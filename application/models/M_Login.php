<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Login extends CI_Model
{

    public function keamananLogout()
    {
        $username = $this->session->userdata('username');
        if (empty($username)) {
            $this->session->sess_destroy();
            redirect('Login');
        }
    }

    public function logout($date, $username)
    {
        $this->db->where('tb_pegawai.username', $username);
        $this->db->update('tb_pegawai', $date);
    }

    public function login($date, $username)
    {
        $this->db->where('tb_pegawai.username', $username);
        $this->db->update('tb_pegawai', $date);
    }
}
