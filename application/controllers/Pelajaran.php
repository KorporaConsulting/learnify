<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelajaran extends CI_Controller
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
        $this->load->view('template/nav');
        $this->load->view('pelajaran');
        $this->load->view('template/footer');
    }
}
