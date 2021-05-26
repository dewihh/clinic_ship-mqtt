-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2021 at 03:38 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nodemcu_rfid_iot_projects`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian_a`
--

DROP TABLE IF EXISTS `antrian_a`;
CREATE TABLE `antrian_a` (
  `id` int(11) NOT NULL,
  `no_antrian` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `kode_antrian` varchar(300) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `antrian_a`
--

INSERT INTO `antrian_a` (`id`, `no_antrian`, `tgl`, `kode_antrian`, `status`) VALUES
(9, 3, '2021-03-22', '', 0),
(10, 2, '2021-03-23', '', 0),
(11, 1, '2021-03-23', '', 0),
(12, 4, '2021-03-23', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

DROP TABLE IF EXISTS `dokter`;
CREATE TABLE `dokter` (
  `id` int(11) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nama_dokter` varchar(300) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `pekerjaan` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `username`, `password`, `nama_dokter`, `alamat`, `pekerjaan`) VALUES
(2, 'dok', 'admin', 'dokter', 'tak tahu', '1'),
(5, 'gigi', 'admin', 'dokter gigi', 'tak tahu', '2'),
(6, 'anak', 'admin', 'dokter anak', 'tak tahu', '3'),
(7, 'KIA', 'admin', 'dokter KIA', 'tak tahu', '4');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`) VALUES
(1, 'Kepala');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

DROP TABLE IF EXISTS `jadwal`;
CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `nama_dokter` varchar(300) NOT NULL,
  `hari` varchar(300) NOT NULL,
  `mulai` varchar(300) NOT NULL,
  `selesai` varchar(300) NOT NULL,
  `poli` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `nama_dokter`, `hari`, `mulai`, `selesai`, `poli`) VALUES
(1, 'Arya', 'Senin', '07:00', '09:00', 'Umum');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

DROP TABLE IF EXISTS `obat`;
CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `kode` varchar(300) NOT NULL,
  `nama_obat` varchar(300) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `kode`, `nama_obat`, `stok`, `harga`) VALUES
(1, 'NA129383', 'Paramex', 44, 10000),
(2, 'NB123894', 'Paracetamol', 91, 10000),
(4, 'NA12938', 'Panadol', 4, 5000),
(5, 'NA13450', 'Obat Mata', 100, 25000);

-- --------------------------------------------------------

--
-- Table structure for table `paramedik`
--

