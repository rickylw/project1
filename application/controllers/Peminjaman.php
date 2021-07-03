<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_Peminjaman");
		$this->load->library("form_validation");
	}

	public function index()
	{
		$data["peminjaman"] = $this->M_Peminjaman->getAll();
		$this->load->view('peminjaman/index', $data);
	}

	public function tampilTambah(){
		$this->load->view('peminjaman/tambah');
	}

	public function tambah(){
		$peminjaman = $this->M_Peminjaman;
		$validation = $this->form_validation;
		$validation->set_rules($peminjaman->rules());

		if($validation->run()){
			if($peminjaman->save()){
				$this->session->set_flashdata('tambah-peminjaman-success', 'Data berhasil disimpan');
			}
			else{
				$this->session->set_flashdata('tambah-peminjaman-failed', 'Data gagal disimpan');
			}
			redirect('peminjaman/index');	
		}
		else{
			$this->load->view('peminjaman/tambah');
		}

	}

	public function tampilUbah($id){
		$data["peminjaman"] = $this->M_Peminjaman->getById($id);
		$this->load->view('peminjaman/ubah', $data);
	}

	public function ubah(){
		$peminjaman = $this->M_Peminjaman;
		$validation = $this->form_validation;
		$validation->set_rules($peminjaman->rules());

		if($validation->run()){
			if($peminjaman->update()){
				$this->session->set_flashdata('ubah-peminjaman-success', 'Data berhasil diubah');
			}
			else{
				$this->session->set_flashdata('ubah-peminjaman-failed', 'Data gagal diubah');
			}
			redirect('peminjaman/index');
			
		}
		else{
			$this->session->set_flashdata('ubah-peminjaman-failed', 'Data gagal diubah');
			redirect('peminjaman/index');
		}

	}

	public function hapus($id){
		$peminjaman = $this->M_Peminjaman;
		if($peminjaman->delete($id)){
			$this->session->set_flashdata('hapus-peminjaman-success', 'Data berhasil dihapus');
		}
		else{
			$this->session->set_flashdata('hapus-peminjaman-failed', 'Data gagal dihapus');
		}
		redirect('peminjaman/index');
	}
}
