<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pemesanan extends CI_Model
{

	private $_table = "tb_pemesanan";

	public $id_pemesanan;
	public $no_antrian;
	public $no_rm;
	public $tgl_pemesanan;


	public function rules()
	{
		return [
			[
				'field' => 'no_rm',
				'label' => 'Nomor RM',
				'rules' => 'required'
			],


			[
				'field' => 'no_antrian',
				'label' => 'Nomor Antrian',
				'rules' => 'required'
			],

			[
				'field' => 'kode_icdx',
				'label' => 'Kode Penyakit',
				'rules' => 'required'
			],


			[
				'field' => 'keadaan_keluar',
				'label' => 'Keadaan Keluar',
				'rules' => 'required|in_list[Pulang,Rawat Inap,Rujuk]'
			],

			[
				'field' => 'prognosa',
				'label' => 'Prognosa',
				'rules' => 'required|in_list[Sembuh,Baik,Buruk,Tidak Tentu/Cenderung Sembuh,Tidak Tentu/Cenderung Baik]'
			],

		];
	}

	//menampilkan no_rm dan nama_pasien dari tb_pasien
	function get_pasien_byId($no_rm)
	{
		$hsl = $this->db->query("SELECT * FROM tb_pasien WHERE no_rm = '$no_rm'");
		if ($hsl->num_rows() > 0) {
			foreach ($hsl->result() as $data) {
				$hasil = array(
					'no_rm' => $data->no_rm,
					'nama_pasien' => $data->nama_pasien,
				);
			}
		}
		return $hasil;
	}

	//menampilkan kode_icdx dan nama_penyakit dari tb_penyakit
	function get_penyakit_byId($kd_icdx)
	{
		$hsl = $this->db->query("SELECT * FROM tb_icdx WHERE kd_icdx = '$kd_icdx'");
		if ($hsl->num_rows() > 0) {
			foreach ($hsl->result() as $data) {
				$hasil = array(
					'kd_icdx' => $data->kd_icdx,
					'nama_icdx' => $data->nama_icdx,
				);
			}
		}
		return $hasil;
	}

	//nomor antrian auto increment dimodal
	public function get_noAntrian()
	{
		$query = "SELECT max(no_antrian) as auto FROM tb_pemesanan WHERE tgl_pemesanan=CURDATE() ";
		$data = $this->db->query($query)->row_array();
		$max = $data['auto'];
		$kodecount = $max + 1;
		return $kodecount;
	}

	//menampilkan data pasien yang antri hari ini
	public function getAll_antri()
	{
		$this->db->select('tb_pemesanan.*, tb_pasien.nama_pasien, tb_jenis_kelamin.jenis_kelamin');
		$this->db->from('tb_pemesanan');
		$this->db->join('tb_pasien', 'tb_pasien.no_rm = tb_pemesanan.no_rm', 'LEFT');
		$this->db->join('tb_jenis_kelamin', 'tb_jenis_kelamin.id_jenis_kelamin = tb_pasien.id_jenis_kelamin', 'LEFT');
		$this->db->order_by('id_pemesanan', 'ASC');
		$this->db->where('tgl_pemesanan = CURDATE()');
		$query = $this->db->get();
		return $query->result();
	}

	//menampilkan jumlah nomor antrian berdasarkan hari ini
	public function nomorAntrian()
	{
		$this->db->select('COUNT(no_antrian) as count');
		$this->db->from('tb_pemesanan');
		$this->db->where('tgl_pemesanan = CURDATE()');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->count;
		}
		return 0;
	}

	//menampilkan jumlah nomor antrian yang sudah dilayani
	public function antrianDilayani()
	{
		$this->db->select('COUNT(no_antrian) as count');
		$this->db->from('tb_pemesanan');
		$this->db->where('tgl_pemesanan = CURDATE() && status_pemesanan = "Sudah Dilayani"');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->count;
		}
		return 0;
	}

	//menampilkan jumlah nomor antrian yang status komentar
	public function antrianDilayani1()
	{
		$this->db->select('COUNT(no_antrian) as count');
		$this->db->from('tb_pemesanan');
		$this->db->where('tgl_pemesanan = CURDATE() && status_pemesanan = "Komentar"');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->count;
		}
		return 0;
	}

	//menyimpan data isian pemesanan
	public function save()
	{
		$post = $this->input->post();
		$this->no_antrian = $post["no_antrian"];
		$this->no_rm = $post["no_rm"];
		$this->tgl_pemesanan = date("Y-m-d");
		$this->waktu_pemesanan = date("H:i:s");
		$this->id_pegawai = $post["id_pegawai"];
		$this->pemesan = "Offline";
		$this->db->insert($this->_table, $this);
	}

	public function auto_id(){
        $ab = "dg"."-";
        $bc = date("YmdHis");
        $cd = $ab.$bc;
        return $cd;
    }

	//menyimpan kode penyakit ke tb_diagnosa
	public function save_diagnosa(){
		$post = $this->input->post();
		if($post["kd_icdx"] !="" && $post["kd_icdx2"] == "" && $post["kd_icdx3"] == ""){
			$data = array("id_diagnosa" => $post["id_diagnosa"],
		 				  "kd_icdx" 	=> $post["kd_icdx"]
		 			);
		}else if($post["kd_icdx"] !="" && $post["kd_icdx2"] != "" && $post["kd_icdx3"] == ""){
			$data = array("id_diagnosa" => $post["id_diagnosa"],
						  "kd_icdx"		=> $post["kd_icdx"],
						  "kd_icdx2"	=> $post["kd_icdx2"]
					);
		}else if($post["kd_icdx"] !="" && $post["kd_icdx2"] == "" && $post["kd_icdx3"] != ""){
			$data = array("id_diagnosa" => $post["id_diagnosa"],
						  "kd_icdx"		=> $post["kd_icdx"],
						  "kd_icdx3"	=> $post["kd_icdx3"]
					);
		}else{
			$data = array("id_diagnosa" => $post["id_diagnosa"],
						  "kd_icdx"		=> $post["kd_icdx"],
						  "kd_icdx2"	=> $post["kd_icdx2"],
						  "kd_icdx3"	=> $post["kd_icdx3"]
					);
		}

		$this->db->insert("tb_diagnosa", $data);
	}

	//tampil data pemesanan berdasarkan id_pemesanan
	public function detail_diagnosa($id)
	{
		$this->db->select('tb_pemesanan.*, tb_pasien.nama_pasien');
		$this->db->from('tb_pemesanan');
		$this->db->join('tb_pasien', 'tb_pasien.no_rm = tb_pemesanan.no_rm');
		$this->db->where(array('id_pemesanan' => $id));
		$query = $this->db->get();
		return $query->row();
	}

	//update data diagnosa
	function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	//hapus data berdasarkan id_pemesanan
	public function delete($id)
	{
		return $this->db->delete($this->_table, array("id_pemesanan" => $id));
	}

}
