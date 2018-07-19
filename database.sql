-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jul 2018 pada 17.31
-- Versi server: 10.1.30-MariaDB
-- Versi PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `url_gambar` varchar(200) NOT NULL,
  `status` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `nama_menu`, `harga`, `keterangan`, `url_gambar`, `status`) VALUES
(1, 'Steak The Bigger', '150000', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec libero urna, dapibus eget vehicula nec, aliquam at enim. Cras sed ex elit. Proin tristique laoreet turpis ac pellentesque. Pellentesque v', '/img/menus/2018_05_23_01_59_18_a3b05c9d9cdbca12cef914a6f433a160.jpg', 1),
(2, 'Spaghetti Aglio Olio', '56000', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec libero urna, dapibus eget vehicula nec, aliquam at enim. Cras sed ex elit. Proin tristique laoreet turpis ac pellentesque. Pellentesque v', '/img/menus/2018_05_23_02_01_38_bd7c3fc5b3a9305aa95f242c4b5dc744.jpg', 1),
(3, 'Steak Tuna Bakar Enak', '35000', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec libero urna, dapibus eget vehicula nec, aliquam at enim. Cras sed ex elit. Proin tristique laoreet turpis ac pellentesque. Pellentesque', '/img/menus/2018_05_23_03_39_45_115211ec9772e971168c7d2708db0866.jpg', 1),
(4, 'Chicken Nugget With Saus Tomat', '55000', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec libero urna, dapibus eget vehicula nec, aliquam at enim. Cras sed ex elit. Proin tristique laoreet turpis ac pellentesque. Pellentesque v', '/img/menus/2018_05_23_02_03_33_6334f06afec60b81c4edf285ac413588.jpg', 1),
(5, 'Nasi Goreng Special', '45000', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec libero urna, dapibus eget vehicula nec, aliquam at enim. Cras sed ex elit. Proin tristique laoreet turpis ac pellentesque. Pellentesque v', '/img/menus/2018_05_23_02_04_11_98e4cca471e56ca25c49c5455b36a791.jpg', 1),
(6, 'Lumpia Manis Telor', '35000', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec libero urna, dapibus eget vehicula nec, aliquam at enim. Cras sed ex elit. Proin tristique laoreet turpis ac pellentesque. Pellentesque v', '/img/menus/2018_05_23_02_04_35_67fc7e7403b1959d259c0f43fbc3b499.jpg', 1),
(7, 'Mie Gulung Udang', '64500', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec libero urna, dapibus eget vehicula nec, aliquam at enim. Cras sed ex elit. Proin tristique laoreet turpis ac pellentesque. Pellentesque v', '/img/menus/2018_05_23_02_05_02_879b5f5b7a37a5e7b9717aaaaa8f133d.jpg', 1),
(8, 'Udang Goreng With Salad', '37500', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec libero urna, dapibus eget vehicula nec, aliquam at enim. Cras sed ex elit. Proin tristique laoreet turpis ac pellentesque. Pellentesque v', '/img/menus/2018_05_23_02_05_58_55af8ab52d2394aed31d8b09e689e23c.jpg', 1),
(9, 'Tuna Sapi Sereh', '99500', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec libero urna, dapibus eget vehicula nec, aliquam at enim. Cras sed ex elit. Proin tristique laoreet turpis ac pellentesque. Pellentesque v', '/img/menus/2018_05_23_02_06_24_8b742a78ef5e51bfb3c722d17d35504b.jpg', 1),
(10, 'Steak with Poteto', '760000', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec libero urna, dapibus eget vehicula nec, aliquam at enim. Cras sed ex elit. Proin tristique laoreet turpis ac pellentesque. Pellentesque v', '/img/menus/2018_05_23_02_07_15_d03514f96c1c4683fa424834ec88081f.jpg', 1),
(11, 'Kentang Saus Rempah dengan Steak', '87500', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec libero urna, dapibus eget vehicula nec, aliquam at enim. Cras sed ex elit. Proin tristique laoreet turpis ac pellentesque. Pellentesque v', '/img/menus/2018_05_24_01_17_55_d1e4f3aef068f39438d2f9b5f48f957e.jpg', 1),
(12, 'Gurame Asam Pedas', '45000', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec libero urna, dapibus eget vehicula nec, aliquam at enim. Cras sed ex elit. Proin tristique laoreet turpis ac pellentesque.', '/img/menus/2018_07_19_03_42_30_91101eac73d55fc2f900595504bf4204.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `no_order` int(11) DEFAULT NULL,
  `nama_pelanggan` varchar(45) DEFAULT NULL,
  `tgl_order` datetime DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `status_bayar` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `no_meja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `no_order`, `nama_pelanggan`, `tgl_order`, `total`, `status_bayar`, `status`, `no_meja`) VALUES
(1, 41189075, 'Pelanggan', '2018-07-19 16:30:50', '0.00', 'unpaid', 'Antrian Masak', 34),
(2, 71495399, 'Pelanggan', '2018-07-19 16:31:17', '0.00', 'unpaid', 'Antrian Masak', 20),
(3, 77319322, 'Pelanggan', '2018-07-19 17:12:54', '0.00', 'unpaid', 'Antrian Masak', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(100) NOT NULL,
  `menu_id` int(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `harga` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `menu_id`, `qty`, `harga`) VALUES
(1, 1, 1, 1, '150000'),
(2, 2, 1, 1, '150000'),
(3, 2, 2, 1, '56000'),
(4, 2, 12, 1, '45000'),
(5, 3, 3, 1, '35000'),
(6, 3, 4, 1, '55000'),
(7, 3, 5, 1, '45000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` enum('Kasir','Pelayan','Koki','Admin') NOT NULL,
  `nip` varchar(11) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `jabatan`, `nip`, `password`) VALUES
(1, 'Asep Saepuloh Sahidin', 'Kasir', 'kasir', '123456'),
(2, 'Eka Meirani Agustin', 'Pelayan', 'pelayan', '123456'),
(3, 'Agus Suryana', 'Koki', 'koki', '123456'),
(4, 'Jhone due', 'Admin', 'admin', '123456');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
