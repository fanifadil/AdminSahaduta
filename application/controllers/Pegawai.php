<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Pegawai');
        $this->load->model('M_Login');
        $this->load->library('upload');
        ceklogin();
    }

    public function index()
    {
        // $this->M_login->keamananLogout();
        $listing = $this->M_Pegawai->getAll();
        $listing1 = $this->M_Pegawai->getStatus();
        $data = array(
            'title'      => 'Pegawai',
            'isi'         => 'pegawai/pegawai',
            'tb_pegawai' => $listing,
            'tb_status' => $listing1,
            'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()

        );
        $this->load->view('dashboard', $data);
    }

    public function add()
    {
        //validasi
        $listing = $this->M_Pegawai->getAll();
        $listing1 = $this->M_Pegawai->getStatus();
        $v = $this->form_validation;
        $v->set_rules('no_hp', 'No HP', 'required|trim|min_length[6]|max_length[13]|integer', array('required' => 'No HP belum diisi', 'min_length' => 'No Telepon Tidak Valid', 'max_length' => 'No Telepon maksimal 13 angka', 'integer' => 'No Telepon Tidak Valid'));
        $v->set_rules('NIK', 'NIK', 'required|trim|min_length[16]|max_length[16]|integer', array('required' => 'NIK belum diisi', 'min_length' => 'NIK Tidak Valid','max_length' => 'NIK Tidak Valid', 'integer' => 'NIK Tidak Valid'));
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_pegawai.username]', array('required' => 'Konfirmasi Password kosong', 'is_unique' => 'Username Telah Tersedia'));

        // Data username
        if ($v->run()) {
            $config['upload_path']  = './build/foto/'; //letak gambar upload
            $config['allowed_types'] = 'jpg|jpeg|png'; //format upload
            $config['max_size'] = '10000'; //KB
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('filefoto')) {

                $data = array(
                    'title' => 'Tambah Pegawai',
                    'isi' => 'pegawai/tambah_pegawai',
                    'error' => $this->upload->display_errors(),
                    'tb_status' => $listing1,
                    'tb_pegawai' => $listing,
                    'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
                );
                $this->load->view('dashboard', $data);

                // $this->index();
                // Masuk database
            } else {
                $upload_data                = array('uploads' => $this->upload->data());
                // Image Editor
                $config['image_library']    = 'gd2';
                $config['source_image']     = './build/foto/' . $upload_data['uploads']['file_name'];
                $config['new_image']        = './build/foto/thumb/';
                $config['create_thumb']     = TRUE;
                $config['quality']          = "100%";
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 360; // Pixel
                $config['height']           = 360; // Pixel
                $config['x_axis']           = 0;
                $config['y_axis']           = 0;
                $config['thumb_marker']     = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $i = $this->input;
                $password = $this->input->post("password");
                // $user = $this->db->get('tb_pegawai.username')->result_array();
                // if ($i->post('username') == $user) {
                //     $this->session->set_flashdata('alert', 'username sudah tersedia');
                // } else {

                // }
                $data = array(
                    'NIK'           => $i->post('NIK'),
                    'nama_pegawai'  => $i->post('nama_pegawai'),
                    'alamat'        => $i->post('alamat'),
                    'no_hp'         => $i->post('no_hp'),
                    'username'      => $i->post('username'),
                    'pass'          => password_hash($password, PASSWORD_DEFAULT),
                    'id_status'     => $i->post('id_status'),
                    'isactive'      => $i->post('isactive'),
                    'foto'          => $upload_data['uploads']['file_name']
                );
                $this->M_Pegawai->save($data);
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
                redirect('Pegawai');
            }
        } else {
            $data = array(
                'title'      => 'Tambah Pegawai',
                'isi'         => 'pegawai/tambah_pegawai',
                'tb_pegawai' => $listing,
                'tb_status' => $listing1,
                'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
            );
            $this->load->view('dashboard', $data);
        }
        // $this->index();
    }

    public function edit_pegawai($id_pegawai)
    {
        $detail = $this->M_Pegawai->detail($id_pegawai);
        $listing = $this->M_Pegawai->getAll();
        $listing1 = $this->M_Pegawai->getStatus();
        //validasi
        $v = $this->form_validation;
        $v->set_rules('no_hp', 'No HP', 'required|trim|min_length[6]|integer', array('required' => 'No HP belum diisi', 'min_length' => 'No Telepon Tidak Valid', 'integer' => 'No Telepon Tidak Valid'));
        $v->set_rules('NIK', 'NIK', 'required|trim|min_length[16]|integer', array('required' => 'NIK belum diisi', 'min_length' => 'NIK Tidak Valid', 'integer' => 'NIK Tidak Valid'));
        if ($v->run()) {
            //kalau ada gambar
            if (!empty($_FILES['filefoto']['name'])) {
                $config['upload_path']  = './build/foto/'; //letak gambar upload
                $config['allowed_types'] = 'jpg|jpeg|png'; //format upload
                $config['max_size'] = '10000'; //KB
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('filefoto')) {

                    $data = array(
                        'title' => 'Edit Pegawai',
                        'isi' => 'pegawai/edit_pegawai',
                        'error' => $this->upload->display_errors(),
                        'detail' => $detail,
                        'tb_status' => $listing1,
                        'tb_pegawai' => $listing,
                        'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
                    );
                    $this->load->view('dashboard', $data);
                    // Masuk database
                } else {
                    $upload_data                = array('uploads' => $this->upload->data());
                    // Image Editor
                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './build/foto/' . $upload_data['uploads']['file_name'];
                    $config['new_image']        = './build/foto/thumb/';
                    $config['create_thumb']     = TRUE;
                    $config['quality']          = "100%";
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 360; // Pixel
                    $config['height']           = 360; // Pixel
                    $config['x_axis']           = 0;
                    $config['y_axis']           = 0;
                    $config['thumb_marker']     = '';
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    //hapus gambar lama
                    if ($detail->foto != "") {
                        unlink('./build/foto/' . $detail->foto);
                        unlink('./build/foto/thumb/' . $detail->foto);
                    }

                    $i = $this->input;
                    $data = array(
                        'id_pegawai'    => $id_pegawai,
                        'NIK'           => $i->post('NIK'),
                        'nama_pegawai'  => $i->post('nama_pegawai'),
                        'alamat'        => $i->post('alamat'),
                        'no_hp'         => $i->post('no_hp'),
                        'username'         => $i->post('username'),
                        // 'pass'          => $i->post('password'),
                        'id_status'     => $i->post('id_status'),
                        'isactive'      => $i->post('isactive'),
                        'foto'          => $upload_data['uploads']['file_name']
                    );
                    $this->M_Pegawai->edit_pegawai($data);
                    $this->session->set_flashdata('success', 'Data Berhasil Di Ubah');
                    redirect('Pegawai');
                }
            } else {
                //update tanpa ganti gambar
                $i = $this->input;
                $data = array(
                    'id_pegawai'    => $id_pegawai,
                    'NIK'           => $i->post('NIK'),
                    'nama_pegawai'  => $i->post('nama_pegawai'),
                    'alamat'        => $i->post('alamat'),
                    'no_hp'         => $i->post('no_hp'),
                    'username'         => $i->post('username'),
                    // 'pass'          => $i->post('password'),
                    'id_status'     => $i->post('id_status'),
                    'isactive'      => $i->post('isactive')
                );
                $this->M_Pegawai->edit_pegawai($data);
                $this->session->set_flashdata('success', 'Data Berhasil Di Ubah');
                redirect('Pegawai');
            }
        } else {
            // End masuk database
            $data = array(
                'title'      => 'Edit Pegawai',
                'isi'        => 'pegawai/edit_pegawai',
                'detail'     => $detail,
                'tb_pegawai' => $listing,
                'tb_status'  => $listing1,
                'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
            );
            $this->load->view('dashboard', $data);
        }
    }

    // public function edit_pegawai()
    // {
    //     $id_pegawai =  $this->input->post('id_pegawai');
    //     $NIK = $this->input->post('NIK');
    //     $nama_pegawai = $this->input->post('nama_pegawai');
    //     $alamat = $this->input->post('alamat');
    //     $no_hp = $this->input->post('no_hp');
    //     $username = $this->input->post('username');
    //     $id_status = $this->input->post('id_status');
    //     $this->M_Pegawai->edit_pegawai($id_pegawai, $NIK, $nama_pegawai, $alamat, $no_hp, $username, $id_status);
    //     redirect('pegawai');
    // }

    public function delete($id_pegawai)
    {
        $tb_pegawai = $this->M_Pegawai->detail($id_pegawai);
        if ($tb_pegawai->foto != "") {
            unlink('./build/foto/' . $tb_pegawai->foto);
            unlink('./build/foto/thumb/' . $tb_pegawai->foto);
        }
        $id_pegawai = $this->uri->segment(3);
        $this->M_Pegawai->delete($id_pegawai);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect('Pegawai');
    }
    

    // public function delete($id = null)
    // {
    //     if (!isset($id)) show_404();

    //     if ($this->M_Pegawai->delete($id)) {
    //         $this->session->set_flashdata('success', 'Data berhasil dihapus');
    //         redirect(base_url('pegawai'));
    //     }
    // }
   

}
