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

        // ambil data kelas
        // $data['kelas'] = $this->m_data->get_data('tb_mapel_essay')->result();


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
    
        // Buat data baru untuk di-update
        $data = array(
            'status_koreksi' => 1
        );
    
        // Panggil model M_koreksi_essay dan gunakan method update_data
        $this->load->model('M_koreksi_essay');
        $this->M_koreksi_essay->update_data($id_peserta_essay, $data);
    
        // Redirect ke halaman koreksi_peserta_essay
        redirect('koreksi_peserta_essay');
    }
    

    // public function detail_jawaban($id_soal)
    // {
    //     // Ambil data soal
    //     $data['soal'] = $this->M_koreksi_essay->get_data_soal2($id_soal);

    //     // Ambil data jawaban yang sama dengan ID soal
    //     $data['jawaban'] = $this->M_koreksi_essay->get_jawaban_by_id_soal($id_soal);

    //     // Tampilkan data ke view
    //     $this->load->view('detail_jawaban', $data);
    // }



    // public function nilai_aksi()
    // {
    //     $nilai         = $this->input->post('nilai');

    //     $data = array(
    //         'nilai_essay' => $nilai
    //     );
    //     $this->m_data->insert_data($data, 'tb_peserta_essay');
    //     $this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !<br></b> Anda telah berhasil menambahkan data Mata Pelajaran</div>');
    //     redirect(base_url('koreksi_essay'));
    // }

    // public function update_status_koreksi()
    // {
    //     $id_siswa = $this->input->get('id_siswa');
    //     $nama_mapel = $this->input->get('nama_mapel');

    //     $this->M_koreksi_essay->update_status_koreksi_by_id_siswa($id_siswa, $nama_mapel);

    //     redirect('koreksi_essay'); 
    // }
}
