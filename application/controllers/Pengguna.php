<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_Pengguna");
		$this->load->library("form_validation");
	}

	public function index()
	{
		$data["pengguna"] = $this->M_Pengguna->getAll();
		$this->load->view('pengguna/index', $pengguna);
	}

	public function tampilTambah(){
		$this->load->view('pengguna/tambah');
	}

	public function tambah(){
		$pengguna = $this->M_Pengguna;
		$validation = $this->form_validation;
		$validation->set_rules($pengguna->rules());

		if($validation->run()){
			$pengguna->save();
			$this->session->set_flashdata('tambah-pengguna-success', 'Data berhasil disimpan');
		}
		else{
			$this->session->set_flashdata('tambah-pengguna-failed', 'Data gagal disimpan');
		}

		$this->load->view("pengguna/index");
	}
}
