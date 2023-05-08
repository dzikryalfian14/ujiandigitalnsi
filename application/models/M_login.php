<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_login extends CI_Model
{

	public function login($data)
	{
		$this->db->select('password');
		$this->db->from('admin');
		$this->db->where('username', $data['username']);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			$record = $query->row_array();
			return password_verify($data['password'], $record['password']);
		} else {
			return false;
		}
	}
}
