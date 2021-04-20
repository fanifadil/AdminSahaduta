<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_Profil");
        ceklogin();
    }
    function index()
    {
        // $listing = $this->M_profil->getAll();
        $data = array(
            'title' => 'Profil',
            'isi'   => 'profil/profil',
            // 'tb_sub_menu' => $listing,
            'user'  => $this->db->get_where('tb_pegawai', ['email' => $this->session->userdata('email')])->row_array()
        );
        $this->load->view('dashboard', $data);
    }
}
