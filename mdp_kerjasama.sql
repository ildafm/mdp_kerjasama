-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2022 at 05:25 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mdp_kerjasama`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukti_kegiatans`
--

CREATE TABLE `bukti_kegiatans` (
  `id` int(11) NOT NULL,
  `nama_bukti_kegiatan` varchar(100) NOT NULL,
  `file` varchar(255) NOT NULL,
  `kegiatans_id` int(11) NOT NULL,
  `ceklist_apt` enum('Y','T') NOT NULL DEFAULT 'T',
  `ceklist_aps` enum('Y','T') NOT NULL DEFAULT 'T',
  `ceklist_lamemba` enum('Y','T') NOT NULL DEFAULT 'T',
  `bidang` char(1) NOT NULL DEFAULT 'P',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bukti_kegiatans`
--

INSERT INTO `bukti_kegiatans` (`id`, `nama_bukti_kegiatan`, `file`, `kegiatans_id`, `ceklist_apt`, `ceklist_aps`, `ceklist_lamemba`, `bidang`, `created_at`, `updated_at`) VALUES
(58, 'Bukti1', 'file-1660883843.pdf', 61, 'T', 'Y', 'T', 'P', '2022-08-19 04:37:23', '2022-08-19 04:37:23'),
(59, 'Bukti1', 'file-1660914510.docx', 54, 'T', 'T', 'Y', 'B', '2022-08-19 13:08:31', '2022-08-19 13:08:31'),
(60, 'Bukti1', 'file-1661135464.pdf', 64, 'Y', 'T', 'T', 'N', '2022-08-22 02:31:04', '2022-08-22 02:31:04'),
(61, 'Bukti1', 'file-1661309849.docx', 70, 'Y', 'T', 'T', 'P', '2022-08-24 02:57:30', '2022-08-24 02:57:30'),
(62, 'Bukti1', 'file-1661310440.docx', 73, 'T', 'Y', 'T', 'N', '2022-08-24 03:07:20', '2022-08-24 03:07:20'),
(63, 'Bukti1', 'file-1661311508.docx', 71, 'T', 'Y', 'T', 'N', '2022-08-24 03:25:08', '2022-08-24 03:25:08');

-- --------------------------------------------------------

--
-- Table structure for table `bukti_kegiatan_units`
--

CREATE TABLE `bukti_kegiatan_units` (
  `id` int(11) NOT NULL,
  `units_id` int(11) NOT NULL,
  `bukti_kegiatans_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bukti_kegiatan_units`
--

INSERT INTO `bukti_kegiatan_units` (`id`, `units_id`, `bukti_kegiatans_id`, `created_at`, `updated_at`) VALUES
(55, 1, 58, '2022-08-19 04:37:23', '2022-08-19 04:37:23'),
(56, 1, 59, '2022-08-19 13:08:31', '2022-08-19 13:08:31'),
(57, 2, 60, '2022-08-22 02:31:05', '2022-08-22 02:31:05'),
(58, 4, 61, '2022-08-24 02:57:30', '2022-08-24 02:57:30'),
(59, 4, 62, '2022-08-24 03:07:20', '2022-08-24 03:07:20'),
(60, 2, 63, '2022-08-24 03:25:08', '2022-08-24 03:25:08');

-- --------------------------------------------------------

--
-- Table structure for table `bukti_kerjasamas`
--

CREATE TABLE `bukti_kerjasamas` (
  `id` int(11) NOT NULL,
  `nama_bukti_kerjasama` varchar(45) NOT NULL,
  `file` varchar(255) NOT NULL,
  `kerjasama_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dosens`
--

CREATE TABLE `dosens` (
  `id` int(11) NOT NULL,
  `kode_dosen` char(6) NOT NULL,
  `nama_dosen` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dosens`
--

INSERT INTO `dosens` (`id`, `kode_dosen`, `nama_dosen`, `created_at`, `updated_at`) VALUES
(1, 'D00001', 'Jhonny', '2022-04-22 07:40:52', '2022-06-20 17:55:43'),
(2, 'D00002', 'Deka', '2022-04-22 00:41:01', '2022-06-11 12:08:50'),
(3, 'D00003', 'Adi', '2022-04-22 00:42:17', '2022-04-22 00:42:17'),
(4, 'D00004', 'Ada', '2022-04-22 00:43:46', '2022-04-22 00:43:46'),
(5, 'D00005', 'Lily', '2022-04-22 00:45:45', '2022-04-22 00:45:45'),
(9, 'D00008', 'Nila', '2022-04-22 08:23:09', '2022-04-22 08:23:09'),
(10, 'D00007', 'Mas Andre', '2022-05-29 02:02:47', '2022-05-29 02:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'MoU', '2022-04-22 13:07:30', '2022-04-23 02:41:01'),
(2, 'Tanpa MoU', '2022-04-22 13:07:35', '2022-07-22 03:09:36'),
(3, '...', '2022-04-22 13:08:06', '2022-04-23 02:44:27');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatans`
--

CREATE TABLE `kegiatans` (
  `id` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_sampai` date NOT NULL,
  `bentuk_kegiatan` text NOT NULL,
  `PIC` enum('F','P') DEFAULT NULL,
  `keterangan` text NOT NULL,
  `kerjasama_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kegiatans`
--

INSERT INTO `kegiatans` (`id`, `tanggal_mulai`, `tanggal_sampai`, `bentuk_kegiatan`, `PIC`, `keterangan`, `kerjasama_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(54, '2022-08-08', '2022-08-12', 'kegiatan minggu pertama', NULL, 'kegiatan minggu pertama', 22, 15, '1', '2022-08-19 03:44:28', '2022-08-19 13:07:54'),
(55, '2022-08-29', '2022-09-02', 'kegiatan minggu 2', NULL, 'kegiatan minggu 2', 22, 15, '1', '2022-08-19 03:49:39', '2022-08-19 04:49:29'),
(56, '2022-09-05', '2022-09-10', 'kegiatan minggu 3', NULL, 'kegiatan minggu 3', 22, 15, '1', '2022-08-19 03:53:40', '2022-08-19 04:49:34'),
(57, '2022-09-12', '2022-09-16', 'kegiatan minggu 4', NULL, 'kegiatan minggu 4', 22, 15, '1', '2022-08-19 03:59:24', '2022-08-19 04:49:42'),
(58, '2022-08-22', '2022-08-26', 'kegiatan Baru', NULL, 'kegiatan Baru', 23, 15, '1', '2022-08-19 04:01:21', '2022-08-19 04:49:48'),
(59, '2022-08-29', '2022-09-03', 'kegiatan Baru 2', NULL, 'kegiatan Baru 2', 23, 15, '1', '2022-08-19 04:05:02', '2022-08-19 04:49:53'),
(60, '2022-09-05', '2022-09-10', 'kegiatan Baru 3', NULL, 'kegiatan Baru 3', 23, 15, '1', '2022-08-19 04:06:09', '2022-08-19 04:49:58'),
(61, '2022-08-01', '2022-08-06', 'kegiatan Lama', NULL, 'kegiatan Lama', 23, 15, '1', '2022-08-19 04:15:02', '2022-08-19 04:37:05'),
(64, '2022-08-19', '2022-08-23', 'kegiatan Baru', NULL, 'kegiatan minggu pertama', 27, 15, '0', '2022-08-19 14:08:17', '2022-08-22 02:26:17'),
(65, '2022-08-20', '2022-08-26', 'kegiatan minggu pertama', NULL, 'kegiatan minggu 2', 27, 15, '0', '2022-08-19 14:09:38', '2022-08-19 14:09:38'),
(66, '2022-08-19', '2022-09-02', 'kegiatan Baru Sekali Lagi Versi 2', NULL, 'kegiatan minggu pertama versi 2', 23, 15, '0', '2022-08-19 14:11:50', '2022-08-19 14:11:50'),
(67, '2022-08-27', '2022-09-03', 'kegiatan minggu pertama 12345', NULL, 'kegiatan Baru', 23, 15, '0', '2022-08-19 14:13:46', '2022-08-19 14:13:46'),
(68, '2022-08-18', '2022-08-22', 'kegiatan minggu pertama abcdefghijklmnopqrstuvwxyz', NULL, 'kegiatan minggu pertama abcdefghijklmnopqrstuvwxyz', 23, 15, '0', '2022-08-19 14:14:58', '2022-08-23 09:56:03'),
(69, '2022-08-23', '2022-08-27', 'kegiatan Baru', NULL, 'kegiatan minggu 2', 28, 25, '1', '2022-08-23 10:40:16', '2022-08-24 02:57:01'),
(70, '2022-08-24', '2022-08-26', 'kegiatan baru 4', NULL, 'keterangan baru 4', 22, 25, '1', '2022-08-24 02:03:06', '2022-08-24 02:10:03'),
(71, '2022-08-01', '2022-08-17', 'kegiatan fikr', NULL, 'kegiatan fikr', 23, 25, '1', '2022-08-24 02:11:09', '2022-08-24 03:10:44'),
(72, '2022-08-24', '2022-08-31', 'kegiatan Baru SI', NULL, 'keterangan Baru SI', 22, 25, '1', '2022-08-24 02:15:25', '2022-08-24 02:55:16'),
(73, '2022-08-24', '2022-08-25', 'AK', NULL, 'AK', 22, 15, '0', '2022-08-24 02:58:37', '2022-08-24 02:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `kerjasamas`
--

CREATE TABLE `kerjasamas` (
  `id` int(11) NOT NULL,
  `nama_kerja_sama` varchar(100) NOT NULL,
  `no_mou` varchar(255) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_sampai` date NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `usulan_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kerjasamas`
--

INSERT INTO `kerjasamas` (`id`, `nama_kerja_sama`, `no_mou`, `tanggal_mulai`, `tanggal_sampai`, `kategori_id`, `status_id`, `usulan_id`, `created_at`, `updated_at`) VALUES
(22, 'Kerjasama Minggu', 'MoU001', '2022-08-19', '2022-09-19', 1, 1, 27, '2022-08-19 03:36:06', '2022-08-23 10:53:36'),
(23, 'Kerjasama Baru', 'MoU002', '2022-08-19', '2022-09-24', 1, 1, 23, '2022-08-19 04:00:55', '2022-08-19 04:00:55'),
(27, 'Kerjasama Minggu Daun', '', '2022-08-19', '2022-09-09', 2, 1, 24, '2022-08-19 13:57:18', '2022-08-19 13:57:18'),
(28, 'Kerjasama Minggu', '', '2022-08-23', '2022-08-27', 2, 1, 25, '2022-08-23 10:39:43', '2022-08-23 10:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mitras`
--

CREATE TABLE `mitras` (
  `id` int(11) NOT NULL,
  `nama_mitra` varchar(45) NOT NULL,
  `tingkat` enum('I','N','W') NOT NULL DEFAULT 'W',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mitras`
--

INSERT INTO `mitras` (`id`, `nama_mitra`, `tingkat`, `created_at`, `updated_at`) VALUES
(1, 'Universitas Indonesia', 'I', '2022-04-21 08:19:25', '2022-04-24 08:00:27'),
(2, 'Universitas Palembang', 'N', '2022-04-21 08:19:25', '2022-04-24 08:00:33'),
(3, 'Universitas Indonesia Sejahtera', 'N', '2022-04-21 08:19:25', '2022-04-24 07:26:30'),
(4, 'Halaman Berkah', 'W', '2022-04-21 08:19:25', '2022-04-24 07:26:57'),
(10, 'Vietnam University', 'I', '2022-04-21 01:27:59', '2022-07-12 18:49:28'),
(15, 'UI', 'W', '2022-06-11 08:23:14', '2022-06-11 08:23:14'),
(16, 'Universitas A', 'N', '2022-06-11 11:28:37', '2022-07-12 19:50:58'),
(17, 'Universitas B', 'I', '2022-06-11 11:30:00', '2022-06-11 11:30:00'),
(18, 'Universitas C', 'I', '2022-06-11 11:30:56', '2022-06-11 11:30:56'),
(19, 'Universitas D', 'W', '2022-06-29 02:41:08', '2022-07-13 23:55:59'),
(20, 'Universitas F', 'W', '2022-07-12 18:49:40', '2022-07-24 18:55:57'),
(21, 'Universitas E', 'N', '2022-07-24 18:55:48', '2022-07-24 18:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$MkahvDf0MASCchRTHEgGr.px6cIoMqJ2b5jQzC4tfxz5lt06jqXrS', '2022-07-06 06:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `nama_status` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `nama_status`, `created_at`, `updated_at`) VALUES
(1, 'Aktif', '2022-04-22 07:48:14', '2022-07-24 19:27:33'),
(2, 'Kadaluarsa', '2022-04-22 00:48:32', '2022-07-24 19:27:40'),
(3, 'Dalam Perpanjangan', '2022-04-22 00:53:30', '2022-07-24 19:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `nama_unit` varchar(45) NOT NULL,
  `parent_unit` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `nama_unit`, `parent_unit`, `created_at`, `updated_at`) VALUES
(1, 'UMDP', NULL, '2022-04-21 15:11:07', '2022-06-29 03:02:14'),
(2, 'FIKR', 1, '2022-04-21 08:11:14', '2022-08-22 02:20:43'),
(3, 'FEB', 1, '2022-04-21 08:11:30', '2022-08-22 02:20:41'),
(4, 'IF', 2, '2022-04-27 03:26:29', '2022-08-22 02:19:52'),
(5, 'SI', 2, '2022-04-22 00:37:07', '2022-08-22 02:20:07'),
(6, 'TE', 2, '2022-04-27 03:30:03', '2022-08-22 02:20:12'),
(7, 'MI', 2, '2022-04-27 03:31:00', '2022-08-23 02:00:21'),
(8, 'AK', 3, '2022-04-27 03:34:34', '2022-08-22 02:20:21'),
(15, 'MJ', 3, '2022-07-11 13:04:14', '2022-08-22 02:20:25'),
(17, 'UPT SI', 1, '2022-08-23 01:56:51', '2022-08-23 01:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `kode_dosen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` char(1) CHARACTER SET utf8 NOT NULL,
  `unit_id` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `kode_dosen`, `name`, `email`, `level`, `unit_id`, `file`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(13, 'D00010', 'Admin User Main', 'usermain026@gmail.com', 'A', 1, NULL, NULL, '$2y$10$DJzep551eMhQyLRkDxW9QuApzJcab5F5cnSQS07wnsEw2l5Vdul9e', NULL, '2022-08-03 15:36:10', '2022-08-19 03:16:59'),
(15, 'D00012', 'Dosen Main Account', 'dosenmain026@gmail.com', 'D', 5, NULL, NULL, '$2y$10$PWvGiLn66aoCvWDk5lZUROuepAz5ZxPnfFyZ4IzgnV59nyGjxGDo2', NULL, '2022-08-19 03:30:18', '2022-08-23 09:57:04'),
(25, 'D00001', 'Fadli Dekan', 'ildafm4000@mhs.mdp.ac.id', 'E', 3, NULL, NULL, '$2y$10$a179UVJahrYMr8GQjTLy6.u/pnWCxi3ygJXwBZMNBe/.B1BOH6e5q', NULL, '2022-08-23 01:31:05', '2022-08-24 02:19:44'),
(26, 'D00002', 'Fadli Kaprodi', 'ildafm4000@gmail.com', 'K', 4, NULL, NULL, '$2y$10$1J.NmBL71u4oY161pIrLTOd0yGdGZhtMwq/x.ftnXfd49Ic9w1fsu', NULL, '2022-08-23 01:39:05', '2022-08-23 01:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `usulans`
--

CREATE TABLE `usulans` (
  `id` int(11) NOT NULL,
  `usulan` varchar(45) NOT NULL,
  `bentuk_kerjasama` text NOT NULL,
  `rencana_kegiatan` text NOT NULL,
  `kontak_kerjasama` varchar(13) DEFAULT NULL,
  `type` char(1) NOT NULL,
  `mitra_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `hasil_penjajakan` char(1) DEFAULT 'B',
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usulans`
--

INSERT INTO `usulans` (`id`, `usulan`, `bentuk_kerjasama`, `rencana_kegiatan`, `kontak_kerjasama`, `type`, `mitra_id`, `user_id`, `unit_id`, `hasil_penjajakan`, `keterangan`, `created_at`, `updated_at`) VALUES
(23, 'Kerjasama untuk membantu masyarakat', 'Bentukan 4', 'Minggu hijau', '081995999912', 'I', 1, 15, 2, 'L', 'Kesepakatan disetujui', '2022-08-19 03:34:29', '2022-08-23 10:55:30'),
(24, 'Usulan', 'Bentukan 4', 'Minggu hijau 1', '081995999912', 'O', 1, 15, 5, 'L', 'Kesepakatan disetujui', '2022-08-19 13:28:32', '2022-08-23 11:01:03'),
(25, 'Kerjasama untuk membantu masyarakat 2', 'Bentukan 43', 'Minggu hijau 12', '081995999901', 'I', 2, 26, 3, 'L', 'Kesepakatan disetujui', '2022-08-23 10:38:18', '2022-08-24 02:04:47'),
(26, 'Usulan FEB', 'Bentuk FEB', 'Rencana FEB', '0819130000012', 'I', 1, 15, 8, 'T', 'Kesepakatan tidak disetujui', '2022-08-23 10:50:21', '2022-08-23 10:51:44'),
(27, 'Usulan AK', 'Bentuk AK', 'Rencana AK', '0819130000011', 'I', 2, 13, 8, 'L', 'Kesepakatan disetujui', '2022-08-23 10:52:40', '2022-08-24 02:59:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukti_kegiatans`
--
ALTER TABLE `bukti_kegiatans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bukti_kegiatans_kegiatans1_idx` (`kegiatans_id`);

--
-- Indexes for table `bukti_kegiatan_units`
--
ALTER TABLE `bukti_kegiatan_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bukti_kegiatan_units_units1_idx` (`units_id`),
  ADD KEY `fk_bukti_kegiatan_units_bukti_kegiatans1_idx` (`bukti_kegiatans_id`);

--
-- Indexes for table `bukti_kerjasamas`
--
ALTER TABLE `bukti_kerjasamas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kerjasama_id` (`kerjasama_id`);

--
-- Indexes for table `dosens`
--
ALTER TABLE `dosens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_dosen_UNIQUE` (`kode_dosen`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_kategori_UNIQUE` (`nama_kategori`);

--
-- Indexes for table `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kegiatans_kerjasamas1_idx` (`kerjasama_id`),
  ADD KEY `fk_kegiatans_dosens1_idx` (`user_id`);

--
-- Indexes for table `kerjasamas`
--
ALTER TABLE `kerjasamas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kerjasamas_kategoris1_idx` (`kategori_id`),
  ADD KEY `fk_kerjasamas_status1_idx` (`status_id`),
  ADD KEY `fk_kerjasamas_usulan1` (`usulan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitras`
--
ALTER TABLE `mitras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_unit` (`parent_unit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fk_units` (`unit_id`);

--
-- Indexes for table `usulans`
--
ALTER TABLE `usulans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usulans_mitras1_idx` (`mitra_id`),
  ADD KEY `fk_usulans_units1_idx` (`unit_id`),
  ADD KEY `fk_usulans_users1` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukti_kegiatans`
--
ALTER TABLE `bukti_kegiatans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `bukti_kegiatan_units`
--
ALTER TABLE `bukti_kegiatan_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `bukti_kerjasamas`
--
ALTER TABLE `bukti_kerjasamas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `dosens`
--
ALTER TABLE `dosens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kegiatans`
--
ALTER TABLE `kegiatans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `kerjasamas`
--
ALTER TABLE `kerjasamas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `mitras`
--
ALTER TABLE `mitras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `usulans`
--
ALTER TABLE `usulans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bukti_kegiatans`
--
ALTER TABLE `bukti_kegiatans`
  ADD CONSTRAINT `fk_bukti_kegiatans_kegiatans1` FOREIGN KEY (`kegiatans_id`) REFERENCES `kegiatans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bukti_kegiatan_units`
--
ALTER TABLE `bukti_kegiatan_units`
  ADD CONSTRAINT `fk_bukti_kegiatan_units_bukti_kegiatans1` FOREIGN KEY (`bukti_kegiatans_id`) REFERENCES `bukti_kegiatans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bukti_kegiatan_units_units1` FOREIGN KEY (`units_id`) REFERENCES `units` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bukti_kerjasamas`
--
ALTER TABLE `bukti_kerjasamas`
  ADD CONSTRAINT `bukti_kerjasamas_ibfk_1` FOREIGN KEY (`kerjasama_id`) REFERENCES `kerjasamas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD CONSTRAINT `fk_kegiatans_kerjasamas1` FOREIGN KEY (`kerjasama_id`) REFERENCES `kerjasamas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kegiatans_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kerjasamas`
--
ALTER TABLE `kerjasamas`
  ADD CONSTRAINT `fk_kerjasamas_kategoris1` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kerjasamas_status1` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kerjasamas_usulan1` FOREIGN KEY (`usulan_id`) REFERENCES `usulans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `units_ibfk_1` FOREIGN KEY (`parent_unit`) REFERENCES `units` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_units` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usulans`
--
ALTER TABLE `usulans`
  ADD CONSTRAINT `fk_usulans_mitras1` FOREIGN KEY (`mitra_id`) REFERENCES `mitras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usulans_units1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usulans_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `auto_update_status_kerjasama` ON SCHEDULE EVERY 1 DAY STARTS '2022-07-22 00:35:05' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE kerjasamas
SET status_id = 2
WHERE tanggal_sampai < NOW() AND status_id = 1$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
