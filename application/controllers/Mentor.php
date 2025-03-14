<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mentor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('m_guru');
        $this->load->library('image_lib');
        date_default_timezone_set('Asia/Jakarta');
        if (!$this->session->userdata('is_guru')) {
            $this->session->set_flashdata('not-login', 'Gagal!');
            redirect('welcome/mentor');
        }
    }

    public function index()
    {
        $tgl = date_create(date("Y-m-d") . '00:00:00');
        $tgl_start = date_format($tgl, "Y-m-d H:i:s");
        $tgl2 = date_create(date("Y-m-d") . '23:59:59');
        $tgl_end = date_format($tgl2, "Y-m-d H:i:s");
        $data['jadwal'] = $this->m_guru->jadwal_zoom($tgl_start, $tgl_end)->result();

        // var_dump($data['jadwal']);
        // die;
        $this->load->view('guru/index', $data);
        $this->load->view('template/footer');
    }

    public function add_materi()
    {
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom deskripsi.',
            'min_length' => 'deskripsi terlalu pendek.',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('guru/mapel/add_materi');
        } else {
            $upload_video = $_FILES['video'];

            if ($upload_video) {
                $config['allowed_types'] = 'mp4|mkv';
                $config['max_size'] = '0';
                $config['upload_path'] = './assets/materi_video';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('video')) {
                    $video = $this->upload->data('file_name');
                } else {
                    $this->upload->display_errors();
                }
            }
            $data = [
                'nama_guru' => htmlspecialchars($this->input->post('nama_guru', true)),
                'nama_mapel' => htmlspecialchars($this->input->post('nama_mapel', true)),
                'video' => $video,
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi', true)),
                'kelas' => htmlspecialchars($this->input->post('kelas', true)),
            ];

            $this->db->insert('materi', $data);
            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('guru'));
        }
    }

    public function course($slug)
    {
        $data['mapel'] = $this->m_guru->tampil_data_course($slug)->row();
        $data['live'] = $this->m_guru->tampil_data_live($slug)->result();
        // var_dump($data['live']);
        // die;
        // setcookie('lastMapel', json_encode([
        //     'url' => current_url(),
        //     'data' => $data['mapel']
        // ]), 0, '/');

        // $this->db->insert('activity', [
        //     'id_user' => $this->session->userdata('id_user'),
        //     'nama_activity' => $data['mapel']->nama_mapel,
        //     'url' => current_url(),
        //     'type' => 'course'
        // ]);


        $this->load->view('guru/materi', $data);
        $this->load->view('template/footer');
    }
    public function jadwal()
    {
        $data['jadwal'] = $this->m_guru->jadwal_zoom_all()->result();
        foreach ($data['jadwal'] as $key => $value) {
            $data['data'][$key]['title'] = $value->nama_mapel;
            $data['data'][$key]['nama_guru'] = $value->nama_guru;
            $data['data'][$key]['start'] = $value->tgl_mulai;
            $data['data'][$key]['end'] = $value->tgl_selesai;
            $data['data'][$key]['link'] = $value->link;
            $data['data'][$key]['textColor'] = "#fff";
        }
        $this->load->view('guru/jadwal', $data);
        $this->load->view('template/footer');
    }
    public function print_jadwal()
    {
        $this->load->library('pdf');
        $data['user'] = $this->m_guru->get_guru($this->session->userdata('id_guru'))->row();
        $data['jadwal'] = $this->m_guru->jadwal_zoom_all()->result();
        $this->pdf->setFileName('Jadwal_SU_' . $this->session->userdata('nama_guru') . '.pdf');
        $this->pdf->setKertas('portrait');
        $this->pdf->load_view('guru/print_jadwal', $data);
    }

    public function profile()
    {
        $id_user = $this->session->userdata('id_guru');
        $data['profile'] = $this->m_guru->get_profile($id_user)->row();

        $this->load->view('guru/profile', $data);
        $this->load->view('template/footer');
    }

    public function image_profile()
    {
        $config['upload_path']          = './assets/profile_picture/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 1000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image_guru')) {
            $this->session->set_flashdata('error-profile', $this->upload->display_errors());
            redirect('mentor/profile');
        } else {
            $image_data =   $this->upload->data();
            $configer =  array(
                'image_library'   => 'gd2',
                'source_image'    =>  $image_data,
                'maintain_ratio'  =>  TRUE,
                'width'           =>  250,
                'height'          =>  250,
            );
            $this->image_lib->clear();
            $this->image_lib->initialize($configer);
            $this->image_lib->resize();
            $gambar = $image_data['file_name'];

            $where = [
                'id_guru' => $this->session->userdata('id_guru')
            ];
            $data = [
                'image_guru' => $gambar
            ];

            $this->db->where($where);
            $this->db->update('guru', $data);
            $this->session->set_flashdata('success-profile', 'berhasil mengubah image profile');
            redirect('mentor/profile');
        }
    }

    public function update_profile()
    {

        if (empty($this->input->post('password_baru'))) {
            $this->form_validation->set_rules(
                'password_baru',
                'Password'
            );
            $this->form_validation->set_rules('conf_password', 'Password', 'required|trim|matches[password_baru]', [
                'matches' => 'Password tidak sama!',
            ]);
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error-password', 'Gagal');
                $this->profile();
            } else {
                $where = [
                    'id_guru' => $this->session->userdata('id_guru')
                ];
                $data = [
                    'nama_guru' => $this->input->post('nama_guru'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password_baru'), PASSWORD_DEFAULT),
                    // 'no_telp' => $this->input->post('no_telp'),
                    'jk' => $this->input->post('jk'),
                    'ttl' => $this->input->post('ttl'),
                    'alamat' => $this->input->post('alamat'),
                ];
                $this->db->where($where);
                $this->db->update('guru', $data);
                $this->session->set_flashdata('success-password', 'berhasil');
                redirect('mentor/profile');
            }
        } else {
            $where = [
                'id_guru' => $this->session->userdata('id_guru')
            ];
            $data = [
                'nama_guru' => $this->input->post('nama_guru'),
                'email' => $this->input->post('email'),
                // 'no_telp' => $this->input->post('no_telp'),
                'jk' => $this->input->post('jk'),
                'ttl' => $this->input->post('ttl'),
                'alamat' => $this->input->post('alamat'),
            ];
            $this->db->where($where);
            $this->db->update('guru', $data);
            $this->session->set_flashdata('success-password', 'berhasil');
            redirect('mentor/profile');
        }
    }
}
