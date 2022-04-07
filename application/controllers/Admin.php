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

        $this->load->helper('url');
        $this->session->set_flashdata('not-login', 'Gagal!');
        if (!$this->session->userdata('email')) {
            redirect('welcome/admin');
        }
    }

    public function index()
    {
        $data['user'] = $this->m_siswa->tampil_data()->result();
        $this->load->view('admin/index', $data);
    }



    // Management Siswa
    public function add_new_siswa()
    {
        $this->form_validation->set_rules('nis', 'NIS', 'required|trim|is_unique[user.nis]', [
            'is_unique' => 'NIS ini telah digunakan!',
            'required' => 'Harap isi kolom NIS.',
        ]);

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
            $data = [
                'nis' => htmlspecialchars($this->input->post('nis', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
                'image' => $image,
                'jk' => htmlspecialchars($this->input->post('jk', true)),
                'ttl' => htmlspecialchars($this->input->post('ttl', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'role' => 3,
            ];

            $this->db->insert('user', $data);

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
                'nis' => htmlspecialchars($this->input->post('nis', true)),
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
        $data['user'] = $this->db->get_where('admin', ['email' =>
        $this->session->userdata('email')])->row_array();

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
                'image' => $image,
                'jk' => htmlspecialchars($this->input->post('jk', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            ];

            $this->db->insert('guru', $data);

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_guru'));
        }
    }

    //manajemen mapel
    public function add_mapel()
    {
        $this->load->model('m_guru');
        $data['mentor'] = $this->m_guru->tampil_data()->result();
        $this->load->view('admin/mapel/add_mapel', $data);
    }

    public function insert_mapel()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[1]', [
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
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'Image', 'required', [
                'required' => 'Harap upload gambar.'
            ]);
        }

        if ($this->form_validation->run() == false) {
            $data['mentor'] = $this->m_guru->tampil_data()->result();
            $this->load->view('admin/mapel/add_mapel', $data);
        } else {
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
                $data = [
                    'nama' => htmlspecialchars($this->input->post('nama', true)),
                    'desk' => htmlspecialchars($this->input->post('desk', true)),
                    'image' => $gambar,
                    'id_guru' => htmlspecialchars($this->input->post('guru', true)),
                    'semester' => htmlspecialchars($this->input->post('semester', true)),
                ];
                $this->db->insert('mapel', $data);
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
        $this->load->view('admin/mapel/data_mapel', $data);
    }

    public function update_mapel($id)
    {
        $this->load->model('m_materi');
        $data['mentor'] = $this->m_guru->tampil_data()->result();
        $data['user'] = $this->m_materi->update_mapel($id)->row();
        $this->load->view('admin/mapel/update_mapel', $data);
    }
    public function mapel_edit()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[1]', [
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
                $data = [
                    'nama' => htmlspecialchars($this->input->post('nama', true)),
                    'desk' => htmlspecialchars($this->input->post('desk', true)),
                    'image' => htmlspecialchars($this->input->post('image', true)),
                    'id_guru' => htmlspecialchars($this->input->post('guru', true)),
                    'semester' => htmlspecialchars($this->input->post('semester', true)),
                ];
                $where = array(
                    'id_mapel' => $id_mapel,
                );
                $this->m_guru->update_data($where, $data, 'mapel');
                $this->session->set_flashdata('success-edit', 'Berhasil!');
                redirect(base_url('admin/data_mapel'));
            } else {
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

                    $id_mapel = $this->input->post('id_mapel');
                    $gambar = $gbr['file_name'];
                    $data = [
                        'nama' => htmlspecialchars($this->input->post('nama', true)),
                        'desk' => htmlspecialchars($this->input->post('desk', true)),
                        'image' => $gambar,
                        'id_guru' => htmlspecialchars($this->input->post('guru', true)),
                        'semester' => htmlspecialchars($this->input->post('semester', true)),
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
    public function delete_mapel($id)
    {
        $this->load->model('m_materi');
        $where = array('id_mapel' => $id);
        $this->m_materi->delete_mapel($where, 'mapel');
        $this->session->set_flashdata('mapel-delete', 'berhasil');
        redirect('admin/data_mapel');
    }
    public function data_materi_course($id)
    {
        $this->load->model('m_materi');
        $data['user'] = $this->m_materi->tampil_data_materi_course($id)->result();
        $this->load->view('admin/materi/data_materi', $data);
    }

    // Manajement Materi

    public function data_materi()
    {
        $this->load->model('m_materi');
        $data['user'] = $this->m_materi->tampil_data_materi()->result();
        $this->load->view('admin/materi/data_materi', $data);
    }

    public function tambah_materi()
    {
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim|min_length[1]', [
            'required' => 'Harap isi kolom deskripsi.',
            'min_length' => 'deskripsi terlalu pendek.',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/add_materi');
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
                'nama_guru' => htmlspecialchars($this->input->post('nama_guru', true)),
                'nama_mapel' => htmlspecialchars($this->input->post('nama_mapel', true)),
                'video' => $video,
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi', true)),
                'kelas' => htmlspecialchars($this->input->post('kelas', true)),
            ];

            $this->db->insert(
                'materi',
                $data
            );
            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_materi'));
        }
    }
    public function add_materi()
    {
        $data['mapel'] = $this->m_materi->tampil_data_mapel()->result();
        $this->load->view('admin/materi/add_materi', $data);
    }
    public function insert_materi()
    {
        $this->load->model('m_materi');
        $this->form_validation->set_rules('nama_materi', 'Nama', 'required|trim', [
            'required' => 'Harap isi kolom NAMA.',
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

            $data = [
                'nama_materi' => htmlspecialchars($this->input->post('nama_materi', true)),
                'desk_materi' => htmlspecialchars($this->input->post('desk', true)),
                'id_mapel' => htmlspecialchars($this->input->post('mapel', true)),
            ];

            $this->db->insert('materi', $data);

            $this->session->set_flashdata('success-reg', 'Berhasil!');
            redirect(base_url('admin/data_materi'));
        }
    }
    public function update_materi($id)
    {
        $where = array('id_materi' => $id);
        $data['user'] = $this->m_materi->update_materi($where, 'materi')->row();
        $data['mapel'] = $this->m_materi->tampil_data_mapel()->result();
        $this->load->view('admin/materi/update_materi', $data);
    }

    public function edit_materi()
    {
        $data = [
            'nama_materi' => htmlspecialchars($this->input->post('nama_materi', true)),
            'desk_materi' => htmlspecialchars($this->input->post('desk_materi', true)),
            'id_mapel' => htmlspecialchars($this->input->post('mapel', true)),
        ];
        $where = array(
            'id_materi' => $this->input->post('id_materi'),
        );

        $this->m_materi->update_data_materi($where, $data, 'materi');
        $this->session->set_flashdata('success-edit', 'berhasil');
        redirect('admin/data_materi');
    }
    public function delete_materi($id)
    {
        $where = array('id_materi' => $id);
        $this->m_materi->delete_materi($where, 'materi');
        $this->session->set_flashdata('materi-delete', 'berhasil');
        redirect('admin/data_materi');
    }

    public function isi_materi($id)
    {
        $data['materi'] = $this->m_materi->where_tampil_materi($id)->row();
        $data['video'] = $this->m_materi->where_tampil_video($id)->result();
        $data['file'] = $this->m_materi->where_tampil_file($id)->result();
        $data['quiz'] = $this->m_materi->where_tampil_quiz($id)->result();
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
            redirect(base_url('admin/isi_materi/' . $id_materi));
        }
    }
    public function delete_video($id, $id_materi)
    {
        $where = array('id_video' => $id);
        $this->m_materi->delete_video($where, 'video');
        $this->session->set_flashdata('video-delete', 'berhasil');
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
        ];
        $this->db->insert('file', $data);
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
        ];
        $where = array(
            'id_file' => $this->input->post('id_file'),
        );

        $this->m_materi->update_data_file($where, $data, 'file');
        $this->session->set_flashdata('success-file-edit', 'Berhasil!');
        redirect(base_url('admin/isi_materi/' . $id_materi));
    }

    public function delete_file($id, $id_materi)
    {
        $where = array('id_file' => $id);
        $this->m_materi->delete_file($where, 'file');
        $this->session->set_flashdata('file-delete', 'berhasil');
        redirect(base_url('admin/isi_materi/' . $id_materi));
    }

    public function insert_quiz()
    {
        $id_materi = $this->input->post('id_materi', true);
        $data = [
            'nama_file' => htmlspecialchars($this->input->post('nama_file', true)),
            'desk_file' => htmlspecialchars($this->input->post('desk_file', true)),
            'link' => htmlspecialchars($this->input->post('link', true)),
            'id_materi' => htmlspecialchars($this->input->post('id_materi', true)),
        ];
        $this->db->insert('file', $data);
        $this->session->set_flashdata('success-file', 'Berhasil!');
        redirect(base_url('admin/isi_materi/' . $id_materi));
    }
}
