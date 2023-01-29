-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2023 at 12:39 AM
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
  `bentuk` text DEFAULT NULL,
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
  `nama_bukti_kegiatan` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `kegiatans_id` int(11) NOT NULL,
  `bidang` char(1) NOT NULL DEFAULT 'P',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bukti_kegiatans`
--

INSERT INTO `bukti_kegiatans` (`id`, `nama_bukti_kegiatan`, `file`, `kegiatans_id`, `bidang`, `created_at`, `updated_at`) VALUES
(1, 'Laporan kegiatan seminar HIMIF', 'file-1674457811.png', 4, 'P', '2023-01-23 07:10:11', '2023-01-23 07:10:11'),
(2, 'Pertukaran mahasiswa di STMIK PGRI Tanggerang', 'file-1674601495.png', 2, 'P', '2023-01-24 23:04:55', '2023-01-24 23:04:55');

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
(1, 4, 1, '2023-01-23 07:10:11', '2023-01-23 07:10:11'),
(2, 5, 2, '2023-01-24 23:04:55', '2023-01-24 23:04:55');

-- --------------------------------------------------------

--
-- Table structure for table `bukti_kerjasamas`
--

CREATE TABLE `bukti_kerjasamas` (
  `id` int(11) NOT NULL,
  `nama_file` text NOT NULL,
  `nomor_file` varchar(300) DEFAULT NULL,
  `jenis_file` char(1) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `kerjasama_id` int(11) NOT NULL,
  `kategori_mou_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bukti_kerjasamas`
--

INSERT INTO `bukti_kerjasamas` (`id`, `nama_file`, `nomor_file`, `jenis_file`, `file`, `kerjasama_id`, `kategori_mou_id`, `created_at`, `updated_at`) VALUES
(1, 'SPK pertukaran mahasiswa Informatika selama 6 bulan dengan Vietnam National University Hanoi', '001/UMDP/SPK/II/2023', 'S', 'file-1674456201.pdf', 1, NULL, '2023-01-23 06:43:22', '2023-01-23 06:43:41'),
(2, 'MoU Vietnam National University Hanoi', '001/UMDP/MOU/II/2023', 'M', 'file-1674456263.pdf', 1, 2, '2023-01-23 06:44:23', '2023-01-23 06:44:23'),
(3, 'SPK kerjasama Pertukaran mahasiswa di STMIK PGRI Tanggerang', '002/UMDP/SPK/II/2023', 'S', 'file-1674456535.pdf', 2, NULL, '2023-01-23 06:48:55', '2023-01-23 06:48:55'),
(4, 'File MoU Pertukaran dosen dengan Universiti Malaya', '002/UMDP/MOU/II/2023', 'M', 'file-1674456904.pdf', 3, 2, '2023-01-23 06:55:04', '2023-01-23 06:55:04'),
(5, 'SPK Pertukaran dosen dengan Universiti Malaya', '003/UMDP/SPK/II/2023', 'S', 'file-1674456940.pdf', 3, NULL, '2023-01-23 06:55:40', '2023-01-23 06:55:40'),
(6, 'SPK Seminar dengan HIMIF', '004/UMDP/SPK/II/2023', 'S', 'file-1674457331.pdf', 4, NULL, '2023-01-23 07:02:11', '2023-01-23 07:02:11'),
(7, 'MoU Program magang di Gojek', '003/UMDP/MOU/II/2023', 'M', 'file-1674601860.pdf', 5, 3, '2023-01-24 23:11:00', '2023-01-24 23:11:00'),
(9, 'Acara kegiatan seminar HIMSI', '001/UMDP/SPK/II/2022', 'S', 'file-1674602288.png', 6, NULL, '2023-01-24 23:18:08', '2023-01-24 23:37:33');

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

--
-- Dumping data for table `kegiatans`
--

INSERT INTO `kegiatans` (`id`, `tanggal_mulai`, `tanggal_sampai`, `bentuk_kegiatan_id`, `PIC`, `keterangan`, `kerjasama_id`, `user_id`, `bukti_kerjasama_spk_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '2023-02-01', '2023-07-29', 12, NULL, 'Kegiatan ini akan dimulai sejak tanggal 01 Febuari 2023 hingga 29 Juli 2023', 1, 8, 1, '1', '2023-01-23 06:46:17', '2023-01-24 23:07:55'),
(2, '2023-01-30', '2023-03-04', 12, NULL, 'kegiatan pertukaran mahasiswa di STMIK PGRI Tanggerang berlangsung selama kurang lebih 2 bulan', 2, 5, 3, '1', '2023-01-23 06:50:21', '2023-01-24 23:03:50'),
(3, '2023-01-30', '2023-05-27', 18, NULL, 'Pertukaran dosen dengan Universiti Malaya akan dimulai pada tanggal 30 Januari 2023 dan berakhir pada tanggal 27 Meu 2023', 3, 3, 5, '1', '2023-01-23 06:56:47', '2023-01-24 23:08:41'),
(4, '2023-01-23', '2023-01-24', 15, NULL, 'Kegiatan seminar yang berlangsung selama 1 hari dengan HIMIF', 4, 4, 6, '1', '2023-01-23 07:03:23', '2023-01-23 07:06:58'),
(5, '2022-11-01', '2022-11-02', 15, NULL, 'Kegiatan seminar yang berlangsung selama 1 hari dengan HIMSI', 6, 5, 9, '1', '2023-01-24 23:19:25', '2023-01-24 23:20:53');

