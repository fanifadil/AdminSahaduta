<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_Pasien');
		$this->load->library('Datatables');
		$this->load->model('M_Login');
		ceklogin();
	}

	public function index()
	{

		$data = array(
			'title' 	 => 'Pasien',
			'isi'		 => 'pasien/list_pasien',
			'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
		);
		$this->load->view('dashboard', $data);
	}

	function get_data_json()
	{
		header('Content-Type: application/json');
		echo $this->M_Pasien->getAll();
	}

	public function add()
	{
		$cek = $this->db->query("SELECT * FROM tb_pasien where NIK ='" . $this->input->post('NIK') . "'");
		$ceknorm = $this->db->query("SELECT * FROM tb_pasien where no_rm ='" . $this->input->post('no_rm') . "'");
		$pasien = $this->M_Pasien;
		$validation = $this->form_validation;
		$validation->set_rules($pasien->rules());

		if ($validation->run() == FALSE) {
			$data = array(
				'title'   	    => 'Tambah Data Pasien',
				'isi'     		=> 'pasien/tambah_pasien',
				'tb_agama'		=> $pasien->getAgama(),
				'tb_pendidikan' => $pasien->getPendidikan(),
				'tb_pekerjaan'  => $pasien->getPekerjaan(),
				'tb_jenis_kelamin' => $pasien->getJenisKelamin(),
				'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
			);
			$this->load->view("dashboard", $data);
		} elseif ($ceknorm->num_rows() > 0) {
			$this->session->set_flashdata('failed', 'No Rm Tidak Boleh Sama');
			$data = array(
				'title'   	    => 'Tambah Data Pasien',
				'isi'     		=> 'pasien/tambah_pasien',
				'tb_agama'		=> $pasien->getAgama(),
				'tb_pendidikan' => $pasien->getPendidikan(),
				'tb_pekerjaan'  => $pasien->getPekerjaan(),
				'tb_jenis_kelamin' => $pasien->getJenisKelamin(),
				'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
			);
			$this->load->view("dashboard", $data);
		} else {
			$pasien->save();
			$this->session->set_flashdata('success', 'Berhasil disimpan');
			redirect('Pasien');
		}
	}

	public function delete($id = null)
	{
		if (!isset($id)) show_404();

		if ($this->M_Pasien->delete($id)) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect('Pasien');
		}
	}

	function edit($id)
	{
		$where = array('no_rm' => $id);
		$pasien = $this->M_Pasien->edit_data($where, 'tb_pasien')->result();
		$data = array(
			'isi'		=> 'pasien/edit_pasien',
			'title'   	=> 'Edit Data Pasien',
			'tb_agama'		=> $this->M_Pasien->getAgama(),
			'tb_pendidikan' => $this->M_Pasien->getPendidikan(),
			'tb_pekerjaan'  => $this->M_Pasien->getPekerjaan(),
			'tb_jenis_kelamin' => $this->M_Pasien->getJenisKelamin(),
			'tb_pasien' => $pasien,
			'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
		);
		$this->load->view("dashboard", $data);
	}

	function update()
	{
		$tgl_lahir = new DateTime($this->input->post('tgl_lahir'));
		$today = new DateTime('today');
		$y = $today->diff($tgl_lahir)->y;
		$m = $today->diff($tgl_lahir)->m;

		$no_rm = $this->input->post('no_rm');
		$no_rmbaru = $this->input->post('no_rmbaru');
		$nama_pasien = $this->input->post('nama_pasien');
		$tgl_lahir = date('Y-m-d', strtotime($this->input->post('tgl_lahir')));
		$umur = $y . ' Tahun ' . $m . ' Bulan';
		$alamat = $this->input->post('alamat');
		$desa = $this->input->post('desa');
		$kota = $this->input->post('kota');
		$nama_kk = $this->input->post('nama_kk');
		$agama = $this->input->post('id_agama');
		$pendidikan = $this->input->post('id_pendidikan');
		$pekerjaan = $this->input->post('id_pekerjaan');
		$jenis_kelamin = $this->input->post('id_jenis_kelamin');
		$darah = $this->input->post('darah');
		$no_hp = $this->input->post('no_hp');
		$NIK = $this->input->post('NIK');
		$password = $this->input->post('password');
		$passHash = password_hash($password, PASSWORD_DEFAULT);
		$ceknormbaru = $this->db->query("SELECT * FROM tb_pasien where no_rm ='" . $no_rmbaru . "'");

		$data = array(
			'no_rm' => $no_rmbaru,
			'nama_pasien' => $nama_pasien,
			'tgl_lahir' => $tgl_lahir,
			'umur'	=> $umur,
			'alamat' => $alamat,
			'desa' => $desa,
			'kota' => $kota,
			'nama_kk' => $nama_kk,
			'id_agama' => $agama,
			'id_pendidikan' => $pendidikan,
			'id_pekerjaan' => $pekerjaan,
			'id_jenis_kelamin' => $jenis_kelamin,
			'darah' => $darah,
			'no_hp' => $no_hp,
			'NIK' => $NIK
		);

		$datapassword = array(
			'no_rm' => $no_rmbaru,
			'nama_pasien' => $nama_pasien,
			'tgl_lahir' => $tgl_lahir,
			'umur'	=> $umur,
			'alamat' => $alamat,
			'desa' => $desa,
			'kota' => $kota,
			'nama_kk' => $nama_kk,
			'id_agama' => $agama,
			'id_pendidikan' => $pendidikan,
			'id_pekerjaan' => $pekerjaan,
			'id_jenis_kelamin' => $jenis_kelamin,
			'darah' => $darah,
			'no_hp' => $no_hp,
			'NIK' => $NIK,
			'password' => $passHash
		);

		$where = array(
			'no_rm' => $no_rm
		);

		if ($no_rm == $no_rmbaru) {
			if ($this->input->post('password') == '') {
				$this->M_Pasien->update_data($where, $data, 'tb_pasien');
				$this->session->set_flashdata('success', 'Data berhasil diedit');
				redirect('Pasien');
			} else {
				$this->M_Pasien->update_data($where, $datapassword, 'tb_pasien');
				$this->session->set_flashdata('success', 'Data berhasil diedit');
				redirect('Pasien');
			}
		} else {
			if ($ceknormbaru->num_rows() > 0) {
				$this->session->set_flashdata('failed', 'No RM Sudah Terdaftar');
				$this->edit($no_rm);
			} else {
				if ($this->input->post('password') == '') {
					$this->M_Pasien->update_data($where, $data, 'tb_pasien');
					$this->session->set_flashdata('success', 'Data berhasil diedit');
					redirect('Pasien');
				} else {
					$this->M_Pasien->update_data($where, $datapassword, 'tb_pasien');
					$this->session->set_flashdata('success', 'Data berhasil diedit');
					redirect('Pasien');
				}
			}
		}
	}
}
