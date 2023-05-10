<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_reset extends CI_Model
{


	public function mytruncate()
	{

		$this->db->truncate('tb_peserta');
		$this->db->truncate('tb_jawaban');
		$this->db->truncate('tb_soal_ujian');
		$this->db->truncate('tb_peserta_essay');
		$this->db->truncate('tb_jawaban_essay');
		$this->db->truncate('tb_soal_ujian_essay');
	}
}
