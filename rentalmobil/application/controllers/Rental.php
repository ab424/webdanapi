<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rental extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        login_timeout();
        $this->load->model('Rental_model');
        $this->load->model('Mobil_model');
        $this->load->model('Transaksi_model');
    }

    public function index()
    {
        $data['rental'] = $this->Rental_model->get_data();
        $isi =  $this->template->display('admin/content/rental/index', $data);
        $this->load->view('admin/vutama', $isi);
    }

    function add()
    {
        $data['notif'] = "";
        if (isset($_POST) && count($_POST) > 0) {
            $this->Rental_model->add_rental($_POST);
            redirect('rental');
        } else {
            $isi =  $this->template->display('admin/content/rental/add', $data);
            $this->load->view('admin/vutama', $isi);
        }
    }

    function edit($id)
    {
        if (isset($_POST) && count($_POST) > 0) {
            $this->db->where('id', $id);
            $this->db->update('tb_rental', $_POST);
            redirect('rental');
        } else {
            $data['rental'] = $this->Rental_model->get_data_id($id);
            $isi =  $this->template->display('admin/content/rental/edit', $data);
            $this->load->view('admin/vutama', $isi);
        }
    }

    function remove($id)
    {
        $mobil = $this->Mobil_model->get_data_mobil_byrental($id);
        foreach ($mobil as $key) {
            $id_mobil = $key["id_mobil"];
            $this->db->delete('tb_mobil', array('id_mobil' => $id_mobil));
            $data_mobil = $this->Transaksi_model->get_data_transaksi_bymobil($id_mobil);
            foreach ($data_mobil as $keys) {
                // echo $keys["id_mobil"];
                $this->db->delete('tb_transaksi', array('id_mobil' => $keys["id_mobil"]));
            }
        }
        // die();
        $this->db->delete('tb_rental', array('id' => $id));
        echo "<script>history.go(-1)</script>";
    }

    function removepasienmasuk()
    {
        if (isset($_POST) && count($_POST) > 0) {
            $msg = array('title' => "Rumah Bekam Gorontalo", 'body' => "Mohon maaf, permintaan registrasi anda ditolak, karena data yang tidak lengkap", 'id' => "svvv", 'jenis' => "ids", 'sound' => 1);
            $fields = array(
                'to' => $this->Pasien_model->get_data_id($this->input->post('id'))['token'],
                'data' => $msg,
                'channel' => 'KONSUMEN_NOTIF_APPS', 'priority' => 'high'
            );
            $this->send($msg, $fields);

            $id = $this->input->post('id');
            $this->db->delete('tb_pasien', array('id' => $id));

            echo "<script>history.go(-1)</script>";
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    function pasienmasuk()
    {
        $data['pasien'] = $this->Pasien_model->get_data_masuk();
        $isi =  $this->template->display('admin/content/pasien/index_mendaftar', $data);
        $this->load->view('admin/vutama', $isi);
    }

    function detailpasien($id)
    {
        $data['pasien'] = $this->Pasien_model->get_data_id($id);
        $isi =  $this->template->display('admin/content/pasien/detail', $data);
        $this->load->view('admin/vutama', $isi);
    }

    function terima($id)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_pasien', array('status' => 1));

        $msg = array('title' => "Rumah Bekam Gorontalo", 'body' => "Akun anda sudah dikonfirmasi, Silahkan Login untuk masuk ke aplikasi", 'id' => "svvv", 'jenis' => "ids", 'sound' => 1);
        $fields = array(
            'to' => $this->Pasien_model->get_data_id($id)['token'],
            'data' => $msg,
            'channel' => 'KONSUMEN_NOTIF_APPS', 'priority' => 'high'
        );
        $this->send($msg, $fields);

        redirect('pasien');
    }

    public function pasien_mendaftar_notif()
    {

        if (isset($_POST['view'])) {
            $this->db->select('count(*) as allcount');
            $this->db->from('tb_pasien');
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


    function check_username($username)
    {
        $this->db->where('nik', $username);
        $query = $this->db->get('tb_pasien');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // public function ambil_data()
    // {
    //     $id = $this->input->post('id');
    //     $dataadmin = $this->Madmin->get_data_id($id);
    //     echo json_encode($dataadmin);
    //     //print $dataadmin;
    //     //var_dump($dataadmin);
    // }
}
