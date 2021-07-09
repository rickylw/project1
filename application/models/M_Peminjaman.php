<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_Peminjaman extends CI_Model{
    private $_table = "peminjaman";

    public $id;
    public $nomor_jari;
    public $ruangan;
    public $waktu_masuk;
    public $waktu_keluar;

    public function rules(){
        return [
            [
                'field' => 'nomorJari',
                'label' => 'Nomor Jari',
                'rules' => 'required'
            ],
            [
                'field' => 'ruangan',
                'label' => 'Ruangan',
                'rules' => 'required'
            ]
        ];
    }

    public function getTable(){
        return $this->_table;
    }

    public function now(){
        $result = $this->db->query("select now() as date")->result_array();
        return $result[0]['date'];
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
        $this->ruangan = $post["ruangan"];

        if($this->db->query("select * from peminjaman where ruangan = '".$this->ruangan."' and waktu_keluar is null")->num_rows() == 0){
            return $this->db->insert($this->_table, $this);
        }
        else{
            return false;
        }

    }

    public function update(){
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->nomor_jari = $post["nomorJari"];
        $this->ruangan = $post["ruangan"];
        return $this->db->update($this->_table, $this, array('id' => $post["id"]));
    }

    public function delete($id){
        return $this->db->delete($this->_table, array("id" => $id));
    }

    public function getGroupedRoom(){
        return $this->db->query("SELECT m1.* FROM peminjaman m1 LEFT JOIN peminjaman m2 ON (m1.ruangan = m2.ruangan AND m1.id < m2.id) WHERE m2.id IS NULL")->result_array();
    }
}

?>