-- --------------------------------------------------------

--
-- Table structure for table `kerjasamas`
--

CREATE TABLE `kerjasamas` (
  `id` int(11) NOT NULL,
  `nama_kerja_sama` text NOT NULL,
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

INSERT INTO `kerjasamas` (`id`, `nama_kerja_sama`, `bidang`, `tanggal_mulai`, `tanggal_sampai`, `kategori_id`, `status_id`, `usulan_id`, `created_at`, `updated_at`) VALUES
(1, 'Kerjasama pertukaran mahasiswa Informatika selama 6 bulan dengan Vietnam National University Hanoi', 'P', '2023-02-01', '2023-07-29', 1, 1, 1, '2023-01-23 06:41:09', '2023-01-23 06:41:09'),
(2, 'Pertukaran mahasiswa di STMIK PGRI Tanggerang', 'P', '2023-01-30', '2023-03-04', 2, 1, 3, '2023-01-23 06:48:06', '2023-01-23 06:48:06'),
(3, 'Pertukaran dosen dengan Universiti Malaya', 'P', '2023-01-30', '2023-05-27', 1, 1, 4, '2023-01-23 06:54:12', '2023-01-23 06:54:12'),
(4, 'Acara kegiatan seminar', 'P', '2023-01-23', '2023-01-24', 2, 2, 6, '2023-01-23 07:01:24', '2023-01-23 23:40:09'),
(5, 'Program magang di Gojek', 'P', '2022-12-01', '2022-12-31', 1, 2, 8, '2023-01-24 23:09:33', '2023-01-24 23:09:33'),
(6, 'Acara kegiatan seminar', 'P', '2022-11-01', '2022-11-02', 2, 3, 9, '2023-01-24 23:17:07', '2023-01-24 23:18:28');

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
(5, 'Perusahaan rintisan (startup company) teknologi', '1 Perusahaan startup teknologi dalam negeri maupun luar negeri', '2022-10-08 01:54:52', '2023-01-23 03:34:08'),
(6, 'Organisasi nirlaba kelas dunia', 'Organisasi nirlaba dalam negeri maupun luar negeri, harus mempunyai anggaran tahunan setahun terakhir sejumlah lebih dari Rp 50.000.000.000 (lima puluh milyar rupiah) atau sudah bekerja sama dengan mitra di tingkat nasional maupun internasional selama 5 tahun terakhir', '2022-10-08 01:58:53', '2022-10-08 01:58:53'),
(7, 'Institusi/Organisasi multilateral', 'Institusi atau organisasi multilateral yang diakui Pemerintah Indonesia', '2022-10-08 01:59:39', '2022-10-08 01:59:39'),
(8, 'Perguruan tinggi yang masuk dalam daftar QS100 berdasarkan ilmu', 'Program studi bekerja sama dengan perguruan tinggi yang termasuk dalam daftar QS100 berdasarkan ilmu', '2022-10-08 02:00:28', '2022-10-08 02:00:28'),
(9, 'Instansi pemerintah, BUMN dan/atau BUMD', 'Kementrian atau kelembagaan Pemerintah Indonesia, Bada Usaha Milik Negara dan Badan Usaha Milik Daerah', '2022-10-08 02:01:24', '2022-10-08 02:01:24'),
(10, 'Rumah Sakit', 'Rumah sakit yaung memiliki Izin Rimah Sakit Kelas A dan B yang diberikan oleh Kementrian Kesehatan', '2022-10-08 02:02:07', '2022-10-08 02:02:07'),
(11, 'UMKM', 'UMKM harus mempunyai pendapatan setahun terakhir sejumlah lebih dari RP 30.000.000.000 (tiga puluh milyar rupiah)', '2022-10-08 02:02:54', '2022-10-08 02:02:54'),
(12, 'Dunia Usaha', NULL, '2022-10-08 02:05:09', '2022-10-08 02:05:09'),
(13, 'Institusi Pendidikan', NULL, '2022-10-08 02:05:37', '2022-10-08 02:05:49'),
(14, 'Organisasi', NULL, '2022-10-08 02:06:23', '2022-10-08 02:06:23'),
(15, 'Organisasi Internal', NULL, '2023-01-23 03:43:41', '2023-01-23 03:43:41');

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
  `nama_mitra` text NOT NULL,
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
(1, 'PT Prima Karya Sasaran Sejahtera', 'W', 2, 1, '2023-01-23 03:25:04', '2023-01-23 03:43:13'),
(2, 'PT Anugerah Karya Prima', 'W', 2, 1, '2023-01-23 03:25:14', '2023-01-23 03:45:41'),
(3, 'STMIK PGRI Tanggerang', 'N', 8, 1, '2023-01-23 03:25:28', '2023-01-23 03:46:25'),
(4, 'Universitas Widya Dharma Pontianak', 'N', 8, 1, '2023-01-23 03:47:06', '2023-01-23 03:47:06'),
(5, 'Yayasan Iman dan Kasih (IPEKA)', 'W', 13, 1, '2023-01-23 03:47:50', '2023-01-23 03:47:50'),
(6, 'HIMIF', 'W', 15, 1, '2023-01-23 03:49:40', '2023-01-23 03:49:40'),
(7, 'HIMSI', 'W', 15, 1, '2023-01-23 03:49:51', '2023-01-23 03:49:51'),
(8, 'Universiti Malaya', 'N', 13, 2, '2023-01-23 03:51:30', '2023-01-23 03:51:30'),
(9, 'Universiti Putra Malaysia', 'N', 13, 2, '2023-01-23 03:51:55', '2023-01-23 03:51:55'),
(10, 'Universiti Kebangsaan Malaysia', 'N', 13, 2, '2023-01-23 03:52:23', '2023-01-23 03:52:23'),
(11, 'Vietnam National University Hanoi', 'N', 13, 3, '2023-01-23 03:53:14', '2023-01-23 03:53:14'),
(12, 'Hanoi University of Science and Technology', 'I', 13, 3, '2023-01-23 03:54:19', '2023-01-23 03:54:19'),
(13, 'Semen Indonesia', 'I', 1, 1, '2023-01-23 03:55:32', '2023-01-23 03:55:32'),
(14, 'Gojek', 'I', 5, 1, '2023-01-23 03:56:22', '2023-01-23 03:56:22');

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
  `nama_unit` varchar(200) NOT NULL,
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
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'D00010', 'Akun Admin', 'usermain026@gmail.com', 'A', 1, NULL, NULL, '$2y$10$bVXvjcHDUEXrrjWxiCSyS.j5RghhXCaumereKrBNW6g9Z6O.yQ1Pu', NULL, '2022-08-03 15:36:10', '2023-01-23 04:11:37'),
(2, 'D00001', 'Akun Dekan FIKR', 'ildafm502@gmail.com', 'E', 2, NULL, NULL, '$2y$10$F7XeMdB15JrWM2Rykrv3mOZi2F61Jel8gIpuqhN2ME4GPYgQkSJLi', NULL, '2023-01-23 03:35:37', '2023-01-23 04:05:58'),
(3, 'D00002', 'Akun Kaprodi IF', 'ildafm4000@gmail.com', 'K', 4, NULL, NULL, '$2y$10$/Be0M0MlR4kvhGiT.heKa.joJmUqDVK4Nv22XIOl9bgfQ59/ylFxW', NULL, '2023-01-23 03:36:08', '2023-01-23 03:36:08'),
(4, 'D00050', 'Akun  Dosen IF', 'dosenmain026@gmail.com', 'D', 4, NULL, NULL, '$2y$10$YIgT8JKYZSA7yHOAD/OH0OXab4KI57fU4OR71qQlZF97/2Sjr.qGW', NULL, '2023-01-23 03:59:29', '2023-01-23 03:59:29'),
(5, 'D00051', 'Akun Dosen SI', 'dosenmain027@gmail.com', 'D', 5, NULL, NULL, '$2y$10$NcRxTZAs71zsf0Pm82BiiuKk.qI4XA8U0VElIfeBAk90g3ZmgaFsa', NULL, '2023-01-23 04:00:03', '2023-01-24 23:02:08'),
(6, 'D00020', 'KA UPT SI', 'firstyou587@gmail.com', 'U', 17, NULL, NULL, '$2y$10$lHp0MXBid1RVlOWTcPnhp.UFFwxznXeRByZNU0ahgaNKNc.TVgf2q', NULL, '2023-01-23 04:05:24', '2023-01-23 04:05:24'),
(7, 'D00011', 'Dekan FEB', 'fieryinferno667@gmail.com', 'E', 3, NULL, NULL, '$2y$10$rxJwtwhwJ1FYcg09/k7TIuz3s6dWhbHhIx3cBfwRwGYDTx/Zf7gz2', NULL, '2023-01-23 04:07:04', '2023-01-23 04:07:04'),
(8, 'D00053', 'Dosen AK', 'vanderlinde2002@gmail.com', 'D', 8, NULL, NULL, '$2y$10$/2oHDDeq9VZvYYI4WPUiS.kcOBDL2B2MfMgo0l6xkZADSExWe/ifq', NULL, '2023-01-23 04:07:38', '2023-01-23 04:07:38'),
(10, 'D00023', 'Kaprodi AK', 'algernoon69@gmail.com', 'K', 8, NULL, NULL, '$2y$10$biVwD9csYwusM0zJm2ZSD.Nq87lpiQfHsdCpVIOlpm7aStqubRtbW', NULL, '2023-01-23 04:09:18', '2023-01-23 04:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `usulans`
--

CREATE TABLE `usulans` (
  `id` int(11) NOT NULL,
  `usulan` text NOT NULL,
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
-- Dumping data for table `usulans`
--

INSERT INTO `usulans` (`id`, `usulan`, `bentuk_kerjasama`, `rencana_kegiatan`, `kontak_kerjasama`, `type`, `mitra_id`, `user_id`, `unit_id`, `hasil_penjajakan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Memulai kerjasama pada tahun 2023', 'Pendidikan', 'Pertukaran mahasiswa prodi informatika selama 6 bulan', '(0813) 000001', 'I', 11, 2, 4, 'L', 'Kesepakatan Disetujui', '2023-01-23 03:57:39', '2023-01-23 06:38:24'),
(2, 'Kerjasama dengan PT Prima Karya Sasaran Sejahtera', 'Program Magang', 'Mengirim beberapa peserta magang ke PT Prima Karya Sasaran Sejahtera', '+62 81722314812', 'I', 1, 3, 8, 'T', 'Kesepakatan Tidak Disetujui', '2023-01-23 04:04:30', '2023-01-23 06:38:56'),
(3, 'Pertukaran mahasiswa di STMIK PGRI Tanggerang', 'Pendidikan', 'Pertukaran mahasiswa di STMIK PGRI Tanggerang', '(0701) 1222134', 'I', 3, 10, 8, 'L', 'Kesepakatan Disetujui', '2023-01-23 04:11:06', '2023-01-23 06:39:11'),
(4, 'Pertukaran Dosen/pengajar dengan Universiti Malaya selama 3 bulan (2023)', 'Pendidikan', 'Pertukaran sementara antara 2 dosen/pengajar dari Universitas Multi Data Palembang dan 2 dosen/pengajar dari Universiti Malaya', '+60 758391123', 'O', 8, 1, 1, 'L', 'Kesepakatan Disetujui', '2023-01-23 04:14:02', '2023-01-23 06:52:35'),
(5, 'Magang di PT Karya Sasaran Sejahtera', 'Pendidikan, Magang', '2 orang peserta akan melaksanakan magang di PT Karya Sasaran Sejahterah selama 6 bulan', '(0813) 612062', 'I', 1, 6, 17, 'B', NULL, '2023-01-23 04:17:11', '2023-01-23 04:17:11'),
(6, 'Mengadakan acara kegiatan seminar', 'Pendidikan, Seminar', 'Mengadakan acara seminar yang berlangsung selama 1 hari', '+62 81012934129', 'I', 6, 3, 4, 'L', 'Kesepakatan Disetujui', '2023-01-23 07:00:28', '2023-01-23 07:00:46'),
(7, 'Visitting Professor di Hanoi University of Science and Technology', 'Kunjungan', 'Kujungan kepada para ahli yang ada di Hanoi University of Science and Technology di Vietnam', '+84 98231746102', 'I', 12, 1, 5, 'T', 'Kesepakatan Tidak Disetujui', '2023-01-23 07:14:54', '2023-01-23 07:15:14'),
(8, 'Program magang di Gojek', 'Magang, pendidikan', 'Peserta akan melaksanakan kegiatan magang selama beberapa bulan di Gojek', '(0813) 000002', 'I', 14, 2, 2, 'L', 'Kesepakatan Disetujui', '2023-01-23 07:17:06', '2023-01-23 07:17:27'),
(9, 'Webinar Himsi', 'Pendidikan, Webinar', 'Mengadakan acara webinar yang berlangsung selama 1 hari', '-', 'I', 7, 1, 5, 'L', 'Kesepakatan Disetujui', '2023-01-24 23:15:58', '2023-01-24 23:16:19');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bukti_kegiatan_units`
--
ALTER TABLE `bukti_kegiatan_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bukti_kerjasamas`
--
ALTER TABLE `bukti_kerjasamas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kerjasamas`
--
ALTER TABLE `kerjasamas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `klasifikasi_mitras`
--
ALTER TABLE `klasifikasi_mitras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mitras`
--
ALTER TABLE `mitras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usulans`
--
ALTER TABLE `usulans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
