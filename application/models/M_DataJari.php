<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_DataJari extends CI_Model{
    private $_table = "data_jari";

    public $id;
    public $nomor_jari;
    public $nim;
    public $nama;
    public $kelas;
    public $jurusan;
    public $angkatan;

    public function rules(){
        return [
            [
                'field' => 'nomorJari',
                'label' => 'Nomor Jari',
                'rules' => 'required'
            ],
            [
                'field' => 'nim',
                'label' => 'NIM',
                'rules' => 'required'
            ],
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required'
            ],
            [
                'field' => 'kelas',
                'label' => 'Kelas',
                'rules' => 'required'
            ],
            [
                'field' => 'jurusan',
                'label' => 'Jurusan',
                'rules' => 'required'
            ],
            [
                'field' => 'angkatan',
                'label' => 'Angkatan',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }

    public function getById($id){
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function save(){
        $post = $this->input->post();
        $this->nomor_jari = $post["nomorJari"];
        $this->nim = $post["nim"];
        $this->nama = $post["nama"];
        $this->kelas = $post["kelas"];
        $this->jurusan = $post["jurusan"];
        $this->angkatan = $post["angkatan"];
        return $this->db->insert($this->_table, $this);
    }

    public function update(){
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->nomor_jari = $post["nomorJari"];
        $this->nim = $post["nim"];
        $this->nama = $post["nama"];
        $this->kelas = $post["kelas"];
        $this->jurusan = $post["jurusan"];
        $this->angkatan = $post["angkatan"];
        return $this->db->update($this->_table, $this, array('id' => $post["id"]));
    }

    public function delete($id){
        return $this->db->delete($this->_table, array("id" => $id));
    }
}

?>