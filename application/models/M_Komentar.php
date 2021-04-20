<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Komentar extends CI_Model
{

    private $_table = "tb_komentar";
    public $no_rm;
    public $kritik;
    public $saran;
    public $penilaian;

    public function getAll()
    {
        $this->datatables->select('tb_komentar.tgl_komentar,tb_komentar.id_komentar, tb_komentar.no_rm , tb_pasien.nama_pasien , tb_komentar.kritik , tb_komentar.saran , tb_komentar.penilaian');
        $this->datatables->from('tb_komentar');
        $this->datatables->join('tb_pasien','tb_pasien.no_rm = tb_komentar.no_rm','id_komentar','DESC');
        //$this->datatables->where('id_komentar','DESC');
        //$this->datatables->orderby('id_komentar','DESC');
        $this->datatables->add_column('action', anchor('Komentar/delete/$1', ' Hapus', array('class' => 'btn btn-danger btn-sm fa fa-trash', 'onClick' => "return confirm('Apakah anda yakin ingin menghapus data ini?');")), 'id_komentar');
        return $this->datatables->generate();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->no_rm = $post["no_rm"];
        $this->saran = $post["saran"];
        $this->kritik = $post["kritik"];
        $this->penilaian = $post["penilaian"];
        $this->tgl_komentar = date('Y-m-d');
        $this->db->insert($this->_table, $this);
    }
    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_komentar" => $id));
    }

    public function jumlahKomentar()
    {
        $queryKomentar = "SELECT COUNT(id_komentar) as jumlah FROM tb_komentar";
        $row = $this->db->query($queryKomentar)->row();
        return $row->jumlah;
    }
    
    function get_rating()
	{
		$query = $this->db->query("SELECT tb_komentar.penilaian as rating, COUNT(tb_komentar.id_komentar) as total FROM tb_komentar GROUP BY rating ");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data2) {
				$hasil[] = $data2;
			}
			return $hasil;
		}
	}
}
