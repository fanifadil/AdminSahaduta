<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Laporan extends CI_Model
{
	public function get_laporan_semua($startDate, $endDate)
	{
		if($startDate != "" && $endDate != ""){
		$this->datatables->select('status_pasien , status_penyakit ,tb_pasien.no_rm, tb_pasien.nama_pasien, tb_pasien.tgl_lahir,tb_pasien.umur, tb_pasien.alamat, tb_pasien.nama_kk, tb_agama.agama, tb_pendidikan.pendidikan, tb_pekerjaan.pekerjaan, tb_jenis_kelamin.jenis_kelamin, tb_pasien.no_hp, tb_pasien.nik, tb_pemesanan.tgl_pemesanan, tb_pegawai.nama_pegawai');
		$this->datatables->from('tb_pemesanan');
		$this->datatables->join('tb_pasien', 'tb_pasien.no_rm = tb_pemesanan.no_rm', 'LEFT');
		$this->datatables->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_pemesanan.id_pegawai', 'LEFT');
		$this->datatables->join('tb_agama', 'tb_agama.id_agama = tb_pasien.id_agama', 'LEFT');
		$this->datatables->join('tb_pendidikan', 'tb_pendidikan.id_pendidikan = tb_pasien.id_pendidikan', 'LEFT');
		$this->datatables->join('tb_pekerjaan', 'tb_pekerjaan.id_pekerjaan = tb_pasien.id_pekerjaan', 'LEFT');
		$this->datatables->join('tb_jenis_kelamin', 'tb_jenis_kelamin.id_jenis_kelamin = tb_pasien.id_jenis_kelamin', 'LEFT');
		$this->datatables->where("tb_pemesanan.tgl_pemesanan between '$startDate' and '$endDate'");
		$this->db->order_by('tb_pemesanan.id_pemesanan');
		// $this->db->group_by('DATE(tgl_pemesanan)');
		return $this->datatables->generate();
		}else{
		$this->datatables->select('status_pasien , status_penyakit ,tb_pasien.no_rm, tb_pasien.nama_pasien, tb_pasien.tgl_lahir,tb_pasien.umur, tb_pasien.alamat, tb_pasien.nama_kk, tb_agama.agama, tb_pendidikan.pendidikan, tb_pekerjaan.pekerjaan, tb_jenis_kelamin.jenis_kelamin, tb_pasien.no_hp, tb_pasien.nik, tb_pemesanan.tgl_pemesanan, tb_pegawai.nama_pegawai');
		$this->datatables->from('tb_pemesanan');
		$this->datatables->join('tb_pasien', 'tb_pasien.no_rm = tb_pemesanan.no_rm', 'LEFT');
		$this->datatables->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_pemesanan.id_pegawai', 'LEFT');
		$this->datatables->join('tb_agama', 'tb_agama.id_agama = tb_pasien.id_agama', 'LEFT');
		$this->datatables->join('tb_pendidikan', 'tb_pendidikan.id_pendidikan = tb_pasien.id_pendidikan', 'LEFT');
		$this->datatables->join('tb_pekerjaan', 'tb_pekerjaan.id_pekerjaan = tb_pasien.id_pekerjaan', 'LEFT');
		$this->datatables->join('tb_jenis_kelamin', 'tb_jenis_kelamin.id_jenis_kelamin = tb_pasien.id_jenis_kelamin', 'LEFT');
		$this->db->order_by('tb_pemesanan.id_pemesanan');
		// $this->db->group_by('DATE(tgl_pemesanan)');
		return $this->datatables->generate();
		}
	}

	public function get_laporan_harian()
	{
		$this->datatables->select('status_pasien , status_penyakit ,tb_pasien.no_rm, tb_pasien.nama_pasien, tb_pasien.tgl_lahir,tb_pasien.umur, tb_pasien.alamat, tb_pasien.nama_kk, tb_agama.agama, tb_pendidikan.pendidikan, tb_pekerjaan.pekerjaan, tb_jenis_kelamin.jenis_kelamin, tb_pasien.no_hp, tb_pasien.nik, tb_pemesanan.tgl_pemesanan, tb_pegawai.nama_pegawai');
		$this->datatables->from('tb_pemesanan');
		$this->datatables->join('tb_pasien', 'tb_pasien.no_rm = tb_pemesanan.no_rm', 'LEFT');
		$this->datatables->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_pemesanan.id_pegawai', 'LEFT');
		$this->datatables->join('tb_agama', 'tb_agama.id_agama = tb_pasien.id_agama', 'LEFT');
		$this->datatables->join('tb_pendidikan', 'tb_pendidikan.id_pendidikan = tb_pasien.id_pendidikan', 'LEFT');
		$this->datatables->join('tb_pekerjaan', 'tb_pekerjaan.id_pekerjaan = tb_pasien.id_pekerjaan', 'LEFT');
		$this->datatables->join('tb_jenis_kelamin', 'tb_jenis_kelamin.id_jenis_kelamin = tb_pasien.id_jenis_kelamin', 'LEFT');
		// $this->datatables->order_by('tb_pemesanan.id_pemesanan', 'ASC');
		$this->datatables->where('SUBSTR(tgl_pemesanan, 1,10) = DATE(NOW())');
		$this->db->order_by('tb_pemesanan.id_pemesanan');
		return $this->datatables->generate();
	}

	public function get_laporan_mingguan()
	{
		$this->datatables->select('status_pasien , status_penyakit ,tb_pasien.no_rm, tb_pasien.nama_pasien, tb_pasien.tgl_lahir,tb_pasien.umur, tb_pasien.alamat, tb_pasien.nama_kk, tb_agama.agama, tb_pendidikan.pendidikan, tb_pekerjaan.pekerjaan, tb_jenis_kelamin.jenis_kelamin, tb_pasien.no_hp, tb_pasien.nik, tb_pemesanan.tgl_pemesanan, tb_pegawai.nama_pegawai');
		$this->datatables->from('tb_pemesanan');
		$this->datatables->join('tb_pasien', 'tb_pasien.no_rm = tb_pemesanan.no_rm', 'LEFT');
		$this->datatables->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_pemesanan.id_pegawai', 'LEFT');
		$this->datatables->join('tb_agama', 'tb_agama.id_agama = tb_pasien.id_agama', 'LEFT');
		$this->datatables->join('tb_pendidikan', 'tb_pendidikan.id_pendidikan = tb_pasien.id_pendidikan', 'LEFT');
		$this->datatables->join('tb_pekerjaan', 'tb_pekerjaan.id_pekerjaan = tb_pasien.id_pekerjaan', 'LEFT');
		$this->datatables->join('tb_jenis_kelamin', 'tb_jenis_kelamin.id_jenis_kelamin = tb_pasien.id_jenis_kelamin', 'LEFT');
		// $this->datatables->order_by('id_pemesanan', 'ASC');
		$this->datatables->where("YEARWEEK(tgl_pemesanan) = YEARWEEK(NOW())");
		$this->db->order_by('tb_pemesanan.id_pemesanan');
		return $this->datatables->generate();
	}

	public function get_laporan_bulanan()
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
		$this->datatables->select('status_pasien , status_penyakit ,tb_pasien.no_rm, tb_pasien.nama_pasien, tb_pasien.tgl_lahir,tb_pasien.umur, tb_pasien.alamat, tb_pasien.nama_kk, tb_agama.agama, tb_pendidikan.pendidikan, tb_pekerjaan.pekerjaan, tb_jenis_kelamin.jenis_kelamin, tb_pasien.no_hp, tb_pasien.nik, tb_pemesanan.tgl_pemesanan, tb_pegawai.nama_pegawai');
		$this->datatables->from('tb_pemesanan');
		$this->datatables->join('tb_pasien', 'tb_pasien.no_rm = tb_pemesanan.no_rm', 'LEFT');
		$this->datatables->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_pemesanan.id_pegawai', 'LEFT');
		$this->datatables->join('tb_agama', 'tb_agama.id_agama = tb_pasien.id_agama', 'LEFT');
		$this->datatables->join('tb_pendidikan', 'tb_pendidikan.id_pendidikan = tb_pasien.id_pendidikan', 'LEFT');
		$this->datatables->join('tb_pekerjaan', 'tb_pekerjaan.id_pekerjaan = tb_pasien.id_pekerjaan', 'LEFT');
		$this->datatables->join('tb_jenis_kelamin', 'tb_jenis_kelamin.id_jenis_kelamin = tb_pasien.id_jenis_kelamin', 'LEFT');
		$this->datatables->where("tb_pemesanan.tgl_pemesanan between '$format' and '$format2'");
		$this->db->order_by('tb_pemesanan.id_pemesanan');
		return $this->datatables->generate();
	}

	public function get_laporan_tahunan()
	{
		$tgl = '27';
		$tgl2 = '26';
		$bulan = '12';
		$bulan2 = '12';
		$tahun = date('Y') - 1;
		$tahun2 = date('Y');
		$format = $tahun . '-' . $bulan . '-' . $tgl;
		$format2 = $tahun2 . '-' . $bulan2 . '-' . $tgl2;
		$this->datatables->select('status_pasien , status_penyakit ,tb_pasien.no_rm, tb_pasien.nama_pasien, tb_pasien.tgl_lahir,tb_pasien.umur, tb_pasien.alamat, tb_pasien.nama_kk, tb_agama.agama, tb_pendidikan.pendidikan, tb_pekerjaan.pekerjaan, tb_jenis_kelamin.jenis_kelamin, tb_pasien.no_hp, tb_pasien.nik, tb_pemesanan.tgl_pemesanan, tb_pegawai.nama_pegawai');
		$this->datatables->from('tb_pemesanan');
		$this->datatables->join('tb_pasien', 'tb_pasien.no_rm = tb_pemesanan.no_rm', 'LEFT');
		$this->datatables->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_pemesanan.id_pegawai', 'LEFT');
		$this->datatables->join('tb_agama', 'tb_agama.id_agama = tb_pasien.id_agama', 'LEFT');
		$this->datatables->join('tb_pendidikan', 'tb_pendidikan.id_pendidikan = tb_pasien.id_pendidikan', 'LEFT');
		$this->datatables->join('tb_pekerjaan', 'tb_pekerjaan.id_pekerjaan = tb_pasien.id_pekerjaan', 'LEFT');
		$this->datatables->join('tb_jenis_kelamin', 'tb_jenis_kelamin.id_jenis_kelamin = tb_pasien.id_jenis_kelamin', 'LEFT');
		$this->datatables->where("tb_pemesanan.tgl_pemesanan BETWEEN '$format' AND '$format2'");
		$this->db->order_by('tb_pemesanan.id_pemesanan');
		return $this->datatables->generate();
	}

	public function get_laporan_penanganan_harian()
	{
		$this->datatables->select("pelayanan_kesehatan ,jenis_pelayanan ,tb_pemesanan.pengobatan ,tb_pemesanan.tindakan,tb_pemesanan.keadaan_keluar,tb_pemesanan.prognosa,tb_pemesanan.tgl_pemesanan, tb_pasien.no_rm, tb_pasien.nama_pasien, tb_jenis_kelamin.jenis_kelamin, tb_pasien.umur, kd_icdx, kd_icdx2, kd_icdx3, tb_pegawai.nama_pegawai");
		$this->datatables->from('tb_pemesanan');
		$this->datatables->join('tb_pasien', 'tb_pasien.no_rm = tb_pemesanan.no_rm', 'LEFT');
		$this->datatables->join('tb_diagnosa', 'tb_diagnosa.id_diagnosa = tb_pemesanan.id_diagnosa', 'LEFT');
		$this->datatables->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_pemesanan.id_pegawai', 'LEFT');
		$this->datatables->join('tb_jenis_kelamin', 'tb_jenis_kelamin.id_jenis_kelamin = tb_pasien.id_jenis_kelamin', 'LEFT');
		$this->datatables->where('SUBSTR(tgl_pemesanan, 1,10) = DATE(NOW()) && status_pemesanan IN("Sudah Dilayani","Komentar")');
		$this->db->order_by('tb_pemesanan.id_pemesanan');
		return $this->datatables->generate();
	}

	public function get_laporan_penanganan_mingguan()
	{
		$this->datatables->select("pelayanan_kesehatan ,jenis_pelayanan ,tb_pemesanan.pengobatan ,tb_pemesanan.tindakan,tb_pemesanan.keadaan_keluar,tb_pemesanan.prognosa,tb_pemesanan.tgl_pemesanan, tb_pasien.no_rm, tb_pasien.nama_pasien, tb_jenis_kelamin.jenis_kelamin, tb_pasien.umur, kd_icdx, kd_icdx2, kd_icdx3, tb_pegawai.nama_pegawai");
		$this->datatables->from('tb_pemesanan');
		$this->datatables->join('tb_pasien', 'tb_pasien.no_rm = tb_pemesanan.no_rm', 'LEFT');
		$this->datatables->join('tb_diagnosa', 'tb_diagnosa.id_diagnosa = tb_pemesanan.id_diagnosa', 'LEFT');
		$this->datatables->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_pemesanan.id_pegawai', 'LEFT');
		$this->datatables->join('tb_jenis_kelamin', 'tb_jenis_kelamin.id_jenis_kelamin = tb_pasien.id_jenis_kelamin', 'LEFT');
		// $this->datatables->order_by('id_pemesanan', 'ASC');
		$this->datatables->where("YEARWEEK(tgl_pemesanan) = YEARWEEK(NOW()) AND status_pemesanan IN('Sudah Dilayani','Komentar')");
		$this->db->order_by('tb_pemesanan.id_pemesanan');
		return $this->datatables->generate();
	}

	public function get_laporan_penanganan_bulanan()
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
		$this->datatables->select("pelayanan_kesehatan ,jenis_pelayanan ,tb_pemesanan.pengobatan ,tb_pemesanan.tindakan,tb_pemesanan.keadaan_keluar,tb_pemesanan.prognosa,tb_pemesanan.tgl_pemesanan, tb_pasien.no_rm, tb_pasien.nama_pasien, tb_jenis_kelamin.jenis_kelamin, tb_pasien.umur, kd_icdx, kd_icdx2, kd_icdx3, tb_pegawai.nama_pegawai");
		$this->datatables->from('tb_pemesanan');
		$this->datatables->join('tb_pasien', 'tb_pasien.no_rm = tb_pemesanan.no_rm', 'LEFT');
		$this->datatables->join('tb_diagnosa', 'tb_diagnosa.id_diagnosa = tb_pemesanan.id_diagnosa', 'LEFT');
		$this->datatables->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_pemesanan.id_pegawai', 'LEFT');
		$this->datatables->join('tb_jenis_kelamin', 'tb_jenis_kelamin.id_jenis_kelamin = tb_pasien.id_jenis_kelamin', 'LEFT');
		// $this->datatables->order_by('id_pemesanan', 'ASC');
		$this->datatables->where("tb_pemesanan.tgl_pemesanan between '$format' and '$format2' AND tb_pemesanan.status_pemesanan IN('Sudah Dilayani','Komentar')");
		$this->db->order_by('tb_pemesanan.id_pemesanan');
		return $this->datatables->generate();
	}

	public function get_laporan_penanganan_tahunan()
	{
		$tgl = '27';
		$tgl2 = '26';
		$bulan = '12';
		$bulan2 = '12';
		$tahun = date('Y') - 1;
		$tahun2 = date('Y');
		$format = $tahun . '-' . $bulan . '-' . $tgl;
		$format2 = $tahun2 . '-' . $bulan2 . '-' . $tgl2;
		$this->datatables->select("pelayanan_kesehatan ,jenis_pelayanan ,tb_pemesanan.pengobatan ,tb_pemesanan.tindakan,tb_pemesanan.keadaan_keluar,tb_pemesanan.prognosa,tb_pemesanan.tgl_pemesanan, tb_pasien.no_rm, tb_pasien.nama_pasien, tb_jenis_kelamin.jenis_kelamin, tb_pasien.umur, kd_icdx, kd_icdx2, kd_icdx3, tb_pegawai.nama_pegawai");
		$this->datatables->from('tb_pemesanan');
		$this->datatables->join('tb_pasien', 'tb_pasien.no_rm = tb_pemesanan.no_rm', 'LEFT');
		$this->datatables->join('tb_diagnosa', 'tb_diagnosa.id_diagnosa = tb_pemesanan.id_diagnosa', 'LEFT');
		$this->datatables->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_pemesanan.id_pegawai', 'LEFT');
		$this->datatables->join('tb_jenis_kelamin', 'tb_jenis_kelamin.id_jenis_kelamin = tb_pasien.id_jenis_kelamin', 'LEFT');
		// $this->datatables->order_by('id_pemesanan', 'ASC');
		$this->datatables->where("tb_pemesanan.tgl_pemesanan BETWEEN '$format' AND '$format2' AND status_pemesanan IN('Sudah Dilayani','Komentar')");
		$this->db->order_by('tb_pemesanan.id_pemesanan');
		return $this->datatables->generate();
	}

	public function get_laporan_penanganan_semua($startDate,  $endDate)
	{

		if($startDate != "" && $endDate != ""){
		$this->datatables->select("pelayanan_kesehatan ,jenis_pelayanan ,tb_pemesanan.pengobatan ,tb_pemesanan.tindakan,tb_pemesanan.keadaan_keluar,tb_pemesanan.prognosa,tb_pemesanan.tgl_pemesanan, tb_pasien.no_rm, tb_pasien.nama_pasien, tb_jenis_kelamin.jenis_kelamin, tb_pasien.umur, kd_icdx, kd_icdx2, kd_icdx3, tb_pegawai.nama_pegawai");
		$this->datatables->from('tb_pemesanan');
		$this->datatables->join('tb_pasien', 'tb_pasien.no_rm = tb_pemesanan.no_rm', 'LEFT');
		$this->datatables->join('tb_diagnosa', 'tb_diagnosa.id_diagnosa = tb_pemesanan.id_diagnosa', 'LEFT');
		$this->datatables->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_pemesanan.id_pegawai', 'LEFT');
		$this->datatables->join('tb_jenis_kelamin', 'tb_jenis_kelamin.id_jenis_kelamin = tb_pasien.id_jenis_kelamin', 'LEFT');
		// $this->datatables->order_by('id_pemesanan', 'ASC');
		$this->datatables->where("tb_pemesanan.tgl_pemesanan BETWEEN '$startDate' AND '$endDate' AND status_pemesanan IN('Sudah Dilayani','Komentar')");
		$this->db->order_by('tb_pemesanan.id_pemesanan');
		return $this->datatables->generate();
		} else {
			$this->datatables->select("pelayanan_kesehatan ,jenis_pelayanan ,tb_pemesanan.pengobatan ,tb_pemesanan.tindakan,tb_pemesanan.keadaan_keluar,tb_pemesanan.prognosa,tb_pemesanan.tgl_pemesanan, tb_pasien.no_rm, tb_pasien.nama_pasien, tb_jenis_kelamin.jenis_kelamin, tb_pasien.umur, kd_icdx, kd_icdx2, kd_icdx3, tb_pegawai.nama_pegawai");
		$this->datatables->from('tb_pemesanan');
		$this->datatables->join('tb_pasien', 'tb_pasien.no_rm = tb_pemesanan.no_rm', 'LEFT');
		$this->datatables->join('tb_diagnosa', 'tb_diagnosa.id_diagnosa = tb_pemesanan.id_diagnosa', 'LEFT');
		$this->datatables->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_pemesanan.id_pegawai', 'LEFT');
		$this->datatables->join('tb_jenis_kelamin', 'tb_jenis_kelamin.id_jenis_kelamin = tb_pasien.id_jenis_kelamin', 'LEFT');
		// $this->datatables->order_by('id_pemesanan', 'ASC');
		$this->datatables->where("status_pemesanan IN('Sudah Dilayani','Komentar')");
		$this->db->order_by('tb_pemesanan.id_pemesanan');
		return $this->datatables->generate();
		}
	}

	public function jumlahlaporanharian()
	{
		$queryLaporanHarian = "SELECT COUNT(id_pemesanan) as jumlah FROM tb_pemesanan WHERE";
		$row = $this->db->query($queryLaporanHarian)->row();
		return $row->kampret;
	}
	public function jumlahlaporanmingguan()
	{
		$queryLaporanMingguan = "SELECT COUNT(id_pemesanan) as jumlah FROM tb_pemesanan WHERE";
		$row = $this->db->query($queryLaporanMingguan)->row();
		return $row->kampret;
	}
}
