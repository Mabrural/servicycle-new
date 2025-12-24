-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 24, 2025 at 12:12 PM
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
('servicycle-cache-aldo@gmail.com|127.0.0.1', 'i:1;', 1766507551),
('servicycle-cache-aldo@gmail.com|127.0.0.1:timer', 'i:1766507551;', 1766507551),
('servicycle-cache-rendi@gmail.com|172.20.10.5', 'i:1;', 1766568399),
('servicycle-cache-rendi@gmail.com|172.20.10.5:timer', 'i:1766568399;', 1766568399);

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
(1, 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'mabruralmutaqi@gmail.com', 44, '2025-12-10 06:57:10', '2025-12-12 06:27:29'),
(4, 'roni', '628117733232', 'roni@gmail.com', NULL, '2025-12-23 16:20:46', '2025-12-23 16:29:16'),
(5, 'aldo', '62812128181818', 'aldo@gmail.com', 50, '2025-12-23 16:31:48', '2025-12-23 16:31:48'),
(6, 'aldi', '6281212002020', 'aldi@gmail.com', 51, '2025-12-23 16:32:12', '2025-12-23 16:32:12'),
(7, 'yuda', '6281929291010', 'yuda@gmaill.com', 52, '2025-12-23 16:32:35', '2025-12-23 16:32:35'),
(8, 'yudi', '6281322113344', 'yudi@gmail.com', 53, '2025-12-23 16:32:56', '2025-12-23 16:32:56'),
(9, 'vani', '6287710102939', 'vani@gmail.com', 54, '2025-12-23 16:33:38', '2025-12-23 16:33:38'),
(10, 'lilis', '6285312129089', 'lis@gmail.com', 55, '2025-12-23 16:34:00', '2025-12-23 16:34:00'),
(11, 'surya', '6281919303019', 'surya@gmail.com', 56, '2025-12-23 16:34:18', '2025-12-23 16:34:18'),
(12, 'rani', '6281900291001', 'rani@gmail.com', 57, '2025-12-23 16:34:52', '2025-12-23 16:34:52'),
(13, 'nunuk', '6281920201819', 'nunuk@gmail.com', 58, '2025-12-23 16:35:12', '2025-12-23 16:35:12'),
(14, 'niki', '6281799291010', 'niki@gmail.com', 59, '2025-12-23 16:35:29', '2025-12-23 16:35:29'),
(15, 'wahyu', '6281722119090', 'wahyu@gmail.com', 60, '2025-12-23 16:35:55', '2025-12-23 16:35:55'),
(16, 'bambang', '6281199201747', 'bam@gmail.com', 61, '2025-12-23 16:36:23', '2025-12-23 16:36:23'),
(17, 'rita', '62819203399', 'rita@gmail.com', 62, '2025-12-23 16:36:48', '2025-12-23 16:36:48'),
(18, 'danil', '62877182929100', 'danil@gmail.com', 63, '2025-12-23 16:37:14', '2025-12-23 16:37:14'),
(19, 'ririn', '6281799102020', 'ririn@gmail.com', 64, '2025-12-23 16:37:37', '2025-12-23 16:37:37'),
(20, 'jaya', '6281920201010', 'jay@gmail.com', 65, '2025-12-23 16:38:03', '2025-12-23 16:38:03'),
(21, 'lia', '6281290102929', 'lia@gmail.com', 66, '2025-12-23 16:38:30', '2025-12-23 16:38:30'),
(22, 'Angga', '628771234889', 'angga@gmail.com', 68, '2025-12-24 09:50:06', '2025-12-24 10:30:14');

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
(25, '2025_12_16_001712_add_payment_method_to_mitras_table', 11),
(26, '2025_12_16_002751_add_facilities_to_mitras_table', 12),
(30, '2025_12_16_232713_create_service_orders_table', 13);

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
  `facilities` json DEFAULT NULL,
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

