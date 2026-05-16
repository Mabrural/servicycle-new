-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 16, 2026 at 03:58 AM
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
('servicycle-cache-1352246e33277e9d3c9090a434fa72cfa6536ae2', 'i:2;', 1768054565),
('servicycle-cache-1352246e33277e9d3c9090a434fa72cfa6536ae2:timer', 'i:1768054565;', 1768054565),
('servicycle-cache-1d513c0bcbe33b2e7440e5e14d0b22ef95c9d673', 'i:1;', 1767552499),
('servicycle-cache-1d513c0bcbe33b2e7440e5e14d0b22ef95c9d673:timer', 'i:1767552499;', 1767552499),
('servicycle-cache-1f1362ea41d1bc65be321c0a378a20159f9a26d0', 'i:2;', 1766735283),
('servicycle-cache-1f1362ea41d1bc65be321c0a378a20159f9a26d0:timer', 'i:1766735283;', 1766735283),
('servicycle-cache-35e995c107a71caeb833bb3b79f9f54781b33fa1', 'i:1;', 1766720213),
('servicycle-cache-35e995c107a71caeb833bb3b79f9f54781b33fa1:timer', 'i:1766720213;', 1766720213),
('servicycle-cache-450ddec8dd206c2e2ab1aeeaa90e85e51753b8b7', 'i:2;', 1766850703),
('servicycle-cache-450ddec8dd206c2e2ab1aeeaa90e85e51753b8b7:timer', 'i:1766850703;', 1766850703),
('servicycle-cache-76546f9a641ede2beab506b96df1688d889e629a', 'i:1;', 1767609558),
('servicycle-cache-76546f9a641ede2beab506b96df1688d889e629a:timer', 'i:1767609558;', 1767609558),
('servicycle-cache-7d7116e23efef7292cad5e6f033d9a962708228c', 'i:2;', 1767702757),
('servicycle-cache-7d7116e23efef7292cad5e6f033d9a962708228c:timer', 'i:1767702757;', 1767702757),
('servicycle-cache-admin@app.servicycle.id|103.176.94.18', 'i:1;', 1778640526),
('servicycle-cache-admin@app.servicycle.id|103.176.94.18:timer', 'i:1778640526;', 1778640526),
('servicycle-cache-admin@test.com|103.150.218.222', 'i:1;', 1778605583),
('servicycle-cache-admin@test.com|103.150.218.222:timer', 'i:1778605583;', 1778605583),
('servicycle-cache-adminqqwqw@app.servicycle.id|103.176.94.18', 'i:1;', 1778640517),
('servicycle-cache-adminqqwqw@app.servicycle.id|103.176.94.18:timer', 'i:1778640517;', 1778640517),
('servicycle-cache-b74f5ee9461495ba5ca4c72a7108a23904c27a05', 'i:1;', 1767524737),
('servicycle-cache-b74f5ee9461495ba5ca4c72a7108a23904c27a05:timer', 'i:1767524737;', 1767524737),
('servicycle-cache-b888b29826bb53dc531437e723738383d8339b56', 'i:1;', 1767535513),
('servicycle-cache-b888b29826bb53dc531437e723738383d8339b56:timer', 'i:1767535513;', 1767535513),
('servicycle-cache-c097638f92de80ba8d6c696b26e6e601a5f61eb7', 'i:2;', 1766719143),
('servicycle-cache-c097638f92de80ba8d6c696b26e6e601a5f61eb7:timer', 'i:1766719143;', 1766719143),
('servicycle-cache-d02560dd9d7db4467627745bd6701e809ffca6e3', 'i:1;', 1766720233),
('servicycle-cache-d02560dd9d7db4467627745bd6701e809ffca6e3:timer', 'i:1766720233;', 1766720233),
('servicycle-cache-d54ad009d179ae346683cfc3603979bc99339ef7', 'i:1;', 1766851919),
('servicycle-cache-d54ad009d179ae346683cfc3603979bc99339ef7:timer', 'i:1766851919;', 1766851919),
('servicycle-cache-eb4ac3033e8ab3591e0fcefa8c26ce3fd36d5a0f', 'i:1;', 1767522500),
('servicycle-cache-eb4ac3033e8ab3591e0fcefa8c26ce3fd36d5a0f:timer', 'i:1767522500;', 1767522500),
('servicycle-cache-fizakel@gmail.com|103.150.218.222', 'i:1;', 1778689583),
('servicycle-cache-fizakel@gmail.com|103.150.218.222:timer', 'i:1778689583;', 1778689583),
('servicycle-cache-hello.glemo@gmail.com|103.164.80.99', 'i:1;', 1772012443),
('servicycle-cache-hello.glemo@gmail.com|103.164.80.99:timer', 'i:1772012443;', 1772012443),
('servicycle-cache-helloglemo@gmail.com|103.164.80.99', 'i:1;', 1772012451),
('servicycle-cache-helloglemo@gmail.com|103.164.80.99:timer', 'i:1772012451;', 1772012451),
('servicycle-cache-isyabelsalsabilla@gmail.com|182.2.6.239', 'i:1;', 1776565075),
('servicycle-cache-isyabelsalsabilla@gmail.com|182.2.6.239:timer', 'i:1776565075;', 1776565075),
('servicycle-cache-muhammadajrunghoirumamnun@gmail.com|103.164.80.99', 'i:5;', 1777361110),
('servicycle-cache-muhammadajrunghoirumamnun@gmail.com|103.164.80.99:timer', 'i:1777361110;', 1777361110),
('servicycle-cache-pegaxushx1@gmail.com|103.174.63.146', 'i:1;', 1778903387),
('servicycle-cache-pegaxushx1@gmail.com|103.174.63.146:timer', 'i:1778903387;', 1778903387),
('servicycle-cache-pengguna_ngasal_123@gmail.com|103.176.94.18', 'i:1;', 1778640484),
('servicycle-cache-pengguna_ngasal_123@gmail.com|103.176.94.18:timer', 'i:1778640484;', 1778640484),
('servicycle-cache-pentest@rks.com|103.150.218.222', 'i:3;', 1778688775),
('servicycle-cache-pentest@rks.com|103.150.218.222:timer', 'i:1778688775;', 1778688775),
('servicycle-cache-yonathankasihlase@gmail.com|103.176.94.18', 'i:1;', 1778640543),
('servicycle-cache-yonathankasihlase@gmail.com|103.176.94.18:timer', 'i:1778640543;', 1778640543);

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
(23, 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'mabruralmutaqi@gmail.com', 72, '2025-12-25 13:04:55', '2025-12-25 13:04:55'),
(24, 'Rama Deni Harahap', '62895603689918', 'ramadeni126@gmail.com', 73, '2025-12-26 03:35:00', '2025-12-26 03:35:00'),
(25, 'Azka', '6282386325801', 'ahmadazkakanzikaze@gmail.com', 74, '2025-12-26 07:45:13', '2025-12-26 07:45:13'),
(26, 'Angelo Tes Akun', '6285835673435', 'jameslames248@gmail.com', 75, '2025-12-27 15:50:24', '2025-12-27 15:50:24'),
(27, 'Demo', '6287788112323', 'demo@servicycle.id', 77, '2025-12-29 16:10:52', '2025-12-29 16:10:52'),
(28, 'Asyraf Rais Fadhil', '6282172437617', 'asrafrf@gmail.com', 78, '2026-01-04 10:20:59', '2026-01-04 10:20:59'),
(29, 'M Idris Nasution', '6285373507910', 'drynhasty@gmail.com', 79, '2026-01-04 11:01:04', '2026-01-04 11:01:04'),
(30, 'Aldy jhonatan Hutasoit', '6285363272621', 'aldyjhonatanhutasoit.1@gmail.com', 80, '2026-01-04 14:02:17', '2026-01-04 14:02:17'),
(31, 'KIKI', '6281313133544', 'kixtudio@gmail.com', 81, '2026-01-04 18:46:44', '2026-01-04 18:46:44'),
(32, 'Auga Raihan Mustohar', '62895410612219', 'raihanmustohar@gmail.com', 82, '2026-01-05 10:35:36', '2026-01-05 10:35:36'),
(33, 'Yamada', '6284938483938', 'yamada@mail.com', 83, '2026-01-06 12:31:31', '2026-01-06 12:31:31'),
(34, 'firdaus', '62895627385848', 'ikanpausterbang@gmail.com', 84, '2026-01-10 14:12:22', '2026-01-10 14:12:22'),
(35, 'albi', '62895627385823', 'zulalbi37@gmail.com', 85, '2026-01-10 14:14:39', '2026-01-10 14:14:39'),
(36, 'Gilang Bagus Ramadhan', '6285156861862', 'gilangbagus.rama@gmail.com', 96, '2026-04-06 07:01:52', '2026-04-06 07:01:52'),
(37, 'Iman Yonathan Kasih Lase', '6285809883084', 'buattugas363@gmail.com', 97, '2026-04-16 02:25:54', '2026-04-16 02:25:54'),
(38, 'M Ajrun Ghoiru Mamnun', '62895410604626', 'muhammadajrunghoirumamnun@gmail.com', 98, '2026-04-16 07:14:11', '2026-04-16 07:14:11'),
(39, 'Isyabel', '6282175661111', 'isyabelsalsabilla@gmail.com', 99, '2026-04-19 02:17:47', '2026-04-19 02:17:47'),
(40, 'Della Khairunnisa', '6281277901402', 'dellakhairunnisa43@gmail.com', 100, '2026-04-28 00:18:31', '2026-04-28 00:18:31'),
(41, 'Dimas Dwi Prasetiyo', '6282287446410', 'ddimasddpprasetiyo@gmail.com', 101, '2026-05-09 09:24:48', '2026-05-09 09:24:48'),
(42, 'rizky nurfadilah', '6285767335490', 'nrfdlhrizky@gmail.com', 102, '2026-05-14 12:55:34', '2026-05-14 12:55:34');

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
(30, '2025_12_16_232713_create_service_orders_table', 13),
(31, '2025_12_24_212003_create_subscription_settings_table', 14),
(32, '2025_12_24_212109_create_user_subscriptions_table', 14),
(33, '2025_12_24_212201_create_subscription_coupons_table', 14),
(34, '2025_12_25_150841_create_subscription_transactions_table', 15),
(35, '2025_12_25_164421_create_personal_access_tokens_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `mitras`
--

CREATE TABLE `mitras` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_type` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `services` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `operational_hours` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `payment_method` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `facilities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `mitras`
--

INSERT INTO `mitras` (`id`, `uuid`, `slug`, `business_name`, `vehicle_type`, `province`, `regency`, `address`, `description`, `services`, `operational_hours`, `payment_method`, `facilities`, `latitude`, `longitude`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(16, '21153f18-0d3a-454c-9e94-d15ba13c0767', 'bengkel-untuk-testing', 'Bengkel untuk Testing', '[\"motor\"]', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'Jl. Ahmad Yani, Tlk. Tering, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29461', NULL, '[\"ban_motor\",\"cuci_motor\",\"ganti_oli\",\"accessories\",\"spesialis_lampu\",\"coating_detailing\"]', '{\"monday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"23:59\"},\"tuesday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"23:59\"},\"wednesday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"23:59\"},\"thursday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"23:59\"},\"friday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"23:59\"},\"saturday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"21:00\"},\"sunday\":{\"open\":\"1\",\"start\":\"00:00\",\"end\":\"23:59\"}}', '[\"cash\"]', '[\"waiting_room_non_ac\",\"parking\"]', 1.0430160, 103.9769880, 1, 71, '2025-12-25 12:34:16', '2025-12-28 15:29:49'),
(18, 'e9e0a639-7ace-42a7-a09d-c25b1e599c10', 'bengkel-mobil-batam-otoxpert-operated-by-agung-automall', 'Bengkel Mobil Batam - OTOXPERT Operated by Agung Automall', '[\"mobil\"]', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'Jl. Duyung, Baloi Indah, Kec. Lubuk Baja, Kota Batam, Kepulauan Riau 29445', 'Bengkel mobil OTOXPERT berlokasi di Jl. Duyung, Baloi Indah, Kec. Lubuk Baja, Kota Batam, Kepulauan Riau 29445 merupakan salah satu bengkel mobil terpercaya di kota batam, memiliki pelayanan yang ramah dan teknisi yang sangat berpengalaman di bidangnya.', '[\"spooring_balancing\",\"service_kaki_kaki\",\"ganti_oli\",\"service_ac\",\"body_repair\",\"ganti_aki\",\"cuci_mobil\",\"salon_mobil\"]', '{\"monday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"16:00\"},\"tuesday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"16:00\"},\"wednesday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"16:00\"},\"thursday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"16:00\"},\"friday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"16:00\"},\"saturday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"15:00\"},\"sunday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"15:00\"}}', '[\"cash\",\"debit\",\"credit\"]', '[\"waiting_room_non_ac\"]', 1.1370490, 104.0016370, 1, 86, '2026-02-23 04:21:21', '2026-02-23 04:45:11'),
(19, '6614d985-cdaf-4017-94ca-c575ed906b35', 'bengkel-pengecatan-mobil', 'Bengkel Pengecatan Mobil', '[\"mobil\"]', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'Ruko Prima Sejati Blok A No.17-18, Baloi Permai, Batam Kota, Batam City, Riau Islands 29444', 'Merupakan bengkel pengecatan mobil yang terpercaya di batam', '[\"ganti_oli\",\"body_repair\",\"coating_detailing\",\"towing\"]', '{\"monday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"tuesday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"wednesday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"thursday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"friday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"saturday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"sunday\":{\"open\":\"0\",\"start\":null,\"end\":null}}', '[\"cash\"]', '[\"waiting_room_non_ac\",\"parking\"]', 1.1117850, 104.0498720, 1, 87, '2026-02-23 04:52:59', '2026-02-23 04:59:21'),
(20, '519705f6-6861-4e18-a573-127da5e61a0c', 'batam-mahkota-mobil', 'Batam Mahkota Mobil', '[\"mobil\"]', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'Komplek Mahkota Niaga, Jalan Engku Putri Blok C No. 15, Baloi Permai, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29431', 'Merupakan bengkel mobil yang berlokasi di komplek mahkota, jl engku putri', '[\"spooring_balancing\",\"service_kaki_kaki\",\"ganti_oli\",\"jok_kulit_interior\",\"ban_velg\",\"kaca_film\",\"service_mesin\",\"ganti_aki\",\"salon_mobil\",\"other\"]', '{\"monday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:30\"},\"tuesday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:30\"},\"wednesday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:30\"},\"thursday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:30\"},\"friday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:30\"},\"saturday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:30\"},\"sunday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:30\"}}', '[\"cash\",\"debit\",\"credit\",\"qris\"]', '[\"waiting_room_non_ac\",\"parking\"]', 1.1052760, 104.0658690, 1, 88, '2026-02-23 05:01:49', '2026-02-23 05:08:31'),
(21, '9890af54-601b-4460-af63-00b81071e624', 'abm-otomotif', 'ABM Otomotif', '[\"mobil\"]', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'Komp. Bumi Riau Makmur, Jl. Laksamana Bintan No.4 Blok F, Sungai Panas, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29444', 'ABM Otomotif merupakan bengkel yang bisa menerima derek mobil mogok atau towing. Selain itu, juga melayani servis ringan seperti ganti oli mesin, dll.', '[\"spooring_balancing\",\"ganti_oli\",\"body_repair\",\"towing\"]', '{\"monday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"tuesday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"wednesday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"thursday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"friday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"saturday\":{\"open\":\"0\",\"start\":null,\"end\":null},\"sunday\":{\"open\":\"0\",\"start\":null,\"end\":null}}', '[\"cash\"]', '[\"waiting_room_non_ac\"]', 1.1289250, 104.0295320, 1, 89, '2026-02-23 05:10:47', '2026-02-23 05:15:28'),
(22, '857fe254-81b1-4b87-b9e2-1cc33b527e5b', 'new-batam-maju', 'New Batam Maju', '[\"mobil\"]', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'Komp Tanah Mas, Jl. Laksamana Bintan Blok D No.10-11, Sungai Panas, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29432', 'Merupakan bengkel mobil yang menyediakan layanan perbaikan mobil seperti ganti ban, aki, servis, dll', '[\"ganti_oli\",\"ban_velg\",\"ganti_aki\",\"towing\"]', '{\"monday\":{\"open\":\"1\",\"start\":\"09:15\",\"end\":\"17:00\"},\"tuesday\":{\"open\":\"1\",\"start\":\"09:15\",\"end\":\"17:00\"},\"wednesday\":{\"open\":\"1\",\"start\":\"09:15\",\"end\":\"17:00\"},\"thursday\":{\"open\":\"1\",\"start\":\"09:15\",\"end\":\"17:00\"},\"friday\":{\"open\":\"1\",\"start\":\"09:15\",\"end\":\"17:00\"},\"saturday\":{\"open\":\"1\",\"start\":\"09:15\",\"end\":\"17:00\"},\"sunday\":{\"open\":\"0\",\"start\":null,\"end\":null}}', '[\"cash\"]', '[\"waiting_room_non_ac\",\"parking\"]', 1.1320590, 104.0300620, 1, 90, '2026-02-23 05:18:03', '2026-02-23 05:22:13'),
(23, '20ceeabb-674e-49f7-9098-f3e1da44d639', 'bengkel-teknik-tan-mobil', 'Bengkel Teknik Tan Mobil', '[\"mobil\"]', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'Ruko, Jl. Ahmad Yani Blk. J No.12B, Taman Baloi, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29444', 'Merupakan bengkel yang berada di simpang kara batam center', '[\"spooring_balancing\",\"service_kaki_kaki\",\"ganti_oli\",\"ban_velg\",\"body_repair\",\"ganti_aki\",\"other\"]', '{\"monday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"tuesday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"wednesday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"thursday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"friday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"saturday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"sunday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"}}', '[\"cash\"]', '[\"waiting_room_non_ac\",\"parking\"]', 1.1093470, 104.0406150, 1, 91, '2026-02-23 05:24:41', '2026-02-23 05:28:45'),
(24, 'e1600970-221c-49fd-95d4-8f68da5b79da', 'kyoto-automotive', 'Kyoto Automotive', '[\"mobil\"]', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'Komplek Roko Mitra Raya Jalan Laksamana Bintan No.2-3 Blok A, Tlk. Tering, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29432', 'Merupakan bengkel yang berada di batam center', '[\"spooring_balancing\",\"service_kaki_kaki\",\"ganti_oli\",\"spesialis_lampu\",\"jok_kulit_interior\",\"service_ac\",\"ban_velg\",\"body_repair\"]', '{\"monday\":{\"open\":\"1\",\"start\":\"07:30\",\"end\":\"17:30\"},\"tuesday\":{\"open\":\"1\",\"start\":\"07:30\",\"end\":\"17:30\"},\"wednesday\":{\"open\":\"1\",\"start\":\"07:30\",\"end\":\"17:30\"},\"thursday\":{\"open\":\"1\",\"start\":\"07:30\",\"end\":\"17:30\"},\"friday\":{\"open\":\"1\",\"start\":\"07:30\",\"end\":\"17:30\"},\"saturday\":{\"open\":\"1\",\"start\":\"07:30\",\"end\":\"17:30\"},\"sunday\":{\"open\":\"0\",\"start\":null,\"end\":null}}', '[\"cash\"]', '[\"waiting_room_non_ac\",\"parking\"]', 1.1196290, 104.0422880, 1, 92, '2026-02-23 05:30:24', '2026-02-23 05:36:44'),
(25, 'fb2e6317-5f96-443d-bfc8-f88a5c13ab02', 'gt-auto-batam', 'GT Auto Batam', '[\"mobil\"]', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'JL Laksamana Bintan, Sei Panas, Komplek Tanah Mas 3 No.4, Sungai Panas, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29433', 'Bengkel ban mobil terletak di simpang kuda sei panas.', '[\"spooring_balancing\",\"ganti_oli\",\"ban_velg\",\"ganti_aki\",\"other\"]', '{\"monday\":{\"open\":\"1\",\"start\":\"07:30\",\"end\":\"17:00\"},\"tuesday\":{\"open\":\"1\",\"start\":\"07:30\",\"end\":\"17:00\"},\"wednesday\":{\"open\":\"1\",\"start\":\"07:30\",\"end\":\"17:00\"},\"thursday\":{\"open\":\"1\",\"start\":\"07:30\",\"end\":\"17:00\"},\"friday\":{\"open\":\"1\",\"start\":\"07:30\",\"end\":\"17:00\"},\"saturday\":{\"open\":\"1\",\"start\":\"07:30\",\"end\":\"17:00\"},\"sunday\":{\"open\":\"0\",\"start\":null,\"end\":null}}', '[\"cash\",\"debit\",\"credit\",\"qris\"]', '[\"waiting_room_non_ac\",\"parking\"]', 1.1364010, 104.0278910, 1, 93, '2026-02-23 07:46:08', '2026-02-23 07:50:12'),
(26, '9ac9a1e2-eab3-4f17-97b1-0ef2fde86860', 'bengkel-batam-nagoya-ljm-car-service', 'Bengkel Batam Nagoya LJM Car Service', '[\"mobil\"]', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'Komplek Nagoya Point B 1-2 (Belakang DC Mall, Jl. Duyung No.1, Batu Selicin, Kec. Lubuk Baja, Kota Batam, Kepulauan Riau 29444', 'Bengkel LJM terletak di kawasan nagoya, Batam.', '[\"spooring_balancing\",\"ganti_oli\",\"service_ac\",\"ban_velg\",\"service_knalpot\",\"service_mesin\",\"ganti_aki\",\"other\"]', '{\"monday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"tuesday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"wednesday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"thursday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"friday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"saturday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"},\"sunday\":{\"open\":\"1\",\"start\":\"08:00\",\"end\":\"17:00\"}}', '[\"cash\",\"debit\",\"credit\",\"qris\"]', '[\"waiting_room_non_ac\",\"parking\"]', 1.1415390, 104.0041480, 1, 94, '2026-02-23 07:52:23', '2026-02-23 07:56:56'),
(27, '5a331ef5-c62a-44bd-8a41-6b54992d314c', 'ym-autoworks', 'YM Autoworks', '[\"mobil\"]', 'KEPULAUAN RIAU', 'KOTA B A T A M', 'Komp Gudang 1 Blok D No.01, Taman Baloi, Batam Centre, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29444', 'YM Auto bengkel mobil terpercaya di batam center', '[\"spooring_balancing\",\"service_kaki_kaki\",\"ganti_oli\",\"spesialis_lampu\",\"service_ac\",\"ban_velg\",\"body_repair\",\"service_knalpot\",\"service_mesin\",\"ganti_aki\",\"other\"]', '{\"monday\":{\"open\":\"1\",\"start\":\"08:30\",\"end\":\"17:00\"},\"tuesday\":{\"open\":\"1\",\"start\":\"08:30\",\"end\":\"17:00\"},\"wednesday\":{\"open\":\"1\",\"start\":\"08:30\",\"end\":\"17:00\"},\"thursday\":{\"open\":\"1\",\"start\":\"08:30\",\"end\":\"17:00\"},\"friday\":{\"open\":\"1\",\"start\":\"08:30\",\"end\":\"17:00\"},\"saturday\":{\"open\":\"1\",\"start\":\"08:30\",\"end\":\"17:00\"},\"sunday\":{\"open\":\"0\",\"start\":null,\"end\":null}}', '[\"cash\",\"debit\",\"credit\",\"qris\"]', '[\"waiting_room_non_ac\",\"parking\"]', 1.1182400, 104.0329330, 1, 95, '2026-02-23 07:59:18', '2026-02-23 08:37:48');

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
(57, 16, 'mitra-images/hNKUqVoa8809ImxLuK0Iih0V59Q19dqZtytF7uoH.jpg', 1, 0, 71, '2026-01-04 09:50:01', '2026-01-04 09:50:01'),
(59, 18, 'mitra-images/zRJ1YKkCJB34XNya3DshmSwDcv4fZ7NJKPhFA6TB.jpg', 1, 0, 86, '2026-02-23 04:46:32', '2026-02-23 04:46:32'),
(60, 19, 'mitra-images/e9LsCFvAv0O0jttYXJqLk9puVbbtQ4vI2Pq2vvYq.png', 1, 0, 87, '2026-02-23 04:56:42', '2026-02-23 04:56:42'),
(61, 20, 'mitra-images/3LzSjORktDXalPYC4H3iiGYkTQ8BzNLCHvoNNHqa.png', 1, 0, 88, '2026-02-23 05:04:57', '2026-02-23 05:04:57'),
(62, 21, 'mitra-images/ylOyXUNVtogjdsVQ0W4WqmGg7w4nqx9e6sGkt5bZ.png', 1, 0, 89, '2026-02-23 05:11:34', '2026-02-23 05:11:34'),
(63, 22, 'mitra-images/MEo7WXPQMs5lO19gPmBKjcrxE1Xlszq3SlMQMM9t.png', 1, 0, 90, '2026-02-23 05:19:58', '2026-02-23 05:19:58'),
(64, 23, 'mitra-images/8oFYAw6CMiO2j0A2xXxScuBTtBKXwbw3AVKWuCUI.png', 1, 0, 91, '2026-02-23 05:26:51', '2026-02-23 05:26:51'),
(65, 24, 'mitra-images/SfCRDLMzbanwbIIl5nScrS4xwZkKpbyR1bX74wB4.png', 1, 0, 92, '2026-02-23 05:35:05', '2026-02-23 05:35:05'),
(66, 25, 'mitra-images/6Owc8kmcphPvR9M29oYNj7qwdMypZF0rjwoahQkH.png', 1, 0, 93, '2026-02-23 07:46:42', '2026-02-23 07:46:42'),
(67, 26, 'mitra-images/cLN89VPVLDC9XwDETpuAmsHa42hSzRasmY3mjsYa.png', 1, 0, 94, '2026-02-23 07:53:46', '2026-02-23 07:53:46'),
(68, 27, 'mitra-images/mJi3bNdYEwXB5GaCDIm1t0OOTXdBnqEeSx4tn6Ka.png', 1, 0, 95, '2026-02-23 08:29:36', '2026-02-23 08:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('buattugas363@gmail.com', '$2y$12$xeiVtVJxOH7H8IjQQHs/seYKwv0YMyNJNrLARUMRDvRc2uB1x6k5.', '2026-04-20 08:04:07'),
('muhammadajrunghoirumamnun@gmail.com', '$2y$12$xJgnSSvvhUioTgEG.qqN4O.Y2OHgC/e0D/2FnFtrf3gRQsAhcI/gW', '2026-04-28 07:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(43, 'eec58dfd-6d96-4ecc-a476-629d55e6a884', 16, 23, 35, 72, 'online', 'motor', 'Suzuki', 'All New Satria F150', 'BP6042GQ', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'ganti oli', 'kampas rem mulai aus', NULL, 90000.00, 1, 'done', 'be56945b-c143-46b2-94b9-13ae5ad496f3', '2025-12-26 06:26:54', '2025-12-26 07:26:23', '2025-12-26 06:26:23', '2025-12-26 06:49:52', '2025-12-26 06:54:43', NULL, '2025-12-26 06:26:01', '2025-12-26 06:54:43'),
(44, 'a34dde7a-9ead-4f87-9c55-00a2ff200fd1', 16, 23, 35, 72, 'online', 'motor', 'Suzuki', 'All New Satria F150', 'BP6042GQ', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'ganti kanvas rem depan belakang', NULL, NULL, NULL, NULL, 'no_show', '70971f28-e58c-4cca-83d5-b51ad529e9a3', NULL, '2025-12-26 08:08:59', '2025-12-26 07:08:59', NULL, NULL, NULL, '2025-12-26 07:08:48', '2025-12-26 07:12:09'),
(45, '0a27519f-729e-4ab8-98f9-f220fae8da7d', 16, 23, 35, 72, 'online', 'motor', 'Suzuki', 'All New Satria F150', 'BP6042GQ', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'ganti ban', 'diganti ban tubles', NULL, 400000.00, 1, 'done', 'aa5c3974-c429-44c7-aca5-5613917e2c96', '2025-12-26 07:14:29', '2025-12-26 08:14:11', '2025-12-26 07:14:11', '2025-12-26 07:14:45', '2025-12-26 07:15:01', NULL, '2025-12-26 07:13:56', '2025-12-26 07:15:01'),
(46, '0cc2fd93-d41a-45e0-b630-d52994df7f04', 16, 23, NULL, 71, 'walk_in', 'motor', 'Suzuki', 'Satria F150 Series', 'BP6043GQ', 'Mabrur', '6282178192938', 'ganti oli', 'oli sudah diganti', NULL, 50000.00, 2, 'done', 'd070404c-28bb-4d7b-b88b-e075b7baef13', NULL, NULL, NULL, '2025-12-26 07:21:33', '2025-12-26 07:21:49', NULL, '2025-12-26 07:20:38', '2025-12-26 07:21:49'),
(48, 'd21e8192-c6e1-42ba-8d7c-64bba09536c8', 16, 23, 35, 72, 'online', 'motor', 'Suzuki', 'All New Satria F150', 'BP6042GQ', 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'ganti rem', 'Kanvas rem habis', NULL, 110000.00, 1, 'done', '6cd3c5d6-8989-4cdd-b990-e80982aac66d', '2025-12-29 04:58:05', '2025-12-29 05:56:06', '2025-12-29 04:56:06', '2026-01-05 00:16:18', '2026-01-05 00:16:45', NULL, '2025-12-29 04:50:39', '2026-01-05 00:16:45'),
(49, '87d1f5b1-d3f0-436b-96d1-cdae224263b9', 16, 30, 38, 80, 'online', 'motor', 'Honda', 'Beat', 'BP1234X', 'Aldy jhonatan Hutasoit', '6285363272621', 'Gak bisa hidup', 'Turun mesin', NULL, 1100000.00, 2, 'done', 'afbc8331-2ef5-4ddf-9799-995c9ba73de7', '2026-01-04 14:14:48', '2026-01-04 15:12:21', '2026-01-04 14:12:21', '2026-01-04 14:15:57', '2026-01-04 14:17:16', NULL, '2026-01-04 14:05:52', '2026-01-04 14:17:16');

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
('1fUIpdkBYIAXpgAn5I2he1f95A9upeUSJTmquZzH', NULL, '18.97.9.99', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; PerplexityBot/1.0; +https://perplexity.ai/perplexitybot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMm1vSVJ6UkZKRWRHNWFDM3JvUGdRM2NrVGFMMmg0V1NsOUUxSGQ3MSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vYXBwLnNlcnZpY3ljbGUuaWQvcmVnaXN0ZXIiO3M6NToicm91dGUiO3M6ODoicmVnaXN0ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778900900),
('6cHbNzIZP744qZFfBLFgEzXpRk298lXVgNpmYNti', NULL, '18.97.9.96', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; PerplexityBot/1.0; +https://perplexity.ai/perplexitybot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMVJtZDZaQUxuS2VLeHpNNHhVNmxnYVZsWXYyYXRMcm12enVFVkhpMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYXBwLnNlcnZpY3ljbGUuaWQiO3M6NToicm91dGUiO3M6Nzoid2VsY29tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778898820),
('6Ticf9yd5vrIinW2GED2QeMyt79wGesNzgHVgTZo', NULL, '18.97.9.102', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; PerplexityBot/1.0; +https://perplexity.ai/perplexitybot)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiajMwOVR3Y2lGOGZ5Tms5RjhXdHBmRUFpTWVyN096VVZXM2QxcVIxciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vYXBwLnNlcnZpY3ljbGUuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778899052),
('achiqZpGmf51XBiA1xT7JYg7JVUbk8dpDtiIl7pf', NULL, '36.64.111.66', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmFRY1NhZmxadlVVTDdMTVhwMHlVMEhwNHNBS05SbGlyZG94N1NFUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6OTE6Imh0dHBzOi8vYXBwLnNlcnZpY3ljbGUuaWQvc3RvcmFnZS9taXRyYS1pbWFnZXMvelJKMVlLa0NKQjM0WE55YTNEc2htU3dEY3Y0Zlo3TkpLUGhGQTZUQi5qcGciO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778903002),
('eFSR1SQJsYojb4AxbGzO3BsKn7O5dF2Ceb70VFjv', NULL, '18.97.43.86', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; Perplexity-User/1.0; +https://perplexity.ai/perplexity-user)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2ptNHQxTURBN2FKS2Z6ZDF2MFdaeDRXT1FKWW91ckd1dXY1cWFWNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYXBwLnNlcnZpY3ljbGUuaWQiO3M6NToicm91dGUiO3M6Nzoid2VsY29tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778898816),
('pO3x0caxCCbYMkERVSrTBnkIdM3KKJ59tUXR1aVV', NULL, '103.174.63.146', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQm5HUlN4NjNGeDVlbE1UdEhFYXlEMmZPYTBldk5OYWkzV21sQUlqRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vYXBwLnNlcnZpY3ljbGUuaWQiO3M6NToicm91dGUiO3M6Nzoid2VsY29tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778897674),
('WhbGkKMnapLTfTAzQDVBonHe4tIgh6dEg8oY3CVF', NULL, '103.174.63.146', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia0R3S0ZYYmRzaDdBNDlWNFRDTENiOEFaaDNzREhGV1puMEdlR0pmMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vYXBwLnNlcnZpY3ljbGUuaWQvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778903327),
('YbnVjsr2eVcZBITMCZaUPHKkNyAh295Ebfgbe3KY', 71, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiamlyWThFNjhFWkZCSlFNaE1RejhSalR0djRmazdWVjJhY2JFZGllUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9taXRyYS9wcm9maWwiO3M6NToicm91dGUiO3M6MTM6InByb2ZpbGUubWl0cmEiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3MTt9', 1778903905);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_coupons`
--

CREATE TABLE `subscription_coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('customer','mitra') COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int NOT NULL DEFAULT '0',
  `is_lifetime` tinyint(1) NOT NULL DEFAULT '0',
  `max_usage` int DEFAULT NULL,
  `used_count` int NOT NULL DEFAULT '0',
  `expired_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_settings`
--

CREATE TABLE `subscription_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `customer_price` int NOT NULL DEFAULT '0',
  `mitra_price` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_settings`
--

INSERT INTO `subscription_settings` (`id`, `is_enabled`, `customer_price`, `mitra_price`, `created_at`, `updated_at`) VALUES
(1, 1, 10000, 49000, '2025-12-24 14:43:20', '2026-04-27 12:15:31');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_transactions`
--

CREATE TABLE `subscription_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchant_ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int NOT NULL,
  `discount` int NOT NULL DEFAULT '0',
  `status` enum('PENDING','PAID','FAILED','EXPIRED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `checkout_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `subscription_transactions`
--

INSERT INTO `subscription_transactions` (`id`, `user_id`, `reference`, `merchant_ref`, `payment_method`, `amount`, `discount`, `status`, `checkout_url`, `payload`, `created_at`, `updated_at`) VALUES
(14, 74, 'DEV-T39655322866MCCIB', 'PRO-3LG4OHXW2A', 'QRIS', 10000, 0, 'PENDING', 'https://tripay.co.id/checkout/DEV-T39655322866MCCIB', '{\"success\":true,\"message\":\"\",\"data\":{\"reference\":\"DEV-T39655322866MCCIB\",\"merchant_ref\":\"PRO-3LG4OHXW2A\",\"payment_selection_type\":\"static\",\"payment_method\":\"QRIS\",\"payment_name\":\"QRIS by ShopeePay\",\"customer_name\":\"Azka\",\"customer_email\":\"ahmadazkakanzikaze@gmail.com\",\"customer_phone\":null,\"callback_url\":\"https:\\/\\/app.servicycle.id\\/api\\/tripay\\/callback\",\"return_url\":\"https:\\/\\/app.servicycle.id\\/upgrade-pro\",\"amount\":10000,\"fee_merchant\":820,\"fee_customer\":0,\"total_fee\":820,\"amount_received\":9180,\"pay_code\":null,\"pay_url\":null,\"checkout_url\":\"https:\\/\\/tripay.co.id\\/checkout\\/DEV-T39655322866MCCIB\",\"status\":\"UNPAID\",\"expired_time\":1766738913,\"order_items\":[{\"sku\":null,\"name\":\"Upgrade PRO\",\"price\":10000,\"quantity\":1,\"subtotal\":10000,\"product_url\":null,\"image_url\":null}],\"instructions\":[{\"title\":\"Pembayaran via QRIS (ShopeePay)\",\"steps\":[\"Masuk ke aplikasi dompet digital Anda yang telah mendukung QRIS\",\"Pindai\\/Scan QR Code yang tersedia\",\"Akan muncul detail transaksi. Pastikan data transaksi sudah sesuai\",\"Selesaikan proses pembayaran Anda\",\"Transaksi selesai. Simpan bukti pembayaran Anda\"]},{\"title\":\"Pembayaran via QRIS (Mobile)\",\"steps\":[\"Download QR Code pada invoice\",\"Masuk ke aplikasi dompet digital Anda yang telah mendukung QRIS\",\"Upload QR Code yang telah di download tadi\",\"Akan muncul detail transaksi. Pastikan data transaksi sudah sesuai\",\"Selesaikan proses pembayaran Anda\",\"Transaksi selesai. Simpan bukti pembayaran Anda\"]}],\"qr_string\":\"SANDBOX MODE\",\"qr_url\":\"https:\\/\\/tripay.co.id\\/qr\\/DEV-T39655322866MCCIB\"}}', '2025-12-26 07:49:33', '2025-12-26 07:49:33'),
(16, 80, 'DEV-T396553270200V053', 'PRO-HMORB08TLF', 'QRIS', 10000, 0, 'PENDING', 'https://tripay.co.id/checkout/DEV-T396553270200V053', '{\"success\":true,\"message\":\"\",\"data\":{\"reference\":\"DEV-T396553270200V053\",\"merchant_ref\":\"PRO-HMORB08TLF\",\"payment_selection_type\":\"static\",\"payment_method\":\"QRIS\",\"payment_name\":\"QRIS by ShopeePay\",\"customer_name\":\"Aldy jhonatan Hutasoit\",\"customer_email\":\"aldyjhonatanhutasoit.1@gmail.com\",\"customer_phone\":null,\"callback_url\":\"https:\\/\\/app.servicycle.id\\/api\\/tripay\\/callback\",\"return_url\":\"https:\\/\\/app.servicycle.id\\/upgrade-pro\",\"amount\":10000,\"fee_merchant\":820,\"fee_customer\":0,\"total_fee\":820,\"amount_received\":9180,\"pay_code\":null,\"pay_url\":null,\"checkout_url\":\"https:\\/\\/tripay.co.id\\/checkout\\/DEV-T396553270200V053\",\"status\":\"UNPAID\",\"expired_time\":1767539117,\"order_items\":[{\"sku\":null,\"name\":\"Upgrade PRO\",\"price\":10000,\"quantity\":1,\"subtotal\":10000,\"product_url\":null,\"image_url\":null}],\"instructions\":[{\"title\":\"Pembayaran via QRIS (ShopeePay)\",\"steps\":[\"Masuk ke aplikasi dompet digital Anda yang telah mendukung QRIS\",\"Pindai\\/Scan QR Code yang tersedia\",\"Akan muncul detail transaksi. Pastikan data transaksi sudah sesuai\",\"Selesaikan proses pembayaran Anda\",\"Transaksi selesai. Simpan bukti pembayaran Anda\"]},{\"title\":\"Pembayaran via QRIS (Mobile)\",\"steps\":[\"Download QR Code pada invoice\",\"Masuk ke aplikasi dompet digital Anda yang telah mendukung QRIS\",\"Upload QR Code yang telah di download tadi\",\"Akan muncul detail transaksi. Pastikan data transaksi sudah sesuai\",\"Selesaikan proses pembayaran Anda\",\"Transaksi selesai. Simpan bukti pembayaran Anda\"]}],\"qr_string\":\"SANDBOX MODE\",\"qr_url\":\"https:\\/\\/tripay.co.id\\/qr\\/DEV-T396553270200V053\"}}', '2026-01-04 14:06:17', '2026-01-04 14:06:17'),
(17, 72, 'DEV-T39655359471UXI0I', 'PRO-L5ZWRSQPJK', 'QRIS', 5000, 0, 'PENDING', 'https://tripay.co.id/checkout/DEV-T39655359471UXI0I', '{\"success\":true,\"message\":\"\",\"data\":{\"reference\":\"DEV-T39655359471UXI0I\",\"merchant_ref\":\"PRO-L5ZWRSQPJK\",\"payment_selection_type\":\"static\",\"payment_method\":\"QRIS\",\"payment_name\":\"QRIS by ShopeePay\",\"customer_name\":\"Muhammad Mabrur Al Mutaqi\",\"customer_email\":\"mabruralmutaqi@gmail.com\",\"customer_phone\":null,\"callback_url\":\"https:\\/\\/app.servicycle.id\\/api\\/tripay\\/callback\",\"return_url\":\"https:\\/\\/app.servicycle.id\\/upgrade-pro\",\"amount\":5000,\"fee_merchant\":785,\"fee_customer\":0,\"total_fee\":785,\"amount_received\":4215,\"pay_code\":null,\"pay_url\":null,\"checkout_url\":\"https:\\/\\/tripay.co.id\\/checkout\\/DEV-T39655359471UXI0I\",\"status\":\"UNPAID\",\"expired_time\":1775462638,\"order_items\":[{\"sku\":null,\"name\":\"Upgrade PRO\",\"price\":5000,\"quantity\":1,\"subtotal\":5000,\"product_url\":null,\"image_url\":null}],\"instructions\":[{\"title\":\"Pembayaran via QRIS (ShopeePay)\",\"steps\":[\"Masuk ke aplikasi dompet digital Anda yang telah mendukung QRIS\",\"Pindai\\/Scan QR Code yang tersedia\",\"Akan muncul detail transaksi. Pastikan data transaksi sudah sesuai\",\"Selesaikan proses pembayaran Anda\",\"Transaksi selesai. Simpan bukti pembayaran Anda\"]},{\"title\":\"Pembayaran via QRIS (Mobile)\",\"steps\":[\"Download QR Code pada invoice\",\"Masuk ke aplikasi dompet digital Anda yang telah mendukung QRIS\",\"Upload QR Code yang telah di download tadi\",\"Akan muncul detail transaksi. Pastikan data transaksi sudah sesuai\",\"Selesaikan proses pembayaran Anda\",\"Transaksi selesai. Simpan bukti pembayaran Anda\"]}],\"qr_string\":\"SANDBOX MODE\",\"qr_url\":\"https:\\/\\/tripay.co.id\\/qr\\/DEV-T39655359471UXI0I\"}}', '2026-04-06 07:04:58', '2026-04-06 07:04:58'),
(18, 72, 'DEV-T39655359698NQWWK', 'PRO-QY1ZEBLDZM', 'QRIS', 5000, 0, 'PENDING', 'https://tripay.co.id/checkout/DEV-T39655359698NQWWK', '{\"success\":true,\"message\":\"\",\"data\":{\"reference\":\"DEV-T39655359698NQWWK\",\"merchant_ref\":\"PRO-QY1ZEBLDZM\",\"payment_selection_type\":\"static\",\"payment_method\":\"QRIS\",\"payment_name\":\"QRIS by ShopeePay\",\"customer_name\":\"Muhammad Mabrur Al Mutaqi\",\"customer_email\":\"mabruralmutaqi@gmail.com\",\"customer_phone\":null,\"callback_url\":\"https:\\/\\/app.servicycle.id\\/api\\/tripay\\/callback\",\"return_url\":\"https:\\/\\/app.servicycle.id\\/upgrade-pro\",\"amount\":5000,\"fee_merchant\":785,\"fee_customer\":0,\"total_fee\":785,\"amount_received\":4215,\"pay_code\":null,\"pay_url\":null,\"checkout_url\":\"https:\\/\\/tripay.co.id\\/checkout\\/DEV-T39655359698NQWWK\",\"status\":\"UNPAID\",\"expired_time\":1775552745,\"order_items\":[{\"sku\":null,\"name\":\"Upgrade PRO\",\"price\":5000,\"quantity\":1,\"subtotal\":5000,\"product_url\":null,\"image_url\":null}],\"instructions\":[{\"title\":\"Pembayaran via QRIS (ShopeePay)\",\"steps\":[\"Masuk ke aplikasi dompet digital Anda yang telah mendukung QRIS\",\"Pindai\\/Scan QR Code yang tersedia\",\"Akan muncul detail transaksi. Pastikan data transaksi sudah sesuai\",\"Selesaikan proses pembayaran Anda\",\"Transaksi selesai. Simpan bukti pembayaran Anda\"]},{\"title\":\"Pembayaran via QRIS (Mobile)\",\"steps\":[\"Download QR Code pada invoice\",\"Masuk ke aplikasi dompet digital Anda yang telah mendukung QRIS\",\"Upload QR Code yang telah di download tadi\",\"Akan muncul detail transaksi. Pastikan data transaksi sudah sesuai\",\"Selesaikan proses pembayaran Anda\",\"Transaksi selesai. Simpan bukti pembayaran Anda\"]}],\"qr_string\":\"SANDBOX MODE\",\"qr_url\":\"https:\\/\\/tripay.co.id\\/qr\\/DEV-T39655359698NQWWK\"}}', '2026-04-07 08:06:44', '2026-04-07 08:06:45'),
(19, 97, 'DEV-T39655361899JH2OF', 'PRO-KF5T4CEIYK', 'QRIS', 5000, 0, 'PENDING', 'https://tripay.co.id/checkout/DEV-T39655361899JH2OF', '{\"success\":true,\"message\":\"\",\"data\":{\"reference\":\"DEV-T39655361899JH2OF\",\"merchant_ref\":\"PRO-KF5T4CEIYK\",\"payment_selection_type\":\"static\",\"payment_method\":\"QRIS\",\"payment_name\":\"QRIS by ShopeePay\",\"customer_name\":\"Iman Yonathan Kasih Lase\",\"customer_email\":\"buattugas363@gmail.com\",\"customer_phone\":null,\"callback_url\":\"https:\\/\\/app.servicycle.id\\/api\\/tripay\\/callback\",\"return_url\":\"https:\\/\\/app.servicycle.id\\/upgrade-pro\",\"amount\":5000,\"fee_merchant\":785,\"fee_customer\":0,\"total_fee\":785,\"amount_received\":4215,\"pay_code\":null,\"pay_url\":null,\"checkout_url\":\"https:\\/\\/tripay.co.id\\/checkout\\/DEV-T39655361899JH2OF\",\"status\":\"UNPAID\",\"expired_time\":1776309908,\"order_items\":[{\"sku\":null,\"name\":\"Upgrade PRO\",\"price\":5000,\"quantity\":1,\"subtotal\":5000,\"product_url\":null,\"image_url\":null}],\"instructions\":[{\"title\":\"Pembayaran via QRIS (ShopeePay)\",\"steps\":[\"Masuk ke aplikasi dompet digital Anda yang telah mendukung QRIS\",\"Pindai\\/Scan QR Code yang tersedia\",\"Akan muncul detail transaksi. Pastikan data transaksi sudah sesuai\",\"Selesaikan proses pembayaran Anda\",\"Transaksi selesai. Simpan bukti pembayaran Anda\"]},{\"title\":\"Pembayaran via QRIS (Mobile)\",\"steps\":[\"Download QR Code pada invoice\",\"Masuk ke aplikasi dompet digital Anda yang telah mendukung QRIS\",\"Upload QR Code yang telah di download tadi\",\"Akan muncul detail transaksi. Pastikan data transaksi sudah sesuai\",\"Selesaikan proses pembayaran Anda\",\"Transaksi selesai. Simpan bukti pembayaran Anda\"]}],\"qr_string\":\"SANDBOX MODE\",\"qr_url\":\"https:\\/\\/tripay.co.id\\/qr\\/DEV-T39655361899JH2OF\"}}', '2026-04-16 02:26:07', '2026-04-16 02:26:08'),
(20, 97, 'DEV-T39655361901KKLG0', 'PRO-LFHHB85WUM', 'QRIS', 5000, 0, 'PENDING', 'https://tripay.co.id/checkout/DEV-T39655361901KKLG0', '{\"success\":true,\"message\":\"\",\"data\":{\"reference\":\"DEV-T39655361901KKLG0\",\"merchant_ref\":\"PRO-LFHHB85WUM\",\"payment_selection_type\":\"static\",\"payment_method\":\"QRIS\",\"payment_name\":\"QRIS by ShopeePay\",\"customer_name\":\"walawe\",\"customer_email\":\"buattugas363@gmail.com\",\"customer_phone\":null,\"callback_url\":\"https:\\/\\/app.servicycle.id\\/api\\/tripay\\/callback\",\"return_url\":\"https:\\/\\/app.servicycle.id\\/upgrade-pro\",\"amount\":5000,\"fee_merchant\":785,\"fee_customer\":0,\"total_fee\":785,\"amount_received\":4215,\"pay_code\":null,\"pay_url\":null,\"checkout_url\":\"https:\\/\\/tripay.co.id\\/checkout\\/DEV-T39655361901KKLG0\",\"status\":\"UNPAID\",\"expired_time\":1776310126,\"order_items\":[{\"sku\":null,\"name\":\"Upgrade PRO\",\"price\":5000,\"quantity\":1,\"subtotal\":5000,\"product_url\":null,\"image_url\":null}],\"instructions\":[{\"title\":\"Pembayaran via QRIS (ShopeePay)\",\"steps\":[\"Masuk ke aplikasi dompet digital Anda yang telah mendukung QRIS\",\"Pindai\\/Scan QR Code yang tersedia\",\"Akan muncul detail transaksi. Pastikan data transaksi sudah sesuai\",\"Selesaikan proses pembayaran Anda\",\"Transaksi selesai. Simpan bukti pembayaran Anda\"]},{\"title\":\"Pembayaran via QRIS (Mobile)\",\"steps\":[\"Download QR Code pada invoice\",\"Masuk ke aplikasi dompet digital Anda yang telah mendukung QRIS\",\"Upload QR Code yang telah di download tadi\",\"Akan muncul detail transaksi. Pastikan data transaksi sudah sesuai\",\"Selesaikan proses pembayaran Anda\",\"Transaksi selesai. Simpan bukti pembayaran Anda\"]}],\"qr_string\":\"SANDBOX MODE\",\"qr_url\":\"https:\\/\\/tripay.co.id\\/qr\\/DEV-T39655361901KKLG0\"}}', '2026-04-16 02:29:44', '2026-04-16 02:29:45'),
(21, 98, 'DEV-T39655361969GYD35', 'PRO-YGVBEZA8QZ', 'QRIS', 5000, 0, 'PENDING', 'https://tripay.co.id/checkout/DEV-T39655361969GYD35', '{\"success\":true,\"message\":\"\",\"data\":{\"reference\":\"DEV-T39655361969GYD35\",\"merchant_ref\":\"PRO-YGVBEZA8QZ\",\"payment_selection_type\":\"static\",\"payment_method\":\"QRIS\",\"payment_name\":\"QRIS by ShopeePay\",\"customer_name\":\"M Ajrun Ghoiru Mamnun\",\"customer_email\":\"muhammadajrunghoirumamnun@gmail.com\",\"customer_phone\":null,\"callback_url\":\"https:\\/\\/app.servicycle.id\\/api\\/tripay\\/callback\",\"return_url\":\"https:\\/\\/app.servicycle.id\\/upgrade-pro\",\"amount\":5000,\"fee_merchant\":785,\"fee_customer\":0,\"total_fee\":785,\"amount_received\":4215,\"pay_code\":null,\"pay_url\":null,\"checkout_url\":\"https:\\/\\/tripay.co.id\\/checkout\\/DEV-T39655361969GYD35\",\"status\":\"UNPAID\",\"expired_time\":1776327225,\"order_items\":[{\"sku\":null,\"name\":\"Upgrade PRO\",\"price\":5000,\"quantity\":1,\"subtotal\":5000,\"product_url\":null,\"image_url\":null}],\"instructions\":[{\"title\":\"Pembayaran via QRIS (ShopeePay)\",\"steps\":[\"Masuk ke aplikasi dompet digital Anda yang telah mendukung QRIS\",\"Pindai\\/Scan QR Code yang tersedia\",\"Akan muncul detail transaksi. Pastikan data transaksi sudah sesuai\",\"Selesaikan proses pembayaran Anda\",\"Transaksi selesai. Simpan bukti pembayaran Anda\"]},{\"title\":\"Pembayaran via QRIS (Mobile)\",\"steps\":[\"Download QR Code pada invoice\",\"Masuk ke aplikasi dompet digital Anda yang telah mendukung QRIS\",\"Upload QR Code yang telah di download tadi\",\"Akan muncul detail transaksi. Pastikan data transaksi sudah sesuai\",\"Selesaikan proses pembayaran Anda\",\"Transaksi selesai. Simpan bukti pembayaran Anda\"]}],\"qr_string\":\"SANDBOX MODE\",\"qr_url\":\"https:\\/\\/tripay.co.id\\/qr\\/DEV-T39655361969GYD35\"}}', '2026-04-16 07:14:43', '2026-04-16 07:14:44'),
(22, 101, 'DEV-T39655367606IMUAX', 'PRO-RNNHEP9DGQ', 'QRIS', 10000, 0, 'PENDING', 'https://tripay.co.id/checkout/DEV-T39655367606IMUAX', '{\"success\":true,\"message\":\"\",\"data\":{\"reference\":\"DEV-T39655367606IMUAX\",\"merchant_ref\":\"PRO-RNNHEP9DGQ\",\"payment_selection_type\":\"static\",\"payment_method\":\"QRIS\",\"payment_name\":\"QRIS by ShopeePay\",\"customer_name\":\"Dimas Dwi Prasetiyo\",\"customer_email\":\"ddimasddpprasetiyo@gmail.com\",\"customer_phone\":null,\"callback_url\":\"https:\\/\\/app.servicycle.id\\/api\\/tripay\\/callback\",\"return_url\":\"https:\\/\\/app.servicycle.id\\/upgrade-pro\",\"amount\":10000,\"fee_merchant\":820,\"fee_customer\":0,\"total_fee\":820,\"amount_received\":9180,\"pay_code\":null,\"pay_url\":null,\"checkout_url\":\"https:\\/\\/tripay.co.id\\/checkout\\/DEV-T39655367606IMUAX\",\"status\":\"UNPAID\",\"expired_time\":1778322259,\"order_items\":[{\"sku\":null,\"name\":\"Upgrade PRO\",\"price\":10000,\"quantity\":1,\"subtotal\":10000,\"product_url\":null,\"image_url\":null}],\"instructions\":[{\"title\":\"Pembayaran via QRIS (ShopeePay)\",\"steps\":[\"Masuk ke aplikasi dompet digital Anda yang telah mendukung QRIS\",\"Pindai\\/Scan QR Code yang tersedia\",\"Akan muncul detail transaksi. Pastikan data transaksi sudah sesuai\",\"Selesaikan proses pembayaran Anda\",\"Transaksi selesai. Simpan bukti pembayaran Anda\"]},{\"title\":\"Pembayaran via QRIS (Mobile)\",\"steps\":[\"Download QR Code pada invoice\",\"Masuk ke aplikasi dompet digital Anda yang telah mendukung QRIS\",\"Upload QR Code yang telah di download tadi\",\"Akan muncul detail transaksi. Pastikan data transaksi sudah sesuai\",\"Selesaikan proses pembayaran Anda\",\"Transaksi selesai. Simpan bukti pembayaran Anda\"]}],\"qr_string\":\"SANDBOX MODE\",\"qr_url\":\"https:\\/\\/tripay.co.id\\/qr\\/DEV-T39655367606IMUAX\"}}', '2026-05-09 09:25:17', '2026-05-09 09:25:18');

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
(71, 'Mabrural', '6287874535030', 'mabrural814@gmail.com', '2025-12-26 03:36:13', '$2y$12$eGK422jTeCm/vYFe0xSg5OmVps/QBlwCb/nnY32EiRHp06.T/kQ1.', 'IBes1YKvnrthqLSLIegGs2IQ8Ad5qwcEbALqPFdioH1rp28OaYqIPhVkRJdX', 'mitra', '2025-12-25 12:34:16', '2025-12-28 03:22:39'),
(72, 'Muhammad Mabrur Al Mutaqi', '6282178192938', 'mabruralmutaqi@gmail.com', '2025-12-26 03:18:32', '$2y$12$p7DDQftObFVc.Q75sW8X0Occ9.H1X9DKNYmlWwP54TSvIlsbdNc5i', NULL, 'customer', '2025-12-25 13:04:55', '2025-12-26 03:18:32'),
(73, 'Rama Deni Harahap', '62895603689918', 'ramadeni126@gmail.com', '2025-12-26 03:35:53', '$2y$12$Gnbo0ID6aSgWZuoO0yrn6OMmEwUM6rjzOU77xT/PxFIB/g7oeXSfi', NULL, 'customer', '2025-12-26 03:35:00', '2025-12-26 03:35:53'),
(74, 'Azka', '6282386325801', 'ahmadazkakanzikaze@gmail.com', '2025-12-26 07:47:57', '$2y$12$5MawBwPCa8ww/xHQLHbvI.6J7oPQW4NCh.etoUOobYoGU6Dgs1.Ry', NULL, 'customer', '2025-12-26 07:45:13', '2025-12-26 07:47:57'),
(75, 'Angelo Tes Akun', '6285835673435', 'jameslames248@gmail.com', '2025-12-27 15:51:13', '$2y$12$DwmF/ASDvRsa7Vrh7kwWQ.jKDGFUdmd74GCuofXbykjV2R90QD3nK', NULL, 'customer', '2025-12-27 15:50:23', '2025-12-27 15:51:13'),
(77, 'Demo', '6287788112323', 'demo@servicycle.id', '2025-12-29 16:11:58', '$2y$12$3/Hmpod9JPugRmsixXTkw.bZoAs4AtBRbx4ly9ECgZxo5.0fNteoS', 'Y2g7phW2kVU9efR12Kegn92dUeLSyDw2I2UTTWialeyYPbBCHZQO8XZfKYgj', 'customer', '2025-12-29 16:10:52', '2025-12-29 16:12:58'),
(78, 'Asyraf Rais Fadhil', '6282172437617', 'asrafrf@gmail.com', '2026-01-04 10:27:20', '$2y$12$VI.cc427ywieHbGzSRQfMeNz2HOOysFnAvRWIjdurfkj3eGpKALSi', 'DxoMBzBpsVzJ4VN8ooyVzcTNXENiOrfc9goZ1JrEvKTrZzCkxBd5u1PLDenF', 'customer', '2026-01-04 10:20:59', '2026-03-31 14:03:25'),
(79, 'M Idris Nasution', '6285373507910', 'drynhasty@gmail.com', '2026-01-04 11:04:37', '$2y$12$lMhGARMoY9.OZyAGAOOZ3eeoMUYES5nHuRxEbp5RdU5hMc6DJmnWi', NULL, 'customer', '2026-01-04 11:01:04', '2026-01-04 11:04:37'),
(80, 'Aldy jhonatan Hutasoit', '6285363272621', 'aldyjhonatanhutasoit.1@gmail.com', '2026-01-04 14:04:13', '$2y$12$1Pu4BGrqTCPPczVzOEb0duhzEuQKUngsiP1T8hpKDuUztR6ZsnMRu', 'nMqVZc5AkJjeVaTDFwb9hlqJiffjPDWvvjMwb8LcmTZ9L8LboZJBePS9Itp3', 'customer', '2026-01-04 14:02:17', '2026-01-04 14:04:13'),
(81, 'KIKI', '6281313133544', 'kixtudio@gmail.com', '2026-01-04 18:47:19', '$2y$12$kokCkC5Bbx2k2oiOKq7DOumwFN34vde9V9mb9l2vpHrmvFz9GeUA2', NULL, 'customer', '2026-01-04 18:46:44', '2026-01-04 18:47:19'),
(82, 'Auga Raihan Mustohar', '62895410612219', 'raihanmustohar@gmail.com', '2026-01-05 10:38:18', '$2y$12$xgIjGNRACfWup3XJpgy78Ok/xSJu4oWJo799ZKHkkfuOzgtaOT1A2', 'JaGWbgSz8xAdJSVe4pk2qrCc3Ne4B2T8t9Bz9rDdGjmnFCVFQd4dXddCy13R', 'customer', '2026-01-05 10:35:36', '2026-01-05 10:38:18'),
(83, 'Yamada', '6284938483938', 'yamada@mail.com', NULL, '$2y$12$YDrptQZyY6Ql9DQI8p428u7lM0TWcR/WyX83LzSH6zsfjoWaUkB2e', NULL, 'customer', '2026-01-06 12:31:31', '2026-01-06 12:31:31'),
(84, 'firdaus', '62895627385848', 'ikanpausterbang@gmail.com', NULL, '$2y$12$0qjQwZzgNvhNoBFXwDjr9e3FbPkEHAnz.akkr4NozdQy6VkzENNCy', NULL, 'customer', '2026-01-10 14:12:22', '2026-01-10 14:12:22'),
(85, 'albi', '62895627385823', 'zulalbi37@gmail.com', '2026-01-10 14:15:24', '$2y$12$8pKDTW1npN0YlpVLXxt.Y.gO9/epEicbOAiF2bDPlEGfBkZmIBaiW', NULL, 'customer', '2026-01-10 14:14:39', '2026-01-10 14:15:24'),
(86, 'Admin OTOXPERT', '6281283383800', 'admin@otoxpert.com', NULL, '$2y$12$p36iqZ3sP46K6.xpYRoqdu1VDpK78WydDCPLZNPyFMqsuH6Lx3dMi', NULL, 'mitra', '2026-02-23 04:21:20', '2026-02-23 04:21:20'),
(87, 'PT. Indo Agung Makmur', '6281287891010', 'admin@agungmakmur.com', NULL, '$2y$12$awrWLgcDaC.0hkid6aw6GuemOgrEu5nIHkzBOtH3GxuysWpK3Uga6', NULL, 'mitra', '2026-02-23 04:52:59', '2026-02-23 04:52:59'),
(88, 'Admin Batam Mahkota Mobil', '628117014155', 'admin@batammahkotamobil.com', NULL, '$2y$12$QC.6MBUHegw6YFSxabLkm.OCQmWbjFEDFLoCl9q5XRRt9TboobKeO', NULL, 'mitra', '2026-02-23 05:01:49', '2026-02-23 05:01:49'),
(89, 'Admin ABM Otomotif', '6287812110909', 'admin@obmotomotif.com', NULL, '$2y$12$htB3g9UpmZqFOQtkcbN7OeE4SdApEiZCC2Orzqaya0HUR6rixhSkO', NULL, 'mitra', '2026-02-23 05:10:47', '2026-02-23 05:10:47'),
(90, 'Admin New Batam Maju', '628786003022', 'admin@newbatammaju.com', NULL, '$2y$12$qrdF2oXOz8XDB7TMRMxFN.tn3ENl4fr3o3kfcZLx1hnEvlPQx8D36', NULL, 'mitra', '2026-02-23 05:18:03', '2026-02-23 05:18:03'),
(91, 'Admin Bengkel Tan Mobil', '6281364698889', 'admin@bengkeltanmobil.com', NULL, '$2y$12$FL4tUSZrobYrHEaj03FZee67bcFUpfHS63LqHcwV4Ond2jL8HbtTu', NULL, 'mitra', '2026-02-23 05:24:41', '2026-02-23 05:24:41'),
(92, 'Admin Kyoto Automotive', '6285805016394', 'admin@kyotoautomotive.com', NULL, '$2y$12$p0lWE5hBlR/pmVok0cIFQu8GPdkJMCM438fPa0ed5EmAkMlGhXdP2', NULL, 'mitra', '2026-02-23 05:30:24', '2026-02-23 05:30:24'),
(93, 'Admin GT Auto Batam', '6285837528233', 'admin@gtautobatam.com', NULL, '$2y$12$dbWX0BZf0RNcngMkuUIn4e4AisqL2ZB/tIXR.UCeMqcwydbJTu0qu', NULL, 'mitra', '2026-02-23 07:46:08', '2026-02-23 07:46:08'),
(94, 'Admin LJM Car Servis', '62778429653', 'admin@ljmcarservice.com', NULL, '$2y$12$qaDqmBCZeh8WTvNrS4lVLOLjm6nze5zsqkb4KnouHEqCa/bmksp92', NULL, 'mitra', '2026-02-23 07:52:23', '2026-02-23 07:52:23'),
(95, 'Admin YM Autoworks', '6281278598872', 'admin@ymautowork.com', NULL, '$2y$12$jAT/14ySV1rF5Du0IXY8yum/B9Az4Kt7k/LaOWlQKxhNpv/pC0oZW', NULL, 'mitra', '2026-02-23 07:59:18', '2026-02-23 07:59:18'),
(96, 'Gilang Bagus Ramadhan', '6285156861862', 'gilangbagus.rama@gmail.com', NULL, '$2y$12$lEIHDKHO4sLth3VQPz22N.KM8kJfqnJH4J4tR3eti5rHLj3ZAfAUu', NULL, 'customer', '2026-04-06 07:01:52', '2026-04-06 07:01:52'),
(97, 'walawe', '6285809883084', 'buattugas363@gmail.com', NULL, '$2y$12$t2/PfAj1Ut.5aPFS9Yi.8eTmQlgB9VnzTjWP3IurOpIT7ABbmx7i2', NULL, 'customer', '2026-04-16 02:25:54', '2026-04-16 02:27:11'),
(98, 'M Ajrun Ghoiru Mamnun', '62895410604626', 'muhammadajrunghoirumamnun@gmail.com', NULL, '$2y$12$Pq9f.lSRxcL27LsFwYsB0ePZa5z7fSX9xPyuV8dJDPAd65QLQlOA2', NULL, 'customer', '2026-04-16 07:14:11', '2026-04-16 07:14:11'),
(99, 'Isyabel', '6282175661111', 'isyabelsalsabilla@gmail.com', NULL, '$2y$12$UqVKQtbTBKCZqdMs4iILYeJzGJTsvb0uQEIoxQZM25DPMP1CUlCUO', NULL, 'customer', '2026-04-19 02:17:47', '2026-04-19 02:17:47'),
(100, 'Della Khairunnisa', '6281277901402', 'dellakhairunnisa43@gmail.com', NULL, '$2y$12$Tq.0egYwpWAYmtWKIsUBrOW/xvNLpNl8zMqXv6m/6zigBI8bbIeZK', NULL, 'customer', '2026-04-28 00:18:31', '2026-04-28 00:18:31'),
(101, 'Dimas Dwi Prasetiyo', '6282287446410', 'ddimasddpprasetiyo@gmail.com', NULL, '$2y$12$Ksj645tItM4T0ErpeKCCBeGPCoqur8Ko0dsV3wlNe4wMSjc.f7Z9q', NULL, 'customer', '2026-05-09 09:24:48', '2026-05-09 09:24:48'),
(102, 'rizky nurfadilah', '6285767335490', 'nrfdlhrizky@gmail.com', NULL, '$2y$12$OqShTkM5NwCxtA3peR49q.teuL08ddv.N/u4Hq.AWzL/l9kZ4SryO', NULL, 'customer', '2026-05-14 12:55:34', '2026-05-14 12:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `role` enum('customer','mitra') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_pro` tinyint(1) NOT NULL DEFAULT '0',
  `start_at` date DEFAULT NULL,
  `end_at` date DEFAULT NULL,
  `is_lifetime` tinyint(1) NOT NULL DEFAULT '0',
  `price` int NOT NULL DEFAULT '0',
  `discount` int NOT NULL DEFAULT '0',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_subscriptions`
--

INSERT INTO `user_subscriptions` (`id`, `user_id`, `role`, `is_pro`, `start_at`, `end_at`, `is_lifetime`, `price`, `discount`, `notes`, `created_at`, `updated_at`) VALUES
(44, 71, 'mitra', 1, '2026-04-18', '2026-05-18', 0, 0, 0, 'Aktivasi manual / kupon / gratis', '2026-03-17 06:46:22', '2026-04-18 13:09:28'),
(45, 99, 'customer', 1, '2026-04-19', '2026-05-19', 0, 0, 0, 'Aktivasi manual / kupon / gratis', '2026-04-19 02:20:03', '2026-04-19 02:20:03');

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
(35, 23, 'motor', 'Suzuki', 'All New Satria F150', '2016', 'BP6042GQ', 120000, '2026-05-11', 72, '2025-12-25 13:18:10', '2026-04-19 01:24:07'),
(36, 26, 'mobil', 'Mitsubishi', 'Xpander Cross', '2010', '1121AC', 1500, '2025-12-29', 75, '2025-12-29 12:53:26', '2025-12-29 12:53:26'),
(37, 26, 'mobil', 'Toyota', 'Agya', '2022', 'BP1557AC', 1200, '2025-12-29', 75, '2025-12-29 12:57:30', '2025-12-29 12:57:30'),
(38, 30, 'motor', 'Honda', 'Beat', '2025', 'BP1234X', 8000, '2026-01-04', 80, '2026-01-04 14:05:09', '2026-01-04 14:05:09'),
(39, 36, 'mobil', 'Honda', 'City', '2022', 'BP1646RG', 22000, '2027-11-11', 96, '2026-04-06 07:06:31', '2026-04-06 07:06:31'),
(40, 42, 'mobil', 'Toyota', 'Avanza', '2015', 'BP1038QE', 90000, '2029-07-10', 102, '2026-05-14 13:39:42', '2026-05-14 13:39:42');

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

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
-- Indexes for table `subscription_coupons`
--
ALTER TABLE `subscription_coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_coupons_code_unique` (`code`);

--
-- Indexes for table `subscription_settings`
--
ALTER TABLE `subscription_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_transactions`
--
ALTER TABLE `subscription_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_transactions_merchant_ref_unique` (`merchant_ref`),
  ADD UNIQUE KEY `subscription_transactions_reference_unique` (`reference`),
  ADD KEY `subscription_transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_subscriptions_user_id_foreign` (`user_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `mitras`
--
ALTER TABLE `mitras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mitra_images`
--
ALTER TABLE `mitra_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_orders`
--
ALTER TABLE `service_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `subscription_coupons`
--
ALTER TABLE `subscription_coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `subscription_settings`
--
ALTER TABLE `subscription_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscription_transactions`
--
ALTER TABLE `subscription_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
  ADD CONSTRAINT `service_orders_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `service_orders_mitra_id_foreign` FOREIGN KEY (`mitra_id`) REFERENCES `mitras` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_orders_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `subscription_transactions`
--
ALTER TABLE `subscription_transactions`
  ADD CONSTRAINT `subscription_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD CONSTRAINT `user_subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
