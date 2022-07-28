<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Price extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_siswa');
        $this->load->model('m_materi');
        $this->load->helper(array('form', 'url'));
        $this->load->library('image_lib');
        $this->load->helper('download');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['user'] = $this->db
            ->where('user.id_user', $this->session->userdata('id_user'))
            ->join('enroll', 'user.id_user = enroll.id_user', 'left')
            ->get('user')
            ->row();

        $data['harga'] = $this->db->get('harga_enroll')->row();
        $this->load->view('user/price', $data);
        $this->load->view('template/footer');
    }
    public function check_voucher()
    {
        header('Content-type: application/json');

        $check = $this->db->where('kode', $this->input->post('kode_voucher'))->get('voucher')->row();

        if ($check != null) {
            if ($check->kode === $this->input->post('kode_voucher')) {
                if ($check->expired_at > date("Y-m-d")) {
                    $data = [
                        'success' => true,
                        'message' => 'Voucher dapat digunakan'
                    ];
                } else {
                    $data = [
                        'success' => false,
                        'message' => 'Voucher expired'
                    ];
                }
            } else {
                $data = [
                    'success' => false,
                    'message' => 'Kode Voucher tidak tersedia',
                ];
            }
        } else {
            $data = [
                'success' => false,
                'message' => 'Kode Voucher tidak tersedia',
            ];
        }


        echo json_encode($data);
    }
    public function update_status_transaksi()
    {
        header('Content-type: application/json');

        if (count($this->input->post('id_transaksi')) > 1) {

            $data = [
                'status' => 'pending'
            ];

            $this->db->where_in('id_transaksi', $this->input->post('id_transaksi'))->update('transaksi', $data);
        }

        $data = [
            'status' => $this->input->post('status')
        ];

        $this->db->where('id_transaksi', $this->input->post('id_transaksi')[0])->update('transaksi', $data);

        echo json_encode([
            'success' => true,
            'data' => $this->input->post('id_transaksi')
        ]);
    }
    public function pay_without_installment()
    {
        header('Content-type: application/json');
        $this->load->library('duitku');
        $price = 3000000 / $this->input->post('loop');

        $product = [
            'nama' => $this->input->post('name'),
            'cicilan' => false,
            'Detail Product' => 'Cicilan Pertama',
            'price' => $price
        ];

        $payment_setting = $this->db->where('is_active', 1)->get('payment_setting')->row();

        $data = $this->duitku->pay($payment_setting, $product, $this->session->userdata());

        if ($data['success']) {
            $count = $this->db->select('id_transaksi')->get('transaksi')->num_rows();
            $num = $count + 1;
            $kode = 'INV-' . str_pad($num, 6, '0', STR_PAD_LEFT);
            $this->db->insert('transaksi', [
                'id_user' => $this->session->userdata('id_user'),
                'kode_transaksi' =>  $kode,
                'nama_transaksi' => $this->input->post('nama_product'),
                'harga' => $price,
                'referenceId' => $data['data']['reference']
            ]);

            $this->db->where('id_user', $this->session->userdata('id_user'))->update('user', [
                'angsuran' => NULL
            ]);

            echo json_encode([
                'duitku' => $data['data'],
                'success' => true,
                'id_transaksi' => [$this->db->insert_id()]
            ]);

            die;
        }

        echo json_encode([
            'success' => false,
            'err' => $data
        ]);
    }
    public function pay_with_installment()
    {

        header('Content-type: application/json');
        $this->load->library('duitku');
        $price = 3000000 / $this->input->post('loop');
        // echo json_encode([
        //     'success' => false,
        //     'err' => $this->input->post('name')
        // ]);
        // die;
        $product = [
            'nama' => $this->input->post('name'),
            'cicilan' => true,
            'Detail Product' => 'Cicilan Pertama',
            'price' => $price
        ];

        $payment_setting = $this->db->where('is_active', 1)->get('payment_setting')->row();

        $data = $this->duitku->pay($payment_setting, $product, $this->session->userdata());

        if ($data['success']) {

            $id_transaksi = [];
            $count = $this->db->select('id_transaksi')->get('transaksi')->num_rows();
            for ($i = 0; $i < $this->input->post('loop'); $i++) {
                $num = $count + 1 + $i;
                $kode = 'INV-' . str_pad($num, 6, '0', STR_PAD_LEFT);
                $this->db->insert('transaksi', [
                    'id_user' => $this->session->userdata('id_user'),
                    'kode_transaksi' =>  $kode,
                    'nama_transaksi' => $this->input->post('name'),
                    'harga' => $price,
                ]);
                array_push($id_transaksi, $this->db->insert_id());
            }
            $user = $this->db->where('id_user', $this->session->userdata('id_user'))->get('user')->row();
            $angsuran = 0;

            if ($user->angsuran != NULL && $user->angsuran > 0) {
                $angsuran = $user->angsuran;
            }

            $this->db->where('id_user', $this->session->userdata('id_user'))->update('user', [
                'angsuran' => $angsuran,
                'tipe_angsuran' => $this->input->post('loop')
            ]);

            echo json_encode([
                'duitku' => $data['data'],
                'success' => true,
                'id_transaksi' => $id_transaksi
            ]);
            die;
        }
        echo json_encode([
            'success' => false,
            'err' => $data['data']
        ]);
    }
    public function detail_pembayaran()
    {
        if ($this->input->get('type')) {
            $data['is_cicilan'] = true;
            $data['cicilan'] = $this->input->get('type');
        } else {
            $data['is_cicilan'] = false;
        }

        $this->load->view('user/detail_payment', $data);
    }
}
