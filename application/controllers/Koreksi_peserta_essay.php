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








        // $id_siswa = $this->input->get('id_siswa');
        // $nama_mapel = $this->input->get('nama_mapel');
        // $data['jawaban'] = $this->M_koreksi_essay->get_data1_by_id_siswa($id_siswa);

        // $data['status_korekss']

        // $data = array(

        //     'status_koreksi' => 1,
        // );



        // Jika form di-submit, simpan status koreksi ke dalam database

        // $status_koreksi = $this->input->post('status_koreksi');
        // $id_jawaban = $this->input->post('id_jawaban');

        // $data = array();

        // $this->db->insert_batch('tb_peserta_essay', $data);

        // $data = array(

        //     'status_koreksi' => 1,

        // );
        // $this->M_koreksi_essay->update_status_koreksi($id_jawaban, $status_koreksi);
        // redirect(base_url('koreksi_peserta_essay'));


        // if ($this->input->get('id_siswa') && $this->input->get('nama_mapel')) {
        //     $id_siswa = $this->input->get('id_siswa');
        //     $nama_mapel = $this->input->get('nama_mapel');

        //     $this->M_koreksi_essay->update_status_koreksi_by_id_siswa($id_siswa, $nama_mapel);
        // }


        $this->load->view('admin/v_koreksi_peserta_essay', $data);
    }

    // public function status_koreksi()
    // {
    //     $data = array(

    //         'status_koreksi' => 1,

    //     );
    //     $this->m_data->UpdateNilaiEssay2($id_peserta, $data);
    //     // gunakan UpdateNilai dari model m_data untuk mengupdate data pada tabel tb_jawaban_essay
    //     redirect(base_url('koreksi_peserta_essay'));
    // }
}
