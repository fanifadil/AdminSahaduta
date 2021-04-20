<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Dashboard');
		$this->load->model('M_Login');
		$this->load->model('M_Komentar');
		$this->load->model('M_Laporan');
		$this->load->model('M_Pasien');
		ceklogin();
	}

	function top_penyakit(){
		$data= $this->M_Dashboard->get_toppenyakit();
		echo json_encode($data);
	}
	
	public function index()
	{		
		$data = array(
			'title' => 'Dashboard',
			// 'kunjungan' => $this->M_pasien->get_kunjungan()->result(),
			'data' => $this->M_Pasien->get_jk(),
			'data2' => $this->M_Komentar->get_rating(),
			'data3' => $this->M_Dashboard->get_bulanan()->result_array(),
			'isi' => 'dashboard/dashboard_1',		
			'jumlah'		=> $this->M_Komentar->jumlahKomentar(),
			'jmlPasien'		=> $this->M_Dashboard->jumlahPasien(),
			'penangananbulanan' =>  $this->M_Dashboard->get_penanganan_bulanan(),
			'penangananmingguan' =>  $this->M_Dashboard->get_penanganan_mingguan(),
			'penanganantahunan' =>  $this->M_Dashboard->get_penanganan_tahunan(),
			'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
		);
		$this->load->view('dashboard', $data);

		
	}
}