<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
    public function get_kelas_by_nama($id_kelas)
    {
        $query = $this->db->get_where('tb_kelas', array('id_kelas' => $id_kelas));
        return $query->row_array();
    }

    public function insert_siswa($siswa)
    {
        return $this->db->insert('tb_siswa', $siswa);
    }

    public function get_all_siswa()
    {
        $this->db->select('*');
        $this->db->from('tb_siswa');
        $this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_siswa($id_siswa)
    {
        return $this->db->delete('tb_siswa)
        siswa', array('id_siswa' => $id_siswa));
    }
}
