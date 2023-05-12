<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruang_ujian_essay extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'siswa_login') {
            redirect(base_url() . 'auth?alert=belum_login');
        }
    }

    public function soal()
    {
        $id_peserta_essay = $this->uri->segment(3);
        $id = $this->db->query('SELECT * FROM tb_peserta_essay WHERE id_peserta_essay="' . $id_peserta_essay . '"  ')->row_array();
        $soal_ujian_essay = $this->db->query('SELECT * FROM tb_soal_essay WHERE id_mapel_essay="' . $id['id_mapel_essay'] . '" ORDER BY RAND()');
        $where = array('id_peserta_essay' => $id_peserta_essay);
        $data2 = array('status_ujian_ujian' => 1);
        $this->m_data->update_data($where, $data2, 'tb_peserta_essay');
        $time = $id['timer_ujian'];
        $data = array(
            "soal_essay" => $soal_ujian_essay->result(),
            "total_soal" => $soal_ujian_essay->num_rows(),
            "max_time" => $time,
            "id" => $id
        );
        $this->load->view('ujian/v_soalujianessay', $data);
    }


    public function jawab_aksi()
    {
        $id_peserta = $this->input->post('id_peserta_essay');
        $id_soal = $this->input->post('soal');
        $jawaban = $_POST['jawaban'];
        $data = array(); // inisialisasi array kosong
        for ($i = 0; $i < count($jawaban); $i++) {
            $data[] = array(
                'id_peserta_essay' => $id_peserta,
                'id_soal_essay' => $id_soal[$i],
                'jawaban' => $jawaban[$id_soal[$i]]
            );
        }
        $this->db->insert_batch('tb_jawaban_essay', $data); 



        $data = array(

            'status_ujian' => 2,
            'status_ujian_ujian' => 2,

        );
        // $where = array('id_peserta_essay' => $id_peserta); // tambahkan where untuk membatasi update hanya pada record peserta yang bersangkutan
        $this->m_data->UpdateNilaiEssay2($id_peserta, $data);
        // gunakan UpdateNilai dari model m_data untuk mengupdate data pada tabel tb_jawaban_essay
        redirect(base_url('jadwal_ujian_essay'));
    }
}
