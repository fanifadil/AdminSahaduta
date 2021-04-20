<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Icdx extends CI_Model
{

    private $_table = "tb_icdx";

    //public $nama_pasien;
    public $kd_icdx;
    public $nama_icdx;

    public function getAll()
    {
        $this->datatables->select('kd_icdx , nama_icdx');
        $this->datatables->from('tb_icdx');
        return $this->datatables->generate();
    }
    public function save()
    {
        $post = $this->input->post();
        $this->no_rm = $post["kd_icdx"];
        $this->saran = $post["nama_icdx"];
        $this->db->insert($this->_table, $this);
    }
    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_komentar" => $id));
    }
}
