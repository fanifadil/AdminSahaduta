<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Komentar extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Komentar');
		$this->load->library('form_validation');
		$this->load->library('Datatables');
		$this->load->model('M_Login');
		ceklogin();
	}

	public function index()
	{
		$data = array(
			'title' 	 => 'Komentar',
			'isi'		 => 'komentar/komentar',
			'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
		);
		$this->load->view('dashboard', $data);
	}

	public function  get_data_json()
	{
		header('Content-Type: application/json');
		echo $this->M_Komentar->getAll();
	}

	public function add()
	{
		$this->form_validation->set_rules('no_rm', 'no_rm', 'integer|trim', array('integer' => 'No RM Tidak Valid'));
		$data = array(
			'title' => 'Tambah Komentar',
			'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array(),
			'isi'   => 'komentar/tambah_komentar'
		);
		if ($this->form_validation->run() == false) {
			$this->load->view("dashboard", $data);
		} else {
			$komentar = $this->M_Komentar;
			$komentar->save();
			$this->session->set_flashdata('success', 'Berhasil disimpan');
			redirect('Komentar');
		}
	}
	public function delete($id = null)
	{
		if (!isset($id)) show_404();
		if ($this->M_Komentar->delete($id)) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect('Komentar');
		}
	}
}
