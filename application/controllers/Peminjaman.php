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

	public function exportExcel(){
		$peminjaman = $this->M_Peminjaman;
		$data["peminjaman"] = $peminjaman->getAll();

		require_once(APPPATH. 'third_party\\PHPExcel-1.8\\Classes\\PHPExcel.php');
		require_once(APPPATH. 'third_party\\PHPExcel-1.8\\Classes\\PHPExcel\\Writer\\Excel2007.php');

		$object = new PHPExcel();

		$object->getProperties()->setCreator("Admin");
		$object->getProperties()->setLastModifiedBy("Admin");
		$object->getProperties()->setTitle("Laporan Peminjaman");

		$object->setActiveSheetIndex(0);

		$object->getActiveSheet()->setCellValue('A1','No');
		$object->getActiveSheet()->setCellValue('B1','ID');
		$object->getActiveSheet()->setCellValue('C1','Nomor Jari');
		$object->getActiveSheet()->setCellValue('D1','Ruangan');
		$object->getActiveSheet()->setCellValue('E1','Waktu Masuk');
		$object->getActiveSheet()->setCellValue('F1','Waktu Keluar');

		$baris = 2;
		$no = 1;

		foreach($data["peminjaman"] as $pinjam){
			$object->getActiveSheet()->setCellValue('A'.$baris, $no++);
			$object->getActiveSheet()->setCellValue('B'.$baris, $pinjam->id);
			$object->getActiveSheet()->setCellValue('C'.$baris, $pinjam->nomor_jari);
			$object->getActiveSheet()->setCellValue('D'.$baris, $pinjam->ruangan);
			$object->getActiveSheet()->setCellValue('E'.$baris, $pinjam->waktu_masuk);
			$object->getActiveSheet()->setCellValue('F'.$baris, $pinjam->waktu_keluar);
			$baris++;
		}

		$filename = $peminjaman->now().'.xlsx';

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');

		$writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		$writer->save('php://output');

		exit;
	}

	public function exportPDF(){
		$peminjaman = $this->M_Peminjaman;
		$data["peminjaman"] = $peminjaman->getAll();

		$this->load->view('template_export/laporan_peminjaman_pdf', $data);
		$this->load->library('dompdf_gen');

		$paperSize = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paperSize, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan_mahasiswa.pdf", array('Attachment' => 0));

	}
}
