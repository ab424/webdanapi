<?php
defined('BASEPATH') or exit('No direct script access allowed');
define('API_ACCESS_KEY', 'AAAAJLGBF54:APA91bE7E-u5KeLYucrXU7blxdR5RG4paOP-g2nH_uF1TN-U0WTSKOhcymsD5aq311OvgOh-XkUBS3o43F2syCi1M8gYqWuPYEDthkJPIu008up6cRVkjrOqTUDmfKxAUNn_0-4Pu9VD');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        login_timeout();
        $this->load->model('User_model');
    }

    public function index()
    {
        $data['user'] = $this->User_model->get_data();
        $isi =  $this->template->display('admin/content/user/index', $data);
        $this->load->view('admin/vutama', $isi);
    }

    function index_mendaftar()
    {
        $data['user'] = $this->User_model->get_data_masuk();
        $isi =  $this->template->display('admin/content/user/index_mendaftar', $data);
        $this->load->view('admin/vutama', $isi);
    }

    function remove()
    {
        if (isset($_POST) && count($_POST) > 0) {
            $id = $this->input->post('id');
            $this->db->delete('tb_pasien', array('id' => $id));
            echo "<script>history.go(-1)</script>";
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    function removeusermasuk($id)
    {

        $msg = array(
            'title' => "Rental Mobil",
            'body' => "Mohon maaf, permintaan registrasi anda ditolak, karena data yang tidak lengkap",
            'id' => "svvv",
            'pesan' => "Mohon maaf, permintaan registrasi anda ditolak, karena data yang tidak lengkap",
            'password' => "",
            'ids' => "akun",
            'sound' => 1
        );

        $fields = array(
            'to' => $this->User_model->get_data_id($id)['token'],
            'data' => $msg,
            'channel' => 'KONSUMEN_NOTIF_APPS', 'priority' => 'high'
        );
        $this->send($msg, $fields);

        $this->db->delete('tb_user', array('id' => $id));

        echo "<script>history.go(-1)</script>";
    }

    function detail($id)
    {
        $data['user'] = $this->User_model->get_data_id($id);
        $isi =  $this->template->display('admin/content/user/detail', $data);
        $this->load->view('admin/vutama', $isi);
    }

    function terima($id)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_user', array('status' => 1));

        $msg = array(
            'title' => "Rental Mobil",
            'body' => "Akun anda sudah dikonfirmasi",
            'id' => "svvv",
            'pesan' => "Akun anda telah dikonfirmasi oleh Admin, Silahkan salin password di bawah untuk Login Ke Aplikasi",
            'password' => $this->User_model->get_data_id($id)['password'],
            'ids' => "akun",
            'sound' => 1
        );

        $fields = array(
            'to' => $this->User_model->get_data_id($id)['token'],
            'data' => $msg,
            'channel' => 'KONSUMEN_NOTIF_APPS', 'priority' => 'high'
        );
        $this->send($msg, $fields);

        redirect('mendaftar');
    }

    public function user_mendaftar_notif()
    {

        if (isset($_POST['view'])) {
            $this->db->select('count(*) as allcount');
            $this->db->from('tb_user');
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

    function testkirim()
    {
        $msg = array('title' => "Rumah Bekam Gorontalo", 'body' => "konfirmasi ssssss", 'id' => "svvv", 'ids' => "akun", 'sound' => 1);

        $fields = array(
            //'registration_ids' => $reg_token,
            //'to' => '/topics/news',
            'to' => "eMw4F8aET_ehm_bEweHWav:APA91bGyBnaYzjv0a4oba4RFMRk7jOy_Sc6hgl8TMklD30HaCdwcdJNn1lYQ9apjpuCM40b9nv-h4tdu_C29qVzT6ccGy0VFfOO9y-09VqNqthgsx-v5tyEzltLfTaD1GRQWhXPy8eCI",
            //'notification' => $msg,
            'data' => $msg,
            'channel' => 'KONSUMEN_NOTIF_APPS', 'priority' => 'high'
        );

        $this->send($msg, $fields);
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
        // var_dump($res);
        return $res;
    }
}
