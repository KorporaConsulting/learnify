<?php

use phpDocumentor\Reflection\Types\This;
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
        date_default_timezone_set('Asia/Jakarta');

        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('not-login', 'Gagal!');
            redirect('welcome');
        }
        if ($this->check_transaksi() == false) {
            redirect('price');
        }
    }

    public function check_profile()
    {
        $cek_profile = $this->db->query('SELECT jk,ttl,alamat FROM user WHERE id_user = ' . $this->session->userdata("id_user"));
        $cek = $cek_profile->row();

        // var_dump($cek);
        // return $cek;
        if ($cek->jk == null || $cek->ttl == null || $cek->alamat == null) {
            return false;
        } else {
            return true;
        }
    }

    public function check_transaksi()
    {
        $cek_transaksi = $this->db->query('SELECT last_status FROM user WHERE id_user = ' . $this->session->userdata("id_user"));
        $cek = $cek_transaksi->row();

        if ($cek->last_status == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function index()
    {
        $data['cek'] = $this->check_profile();
        $data['user'] = $this->m_siswa->tampil_data_user($this->session->userdata('id_user'))->row();

        $data['aktifitas_belajar'] = $this->db
            ->where('id_user', $this->session->userdata('id_user'))
            ->where('type', 'course')
            ->limit(5)
            ->group_by('nama_activity')
            ->get('activity')->result();

        $data['recent_video'] = $this->db
            ->join('video', 'video.id_video = activity.id_join', 'left')
            ->where('id_user', $this->session->userdata('id_user'))
            ->where('type', 'video')
            ->limit(5)
            ->group_by('nama_activity')
            ->get('activity')->result();


        $tgl = date_create(date("Y-m-d"));
        $tgl_start = date_format($tgl, "Y-m-d H:i:s");
        $tgl2 = date_create(date("Y-m-d") . '23:59:59');
        $tgl_end = date_format($tgl2, "Y-m-d H:i:s");
        $data['jadwal'] = $this->m_siswa->jadwal_zoom_home($tgl_start, $tgl_end)->result();

        $data['total_absen'] = $this->m_siswa->get_total_absen();
        $data['absen'] = $this->m_siswa->get_absen();

        $data['akurasi'] = $this->m_siswa->get_akurasi_absen()->row();


        // header('Content-type: application/json');
        // echo json_encode($data);
        // die;
        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }




    public function test()
    {
        $this->load->library('CoverVideo');
        $this->CoverVideo->generate();
    }

    public function semester($semester)
    {
        $id_user = $this->session->userdata('id_user');
        $data['course'] = $this->m_siswa->tampil_data_semester($semester, $id_user)->result();
        $data['zoom'] = $this->m_siswa->tampil_data_semester_zoom($semester, $id_user)->result();

        // var_dump($data['course']);
        // die;

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
        $data['live'] = $this->m_siswa->tampil_data_live($slug)->result();
        $data['mapel'] = $this->m_siswa->tampil_data_course($slug)->row();
        $data['semester'] = $this->m_siswa->get_semester_mapel($slug)->row();
        $data['user'] = $this->m_siswa->tampil_data_user($this->session->userdata('id_user'))->row();
        $data['check_absensi'] = $this->m_siswa->check_absensi($data['mapel']->id_mapel, $this->session->userdata('id_user'));

        $data['total_materi'] = $this->m_siswa->total_status($this->session->userdata('id_user'), $data['mapel']->id_mapel);
        $data['done_materi'] = $this->m_siswa->done_status($this->session->userdata('id_user'), $data['mapel']->id_mapel);


        // var_dump($data['live']);
        // die;
        // setcookie('lastMapel', json_encode([
        //     'url' => current_url(),
        //     'data' => $data['mapel']
        // ]), 0, '/');

        if ($data['mapel']->is_zoom == 0) {
            $this->db->insert('activity', [
                'id_user' => $this->session->userdata('id_user'),
                'nama_activity' => $data['mapel']->nama_mapel,
                'url' => current_url(),
                'type' => 'course'
            ]);
        }


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
        $data['tugas_row'] = $this->m_siswa->tampil_data_tugas($id_mapel, $slug, $id_user)->row();
        $data['tugas'] = $this->m_siswa->tampil_data_tugas($id_mapel, $slug, $id_user)->result();
        $data['list_tugas'] = $this->m_siswa->tampil_data_list_tugas($id_mapel, $slug, $id_user)->result();
        $data['list_tugas_row'] = $this->m_siswa->check_tugas_user($id_materi, $id_user);

        if ($data['video']->id_video != null) {
            if ($data['video']->kunci == 1) {
                $this->db->insert('activity', [
                    'id_user' => $this->session->userdata('id_user'),
                    'id_join' => $data['video']->id_video,
                    'nama_activity' => $data['video']->nama_materi,
                    'type' => 'video',
                    'url' => current_url()
                ]);
            }
        }
        // var_dump($data['quiz_row']);
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

    public function quiz($id_materi, $id_quiz)
    {
        $where = [
            'id_user' => $this->session->userdata('id_user'),
            'id_materi' => $id_materi
        ];

        $cek_soal_dikerjakan = $this->db->select('type')->select_max('nilai')->where($where)->get('nilai')->row();
        $data['min_nilai'] = $this->db->select('min_nilai')->where('id_materi', $id_materi)->get('quiz')->row();

        if ($cek_soal_dikerjakan->type == 1) {
            if (!empty($cek_soal_dikerjakan)) {
                if ($cek_soal_dikerjakan->nilai >= $data['min_nilai']->min_nilai) {
                    // $data['is_lulus'] = 1;
                    redirect('user/hasil_quiz/' . $id_materi . '/' . $id_quiz);
                }
            }
        }

        $data['quiz'] = $this->db->get_where('tb_soal', ['id_quiz' => $id_quiz])->result();
        $data['materi'] = $this->db->get_where('materi', ['id_materi' => $id_materi])->row();
        $data['quiz_type'] = $this->db->get_where('quiz', ['id_quiz' => $id_quiz])->row();


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
        $type_quiz = $this->db->select('type')->where('id_materi', $this->input->post('id_materi'))->get('quiz')->row();


        $max_post_test = $this->db->select('max_post_test')->get('opt_quiz')->row();

        if (!empty($cek_soal_dikerjakan)) {
            if ($type_quiz->type == 1) {
                if ($cek_soal_dikerjakan >= $max_post_test->max_post_test) {
                    if ($nilai >= 70) {
                        $nilai = 70;
                    }
                }
            }
        }

        $tb_nilai = [
            'id_user' => $this->session->userdata('id_user'),
            'id_materi' => $this->input->post('id_materi'),
            'type' => $this->input->post('type'),
            'nilai' => $nilai,
        ];
        $this->db->insert_batch('jawaban', $jawaban_batch);
        $this->db->insert('nilai', $tb_nilai);

        redirect('user/hasil_quiz/' . $this->input->post('id_materi') . '/' . $this->input->post('id_quiz'));
    }

    public function hasil_quiz($id, $id_quiz)
    {
        $where = [
            'id_user' => $this->session->userdata('id_user'),
            'id_materi' => $id,
        ];

        $cek_soal_dikerjakan = $this->db->select('type')->select_max('nilai')->where($where)->get('nilai')->row();

        $data['min_nilai'] = $this->db->select('min_nilai')->where('id_materi', $id)->get('quiz')->row();
        $max_post_test = $this->db->select('max_post_test')->get('opt_quiz')->row();
        // $type_quiz = $this->db->select('type')->where('id_materi', $id)->get('quiz')->row();

        // $cek_soal_num = $this->db->select('nilai')->where($where)->get('nilai')->num_rows();

        if (!empty($cek_soal_dikerjakan)) {
            // if ($cek_soal_num >= $max_post_test->max_post_test) {
            if ($cek_soal_dikerjakan->nilai >= $data['min_nilai']->min_nilai) {
                $this->mark_quiz($id);
                if ($cek_soal_dikerjakan->type == 1) {
                    $data['is_lulus'] = 1;
                }
            }
            // }
        }


        $data['materi'] = $this->db->get_where('materi', ['id_materi' => $id])->row();
        $id_mapel =  $data['materi']->id_mapel;
        $data['mapel'] = $this->db->get_where('mapel', ['id_mapel' => $id_mapel])->row();
        $data['slug_mapel'] = $data['mapel']->slug_mapel;
        $data['id_quiz'] = $id_quiz;
        $data['is_final'] = $cek_soal_dikerjakan->type;
        $data['histori'] = $this->m_siswa->histori_nilai($id)->result();

        $total_materi = $this->m_siswa->total_status($this->session->userdata('id_user'), $id_mapel);
        $done_materi = $this->m_siswa->done_status($this->session->userdata('id_user'), $id_mapel);

        // var_dump($id_mapel);
        // var_dump($done_materi);
        // die;

        if ($total_materi == $done_materi) {
            $this->insert_transkrip($this->session->userdata('id_user'), $id_mapel);
            $this->mark_mapel($id_mapel);
        }
        $data['opt_quiz'] = $this->db->select('*')->get('opt_quiz')->row();
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
        $check_slug = $this->m_materi->where_tampil_materi($id)->row();
        $id_mapel = $check_slug->id_mapel;
        $urutan = $check_slug->urutan + 1;

        $where = [
            'id_user' => $this->session->userdata('id_user'),
            'id_materi' => $id,
        ];

        $cek_soal_dikerjakan = $this->db->select_max('nilai')->where($where)->get('nilai')->row();
        $data['min_nilai'] = $this->db->select('min_nilai')->where('id_materi', $id)->get('quiz')->row();

        if (!empty($cek_soal_dikerjakan)) {
            if ($cek_soal_dikerjakan->nilai >= $data['min_nilai']->min_nilai) {
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

        $get_urutan_materi = $this->m_materi->cek_urutan_materi($id_mapel, $urutan)->row();
        if (!empty($get_urutan_materi)) {
            $where_kunci = [
                'id_materi' => $get_urutan_materi->id_materi,
                'id_user' => $this->session->userdata('id_user')
            ];
            $data_kunci = [
                'kunci' => 1
            ];

            $this->db->where($where_kunci);
            $this->db->update('status_materi', $data_kunci);
        }
    }

    public function mark($id_mapel, $slug)
    {
        $check_slug = $this->m_materi->get_materi($slug)->row();
        $slug_mapel = $this->m_materi->get_mapel($id_mapel)->row();
        $id_materi = $check_slug->id_materi;
        $urutan = $check_slug->urutan + 1;
        $slug_mapel = $slug_mapel->slug_mapel;
        $id_user = $this->session->userdata('id_user');

        $get_urutan_materi = $this->m_materi->cek_urutan_materi($id_mapel, $urutan)->row();

        $where_kunci = [
            'id_materi' => $get_urutan_materi->id_materi,
            'id_user' => $id_user
        ];

        $data_kunci = [
            'kunci' => 1
        ];

        $this->db->where($where_kunci);
        $this->db->update('status_materi', $data_kunci);


        $where = [
            'id_materi' => $id_materi,
            'id_user' => $id_user
        ];

        $data = [
            'status' => 1
        ];

        $this->db->where($where);
        $this->db->update('status_materi', $data);
        $this->session->set_flashdata('success-mark', 'Berhasil');
        redirect('user/materi/' . $id_mapel . '/' . $slug);
    }

    public function mark_mapel($id_mapel)
    {
        $mapel = $this->m_materi->get_mapel($id_mapel)->row();
        $semester = $this->m_materi->get_kunci_mapel($mapel->id_semester)->row();
        $urutan = $mapel->urutan + 1;
        $id_user = $this->session->userdata('id_user');

        $get_urutan_mapel = $this->m_materi->cek_urutan_mapel($semester->id_semester, $urutan)->row();

        // var_dump($get_urutan_mapel);
        // die;

        $where_kunci = [
            'id_mapel' => $get_urutan_mapel->id_mapel,
            'id_user' => $id_user
        ];

        $data_kunci = [
            'kunci' => 1
        ];

        $this->db->where($where_kunci);
        $this->db->update('status_mapel', $data_kunci);


        $where = [
            'id_mapel' => $id_mapel,
            'id_user' => $id_user
        ];

        $data = [
            'status' => 1
        ];

        $this->db->where($where);
        $this->db->update('status_mapel', $data);
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

        $cek_time_mapel = $this->m_materi->get_mapel($this->input->post('id_mapel'))->row();

        $date_mulai = date_create($cek_time_mapel->tgl_mulai);
        $date_selesai = date_create($cek_time_mapel->tgl_selesai);


        $date_mulai =  strtotime(date_format($date_mulai, 'H:i:s'));
        $date_selesai = strtotime(date_format($date_selesai, 'H:i:s'));
        $date_now = strtotime(date('H:i:s'));
        $akurasi = $date_now - $date_mulai;

        if ($akurasi <= 0) {
            $ketepatan_absen = "100";
        } elseif ($akurasi >= 1 && $akurasi <= 600) {
            $ketepatan_absen = "97";
        } elseif ($akurasi >= 601 && $akurasi <= 1200) {
            $ketepatan_absen = "80";
        } elseif ($akurasi >= 1201 && $akurasi <= 1800) {
            $ketepatan_absen = "60";
        } elseif ($akurasi >= 1801) {
            $ketepatan_absen = "0";
        }


        $decrypted_string = openssl_decrypt($email, "AES-128-ECB", $password);


        if ($decrypted_string != $this->session->userdata('email')) {
            echo 'error';
            die;
        }

        $data = array(
            'id_user' => $this->input->post('id_user'),
            'id_mapel' => $this->input->post('id_mapel'),
            'status_absensi' => $this->input->post('status_absensi'),
            'ketepatan_absensi' =>  $ketepatan_absen
        );
        $this->db->insert('absensi', $data);
        echo 'Absen successfully.';
    }

    public function insert_transkrip($id_user, $id_mapel)
    {

        // $check_tugas = $this->m_siswa->check_tugas($id_mapel);

        // if ($check_tugas == 0) {
        //     $p_nilai = $this->db->select('*')->where('id_persentase_nilai', 2)->get('persentase_nilai')->row();
        // } else {
        //     $p_nilai = $this->db->select('*')->where('id_persentase_nilai', 1)->get('persentase_nilai')->row();
        // }

        // $data_nilai_quiz = $this->m_siswa->nilai_quiz()->result();
        // $nilai_quiz_tampung = 0;
        // $total_nilai_quiz = count($data_nilai_quiz);
        // if (!empty($data_nilai_quiz)) {
        //     foreach ($data_nilai_quiz as $key => $value) {
        //         $nilai_quiz_tampung += $value->nilai_quiz;
        //     }
        //     $nilai_quiz = ($nilai_quiz_tampung / $total_nilai_quiz) * ($p_nilai->test_quiz / 100); //Nilai All Quiz
        // }

        $post_test = $this->m_siswa->nilai_final($id_mapel)->row();
        $nilai_final = $post_test->nilai_final; // Nilai Post Test

        // $where_absensi = [
        //     'id_user' => $this->session->userdata('id_user'),
        //     'id_mapel' => $id_mapel,
        //     'status_absensi' => 1,
        // ];

        // $total_absensi = $this->db->select('id_user, status_absensi')->where($where_absensi)->get('absensi')->num_rows();

        // if (!empty($total_absensi)) { //absensi
        //     $nilai_absensi = $p_nilai->absensi;
        // } else {
        //     $nilai_absensi = 0;
        // }

        // $total_absensi = $this->db->select('id_user, status_absensi')->where($where_absensi)->get('absensi')->num_rows();

        // $data_nilai_tugas = $this->m_siswa->nilai_tugas($id_mapel)->result();


        // if (!empty($data_nilai_tugas)) {
        //     $total_tugas = count($data_nilai_tugas);
        // } else {
        //     $total_tugas = 0;
        // }

        // $point = 0;
        // foreach ($data_nilai_tugas as $key => $value) {
        //     $ngumpulin = date_create($value->kumpul);
        //     $due_date = date_create($value->due_date);
        //     if (strtotime(date_format($ngumpulin, 'Y-m-d')) == strtotime(date_format($due_date, 'Y-m-d'))) {
        //         $point_tugas = 85;
        //     } elseif (strtotime(date_format($ngumpulin, 'Y-m-d')) <= strtotime(date_format($due_date, 'Y-m-d'))) {
        //         $point_tugas = 100;
        //     } elseif (strtotime(date_format($ngumpulin, 'Y-m-d')) >= strtotime(date_format($due_date, 'Y-m-d'))) {
        //         $point_tugas = 70;
        //     }
        //     $point += $point_tugas;
        // }


        // if (!empty($data_nilai_tugas)) {
        //     $nilai_tugas = ($point / $total_tugas) * ($p_nilai->tugas / 100);
        // } else {
        //     $nilai_tugas = 0;
        // }
        // $total = $nilai_quiz + $nilai_final  + $nilai_absensi + $nilai_tugas;

        $data = [
            'id_user' => $id_user,
            'id_mapel' => $id_mapel,
            'nilai' => $nilai_final,
        ];
        $this->db->insert('transkrip', $data);
    }

    public function penilaian()
    {
        $data['mutu'] = $this->db->select('*')->get('mutu')->result();
        $data['user'] = $this->m_siswa->tampil_data_user($this->session->userdata('id_user'))->row();
        $data['transkrip'] = $this->m_siswa->transkrip()->result();
        $data['ujian'] = $this->m_siswa->ujian()->result();
        $data['tugas'] = $this->m_siswa->tugas()->result();
        $data['absensi'] = $this->m_siswa->get_all_absensi()->result();
        $data['total_absen'] = $this->m_siswa->total_absen_penilaian();
        $data['akurasi'] = $this->m_siswa->get_akurasi_absen()->row();
        // var_dump($data['total_absen']);
        // die;
        $this->load->view('user/transkrip', $data);
    }
    public function detail_transkrip()
    {
        $data['user'] = $this->m_siswa->tampil_data_user($this->session->userdata('id_user'))->row();
        $data['detail'] = $this->m_siswa->detail_transkrip()->result();
        $this->load->view('user/detail_transkrip', $data);
    }

    public function print_transkrip()
    {
        $this->load->library('pdf');
        $data['mutu'] = $this->db->select('*')->get('mutu')->result();
        $data['user'] = $this->m_siswa->tampil_data_user($this->session->userdata('id_user'))->row();
        $data['transkrip'] = $this->m_siswa->transkrip()->result();
        $data['absensi'] = $this->m_siswa->get_all_absensi()->result();
        $data['akurasi'] = $this->m_siswa->get_akurasi_absen()->row();
        $data['total_absen'] = $this->m_siswa->get_total_absen();
        $data['absen'] = $this->m_siswa->get_absen();
        $this->pdf->setFileName('Traskrip_SU_' . $this->session->userdata('nama') . '.pdf');
        $this->pdf->setKertas('portrait');
        $this->pdf->load_view('user/print_transkrip', $data);
    }

    public function pembayaran()
    {
        // $this->load->view('user/template_user/header');
        $data['user'] = $this->db
            ->where('user.id_user', $this->session->userdata('id_user'))
            ->join('enroll', 'user.id_user = enroll.id_user', 'left')
            ->get('user')
            ->row();

        $data['harga_enroll'] = $this->db->get('harga_enroll')->row();
        // header('Content-type: application/json');
        // echo json_encode($data);
        // die;
        $this->load->view('user/payment', $data);
    }

    public function detail_pembayaran()
    {
        if ($this->input->get('type')) {
            $data['is_cicilan'] = true;
            $data['cicilan'] = 3;
        } else {
            $data['is_cicilan'] = false;
        }

        $this->load->view('user/detail_payment', $data);
    }

    public function pay_with_installment()
    {
        header('Content-type: application/json');
        $this->load->library('duitku');
        $price = 3000000 / $this->input->post('loop');

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
                    'nama_transaksi' => $this->input->post('nama_product'),
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



    public function jadwal()
    {
        $data['jadwal'] = $this->m_siswa->jadwal_zoom()->result();

        foreach ($data['jadwal'] as $key => $value) {
            $data['data'][$key]['title'] = $value->nama_mapel;
            $data['data'][$key]['nama_guru'] = $value->nama_guru;
            $data['data'][$key]['start'] = $value->tgl_mulai;
            $data['data'][$key]['end'] = $value->tgl_selesai;
            $data['data'][$key]['link'] = $value->link;
            $data['data'][$key]['textColor'] = "#fff";
        }

        $this->load->view('user/jadwal', $data);
        $this->load->view('template/footer');
    }

    public function print_jadwal()
    {
        $this->load->library('pdf');
        $data['user'] = $this->m_siswa->tampil_data_user($this->session->userdata('id_user'))->row();
        $data['jadwal'] = $this->m_siswa->jadwal_zoom()->result();
        $this->pdf->setFileName('Jadwal_SU_' . $this->session->userdata('nama') . '.pdf');
        $this->pdf->setKertas('portrait');
        $this->pdf->load_view('user/print_jadwal', $data);
    }
    public function print_sertifikat()
    {
        $this->load->library('pdf');
        $data['user'] = $this->m_siswa->tampil_data_user($this->session->userdata('id_user'))->row();
        // $data['jadwal'] = $this->m_siswa->jadwal_zoom()->result();
        $this->pdf->setFileName('Sertifikat_' . $data['user']->nama . '.pdf');
        $this->pdf->setKertas('landscape');
        $this->pdf->load_view('user/print_sertifikat', $data);
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
}
