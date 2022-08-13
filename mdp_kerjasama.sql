-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2022 at 07:24 AM
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
(48, 'bukti 1', 'file-1659595478.pdf', 29, 'Y', 'T', 'T', 'P', '2022-08-04 06:44:38', '2022-08-04 06:44:38'),
(49, 'bukti Q1', 'file-1659595498.pdf', 29, 'T', 'Y', 'T', 'B', '2022-08-04 06:44:58', '2022-08-04 06:44:58'),
(53, 'bukti 1', 'file-1659599847.pdf', 30, 'T', 'Y', 'T', 'L', '2022-08-04 07:57:27', '2022-08-04 07:57:27'),
(54, 'Bukti A', 'file-1660094187.png', 37, 'Y', 'T', 'T', 'P', '2022-08-10 01:16:27', '2022-08-10 01:16:27'),
(55, 'Bukti A', 'file-1660096033.png', 38, 'T', 'Y', 'T', 'P', '2022-08-10 01:47:13', '2022-08-10 01:47:13'),
(56, 'Bukti A', 'file-1660365727.png', 34, 'T', 'T', 'Y', 'P', '2022-08-13 04:42:07', '2022-08-13 04:42:07');

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
(45, 2, 48, '2022-08-04 06:44:38', '2022-08-04 06:44:38'),
(46, 2, 49, '2022-08-04 06:44:58', '2022-08-04 06:44:58'),
(50, 5, 53, '2022-08-04 07:57:27', '2022-08-04 07:57:27'),
(51, 1, 54, '2022-08-10 01:16:27', '2022-08-10 01:16:27'),
(52, 1, 55, '2022-08-10 01:47:13', '2022-08-10 01:47:13'),
(53, 2, 56, '2022-08-13 04:42:08', '2022-08-13 04:42:08');

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

--
-- Dumping data for table `bukti_kerjasamas`
--

