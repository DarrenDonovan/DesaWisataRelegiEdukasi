-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2025 at 08:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kecamatan_tigaraksa`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id_about` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `visi` longtext NOT NULL,
  `misi` longtext NOT NULL,
  `gambar_about` varchar(255) NOT NULL,
  `bagan_organisasi` varchar(255) NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id_about`, `id_wilayah`, `visi`, `misi`, `gambar_about`, `bagan_organisasi`, `updated_by`, `updated_at`) VALUES
(1, 13, '<p>Visi Kecamatan Tigaraksa bertujuan memberikan arah strategis bagi pembangunan daerah yang berkelanjutan sebagai berikut:s</p>\r\n<p>\"Terwujudnya kehidupan masyarakat Kecamatan Tigaraksa yang cerdas, religius, dan berwawasan kemandirian\"</p>\r\n<ul>\r\n<li>Cerdas: Masyarakat memiliki wawasan, keterampilan, serta pendidikan yang mendukung kualitas hidup</li>\r\n<li>Religius: Nilai-nilai agama menjadi landasan dalam kehidupan masyarakat dan kebijakan pemerintah</li>\r\n<li>Berwawasan Kemandirian: Masyarakat mampu berpikir kreatif, inovatif, serta mandiri dalam menghadapi tantangan</li>\r\n</ul>\r\n<p>Visi ini menjadi pedoman dalam menyusun program prioritas dan kegiatan pembangunan di Kecamatan Tigaraksa</p>', '<ul>\r\n<li>Meningkatkan fasilitas pendidikan dan layanan kesehatan masyarakat</li>\r\n<li>Mendorong pertumbuhan ekonomi berbasis UMKM sesuai potensi wilayah</li>\r\n<li>Mewujudkan kesejahteraan sosial dengan nilai-nilai religius dalam pemerintahan</li>\r\n<li>Mempercepat pembangunan infrastruktur jalan, jembatan, dan fasilitas umum</li>\r\n<li>Meningkatkan ketertiban dan keamanan melalui koordinasi yang efektif</li>\r\n<li>Mengembangkan kapasitas aparatur kecamatan, desa, dan kelurahan dalam pelayanan publik</li>\r\n</ul>\r\n<p>Misi ini menjadi pedoman utama dalam merancang kebijakan dan program pembangunan di Kecamatan Tigaraksa, Tangerang</p>', 'about_us/tentang-kami.jpg', 'bagan_organisasi/tigaraksa.jpg', 1, '2025-03-21 01:25:31');

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE `agama` (
  `id_agama` int(11) NOT NULL,
  `agama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id_agama`, `agama`) VALUES
(1, 'Katolik'),
(2, 'Kristen'),
(3, 'Islam'),
(4, 'Buddha'),
(5, 'Hindu'),
(6, 'Kong Hu Cu');

-- --------------------------------------------------------

--
-- Table structure for table `agama_per_wilayah`
--

CREATE TABLE `agama_per_wilayah` (
  `id` int(11) NOT NULL,
  `id_agama` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `jumlah_penganut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agama_per_wilayah`
--

INSERT INTO `agama_per_wilayah` (`id`, `id_agama`, `id_wilayah`, `jumlah_penganut`) VALUES
(1, 1, 13, 10000),
(2, 2, 13, 1234),
(3, 3, 13, 40000),
(4, 4, 13, 5900),
(5, 5, 13, 10235),
(6, 6, 13, 7000);

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `judul_berita` longtext NOT NULL,
  `konten_berita` longtext NOT NULL,
  `gambar_berita` varchar(255) NOT NULL,
  `penulis_berita` varchar(255) NOT NULL,
  `tanggal_berita` date NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul_berita`, `konten_berita`, `gambar_berita`, `penulis_berita`, `tanggal_berita`, `id_wilayah`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Festival Budaya Tigaraksa 2024', 'Pemerintah Kecamatan Tigaraksa mengadakan festival budaya tahunan dengan berbagai pertunjukan seni dan kuliner khas daerah.', 'berita/festival_tigaraksa.jpg', 'Dinas Pariwisata Tigaraksa', '2024-03-01', 1, 1, '2025-03-24 03:20:23', 1, '2025-03-24 03:20:23'),
