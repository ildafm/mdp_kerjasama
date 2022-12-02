-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2022 at 02:11 PM
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
  `ceklist_apt` enum('Y','T') NOT NULL DEFAULT 'T',
  `ceklist_aps` enum('Y','T') NOT NULL DEFAULT 'T',
  `ceklist_lamemba` enum('Y','T') NOT NULL DEFAULT 'T',
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
  `jenis_file` char(1) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `kerjasama_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bukti_kerjasamas`
--

INSERT INTO `bukti_kerjasamas` (`id`, `nama_file`, `jenis_file`, `file`, `kerjasama_id`, `created_at`, `updated_at`) VALUES
(66, 'input file lain-lain', 'B', 'file-1669786081.png', 54, '2022-11-30 05:28:02', '2022-11-30 05:28:02'),
(68, 'Input MoU', 'M', 'file-1669786125.png', 54, '2022-11-30 05:28:45', '2022-11-30 05:28:45'),
(69, 'SPK/MoA', 'S', 'file-1669786194.png', 54, '2022-11-30 05:29:54', '2022-11-30 05:29:54'),
(71, 'SPK/MoA 2', 'S', 'file-1669787685.PNG', 54, '2022-11-30 05:54:45', '2022-12-02 12:22:40'),
(72, 'MoU', 'M', 'file-1669787779.png', 56, '2022-11-30 05:56:19', '2022-11-30 05:56:19');

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
(2, 'Tanpa MoU', '2022-04-22 13:07:35', '2022-07-22 03:09:36');

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
  `bukti_kerjasama_spk_id` int(11) DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kegiatans`
--

INSERT INTO `kegiatans` (`id`, `tanggal_mulai`, `tanggal_sampai`, `bentuk_kegiatan_id`, `PIC`, `keterangan`, `kerjasama_id`, `user_id`, `bukti_kerjasama_spk_id`, `status`, `created_at`, `updated_at`) VALUES
(129, '2022-12-05', '2022-12-09', 27, NULL, 'Visiting Professor', 54, 29, 71, '0', '2022-12-02 12:29:12', '2022-12-02 12:29:39');

-- --------------------------------------------------------

--
-- Table structure for table `kerjasamas`
--

CREATE TABLE `kerjasamas` (
  `id` int(11) NOT NULL,
  `nama_kerja_sama` varchar(100) NOT NULL,
  `no_mou` varchar(255) NOT NULL,
  `bidang` varchar(1) NOT NULL DEFAULT 'P',
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

INSERT INTO `kerjasamas` (`id`, `nama_kerja_sama`, `no_mou`, `bidang`, `tanggal_mulai`, `tanggal_sampai`, `kategori_id`, `status_id`, `usulan_id`, `created_at`, `updated_at`) VALUES
(54, 'Kerjasama Informatika bersama dengan Malaysia', 'MoU00001', 'A', '2022-11-30', '2023-11-30', 1, 1, 51, '2022-11-30 05:26:25', '2022-11-30 05:26:25'),
(55, 'Kerjasama 1', '', 'P', '2022-11-30', '2022-12-01', 2, 2, 53, '2022-11-30 05:47:45', '2022-12-01 02:58:23'),
(56, 'Usulan Informatika', 'MoU0003', 'P', '2022-11-30', '2022-12-14', 1, 1, 53, '2022-11-30 05:55:48', '2022-11-30 05:55:48');

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

--
-- Dumping data for table `mitras`
--

INSERT INTO `mitras` (`id`, `nama_mitra`, `tingkat`, `klasifikasi_id`, `negara_id`, `created_at`, `updated_at`) VALUES
(1, 'Universitas Indonesia', 'I', 2, 1, '2022-04-21 08:19:25', '2022-10-04 11:57:27'),
(2, 'Universitas Palembang', 'N', 1, 1, '2022-04-21 08:19:25', '2022-04-24 08:00:33'),
(3, 'Universitas Indonesia Sejahtera', 'N', 1, 1, '2022-04-21 08:19:25', '2022-04-24 07:26:30'),
(4, 'Halaman Berkah', 'W', 1, 1, '2022-04-21 08:19:25', '2022-04-24 07:26:57'),
(10, 'Vietnam University', 'I', 2, 3, '2022-04-21 01:27:59', '2022-10-04 11:56:40'),
(15, 'UI', 'W', 1, 1, '2022-06-11 08:23:14', '2022-06-11 08:23:14'),
(16, 'Universitas Malaysia', 'I', 2, 2, '2022-06-11 11:28:37', '2022-10-06 01:51:25'),
(17, 'Universitas A (Malaysia)', 'I', 12, 2, '2022-06-11 11:30:00', '2022-10-09 23:52:52'),
(18, 'Universitas B (Malaysia)', 'I', 13, 2, '2022-06-11 11:30:56', '2022-10-09 23:53:25'),
(19, 'Mitra A (Vietnam)', 'I', 4, 3, '2022-06-29 02:41:08', '2022-10-09 23:55:21'),
(20, 'Universitas F', 'W', 4, 2, '2022-07-12 18:49:40', '2022-11-15 22:47:20'),
(21, 'Universitas E', 'N', 1, 1, '2022-07-24 18:55:48', '2022-07-24 18:55:48'),
(22, 'Mitra Baru', 'I', 2, 2, '2022-10-04 11:47:51', '2022-10-04 11:47:51'),
(23, 'Mitra B (Indonesia)', 'N', 5, 1, '2022-10-09 23:54:18', '2022-10-09 23:54:18'),
(24, 'Mitra C (Vietnam)', 'I', 2, 3, '2022-10-09 23:56:33', '2022-10-09 23:56:33'),
(25, 'Mitra D (Malaysia)', 'I', 13, 2, '2022-10-09 23:58:58', '2022-10-09 23:58:58'),
(26, 'Mitra E (Singapura)', 'I', 8, 5, '2022-10-11 03:08:49', '2022-11-30 05:15:39');

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
(13, 'D00010', 'Admin User Main', 'usermain026@gmail.com', 'A', 1, NULL, NULL, '$2y$10$r9Xdrro1cYQqOvFK/2ps7udBtwc6KNX0ZHUGxCusDY2u3Y.vygJvi', NULL, '2022-08-03 15:36:10', '2022-09-01 08:55:01'),
(15, 'D00012', 'Dosen Main Account', 'dosenmain026@gmail.com', 'D', 4, NULL, NULL, '$2y$10$GJbR9Jc6fC/ALpucdQbNTekuxNHTcKJrP9dlyXlTirRO6g4Y8KNT.', NULL, '2022-08-19 03:30:18', '2022-09-08 15:14:44'),
(25, 'D00001', 'Dekan', 'ildafm4000@mhs.mdp.ac.id', 'E', 2, NULL, NULL, '$2y$10$n64JdaD5zFH3WDTU8FCwT.71Y0Zqb4EhsCBP1I30tNqd76oRtjudO', NULL, '2022-08-23 01:31:05', '2022-11-20 23:08:26'),
(26, 'D00002', 'Kaprodi', 'ildafm4000@gmail.com', 'K', 4, 'file-D00002-Kaprodi.png', NULL, '$2y$10$CEvTnO9sHV40u7w4ubsG.O56iLyB8qHP/iWIjSuEmjMVXNmkqBuky', NULL, '2022-08-23 01:39:05', '2022-11-30 05:52:47'),
(28, 'D00003', 'Ka Unit', 'ildafm502@gmail.com', 'U', 17, NULL, NULL, '$2y$10$De7e5Tl4lFguYQb7jkHt1OaQdEx.hjtjrzFDN7JKVBf/qB6M2eRem', NULL, '2022-08-30 22:18:21', '2022-11-20 23:08:47'),
(29, 'D00013', 'User Baru', 'ildafm4000@premiumpedia.net', 'D', 5, NULL, NULL, '$2y$10$c6BCT/J5Zly/rUhrVsOOT.wdx0yVc.SxlId9zVeqpsjZxzeuPqixC', NULL, '2022-09-22 00:00:26', '2022-09-22 00:00:26');

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
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usulans`
--

