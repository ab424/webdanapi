<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Kategori extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_model');
    }

    public function kategori_get()
    {
        $data = $this->Kategori_model->get_kategori();
        if ($data) {
            $this->response([
                'status' => true,
                'message' => 'sukses menampilkan data',
                'payload' => $data
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => true,
                'message' => 'gagal menampilkan data',
                'payload' => null
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
