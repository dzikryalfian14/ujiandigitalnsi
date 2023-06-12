-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2023 at 03:20 AM
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
(11111, 'Dzikry Alfian(Test Developer)', 'alfian', 'dzikry');

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
  `jawaban` text CHARACTER SET latin1 NOT NULL,
  `nilai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jawaban_essay`
--

INSERT INTO `tb_jawaban_essay` (`id_jawaban_essay`, `id_peserta_essay`, `id_soal_essay`, `jawaban`, `nilai`) VALUES
(1, 7, 113, 'Apa ya kira2?', 24),
(2, 7, 115, 'WATASHIWA UCIHA MADARA, KOREWA WIBU DESU?', 3),
(3, 7, 114, 'C KEKNYA', 2);

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
(11, 'Ruang Ujian 1'),
(12, 'Ruang Ujian 2');

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
(7, '2', 'Logika Aritmatika'),
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
(1, 6, 1, 8, '2023-06-08', '08:27:00', 90, 5400, 1, 0, 0, 0),
(2, 6, 7, 8, '2023-06-08', '08:27:00', 90, 5400, 1, 0, 0, 0),
(3, 6, 8, 8, '2023-06-08', '08:27:00', 90, 5400, 1, 0, 0, 0),
(4, 6, 9, 8, '2023-06-08', '08:27:00', 90, 5400, 1, 0, 0, 0),
(5, 6, 10, 8, '2023-06-08', '08:27:00', 90, 5400, 1, 0, 0, 0),
(6, 6, 11, 8, '2023-06-08', '08:27:00', 90, 5400, 1, 0, 0, 0),
(7, 6, 12, 8, '2023-06-08', '08:27:00', 90, 5400, 2, 2, 0, 0),
(8, 6, 13, 8, '2023-06-08', '08:27:00', 90, 5400, 1, 0, 0, 0),
(9, 6, 23, 8, '2023-06-08', '08:27:00', 90, 5400, 1, 0, 0, 0),
(10, 6, 24, 8, '2023-06-08', '08:27:00', 90, 5400, 1, 0, 0, 0);

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
(1, 11, 'Dzikry Alfian(Test Developer)', 11111, 'dzikry', 'dzikry'),
(2, 12, 'Muhammad Solahudin ', 11236, 'udin', 'udin'),
(3, 12, 'Fabin Wantara', 88907, 'fabin', 'fabin'),
(4, 12, 'Stevanus Ertito', 44567, 'tito', 'tito'),
(5, 12, 'Takiya Edi', 11243, 'edi', 'edi'),
(6, 12, 'Yaya Baitur Rohman', 12121, 'yaya', 'yaya'),
(7, 11, 'Irul Daratista', 13131, 'irul', 'irul'),
(8, 11, 'Naruto Uzumaki', 31313, 'naruto', 'naruto'),
(9, 11, 'Sasuke Uciha', 12112, 'saskeh', 'saskeh'),
(10, 11, 'Ali bin Jiraiya ', 12476, 'jiraya', 'jiraya'),
(11, 11, 'Obito Uciha', 33567, 'obito', 'obito'),
(12, 11, 'Madara Uciha', 22145, 'madara', 'madara'),
(13, 11, 'Boku no Pico', 33907, 'pico', 'pico'),
(14, 12, 'John Smith', 83924, 'jsmith', 'jsmith'),
(15, 12, 'Emily Johnson', 50768, 'ejohnson', 'ejohnson'),
(16, 12, 'Michael Williams', 91235, 'mwilliams', 'mwilliams'),
(17, 12, 'Jessica Brown', 62349, 'jbrown', 'jbrown'),
(18, 12, 'Daniel Jones', 43189, 'djones', 'djones'),
(19, 12, 'Olivia Davis', 27650, 'odavis', 'odavis'),
(20, 12, 'David Miller', 75891, 'dmiller', 'dmiller'),
(21, 12, 'Sophia Wilson', 19482, 'swilson', 'swilson'),
(22, 12, 'James Taylor', 56209, 'jtaylor', 'jtaylor'),
(23, 11, 'Ava Anderson', 84316, 'aanderson', 'aanderson'),
(24, 11, 'Robert Thomas', 10795, 'rthomas', 'rthomas'),
(25, 11, 'Isabella Martinez', 68943, 'imartinez', 'imartinez'),
(26, 11, 'Joseph Jackson', 21579, 'jjackson', 'jjackson'),
(27, 11, 'Mia Thompson', 49762, 'mthompson', 'mthompson'),
(28, 11, 'William Clark', 32817, 'wclark', 'wclark'),
(29, 11, 'Charlotte Lewis', 87406, 'clewis', 'clewis'),
(30, 11, 'Benjamin Rodriguez', 63125, 'brodriguez', 'brodriguez'),
(31, 11, 'Harper Lee', 98140, 'hlee', 'hlee'),
(32, 11, 'Samuel Garcia', 74328, 'sgarcia', 'sgarcia'),
(33, 11, 'Evelyn Martinez', 51673, 'emartinez', 'emartinez');

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
(109, 7, '<p><span style=\"color: rgb(20, 20, 43); font-family: Poppins, sans-serif; font-size: 16px;\">Bagus melakukan 3 kali tes matematika dengan nilai rerata 89. Berapa nilai yang harus bagus pada tes selanjutnya jika ia ingin mendapatkan rerata nilai 90?</span><br></p>', '', 'Mudah'),
(110, 7, '<p><span style=\"color: rgb(20, 20, 43); font-family: Poppins, sans-serif; font-size: 16px;\">Suatu seri: 100-4-90-7-80 seri selanjutnya adalah…</span><br></p>', '', 'Mudah'),
(111, 8, '<p><span style=\"color: rgb(20, 20, 43); font-family: Poppins, sans-serif; font-size: 16px;\">Taraf = ....</span><br></p>', '', 'Sedang'),
(112, 8, '<p><span style=\"color: rgb(20, 20, 43); font-family: Poppins, sans-serif; font-size: 16px;\">Emas : Tambang || ...... : ....</span><br></p>', '', 'Sedang'),
(113, 6, '<p><span style=\"font-family: Nunito, sans-serif; font-size: 18px;\">Dalam tes ini, kamu diminta untuk mencari pasangan gambar di dalam dua kotak yang berbeda.</span><br></p>', 'uploads/soal_gambar11.jpg', 'Susah'),
(114, 6, '<p><span style=\"font-family: Nunito, sans-serif; font-size: 18px;\">Carilah lanjutan gambar berikut ini!</span><br></p>', 'uploads/soal_gambar21.jpg', 'Susah'),
(115, 6, '<p>Kenapa bumi bulat?</p>', '', 'Mudah');

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
  MODIFY `id_jawaban_essay` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id_peserta_essay` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_soal_essay`
--
ALTER TABLE `tb_soal_essay`
  MODIFY `id_soal_essay` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  MODIFY `id_soal_ujian` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
