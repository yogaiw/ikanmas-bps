-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2021 at 09:25 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bps`
--

-- --------------------------------------------------------

--
-- Table structure for table `izin`
--

CREATE TABLE `izin` (
  `id_izin` int(11) NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `jam_keluar` varchar(45) DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `jam_kembali` varchar(45) DEFAULT NULL,
  `isAccepted` int(1) DEFAULT NULL,
  `keperluan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `izin`
--

INSERT INTO `izin` (`id_izin`, `id_pegawai`, `tanggal_keluar`, `jam_keluar`, `tanggal_kembali`, `jam_kembali`, `isAccepted`, `keperluan`) VALUES
(7, 2, '2021-09-15', '13:02', '2021-09-15', '14:00', 1, 'Uwowowowowo');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nip` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_pegawai` varchar(45) DEFAULT NULL,
  `isAdmin` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nip`, `password`, `nama_pegawai`, `isAdmin`) VALUES
(1, '18102180', '$2y$10$uRn1ooximjdBDxaMxAKya.kV2uXx/FMnQQGX2QS06Em8wmW103NPS', 'Yoga Indra Wijaya', 1),
(2, '18102168', '$2y$10$EDzNnfk1aLM2XCa4Zg64VO9YOSQvirORt9xsQIWBAxtM4ztP.QjOW', 'Humam Zaky', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `izin`
--
ALTER TABLE `izin`
  ADD PRIMARY KEY (`id_izin`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `izin`
--
ALTER TABLE `izin`
  MODIFY `id_izin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
