<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataJari extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_DataJari");
		$this->load->library("form_validation");
	}

	public function index()
	{
		$data["datajari"] = $this->M_DataJari->getAll();
		$this->load->view('datajari/index', $data);
	}

	public function tampilTambah(){
		$this->load->view('datajari/tambah');
	}

	public function tambah(){
		$dataJari = $this->M_DataJari;
		$validation = $this->form_validation;
		$validation->set_rules($dataJari->rules());

		if($validation->run()){
			if($dataJari->save()){
				$this->session->set_flashdata('tambah-datajari-success', 'Data berhasil disimpan');
			}
			else{
				$this->session->set_flashdata('tambah-datajari-failed', 'Data gagal disimpan');
			}
			redirect('datajari/index');	
		}
		else{
			$this->load->view('datajari/tambah');
		}

	}

	public function tampilUbah($id){
		$data["datajari"] = $this->M_DataJari->getById($id);
		$this->load->view('datajari/ubah', $data);
	}

	public function ubah(){
		$dataJari = $this->M_DataJari;
		$validation = $this->form_validation;
		$validation->set_rules($dataJari->rules());

		if($validation->run()){
			if($dataJari->update()){
				$this->session->set_flashdata('ubah-datajari-success', 'Data berhasil diubah');
			}
			else{
				$this->session->set_flashdata('ubah-datajari-failed', 'Data gagal diubah');
			}
			redirect('datajari/index');
			
		}
		else{
			$this->session->set_flashdata('ubah-datajari-failed', 'Data gagal diubah');
			redirect('datajari/index');
		}

	}

	public function hapus($id){
		$dataJari = $this->M_DataJari;
		if($dataJari->delete($id)){
			$this->session->set_flashdata('hapus-datajari-success', 'Data berhasil dihapus');
		}
		else{
			$this->session->set_flashdata('hapus-datajari-failed', 'Data gagal dihapus');
		}
		redirect('datajari/index');
	}
}
