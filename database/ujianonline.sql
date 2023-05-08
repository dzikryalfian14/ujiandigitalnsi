-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2023 at 03:38 AM
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
(12321431, 'fabin', 'fabin', 'fabin');

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

--
-- Dumping data for table `tb_jawaban`
--

INSERT INTO `tb_jawaban` (`id_jawaban`, `id_peserta`, `id_soal_ujian`, `jawaban`, `skor`) VALUES
(1, 2, 1, 'A', '1'),
(2, 2, 1, 'A', '1'),
(3, 2, 1, 'A', '1'),
(4, 7, 1, 'A', '1'),
(5, 7, 2, 'B', '0'),
(6, 9, 1, 'D', '0'),
(7, 10, 1, 'C', '1'),
(8, 10, 2, 'A', '1'),
(9, 13, 7, 'A', '1'),
(10, 13, 6, 'B', '0'),
(11, 15, 7, 'A', '1'),
(12, 15, 8, 'D', '1'),
(13, 15, 6, 'A', '1'),
(14, 17, 9, 'A', '1'),
(15, 17, 8, 'D', '1'),
(16, 17, 7, 'A', '1'),
(17, 17, 6, 'E', '0'),
(18, 14, 8, 'E', '0'),
(19, 14, 6, 'E', '0'),
(20, 14, 7, 'A', '1'),
(21, 14, 9, 'E', '0'),
(22, 24, 17, 'D', '1'),
(23, 24, 19, 'B', '1'),
(24, 24, 18, 'B', '1'),
(25, 24, 20, 'B', '0'),
(26, 24, 16, 'C', '1'),
(27, 25, 18, 'A', '0'),
(28, 25, 16, 'C', '1'),
(29, 25, 17, 'B', '0'),
(30, 25, 19, 'C', '0'),
(31, 25, 20, 'C', '1'),
(32, 26, 19, 'B', '1'),
(33, 26, 20, 'C', '1'),
(34, 26, 18, 'B', '1'),
(35, 26, 16, 'C', '1'),
(36, 26, 17, 'D', '1'),
(37, 27, 35, 'B', '1'),
(38, 28, 37, 'A', '0'),
(39, 28, 35, 'C', '0'),
(40, 29, 37, 'D', '0'),
(41, 29, 35, 'C', '0'),
(42, 35, 37, 'B', '1'),
(43, 35, 35, 'A', '0'),
(44, 31, 35, 'C', '0'),
(45, 31, 37, 'C', '0'),
(46, 36, 37, 'C', '0'),
(47, 36, 35, 'A', '0'),
(48, 36, 35, 'A', '0'),
(49, 36, 37, 'C', '0'),
(50, 36, 35, 'B', '1'),
(51, 36, 37, 'A', '0'),
(52, 36, 35, 'E', '0'),
(53, 36, 37, 'B', '1'),
(54, 36, 35, 'E', '0'),
(55, 36, 37, 'B', '1'),
(56, 36, 37, 'B', '1'),
(57, 36, 35, 'E', '0'),
(58, 36, 37, 'B', '1'),
(59, 36, 35, 'E', '0'),
(60, 36, 37, 'B', '1'),
(61, 36, 35, 'E', '0'),
(62, 36, 35, 'A', '0'),
(63, 36, 37, 'B', '1'),
(64, 36, 37, 'B', '1'),
(65, 36, 35, 'A', '0'),
(66, 41, 39, 'A', '0'),
(67, 41, 38, 'D', '0'),
(68, 41, 38, 'C', '1'),
(69, 41, 39, 'A', '0'),
(70, 41, 38, 'C', '1'),
(71, 41, 39, 'A', '0'),
(72, 41, 38, 'C', '1'),
(73, 41, 39, 'A', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jawaban_essay`
--

CREATE TABLE `tb_jawaban_essay` (
  `id_jawaban_essay` int(20) NOT NULL,
  `id_peserta_essay` int(20) NOT NULL,
  `id_soal_essay` int(20) NOT NULL,
  `jawaban` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jawaban_essay`
--

INSERT INTO `tb_jawaban_essay` (`id_jawaban_essay`, `id_peserta_essay`, `id_soal_essay`, `jawaban`) VALUES
(116, 27, 43, '1993'),
(117, 29, 43, '1998'),
(118, 30, 43, 'lam pabin'),
(119, 33, 51, 'haii'),
(120, 33, 43, 'semua orang pasti tau'),
(121, 34, 45, 'iya ini bisa masuk'),
(122, 34, 50, ';'),
(123, 34, 46, '12'),
(124, 35, 45, 'iya bisa'),
(125, 35, 54, 'saya dzikry'),
(126, 35, 46, '12'),
(127, 36, 59, 'asfsafaf'),
(128, 36, 46, 'asfasfasf'),
(129, 36, 45, 'asfasfasfas'),
(130, 38, 46, 'asd'),
(131, 38, 59, 'asda'),
(132, 38, 45, 'assadasdad'),
(133, 41, 45, 'dgagadga'),
(134, 41, 59, 'adgdagadgad'),
(135, 41, 46, 'gdagadgagadg');

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
(5, 'Jenis ujian coba 1'),
(6, 'Jenis Ujian coba 2'),
(7, 'Jenis ujian coba 3');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(12) NOT NULL
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
(2, '1', 'Dasar Pemograman'),
(3, '2', 'Manajemen Proyek IT'),
(5, '3', 'Ujian Pengetahuan Perusahaan');

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

--
-- Dumping data for table `tb_peserta`
--

INSERT INTO `tb_peserta` (`id_peserta`, `id_matapelajaran`, `id_siswa`, `id_jenis_ujian`, `tanggal_ujian`, `jam_ujian`, `durasi_ujian`, `timer_ujian`, `status_ujian`, `status_ujian_ujian`, `benar`, `salah`, `nilai`) VALUES
(27, 27, 16, 1, '2023-03-13', '15:00:00', 12, 720, 2, 2, '1', '0', '100'),
(28, 27, 17, 1, '2023-03-14', '09:05:00', 5, 300, 2, 2, '0', '2', '0'),
(29, 27, 18, 1, '2023-03-14', '09:05:00', 5, 300, 2, 2, '0', '2', '0'),
(31, 27, 16, 1, '2023-03-14', '09:24:00', 120, 7200, 2, 2, '0', '2', '0'),
(32, 27, 17, 1, '2023-03-14', '09:24:00', 120, 7200, 1, 0, '', '', ''),
(33, 27, 18, 1, '2023-03-14', '09:24:00', 120, 7200, 1, 0, '', '', ''),
(35, 27, 20, 1, '2023-03-14', '09:24:00', 120, 7200, 2, 2, '1', '1', '50'),
(36, 27, 16, 1, '2023-03-16', '11:38:00', 120, 7200, 2, 2, '8', '12', '40'),
(41, 29, 23, 4, '2023-03-24', '07:28:00', 120, 7200, 2, 2, '3', '5', '37.5'),
(42, 30, 16, 5, '2023-03-27', '15:13:00', 120, 7200, 2, 2, '0', '0', '0'),
(43, 2, 16, 4, '2023-03-31', '11:45:00', 120, 7200, 1, 0, '', '', ''),
(44, 2, 17, 4, '2023-03-31', '11:45:00', 120, 7200, 1, 0, '', '', ''),
(45, 2, 18, 4, '2023-03-31', '11:45:00', 120, 7200, 1, 0, '', '', ''),
(46, 2, 19, 4, '2023-03-31', '11:45:00', 120, 7200, 1, 0, '', '', ''),
(47, 2, 23, 4, '2023-03-31', '11:45:00', 120, 7200, 1, 0, '', '', ''),
(48, 2, 16, 4, '2023-03-31', '11:45:00', 120, 7200, 1, 0, '', '', ''),
(49, 2, 17, 4, '2023-03-31', '11:45:00', 120, 7200, 1, 0, '', '', ''),
(50, 2, 18, 4, '2023-03-31', '11:45:00', 120, 7200, 1, 0, '', '', ''),
(51, 2, 19, 4, '2023-03-31', '11:45:00', 120, 7200, 1, 0, '', '', ''),
(52, 2, 23, 4, '2023-03-31', '11:45:00', 120, 7200, 1, 0, '', '', '');

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
  `Keterangan` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_peserta_essay`
--

INSERT INTO `tb_peserta_essay` (`id_peserta_essay`, `id_mapel_essay`, `id_siswa`, `id_jenis_ujian_essay`, `tanggal_ujian`, `jam_ujian`, `durasi_ujian`, `timer_ujian`, `status_ujian`, `status_ujian_ujian`, `nilai_essay`, `Keterangan`) VALUES
(34, 2, 16, 5, '2023-04-27', '13:13:00', 300, 18000, 2, 2, 60, ''),
(35, 2, 16, 5, '2023-05-02', '09:27:00', 5, 300, 2, 2, 80, ''),
(36, 2, 16, 5, '2023-05-04', '08:14:00', 15, 900, 2, 2, 70, ''),
(37, 2, 17, 5, '2023-05-04', '08:14:00', 15, 900, 1, 0, 0, ''),
(38, 2, 18, 5, '2023-05-04', '08:14:00', 15, 900, 2, 2, 90, ''),
(39, 2, 19, 5, '2023-05-04', '08:14:00', 15, 900, 1, 0, 0, ''),
(40, 2, 23, 5, '2023-05-04', '08:14:00', 15, 900, 1, 0, 0, ''),
(41, 2, 16, 5, '2023-05-04', '10:08:00', 120, 7200, 2, 2, 0, '');

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
(16, 8, 'Dzikry Alfian', 1322131, 'dzikry', 'dzikry'),
(17, 9, 'Fabin Wantara', 12121313, 'fabin', 'fabin'),
(18, 9, 'Stevanus Ertito', 312313412, 'tito', 'tito'),
(19, 9, 'Muhammad Solahudin', 123123, 'udin', 'udin'),
(23, 8, 'Cristiano Messi', 1213123, 'ronaldo', 'messi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal_essay`
--

CREATE TABLE `tb_soal_essay` (
  `id_soal_essay` int(10) NOT NULL,
  `id_mapel_essay` int(10) NOT NULL,
  `pertanyaan` varchar(500) NOT NULL,
  `jawaban` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_soal_essay`
--

INSERT INTO `tb_soal_essay` (`id_soal_essay`, `id_mapel_essay`, `pertanyaan`, `jawaban`) VALUES
(43, 5, 'Perusahaan nihon berdiri sejak tahun berapa?', 'Mudah'),
(45, 2, '<p>Apakah ini bisa masuk?</p>', 'Sulit'),
(46, 2, '<p>2, 4, 8, 10, ...</p>', 'Mudah'),
(51, 5, 'apa ya ges ya', 'Mudah'),
(59, 2, '<p><b>fafafasfa</b></p>', 'ez');

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
-- Dumping data for table `tb_soal_ujian`
--

INSERT INTO `tb_soal_ujian` (`id_soal_ujian`, `id_matapelajaran`, `pertanyaan`, `a`, `b`, `c`, `d`, `e`, `kunci_jawaban`) VALUES
(36, 28, 'Agar terbentuk pengurus suatu organisasi terdapat 2 calon ketua 3 calon sekretaris serta 2 orang calon bendahara dan tidak ada seorangpun yang dicalonkan pada dua kedudukan yang berbeda dalam berapa carakah susunan pengurus tersebut terdiri dari seorang ketua seorang sekretaris dan seorang bendahara yang dapat dibentuk? \r\n\r\n', '18 cara', '16 cara', '12 cara', '8 cara', '10 cara', 'C'),
(38, 29, 'Kecakapan seseorang sebagai WNI yang mendapatkan hak serta berkewajiban dalam usaha-usaha bernegara ditetapkan pada saat..', 'Dilahirkan', 'Masuk sekolah dasar', 'usia 17 tahun', 'usia 19 tahun', 'usia 21 tahun', 'C'),
(42, 28, 'asfasfasf', 'afsafsaf', 'asfasfsaf', 'afsasfas', 'asfaf', 'asfasfasf', 'D');

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
  MODIFY `id_jawaban` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tb_jawaban_essay`
--
ALTER TABLE `tb_jawaban_essay`
  MODIFY `id_jawaban_essay` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `tb_jenis_ujian`
--
ALTER TABLE `tb_jenis_ujian`
  MODIFY `id_jenis_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_jenis_ujian_essay`
--
ALTER TABLE `tb_jenis_ujian_essay`
  MODIFY `id_jenis_ujian_essay` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_mapel_essay`
--
ALTER TABLE `tb_mapel_essay`
  MODIFY `id_mapel_essay` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_matapelajaran`
--
ALTER TABLE `tb_matapelajaran`
  MODIFY `id_matapelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_peserta`
--
ALTER TABLE `tb_peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tb_peserta_essay`
--
ALTER TABLE `tb_peserta_essay`
  MODIFY `id_peserta_essay` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tb_soal_essay`
--
ALTER TABLE `tb_soal_essay`
  MODIFY `id_soal_essay` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  MODIFY `id_soal_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
