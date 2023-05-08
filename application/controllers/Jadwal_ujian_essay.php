<?php
defined('BASEPATH') or exit('No direct script access allowed');

class jadwal_ujian_essay extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'siswa_login') {
            redirect(base_url() . 'auth?alert=belum_login');
        }
    }

    public function index()
    {
        $data['peserta_essay'] = $this->db->query('SELECT tb_peserta_essay.id_peserta_essay, tb_mapel_essay.kode_mapel_essay, tb_mapel_essay.nama_mapel_essay, tb_mapel_essay.id_mapel_essay, tb_siswa.nama_siswa, tb_siswa.nis, tanggal_ujian, jam_ujian, durasi_ujian, tb_jenis_ujian_essay.jenis_ujian_essay, status_ujian  FROM tb_peserta_essay, tb_mapel_essay, tb_siswa, tb_jenis_ujian_essay WHERE tb_peserta_essay.id_jenis_ujian_essay=tb_jenis_ujian_essay.id_jenis_ujian_essay and tb_peserta_essay.id_mapel_essay=tb_mapel_essay.id_mapel_essay and tb_peserta_essay.id_siswa=tb_siswa.id_siswa and tb_siswa.nama_siswa="' . $this->session->userdata('nama') . '" ')->result();
        $this->load->view('siswa/v_jadwal_ujian_essay', $data);
    }
}
