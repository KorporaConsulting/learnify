<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_siswa');
        $this->load->model('m_materi');
        $this->load->helper(array('form', 'url'));
        $this->load->library('image_lib');
        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('not-login', 'Gagal!');
            redirect('welcome');
        }
    }

    public function index()
    {
        $data['semester'] = $this->m_materi->tampil_data_semester()->result();

        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }

    public function semester($semester)
    {
        $id_user = $this->session->userdata('id_user');
        $data['course'] = $this->m_siswa->tampil_data_semester($semester, $id_user)->result();

        $this->load->view('user/course', $data);
        $this->load->view('template/footer');
    }

    public function course($slug)
    {

        $data['materi'] = $this->m_siswa->tampil_data_materi($slug)->result();
        $data['mapel'] = $this->m_siswa->tampil_data_course($slug)->row();
        // var_dump($this->session->userdata('id_user'));
        // die;
        // var_dump($data['materi']);
        // die;
        $this->load->view('user/materi', $data);
        $this->load->view('template/footer');
    }

    public function materi($slug)
    {
        $id_user = $this->session->userdata('id_user');
        $data['file_row'] = $this->m_siswa->tampil_data_file($slug, $id_user)->row();
        $data['file'] = $this->m_siswa->tampil_data_file($slug, $id_user)->result();
        $data['video'] = $this->m_siswa->tampil_data_video($slug, $id_user)->row();
        $data['quiz'] = $this->m_siswa->tampil_data_quiz($slug, $id_user)->result();
        $data['quiz_row'] = $this->m_siswa->tampil_data_quiz($slug, $id_user)->row();
        $data['materi'] = $this->m_siswa->get_nama_materi($slug)->row();

        $id_materi = $data['materi']->id_materi;
        $id_user = $this->session->userdata('id_user');

        $data['status_materi'] = $this->m_materi->get_status_materi_user($id_materi, $id_user)->row();


        $this->load->view('user/isi_materi', $data);
        $this->load->view('template/footer');
    }

    public function quiz ($id_materi)
    {
        $where = [
            'id_user' => $this->session->userdata('id_user'),
            'id_materi' => $id_materi,
            'type' => 'quiz'
        ];

        $cek_soal_dikerjakan = $this->db->select_max('nilai')->where($where)->get('nilai')->row();

        if(!empty($cek_soal_dikerjakan)){
            if($cek_soal_dikerjakan->nilai > 70){
                echo 'lulus';
                die;
            }
        }
        // header('Content-type: application/json');
        // echo json_encode($data);
        // die;
        $where = [
            'id_materi' => $id_materi
        ];

        $data['quiz'] = $this->db->get_where('tb_soal', $where)->result();

        //  header('content-type: application/json');

        // echo json_encode([
        //     'data' => $data
        // ]);

        $this->load->view('user/quiz/tampil_quiz', $data);
    }

    public function save_quiz()
    {
        header('Content-type: application/json');

        $total_benar = 0;

        for ($i=0; $i < $this->input->post('total_soal'); $i++) { 

            if($this->input->post('answer_key' . $i) == $this->input->post('answer' . $i)){
                $total_benar += 1;
                $is_benar = 1;
            }else{
                $is_benar = 0;
            }
            $jawaban_batch [] = [
                'id_user' => $this->session->userdata('id_user'),
                'id_soal' => $this->input->post('id_soal')[$i],
                'jawaban' => $this->input->post('answer' . $i),
                'is_benar' => $is_benar
            ];
        }

        $nilai = ($total_benar / $this->input->post('total_soal')) * 100;

        $tb_nilai = [
            'id_user' => $this->session->userdata('id_user'),
            'id_materi' => $this->input->post('id_materi'),
            'type' => 'quiz',
            'nilai' => $nilai,
        ];
        
        $this->db->insert_batch('jawaban', $jawaban_batch);
        $this->db->insert('nilai', $tb_nilai);
        
    }

    public function profile()
    {
        $id_user = $this->session->userdata('id_user');
        $data['profile'] = $this->m_siswa->get_profile($id_user)->row();

        $this->load->view('user/profile', $data);
        $this->load->view('template/footer');
    }

    public function image_profile()
    {
        $config['upload_path']          = './assets/profile_picture/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['max_size']             = 2000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image_user')) {
            $this->session->set_flashdata('error-profile', $this->upload->display_errors());
            redirect('user/profile');
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
                'id_user' => $this->session->userdata('id_user')
            ];
            $data = [
                'image_user' => $gambar
            ];

            $this->db->where($where);
            $this->db->update('user', $data);
            $this->session->set_flashdata('success-profile', 'berhasil mengubah image profile');
            redirect('user/profile');
        }
    }

    public function update_profile()
    {
        if ($this->input->post('password_baru') != "") {
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
                    'id_user' => $this->session->userdata('id_user')
                ];
                $data = [
                    'nama' => $this->input->post('nama'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password_baru'), PASSWORD_DEFAULT),
                    'no_telp' => $this->input->post('no_telp'),
                    'jk' => $this->input->post('jk'),
                    'ttl' => $this->input->post('ttl'),
                    'alamat' => $this->input->post('alamat'),
                ];
                $this->db->where($where);
                $this->db->update('user', $data);
                $this->session->set_flashdata('success-password', 'berhasil');
                redirect('user/profile');
            }
        } else {
            $where = [
                'id_user' => $this->session->userdata('id_user')
            ];
            $data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_telp' => $this->input->post('no_telp'),
                'jk' => $this->input->post('jk'),
                'ttl' => $this->input->post('ttl'),
                'alamat' => $this->input->post('alamat'),
            ];
            $this->db->where($where);
            $this->db->update('user', $data);
            $this->session->set_flashdata('success-password', 'berhasil');
            redirect('user/profile');
        }
    }


    public function mark($id_mapel, $slug)
    {
        $check_slug = $this->m_materi->get_materi($slug)->row();
        $slug_mapel = $this->m_materi->get_mapel($id_mapel)->row();

        $id_materi = $check_slug->id_materi;
        $slug_mapel = $slug_mapel->slug;
        $id_user = $this->session->userdata('id_user');

        $where = [
            'id_materi' => $id_materi,
            'id_user' => $id_user
        ];
        $data = [
            'status' => 1
        ];
        $this->db->where($where);
        $this->db->update('status_materi', $data);
        $this->session->set_flashdata('success-mark', 'berhasil');
        redirect('user/course/' . $slug_mapel);
    }


    public function registration()
    {
        $this->load->view('user/registration');
        $this->load->view('template/footer');
    }

    public function registration_act()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[4]', [
            'required' => 'Harap isi kolom username.',
            'min_length' => 'Nama terlalu pendek.',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email ini telah digunakan!',
            'required' => 'Harap isi kolom email.',
            'valid_email' => 'Masukan email yang valid.',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[retype_password]', [
            'required' => 'Harap isi kolom Password.',
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek',
        ]);
        $this->form_validation->set_rules('retype_password', 'Password', 'required|trim|matches[password]', [
            'matches' => 'Password tidak sama!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/nav');
            $this->load->view('user/registration');
            $this->load->view('template/footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'is_active' => 1,
                'date_created' => time(),
            ];

            //siapkan token

            // $token = base64_encode(random_bytes(32));
            // $user_token = [
            //     'email' => $email,
            //     'token' => $token,
            //     'date_created' => time(),
            // ];

            $this->db->insert('user', $data);
            // $this->db->insert('token', $user_token);

            // $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('welcome'));
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'ini email disini',
            'smtp_pass' => 'Isi Password gmail disini',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];

        $this->email->initialize($config);

        $data = array(
            'name' => 'syauqi',
            'link' => ' ' . base_url() . 'welcome/verify?email=' . $this->input->post('email') . '& token' . urlencode($token) . '"',
        );

        $this->email->from('LearnifyEducations@gmail.com', 'Learnify');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $link =
                $this->email->subject('Verifikasi Akun');
            $body = $this->load->view('template/email-template.php', $data, true);
            $this->email->message($body);
        } else {
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die();
        }
    }
}
