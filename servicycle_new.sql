-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 15, 2025 at 05:22 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `servicycle_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('servicycle-cache-0286dd552c9bea9a69ecb3759e7b94777635514b', 'i:1;', 1765545976),
('servicycle-cache-0286dd552c9bea9a69ecb3759e7b94777635514b:timer', 'i:1765545976;', 1765545976),
('servicycle-cache-0a57cb53ba59c46fc4b692527a38a87c78d84028', 'i:2;', 1765428335),
('servicycle-cache-0a57cb53ba59c46fc4b692527a38a87c78d84028:timer', 'i:1765428335;', 1765428335),
('servicycle-cache-22d200f8670dbdb3e253a90eee5098477c95c23d', 'i:1;', 1765434627),
('servicycle-cache-22d200f8670dbdb3e253a90eee5098477c95c23d:timer', 'i:1765434627;', 1765434627),
('servicycle-cache-5b384ce32d8cdef02bc3a139d4cac0a22bb029e8', 'i:1;', 1765473697),
('servicycle-cache-5b384ce32d8cdef02bc3a139d4cac0a22bb029e8:timer', 'i:1765473697;', 1765473697),
('servicycle-cache-632667547e7cd3e0466547863e1207a8c0c0c549', 'i:2;', 1765468805),
('servicycle-cache-632667547e7cd3e0466547863e1207a8c0c0c549:timer', 'i:1765468805;', 1765468805),
('servicycle-cache-92cfceb39d57d914ed8b14d0e37643de0797ae56', 'i:1;', 1765543404),
('servicycle-cache-92cfceb39d57d914ed8b14d0e37643de0797ae56:timer', 'i:1765543404;', 1765543404),
('servicycle-cache-972a67c48192728a34979d9a35164c1295401b71', 'i:2;', 1765471937),
('servicycle-cache-972a67c48192728a34979d9a35164c1295401b71:timer', 'i:1765471937;', 1765471937),
('servicycle-cache-98fbc42faedc02492397cb5962ea3a3ffc0a9243', 'i:1;', 1765546123),
('servicycle-cache-98fbc42faedc02492397cb5962ea3a3ffc0a9243:timer', 'i:1765546123;', 1765546123),
('servicycle-cache-af3e133428b9e25c55bc59fe534248e6a0c0f17b', 'i:1;', 1765535176),
('servicycle-cache-af3e133428b9e25c55bc59fe534248e6a0c0f17b:timer', 'i:1765535176;', 1765535176),
('servicycle-cache-b6692ea5df920cad691c20319a6fffd7a4a766b8', 'i:1;', 1765470317),
('servicycle-cache-b6692ea5df920cad691c20319a6fffd7a4a766b8:timer', 'i:1765470317;', 1765470317),
('servicycle-cache-bc33ea4e26e5e1af1408321416956113a4658763', 'i:2;', 1765428391),
('servicycle-cache-bc33ea4e26e5e1af1408321416956113a4658763:timer', 'i:1765428391;', 1765428391),
('servicycle-cache-ca3512f4dfa95a03169c5a670a4c91a19b3077b4', 'i:1;', 1765473965),
('servicycle-cache-ca3512f4dfa95a03169c5a670a4c91a19b3077b4:timer', 'i:1765473965;', 1765473965),
('servicycle-cache-cb4e5208b4cd87268b208e49452ed6e89a68e0b8', 'i:1;', 1765470191),
('servicycle-cache-cb4e5208b4cd87268b208e49452ed6e89a68e0b8:timer', 'i:1765470191;', 1765470191),
('servicycle-cache-cb7a1d775e800fd1ee4049f7dca9e041eb9ba083', 'i:1;', 1765472551),
('servicycle-cache-cb7a1d775e800fd1ee4049f7dca9e041eb9ba083:timer', 'i:1765472551;', 1765472551),
('servicycle-cache-f1f836cb4ea6efb2a0b1b99f41ad8b103eff4b59', 'i:1;', 1765471037),
('servicycle-cache-f1f836cb4ea6efb2a0b1b99f41ad8b103eff4b59:timer', 'i:1765471037;', 1765471037),
('servicycle-cache-fb644351560d8296fe6da332236b1f8d61b2828a', 'i:1;', 1765546290),
('servicycle-cache-fb644351560d8296fe6da332236b1f8d61b2828a:timer', 'i:1765546290;', 1765546290),
('servicycle-cache-fc074d501302eb2b93e2554793fcaf50b3bf7291', 'i:2;', 1765472120),
('servicycle-cache-fc074d501302eb2b93e2554793fcaf50b3bf7291:timer', 'i:1765472120;', 1765472120),
('servicycle-cache-mabrur@mitramaritim.com|127.0.0.1', 'i:2;', 1765428201),
('servicycle-cache-mabrur@mitramaritim.com|127.0.0.1:timer', 'i:1765428201;', 1765428201);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'mabruralmutaqi@gmail.com', 44, '2025-12-10 06:57:10', '2025-12-12 06:27:29');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(12, '0001_01_01_000000_create_users_table', 1),
(13, '0001_01_01_000001_create_cache_table', 1),
(14, '0001_01_01_000002_create_jobs_table', 1),
(15, '2025_12_10_102645_add_role_to_users_table', 1),
(16, '2025_12_10_132728_add_phone_to_users_table', 2),
(17, '2025_12_10_134547_create_customers_table', 3),
(18, '2025_12_10_144634_create_vehicles_table', 4),
(19, '2025_12_11_065305_create_mitras_table', 5),
(20, '2025_12_12_123315_add_uuid_and_slug_to_mitras_table', 6),
(21, '2025_12_14_143147_create_mitra_images_table', 7),
(22, '2025_12_14_163513_add_description_to_mitras_table', 8),
(23, '2025_12_15_152928_add_services_to_mitras_table', 9),
(24, '2025_12_15_162221_add_operational_hours_to_mitras_table', 10),
(25, '2025_12_16_001712_add_payment_method_to_mitras_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `mitras`
--

CREATE TABLE `mitras` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_type` json NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `services` json DEFAULT NULL,
  `operational_hours` json DEFAULT NULL,
  `payment_method` json DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mitras`
--

INSERT INTO `mitras` (`id`, `uuid`, `slug`, `business_name`, `vehicle_type`, `province`, `regency`, `address`, `description`, `services`, `operational_hours`, `payment_method`, `latitude`, `longitude`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(11, '7c32bb98-293b-4a8e-882c-40a0cdc77965', 'bengkel-ban', 'Bengkel Ban', '[\"motor\"]', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'Jl. Central Raya No. 17, Komplek The Centro Town House', 'Bengkel Ban merupakan bengkel yang khusus melayani ganti ban mobil maupun motor. Tidak hanya ban, kami juga menerima servis kendaran ringan seperti ganti oli, ganti bearing, dll.', '[\"ban_motor\", \"ganti_oli\", \"spesialis_lampu\", \"wrapping_sticker\"]', NULL, NULL, 1.1005380, 104.0338030, 0, 45, '2025-12-12 06:30:16', '2025-12-15 09:06:33'),
(13, '30db9188-e132-40a9-9e96-8a99c467bcb6', 'ajo-motor', 'Ajo Motor', '[\"motor\"]', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'Simpang Kara', 'Bengkel ajo motor adalah bengkel motor terpercaya di batam, memiliki lebih dari 200 pelanggan dalam 1 bulan. Sudah beroperasi sejak tahun 2020.', '[\"ban_motor\", \"service_mesin\", \"ganti_oli\", \"accessories\", \"ganti_aki\", \"velg_motor\"]', '{\"friday\": {\"end\": \"23:59\", \"open\": \"1\", \"start\": \"08:00\"}, \"monday\": {\"end\": \"23:59\", \"open\": \"1\", \"start\": \"08:00\"}, \"sunday\": {\"end\": \"23:59\", \"open\": \"1\", \"start\": \"08:00\"}, \"tuesday\": {\"end\": \"23:59\", \"open\": \"1\", \"start\": \"00:00\"}, \"saturday\": {\"end\": \"23:59\", \"open\": \"1\", \"start\": \"08:00\"}, \"thursday\": {\"end\": \"23:59\", \"open\": \"1\", \"start\": \"08:00\"}, \"wednesday\": {\"end\": \"23:59\", \"open\": \"1\", \"start\": \"08:00\"}}', '[\"cash\"]', 1.1305780, 104.0303280, 0, 47, '2025-12-14 09:26:16', '2025-12-15 17:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `mitra_images`
--

CREATE TABLE `mitra_images` (
  `id` bigint UNSIGNED NOT NULL,
  `mitra_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_cover` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mitra_images`
