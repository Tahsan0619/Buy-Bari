-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2026 at 02:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buybari`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `plain` tinyint(1) NOT NULL DEFAULT 1,
  `eyebrow` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `cta` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `alt`, `link`, `plain`, `eyebrow`, `title`, `text`, `cta`, `category`, `sort`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '/images/banners/client-1.jpeg', 'Buybari: everything you need, one place', '/#products', 1, NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-10-13 06:17:19', '2026-10-13 06:17:19'),
(2, '/images/banners/client-2.jpeg', 'Welcome to Buybari', '/#products', 1, NULL, NULL, NULL, NULL, NULL, 2, 1, '2026-10-13 06:17:19', '2026-10-13 06:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('buybari-cache-buybari.settings', 'a:12:{s:7:\"address\";s:17:\"Dhaka, Bangladesh\";s:15:\"delivery_inside\";s:2:\"70\";s:16:\"delivery_outside\";s:3:\"130\";s:5:\"email\";s:21:\"contactus@buybari.com\";s:8:\"facebook\";s:42:\"https://www.facebook.com/share/1CRT4Dpc91/\";s:5:\"hours\";s:41:\"Saturday to Thursday, 10:00 AM to 8:00 PM\";s:4:\"logo\";s:16:\"/images/logo.png\";s:4:\"name\";s:7:\"Buybari\";s:5:\"phone\";s:16:\"+880 1777-012681\";s:10:\"phone_link\";s:14:\"+8801777012681\";s:7:\"tagline\";s:116:\"Everything your bari needs: home, kitchen, gadgets, fashion and food, delivered to your door anywhere in Bangladesh.\";s:8:\"whatsapp\";s:13:\"8801777012681\";}', 1791894596);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'grid',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'Home Decor', 'home-decor', 'sofa', 1, '2026-10-13 06:17:19', '2026-10-13 06:17:19'),
(2, 'Home & Kitchen', 'home-kitchen', 'kitchen', 2, '2026-10-13 06:17:19', '2026-10-13 06:17:19'),
(3, 'Electronics', 'electronics', 'plug', 3, '2026-10-13 06:17:19', '2026-10-13 06:17:19'),
(4, 'Smart Gadgets', 'smart-gadgets', 'watch', 4, '2026-10-13 06:17:19', '2026-10-13 06:17:19'),
(5, 'Men\'s Fashion', 'mens-fashion', 'shirt', 5, '2026-10-13 06:17:19', '2026-10-13 06:17:19'),
(6, 'Women\'s Fashion', 'womens-fashion', 'dress', 6, '2026-10-13 06:17:19', '2026-10-13 06:17:19'),
(7, 'Kids\' Fashion', 'kids-fashion', 'kid', 7, '2026-10-13 06:17:19', '2026-10-13 06:17:19'),
(8, 'Life Style', 'life-style', 'sparkle', 8, '2026-10-13 06:17:19', '2026-10-13 06:17:19'),
(9, 'Groceries & Food', 'groceries-food', 'food', 9, '2026-10-13 06:17:19', '2026-10-13 06:17:19'),
(10, 'Bath & Hardware', 'bath-hardware', 'wrench', 10, '2026-10-13 06:17:19', '2026-10-13 06:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_13_000001_create_shop_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `zone` varchar(255) NOT NULL DEFAULT 'inside',
  `address` text NOT NULL,
  `area` varchar(255) DEFAULT NULL,
  `subtotal` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `delivery_cost` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `discount` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `advance` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `total` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `payment_type` varchar(255) NOT NULL DEFAULT 'cod',
  `payment_gateway` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `special_notes` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `nittoz_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`nittoz_response`)),
  `transferred_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `b_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `qty` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `variant_sku` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `b_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `old_price` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `section` varchar(255) NOT NULL DEFAULT 'regular',
  `badge` varchar(255) NOT NULL DEFAULT 'feature',
  `rating` tinyint(3) UNSIGNED NOT NULL DEFAULT 5,
  `reviews` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_variable` tinyint(1) NOT NULL DEFAULT 0,
  `variants` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`variants`)),
  `raw` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`raw`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `synced_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `b_product_id`, `category_id`, `name`, `slug`, `image`, `price`, `old_price`, `description`, `section`, `badge`, `rating`, `reviews`, `is_variable`, `variants`, `raw`, `is_active`, `synced_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Handmade Ceramic Vase Set (3 pcs)', 'vase-set', '/images/products/vase-set.jpg', 1250, 1550, 'A trio of hand-thrown ceramic vases in cream, terracotta and red. Perfect for dried flowers or as standalone decor on shelves and tables.', 'hot', 'hot', 5, 48, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(2, NULL, 4, 'Pro Wireless Earbuds with ENC', 'earbuds', '/images/products/earbuds.jpg', 1450, 1900, 'Bluetooth 5.3 earbuds with environmental noise cancellation, 30 hours total playback with the case and touch controls.', 'hot', 'hot', 5, 126, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(3, NULL, 2, 'Granite Non-Stick Frying Pan 26cm', 'frying-pan', '/images/products/frying-pan.jpg', 990, 1250, 'PFOA-free granite coating, induction compatible base and a cool-touch wood-look handle. Cooks evenly with less oil.', 'hot', 'hot', 5, 73, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(4, NULL, 5, 'Premium Cotton Panjabi (Maroon)', 'panjabi', '/images/products/panjabi.jpg', 1850, 2200, 'Soft, breathable cotton panjabi with tone-on-tone embroidery on the collar and placket. Available in M, L, XL and XXL.', 'hot', 'hot', 5, 64, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(5, NULL, 6, 'Embroidered Cotton Three Piece', 'three-piece', '/images/products/three-piece.jpg', 2250, 2650, 'Unstitched cotton three piece with floral hand-embroidery on the kameez and a printed matching dupatta.', 'hot', 'hot', 5, 91, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(6, NULL, 4, 'Smart Fitness Watch with Calling', 'smartwatch', '/images/products/smartwatch.jpg', 2490, 2990, '1.85\" HD display, Bluetooth calling, heart-rate and SpO2 tracking, 100+ sports modes and up to 7 days battery.', 'hot', 'hot', 4, 57, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(7, NULL, 8, 'Insulated Steel Water Bottle 1L', 'bottle', '/images/products/bottle.jpg', 650, 800, 'Double-wall vacuum insulation keeps drinks cold for 24 hours or hot for 12. Leak-proof steel cap with carry loop.', 'hot', 'hot', 5, 112, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(8, NULL, 3, 'Rechargeable LED Desk Lamp', 'desk-lamp', '/images/products/desk-lamp.jpg', 1150, 1400, 'Foldable arm, 3 color temperatures, stepless dimming and a 2000mAh battery. Eye-friendly light for study and work.', 'hot', 'hot', 4, 39, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(9, NULL, 7, 'Kids Cotton T-Shirt & Shorts Set', 'kids-set', '/images/products/kids-set.jpg', 590, 850, 'Comfortable 100% cotton tee with leaf print and soft navy shorts. Sizes for ages 2 to 10.', 'discount', 'discount', 5, 44, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(10, NULL, 2, 'Electric Kettle 1.8L (Red)', 'kettle', '/images/products/kettle.jpg', 1290, 1650, '1500W fast boil, stainless steel base, auto shut-off and boil-dry protection. Brews tea for the whole family.', 'discount', 'discount', 5, 88, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(11, NULL, 9, 'Natural Wildflower Honey 500g', 'honey', '/images/products/honey.jpg', 650, 850, 'Raw, unprocessed honey collected from wildflower farms. No added sugar or preservatives.', 'discount', 'discount', 5, 203, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(12, NULL, 1, 'Premium Cotton Bath Towel Set (3 pcs)', 'towels', '/images/products/towels.jpg', 890, 1200, 'Thick, absorbent and quick-drying cotton towels in coral, orange and cream.', 'discount', 'discount', 4, 51, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(13, NULL, 3, '20W Type-C Fast Charger with Cable', 'charger', '/images/products/charger.jpg', 580, 750, 'PD 20W fast charging adapter with a 1m USB-C cable. Charges compatible phones up to 50% in 30 minutes. 6 month warranty.', 'new', 'new', 5, 97, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(14, NULL, 3, 'Portable Bluetooth Speaker (Orange)', 'speaker', '/images/products/speaker.jpg', 1350, 1650, 'Rich bass, IPX6 water resistance, 12-hour battery and a detachable strap for outdoor trips.', 'new', 'new', 5, 62, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(15, NULL, 6, 'Structured Leather Tote Bag (Red)', 'handbag', '/images/products/handbag.jpg', 1690, 2100, 'Spacious PU leather tote with gold hardware, inner zip pocket and sturdy double handles.', 'new', 'new', 5, 38, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(16, NULL, 7, 'Kids School Backpack', 'backpack', '/images/products/backpack.jpg', 990, 1250, 'Lightweight, water-resistant backpack with padded straps and a front organiser pocket.', 'new', 'new', 5, 29, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(17, NULL, 1, 'Floral Cotton Bedsheet Set (King)', 'bedsheet', '/images/products/bedsheet.jpg', 1450, 1800, 'King size pure cotton bedsheet with two matching pillow covers. Colorfast print that stays bright wash after wash.', 'new', 'new', 5, 76, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(18, NULL, 9, 'Premium Mixed Dry Fruits & Nuts 500g', 'dry-fruits', '/images/products/dry-fruits.jpg', 890, 1050, 'Almonds, cashews, pistachios, walnuts, golden raisins and dates, freshly packed.', 'new', 'new', 5, 134, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(19, NULL, 6, 'Georgette Hijab Set (3 pcs)', 'hijab', '/images/products/hijab.jpg', 450, 600, 'Soft, lightweight georgette hijabs in coral, peach and mustard. Easy to style and breathable.', 'new', 'new', 4, 85, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(20, NULL, 5, 'Men\'s Casual Low-Top Sneakers', 'sneakers', '/images/products/sneakers.jpg', 1990, 2400, 'Leather and suede upper with a cushioned insole and durable rubber sole. Sizes 39 to 44.', 'new', 'new', 4, 47, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(21, NULL, 10, 'Chrome Basin Mixer Faucet', 'faucet', '/images/products/faucet.jpg', 1600, 1900, 'Solid brass body with a mirror chrome finish, ceramic cartridge and hot/cold single lever control.', 'regular', 'feature', 5, 22, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(22, NULL, 2, 'Glass Food Storage Container Set (4 pcs)', 'containers', '/images/products/containers.jpg', 1100, 1350, 'Borosilicate glass containers with airtight snap-lock lids. Microwave, oven and freezer safe.', 'regular', 'feature', 5, 58, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(23, NULL, 8, 'Stainless Steel 3-Tier Tiffin Box', 'tiffin', '/images/products/tiffin.jpg', 750, 950, 'Food-grade stainless steel tiffin carrier with secure side clips. Ideal for office and school lunches.', 'regular', 'feature', 5, 66, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55'),
