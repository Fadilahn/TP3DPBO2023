-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Bulan Mei 2023 pada 10.19
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_combo_food`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `food`
--

INSERT INTO `food` (`food_id`, `food_name`) VALUES
(1, 'Nasi Goreng'),
(2, 'Pizza'),
(3, 'Burger'),
(4, 'Sushi'),
(5, 'Spaghetti'),
(6, 'Tacos'),
(7, 'Chicken Rice'),
(8, 'Steak'),
(9, 'Dim Sum'),
(10, 'Curry');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_image` varchar(255) DEFAULT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_price` int(15) NOT NULL,
  `menu_desc` text DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `sauce_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_image`, `menu_name`, `menu_price`, `menu_desc`, `food_id`, `sauce_id`) VALUES
(1, '8-eDUakKtZiZQX0Ho.png', 'Curry with Teriyaki Sauce', 6, 'Delicious combo of Curry with Teriyaki Sauce', 4, 4),
(2, '8-bIMo90ecMSvEAas.png', 'Spaghetti with Barbecue Sauce', 13, 'Delicious combo of Spaghetti with Barbecue Sauce', 5, 3),
(3, '8-PevcjN20hNuPpVJ.png', 'Steak with Chili Sauce', 21, 'Delicious combo of Steak with Chili Sauce', 8, 7),
(4, '8-jeP0iRbdBfLlqPx.png', 'Dim Sum with Tartar Sauce', 14, 'Delicious combo of Dim Sum with Tartar Sauce', 9, 9),
(5, '8-BeJTIrbYxhlvc9Q.png', 'Tacos with Barbecue Sauce', 11, 'Delicious combo of Tacos with Barbecue Sauce', 6, 3),
(6, '8-bajftGxnN35HqVV.png', 'Tacos with Soy Sauce', 11, 'Delicious combo of Tacos with Soy Sauce', 6, 8),
(7, '8-HkWkuHrrS5TzlVP.png', 'Pizza with Tomato Sauce', 15, 'Delicious combo of Pizza with Tomato Sauce', 2, 5),
(8, '8-jeP0iRbdBfLlqPx.png', 'Tacos with Sambal', 16, 'Delicious combo of Tacos with Sambal', 6, 1),
(9, '8-ft93EHGnIsRf94b.png', 'Spaghetti with Mayonnaise', 19, 'Delicious combo of Spaghetti with Mayonnaise', 2, 2),
(10, '8-oK7YBAyHLu1jLsP.png', 'Nasi Goreng with Mayonnaise', 5, 'Delicious combo of Nasi Goreng with Mayonnaise', 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sauce`
--

CREATE TABLE `sauce` (
  `sauce_id` int(11) NOT NULL,
  `sauce_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sauce`
--

INSERT INTO `sauce` (`sauce_id`, `sauce_name`) VALUES
(1, 'Sambal'),
(2, 'Mayonnaise'),
(3, 'Barbecue Sauce'),
(4, 'Teriyaki Sauce'),
(5, 'Tomato Sauce'),
(6, 'Guacamole'),
(7, 'Chili Sauce'),
(8, 'Soy Sauce'),
(9, 'Tartar Sauce'),
(10, 'Sweet and Sour Sauce');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `sauce_id` (`sauce_id`);

--
-- Indeks untuk tabel `sauce`
--
ALTER TABLE `sauce`
  ADD PRIMARY KEY (`sauce_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `sauce`
--
ALTER TABLE `sauce`
  MODIFY `sauce_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`),
  ADD CONSTRAINT `menu_ibfk_2` FOREIGN KEY (`sauce_id`) REFERENCES `sauce` (`sauce_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
