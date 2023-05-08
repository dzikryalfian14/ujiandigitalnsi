<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_koreksi_essay extends CI_Model
{

    public function get_data1()
    {
        $this->db->select('tb_jawaban_essay.jawaban, tb_peserta_essay.id_siswa');
        $this->db->from('tb_jawaban_essay');
        $this->db->join('tb_peserta_essay', 'tb_jawaban_essay.id_peserta_essay =tb_peserta_essay.id_peserta_essay');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_data2()
    {
        $this->db->select('*');
        $this->db->from('tb_peserta_essay');
        $this->db->join('tb_siswa', 'tb_peserta_essay.id_siswa = tb_siswa.id_siswa');
        $this->db->join('tb_mapel_essay', 'tb_peserta_essay.id_mapel_essay = tb_mapel_essay.id_mapel_essay');
        $this->db->join('tb_jenis_ujian_essay', 'tb_peserta_essay.id_jenis_ujian_essay = tb_jenis_ujian_essay.id_jenis_ujian_essay');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_data_soal1()
    {
        $this->db->select('tb_soal_essay.id_soal_essay, tb_soal_essay.id_mapel_essay, tb_soal_essay.pertanyaan, tb_mapel_essay.nama_mapel_essay');
        $this->db->from('tb_soal_essay');
        $this->db->join('tb_mapel_essay', 'tb_soal_essay.id_mapel_essay = tb_mapel_essay.id_mapel_essay');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_data_soal2($id)
    {
        $this->db->select('tb_soal_essay.id_soal_essay, tb_soal_essay.id_mapel_essay, tb_soal_essay.pertanyaan, tb_mapel_essay.nama_mapel_essay');
        $this->db->from('tb_soal_essay');
        $this->db->join('tb_mapel_essay', 'tb_soal_essay.id_mapel_essay = tb_mapel_essay.id_mapel_essay');
        $this->db->where('tb_soal_essay.id_soal_essay', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }


    public function get_mapel_essay()
    {
        $this->db->select('nama_mapel_essay');
        $this->db->from('tb_mapel_essay');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_mapel_by_id($id)
    {
        $this->db->select('tb_mapel_essay.nama_mapel_essay');
        $this->db->from('tb_jawaban_essay');
        $this->db->join('tb_soal_essay', 'tb_jawaban_essay.id_soal_essay = tb_soal_essay.id_soal_essay');
        $this->db->join('tb_mapel_essay', 'tb_soal_essay.id_mapel_essay = tb_mapel_essay.id_mapel_essay');
        $this->db->where('tb_jawaban_essay.id_jawaban_essay', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_soal_by_id_mapel($id_mapel)
    {
        $this->db->where('id_mapel_essay', $id_mapel);
        $query = $this->db->get('tb_soal_essay');
        return $query->row();
    }


    public function get_soal_jawaban_by_id_peserta($id_peserta)
    {
        $query = $this->db->select('*')
            ->from('tb_jawaban_essay')
            ->join('tb_soal_essay', 'tb_soal_essay.id_soal_essay = tb_jawaban_essay.id_soal_essay')
            ->where('id_peserta_essay', $id_peserta)
            ->get();
        return $query->row();
    }

    //koreksi essay baru

}