(24, NULL, 1, 'Minimal Wooden Wall Clock 12\"', 'wall-clock', '/images/products/wall-clock.jpg', 950, 1200, 'Silent sweep movement, natural wood frame and a clean cream dial with orange markers.', 'regular', 'feature', 4, 31, 0, NULL, NULL, 1, NULL, '2026-10-13 06:18:55', '2026-10-13 06:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('25NlM83jKf9r4Sfti1ToooLU6E7xlvYdiphVhLWb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJ0ZTBXRjFnam5QVWVVRlpaSmEyTE9rcnBjSmV1V2lmdFdOM3EwemV3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jb250YWN0Iiwicm91dGUiOiJjb250YWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791893993),
('hl22YjY5dlfWOqFUqYlCdS3UAj9DVpSwwCHnPpSx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJCd3lINURlaG1mbG5hcG1GUTRkaUxDcGRERVRSSVdoSGpSU0NYTlJNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791894018),
('hUkaQxFIR7K6DKsChcPLSCTjfpVV4uJDqBW1ybrW', NULL, '127.0.0.1', 'curl/8.21.0', 'eyJfdG9rZW4iOiJYY3ZVQUp6ME55NUswRUxYallsaVVKWFdUaEQyRjd6S2s4SU16NDFuIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791894277),
('ncd86Smisi3Gbwje1PW2nUPsV9FXjM6WWEoYhFWr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJlSURmeWw0c0JoSElBNVVrUU1samtJOGx2cGtLWEphbXNtNVlxVHJrIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC90ZXJtcyIsInJvdXRlIjoidGVybXMifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791893993),
('PFjT8wfQuoOLSLLw66OmkuKV5nvI8bLT9sKOFUsU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJodVVya1M0V25VODk5WEFMUldUN0RHbXFoWmN4YVJCWFNUcnZnS3VmIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791893991),
('qManpuGdZ5twjgG626kt0p3s4Gcqhc7eh55tMwgK', 1, '127.0.0.1', 'curl/8.21.0', 'eyJfdG9rZW4iOiJTS0g3MkZRTUlmdXN6WXREdFEwbm5BTHpWeXA3dm1ST1dFUUQyWndxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvb3JkZXJzXC8xIiwicm91dGUiOiJhZG1pbi5vcmRlcnMuc2hvdyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sInVybCI6W10sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJwYXNzd29yZF9oYXNoX3dlYiI6IjUwYzdhYTJlNzkyOTAyM2NkYWYzMGMzMDkzZDY0NWJiY2ZiNjJmYWFjYjU4ZjBmMWJjOTE5NmQwZDYzNDYxY2UifQ==', 1791894258),
('R3ud2SbSWigXWKIm4Rrx8WLs5FtXPHWEru3mw3sh', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Cursor/3.2.16 Chrome/142.0.7444.265 Electron/39.8.1 Safari/537.36', 'eyJfdG9rZW4iOiJOOGY0YnBpS2tSblltV1o2UTFiRDJxcnRMREd5VzVKa2RnQ2VXRU4yIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvYmFubmVycyIsInJvdXRlIjoiYWRtaW4uYmFubmVycy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJwYXNzd29yZF9oYXNoX3dlYiI6IjUwYzdhYTJlNzkyOTAyM2NkYWYzMGMzMDkzZDY0NWJiY2ZiNjJmYWFjYjU4ZjBmMWJjOTE5NmQwZDYzNDYxY2UifQ==', 1791894764),
('r4xzmMCo55pGV5luk8ScxyrQxhhfoc5FIuNa1Kbq', NULL, '127.0.0.1', 'curl/8.21.0', 'eyJfdG9rZW4iOiJ0YkR3MFU2Qjd3bU1yREdiQndvbjloNUxQUVFwR1NsRHNQREpqenhJIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9jb250YWN0Iiwicm91dGUiOiJjb250YWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791894276),
('sHLdzpT7sqf4neVFOEz9kFa3x9bePOS6PUDsXDWX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJwYlNGS3pGSEJ5V2lXcWlkN3VNWmVNVjVBZ2NtaTNuUUY1aVVRem1OIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hYm91dCIsInJvdXRlIjoiYWJvdXQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1791893992),
('UnzpjJgkLMbDAn7NmNnoHq6CUPeJ52UlZO0w6cQp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJvZnE0d0dKMVVuaWwwejdpZTRhMDhGS3VDUWdsMTJydXFLNXN1NVl4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wcm9kdWN0XC9zbWFydHdhdGNoIiwicm91dGUiOiJwcm9kdWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791893992),
('vCgx2RaSYrA79T5Y9GlzoaWvWVFfSH6FdFvHErFc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJMamI2RGltWUhLRnNuVXkwZTBEbzM1RW8yUHhJTkFnZlhoVmNscGhyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvbG9naW4iLCJyb3V0ZSI6ImFkbWluLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791893993),
('XHohIdq2V9tuneH6G2mKiDXC3GULODShegHWDb7d', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJ1NmduNTYyQ1dpNWFYSm9DMmpyQzR6dTBNdHBDRTZCY2RwZHcyaHBPIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluIn0sIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYWRtaW4iLCJyb3V0ZSI6ImFkbWluLmRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1791893993),
('XHVzjF1cFDqDgzpVLfgeFbzewJKLosWtJBYQWwdp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiI5Y0lOOTJudGdibjZRc2hwZXNYd2VXY0tZUjN1QklPUmpPbWFrcUR1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791894008),
('xxo0FQdv6LuKFinnBpMUoYPxleLsUAUJp36h7g8Z', NULL, '127.0.0.1', 'curl/8.21.0', 'eyJfdG9rZW4iOiJ5alVpY0FMd2RHSjFEWkF1dnRYdW9lYTRCM0hiMXR3THRUb2Fyb1o4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791894074),
('z4gvV50mweGPacEzxhSGSiGAUDG6UWWaIOG7bGuc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.26100.9444', 'eyJfdG9rZW4iOiJ5WnhCTEFKOEtiVlFJSlowMHFGYXJaTnpqSXprRlh0MEpSSzhlNEh4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvbG9naW4iLCJyb3V0ZSI6ImFkbWluLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1791894008);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`key`, `value`) VALUES
('address', 'Dhaka, Bangladesh'),
('delivery_inside', '70'),
('delivery_outside', '130'),
('email', 'contactus@buybari.com'),
('facebook', 'https://www.facebook.com/share/1CRT4Dpc91/'),
('hours', 'Saturday to Thursday, 10:00 AM to 8:00 PM'),
('logo', '/images/logo.png'),
('name', 'Buybari'),
('phone', '+880 1777-012681'),
('phone_link', '+8801777012681'),
('tagline', 'Everything your bari needs: home, kitchen, gadgets, fashion and food, delivered to your door anywhere in Bangladesh.'),
('whatsapp', '8801777012681');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Buybari Admin', 'admin@gmail.com', NULL, '$2y$12$InafqNgPtrc1iGFzk.hom.OAaYusH9v5MpxU8c6.n5lfP3AT0DdOW', NULL, '2026-10-13 06:17:18', '2026-10-13 06:30:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_no_unique` (`order_no`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_b_product_id_unique` (`b_product_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
