<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Profil extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Profil_model');
    }


    public function profil_get($id_user)
    {
        $data = $this->Profil_model->get_profil_id($id_user);

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

    public function rental_get()
    {
        $data = $this->Mobil_model->get_rental();
        foreach ($data as $row) {
            $dataar[] = array(
                'id' => $row['id'],
                'nama' => $row['nama'],
                'no_hp' => $row['no_hp'],
                'alamat' => $row['alamat'],
                'lat' => $row['lat'],
                'lng' => $row['lng'],
                'jumlah' => $this->Mobil_model->get_count_mobilbyrental($row['id'])
            );
        }
        if ($data) {
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

    public function rental_detail_get($id_rental)
    {
        $data = $this->Mobil_model->get_rental_detail($id_rental);

        $dataar = array(
            'id' => $data['id'],
            'nama' => $data['nama'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat'],
            'lat' => $data['lat'],
            'lng' => $data['lng'],
            'jumlah' => $this->Mobil_model->get_count_mobilbyrental($data['id'])
        );

        if ($data) {
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

    public function mobil_detail_get($id)
    {
        $data = $this->Mobil_model->get_data_id($id);

        $dataar = array(
            'id_mobil' => $data['id_mobil'],
            'nama_mobil' => $data['nama_mobil'],
            'plat_mobil' => $data['plat_mobil'],
            'merk' => $data['merk'],
            'tahun' => $data['tahun'],
            'kapasitas' => $data['kapasitas'],
            'harga' => getRupiah($data['harga']),
            'warna' => $data['warna'],
            'tipe' => $data['tipe'],
            'status' => $data['status'],
            'foto' => $data['foto'],
            'deskripsi' => $data['deskripsi'],
            'id_rental' => $data['id_rental'],
            'id' => $data['id'],
            'nama' => $data['nama'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat'],
            'lat' => $data['lat'],
            'lng' => $data['lng']

        );

        if ($data) {
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
}
