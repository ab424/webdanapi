<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Transaksi extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_model');
        $this->load->model('Mobil_model');
        $this->load->model('User_model');
    }

    public function index_get($id_user)
    {
        $data = $this->Transaksi_model->get_data($id_user);
        // $array_mobil = array();
        foreach ($data as $row) {
            $t = date_create($row['tgl_pinjam']);
            $n = date_create($row['tgl_kembali']);
            $terlambat = date_diff($t, $n);
            $mobil = $this->User_model->get_data_id($row['id_user'])["nama"];

            $perpanjangan = $this->Transaksi_model->get_data_detail_perpanjang($row['id_transaksi']);
            $hari_perpanjang = 0;
            if ($perpanjangan != null) {
                $t2 = date_create($perpanjangan['tgl_perpanjangan']);
                $n2 = date_create($perpanjangan['tgl_kembali']);
                $terlambat2 = date_diff($t2, $n2);
                $hari_perpanjang = $terlambat2->format("%a");
            }


            $dataar[] = array(
                'urutan' => $row['urutan'],
                'id_transaksi' => $row['id_transaksi'],
                'id_user' => $row['id_user'],
                'id_mobil' => $row['id_mobil'],
                'nama_mobil' => $this->Mobil_model->get_data_id($row['id_mobil'])["nama_mobil"],
                'nama_pengirim' => $row['nama_pengirim'],
                'nomor_pengirim' => $row['nomor_pengirim'],
                'foto' => $row['foto'],
                'tgl_transaksi' => $row['tgl_transaksi'],
                'tgl_pinjam' => $row['tgl_pinjam'],
                'tgl_kembali' => $row['tgl_kembali'],
                'total' => $row['total'],
                'status' => $row['status'],
                'hari' => $terlambat->format("%a") + $hari_perpanjang . " Hari",
                // 'harga' => $this->Mobil_model->get_data_ids($row['id_mobil'])["harga"]
                'harga' => getRupiah($this->Mobil_model->get_data_ids($row['id_mobil'])["harga"] * ($terlambat->format("%a") + $hari_perpanjang)),
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

    public function detail_get($id_transaksi)
    {
        $data['transaksi'] = $this->Transaksi_model->get_data_detail_transaksi($id_transaksi);
        $data['mobil'] = $this->Mobil_model->get_data_ids($data['transaksi']["id_mobil"]);
        $data['user'] = $this->User_model->get_data_id($data['transaksi']["id_user"]);
        $data['perpanjangan'] = $this->Transaksi_model->get_data_detail_perpanjang($id_transaksi);
        $data['rental'] = $this->Mobil_model->get_rental_detail($data['mobil']["id_rental"]);

        $hari_perpanjang = 0;
        if ($data['perpanjangan'] != null) {
            $t2 = date_create($data['perpanjangan']['tgl_perpanjangan']);
            $n2 = date_create($data['perpanjangan']['tgl_kembali']);
            $terlambat2 = date_diff($t2, $n2);
            $hari_perpanjang = $terlambat2->format("%a");
        }

        $t = date_create($data['transaksi']['tgl_pinjam']);
        $n = date_create($data['transaksi']['tgl_kembali']);
        $terlambat = date_diff($t, $n);

        $dataar = array(
            'urutan' => $data['transaksi']["urutan"],
            'id_transaksi' => $data['transaksi']["id_transaksi"],
            'id_user' => $data['transaksi']["id_user"],
            'id_mobil' => $data['transaksi']["id_mobil"],
            'nama_pengirim' => $data['transaksi']["nama_pengirim"],
            'nomor_pengirim' => $data['transaksi']["nomor_pengirim"],
            'foto' => $data['transaksi']["foto"],
            'tgl_transaksi' => $data['transaksi']["tgl_transaksi"],
            'tgl_pinjam' => $data['transaksi']["tgl_pinjam"],
            'tgl_kembali' => $data['transaksi']["tgl_kembali"],
            // 'total' => $data['transaksi']["total"],
            'status' => $data['transaksi']["status"],
            'jumlah_hari' => $terlambat->format("%a"),
            'jumlah_hari_perpanjang' => $hari_perpanjang . "",
            'bayar_hari' => getRupiah($data['mobil']['harga'] * $terlambat->format("%a")),
            'bayar_hari_perpanjang' => getRupiah($data['mobil']['harga'] * $hari_perpanjang),
            'nama_mobil' => $data['mobil']['nama_mobil'],
            'foto_mobil' => $data['mobil']['foto'],
            'harga_mobil' => $data['mobil']['harga'],
            'total' => getRupiahs($data['mobil']['harga'] * ($terlambat->format("%a") + $hari_perpanjang)),
            'norek' => $data['user']['norek'],
            'nama_bank' => $data['user']['nama_bank'],
            'nama_rekening' => $data['user']['nama_rekening'],
            'nama_bank_rental' => $data['rental']['nama_bank'],
            'norek_rental' => $data['rental']['norek'],


        );

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

    public function transaksi_post()
    {
        $Date = date('Y-m-d H:i');
        $id_transaksi = str_replace("-", "", $this->uuid->v4());

        $params = array(
            'id_transaksi' => $id_transaksi,
            'id_user' => $this->post('id_user'),
            'tgl_transaksi' => $Date,
            'tgl_pinjam' => $this->post('tgl_pinjam') . " " . $this->post('waktu'),
            'tgl_kembali' => $this->post('tgl_kembali') . " " . $this->post('waktu'),
            'id_mobil' => $this->post('id_mobil'),
            'id_rental' => $this->Mobil_model->get_data_id($this->post('id_mobil'))["id_rental"]
        );

        $this->Transaksi_model->add_transaksi($params);

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

    public function kembalikan_post()
    {
        $Date = date('Y-m-d H:i');
        $params = array(
            'status' => 5
        );

        $this->db->where('id_transaksi', $this->post('id_transaksi'));
        $this->db->update('tb_transaksi', $params);

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

    public function uploadBuktiBayar_post()
    {
        $filename = $_FILES["foto"]["name"];
        if ($filename) {
            $foto = $this->_uploadImagep();
        } else {
            $foto = "";
        }

        $params = array(
            'foto' => $foto,
            'nama_pengirim' => $this->post('nama_pengirim'),
            'nomor_pengirim' => $this->post('nomor_pengirim'),
            'nama_bank' => $this->post('nama_bank'),
            'status' => 1
        );

        $this->db->where('id_transaksi', $this->post('id_transaksi'));
        $this->db->update('tb_transaksi', $params);

        if ($params) {
            // $msg_user = array('title' => "e-Damkar", 'body' => $this->post('ket'), 'id' => $ids, 'channel' => 'CH_ID_NOTIF_ABSEN', 'priority' => 'high');
            // $fields_user = array('to' => '/topics/damkar', 'data' => $msg_user, 'sound' => 1);
            // $this->fcm($msg_user, $fields_user);

            $this->response([
                'status' => true,
                'message' => 'sukses menampilkan data',
                'payload' => $params
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal menampilkan data',
                'payload' => null
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function uploadBuktiBayarPerpanjang_post()
    {
        $filename = $_FILES["foto"]["name"];
        if ($filename) {
            $foto = $this->_uploadImagep();
        } else {
            $foto = "";
        }

        $params = array(
            'foto' => $foto,
            'id_transaksi' => $this->post('id_transaksi'),
            'tgl_perpanjangan' => $this->post('tgl_perpanjangan'),
            'tgl_kembali ' => $this->post('tgl_kembali'),
            'nama_pengirim' => $this->post('nama_pengirim'),
            'nomor_pengirim' => $this->post('nomor_pengirim'),
            'nama_bank' => $this->post('nama_bank')
        );

        $this->Transaksi_model->add_transaksi_perpanjang($params);

        $this->db->where('id_transaksi', $this->post('id_transaksi'));
        $this->db->update('tb_transaksi', array('status' => 4));

        if ($params) {
            // $msg_user = array('title' => "e-Damkar", 'body' => $this->post('ket'), 'id' => $ids, 'channel' => 'CH_ID_NOTIF_ABSEN', 'priority' => 'high');
            // $fields_user = array('to' => '/topics/damkar', 'data' => $msg_user, 'sound' => 1);
            // $this->fcm($msg_user, $fields_user);

            $this->response([
                'status' => true,
                'message' => 'sukses menampilkan data',
                'payload' => $params
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal menampilkan data',
                'payload' => null
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function retur_post()
    {
        $filename = $_FILES["foto"]["name"];
        if ($filename) {
            $foto = $this->_uploadImagep();
        } else {
            $foto = "";
        }

        $id_retur = str_replace("-", "", $this->uuid->v4());

        $params = array(
            'kuantitas_item' => $this->post('kuantitas_item'),
            'alasan' => $this->post('alasan')
        );

        $this->db->insert(
            'tb_retur',
            array(
                'id_retur' => $id_retur,
                'kuantitas_item' => $this->post('kuantitas_item'),
                'alasan' => $this->post('alasan'),
                'foto' => $foto
            )
        );

        $this->db->where('id_item', $this->post('id_item'));
        $this->db->update('tb_item_transaksi', array('status' => 1, 'id_retur' => $id_retur));

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
                'payload' => null
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    private function _uploadImagep()
    {
        $id_user = str_replace("-", "", $this->uuid->v4());
        $config['upload_path']          = 'public/fbukti';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 200000000;
        $config['overwrite'] = TRUE;
        $filename = $_FILES["foto"]["name"];
        $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
        $config['file_name'] = $id_user . '.' . 'jpg';

        $this->upload->initialize($config);
        $this->load->library('upload');

        if (!$this->upload->do_upload('foto')) {
            $data['error'] = array('error' => $this->upload->display_errors());
            var_dump($data['error']);
            die();
        } else {
            return $this->upload->data('file_name');
        }
    }
}
