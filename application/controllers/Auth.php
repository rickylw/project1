<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model("M_Pengguna");
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('/'));
	}

    public function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = array(
			'username' => $username,
			'password' => md5($password)
		);
		$cek = $this->M_Pengguna->login($data)->num_rows();
		if($cek > 0){ 
			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);
 
			$this->session->set_userdata($data_session);
 
			redirect(base_url("dashboard"));
 
		}else{
			$this->session->set_flashdata('login-failed', 'Gagal melakukan login');
			redirect(base_url("/"));
		}
    }
}
