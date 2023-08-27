<?php
defined('BASEPATH') or exit('No direct script access allowed');

class chome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        login_timeout();
        $this->load->library('otherLibrary');
        $this->load->model('Rental_model');
        $this->load->model('Mobil_model');
        $this->load->model('User_model');
        $this->load->model('Transaksi_model');
    }

    public function index()
    {
        $data['rental'] = $this->Rental_model->get_data_count();
        $data['mobil'] = $this->Mobil_model->get_data_count_mobil();
        $data['user'] = $this->User_model->get_data_count();
        $data['transaksi'] = $this->Transaksi_model->get_count_transaksi();

        $isi =  $this->template->display('admin/content/home/vhomepj', $data);
        $this->load->view('admin/vutama', $isi);
    }
}
