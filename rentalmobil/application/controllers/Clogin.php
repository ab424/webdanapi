<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class clogin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Muser');
    }

    public function index()
    {
        if (!isset($_SESSION['login']))
            $_SESSION['login'] = 0;
        $_SESSION['success'] = 0;
        $this->load->view('vlogin');
    }

    public function auth()
    {
        $this->Muser->siteman();

        if ($_SESSION['login'] == 1) {
            redirect('chome');
        } else
            redirect('clogin');
    }

    public function authrental()
    {
        $this->Muser->sitemanrental();

        if ($_SESSION['login'] == 1) {
            redirect('transaksi');
        } else
            redirect('clogin');
    }

    public function login()
    {
        $this->user_model->login();
        $header = $this->header_model->get_config();
        $this->load->view('siteman', $header);
    }

    public function logout()
    {
        unset(
            $_SESSION['id'],
            $_SESSION['username'],
            $_SESSION['nama'],
            $_SESSION['status'],
            $_SESSION['id_cabang'],
            $_SESSION['login'],
            $_SESSION['level']
        );
        $this->session->sess_destroy();
        redirect('clogin');
    }

    public function flash()
    {
        $this->load->view('config');
    }
}
