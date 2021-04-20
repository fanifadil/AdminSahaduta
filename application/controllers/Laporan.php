<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Laporan');
		$this->load->library('Datatables');
		$this->load->model('M_Login');
		ceklogin();
	}

	//laporan kunjungan semua
	public function laporan_semua()
	{
		$startDate = $this->input->post('tgl_awal');
		$endDate = $this->input->post('tgl_akhir');
		$this->session->set_userdata('startDate', $startDate);
		$this->session->set_userdata('endDate', $endDate);
		$data = array(
			'title' 	      => 'Data Laporan Kunjungan Semua',
			'isi'		 	  => 'laporan/list_laporan_kunjungan',
			'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
		);
		$this->load->view('dashboard', $data);
	}

	function kunjungan_semua()
	{
		$startDate = $this->session->userdata('startDate');
		$endDate = $this->session->userdata('endDate');
		header('Content-Type: application/json');
		echo $this->M_Laporan->get_laporan_semua($startDate, $endDate);
	}

	//laporan kunjungan harian
	public function laporan_harian()
	{
		$data = array(
			'title' 	      => 'Data Laporan Kunjungan Hari Ini',
			'isi'		 	  => 'laporan/list_laporan_kunjungan',
			'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
		);
		$this->load->view('dashboard', $data);
	}

	function kunjungan_harian()
	{
		header('Content-Type: application/json');
		echo $this->M_Laporan->get_laporan_harian();
	}

	//laporan kunjungan mingguan
	public function laporan_mingguan()
	{
		$data = array(
			'title' 	      => 'Data Laporan Kunjungan Minggu Ini',
			'isi'		 	  => 'laporan/list_laporan_kunjungan',
			'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
		);
		$this->load->view('dashboard', $data);
	}

	function kunjungan_mingguan()
	{
		header('Content-Type: application/json');
		echo $this->M_Laporan->get_laporan_mingguan();
	}

	//laporan kunjungan bulanan
	public function laporan_bulanan()
	{
		$data = array(
			'title' 	      => 'Data Laporan Kunjungan Bulan Ini',
			'isi'		 	  => 'laporan/list_laporan_kunjungan',
			'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
		);
		$this->load->view('dashboard', $data);
	}

	function kunjungan_bulanan()
	{
		header('Content-Type: application/json');
		echo $this->M_Laporan->get_laporan_bulanan();
	}

	//laporan kunjungan tahunan
	public function laporan_tahunan()
	{
		$data = array(
			'title' 	      => 'Data Laporan Kunjungan Tahun Ini',
			'isi'		 	  => 'laporan/list_laporan_kunjungan',
			'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
		);
		$this->load->view('dashboard', $data);
	}

	function kunjungan_tahunan()
	{
		header('Content-Type: application/json');
		echo $this->M_Laporan->get_laporan_tahunan();
	}


	// Laporan Pengangan


	public function laporan_penanganan_harian()
	{
		$data = array(
			'title'						=> 'Laporan Penanganan Pasien Hari Ini',
			'isi'						=> 'laporan/list_laporan_penanganan',
			'user'						=> $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
		);
		$this->load->view('dashboard', $data);
	}

	function penanganan_harian()
	{
		header('Content-Type: application/json');
		echo $this->M_Laporan->get_laporan_penanganan_harian();
	}


	public function laporan_penanganan_mingguan()
	{
		$data = array(
			'title'						=> 'Laporan Penanganan Pasien Minggu Ini',
			'isi'						=> 'laporan/list_laporan_penanganan',
			'user'						=> $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
		);
		$this->load->view('dashboard', $data);
	}

	function penanganan_mingguan()
	{
		header('Content-Type: application/json');
		echo $this->M_Laporan->get_laporan_penanganan_mingguan();
	}

	public function laporan_penanganan_bulanan()
	{
		$data = array(
			'title'						=> 'Laporan Penanganan Pasien Bulan Ini',
			'isi'						=> 'laporan/list_laporan_penanganan',
			'user'						=> $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
		);
		$this->load->view('dashboard', $data);
	}

	function penanganan_bulanan()
	{
		header('Content-Type: application/json');
		echo $this->M_Laporan->get_laporan_penanganan_bulanan();
	}


	public function laporan_penanganan_tahunan()
	{
		$data = array(
			'title'						=> 'Laporan Penanganan Pasien Tahun Ini',
			'isi'						=> 'laporan/list_laporan_penanganan',
			'user'						=> $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
		);
		$this->load->view('dashboard', $data);
	}

	function penanganan_tahunan()
	{
		header('Content-Type: application/json');
		echo $this->M_Laporan->get_laporan_penanganan_tahunan();
	}

	public function laporan_penanganan_semua()
	{
		$startDate = $this->input->post('tgl_awal');
		$endDate = $this->input->post('tgl_akhir');
		$this->session->set_userdata('startDate', $startDate);
		$this->session->set_userdata('endDate', $endDate);
		$data = array(
			'title'						=> 'Laporan Penanganan Pasien',
			'isi'						=> 'laporan/list_laporan_penanganan',
			'user'						=> $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
		);
		$this->load->view('dashboard', $data);
	}

	function penanganan_semua()
	{	
		$startDate = $this->session->userdata('startDate');
		$endDate = $this->session->userdata('endDate');
		header('Content-Type: application/json');
		echo $this->M_Laporan->get_laporan_penanganan_semua($startDate, $endDate);
	}
}
