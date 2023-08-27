-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2023 at 06:21 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m_sewabaju_2023`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_administrator`
--

CREATE TABLE `tb_administrator` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_administrator`
--

INSERT INTO `tb_administrator` (`id`, `username`, `password`, `nama`) VALUES
(1, 'admin', 'admin', 'Administrator'),
(4, 'pimpinan', 'pimpinan', 'Pimpinan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mobil`
--

CREATE TABLE `tb_mobil` (
  `id_mobil` int(11) NOT NULL,
  `nama_mobil` varchar(50) NOT NULL,
  `plat_mobil` varchar(20) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `tahun` int(11) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `tipe` int(2) NOT NULL COMMENT '1=laki-laki, 2=perempuan',
  `status` int(11) NOT NULL,
  `foto` text NOT NULL,
  `deskripsi` text NOT NULL,
  `id_rental` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mobil`
--

INSERT INTO `tb_mobil` (`id_mobil`, `nama_mobil`, `plat_mobil`, `merk`, `tahun`, `kapasitas`, `harga`, `warna`, `tipe`, `status`, `foto`, `deskripsi`, `id_rental`) VALUES
(2, 'Baju Kurung', 'Pontianak', 'Melayu', 5, 0, 75000, 'Ungu', 1, 0, '1c027be3140d4e0e8c982ffc1c6eea30.jpg', 'Baju kurung (Jawi: باجو كوروڠ) adalah salah satu pakaian adat masyarakat Melayu diIndonesia, Malaysia,Baju kurung sering diasosiasi dengan kaum perempuan. Ciri khas baju kurung adalah rancangan yang longgar pada lubang lengan, perut, dan dada. Pada saat dikenakan, bagian paling bawah baju kurung sejajar dengan pangkal paha, tetapi untuk kasus yang jarang ada pula yang memanjang hingga sejajar dengan lutut. Baju kurung tidak dipasangi kancing, melainkan hampir serupa dengan t-shirt, meski begitu tetapi baju kurung ada juga yang memiliki kancing yang jumlahnya sekitar 3 baris. Baju kurung tidak pula berkerah, tiap ujungnya direnda. Beberapa bagiannya sering dihiasi sulaman berwarna keemasan.', 9),
(3, 'Bundo Kanduang', 'Sumatra Barat', 'Minang', 0, 0, 100000, 'Merah', 2, 0, '577c2b0ef2864ce7a1e346a20f03e94f.jpg', 'Bundo Kanduang atau dapat diterjemahkan secara kasar ke dalam bahasa Indonesia sebagai Bunda Kandung, adalah personifikasi etnis Minangkabau sekaligus julukan yang diberikan kepada perempuan sulung atau yang dituakan dalam suatu suku (klan). Sebutan bundo kanduang hanya melakat pada seorang perempuan yang sudah berkeluarga.', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_perpanjangan`
--

CREATE TABLE `tb_perpanjangan` (
  `id_perpanjangan` int(11) NOT NULL,
  `id_transaksi` text NOT NULL,
  `tgl_perpanjangan` varchar(50) NOT NULL,
  `tgl_kembali` varchar(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `nomor_pengirim` varchar(100) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `foto` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_perpanjangan`
--

INSERT INTO `tb_perpanjangan` (`id_perpanjangan`, `id_transaksi`, `tgl_perpanjangan`, `tgl_kembali`, `harga`, `nama_pengirim`, `nomor_pengirim`, `nama_bank`, `foto`, `status`) VALUES
(1, '64ca7e8e8e4840fc8ce1f1e659d79e1e', '2023-08-30 10:52', '2023-08-31 10:52', 0, 'Abrari', '0923168626', 'Bca', '228d4ff6ba2c4255ae8bcb778a544627.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rental`
--

CREATE TABLE `tb_rental` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL,
  `norek` varchar(100) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `nama_rekening` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_rental`
--

INSERT INTO `tb_rental` (`id`, `nama`, `no_hp`, `alamat`, `password`, `lat`, `lng`, `norek`, `nama_bank`, `nama_rekening`) VALUES
(9, 'staff1', '085240097431', 'Jalan Wonodadi 2 Kubu Raya', 'staff1', '', '', '12313131231312', 'BCA', '09234323243');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `urutan` int(11) NOT NULL,
  `id_transaksi` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `id_rental` text NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `nomor_pengirim` varchar(100) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `foto` text NOT NULL,
  `tgl_transaksi` varchar(50) NOT NULL,
  `tgl_pinjam` varchar(50) NOT NULL,
  `tgl_kembali` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=transaksi masuk,1=konfirmasi belum bayar,2=konfirmasi pembayaran, 3=selesai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`urutan`, `id_transaksi`, `id_user`, `id_mobil`, `id_rental`, `nama_pengirim`, `nomor_pengirim`, `nama_bank`, `foto`, `tgl_transaksi`, `tgl_pinjam`, `tgl_kembali`, `total`, `status`) VALUES
(1, '916469c997994cd3acc7478909181376', 42, 3, '9', 'ABRARI LIWALIDINA', '092132656468', 'BCA', '53189e141e204491a12d686d4850dd82.jpg', '2023-08-27 11:04', '2023-08-28 10:04', '2023-08-29 10:04', '', 3),
(2, '64ca7e8e8e4840fc8ce1f1e659d79e1e', 42, 2, '9', 'ABRARI', '0925613468', 'BCA', '957b2f758b0c45a6aa6c2ea6163a1df9.jpg', '2023-08-27 11:52', '2023-08-27 10:52', '2023-08-31 10:52', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_daftar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jk` int(11) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto_ktp` text NOT NULL,
  `status` int(11) NOT NULL,
  `norek` varchar(100) NOT NULL,
  `nama_rekening` varchar(100) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `tgl_daftar`, `jk`, `no_hp`, `alamat`, `pekerjaan`, `nik`, `password`, `foto_ktp`, `status`, `norek`, `nama_rekening`, `nama_bank`, `token`) VALUES
(40, 'Diki Paris', '2021-06-05 15:15:16', 0, '082259500319', 'Just. rumah sawit in', 'Pekerjaan', '12344441414', 'eD7QGA', '0e21caaffc5e46b88ef40ad6f6a57832.jpg', 1, '122029292929211', 'NAMA REKENING', 'BRI', 'eMw4F8aET_ehm_bEweHWav:APA91bGyBnaYzjv0a4oba4RFMRk7jOy_Sc6hgl8TMklD30HaCdwcdJNn1lYQ9apjpuCM40b9nv-h4tdu_C29qVzT6ccGy0VFfOO9y-09VqNqthgsx-v5tyEzltLfTaD1GRQWhXPy8eCI'),
(41, 'Ari', '2023-08-26 16:39:52', 0, '085249506171', 'Wonodadi 2', 'Mahasiswa', '60017865677543198', 'QptzUc', '9398fa2ee9c54398b027e96e0ca7f44b.jpg', 1, '0984828194', 'Ari', 'BCA', 'eakQOTsWTI6LH_Q8OP2XS9:APA91bFKMKKRZqcgKR8xYUZUcq3apfy6j_4w0STWV5zm43MCGa-2OKYma1NiWNbmO1RJ6W86MGf1ORBVEBOrpjq-Z_S6ctXxP5TlcciuZe-o3ChckmrfiVlu5A7ZtFv_kXLMy9Dd936w'),
(42, 'Abrari Liwalidina', '2023-08-27 02:33:39', 0, '085888119664', 'Jalan Sepakat', 'Pelajar', '6004175624865165894', 'ariari', 'fd72cdf1a2094a379aaf7f52f76a16ea.jpg', 1, '-', '-', '-', 'fFS6OYnxS-ye7fmWN-FAXX:APA91bHnJ1Lyu3md0x1F8AYYfKeXGffNSJagw_WAkS_Qyo7GSnbfTsoSl1wwyGNWMfwPl15_Qng0IxcvVmtfAwBHu515MoVTvjc8C8Rbo2zotD6S0W6eAnLcDVDi3mikYDWB19ijCTmb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_administrator`
--
ALTER TABLE `tb_administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_mobil`
--
ALTER TABLE `tb_mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `tb_perpanjangan`
--
ALTER TABLE `tb_perpanjangan`
  ADD PRIMARY KEY (`id_perpanjangan`);

--
-- Indexes for table `tb_rental`
--
ALTER TABLE `tb_rental`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`urutan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_administrator`
--
ALTER TABLE `tb_administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_mobil`
--
ALTER TABLE `tb_mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_perpanjangan`
--
ALTER TABLE `tb_perpanjangan`
  MODIFY `id_perpanjangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_rental`
--
ALTER TABLE `tb_rental`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `urutan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
