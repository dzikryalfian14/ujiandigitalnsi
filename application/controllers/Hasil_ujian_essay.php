<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasil_ujian_essay extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'admin_login') {
            redirect(base_url('auth'));
        }
        $this->load->model('m_hasil_essay');
        $this->load->library('mypdf');
    }

    public function index()
    {
        if (isset($_GET['id'])) {
            $id = $this->input->get('id');
            $data['hasil_essay'] = $this->m_hasil_essay->get_peserta2($id);
            $data['kelas'] = $this->m_data->get_data('tb_mapel_essay')->result();
        } else {
            $data['hasil_essay'] = $this->m_hasil_essay->get_peserta3();
            $data['kelas'] = $this->m_data->get_data('tb_mapel_essay')->result();
        }
        // foreach ($data['hasil_essay'] as $key => $value) {
        //     $nilai_essay = $value->nilai_essay;
        //     if ($nilai_essay >= $data) {
        //         $data['hasil_essay'][$key]->status_lulus = "Lulus";
        //     } else {
        //         $data['hasil_essay'][$key]->status_lulus = "Tidak Lulus";
        //     }
        // }
        $this->load->view('admin/v_hasil_essay', $data);
    }

    public function print_all()
    {
        if (isset($_GET['id'])) {
            $id = $this->input->get('id');
            $data['cetak_essay'] = $this->m_hasil_essay->get_peserta2($id);
        } else {
            $data['cetak_essay'] = $this->m_hasil_essay->get_peserta3();
        }
        $this->mypdf->generate('admin/v_cetak_essay', $data, 'Cetak Hasil Ujian ujian', 'A4', 'Landscape');
    }

    public function cetak($id)
    {
        $where = array('id_peserta_essay' => $id);
        $id = $where['id_peserta_essay'];
        $data['cetak_essay'] = $this->m_hasil_essay->cetak($id);
        $this->mypdf->generate('admin/v_cetak_essay', $data, 'Cetak Hasil Ujian ujian', 'A4', 'Landscape');
    }


    public function insert_nilai($id_peserta_essay)
    {
        $nilai = $this->input->post('nilai');

        // update nilai peserta pada tabel tb_peserta_essay
        $data = array(
            'nilai_essay' => $nilai
        );
        $this->m_data->UpdateNilaiEssay12($id_peserta_essay, $data);

        // redirect ke halaman hasil ujian essay
        redirect(base_url('hasil_ujian_essay'));
    }
}
