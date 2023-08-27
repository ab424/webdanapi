-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2022 at 01:39 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m_rentalmobil_2021`
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
  `tipe` int(2) NOT NULL COMMENT '1=manual, 2=matic',
  `status` int(11) NOT NULL,
  `foto` text NOT NULL,
  `deskripsi` text NOT NULL,
  `id_rental` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mobil`
--

INSERT INTO `tb_mobil` (`id_mobil`, `nama_mobil`, `plat_mobil`, `merk`, `tahun`, `kapasitas`, `harga`, `warna`, `tipe`, `status`, `foto`, `deskripsi`, `id_rental`) VALUES
(2, 'HRV', 'DM 1234 LL', 'Honda', 2000, 10, 500000, 'merah', 1, 0, '6b4f645e0d1941628577df8f308291c4.jpg', 'deskripsi', 3),
(4, 'Honda Jazz', 'DM 1111 EE', 'Honda', 2015, 6, 300000, 'Kuning', 1, 0, '88688d89aa3d4620a0cf2c6060ad53c1.jpg', '-', 6),
(14, 'Daihatsu Sigra Manual', 'D 3001 CP', 'Daihatsu', 2017, 7, 490000, 'Biru', 1, 0, 'c05eda0644b74b15a00d36eab8d4ed0c.jpg', 'Body Daihatsu sigra yang kecil mampu bermanuver di antara kerumitan lalu lintas Jakarta, termasuk gang-gang sempit yang ada di kota Metropolitan ini.  Hal ini membuat Daihatsu Sigra terasa asyik untuk menemani anda berwisata di sekitar kota.\r\n\r\nDisediakan ruang kabin luas yang sanggup menampung penumpang hingga 7 orang sekaligus sehingga membuat ruang gerak penumpang anda menjadi lebih leluasa dan bebas.\r\n\r\nSelain itu, kelebihan Daihatsu Sigra yang utama yakni pada keiritan dan efisiensi konsumsi bahan bakarnya.', 6),
(15, 'Toyota Innova', 'DB 1234 DD', 'Toyota', 2010, 7, 720000, 'Putih', 1, 0, '7015f4c441e6493b858f68ba0fbc3abb.jpg', 'Mobil All New Innova didukung dengan mesin berkapasitas 2000 cc dengan sistem VVT-i.  Mampu menghasilkan kinerja mesin yang maksimum, dengan konsumsi bahan bakar minimum.\r\n\r\nDidukung dengan ruang bagasi yang luas, sangatlah cocok bagi Anda yang membawa bagasi dalam jumlah banyak. \r\n\r\nMungkin dapat dikatakan, Toyota Innova adalah kendaraan keluarga paling ideal di Indonesia.', 6),
(16, 'Honda Brio', 'CC 9821 DP', 'Honda', 2019, 5, 520000, 'Kuning', 1, 0, '32881774615345dca92e22baca617cea.jpg', '-', 6),
(17, 'Honda Mobilio', 'M 1123 LP', 'Honda', 2015, 7, 570000, 'Grey', 1, 0, '67c8df170ba147d29e6d80e0e0bcbc59.jpg', 'Honda Mobilio yang merupakan mobil pilihan keluarga, dimensi sebuah mpv dan efisiensi bahan bakar seperti layaknya sebuah city car. Perpaduan sempurna sebuah mobil untuk kebutuhan anda sehari - hari.\r\n\r\nMempunyai mesin 1.500 cc mobil ini dijamin hemat bahan bakar.\r\n\r\nSelain itu, mobil ini juga di lengkapi banyak fitur menarik seperti :  dual Airbags, ABS, EBD, sensor mundur, head unit dengan DVD player dan juga beberapa fitur lain yang cukup menunjang perjalananan anda', 6),
(18, 'Grand Avanza', 'CC 4546 M', 'Toyota', 2016, 7, 670000, 'Merah', 1, 0, '7d81396322b9421999169da336f0854b.jpg', 'Toyota Avanza dengan tampungan sekitar 7 orang dewasa ini tergolong irit bahan bakar. Mempunyai mesin sebesar 1.300 CC membuat mobil ini menjadi lebih hemat BBM.\r\n\r\nSelain itu, kapasitas kabin yang luas membuat penumpang akan merasa lebih nyaman mengingat memiliki ruang gerak yang lebih luas.\r\n\r\nMobil ini juga dilengkapi dengan berbagai fitur, seperti AC Double Blower, dan airbag. Jadi, selain nyaman, mobil tipe ini juga aman untuk digunakan.', 3),
(19, 'Mitsubishi Xpander', 'M 2021 L', 'Mitsubishi', 2019, 8, 600000, 'Hitam', 1, 0, 'ce3a7b3efc47441488d563886e6aa2fc.jpg', 'Mobil Mitsubishi Xpander menggunakan mesin 4A91 1.5L MIVEC DOHC 16-Valve yang memiliki kapasitas silinder 1.499cc. Mampu menghasilkan kinerja mesin yang maksimum, dengan konsumsi bahan bakar minimum.\r\n\r\nDidukung dengan ruang bagasi yang luas, sangatlah cocok bagi Anda yang membawa bagasi dalam jumlah banyak. \r\n\r\nMungkin dapat dikatakan, Mitsubishi Xpander adalah kendaraan keluarga paling ideal di Indonesia.', 3),
(20, 'Honda BR-V', 'EE 2938 IW', 'Honda', 2019, 8, 620000, 'Silver', 1, 0, '8cd0175ab41b482c88bbbe034b7e8c47.jpg', 'Honda BR-V yang merupakan mobil pilihan crossover, dimensi sebuah mpv dan efisiensi bahan bakar seperti layaknya sebuah city car. Perpaduan sempurna sebuah mobil untuk kebutuhan anda sehari - hari.\r\n\r\nMempunyai mesin 1.500 cc mobil ini dijamin hemat bahan bakar.\r\n\r\nSelain itu, mobil ini juga di lengkapi banyak fitur menarik seperti : steering switch control, dual Airbags, ABS, EBD, kamera mundur, head unit dengan DVD player dan juga beberapa fitur lain yang cukup menunjang perjalananan anda', 3),
(21, 'Toyota Camry - Wedding', 'D 12 P', 'Toyota', 2017, 6, 2220000, 'Hitam', 1, 0, '49b91c9118e54b09b22dd38ff4be6447.jpg', '-', 3);

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
(15, '937f78a32f5d45a296bf14640390030b', '2021-06-13 15:51', '2021-06-16 15:51', 0, 'NAMA REKENING', '122029292929211', 'BRI', 'd0331e06a5534f5ba067082191508958.jpg', 0),
(16, '3de5724805e04c3a9801539628778830', '2021-06-14 16:22', '2021-06-17 16:22', 0, 'NAMA REKENING', '122029292929211', 'BRI', 'c66b6609777a4d78891d85471e826b12.jpg', 0),
(17, '1fe3d4d264a9478a82de468c2eb3183b', '2021-10-31 13:02', '2021-11-01 13:02', 0, 'alvaren', '6654329065123', 'BRI', '185b966b19cc43a29eb294600e9f3ab6.jpg', 0);

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
(3, 'Rental Mobil Zhafira', '085240224411', 'Jl. Jend. Sudirman, Wumialo, Kota Tengah, Kota Jakarta', '12345', '0.6267063430630531', '123.00219065279276', '212334234', 'BRI', 'DIKA'),
(6, 'Rental Mobil Alva', '082258784721', 'Jl. Harsono RM No.1, Ragunan, Kec. Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta', '12345', '', '', '213324324', 'BNI', 'Alva'),
(9, 'Rental Taka', '085240097431', 'Gambir, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta', '12345', '', '', '12313131231312', '', ''),
(10, 'Rental Mobil AO', '082259500319', 'Jl. Sultan Iskandar Muda, RT.10/RW.6, Kby. Lama Utara, Kec. Kby. Lama, Kota Jakarta Selatan', '12345', '', '', '111111111111112', 'bccc2', 'nama rekening2');

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
(63, '937f78a32f5d45a296bf14640390030b', 40, 4, '6', 'NAMA REKENING', '122029292929211', 'BRI', '269c876c415d48d4bffbb127654ff08e.jpg', '2021-06-12 23:51', '2021-06-12 15:51', '2021-06-13 15:51', '', 1),
(64, '07d29172a7524b6188c6fbd8289e4d75', 40, 4, '6', 'NAMA REKENING', '122029292929211', 'BRI', '285d96dab15c4060bc4b9e561375badc.jpg', '2021-06-13 00:15', '2021-06-12 16:15', '2021-06-13 16:15', '', 1),
(65, '3de5724805e04c3a9801539628778830', 40, 2, '3', 'NAMA REKENING', '122029292929211', 'BRI', 'b2325b4c8c824226a9212009767384f6.jpg', '2021-06-13 00:22', '2021-06-12 16:22', '2021-06-17 16:22', '', 1),
(66, '57877ee2c1844c9bb95cf6edb335c9ee', 41, 4, '6', 'dasdas', '4234', 'dsad', 'cedc160ff7804defa071888a099e4662.jpg', '2021-10-26 22:44', '2021-10-26 14:44', '2021-10-28 14:44', '', 1),
(67, '026a25743c3a4bbc989c3071818dc173', 41, 21, '3', 'dasdas', '4234', 'dsad', 'a29953d84f174e6f84f5067415a0350b.jpg', '2021-10-28 20:37', '2021-10-28 12:37', '2021-10-29 12:37', '', 1),
(69, '1fe3d4d264a9478a82de468c2eb3183b', 43, 18, '3', 'alvaren', '6654329065123', 'BRI', '18db4518cb6848c982d21df7c903de28.jpg', '2021-10-28 21:02', '2021-10-28 13:02', '2021-11-01 13:02', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_daftar` timestamp NOT NULL DEFAULT current_timestamp(),
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
(39, 'xtxyyc', '2021-06-01 11:23:41', 0, '158558', 'uf7f7f', 'txtx', '85858', 'X7OAsY', '67a555667a18471dab7b1fdbdf58d37b.jpg', 1, 'dtdyxyd', 'cyxy', 'xtfxyxdyd', 'eMw4F8aET_ehm_bEweHWav:APA91bGyBnaYzjv0a4oba4RFMRk7jOy_Sc6hgl8TMklD30HaCdwcdJNn1lYQ9apjpuCM40b9nv-h4tdu_C29qVzT6ccGy0VFfOO9y-09VqNqthgsx-v5tyEzltLfTaD1GRQWhXPy8eCI'),
(40, 'Diki Paris', '2021-06-05 15:15:16', 0, '082259500319', 'Just. rumah sawit in', 'Pekerjaan', '12344441414', 'eD7QGA', '0e21caaffc5e46b88ef40ad6f6a57832.jpg', 1, '122029292929211', 'NAMA REKENING', 'BRI', 'eMw4F8aET_ehm_bEweHWav:APA91bGyBnaYzjv0a4oba4RFMRk7jOy_Sc6hgl8TMklD30HaCdwcdJNn1lYQ9apjpuCM40b9nv-h4tdu_C29qVzT6ccGy0VFfOO9y-09VqNqthgsx-v5tyEzltLfTaD1GRQWhXPy8eCI'),
(41, 'sadjadad', '2021-10-26 14:41:11', 0, '082259500321', '-', 'adde', '123131', 'sxO7gc', '874b89a87a54494f98341c93f49c8ca8.jpg', 1, '4234', 'dasdas', 'dsad', 'fFWAI6OMT2CgrF9y7I9uOe:APA91bHgBQvpj9JcCnGHo7ujcNSStHhjr-FkMJeHRZWJQHm1uFP-AM-f6do_UJ6Ab0MGApk-7LKNv8jLcfZPV3Gh3PmtKQ-fePsiyYAycsWfGfCEK4a4Wo6YK8GskgfVOmoVIdZ_PZu1'),
(42, 'Dano', '2021-10-28 12:48:53', 0, '085240097408', 'just. irian 29', 'Programmer', '12345678910112', 'FueUHk', '3e52b32bb9b14a6b882dedbdef5eb438.jpg', 1, '77234566181389', 'Dano', 'BRI', 'fFWAI6OMT2CgrF9y7I9uOe:APA91bHgBQvpj9JcCnGHo7ujcNSStHhjr-FkMJeHRZWJQHm1uFP-AM-f6do_UJ6Ab0MGApk-7LKNv8jLcfZPV3Gh3PmtKQ-fePsiyYAycsWfGfCEK4a4Wo6YK8GskgfVOmoVIdZ_PZu1'),
(43, 'Alvaren', '2021-10-28 13:00:22', 0, '085259500319', 'jl. irigasi 234, bandung', 'Mahasiswa', '123654789357159', 'BLW82y', '39323459780346509fe2098759fd0caf.jpg', 1, '6654329065123', 'alvaren', 'BRI', 'fFWAI6OMT2CgrF9y7I9uOe:APA91bHgBQvpj9JcCnGHo7ujcNSStHhjr-FkMJeHRZWJQHm1uFP-AM-f6do_UJ6Ab0MGApk-7LKNv8jLcfZPV3Gh3PmtKQ-fePsiyYAycsWfGfCEK4a4Wo6YK8GskgfVOmoVIdZ_PZu1');

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
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_perpanjangan`
--
ALTER TABLE `tb_perpanjangan`
  MODIFY `id_perpanjangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_rental`
--
ALTER TABLE `tb_rental`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `urutan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
