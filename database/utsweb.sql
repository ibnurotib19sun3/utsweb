-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Bulan Mei 2024 pada 09.26
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utsweb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `nama_kamar` varchar(100) NOT NULL,
  `kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `nama_kamar`, `kapasitas`) VALUES
(333, 'Percobaan', 56),
(1309, 'Darus Shohihain', 20),
(1401, 'Kamar Assalam', 30),
(1508, 'Darun Na\'im', 15),
(2302, 'Kamar Al Ma\'la', 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `ruang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `ruang`) VALUES
(1, '1 (Satu) Ibtida\'iyah', 'Ruang Assalam'),
(2, '2 (Dua) Ibtida\'iyah', 'Ruang 2 Ibtd'),
(3, '3 (Tiga) Ibtida\'iyah', 'Bangunan Utara Ruang Timur'),
(4, '4 (Empat) Ibtida\'iyah', 'Bangunan Selatan Ruang Barat'),
(102, '1 (Satu) Tsanawiyah', 'Utara Musholla Putra'),
(202, '2 (Dua) Tsanawiyah', 'Bangunan Barat Ruang Barat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `santri`
--

CREATE TABLE `santri` (
  `nis` int(25) NOT NULL,
  `nama_santri` varchar(250) NOT NULL,
  `id_kelas` int(25) NOT NULL,
  `id_kamar` int(25) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `santri`
--

INSERT INTO `santri` (`nis`, `nama_santri`, `id_kelas`, `id_kamar`, `alamat`) VALUES
(554, 'Santri Coba', 4, 1401, 'tesr'),
(140102, 'Mohammad Zaini', 4, 1309, 'Kebon Agung - Jetak - Montong - Tuban'),
(140225, 'Hapram Juli', 3, 1508, 'Bogang - Beji - Jenu - Tuban'),
(223002, 'Ahmad Nur Faqih', 2, 2302, 'Mentoso Jenu Tuban'),
(2401005, 'Affan', 1, 1401, 'alamat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'username', '$2y$10$1JPxhqa7a4HDX8ArdSIwue1xuNFMTNCPATesB96HT3gZmlk8WHXQq');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_kamar` (`id_kamar`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2410;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `santri`
--
ALTER TABLE `santri`
  ADD CONSTRAINT `santri_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `santri_ibfk_2` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
