-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2019 at 04:44 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rangkaspcdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu`
--

CREATE TABLE `admin_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Index', 'fa-bar-chart', '/', NULL, NULL),
(2, 0, 2, 'Admin', 'fa-tasks', '', NULL, NULL),
(3, 2, 3, 'Users', 'fa-users', 'auth/users', NULL, NULL),
(4, 2, 4, 'Roles', 'fa-user', 'auth/roles', NULL, NULL),
(5, 2, 5, 'Permission', 'fa-ban', 'auth/permissions', NULL, NULL),
(6, 2, 6, 'Menu', 'fa-bars', 'auth/menu', NULL, NULL),
(7, 2, 7, 'Operation log', 'fa-history', 'auth/logs', NULL, NULL),
(8, 0, 0, 'Product', 'fa-bars', '/products', '2018-04-20 23:04:49', '2018-04-20 23:04:49'),
(9, 0, 0, 'Code', 'fa-bars', '/code', '2018-04-20 23:04:59', '2018-04-20 23:04:59');

-- --------------------------------------------------------

--
-- Table structure for table `admin_operation_log`
--

CREATE TABLE `admin_operation_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_operation_log`
--

INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin/code', 'GET', '127.0.0.1', '[]', '2018-04-20 23:04:20', '2018-04-20 23:04:20'),
(2, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-04-20 23:04:27', '2018-04-20 23:04:27'),
(3, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"title\":\"Product\",\"icon\":\"fa-bars\",\"uri\":\"\\/products\",\"roles\":[\"1\",null],\"_token\":\"2slXa2hxHa3e1aLGt8WwCTJ7GeIPM2BIzzL6NPWI\"}', '2018-04-20 23:04:49', '2018-04-20 23:04:49'),
(4, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2018-04-20 23:04:49', '2018-04-20 23:04:49'),
(5, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"title\":\"Code\",\"icon\":\"fa-bars\",\"uri\":\"\\/code\",\"roles\":[\"1\",null],\"_token\":\"2slXa2hxHa3e1aLGt8WwCTJ7GeIPM2BIzzL6NPWI\"}', '2018-04-20 23:04:59', '2018-04-20 23:04:59'),
(6, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2018-04-20 23:05:00', '2018-04-20 23:05:00'),
(7, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2018-04-20 23:05:03', '2018-04-20 23:05:03'),
(8, 1, 'admin/products', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-04-20 23:05:14', '2018-04-20 23:05:14'),
(9, 1, 'admin/products/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-04-20 23:05:16', '2018-04-20 23:05:16'),
(10, 1, 'admin/products', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-04-20 23:05:47', '2018-04-20 23:05:47'),
(11, 1, 'admin/products/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-04-20 23:05:50', '2018-04-20 23:05:50'),
(12, 1, 'admin/products', 'POST', '127.0.0.1', '{\"type\":\"PC\",\"name\":\"Fallout 4\",\"brand\":\"Bethesda\",\"description\":\"Fallout yg ke empat\",\"gameplay\":\"FPS\",\"price\":\"500000\",\"video\":\"https:\\/\\/www.youtube.com\\/embed\\/2gUtfBmw86Y\",\"_token\":\"2slXa2hxHa3e1aLGt8WwCTJ7GeIPM2BIzzL6NPWI\",\"_previous_\":\"http:\\/\\/localhost:8000\\/admin\\/products\"}', '2018-04-20 23:06:20', '2018-04-20 23:06:20'),
(13, 1, 'admin/products', 'GET', '127.0.0.1', '[]', '2018-04-20 23:06:21', '2018-04-20 23:06:21'),
(14, 1, 'admin/code', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-04-20 23:06:27', '2018-04-20 23:06:27'),
(15, 1, 'admin/code/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-04-20 23:06:29', '2018-04-20 23:06:29'),
(16, 1, 'admin/code', 'POST', '127.0.0.1', '{\"product_id\":\"1\",\"code\":\"QWERT-QWERT-QWERT\",\"_token\":\"2slXa2hxHa3e1aLGt8WwCTJ7GeIPM2BIzzL6NPWI\",\"_previous_\":\"http:\\/\\/localhost:8000\\/admin\\/code\"}', '2018-04-20 23:06:36', '2018-04-20 23:06:36'),
(17, 1, 'admin/code', 'GET', '127.0.0.1', '[]', '2018-04-20 23:06:36', '2018-04-20 23:06:36'),
(18, 1, 'admin/products', 'GET', '127.0.0.1', '[]', '2018-04-21 03:41:10', '2018-04-21 03:41:10'),
(19, 1, 'admin/products/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-04-21 03:41:15', '2018-04-21 03:41:15'),
(20, 1, 'admin/products', 'POST', '127.0.0.1', '{\"type\":\"digital\",\"name\":\"Player Unknown\'s Battleground\",\"brand\":\"Steam\",\"description\":\"LALLA\",\"gameplay\":\"FPS\",\"price\":\"500000\",\"video\":\"https:\\/\\/www.youtube.com\\/embed\\/GE2BkLqMef4\",\"_token\":\"4MOlzBuTsSFUFvagmkLN8NAwUz2No0tmiWncT6hv\",\"_previous_\":\"http:\\/\\/localhost:8000\\/admin\\/products\"}', '2018-04-21 03:41:48', '2018-04-21 03:41:48'),
(21, 1, 'admin/products', 'GET', '127.0.0.1', '[]', '2018-04-21 03:41:49', '2018-04-21 03:41:49'),
(22, 1, 'admin/products/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-04-21 03:41:52', '2018-04-21 03:41:52'),
(23, 1, 'admin/products', 'POST', '127.0.0.1', '{\"type\":\"PC\",\"name\":\"CS:GO\",\"brand\":\"VALVE\",\"description\":\"LALLA\",\"gameplay\":\"FPS\",\"price\":\"150000\",\"video\":\"https:\\/\\/www.youtube.com\\/embed\\/Lb-f9P_tyQQ\",\"_token\":\"4MOlzBuTsSFUFvagmkLN8NAwUz2No0tmiWncT6hv\",\"_previous_\":\"http:\\/\\/localhost:8000\\/admin\\/products\"}', '2018-04-21 03:42:22', '2018-04-21 03:42:22'),
(24, 1, 'admin/products', 'GET', '127.0.0.1', '[]', '2018-04-21 03:42:23', '2018-04-21 03:42:23'),
(25, 1, 'admin', 'GET', '127.0.0.1', '[]', '2018-04-22 21:20:54', '2018-04-22 21:20:54'),
(26, 1, 'admin', 'GET', '127.0.0.1', '[]', '2018-04-23 05:09:37', '2018-04-23 05:09:37'),
(27, 1, 'admin/code', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-04-23 05:09:42', '2018-04-23 05:09:42'),
(28, 1, 'admin/code/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-04-23 05:09:45', '2018-04-23 05:09:45'),
(29, 1, 'admin/code', 'POST', '127.0.0.1', '{\"product_id\":\"2\",\"code\":\"12345-QWERT-ASDFG\",\"_token\":\"1l81V6Nh6OzAKeuTLRvS1Zn6xrVt4azc75UEENlE\",\"_previous_\":\"http:\\/\\/localhost:8000\\/admin\\/code\"}', '2018-04-23 05:09:52', '2018-04-23 05:09:52'),
(30, 1, 'admin/code', 'GET', '127.0.0.1', '[]', '2018-04-23 05:09:53', '2018-04-23 05:09:53'),
(31, 1, 'admin/code/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-04-23 05:11:03', '2018-04-23 05:11:03'),
(32, 1, 'admin/code', 'POST', '127.0.0.1', '{\"product_id\":\"1\",\"code\":\"QWERT-QWERT-QWERT\",\"_token\":\"1l81V6Nh6OzAKeuTLRvS1Zn6xrVt4azc75UEENlE\",\"_previous_\":\"http:\\/\\/localhost:8000\\/admin\\/code\"}', '2018-04-23 05:11:10', '2018-04-23 05:11:10'),
(33, 1, 'admin/code', 'GET', '127.0.0.1', '[]', '2018-04-23 05:11:10', '2018-04-23 05:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `admin_permissions`
--

CREATE TABLE `admin_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `created_at`, `updated_at`) VALUES
(1, 'All permission', '*', '', '*', NULL, NULL),
(2, 'Dashboard', 'dashboard', 'GET', '/', NULL, NULL),
(3, 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, NULL),
(4, 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, NULL),
(5, 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator', '2018-04-20 23:02:24', '2018-04-20 23:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `admin_role_menu`
--

CREATE TABLE `admin_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_role_menu`
--

INSERT INTO `admin_role_menu` (`role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL),
(1, 8, NULL, NULL),
(1, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_role_permissions`
--

CREATE TABLE `admin_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_role_permissions`
--

INSERT INTO `admin_role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_role_users`
--

CREATE TABLE `admin_role_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_role_users`
--

INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$CbTSb9cid5OS5R4GDNKZfeuMWUSqWZkjUIK7BTBHvpJE0bLKM/KqC', 'Administrator', NULL, NULL, '2018-04-20 23:02:24', '2018-04-20 23:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_permissions`
--

CREATE TABLE `admin_user_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carousels`
--

CREATE TABLE `carousels` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`id`, `product_id`, `code`) VALUES
(2, 2, '12345-QWERT-ASDFG'),
(3, 1, 'QWERT-QWERT-QWERT');

-- --------------------------------------------------------

--
-- Table structure for table `featureds`
--

CREATE TABLE `featureds` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `total_price` int(10) UNSIGNED NOT NULL,
  `total_item` tinyint(4) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Paid',
  `payment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `user_id`, `total_price`, `total_item`, `status`, `payment_id`, `payment_type`, `payment_date`) VALUES
(1, 2, 500000, 1, 'Paid', '5adad5973f8f4', 'credit_card', '2018-04-21'),
(2, 2, 1000000, 2, 'Paid', '5addcd7f48f93', 'credit_card', '2018-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2016_01_04_173148_create_admin_tables', 1),
(3, '2018_03_29_035947_create_users_table', 1),
(4, '2018_03_29_040354_create_products_table', 1),
(5, '2018_03_29_094523_create_invoices_table', 1),
(6, '2018_03_29_095025_create_orders_table', 1),
(7, '2018_03_30_110321_create_admins_table', 1),
(8, '2018_04_02_135106_create_user_verifications_table', 1),
(9, '2018_04_09_072247_create_carousels_table', 1),
(10, '2018_04_09_072824_create_featureds_table', 1),
(11, '2018_04_20_111106_create_codes_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `total_price` int(10) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `invoice_id`, `product_id`, `total_price`, `amount`) VALUES
(1, 1, 1, 500000, 1),
(2, 2, 2, 500000, 1),
(3, 2, 1, 500000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gameplay` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `stock` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sold` int(11) NOT NULL DEFAULT '0',
  `img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `video` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `type`, `name`, `brand`, `description`, `gameplay`, `price`, `views`, `stock`, `sold`, `img`, `video`, `created_at`, `updated_at`) VALUES
(1, 'PC', 'Fallout 4', 'Bethesda', 'Fallout yg ke empat', 'FPS', 500000, 0, 1, 1, 'image/40ce1055016890cc2f2b054c7ec2ed34.jpg', 'https://www.youtube.com/embed/2gUtfBmw86Y', '2018-04-20 23:06:20', '2018-04-23 05:12:32'),
(2, 'digital', 'Player Unknown\'s Battleground', 'Steam', 'LALLA', 'FPS', 500000, 1, 0, 0, 'image/4ca2b57e0bd4e4d359a297d0dd7be25c.jpg', 'https://www.youtube.com/embed/GE2BkLqMef4', '2018-04-21 03:41:48', '2018-04-21 21:50:18'),
(3, 'PC', 'CS:GO', 'VALVE', 'LALLA', 'FPS', 150000, 0, 0, 0, 'image/d3e9539833bab8f66cf640785bf441f6.jpg', 'https://www.youtube.com/embed/Lb-f9P_tyQQ', '2018-04-21 03:42:22', '2018-04-21 03:42:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `phone` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` int(11) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `birthdate`, `phone`, `address`, `city`, `state`, `zip`, `is_verified`) VALUES
(1, 'Nicolas Bryan', 'nicbryan77@gmail.com', '$2y$10$zs/e7/wlU5Klx5Bc8PlcEuVWfzn833NYk.tSVMgYEcBUXtYcTjGXi', '1998-08-12', '082153100681', 'Layap Permai 2 no.9', 'Jakarta', 'DKI Jakarta', 14460, 0),
(2, 'Nicolas Bryan', 'nicbryan777@gmail.com', '$2y$10$Zxx16bsbYicLz56Pv685Uuurmz8ma5WfLJ2Rzc08Jp9smFG2om37W', '1998-08-12', '082153100681', 'Layap Permai 2 no.9', 'Jakarta', 'DKI Jakarta', 14460, 1),
(4, 'nicolas', 'nicbryan779@gmail.com', '$2y$10$7zstiBlBjfi5uVDIKA8AVeaCyR3PwIJUcrhfSOxIL4/4YEVrQSTjq', '1998-12-08', '082153100681', 'Layar Permai 2 no.9', 'Jakarta', 'crazeee', 14460, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_verifications`
--

CREATE TABLE `user_verifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_verifications`
--

INSERT INTO `user_verifications` (`id`, `user_id`, `token`) VALUES
(1, 1, 'VfQ8wj33sIrhHUrqa7tTX6V8gmsacc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_operation_log`
--
ALTER TABLE `admin_operation_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_operation_log_user_id_index` (`user_id`);

--
-- Indexes for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_permissions_name_unique` (`name`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_roles_name_unique` (`name`);

--
-- Indexes for table `admin_role_menu`
--
ALTER TABLE `admin_role_menu`
  ADD KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`);

--
-- Indexes for table `admin_role_permissions`
--
ALTER TABLE `admin_role_permissions`
  ADD KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`);

--
-- Indexes for table `admin_role_users`
--
ALTER TABLE `admin_role_users`
  ADD KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_username_unique` (`username`);

--
-- Indexes for table `admin_user_permissions`
--
ALTER TABLE `admin_user_permissions`
  ADD KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`);

--
-- Indexes for table `carousels`
--
ALTER TABLE `carousels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codes_product_id_foreign` (`product_id`);

--
-- Indexes for table `featureds`
--
ALTER TABLE `featureds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `featureds_product_id_foreign` (`product_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_user_id_foreign` (`user_id`);

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
  ADD KEY `orders_invoice_id_foreign` (`invoice_id`),
  ADD KEY `orders_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_verifications`
--
ALTER TABLE `user_verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_verifications_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admin_operation_log`
--
ALTER TABLE `admin_operation_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carousels`
--
ALTER TABLE `carousels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `featureds`
--
ALTER TABLE `featureds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_verifications`
--
ALTER TABLE `user_verifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `codes`
--
ALTER TABLE `codes`
  ADD CONSTRAINT `codes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `featureds`
--
ALTER TABLE `featureds`
  ADD CONSTRAINT `featureds_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `user_verifications`
--
ALTER TABLE `user_verifications`
  ADD CONSTRAINT `user_verifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
