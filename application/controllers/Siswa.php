<?php
defined('BASEPATH') or exit('No direct script access allowed');


use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class siswa extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		if ($this->session->userdata('status') != 'admin_login') {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{
		$data['siswa'] = $this->db->query('SELECT * FROM tb_siswa join tb_kelas ON tb_siswa.id_kelas=tb_kelas.id_kelas')->result();
		$data['kelas'] = $this->m_data->get_data('tb_kelas')->result();

		$this->load->view('admin/v_siswa', $data);
	}

	public function create()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => 'Nama harus di isi!']);
		$this->form_validation->set_rules('nis', 'nis', 'required|trim|is_unique[tb_siswa.nis]', ['required' => 'nis harus di isi!']);
		$this->form_validation->set_rules('kelas', 'Kelas', 'required|trim', ['required' => 'Kelas harus di pilih!']);
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_siswa.username]', ['required' => 'Username harus di isi!']);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password harus di isi!']);

		$nama 		= htmlspecialchars($this->input->post('nama', TRUE));
		$nis		= htmlspecialchars($this->input->post('nis', TRUE));
		$kelas 		= htmlspecialchars($this->input->post('kelas', TRUE));
		$username	= htmlspecialchars($this->input->post('username', TRUE));
		$password	= htmlspecialchars($this->input->post('password', TRUE));

		if ($this->form_validation->run() != false) {
			$data = array(
				'nama_siswa' => $nama,
				'nis' => $nis,
				'id_kelas' => $kelas,
				'username' => $username,
				'password' => $password,
			);

			$this->m_data->insert_data($data, 'tb_siswa');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat ! <br></b> Anda telah berhasil menambahkan data peserta</div>');
			redirect(base_url('siswa'));
		} else {
			$data['kelas'] = $this->m_data->get_data('tb_kelas')->result();
			$this->load->view('admin/v_siswa_tambah', $data);
		}
	}

	public function edit($id)
	{
		$data['siswa'] = $this->m_data->get_joinsiswa($id)->result();
		$data['kelas'] = $this->m_data->get_data('tb_kelas')->result();
		$this->load->view('admin/v_siswa_edit', $data);
	}

	public function update()
	{
		$id 		= $this->input->post('id');
		$nama 		= $this->input->post('nama');
		$nis		= $this->input->post('nis');
		$kelas		= $this->input->post('kelas');
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');

		$where = array('id_siswa' => $id);

		if ($password == "") {
			$data = array(
				'nama_siswa' => $nama,
				'nis' => $nis,
				'id_kelas' => $kelas,
				'username' => $username
			);
			$this->m_data->update_data($where, $data, 'tb_siswa');
		} else {
			$data = array(
				'nama_siswa' => $nama,
				'nis'		 => $nis,
				'id_kelas' 	 => $kelas,
				'username' 	 => $username,
				'password' 	 => $password,
			);
			$this->m_data->update_data($where, $data, 'tb_siswa');
		}
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat ! <br></b> Anda telah berhasil mengupdate data peserta</div>');
		redirect(base_url('siswa'));
	}

	public function hapus($id)
	{
		$where = array(
			'id_siswa' => $id
		);
		$this->m_data->delete_data($where, 'tb_siswa');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-check"></i><b>Selamat ! <br></b> Anda telah berhasil menghapus data peserta</div>');
		redirect(base_url('siswa'));
	}

	public function hapusall()
	{
		$this->m_data->truncate_table('tb_siswa');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-check"></i><b>Selamat ! <br></b> Anda telah berhasil menghapus semua data peserta</div>');
		redirect(base_url('siswa'));
	}


	public function import()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xlsx|xls';
		$config['max_size'] = '2048';

		$this->load->library('upload', $config);

		// Check if a file has been selected before uploading
		if (!$this->upload->do_upload('excel_file')) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('message', '<div class="alert alert-danger">' . $this->upload->display_errors() . '</div>');
			redirect('siswa');
		} else {
			// Process the imported data
			$file_data = $this->upload->data();
			$inputFileName = './uploads/' . $file_data['file_name'];

			$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
			$worksheet = $spreadsheet->getActiveSheet();
			$highestRow = $worksheet->getHighestRow();
			$highestColumn = $worksheet->getHighestColumn();
			$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

			$data = array();

			for ($row = 2; $row <= $highestRow; ++$row) {
				$data[] = array(
					'id_siswa' => $worksheet->getCellByColumnAndRow(1, $row)->getValue(),
					'id_kelas' => $worksheet->getCellByColumnAndRow(2, $row)->getValue(),
					'nama_siswa' => $worksheet->getCellByColumnAndRow(3, $row)->getValue(),
					'nis' => $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
					'username' => $worksheet->getCellByColumnAndRow(5, $row)->getValue(),
					'password' => $worksheet->getCellByColumnAndRow(6, $row)->getValue(),
				);
			}

			$this->load->model('M_siswa');
			$this->M_siswa->importData($data); // Assuming you have a method called importData() in your M_siswa model

			// Get the updated data from the database
			$siswa = $this->M_siswa->getAllSiswa(); // Assuming you have a method called getAllData() in your M_siswa model to retrieve all the imported data

			$this->load->view('admin/v_siswa', ['siswa' => $siswa]); // Replace 'your_view_file' with the actual view file where you want to display the table

			$this->session->set_flashdata('message', '<div class="alert alert-success">Data peserta berhasil diimport</div>');
		}

		redirect('siswa');
	}


	// public function import()
	// {
	// 	$config['upload_path'] = './uploads/';
	// 	$config['allowed_types'] = 'xlsx|xls';
	// 	$config['max_size'] = '2048';

	// 	$this->load->library('upload', $config);

	// 	// Check if a file has been selected before uploading
	// 	if (!$this->upload->do_upload('excel_file')) {
	// 		$error = array('error' => $this->upload->display_errors());
	// 		$this->session->set_flashdata('message', '<div class="alert alert-danger">' . $this->upload->display_errors() . '</div>');
	// 		redirect('siswa');
	// 	} else {
	// 		// Process the imported data
	// 		$file_data = $this->upload->data();
	// 		$inputFileName = './uploads/' . $file_data['file_name'];

	// 		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
	// 		$worksheet = $spreadsheet->getActiveSheet();
	// 		$highestRow = $worksheet->getHighestRow();
	// 		$highestColumn = $worksheet->getHighestColumn();
	// 		$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

	// 		$data = array();

	// 		for ($row = 2; $row <= $highestRow; ++$row) {
	// 			$data[] = array(
	// 				'id_siswa' => $worksheet->getCellByColumnAndRow(1, $row)->getValue(),
	// 				'id_kelas' => $worksheet->getCellByColumnAndRow(2, $row)->getValue(),
	// 				'nama_siswa' => $worksheet->getCellByColumnAndRow(3, $row)->getValue(),
	// 				'nis' => $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
	// 				'username' => $worksheet->getCellByColumnAndRow(5, $row)->getValue(),
	// 				'password' => $worksheet->getCellByColumnAndRow(6, $row)->getValue(),
	// 			);
	// 		}

	// 		$this->load->model('M_siswa');
	// 		$this->M_siswa->importData($data); // Assuming you have a method called importData() in your M_siswa model

	// 		$this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil diimport</div>');
	// 	}

	// 	redirect('siswa');
	// }
}
