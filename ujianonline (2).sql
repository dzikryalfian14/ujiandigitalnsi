-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 08:29 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujianonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `nama_user` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama_user`, `username`, `password`) VALUES
(1, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int(11) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nama_guru`, `username`, `password`) VALUES
(123132131, 'Ngab Owo', 'Prabowo', 'Subianto');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jawaban`
--

CREATE TABLE `tb_jawaban` (
  `id_jawaban` int(5) NOT NULL,
  `id_peserta` int(5) NOT NULL,
  `id_soal_ujian` int(5) NOT NULL,
  `jawaban` varchar(15) NOT NULL,
  `skor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jawaban_essay`
--

CREATE TABLE `tb_jawaban_essay` (
  `id_jawaban_essay` int(20) NOT NULL,
  `id_peserta_essay` int(20) NOT NULL,
  `id_soal_essay` int(20) NOT NULL,
  `jawaban` varchar(100) CHARACTER SET latin1 NOT NULL,
  `nilai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jawaban_essay`
--

INSERT INTO `tb_jawaban_essay` (`id_jawaban_essay`, `id_peserta_essay`, `id_soal_essay`, `jawaban`, `nilai`) VALUES
(1, 1, 104, '1', 10),
(2, 1, 65, '2', 10),
(3, 1, 64, '3', 10),
(4, 1, 67, '4', 10),
(5, 1, 66, '5', 10),
(6, 1, 106, '6', 10),
(7, 1, 68, '7', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_ujian`
--

