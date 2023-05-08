<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mapel_essay extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('status') != 'admin_login') {
            redirect(base_url('auth'));
        }
    }

    public function index()
    {
        $data['mapel_essay'] = $this->m_data->get_data('tb_mapel_essay')->result();
        $this->load->view('admin/v_mapel_essay', $data);
    }

    public function mapel_aksi()
    {
        $kode         = $this->input->post('kode');
        $nama        = $this->input->post('nama');

        $data = array(
            'kode_mapel_essay' => $kode,
            'nama_mapel_essay' => $nama
        );
        $this->m_data->insert_data($data, 'tb_mapel_essay');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !<br></b> Anda telah berhasil menambahkan data Mata Pelajaran</div>');
        redirect(base_url('mapel_essay'));
    }

    public function hapus($id)
    {
        $where = array(
            'id_mapel_essay' => $id
        );
        $this->m_data->delete_data($where, 'tb_mapel_essay');
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-check"></i><b>Selamat !<br></b> Anda telah berhasil menghapus data Mata Pelajaran</div>');
        redirect(base_url('mapel_essay'));
    }

    public function edit($id)
    {
        $where    = array('id_mapel_essay' => $id);
        $data['mapel_essay'] = $this->m_data->edit_data($where, 'tb_mapel_essay')->result();
        $this->load->view('admin/v_mapel_essay_edit', $data);
    }

    public function update()
    {
        $id         = $this->input->post('id');
        $kode         = $this->input->post('kode');
        $nama        = $this->input->post('nama');

        $where = array('id_mapel_essay' => $id);
        $data = array(
            'kode_mapel_essay' => $kode,
            'nama_mapel_essay' => $nama
        );
        $this->m_data->update_data($where, $data, 'tb_mapel_essay');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !<br></b> Anda telah berhasil mengupdate data Mata Pelajaran</div>');
        redirect(base_url('mapel_essay'));
    }
}
