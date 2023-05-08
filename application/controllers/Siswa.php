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
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat ! <br></b> Anda telah berhasil menambahkan data siswa</div>');
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
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat ! <br></b> Anda telah berhasil mengupdate data siswa</div>');
		redirect(base_url('siswa'));
	}

	public function hapus($id)
	{
		$where = array(
			'id_siswa' => $id
		);
		$this->m_data->delete_data($where, 'tb_siswa');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-check"></i><b>Selamat ! <br></b> Anda telah berhasil menghapus data siswa</div>');
		redirect(base_url('siswa'));
	}

	public function import()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xlsx|xls';
		$config['max_size'] = '2048';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file')) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('message', '<div class="alert alert-danger">' . $this->upload->display_errors() . '</div>');
			redirect('siswa');
		} else {
			$file_data = $this->upload->data();
			$inputFileName = './uploads/' . $file_data['file_name'];
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
			$spreadsheet = $reader->load($inputFileName);
			$worksheet = $spreadsheet->getActiveSheet();
			$highestRow = $worksheet->getHighestRow();
			$highestColumn = $worksheet->getHighestColumn();
			$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
			$rowData = array();

			for ($row = 2; $row <= $highestRow; ++$row) {
				$rowData[] = array(
					'nis' => $worksheet->getCellByColumnAndRow(1, $row)->getValue(),
					'nama_siswa' => $worksheet->getCellByColumnAndRow(2, $row)->getValue(),
					'id_kelas' => $worksheet->getCellByColumnAndRow(3, $row)->getValue(),
					'username' => $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
					'password' => password_hash($worksheet->getCellByColumnAndRow(5, $row)->getValue(), PASSWORD_DEFAULT),
				);
			}

			$this->load->model('M_import');
			$this->M_import->import($rowData);

			$this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil diimport</div>');
			redirect('siswa');
		}
	}


	// public function import()
	// {
	// 	// Load library PHPExcel
	// 	require_once(APPPATH . 'third_party/PHPExcel/PHPExcel.php');

	// 	// Load model Siswa_model
	// 	$this->load->model('Siswa_model');

	// 	// Load file upload library
	// 	$this->load->library('upload');

	// 	// Set preferences for file upload
	// 	$config['upload_path'] = './uploads/';
	// 	$config['allowed_types'] = 'xls|xlsx';
	// 	$config['max_size'] = '2000';

	// 	// Initialize the upload class
	// 	$this->upload->initialize($config);

	// 	// Check if a file was uploaded
	// 	if (!$this->upload->do_upload('file')) {
	// 		// If no file was uploaded, show an error message
	// 		$this->session->set_flashdata('error', 'Silahkan pilih file Excel untuk diimport!');
	// 		redirect('siswa');
	// 	} else {
	// 		// If a file was uploaded, load the file using PHPExcel Reader
	// 		$inputFileName = './uploads/' . $this->upload->data('file_name');
	// 		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
	// 		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
	// 		$objPHPExcel = $objReader->load($inputFileName);

	// 		// Get the active worksheet
	// 		$worksheet = $objPHPExcel->getActiveSheet();

	// 		// Get the highest row and column numbers from the worksheet
	// 		$highestRow = $worksheet->getHighestRow();
	// 		$highestColumn = $worksheet->getHighestColumn();

	// 		// Loop through each row of the worksheet
	// 		for ($row = 2; $row <= $highestRow; $row++) {
	// 			// Get the row data as an array
	// 			$rowData = $worksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

	// 			// Insert the row data into the database
	// 			$siswa = array(
	// 				'id_kelas' => $rowData[0][0],
	// 				'nama_siswa' => $rowData[0][1],
	// 				'nis' => $rowData[0][2],
	// 				'username' => $rowData[0][3],
	// 				'password' => $rowData[0][4]
	// 			);
	// 			$this->Siswa_model->insert_siswa($siswa);
	// 		}

	// 		// Delete the uploaded file
	// 		unlink($inputFileName);

	// 		// Redirect to the Siswa list page with success message
	// 		$this->session->set_flashdata('success', 'Data siswa berhasil diimport!');
	// 		redirect('siswa');
	// 	}
	// }


	// public function import()
	// {
	// 	$config['upload_path'] = './uploads/';
	// 	$config['allowed_types'] = 'xlsx|xls';
	// 	$config['max_size'] = 2000;

	// 	$this->load->library('upload', $config);
	// 	$this->load->library('Spreadsheet');

	// 	if (!$this->upload->do_upload('file_excel')) {
	// 		$error = $this->upload->display_errors();
	// 		$this->session->set_flashdata('error', $error);
	// 		redirect('siswa');
	// 	} else {
	// 		$file = $this->upload->data('full_path');
	// 		$spreadsheet = $this->spreadsheet->loadSpreadsheet($file);

	// 		$worksheet = $spreadsheet->getActiveSheet();
	// 		$rows = $worksheet->toArray();
	// 		$num_rows = count($rows);

	// 		$data = array();
	// 		$error = 0;

	// 		for ($i = 1; $i < $num_rows; $i++) {
	// 			$nis = $rows[$i][0];
	// 			$nama_siswa = $rows[$i][1];
	// 			$id_kelas = $rows[$i][2];
	// 			$username = $rows[$i][3];
	// 			$password = $rows[$i][4];

	// 			$kelas = $this->siswa_model->get_kelas_by_nama($id_kelas);

	// 			if (!$kelas) {
	// 				$this->session->set_flashdata('error', 'Gagal import data. Nama kelas tidak ditemukan.');
	// 				$error++;
	// 				continue;
	// 			}

	// 			$data[] = array(
	// 				'nis' => $nis,
	// 				'nama_siswa' => $nama_siswa,
	// 				'id_kelas' => $kelas->id_kelas,
	// 				'username' => $username,
	// 				'password' => $password,
	// 			);
	// 		}

	// 		if ($error > 0) {
	// 			$this->session->set_flashdata('error', 'Gagal import data. Ada kesalahan pada data yang diimpor.');
	// 		} else {
	// 			if ($this->siswa_model->insert_batch($data)) {
	// 				$this->session->set_flashdata('success', 'Data siswa berhasil diimpor.');
	// 			} else {
	// 				$this->session->set_flashdata('error', 'Gagal import data. Terjadi kesalahan saat menyimpan data.');
	// 			}
	// 		}

	// 		redirect('siswa');
	// 	}
	// }

	// public function import()
	// {
	// 	// Load library Spreadsheet Reader
	// 	require_once(APPPATH . 'third_party/SpreadsheetReader/php-excel-reader/excel_reader2.php');
	// 	require_once(APPPATH . 'third_party/SpreadsheetReader/SpreadsheetReader.php');

	// 	// Load model Siswa_model
	// 	$this->load->model('Siswa_model');

	// 	// Load file upload library
	// 	$this->load->library('upload');

	// 	// Set preferences for file upload
	// 	$config['upload_path'] = './uploads/';
	// 	$config['allowed_types'] = 'xls|xlsx';
	// 	$config['max_size'] = '2000';

	// 	// Initialize the upload class
	// 	$this->upload->initialize($config);

	// 	// Check if a file was uploaded
	// 	if (!$this->upload->do_upload('file')) {
	// 		// If no file was uploaded, show an error message
	// 		$this->session->set_flashdata('error', 'Silahkan pilih file Excel untuk diimport!');
	// 		redirect('siswa');
	// 	} else {
	// 		// If a file was uploaded, load the file using Spreadsheet Reader
	// 		$inputFileName = './uploads/' . $this->upload->data('file_name');
	// 		$reader = new \SpreadsheetReader($inputFileName);

	// 		// Get the worksheet data
	// 		$worksheets = $reader->Sheets();
	// 		$data = $reader->Sheets($worksheets[0]);

	// 		// Loop through each row of the worksheet
	// 		foreach ($data as $key => $row) {
	// 			// Skip the header row
	// 			if ($key == 0) continue;

	// 			// Insert the row data into the database
	// 			$siswa = array(
	// 				'id_kelas' => $row[0],
	// 				'nama_siswa' => $row[1],
	// 				'nis' => $row[2],
	// 				'username' => $row[3],
	// 				'password' => $row[4]
	// 			);
	// 			$this->Siswa_model->insert_siswa($siswa);
	// 		}

	// 		// Delete the uploaded file
	// 		unlink($inputFileName);

	// 		// Redirect to the Siswa list page with success message
	// 		$this->session->set_flashdata('success', 'Data siswa berhasil diimport!');
	// 		redirect('siswa');
	// 	}
	// }

	// public function import()
	// {
	// 	// Load model Siswa_model
	// 	$this->load->model('Siswa_model');

	// 	// Load file upload library
	// 	$this->load->library('upload');

	// 	// Set preferences for file upload
	// 	$config['upload_path'] = './uploads/';
	// 	$config['allowed_types'] = 'xls|xlsx|csv';
	// 	$config['max_size'] = '2000';

	// 	// Initialize the upload class
	// 	$this->upload->initialize($config);

	// 	// Check if a file was uploaded
	// 	if (!$this->upload->do_upload('file')) {
	// 		// If no file was uploaded, show an error message
	// 		$this->session->set_flashdata('error', 'Silahkan pilih file Excel untuk diimport!');
	// 		redirect('siswa');
	// 	} else {
	// 		// If a file was uploaded, load the file using Spreadsheet Reader
	// 		$inputFileName = './uploads/' . $this->upload->data('file_name');
	// 		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	// 		$spreadsheet = $reader->load($inputFileName);

	// 		// Get the active worksheet
	// 		$worksheet = $spreadsheet->getActiveSheet();

	// 		// Get the highest row and column numbers from the worksheet
	// 		$highestRow = $worksheet->getHighestRow();
	// 		$highestColumn = $worksheet->getHighestColumn();

	// 		// Loop through each row of the worksheet
	// 		for ($row = 2; $row <= $highestRow; $row++) {
	// 			// Get the row data as an array
	// 			$rowData = $worksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

	// 			// Insert the row data into the database
	// 			$siswa = array(
	// 				'id_kelas' => $rowData[0][0],
	// 				'nama_siswa' => $rowData[0][1],
	// 				'nis' => $rowData[0][2],
	// 				'username' => $rowData[0][3],
	// 				'password' => $rowData[0][4]
	// 			);
	// 			$this->Siswa_model->insert_siswa($siswa);
	// 		}

	// 		// Delete the uploaded file
	// 		unlink($inputFileName);

	// 		// Redirect to the Siswa list page with success message
	// 		$this->session->set_flashdata('success', 'Data siswa berhasil diimport!');
	// 		redirect('siswa');
	// 	}
	// }
}
