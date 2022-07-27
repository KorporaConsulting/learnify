<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // load Session Library
        $this->load->library('session');

        // load url helper
        $this->load->helper('url');
    }

    public function register()
    {
        $this->load->view('user/registration');
        $this->load->view('template/footer');
    }

    public function login()
    {
        $this->load->view('template/nav');
        $this->load->view('login');
        $this->load->view('template/footer');
    }

    public function validateLogin()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required', [
            'required' => 'Harap isi kolom email!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Harap isi kolom password!',
        ]);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('false-login', true);
            $this->session->set_flashdata('validateLoginFalse', $this->form_validation->error_array());
            $this->load->library('user_agent');
            redirect($this->agent->referrer());
        } else {
            $this->login_proses();
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success-logout', 'Berhasil!');
        redirect(base_url());
    }

    private function login_proses()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            //cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'id_user' => $user['id_user'],
                    'email' => $user['email'],
                    'nama' => $user['nama'],
                    'ttl' => $user['ttl'],
                    'jk' => $user['jk'],
                    'image_user' => $user['image_user'],
                    'qr_code' => $user['qr_code']
                ];
                $this->session->set_userdata($data);
                $this->session->set_flashdata('sukses-login', 'Berhasil!');
                redirect(base_url('user'));
            } else {
                $this->session->set_flashdata('fail-pass', 'Gagal!');
                redirect(base_url('auth/login'));
            }
        } else {
            $this->session->set_flashdata('fail-login', 'Gagal!');
            redirect(base_url('auth/login'));
        }
    }


    public function admin()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Harap isi bidang email!',
            'valid_email' => 'Email tidak valid!',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Harap isi bidang password!',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/login');
        } else {
            //validasi sukses
            $this->adminlogin();
        }
    }

    private function adminlogin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('admin', ['email' => $email])->row_array();

        if ($user) {
            //cek password
            if (password_verify($password, $user['password'])) {
                $data = [

                    'email' => $user['email'],
                    'nama' => $user['username'],
                    'image' => $user['image'],
                    'login_admin' => 'is_login'

                ];
                $this->session->set_userdata($data);
                redirect(base_url('admin'));
            } else {

                $this->session->set_flashdata('fail-pass', 'Gagal!');
                redirect(base_url('auth/admin'));
            }
        } else {

            $this->session->set_flashdata('fail-login', 'Gagal!');
            redirect(base_url('auth/admin'));
        }
    }
    public function logout_mentor()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success-logout', 'Berhasil!');
        redirect('auth/mentor');
    }

    public function mentor()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Harap isi bidang email!',
            'valid_email' => 'Email tidak valid!',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Harap isi bidang password!',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('guru/login');
        } else {
            //validasi sukses
            $this->guru_login_process();
        }
    }

    private function guru_login_process()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('guru', ['email' => $email])->row_array();

        if ($user) {
            //cek password
            if (password_verify($password, $user['password'])) {
                $data = [

                    'id_guru' => $user['id_guru'],
                    'email' => $user['email'],
                    'nama_guru' => $user['nama_guru'],
                    'is_guru' => "is_guru",

                ];
                $this->session->set_userdata($data);
                $this->session->set_flashdata('sukses-login', 'Berhasil!');
                redirect(base_url('mentor'));
            } else {

                $this->session->set_flashdata('fail-pass', 'Gagal!');
                redirect(base_url('auth/mentor'));
            }
        } else {

            $this->session->set_flashdata('fail-login', 'Gagal!');
            redirect(base_url('auth/mentor'));
        }
    }
}
