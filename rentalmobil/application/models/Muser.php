<?php

class Muser extends CI_Model
{

    private $_username;
    private $_password;

    public function __construct()
    {
        parent::__construct();
    }

    public function siteman()
    {


        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        // Cek Inputan Username dan Password
        if (empty($user) || empty($pass)) {
            $_SESSION['login'] = -1;
        } else {
            //$password = sha1($pass);

            // Jika Sudah Terisi Kirim Parameter Username ke Model Login
            $result = $this->login($user, $pass);
            if ($result) {
                // Simpan Session Username 
                $data = array(
                    'id' => $result->id,
                    'username' => $result->username,
                    'nama' => $result->nama,
                    'login' => 1,
                    'role' => "admin"
                );
                $this->session->set_userdata($data);
            } else {
                $_SESSION['login'] = -1;
            }
        }
    }

    public function sitemanrental()
    {
        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        // Cek Inputan Username dan Password
        if (empty($user) || empty($pass)) {
            $_SESSION['login'] = -1;
        } else {
            //$password = sha1($pass);

            // Jika Sudah Terisi Kirim Parameter Username ke Model Login
            $result = $this->loginrental($user, $pass);
            if ($result) {
                // Simpan Session Username 
                $data = array(
                    'id' => $result->id,
                    'username' => $result->username,
                    'nama' => $result->nama,
                    'login' => 1,
                    'role' => "rental"
                );
                $this->session->set_userdata($data);
            } else {
                $_SESSION['login'] = -1;
            }
        }
    }

    function login($username, $password)
    {

        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->limit(1);
        $query = $this->db->get('tb_administrator');
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }

    function loginrental($username, $password)
    {
        $this->db->where('no_hp', $username);
        $this->db->where('password', $password);
        $this->db->limit(1);
        $query = $this->db->get('tb_rental');
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }


    // $this->_username = $username = trim($this->input->post('username'));
    // $this->_password = $password = trim($this->input->post('password'));
    // $sql = "SELECT id, username, password, nama FROM tb_administrator WHERE username = ? AND status=1";

    // $query = $this->db->query($sql, array($username));
    //       $row = $query->row();

    // // Cek hasil query ke db, ada atau tidak data user ybs.
    // $userAda = is_object($row);
    // $pwMasihMD5 = $userAda ?
    // (
    // 	(strlen($row->pass_word) == 32) && (stripos($row->pass_word, '$') === FALSE)
    // ) : FALSE;

    // $authLolos = $pwMasihMD5
    // 	? (md5($password) == $row->pass_word)
    // 	: password_verify($password, $row->pass_word);

    // // Login gagal: user tidak ada atau tidak lolos verifikasi
    // if ($userAda === FALSE || $authLolos === FALSE)
    // {

    // 	$_SESSION['login'] = -1;

    //       }else{

    //           $data = array('id' => $row->id,
    //           				'username' => $row->u_name,
    //                           'nama' => $row->nama,
    //                           'status' => $row->status,
    //                           'id_cabang' => $row->id_cabang,
    //                           'login' => 1, 
    //                           'level' => $row->level);
    //           $this->session->set_userdata($data);
    // }



    public function logout()
    {
        unset(
            $_SESSION['email'],
            $_SESSION['nama'],
            $_SESSION['status'],
            $_SESSION['login'],
            $_SESSION['level']
        );
        $this->session->sess_destroy();
        redirect('LoginDesa');
    }
}
