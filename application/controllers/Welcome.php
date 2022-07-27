<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function payment_callback()
    {
        $Date = date("Y-m-d");

        $user = $this->db
            ->select('*, user.angsuran')
            ->where('referenceId', $this->input->post('reference'))
            ->join('transaksi', 'transaksi.id_user = user.id_user')
            ->get('user')
            ->row();

        if ($this->input->post('resultCode') == '00') {
            $status = 'success';
            if ($user->last_status == 0) {
                if ($user->angsuran != null) {
                    $data['last_status'] = 1;
                    $data['angsuran'] = $user->angsuran + 1;

                    $this->db->where('id_user', $user->id_user)->update('user', $data);

                    if ($data['angsuran'] == $user->tipe_angsuran) {
                        $expired_at = NULL;
                    } else {
                        $expired_at = date('Y-m-d',  strtotime($Date . ' + 1 month'));
                    }

                    $this->db->insert_batch('enroll', [
                        [
                            'id_semester' => 1,
                            'id_user' => $user->id_user,
                            'expired_at' => $expired_at

                        ],
                        [
                            'id_semester' => 2,
                            'id_user' => $user->id_user,
                            'expired_at' => $expired_at
                        ]
                    ]);
                } else {
                    $data['last_status'] = 1;
                    $this->db->where('id_user', $user->id_user)->update('user', $data);
                    $this->db->insert_batch('enroll', [
                        [
                            'id_semester' => 1,
                            'id_user' => $user->id_user,
                        ],
                        [
                            'id_semester' => 2,
                            'id_user' => $user->id_user,
                        ]
                    ]);
                }
            } else {
                $data['angsuran'] = $user->angsuran + 1;
                $this->db->where('id_user', $user->id_user)->update('user', $data);

                $enroll = $this->db->where('id_user', $user->id_user)->get('enroll')->row();

                $this->db->where('id_user', $user->id_user)->update('enroll', [
                    'expired_at' => date('Y-m-d',  strtotime($enroll->expired_at . ' + 1 month'))
                ]);
                echo json_encode($enroll);
            }
        } else {
            $status = 'failed';
        }

        $this->db->where('referenceId', $this->input->post('reference'))->update('transaksi', [
            'status' => $status,

        ]);

        // echo json_encode([
        //     'data' => $user
        // ]);
    }

    public function cron_job(){
        $this->db->where('expired_at <', date("Y-m-d"))->delete('enroll');
    }

    public function __construct()
    {
        parent::__construct();

        // load Session Library
        $this->load->library('session');

        // load url helper
        $this->load->helper('url');
    }
    public function index()
    {
        $this->load->model("m_materi");
        $this->load->view('template/nav');
        $data['course'] = $this->m_materi->get_all_mapel()->result();

        $this->load->view('index', $data);
        $this->load->view('template/footer');
    }


    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('token', ['token => $token'])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (600 * 600 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('token', ['email' => $email]);
                    $this->session->set_flashdata('success-verify', 'Bserhasil!');
                    redirect(base_url('welcome'));
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('token', ['email' => $email]);

                    $this->session->set_flashdata('fail-token-expired', 'gagal');
                    redirect(base_url('welcome'));
                }
            } else {
                $this->session->set_flashdata('fail-token', 'gagal');
                redirect(base_url('welcome'));
            }
        } else {
            $this->session->set_flashdata('fail-verify', 'gagal');
            redirect(base_url('welcome'));
        }
    }

    // Guru


}
