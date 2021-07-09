<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_Pengguna extends CI_Model{
    private $_table = "user";

    public $id;
    public $username;
    public $password;
    public $nomor_telpon;
    public $alamat;

    public function rules(){
        return [
            [
                'field' => 'username',
                'label' => 'username',
                'rules' => 'required'
            ],
            [
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required'
            ],
            [
                'field' => 'konfirmasiPassword',
                'label' => 'konfirmasi password',
                'rules' => 'required|matches[password]'
            ],
            [
                'field' => 'nomorTelpon',
                'label' => 'nomor telpon',
                'rules' => 'required'
            ],
            [
                'field' => 'alamat',
                'label' => 'alamat',
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
        $this->username = $post["username"];
        $this->password = md5($post["password"]);
        $this->nomor_telpon = $post["nomorTelpon"];
        $this->alamat = $post["alamat"];
        return $this->db->insert($this->_table, $this);
    }

    public function update(){
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->username = $post["username"];
        $this->password = md5($post["password"]);
        $this->nomor_telpon = $post["nomorTelpon"];
        $this->alamat = $post["alamat"];
        return $this->db->update($this->_table, $this, array('id' => $post["id"]));
    }

    public function delete($id){
        return $this->db->delete($this->_table, array("id" => $id));
    }

    public function login($data){
        return $this->db->get_where($this->_table, $data);
    }
}

?>