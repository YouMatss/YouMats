-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2021 at 03:18 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `youmats`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_events`
--

CREATE TABLE `action_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionable_id` bigint(20) UNSIGNED NOT NULL,
  `target_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fields` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'running',
  `exception` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `original` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `changes` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'superAdmin@youmats.com', NULL, '$2y$10$qPo5LC0mR8SbYReK/wC1A.q6XoFWShqQv3fF8qiEBkGREWFYsR9MG', NULL, NULL, '2021-02-09 11:59:13', '2021-02-09 11:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `sort` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` decimal(10,6) NOT NULL DEFAULT 1.000000,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `days` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_limit` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2013_12_30_155229_create_admins_table', 1),
(2, '2013_12_30_155618_create_languages_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2018_01_01_000000_create_action_events_table', 1),
(6, '2019_05_10_000000_add_fields_to_action_events_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2020_12_16_192147_create_memberships_table', 1),
(9, '2020_12_16_192405_create_countries_table', 1),
(10, '2020_12_16_192414_create_cities_table', 1),
(11, '2020_12_30_155247_create_vendors_table', 1),
(12, '2020_12_30_155516_create_faqs_table', 1),
(13, '2020_12_30_173130_create_categories_table', 1),
(14, '2020_12_30_173708_create_sub_categories_table', 1),
(15, '2021_01_05_140752_create_products_table', 1),
(16, '2021_01_06_130036_create_media_table', 1),
(17, '2021_01_11_142658_create_permission_tables', 1),
(18, '2021_01_13_152145_create_orders_table', 1),
(19, '2021_01_13_154951_create_order_items_table', 1),
(20, '2021_01_16_192356_create_tags_table', 1),
(21, '2021_01_17_172730_create_product_tag_table', 1),
(22, '2021_01_18_151641_create_subscribers_table', 1),
(23, '2021_01_18_153215_create_contacts_table', 1),
(24, '2021_01_18_155024_create_currencies_table', 1),
(25, '2021_01_18_224614_create_pages_table', 1),
(26, '2021_01_19_125707_create_quotes_table', 1),
(27, '2021_01_19_134340_create_quote_items_table', 1),
(28, '2021_01_20_133136_create_contents_table', 1),
(29, '2021_01_20_202812_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` enum('cash','credit card','paypal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_exp_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_date` timestamp NULL DEFAULT NULL,
  `payment_status` enum('pending','refunded','completed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` enum('pending','shipping','completed','refused') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refused_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` double NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
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
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `SKU` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'viewAny users', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(2, 'view users', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(3, 'create users', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(4, 'update users', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(5, 'delete users', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(6, 'restore users', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(7, 'forceDelete users', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(8, 'viewAny vendors', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(9, 'view vendors', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(10, 'create vendors', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(11, 'update vendors', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(12, 'delete vendors', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(13, 'restore vendors', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(14, 'forceDelete vendors', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(15, 'viewAny categories', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(16, 'view categories', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(17, 'create categories', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(18, 'update categories', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(19, 'delete categories', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(20, 'restore categories', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(21, 'forceDelete categories', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(22, 'viewAny subCategories', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(23, 'view subCategories', 'admin', '2021-02-09 11:59:16', '2021-02-09 11:59:16'),
(24, 'create subCategories', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(25, 'update subCategories', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(26, 'delete subCategories', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(27, 'restore subCategories', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(28, 'forceDelete subCategories', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(29, 'viewAny products', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(30, 'view products', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(31, 'create products', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(32, 'update products', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(33, 'delete products', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(34, 'restore products', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(35, 'forceDelete products', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(36, 'viewAny languages', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(37, 'view languages', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(38, 'create languages', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(39, 'update languages', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(40, 'delete languages', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(41, 'restore languages', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(42, 'forceDelete languages', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(43, 'viewAny faqs', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(44, 'view faqs', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(45, 'create faqs', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(46, 'update faqs', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(47, 'delete faqs', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(48, 'restore faqs', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(49, 'forceDelete faqs', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(50, 'viewAny orders', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(51, 'view orders', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(52, 'create orders', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(53, 'update orders', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(54, 'delete orders', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(55, 'restore orders', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(56, 'forceDelete orders', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(57, 'viewAny quotes', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(58, 'view quotes', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(59, 'create quotes', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(60, 'update quotes', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(61, 'delete quotes', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(62, 'restore quotes', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(63, 'forceDelete quotes', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(64, 'viewAny countries', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(65, 'view countries', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(66, 'create countries', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(67, 'update countries', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(68, 'delete countries', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(69, 'restore countries', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(70, 'forceDelete countries', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(71, 'viewAny cities', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(72, 'view cities', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(73, 'create cities', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(74, 'update cities', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(75, 'delete cities', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(76, 'restore cities', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(77, 'forceDelete cities', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(78, 'viewAny contacts', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(79, 'view contacts', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(80, 'create contacts', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(81, 'update contacts', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(82, 'delete contacts', 'admin', '2021-02-09 11:59:17', '2021-02-09 11:59:17'),
(83, 'restore contacts', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(84, 'forceDelete contacts', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(85, 'viewAny subscribers', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(86, 'view subscribers', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(87, 'create subscribers', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(88, 'update subscribers', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(89, 'delete subscribers', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(90, 'restore subscribers', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(91, 'forceDelete subscribers', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(92, 'viewAny tags', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(93, 'view tags', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(94, 'create tags', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(95, 'update tags', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(96, 'delete tags', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(97, 'restore tags', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(98, 'forceDelete tags', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(99, 'viewAny currencies', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(100, 'view currencies', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(101, 'create currencies', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(102, 'update currencies', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(103, 'delete currencies', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(104, 'restore currencies', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(105, 'forceDelete currencies', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(106, 'viewAny memberships', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(107, 'view memberships', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(108, 'create memberships', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(109, 'update memberships', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(110, 'delete memberships', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(111, 'restore memberships', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(112, 'forceDelete memberships', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(113, 'viewAny pages', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(114, 'view pages', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(115, 'create pages', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(116, 'update pages', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(117, 'delete pages', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(118, 'restore pages', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18'),
(119, 'forceDelete pages', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subCategory_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` decimal(10,1) NOT NULL,
  `type` enum('product','service') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stoke` int(11) NOT NULL DEFAULT 0,
  `unit` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SKU` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `views` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE `product_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quote_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` enum('pending','shipping','completed','refused') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_price` double DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quote_items`
--

CREATE TABLE `quote_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quote_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `SKU` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin', '2021-02-09 11:59:18', '2021-02-09 11:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('individual','company') COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `name`, `email`, `phone`, `phone2`, `email_verified_at`, `password`, `address`, `address2`, `remember_token`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'individual', 'Mohamed Maher', 'developer@seoera.net', '01064323735', NULL, '2021-02-09 12:13:41', '$2y$10$otaVcv8a2qlYPrjGTXiXg.yGO2K9UIYzT2Oass2ffs/5a5HGQ0cRK', 'Maadi', NULL, NULL, 1, NULL, '2021-02-09 12:13:07', '2021-02-09 12:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `membership_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isFeatured` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_events`
--
ALTER TABLE `action_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_events_actionable_type_actionable_id_index` (`actionable_type`,`actionable_id`),
  ADD KEY `action_events_batch_id_model_type_model_id_index` (`batch_id`,`model_type`,`model_id`),
  ADD KEY `action_events_user_id_index` (`user_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_index` (`country_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contents_key_unique` (`key`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_name_unique` (`name`),
  ADD UNIQUE KEY `currencies_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_slug_unique` (`slug`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_id_unique` (`order_id`),
  ADD KEY `orders_user_id_index` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_index` (`order_id`),
  ADD KEY `order_items_product_id_index` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`SKU`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_subcategory_id_index` (`subCategory_id`),
  ADD KEY `products_vendor_id_index` (`vendor_id`);

--
-- Indexes for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_tag_product_id_index` (`product_id`),
  ADD KEY `product_tag_tag_id_index` (`tag_id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quotes_quote_no_unique` (`quote_no`),
  ADD KEY `quotes_user_id_index` (`user_id`);

--
-- Indexes for table `quote_items`
--
ALTER TABLE `quote_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quote_items_quote_id_index` (`quote_id`),
  ADD KEY `quote_items_product_id_index` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribers_email_unique` (`email`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_categories_slug_unique` (`slug`),
  ADD KEY `sub_categories_category_id_index` (`category_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`),
  ADD KEY `vendors_membership_id_index` (`membership_id`),
  ADD KEY `vendors_city_id_index` (`city_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_events`
--
ALTER TABLE `action_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_tag`
--
ALTER TABLE `product_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quote_items`
--
ALTER TABLE `quote_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subCategory_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD CONSTRAINT `product_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quotes`
--
ALTER TABLE `quotes`
  ADD CONSTRAINT `quotes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `quote_items`
--
ALTER TABLE `quote_items`
  ADD CONSTRAINT `quote_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `quote_items_quote_id_foreign` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `vendors_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `vendors_membership_id_foreign` FOREIGN KEY (`membership_id`) REFERENCES `memberships` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
