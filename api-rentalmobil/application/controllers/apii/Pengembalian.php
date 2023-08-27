<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pengembalian extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengembalian_model');
        $this->load->model('Peminjaman_model');
    }

    public function index_get($id)
    {
        $data = $this->Pengembalian_model->get_data($id);

        foreach ($data as $row) {
            $dataar[] = array(
                'id' => $row['id'],
                'tgl_peminjaman' => $row['tgl_peminjaman'],
                'tgl_kembali' => $row['tgl_kembali'],
                'tgl_pengembalian' => $row['tgl_pengembalian'],
                'id_mahasiswa' => $row['id_mahasiswa'],
                'pengembalian' => $this->Peminjaman_model->get_count_pinjam($row['pengembalian']),
                'id_pengembalian' => $row['pengembalian'],
                'status_kembali' => $row['status_kembali'],
                'denda' => "Denda " . getRupiah((int) $row['denda'])
            );
        }


        if ($dataar) {
            $this->response([
                'status' => true,
                'message' => 'sukses menampilkan data',
                'payload' => $dataar
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => true,
                'message' => 'gagal menampilkan data',
                'payload' => null
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function pengembalian_post()
    {
        $Date = date('Y-m-d H:i:s');
        // $Date = "2021-03-06 05:22:43";
        $jumlah_buku = $this->Pengembalian_model->get_count_pinjam($this->post('pengembalian'));
        $t = date_create($this->post('tgl_kembali'));
        $n = date_create($Date);
        $terlambat = date_diff($t, $n);
        $hari = $terlambat->format("%a");
        if ($n < $t) {
            $denda = "0";
        } else {
            $denda = $hari * 1000;
        }


        $params = array(
            'id_mahasiswa' => $this->post('id_mahasiswa'),
            'tgl_peminjaman' => $this->post('tgl_peminjaman'),
            'tgl_kembali' => $this->post('tgl_kembali'),
            'tgl_pengembalian' => $Date,
            'pengembalian' => $this->post('pengembalian')
        );

        // 'denda' => $denda * $jumlah_buku
        $this->Pengembalian_model->add_Pengembalian($params);

        if ($params) {
            $this->response([
                'status' => true,
                'message' => 'sukses menampilkan data',
                'payload' => "Sukses"
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal menampilkan data',
                'payload' => null
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
