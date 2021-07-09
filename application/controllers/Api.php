<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model("M_Peminjaman");
		$this->load->helper("date");
	}

	//Input = nomor_jari dan ruangan
	public function tambahPeminjaman()
	{
		$peminjaman = $this->M_Peminjaman;

        if($peminjaman->save()){
			$data = [
				'id' => $peminjaman->db->insert_id(),
				'ruangan' => $peminjaman->ruangan
			];

			echo json_encode([
				'success' => 1,
				'message' => 'Success',
				'data' => $data
			]);
        }
        else{
            echo json_encode([
				'success' => 0,
				'message' => 'Gagal'
			]);
        }
	}

	//Input = id
	public function selesaiPeminjaman($id){
		$peminjaman = $this->M_Peminjaman;
		$pinjam = $peminjaman->getById($id);

		if($pinjam !== null){
			if($pinjam->waktu_keluar === null){
				$pinjam->waktu_keluar = $peminjaman->now();
				if($peminjaman->db->update($peminjaman->getTable(), $pinjam, array('id' => $id))){
					$data = [
						'id' => $id,
						'ruangan' => $pinjam->ruangan
					];
					echo json_encode([
						'success' => 1,
						'message' => 'Success',
						'data' => $data
					]);
				}
				else{
					echo json_encode([
						'success' => 0,
						'message' => 'Gagal'
					]);
				}
			}
			else{
				echo json_encode([
					'success' => 0,
					'message' => 'Gagal'
				]);
			}
			
		}
		else{
            echo json_encode([
				'success' => 0,
				'message' => 'Gagal'
			]);
		}
	}
}
