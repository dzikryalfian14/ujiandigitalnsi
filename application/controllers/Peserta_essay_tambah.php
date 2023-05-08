<?php
defined('BASEPATH') or exit('No direct script access allowed');

class peserta_essay_tambah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'admin_login') {
            redirect(base_url() . 'auth?alert=belum_login');
        }
    }

    public function index()
    {
        if (isset($_GET['kelas'])) {
            $id = $this->input->get('kelas');
            $data['siswa'] = $this->db->query('SELECT * from tb_siswa join tb_kelas where tb_siswa.id_kelas=tb_kelas.id_kelas and tb_kelas.id_kelas="' . $id . '"')->result();

            $data['kelas'] = $this->m_data->get_data('tb_kelas')->result();
            $data['mapel_essay'] = $this->m_data->get_data('tb_mapel_essay')->result();
            $data['jenis_ujian'] = $this->m_data->get_data('tb_jenis_ujian')->result();
        } else {
            $data['siswa'] = $this->db->query('SELECT * from tb_siswa join tb_kelas where tb_siswa.id_kelas=tb_kelas.id_kelas')->result();
            $data['kelas'] = $this->m_data->get_data('tb_kelas')->result();
            $data['mapel_essay'] = $this->m_data->get_data('tb_mapel_essay')->result();
            $data['jenis_ujian_essay'] = $this->m_data->get_data('tb_jenis_ujian_essay')->result();
        }
        $this->load->view('admin/v_peserta_essay_tambah', $data);
    }

    public function insert_()
    {
        $mapel_essay    = $this->input->post('mapel');
        $tanggal        = $this->input->post('tanggal');
        $jam            = $this->input->post('jam');
        $jenis_essay    = $this->input->post('jenis_ujian');
        $durasi_ujian   = $this->input->post('durasi_ujian');


        if ($mapel_essay == '' || $tanggal == '' || $jam == '' || $durasi_ujian == '' || $jenis_essay == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Input Data Peserta Gagal !</h4> Cek kembali data yang diinputkan.</div>');
            redirect(base_url('peserta_essay_tambah'));
        } else {
            $result = $this->m_data->insert_multiple_essay();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Peserta Ujian berhasil dibuat !</h4></div>');
            redirect(base_url('peserta_essay'));
        }
    }
}
