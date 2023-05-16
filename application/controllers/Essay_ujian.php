<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Essay_ujian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'admin_login') {
            if ($this->session->userdata('status') != 'guru_login') {
                redirect('auth');
            }
        }
        $this->load->model('m_essay');
    }
    public function index()
    {
        if (isset($_GET['id'])) {
            $id = $this->input->get('id');
            $data['essay_ujian'] = $this->db->query('SELECT * from tb_soal_essay join tb_mapel_essay where tb_soal_essay.id_mapel_essay=tb_mapel_essay.id_mapel_essay and tb_mapel_essay.id_mapel_essay="' . $id . '" order by id_soal_essay desc')->result();
            $data['kelas'] = $this->m_data->get_data('tb_mapel_essay')->result();
        } else {
            $data['essay_ujian'] =  $this->db->query('SELECT * FROM tb_soal_essay join tb_mapel_essay ON tb_soal_essay.id_mapel_essay=tb_mapel_essay.id_mapel_essay order by id_soal_essay desc')->result();
            $data['kelas'] = $this->m_data->get_data('tb_mapel_essay')->result();
        }
        $this->load->view('admin/v_essay_ujian', $data);
    }

    public function edit($id)
    {
        $data['essay'] = $this->m_essay->get_joinsoalessay($id)->result();
        $data['kelas'] = $this->m_data->get_data('tb_mapel_essay')->result();
        $this->load->view('admin/v_essay_ujian_edit', $data);
    }

    // public function update()
    // {
    //     $id                 = $this->input->post('id');
    //     $nama_mapel_essay     = $this->input->post('nama_mapel_essay');
    //     $soal                = $this->input->post('pertanyaan');
    //     $kunci                = $this->input->post('jawaban');

    //     $where = array('id_soal_essay' => $id);
    //     $data = array(
    //         'id_mapel_essay' => $nama_mapel_essay,
    //         'pertanyaan' => $soal,
    //         'jawaban' => $kunci
    //     );
    //     $this->m_data->update_data($where, $data, 'tb_soal_essay');
    //     $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Selamat, Soal telah berhasil diupdate!</h4></div>');
    //     redirect(base_url('essay_ujian'));
    // }

    public function update()
    {
        $id = $this->input->post('id');
        $nama_mapel_essay = $this->input->post('nama_mapel_essay');
        $soal = $this->input->post('pertanyaan');
        $gambar = $this->input->post('gambar');
        $kunci = $this->input->post('jawaban');


        // Cek apakah ada file gambar yang diunggah
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
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Maaf, Update Soal Gagal!</h4>' . $error . '</div>');
                redirect(base_url('essay_ujian'));
            }
        } else {
            // Tidak ada file gambar yang diunggah, beri nilai default
            $gambar = ''; // Atau gunakan nilai gambar yang sudah ada sebelumnya jika perlu
        }

        $where = array('id_soal_essay' => $id);
        $data = array(
            'id_mapel_essay' => $nama_mapel_essay,
            'pertanyaan' => $soal,
            'jawaban' => $kunci,
            'gambar' => $gambar
        );

        $this->m_data->update_data($where, $data, 'tb_soal_essay');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Selamat, Soal telah berhasil diupdate!</h4></div>');
        redirect(base_url('essay_ujian'));
    }

    // public function update()
    // {
    //     $id = $this->input->post('id');
    //     $nama_mapel_essay = $this->input->post('nama_mapel_essay');
    //     $soal = $this->input->post('pertanyaan');
    //     $kunci = $this->input->post('jawaban');

    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'gif|jpg|png';
    //     $config['max_size'] = 2048;

    //     $this->load->library('upload', $config);

    //     if ($this->upload->do_upload('gambar')) {
    //         $upload_data = $this->upload->data();
    //         $gambar = 'uploads/' . $upload_data['file_name'];
    //     } else {
    //         $error = $this->upload->display_errors();
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Maaf, Update Soal Gagal!</h4>' . $error . '</div>');
    //         redirect(base_url('essay_ujian'));
    //     }

    //     $where = array('id_soal_essay' => $id);
    //     $data = array(
    //         'id_mapel_essay' => $nama_mapel_essay,
    //         'pertanyaan' => $soal,
    //         'jawaban' => $kunci,
    //         'gambar' => $gambar
    //     );

    //     $this->m_data->update_data($where, $data, 'tb_soal_essay');
    //     $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Selamat, Soal telah berhasil diupdate!</h4></div>');
    //     redirect(base_url('essay_ujian'));
    // }




    public function hapus($id)
    {
        $where = array(
            'id_soal_essay' => $id
        );
        $this->m_data->delete_data($where, 'tb_soal_essay');
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Perhatian, Data telah berhasil dihapus!</h4></div>');
        redirect(base_url('essay_ujian'));
    }
}
