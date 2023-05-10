<?php
defined('BASEPATH') or exit('No direct script access allowed');

class essay extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'admin_login') {
            if ($this->session->userdata('status') != 'guru_login') {
                redirect('auth');
            }
        }
    }
    public function index()
    {
        $data['essay'] = $this->m_data->get_data('tb_mapel_essay')->result();
        $this->load->view('admin/v_essay', $data);
    }

    public function insert()
    {
        $nama_mapel_essay = $this->input->post('nama_mapel_essay');
        $soal = $this->input->post('soal');
        $gambar = $this->input->post('gambar');
        $kunci = $this->input->post('kunci');

        // handle gambar
        $config['upload_path'] = './uploads/'; //lokasi penyimpanan gambar
        $config['allowed_types'] = 'jpg|jpeg|png'; //tipe file gambar yang diperbolehkan
        $config['encrypt_name'] = TRUE; //nama file gambar diacak
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar_pertanyaan')) {
            $gambar = $this->upload->data('file_name'); //nama file gambar disimpan ke database
        } else {
            $gambar = ''; //jika gambar tidak diupload
        }

        $data = array(
            'id_mapel_essay' => $nama_mapel_essay,
            'pertanyaan' => $soal,
            'gambar' => $gambar,
            'jawaban' => $kunci
        );
        if ($nama_mapel_essay == '' || $soal == '') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Maaf, Input Soal Gagal!</h4> Jenis Ujian dan Pertanyaan Soal tidak boleh dikosongkan.</div>');
            redirect(base_url('essay'));
        } else {
            $this->m_data->insert_data($data, 'tb_soal_essay');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-message alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Selamat, Soal berhasil dibuat!</h4>untuk melihat soal tersebut bisa anda lihat di menu <b>Daftar Soal ujian</b>.</div>');
            redirect(base_url('essay_ujian'));
        }
    }
}