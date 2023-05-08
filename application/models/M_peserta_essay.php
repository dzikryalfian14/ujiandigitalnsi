<?php
defined('BASEPATH') or exit('no direct script access allowed');

class m_peserta_essay extends CI_Model
{
    public function get_joinpeserta($id)
    {
        $this->db->select('*');
        $this->db->from('tb_peserta_essay');
        $this->db->join('tb_mapel_essay', 'tb_peserta_essay.id_mapel_essay=tb_mapel_essay.id_mapel_essay');
        $this->db->join('tb_siswa', 'tb_peserta_essay.id_siswa=tb_siswa.id_siswa');
        $this->db->join('tb_jenis_ujian_essay', 'tb_peserta_essay.id_jenis_ujian_essay=tb_jenis_ujian_essay.id_jenis_ujian_essay');
        $this->db->where('tb_peserta_essay.id_peserta_essay', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_peserta($idkls, $idsiswa)
    {
        $array = array('tb_kelas.id_kelas' => $idkls, 'tb_siswa.id_siswa' => $idsiswa);
        $this->db->select('*');
        $this->db->from('tb_peserta_essay');
        $this->db->join('tb_mapel_essay', 'tb_peserta_essay.id_mapel_essay=tb_mapel_essay.id_mapel_essay');
        $this->db->join('tb_siswa', 'tb_peserta_essay.id_siswa=tb_siswa.id_siswa');
        $this->db->join('tb_jenis_ujian_essay', 'tb_peserta.id_jenis_ujian_essay=tb_jenis_ujian_essay.id_jenis_ujian_essay');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas=tb_siswa.id_kelas', 'left');
        $this->db->where($array);
        $this->db->order_by('id_peserta_essay', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_peserta2($idkls)
    {
        $this->db->select('*');
        $this->db->from('tb_peserta_essay');
        $this->db->join('tb_mapel_essay', 'tb_peserta_essay.id_mapel_essay=tb_mapel_essay.id_mapel_essay');
        $this->db->join('tb_siswa', 'tb_peserta_essay.id_siswa=tb_siswa.id_siswa');
        $this->db->join('tb_jenis_ujian_essay', 'tb_peserta_essay.id_jenis_ujian_essay=tb_jenis_ujian_essay.id_jenis_ujian_essay');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas=tb_siswa.id_kelas', 'left');
        $this->db->where('tb_kelas.id_kelas', $idkls);
        $this->db->order_by('id_peserta_essay', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_peserta3($idsiswa)
    {
        $this->db->select('*');
        $this->db->from('tb_peserta_essay');
        $this->db->join('tb_mapel_essay', 'tb_peserta_essay.id_mapel_essay=tb_mapel_essay.id_mapel_essay');
        $this->db->join('tb_siswa', 'tb_peserta_essay.id_siswa=tb_siswa.id_siswa');
        $this->db->join('tb_jenis_ujian_essay', 'tb_peserta_essay.id_jenis_ujian_essay=tb_jenis_ujian_essay.id_jenis_ujian_essay');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas=tb_siswa.id_kelas', 'left');
        $this->db->where('tb_siswa.id_siswa', $idsiswa);
        $this->db->order_by('id_peserta_essay', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_peserta4()
    {
        $this->db->select('*');
        $this->db->from('tb_peserta_essay');
        $this->db->join('tb_mapel_essay', 'tb_peserta_essay.id_mapel_essay=tb_mapel_essay.id_mapel_essay');
        $this->db->join('tb_siswa', 'tb_peserta_essay.id_siswa=tb_siswa.id_siswa');
        $this->db->join('tb_jenis_ujian_essay', 'tb_peserta_essay.id_jenis_ujian_essay=tb_jenis_ujian_essay.id_jenis_ujian_essay');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas=tb_siswa.id_kelas', 'left');
        $this->db->order_by('id_peserta_essay', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getAllSiswa()
    {
        $this->db->select('siswa.id_siswa, siswa.nis, siswa.nama_siswa, kelas.nama_kelas, siswa.username');
        $this->db->from('siswa');
        $this->db->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
        $query = $this->db->get();
        return $query->result();
    }
}
