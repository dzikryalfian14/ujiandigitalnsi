<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_import extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function import_siswa($data)
    {
        $this->db->insert_batch('siswa', $data);
    }
}
