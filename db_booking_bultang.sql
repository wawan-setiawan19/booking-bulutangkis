-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2023 at 05:46 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_booking_bultang`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukti_pembayaran`
--

CREATE TABLE `bukti_pembayaran` (
  `id_bukti` int(11) NOT NULL,
  `screenshot` varchar(50) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `keperluan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bukti_pembayaran`
--

INSERT INTO `bukti_pembayaran` (`id_bukti`, `screenshot`, `id_pemesanan`, `keperluan`) VALUES
(1, 'UseCase Absensi.png', 7, 'DP'),
(2, 'Screen Shot 2023-05-04 at 12.36.01.png', 13, 'LUNAS');

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `id` int(11) NOT NULL,
  `nama_lapangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`id`, `nama_lapangan`) VALUES
(1, 'Lapang 1'),
(2, 'Lapang 2');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `id_lapangan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `expired` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `id_lapangan`, `id_user`, `tanggal`, `waktu`, `status`, `expired`) VALUES
(1, 1, 6, '2023-04-17', 1, 'LUNAS', '2023-06-03 15:13:10'),
(2, 2, 6, '2023-04-17', 5, 'LUNAS', '2023-06-03 15:13:10'),
(3, 1, 6, '2023-04-18', 4, 'LUNAS', '2023-06-03 15:13:10'),
(6, 1, 8, '2023-05-09', 2, 'LUNAS', '2023-06-03 15:13:10'),
(7, 1, 7, '2023-05-09', 1, 'LUNAS', '2023-06-03 15:20:12'),
(9, 1, 5, '2023-05-19', 1, 'LUNAS', '2023-06-03 15:13:10'),
(10, 1, 0, '2023-06-03', 1, 'LUNAS', '2023-06-03 15:13:10'),
(11, 2, 0, '2023-06-03', 1, 'LUNAS', '2023-06-03 15:13:10'),
(12, 1, 0, '2023-06-03', 3, 'LUNAS', '2023-06-03 15:13:10'),
(13, 2, 7, '2023-06-03', 3, 'LUNAS', '2023-06-03 15:21:32'),
(14, 2, 0, '2023-06-03', 2, 'LUNAS', '2023-06-03 15:13:10'),
(15, 1, 7, '2023-06-03', 2, 'MENUNGGU VALIDASI', '2023-06-03 15:18:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'default.svg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `name`, `photo`) VALUES
(1, 'admin', 'admin@gmail.com', '$2a$12$LwgF4wxCBJfI8TpYtqncAukNu.IFnVy1REzKB3mgnTZ.EmDQ10dNi', 'admin', 'Admin', 'default.svg'),
(5, 'testing2', 'testing2@gmail.com', '$2y$10$kYEqhvoibXlhr6oZlgw.W.zmwDCx.6VvKsjh9BuxWOeI9YLHilx5K', 'user', 'testing2', 'default.svg'),
(6, 'user', 'user@gmail.com', '$2y$10$j3w0JI0TH3auowBA/0BIBeV.hzcruve4Kw.y7GAbrxIHaQqd3tvAG', '', '', 'default.svg'),
(7, 'antoni', 'antoni@gmail.com', '$2y$10$aB7QQyqQNTCcKH3K3R9hV.gSXADkP5yC5zx2HcMGx.fIL5MoyQEKy', '', '', 'default.svg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  ADD PRIMARY KEY (`id_bukti`);

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukti_pembayaran`
--
ALTER TABLE `bukti_pembayaran`
  MODIFY `id_bukti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
