<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataJari extends CI_Controller {

	public function index()
	{
		$this->load->view('datajari/index');
	}
}
