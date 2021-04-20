<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Dashboard extends CI_Model
{
    public function jumlahPasien()
    {
        $queryPasien = "SELECT COUNT(id_pemesanan) as jumlah FROM tb_pemesanan where SUBSTR(tgl_pemesanan, 1,10) = DATE(NOW())";
        $row = $this->db->query($queryPasien)->row();
        return $row->jumlah;
    }

    function get_bulanan(){
        $tahun = date("Y");
		$tahun2 = $tahun-1;
		
		$bulan12a = $tahun2 . '-' . '12-27';//januari
		$bulan12b = $tahun . '-' . '01-26';//januari
		
		$bulan1a = $tahun . '-' . '01-27';//februari
		$bulan1b = $tahun . '-' . '02-26';//februari

		$bulan2a = $tahun . '-' . '02-27';//maret
		$bulan2b = $tahun . '-' . '03-26';//maret

		$bulan3a = $tahun . '-' . '03-27';//april
		$bulan3b = $tahun . '-' . '04-26';//april

		$bulan4a = $tahun . '-' . '04-27';//mei
		$bulan4b = $tahun . '-' . '05-26';//mei

		$bulan5a = $tahun . '-' . '05-27';//juni
		$bulan5b = $tahun . '-' . '06-26';//juni

		$bulan6a = $tahun . '-' . '06-27';//juli
		$bulan6b = $tahun . '-' . '07-26';//juli

		$bulan7a = $tahun . '-' . '07-27';//agustus
		$bulan7b = $tahun . '-' . '08-26';//agustus

		$bulan8a = $tahun . '-' . '08-27';//september
		$bulan8b = $tahun . '-' . '09-26';//september

		$bulan9a = $tahun . '-' . '09-27';//oktober
		$bulan9b = $tahun . '-' . '10-26';//oktober

		$bulan10a = $tahun . '-' . '10-27';//november
		$bulan10b = $tahun . '-' . '11-26';//november

		$bulan11a = $tahun . '-' . '11-27';//desember
		$bulan11b = $tahun . '-' . '12-26';//desember

		


		 
        $query = $this->db->query("SELECT
		ifnull((SELECT count(tgl_pemesanan) FROM (tb_pemesanan)WHERE(tgl_pemesanan BETWEEN '$bulan12a' AND '$bulan12b')),0) AS `Januari`,
		ifnull((SELECT count(tgl_pemesanan) FROM (tb_pemesanan)WHERE(tgl_pemesanan BETWEEN '$bulan1a' AND '$bulan1b')),0) AS `Februari`,
		ifnull((SELECT count(tgl_pemesanan) FROM (tb_pemesanan)WHERE(tgl_pemesanan BETWEEN '$bulan2a' AND '$bulan2b')),0) AS `Maret`,
		ifnull((SELECT count(tgl_pemesanan) FROM (tb_pemesanan)WHERE(tgl_pemesanan BETWEEN '$bulan3a' AND '$bulan3b')),0) AS `April`,
		ifnull((SELECT count(tgl_pemesanan) FROM (tb_pemesanan)WHERE(tgl_pemesanan BETWEEN '$bulan4a' AND '$bulan4b')),0) AS `Mei`,
		ifnull((SELECT count(tgl_pemesanan) FROM (tb_pemesanan)WHERE(tgl_pemesanan BETWEEN '$bulan5a' AND '$bulan5b')),0) AS `Juni`,
		ifnull((SELECT count(tgl_pemesanan) FROM (tb_pemesanan)WHERE(tgl_pemesanan BETWEEN '$bulan6a' AND '$bulan6b')),0) AS `Juli`,
		ifnull((SELECT count(tgl_pemesanan) FROM (tb_pemesanan)WHERE(tgl_pemesanan BETWEEN '$bulan7a' AND '$bulan7b')),0) AS `Agustus`,
		ifnull((SELECT count(tgl_pemesanan) FROM (tb_pemesanan)WHERE(tgl_pemesanan BETWEEN '$bulan8a' AND '$bulan8b')),0) AS `September`,
		ifnull((SELECT count(tgl_pemesanan) FROM (tb_pemesanan)WHERE(tgl_pemesanan BETWEEN '$bulan9a' AND '$bulan9b')),0) AS `Oktober`,
		ifnull((SELECT count(tgl_pemesanan) FROM (tb_pemesanan)WHERE(tgl_pemesanan BETWEEN '$bulan10a' AND '$bulan10b')),0) AS `November`,
		ifnull((SELECT count(tgl_pemesanan) FROM (tb_pemesanan)WHERE(tgl_pemesanan BETWEEN '$bulan11a' AND '$bulan11b')),0) AS `Desember` FROM tb_pemesanan GROUP BY YEAR(tgl_pemesanan=now())");
		
         
            return $query;
		}
		
	function get_penanganan_tahunan()
	{
		$tgl = '27';
		$tgl2 = '26';
		$bulan = '12';
		$bulan2 = '12';
		$tahun = date('Y') - 1;
		$tahun2 = date('Y');
		$format = $tahun . '-' . $bulan . '-' . $tgl;
		$format2 = $tahun2 . '-' . $bulan2 . '-' . $tgl2;
		$query = $this->db->query("SELECT
		((SELECT count(id_pemesanan) FROM (tb_pemesanan) WHERE(tgl_pemesanan BETWEEN '$format' AND '$format2') AND status_pemesanan IN('Komentar' , 'Sudah Dilayani') )) AS `total`,
		((SELECT count(id_jenis_kelamin) FROM (tb_pemesanan) JOIN (tb_pasien) USING (no_rm) WHERE(tgl_pemesanan BETWEEN '$format' AND '$format2') AND id_jenis_kelamin IN('1') AND status_pemesanan IN('Komentar' , 'Sudah Dilayani') )) AS `totalL`,
		((SELECT count(id_jenis_kelamin) FROM (tb_pemesanan) JOIN (tb_pasien) USING (no_rm) WHERE(tgl_pemesanan BETWEEN '$format' AND '$format2') AND id_jenis_kelamin IN('2') AND status_pemesanan IN('Komentar' , 'Sudah Dilayani') )) AS `totalP`;");
		return $query->result_array();
	}
	
	function get_penanganan_bulanan()
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
		  //  if($bulan2 == 1){
		        
		  //  }
		}
			if ($tglsekarang == 27){
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
		}
		$format = $tahun . '-' . $bulan . '-' . $tgl;
		$format2 = $tahun2 . '-' . $bulan2 . '-' . $tgl2;
		$query = $this->db->query("SELECT
		((SELECT count(id_pemesanan) FROM (tb_pemesanan) WHERE(tgl_pemesanan BETWEEN '$format' AND '$format2') AND status_pemesanan IN('Komentar' , 'Sudah Dilayani') )) AS `total`,
		((SELECT count(id_jenis_kelamin) FROM (tb_pemesanan) JOIN (tb_pasien) USING (no_rm) WHERE(tgl_pemesanan BETWEEN '$format' AND '$format2') AND id_jenis_kelamin IN('1') AND status_pemesanan IN('Komentar' , 'Sudah Dilayani') )) AS `totalL`,
		((SELECT count(id_jenis_kelamin) FROM (tb_pemesanan) JOIN (tb_pasien) USING (no_rm) WHERE(tgl_pemesanan BETWEEN '$format' AND '$format2') AND id_jenis_kelamin IN('2') AND status_pemesanan IN('Komentar' , 'Sudah Dilayani') )) AS `totalP`;");
		return $query->result_array();
	}

// 	function get_penanganan_mingguan()
// 	{
// 		$today = date("Y-m-d");
// 		$startweek = '2020-02-27';
// 		$endweek = date('Y-m-d', strtotime('+6 days', strtotime($startweek)));

// 		if ($today <= $endweek) {
// 			$tempstart = $startweek;
// 			$tempend = $endweek;
// 		} else if ($today > $endweek) {
// 			$tempstart = date('Y-m-d', strtotime('+1 days', strtotime($endweek)));
// 			$tempend = date('Y-m-d', strtotime('+7 days', strtotime($endweek)));
// 			while ($today > $tempend) {
// 				$tempstart = date('Y-m-d', strtotime('+1 days', strtotime($tempend)));
// 				$tempend = date('Y-m-d', strtotime('+7 days', strtotime($tempend)));
// 			}
// 		}

// 		$tempstart;
// 		$tempend;
// 		$query = $this->db->query("SELECT
// 		((SELECT count(id_pemesanan) FROM (tb_pemesanan) WHERE(tgl_pemesanan BETWEEN '$tempstart' AND '$tempend') AND status_pemesanan IN('Komentar' , 'Sudah Dilayani') )) AS `total`,
// 		((SELECT count(id_jenis_kelamin) FROM (tb_pemesanan) JOIN (tb_pasien) USING (no_rm) WHERE(tgl_pemesanan BETWEEN '$tempstart' AND '$tempend;') AND id_jenis_kelamin IN('1') AND status_pemesanan IN('Komentar' , 'Sudah Dilayani') )) AS `totalL`,
// 		((SELECT count(id_jenis_kelamin) FROM (tb_pemesanan) JOIN (tb_pasien) USING (no_rm) WHERE(tgl_pemesanan BETWEEN '$tempstart' AND '$tempend;') AND id_jenis_kelamin IN('2') AND status_pemesanan IN('Komentar' , 'Sudah Dilayani') )) AS `totalP`;");

// 		return $query->result_array();
// 	}

        function get_penanganan_mingguan(){
		$query = $this->db->query("SELECT
			((SELECT count(id_pemesanan) FROM (tb_pemesanan) where YEARWEEK(tgl_pemesanan) = YEARWEEK(NOW()) AND status_pemesanan IN ('Komentar','Sudah Dilayani') )) AS total,
			((SELECT count(id_jenis_kelamin) FROM (tb_pemesanan) JOIN (tb_pasien) USING (no_rm) WHERE YEARWEEK(tgl_pemesanan) = YEARWEEK(NOW()) AND id_jenis_kelamin IN('1') AND status_pemesanan IN('Komentar' , 'Sudah Dilayani') )) AS `totalL`,
			((SELECT count(id_jenis_kelamin) FROM (tb_pemesanan) JOIN (tb_pasien) USING (no_rm) WHERE YEARWEEK(tgl_pemesanan) = YEARWEEK(NOW()) AND id_jenis_kelamin IN('2') AND status_pemesanan IN('Komentar' , 'Sudah Dilayani') )) AS `totalP`;");
		return $query->result_array();
	}
		function get_toppenyakit(){

			// $this->db->select('count(id_pemesanan) as total');
			// $this->db->from('tb_pemesanan');
			// $this->db->where('MONTH(tgl_pemesanan)=MONTH(now())');
			// $query = "SELECT count(id_pemesanan) as total FROM `tb_pemesanan` WHERE MONTH(tgl_pemesanan)=MONTH(now())";
// 			$query = $this->db->query('SELECT tb_icdx.nama_icdx as penyakit, COUNT(tb_pemesanan.kd_icdx) as total FROM tb_icdx, tb_pemesanan WHERE tb_icdx.kd_icdx = tb_pemesanan.kd_icdx GROUP BY penyakit ORDER BY total DESC LIMIT 10');
            $query = $this->db->query('SELECT tb_icdx.nama_icdx as penyakit, COUNT(tb_diagnosa.kd_icdx) as total FROM tb_icdx, tb_diagnosa WHERE tb_icdx.kd_icdx = tb_diagnosa.kd_icdx GROUP BY penyakit ORDER BY total DESC LIMIT 10');
	
			return $query->result();
		}
		
		function get_rating(){

			// $this->db->select('count(id_pemesanan) as total');
			// $this->db->from('tb_pemesanan');
			// $this->db->where('MONTH(tgl_pemesanan)=MONTH(now())');
			// $query = "SELECT count(id_pemesanan) as total FROM `tb_pemesanan` WHERE MONTH(tgl_pemesanan)=MONTH(now())";
			$query = $this->db->query('SELECT tb_komentar.penilaian as rating, COUNT(tb_komentar.id_komentar) as total FROM tb_komentar GROUP BY rating ORDER BY total DESC LIMIT 5 ');
	
			return $query->result();
		}
}