--

INSERT INTO `mitra_images` (`id`, `mitra_id`, `image_path`, `is_cover`, `sort_order`, `created_by`, `created_at`, `updated_at`) VALUES
(43, 11, 'mitra-images/AYK61UonxABSbAdqlm31nfh8EqzefGURedwcvuNU.png', 0, 1, 45, '2025-12-14 09:09:50', '2025-12-14 09:09:50'),
(47, 11, 'mitra-images/FvvBBGBkBPUTjiiZ3nyU1xuXmdO9BbwHpxqNiK2F.jpg', 0, 4, 45, '2025-12-14 09:10:41', '2025-12-14 09:10:41'),
(48, 11, 'mitra-images/TcGygNcSCrQUmU07fHThFWUurwGxlNlANWQv0yvI.png', 0, 2, 45, '2025-12-14 09:11:26', '2025-12-14 09:11:26'),
(52, 11, 'mitra-images/2ZNxJXRVmPkveZzPJO6BfjKhtPpnUOIbeQepKl9j.png', 1, 0, 45, '2025-12-14 09:14:22', '2025-12-14 09:14:22'),
(53, 13, 'mitra-images/8TPmSXPGyXbeztRaYHYrok4K7WDoNO2NQ01t8PVG.png', 1, 0, 47, '2025-12-14 09:31:15', '2025-12-14 09:31:15'),
(54, 13, 'mitra-images/BStU8SSlktLX5FFEOvQ1bN9jSoDXahhbi0meXHIC.png', 0, 1, 47, '2025-12-14 09:32:29', '2025-12-14 09:32:29'),
(55, 11, 'mitra-images/nx6EbbL96D4sgvqWH9bgbEMXe9UFTju3ymTLzZ8N.jpg', 0, 3, 45, '2025-12-15 09:06:58', '2025-12-15 09:06:58');

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('qrsaQhTtaWP67ko2aroqrekDwyVT27s4pMQsPwLh', 47, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibXdTM2wzVW1PeGpjbTBCMHNiSHBaQm9MeFhSNGFjblpqZzRSSHZDQSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9taXRyYS9wcm9maWwvZWRpdCI7czo1OiJyb3V0ZSI7czoxMDoiZWRpdC5taXRyYSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ3O30=', 1765819245);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','customer','mitra') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(43, 'Admin Servicycle', '6285830317840', 'servicycledev@gmail.com', '2025-12-12 06:25:16', '$2y$12$DZpWi8rp0wqu.LWn.93ik.dHqzojHcAZXBVuQYAu9XkqzLOJtOxOa', NULL, 'admin', '2025-12-12 06:24:56', '2025-12-12 06:25:16'),
(44, 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'mabruralmutaqi@gmail.com', '2025-12-12 06:27:43', '$2y$12$H5xjw7ntfQmdGptwvz4kFOY/nQLcoTxk4p5MCEFo.hlVfBlAIVnvS', NULL, 'customer', '2025-12-12 06:27:29', '2025-12-12 06:27:43'),
(45, 'Almutaqi', '628566533937', 'almutaqi6@gmail.com', '2025-12-12 06:30:30', '$2y$12$3/TjSn61hcXD.zDHoYmnHOQTzyyuJYaWeS/6s3Ib7waXYMW65UWzy', NULL, 'mitra', '2025-12-12 06:30:16', '2025-12-12 06:30:30'),
(47, 'Mabrural', '628127744282', 'mabrural814@gmail.com', NULL, '$2y$12$TSg56w4AAambPVvs4yqbhOJMY5vEtOFxng3Jo8B7BBo0AqbdRv9M2', NULL, 'mitra', '2025-12-14 09:26:16', '2025-12-14 09:26:16');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `vehicle_type` enum('motor','mobil') COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` year NOT NULL,
  `plate_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kilometer` int DEFAULT NULL,
  `masa_berlaku_stnk` date DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `customer_id`, `vehicle_type`, `brand`, `model`, `tahun`, `plate_number`, `kilometer`, `masa_berlaku_stnk`, `created_by`, `created_at`, `updated_at`) VALUES
(27, 1, 'motor', 'Honda', 'Scoopy', '2025', 'BP6043GQ', 20, NULL, NULL, '2025-12-10 10:54:43', '2025-12-12 06:28:57'),
(28, 1, 'mobil', 'Tesla', 'Cybertruck', '2025', 'BP1104HA', 10, '2025-12-11', NULL, '2025-12-10 10:55:53', '2025-12-12 06:28:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD KEY `customers_created_by_foreign` (`created_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
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
  ADD UNIQUE KEY `mitras_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `mitras_slug_unique` (`slug`),
  ADD KEY `mitras_created_by_foreign` (`created_by`);

--
-- Indexes for table `mitra_images`
--
ALTER TABLE `mitra_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mitra_images_mitra_id_foreign` (`mitra_id`),
  ADD KEY `mitra_images_created_by_foreign` (`created_by`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicles_plate_number_unique` (`plate_number`),
  ADD KEY `vehicles_customer_id_foreign` (`customer_id`),
  ADD KEY `vehicles_created_by_foreign` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `mitras`
--
ALTER TABLE `mitras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mitra_images`
--
ALTER TABLE `mitra_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `mitras`
--
ALTER TABLE `mitras`
  ADD CONSTRAINT `mitras_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mitra_images`
--
ALTER TABLE `mitra_images`
  ADD CONSTRAINT `mitra_images_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mitra_images_mitra_id_foreign` FOREIGN KEY (`mitra_id`) REFERENCES `mitras` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vehicles_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
