-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2023 at 07:38 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sila`
--

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
-- Table structure for table `klusterisasi`
--

CREATE TABLE `klusterisasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dt_dataset` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`dt_dataset`)),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `dt_parameter` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`dt_parameter`)),
  `dt_perhitungan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`dt_perhitungan`)),
  `iterasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `klusterisasi`
--

INSERT INTO `klusterisasi` (`id`, `dt_dataset`, `created_at`, `updated_at`, `dt_parameter`, `dt_perhitungan`, `iterasi`) VALUES
(1, '[{\"id\":\"91\",\"nama\":\"FAIZAL LEVIANSYAH \",\"kelas\":\"2I\",\"time\":\"11\",\"salah_wr\":14,\"salah_gnd\":14,\"jumlah_gnd_wr\":28,\"nilai\":0},{\"id\":\"98\",\"nama\":\"FARADISHA ALDINA PUTRI\",\"kelas\":\"2I\",\"time\":\"7\",\"salah_wr\":1,\"salah_gnd\":0,\"jumlah_gnd_wr\":1,\"nilai\":0},{\"id\":\"107\",\"nama\":\"GHAITZA RAJAWALI NUSANTARA MUHAMMAD\",\"kelas\":\"2I\",\"time\":\"5\",\"salah_wr\":14,\"salah_gnd\":6,\"jumlah_gnd_wr\":20,\"nilai\":0},{\"id\":\"111\",\"nama\":\"KEITH CAHYAWIYANATA\",\"kelas\":\"2I\",\"time\":\"2\",\"salah_wr\":0,\"salah_gnd\":0,\"jumlah_gnd_wr\":0,\"nilai\":0},{\"id\":\"115\",\"nama\":\"MAYFANA LAURA ABDI\",\"kelas\":\"2I\",\"time\":\"5\",\"salah_wr\":2,\"salah_gnd\":4,\"jumlah_gnd_wr\":6,\"nilai\":0},{\"id\":\"117\",\"nama\":\"MUHAMMAD ADHIKA ISA NUGRAHA \",\"kelas\":\"2I\",\"time\":\"5\",\"salah_wr\":7,\"salah_gnd\":2,\"jumlah_gnd_wr\":9,\"nilai\":0},{\"id\":\"119\",\"nama\":\"MUHAMMAD ASAD\",\"kelas\":\"2I\",\"time\":\"10\",\"salah_wr\":2,\"salah_gnd\":0,\"jumlah_gnd_wr\":2,\"nilai\":0},{\"id\":\"123\",\"nama\":\"MUMTAZ ZAIN ABDULLAH \",\"kelas\":\"2I\",\"time\":\"11\",\"salah_wr\":8,\"salah_gnd\":6,\"jumlah_gnd_wr\":14,\"nilai\":0},{\"id\":\"128\",\"nama\":\"RAIHAN DANY RADHINNUR\",\"kelas\":\"2I\",\"time\":\"2\",\"salah_wr\":1,\"salah_gnd\":4,\"jumlah_gnd_wr\":5,\"nilai\":0},{\"id\":\"131\",\"nama\":\"RAYNOR HERFIAN IQBAL FAWWAZ\",\"kelas\":\"2I\",\"time\":\"1\",\"salah_wr\":2,\"salah_gnd\":0,\"jumlah_gnd_wr\":2,\"nilai\":0},{\"id\":\"134\",\"nama\":\"RHENO RAYHAN FAYYAZ DHANA PRAMUDYA\",\"kelas\":\"2I\",\"time\":\"3\",\"salah_wr\":2,\"salah_gnd\":0,\"jumlah_gnd_wr\":2,\"nilai\":0},{\"id\":\"137\",\"nama\":\"SAEFULLOH FATAH PUTRA KYRANNA\",\"kelas\":\"2I\",\"time\":\"12\",\"salah_wr\":12,\"salah_gnd\":8,\"jumlah_gnd_wr\":20,\"nilai\":0},{\"id\":\"139\",\"nama\":\"SATRIA PANGESTU ADILAMSYAH\",\"kelas\":\"2I\",\"time\":\"8\",\"salah_wr\":8,\"salah_gnd\":6,\"jumlah_gnd_wr\":14,\"nilai\":0},{\"id\":\"140\",\"nama\":\"SEPTIAN FAHMI ARDIANSYAH\",\"kelas\":\"2I\",\"time\":\"2\",\"salah_wr\":1,\"salah_gnd\":0,\"jumlah_gnd_wr\":1,\"nilai\":0},{\"id\":\"141\",\"nama\":\"THORIQ IRFAN FALACH\",\"kelas\":\"2I\",\"time\":\"6\",\"salah_wr\":2,\"salah_gnd\":0,\"jumlah_gnd_wr\":2,\"nilai\":0},{\"id\":\"142\",\"nama\":\"VERSACITTA FEODORA RAMADHANI\",\"kelas\":\"2I\",\"time\":\"7\",\"salah_wr\":10,\"salah_gnd\":16,\"jumlah_gnd_wr\":26,\"nilai\":0},{\"id\":\"143\",\"nama\":\"VINSENSIUS ADE WINATA\",\"kelas\":\"2I\",\"time\":\"7\",\"salah_wr\":5,\"salah_gnd\":4,\"jumlah_gnd_wr\":9,\"nilai\":0}]', NULL, NULL, '{\"pilihan\":[\"time\",\"salah_gnd\",\"salah_wr\"],\"ids\":[\"91\",\"111\"],\"kelas\":[\"2I\"],\"id_lesson\":\"11\"}', '[{\"data\":[{\"id\":\"91\",\"nama\":\"FAIZAL LEVIANSYAH \",\"kelas\":\"2I\",\"time\":\"11\",\"salah_wr\":14,\"salah_gnd\":14,\"jumlah_gnd_wr\":28,\"nilai\":0},{\"id\":\"98\",\"nama\":\"FARADISHA ALDINA PUTRI\",\"kelas\":\"2I\",\"time\":\"7\",\"salah_wr\":1,\"salah_gnd\":0,\"jumlah_gnd_wr\":1,\"nilai\":0},{\"id\":\"107\",\"nama\":\"GHAITZA RAJAWALI NUSANTARA MUHAMMAD\",\"kelas\":\"2I\",\"time\":\"5\",\"salah_wr\":14,\"salah_gnd\":6,\"jumlah_gnd_wr\":20,\"nilai\":0},{\"id\":\"111\",\"nama\":\"KEITH CAHYAWIYANATA\",\"kelas\":\"2I\",\"time\":\"2\",\"salah_wr\":0,\"salah_gnd\":0,\"jumlah_gnd_wr\":0,\"nilai\":0},{\"id\":\"115\",\"nama\":\"MAYFANA LAURA ABDI\",\"kelas\":\"2I\",\"time\":\"5\",\"salah_wr\":2,\"salah_gnd\":4,\"jumlah_gnd_wr\":6,\"nilai\":0},{\"id\":\"117\",\"nama\":\"MUHAMMAD ADHIKA ISA NUGRAHA \",\"kelas\":\"2I\",\"time\":\"5\",\"salah_wr\":7,\"salah_gnd\":2,\"jumlah_gnd_wr\":9,\"nilai\":0},{\"id\":\"119\",\"nama\":\"MUHAMMAD ASAD\",\"kelas\":\"2I\",\"time\":\"10\",\"salah_wr\":2,\"salah_gnd\":0,\"jumlah_gnd_wr\":2,\"nilai\":0},{\"id\":\"123\",\"nama\":\"MUMTAZ ZAIN ABDULLAH \",\"kelas\":\"2I\",\"time\":\"11\",\"salah_wr\":8,\"salah_gnd\":6,\"jumlah_gnd_wr\":14,\"nilai\":0},{\"id\":\"128\",\"nama\":\"RAIHAN DANY RADHINNUR\",\"kelas\":\"2I\",\"time\":\"2\",\"salah_wr\":1,\"salah_gnd\":4,\"jumlah_gnd_wr\":5,\"nilai\":0},{\"id\":\"131\",\"nama\":\"RAYNOR HERFIAN IQBAL FAWWAZ\",\"kelas\":\"2I\",\"time\":\"1\",\"salah_wr\":2,\"salah_gnd\":0,\"jumlah_gnd_wr\":2,\"nilai\":0},{\"id\":\"134\",\"nama\":\"RHENO RAYHAN FAYYAZ DHANA PRAMUDYA\",\"kelas\":\"2I\",\"time\":\"3\",\"salah_wr\":2,\"salah_gnd\":0,\"jumlah_gnd_wr\":2,\"nilai\":0},{\"id\":\"137\",\"nama\":\"SAEFULLOH FATAH PUTRA KYRANNA\",\"kelas\":\"2I\",\"time\":\"12\",\"salah_wr\":12,\"salah_gnd\":8,\"jumlah_gnd_wr\":20,\"nilai\":0},{\"id\":\"139\",\"nama\":\"SATRIA PANGESTU ADILAMSYAH\",\"kelas\":\"2I\",\"time\":\"8\",\"salah_wr\":8,\"salah_gnd\":6,\"jumlah_gnd_wr\":14,\"nilai\":0},{\"id\":\"140\",\"nama\":\"SEPTIAN FAHMI ARDIANSYAH\",\"kelas\":\"2I\",\"time\":\"2\",\"salah_wr\":1,\"salah_gnd\":0,\"jumlah_gnd_wr\":1,\"nilai\":0},{\"id\":\"141\",\"nama\":\"THORIQ IRFAN FALACH\",\"kelas\":\"2I\",\"time\":\"6\",\"salah_wr\":2,\"salah_gnd\":0,\"jumlah_gnd_wr\":2,\"nilai\":0},{\"id\":\"142\",\"nama\":\"VERSACITTA FEODORA RAMADHANI\",\"kelas\":\"2I\",\"time\":\"7\",\"salah_wr\":10,\"salah_gnd\":16,\"jumlah_gnd_wr\":26,\"nilai\":0},{\"id\":\"143\",\"nama\":\"VINSENSIUS ADE WINATA\",\"kelas\":\"2I\",\"time\":\"7\",\"salah_wr\":5,\"salah_gnd\":4,\"jumlah_gnd_wr\":9,\"nilai\":0}],\"centroid_awal\":[{\"id\":\"91\",\"nama\":\"FAIZAL LEVIANSYAH \",\"kelas\":\"2I\",\"time\":\"11\",\"salah_wr\":14,\"salah_gnd\":14,\"jumlah_gnd_wr\":28,\"nilai\":0},{\"id\":\"111\",\"nama\":\"KEITH CAHYAWIYANATA\",\"kelas\":\"2I\",\"time\":\"2\",\"salah_wr\":0,\"salah_gnd\":0,\"jumlah_gnd_wr\":0,\"nilai\":0}],\"jarak\":[[0,21.748563170931547],[19.519221295943137,5.0990195135927845],[10,15.524174696260024],[21.748563170931547,0],[16.73320053068151,5.385164807134504],[15.132745950421556,7.874007874011811],[18.466185312619388,8.246211251235321],[10,13.45362404707371],[18.708286933869708,4.123105625617661],[20.97617696340303,2.23606797749979],[20.09975124224178,2.23606797749979],[6.4031242374328485,17.549928774784245],[10.44030650891055,11.661903789690601],[21.118712081942874,1],[19.1049731745428,4.47213595499958],[6,19.519221295943137],[14.035668847618199,8.12403840463596]],\"hasil_klusterisasi\":[0,1,0,1,1,1,1,0,1,1,1,0,0,1,1,0,1],\"tabel_klusterisasi\":[{\"id\":\"91\",\"nama\":\"FAIZAL LEVIANSYAH \",\"kelas\":\"2I\",\"time\":54,\"salah_wr\":66,\"salah_gnd\":56,\"jumlah_gnd_wr\":28,\"nilai\":0,\"count\":6},{\"id\":\"98\",\"nama\":\"FARADISHA ALDINA PUTRI\",\"kelas\":\"2I\",\"time\":50,\"salah_wr\":25,\"salah_gnd\":14,\"jumlah_gnd_wr\":1,\"nilai\":0,\"count\":11}],\"centroid_baru\":[{\"time\":9,\"salah_gnd\":9.333333333333334,\"salah_wr\":11},{\"time\":4.545454545454546,\"salah_gnd\":1.2727272727272727,\"salah_wr\":2.272727272727273}]},{\"data\":[{\"id\":\"91\",\"nama\":\"FAIZAL LEVIANSYAH \",\"kelas\":\"2I\",\"time\":\"11\",\"salah_wr\":14,\"salah_gnd\":14,\"jumlah_gnd_wr\":28,\"nilai\":0},{\"id\":\"98\",\"nama\":\"FARADISHA ALDINA PUTRI\",\"kelas\":\"2I\",\"time\":\"7\",\"salah_wr\":1,\"salah_gnd\":0,\"jumlah_gnd_wr\":1,\"nilai\":0},{\"id\":\"107\",\"nama\":\"GHAITZA RAJAWALI NUSANTARA MUHAMMAD\",\"kelas\":\"2I\",\"time\":\"5\",\"salah_wr\":14,\"salah_gnd\":6,\"jumlah_gnd_wr\":20,\"nilai\":0},{\"id\":\"111\",\"nama\":\"KEITH CAHYAWIYANATA\",\"kelas\":\"2I\",\"time\":\"2\",\"salah_wr\":0,\"salah_gnd\":0,\"jumlah_gnd_wr\":0,\"nilai\":0},{\"id\":\"115\",\"nama\":\"MAYFANA LAURA ABDI\",\"kelas\":\"2I\",\"time\":\"5\",\"salah_wr\":2,\"salah_gnd\":4,\"jumlah_gnd_wr\":6,\"nilai\":0},{\"id\":\"117\",\"nama\":\"MUHAMMAD ADHIKA ISA NUGRAHA \",\"kelas\":\"2I\",\"time\":\"5\",\"salah_wr\":7,\"salah_gnd\":2,\"jumlah_gnd_wr\":9,\"nilai\":0},{\"id\":\"119\",\"nama\":\"MUHAMMAD ASAD\",\"kelas\":\"2I\",\"time\":\"10\",\"salah_wr\":2,\"salah_gnd\":0,\"jumlah_gnd_wr\":2,\"nilai\":0},{\"id\":\"123\",\"nama\":\"MUMTAZ ZAIN ABDULLAH \",\"kelas\":\"2I\",\"time\":\"11\",\"salah_wr\":8,\"salah_gnd\":6,\"jumlah_gnd_wr\":14,\"nilai\":0},{\"id\":\"128\",\"nama\":\"RAIHAN DANY RADHINNUR\",\"kelas\":\"2I\",\"time\":\"2\",\"salah_wr\":1,\"salah_gnd\":4,\"jumlah_gnd_wr\":5,\"nilai\":0},{\"id\":\"131\",\"nama\":\"RAYNOR HERFIAN IQBAL FAWWAZ\",\"kelas\":\"2I\",\"time\":\"1\",\"salah_wr\":2,\"salah_gnd\":0,\"jumlah_gnd_wr\":2,\"nilai\":0},{\"id\":\"134\",\"nama\":\"RHENO RAYHAN FAYYAZ DHANA PRAMUDYA\",\"kelas\":\"2I\",\"time\":\"3\",\"salah_wr\":2,\"salah_gnd\":0,\"jumlah_gnd_wr\":2,\"nilai\":0},{\"id\":\"137\",\"nama\":\"SAEFULLOH FATAH PUTRA KYRANNA\",\"kelas\":\"2I\",\"time\":\"12\",\"salah_wr\":12,\"salah_gnd\":8,\"jumlah_gnd_wr\":20,\"nilai\":0},{\"id\":\"139\",\"nama\":\"SATRIA PANGESTU ADILAMSYAH\",\"kelas\":\"2I\",\"time\":\"8\",\"salah_wr\":8,\"salah_gnd\":6,\"jumlah_gnd_wr\":14,\"nilai\":0},{\"id\":\"140\",\"nama\":\"SEPTIAN FAHMI ARDIANSYAH\",\"kelas\":\"2I\",\"time\":\"2\",\"salah_wr\":1,\"salah_gnd\":0,\"jumlah_gnd_wr\":1,\"nilai\":0},{\"id\":\"141\",\"nama\":\"THORIQ IRFAN FALACH\",\"kelas\":\"2I\",\"time\":\"6\",\"salah_wr\":2,\"salah_gnd\":0,\"jumlah_gnd_wr\":2,\"nilai\":0},{\"id\":\"142\",\"nama\":\"VERSACITTA FEODORA RAMADHANI\",\"kelas\":\"2I\",\"time\":\"7\",\"salah_wr\":10,\"salah_gnd\":16,\"jumlah_gnd_wr\":26,\"nilai\":0},{\"id\":\"143\",\"nama\":\"VINSENSIUS ADE WINATA\",\"kelas\":\"2I\",\"time\":\"7\",\"salah_wr\":5,\"salah_gnd\":4,\"jumlah_gnd_wr\":9,\"nilai\":0}],\"centroid_awal\":[{\"id\":\"91\",\"nama\":\"FAIZAL LEVIANSYAH \",\"kelas\":\"2I\",\"time\":\"11\",\"salah_wr\":14,\"salah_gnd\":14,\"jumlah_gnd_wr\":28,\"nilai\":0},{\"id\":\"111\",\"nama\":\"KEITH CAHYAWIYANATA\",\"kelas\":\"2I\",\"time\":\"2\",\"salah_wr\":0,\"salah_gnd\":0,\"jumlah_gnd_wr\":0,\"nilai\":0}],\"jarak\":[[6.164414002968976,19.026297590440446],[13.601470508735444,3.3166247903554],[5.830951894845301,13.038404810405298],[15.84297951775486,3],[11.045361017187261,3.1622776601683795],[9,5.196152422706632],[12.767145334803704,6.082762530298219],[4.69041575982343,10.488088481701515],[13.19090595827292,3.7416573867739413],[15.033296378372908,3.1622776601683795],[14.071247279470288,1.4142135623730951],[3.3166247903554,14.594519519326424],[4.358898943540674,8.774964387392123],[15.165750888103101,2.449489742783178],[13.076696830622021,2.23606797749979],[7.3484692283495345,17.26267650163207],[8.06225774829855,5.196152422706632]],\"hasil_klusterisasi\":[0,1,0,1,1,1,1,0,1,1,1,0,0,1,1,0,1],\"tabel_klusterisasi\":[{\"id\":\"91\",\"nama\":\"FAIZAL LEVIANSYAH \",\"kelas\":\"2I\",\"time\":54,\"salah_wr\":66,\"salah_gnd\":56,\"jumlah_gnd_wr\":28,\"nilai\":0,\"count\":6},{\"id\":\"98\",\"nama\":\"FARADISHA ALDINA PUTRI\",\"kelas\":\"2I\",\"time\":50,\"salah_wr\":25,\"salah_gnd\":14,\"jumlah_gnd_wr\":1,\"nilai\":0,\"count\":11}],\"centroid_baru\":[{\"time\":9,\"salah_gnd\":9.333333333333334,\"salah_wr\":11},{\"time\":4.545454545454546,\"salah_gnd\":1.2727272727272727,\"salah_wr\":2.272727272727273}]}]', 2);

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_31_034710_create_klusterisasi_table', 2),
(6, '2023_03_31_042502_create_klusterisasi_table', 3),
(7, '2023_03_31_055733_create_klusterisasi_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `pre_test` int(11) NOT NULL,
  `post_test` int(11) NOT NULL,
  `delay_test` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `nama`, `pre_test`, `post_test`, `delay_test`) VALUES
(1, 'ADINDA RAHAJENG SILVIA PRANESTI', 0, 50, 1),
(2, 'AMINY GHAISAN NURDINIYAH', 0, 60, 1),
(3, 'EKA EVITA ANGGRAINI ', 0, 60, 1),
(4, 'EVAN FADHILAH DZULFIKAR ', 0, 80, 1),
(5, 'FAIZAL LEVIANSYAH ', 0, 30, 1),
(6, 'FARADISHA ALDINA PUTRI', 0, 80, 1),
(7, 'FINA ORVIA NURFADILLAH', 0, 80, 1),
(8, 'GHAITZA RAJAWALI NUSANTARA MUHAMMAD', 0, 80, 1),
(9, 'HAFIZH ZAHRUL IFAZ', 0, 70, 1),
(10, 'KEITH CAHYAWIYANATA', 0, 50, 1),
(11, 'KHAFILLAH AKBAR SYAHPUTRA', 0, 80, 1),
(12, 'MAYFANA LAURA ABDI', 0, 40, 1),
(13, 'MUHAMMAD ASAD', 0, 50, 1),
(14, 'MUHAMMAD FAHMI HUWAIDI', 0, 50, 1),
(15, 'MUMTAZ ZAIN ABDULLAH ', 0, 50, 1),
(16, 'NATASHA DWI PRAMUDITA', 0, 80, 1),
(17, 'RAIHAN DANY RADHINNUR', 0, 60, 1),
(18, 'RAYNOR HERFIAN IQBAL FAWWAZ', 0, 90, 1),
(19, 'RHENO RAYHAN FAYYAZ DHANA PRAMUDYA', 0, 70, 1),
(20, 'SAEFULLOH FATAH PUTRA KYRANNA', 0, 50, 1),
(21, 'SATRIA PANGESTU ADILAMSYAH', 0, 60, 1),
(22, 'SEPTIAN FAHMI ARDIANSYAH', 0, 50, 1),
(23, 'THORIQ IRFAN FALACH', 0, 50, 1),
(24, 'VERSACITTA FEODORA RAMADHANI', 0, 80, 1),
(25, 'VINSENSIUS ADE WINATA', 0, 90, 1),
(26, 'ZERLINA PUTRI WOLLWAGE', 0, 30, 1);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `nama`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin_sila', 'Administrotor_Sila@gmail.com', NULL, 'Administrator SILA', '123', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `klusterisasi`
--
ALTER TABLE `klusterisasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `klusterisasi`
--
ALTER TABLE `klusterisasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
