<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Pemesanan');
        $this->load->model('M_Login');
        ceklogin();
    }

    public function index()
    {
        $listing = $this->M_Pemesanan->getAll_antri();  //Meload data pemesanan dari tabel pemesanan
        $no_antrian = $this->M_Pemesanan->get_noAntrian();  //auto increment no_antrian sesuai database
        $antri = $this->M_Pemesanan->nomorAntrian();    //Total antrean
        $validation = $this->form_validation;   //FORM VALIDATION
        $validation->set_rules('no_rm', 'No_RM', 'required', array('required' => '<h2>Nomor RM harus diisi</h2>')); //kondisi rules sesuai di model

        if ($validation->run() === FALSE) {
            $data = array(
                'title'        => 'Pemesanan',   //judul halaman
                'isi'          => 'pemesanan/list_pemesanan',   //load view yang ditampilkan
                'tb_pemesanan' => $listing,   //variabel "tb_pemesanan" yg dipakai meload data dari tabel
                'no_antrian'   => $no_antrian, //variabel "no_antrian" yg dipakai untuk auto increment no_antrian
                'antri'        => $antri, //variabel yg dipakai untuk menampilkan total antrean
                'dilayani'     => $this->M_Pemesanan->antrianDilayani() + $this->M_Pemesanan->antrianDilayani1(), //variabel yg dipakai untuk menampilkan jumlah pasien yang sudah dilayani
                'user'         => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
            );
            $this->load->view('dashboard', $data); //memuat view modul template
        } else {
            $cek = $this->db->query("SELECT * FROM tb_pemesanan where tgl_pemesanan=curdate() && status_pemesanan='Belum Dilayani' && no_rm ='" . $this->input->post('no_rm') . "'");
            $adaPasien = $this->db->query("SELECT * FROM tb_pasien where no_rm ='" . $this->input->post('no_rm') . "'");
            $batas1 = date('H:i:s', strtotime('13:00:00'));
            $batas2 = date('H:i:s', strtotime('16:00:00'));
            $sekarang = date('H:i:s');

            if ($cek->num_rows() >= 1) {
                $this->session->set_flashdata('error', '<h2>Nomor RM <strong>' . $this->input->post('no_rm') . '</strong> sudah antri, Silakan isi Nomor RM lain !</h2>');
                redirect('Pemesanan');
            } else if ($adaPasien->num_rows() == 0) {
                $this->session->set_flashdata('error', '<h2>Nomor RM <strong>' . $this->input->post('no_rm') . '</strong> belum terdaftar, Silakan isi Nomor RM yang sudah terdaftar !</h2>');
                redirect('Pemesanan');
            } else if ($sekarang > $batas1 && $sekarang < $batas2) {
                $this->session->set_flashdata('error', '<h2>Antrian dibuka kembali pukul 16.00 WIB</h2>');
                redirect('Pemesanan');
            } else {
                //masuk database
                $this->M_Pemesanan->save(); //simpan data
                $this->session->set_flashdata('success', '<strong><h2>Berhasil menambah antrian</h2></strong>');  //tampilkan pesan sukses
                redirect('Pemesanan');  //mengarahkan halaman ke controller pemesanan
            }
        }
        $this->load->view('vendor/autoload.php');
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            'a1e095bed9535a20e287',
            '338c42efee9dfe3b940a',
            '874582',
            $options
        );

        $data['message'] = 'halo';
        $pusher->trigger('my-channel', 'my-event', $data);
    }

    //hapus data berdasarkan id_pemesanan
    public function delete($id = null)
    {
        if (!isset($id)) show_404();

        if ($this->M_Pemesanan->delete($id)) {
            $this->session->set_flashdata('success', '<strong><h2>Data berhasil dihapus</h2></strong>');
            redirect(base_url('pemesanan'));
        }
        $this->load->view('vendor/autoload.php');
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            'a1e095bed9535a20e287',
            '338c42efee9dfe3b940a',
            '874582',
            $options
        );

        $data['message'] = 'halo';
        $pusher->trigger('my-channel', 'my-event', $data);
    }

    //detail diagnosa pasien setelah antrian dipanggil
    public function detail_pemesanan($id = null)
    {
        if (!isset($id)) redirect('Pemesanan');
        $validation = $this->form_validation;
        $validation->set_rules($this->M_Pemesanan->rules());

        if ($validation->run() == FALSE) {
            $data = array(
                'title' => 'Detail Diagnosa Pasien',
                'isi'   => 'pemesanan/detail_pemesanan',
                'id'    => $this->M_Pemesanan->auto_id(),
                'tb_pemesanan' => $this->M_Pemesanan->detail_diagnosa($id),
                'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
            );
            $this->load->view('dashboard', $data);
        }
    }

    //Update data diagnosa pemeriksaan
    public function update()
    {
        $cekIcdx = $this->db->query("SELECT * FROM tb_icdx where kd_icdx ='" . $this->input->post('kd_icdx') . "'");
        $cekIcdx2 = $this->db->query("SELECT * FROM tb_icdx where kd_icdx ='" . $this->input->post('kd_icdx2') . "'");
        $cekIcdx3 = $this->db->query("SELECT * FROM tb_icdx where kd_icdx ='" . $this->input->post('kd_icdx3') . "'");
        $id = $this->input->post('id');
        
            if($cekIcdx->num_rows() < 1){
                $this->session->set_flashdata('error', 'Kode ICDX <strong>' . $this->input->post('kd_icdx') . '</strong> tidak terdaftar, Masukkan Kode ICDX yang valid!');
                $data = array(
                'title' => 'Detail Diagnosa Pasien',
                'isi'   => 'pemesanan/detail_pemesanan',
                'id'    => $this->M_Pemesanan->auto_id(),
                'tb_pemesanan' => $this->M_Pemesanan->detail_diagnosa($id),
                'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
            );
            $this->load->view('dashboard', $data);
            } else if($cekIcdx2->num_rows() < 1 && $this->input->post('kd_icdx2') != ""){
                $this->session->set_flashdata('error', 'Kode ICDX <strong>' . $this->input->post('kd_icdx2') . '</strong> tidak terdaftar, Masukkan Kode ICDX yang valid!');
                $data = array(
                'title' => 'Detail Diagnosa Pasien',
                'isi'   => 'pemesanan/detail_pemesanan',
                'id'    => $this->M_Pemesanan->auto_id(),
                'tb_pemesanan' => $this->M_Pemesanan->detail_diagnosa($id),
                'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
            );
            $this->load->view('dashboard', $data);
            } else if($cekIcdx3->num_rows() < 1 && $this->input->post('kd_icdx3') != ""){
                $this->session->set_flashdata('error', 'Kode ICDX <strong>' . $this->input->post('kd_icdx3') . '</strong> tidak terdaftar, Masukkan Kode ICDX yang valid!');
                $data = array(
                'title' => 'Detail Diagnosa Pasien',
                'isi'   => 'pemesanan/detail_pemesanan',
                'id'    => $this->M_Pemesanan->auto_id(),
                'tb_pemesanan' => $this->M_Pemesanan->detail_diagnosa($id),
                'user'  => $this->db->get_where('tb_pegawai', ['username' => $this->session->userdata('username')])->row_array()
            );
            $this->load->view('dashboard', $data);
            } else{
            $data = array(
            'id_pemesanan' => $this->input->post('id'),
            'no_antrian' => $this->input->post('no_antrian'),
            'no_rm' => $this->input->post('no_rm'),
            'id_diagnosa' => $this->input->post('id_diagnosa'),
            'pengobatan' => $this->input->post('pengobatan'),
            'tindakan' => $this->input->post('tindakan'),
            'keadaan_keluar' => $this->input->post('keadaan_keluar'),
            'prognosa' => $this->input->post('prognosa'),
            'status_pemesanan' => $this->input->post('status_pemesanan'),
            'pelayanan_kesehatan' => $this->input->post('pelayanan_kesehatan'),
            'jenis_pelayanan' => $this->input->post('jenis_pelayanan'),
            'status_pasien' => $this->input->post('status_pasien'),
            'status_penyakit' => $this->input->post('status_penyakit'));

            $where = array(
                'id_pemesanan' => $id
            );
            // var_dump($implode);
            // die();

            $this->M_Pemesanan->update_data($where, $data, 'tb_pemesanan');
            $this->M_Pemesanan->save_diagnosa();
            $this->session->set_flashdata('success', 'Selesai menambahkan penanganan pada pasien');
            redirect('Pemesanan');
            }
    }

    //ajax untuk menampilkan nama pasien berdasarkan no_rm otomatis di pemesanan
    public function get_pasien()
    {
        $no_rm = $this->input->post('no_rm');
        $data = $this->M_Pemesanan->get_pasien_byId($no_rm);
        echo json_encode($data);
    }

    //ajax untuk menampilkan nama penyakit otomatis berdasarkan kode_icdx nya
    public function get_penyakit()
    {
        $kd_icdx = $this->input->post('kd_icdx');
        $data = $this->M_Pemesanan->get_penyakit_byId($kd_icdx);
        echo json_encode($data);
    }

    function ambilData()
    {
        $dataPasien = $this->M_Pemesanan->getAll_antri();
        echo json_encode($dataPasien);
        $this->load->view('vendor/autoload.php');
    }
}
