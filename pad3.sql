-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 10, 2024 at 08:25 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pad3`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_pelanggans`
--

CREATE TABLE `data_pelanggans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_pelanggans`
--

INSERT INTO `data_pelanggans` (`id`, `nama_pelanggan`, `nomor_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(39, 'Yono', '0810000000', 'Jl. Jawa', '2024-05-10 06:41:42', '2024-05-10 06:41:42'),
(40, 'Bayu', '085807290526', 'Jl. Sulawesi', '2024-05-10 06:43:08', '2024-05-10 06:43:08'),
(42, 'asdasdasd', 'asdasdasd', 'dasdasdas', '2024-05-10 06:52:53', '2024-05-10 06:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_produks`
--

CREATE TABLE `jenis_produks` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_produks`
--

INSERT INTO `jenis_produks` (`id`, `jenis_produk`, `created_at`, `updated_at`) VALUES
(1, 'Nutrisi', NULL, '2024-05-09 23:28:51'),
(4, 'Perekat/lem pertanian', '2024-04-23 22:19:41', '2024-05-09 23:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_19_142858_create_data_pelanggans_table', 1),
(6, '2024_03_19_143450_create_produks_table', 1),
(7, '2024_03_19_150008_create_jenis_produks_table', 1),
(8, '2024_03_19_150349_create_status_pesanans_table', 1),
(9, '2024_03_19_150455_create_pesanan_masuks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_masuks`
--

CREATE TABLE `pesanan_masuks` (
  `id` bigint UNSIGNED NOT NULL,
  `produk_id` int NOT NULL,
  `kode_pesanan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelanggan_id` int NOT NULL,
  `harga_produk` int NOT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `qty` int DEFAULT NULL,
  `total_pesanan` int NOT NULL,
  `resi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan_masuks`
--

INSERT INTO `pesanan_masuks` (`id`, `produk_id`, `kode_pesanan`, `pelanggan_id`, `harga_produk`, `tanggal_masuk`, `qty`, `total_pesanan`, `resi`, `created_at`, `updated_at`) VALUES
(50, 6, 'ORD7488686', 39, 32000, '2024-05-10 13:41:05', 2, 64000, NULL, '2024-05-10 06:43:37', '2024-05-10 06:43:37'),
(51, 7, 'ORD7488686', 39, 50000, '2024-05-10 13:41:05', 1, 50000, NULL, '2024-05-10 06:43:37', '2024-05-10 06:43:37'),
(52, 9, 'ORD7488686', 39, 35000, '2024-05-10 13:41:05', 10, 350000, NULL, '2024-05-10 06:43:37', '2024-05-10 06:43:37'),
(53, 7, 'ORD1369800', 40, 50000, '2024-05-10 13:42:16', 100, 5000000, NULL, '2024-05-10 06:43:46', '2024-05-10 06:43:46'),
(54, 6, 'ORD1873463', 42, 32000, '2024-05-10 13:52:45', 1, 32000, NULL, '2024-05-10 06:52:53', '2024-05-10 06:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_user`
--

CREATE TABLE `pesanan_user` (
  `id` int NOT NULL,
  `pelanggan_id` int DEFAULT NULL,
  `kode_pesanan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kode_resi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jasa_kurir` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ongkir` int DEFAULT NULL,
  `bukti_tf` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tanggal_pesan` datetime DEFAULT NULL,
  `status_pesanan` int DEFAULT NULL,
  `total_harga_pesanan` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pesanan_user`
--

INSERT INTO `pesanan_user` (`id`, `pelanggan_id`, `kode_pesanan`, `kode_resi`, `jasa_kurir`, `ongkir`, `bukti_tf`, `tanggal_pesan`, `status_pesanan`, `total_harga_pesanan`, `created_at`, `updated_at`) VALUES
(14, 39, 'ORD7488686', '1919234637198', 'JNT Express', 15000, 'bukti_tf/php.jpg', '2024-05-10 13:41:05', 2, 464000, '2024-05-10 06:41:42', '2024-05-10 06:53:22'),
(15, 40, 'ORD1369800', '475830934587', 'JNE EXPRESS', 12000, 'bukti_tf/peakpx.jpg', '2024-05-10 13:42:16', 2, 5000000, '2024-05-10 06:43:08', '2024-05-10 07:21:08'),
(17, 42, 'ORD1873463', NULL, NULL, NULL, NULL, '2024-05-10 13:52:45', 0, 32000, '2024-05-10 06:52:53', '2024-05-10 07:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis_produk_id` int NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_produk` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `jenis_produk_id`, `nama_produk`, `harga`, `barcode`, `gambar_produk`, `created_at`, `updated_at`) VALUES
(6, 1, 'Java Higros', 32000, 'PRD-687845', 'java.jpg', '2024-05-06 23:46:29', '2024-05-09 23:29:29'),
(7, 1, 'Radix', 50000, 'PRD-859464', 'radix.jpg', '2024-05-08 02:58:42', '2024-05-09 23:29:55'),
(8, 1, 'Java Bloom', 45000, 'PRD-296212', 'bloom.jpg', '2024-05-09 23:30:31', '2024-05-09 23:30:31'),
(9, 1, 'Java Green', 35000, 'PRD-934755', 'green.jpg', '2024-05-09 23:30:55', '2024-05-09 23:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `status_pesanans`
--

CREATE TABLE `status_pesanans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'xubaz', '$2y$10$ic7V.MAWc3YlXNPgtwG1S.0XBedrMU.uHF0LhzKq0LqA/EYo/eaK6', 1, '2024-04-02 06:44:17', '2024-04-02 06:44:17'),
(2, 'admin', '$2y$10$PQVMJDQ3wUHOs2TjQb5O1.CJXBzcVhZHJazTqyK20gpOXEFloR7/W', 1, '2024-04-02 06:45:39', '2024-04-02 06:45:39'),
(3, 'owner', '$2y$12$eu6UBK7tQQhK3oExV3SZbOMysG8nggdb9y0f8ew.ZTsb69I4M06/y', 2, '2024-05-09 01:13:45', '2024-05-09 01:13:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_pelanggans`
--
ALTER TABLE `data_pelanggans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis_produks`
--
ALTER TABLE `jenis_produks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pesanan_masuks`
--
ALTER TABLE `pesanan_masuks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan_user`
--
ALTER TABLE `pesanan_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_pesanans`
--
ALTER TABLE `status_pesanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_pelanggans`
--
ALTER TABLE `data_pelanggans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_produks`
--
ALTER TABLE `jenis_produks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan_masuks`
--
ALTER TABLE `pesanan_masuks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `pesanan_user`
--
ALTER TABLE `pesanan_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `status_pesanans`
--
ALTER TABLE `status_pesanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
