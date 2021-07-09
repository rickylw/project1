<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("/"));
		}
		$this->load->model("M_Peminjaman");
	}

	public function index()
	{
		$peminjaman = $this->M_Peminjaman;
		$data["ruangan"] = $peminjaman->getGroupedRoom();
		$this->load->view('dashboard', $data);
	}
}
