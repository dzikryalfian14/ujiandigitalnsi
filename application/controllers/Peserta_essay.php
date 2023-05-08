<?php
defined('BASEPATH') or exit('No direct script access allowed');

class peserta_essay extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'admin_login') {
            redirect(base_url('auth'));
        }
        $this->load->model('m_peserta_essay');
    }

    public function index()
    {
        if (isset($_GET['idkls']) and isset($_GET['idsiswa'])) {
            $idkls = $this->input->get('idkls');
            $idsiswa = $this->input->get('idsiswa');
            $data['peserta_essay'] = $this->m_peserta_essay->get_peserta($idkls, $idsiswa)->result();
            $data['kelas'] = $this->m_data->get_data('tb_kelas')->result();
            $data['siswa'] = $this->m_data->get_data('tb_siswa')->result();
        } else if (isset($_GET['idkls'])) {
            $idkls = $this->input->get('idkls');
            $data['peserta_essay'] = $this->m_peserta_essay->get_peserta2($idkls)->result();
            $data['kelas'] = $this->m_data->get_data('tb_kelas')->result();
            $data['siswa'] = $this->m_data->get_data('tb_siswa')->result();
        } else if (isset($_GET['idsiswa'])) {
            $idsiswa = $this->input->get('idsiswa');
            $data['peserta_essay'] = $this->m_peserta_essay->get_peserta3($idsiswa)->result();
            $data['kelas'] = $this->m_data->get_data('tb_kelas')->result();
            $data['siswa'] = $this->m_data->get_data('tb_siswa')->result();
        } else {
            $data['peserta_essay'] = $this->m_peserta_essay->get_peserta4()->result();
            $data['kelas'] = $this->m_data->get_data('tb_kelas')->result();
            $data['siswa'] = $this->m_data->get_data('tb_siswa')->result();
        }
        $this->load->view('admin/v_peserta_essay', $data);
    }

    public function hapus($id)
    {
        $where = array(
            'id_peserta_essay' => $id
        );
        $this->m_data->delete_data($where, 'tb_peserta_essay');
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Data Peserta Ujian berhasil di hapus !</h4></div>');
        redirect(base_url('peserta_essay'));
    }


    public function edit($id)
    {
        $data['peserta_essay'] = $this->m_peserta_essay->get_joinpeserta($id);
        $data['mapel_essay'] = $this->m_data->get_data('tb_mapel_essay')->result();
        $data['siswa'] = $this->m_data->get_data('tb_siswa')->result();
        $data['jenis_ujian_essay'] = $this->m_data->get_data('tb_jenis_ujian_essay')->result();
        $this->load->view('admin/v_peserta_essay_edit', $data);
    }

    public function update()
    {
        $peserta_essay   = $this->input->post('peserta');
        $mapel_essay     = $this->input->post('mapel');
        $tanggal         = $this->input->post('tanggal');
        $jam             = $this->input->post('jam');
        $durasi_ujian    = $this->input->post('durasi_ujian');
        $jenis           = $this->input->post('jenis');
        $timer_ujian     = $durasi_ujian * 60;
        $where  = array('id_peserta_essay' => $this->input->post('id'));

        if ($peserta_essay == '' || $mapel_essay == '' || $tanggal == '' || $jam == '' || $durasi_ujian == '' || $jenis == '') {

            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> semua field harus diisi semua !</h4></div>');
            redirect(base_url('peserta_essay'));
        } else {
            $data = array(
                'id_siswa'        => $peserta_essay,
                'id_mapel_essay'        => $mapel_essay,
                'id_jenis_ujian'    => $jenis,
                'tanggal_ujian'        => $tanggal,
                'jam_ujian'            => $jam,
                'durasi_ujian'            => $durasi_ujian,
                'timer_ujian'            => $timer_ujian,
                'status_ujian'            => 1

            );

            $this->m_data->update_data($where, $data, 'tb_peserta_essay');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Data berhasil di Update.</h4></div>');
            redirect(base_url('peserta_essay'));
        }
    }
}