CREATE TABLE `tb_jenis_ujian` (
  `id_jenis_ujian` int(11) NOT NULL,
  `jenis_ujian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenis_ujian`
--

INSERT INTO `tb_jenis_ujian` (`id_jenis_ujian`, `jenis_ujian`) VALUES
(1, 'Ujian Pertama'),
(3, 'Ujian Kedua'),
(4, 'Ujian Ketiga');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_ujian_essay`
--

CREATE TABLE `tb_jenis_ujian_essay` (
  `id_jenis_ujian_essay` int(20) NOT NULL,
  `jenis_ujian_essay` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jenis_ujian_essay`
--

INSERT INTO `tb_jenis_ujian_essay` (`id_jenis_ujian_essay`, `jenis_ujian_essay`) VALUES
(5, 'Ujian Gelombang 1'),
(6, 'Ujian Gelombang 2'),
(7, 'Ujian Gelombang 3'),
(8, 'Ujian Gelombang 4'),
(9, 'Ujian Gelombang 5');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`) VALUES
(8, 'R. Training'),
(9, 'R. Kantin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel_essay`
--

CREATE TABLE `tb_mapel_essay` (
  `id_mapel_essay` int(20) NOT NULL,
  `kode_mapel_essay` varchar(20) CHARACTER SET latin1 NOT NULL,
  `nama_mapel_essay` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mapel_essay`
--

INSERT INTO `tb_mapel_essay` (`id_mapel_essay`, `kode_mapel_essay`, `nama_mapel_essay`) VALUES
(6, '1', 'Penalaran Logika'),
(7, '2', 'Aritmatika'),
(8, '3', 'Test Kemampuan Verbal');

-- --------------------------------------------------------

--
-- Table structure for table `tb_matapelajaran`
--

CREATE TABLE `tb_matapelajaran` (
  `id_matapelajaran` int(11) NOT NULL,
  `kode_matapelajaran` varchar(10) NOT NULL,
  `nama_matapelajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_matapelajaran`
--

INSERT INTO `tb_matapelajaran` (`id_matapelajaran`, `kode_matapelajaran`, `nama_matapelajaran`) VALUES
(27, '1', 'Ujian Psikotest'),
(28, '2', 'Matematika Dasar'),
(29, '3', 'Wawasan Kebangsaan'),
(30, '4', 'Ujian Kemampuan Logika');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peserta`
--

CREATE TABLE `tb_peserta` (
  `id_peserta` int(11) NOT NULL,
  `id_matapelajaran` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_jenis_ujian` int(11) NOT NULL,
  `tanggal_ujian` date NOT NULL,
  `jam_ujian` time NOT NULL,
  `durasi_ujian` int(11) NOT NULL,
  `timer_ujian` int(11) NOT NULL,
  `status_ujian` tinyint(1) NOT NULL,
  `status_ujian_ujian` int(11) NOT NULL,
  `benar` varchar(20) NOT NULL,
  `salah` varchar(20) NOT NULL,
  `nilai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_peserta_essay`
--

CREATE TABLE `tb_peserta_essay` (
  `id_peserta_essay` int(20) NOT NULL,
  `id_mapel_essay` int(20) NOT NULL,
  `id_siswa` int(20) NOT NULL,
  `id_jenis_ujian_essay` int(20) NOT NULL,
  `tanggal_ujian` date NOT NULL,
  `jam_ujian` time NOT NULL,
  `durasi_ujian` int(11) NOT NULL,
  `timer_ujian` int(11) NOT NULL,
  `status_ujian` tinyint(1) NOT NULL,
  `status_ujian_ujian` int(11) NOT NULL,
  `nilai_essay` int(10) NOT NULL,
  `status_koreksi` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_peserta_essay`
--

INSERT INTO `tb_peserta_essay` (`id_peserta_essay`, `id_mapel_essay`, `id_siswa`, `id_jenis_ujian_essay`, `tanggal_ujian`, `jam_ujian`, `durasi_ujian`, `timer_ujian`, `status_ujian`, `status_ujian_ujian`, `nilai_essay`, `status_koreksi`) VALUES
(1, 6, 1, 5, '2023-05-23', '11:11:00', 20, 1200, 2, 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `nis` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `id_kelas`, `nama_siswa`, `nis`, `username`, `password`) VALUES
(1, 8, 'Dzikry Alfian(Test Developer)', 11111, 'dzikry', 'dzikry'),
(2, 8, 'Muhammad Solahudin ', 11236, 'udin', 'udin'),
(3, 8, 'Fabin Wantara', 88907, 'fabin', 'fabin'),
(4, 8, 'Stevanus Ertito', 44567, 'tito', 'tito'),
(5, 8, 'Takiya Edi', 11243, 'edi', 'edi'),
(6, 9, 'Yaya Baitur Rohman', 12121, 'yaya', 'yaya'),
(7, 9, 'Irul Daratista', 13131, 'irul', 'irul'),
(8, 9, 'Naruto Uzumaki', 31313, 'naruto', 'naruto'),
(9, 9, 'Sasuke Uciha', 12112, 'saskeh', 'saskeh'),
(10, 9, 'Ali bin Jiraiya ', 12476, 'jiraya', 'jiraya'),
(11, 9, 'Obito Uciha', 33567, 'obito', 'obito'),
(12, 9, 'Madara Uciha', 22145, 'madara', 'madara'),
(13, 9, 'Boku no Pico', 33907, 'pico', 'pico');

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal_essay`
--

CREATE TABLE `tb_soal_essay` (
  `id_soal_essay` int(10) NOT NULL,
  `id_mapel_essay` int(10) NOT NULL,
  `pertanyaan` varchar(500) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `jawaban` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_soal_essay`
--

INSERT INTO `tb_soal_essay` (`id_soal_essay`, `id_mapel_essay`, `pertanyaan`, `gambar`, `jawaban`) VALUES
(43, 5, 'Perusahaan nihon berdiri sejak tahun berapa?', '', 'Mudah'),
(45, 2, '<p>Apakah ini bisa masuk?</p>', '', 'Sulit'),
(46, 2, '<p>2, 4, 8, 10, ...</p>', '', 'Mudah'),
(51, 5, 'apa ya ges ya', '', 'Mudah'),
(64, 6, '<p>Semua dokter adalah laki-laki maka....</p>', '', 'Mudah'),
(65, 6, '<p>Hesti, Beli, Penky, dan Meli adalah mahasiswa satu angkatan dari universitas yang sama. Hesti lulus sebelum Beli, tetapi sesudah Penky, dan Meli lulus sebelum Hesti.<br></p>', '', 'Sedang'),
(66, 6, '<p>Beberapa dosen bergabung dalam tim karawitan. Tim karawitan tidak ada yang menjadi pemain tenis.<br></p>', '', 'Sedang '),
(67, 6, '<p>Selama semester ini Budi belum pernah mendapat nilai lebih baik daripada temantemannya. Heru- termasuk dari separuh siswa yang terpandai di kelasnya. Agus lebih pandai daripada Heru dalam pelajaran matematika, tetapi ulangan biologinya lebih rendah daripada hasil ulangan Budi.<br></p>', '', 'Susah'),
(68, 6, '<p>Semua bayi minum ASI. Sebagian bayi diberi makanan tambahan. Semua bayi minum ASI dan diberi makanan tambahan.<br></p>', '', 'Mudah'),
(69, 7, '<p>Diketahui barisan aritmetika: 5, 7, 9, 11, ....,<br></p>', '', 'Sedang '),
(70, 7, '<p>Jika suku ketiga dan ketujuh suatu barisan aritmetika adalah 11 dan 19. Maka suku ke-11 dari barisan tersebut adalah ....<br></p>', '', 'Susah'),
(102, 7, '<p><b>Soal Gambar coba 1&nbsp;</b></p>', 'uploads/soal_psikotest5.png', 'Susah'),
(104, 6, '<pre>Test gambar 2</pre>', 'uploads/mbti_saya2.png', 'Mudah'),
(106, 6, '<p>eqweqeqweqwe</p>', 'uploads/tagihan_kuliah.png', 'ez');

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal_ujian`
--

CREATE TABLE `tb_soal_ujian` (
  `id_soal_ujian` int(11) NOT NULL,
  `id_matapelajaran` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `e` text NOT NULL,
  `kunci_jawaban` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_soal_ujian` (`id_soal_ujian`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indexes for table `tb_jawaban_essay`
--
ALTER TABLE `tb_jawaban_essay`
  ADD PRIMARY KEY (`id_jawaban_essay`),
  ADD KEY `id_peserta` (`id_peserta_essay`),
  ADD KEY `id_soal_ujian` (`id_soal_essay`);

--
-- Indexes for table `tb_jenis_ujian`
--
ALTER TABLE `tb_jenis_ujian`
  ADD PRIMARY KEY (`id_jenis_ujian`);

--
-- Indexes for table `tb_jenis_ujian_essay`
--
ALTER TABLE `tb_jenis_ujian_essay`
  ADD PRIMARY KEY (`id_jenis_ujian_essay`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_mapel_essay`
--
ALTER TABLE `tb_mapel_essay`
  ADD PRIMARY KEY (`id_mapel_essay`);

--
-- Indexes for table `tb_matapelajaran`
--
ALTER TABLE `tb_matapelajaran`
  ADD PRIMARY KEY (`id_matapelajaran`);

--
-- Indexes for table `tb_peserta`
--
ALTER TABLE `tb_peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_matakuliah` (`id_matapelajaran`),
  ADD KEY `id_mahasiswa` (`id_siswa`),
  ADD KEY `id_jenis_ujian` (`id_jenis_ujian`);

--
-- Indexes for table `tb_peserta_essay`
--
ALTER TABLE `tb_peserta_essay`
  ADD PRIMARY KEY (`id_peserta_essay`),
  ADD KEY `id_mapel_essay` (`id_mapel_essay`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_jenis_ujian` (`id_jenis_ujian_essay`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nim` (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tb_soal_essay`
--
ALTER TABLE `tb_soal_essay`
  ADD PRIMARY KEY (`id_soal_essay`),
  ADD KEY `id_matapelajaran` (`id_mapel_essay`);

--
-- Indexes for table `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  ADD PRIMARY KEY (`id_soal_ujian`),
  ADD KEY `id_matakuliah` (`id_matapelajaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  MODIFY `id_jawaban` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_jawaban_essay`
--
ALTER TABLE `tb_jawaban_essay`
  MODIFY `id_jawaban_essay` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_jenis_ujian`
--
ALTER TABLE `tb_jenis_ujian`
  MODIFY `id_jenis_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_jenis_ujian_essay`
--
ALTER TABLE `tb_jenis_ujian_essay`
  MODIFY `id_jenis_ujian_essay` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_mapel_essay`
--
ALTER TABLE `tb_mapel_essay`
  MODIFY `id_mapel_essay` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_matapelajaran`
--
ALTER TABLE `tb_matapelajaran`
  MODIFY `id_matapelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_peserta`
--
ALTER TABLE `tb_peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_peserta_essay`
--
ALTER TABLE `tb_peserta_essay`
  MODIFY `id_peserta_essay` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_soal_essay`
--
ALTER TABLE `tb_soal_essay`
  MODIFY `id_soal_essay` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  MODIFY `id_soal_ujian` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
