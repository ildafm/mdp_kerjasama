-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2022 at 05:08 AM
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bukti_kegiatans`
--

INSERT INTO `bukti_kegiatans` (`id`, `nama_bukti_kegiatan`, `file`, `kegiatans_id`, `ceklist_apt`, `ceklist_aps`, `ceklist_lamemba`, `created_at`, `updated_at`) VALUES
(6, 'Bukti kegiatan 2', 'file-1655296043.png', 1, 'Y', 'Y', 'Y', '2022-06-15 12:27:23', '2022-06-15 12:27:23'),
(7, 'Bukti kegiatan 3', 'file-1655297039.png', 1, 'T', 'Y', 'T', '2022-06-15 12:43:59', '2022-06-15 12:43:59'),
(8, 'Bukti kegiatan Q1', 'file-1655297673.jpg', 2, 'T', 'T', 'Y', '2022-06-15 12:54:33', '2022-06-15 12:54:33'),
(9, 'Bukti kegiatan 4', 'file-1655298011.png', 1, 'Y', 'Y', 'T', '2022-06-15 13:00:11', '2022-06-15 13:00:11');

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
(3, 1, 6, '2022-06-15 12:27:23', '2022-06-15 12:27:23'),
(4, 3, 7, '2022-06-15 12:43:59', '2022-06-15 12:43:59'),
(5, 4, 8, '2022-06-15 12:54:33', '2022-06-15 12:54:33'),
(6, 1, 9, '2022-06-15 13:00:11', '2022-06-15 13:00:11');

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
(8, 'Bukti Kerjasama 1', 'DocumentBuktiKerjasama-1654342435.png', 1, '2022-06-04 11:33:55', '2022-06-04 11:33:55'),
(9, 'Bukti Kerjasama Q2', 'DocumentBuktiKerjasama-1654849011.png', 1, '2022-06-10 08:16:51', '2022-06-10 08:16:51'),
(10, 'Bukti Kerjasama Q3', 'DocumentBuktiKerjasama-1654849085.png', 1, '2022-06-10 08:18:05', '2022-06-10 08:18:05'),
(14, 'Bukti Kerjasama Z1', 'DocumentBuktiKerjasama-1654854388.png', 2, '2022-06-10 09:46:28', '2022-06-10 09:46:28'),
(17, 'Kerjasama 3 Punya Bukti Bernama Bukti Y1', 'file-1655288413.png', 3, '2022-06-15 10:20:13', '2022-06-15 10:20:13'),
(18, 'Kerjasama 3 Punya Bukti Bernama Bukti Y2', 'file-1655288773.png', 3, '2022-06-15 10:26:13', '2022-06-15 10:26:13'),
(20, 'Ini Bukti Kerjasama 4 Namanya R4', 'file-1655288945.png', 5, '2022-06-15 10:29:05', '2022-06-15 10:29:05'),
(21, 'Ini file pdf Q1', 'file-1655288996.pdf', 1, '2022-06-15 10:29:56', '2022-06-15 10:29:56'),
(22, 'Ini file pdf Q2', 'file-1655292568.pdf', 1, '2022-06-15 11:29:28', '2022-06-15 11:29:28');

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
(2, 'SPK', '2022-04-22 13:07:35', '2022-04-23 02:41:14'),
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
  `PIC` enum('F','P') NOT NULL,
  `keterangan` text NOT NULL,
  `kerjasama_id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kegiatans`
--

INSERT INTO `kegiatans` (`id`, `tanggal_mulai`, `tanggal_sampai`, `bentuk_kegiatan`, `PIC`, `keterangan`, `kerjasama_id`, `dosen_id`, `created_at`, `updated_at`) VALUES
(1, '2022-06-24', '2022-07-05', 'Daring', 'F', 'Dilakukan secara daring selama beberapa hari', 1, 1, '2022-04-25 01:57:59', '2022-06-24 12:55:43'),
(2, '2022-04-25', '2022-05-25', 'Bentuk 1', 'P', 'Keterangan 1', 2, 9, '2022-04-25 01:58:07', '2022-04-25 01:58:07'),
(4, '2022-06-11', '2022-06-17', 'Bentuk Kegiatan Q3', 'P', 'Keterangan Empat Q1', 3, 2, '2022-06-11 12:09:28', '2022-06-11 12:09:28'),
(5, '2022-06-24', '2022-06-25', 'Bentuk ke 14', 'P', 'Keterangan ke 14', 3, 10, '2022-06-24 13:23:05', '2022-06-24 13:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `kerjasamas`
--

CREATE TABLE `kerjasamas` (
  `id` int(11) NOT NULL,
  `nama_kerja_sama` varchar(100) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_sampai` date NOT NULL,
  `mitra_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kerjasamas`
