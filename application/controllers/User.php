<?php

use SebastianBergmann\Environment\Console;

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
        $this->load->helper('download');
        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('not-login', 'Gagal!');
            redirect('welcome');
        }
    }

    public function index()
    {

        $data['user'] = $this->m_siswa->tampil_data_user($this->session->userdata('id_user'))->row();
        if (isset($_COOKIE['lastMapel'])) {
            $data['aktifitas_belajar'] = json_decode($_COOKIE['lastMapel']);
        }
        $data['total_absen'] = $this->m_siswa->get_total_absen();
        $data['absen'] = $this->m_siswa->get_absen();

        // var_dump($data['total_absen']);
        // die;

        // header('Content-type: application/json');
        // echo json_encode($data);
        // die;
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

    public function all_semester()
    {
        $data['semester'] = $this->m_materi->tampil_data_semester()->result();
        $this->load->view('user/all_semester', $data);
    }

    public function course($slug)
    {

        $data['materi'] = $this->m_siswa->tampil_data_materi($slug)->result();
        $data['mapel'] = $this->m_siswa->tampil_data_course($slug)->row();
        $data['semester'] = $this->m_siswa->get_semester_mapel($slug)->row();
        $data['user'] = $this->m_siswa->tampil_data_user($this->session->userdata('id_user'))->row();
        $data['check_absensi'] = $this->m_siswa->check_absensi($data['mapel']->id_mapel, $this->session->userdata('id_user'));


        setcookie('lastMapel', json_encode([
            'url' => current_url(),
            'data' => $data['mapel']
        ]), 0, '/');

        // var_dump($data['semester']);
        // die;
        $this->load->view('user/materi', $data);
        $this->load->view('template/footer');
    }

    public function materi($id_mapel, $slug)
    {
        $data['side_materi'] = $this->m_siswa->tampil_data_side_materi($id_mapel)->result();


        $data['materi'] = $this->m_siswa->get_nama_materi($slug)->row();
        $id_materi = $data['materi']->id_materi;

        $id_user = $this->session->userdata('id_user');
        $data['file_row'] = $this->m_siswa->tampil_data_file($id_mapel, $slug, $id_user)->row();
        $data['file'] = $this->m_siswa->tampil_data_file($id_mapel, $slug, $id_user)->result();
        $data['zoom_row'] = $this->m_siswa->tampil_data_zoom($id_mapel, $slug, $id_user)->row();
        $data['zoom'] = $this->m_siswa->tampil_data_zoom($id_mapel, $slug, $id_user)->result();
        $data['video'] = $this->m_siswa->tampil_data_video($id_mapel, $slug, $id_user)->row();
        $data['quiz'] = $this->m_siswa->tampil_data_quiz($id_mapel, $slug, $id_user)->result();
        $data['quiz_row'] = $this->m_siswa->tampil_data_quiz($id_mapel, $slug, $id_user)->row();
        $data['quiz'] = $this->m_siswa->tampil_data_quiz($id_mapel, $slug, $id_user)->result();
        $data['tugas_row'] = $this->m_siswa->tampil_data_tugas($id_mapel, $slug, $id_user)->row();
        $data['tugas'] = $this->m_siswa->tampil_data_tugas($id_mapel, $slug, $id_user)->result();
        $data['list_tugas'] = $this->m_siswa->tampil_data_list_tugas($id_mapel, $slug, $id_user)->result();
        $data['list_tugas_row'] = $this->m_siswa->check_tugas_user($id_materi, $id_user);

        // var_dump($data['file_row']);
        // die;

        $id_user = $this->session->userdata('id_user');
        $data['status_materi'] = $this->m_materi->get_status_materi_user($id_materi, $id_user)->row();
        $data['urutan_materi'] = $this->m_siswa->get_urutan($id_mapel, $slug)->row();
        $urutan_prev = ($data['urutan_materi']->urutan) - 1;
        $urutan_next = ($data['urutan_materi']->urutan) + 1;
        $data['previous'] = $this->m_siswa->get_urutan_previous($id_mapel, $urutan_prev)->row();
        $data['next'] = $this->m_siswa->get_urutan_previous($id_mapel, $urutan_next)->row();

        $this->load->view('user/isi_materi', $data);
        $this->load->view('template/footer');
    }

    public function quiz($id_materi)
    {
        $where = [
            'id_user' => $this->session->userdata('id_user'),
            'id_materi' => $id_materi,
            'type' => 'quiz'
        ];

        $cek_soal_dikerjakan = $this->db->select_max('nilai')->where($where)->get('nilai')->row();
        if (!empty($cek_soal_dikerjakan)) {
            if ($cek_soal_dikerjakan->nilai > 70) {
                // $data['is_lulus'] = 1;
                redirect('user/hasil_quiz/' . $id_materi);
            }
        }

        // header('Content-type: application/json');
        // echo json_encode($data);
        // die;
        $where = [
            'id_materi' => $id_materi
        ];

        $data['quiz'] = $this->db->get_where('tb_soal', $where)->result();
        $data['materi'] = $this->db->get_where('materi', $where)->row();

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

        for ($i = 0; $i < $this->input->post('total_soal'); $i++) {

            if ($this->input->post('answer_key' . $i) == $this->input->post('answer' . $i)) {
                $total_benar += 1;
                $is_benar = 1;
            } else {
                $is_benar = 0;
            }
            $jawaban_batch[] = [
                'id_user' => $this->session->userdata('id_user'),
                'id_soal' => $this->input->post('id_soal')[$i],
                'jawaban' => $this->input->post('answer' . $i),
                'is_benar' => $is_benar
            ];
        }

        $nilai = ($total_benar / $this->input->post('total_soal')) * 100;

        $where = [
            'id_user' => $this->session->userdata('id_user'),
            'id_materi' => $this->input->post('id_materi')
        ];

        $cek_soal_dikerjakan = $this->db->select('nilai')->where($where)->get('nilai')->num_rows();

        if (!empty($cek_soal_dikerjakan)) {
            if ($cek_soal_dikerjakan >= 2) {
                if ($nilai >= 70) {
                    $nilai = 70;
                }
            }
        }

        if ($this->input->post('type') == 0) {
            $type = 'quiz';
        } else {
            $type = 'final';
        }
        $tb_nilai = [
            'id_user' => $this->session->userdata('id_user'),
            'id_materi' => $this->input->post('id_materi'),
            'type' => $type,
            'nilai' => $nilai,
        ];
        $this->db->insert_batch('jawaban', $jawaban_batch);
        // $id = $this->db->insert_id();
        $this->db->insert('nilai', $tb_nilai);

        redirect('user/hasil_quiz/' . $this->input->post('id_materi'));
    }

    public function hasil_quiz($id)
    {
        $where = [
            'id_user' => $this->session->userdata('id_user'),
            'id_materi' => $id,
            'type' => 'quiz'
        ];

        $cek_soal_dikerjakan = $this->db->select_max('nilai')->where($where)->get('nilai')->row();
        if (!empty($cek_soal_dikerjakan)) {
            if ($cek_soal_dikerjakan->nilai >= 70) {
                $data['is_lulus'] = 1;
                $this->mark_quiz($id);
            }
        }
        $data['materi'] = $this->db->get_where('materi', ['id_materi' => $id])->row();
        $id_mapel =  $data['materi']->id_mapel;
        $data['mapel'] = $this->db->get_where('mapel', ['id_mapel' => $id_mapel])->row();
        $data['slug_mapel'] = $data['mapel']->slug_mapel;
        $data['histori'] = $this->m_siswa->histori_nilai($id)->result();
        // var_dump($data['histori']);
        // die;

        $this->load->view('user/quiz/hasil', $data);
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
        $config['max_size']             = 1000;
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

    public function mark_quiz($id)
    {
        $where = [
            'id_user' => $this->session->userdata('id_user'),
            'id_materi' => $id,
            'type' => 'quiz'
        ];

        $cek_soal_dikerjakan = $this->db->select_max('nilai')->where($where)->get('nilai')->row();
        if (!empty($cek_soal_dikerjakan)) {
            if ($cek_soal_dikerjakan->nilai >= 70) {
                $data = [
                    'status' => 1
                ];
            } else {
                $data = [
                    'status' => 0
                ];
            }
        }
        $where = [
            'id_materi' => $id,
            'id_user' => $this->session->userdata('id_user')
        ];

        $this->db->where($where);
        $this->db->update('status_materi', $data);
    }

    public function mark($id_mapel, $slug)
    {
        $check_slug = $this->m_materi->get_materi($slug)->row();
        $slug_mapel = $this->m_materi->get_mapel($id_mapel)->row();
        $id_materi = $check_slug->id_materi;
        $slug_mapel = $slug_mapel->slug_mapel;
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
        redirect('user/materi/' . $id_mapel . '/' . $slug);
    }


    public function registration()
    {
        $this->load->view('user/registration');
        $this->load->view('template/footer');
    }

    public function upload_tugas()
    {

        $id_materi = $this->m_siswa->get_materi($this->input->post('slug_materi'))->row();
        $id_mapel = $this->input->post('id_mapel');
        $slug_materi = $this->input->post('slug_materi');

        $config['upload_path']          = './assets/tugas/';
        $config['allowed_types']        = '*';
        $config['max_size']             = 2000;
        $config['encrypt_name']         = true;
        $this->load->library('upload', $config);
        $files_batch = [];

        $jumlah_berkas = count($_FILES['tugas']['name']);
        for ($i = 0; $i < $jumlah_berkas; $i++) {
            if (!empty($_FILES['tugas']['name'][$i])) {
                $_FILES['file']['name'] = $_FILES['tugas']['name'][$i];
                $_FILES['file']['type'] = $_FILES['tugas']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['tugas']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['tugas']['error'][$i];
                $_FILES['file']['size'] = $_FILES['tugas']['size'][$i];
                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $data['nama_file'] = $uploadData['file_name'];
                    $data['desk_file'] = $this->input->post('notes');
                    $data['link'] = base_url('assets/tugas/' . $uploadData['file_name']);
                    $data['id_materi'] = $id_materi->id_materi;
                    $data['is_tugas'] = 1;
                    $data['id_user'] = $this->session->userdata('id_user');
                    // $this->db->insert('file', $data);
                    array_push($files_batch, $data);
                } else {
                    $this->session->set_flashdata('error-tugas', $this->upload->display_errors());
                    redirect('user/materi/' . $id_mapel . '/' . $slug_materi);
                }
            }
        }
        if ($this->db->insert_batch('file', $files_batch)) {
            $this->session->set_flashdata('sukses-tugas', 'File berhasil di upload');
            redirect('user/materi/' . $id_mapel . '/' . $slug_materi);
        } else {
            $this->session->set_flashdata('error-tugas', 'File gagal di upload');
            redirect('user/materi/' . $id_mapel . '/' . $slug_materi);
        }
    }

    public function hapus_tugas($id, $id_mapel, $slug_materi)
    {
        $where = [
            'id_user' => $this->session->userdata('id_user'),
            'id_file' => $id,
        ];
        $this->db->delete('file', $where);
        if ($this->db->error()['message']) {
            $this->session->set_flashdata('error-tugas', 'File gagal dihapus');
            redirect('user/materi/' . $id_mapel . '/' . $slug_materi);
        } else if (!$this->db->affected_rows()) {
            $this->session->set_flashdata('error-tugas', 'File gagal dihapus');
            redirect('user/materi/' . $id_mapel . '/' . $slug_materi);
        } else {
            $this->session->set_flashdata('sukses-tugas', 'File berhasil dihapus');
            redirect('user/materi/' . $id_mapel . '/' . $slug_materi);
        }
    }

    public function download_file($nama_file)
    {
        // $link = base_url('assets/tugas/');
        force_download('assets/tugas/' . $nama_file, null);
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
    public function regenerate_qrcode()
    {
        $this->load->library('qrcode');
        $data['qr_code'] = $this->qrcode->generate($this->session->userdata('email'));
        $where['id_user'] = $this->session->userdata('id_user');
        $this->db->where($where)->update('user', $data);
        $this->session->set_flashdata('sukses-qr', 'QR code berhasil di generate');
        $this->session->set_userdata('qr_code', $data['qr_code']);
        redirect('user/profile');
    }

    public function detail_activity_learn()
    {
        $this->load->view('user/detail_activity_learn');
    }

    public function absensi_input()
    {
        $password = "ketik amin biar saya masuk surga";
        $email = $this->input->post('qr_code', true);
        // $encrypted_string = openssl_encrypt($email, "AES-128-ECB", $password);

        $decrypted_string = openssl_decrypt($email, "AES-128-ECB", $password);


        if ($decrypted_string != $this->session->userdata('email')) {
            echo 'error';
            die;
        }

        $data = array(
            'id_user' => $this->input->post('id_user'),
            'id_mapel' => $this->input->post('id_mapel'),
            'status_absensi' => $this->input->post('status_absensi')
        );
        $this->db->insert('absensi', $data);
        echo 'Absen successfully.';
    }

    public function transkrip()
    {
        $data['nilai_quiz'] = $this->m_siswa->nilai_quiz()->result();
        // $data['nilai_final'] = $this->m_siswa->nilai_final()->result();
        $data['user'] = $this->m_siswa->tampil_data_user($this->session->userdata('id_user'))->row();


        //get the highest value from multi dimenstion array in php
        //get the max value from multi dimenstion array in php
        $array = [[100, 200, 600], [205, 108, 849, 456], [548, 149, 7840]];
        $max = 0;
        for ($i = 0; $i < count($array); $i++) {
            for ($j = 0; $j < count($array[$i]); $j++) {
                if ($array[$i][$j] > $max) {
                    $max = $array[$i][$j];
                }
            }
        }
        print $max;

        // $row = [];
        // $lastNilai = 0;
        // foreach ($data['nilai_quiz'] as $key => $value) {
        //     if ($value->nilai > $lastNilai) {
        //         $lastNilai = $value->nilai;
        //         $row = $value;
        //     }
        // }
        die;
        $this->load->view('user/transkrip', $data);
    }
}
