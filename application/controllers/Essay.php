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

    // public function insert()
    // {
    //     $nama_mapel_essay = $this->input->post('nama_mapel_essay');
    //     $soal = $this->input->post('soal');
    //     $kunci = $this->input->post('kunci');
    //     $data = array(
    //         'id_mapel_essay' => $nama_mapel_essay,
    //         'pertanyaan' => $soal,
    //         'jawaban' => $kunci
    //     );
    //     if ($nama_mapel_essay == '' || $soal == '') {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Maaf, Input Soal Gagal!</h4> Jenis Ujian dan Pertanyaan Soal tidak boleh dikosongkan.</div>');
    //         redirect(base_url('essay'));
    //     } else {
    //         $this->m_data->insert_data($data, 'tb_soal_essay');
    //         $this->session->set_flashdata('message', '<div class="alert alert-success alert-message alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Selamat, Soal berhasil dibuat!</h4>untuk melihat soal tersebut bisa anda lihat di menu <b>Daftar Soal ujian</b>.</div>');
    //         redirect(base_url('essay_ujian'));
    //     }
    // }

    // public function insert()
    // {
    //     $nama_mapel_essay = $this->input->post('nama_mapel_essay');
    //     $soal = $this->input->post('soal');
    //     $kunci = $this->input->post('kunci');

    //     $config['upload_path'] = './uploads/'; // Lokasi folder penyimpanan file
    //     $config['allowed_types'] = 'gif|jpg|png'; // Jenis file yang diizinkan untuk diunggah
    //     $config['max_size'] = 2048; // Ukuran maksimum file dalam kilobita

    //     $this->load->library('upload', $config);

    //     if ($this->upload->do_upload('gambar')) {
    //         $upload_data = $this->upload->data();
    //         $gambar = 'uploads/' . $upload_data['file_name'];

    //         $data = array(
    //             'id_mapel_essay' => $nama_mapel_essay,
    //             'pertanyaan' => $soal,
    //             'jawaban' => $kunci,
    //             'gambar' => $gambar
    //         );

    //         if ($nama_mapel_essay == '' || $soal == '') {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Maaf, Input Soal Gagal!</h4> Jenis Ujian dan Pertanyaan Soal tidak boleh dikosongkan.</div>');
    //             redirect(base_url('essay'));
    //         } else {
    //             $this->m_data->insert_data($data, 'tb_soal_essay');
    //             $this->session->set_flashdata('message', '<div class="alert alert-success alert-message alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Selamat, Soal berhasil dibuat!</h4>untuk melihat soal tersebut bisa anda lihat di menu <b>Daftar Soal ujian</b>.</div>');
    //             redirect(base_url('essay_ujian'));
    //         }
    //     } else {
    //         // Jika upload gambar gagal, tampilkan pesan error
    //         $error = $this->upload->display_errors();
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Maaf, Input Soal Gagal!</h4>' . $error . '</div>');
    //         redirect(base_url('essay'));
    //     }
    // }

    public function insert()
    {
        $nama_mapel_essay = $this->input->post('nama_mapel_essay');
        $soal = $this->input->post('soal');
        $kunci = $this->input->post('kunci');

        // Cek apakah ada file gambar yang diunggah
        if (isset($_FILES['gambar']) && $_FILES['gambar']['name'] != "") {
            $config['upload_path'] = './uploads/'; // Lokasi folder penyimpanan file
            $config['allowed_types'] = 'gif|jpg|png|jfif'; // Jenis file yang diizinkan untuk diunggah
            $config['max_size'] = 2048; // Ukuran maksimum file dalam kilobita

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $upload_data = $this->upload->data();
                $gambar = 'uploads/' . $upload_data['file_name'];
            } else {
                // Jika upload gambar gagal, tampilkan pesan error
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Maaf, Input Soal Gagal!</h4>' . $error . '</div>');
                redirect(base_url('essay'));
            }
        } else {
            // Tidak ada file gambar yang diunggah, beri nilai default
            $gambar = '';
        }

        $data = array(
            'id_mapel_essay' => $nama_mapel_essay,
            'pertanyaan' => $soal,
            'jawaban' => $kunci,
            'gambar' => $gambar
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
