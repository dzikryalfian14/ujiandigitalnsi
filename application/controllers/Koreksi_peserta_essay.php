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
        // ambil data peserta dan jawaban essay
        $data['peserta'] = $this->M_koreksi_essay->get_data2();
        $data['jawaban'] = $this->M_koreksi_essay->get_data1();

        $this->load->view('admin/v_koreksi_peserta_essay', $data);
    }

    public function nilai_aksi($id_peserta)
    {
        // ambil nilai dari form input
        $nilai = $this->input->post('nilai');

        // update nilai peserta
        $data = array(
            'nilai_essay' => $nilai
        );
        $where = array('id_peserta' => $id_peserta);
        $this->M_data->update_data($where, $data, 'tb_peserta_essay');

        // set flash data untuk notifikasi sukses
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !<br></b> Anda telah berhasil menambahkan data Mata Pelajaran</div>');

        // redirect ke halaman koreksi_peserta_essay
        redirect(base_url('koreksi_peserta_essay'));
    }

    public function koreksi($id_peserta)
    {
        // ambil data peserta dan jawaban essay
        $data['peserta'] = $this->M_koreksi_essay->get_data_peserta_essay($id_peserta);
        $data['jawaban'] = $this->M_koreksi_essay->get_data_jawaban($id_peserta);

        $this->load->view('admin/v_koreksi_essay', $data);
    }
}