DROP TABLE IF EXISTS `paramedik`;
CREATE TABLE `paramedik` (
  `id` int(11) NOT NULL,
  `kode_paramedik` varchar(300) NOT NULL,
  `nama_paramedik` varchar(300) NOT NULL,
  `kelamin` varchar(300) NOT NULL,
  `sipp` varchar(300) NOT NULL,
  `tgl_lahir` varchar(300) NOT NULL,
  `alam` varchar(300) NOT NULL,
  `poli` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paramedik`
--

INSERT INTO `paramedik` (`id`, `kode_paramedik`, `nama_paramedik`, `kelamin`, `sipp`, `tgl_lahir`, `alam`, `poli`) VALUES
(2, '1234567', 'Anesha', '2', '1231241512', '1999-03-13', '', 'Umum'),
(3, '67867967', 'Arista', '1', '23423523234', '1998-01-04', '', 'KIA'),
(6, '1234567', 'Testing', '1', '45678', '2021-03-01', '', 'Umum');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_pegawai` varchar(300) NOT NULL,
  `nama_pegawai` varchar(200) NOT NULL,
  `kelamin` varchar(300) NOT NULL,
  `npwp` int(22) NOT NULL,
  `tgl_lahir` varchar(300) NOT NULL,
  `alamat` varchar(360) NOT NULL,
  `pekerjaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `username`, `email`, `password`, `id_pegawai`, `nama_pegawai`, `kelamin`, `npwp`, `tgl_lahir`, `alamat`, `pekerjaan`) VALUES
(2, 'arfian', '', 'admin', '12345', 'fian', '1', 785327, '0', 'tak tahu', 1),
(4, 'dewi', '', 'admin', '1234567890', 'Dewi Hajar', '2', 0, '0', 'tak tahu', 2),
(7, 'budiman', 'dewih498@gmail.com', '93a59ad5cd604192ea571a4ef4085ac6', '123123948', 'Dewi Ha', '2', 650543, '', 'tidak ada', 2),
(8, 'tara', 'tara@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '123145', 'Tara', '1', 64573, '', 'tidak ada', 3);

-- --------------------------------------------------------

--
-- Table structure for table `poli`
--

DROP TABLE IF EXISTS `poli`;
CREATE TABLE `poli` (
  `id` int(11) NOT NULL,
  `nama_poli` varchar(300) NOT NULL,
  `ruangan_poli` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poli`
--

INSERT INTO `poli` (`id`, `nama_poli`, `ruangan_poli`) VALUES
(1, 'Poli KIA', 'Ruangan Poli KIA 1');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_obat`
--

DROP TABLE IF EXISTS `riwayat_obat`;
CREATE TABLE `riwayat_obat` (
  `id` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayat_obat`
--

INSERT INTO `riwayat_obat` (`id`, `id_penyakit`, `id_pasien`, `id_obat`, `jumlah`) VALUES
(2, 3, 498, 1, 5),
(3, 3, 498, 1, 1),
(4, 4, 498, 1, 2),
(5, 4, 498, 2, 2),
(6, 5, 498, 4, 2),
(7, 6, 498, 1, 1),
(8, 6, 498, 2, 1),
(9, 6, 498, 4, 1),
(10, 7, 498, 1, 1),
(11, 7, 498, 2, 1),
(12, 7, 498, 4, 1),
(13, 8, 498, 1, 1),
(14, 8, 498, 2, 1),
(15, 8, 498, 4, 1),
(17, 10, 498, 1, 1),
(18, 11, 0, 1, 1),
(19, 11, 0, 2, 1),
(20, 11, 0, 4, 1),
(21, 12, 0, 2, 1),
(22, 13, 0, 2, 1),
(23, 15, 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_penyakit`
--

DROP TABLE IF EXISTS `riwayat_penyakit`;
CREATE TABLE `riwayat_penyakit` (
  `id` int(11) NOT NULL,
  `id_pasien` varchar(11) NOT NULL,
  `penyakit` varchar(300) NOT NULL,
  `diagnosa` text NOT NULL,
  `tgl` varchar(200) NOT NULL,
  `biaya_pengobatan` int(11) NOT NULL,
  `status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayat_penyakit`
--

INSERT INTO `riwayat_penyakit` (`id`, `id_pasien`, `penyakit`, `diagnosa`, `tgl`, `biaya_pengobatan`, `status`) VALUES
(14, '498D24B3', 'Flu', 'Mampet', '2021-04-06', 10000, ''),
(15, 'A3482303', 'Flu', 'Mampet hidung', '2021-04-06', 10000, '1');

-- --------------------------------------------------------

--
-- Table structure for table `table_the_iot_projects`
--

DROP TABLE IF EXISTS `table_the_iot_projects`;
CREATE TABLE `table_the_iot_projects` (
  `name` varchar(100) NOT NULL,
  `id` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `validation_sheet` varchar(100) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `phone_numb` varchar(255) NOT NULL,
  `tinggi` varchar(255) NOT NULL,
  `berat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_the_iot_projects`
--

INSERT INTO `table_the_iot_projects` (`name`, `id`, `gender`, `age`, `validation_sheet`, `adress`, `phone_numb`, `tinggi`, `berat`) VALUES
('Testing', '498D24B3', 'Male', '1999-02-03', 'test', 'tes alamt', '678955464564', '165', '55'),
('Suyati', 'A3482303', 'Female', '1998-03-05', 'Tidak ada', 'Jakarta', '8768940', '155', '45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian_a`
--
ALTER TABLE `antrian_a`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paramedik`
--
ALTER TABLE `paramedik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_obat`
--
ALTER TABLE `riwayat_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_penyakit`
--
ALTER TABLE `riwayat_penyakit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_pasien_2` (`id_pasien`);

--
-- Indexes for table `table_the_iot_projects`
--
ALTER TABLE `table_the_iot_projects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian_a`
--
ALTER TABLE `antrian_a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paramedik`
--
ALTER TABLE `paramedik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `riwayat_obat`
--
ALTER TABLE `riwayat_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `riwayat_penyakit`
--
ALTER TABLE `riwayat_penyakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
