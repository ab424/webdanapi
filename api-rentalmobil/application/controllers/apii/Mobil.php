<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mobil extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mobil_model');
        $this->load->model('Transaksi_model');
    }

    public function mobil_search_get()
    {
        $j = $_GET['j'];
        $data = $this->Mobil_model->get_mobil_search($j);
        $array_mobil = array();
        foreach ($data as $row) {
            $Date = date('Y-m-d H:i');
            $tglMulai = $this->Transaksi_model->get_data_byidmobil($row['id_mobil'])["tgl_pinjam"];
            $tglSelesai = $this->Transaksi_model->get_data_byidmobil($row['id_mobil'])["tgl_kembali"];

            // $last_key = end(array_keys($this->displayDates($tglMulai, $tglSelesai)));
            // echo $last_key;
            // die();
            foreach ($this->displayDates($tglMulai, $tglSelesai) as $key) {
                $tglPinjam = strtotime($Date);
                $tglkembali = strtotime($key);

                // var_dump(date('Y-m-d H:i', strtotime($Date)) > date('Y-m-d H:i', strtotime($key)));
                // echo $key;
                // die();
                if (date('Y-m-d H:i', strtotime($Date)) > date('Y-m-d H:i', strtotime($tglMulai)) && date('Y-m-d H:i', strtotime($Date)) <= date('Y-m-d H:i', strtotime($tglSelesai))) {
                    // if ($tglkembali == $tglSelesai) {
                    //     $status =  1;
                    //     break;
                    // } else {
                    //     $status =  1;
                    //     continue;
                    // }
                    // echo $tglSelesai;
                    // echo $key;
                    $status =  1;
                    break;
                } else {
                    $status =  0;
                }
                // echo $status;
                // die();
            }
            // echo $status;
            // die();
            // if (in_array($Date, $this->displayDates($tglMulai, $tglSelesai))) {
            //     $status =  1;
            // } else {
            //     $status =  0;
            // }

            $dataar[] = array(
                'id_mobil' => $row['id_mobil'],
                'nama_mobil' => $row['nama_mobil'],
                'plat_mobil' => $row['plat_mobil'],
                'merk' => $row['merk'],
                'tahun' => $row['tahun'],
                'kapasitas' => $row['kapasitas'],
                'harga' => getRupiah($row['harga']),
                'warna' => $row['warna'],
                'tipe' => $row['tipe'],
                'status' => $status,
                'foto' => $row['foto'],
                'deskripsi' => $row['deskripsi'],
                'id_rental' => $row['id_rental'],
                'id' => $row['id'],
                'nama' => $row['nama'],
                'no_hp' => $row['no_hp'],
                'alamat' => $row['alamat'],
                'lat' => $row['lat'],
                'lng' => $row['lng']
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

    public function rental_mobil_get($id_rental)
    {
        $data = $this->Mobil_model->get_rental_mobil($id_rental);

        foreach ($data as $row) {
            $dataar[] = array(
                'id_mobil' => $row['id_mobil'],
                'nama_mobil' => $row['nama_mobil'],
                'plat_mobil' => $row['plat_mobil'],
                'merk' => $row['merk'],
                'tahun' => $row['tahun'],
                'kapasitas' => $row['kapasitas'],
                'harga' => getRupiah($row['harga']),
                'warna' => $row['warna'],
                'tipe' => $row['tipe'],
                'status' => $row['status'],
                'foto' => $row['foto'],
                'deskripsi' => $row['deskripsi'],
                'id_rental' => $row['id_rental'],
                'id' => $row['id'],
                'nama' => $row['nama'],
                'no_hp' => $row['no_hp'],
                'alamat' => $row['alamat'],
                'lat' => $row['lat'],
                'lng' => $row['lng']

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
            'norek' => $data['norek'],
            'nama_bank' => $data['nama_bank'],
            'nama_rekening' => $data['nama_rekening'],
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

    // function displayDates($date1, $date2, $format = 'Y-m-d H:i')
    function displayDates($date1, $date2, $format = 'Y-m-d H:i')
    {
        $dates = array();
        $current = strtotime($date1);
        $date2 = strtotime($date2);
        $stepVal = '+1 day';
        while ($current <= $date2) {
            $dates[] = date($format, $current);
            $current = strtotime($stepVal, $current);
        }
        return $dates;
    }
}
