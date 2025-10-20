-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 20 Okt 2025 pada 02.00
-- Versi server: 8.3.0
-- Versi PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aduan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `masyarakat`
--

DROP TABLE IF EXISTS `masyarakat`;
CREATE TABLE IF NOT EXISTS `masyarakat` (
  `nik` char(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`nik`),
  UNIQUE KEY `masyarakat_username_unique` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `masyarakat`
--

INSERT INTO `masyarakat` (`nik`, `nama`, `username`, `password`, `telp`, `created_at`, `updated_at`) VALUES
('1234567890123456', 'ryo', 'io', '$2y$12$13X.Xevj2WMtY1rsibm/i.7xWYML2xX/qi5dae3w3jrAZ5qyHTys6', '121212121212', '2025-09-11 05:14:28', '2025-09-11 05:14:28'),
('1234567890123455', '1', '1', '$2y$12$AX9OqID./7NO1PsqnxXaOe4arzaqmq.YHINbTPdpJ5VJSt8NoGKA6', '111111111111', '2025-09-14 18:40:40', '2025-09-14 18:40:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2025_09_11_014425_create_masyarakat_table', 1),
(3, '2025_09_11_125237_create_pengaduan_table', 2),
(4, '2025_09_11_140341_create_petugas_table', 3),
(5, '2025_09_11_142039_create_tanggapan_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

DROP TABLE IF EXISTS `pengaduan`;
CREATE TABLE IF NOT EXISTS `pengaduan` (
  `id_pengaduan` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tgl_pengaduan` date NOT NULL,
  `nik` char(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_laporan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(355) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','proses','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengaduan`),
  KEY `pengaduan_nik_foreign` (`nik`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `tgl_pengaduan`, `nik`, `isi_laporan`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(1, '2025-09-11', '1234567890123456', 'adili jokowi', 'aduan/OL73q2djVI9VDWFEicrtIJEULxaQp2AEL7je8kMp.jpg', 'selesai', '2025-09-11 05:58:51', '2025-09-14 18:52:19'),
(2, '2025-09-15', '1234567890123456', '11212121', 'aduan/KswtSi8V4No28iECBHnMTIM0WS6YHxdqUWvK8hyg.jpg', 'proses', '2025-09-14 19:18:29', '2025-09-14 19:21:28'),
(3, '2025-09-15', '1234567890123455', 'kita satu', 'aduan/PhaYM0uHPCRFp2yE5q6GfLKoEBfVVaAo4BMOwlDx.png', 'proses', '2025-09-14 19:19:10', '2025-09-14 19:21:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

DROP TABLE IF EXISTS `petugas`;
CREATE TABLE IF NOT EXISTS `petugas` (
  `id_petugas` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_petugas` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','petugas') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_petugas`),
  UNIQUE KEY `petugas_username_unique` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `telp`, `level`, `created_at`, `updated_at`) VALUES
(1, 'yo', 'ryo', '$2y$12$vncYh56AObDr3Kr/llx7BuGt/KOh8bOj4OpwK7hIMHZir9ZwGeDcG', '121212121212', 'admin', '2025-09-11 07:27:08', '2025-09-11 07:27:08'),
(2, '1', '1', '$2y$12$uk05.MTtSUmda2Pf2sbK3uc.SYwaa0/lX.8IsB5Awfe9coOn187eK', '121212121212', 'petugas', '2025-09-11 07:34:22', '2025-09-11 07:34:22'),
(3, '2', '2', '$2y$12$JALhiXBhCNoMNq8AvzkasOj3/QkQH7BzRJgRSwJObaTkr3S6sXI7y', '111111111111', 'petugas', '2025-09-14 18:50:42', '2025-09-14 18:50:42'),
(4, '3', '3', '$2y$12$sHsK4NeZ1OS9LNFrtOfm4.6JnJIX9SQ7cfwIc9mp/9lHa9sPAThQC', '111111111111', 'petugas', '2025-09-14 19:20:36', '2025-09-14 19:20:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapan`
--

DROP TABLE IF EXISTS `tanggapan`;
CREATE TABLE IF NOT EXISTS `tanggapan` (
  `id_tanggapan` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pengaduan` bigint UNSIGNED NOT NULL,
  `tgl_tanggapan` date NOT NULL,
  `tanggapan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_petugas` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tanggapan`),
  KEY `tanggapan_id_pengaduan_foreign` (`id_pengaduan`),
  KEY `tanggapan_id_petugas_foreign` (`id_petugas`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_pengaduan`, `tgl_tanggapan`, `tanggapan`, `id_petugas`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-09-11', 'otw', 1, '2025-09-11 07:27:44', '2025-09-11 07:27:44');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
