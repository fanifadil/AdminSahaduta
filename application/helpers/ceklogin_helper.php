<?php

function ceklogin()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('login');
    } else {
        $idStatus = $ci->session->userdata('id_status');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('tb_sub_menu', ['judul' => $menu])->row_array();
        $idMenu = $queryMenu['id_menu'];

        $userAcces = $ci->db->get_where('tb_acces_menu', [
            'id_status' => $idStatus,
            'id_menu' => $idMenu
        ]);
        if ($userAcces->num_rows() < 1) {
            redirect('login/block');
        }
    }
}

function cetak($str)
{
    echo htmlentities($str, ENT_QUOTES, 'UTF-8');
}

