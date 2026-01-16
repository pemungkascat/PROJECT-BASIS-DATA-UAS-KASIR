-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 16, 2026 at 05:25 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir_cctv`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_produk`, `jumlah`, `subtotal`) VALUES
(1, 1, 1, 2, 700000.00),
(2, 1, 3, 1, 850000.00),
(3, 1, 4, 1, 750000.00),
(4, 2, 1, 2, 700000.00),
(5, 3, 2, 3, 1950000.00),
(6, 4, 1, 3, 1080000.00),
(7, 5, 1, 1, 360000.00),
(8, 5, 3, 1, 850000.00),
(9, 6, 2, 3, 1950000.00),
(10, 6, 5, 3, 1350000.00),
(11, 2, 1, 2, 700000.00),
(12, 8, 1, 2, 700000.00),
(13, 10, 1, 4, 1440000.00),
(14, 10, 3, 1, 850000.00),
(15, 10, 4, 2, 1500000.00),
(16, 11, 1, 1, 360000.00),
(17, 11, 3, 1, 850000.00);

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

INSERT INTO `kasir` (`id_kasir`, `nama_kasir`, `telepon`) VALUES
(1, 'Ahmad Fauzi', '081299998888'),
(2, 'Siti Aminah', '081298765432'),
(5, 'Ahmad Fauzi', '081234567890'),
(6, 'Siti Aminah', '081298765432');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--


INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `telepon`, `alamat`, `email`) VALUES
(1, 'Budi Santoso', '085511223344', 'Jl. Sudirman No. 25, Jakarta', NULL),
(2, 'Ani Wijaya', '085577889900', 'Tangerang', NULL),
(4, 'catur pamungkas', '823814134', 'sukoharjo', NULL),
(5, 'hasan', '07643245678', 'sukoharjo', NULL),
(6, 'hasan m', '08334738212', 'sukoharjo', NULL),
(7, 'Ahmad Hasan Mustofa', '', '', NULL),
(8, 'Ahmad Hasan Mustofa', '08832736842', 'Ngunut, Sukoharjo', NULL),
(9, 'guguygygy', '08832736842', 'Karanganyar', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--


INSERT INTO `pembayaran` (`id_pembayaran`, `id_transaksi`, `metode_pembayaran`, `jumlah_uang_diterima`, `kembalian`, `status_pembayaran`) VALUES
(1, 1, 'Tunai', 2500000.00, 300000.00, NULL),
(2, 2, 'Tunai', 2000000.00, 500000.00, NULL),
(3, 3, 'Tunai', 1950000.00, 0.00, NULL),
(4, 4, 'Tunai', 1080000.00, 0.00, NULL),
(5, 5, 'Tunai', 1210000.00, 0.00, NULL),
(6, 6, 'Tunai', 3300000.00, 0.00, NULL),
(7, 2, 'Tunai', 2000000.00, 500000.00, NULL),
(9, 9, 'Tunai', 0.00, 0.00, NULL),
(10, 10, 'Tunai', 3790000.00, 0.00, NULL),
(11, 11, 'Tunai', 1210000.00, 0.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--



INSERT INTO `produk` (`id_produk`, `nama_produk`, `merk`, `harga`, `stok`) VALUES
(1, 'CCTV Indoor 2MP Dome', 'Hikvision', 360000.00, 39),
(2, 'CCTV Outdoor 5MP Bullet', 'Dahua', 650000.00, 27),
(3, 'DVR 4 Channel 1080P', 'Hikvision', 850000.00, 7),
(4, 'Harddisk 1TB WD Purple', 'Western Digital', 750000.00, 13),
(5, 'Kabel Coaxial RG59 + Power (100m)', 'BNC', 450000.00, 10),
(6, 'C6N G1 4K ', 'Ezviz', 1000000.00, 20);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--


INSERT INTO `transaksi` (`id_transaksi`, `id_kasir`, `id_pelanggan`, `tanggal_transaksi`, `total_bayar`) VALUES
(1, 1, 1, '2023-10-25 10:30:00', 2200000.00),
(2, 1, 1, '2026-01-16 10:33:31', 1500000.00),
(3, 1, 4, '2026-01-16 10:55:14', 1950000.00),
(4, 2, 2, '2026-01-16 10:57:46', 1080000.00),
(5, 1, 5, '2026-01-16 11:04:52', 1210000.00),
(6, 1, 6, '2026-01-16 11:07:27', 3300000.00),
(7, 1, 4, '2026-01-16 18:49:45', 1500000.00),
(8, 1, 1, '2026-01-16 18:58:09', 1500000.00),
(9, 5, 7, '2026-01-16 20:51:15', 0.00),
(10, 2, 8, '2026-01-16 20:51:49', 3790000.00),
(11, 2, 9, '2026-01-16 20:52:39', 1210000.00);

-- --------------------------------------------------------

