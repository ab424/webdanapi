<?php
defined('BASEPATH') or exit('No direct script access allowed');
define('API_ACCESS_KEY', 'AAAAJLGBF54:APA91bE7E-u5KeLYucrXU7blxdR5RG4paOP-g2nH_uF1TN-U0WTSKOhcymsD5aq311OvgOh-XkUBS3o43F2syCi1M8gYqWuPYEDthkJPIu008up6cRVkjrOqTUDmfKxAUNn_0-4Pu9VD');

class Transaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        login_timeout();
        $this->load->model('Transaksi_model');
        $this->load->model('User_model');
        $this->load->model('Mobil_model');
        $this->load->model('Rental_model');
        // $this->load->model('Satuan_model');
    }

    public function index()
    {
        $data['transaksi'] = $this->Transaksi_model->get_data();
        $isi =  $this->template->display('admin/content/transaksi/index', $data);
        $this->load->view('admin/vutama', $isi);
    }

    public function transaksiproses()
    {
        $data['transaksi'] = $this->Transaksi_model->get_data_proses();
        $isi =  $this->template->display('admin/content/transaksi/proses_transaksi', $data);
        $this->load->view('admin/vutama', $isi);
    }

    public function transaksibatal()
    {
        $data['transaksi'] = $this->Transaksi_model->get_data_batal();
        $isi =  $this->template->display('admin/content/transaksi/index', $data);
        $this->load->view('admin/vutama', $isi);
    }

    public function transaksiselesai()
    {
        $data['transaksi'] = $this->Transaksi_model->get_data_selesai();
        $isi =  $this->template->display('admin/content/transaksi/transaksi_selesai', $data);
        $this->load->view('admin/vutama', $isi);
    }

    public function transaksiselesairental()
    {
        if (isset($_POST['tgl_dari']))
            $data['tgl_dari'] = $_POST['tgl_dari'];
        else {
            $data['tgl_dari'] = '';
        }

        if (isset($_POST['tgl_sampai']))
            $data['tgl_sampai'] = $_POST['tgl_sampai'];
        else {
            $data['tgl_sampai'] = '';
        }

        if (!empty($_REQUEST['cari'])) {
            $data['transaksi'] = $this->Transaksi_model->get_data_selesai_rental($_SESSION['id']);
            $isi =  $this->template->display('admin/content/transaksi/transaksi_selesai_rental', $data);
            $this->load->view('admin/vutama', $isi);
        } else {
            $data['transaksi'] = $this->Transaksi_model->get_data_selesai_rental($_SESSION['id']);
            $isi =  $this->template->display('admin/content/transaksi/transaksi_selesai_rental');
            $this->load->view('admin/vutama', $isi);
        }

        // var_dump($data['transaksi']);
        // die();
        // $data['transaksi'] = $this->Transaksi_model->get_data_selesai_rental($_SESSION['id']);
        // $isi =  $this->template->display('admin/content/transaksi/transaksi_selesai_rental', $data);
        // $this->load->view('admin/vutama', $isi);
    }

    public function detail($id_konsumen, $id_transaksi)
    {
        $data['transaksi'] = $this->Transaksi_model->get_data_detail_transaksi($id_transaksi);
        $data['mobil'] = $this->Mobil_model->get_data_id($data['transaksi']["id_mobil"]);
        $data['user'] = $this->User_model->get_data_id($data['transaksi']["id_user"]);
        $data['perpanjangan'] = $this->Transaksi_model->get_data_detail_perpanjang($id_transaksi);
        $isi =  $this->template->display('admin/content/transaksi/detail', $data);
        $this->load->view('admin/vutama', $isi);
    }

    public function detail_pembayaran($idTransaksi)
    {
        $data['transaksi'] = $this->Transaksi_model->get_data_detail_transaksi($idTransaksi);
        $data['mobil'] = $this->Mobil_model->get_data_id($data['transaksi']["id_mobil"]);
        $data['user'] = $this->User_model->get_data_id($data['transaksi']["id_user"]);
        $isi =  $this->template->display('admin/content/transaksi/detail_pembayaran', $data);
        $this->load->view('admin/vutama', $isi);
    }

    public function detail_pembayaran_perpanjang($idTransaksi)
    {
        $data['transaksi'] = $this->Transaksi_model->get_data_detail_perpanjang($idTransaksi);
        $data['transaksis'] = $this->Transaksi_model->get_data_detail_transaksi($idTransaksi);
        $data['mobil'] = $this->Mobil_model->get_data_id($data['transaksis']["id_mobil"]);
        $data['user'] = $this->User_model->get_data_id($data['transaksis']["id_user"]);
        $isi =  $this->template->display('admin/content/transaksi/detail_pembayaran_perpanjang', $data);
        $this->load->view('admin/vutama', $isi);
    }

    function terima_transaksi($id_transaksi)
    {

        $dataTransaksi = $this->Transaksi_model->get_data_detail_transaksi($id_transaksi);

        $tokenNotif =  $this->User_model->get_data_id($this->Transaksi_model->get_data_id($id_transaksi)['id_user'])['token'];

        // $this->db->where('id_mobil', $dataTransaksi["id_mobil"]);
        // $this->db->update('tb_mobil', array('status' => 1));

        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->update('tb_transaksi', array('status' => 2));

        $msg = array(
            'title' => "Rental Mobil",
            'body' => "Transaksi Pembayaran Diterima",
            'ids' => "transaksi",
            'id' => "1"
        );

        $fields = array(
            'to' => $tokenNotif,
            'data' => $msg,
            'channel' => 'KONSUMEN_NOTIF_APPS', 'priority' => 'high'
        );
        $this->send($msg, $fields);

        redirect('transaksi');
        die();
        $tokenNotif =  $this->Konsumen_model->get_data_id($this->Transaksi_model->get_data_id($id_transaksi)['id_konsumen'])['token'];
        $data_produk = $this->Transaksi_model->get_data_transaksi($this->Transaksi_model->get_data_id($id_transaksi)['id_transaksi']);
        $status_transaksi = $this->Transaksi_model->get_data_id($id_transaksi)["status"];


        if ($status_transaksi == "0") {
            $this->db->where('id_transaksi', $id_transaksi);
            $this->db->update('tb_transaksi', array('status' => 1));
        } else if ($status_transaksi == "1") {
            foreach ($data_produk as $key) {
                $this->update_stok_produk($key);
            }
            $this->db->where('id_transaksi', $id_transaksi);
            $this->db->update('tb_transaksi', array('status' => 2));

            $msg = array(
                'title' => "TOKO JASA BARU BANGUNAN",
                'body' => "Pembayaran DiKonfirmasi, Barang Akan Segera diantar",
                'jenis' => "ids",
                'id' => "1"
            );
        } else if ($status_transaksi == "2") {
            $this->db->where('id_transaksi', $id_transaksi);
            $this->db->update('tb_transaksi', array('status' => 3));
            $msg = array(
                'title' => "TOKO JASA BARU BANGUNAN",
                'body' => "Pesanan Dalam Perjalanan",
                'jenis' => "ids",
                'id' => "1"
            );
        }

        // $fields = array(
        //     'to' => $tokenNotif,
        //     'data' => $msg,
        //     'channel' => 'KONSUMEN_NOTIF_APPS', 'priority' => 'high'
        // );
        // $this->send($msg, $fields);

        redirect('transaksi');
    }

    function terima_transaksi_perpanjangan($id_transaksi)
    {
        $tokenNotif =  $this->User_model->get_data_id($this->Transaksi_model->get_data_id($id_transaksi)['id_user'])['token'];
        $dataTransaksi = $this->Transaksi_model->get_data_detail_transaksi($id_transaksi);
        $dataTransaksiPerpanjang = $this->Transaksi_model->get_data_detail_perpanjang($id_transaksi)["tgl_kembali"];
        // $dataMobil = $this->Mobil_model->get_data_id($dataTransaksi["id_mobil"]);
        // var_dump($dataMobil);
        // die();

        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->update('tb_transaksi', array('status' => 2, 'tgl_kembali' => $dataTransaksiPerpanjang));

        $msg = array(
            'title' => "Rental Mobil",
            'body' => "Penambahan Waktu Pinjam di Konfirmasi",
            'ids' => "transaksi",
            'id' => "1"
        );

        $fields = array(
            'to' => $tokenNotif,
            'data' => $msg,
            'channel' => 'KONSUMEN_NOTIF_APPS', 'priority' => 'high'
        );
        $this->send($msg, $fields);

        redirect('transaksiproses');
    }

    function cancel_transaksi($id_transaksi)
    {
        $tokenNotif =  $this->User_model->get_data_id($this->Transaksi_model->get_data_id($id_transaksi)['id_user'])['token'];
        $dataTransaksi = $this->Transaksi_model->get_data_detail_transaksi($id_transaksi);
        // $dataMobil = $this->Mobil_model->get_data_id($dataTransaksi["id_mobil"]);
        // var_dump($dataMobil);
        // die();

        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->update('tb_transaksi', array('status' => 6));

        $msg = array(
            'title' => "Rental Mobil",
            'body' => "Transaksi Dibatalkan",
            'ids' => "transaksi",
            'id' => "1"
        );

        $fields = array(
            'to' => $tokenNotif,
            'data' => $msg,
            'channel' => 'KONSUMEN_NOTIF_APPS', 'priority' => 'high'
        );
        $this->send($msg, $fields);

        redirect('transaksibatal');
    }

    function terima_transaksi_selesai($id_transaksi)
    {
        $tokenNotif =  $this->User_model->get_data_id($this->Transaksi_model->get_data_id($id_transaksi)['id_user'])['token'];
        $idMobil = $this->Mobil_model->get_data_id($this->Transaksi_model->get_data_id($id_transaksi)['id_mobil'])['id_mobil'];

        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->update('tb_transaksi', array('status' => 3));

        $this->db->where('id_mobil', $idMobil);
        $this->db->update('tb_mobil', array('status' => 0));

        $msg = array(
            'title' => "Rental Mobil",
            'body' => "Pengembalian Dikonfirmasi, Terima Kasih",
            'ids' => "transaksi",
            'id' => "1"
        );

        $fields = array(
            'to' => $tokenNotif,
            'data' => $msg,
            'channel' => 'KONSUMEN_NOTIF_APPS', 'priority' => 'high'
        );
        $this->send($msg, $fields);

        redirect('transaksiproses');
    }

    function tolak_peminjaman()
    {
        if (isset($_POST) && count($_POST) > 0) {

            $id = $this->input->post('id');
            $alasan = $this->input->post('alasan');
            $this->db->where('id', $id);
            $this->db->update('tb_peminjaman', array('status_pinjam' => 5, 'alasan' => $alasan));

            $tokenNotif =  $this->Mahasiswa_model->get_data_id($this->Peminjaman_model->get_data_id($id)['id_mahasiswa'])['token'];
            $msg = array(
                'title' => "Perpustakaan",
                'body' => "Peminjaman Buku Anda Ditolak oleh Admin alasannya : $alasan",
                'jenis' => "ids",
                'id' => "1"
            );
            $fields = array(
                'to' => $tokenNotif,
                'data' => $msg,
                'channel' => 'KONSUMEN_NOTIF_APPS', 'priority' => 'high'
            );
            $this->send($msg, $fields);

            echo "<script>history.go(-1)</script>";
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    public function laporanTransaksi()
    {
        if (isset($_POST['tgl_dari']))
            $data['tgl_dari'] = $_POST['tgl_dari'];
        else {
            $data['tgl_dari'] = '';
        }

        if (isset($_POST['tgl_sampai']))
            $data['tgl_sampai'] = $_POST['tgl_sampai'];
        else {
            $data['tgl_sampai'] = '';
        }

        if (!empty($_REQUEST['cetak'])) {
            $data['transaksi'] = $this->Transaksi_model->get_data_laporan();
            $this->load->view('admin/content/transaksi/print', $data);
        } else if (!empty($_REQUEST['cari'])) {
            $data['transaksi'] = $this->Transaksi_model->get_data_laporan();
            $isi =  $this->template->display('admin/content/transaksi/laporan', $data);
            $this->load->view('admin/vutama', $isi);
        } else {
            $data['transaksi'] = $this->Transaksi_model->get_data_laporan();
            $isi =  $this->template->display('admin/content/transaksi/laporan', $data);
            $this->load->view('admin/vutama', $isi);
        }
    }

    public function transaksi_notif()
    {

        if (isset($_POST['view'])) {
            $this->db->select('count(*) as allcount');
            $this->db->from('tb_transaksi');
            $this->db->where('id_rental', $_SESSION['id']);
            $this->db->where('status', 0);
            $query = $this->db->get();
            $result = $query->result_array();

            $data = array(
                /*'notification' => $output,*/
                'unseen_notification'  => $result[0]['allcount'],
            );
            echo json_encode($data);
        }
    }

    public function transaksi_other_notif()
    {

        if (isset($_POST['view'])) {
            $this->db->select('count(*) as allcount');
            $this->db->from('tb_transaksi');
            $this->db->where('id_rental', $_SESSION['id']);
            $this->db->where('status', 4);
            $this->db->or_where('status', 5);
            $query = $this->db->get();
            $result = $query->result_array();

            $data = array(
                /*'notification' => $output,*/
                'unseen_notification'  => $result[0]['allcount'],
            );
            echo json_encode($data);
        }
    }

    public function return_notif()
    {

        if (isset($_POST['view'])) {
            $this->db->select('count(*) as allcount');
            $this->db->from('tb_item_transaksi');
            $this->db->where('id_rental', $_SESSION['id']);
            $this->db->where('status', 1);
            $query = $this->db->get();
            $result = $query->result_array();

            $data = array(
                /*'notification' => $output,*/
                'unseen_notification'  => $result[0]['allcount'],
            );
            echo json_encode($data);
        }
    }

    function send($msg, $fields)
    {
        $headers = array('Authorization: key=' . API_ACCESS_KEY, 'Content-Type: application/json');
        //Using curl to perform http request 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        //Getting the result 
        $result = curl_exec($ch);
        curl_close($ch);
        //Decoding json from result 
        $res = json_decode($result);
        var_dump($res);
        return $res;
    }

    function generate_key()
    {
        return str_replace("-", "", $this->uuid->v4());
    }
}
