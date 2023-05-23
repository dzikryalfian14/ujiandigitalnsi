<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_hasil_essay extends CI_Model
{
    public function get_peserta2($id)
    {
        $this->db->select('*');
        $this->db->from('tb_peserta_essay');
        $this->db->join('tb_mapel_essay', 'tb_peserta_essay.id_mapel_essay=tb_mapel_essay.id_mapel_essay');
        $this->db->join('tb_jenis_ujian_essay', 'tb_peserta_essay.id_jenis_ujian_essay=tb_jenis_ujian_essay.id_jenis_ujian_essay');
        $this->db->join('tb_siswa', 'tb_peserta_essay.id_siswa=tb_siswa.id_siswa');
        $this->db->where('tb_peserta_essay.id_mapel_essay', $id);
        $this->db->order_by('nilai_essay', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_peserta3()
    {
        $this->db->select('*');
        $this->db->from('tb_peserta_essay');
        $this->db->join('tb_mapel_essay', 'tb_peserta_essay.id_mapel_essay=tb_mapel_essay.id_mapel_essay');
        $this->db->join('tb_jenis_ujian_essay', 'tb_peserta_essay.id_jenis_ujian_essay=tb_jenis_ujian_essay.id_jenis_ujian_essay');
        $this->db->join('tb_siswa', 'tb_peserta_essay.id_siswa=tb_siswa.id_siswa');
        $this->db->order_by('nilai_essay', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_status($id)
    {
        $this->db->select('*');
        $this->db->from('tb_peserta_essay');
        $this->db->join('tb_mapel_essay', 'tb_peserta_essay.id_mapel_essay=tb_mapel_essay.id_mapel_essay');
        $this->db->join('tb_jenis_ujian_essay', 'tb_peserta_essay.id_jenis_ujian_essay=tb_jenis_ujian_essay.id_jenis_ujian_essay');
        $this->db->join('tb_siswa', 'tb_peserta_essay.id_siswa=tb_siswa.id_siswa');
        $this->db->order_by('status_ujian', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_jawaban_essay()
    {
        $this->db->select('*');
    }

    public function cetak($id)
    {
        $this->db->select('*');
        $this->db->from('tb_peserta_essay');
        $this->db->join('tb_mapel_essay', 'tb_peserta_essay.id_mapel_essay=tb_mapel_essay.id_mapel_essay');
        $this->db->join('tb_jenis_ujian_essay', 'tb_peserta_essay.id_jenis_ujian_essay=tb_jenis_ujian_essay.id_jenis_ujian_essay');
        $this->db->join('tb_siswa', 'tb_peserta_essay.id_siswa=tb_siswa.id_siswa');
        $this->db->where('tb_peserta_essay.id_peserta_essay', $id);
        $query = $this->db->get();
        return $query->result();
    }


    public function update_nilai($id_peserta_essay, $data)
    {
        $this->db->where('id_peserta_essay', $id_peserta_essay);
        $this->db->update('tb_hasil_essay', $data);
    }

    public function get_total_nilai_per_peserta($id_peserta)
    {
        $this->db->select_sum('nilai');
        $this->db->where('id_peserta_essay', $id_peserta);
        $query = $this->db->get('tb_jawaban_essay');

        return $query->row()->nilai;
    }
}
