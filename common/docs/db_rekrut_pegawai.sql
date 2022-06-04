-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 03, 2022 at 02:09 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rekrut_pegawai`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil_interview`
--

CREATE TABLE `hasil_interview` (
  `id` int(11) NOT NULL,
  `keterangan` text,
  `hasil` int(11) DEFAULT NULL,
  `interview_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hasil_interview`
--

INSERT INTO `hasil_interview` (`id`, `keterangan`, `hasil`, `interview_id`) VALUES
(3, 'Lamaran Diterima', 100, 1),
(4, 'Lamaran Diterima', 100, 2);

-- --------------------------------------------------------

--
-- Table structure for table `hrd`
--

CREATE TABLE `hrd` (
  `nik` varchar(45) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `alamat` text,
  `no_hp` varchar(45) DEFAULT NULL,
  `posisi` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hrd`
--

INSERT INTO `hrd` (`nik`, `nama_lengkap`, `alamat`, `no_hp`, `posisi`) VALUES
('12345', 'Wahid', 'Kendari', '0885554', 'HRD');

-- --------------------------------------------------------

--
-- Table structure for table `interview`
--

CREATE TABLE `interview` (
  `id` int(11) NOT NULL,
  `lowongan_id` int(11) NOT NULL,
  `pelamar_nik` varchar(45) NOT NULL,
  `tanggal_interview` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `interview`
--

INSERT INTO `interview` (`id`, `lowongan_id`, `pelamar_nik`, `tanggal_interview`) VALUES
(1, 1, '12345', '2022-05-24 00:00:00'),
(2, 1, '321', '2022-05-21 00:00:00'),
(3, 2, '321', '2022-05-27 00:00:00'),
(7, 2, '12345', '2022-05-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `lowongan`
--

CREATE TABLE `lowongan` (
  `id` int(11) NOT NULL,
  `nama_pekerjaan` varchar(45) DEFAULT NULL,
  `tgl_publish` date DEFAULT NULL,
  `tgl_penutupan` date DEFAULT NULL,
  `deskripsi` text,
  `hrd_nik` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lowongan`
--

INSERT INTO `lowongan` (`id`, `nama_pekerjaan`, `tgl_publish`, `tgl_penutupan`, `deskripsi`, `hrd_nik`) VALUES
(1, 'Web Dev', '2022-04-14', '2022-04-29', '', '12345'),
(2, 'Mobile dev', '2022-04-04', '2022-04-14', 'Deskripsi banyak', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1643841874),
('m130524_201442_init', 1643841876),
('m190124_110200_add_verification_token_column_to_user_table', 1643841877);

-- --------------------------------------------------------

--
-- Table structure for table `pelamar`
--

CREATE TABLE `pelamar` (
  `nik` varchar(45) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(45) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text,
  `no_hp` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `file_cv` varchar(255) DEFAULT NULL,
  `file_ijazah` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pelamar`
--

INSERT INTO `pelamar` (`nik`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_hp`, `email`, `file_cv`, `file_ijazah`) VALUES
('12345', 'Muh. Syafri Jayanto', 'Kendari', '2022-04-14', 'Kendari', '+6285396252675', 'arwanpriantomangidi@gmail.com', '12345-cv-1649422017.pdf', '12345-ijazah-1649422017.pdf'),
('321', 'WAHID', 'Kendari', '2022-04-12', 'Kendari', '+62853330404', 'wahid@gmail.com', '321-cv-1651240408.pdf', '321-ijazah-1651240408.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `interview_id` int(11) NOT NULL,
  `soal_interview_id` varchar(45) NOT NULL,
  `pilih` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`interview_id`, `soal_interview_id`, `pilih`) VALUES
(1, 'S01', 3),
(1, 'S02', 4),
(2, 'S01', 2),
(2, 'S02', 5),
(7, 'S01', 3),
(7, 'S02', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pilihan_jawaban`
--

CREATE TABLE `pilihan_jawaban` (
  `id` int(11) NOT NULL,
  `pilihan` varchar(255) DEFAULT NULL,
  `soal_interview_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pilihan_jawaban`
--

INSERT INTO `pilihan_jawaban` (`id`, `pilihan`, `soal_interview_id`) VALUES
(1, 'Pilihan a', 'S01'),
(2, 'Pilihan b', 'S01'),
(3, 'Pilihan c', 'S01'),
(4, 'Pilihan A soal kedua', 'S02'),
(5, 'Pilihan b soal ke 2', 'S02');

-- --------------------------------------------------------

--
-- Table structure for table `soal_interview`
--

CREATE TABLE `soal_interview` (
  `id` varchar(45) NOT NULL,
  `soal` text,
  `jawaban` varchar(45) DEFAULT NULL,
  `kategori` varchar(45) DEFAULT NULL,
  `hrd_nik` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `soal_interview`
--

INSERT INTO `soal_interview` (`id`, `soal`, `jawaban`, `kategori`, `hrd_nik`) VALUES
('S01', 'Soal 1', '3', '1', '12345'),
('S02', 'Soal 2', '5', '1', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_hrd` int(1) DEFAULT NULL,
  `usercol` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `is_hrd`, `usercol`) VALUES
(321, 'wahid', 'KjMEBEjmOwyIz72-n0lBg-IZJKupaS8d', '$2y$13$1XRDGdDRkJQ88/ybt2jWQuznHt71jC507C5MbOCJVB0VGp7cE6ezC', NULL, 'wahid@gmail.com', 10, 1650087002, 1650087002, 'Q0LiNyYvXw6k4zonXsgZIZyyqhnyuHbz_1650087002', NULL, NULL),
(12345, 'wahid_hrd', '0ohz9dtg4styDhNPKv0KPBSKmzpt9sih', '$2y$13$1XRDGdDRkJQ88/ybt2jWQuznHt71jC507C5MbOCJVB0VGp7cE6ezC', NULL, 'arwan@gmail.com', 10, 1644384715, 1644384715, 'pPBQX2KjI6Rqjjk9frWeTN-kyKYweA6t_1644384715', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil_interview`
--
ALTER TABLE `hasil_interview`
  ADD PRIMARY KEY (`id`,`interview_id`),
  ADD KEY `fk_hasil_interview_interview1_idx` (`interview_id`);

--
-- Indexes for table `hrd`
--
ALTER TABLE `hrd`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `interview`
--
ALTER TABLE `interview`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lowongan_has_pelamar_pelamar1_idx` (`pelamar_nik`),
  ADD KEY `fk_lowongan_has_pelamar_lowongan_idx` (`lowongan_id`);

--
-- Indexes for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lowongan_hrd1_idx` (`hrd_nik`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `pelamar`
--
ALTER TABLE `pelamar`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`interview_id`,`soal_interview_id`),
  ADD KEY `fk_interview_has_soal_interview_interview1_idx` (`interview_id`),
  ADD KEY `fk_penilaian_soal_interview1_idx` (`soal_interview_id`);

--
-- Indexes for table `pilihan_jawaban`
--
ALTER TABLE `pilihan_jawaban`
  ADD PRIMARY KEY (`id`,`soal_interview_id`),
  ADD KEY `fk_pilihan_jawaban_soal_interview1_idx` (`soal_interview_id`);

--
-- Indexes for table `soal_interview`
--
ALTER TABLE `soal_interview`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_soal_interview_hrd1_idx` (`hrd_nik`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil_interview`
--
ALTER TABLE `hasil_interview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `interview`
--
ALTER TABLE `interview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pilihan_jawaban`
--
ALTER TABLE `pilihan_jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12346;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_interview`
--
ALTER TABLE `hasil_interview`
  ADD CONSTRAINT `fk_hasil_interview_interview1` FOREIGN KEY (`interview_id`) REFERENCES `interview` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `interview`
--
ALTER TABLE `interview`
  ADD CONSTRAINT `fk_lowongan_has_pelamar_lowongan` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lowongan_has_pelamar_pelamar1` FOREIGN KEY (`pelamar_nik`) REFERENCES `pelamar` (`nik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD CONSTRAINT `fk_lowongan_hrd1` FOREIGN KEY (`hrd_nik`) REFERENCES `hrd` (`nik`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `fk_interview_has_soal_interview_interview1` FOREIGN KEY (`interview_id`) REFERENCES `interview` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_penilaian_soal_interview1` FOREIGN KEY (`soal_interview_id`) REFERENCES `soal_interview` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pilihan_jawaban`
--
ALTER TABLE `pilihan_jawaban`
  ADD CONSTRAINT `fk_pilihan_jawaban_soal_interview1` FOREIGN KEY (`soal_interview_id`) REFERENCES `soal_interview` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `soal_interview`
--
ALTER TABLE `soal_interview`
  ADD CONSTRAINT `fk_soal_interview_hrd1` FOREIGN KEY (`hrd_nik`) REFERENCES `hrd` (`nik`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
