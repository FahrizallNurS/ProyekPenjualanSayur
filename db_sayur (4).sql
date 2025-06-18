-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 15, 2025 at 05:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sayur`
--

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `Id_Pembayaran` int(11) NOT NULL,
  `Subtotal_Produk` varchar(20) DEFAULT NULL,
  `Total_Pembayaran` varchar(30) DEFAULT NULL,
  `Id_Pengguna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`Id_Pembayaran`, `Subtotal_Produk`, `Total_Pembayaran`, `Id_Pengguna`) VALUES
(9, '12000', '24000', 10),
(23, NULL, '54000', 18),
(24, NULL, '24000', 10),
(25, NULL, '32000', 10);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `Id_Produk` int(11) NOT NULL,
  `Nama_Produk` varchar(20) DEFAULT NULL,
  `Harga_Produk` varchar(20) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`Id_Produk`, `Nama_Produk`, `Harga_Produk`, `gambar`) VALUES
(24, 'Daun bawang', '12000', '472a1aa39ae9a70f63a2c1a2c69f0faa.png'),
(25, 'Jahe', '12000', 'jahe.png'),
(28, 'Wortel', '10000', '50193a5a6424e49fe2e4c72a730fbac6.png'),
(29, 'Sawi', '10000', '5dd764b50318a366452c6aa9daac0856.png'),
(31, 'Cabai', '10000', '7ccc57de30081e98a69195234a33b890.png'),
(34, 'tomatt', '10000', 'a73a3c1ad5887700467858af26447788.png'),
(36, 'pare ', '12000', 'b30d685b799a605cdad98bc8b1378903.png'),
(38, 'Lobak', '30000', '4478353c39d5ab3a2fa86d1ad3fa4367.png');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `Id_Transaksi` int(11) NOT NULL,
  `Id_Pengguna` int(11) NOT NULL,
  `Id_Produk` int(11) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `Id_Pembayaran` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`Id_Transaksi`, `Id_Pengguna`, `Id_Produk`, `Jumlah`, `Id_Pembayaran`) VALUES
(25, 1, 24, 9, NULL),
(26, 1, 25, 1, NULL),
(27, 17, 24, 2, NULL),
(32, 10, 25, 1, 9),
(41, 18, 24, 1, 23),
(42, 18, 25, 1, 23),
(43, 18, 28, 1, 23),
(44, 18, 29, 1, 23),
(45, 10, 25, 1, 24),
(46, 10, 31, 2, 25);

-- --------------------------------------------------------

--
-- Table structure for table `t_admin`
--

CREATE TABLE `t_admin` (
  `id_admin` int(15) NOT NULL,
  `nama_admin` varchar(40) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email_Admin` varchar(30) NOT NULL,
  `NoHP` varchar(15) NOT NULL,
  `Alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_admin`
--

INSERT INTO `t_admin` (`id_admin`, `nama_admin`, `Password`, `Email_Admin`, `NoHP`, `Alamat`) VALUES
(1, 'AWA', '$2y$15$F0KS5UlT6AIWU7VJi8fsUOhWU/P3NTWZeUDzd0iMjvVprI4FVN3Fi', 'awa@gmail.com', '081234567890', 'Jl. Mawar No.10');

-- --------------------------------------------------------

--
-- Table structure for table `t_pengguna`
--

CREATE TABLE `t_pengguna` (
  `Id_Pengguna` int(11) NOT NULL,
  `Nama_pengguna` varchar(45) DEFAULT NULL,
  `Email_Pengguna` varchar(45) DEFAULT NULL,
  `NoTelp_Pengguna` varchar(20) DEFAULT NULL,
  `Alamat_Pengguna` varchar(35) DEFAULT NULL,
  `JenisKelamin` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `token_ganti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_pengguna`
--

INSERT INTO `t_pengguna` (`Id_Pengguna`, `Nama_pengguna`, `Email_Pengguna`, `NoTelp_Pengguna`, `Alamat_Pengguna`, `JenisKelamin`, `Password`, `token_ganti`) VALUES
();

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`Id_Pembayaran`),
  ADD KEY `fk_t_pengguna` (`Id_Pengguna`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`Id_Produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`Id_Transaksi`),
  ADD KEY `pengguna_Id_Pengguna` (`Id_Pengguna`),
  ADD KEY `Produk_Id_Produk` (`Id_Produk`),
  ADD KEY `pembayaran_Id_Pembayaran` (`Id_Pembayaran`);

--
-- Indexes for table `t_admin`
--
ALTER TABLE `t_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `t_pengguna`
--
ALTER TABLE `t_pengguna`
  ADD PRIMARY KEY (`Id_Pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `Id_Pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `Id_Produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `Id_Transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `t_admin`
--
ALTER TABLE `t_admin`
  MODIFY `id_admin` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_pengguna`
--
ALTER TABLE `t_pengguna`
  MODIFY `Id_Pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_t_pengguna` FOREIGN KEY (`Id_Pengguna`) REFERENCES `t_pengguna` (`Id_Pengguna`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`Id_Pengguna`) REFERENCES `t_pengguna` (`Id_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`Id_Produk`) REFERENCES `produk` (`Id_Produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`Id_Pembayaran`) REFERENCES `pembayaran` (`Id_Pembayaran`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