INSERT INTO `bukti_kerjasamas` (`id`, `nama_bukti_kerjasama`, `file`, `kerjasama_id`, `created_at`, `updated_at`) VALUES
(24, 'Bukti Kerjasama Q1', 'file-1656651006.png', 8, '2022-07-01 04:50:06', '2022-07-01 04:50:06'),
(27, 'Upload FIle PDF', 'file-1656651201.pdf', 8, '2022-07-01 04:53:21', '2022-07-01 04:53:21'),
(28, 'Bukti Kerjasama Dari Kerja Sama Q12', 'file-1657650172.png', 9, '2022-07-12 18:22:52', '2022-07-12 18:22:52'),
(29, 'Bukti Kerjasama', 'file-1657651442.png', 8, '2022-07-12 18:29:07', '2022-07-12 18:44:44');

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
(29, '2022-08-03', '2022-08-06', 'Kegiatan 10', NULL, 'Keterangan 10', 8, 13, '1', '2022-05-04 16:25:20', '2022-08-13 05:18:11'),
(30, '2022-08-04', '2022-08-31', 'Kegiatan Q10', NULL, 'Keterangan Q10', 9, 13, '1', '2022-07-02 19:05:00', '2022-08-04 06:52:13'),
(32, '2022-08-04', '2022-08-19', 'Kegiatan E10', NULL, 'Keterangan E10', 9, 11, '1', '2022-08-04 06:13:45', '2022-08-04 06:14:21'),
(34, '2022-08-10', '2022-08-13', 'Kegiatan T10', NULL, 'Keterangan T10', 8, 13, '1', '2022-08-10 00:51:08', '2022-08-10 01:48:03'),
(37, '2022-08-10', '2022-08-12', 'Kegiatan T10', NULL, 'Keterangan T10', 8, 2, '1', '2022-08-10 01:11:49', '2022-08-10 01:12:11'),
(38, '2022-08-10', '2022-08-11', 'Kegiatan Y10', NULL, 'Keterangan Y10', 9, 2, '1', '2022-08-10 01:20:15', '2022-08-10 01:44:36'),
(39, '2022-08-11', '2022-08-24', 'Kegiatan 10', NULL, 'Keterangan 10', 8, 2, '1', '2022-08-10 01:32:37', '2022-08-10 01:44:44'),
(40, '2022-08-10', '2022-08-13', 'Kegiatan 10', NULL, 'Keterangan 10', 8, 2, '0', '2022-08-10 01:42:46', '2022-08-10 01:42:46'),
(41, '2022-08-13', '2022-08-16', 'Kegiatan U10', NULL, 'Keterangan U10', 8, 13, '1', '2022-08-13 04:39:26', '2022-08-13 04:43:28');

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
(8, 'Kerja Sama Q1', 'MoU001', '2022-06-30', '2022-07-22', 1, 2, 17, '2022-06-29 19:20:18', '2022-07-24 11:25:05'),
(9, 'Kerja Sama Q2', '', '2022-07-01', '2022-07-02', 2, 3, 19, '2022-07-01 04:34:11', '2022-07-24 11:40:48'),
(15, 'Kerjasama Q3', '', '2022-07-22', '2022-07-30', 3, 2, 17, '2022-07-21 17:50:54', '2022-08-02 02:25:27'),
(16, 'Kerjasama Q4', '', '2022-07-23', '2022-07-24', 2, 2, 19, '2022-07-23 21:49:13', '2022-07-24 11:20:55'),
(17, 'Kerja Sama Q5', '', '2022-07-24', '2022-07-31', 2, 2, 18, '2022-07-23 22:13:12', '2022-08-02 02:25:27');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `nama_unit`, `created_at`, `updated_at`) VALUES
(1, 'UMDP', '2022-04-21 15:11:07', '2022-06-29 03:02:14'),
(2, 'FIKR', '2022-04-21 08:11:14', '2022-06-24 13:28:29'),
(3, 'FEB', '2022-04-21 08:11:30', '2022-06-24 13:28:38'),
(4, 'IF', '2022-04-27 03:26:29', '2022-06-24 13:28:45'),
(5, 'SI', '2022-04-22 00:37:07', '2022-06-24 13:28:52'),
(6, 'TE', '2022-04-27 03:30:03', '2022-06-24 13:28:58'),
(7, 'MI', '2022-04-27 03:31:00', '2022-06-24 13:29:06'),
(8, 'AK', '2022-04-27 03:34:34', '2022-06-24 13:29:14'),
(15, 'MJ', '2022-07-11 13:04:14', '2022-07-11 13:04:14');

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
(2, '000000', 'MainAccount', 'admin@gmail.com', 'A', 1, NULL, NULL, '$2y$10$1Z/MaxYrXiOtFN5zZdu6.eeDsbt.QqEnmpgKS/WhKnrPEbCYh/qsa', NULL, '2022-05-27 01:55:39', '2022-07-29 14:48:39'),
(4, 'D00002', 'Account Dosen', 'dosen@gmail.com', 'D', 3, 'file-D00002-Main Account Dosen 1.jpg', NULL, '$2y$10$Rk9WruJrJqv/WJ7a5vhw8uV3cw96IbybCGoqIxYA.pwtLtfsYxZsG', NULL, '2022-05-29 02:59:11', '2022-07-29 14:48:44'),
(6, 'D00004', 'Main Account User', 'user@mail.com', 'K', 6, 'file-D00004-User123.jpg', NULL, '$2y$10$LGiWSlpAmY29qI8yYpJ.PuwxLHK4SaXBS2uWLTU6BgR0UQBNwFvaK', NULL, '2022-06-26 02:31:14', '2022-07-29 14:48:51'),
(11, 'D00003', 'MainDekan', 'dekan@gmail.com', 'E', 8, NULL, NULL, '$2y$10$DSPCZBtaRwe.9yfO0XR9j.bHsiIS7IV8R/OHhObOgnlt/49x8Ko0m', NULL, '2022-07-21 17:21:28', '2022-07-29 14:48:58'),
(13, 'D00010', 'User Main', 'usermain026@gmail.com', 'D', 1, NULL, NULL, '$2y$10$DJzep551eMhQyLRkDxW9QuApzJcab5F5cnSQS07wnsEw2l5Vdul9e', NULL, '2022-08-03 15:36:10', '2022-08-03 15:36:10');

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
(17, 'Pengusulan Tentang Nomor 1', 'Membentuk Kerjasama Nomor 1', 'Rencanakan Nomor 1', '081335888815', 'I', 2, 4, 2, 'L', 'Kesepakatan Disetujui', '2022-07-18 16:42:43', '2022-07-23 21:06:52'),
(18, 'Pengusulan Tentang Nomor 2', 'Membentuk Kerjasama Nomor 2', 'Rencanakan Nomor 2', '0813358888131', 'O', 2, 6, 3, 'L', 'Kesepakatan Disetujui', '2022-07-18 17:03:52', '2022-07-24 10:41:51'),
(19, 'Pengusulan Tentang Nomor Q2', 'Membentuk Kerjasama Nomor Q2', 'Rencanakan Nomor Q2', '081335888814', 'I', 15, 6, 4, 'L', 'Kesepakatan Disetujui', '2022-07-18 17:35:40', '2022-07-24 10:42:05'),
(20, 'Pengusulan Tentang Nomor 3', 'Membentuk Kerjasama Nomor 3', 'Rencanakan Nomor 3', '081335888812', '', 2, 11, 2, 'T', 'Kesepakatan Tidak Disetujui', '2022-07-21 17:29:36', '2022-07-24 11:25:11'),
(21, 'Pengusulan Tentang Nomor Q3', 'Membentuk Kerjasama Nomor Q3', 'Rencana Q2', '081335888813', 'O', 3, 11, 2, 'B', NULL, '2022-07-23 21:15:09', '2022-07-24 11:35:28'),
(22, 'Usulan Q1', 'Bentuk Kerjasama Q1', 'Rencana Kegiatan Q1', '081335888810', 'I', 2, 4, 2, 'L', 'Kesepakatan Disetujui', '2022-07-24 18:46:38', '2022-07-24 18:46:55');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `bukti_kegiatan_units`
--
ALTER TABLE `bukti_kegiatan_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `kerjasamas`
--
ALTER TABLE `kerjasamas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `usulans`
--
ALTER TABLE `usulans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