INSERT INTO `usulans` (`id`, `usulan`, `bentuk_kerjasama`, `rencana_kegiatan`, `kontak_kerjasama`, `type`, `mitra_id`, `user_id`, `unit_id`, `hasil_penjajakan`, `keterangan`, `created_at`, `updated_at`) VALUES
(51, 'Informatika', 'FIKR', 'Kerjasama bersama malaysia', '0771-000001', 'I', 17, 26, 4, 'L', 'Kesepakatan disetujui', '2022-11-30 05:19:44', '2022-11-30 05:21:45'),
(52, 'Sistem Informasi', 'Kerjasama FIKR', 'Kerjasama bersama Vietnam', '091132877810', 'O', 19, 15, 5, 'T', 'Kesepakatan tidak disetujui karena .......................', '2022-11-30 05:23:34', '2022-11-30 05:24:41'),
(53, 'Teknik Elektro', 'FIKR', 'Kerjasama bersama Singapura', '07111-555555', 'I', 26, 25, 6, 'L', 'Hasil kesepakatan disetujui', '2022-11-30 05:46:39', '2022-11-30 05:47:03');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `bukti_kegiatan_units`
--
ALTER TABLE `bukti_kegiatan_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `bukti_kerjasamas`
--
ALTER TABLE `bukti_kerjasamas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `kerjasamas`
--
ALTER TABLE `kerjasamas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `klasifikasi_mitras`
--
ALTER TABLE `klasifikasi_mitras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mitras`
--
ALTER TABLE `mitras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `usulans`
--
ALTER TABLE `usulans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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
