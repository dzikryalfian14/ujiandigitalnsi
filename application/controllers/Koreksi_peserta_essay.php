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


        $this->load->view('admin/v_koreksi_peserta_essay', $data);
    }

    public function ubah_status_koreksi()
    {
        $id_peserta_essay = $this->input->post('id_peserta_essay');
        $status_koreksi = $this->input->post('status_koreksi');
        $data = array(
            'status_koreksi' => 1
        );
        $this->M_koreksi_essay->update_status_koreksi($id_peserta_essay, $data);
        redirect('koreksi_peserta_essay');
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
        $this->M_koreksi_essay->update_data($id_peserta_essay, $data);

        // Cek apakah update berhasil
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
