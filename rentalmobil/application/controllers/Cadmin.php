<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cadmin extends CI_Controller {

    public function __construct()
   {
      parent::__construct();
      login_timeout();
      $this->load->model('Madmin');
   }

   public function index(){
      $data['dataadmin'] = $this->Madmin->get_data();
      $isi =  $this->template->display('admin/content/admin/index', $data);
      $this->load->view('admin/vutama',$isi);
   }

   function profil(){
      $data['datacabang'] = $this->Mcabang->get_data();  
      $data['dataadmin'] = $this->Madmin->get_data_id($this->session->userdata('id'));
      $isi =  $this->template->display('admin/content/admin/profil', $data);
      $this->load->view('admin/vutama',$isi);
  }

   
   function add(){
      if(isset($_POST) && count($_POST) > 0)     
      {
        if ($this->check_username($this->input->post('username'))) {
          $this->session->set_flashdata('error', 'Username sudah digunakan');  
          redirect('cadmin');
          die();
        }else{
          //$password = $this->random_password();
          $params = array(
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
          );
          $this->Madmin->add_admin($params);
          $this->session->set_flashdata('success', "Berhasil");  
          redirect('cadmin');        
        }
      }
  }

  function edit($id){
      if(isset($_POST) && count($_POST) > 0)     
      {
        $params = array(
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
          );
        $this->db->where('id',$id);
        $this->db->update('tb_administrator',$params);
        redirect('cadmin');
      }else{
        $data['dataadmin'] = $this->Madmin->get_data_id($id);
        $isi =  $this->template->display('admin/content/admin/edit', $data);
        $this->load->view('admin/vutama',$isi);
      }
  }

   function remove($id)
    {
      if ($id == "1") {
        $this->session->set_flashdata('gagal_hapus', "Tidak Bisa Di Hapus");  
        redirect('cadmin');
      }else{
        $this->Madmin->delete_admin($id);
        redirect('cadmin');  
      }
      
    }

    function ubahpass(){
      if(isset($_POST) && count($_POST) > 0)     
      {
        if ($this->check_pass($this->input->post('oldpassword')) == "false") {
          $this->session->set_flashdata('error', 'Password Tidak Benar');
          redirect('administrator/profil');
          die();
        }else{
          if ($this->input->post('newpassword') <> $this->input->post('newpasswordconfirm')) {
            $this->session->set_flashdata('error', 'Password Tidak Sama');
            redirect('administrator/profil');        
            die();
          }

          $params = array(
            'pass_word' => $this->input->post('newpasswordconfirm'),
          );
          $this->Madmin->edit_pass($this->session->userdata('id'),$params);
          $this->session->set_flashdata('success', "Password anda berhasil diubah");  
          redirect('administrator/profil');        
        }
      }
  }

  

  function check_username($username){
        $this->db->where('username',$username);
        $query = $this->db->get('tb_administrator');
        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }

  public function ambil_data()
  {
    $id=$this->input->post('id');
    $dataadmin = $this->Madmin->get_data_id($id);
    echo json_encode($dataadmin);
    //print $dataadmin;
    //var_dump($dataadmin);
  }

}
