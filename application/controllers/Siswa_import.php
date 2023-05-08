<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_Import extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Import');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('PhpSpreadsheet');
    }

    public function index()
    {
        $data['siswa'] = $this->M_import->get_siswa();
        $this->load->view('v_siswa', $data);
    }

    public function import()
    {
        // Load library PHP Spreadsheet
        $this->load->library('PhpSpreadsheet');

        // Ambil nama file Excel dari form
        $file_name = $_FILES['file_excel']['name'];

        // Ambil path file Excel
        $file_path = $_FILES['file_excel']['tmp_name'];

        // Baca file Excel
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_path);
        $worksheet = $spreadsheet->getActiveSheet();

        // Looping baris data di file Excel
        foreach ($worksheet->getRowIterator() as $row) {
            // Ambil nilai dari setiap kolom pada baris tersebut
            $nama_siswa = $worksheet->getCellByColumnAndRow(0, $row->getRowIndex())->getValue();
            $nis = $worksheet->getCellByColumnAndRow(1, $row->getRowIndex())->getValue();
            $id_kelas = $worksheet->getCellByColumnAndRow(2, $row->getRowIndex())->getValue();
            $username = $worksheet->getCellByColumnAndRow(3, $row->getRowIndex())->getValue();
            $password = $worksheet->getCellByColumnAndRow(4, $row->getRowIndex())->getValue();

            // Masukkan data siswa ke dalam array
            $data = array(
                'nama_siswa' => $nama_siswa,
                'nis' => $nis,
                'id_kelas' => $id_kelas,
                'username' => $username,
                'password' => $password
            );

            // Insert data siswa ke dalam database
            $this->M_import->import_siswa($data);
        }

        // Redirect ke halaman utama setelah selesai mengimport data
        redirect(base_url('v_siswa'));
    }
}
