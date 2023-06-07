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
        $this->load->library('session');
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



        $id_peserta_essay = $this->input->get('id_peserta_essay');
        // // ambil data jawaban peserta dan soal
        $data['jawaban_peserta_soal'] = $this->M_koreksi_essay->get_jawaban_peserta_soal($id_peserta_essay);

        // ambil data soal essay
        $data['soal'] = $this->M_koreksi_essay->get_data_soal();

        $data['daftar_soal'] = $this->M_koreksi_essay->get_data_soal();
        $data['siswa'] = $this->m_data->get_data('tb_siswa')->result();


        //ambil data soal
        if (isset($_GET['id'])) {
            $id_mapel = $this->input->get('id');
            // $data['soal'] = $this->M_koreksi_essay->get_soal_by_id_mapel($id_mapel);
            $data['kelas'] = $this->m_data->get_data('tb_mapel_essay')->result();
        } else {
            $data['soal'] = $this->M_koreksi_essay->get_data_soal1();
            // $data['kelas'] = $this->m_data->get_data('tb_mapel_essay')->result();
        }



        $this->load->view('admin/v_koreksi_essay', $data);
    }
    public function simpan_nilai()
    {
        $input_nilai = $this->input->post('nilai'); // Mengambil nilai dari inputan
        $id_peserta = $this->input->post('id_peserta_essay');

        foreach ($input_nilai as $id_jawaban => $nilai) {
            // Update nilai pada tabel tb_jawaban_essay
            $data = array(
                'nilai' => $nilai
            );
            $this->db->where('id_jawaban_essay', $id_jawaban);
            $this->db->update('tb_jawaban_essay', $data);
        }

        // Mengubah status koreksi menjadi "Sudah Dikoreksi"
        $data = array(
            'status_koreksi' => 1
        );
        $this->M_koreksi_essay->update_status_koreksi($id_peserta, $data);

        // Menghitung total nilai berdasarkan ID peserta
        $total_nilai = $this->db->select_sum('nilai')->where('id_peserta_essay', $id_peserta)->get('tb_jawaban_essay')->row()->nilai;

        $data = array(
            'nilai_essay' => $total_nilai
        );
        $this->load->model('m_data'); // Load model m_data
        $this->m_data->updateNilaiEssay($id_peserta, $data);

        // Simpan total_nilai ke flashdata
        $this->session->set_flashdata('total_nilai', $total_nilai);

        // Ubah status koreksi pada variabel peserta
        foreach ($peserta as &$row) {
            if ($row->id_peserta_essay == $id_peserta) {
                $row->status_koreksi = 1;
                break;
            }
        }

        // Setelah nilai disimpan, lakukan redirect
        redirect('hasil_ujian_essay'); // Ganti dengan URL atau fungsi yang sesuai
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
            $message = ".";
        }

        $this->session->set_flashdata('message', $message);


        // Redirect ke halaman koreksi_peserta_essay
        redirect('koreksi_peserta_essay');
    }
}
