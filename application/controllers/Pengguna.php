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
		$this->load->view('pengguna/index', $data);
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

		redirect('pengguna/index');
	}

	public function tampilUbah($id){
		$data["pengguna"] = $this->M_Pengguna->getById($id);
		$this->load->view('pengguna/ubah', $data);
	}

	public function ubah(){
		$pengguna = $this->M_Pengguna;
		$validation = $this->form_validation;
		$validation->set_rules($pengguna->rules());

		if($validation->run()){
			$pengguna->update();
			$this->session->set_flashdata('ubah-pengguna-success', 'Data berhasil diubah');
		}
		else{
			$this->session->set_flashdata('ubah-pengguna-failed', 'Data gagal diubah');
		}

		redirect('pengguna/index');
	}

	public function hapus($id){
		$pengguna = $this->M_Pengguna;
		if($pengguna->delete($id)){
			$this->session->set_flashdata('hapus-pengguna-success', 'Data berhasil dihapus');
		}
		else{
			$this->session->set_flashdata('hapus-pengguna-failed', 'Data gagal dihapus');
		}
		redirect('pengguna/index');
	}
}
