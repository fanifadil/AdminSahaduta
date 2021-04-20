<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Icdx extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Icdx');
        $this->load->library('Datatables');
        ceklogin();
    }

    public function index()
    {
        $data = array(
            'title'      => 'Kode ICDX',
            'isi'         => 'icdx/icdx',
            'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
        );
        $this->load->view('dashboard', $data);
    }

    function get_data_json()
    {
        header('Content-Type: application/json');
        echo $this->M_Icdx->getAll();
    }

    public function add()
    {
        $icdx = $this->M_Icdx;
        $icdx->save();
        $this->session->set_flashdata('success', 'Berhasil disimpan');
        redirect('Icdx');
    }
    public function delete($id = null)
    {
        if (!isset($id)) show_404();

        if ($this->M_Icdx->delete($id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('Icdx');
        }
    }
}
