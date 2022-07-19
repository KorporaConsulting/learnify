<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_materi');
        $this->load->model('m_guru');
        $this->load->model('m_siswa');
        $this->load->model('m_enroll');
        $this->load->helper('url');
        $this->load->library('upload');
        $this->load->helper('download');
        $this->session->set_flashdata('not-login', 'Gagal!');
        // if (!$this->session->userdata('email')) {
        //     redirect('welcome/admin');
        // }
    }

    public function index()
    {
        $data['user'] = $this->m_siswa->tampil_data()->result();
        $this->load->view('admin/index', $data);
    }

    // Management Siswa
    public function add_new_siswa()
    {

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email ini telah digunakan!',
            'required' => 'Harap isi kolom email.',
            'valid_email' => 'Masukan email yang valid.',
        ]);
        $this->form_validation->set_rules('no_telp', 'No Telpon', 'required|min_length[10]', [
            'required' => 'Harap isi kolom Nomer Telepon.',
        ]);

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Harap isi kolom NAMA.',
        ]);

        $this->form_validation->set_rules('jk', 'JK', 'required|trim', [
            'required' => 'Harap isi kolom Jenis Kelamin.',
        ]);

        $this->form_validation->set_rules('ttl', 'TTL', 'required|trim', [
            'required' => 'Harap isi kolom Tanggal lahir.',
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Harap isi kolom Alamat.',
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Harap isi kolom Password.',
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek',
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]', [
            'matches' => 'Password tidak sama!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/siswa/add_siswa');
        } else {
            $jk = htmlspecialchars($this->input->post('jk', true));
            if ($jk == 'Laki-laki') {
                $image = 'null.svg';
            } else {
                $image = 'nill.svg';
            }
            $nis = 'SUS-' . strtotime($this->input->post('ttl', true)) . rand(111, 999);

            $data = [
                'nis' => $nis,
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
                'image_user' => $image,
                'jk' => htmlspecialchars($this->input->post('jk', true)),
                'ttl' => htmlspecialchars($this->input->post('ttl', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'role' => 3,
            ];

            $this->load->library('qrcode');
            $data['qr_code'] = $this->qrcode->generate($this->input->post('email', true));
            $this->db->insert('user', $data);
            // $id_user = $this->db->insert_id();

            // $materi = $this->m_materi->tampil_data_materi()->result();
            // foreach ($materi as $user) {
            //     if ($user->urutan == 1) {
            //         $kunci = 1;
            //     } else {
            //         $kunci = 0;
            //     }
            //     $insert[] = array(
            //         "id_materi" => $user->id_materi,
            //         "id_user" => $id_user,
            //         "status" => 0,
            //         "kunci" => $kunci,
            //         "semester_status_materi" => $user->id_semester
            //     );
            // }
            // $this->db->insert_batch('status_materi', $insert);


            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_siswa'));
        }
    }

    public function data_siswa()
    {
        $this->load->model('m_siswa');

        $data['user'] = $this->m_siswa->tampil_data()->result();
        $this->load->view('admin/siswa/data_siswa', $data);
    }

    public function detail_siswa($id)
    {
        $this->load->model('m_siswa');
        $where = array('id_user' => $id);
        $detail = $this->m_siswa->detail_siswa($id);
        $data['detail'] = $detail;
        $this->load->view('admin/siswa/detail_siswa', $data);
    }

    public function progres_siswa($id, $slug)
    {
        $data['nama_siswa'] = $this->m_siswa->get_profile($id)->row();
        $data['progres'] = $this->m_materi->tampil_data_materi_admin($id, $slug)->result();
        // var_dump($data['progres']);
        // die;
        $this->load->view('admin/progres/progres_materi', $data);
    }

    public function progres_course_siswa($id)
    {
        $data['nama_siswa'] = $this->m_siswa->get_profile($id)->row();
        $data['progres'] = $this->m_materi->tampil_data_course_admin($id)->result();
        // var_dump($data['progres']);
        // die;
        $this->load->view('admin/progres/progres_course', $data);
    }

    public function update_siswa($id)
    {
        $this->load->model('m_siswa');
        $where = array('id_user' => $id);
        $data['user'] = $this->m_siswa->update_siswa($where, 'user')->result();
        $this->load->view('admin/siswa/update_siswa', $data);
    }

    public function add_siswa()
    {
        $this->load->view('admin/siswa/add_siswa');
    }

    public function user_edit()
    {
        $this->form_validation->set_rules('no_telp', 'No Telpon', 'required|min_length[10]', [
            'required' => 'Harap isi kolom Nomer Telepon.',
        ]);

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Harap isi kolom NAMA.',
        ]);

        $this->form_validation->set_rules('jk', 'JK', 'required|trim', [
            'required' => 'Harap isi kolom Jenis Kelamin.',
        ]);

        $this->form_validation->set_rules('ttl', 'TTL', 'required|trim', [
            'required' => 'Harap isi kolom Tanggal lahir.',
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Harap isi kolom Alamat.',
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('admin/siswa/update_siswa');
        } else {
            $id = $this->input->post('id_user');

            $data = array(
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
                'jk' => htmlspecialchars($this->input->post('jk', true)),
                'ttl' => htmlspecialchars($this->input->post('ttl', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            );

            $where = array(
                'id_user' => $id,
            );

            $this->m_siswa->update_data($where, $data, 'user');
            $this->session->set_flashdata('success-edit', 'berhasil');
            redirect('admin/data_siswa');
        }
    }

    public function delete_siswa($id)
    {
        $this->load->model('m_siswa');
        $where = array('id_user' => $id);
        $this->m_siswa->delete_siswa($where, 'user');
        $this->session->set_flashdata('user-delete', 'berhasil');
        redirect('admin/data_siswa');
    }

    // manajemen guru

    public function data_guru()
    {
        $this->load->model('m_guru');

        $data['user'] = $this->m_guru->tampil_data()->result();
        $this->load->view('admin/guru/data_guru', $data);
    }

    public function detail_guru($id)
    {
        $detail = $this->m_guru->detail_guru($id)->row();
        $data['course'] = $this->m_guru->detail_guru($id)->result();
        $data['detail'] = $detail;
        $this->load->view('admin/guru/detail_guru', $data);
    }

    public function update_guru($nip)
    {
        $this->load->model('m_guru');
        $where = array('nip' => $nip);
        $data['user'] = $this->m_guru->update_guru($where, 'guru')->result();
        $this->load->view('admin/guru/update_guru', $data);
    }

    public function guru_edit()
    {
        $this->load->model('m_guru');
        $id_guru = $this->input->post('id_guru');

        $data = array(
            'nip' => htmlspecialchars($this->input->post('nip', true)),
            'nama_guru' => htmlspecialchars($this->input->post('nama', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'jk' => htmlspecialchars($this->input->post('jk', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
        );

        $where = array(
            'id_guru' => $id_guru,
        );

        $this->m_guru->update_data($where, $data, 'guru');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_guru');
    }




    public function delete_guru($nip)
    {
        $this->load->model('m_guru');
        $where = array('nip' => $nip);
        $this->m_guru->delete_guru($where, 'guru');
        $this->session->set_flashdata('user-delete', 'berhasil');
        redirect('admin/data_guru');
    }

    public function add_guru()
    {
        $this->form_validation->set_rules('nip', 'Nip', 'required|trim|min_length[4]', [
            'required' => 'Harap isi kolom NIP.',
            'min_length' => 'NIP terlalu pendek.',
        ]);

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[guru.email]', [
            'is_unique' => 'Email ini telah digunakan!',
            'required' => 'Harap isi kolom email.',
            'valid_email' => 'Masukan email yang valid.',
        ]);

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Harap isi kolom nAMA.',
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Harap isi kolom Password.',
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek',
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]', [
            'matches' => 'Password tidak sama!',
        ]);

        if ($this->form_validation->run() == false) {
            $data['nip'] = $this->input->post('nip', true);
            $data['nama'] = $this->input->post('nama', true);
            $data['email'] = $this->input->post('email', true);
            $data['jk'] = $this->input->post('jk', true);
            $data['alamat'] = $this->input->post('alamat', true);
            $this->load->view('admin/guru/add_guru', $data);
        } else {
            $jk = htmlspecialchars($this->input->post('jk', true));
            if ($jk == 'Laki-laki') {
                $image = 'null.svg';
            } else {
                $image = 'nill.svg';
            }
            $data = [
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'nama_guru' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'image_guru' => $image,
                'jk' => htmlspecialchars($this->input->post('jk', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            ];

            $this->db->insert('guru', $data);

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_guru'));
        }
    }

    // manajemen Semester
    public function add_semester()
    {
        $this->load->view('admin/semester/add_semester');
    }
    public function insert_semester()
    {
        $this->form_validation->set_rules('semester', 'Semester', 'required|is_unique[semester.semester]', [
            'required' => 'Harap isi kolom Nama.',
            'is_unique' => 'Semester telah ada.'
        ]);
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'Image', 'required', [
                'required' => 'Harap upload gambar.'
            ]);
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/semester/add_semester');
        } else {
            $this->load->library('upload');
            $config['upload_path'] = './assets/img'; //path folder
            $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan

            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '50%';
                $config['width'] = 600;
                $config['height'] = 600;
                $config['new_image'] = './assets/img' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $gambar = $gbr['file_name'];
                $data = [
                    'semester' => htmlspecialchars($this->input->post('semester', true)),
                    'image_semester' => $gambar
                ];
                $this->db->insert('semester', $data);
                $this->session->set_flashdata('success-reg', 'Berhasil!');
                redirect(base_url('admin/data_semester'));
            } else {
                $this->session->set_flashdata('gagal-reg', 'gagal!');
                redirect(base_url('admin/data_semester'));
            }
        }
    }
    public function data_semester()
    {
        $this->load->model('m_materi');

        $data['semester'] = $this->m_materi->tampil_data_semester()->result();

        $this->load->view('admin/semester/data_semester', $data);
    }
    public function update_semester($id)
    {
        $this->load->model('m_materi');
        $data['semester'] = $this->m_materi->update_semester($id)->row();
        $this->load->view('admin/semester/update_semester', $data);
    }
    function check_semester($semester)
    {
        if ($this->input->post('id_semester'))
            $id = $this->input->post('id_semester');
        else
            $id = '';
        $result = $this->m_materi->check_unique_semester($id, $semester);
        if ($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('check_semester', 'Semester Telah digunakan');
            $response = false;
        }
        return $response;
    }

    public function semester_edit()
    {
        $id_semester = $this->input->post('id_semester');
        $this->form_validation->set_rules('semester', 'Semester', 'required|callback_check_semester');

        if ($this->form_validation->run() == false) {
            $id = $this->input->post('id_semester');
            $data['semester'] = $this->m_materi->update_semester($id)->row();
            $this->load->view('admin/semester/update_semester', $data);
        } else {
            if (empty($_FILES['image']['name'])) {

                $data = [
                    'semester' => htmlspecialchars($this->input->post('semester', true)),
                    'image_semester' =>
                    htmlspecialchars($this->input->post('image', true)),
                ];
                $where = array(
                    'id_semester' => $id_semester,
                );
                $this->m_materi->update_data($where, $data, 'semester');
                $this->session->set_flashdata('success-edit', 'Berhasil!');
                redirect(base_url('admin/data_semester'));
            } else {
                $config['upload_path'] = './assets/img'; //path folder
                $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan

                $this->upload->initialize($config);
                if ($this->upload->do_upload('image')) {
                    $gbr = $this->upload->data();
                    //Compress Image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/courses' . $gbr['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '50%';
                    $config['width'] = 600;
                    $config['height'] = 600;
                    $config['new_image'] = './assets/img/courses' . $gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $id_mapel = $this->input->post('id_mapel');
                    $gambar = $gbr['file_name'];
                    $data = [
                        'semester' => htmlspecialchars($this->input->post('semester', true)),
                        'image_semester' =>
                        htmlspecialchars($this->input->post('image', true)),
                    ];
                    $where = array(
                        'id_semester' => $id_semester,
                    );
                    $this->m_materi->update_data($where, $data, 'semester');
                    $this->session->set_flashdata('success-edit', 'Berhasil!');
                    redirect(base_url('admin/data_semester'));
                } else {
                    $this->session->set_flashdata('gagal-reg', 'gagal!');
                    redirect(base_url('admin/update_semester/' . $id_semester));
                }
            }
        }
    }

    public function delete_semester($id)
    {
        $where = array('id_semester' => $id);
        $this->m_materi->delete_semester($where, 'semester');
        $this->session->set_flashdata('semester-delete', 'berhasil');
        redirect('admin/data_semester');
    }
    //manajemen mapel
    public function add_mapel()
    {
        $this->load->model('m_guru');
        $data['mentor'] = $this->m_guru->tampil_data()->result();
        $data['semester'] = $this->m_materi->tampil_data_semester()->result();
        $this->load->view('admin/mapel/add_mapel', $data);
    }

    public function insert_mapel()
    {
        $this->form_validation->set_rules('nama_mapel', 'Nama', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom Nama.',
            'min_length' => 'Nama course terlalu pendek.',
        ]);
        $this->form_validation->set_rules('desk', 'Deskripsi', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom deskripsi.',
            'min_length' => 'deskripsi terlalu pendek.',
        ]);
        $this->form_validation->set_rules('guru', 'Guru', 'required', [
            'required' => 'Harap isi kolom mentor.'
        ]);
        $this->form_validation->set_rules('zoom', 'Type', 'required', [
            'required' => 'Harap isi kolom Type.'
        ]);
        $this->form_validation->set_rules('semester', 'Semester', 'required', [
            'required' => 'Harap pilih semester.'
        ]);
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'Image', 'required', [
                'required' => 'Harap upload gambar.'
            ]);
        }

        if ($this->form_validation->run() == false) {
            $data['mentor'] = $this->m_guru->tampil_data()->result();
            $data['semester'] = $this->m_materi->tampil_data_semester()->result();
            $this->load->view('admin/mapel/add_mapel', $data);
        } else {

            $check_urutan = $this->m_materi->check_urutan_mapel($this->input->post('semester', true), $this->input->post('zoom', true))->row();
            $urutan = ($check_urutan->urutan) + 1;
            // var_dump($urutan);
            // die;

            $this->load->library('upload');
            $config['upload_path'] = './assets/img/courses'; //path folder
            $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan

            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/courses' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '50%';
                $config['width'] = 600;
                $config['height'] = 600;
                $config['new_image'] = './assets/img/courses' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $gambar = $gbr['file_name'];
                $title = trim(strtolower($this->input->post('nama_mapel', true)));
                $out = explode(" ", $title);
                $slug = implode("-", $out);

                $get_last_kode = $this->db->select('id_mapel')->get('mapel')->num_rows();

                $kode_mapel =  $get_last_kode + 1;
                $kode_mapel = str_pad($kode_mapel, 4, "0", STR_PAD_LEFT);
                $kode_mapel =  'SU' . $kode_mapel;

                $data = [
                    'kode_mapel' => $kode_mapel,
                    'nama_mapel' => htmlspecialchars($this->input->post('nama_mapel', true)),
                    'slug_mapel' => url_title($this->input->post('nama_mapel'), 'dash', TRUE),
                    'desk' => htmlspecialchars($this->input->post('desk', true)),
                    'tgl_mulai' => htmlspecialchars($this->input->post('tgl_mulai', true)),
                    'tgl_selesai' => htmlspecialchars($this->input->post('tgl_selesai', true)),
                    'link' => htmlspecialchars($this->input->post('link', true)),
                    'image' => $gambar,
                    'id_guru' => htmlspecialchars($this->input->post('guru', true)),
                    'id_semester' => htmlspecialchars($this->input->post('semester', true)),
                    'urutan' =>  $urutan,
                    'is_zoom' =>  htmlspecialchars($this->input->post('zoom', true)),
                ];
                $this->db->insert('mapel', $data);
                $insert_id = $this->db->insert_id();
                $check_enroll = $this->m_materi->check_table_enroll();


                if ($check_enroll == 0) {
                    $this->session->set_flashdata('success-reg', 'Berhasil!');
                    redirect(base_url('admin/data_mapel'));
                } else {
                    $id_user = $this->m_materi->get_status_mapel()->result();
                    $check_materi = $this->m_materi->where_tampil_mapel($insert_id)->row();

                    if ($check_materi->urutan == 1) {
                        $kunci = 1;
                    } else {
                        $kunci = 0;
                    }
                    foreach ($id_user as $user) {
                        $insert[] = array(
                            "id_mapel" => $insert_id,
                            "id_user" => $user->id_user,
                            "status" => 0,
                            "kunci" => $kunci,
                        );
                    }
                    $this->db->insert_batch('status_mapel', $insert);
                }
                $this->session->set_flashdata('success-reg', 'Berhasil!');
                redirect(base_url('admin/data_mapel'));
            } else {
                $this->session->set_flashdata('gagal-reg', 'gagal!');
                redirect(base_url('admin/data_mapel'));
            }
        }
    }


    public function data_mapel()
    {
        $this->load->model('m_materi');
        $data['user'] = $this->m_materi->tampil_data_mapel()->result();
        $data['live'] = $this->m_materi->tampil_data_mapel_live()->result();
        $this->load->view('admin/mapel/data_mapel', $data);
    }

    public function data_sort_semester()
    {
        $this->load->model('m_materi');

        $data['semester'] = $this->m_materi->tampil_data_semester()->result();

        $this->load->view('admin/mapel/data_sort', $data);
    }

    public function sort_mapel()
    {
        $this->load->model('m_materi');

        $data['user'] = $this->m_materi->tampil_sort_mapel($this->input->post('semester'))->result();
        // header('Content-type:application/json');
        // echo json_encode($data);
        // die;

        $data['semester'] = $this->input->post('semester');
        $this->load->view('admin/mapel/sort_mapel', $data);
    }

    public function update_sort_mapel()
    {
        $this->db->where_in('id_mapel', $this->input->post('data'));
        $this->db->delete('mapel');

        $this->db->insert_batch('mapel', $this->input->post('data_key'));
        $this->session->set_flashdata('success', 'Berhasil mengurutkan mapel');

        echo json_encode([
            'success' => true
        ]);
    }

    public function update_sort_mapel_kunci()
    {
        $this->db->where_in('id_mapel', $this->input->post('data'));
        $this->db->update('status_mapel', ['status' => 0, 'kunci' => 0]);

        $this->db->where('id_mapel', $this->input->post('id_mapel_open'));
        $this->db->update('status_mapel', ['kunci' => 1]);

        $this->session->set_flashdata('success', 'Berhasil mengurutkan Materi');

        echo json_encode([
            'success' => true,
            'data' => $this->input->post('id_mapel_open')
        ]);
    }

    public function sort_materi($id)
    {
        $this->load->model('m_materi', 'materi');

        $data['materi'] = $this->materi->where_sort_data_materi($id)->result();
        $data['materi_row'] = $this->materi->where_sort_data_materi($id)->row();

        // var_dump($data['materi_row']->id_materi);
        // die;
        $this->load->view('admin/materi/sort_materi', $data);
    }

    public function update_sort_materi()
    {
        $this->db->where_in('id_mapel', $this->input->post('id_mapel'));
        $this->db->where_in('id_materi', $this->input->post('data'));
        $this->db->delete('materi');

        $this->db->insert_batch('materi', $this->input->post('data_key'));
        $this->session->set_flashdata('success', 'Berhasil mengurutkan Materi');


        echo json_encode([
            'success' => true
        ]);
    }

    public function update_sort_materi_kunci()
    {
        $this->db->where_in('id_materi', $this->input->post('data'));
        $this->db->update('status_materi', ['kunci' => 0]);

        $this->db->where('id_materi', $this->input->post('id_materi_open'));
        $this->db->update('status_materi', ['kunci' => 1]);

        $this->session->set_flashdata('success', 'Berhasil mengurutkan Materi');

        echo json_encode([
            'success' => true,
        ]);
    }

    public function update_mapel($id)
    {
        $this->load->model('m_materi');
        $data['mentor'] = $this->m_guru->tampil_data()->result();
        $data['user'] = $this->m_materi->update_mapel($id)->row();
        $data['semester'] = $this->m_materi->tampil_data_semester()->result();
        $this->load->view('admin/mapel/update_mapel', $data);
    }
    public function mapel_edit()
    {
        $this->form_validation->set_rules('nama_mapel', 'Nama', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom Nama.',
            'min_length' => 'Nama course terlalu pendek.',
        ]);
        $this->form_validation->set_rules('desk', 'Deskripsi', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom deskripsi.',
            'min_length' => 'deskripsi terlalu pendek.',
        ]);
        $this->form_validation->set_rules('guru', 'Guru', 'required', [
            'required' => 'Harap isi kolom mentor.'
        ]);
        $this->form_validation->set_rules('semester', 'Semester', 'required', [
            'required' => 'Harap pilih semester.'
        ]);

        if ($this->form_validation->run() == false) {
            $data['mentor'] = $this->m_guru->tampil_data()->result();
            $id_mapel = $this->input->post('id_mapel');
            $this->session->set_flashdata('gagal-reg', 'gagal!');
            redirect(base_url('admin/update_mapel/' . $id_mapel));
        } else {

            if (empty($_FILES['image']['name'])) {
                $id_mapel = $this->input->post('id_mapel');
                $title = trim(strtolower($this->input->post('nama_mapel', true)));
                $out = explode(" ", $title);
                $slug = implode("-", $out);
                $data = [
                    'nama_mapel' => htmlspecialchars($this->input->post('nama_mapel', true)),
                    'slug_mapel' => uniqid($slug),
                    'desk' => htmlspecialchars($this->input->post('desk', true)),
                    'tgl_mulai' => htmlspecialchars($this->input->post('tgl_mulai', true)),
                    'tgl_selesai' => htmlspecialchars($this->input->post('tgl_selesai', true)),
                    'link' => htmlspecialchars($this->input->post('link', true)),
                    'image' => htmlspecialchars($this->input->post('image', true)),
                    'id_guru' => htmlspecialchars($this->input->post('guru', true)),
                    'id_semester' => htmlspecialchars($this->input->post('semester', true)),
                ];
                $where = array(
                    'id_mapel' => $id_mapel,
                );
                $this->m_guru->update_data($where, $data, 'mapel');
                $this->session->set_flashdata('success-edit', 'Berhasil!');
                redirect(base_url('admin/data_mapel'));
            } else {

                $config['upload_path'] = './assets/img/courses'; //path folder
                $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan

                $this->upload->initialize($config);
                if ($this->upload->do_upload('image')) {
                    $gbr = $this->upload->data();
                    //Compress Image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/img/courses' . $gbr['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '50%';
                    $config['width'] = 600;
                    $config['height'] = 600;
                    $config['new_image'] = './assets/img/courses' . $gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $id_mapel = $this->input->post('id_mapel');
                    $gambar = $gbr['file_name'];
                    $title = trim(strtolower($this->input->post('nama_mapel', true)));
                    $out = explode(" ", $title);
                    $slug = implode("-", $out);
                    $data = [
                        'nama_mapel' => htmlspecialchars($this->input->post('nama_mapel', true)),
                        'slug_mapel' => uniqid($slug),
                        'desk' => htmlspecialchars($this->input->post('desk', true)),
                        'tgl_mulai' => htmlspecialchars($this->input->post('tgl_mulai', true)),
                        'tgl_selesai' => htmlspecialchars($this->input->post('tgl_selesai', true)),
                        'link' => htmlspecialchars($this->input->post('link', true)),
                        'image' => $gambar,
                        'id_guru' => htmlspecialchars($this->input->post('guru', true)),
                        'id_semester' => htmlspecialchars($this->input->post('semester', true)),
                    ];
                    $where = array(
                        'id_mapel' => $id_mapel,
                    );
                    $this->m_guru->update_data($where, $data, 'mapel');
                    $this->session->set_flashdata('success-edit', 'Berhasil!');
                    redirect(base_url('admin/data_mapel'));
                } else {
                    $id_mapel = $this->input->post('id_mapel');
                    $this->session->set_flashdata('gagal-reg', 'gagal!');
                    redirect(base_url('admin/update_mapel/' . $id_mapel));
                }
            }
        }
    }
    public function delete_mapel($id, $id_semester)
    {
        $this->load->model('m_materi');
        $check_urutan = $this->m_materi->check_urutan_mapel_delete($id, $id_semester)->row();
        $get_urutan = $this->m_materi->get_urutan_mapel($check_urutan->urutan, $id_semester)->result();
        // $urutan = ($check_urutan->urutan);
        foreach ($get_urutan as $k => $g) {
            $data = [
                'urutan' => ($g->urutan) - 1,
            ];
            $this->db->where('id_mapel', $g->id_mapel);
            $this->db->update('mapel', $data);
        }

        $where = array('id_mapel' => $id);
        $this->m_materi->delete_mapel($where, 'mapel');
        $this->session->set_flashdata('mapel-delete', 'berhasil');
        redirect('admin/data_mapel');
    }
    public function data_materi_course($id)
    {
        $this->load->model('m_materi');
        $data['user'] = $this->m_materi->tampil_data_materi_course($id)->result();
        $data['course'] = $this->m_materi->get_mapel($id)->row();
        $data['materi'] = $id;
        $this->load->view('admin/materi/data_materi', $data);
    }

    // Manajement Materi

    public function data_materi()
    {
        $this->load->model('m_materi');
        $data['user'] = $this->m_materi->tampil_data_materi()->result();
        $this->load->view('admin/materi/data_materi', $data);
    }


    public function add_materi()
    {
        $data['mapel'] = $this->m_materi->tampil_data_mapel()->result();
        $this->load->view('admin/materi/add_materi', $data);
    }
    public function add_materi_course($id)
    {
        $data['mapel'] = $this->m_materi->tampil_data_mapel_where($id)->result();
        $this->load->view('admin/materi/add_materi', $data);
    }
    public function insert_materi()
    {
        $this->load->model('m_materi');
        $this->form_validation->set_rules('nama_materi', 'Nama', 'required', [
            'required' => 'Harap isi kolom Materi.',
        ]);
        $this->form_validation->set_rules('desk', 'Desk', 'required|trim', [
            'required' => 'Harap isi kolom Deskripsi.',
        ]);
        $this->form_validation->set_rules('mapel', 'Mapel', 'required|trim', [
            'required' => 'Harap Pilih Mapel.',
        ]);


        if ($this->form_validation->run() == false) {
            $data['mapel'] = $this->m_materi->tampil_data_mapel()->result();
            $this->load->view('admin/materi/add_materi', $data);
        } else {
            $user = $this->m_materi->get_id_user()->result();
            $check_urutan = $this->m_materi->check_urutan($this->input->post('mapel', true))->row();
            $urutan = ($check_urutan->urutan) + 1;

            $data = [
                'nama_materi' => htmlspecialchars($this->input->post('nama_materi', true)),
                'slug_materi' => url_title($this->input->post('nama_materi'), 'dash', TRUE),
                'desk_materi' => htmlspecialchars($this->input->post('desk', true)),
                'id_mapel' => htmlspecialchars($this->input->post('mapel', true)),
                'urutan' => $urutan,
            ];
            $this->db->insert('materi', $data);
            $insert_id = $this->db->insert_id();
            $check_enroll = $this->m_materi->check_table_enroll();


            if ($check_enroll == 0) {
                $this->session->set_flashdata('success-reg', 'Berhasil!');
                redirect(base_url('admin/data_materi'));
            } else {
                $id_user = $this->m_materi->get_status_materi()->result();
                $semester = $this->m_materi->where_sort_data_materi($this->input->post('mapel', true))->row();
                $check_materi = $this->m_materi->where_tampil_materi($insert_id)->row();

                if ($check_materi->urutan == 1) {
                    $kunci = 1;
                } else {
                    $kunci = 0;
                }
                foreach ($id_user as $user) {
                    $insert[] = array(
                        "id_materi" => $insert_id,
                        "id_user" => $user->id_user,
                        "status" => 0,
                        "kunci" => $kunci,
                        "semester_status_materi" => $semester->id_semester
                    );
                }
                $this->db->insert_batch('status_materi', $insert);
                $this->session->set_flashdata('success-reg', 'Berhasil!');
                redirect(base_url('admin/data_materi'));
            }
        }
    }
    public function insert_materi_course()
    {
        $id = $this->input->post('id_mapel');
        $this->load->model('m_materi');
        $this->form_validation->set_rules('nama_materi', 'Nama', 'required', [
            'required' => 'Harap isi kolom Materi.',
        ]);
        $this->form_validation->set_rules('desk', 'Desk', 'required|trim', [
            'required' => 'Harap isi kolom Deskripsi.',
        ]);
        $this->form_validation->set_rules('mapel', 'Mapel', 'required|trim', [
            'required' => 'Harap Pilih Mapel.',
        ]);


        if ($this->form_validation->run() == false) {
            // $data['mapel'] = $this->m_materi->tampil_data_mapel()->result();
            // $this->load->view('admin/materi/add_materi', $data);
            $this->session->set_flashdata('gagal-reg', 'Gagal!');
            redirect_back();
        } else {
            $check_urutan = $this->m_materi->check_urutan($this->input->post('mapel', true))->row();
            $urutan = ($check_urutan->urutan) + 1;

            $data = [
                'nama_materi' => htmlspecialchars($this->input->post('nama_materi', true)),
                'slug_materi' => url_title($this->input->post('nama_materi'), 'dash', TRUE),
                'desk_materi' => htmlspecialchars($this->input->post('desk', true)),
                'id_mapel' => htmlspecialchars($this->input->post('mapel', true)),
                'urutan' => $urutan,
            ];
            $this->db->insert('materi', $data);
            $insert_id = $this->db->insert_id();
            $check_enroll = $this->m_materi->check_table_enroll();

            if ($check_enroll == 0) {
                $this->session->set_flashdata('success-reg', 'Berhasil!');
            } else {
                // $user = $this->m_materi->get_id_user()->result();
                $id_user = $this->m_materi->get_status_materi()->result();
                $semester = $this->m_materi->where_sort_data_materi($this->input->post('mapel', true))->row();
                $check_materi = $this->m_materi->where_tampil_materi($insert_id)->row();


                if ($check_materi->urutan == 1) {
                    $kunci = 1;
                } else {
                    $kunci = 0;
                }

                foreach ($id_user as $user) {
                    $insert[] = array(
                        "id_materi" => $insert_id,
                        "id_user" => $user->id_user,
                        "status" => 0,
                        "kunci" => $kunci,
                        "semester_status_materi" => $semester->id_semester
                    );
                }
                $this->db->insert_batch('status_materi', $insert);
            }
            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_materi_course/' . $id));
        }
    }
    public function update_materi($id)
    {
        $where = array('id_materi' => $id);
        $data['user'] = $this->m_materi->update_materi($where, 'materi')->row();
        $this->load->view('admin/materi/update_materi', $data);
    }

    public function edit_materi()
    {

        $this->form_validation->set_rules('nama_materi', 'Nama', 'required', [
            'required' => 'Harap isi kolom Materi.',
        ]);

        if ($this->form_validation->run() == false) {
            // $data['mapel'] = $this->m_materi->tampil_data_mapel()->result();
            // $this->load->view('admin/materi/add_materi', $data);
            $this->session->set_flashdata('gagal-reg', 'Gagal!');
            redirect_back();
        } else {
            $title = trim(strtolower($this->input->post('nama_materi', true)));
            $out = explode(" ", $title);
            $slug = implode("-", $out);
            $data = [
                'nama_materi' => htmlspecialchars($this->input->post('nama_materi', true)),
                'slug_materi' => uniqid($slug),
                'desk_materi' => htmlspecialchars($this->input->post('desk_materi', true)),
                // 'id_mapel' => htmlspecialchars($this->input->post('mapel', true)),
            ];
            $where = array(
                'id_materi' => $this->input->post('id_materi'),
            );

            $this->m_materi->update_data_materi($where, $data, 'materi');
            $this->session->set_flashdata('success-edit', 'berhasil');
            redirect('admin/data_materi_course/' . $this->input->post('id_mapel', true));
        }
    }
    public function delete_materi($id, $id_mapel)
    {

        $check_urutan = $this->m_materi->check_urutan_materi($id, $id_mapel)->row();
        $get_urutan = $this->m_materi->get_urutan_materi($check_urutan->urutan, $id_mapel)->result();
        // $urutan = ($check_urutan->urutan);
        foreach ($get_urutan as $k => $g) {
            $data = [
                'urutan' => ($g->urutan) - 1,
            ];
            $this->db->where('id_materi', $g->id_materi);
            $this->db->update('materi', $data);
        }
        // var_dump($data);
        // die;

        $where = array('id_materi' => $id);
        $this->m_materi->delete_materi($where, 'materi');

        $where = array('id_materi' => $id);
        $this->m_materi->delete_materi($where, 'status_materi');


        $this->session->set_flashdata('materi-delete', 'berhasil');
        redirect('admin/data_materi_course/' . $id_mapel);
    }

    public function isi_materi($id)
    {
        $data['materi'] = $this->m_materi->where_tampil_materi($id)->row();
        $data['video'] = $this->m_materi->where_tampil_video($id)->result();
        $data['video_row'] = $this->m_materi->where_tampil_video($id)->row();
        $data['file'] = $this->m_materi->where_tampil_file($id)->result();
        $data['file_row'] = $this->m_materi->where_tampil_file($id)->row();
        $data['quiz'] = $this->m_materi->where_tampil_quiz($id)->result();
        $data['quiz_row'] = $this->m_materi->where_tampil_quiz($id)->row();
        $data['tugas'] = $this->m_materi->where_tampil_tugas($id)->result();
        $data['tugas_row'] = $this->m_materi->where_tampil_tugas($id)->row();
        $data['zoom'] = $this->m_materi->where_tampil_zoom($id)->result();
        $data['zoom_row'] = $this->m_materi->where_tampil_zoom($id)->row();
        // var_dump($data['quiz_row']);
        // var_dump($data['file_row']);
        // var_dump($data['video_row']);
        // var_dump($data['materi']);
        // die;
        $this->load->view('admin/materi/isi_materi', $data);
    }

    public function upload_video()
    {
        $id_materi = $this->input->post('id_materi', true);
        if (empty($_FILES['video']['name'])) {
            $link = $this->input->post('link', true);
            $data = [
                'nama_video' => htmlspecialchars($this->input->post('nama_video', true)),
                'desk_video' => htmlspecialchars($this->input->post('desk_video', true)),
                'link' => $link,
                'id_materi' => htmlspecialchars($this->input->post('id_materi', true)),
            ];

            $this->db->insert('video', $data);
            $this->session->set_flashdata('success-reg', 'Berhasil!');
            $this->session->set_flashdata('tab', 'home3');
            $this->session->set_flashdata('nav-link', 'home-tab3');

            redirect(base_url('admin/isi_materi/' . $id_materi));
        } else {
            $upload_video = $_FILES['video'];
            if ($upload_video) {
                $config['allowed_types'] = 'mp4|mkv|mov';
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
                'nama_video' => htmlspecialchars($this->input->post('nama_video', true)),
                'desk_video' => htmlspecialchars($this->input->post('desk_video', true)),
                'video' => $video,
                'id_materi' => htmlspecialchars($this->input->post('id_materi', true)),
            ];

            $this->db->insert('video', $data);
            $this->session->set_flashdata('success-video', 'Berhasil!');
            redirect(base_url('admin/isi_materi/' . $id_materi));
        }
    }

    public function update_video($id)
    {
        $where = array('id_video' => $id);
        $data['video'] = $this->m_materi->update_materi($where, 'video')->row();
        $this->load->view('admin/materi/update_video', $data);
    }

    public function video_edit()
    {
        $id_materi = $this->input->post('id_materi', true);
        $link = $this->input->post('link', true);
        if (empty($_FILES['video']['name'])) {
            $data = [
                'nama_video' => htmlspecialchars($this->input->post('nama_video', true)),
                'desk_video' => htmlspecialchars($this->input->post('desk_video', true)),
                'link' => $link,
                'id_materi' => htmlspecialchars($this->input->post('id_materi', true)),
            ];
            $where = array(
                'id_video' => $this->input->post('id_video'),
            );

            $this->m_materi->update_data_video($where, $data, 'video');
            $this->session->set_flashdata('success-video-edit', 'Berhasil!');
            $this->session->set_flashdata('tab', 'home3');
            $this->session->set_flashdata('nav-link', 'home-tab3');
            redirect(base_url('admin/isi_materi/' . $id_materi));
        } else {
            $upload_video = $_FILES['video'];
            if ($upload_video) {
                $config['allowed_types'] = 'mp4|mkv|mov';
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
                'nama_video' => htmlspecialchars($this->input->post('nama_video', true)),
                'desk_video' => htmlspecialchars($this->input->post('desk_video', true)),
                'video' => $video,
                'id_materi' => htmlspecialchars($this->input->post('id_materi', true)),
            ];

            $where = array(
                'id_video' => $this->input->post('id_video'),
            );

            $this->m_materi->update_data_video($where, $data, 'video');
            $this->session->set_flashdata('success-video-edit', 'Berhasil!');
            $this->session->set_flashdata('success-reg', 'Berhasil!');
            $this->session->set_flashdata('tab', 'home3');
            redirect(base_url('admin/isi_materi/' . $id_materi));
        }
    }
    public function delete_video($id, $id_materi)
    {
        $where = array('id_video' => $id);
        $this->m_materi->delete_video($where, 'video');
        $this->session->set_flashdata('video-delete', 'berhasil');
        $this->session->set_flashdata('tab', 'home3');
        $this->session->set_flashdata('nav-link', 'home-tab3');
        redirect(base_url('admin/isi_materi/' . $id_materi));
    }
    public function insert_file()
    {
        $id_materi = $this->input->post('id_materi', true);
        $data = [
            'nama_file' => htmlspecialchars($this->input->post('nama_file', true)),
            'desk_file' => htmlspecialchars($this->input->post('desk_file', true)),
            'link' => htmlspecialchars($this->input->post('link', true)),
            'id_materi' => htmlspecialchars($this->input->post('id_materi', true)),
            'is_tugas' => 0,
        ];
        $this->db->insert('file', $data);
        $this->session->set_flashdata('tab', 'profile3');
        $this->session->set_flashdata('nav-link', 'profile-tab3');
        $this->session->set_flashdata('success-file', 'Berhasil!');
        redirect(base_url('admin/isi_materi/' . $id_materi));
    }
    public function update_file($id)
    {
        $where = array('id_file' => $id);
        $data['file'] = $this->m_materi->update_materi($where, 'file')->row();
        $this->load->view('admin/materi/update_file', $data);
    }
    public function file_edit()
    {
        $id_materi = $this->input->post('id_materi', true);
        $data = [
            'nama_file' => htmlspecialchars($this->input->post('nama_file', true)),
            'desk_file' => htmlspecialchars($this->input->post('desk_file', true)),
            'link' => htmlspecialchars($this->input->post('link', true)),
            'id_materi' => htmlspecialchars($this->input->post('id_materi', true)),
            'is_tugas' => 0,
        ];
        $where = array(
            'id_file' => $this->input->post('id_file'),
        );

        $this->m_materi->update_data_file($where, $data, 'file');
        $this->session->set_flashdata('tab', 'profile3');
        $this->session->set_flashdata('nav-link', 'profile-tab3');
        $this->session->set_flashdata('success-file-edit', 'Berhasil!');
        redirect(base_url('admin/isi_materi/' . $id_materi));
    }

    public function delete_file($id, $id_materi)
    {
        $where = array('id_file' => $id);
        $this->m_materi->delete_file($where, 'file');
        $this->session->set_flashdata('file-delete', 'berhasil');
        $this->session->set_flashdata('tab', 'profile3');
        $this->session->set_flashdata('nav-link', 'profile-tab3');
        redirect(base_url('admin/isi_materi/' . $id_materi));
    }



    // public function insert_quiz()
    // {
    //     $id_materi = $this->input->post('id_materi', true);
    //     $data = [
    //         'nama_file' => htmlspecialchars($this->input->post('nama_file', true)),
    //         'desk_file' => htmlspecialchars($this->input->post('desk_file', true)),
    //         'link' => htmlspecialchars($this->input->post('link', true)),
    //         'id_materi' => htmlspecialchars($this->input->post('id_materi', true)),
    //     ];
    //     $this->db->insert('file', $data);
    //     $this->session->set_flashdata('success-file', 'Berhasil!');
    //     redirect(base_url('admin/isi_materi/' . $id_materi));
    // }

    public function data_enroll()
    {
        $data['user'] = $this->m_enroll->tampil_data_enroll()->result();
        // var_dump($data['user']);
        // die;
        $this->load->view('admin/enroll/data_enroll', $data);
    }
    public function add_enroll()
    {
        $data['semester'] = $this->m_materi->tampil_data_semester()->result();
        $data['user'] = $this->m_siswa->tampil_data()->result();
        $this->load->view('admin/enroll/add_enroll', $data);
    }

    public function enroll_check()
    {
        $check_enroll = $this->m_materi->check_enroll($this->input->post('semester', true), $this->input->post('user', true));

        if ($check_enroll > 0) {
            $this->form_validation->set_message('enroll_check', 'User telah memiliki Course');
            $this->session->set_flashdata('valid_enroll', 'Gagal!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function insert_enroll()
    {
        $this->form_validation->set_rules('semester', 'Semester', 'required|callback_enroll_check', [
            'required' => 'Harap isi kolom Semester.'
        ]);
        $this->form_validation->set_rules('user', 'User', 'required|trim', [
            'required' => 'Harap isi kolom User.',
        ]);

        if ($this->form_validation->run() == false) {
            $data['semester'] = $this->m_materi->tampil_data_semester()->result();
            $data['user'] = $this->m_siswa->tampil_data()->result();
            $this->load->view('admin/enroll/add_enroll', $data);
        } else {
            $data = [
                'id_semester' => htmlspecialchars($this->input->post('semester', true)),
                'id_user' => htmlspecialchars($this->input->post('user', true)),
            ];

            $this->db->insert('enroll', $data);
            $get_enroll = $this->m_materi->get_list_materi($this->input->post('semester', true))->result();
            $get_enroll_mapel = $this->m_materi->get_kunci_mapel($this->input->post('semester', true))->result();

            $check_user = $this->m_materi->check_user($this->input->post('user'), $this->input->post('semester'));

            if ($check_user == 0) {
                foreach ($get_enroll_mapel as $mapel) {
                    if ($mapel->urutan == 1) {
                        $kunci_mapel = 1;
                    } else {
                        $kunci_mapel = 0;
                    }
                    $insert_status_mapel[] = array(
                        "id_mapel" => $mapel->id_mapel,
                        "id_user" => $this->input->post('user', true),
                        "status" => 0,
                        "kunci" => $kunci_mapel,
                    );
                }
                $this->db->insert_batch('status_mapel', $insert_status_mapel);

                if ($get_enroll != "") {
                    foreach ($get_enroll as $id_materi) {
                        if ($id_materi->urutan == 1) {
                            $kunci = 1;
                        } else {
                            $kunci = 0;
                        }
                        $insert[] = array(
                            "id_materi" => $id_materi->id_materi,
                            "id_user" => $this->input->post('user', true),
                            "status" => 0,
                            "kunci" => $kunci,
                            "semester_status_materi" => $this->input->post('semester', true),
                        );
                    }

                    $this->db->insert_batch('status_materi', $insert);
                } else {
                    $data['semester'] = $this->m_materi->tampil_data_semester()->result();
                    $data['user'] = $this->m_siswa->tampil_data()->result();
                    $this->load->view('admin/enroll/add_enroll', $data);
                    $this->session->set_flashdata('error-enroll', 'Gagal!');
                    redirect(base_url('admin/add_enroll', $data));
                }
            }
            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_enroll'));
        }
    }
    public function delete_enroll($id)
    {
        $where = array('id_enroll' => $id);
        $this->m_enroll->delete_enroll($where, 'enroll');
        $this->session->set_flashdata('enroll-delete', 'berhasil');
        redirect(base_url('admin/data_enroll/'));
    }

    public function detail_soal($id_soal)
    {
        $data['soal'] = $this->db->where('id_soal', $id_soal)->get('tb_soal')->row();
        $this->load->view('admin/soal/detail_soal', $data);
    }

    public function tambah_quiz()
    {
        $id_materi = $this->input->post('id_materi', true);
        $data = [
            'id_materi' => htmlspecialchars($this->input->post('id_materi', true)),
            'judul' => htmlspecialchars($this->input->post('judul', true)),
            'type' => htmlspecialchars($this->input->post('type', true)),
            'min_nilai' => htmlspecialchars($this->input->post('min_nilai', true)),
        ];
        $this->db->insert('quiz', $data);
        $this->session->set_flashdata('success-quiz', 'Berhasil!');
        $this->session->set_flashdata('tab', $this->input->post('tab'));
        $this->session->set_flashdata('nav-link', $this->input->post('nav-link'));
        redirect(base_url('admin/isi_materi/' . $id_materi));
    }
    public function edit_quiz($id_quiz)
    {
        $data['quiz'] = $this->db->where('id_quiz', $id_quiz)->get('quiz')->row();
        $this->load->view('admin/quiz/edit_quiz', $data);
    }

    public function update_quiz($id_quiz)
    {
        $data = [
            'judul' => $this->input->post('judul'),
            'type' => $this->input->post('type'),
            'min_nilai' => htmlspecialchars($this->input->post('min_nilai', true)),
        ];
        $this->db->where('id_quiz', $id_quiz)->update('quiz', $data);
        $update_type_nilai = [
            'type' => $this->input->post('type')
        ];
        $this->db->where('id_materi', $this->input->post('id_materi'))->update('nilai', $update_type_nilai);

        $this->session->set_flashdata('tab', 'contact3');
        $this->session->set_flashdata('nav-link', 'contact-tab3');

        $this->session->set_flashdata('success-edit-quiz', 'Berhasil mengupdate Quiz');

        redirect('admin/isi_materi/' . $this->input->post('id_materi'));
    }
    public function delete_quiz($id_quiz, $id_materi)
    {
        $this->db->where('id_quiz', $id_quiz)->delete('quiz');
        $this->session->set_flashdata('success-delete', 'Berhasil menghapus Quiz');
        $this->session->set_flashdata('tab', 'contact3');
        $this->session->set_flashdata('nav-link', 'contact-tab3');
        redirect('admin/isi_materi/' . $id_materi);
    }


    public function view_soal($id)
    {
        $data['quiz'] = $this->m_materi->where_tampil_soal($id)->result();
        $data['materi'] = $this->db->select('id_materi')->where('id_quiz', $id)->get('quiz')->row();
        $this->load->view('admin/soal/tambah_soal', $data);
    }

    public function tambah_soal()
    {
        $this->session->set_flashdata('tab', $this->input->post('tab'));
        $this->session->set_flashdata('nav-link', $this->input->post('nav-link'));

        $data = array('upload_data' => $this->upload->data());
        $this->db->insert('tb_soal', [
            'id_quiz' => $this->input->post('id_quiz'),
            'soal' => $this->input->post('soal'),
            'opsi_a' => $this->input->post('opsi_a'),
            'opsi_b' => $this->input->post('opsi_b'),
            'opsi_c' => $this->input->post('opsi_c'),
            'opsi_d' => $this->input->post('opsi_d'),
            'jawaban' => $this->input->post('jawaban')
        ]);
        $this->session->set_flashdata('success', 'Berhasil menambah soal');
        redirect('admin/view_soal/' . $this->input->post('id_quiz'));
    }

    public function delete_soal($id_soal, $id_quiz)
    {
        $this->db->where('id_soal', $id_soal)->delete('tb_soal');

        $this->session->set_flashdata('success-delete', 'Berhasil menghapus soal');

        redirect('admin/view_soal/' . $id_quiz);
    }

    public function edit_soal($id_soal)
    {
        $data['soal'] = $this->db->where('id_soal', $id_soal)->get('tb_soal')->row();

        $this->load->view('admin/soal/edit_soal', $data);
    }

    public function update_soal($id_soal)
    {

        $data = [
            'soal' => $this->input->post('soal'),
            'jawaban' => $this->input->post('jawaban'),
            'opsi_a' => $this->input->post('opsi_a'),
            'opsi_b' => $this->input->post('opsi_b'),
            'opsi_c' => $this->input->post('opsi_c'),
            'opsi_d' => $this->input->post('opsi_d')
        ];

        $this->db->where('id_soal', $id_soal)->update('tb_soal', $data);

        $this->session->set_flashdata('tab', 'contact3');
        $this->session->set_flashdata('nav-link', 'contact-tab3');

        $this->session->set_flashdata('success-edit', 'Berhasil mengupdate soal');

        redirect('admin/view_soal/' . $this->input->post('id_quiz'));
    }


    public function data_quiz()
    {
        $data['quiz'] = $this->m_materi->tampil_data_quiz()->result();
        $this->load->view('admin/quiz/data_quiz', $data);
    }

    public function histori_quiz($id_materi, $id_user, $id_mapel)
    {

        $data['quiz'] = $this->m_materi->histori_nilai($id_materi, $id_user)->result();
        $data['nama_user'] = $this->m_materi->get_user($id_user)->row();
        $data['mapel'] = $this->m_materi->get_mapel($id_mapel)->row();
        // var_dump($data['quiz']);
        // die;

        $this->load->view('admin/quiz/detail_quiz', $data);
    }
    public function insert_tugas()
    {
        $id_materi = $this->input->post('id_materi', true);
        $data = [
            'link_template' => htmlspecialchars($this->input->post('link_template', true)),
            'nama_tugas' => htmlspecialchars($this->input->post('nama_tugas', true)),
            'desk_tugas' => htmlspecialchars($this->input->post('desk_tugas', true)),
            'due_date' => htmlspecialchars($this->input->post('due_date', true)),
            'id_materi' => htmlspecialchars($this->input->post('id_materi', true)),
            // 'approve' => 0,
        ];
        $this->db->insert('tugas', $data);
        $this->session->set_flashdata('tab', 'contact4');
        $this->session->set_flashdata('nav-link', 'contact-tab4');
        $this->session->set_flashdata('success-file', 'Berhasil!');
        redirect(base_url('admin/isi_materi/' . $id_materi));
    }

    public function edit_tugas($id)
    {
        $where = array('id_tugas' => $id);
        $data['tugas'] = $this->m_materi->update_materi($where, 'tugas')->row();
        $this->load->view('admin/tugas/edit_tugas', $data);
    }

    public function update_tugas()
    {
        $id_materi = $this->input->post('id_materi', true);
        $data = [
            'nama_tugas' => htmlspecialchars($this->input->post('nama_tugas', true)),
            'desk_tugas' => htmlspecialchars($this->input->post('desk_tugas', true)),
            'due_date' => htmlspecialchars($this->input->post('due_date', true)),
            'id_materi' => htmlspecialchars($this->input->post('id_materi', true))
        ];
        $where = array(
            'id_tugas' => $this->input->post('id_tugas'),
        );

        $this->m_materi->update_data_tugas($where, $data, 'tugas');
        $this->session->set_flashdata('tab', 'contact4');
        $this->session->set_flashdata('nav-link', 'contact-tab4');
        $this->session->set_flashdata('success-tugas-edit', 'Berhasil!');
        redirect(base_url('admin/isi_materi/' . $id_materi));
    }
    public function delete_tugas($id, $id_materi)
    {
        $where = array('id_tugas' => $id);
        $this->m_materi->delete_tugas($where, 'tugas');
        $this->session->set_flashdata('tugas-delete', 'berhasil');
        $this->session->set_flashdata('tab', 'contact4');
        $this->session->set_flashdata('nav-link', 'contact-tab4');
        $this->session->set_flashdata('success-tugas-edit', 'Berhasil!');
        redirect(base_url('admin/isi_materi/' . $id_materi));
    }

    public function list_tugas_user()
    {
        $data['tugas_list'] = $this->m_materi->where_tampil_tugas_user()->result();
        $this->load->view('admin/tugas/list_tugas_user', $data);
    }

    public function approve_tugas($id_file, $id_materi, $id_user)
    {
        $check_slug = $this->m_materi->where_tampil_materi($id_materi)->row();
        $id_mapel = $check_slug->id_mapel;
        $urutan = $check_slug->urutan + 1;

        $data = [
            'approve' => 1
        ];
        $where = array(
            'id_file' => $id_file,
            'id_materi' => $id_materi,
            'id_user' => $id_user,
        );
        $this->m_materi->approve_tugas($where, $data, 'file');

        $check_file = $this->m_materi->check_file_user($id_materi, $id_user);
        $check_file_done = $this->m_materi->check_file_user_done($id_materi, $id_user);

        // var_dump($check_file_done);
        // die;

        if ($check_file == $check_file_done) {
            $data_status = [
                'status' => 1
            ];
            $where_status = [
                'id_materi' => $id_materi,
                'id_user' => $id_user,
            ];
            $this->m_materi->approve_tugas($where_status, $data_status, 'status_materi');

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
        }

        $total_materi = $this->m_siswa->total_status($id_user, $id_mapel);
        $done_materi = $this->m_siswa->done_status($id_user, $id_mapel);

        if ($total_materi == $done_materi) {
            $this->mark_mapel($id_mapel, $id_user);
        }

        $this->session->set_flashdata('success-approve', 'Tugas telah disetujui');
        redirect('admin/list_tugas_user');
    }
    public function delete_approve_tugas($id_file, $id_materi, $id_user)
    {
        $data = [
            'approve' => 0
        ];
        $where = array(
            'id_file' => $id_file,
            'id_materi' => $id_materi,
            'id_user' => $id_user,
        );
        $this->m_materi->approve_tugas($where, $data, 'file');

        $check_file = $this->m_materi->check_file_user($id_materi, $id_user);
        $check_file_done = $this->m_materi->check_file_user_done($id_materi, $id_user);

        if ($check_file != $check_file_done) {
            $data_status = [
                'status' => 0
            ];
            $where_status = [
                'id_materi' => $id_materi,
                'id_user' => $id_user,
            ];
            $this->m_materi->approve_tugas($where_status, $data_status, 'status_materi');
        }

        $this->session->set_flashdata('success-approve', 'Approve telah dihapus');
        redirect('admin/list_tugas_user');
    }


    public function insert_zoom()
    {
        $id_materi = $this->input->post('id_materi', true);
        $data = [
            'nama_file' => htmlspecialchars($this->input->post('nama_zoom', true)),
            'desk_file' => htmlspecialchars($this->input->post('desk_zoom', true)),
            'link' => htmlspecialchars($this->input->post('link', true)),
            'id_materi' => htmlspecialchars($this->input->post('id_materi', true)),
            'is_tugas' => 2,
        ];
        $this->db->insert('file', $data);
        $this->session->set_flashdata('tab', 'home2');
        $this->session->set_flashdata('nav-link', 'home-tab2');
        $this->session->set_flashdata('success-zoom', 'Berhasil!');
        redirect(base_url('admin/isi_materi/' . $id_materi));
    }

    public function update_zoom($id)
    {
        $where = array('id_file' => $id);
        $data['file'] = $this->m_materi->update_materi($where, 'file')->row();
        $this->load->view('admin/materi/update_zoom', $data);
    }

    public function edit_zoom()
    {
        $id_materi = $this->input->post('id_materi', true);
        $data = [
            'nama_file' => htmlspecialchars($this->input->post('nama_zoom', true)),
            'desk_file' => htmlspecialchars($this->input->post('desk_zoom', true)),
            'link' => htmlspecialchars($this->input->post('link', true)),
            // 'id_materi' => htmlspecialchars($this->input->post('id_materi', true)),
            // 'is_tugas' => 2,
        ];

        $where = array(
            'id_file' => $this->input->post('id_file'),
        );

        $this->m_materi->update_data_file($where, $data, 'file');
        $this->session->set_flashdata('tab', 'home2');
        $this->session->set_flashdata('nav-link', 'home-tab2');
        $this->session->set_flashdata('success-zoom', 'Berhasil!');
        redirect(base_url('admin/isi_materi/' . $id_materi));
    }

    public function delete_zoom($id, $id_materi)
    {
        $where = array('id_file' => $id);
        $this->m_materi->delete_file($where, 'file');
        $this->session->set_flashdata('tab', 'home2');
        $this->session->set_flashdata('nav-link', 'home-tab2');
        $this->session->set_flashdata('success-zoom', 'Berhasil!');
        redirect(base_url('admin/isi_materi/' . $id_materi));
    }

    public function opt_quiz()
    {
        $data['opt_quiz'] = $this->db->select('*')->get('opt_quiz')->row();
        $this->load->view('admin/setting/opt_quiz', $data);
    }

    public function update_opt_quiz()
    {
        $data = [
            'max_post_test' => htmlspecialchars($this->input->post('max_post_test', true)),
        ];

        $where = array(
            'id_opt_quiz' => 1,
        );

        $this->m_materi->update_data_file($where, $data, 'opt_quiz');
        $this->session->set_flashdata('success-opt-quiz', 'Berhasil!');
        redirect(base_url('admin/opt_quiz'));
    }

    public function opt_course()
    {
        $data['opt_course'] = $this->db->select('*')->where('id_persentase_nilai', 1)->get('persentase_nilai')->row();
        $data['opt_course_tugas'] = $this->db->select('*')->where('id_persentase_nilai', 2)->get('persentase_nilai')->row();
        $this->load->view('admin/setting/opt_course', $data);
    }

    public function update_opt_course()
    {
        $total = $this->input->post('post_test', true) + $this->input->post('test_quiz', true) + $this->input->post('tugas', true) + $this->input->post('absensi', true);

        if ($total != 100) {
            $this->session->set_flashdata('error-opt-course', 'Gagal!');
            redirect(base_url('admin/opt_course'));
        }

        if ($this->input->post('tugas', true) == 0) {
            $id = 2;
        } else {
            $id = 1;
        }

        $data = [
            'post_test' => htmlspecialchars($this->input->post('post_test', true)),
            'test_quiz' => htmlspecialchars($this->input->post('test_quiz', true)),
            'tugas' => htmlspecialchars($this->input->post('tugas', true)),
            'absensi' => htmlspecialchars($this->input->post('absensi', true)),
        ];

        $where = array(
            'id_persentase_nilai' => $id,
        );

        $this->m_materi->update_data_file($where, $data, 'persentase_nilai');
        $this->session->set_flashdata('success-opt-course', 'Berhasil!');
        redirect(base_url('admin/opt_course'));
    }

    public function opt_transkrip()
    {
        $data['opt_transkrip'] = $this->db->select('*')->get('mutu')->result();
        $this->load->view('admin/setting/opt_transkrip', $data);
    }

    public function edit_transkrip($id)
    {
        $data['opt_edit_transkrip'] = $this->db->select('*')->where('id_mutu', $id)->get('mutu')->row();
        $this->load->view('admin/setting/opt_edit_transkrip', $data);
    }

    public function update_opt_transkrip()
    {
        $min = $this->input->post('min', true);
        $max = $this->input->post('max', true);

        $data = [
            'nilai' => $min . '-' . $max
        ];

        $where = array(
            'id_mutu' => $this->input->post('id_mutu'),
        );

        $this->m_materi->update_data_file($where, $data, 'mutu');
        $this->session->set_flashdata('success-opt-transkrip', 'Berhasil!');
        redirect(base_url('admin/opt_transkrip'));
    }

    public function opt_tugas()
    {
        $data['opt_tugas'] = $this->db->select('*')->get('opt_tugas')->row();
        $this->load->view('admin/setting/opt_tugas', $data);
    }

    public function update_opt_tugas()
    {
        $data = [
            'kurang_due_date' => htmlspecialchars($this->input->post('kurang_due_date', true)),
            'pas_due_date' => htmlspecialchars($this->input->post('pas_due_date', true)),
            'lebih_due_date' => htmlspecialchars($this->input->post('lebih_due_date', true))
        ];

        $where = array(
            'id_opt_tugas' => 1,
        );

        $this->m_materi->update_data_file($where, $data, 'opt_tugas');
        $this->session->set_flashdata('success-opt-tugas', 'Berhasil!');
        redirect(base_url('admin/opt_tugas'));
    }
    public function transkrip($id)
    {
        $data['nama_siswa'] = $this->m_siswa->get_profile($id)->row();
        $data['mutu'] = $this->db->select('*')->get('mutu')->result();
        $data['transkrip'] = $this->m_materi->transkrip($id)->result();
        $this->load->view('admin/transkrip/data_transkrip', $data);
    }

    public function opt_payment()
    {
        $data['setting'] = $this->db->get('payment_setting')->result();

        $this->load->view('admin/setting/opt_payment', $data);
    }

    public function payment_active($id_payment)
    {
        $this->db->update('payment_setting', ['is_active' => 0]);

        $this->db->where('id', $id_payment)->update('payment_setting', ['is_active' => 1]);

        $this->session->set_flashdata('success', "Berhasil mengganti opsi");

        redirect('admin/opt_payment');
    }
    public function add_payment_setting()
    {
        $this->db->insert('payment_setting', $this->input->post());

        header('Content-type: application/json');
        $this->session->set_flashdata('success', "Berhasil menambah opsi");
        echo json_encode([
            'success' => true
        ]);
    }

    public function delete_opt_payment($id)
    {
        $this->db->delete('payment_setting', ['id' => $id]);
        $this->session->set_flashdata('success', "Berhasil menghapus opsi");
        redirect('admin/opt_payment');
    }

    public function mark_mapel($id_mapel, $id_user)
    {
        $mapel = $this->m_materi->get_mapel($id_mapel)->row();
        $semester = $this->m_materi->get_kunci_mapel($mapel->id_semester)->row();
        $urutan = $mapel->urutan + 1;

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

    public function riwayat_transaksi ()
    {
        $data['transaksi'] = $this->db
            ->join('user', 'user.id_user=transaksi.id_user')
            ->get('transaksi')
            ->result();

        $this->load->view('admin/transaksi/riwayat', $data);
    }
}
