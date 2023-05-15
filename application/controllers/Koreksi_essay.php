<?php
defined('BASEPATH') or exit('No direct script access allowed');

class koreksi_essay extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'admin_login') {
            redirect(base_url('auth'));
        }
        $this->load->model('M_koreksi_essay');
        $this->load->model('m_data');
    }


    public function index()
    {
        

        $id_siswa = $this->input->get('id_siswa');
        $nama_mapel = $this->input->get('nama_mapel');
        $data['jawaban'] = $this->M_koreksi_essay->get_data1_by_id_siswa($id_siswa);

        // ambil data peserta ujian
        $data['peserta'] = $this->M_koreksi_essay->get_data2();

        // ambil data jawaban essay
        $data['jawaban'] = $this->M_koreksi_essay->get_data1();

 


        // // ambil data jawaban peserta dan soal
        $data['jawaban_peserta_soal'] = $this->M_koreksi_essay->get_jawaban_peserta_soal();

        // ambil data soal essay
        $data['soal'] = $this->M_koreksi_essay->get_data_soal();

        $data['daftar_soal'] = $this->M_koreksi_essay->get_data_soal();


        //ambil data soal
        if (isset($_GET['id'])) {
            $id_mapel = $this->input->get('id');
            // $data['soal'] = $this->M_koreksi_essay->get_soal_by_id_mapel($id_mapel);
            $data['kelas'] = $this->m_data->get_data('tb_mapel_essay')->result();
        } else {
            $data['soal'] = $this->M_koreksi_essay->get_data_soal1();
            $data['kelas'] = $this->m_data->get_data('tb_mapel_essay')->result();
        }

        // ambil data nama ujian
        // if (isset($_GET['id'])) {
        //     $id_mapel = $this->input->get('id');
        //     $data['mapel'] = $this->M_koreksi_essay->get_mapel_by_id($id);
        //     $data['kelas'] = $this->m_data->get_data('tb_mapel_essay')->result();
        // } else {
        //     $data['mapel_essay'] = $this->M_koreksi_essay->get_mapel_essay();
        //     $data['kelas'] = $this->m_data->get_data('tb_mapel_essay')->result();
        // }

        // // ambil data soal dan jawaban
        // $id_peserta = 1; // ganti dengan id peserta yang diinginkan
        // $data['soal_jawaban'] = $this->M_koreksi_essay->get_soal_jawaban_by_id_peserta($id_peserta);
        // $data['kelas'] = $this->m_data->get_data('tb_mapel_essay')->result();




        $this->load->view('admin/v_koreksi_essay', $data);
    }

    public function kembali()
    {
        // Ambil id peserta dari query string
        $id_peserta_essay = $this->input->get('id_peserta_essay');

        // // Buat data baru untuk di-update
        $data = array(
            'status_koreksi' => 1
        );

        // // Panggil model M_koreksi_essay dan gunakan method update_data
        $this->M_koreksi_essay->update_data($id_peserta_essay, $data);

        // // Cek apakah update berhasil
        $row = $this->M_koreksi_essay->get_data_by_id($id_peserta_essay);

        if ($row->status_koreksi == 1) {
            $message = "Status koreksi berhasil diubah menjadi Sudah Dikoreksi.";
        } else {
            $message = "Status koreksi gagal diubah.";
        }

        $this->session->set_flashdata('message', $message);


        // Redirect ke halaman koreksi_peserta_essay
        redirect('koreksi_peserta_essay');
    }

}
