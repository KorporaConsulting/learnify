<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

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
