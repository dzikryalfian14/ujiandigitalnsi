<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruang_hasil_essay extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'siswa_login') {
            redirect(base_url('auth'));
        }
    }

    public function index()
    {
        $id_siswa = $_SESSION['id'];
        $data['hasil_essay'] = $this->m_data->get_peserta_essay($id_siswa);
        $this->load->view('siswa/v_hasil_essay', $data);
    }
}
