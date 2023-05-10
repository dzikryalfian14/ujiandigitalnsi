<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Koreksi_peserta_essay extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'admin_login') {
            redirect(base_url('auth'));
        }
        $this->load->model('M_koreksi_essay');
        $this->load->model('M_data');
    }

    public function index()
    {
        // // ambil data peserta dan jawaban essay
        $data['peserta'] = $this->M_koreksi_essay->get_data2();
        $data['jawaban'] = $this->M_koreksi_essay->get_data1();

        $id_siswa = $this->input->get('id_siswa');
        $nama_mapel = $this->input->get('nama_mapel');
        $data['jawaban'] = $this->M_koreksi_essay->get_data1_by_id_siswa($id_siswa);

        // // Ambil data peserta dan jawaban essay
        // $data['peserta'] = $this->M_koreksi_essay->get_data2_by_id_siswa();
        // $data['jawaban'] = $this->M_koreksi_essay->get_data1_by_id_siswa();


        $this->load->view('admin/v_koreksi_peserta_essay', $data);
    }
}
