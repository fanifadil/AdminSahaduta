<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pasien extends CI_Model
{

	private $_table = "tb_pasien";
	private $_table2 = "tb_agama";
	private $_table3 = "tb_pendidikan";
	private $_table4 = "tb_pekerjaan";
	private $_table5 = "tb_jenis_kelamin";

	public $no_rm;
	public $password;
	public $nama_pasien;
	public $tgl_lahir;
	public $umur;
	public $alamat;
	public $darah;
	public $nama_kk;
	public $kota;
	public $desa;
	public $id_agama;
	public $id_pendidikan;
	public $id_pekerjaan;
	public $id_jenis_kelamin;
	public $no_hp;
	public $NIK;

	public function rules()
	{
		return [
		    [
				'field' => 'no_rm',
				'label' => 'No RM',
				'rules' => 'required'
			],
			[
				'field' => 'nama_pasien',
				'label' => 'Nama Pasien',
				'rules' => 'required'
			],

			[
				'field' => 'tgl_lahir',
				'label' => 'Tanggal Lahir',
				'rules' => 'required'
			],

			[
				'field' => 'alamat',
				'label' => 'Alamat',
				'rules' => 'required'
			],

			[
				'field' => 'desa',
				'label' => 'Desa',
				'rules' => 'required'
			],

			[
				'field' => 'kota',
				'label' => 'Kota',
				'rules' => 'required'
			],

			[
				'field' => 'id_agama',
				'label' => 'Agama',
				'rules' => 'required|in_list[' . implode(array_keys($data = array("1", "2", "3", "4", "5", "6", "7")), ",") . ']'
			],

			[
				'field' => 'id_pendidikan',
				'label' => 'Pendidikan',
				'rules' => 'required'
			],

			[
				'field' => 'id_pekerjaan',
				'label' => 'Pekerjaan',
				'rules' => 'required|in_list[' . implode(array_keys($data = array("1", "2", "3", "4", "5", "6", "7" , "8")), ",") . ']'
			],

			[
				'field' => 'id_jenis_kelamin',
				'label' => 'Jenis Kelamin',
				'rules' => 'required|in_list[' . implode(array_keys($data = array("1", "2", "3")), ",") . ']'
			],

		];
	}

	//menampilkan DB
	public function getAll()
	{
		$this->datatables->select('no_rm , nama_pasien ,nama_kk,tgl_lahir,umur,alamat,desa,kota,darah,agama,pendidikan,pekerjaan,jenis_kelamin,no_hp,nik');
		$this->datatables->from('tb_pasien', 'LEFT');
		$this->datatables->join('tb_agama', 'tb_pasien.id_agama = tb_agama.id_agama',  'LEFT');
		$this->datatables->join('tb_pendidikan', 'tb_pasien.id_pendidikan = tb_pendidikan.id_pendidikan', 'LEFT');
		$this->datatables->join('tb_pekerjaan', 'tb_pasien.id_pekerjaan = tb_pekerjaan.id_pekerjaan', 'LEFT');
		$this->datatables->join('tb_jenis_kelamin', 'tb_pasien.id_jenis_kelamin = tb_jenis_kelamin.id_jenis_kelamin');
		$this->datatables->add_column('edit', anchor('Pasien/edit/$1', ' Edit', array('class' => 'btn btn-primary btn-sm fa fa-edit')), 'no_rm');
		$this->datatables->add_column('hapus', anchor('Pasien/delete/$1', ' Hapus', array('class' => 'btn btn-danger btn-sm fa fa-trash', 'onClick' => "return confirm('Apakah anda yakin ingin menghapus data ini?');")), 'no_rm');
		return $this->datatables->generate();
	}
	public function getAgama()
	{
		return $this->db->get($this->_table2)->result();
	}

	public function getPendidikan()
	{
		return $this->db->get($this->_table3)->result();
	}

	public function getPekerjaan()
	{
		return $this->db->get($this->_table4)->result();
	}

	public function getJenisKelamin()
	{
		return $this->db->get($this->_table5)->result();
	}

	public function getById($id)
	{
		return $this->db->get_where($this->_table, ["no_rm"->$id])->row();
		//select * from products where product_id=$id;
	}

	//CREAT = mengisikan data
	public function save()
	{   
	    $tgl_lahir = new DateTime($this->input->post('tgl_lahir'));
		$today = new DateTime('today');
		$y = $today->diff($tgl_lahir)->y;
		$m = $today->diff($tgl_lahir)->m;
	    
		$post = $this->input->post();
		$password = 'sahaduta';
		$this->password = password_hash($password, PASSWORD_DEFAULT);
		$this->nama_pasien = $post["nama_pasien"];
		$this->tgl_lahir = date('Y-m-d', strtotime($post["tgl_lahir"]));
		$this->umur = $y . ' Tahun ' . $m . ' Bulan';
		$this->alamat = $post["alamat"];
		$this->no_rm = $post["no_rm"];
		$this->desa = $post["desa"];
		$this->kota = $post["kota"];
		$this->nama_kk = $post["nama_kk"];
		$this->id_agama = $post["id_agama"];
		$this->id_pendidikan = $post["id_pendidikan"];
		$this->id_pekerjaan = $post["id_pekerjaan"];
		$this->id_jenis_kelamin = $post["id_jenis_kelamin"];
		$this->darah = $post["darah"];
		$this->no_hp = $post["no_hp"];
		$this->NIK = $post["NIK"];

		$this->db->insert($this->_table, $this);
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array("no_rm" => $id));
	}

	function edit_data($where, $table)
	{
		return $this->db->get_where($table, $where);
	}

	// public function edit_data($id) {

	//        $this->db->select('*');
	//        $this->db->from('tb_pasien');
	//        $this->db->where('no_rm',$id );
	//        $query = $this->db->get();
	//        return $result = $query->row_array();

	//    }

	function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	function get_jk()
	{
	    $tglsekarang = date("d");
		$tgl = '27';
		$tgl2 = '26';
		$bulan = date('m');
		$bulan2 = $bulan + 01;
		$tahun = date('Y');
		$tahun2 = date('Y');
		if ($tglsekarang < $tgl){
		    $bulan = $bulan-1;
		    $bulan2 = $bulan2-1;
		    
    		if ($bulan2 == 1) {
    			$bulan = 12;
    			$tahun = $tahun - 1;
    			$tahun2 = $tahun2 - 1;
    		}
		}
		
		if ($bulan == 12){
		    $bulan2 = '01';
		    $tahun2 = $tahun + 01;
		    if($bulan2 == 1){
		        
		    }
		}
		$format = $tahun . '-' . $bulan . '-' . $tgl;
		$format2 = $tahun2 . '-' . $bulan2 . '-' . $tgl2;
		$query = $this->db->query("SELECT id_jenis_kelamin as jk,count(id_jenis_kelamin) AS jumlah_jk FROM tb_pemesanan JOIN tb_pasien ON tb_pemesanan.no_rm=tb_pasien.no_rm WHERE tb_pemesanan.tgl_pemesanan BETWEEN '$format' AND '$format2' GROUP BY jk");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$hasil[] = $data;
			}
			return $hasil;
		}
	}
	
	function get_jk_mingguan()
	{
	    $today = date("Y-m-d");
		$startweek = '2020-01-27';
		$endweek = date('Y-m-d', strtotime('+6 days', strtotime($startweek)));
		
		if ($today <= $endweek) {
			$tempstart = $startweek;
			$tempend = $endweek;
		} else if ($today > $endweek) {
			$tempstart = date('Y-m-d', strtotime('+1 days', strtotime($endweek)));
			$tempend = date('Y-m-d', strtotime('+7 days', strtotime($endweek)));
			while ($today > $tempend) {
				$tempstart = date('Y-m-d', strtotime('+1 days', strtotime($tempend)));
				$tempend = date('Y-m-d', strtotime('+7 days', strtotime($tempend)));
			}
		}

		$tempstart;
		$tempend;
		$query = $this->db->query("SELECT id_jenis_kelamin as jk,count(id_jenis_kelamin) AS jumlah_jk FROM tb_pemesanan JOIN tb_pasien ON tb_pemesanan.no_rm=tb_pasien.no_rm WHERE tb_pemesanan.tgl_pemesanan BETWEEN '$tempstart' AND '$tempend' GROUP BY jk");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$hasil[] = $data;
			}
			return $hasil;
		}
	}
	

	function get_agama()
	{
		$query = $this->db->query("SELECT id_agama as agama,count(id_agama) AS jumlah_agama FROM tb_pasien GROUP BY agama");


		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$hasil[] = $data;
			}
			return $hasil;
		}
	}
}
