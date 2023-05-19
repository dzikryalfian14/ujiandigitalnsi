<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_siswa extends CI_Model
{
    public function importData($data)
    {
        // Membaca data siswa dari array dan memasukkannya ke dalam tabel tb_siswa
        $this->db->insert_batch('tb_siswa', $data);
    }
    public function getAllSiswa()
    {
        $query = $this->db->get('tb_siswa');
        return $query->result();
    }
}
    