INSERT INTO `mitras` (`id`, `uuid`, `slug`, `business_name`, `vehicle_type`, `province`, `regency`, `address`, `description`, `services`, `operational_hours`, `payment_method`, `facilities`, `latitude`, `longitude`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(11, '7c32bb98-293b-4a8e-882c-40a0cdc77965', 'bengkel-ban', 'Bengkel Ban', '[\"motor\"]', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'Jl. Central Raya No. 17, Komplek The Centro Town House', 'Bengkel Ban merupakan bengkel yang khusus melayani ganti ban mobil maupun motor. Tidak hanya ban, kami juga menerima servis kendaran ringan seperti ganti oli, ganti bearing, dll.', '[\"ban_motor\", \"ganti_oli\", \"spesialis_lampu\", \"wrapping_sticker\"]', '{\"friday\": {\"end\": null, \"open\": \"0\", \"start\": null}, \"monday\": {\"end\": null, \"open\": \"0\", \"start\": null}, \"sunday\": {\"end\": null, \"open\": \"0\", \"start\": null}, \"tuesday\": {\"end\": null, \"open\": \"0\", \"start\": null}, \"saturday\": {\"end\": null, \"open\": \"0\", \"start\": null}, \"thursday\": {\"end\": null, \"open\": \"0\", \"start\": null}, \"wednesday\": {\"end\": \"21:00\", \"open\": \"1\", \"start\": \"08:00\"}}', NULL, NULL, 1.0463500, 103.9715540, 1, 45, '2025-12-12 06:30:16', '2025-12-24 09:44:45'),
(13, '30db9188-e132-40a9-9e96-8a99c467bcb6', 'ajo-motor', 'Ajo Motor', '[\"motor\"]', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'Simpang Kara', 'Bengkel ajo motor adalah bengkel motor terpercaya di batam, memiliki lebih dari 200 pelanggan dalam 1 bulan. Sudah beroperasi sejak tahun 2020.', '[\"ban_motor\", \"cuci_motor\", \"service_mesin\", \"ganti_oli\", \"accessories\", \"ganti_aki\", \"velg_motor\"]', '{\"friday\": {\"end\": \"23:59\", \"open\": \"1\", \"start\": \"08:00\"}, \"monday\": {\"end\": \"23:59\", \"open\": \"1\", \"start\": \"08:00\"}, \"sunday\": {\"end\": \"23:59\", \"open\": \"0\", \"start\": \"08:00\"}, \"tuesday\": {\"end\": \"23:59\", \"open\": \"1\", \"start\": \"00:00\"}, \"saturday\": {\"end\": \"23:59\", \"open\": \"1\", \"start\": \"08:00\"}, \"thursday\": {\"end\": \"23:59\", \"open\": \"1\", \"start\": \"08:00\"}, \"wednesday\": {\"end\": \"23:59\", \"open\": \"1\", \"start\": \"00:00\"}}', '[\"cash\"]', '[\"waiting_room_ac\"]', 1.1305780, 104.0303280, 1, 47, '2025-12-14 09:26:16', '2025-12-23 17:00:17');

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
-- Table structure for table `service_orders`
--

CREATE TABLE `service_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mitra_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `vehicle_id` bigint UNSIGNED DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `order_type` enum('online','walk_in') COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_type_manual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_brand_manual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_model_manual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_plate_manual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_complain` text COLLATE utf8mb4_unicode_ci,
  `diagnosed_problem` text COLLATE utf8mb4_unicode_ci,
  `estimated_cost` decimal(10,2) DEFAULT NULL,
  `final_cost` decimal(10,2) DEFAULT NULL,
  `queue_number` int DEFAULT NULL,
  `status` enum('pending','accepted','rejected','checked_in','waiting','in_progress','done','picked_up','no_show','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `qr_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checked_in_at` timestamp NULL DEFAULT NULL,
  `check_in_deadline` timestamp NULL DEFAULT NULL,
  `accepted_at` timestamp NULL DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `finished_at` timestamp NULL DEFAULT NULL,
  `picked_up_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_orders`
--

INSERT INTO `service_orders` (`id`, `uuid`, `mitra_id`, `customer_id`, `vehicle_id`, `created_by`, `order_type`, `vehicle_type_manual`, `vehicle_brand_manual`, `vehicle_model_manual`, `vehicle_plate_manual`, `customer_name`, `customer_phone`, `customer_complain`, `diagnosed_problem`, `estimated_cost`, `final_cost`, `queue_number`, `status`, `qr_token`, `checked_in_at`, `check_in_deadline`, `accepted_at`, `started_at`, `finished_at`, `picked_up_at`, `created_at`, `updated_at`) VALUES
(12, '78bbd03b-718d-4f88-8375-422bb46dc31b', 13, NULL, 27, 44, 'online', NULL, NULL, NULL, NULL, 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'oli', NULL, NULL, NULL, NULL, 'accepted', 'f05f1fe8-4d64-46cb-a59d-cc8f10c9766d', NULL, '2025-12-23 04:43:07', '2025-12-23 03:43:07', '2025-12-23 03:38:09', NULL, NULL, '2025-12-23 03:17:56', '2025-12-23 03:43:07'),
(13, '778ad164-2e67-4bcd-8d36-219f502dc901', 13, NULL, 27, 44, 'online', NULL, NULL, NULL, NULL, 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'asdsa', NULL, NULL, NULL, NULL, 'pending', 'c8ca465b-bf34-4b77-8302-c97b7bb4e794', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-23 04:22:10', '2025-12-23 04:22:10'),
(14, '3e5762b6-3f3f-45c4-8a2f-a3018d56e33e', 13, NULL, 28, 44, 'online', NULL, 'Tesla', 'Cybertruck', 'BP1104HA', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'berisik', NULL, NULL, NULL, NULL, 'pending', 'a882d217-a16d-4d3c-a166-f5b7131c65ca', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-23 04:34:06', '2025-12-23 04:34:06'),
(15, '4c766794-1561-4ef0-b296-e64efad922b4', 13, NULL, 28, 44, 'online', 'mobil', 'Tesla', 'Cybertruck', 'BP1104HA', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'rem', NULL, NULL, NULL, NULL, 'pending', '00f51175-9992-4672-8857-a4a6f329b68b', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-23 04:39:44', '2025-12-23 04:39:44'),
(16, 'd7263449-d099-467b-978f-8502f9ebd188', 13, 1, 27, 44, 'online', 'motor', 'Honda', 'Scoopy', 'BP6043GQ', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'ganti ban', NULL, NULL, NULL, NULL, 'cancelled', '8a036b37-91e7-480d-be4a-e554f5d36954', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-23 04:55:14', '2025-12-24 11:39:32'),
(17, '075ffe2c-4120-4143-aa64-7913882569b5', 13, 1, 27, 44, 'online', 'motor', 'Honda', 'Scoopy', 'BP6043GQ', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'tune up', NULL, NULL, NULL, NULL, 'cancelled', '87916202-19b8-432c-890d-6e9595690e37', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-23 05:04:14', '2025-12-24 11:39:28'),
(18, '34307b28-32f3-4218-b09b-36732ab097d0', 13, 1, 28, 44, 'online', 'mobil', 'Tesla', 'Cybertruck', 'BP1104HA', 'Muhammad Mabrur Al Mutaqi', '6282178192938', '-', NULL, NULL, NULL, NULL, 'cancelled', '0c22aa38-6011-4c15-8456-372c7e2a61ac', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-23 05:11:24', '2025-12-24 11:39:18'),
(19, 'f076cf38-c424-4a53-85a0-1ac10103bd15', 13, 1, 27, 44, 'online', 'motor', 'Honda', 'Scoopy', 'BP6043GQ', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'ganti ban', NULL, NULL, NULL, NULL, 'rejected', '35c0598c-a67e-4f6e-b672-6c05664fe8c0', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-23 05:23:01', '2025-12-24 10:56:10'),
(20, '7425873f-8d83-4489-acc3-cb205b848e7b', 13, 1, 27, 44, 'online', 'motor', 'Honda', 'Scoopy', 'BP6043GQ', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'aasas', '-', NULL, 70000.00, 3, 'done', '088d46ec-cedd-400f-8a5c-25a54b7aa64e', '2025-12-24 04:16:53', '2025-12-24 05:16:28', '2025-12-24 04:16:28', '2025-12-24 09:24:41', '2025-12-24 09:24:52', NULL, '2025-12-23 05:24:05', '2025-12-24 09:24:52'),
(21, 'bdacc6ff-eb58-450c-a224-a1e7384acb2a', 13, 1, 27, 44, 'online', 'motor', 'Honda', 'Scoopy', 'BP6043GQ', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'aaa', 'GANTI OLI', NULL, 80000.00, 1, 'done', '1d12e0e0-55b2-4989-bb24-10ab3a1026d3', '2025-12-24 04:13:12', '2025-12-23 07:15:52', '2025-12-23 06:15:52', '2025-12-24 09:23:49', '2025-12-24 09:24:05', NULL, '2025-12-23 05:28:21', '2025-12-24 09:24:05'),
(22, '51993a01-d0f4-4e7e-8a76-9cb61142b404', 13, 1, 28, 44, 'online', 'mobil', 'Tesla', 'Cybertruck', 'BP1104HA', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'ganti bumper', '-', NULL, 100000.00, 1, 'done', 'd7904560-8ca5-4d08-97bc-97c6df1ca65c', '2025-12-23 21:03:09', '2025-12-23 06:40:20', '2025-12-23 05:40:20', '2025-12-24 03:47:01', '2025-12-24 03:47:16', NULL, '2025-12-23 05:32:42', '2025-12-24 03:47:16'),
(23, '10e24fc4-81ea-474d-af4e-930f5212aeab', 13, 1, 27, 44, 'online', 'motor', 'Honda', 'Scoopy', 'BP6043GQ', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'asdasd', NULL, NULL, NULL, NULL, 'rejected', '3019cf8e-aa40-4371-b485-fb52dc689b5e', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-23 08:57:14', '2025-12-23 21:11:28'),
(24, '3576a60d-6434-4dbc-b936-9af739db0288', 13, 1, 27, 44, 'online', 'motor', 'Honda', 'Scoopy', 'BP6043GQ', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'asdasd', '-', NULL, 90000.00, 2, 'done', '00799ced-2c45-4ab6-861b-fb22c502a996', '2025-12-23 20:24:02', '2025-12-23 21:22:14', '2025-12-23 20:22:14', '2025-12-23 20:34:12', '2025-12-23 20:34:24', NULL, '2025-12-23 09:00:10', '2025-12-23 20:34:24'),
(27, 'd47686e1-664d-4070-84d0-bfdfcc6b891d', 13, 19, 32, 64, 'online', 'motor', 'Honda', 'Beat', 'BP1100YU', 'ririn', '6281799102020', 'ganti oli', 'terdapat bearing goyang yang sudah diperbaiki di roda depan', NULL, 150000.00, 1, 'done', 'b1311dff-9eda-4bec-a6ae-526ef14b820e', '2025-12-23 19:54:19', '2025-12-23 20:52:43', '2025-12-23 19:52:43', '2025-12-23 20:05:31', '2025-12-23 20:06:26', NULL, '2025-12-23 19:52:06', '2025-12-23 20:06:26'),
(28, '0efa4e7c-1a41-4f1f-b065-cab9eb3fbb1a', 13, 19, 32, 64, 'online', 'motor', 'Honda', 'Beat', 'BP1100YU', 'ririn', '6281799102020', 'ganti air radiator', '-', NULL, 200000.00, 1, 'done', '515bfbcd-934a-4ce4-8dba-890d28f5f7c8', '2025-12-23 20:20:46', '2025-12-23 21:12:56', '2025-12-23 20:12:56', '2025-12-23 20:29:48', '2025-12-23 20:30:00', NULL, '2025-12-23 20:09:02', '2025-12-23 20:30:00'),
(29, 'c2170258-1bd7-42f7-b48b-ef1f7723257c', 13, 19, 32, 64, 'online', 'motor', 'Honda', 'Beat', 'BP1100YU', 'ririn', '6281799102020', 'ganti busi', 'tidak ada masalah', NULL, 10000.00, 1, 'done', '20a68ff6-5655-4013-ae30-4f5e4138a7fa', '2025-12-23 20:54:10', '2025-12-23 21:35:27', '2025-12-23 20:35:27', '2025-12-23 20:56:11', '2025-12-23 20:56:25', NULL, '2025-12-23 20:35:13', '2025-12-23 20:56:25'),
(30, 'ae607cef-b3f4-480f-a001-77539d95243f', 13, 19, 32, 64, 'online', 'motor', 'Honda', 'Beat', 'BP1100YU', 'ririn', '6281799102020', 'tidak ada keluhan cuman mau servis rutin', '-', NULL, 200000.00, 2, 'done', 'e877ee8e-640f-4a5c-ba97-2dd5bdc3b7b7', '2025-12-23 20:58:32', '2025-12-23 21:57:17', '2025-12-23 20:57:17', '2025-12-24 03:48:01', '2025-12-24 03:48:19', NULL, '2025-12-23 20:57:05', '2025-12-24 03:48:19'),
(31, 'af5b131f-133a-4a40-84f7-ec7dac4070f0', 13, 20, 33, 65, 'online', 'motor', 'Honda', 'CB150R', 'F1239GG', 'jaya', '6281920201010', 'ganti bearing', 'bearing roda depan ganti', NULL, 80000.00, 2, 'done', '745a1fc8-8176-4f00-8215-c1cfa7df5130', '2025-12-24 05:15:49', '2025-12-24 06:13:24', '2025-12-24 05:13:24', '2025-12-24 09:24:13', '2025-12-24 09:24:33', NULL, '2025-12-24 05:13:14', '2025-12-24 09:24:33'),
(32, '395dbb71-b316-4dae-a52f-8b5baf866629', 11, 1, 27, 44, 'online', 'motor', 'Honda', 'Scoopy', 'BP6043GQ', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'ganti oli', 'tidak ada masalah', NULL, 90000.00, 1, 'done', 'da93dafa-6267-44cc-8f06-d326e9393cb0', '2025-12-24 09:45:57', '2025-12-24 10:45:30', '2025-12-24 09:45:30', '2025-12-24 09:50:43', '2025-12-24 09:50:57', NULL, '2025-12-24 09:45:01', '2025-12-24 09:50:57'),
(34, '632a7920-19d1-4077-b6d9-92e6dae88744', 11, 22, NULL, 45, 'walk_in', 'motor', 'Yamaha', 'Mio 125', 'BP60420GQ', 'Angga', '628771234889', 'ganti oli', 'tidak ada', NULL, 90000.00, 2, 'done', '25fe8867-98c7-44e6-abd4-d5b617275dd6', NULL, NULL, NULL, '2025-12-24 09:51:19', '2025-12-24 09:51:34', NULL, '2025-12-24 09:50:06', '2025-12-24 09:51:34'),
(36, '5c80fb75-6ca6-4e1e-a635-d96a6309c68d', 13, 22, 34, 68, 'online', 'motor', 'Yamaha', 'Mio M3', 'BP1230IO', 'Angga', '628771234889', 'ganti oli', 'bearing roda depan goyang tapi belum diganti', NULL, 90000.00, 1, 'done', '6b49b065-2d85-42af-b4e3-e68a9d351faa', '2025-12-24 10:35:42', '2025-12-24 11:35:06', '2025-12-24 10:35:06', '2025-12-24 10:36:11', '2025-12-24 10:36:47', NULL, '2025-12-24 10:34:54', '2025-12-24 10:36:47'),
(37, 'd008fcdc-2c15-48b5-b4ee-09f6b3d3fe3c', 13, 1, 27, 44, 'online', 'motor', 'Honda', 'Scoopy', 'BP6043GQ', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'ganti oli', NULL, NULL, NULL, NULL, 'cancelled', '546a0057-56ce-4fa5-a736-eb849310c0f0', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-24 11:48:04', '2025-12-24 11:48:27'),
(38, '4151a03e-f4aa-4bf1-8200-4daadcb981a7', 13, 1, 27, 44, 'online', 'motor', 'Honda', 'Scoopy', 'BP6043GQ', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'ganti jok', NULL, NULL, NULL, NULL, 'no_show', '04997853-0a32-49ff-acda-9aac922cff6b', NULL, '2025-12-24 12:50:55', '2025-12-24 11:50:55', NULL, NULL, NULL, '2025-12-24 11:49:35', '2025-12-24 12:01:39');

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
('6s3l7jSm82KPgix3RgGcWMv7QtxMIoXyqJvsjpDK', 47, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV29GdjI5Q0pWMFlYa3ZDNWhJOGtxMjRrSWZlNGV4dzl1akh2SktoMSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sYXBvcmFuLWJlbmdrZWwiO3M6NToicm91dGUiO3M6MTU6ImxhcG9yYW4uYmVuZ2tlbCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ3O30=', 1766578240),
('8Rhs85Xy4NNsjLqh5tR74wYyHvlkLvqFYOrxo02M', 44, '172.20.10.5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVjh2Z1JzZ1haTzU0QXRNdjZhTGN6eE9FTVJkWElnVXRLUWRZSDJwOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xNzIuMjAuMTAuNTo4MDAwL2Mvc2VydmlzLXNheWEiO3M6NToicm91dGUiO3M6MTA6ImJvb2tpbmcubXkiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0NDt9', 1766576378),
('NqE1HBLoVqn8pNlGg7gLk6n7oho6yPaRIO5ZVtP0', 44, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY09xZmZzOXVnMk9qSVJiUzVxSVhiVFhuakpGOVVuTnlvbU9WWEJxUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jL3NlcnZpcy1zYXlhIjtzOjU6InJvdXRlIjtzOjEwOiJib29raW5nLm15Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDQ7fQ==', 1766577854);

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
(44, 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'mabruralmutaqi@gmail.com', '2025-12-12 06:27:43', '$2y$12$X4mrOCeV7TkZg1bN7LpGLOQENfXX.MO/DNdpTld0WtLqZ5OpCdjF.', NULL, 'customer', '2025-12-12 06:27:29', '2025-12-24 05:02:45'),
(45, 'Almutaqi', '628566533937', 'almutaqi6@gmail.com', '2025-12-12 06:30:30', '$2y$12$3/TjSn61hcXD.zDHoYmnHOQTzyyuJYaWeS/6s3Ib7waXYMW65UWzy', NULL, 'mitra', '2025-12-12 06:30:16', '2025-12-12 06:30:30'),
(47, 'Mabrural', '628127744282', 'mabrural814@gmail.com', NULL, '$2y$12$TSg56w4AAambPVvs4yqbhOJMY5vEtOFxng3Jo8B7BBo0AqbdRv9M2', NULL, 'mitra', '2025-12-14 09:26:16', '2025-12-23 16:20:03'),
(50, 'aldo', '62812128181818', 'aldo@gmail.com', NULL, '$2y$12$XknvabO5GqtMZz5lEL4eQ.QgOltn.mKG5DE4lQ3YAr7.dqRydzhJy', NULL, 'customer', '2025-12-23 16:31:48', '2025-12-23 16:31:48'),
(51, 'aldi', '6281212002020', 'aldi@gmail.com', NULL, '$2y$12$fq2LRXe5gmCOJxB4WBytD.sLE09qUdvoea691kaSwjzsgCaorXn26', NULL, 'customer', '2025-12-23 16:32:12', '2025-12-23 16:32:12'),
(52, 'yuda', '6281929291010', 'yuda@gmaill.com', NULL, '$2y$12$8mLwLlybkSxgAOMAD8vOEOjZn0myGtSo9fSAyNPskTRxpnZP7Oajq', NULL, 'customer', '2025-12-23 16:32:34', '2025-12-23 16:32:34'),
(53, 'yudi', '6281322113344', 'yudi@gmail.com', NULL, '$2y$12$7NKqCa7VcevzXkiWgJg8Nean44Z9HhSdpWst65OR4yssMTAuvIrVK', NULL, 'customer', '2025-12-23 16:32:56', '2025-12-23 16:32:56'),
(54, 'vani', '6287710102939', 'vani@gmail.com', NULL, '$2y$12$nL7kIGooeXnHuu.i0RTNtehMlhDTkwqzjlA6Xznou9pW2XuE5fnEy', NULL, 'customer', '2025-12-23 16:33:38', '2025-12-23 16:33:38'),
(55, 'lilis', '6285312129089', 'lis@gmail.com', NULL, '$2y$12$rw0Ihti7fvVf9sCPsR0PwueaUYoB6d2x7HL3TkN.A13v7fVD0Nv6y', NULL, 'customer', '2025-12-23 16:34:00', '2025-12-23 16:34:00'),
(56, 'surya', '6281919303019', 'surya@gmail.com', NULL, '$2y$12$jzjRgg.mFpW66cW6dag/AutOitBE5yPvLecJ/oc/XuELQ6OAt.yKa', NULL, 'customer', '2025-12-23 16:34:18', '2025-12-23 16:34:18'),
(57, 'rani', '6281900291001', 'rani@gmail.com', NULL, '$2y$12$ntC5uLMRa4c918Hul6Ntq.iPchfTex1kSglUk4Ya6mVlyVkD9e1Cy', NULL, 'customer', '2025-12-23 16:34:52', '2025-12-23 16:34:52'),
(58, 'nunuk', '6281920201819', 'nunuk@gmail.com', NULL, '$2y$12$j2PWfgF78ZfhpckVYi6X7udDixJX/Vy6RIhraFpbUtEefC1GD7QLK', NULL, 'customer', '2025-12-23 16:35:12', '2025-12-23 16:35:12'),
(59, 'niki', '6281799291010', 'niki@gmail.com', NULL, '$2y$12$oW1w/o.c4TC6ITvQb3IimeaA3VXj/9ctfnBDe1dM0wi5AATB5gQ5m', NULL, 'customer', '2025-12-23 16:35:29', '2025-12-23 16:35:29'),
(60, 'wahyu', '6281722119090', 'wahyu@gmail.com', NULL, '$2y$12$CDN.dfLGRKSXXY9mWaH9Z.3E21tTkSod6UPczvlgLCXr0NshKMZPm', NULL, 'customer', '2025-12-23 16:35:55', '2025-12-23 16:35:55'),
(61, 'bambang', '6281199201747', 'bam@gmail.com', NULL, '$2y$12$ZJki9GO0dNJUSZaSXtqsVOBBsaldgUuak2eQkr3iL8/yUD1G8z1uC', NULL, 'customer', '2025-12-23 16:36:23', '2025-12-23 16:36:23'),
(62, 'rita', '62819203399', 'rita@gmail.com', NULL, '$2y$12$/GkPDMilGCsbulNM6BMHReXp9Z.NQ1kzzL9gL2QnxmBVPvAfb41Dm', NULL, 'customer', '2025-12-23 16:36:48', '2025-12-23 16:36:48'),
(63, 'danil', '62877182929100', 'danil@gmail.com', NULL, '$2y$12$Vrmk7iSM9q9QENi5T2Le2eD2YFTgATe8zEFoM4o1uk3FiWMbYQw7C', NULL, 'customer', '2025-12-23 16:37:14', '2025-12-23 16:37:14'),
(64, 'ririn', '6281799102020', 'ririn@gmail.com', NULL, '$2y$12$rpHnLnwdwFvH3CJNE.qUaeAQXfhPdywGQwC876kwO4W/byUPbl8Y2', NULL, 'customer', '2025-12-23 16:37:37', '2025-12-23 16:37:37'),
(65, 'jaya', '6281920201010', 'jay@gmail.com', NULL, '$2y$12$81BSYVPeSMRPTOsw7ZDRa.xXe/PFXSaJm/qemYHOmVBOgVO8Z4w0m', NULL, 'customer', '2025-12-23 16:38:03', '2025-12-23 16:38:03'),
(66, 'lia', '6281290102929', 'lia@gmail.com', NULL, '$2y$12$eoqmpemT.zfU488.zYlUgO1bqPkC5FGhIP47hjo9t0AMlY8FUD9KS', NULL, 'customer', '2025-12-23 16:38:30', '2025-12-23 16:38:30'),
(68, 'Angga', '628771234889', 'angga@gmail.com', NULL, '$2y$12$9uYCcKx3i.BFKCXLbXob0.Zp1BahpwCvVY3hxkbb/z0E2mijO85jS', NULL, 'customer', '2025-12-24 10:30:14', '2025-12-24 10:30:14');

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
(28, 1, 'mobil', 'Tesla', 'Cybertruck', '2025', 'BP1104HA', 10, '2025-12-11', NULL, '2025-12-10 10:55:53', '2025-12-12 06:28:48'),
(32, 19, 'motor', 'Honda', 'Beat', '2024', 'BP1100YU', NULL, NULL, 64, '2025-12-23 17:01:36', '2025-12-23 17:01:36'),
(33, 20, 'motor', 'Honda', 'CB150R', '2014', 'F1239GG', NULL, NULL, 65, '2025-12-24 05:12:51', '2025-12-24 05:12:51'),
(34, 22, 'motor', 'Yamaha', 'Mio M3', '2024', 'BP1230IO', NULL, NULL, NULL, '2025-12-24 10:09:34', '2025-12-24 10:09:34');

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
-- Indexes for table `service_orders`
--
ALTER TABLE `service_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_orders_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `service_orders_qr_token_unique` (`qr_token`),
  ADD KEY `service_orders_mitra_id_foreign` (`mitra_id`),
  ADD KEY `service_orders_customer_id_foreign` (`customer_id`),
  ADD KEY `service_orders_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `created_by` (`created_by`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
-- AUTO_INCREMENT for table `service_orders`
--
ALTER TABLE `service_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
-- Constraints for table `service_orders`
--
ALTER TABLE `service_orders`
  ADD CONSTRAINT `service_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `service_orders_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `service_orders_mitra_id_foreign` FOREIGN KEY (`mitra_id`) REFERENCES `mitras` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_orders_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE SET NULL;

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
