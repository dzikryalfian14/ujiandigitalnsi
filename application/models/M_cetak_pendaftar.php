<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_cetak_pendaftar extends CI_Model
{
    public function cetak()
    {
        $this->db->select('*');
        $this->db->from('tb_siswa');
        $query = $this->db->get();
        return $query->result();
    }
}
