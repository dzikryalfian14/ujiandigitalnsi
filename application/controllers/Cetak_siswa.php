<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cetak_siswa extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'admin_login') {
            redirect(base_url('auth'));
        }
        $this->load->model('m_cetak_pendaftar');
        $this->load->library('mypdf');
    }

    public function index()
    {
        $this->load->view('admin/v_cetak_pendaftar_siswa');
    }

    public function print_all()
    {
        if (isset($_GET['id'])) {
            $id = $this->input->get('id');
            $data['cetak_siswa'] = $this->m_cetak_pendaftar->cetak();
        } else {
            $data['cetak_siswa'] = $this->m_cetak_pendaftar->cetak();
        }
        $this->mypdf->generate('admin/v_cetak_pendaftar_siswa', $data, 'Cetak Pendaftar Ujian', 'A4', 'Landscape');
    }
}
