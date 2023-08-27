<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Keranjang extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Keranjang_model');
        $this->load->model('Produk_model');
        $this->load->model('Kategori_model');
    }

    public function index_get($id_konsumen)
    {
        $data = $this->Keranjang_model->get_data($id_konsumen);
        $arr = array();
        foreach ($data as $row) {
            $id_satuan = $this->Produk_model->get_data_id($row['id_produk'])["id_satuan"];
            $subTotal =  $this->Produk_model->get_data_id($row['id_produk'])["harga"] * $row['kuantitas_item'];
            array_push($arr, $subTotal);
            $total_harga = array_sum($arr);

            $dataar[] = array(
                'id_keranjang' => $row['id_keranjang'],
                'id_produk' => $row['id_produk'],
                'nama_produk' => $this->Produk_model->get_data_id($row['id_produk'])["nama_produk"],
                'satuan' => $this->Kategori_model->get_data_satuan_id($id_satuan)["nama_satuan"],
                'harga' => $this->Produk_model->get_data_id($row['id_produk'])["harga"],
                'foto' => $this->Produk_model->get_data_id($row['id_produk'])["foto"],
                'kuantitas_item' => $row['kuantitas_item'],
                'subTotal' => $subTotal . ""
            );
        }

        if ($dataar) {
            $this->response([
                'status' => true,
                'message' => 'sukses menampilkan data',
                'total' => $total_harga . "",
                'payload' => $dataar
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => true,
                'message' => 'gagal menampilkan data',
                'total' => "",
                'payload' => null
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function keranjang_post()
    {
        $params = array(
            'id_konsumen' => $this->post('id_konsumen'),
            'id_produk' => $this->post('id_produk'),
            'kuantitas_item' => $this->post('kuantitas_item')
        );

        if ($this->check_produk($this->post('id_konsumen'), $this->post('id_produk'))) {
        } else {
            $this->Keranjang_model->add_keranjang($params);
        }

        if ($params) {
            $this->response([
                'status' => true,
                'message' => 'sukses menampilkan data',
                'payload' => "sukses"
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal menampilkan data',
                'payload' => "gagal"
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function update_keranjang_post()
    {
        $params = array(
            'id_keranjang' => $this->post('id_keranjang'),
            'kuantitas_item' => $this->post('kuantitas_item')
        );

        $this->db->where('id_keranjang', $this->post('id_keranjang'));
        $this->db->update('tb_keranjang', array('kuantitas_item' => $this->post('kuantitas_item')));

        if ($params) {
            $this->response([
                'status' => true,
                'message' => 'sukses menampilkan data',
                'payload' => "sukses"
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal menampilkan data',
                'payload' => "gagal"
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    function check_produk($id_konsumen, $id_produk)
    {
        $this->db->where('id_konsumen', $id_konsumen);
        $this->db->where('id_produk', $id_produk);
        $query = $this->db->get('tb_keranjang');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
