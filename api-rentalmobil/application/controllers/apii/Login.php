<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Login extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
	}

	public function login_post()
	{
		$user = $this->post('user');
		$pass = $this->post('pass');
		$token = $this->post('token');

		$login = $this->Login_model->is_valid_login($user, $pass);

		if ($login) {
			$this->db->where('no_hp', $user);
			$this->db->update('tb_user', array('token' => $token));

			$this->response([
				'status' => true,
				'message' => 'sukses menampilkan data',
				'payload' => $login
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'gagal menampilkan data',
				'payload' => null
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function registrasi_post()
	{
		$filename = $_FILES["foto"]["name"];
		if ($filename) {
			$foto = $this->_uploadImagep();
		} else {
			$foto = "";
		}

		$pass_w = $this->random_password();
		$params = array(
			'nama' => $this->input->post('nama'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
			'pekerjaan' => $this->input->post('pekerjaan'),
			'nik' => $this->input->post('nik'),
			'norek' => $this->input->post('norek'),
			'nama_bank' => $this->input->post('nama_bank'),
			'nama_rekening' => $this->input->post('nama_rekening'),
			'foto_ktp' => $foto,
			'token' => $this->input->post('token'),
			// 'tgl_create' => date('Y-m-d H:i:s'),
			'password' => $pass_w
		);

		if ($this->check_sudah_regis($this->post('no_hp'))) {
			$regis = false;
		} else {
			$regis = $this->Login_model->is_valid_regis($params);
		}


		if ($regis) {
			$this->response([
				'status' => true,
				'message' => 'Registrasi Berhasil, Tunggu Notifikasi Konfirmasi dari Admin',
				'password' => $pass_w
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'gagal menampilkan data',
				'password' => null
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	function check_sudah_regis($nomor)
	{
		$this->db->where('no_hp', $nomor);
		$query = $this->db->get('tb_user');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function ubahpass_post()
	{
		$params = array(
			'password' => $this->post('password')
		);

		$this->db->where('id', $this->post('id'));
		$this->db->update('tb_user', $params);

		if ($params) {
			$this->response(
				[
					'status' => true,
					'message' => 'sukses menampilkan data',
					'payload' => "Sukses"
				],
				200
			);
		} else {

			$this->response([
				'status' => true,
				'message' => 'gagal menampilkan data',
				'payload' => null
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	function random_password()
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$password = array();
		$alpha_length = strlen($alphabet) - 1;
		for ($i = 0; $i < 6; $i++) {
			$n = rand(0, $alpha_length);
			$password[] = $alphabet[$n];
		}
		return implode($password);
	}

	private function _uploadImagep()
	{
		$id_user = str_replace("-", "", $this->uuid->v4());
		$config['upload_path']          = 'public/ktp';
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
