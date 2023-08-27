<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        login_timeout();
        $this->load->model('Jadwal_model');
        $this->load->model('Pasien_model');
        $this->load->model('Rekam_model');
    }

    public function index()
    {
        // $data['laporan'] = $this->Laporan_model->get_data(1);
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
            $data['laporan'] = $this->Jadwal_model->get_data_laporan();
            $this->load->view('admin/content/laporan/print', $data);
        } else if (!empty($_REQUEST['cari'])) {
            $data['laporan'] = $this->Jadwal_model->get_data_laporan();
            $isi =  $this->template->display('admin/content/laporan/index', $data);
            $this->load->view('admin/vutama', $isi);
        } else {
            $isi =  $this->template->display('admin/content/laporan/index', $data);
            $this->load->view('admin/vutama', $isi);
        }
    }

    function add()
    {
        if (isset($_POST) && count($_POST) > 0) {

            $params = array(
                'nama_laporan' => $this->input->post('nama'),
                "tgl" => $this->input->post('tgl'),
                "jenis_laporan" => $this->input->post('jenis_laporan')
            );

            $ok = $this->Laporan_model->add_dokumen($params);
            if (!$ok) {
                $this->session->set_flashdata('eror_file', 'Gagal.!! File harus berekstensi (*pdf).');
                echo "<script>history.go(-1)</script>";
            } else {
                $this->session->set_flashdata('sukses_file', 'Sukses.!! Data Berhasil Diinputkan');
                echo "<script>history.go(-2)</script>";
            }
        } else {
            //$data['datacabang'] = $this->Mcabang->get_data();
            $isi =  $this->template->display('admin/content/laporan/add');
            $this->load->view('admin/vutama', $isi);
        }
    }

    public function edit($id)
    {
        if (isset($_POST) && count($_POST) > 0) {
            $params = array(
                'nama_laporan' => $this->input->post('nama'),
                "tgl" => $this->input->post('tgl')
            );
            $ok = $this->Laporan_model->update_dokumen($id, $params);
            if (!$ok) {
                $this->session->set_flashdata('eror_file', 'Gagal.!! File harus berekstensi (*pdf).');
                echo "<script>history.go(-1)</script>";
            } else {
                $this->session->set_flashdata('sukses_file', 'Sukses.!! Data Berhasil Diupdate');
                echo "<script>history.go(-2)</script>";
            }
        } else {
            $data['laporan'] = $this->Laporan_model->get_data_id($id);
            $isi =  $this->template->display('admin/content/laporan/edit', $data);
            $this->load->view('admin/vutama', $isi);
        }
    }

    function detail($id)
    {
        if (isset($_POST) && count($_POST) > 0) {
            $data = $_POST['image'];
            if ($data == "") {
                $id_user = str_replace(".png", "", $this->input->post('foto'));
            } else {
                $id_user = $this->generate_key();
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $imageName = $id_user . '.png';
                file_put_contents('public/img/ikm/' . $imageName, $data);
            }

            $params = array(
                'nm_ikm' => $this->input->post('nm_ikm'),
                'nm_pemilik' => $this->input->post('nm_pemilik'),
                'jenis_usaha' => $this->input->post('jenis_usaha'),
                'latitude' => $this->input->post('latitude'),
                'longitude' => $this->input->post('longitude'),
                'alamat' => $this->input->post('alamat'),
                'kontak' => $this->input->post('kontak'),
                'deskripsi_usaha' => $this->input->post('deskripsi_usaha'),
                'foto' => $id_user . '.png',
            );
            $this->db->where('id', $this->input->post('idikm'));
            $this->db->update('tb_ikm', $params);
            $this->session->set_flashdata('success', "Data berhasil diubah");
        } else {
            $data['ikm'] = $this->Mikm->get_data_id($id);
            $data['produk'] = $this->Mproduk->get_data_detail($id);
            $isi =  $this->template->display('admin/content/ikm/detail', $data);
            $this->load->view('admin/vutama', $isi);
        }
    }

    public function remove()
    {
        if (isset($_POST) && count($_POST) > 0) {
            $id = $this->input->post('id_laporan');
            $this->Laporan_model->delete_dokumen($id);
            echo "<script>history.go(-1)</script>";
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    function generate_key()
    {
        return str_replace("-", "", $this->uuid->v4());
    }
}
