<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_essay extends CI_Model
{
    public function get_joinsoalessay($id)
    {
        $query = 'SELECT * FROM tb_soal_essay join tb_mapel_essay ON tb_soal_essay.id_mapel_essay=tb_mapel_essay.id_mapel_essay WHERE tb_soal_essay.id_soal_essay="' . $id . '"';
        return $this->db->query($query);
    }
}