--

INSERT INTO `kerjasamas` (`id`, `nama_kerja_sama`, `tanggal_mulai`, `tanggal_sampai`, `mitra_id`, `kategori_id`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'Kerja Sama 31', '2022-06-28', '2022-06-29', 1, 1, 3, '2022-04-22 13:10:46', '2022-06-28 02:37:42'),
(2, 'Kerja Sama Q123456789', '2022-06-24', '2022-06-25', 3, 2, 3, '2022-04-22 13:40:37', '2022-06-28 02:37:51'),
(3, 'Kerja Sama 3', '2022-04-23', '2022-04-30', 2, 2, 4, '2022-04-22 13:45:26', '2022-04-22 13:45:26'),
(5, 'Kerja Sama Q1', '2022-06-11', '2022-06-18', 1, 1, 3, '2022-06-11 11:41:52', '2022-06-28 02:37:58'),
(6, 'Kerja Sama Q2', '2022-06-11', '2022-06-30', 3, 2, 2, '2022-06-11 11:42:32', '2022-06-11 11:42:32'),
(7, 'Kerja Sama Q12', '2022-06-28', '2022-06-29', 4, 2, 3, '2022-06-24 13:04:41', '2022-06-28 02:35:11');

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
(10, 'Vietnam University Q1', 'I', '2022-04-21 01:27:59', '2022-05-29 03:43:36'),
(15, 'UI', 'W', '2022-06-11 08:23:14', '2022-06-11 08:23:14'),
(16, 'Universitas A', 'I', '2022-06-11 11:28:37', '2022-06-11 11:28:37'),
(17, 'Universitas B', 'I', '2022-06-11 11:30:00', '2022-06-11 11:30:00'),
(18, 'Universitas C', 'I', '2022-06-11 11:30:56', '2022-06-11 11:30:56'),
(19, 'White House', 'I', '2022-06-29 02:41:08', '2022-06-29 02:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Aktif', '2022-04-22 07:48:14', '2022-04-22 07:48:14'),
(2, 'Kadaluarsa', '2022-04-22 00:48:32', '2022-04-23 02:44:51'),
(3, 'Dalam Perpanjangan', '2022-04-22 00:53:30', '2022-04-23 03:10:22'),
(4, 'Tidak Aktif', '2022-04-22 00:54:56', '2022-04-23 03:10:32');

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
(13, 'MJ', '2022-06-17 11:25:36', '2022-06-24 13:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_dosen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('A','D') CHARACTER SET utf8 NOT NULL,
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

INSERT INTO `users` (`id`, `kode_dosen`, `name`, `email`, `level`, `file`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, '000000', 'MainAccount', 'admin@gmail.com', 'A', NULL, NULL, '$2y$10$1Z/MaxYrXiOtFN5zZdu6.eeDsbt.QqEnmpgKS/WhKnrPEbCYh/qsa', NULL, '2022-05-27 01:55:39', '2022-06-26 02:14:22'),
(4, 'D00002', 'Dosen', 'dosen@gmail.com', 'D', NULL, NULL, '$2y$10$99Q3pK58iKDaPS8jsBxaM.7E895ooZLKKo0251usp2y//8xlX0p9W', NULL, '2022-05-29 02:59:11', '2022-06-26 02:07:43'),
(5, 'D00003', 'Dosen2', 'dosen2@gmail.com', 'D', NULL, NULL, '$2y$10$YqNpVetZcCe3JYiH549svO1zG73fP5oh1ZwRtUJ9M5xhmcjb5pyrG', NULL, '2022-06-17 11:32:46', '2022-06-26 02:07:53'),
(6, 'D00004', 'User123', 'user@mail.com', 'D', NULL, NULL, '$2y$10$SacrjeyyQiDsVoPIqhZwVOBETyIrGS0Dt1gt6.Y0CN/o175/Mu8wy', NULL, '2022-06-26 02:31:14', '2022-06-26 02:45:23'),
(7, 'D00005', 'User1', 'user1@mail.com', 'D', NULL, NULL, '$2y$10$D5o03G.RX0n3C/0Enfb1t.iUS..Jqh8Gc78x4HE63OjtkWqIn/fwS', NULL, '2022-06-26 02:47:09', '2022-06-26 02:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `usulans`
--

CREATE TABLE `usulans` (
  `id` int(11) NOT NULL,
  `nama_usulan` varchar(45) NOT NULL,
  `bentuk_kerjasama` text NOT NULL,
  `rencana_kegiatan` text NOT NULL,
  `tanggal_rencana_kegiatan` date NOT NULL,
  `mitra_id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usulans`
--

INSERT INTO `usulans` (`id`, `nama_usulan`, `bentuk_kerjasama`, `rencana_kegiatan`, `tanggal_rencana_kegiatan`, `mitra_id`, `dosen_id`, `unit_id`, `created_at`, `updated_at`) VALUES
(1, 'Usulan 1', 'Kerja sama 1', 'Rencana 1', '2022-04-18', 1, 1, 1, '2022-04-25 04:07:10', '2022-04-25 04:07:10'),
(2, 'Usulan 2', 'Kerja sama 2', 'Rencana 2', '2022-05-10', 2, 2, 1, '2022-04-25 04:10:11', '2022-05-10 02:14:11'),
(3, 'sgdg', 'gssg', 'sgssgg', '2022-04-14', 2, 4, 5, '2022-04-25 04:10:27', '2022-06-17 12:14:44'),
(5, 'Usulan Delapan', 'Bentuk Delapan', 'Rencana Baru', '2022-06-24', 4, 4, 4, '2022-06-24 13:37:30', '2022-06-24 13:37:30');

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
  ADD KEY `fk_kegiatans_dosens1_idx` (`dosen_id`);

--
-- Indexes for table `kerjasamas`
--
ALTER TABLE `kerjasamas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kerjasamas_mitras_idx` (`mitra_id`),
  ADD KEY `fk_kerjasamas_kategoris1_idx` (`kategori_id`),
  ADD KEY `fk_kerjasamas_status1_idx` (`status_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `usulans`
--
ALTER TABLE `usulans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usulans_mitras1_idx` (`mitra_id`),
  ADD KEY `fk_usulans_dosens1_idx` (`dosen_id`),
  ADD KEY `fk_usulans_units1_idx` (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukti_kegiatans`
--
ALTER TABLE `bukti_kegiatans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bukti_kegiatan_units`
--
ALTER TABLE `bukti_kegiatan_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bukti_kerjasamas`
--
ALTER TABLE `bukti_kerjasamas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kerjasamas`
--
ALTER TABLE `kerjasamas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mitras`
--
ALTER TABLE `mitras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usulans`
--
ALTER TABLE `usulans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bukti_kegiatans`
--
ALTER TABLE `bukti_kegiatans`
  ADD CONSTRAINT `fk_bukti_kegiatans_kegiatans1` FOREIGN KEY (`kegiatans_id`) REFERENCES `kegiatans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `bukti_kerjasamas_ibfk_1` FOREIGN KEY (`kerjasama_id`) REFERENCES `kerjasamas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD CONSTRAINT `fk_kegiatans_dosens1` FOREIGN KEY (`dosen_id`) REFERENCES `dosens` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kegiatans_kerjasamas1` FOREIGN KEY (`kerjasama_id`) REFERENCES `kerjasamas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kerjasamas`
--
ALTER TABLE `kerjasamas`
  ADD CONSTRAINT `fk_kerjasamas_kategoris1` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kerjasamas_mitras` FOREIGN KEY (`mitra_id`) REFERENCES `mitras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kerjasamas_status1` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usulans`
--
ALTER TABLE `usulans`
  ADD CONSTRAINT `fk_usulans_dosens1` FOREIGN KEY (`dosen_id`) REFERENCES `dosens` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usulans_mitras1` FOREIGN KEY (`mitra_id`) REFERENCES `mitras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usulans_units1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
