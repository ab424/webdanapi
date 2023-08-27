<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mobil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        login_timeout();
        $this->load->model('Mobil_model');
        $this->load->model('Rental_model');
    }

    public function index()
    {
        if (isset($_SESSION['search']))
            $data['search'] = $_SESSION['search'];
        else {
            $data['search'] = '';
        }

        if (isset($_SESSION['filter_kategori']))
            $data['filter_kategori'] = $_SESSION['filter_kategori'];
        else {
            $data['filter_kategori'] = '';
        }

        $data['kategori'] = $this->Rental_model->get_data();

        $data['mobil'] = $this->Mobil_model->get_data();
        $isi =  $this->template->display('admin/content/mobil/index', $data);
        $this->load->view('admin/vutama', $isi);
    }

    function add()
    {
        if (isset($_POST) && count($_POST) > 0) {

            $filename = $_FILES["foto"]["name"];
            if ($filename) {
                $foto = $this->_uploadImagep();
            } else {
                $foto = "";
            }

            $params = array(
                'id_rental' => $this->input->post('rental'),
                'nama_mobil' => $this->input->post('nama_mobil'),
                'plat_mobil' => $this->input->post('plat_mobil'),
                'merk' => $this->input->post('merk'),
                'tahun' => $this->input->post('tahun'),
                'kapasitas' => $this->input->post('kapasitas'),
                'harga' => str_replace(array('Rp', '.', ' '), '', $this->input->post('harga')),
                'warna' => $this->input->post('warna'),
                'tipe' => $this->input->post('tipe'),
                'deskripsi' => $this->input->post('deskripsi'),
                'foto' => $foto
            );
            $this->Mobil_model->add_mobil($params);
            redirect('mobil');
        } else {
            $data['rental'] = $this->Rental_model->get_data();
            $isi =  $this->template->display('admin/content/mobil/add', $data);
            $this->load->view('admin/vutama', $isi);
        }
    }

    function edit($id)
    {
        if (isset($_POST) && count($_POST) > 0) {
            $params = array(
                'id_rental' => $this->input->post('rental'),
                'nama_mobil' => $this->input->post('nama_mobil'),
                'plat_mobil' => $this->input->post('plat_mobil'),
                'merk' => $this->input->post('merk'),
                'tahun' => $this->input->post('tahun'),
                'kapasitas' => $this->input->post('kapasitas'),
                'harga' => str_replace(array('Rp', '.', ' '), '', $this->input->post('harga')),
                'warna' => $this->input->post('warna'),
                'tipe' => $this->input->post('tipe'),
                'deskripsi' => $this->input->post('deskripsi')
            );
            $this->db->where('id_mobil', $id);
            $this->db->update('tb_mobil', $params);
            redirect('mobil');
        } else {
            $data['rental'] = $this->Rental_model->get_data();
            $data['mobil'] = $this->Mobil_model->get_data_id($id);
            $isi =  $this->template->display('admin/content/mobil/edit', $data);
            $this->load->view('admin/vutama', $isi);
        }
    }

    function edit_gambar($id)
    {
        if (isset($_POST) && count($_POST) > 0) {
            $filename = $_FILES["foto"]["name"];
            if ($filename) {
                $foto = $this->_uploadImagep();
            } else {
                $foto = $this->input->post('fotonama');
            }
            $params = array(
                'foto' => $foto
            );

            $this->db->where('id_mobil', $id);
            $this->db->update('tb_mobil', $params);
            redirect('mobil');
        }
    }

    function detail($id)
    {
        $data['mobil'] = $this->Mobil_model->get_data_id($id);
        $isi =  $this->template->display('admin/content/mobil/detail', $data);
        $this->load->view('admin/vutama', $isi);
    }

    function remove($id)
    {
        $this->db->delete('tb_transaksi', array('id_mobil' => $id));
        $this->db->delete('tb_mobil', array('id_mobil' => $id));
        echo "<script>history.go(-1)</script>";
    }

    private function _uploadImagep()
    {
        $id_user = str_replace("-", "", $this->uuid->v4());
        $config['upload_path']          = 'public/images/mobil';
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

    public function search()
    {
        $search_text = $this->input->post('search');
        if ($search_text != '')
            $_SESSION['search'] = $search_text;
        else unset($_SESSION['search']);
        redirect('mobil');
    }

    public function filter_kategori()
    {
        $filter_kategori = $this->input->post('filter_kategori');
        if ($filter_kategori != '')
            $_SESSION['filter_kategori'] = $filter_kategori;
        else unset($_SESSION['filter_kategori']);
        redirect('mobil');
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
