<?php

class M_Pegawai extends CI_Model
{

    private $_table = "tb_pegawai";
    private $_table1 = "tb_status";
    public $NIK;
    public $nama_pegawai;
    public $alamat;
    public $no_hp;
    public $email;
    public $pass;
    public $id_status;
    public $isactive;
    public $foto;

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('tb_pegawai');
        $this->db->join('tb_status', 'tb_pegawai.id_status = tb_status.id_status');
        $this->db->where('tb_pegawai.id_pegawai !=' , 14 );
        $query = $this->db->get();
        return $query->result();
    }
    public function getStatus()
    {
        return $this->db->get($this->_table1)->result();
    }

    public function save($data){
        $this->db->insert('tb_pegawai',$data);
    }

    public function delete($id_pegawai){
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->delete('tb_pegawai');
    }

    public function detail($id_pegawai){
        $query = $this->db->get_where('tb_pegawai',array('id_pegawai' => $id_pegawai));
        return $query->row();
    }

    public function edit_pegawai($data){
        $this->db->where('id_pegawai',$data['id_pegawai']);
        $this->db->update('tb_pegawai',$data);
    }
}
