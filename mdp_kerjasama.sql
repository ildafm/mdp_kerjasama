-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2023 at 03:28 AM
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
-- Table structure for table `bentuk_kegiatans`
--

CREATE TABLE `bentuk_kegiatans` (
  `id` int(11) NOT NULL,
  `bentuk` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bentuk_kegiatans`
--

INSERT INTO `bentuk_kegiatans` (`id`, `bentuk`, `created_at`, `updated_at`) VALUES
(1, 'Pertukaran Pelajar-Kampus Merdeka', '2022-10-01 11:52:33', '2022-10-08 02:18:42'),
(2, 'Magang/Praktik Kerja-Kampus Merdeka', '2022-10-01 16:22:01', '2022-10-08 02:18:49'),
(4, 'Asistensi Mengajar di Satuan Pendidikan-Kampus Merdeka', '2022-10-08 02:10:27', '2022-10-08 02:10:27'),
(5, 'Penelitian/Riset-Kampus Merdeka', '2022-10-08 02:10:44', '2022-10-08 02:10:44'),
(6, 'Membangun Desa/KKN Tematik-Kampus Merdeka', '2022-10-08 02:11:13', '2022-10-08 02:11:13'),
(7, 'Studi/Proyek Independen-Kampus Merdeka', '2022-10-08 02:11:30', '2022-10-08 02:11:30'),
(8, 'Kegiatan Wirausaha-Kampus Merdeka', '2022-10-08 02:11:41', '2022-10-08 02:11:41'),
(9, 'Proyek Kemanusiaan-Kampus Merdeka', '2022-10-08 02:12:09', '2022-10-08 02:12:09'),
(10, 'Gelar Bersama (Joint Degree)', '2022-10-08 02:12:27', '2022-10-08 02:12:27'),
(11, 'Gelar Ganda (Dual Degree)', '2022-10-08 02:12:38', '2022-10-08 02:12:38'),
(12, 'Pertukaran Mahasiswa', '2022-10-08 02:12:47', '2022-10-08 02:12:47'),
(13, 'Penerbit Berkala Ilmiah', '2022-10-08 02:12:57', '2022-10-08 02:12:57'),
(14, 'Pemagangan', '2022-10-08 02:13:07', '2022-10-08 02:13:07'),
(15, 'Penyelenggaraan Seminar/Konferensi Ilmiah', '2022-10-08 02:13:30', '2022-10-08 02:13:30'),
(16, 'Penelitian Bersama', '2022-10-08 02:13:42', '2022-10-08 02:13:42'),
(17, 'Pengabdian Kepada Masyarakat', '2022-10-08 02:15:28', '2022-10-08 02:15:28'),
(18, 'Pertukaran Dosen', '2022-10-08 02:15:39', '2022-10-08 02:15:39'),
(19, 'Penelitian Bersama - Paten', '2022-10-08 02:15:57', '2022-10-08 02:15:57'),
(20, 'Penelitian Bersama - Prototipe', '2022-10-08 02:16:08', '2022-10-08 02:16:08'),
(21, 'Penelitian Bersama - Artikel/Jurnal Ilmiah', '2022-10-08 02:16:28', '2022-10-08 02:16:28'),
(22, 'Pengembangan Kurikulum/Program Bersama', '2022-10-08 02:16:41', '2022-10-08 02:16:41'),
(23, 'Penyaluran Lulusan', '2022-10-08 02:17:04', '2022-10-08 02:17:04'),
(24, 'Pengiriman Praktisi sebagai Dosen', '2022-10-08 02:17:19', '2022-10-08 02:17:19'),
(25, 'Pelatihan Dosen dan Instruktur', '2022-10-08 02:17:33', '2022-10-08 02:17:33'),
(26, 'Transfer Kredit', '2022-10-08 02:17:42', '2022-10-08 02:17:42'),
(27, 'Visiting Professor', '2022-10-08 02:17:51', '2022-10-08 02:17:51'),
(28, 'Pengembangan Pusat Penelitian dan Pengembangan Keilmuan', '2022-10-08 02:18:12', '2022-10-08 02:18:12'),
(29, 'Pengembangan Sistem / Produk', '2022-10-08 02:18:28', '2022-10-08 02:18:28');

-- --------------------------------------------------------

--
-- Table structure for table `bukti_kegiatans`
--

CREATE TABLE `bukti_kegiatans` (
  `id` int(11) NOT NULL,
  `nama_bukti_kegiatan` varchar(100) NOT NULL,
  `file` varchar(255) NOT NULL,
  `kegiatans_id` int(11) NOT NULL,
  `bidang` char(1) NOT NULL DEFAULT 'P',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `bukti_kerjasamas`
--

CREATE TABLE `bukti_kerjasamas` (
  `id` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `nomor_file` varchar(300) DEFAULT NULL,
  `jenis_file` char(1) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `kerjasama_id` int(11) NOT NULL,
  `kategori_mou_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(2, 'Tanpa MoU', '2022-04-22 13:07:35', '2022-07-22 03:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_mous`
--

CREATE TABLE `kategori_mous` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori_mous`
--

INSERT INTO `kategori_mous` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Sekolah', '2022-12-27 06:48:16', '2022-12-27 06:52:08'),
(2, 'Perguruan Tinggi', '2022-12-27 06:53:32', '2022-12-27 06:53:32'),
(3, 'Perusahaan', '2022-12-27 06:53:38', '2022-12-27 06:53:38'),
(4, 'Pemerintahan', '2022-12-27 06:53:49', '2022-12-27 06:53:49');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatans`
--

CREATE TABLE `kegiatans` (
  `id` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_sampai` date NOT NULL,
  `bentuk_kegiatan_id` int(11) NOT NULL,
  `PIC` enum('F','P') DEFAULT NULL,
  `keterangan` text NOT NULL,
  `kerjasama_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bukti_kerjasama_spk_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kerjasamas`
--

CREATE TABLE `kerjasamas` (
  `id` int(11) NOT NULL,
  `nama_kerja_sama` varchar(100) NOT NULL,
  `bidang` varchar(1) NOT NULL DEFAULT 'P',
  `tanggal_mulai` date NOT NULL,
  `tanggal_sampai` date NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `usulan_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi_mitras`
--

CREATE TABLE `klasifikasi_mitras` (
  `id` int(11) NOT NULL,
  `klasifikasi_mitra` varchar(400) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `klasifikasi_mitras`
--

INSERT INTO `klasifikasi_mitras` (`id`, `klasifikasi_mitra`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Perusahaan multinasional', 'Perusahaan yang beroperasi di lebih dari 1 (satu) negara', '2022-10-04 10:32:33', '2022-10-08 01:50:59'),
(2, 'Perusahaan nasional berstandar tinggi', 'Perusahaan nasional yang sudah menjadi perusahaan publik (terbuka/Tbk) atau perusahaan dengan pendapatan setahun terakhir sejumlah lebih dari Rp100.000.000.000 (seratus miliar rupiah))', '2022-10-04 10:33:36', '2022-10-08 01:52:37'),
(4, 'Perusahaan teknologi global', 'Perusahaan yang tercakup sebagai perusahaan teknologi global adalah yang terdaftar di Forbes Top 100 Digital Companies', '2022-10-08 01:49:28', '2022-10-08 01:53:54'),
(5, 'Perusahaan rintisan (startup company) teknologi', '1 Perusahaan startop teknologi dalam negeri maupun luar negeri', '2022-10-08 01:54:52', '2022-10-08 01:54:52'),
(6, 'Organisasi nirlaba kelas dunia', 'Organisasi nirlaba dalam negeri maupun luar negeri, harus mempunyai anggaran tahunan setahun terakhir sejumlah lebih dari Rp 50.000.000.000 (lima puluh milyar rupiah) atau sudah bekerja sama dengan mitra di tingkat nasional maupun internasional selama 5 tahun terakhir', '2022-10-08 01:58:53', '2022-10-08 01:58:53'),
(7, 'Institusi/Organisasi multilateral', 'Institusi atau organisasi multilateral yang diakui Pemerintah Indonesia', '2022-10-08 01:59:39', '2022-10-08 01:59:39'),
(8, 'Perguruan tinggi yang masuk dalam daftar QS100 berdasarkan ilmu', 'Program studi bekerja sama dengan perguruan tinggi yang termasuk dalam daftar QS100 berdasarkan ilmu', '2022-10-08 02:00:28', '2022-10-08 02:00:28'),
(9, 'Instansi pemerintah, BUMN dan/atau BUMD', 'Kementrian atau kelembagaan Pemerintah Indonesia, Bada Usaha Milik Negara dan Badan Usaha Milik Daerah', '2022-10-08 02:01:24', '2022-10-08 02:01:24'),
(10, 'Rumah Sakit', 'Rumah sakit yaung memiliki Izin Rimah Sakit Kelas A dan B yang diberikan oleh Kementrian Kesehatan', '2022-10-08 02:02:07', '2022-10-08 02:02:07'),
(11, 'UMKM', 'UMKM harus mempunyai pendapatan setahun terakhir sejumlah lebih dari RP 30.000.000.000 (tiga puluh milyar rupiah)', '2022-10-08 02:02:54', '2022-10-08 02:02:54'),
(12, 'Dunia Usaha', NULL, '2022-10-08 02:05:09', '2022-10-08 02:05:09'),
(13, 'Institusi Pendidikan', NULL, '2022-10-08 02:05:37', '2022-10-08 02:05:49'),
(14, 'Organisasi', NULL, '2022-10-08 02:06:23', '2022-10-08 02:06:23');

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
  `klasifikasi_id` int(11) NOT NULL,
  `negara_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `negaras`
--

CREATE TABLE `negaras` (
  `id` int(11) NOT NULL,
  `nama_negara` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `negaras`
--

INSERT INTO `negaras` (`id`, `nama_negara`, `created_at`, `updated_at`) VALUES
(1, 'Indonesia', '2022-10-03 12:28:38', '2022-10-04 10:54:48'),
(2, 'Malaysia', '2022-10-03 12:34:19', '2022-10-03 12:34:19'),
(3, 'Vietnam', '2022-10-03 12:34:29', '2022-10-03 12:34:29'),
(5, 'Singapura', '2022-10-11 03:07:26', '2022-11-30 05:13:36'),
(6, 'Filipina', '2022-11-30 05:13:45', '2022-11-30 05:13:45'),
(7, 'Thailand', '2022-11-30 05:13:53', '2022-11-30 05:13:53'),
(8, 'Brunei Darussalam', '2022-11-30 05:14:03', '2022-11-30 05:14:03'),
(9, 'Laos', '2022-11-30 05:14:08', '2022-11-30 05:14:08'),
(10, 'Myanmar', '2022-11-30 05:14:16', '2022-11-30 05:14:16'),
(11, 'Kamboja', '2022-11-30 05:14:21', '2022-11-30 05:14:21');

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
(1, 'D00010', 'Admin Main', 'usermain026@gmail.com', 'A', 1, NULL, NULL, '$2y$10$bVXvjcHDUEXrrjWxiCSyS.j5RghhXCaumereKrBNW6g9Z6O.yQ1Pu', NULL, '2022-08-03 15:36:10', '2023-01-12 02:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `usulans`
--

CREATE TABLE `usulans` (
  `id` int(11) NOT NULL,
  `usulan` varchar(45) NOT NULL,
  `bentuk_kerjasama` text NOT NULL,
  `rencana_kegiatan` text NOT NULL,
  `kontak_kerjasama` varchar(15) DEFAULT NULL,
  `type` char(1) NOT NULL,
  `mitra_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `hasil_penjajakan` char(1) DEFAULT 'B',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bentuk_kegiatans`
--
ALTER TABLE `bentuk_kegiatans`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `kerjasama_id` (`kerjasama_id`),
  ADD KEY `fk_kategori_mous_1` (`kategori_mou_id`);

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
-- Indexes for table `kategori_mous`
--
ALTER TABLE `kategori_mous`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kegiatans_kerjasamas1_idx` (`kerjasama_id`),
  ADD KEY `fk_kegiatans_dosens1_idx` (`user_id`),
  ADD KEY `fk_bentuk_kegiatans1` (`bentuk_kegiatan_id`),
  ADD KEY `fk_spk_id` (`bukti_kerjasama_spk_id`);

--
-- Indexes for table `kerjasamas`
--
ALTER TABLE `kerjasamas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kerjasamas_kategoris1_idx` (`kategori_id`),
  ADD KEY `fk_kerjasamas_status1_idx` (`status_id`),
  ADD KEY `fk_kerjasamas_usulan1` (`usulan_id`);

--
-- Indexes for table `klasifikasi_mitras`
--
ALTER TABLE `klasifikasi_mitras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitras`
--
ALTER TABLE `mitras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_klasifikasi` (`klasifikasi_id`),
  ADD KEY `fk_negara` (`negara_id`);

--
-- Indexes for table `negaras`
--
ALTER TABLE `negaras`
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
-- AUTO_INCREMENT for table `bentuk_kegiatans`
--
ALTER TABLE `bentuk_kegiatans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `bukti_kegiatans`
--
ALTER TABLE `bukti_kegiatans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bukti_kegiatan_units`
--
ALTER TABLE `bukti_kegiatan_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bukti_kerjasamas`
--
ALTER TABLE `bukti_kerjasamas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori_mous`
--
ALTER TABLE `kategori_mous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kegiatans`
--
ALTER TABLE `kegiatans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kerjasamas`
--
ALTER TABLE `kerjasamas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `klasifikasi_mitras`
--
ALTER TABLE `klasifikasi_mitras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mitras`
--
ALTER TABLE `mitras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `negaras`
--
ALTER TABLE `negaras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usulans`
--
ALTER TABLE `usulans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `bukti_kerjasamas_ibfk_1` FOREIGN KEY (`kerjasama_id`) REFERENCES `kerjasamas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kategori_mous_1` FOREIGN KEY (`kategori_mou_id`) REFERENCES `kategori_mous` (`id`);

--
-- Constraints for table `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD CONSTRAINT `fk_bentuk_kegiatans1` FOREIGN KEY (`bentuk_kegiatan_id`) REFERENCES `bentuk_kegiatans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kegiatans_kerjasamas1` FOREIGN KEY (`kerjasama_id`) REFERENCES `kerjasamas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kegiatans_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_spk_id` FOREIGN KEY (`bukti_kerjasama_spk_id`) REFERENCES `bukti_kerjasamas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kerjasamas`
--
ALTER TABLE `kerjasamas`
  ADD CONSTRAINT `fk_kerjasamas_kategoris1` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kerjasamas_status1` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_kerjasamas_usulan1` FOREIGN KEY (`usulan_id`) REFERENCES `usulans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mitras`
--
ALTER TABLE `mitras`
  ADD CONSTRAINT `fk_klasifikasi` FOREIGN KEY (`klasifikasi_id`) REFERENCES `klasifikasi_mitras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_negara` FOREIGN KEY (`negara_id`) REFERENCES `negaras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
CREATE DEFINER=`root`@`localhost` EVENT `auto_update_status_kerjasama` ON SCHEDULE EVERY 1 MINUTE STARTS '2022-07-31 11:08:07' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE kerjasamas
SET status_id = 2
WHERE tanggal_sampai < NOW() AND status_id = 1$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
