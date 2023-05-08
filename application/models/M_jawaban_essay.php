<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_jawaban_essay extends CI_Model
{
    public function get_jawaban_peserta($id)
    {
        $this->db->select('*');
        $this->db->from('tb_jawaban_essay');
        $this->db->join('tb_mapel_essay', 'tb_peserta_essay.id_mapel_essay=tb_mapel_essay.id_mapel_essay');
        $this->db->join('tb_jenis_ujian_essay', 'tb_peserta_essay.id_jenis_ujian_essay=tb_jenis_ujian_essay.id_jenis_ujian_essay');
        $this->db->join('tb_siswa', 'tb_peserta_essay.id_siswa=tb_siswa.id_siswa');
        $this->db->where('tb_peserta.id_mapel_essay', $id);
        $this->db->order_by('jawaban', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }



    public function cetak($id)
    {
        $this->db->select('*');
        $this->db->from('tb_peserta');
        $this->db->join('tb_matapelajaran', 'tb_peserta.id_matapelajaran=tb_matapelajaran.id_matapelajaran');
        $this->db->join('tb_jenis_ujian', 'tb_peserta.id_jenis_ujian=tb_jenis_ujian.id_jenis_ujian');
        $this->db->join('tb_siswa', 'tb_peserta.id_siswa=tb_siswa.id_siswa');
        $this->db->where('tb_peserta.id_peserta', $id);
        $query = $this->db->get();
        return $query->result();
    }
}