(2, 'Pembangunan Infrastruktur di Desa Pasir Nangka', 'Proyek pembangunan jalan desa di Pasir Nangka mulai dikerjakan untuk meningkatkan aksesibilitas warga.', 'berita/jalan_pasir_nangka.jpg', 'Dinas PUPR Tigaraksa', '2024-02-20', 2, 1, '2025-03-24 03:20:23', 1, '2025-03-24 03:20:23'),
(3, 'Lomba Kebersihan Antar Desa', 'Dalam rangka memperingati Hari Peduli Sampah Nasional, Kecamatan Tigaraksa menggelar lomba kebersihan antar desa.', 'berita/lomba_kebersihan.jpg', 'Pemuda Karang Taruna Tigaraksa', '2024-02-25', 3, 1, '2025-03-24 03:20:23', 1, '2025-03-24 03:20:23'),
(4, 'Sosialisasi Pertanian Organik di Desa Tapos', 'Petani di Desa Tapos diberikan pelatihan tentang pertanian organik untuk meningkatkan hasil panen yang lebih sehat.', 'berita/pelatihan_pertanian.jpg', 'Dinas Pertanian Tigaraksa', '2024-02-15', 4, 1, '2025-03-24 03:20:23', 1, '2025-03-24 03:20:23'),
(5, 'Pengobatan Gratis di Desa Sodong', 'Puskesmas Tigaraksa mengadakan program pengobatan gratis untuk warga Desa Sodong.', 'berita/pengobatan_gratis.jpg', 'Puskesmas Tigaraksa', '2024-03-03', 5, 1, '2025-03-24 03:20:23', 1, '2025-03-24 03:20:23'),
(6, 'Peringatan Hari Kemerdekaan di Desa Cileless', '<p>Pemerintah Kecamatan Tigaraksa mengadakan festival budaya tahunan dengan berbagai pertunjukan seni dan kuliner khas daerah.</p>', 'berita/hari_kemerdekaan_cileles.jpg', 'Panitia HUT RI Tigaraksa', '2024-08-17', 9, 1, '2025-03-24 03:20:23', 1, '2025-03-24 01:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kegiatan`
--

CREATE TABLE `jenis_kegiatan` (
  `id_jenis_kegiatan` int(11) NOT NULL,
  `nama_jenis_kegiatan` varchar(50) NOT NULL,
  `gambar_jenis_kegiatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_kegiatan`
--

INSERT INTO `jenis_kegiatan` (`id_jenis_kegiatan`, `nama_jenis_kegiatan`, `gambar_jenis_kegiatan`) VALUES
(1, 'Rapat Koordinasi', 'jenis_kegiatan/rapat-koordinasi.jpeg'),
(2, 'Posyandu', 'jenis_kegiatan/posyandu.png'),
(3, 'Ulang Tahun Desa', 'jenis_kegiatan/ultah-desa.jpg'),
(4, 'Kesehatan', 'jenis_kegiatan/kesehatan.jpg'),
(5, 'Lomba', 'jenis_kegiatan/lomba-desa.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kelamin_per_wilayah`
--

CREATE TABLE `jenis_kelamin_per_wilayah` (
  `id_wilayah` int(11) NOT NULL,
  `penduduk_laki` int(11) NOT NULL,
  `penduduk_perempuan` int(11) NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_kelamin_per_wilayah`
--

INSERT INTO `jenis_kelamin_per_wilayah` (`id_wilayah`, `penduduk_laki`, `penduduk_perempuan`, `updated_by`, `updated_at`) VALUES
(1, 3138, 3053, NULL, NULL),
(2, 3337, 3064, NULL, NULL),
(3, 13076, 12732, NULL, NULL),
(4, 5712, 5487, NULL, NULL),
(5, 7688, 7425, 2, '2025-03-23 20:30:18'),
(6, 2710, 2507, NULL, NULL),
(7, 6286, 6189, NULL, NULL),
(8, 7760, 7503, NULL, NULL),
(9, 5885, 5750, NULL, NULL),
(10, 4906, 4708, NULL, NULL),
(11, 4131, 3959, NULL, NULL),
(12, 4637, 4449, 3, '2025-03-23 23:05:47'),
(14, 4185, 4149, NULL, NULL),
(15, 8588, 8581, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `keterangan` longtext DEFAULT NULL,
  `gambar_kegiatan` varchar(255) DEFAULT NULL,
  `id_wilayah` int(11) NOT NULL,
  `id_jenis_kegiatan` int(11) NOT NULL,
  `tanggal_kegiatan` date DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nama_kegiatan`, `keterangan`, `gambar_kegiatan`, `id_wilayah`, `id_jenis_kegiatan`, `tanggal_kegiatan`, `updated_by`, `updated_at`) VALUES
(1, 'Rapat Koordinasi Pembangunan', 'Rapat koordinasi untuk membahas pembangunan infrastruktur di desa.', 'kegiatan/rapat1.jpg', 1, 1, '2025-03-01', NULL, NULL),
(2, 'Posyandu Balita Desa Cisereh', 'Kegiatan posyandu rutin untuk pemeriksaan kesehatan balita.', 'kegiatan/posyandu1.jpg', 2, 2, '2025-03-05', NULL, NULL),
(3, 'Perayaan HUT Desa Pasir Nangka', 'Acara perayaan ulang tahun desa dengan berbagai kegiatan budaya.', 'kegiatan/ultah-desa1.jpg', 3, 3, '2025-04-10', NULL, NULL),
(4, 'Pemeriksaan Kesehatan Gratis', 'Program pemeriksaan kesehatan gratis untuk warga desa.', 'kegiatan/kesehatan1.jpg', 4, 4, '2025-02-25', NULL, NULL),
(5, 'Lomba Kebersihan Antar RT', 'Lomba kebersihan untuk meningkatkan kesadaran warga tentang kebersihan lingkungan.', 'kegiatan/lomba1.jpg', 5, 5, '2025-03-12', NULL, NULL),
(6, 'Rapat Evaluasi Program Desa', 'Evaluasi program desa yang telah berjalan selama setahun.', 'kegiatan/rapat2.jpg', 6, 1, '2025-03-20', NULL, NULL),
(7, 'Posyandu Lansia Desa Mata Gara', 'Kegiatan posyandu untuk pemeriksaan kesehatan lansia.', 'kegiatan/posyandu2.jpg', 7, 2, '2025-04-02', NULL, NULL),
(8, 'Festival Budaya Desa Marga Sari', 'Festival budaya tahunan dengan berbagai pertunjukan seni.', 'kegiatan/ultah-desa2.jpeg', 8, 3, '2025-05-15', NULL, NULL),
(9, 'Sosialisasi Kesehatan Ibu dan Anak', 'Sosialisasi pentingnya kesehatan ibu dan anak di Desa Sodong.', 'kegiatan/kesehatan2.jpeg', 9, 4, '2025-02-18', NULL, NULL),
(10, 'Turnamen Olahraga Desa Tapos', 'Lomba olahraga antar warga desa untuk mempererat persaudaraan.', 'kegiatan/lomba2.jpg', 10, 5, '2025-06-01', NULL, NULL),
(11, 'Musyawarah Desa Bantar Panjang', 'Musyawarah desa terkait rencana pembangunan desa tahun depan.', 'kegiatan/rapat3.jpg', 11, 1, '2025-02-28', NULL, NULL),
(12, 'Pemeriksaan Kesehatan Cileles', 'Pemeriksaan kesehatan gratis untuk warga desa.', 'kegiatan/kesehatan3.jpg', 12, 4, '2025-03-07', NULL, NULL),
(13, 'Lomba Mewarnai Anak Tigaraksa', 'Lomba mewarnai tingkat anak-anak dalam rangka memperingati Hari Anak.', 'kegiatan/lomba3.jpg', 13, 5, '2025-03-22', NULL, NULL),
(14, 'Posyandu Bayi Kelurahan Kadu Agung', 'Pelayanan posyandu untuk bayi dan balita.', 'kegiatan/posyandu3.jpg', 14, 2, '2025-04-05', NULL, NULL),
(15, 'Rapat Perencanaan Kelurahan Tigaraksa', 'Rapat membahas perencanaan program kelurahan.', 'kegiatan/rapat3.jpg', 15, 1, '2025-04-15', 1, '2025-03-21 01:37:27');

-- --------------------------------------------------------

--
-- Table structure for table `kel_umur_per_wilayah`
--

CREATE TABLE `kel_umur_per_wilayah` (
  `id` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `kelompok_umur` varchar(255) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kel_umur_per_wilayah`
--

INSERT INTO `kel_umur_per_wilayah` (`id`, `id_wilayah`, `kelompok_umur`, `jumlah_orang`, `updated_by`, `updated_at`) VALUES
(1, 13, '0 - 4 Tahun', 10119, 1, '2025-03-21 01:26:59'),
(2, 13, '5 - 9 Tahun', 15656, NULL, NULL),
(3, 13, '10 - 14 Tahun', 15693, NULL, NULL),
(4, 13, '15 - 19 Tahun', 12747, NULL, NULL),
(5, 13, '20 - 24 Tahun', 14259, NULL, NULL),
(6, 13, '25 - 29 Tahun', 13755, NULL, NULL),
(8, 13, '30 - 34 Tahun', 13939, NULL, NULL),
(9, 13, '35 - 39 Tahun', 12870, NULL, NULL),
(10, 13, '40 - 44 Tahun', 14019, NULL, NULL),
(11, 13, '45 - 49 Tahun', 12430, NULL, NULL),
(12, 13, '50 - 54 Tahun', 10567, NULL, NULL),
(13, 13, '55 - 59 Tahun', 6294, NULL, NULL),
(14, 13, '60 - 64 Tahun', 3818, NULL, NULL),
(15, 13, '65 - 69 Tahun', 2473, NULL, NULL),
(16, 13, '70 - 74 Tahun', 1468, NULL, NULL),
(17, 13, '75+ Tahun', 1488, NULL, NULL),
(18, 1, '0 - 4 Tahun', 5000, NULL, NULL),
(19, 1, '5 - 9 Tahun', 7500, NULL, NULL),
(20, 1, '10 - 14 Tahun', 8000, NULL, NULL),
(21, 1, '15 - 19 Tahun', 7000, NULL, NULL),
(22, 1, '20 - 24 Tahun', 8500, NULL, NULL),
(23, 1, '25 - 29 Tahun', 9000, NULL, NULL),
(24, 1, '30 - 34 Tahun', 8700, NULL, NULL),
(25, 1, '35 - 39 Tahun', 8200, NULL, NULL),
(26, 1, '40 - 44 Tahun', 8800, NULL, NULL),
(27, 1, '45 - 49 Tahun', 7600, NULL, NULL),
(28, 1, '50 - 54 Tahun', 6400, NULL, NULL),
(29, 1, '55 - 59 Tahun', 4200, NULL, NULL),
(30, 1, '60 - 64 Tahun', 2500, NULL, NULL),
(31, 1, '65 - 69 Tahun', 1500, NULL, NULL),
(32, 1, '70 - 74 Tahun', 900, NULL, NULL),
(33, 1, '75+ Tahun', 1000, NULL, NULL),
(34, 2, '0 - 4 Tahun', 5200, NULL, NULL),
(35, 2, '5 - 9 Tahun', 7800, NULL, NULL),
(36, 2, '10 - 14 Tahun', 8300, NULL, NULL),
(37, 2, '15 - 19 Tahun', 7100, NULL, NULL),
(38, 2, '20 - 24 Tahun', 8600, NULL, NULL),
(39, 2, '25 - 29 Tahun', 9100, NULL, NULL),
(40, 2, '30 - 34 Tahun', 8800, NULL, NULL),
(41, 2, '35 - 39 Tahun', 8300, NULL, NULL),
(42, 2, '40 - 44 Tahun', 8900, NULL, NULL),
(43, 2, '45 - 49 Tahun', 7700, NULL, NULL),
(44, 2, '50 - 54 Tahun', 6500, NULL, NULL),
(45, 2, '55 - 59 Tahun', 4300, NULL, NULL),
(46, 2, '60 - 64 Tahun', 2600, NULL, NULL),
(47, 2, '65 - 69 Tahun', 1600, NULL, NULL),
(48, 2, '70 - 74 Tahun', 950, NULL, NULL),
(49, 2, '75+ Tahun', 1100, NULL, NULL),
(50, 3, '0 - 4 Tahun', 10000, NULL, NULL),
(51, 3, '5 - 9 Tahun', 15000, NULL, NULL),
(52, 3, '10 - 14 Tahun', 15500, NULL, NULL),
(53, 3, '15 - 19 Tahun', 12500, NULL, NULL),
(54, 3, '20 - 24 Tahun', 14000, NULL, NULL),
(55, 3, '25 - 29 Tahun', 13500, NULL, NULL),
(56, 3, '30 - 34 Tahun', 13800, NULL, NULL),
(57, 3, '35 - 39 Tahun', 12700, NULL, NULL),
(58, 3, '40 - 44 Tahun', 13900, NULL, NULL),
(59, 3, '45 - 49 Tahun', 12300, NULL, NULL),
(60, 3, '50 - 54 Tahun', 10400, NULL, NULL),
(61, 3, '55 - 59 Tahun', 6200, NULL, NULL),
(62, 3, '60 - 64 Tahun', 3800, NULL, NULL),
(63, 3, '65 - 69 Tahun', 2400, NULL, NULL),
(64, 3, '70 - 74 Tahun', 1400, NULL, NULL),
(65, 3, '75+ Tahun', 1500, NULL, NULL),
(66, 4, '0 - 4 Tahun', 5500, NULL, NULL),
(67, 4, '5 - 9 Tahun', 7900, NULL, NULL),
(68, 4, '10 - 14 Tahun', 8400, NULL, NULL),
(69, 4, '15 - 19 Tahun', 7200, NULL, NULL),
(70, 4, '20 - 24 Tahun', 8700, NULL, NULL),
(71, 4, '25 - 29 Tahun', 9200, NULL, NULL),
(72, 4, '30 - 34 Tahun', 8900, NULL, NULL),
(73, 4, '35 - 39 Tahun', 8400, NULL, NULL),
(74, 4, '40 - 44 Tahun', 9000, NULL, NULL),
(75, 4, '45 - 49 Tahun', 7800, NULL, NULL),
(76, 4, '50 - 54 Tahun', 6600, NULL, NULL),
(77, 4, '55 - 59 Tahun', 4400, NULL, NULL),
(78, 4, '60 - 64 Tahun', 2700, NULL, NULL),
(79, 4, '65 - 69 Tahun', 1700, NULL, NULL),
(80, 4, '70 - 74 Tahun', 970, NULL, NULL),
(81, 4, '75+ Tahun', 1200, NULL, NULL),
(82, 5, '0 - 4 Tahun', 6000, NULL, NULL),
(83, 5, '5 - 9 Tahun', 8100, NULL, NULL),
(84, 5, '10 - 14 Tahun', 8700, NULL, NULL),
(85, 5, '15 - 19 Tahun', 7300, NULL, NULL),
(86, 5, '20 - 24 Tahun', 8800, NULL, NULL),
(87, 5, '25 - 29 Tahun', 9300, NULL, NULL),
(88, 5, '30 - 34 Tahun', 9000, NULL, NULL),
(89, 5, '35 - 39 Tahun', 8500, NULL, NULL),
(90, 5, '40 - 44 Tahun', 9100, NULL, NULL),
(91, 5, '45 - 49 Tahun', 7900, NULL, NULL),
(92, 5, '50 - 54 Tahun', 6700, NULL, NULL),
(93, 5, '55 - 59 Tahun', 4500, NULL, NULL),
(94, 5, '60 - 64 Tahun', 2800, NULL, NULL),
(95, 5, '65 - 69 Tahun', 1800, NULL, NULL),
(96, 5, '70 - 74 Tahun', 990, NULL, NULL),
(97, 5, '75+ Tahun', 1300, NULL, NULL),
(98, 14, '0 - 4 Tahun', 5900, NULL, NULL),
(99, 14, '5 - 9 Tahun', 8200, NULL, NULL),
(100, 14, '10 - 14 Tahun', 8800, NULL, NULL),
(101, 14, '15 - 19 Tahun', 7400, NULL, NULL),
(102, 14, '20 - 24 Tahun', 8900, NULL, NULL),
(103, 14, '25 - 29 Tahun', 9400, NULL, NULL),
(104, 14, '30 - 34 Tahun', 9100, NULL, NULL),
(105, 14, '35 - 39 Tahun', 8600, NULL, NULL),
(106, 14, '40 - 44 Tahun', 9200, NULL, NULL),
(107, 14, '45 - 49 Tahun', 8000, NULL, NULL),
(108, 14, '50 - 54 Tahun', 6800, NULL, NULL),
(109, 14, '55 - 59 Tahun', 4600, NULL, NULL),
(110, 14, '60 - 64 Tahun', 2900, NULL, NULL),
(111, 14, '65 - 69 Tahun', 1900, NULL, NULL),
(112, 14, '70 - 74 Tahun', 1000, NULL, NULL),
(113, 14, '75+ Tahun', 1400, NULL, NULL),
(114, 15, '0 - 4 Tahun', 6200, NULL, NULL),
(115, 15, '5 - 9 Tahun', 8300, NULL, NULL),
(116, 15, '10 - 14 Tahun', 8900, NULL, NULL),
(117, 15, '15 - 19 Tahun', 7500, NULL, NULL),
(118, 15, '20 - 24 Tahun', 9000, NULL, NULL),
(119, 15, '25 - 29 Tahun', 9500, NULL, NULL),
(120, 15, '30 - 34 Tahun', 9200, NULL, NULL),
(121, 15, '35 - 39 Tahun', 8700, NULL, NULL),
(122, 15, '40 - 44 Tahun', 9300, NULL, NULL),
(123, 15, '45 - 49 Tahun', 8100, NULL, NULL),
(124, 15, '50 - 54 Tahun', 6900, NULL, NULL),
(125, 15, '55 - 59 Tahun', 4700, NULL, NULL),
(126, 15, '60 - 64 Tahun', 3000, NULL, NULL),
(127, 15, '65 - 69 Tahun', 2000, NULL, NULL),
(128, 15, '70 - 74 Tahun', 1050, NULL, NULL),
(129, 15, '75+ Tahun', 1500, NULL, NULL),
(130, 6, '0 - 4 Tahun', 6100, NULL, NULL),
(131, 6, '5 - 9 Tahun', 8400, NULL, NULL),
(132, 6, '10 - 14 Tahun', 9000, NULL, NULL),
(133, 6, '15 - 19 Tahun', 7600, NULL, NULL),
(134, 6, '20 - 24 Tahun', 9100, NULL, NULL),
(135, 6, '25 - 29 Tahun', 9600, NULL, NULL),
(136, 6, '30 - 34 Tahun', 9300, NULL, NULL),
(137, 6, '35 - 39 Tahun', 8800, NULL, NULL),
(138, 6, '40 - 44 Tahun', 9400, NULL, NULL),
(139, 6, '45 - 49 Tahun', 8200, NULL, NULL),
(140, 6, '50 - 54 Tahun', 7000, NULL, NULL),
(141, 6, '55 - 59 Tahun', 4800, NULL, NULL),
(142, 6, '60 - 64 Tahun', 3100, NULL, NULL),
(143, 6, '65 - 69 Tahun', 2100, NULL, NULL),
(144, 6, '70 - 74 Tahun', 1100, NULL, NULL),
(145, 6, '75+ Tahun', 1600, NULL, NULL),
(146, 7, '0 - 4 Tahun', 6200, NULL, NULL),
(147, 7, '5 - 9 Tahun', 8500, NULL, NULL),
(148, 7, '10 - 14 Tahun', 9100, NULL, NULL),
(149, 7, '15 - 19 Tahun', 7700, NULL, NULL),
(150, 7, '20 - 24 Tahun', 9200, NULL, NULL),
(151, 7, '25 - 29 Tahun', 9700, NULL, NULL),
(152, 7, '30 - 34 Tahun', 9400, NULL, NULL),
(153, 7, '35 - 39 Tahun', 8900, NULL, NULL),
(154, 7, '40 - 44 Tahun', 9500, NULL, NULL),
(155, 7, '45 - 49 Tahun', 8300, NULL, NULL),
(156, 7, '50 - 54 Tahun', 7100, NULL, NULL),
(157, 7, '55 - 59 Tahun', 4900, NULL, NULL),
(158, 7, '60 - 64 Tahun', 3200, NULL, NULL),
(159, 7, '65 - 69 Tahun', 2200, NULL, NULL),
(160, 7, '70 - 74 Tahun', 1150, NULL, NULL),
(161, 7, '75+ Tahun', 1700, NULL, NULL),
(162, 8, '0 - 4 Tahun', 6300, NULL, NULL),
(163, 8, '5 - 9 Tahun', 8600, NULL, NULL),
(164, 8, '10 - 14 Tahun', 9200, NULL, NULL),
(165, 8, '15 - 19 Tahun', 7800, NULL, NULL),
(166, 8, '20 - 24 Tahun', 9300, NULL, NULL),
(167, 8, '25 - 29 Tahun', 9800, NULL, NULL),
(168, 8, '30 - 34 Tahun', 9500, NULL, NULL),
(169, 8, '35 - 39 Tahun', 9000, NULL, NULL),
(170, 8, '40 - 44 Tahun', 9600, NULL, NULL),
(171, 8, '45 - 49 Tahun', 8400, NULL, NULL),
(172, 8, '50 - 54 Tahun', 7200, NULL, NULL),
(173, 8, '55 - 59 Tahun', 5000, NULL, NULL),
(174, 8, '60 - 64 Tahun', 3300, NULL, NULL),
(175, 8, '65 - 69 Tahun', 2300, NULL, NULL),
(176, 8, '70 - 74 Tahun', 1200, NULL, NULL),
(177, 8, '75+ Tahun', 1800, NULL, NULL),
(178, 9, '0 - 4 Tahun', 6400, NULL, NULL),
(179, 9, '5 - 9 Tahun', 8700, NULL, NULL),
(180, 9, '10 - 14 Tahun', 9300, NULL, NULL),
(181, 9, '15 - 19 Tahun', 7900, NULL, NULL),
(182, 9, '20 - 24 Tahun', 9400, NULL, NULL),
(183, 9, '25 - 29 Tahun', 9900, NULL, NULL),
(184, 9, '30 - 34 Tahun', 9600, NULL, NULL),
(185, 9, '35 - 39 Tahun', 9100, NULL, NULL),
(186, 9, '40 - 44 Tahun', 9700, NULL, NULL),
(187, 9, '45 - 49 Tahun', 8500, NULL, NULL),
(188, 9, '50 - 54 Tahun', 7300, NULL, NULL),
(189, 9, '55 - 59 Tahun', 5100, NULL, NULL),
(190, 9, '60 - 64 Tahun', 3400, NULL, NULL),
(191, 9, '65 - 69 Tahun', 2400, NULL, NULL),
(192, 9, '70 - 74 Tahun', 1250, NULL, NULL),
(193, 9, '75+ Tahun', 1900, NULL, NULL),
(194, 10, '0 - 4 Tahun', 6500, NULL, NULL),
(195, 10, '5 - 9 Tahun', 8800, NULL, NULL),
(196, 10, '10 - 14 Tahun', 9400, NULL, NULL),
(197, 10, '15 - 19 Tahun', 8000, NULL, NULL),
(198, 10, '20 - 24 Tahun', 9500, NULL, NULL),
(199, 10, '25 - 29 Tahun', 10000, NULL, NULL),
(200, 10, '30 - 34 Tahun', 9700, NULL, NULL),
(201, 10, '35 - 39 Tahun', 9200, NULL, NULL),
(202, 10, '40 - 44 Tahun', 9800, NULL, NULL),
(203, 10, '45 - 49 Tahun', 8600, NULL, NULL),
(204, 10, '50 - 54 Tahun', 7400, NULL, NULL),
(205, 10, '55 - 59 Tahun', 5200, NULL, NULL),
(206, 10, '60 - 64 Tahun', 3500, NULL, NULL),
(207, 10, '65 - 69 Tahun', 2500, NULL, NULL),
(208, 10, '70 - 74 Tahun', 1300, NULL, NULL),
(209, 10, '75+ Tahun', 2000, NULL, NULL),
(210, 11, '0 - 4 Tahun', 6600, NULL, NULL),
(211, 11, '5 - 9 Tahun', 8900, NULL, NULL),
(212, 11, '10 - 14 Tahun', 9500, NULL, NULL),
(213, 11, '15 - 19 Tahun', 8100, NULL, NULL),
(214, 11, '20 - 24 Tahun', 9600, NULL, NULL),
(215, 11, '25 - 29 Tahun', 10100, NULL, NULL),
(216, 11, '30 - 34 Tahun', 9800, NULL, NULL),
(217, 11, '35 - 39 Tahun', 9300, NULL, NULL),
(218, 11, '40 - 44 Tahun', 9900, NULL, NULL),
(219, 11, '45 - 49 Tahun', 8700, NULL, NULL),
(220, 11, '50 - 54 Tahun', 7500, NULL, NULL),
(221, 11, '55 - 59 Tahun', 5300, NULL, NULL),
(222, 11, '60 - 64 Tahun', 3600, NULL, NULL),
(223, 11, '65 - 69 Tahun', 2600, NULL, NULL),
(224, 11, '70 - 74 Tahun', 1350, NULL, NULL),
(225, 11, '75+ Tahun', 2100, NULL, NULL),
(226, 12, '0 - 4 Tahun', 6700, NULL, NULL),
(227, 12, '5 - 9 Tahun', 9000, NULL, NULL),
(228, 12, '10 - 14 Tahun', 9600, NULL, NULL),
(229, 12, '15 - 19 Tahun', 8200, NULL, NULL),
(230, 12, '20 - 24 Tahun', 9700, NULL, NULL),
(231, 12, '25 - 29 Tahun', 10200, NULL, NULL),
(232, 12, '30 - 34 Tahun', 9900, NULL, NULL),
(233, 12, '35 - 39 Tahun', 9400, NULL, NULL),
(234, 12, '40 - 44 Tahun', 10000, NULL, NULL),
(235, 12, '45 - 49 Tahun', 8800, NULL, NULL),
(236, 12, '50 - 54 Tahun', 7600, NULL, NULL),
(237, 12, '55 - 59 Tahun', 5400, NULL, NULL),
(238, 12, '60 - 64 Tahun', 3700, NULL, NULL),
(239, 12, '65 - 69 Tahun', 2700, NULL, NULL),
(240, 12, '70 - 74 Tahun', 1400, NULL, NULL),
(241, 12, '75+ Tahun', 2200, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `pekerjaan`) VALUES
(1, 'Petani'),
(2, 'Nelayan'),
(3, 'Guru'),
(4, 'Dokter'),
(5, 'Pegawai Negeri'),
(6, 'Wiraswasta');

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan_per_wilayah`
--

CREATE TABLE `pekerjaan_per_wilayah` (
  `id` int(11) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `jumlah_pekerja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pekerjaan_per_wilayah`
--

INSERT INTO `pekerjaan_per_wilayah` (`id`, `id_pekerjaan`, `id_wilayah`, `jumlah_pekerja`) VALUES
(1, 1, 13, 1000),
(2, 2, 13, 1200),
(3, 3, 13, 800),
(4, 4, 13, 300),
(5, 5, 13, 1500),
(6, 6, 13, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id_pendidikan` int(11) NOT NULL,
  `pendidikan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`id_pendidikan`, `pendidikan`) VALUES
(1, 'Tidak Sekolah'),
(2, 'SD'),
(3, 'SMP'),
(4, 'SMA'),
(5, 'Diploma'),
(6, 'Sarjana'),
(7, 'Magister'),
(8, 'Doktor');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan_per_wilayah`
--

CREATE TABLE `pendidikan_per_wilayah` (
  `id` int(11) NOT NULL,
  `id_pendidikan` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `jumlah_orang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendidikan_per_wilayah`
--

INSERT INTO `pendidikan_per_wilayah` (`id`, `id_pendidikan`, `id_wilayah`, `jumlah_orang`) VALUES
(1, 1, 13, 600),
(2, 2, 13, 4000),
(3, 3, 13, 3500),
(4, 4, 13, 2800),
(5, 5, 13, 1500),
(6, 6, 13, 2000),
(7, 7, 13, 500),
(8, 8, 13, 100);

-- --------------------------------------------------------

--
-- Table structure for table `perangkat_kecamatan`
--

CREATE TABLE `perangkat_kecamatan` (
  `id_perangkat` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `link_facebook` varchar(255) DEFAULT NULL,
  `link_instagram` varchar(255) DEFAULT NULL,
  `link_tiktok` varchar(255) DEFAULT NULL,
  `id_wilayah` int(11) DEFAULT NULL,
  `gambar_perangkat` varchar(255) NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perangkat_kecamatan`
--

INSERT INTO `perangkat_kecamatan` (`id_perangkat`, `nama`, `jabatan`, `link_facebook`, `link_instagram`, `link_tiktok`, `id_wilayah`, `gambar_perangkat`, `updated_by`, `updated_at`) VALUES
(1, 'Ahmad Setiawan', 'Camat', 'https://facebook.com/ahmadsetiawan', 'https://instagram.com/ahmadsetiawan', 'https://tiktok.com/@ahmadsetiawan', NULL, 'perangkat_kecamatan/camat_ahmad.jpg', NULL, NULL),
(2, 'Budi Santoso', 'Sekretaris Kecamatan', 'https://facebook.com/budisantoso', 'https://instagram.com/budisantoso', 'https://tiktok.com/@budisantoso', NULL, 'perangkat_kecamatan/sekretaris_budi.jpg', NULL, NULL),
(3, 'Citra Dewi', 'Kasi Pemerintahan', 'https://facebook.com/citradewi', 'https://instagram.com/citrapemerintahan', 'https://tiktok.com/@citradewi', NULL, 'perangkat_kecamatan/kasi_pemerintahan.jpg', NULL, NULL),
(4, 'Dedi Prasetyo', 'Kasi Pembangunan dan Perekonomian', 'https://facebook.com/dediprasetyo', 'https://instagram.com/dediprasetyo', 'https://tiktok.com/@dediprasetyo', NULL, 'perangkat_kecamatan/kasi_pembangunan.jpg', NULL, NULL),
(5, 'Eka Sari', 'Kasi Kesejahteraan Sosial', NULL, NULL, NULL, NULL, 'perangkat_kecamatan/kasi_kesejahteraan.jpg', 1, '2025-03-21 01:26:03'),
(6, 'Farhan Hakim', 'Kasi Ketenteraman dan Ketertiban Umum', 'https://facebook.com/farhanhakim', 'https://instagram.com/farhanhakim', 'https://tiktok.com/@farhanhakim', NULL, 'perangkat_kecamatan/kasi_ketertiban.jpg', NULL, NULL),
(7, 'Gina Lestari', 'Kasi Pelayanan Umum', 'https://facebook.com/ginalestari', 'https://instagram.com/ginalestari', 'https://tiktok.com/@ginalestari', NULL, 'perangkat_kecamatan/kasi_pelayanan.jpg', NULL, NULL),
(8, 'Hendra Wijaya', 'Kepala Desa Pasir Nangka', 'https://facebook.com/hendrawijaya', 'https://instagram.com/hendrawijaya', 'https://tiktok.com/@hendrawijaya', 3, 'perangkat_kecamatan/kepala_pasirnangka.jpg', NULL, NULL),
(9, 'Indah Permata', 'Kepala Desa Margasari', 'https://facebook.com/indahpermata', 'https://instagram.com/indahpermata', 'https://tiktok.com/@indahpermata', 8, 'perangkat_kecamatan/kepala_margasari.jpg', NULL, NULL),
(11, 'Kartika Dewi', 'Kepala Desa Matagara', 'https://facebook.com/kartikadewi', 'https://instagram.com/kartikadewi', 'https://tiktok.com/@kartikadewi', 7, 'perangkat_kecamatan/kepala_matagara.jpg', NULL, NULL),
(13, 'Mulyadi Saputra', 'Kepala Desa Pasir Bolang', 'https://facebook.com/mulyadisp', 'https://instagram.com/mulyadisp', 'https://tiktok.com/@mulyadisp', 1, 'perangkat_kecamatan/kepala_pasirbolang.jpg', NULL, NULL),
(14, 'Rina Astuti', 'Kepala Desa Cisereh', 'https://facebook.com/rinaastuti', 'https://instagram.com/rinaastuti', 'https://tiktok.com/@rinaastuti', 2, 'perangkat_kecamatan/kepala_cisereh.jpg', NULL, NULL),
(15, 'Samsul Bahri', 'Kepala Desa Pematang', 'https://facebook.com/samsulbahri', 'https://instagram.com/samsulbahri', 'https://tiktok.com/@samsulbahri', 4, 'perangkat_kecamatan/kepala_pematang.jpg', NULL, NULL),
(16, 'Nurul Hidayah', 'Kepala Desa Pete', 'https://facebook.com/nurulhidayah', 'https://instagram.com/nurulhidayah', 'https://tiktok.com/@nurulhidayah', 5, 'perangkat_kecamatan/kepala_pete.jpg', NULL, NULL),
(17, 'Herman Wijaya', 'Kepala Desa Tegalsari', 'https://facebook.com/hermanwijaya', 'https://instagram.com/hermanwijaya', 'https://tiktok.com/@hermanwijaya', 6, 'perangkat_kecamatan/kepala_tegalsari.jpg', NULL, NULL),
(18, 'Sri Lestari', 'Kepala Desa Sodong', 'https://facebook.com/srilestari', 'https://instagram.com/srilestari', 'https://tiktok.com/@srilestari', 9, 'perangkat_kecamatan/kepala_sodong.jpg', NULL, NULL),
(19, 'Wahyu Prasetyo', 'Kepala Desa Tapos', 'https://facebook.com/wahyuprasetyo', 'https://instagram.com/wahyuprasetyo', 'https://tiktok.com/@wahyuprasetyo', 10, 'perangkat_kecamatan/kepala_tapos.jpg', NULL, NULL),
(20, 'Yulianto Kusuma', 'Kepala Desa Bantar Panjang', 'https://facebook.com/yuliantokusuma', 'https://instagram.com/yuliantokusuma', 'https://tiktok.com/@yuliantokusuma', 11, 'perangkat_kecamatan/kepala_bantarpanjang.jpg', NULL, NULL),
(21, 'Dewi Kartikasari', 'Kepala Kelurahan Kadu Agung', 'https://facebook.com/dewikartikasari', 'https://instagram.com/dewikartikasari', 'https://tiktok.com/@dewikartikasari', 14, 'perangkat_kecamatan/kepala_kaduagung.jpg', NULL, NULL),
(22, 'Arif Ramadhan', 'Kepala Kelurahan Tigaraksa', 'https://facebook.com/ariframadhan', 'https://instagram.com/ariframadhan', 'https://tiktok.com/@ariframadhan', 15, 'perangkat_kecamatan/kepala_tigaraksa.jpg', NULL, NULL),
(23, 'Adi Makmur Sejahtra', 'Kepala Desa Cileles', NULL, NULL, NULL, 12, 'perangkat_kecamatan/kepala_cileles.jpg', 1, '2025-03-24 06:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `id_wilayah` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `id_wilayah`) VALUES
(1, 'superadmin', 'superadmin@admin.com', NULL, '$2y$10$ZQWfYXlXjMePzcNX18KBxOMlu/Kj9Kk98wYhffpWMN9BeI2t58LhG', NULL, '2025-03-02 22:51:28', '2025-03-02 22:51:28', 'superadmin', 13),
(2, 'Admin 1', 'admin1@admin.com', NULL, '$2y$10$NAwL18jSYuiCTHFaiuR/yOXa7IQ5IXX7uDLe4X1ix76CoRW6kDZF6', NULL, '2025-03-17 22:28:08', '2025-03-17 22:28:08', 'admin', 5),
(3, 'admin2', 'admin2@admin.com', NULL, '$2y$10$Wj3tTXbuKDjLZ7gRn9D5D.elaDGfo5VecB44YXyDy9r2bHWqEMZLC', NULL, '2025-03-18 23:12:47', '2025-03-18 23:12:47', 'admin', 12);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `id_log` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `action` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id_log`, `user_id`, `email`, `action`, `time`) VALUES
(1, 1, 'superadmin@admin.com', 'login', '2025-03-20 21:55:33'),
(2, 1, 'superadmin@admin.com', 'logout', '2025-03-20 21:57:54'),
(3, 2, 'admin1@admin.com', 'login', '2025-03-20 21:58:56'),
(4, 1, 'superadmin@admin.com', 'login', '2025-03-21 00:45:29'),
(5, 1, 'superadmin@admin.com', 'login', '2025-03-21 01:17:42'),
(6, 1, 'superadmin@admin.com', 'login', '2025-03-23 20:23:29'),
(7, 1, 'superadmin@admin.com', 'logout', '2025-03-23 20:29:23'),
(8, 2, 'admin1@admin.com', 'login', '2025-03-23 20:29:32'),
(9, 2, 'admin1@admin.com', 'logout', '2025-03-23 20:32:28'),
(10, 1, 'superadmin@admin.com', 'login', '2025-03-23 20:32:56'),
(11, 1, 'superadmin@admin.com', 'logout', '2025-03-23 22:57:00'),
(12, 2, 'admin1@admin.com', 'login', '2025-03-23 22:57:09'),
(13, 2, 'admin1@admin.com', 'logout', '2025-03-23 22:59:04'),
(14, 3, 'admin2@admin.com', 'login', '2025-03-23 22:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `id_wilayah` int(11) NOT NULL,
  `nama_wilayah` varchar(255) NOT NULL,
  `jenis_wilayah` varchar(50) NOT NULL,
  `luas_wilayah` int(11) NOT NULL,
  `latitude` decimal(20,17) NOT NULL,
  `longitude` decimal(20,17) NOT NULL,
  `batas_utara` varchar(255) NOT NULL,
  `batas_timur` varchar(255) NOT NULL,
  `batas_barat` varchar(255) NOT NULL,
  `batas_selatan` varchar(255) NOT NULL,
  `gambar_wilayah` varchar(255) NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`id_wilayah`, `nama_wilayah`, `jenis_wilayah`, `luas_wilayah`, `latitude`, `longitude`, `batas_utara`, `batas_timur`, `batas_barat`, `batas_selatan`, `gambar_wilayah`, `updated_by`, `updated_at`) VALUES
(1, 'Desa Pasir Bolang', 'Desa', 429, -6.22647991797654200, 106.47184220102415000, '', '', '', '', 'profilwilayah/petakecamatan.png', NULL, NULL),
(2, 'Desa Cisereh', 'Desa', 318, -6.23258393623556000, 106.45836800354205000, '', '', '', '', 'profilwilayah/petakecamatan.png', NULL, NULL),
(3, 'Desa Pasir Nangka', 'Desa', 392, -6.25222566486495700, 106.47206608878156000, '', '', '', '', 'profilwilayah/petakecamatan.png', NULL, NULL),
(4, 'Desa Pematang', 'Desa', 268, -6.25070022721644800, 106.46269611260229000, '', '', '', '', 'profilwilayah/petakecamatan.png', NULL, NULL),
(5, 'Desa Pete', 'Desa', 404, -6.25517574675986050, 106.46014819401702000, '', '', '', '', 'profilwilayah/petakecamatan.png', NULL, NULL),
(6, 'Desa Tegalsari', 'Desa', 356, -6.25950871858672100, 106.44606958089086000, '', '', '', '', 'profilwilayah/petakecamatan.png', NULL, NULL),
(7, 'Desa Mata Gara', 'Desa', 390, -6.25105207832220700, 106.48871237640144000, '', '', '', '', 'profilwilayah/petakecamatan.png', NULL, NULL),
(8, 'Desa Marga Sari', 'Desa', 350, -6.28606598874702700, 106.49771244628573000, '', '', '', '', 'profilwilayah/petakecamatan.png', NULL, NULL),
(9, 'Desa Sodong', 'Desa', 410, -6.28278867934972200, 106.46819138548888000, '', '', '', '', 'profilwilayah/petakecamatan.png', NULL, NULL),
(10, 'Desa Tapos', 'Desa', 355, -6.29491710259832500, 106.47231257584326000, '', '', '', '', 'profilwilayah/petakecamatan.png', NULL, NULL),
(11, 'Desa Bantar Panjang', 'Desa', 578, -6.29560118492594800, 106.45126923990308000, '', '', '', '', 'profilwilayah/petakecamatan.png', NULL, NULL),
(12, 'Desa Cileles', 'Desa', 434, -6.32024263025774100, 106.43198249092904000, '', '', '', '', 'profilwilayah/petakecamatan.png', NULL, NULL),
(13, 'Kecamatan Tigaraksa', 'Kecamatan', 5279, 0.00000000000000000, 0.00000000000000000, '', '', '', '', 'profilwilayah/petakecamatan.png', NULL, NULL),
(14, 'Kelurahan Kadu Agung', 'Kelurahan', 284, -6.26903958048301800, 106.49774425197550000, '', '', '', '', 'profilwilayah/petakecamatan.png', NULL, NULL),
(15, 'Kelurahan Tigaraksa', 'Kelurahan', 311, -6.26416190920571000, 106.43198249092904000, '', '', '', '', 'profilwilayah/petakecamatan.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wisata`
--

CREATE TABLE `wisata` (
  `id_wisata` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `nama_tempat` varchar(255) NOT NULL,
  `keterangan` longtext NOT NULL,
  `gambar_wisata` varchar(255) DEFAULT NULL,
  `latitude` decimal(20,17) DEFAULT NULL,
  `longitude` decimal(20,17) DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wisata`
--

INSERT INTO `wisata` (`id_wisata`, `id_wilayah`, `nama_tempat`, `keterangan`, `gambar_wisata`, `latitude`, `longitude`, `updated_by`, `updated_at`) VALUES
(1, 8, 'Hutan Kota Tigaraksa', 'Hutan Kota Tigaraksa adalah ruang hijau yang terletak di pusat Pemerintahan Kabupaten Tangerang. Hutan kota ini menawarkan pemandangan alam yang asri dan menjadi tempat yang ideal untuk rekreasi dan bersantai. Pengunjung dapat menikmati berjalan-jalan di tengah pepohonan rindang, area piknik, serta berbagai fasilitas olahraga yang disediakan. Hutan Kota Tigaraksa juga berfungsi sebagai paru-paru kota, menyediakan udara segar bagi warga sekitar.', 'wisata/HutanKotaTigaraksa.jpg', -6.27653176143692450, 106.48042897326377000, NULL, NULL),
(2, 6, 'Makam Syekh Mubarok', 'Makan Syekh Mubarok telah dijadikan sebagai destinasi wisata religi oleh Pemerintah Desa Tegalsari, Kecamatan Tigaraksa. Langkah ini diambil untuk memanfaatkan potensi ziarah yang sudah berlangsung sejak lama dan meningkatkan perekonomian masyarakat setempat.\r\n\r\n', 'wisata/MakamSyekhMubarok.jpg', -6.24639994718182000, 106.44647806188415000, NULL, NULL),
(3, 15, 'Taman ide ', 'Taman Ide adalah sebuah kafe dengan konsep taman yang unik, terletak di Perumahan Triraksa Village 2, Kecamatan Tigaraksa, Kabupaten Tangerang. \r\nTempat ini menawarkan suasana outdoor yang asri dengan berbagai spot foto Instagramable, menjadikannya destinasi favorit bagi kaum milenial dan pecinta fotografi. \r\n', 'wisata/TamanIde.jpg', -6.26361653365111300, 106.45856173337036000, NULL, NULL),
(4, 14, 'Tigaraksa Waterboom', 'Tigaraksa Waterboom adalah destinasi wisata air yang populer di Kabupaten Tangerang. Tempat ini menawarkan berbagai wahana air yang menyenangkan untuk keluarga, termasuk kolam renang, perosotan, ember tumpah, dan kolam arus mini. Fasilitas yang tersedia di sini meliputi kamar bilas, toilet, kantin, mushola, dan area parkir yang luas. Tigaraksa Waterboom juga memiliki lifeguard yang berjaga di beberapa titik untuk memastikan keamanan pengunjung, terutama anak-anak. Tiket masuknya terjangkau, dengan harga Rp 25.000 pada hari biasa dan Rp 30.000 pada akhir pekan.', 'wisata/TigaraksaWaterboom.jpg', -6.26238036130619900, 106.49107417326361000, NULL, NULL),
(5, 14, 'Monumen Tigaraksa\r\n\r\n', 'Monumen Tigaraksa adalah tugu yang dibangun untuk mengenang jasa tiga perwira dari Kesultanan Banten. Monumen ini berbentuk tiga orang yang berdiri, terbuat dari material stainless steel dan tembaga, memberikan kesan modern namun tetap sarat dengan nilai sejarah. Monumen ini menjadi simbol perjuangan tiga ksatria yang bernama Aria Yudanegara, Aria Wangsakerta, dan Aria Santika, yang bertugas menyusun baris pertahanan dan perlawanan terhadap penjajah pada masa Kesultanan Banten\r\n\r\n', 'wisata/MonumenTigaraksa.jpg', -6.26207196130332800, 106.48139347326357000, NULL, NULL),
(6, 14, 'Alun Alun Tigaraksa \r\n', 'Alun-Alun Tigaraksa adalah area terbuka yang luas dan menjadi pusat kegiatan masyarakat sekitar. Letaknya tidak jauh dari kantor Pemda Kabupaten Tangerang. Alun-alun ini sering digunakan untuk berbagai kegiatan seperti olahraga, acara komunitas, dan rekreasi keluarga. Pengunjung dapat menikmati suasana yang nyaman dengan berbagai fasilitas seperti area bermain anak, jogging track, dan tempat duduk yang nyaman. Selain itu, alun-alun ini juga menjadi pusat kuliner dengan banyak pedagang yang menjual aneka makanan dan minuman.\r\n', 'wisata/AlunTigaraksa.jpg', -6.27435746141683200, 106.48275507326376000, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id_about`),
  ADD KEY `FK_wilayah` (`id_wilayah`),
  ADD KEY `FK_id_user_updated_by` (`updated_by`);

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `agama_per_wilayah`
--
ALTER TABLE `agama_per_wilayah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_agama` (`id_agama`),
  ADD KEY `fk_agama_id_wilayah` (`id_wilayah`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`),
  ADD KEY `FK_id_wilayah` (`id_wilayah`),
  ADD KEY `FK_berita_id_user_updated` (`updated_by`),
  ADD KEY `FK_berita_id_user_created` (`created_by`);

--
-- Indexes for table `jenis_kegiatan`
--
ALTER TABLE `jenis_kegiatan`
  ADD PRIMARY KEY (`id_jenis_kegiatan`);

--
-- Indexes for table `jenis_kelamin_per_wilayah`
--
ALTER TABLE `jenis_kelamin_per_wilayah`
  ADD KEY `FK_wilayah_jenis_kelamin` (`id_wilayah`),
  ADD KEY `FK_jeniskel_updated_by` (`updated_by`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`),
  ADD KEY `id_wilayah` (`id_wilayah`),
  ADD KEY `id_jenis_kegiatan` (`id_jenis_kegiatan`),
  ADD KEY `fk_kegiatan_updated_by` (`updated_by`);

--
-- Indexes for table `kel_umur_per_wilayah`
--
ALTER TABLE `kel_umur_per_wilayah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_wilayah_kel_umur` (`id_wilayah`),
  ADD KEY `FK_kelUmur_updated` (`updated_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indexes for table `pekerjaan_per_wilayah`
--
ALTER TABLE `pekerjaan_per_wilayah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_wilayah_pekerjaan` (`id_wilayah`),
  ADD KEY `FK_id_pekerjaan` (`id_pekerjaan`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`);

--
-- Indexes for table `pendidikan_per_wilayah`
--
ALTER TABLE `pendidikan_per_wilayah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perangkat_kecamatan`
--
ALTER TABLE `perangkat_kecamatan`
  ADD PRIMARY KEY (`id_perangkat`),
  ADD KEY `FK_wilayah_perangkat_kec` (`id_wilayah`),
  ADD KEY `FK_perangkat_updated` (`updated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `FK_User_id_log` (`user_id`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id_wilayah`),
  ADD KEY `FK_wilayah_updated` (`updated_by`);

--
-- Indexes for table `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id_wisata`),
  ADD KEY `FK_wisata_id_wilayah` (`id_wilayah`),
  ADD KEY `FK_wisata_updated` (`updated_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id_about` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `id_agama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `agama_per_wilayah`
--
ALTER TABLE `agama_per_wilayah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jenis_kegiatan`
--
ALTER TABLE `jenis_kegiatan`
  MODIFY `id_jenis_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kel_umur_per_wilayah`
--
ALTER TABLE `kel_umur_per_wilayah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pekerjaan_per_wilayah`
--
ALTER TABLE `pekerjaan_per_wilayah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pendidikan_per_wilayah`
--
ALTER TABLE `pendidikan_per_wilayah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `perangkat_kecamatan`
--
ALTER TABLE `perangkat_kecamatan`
  MODIFY `id_perangkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id_wilayah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `about_us`
--
ALTER TABLE `about_us`
  ADD CONSTRAINT `FK_id_user_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_wilayah` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`);

--
-- Constraints for table `agama_per_wilayah`
--
ALTER TABLE `agama_per_wilayah`
  ADD CONSTRAINT `FK_id_agama` FOREIGN KEY (`id_agama`) REFERENCES `agama` (`id_agama`),
  ADD CONSTRAINT `fk_agama_id_wilayah` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`);

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `FK_berita_id_user_created` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_berita_id_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_id_wilayah` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`);

--
-- Constraints for table `jenis_kelamin_per_wilayah`
--
ALTER TABLE `jenis_kelamin_per_wilayah`
  ADD CONSTRAINT `FK_jeniskel_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_wilayah_jenis_kelamin` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`);

--
-- Constraints for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `fk_kegiatan_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`) ON DELETE CASCADE,
  ADD CONSTRAINT `kegiatan_ibfk_2` FOREIGN KEY (`id_jenis_kegiatan`) REFERENCES `jenis_kegiatan` (`id_jenis_kegiatan`) ON DELETE CASCADE;

--
-- Constraints for table `kel_umur_per_wilayah`
--
ALTER TABLE `kel_umur_per_wilayah`
  ADD CONSTRAINT `FK_kelUmur_updated` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_id_wilayah_kel_umur` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`);

--
-- Constraints for table `pekerjaan_per_wilayah`
--
ALTER TABLE `pekerjaan_per_wilayah`
  ADD CONSTRAINT `FK_id_pekerjaan` FOREIGN KEY (`id_pekerjaan`) REFERENCES `pekerjaan` (`id_pekerjaan`),
  ADD CONSTRAINT `FK_id_wilayah_pekerjaan` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`);

--
-- Constraints for table `perangkat_kecamatan`
--
ALTER TABLE `perangkat_kecamatan`
  ADD CONSTRAINT `FK_perangkat_updated` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_wilayah_perangkat_kec` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`);

--
-- Constraints for table `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `FK_User_id_log` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD CONSTRAINT `FK_wilayah_updated` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `wisata`
--
ALTER TABLE `wisata`
  ADD CONSTRAINT `FK_wisata_id_wilayah` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`),
  ADD CONSTRAINT `FK_wisata_updated` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
