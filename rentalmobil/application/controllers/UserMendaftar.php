<?php
defined('BASEPATH') or exit('No direct script access allowed');
define('API_ACCESS_KEY', 'AAAAJLGBF54:APA91bE7E-u5KeLYucrXU7blxdR5RG4paOP-g2nH_uF1TN-U0WTSKOhcymsD5aq311OvgOh-XkUBS3o43F2syCi1M8gYqWuPYEDthkJPIu008up6cRVkjrOqTUDmfKxAUNn_0-4Pu9VD');

class UserMendaftar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        login_timeout();
        $this->load->model('User_model');
    }

    public function index()
    {
        $data['user'] = $this->User_model->get_data_mendaftar();
        $isi =  $this->template->display('admin/content/user/index_mendaftar', $data);
        $this->load->view('admin/vutama', $isi);
    }
}
