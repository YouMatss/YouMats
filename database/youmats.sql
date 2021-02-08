-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2021 at 02:03 PM
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
  `original` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `changes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `action_events`
--

INSERT INTO `action_events` (`id`, `batch_id`, `user_id`, `name`, `actionable_type`, `actionable_id`, `target_type`, `target_id`, `model_type`, `model_id`, `fields`, `status`, `exception`, `created_at`, `updated_at`, `original`, `changes`) VALUES
(1, '926d4337-8d4a-4fe4-b0d9-769d41703412', 1, 'Update', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 1, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 1, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 1, '', 'finished', '', '2021-01-06 22:36:08', '2021-01-06 22:36:08', '{\"file_name\":\"newsletter.jpg\",\"img_title\":null,\"img_alt\":null}', '{\"file_name\":\"category1.jpg\",\"img_title\":\"\\u0635\\u0646\\u0641 1\",\"img_alt\":\"\\u0635\\u0646\\u0641 1\"}'),
(2, '926d4371-cef0-4969-b833-18616d2f9c6f', 1, 'Create', 'App\\Models\\Category', 1, 'App\\Models\\Category', 1, 'App\\Models\\Category', 1, '', 'finished', '', '2021-01-06 22:36:46', '2021-01-06 22:36:46', NULL, '{\"name\":{\"en\":\"Category 1\",\"ar\":\"\\u0635\\u0646\\u0641 1\"},\"short_desc\":{\"en\":\"Category 1\",\"ar\":\"\\u0635\\u0646\\u0641 1\"},\"desc\":{\"en\":\"<p>category 1<\\/p>\",\"ar\":\"<p>\\u0635\\u0646\\u0641 1<\\/p>\"},\"slug\":\"CATEGORY_1\",\"meta_title\":{\"ar\":null},\"meta_keywords\":{\"ar\":null},\"meta_desc\":{\"en\":\"desc\",\"ar\":null},\"created_by\":1,\"sort\":1,\"updated_at\":\"2021-01-07T00:36:46.000000Z\",\"created_at\":\"2021-01-07T00:36:46.000000Z\",\"id\":1}'),
(3, '926d4899-a19f-4f24-ad9c-9bce2d29f59c', 1, 'Update', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 3, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 3, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 3, '', 'finished', '', '2021-01-06 22:51:11', '2021-01-06 22:51:11', '{\"img_alt\":null}', '{\"img_alt\":\"Sub Category 1\"}'),
(4, '926d48a1-f41e-476b-8123-1f8ce9b17263', 1, 'Create', 'App\\Models\\SubCategory', 1, 'App\\Models\\SubCategory', 1, 'App\\Models\\SubCategory', 1, '', 'finished', '', '2021-01-06 22:51:16', '2021-01-06 22:51:16', NULL, '{\"category_id\":1,\"name\":{\"en\":\"Sub Category 1\",\"ar\":\"\\u0635\\u0646\\u0641 1\"},\"short_desc\":{\"en\":\"Sub Category 1\",\"ar\":\"\\u0633\"},\"desc\":{\"en\":\"<p>Sub Category 1<\\/p>\",\"ar\":\"<p>\\u0633<\\/p>\"},\"slug\":\"Sub Category 1\",\"meta_title\":{\"ar\":null},\"meta_keywords\":{\"ar\":null},\"meta_desc\":{\"ar\":null},\"created_by\":1,\"sort\":1,\"updated_at\":\"2021-01-07T00:51:16.000000Z\",\"created_at\":\"2021-01-07T00:51:16.000000Z\",\"id\":1}'),
(5, '926d493d-2c14-40d9-a82f-5c3b6947f14e', 1, 'Update', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 4, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 4, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 4, '', 'finished', '', '2021-01-06 22:52:58', '2021-01-06 22:52:58', '{\"img_alt\":null}', '{\"img_alt\":\"Sub Category 1\"}'),
(6, '926d494c-c6eb-4886-9ca9-31aa3d7f203d', 1, 'Update', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 4, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 4, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 4, '', 'finished', '', '2021-01-06 22:53:08', '2021-01-06 22:53:08', '{\"img_title\":null}', '{\"img_title\":\"Sub Category 1\"}'),
(7, '926d4987-9c7e-4058-8159-d4f9c3277abe', 1, 'Create', 'App\\Models\\Vendor', 1, 'App\\Models\\Vendor', 1, 'App\\Models\\Vendor', 1, '', 'finished', '', '2021-01-06 22:53:47', '2021-01-06 22:53:47', NULL, '{\"name\":\"Oils\",\"email\":\"Oils@youmats.com\",\"created_by\":1,\"updated_at\":\"2021-01-07T00:53:47.000000Z\",\"created_at\":\"2021-01-07T00:53:47.000000Z\",\"id\":1}'),
(8, '926d49e9-e1e7-4ff7-96f8-5525e1b46587', 1, 'Update', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 6, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 6, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 6, '', 'finished', '', '2021-01-06 22:54:51', '2021-01-06 22:54:51', '{\"img_alt\":null}', '{\"img_alt\":\"ss\"}'),
(9, '926d4a03-84ca-4b61-9a66-656218349bd9', 1, 'Create', 'App\\Models\\Product', 1, 'App\\Models\\Product', 1, 'App\\Models\\Product', 1, '', 'finished', '', '2021-01-06 22:55:08', '2021-01-06 22:55:08', NULL, '{\"subCategory_id\":1,\"vendor_id\":1,\"name\":{\"en\":\"Product 1\",\"ar\":\"\\u0645\\u0646\\u062a\\u062c1\"},\"short_desc\":{\"ar\":null},\"desc\":{\"en\":\"<p>desc<\\/p>\",\"ar\":\"<p>desc<\\/p>\"},\"type\":\"product\",\"price\":\"10\",\"unit\":{\"en\":\"Kilo\",\"ar\":\"\\u0643\\u064a\\u0644\\u0648\"},\"SKU\":\"FW511948218\",\"stoke\":\"26\",\"rate\":\"1.5\",\"slug\":\"pr\",\"meta_title\":{\"ar\":null},\"meta_keywords\":{\"ar\":null},\"meta_desc\":{\"ar\":null},\"created_by\":1,\"sort\":1,\"updated_at\":\"2021-01-07T00:55:08.000000Z\",\"created_at\":\"2021-01-07T00:55:08.000000Z\",\"id\":1}'),
(10, '926d4a38-4abc-43ad-89c2-581fe5c50466', 1, 'Update', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 9, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 9, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 9, '', 'finished', '', '2021-01-06 22:55:42', '2021-01-06 22:55:42', '{\"img_alt\":null}', '{\"img_alt\":\"sda\"}'),
(11, '926d4ab0-38fa-40c4-aea9-fda958df2930', 1, 'Create', 'App\\Models\\FAQ', 1, 'App\\Models\\FAQ', 1, 'App\\Models\\FAQ', 1, '', 'finished', '', '2021-01-06 22:57:01', '2021-01-06 22:57:01', NULL, '{\"question\":{\"en\":\"1\",\"ar\":\"2\"},\"answer\":{\"en\":\"3\",\"ar\":\"4\"},\"created_by\":1,\"sort\":1,\"updated_at\":\"2021-01-07T00:57:01.000000Z\",\"created_at\":\"2021-01-07T00:57:01.000000Z\",\"id\":1}'),
(12, '9271299e-36d9-49ec-9f98-b59f39ebbd27', 1, 'Create', 'App\\Models\\Category', 2, 'App\\Models\\Category', 2, 'App\\Models\\Category', 2, '', 'finished', '', '2021-01-08 21:07:52', '2021-01-08 21:07:52', NULL, '{\"name\":{\"en\":\"Oils\",\"ar\":\"\\u0632\\u064a\\u0648\\u062a\"},\"short_desc\":{\"en\":\"Oils\",\"ar\":null},\"desc\":{\"en\":\"<p>Oils<\\/p>\",\"ar\":\"<p>\\u0632\\u064a\\u0648\\u062a<\\/p>\"},\"slug\":\"oils\",\"meta_title\":{\"ar\":null},\"meta_keywords\":{\"ar\":null},\"meta_desc\":{\"ar\":null},\"created_by\":1,\"sort\":2,\"updated_at\":\"2021-01-08T23:07:51.000000Z\",\"created_at\":\"2021-01-08T23:07:51.000000Z\",\"id\":2}'),
(13, '92712a25-37f2-4634-b7b5-384a2f926c35', 1, 'Create', 'App\\Models\\SubCategory', 2, 'App\\Models\\SubCategory', 2, 'App\\Models\\SubCategory', 2, '', 'finished', '', '2021-01-08 21:09:20', '2021-01-08 21:09:20', NULL, '{\"category_id\":2,\"name\":{\"en\":\"Petrol Oils\",\"ar\":\"\\u0632\\u064a\\u0648\\u062a \\u0628\\u062a\\u0631\\u0648\\u0644\\u064a\\u0629\"},\"short_desc\":{\"en\":\"Petrol Oils\",\"ar\":\"\\u0632\\u064a\\u0648\\u062a \\u0628\\u062a\\u0631\\u0648\\u0644\\u064a\\u0629\"},\"desc\":{\"en\":\"<p>Petrol Oils<\\/p>\",\"ar\":\"<p>\\u0632\\u064a\\u0648\\u062a \\u0628\\u062a\\u0631\\u0648\\u0644\\u064a\\u0629<\\/p>\"},\"slug\":\"petrol-oils\",\"meta_title\":{\"ar\":null},\"meta_keywords\":{\"ar\":null},\"meta_desc\":{\"ar\":null},\"created_by\":1,\"sort\":2,\"updated_at\":\"2021-01-08T23:09:20.000000Z\",\"created_at\":\"2021-01-08T23:09:20.000000Z\",\"id\":2}'),
(14, '92712b84-630a-44c1-a4c0-02dba22692fe', 1, 'Create', 'App\\Models\\Product', 2, 'App\\Models\\Product', 2, 'App\\Models\\Product', 2, '', 'finished', '', '2021-01-08 21:13:10', '2021-01-08 21:13:10', NULL, '{\"subCategory_id\":2,\"vendor_id\":1,\"name\":{\"en\":\"Gas\",\"ar\":\"\\u062c\\u0627\\u0632\"},\"short_desc\":{\"en\":\"Gas\",\"ar\":\"\\u062c\\u0627\\u0632\"},\"desc\":{\"en\":\"<p>Gas<\\/p>\",\"ar\":\"<p>\\u062c\\u0627\\u0632<\\/p>\"},\"type\":\"product\",\"price\":\"2.45\",\"unit\":{\"en\":\"Liter\",\"ar\":\"\\u0644\\u062a\\u0631\"},\"SKU\":\"FW511948213\",\"stoke\":\"5000\",\"rate\":\"4.5\",\"slug\":\"gas\",\"meta_title\":{\"ar\":null},\"meta_keywords\":{\"ar\":null},\"meta_desc\":{\"ar\":null},\"created_by\":1,\"sort\":2,\"updated_at\":\"2021-01-08T23:13:10.000000Z\",\"created_at\":\"2021-01-08T23:13:10.000000Z\",\"id\":2}'),
(15, '92712dfa-b6ce-4848-834e-936c95782194', 1, 'Update', 'App\\Models\\FAQ', 1, 'App\\Models\\FAQ', 1, 'App\\Models\\FAQ', 1, '', 'finished', '', '2021-01-08 21:20:03', '2021-01-08 21:20:03', '{\"question\":{\"en\":\"1\",\"ar\":\"2\"},\"answer\":{\"en\":\"3\",\"ar\":\"4\"}}', '{\"question\":\"{\\\"en\\\":\\\"Question 1\\\",\\\"ar\\\":\\\"\\\\u0633\\\\u0648\\\\u0627\\\\u0644 1\\\"}\",\"answer\":\"{\\\"en\\\":\\\"<p>Answer 1<\\\\\\/p>\\\",\\\"ar\\\":\\\"<p>\\\\u0627\\\\u062c\\\\u0627\\\\u0628\\\\u0629 1<\\\\\\/p>\\\"}\"}'),
(16, '927132ba-d58a-4334-997e-29005d8b4f32', 1, 'Create', 'App\\Models\\Language', 1, 'App\\Models\\Language', 1, 'App\\Models\\Language', 1, '', 'finished', '', '2021-01-08 21:33:20', '2021-01-08 21:33:20', NULL, '{\"name\":{\"en\":\"English\",\"ar\":\"\\u0627\\u0644\\u0627\\u0646\\u062c\\u0644\\u064a\\u0632\\u064a\\u0629\"},\"slug\":\"en\",\"created_by\":1,\"sort\":1,\"updated_at\":\"2021-01-08T23:33:20.000000Z\",\"created_at\":\"2021-01-08T23:33:20.000000Z\",\"id\":1}'),
(17, '9271330e-0185-4252-a394-bef5c8d886dd', 1, 'Create', 'App\\Models\\Language', 2, 'App\\Models\\Language', 2, 'App\\Models\\Language', 2, '', 'finished', '', '2021-01-08 21:34:15', '2021-01-08 21:34:15', NULL, '{\"name\":{\"en\":\"Arabic\",\"ar\":\"\\u0627\\u0644\\u0639\\u0631\\u0628\\u064a\\u0629\"},\"slug\":\"ar\",\"created_by\":1,\"sort\":2,\"updated_at\":\"2021-01-08T23:34:15.000000Z\",\"created_at\":\"2021-01-08T23:34:15.000000Z\",\"id\":2}'),
(18, '927134bf-ac5a-4d2f-96fc-ce11190f5d22', 1, 'Update', 'App\\Models\\Admin', 1, 'App\\Models\\Admin', 1, 'App\\Models\\Admin', 1, '', 'finished', '', '2021-01-08 21:38:59', '2021-01-08 21:38:59', '[]', '[]'),
(19, '927134cd-24be-40fb-ac6d-05a17386a200', 1, 'Update', 'App\\Models\\Admin', 1, 'App\\Models\\Admin', 1, 'App\\Models\\Admin', 1, '', 'finished', '', '2021-01-08 21:39:08', '2021-01-08 21:39:08', '{\"password\":\"$2y$10$y.lldjBmNt3u9ESxsrlqu.OQxQrLLglVGYaPBcrP9WIMAKLZErkUW\"}', '{\"password\":\"$2y$10$e9ahnIL03i6tABLd2lryKOXK4S0mEQilXbK44tbs670BsE\\/QvBkKW\"}'),
(20, '92713512-5cb7-4a61-8fe4-6acc7669a8dc', 1, 'Create', 'App\\Models\\Admin', 2, 'App\\Models\\Admin', 2, 'App\\Models\\Admin', 2, '', 'finished', '', '2021-01-08 21:39:53', '2021-01-08 21:39:53', NULL, '{\"name\":\"Nour\",\"email\":\"nour@youmats.com\",\"created_by\":1,\"updated_at\":\"2021-01-08T23:39:53.000000Z\",\"created_at\":\"2021-01-08T23:39:53.000000Z\",\"id\":2}'),
(21, '92713524-9edd-498c-ae73-a0ec19f9e7c0', 1, 'Create', 'App\\Models\\Admin', 3, 'App\\Models\\Admin', 3, 'App\\Models\\Admin', 3, '', 'finished', '', '2021-01-08 21:40:05', '2021-01-08 21:40:05', NULL, '{\"name\":\"Basma\",\"email\":\"basma@youmats.com\",\"created_by\":1,\"updated_at\":\"2021-01-08T23:40:05.000000Z\",\"created_at\":\"2021-01-08T23:40:05.000000Z\",\"id\":3}'),
(22, '927177e0-d721-48a9-9749-26c848367ff3', 1, 'Create', 'Spatie\\Permission\\Models\\Role', 1, 'Spatie\\Permission\\Models\\Role', 1, 'Spatie\\Permission\\Models\\Role', 1, '', 'finished', '', '2021-01-09 00:46:41', '2021-01-09 00:46:41', NULL, '{\"guard_name\":\"admin\",\"name\":\"Administrator\",\"updated_at\":\"2021-01-09T02:46:41.000000Z\",\"created_at\":\"2021-01-09T02:46:41.000000Z\",\"id\":1}'),
(23, '92717812-cac2-4b33-846a-544e244249e1', 1, 'Create', 'Spatie\\Permission\\Models\\Permission', 1, 'Spatie\\Permission\\Models\\Permission', 1, 'Spatie\\Permission\\Models\\Permission', 1, '', 'finished', '', '2021-01-09 00:47:14', '2021-01-09 00:47:14', NULL, '{\"guard_name\":\"admin\",\"name\":\"Create Products\",\"updated_at\":\"2021-01-09T02:47:14.000000Z\",\"created_at\":\"2021-01-09T02:47:14.000000Z\",\"id\":1}'),
(24, '9271782f-f310-4977-8752-38408bab53a2', 1, 'Attach To Role', 'Spatie\\Permission\\Models\\Permission', 1, 'Spatie\\Permission\\Models\\Permission', 1, 'Spatie\\Permission\\Models\\Permission', 1, 'a:1:{s:4:\"role\";s:1:\"1\";}', 'finished', '', '2021-01-09 00:47:33', '2021-01-09 00:47:33', NULL, NULL),
(25, '9271786b-1b14-4242-98b3-8dcb5ed668ca', 1, 'Attach', 'Spatie\\Permission\\Models\\Role', 1, 'App\\Models\\Admin', 1, 'Illuminate\\Database\\Eloquent\\Relations\\MorphPivot', NULL, '', 'finished', '', '2021-01-09 00:48:12', '2021-01-09 00:48:12', NULL, '{\"role_id\":\"1\",\"model_id\":\"1\",\"model_type\":\"App\\\\Models\\\\Admin\"}'),
(26, '927178db-d8ff-4c98-8016-aabdcb42fd4f', 1, 'Update', 'App\\Models\\Admin', 1, 'App\\Models\\Admin', 1, 'App\\Models\\Admin', 1, '', 'finished', '', '2021-01-09 00:49:26', '2021-01-09 00:49:26', '[]', '[]'),
(27, '92717a01-b1f3-42f9-a4e3-102c73940ef4', 1, 'Create', 'Spatie\\Permission\\Models\\Role', 2, 'Spatie\\Permission\\Models\\Role', 2, 'Spatie\\Permission\\Models\\Role', 2, '', 'finished', '', '2021-01-09 00:52:38', '2021-01-09 00:52:38', NULL, '{\"guard_name\":\"admin\",\"name\":\"Data Entry\",\"updated_at\":\"2021-01-09T02:52:38.000000Z\",\"created_at\":\"2021-01-09T02:52:38.000000Z\",\"id\":2}'),
(28, '92717a16-4b9b-4b13-a659-ceb8dcd3ad6e', 1, 'Update', 'App\\Models\\Admin', 1, 'App\\Models\\Admin', 1, 'App\\Models\\Admin', 1, '', 'finished', '', '2021-01-09 00:52:52', '2021-01-09 00:52:52', '[]', '[]'),
(29, '9272b795-87d1-49eb-8ced-ffe6468087b8', 1, 'Update', 'Spatie\\Permission\\Models\\Role', 6, 'Spatie\\Permission\\Models\\Role', 6, 'Spatie\\Permission\\Models\\Role', 6, '', 'finished', '', '2021-01-09 15:40:39', '2021-01-09 15:40:39', '{\"name\":\"super-admin\"}', '{\"name\":\"Super Admin\"}'),
(30, '9272b7ac-7bf8-4885-85d4-29561d08adff', 1, 'Update', 'Spatie\\Permission\\Models\\Role', 6, 'Spatie\\Permission\\Models\\Role', 6, 'Spatie\\Permission\\Models\\Role', 6, '', 'finished', '', '2021-01-09 15:40:54', '2021-01-09 15:40:54', '[]', '[]'),
(31, '9272ba69-02a8-48f5-b7cd-825f48233168', 1, 'Delete', 'App\\Models\\Admin', 4, 'App\\Models\\Admin', 4, 'App\\Models\\Admin', 4, '', 'finished', '', '2021-01-09 15:48:33', '2021-01-09 15:48:33', NULL, NULL),
(32, '9272ba69-52f3-4e6f-96d9-131f8ad1d89f', 1, 'Delete', 'App\\Models\\Admin', 5, 'App\\Models\\Admin', 5, 'App\\Models\\Admin', 5, '', 'finished', '', '2021-01-09 15:48:33', '2021-01-09 15:48:33', NULL, NULL),
(33, '9272ba69-c1db-46c0-af8d-d7413de4bc98', 1, 'Delete', 'App\\Models\\Admin', 6, 'App\\Models\\Admin', 6, 'App\\Models\\Admin', 6, '', 'finished', '', '2021-01-09 15:48:34', '2021-01-09 15:48:34', NULL, NULL),
(34, '9272ba6a-2020-40b9-9fee-e8cd9a7c8627', 1, 'Delete', 'App\\Models\\Admin', 7, 'App\\Models\\Admin', 7, 'App\\Models\\Admin', 7, '', 'finished', '', '2021-01-09 15:48:34', '2021-01-09 15:48:34', NULL, NULL),
(35, '9272ba6a-77c9-41cc-8313-5cf3e1f1366b', 1, 'Delete', 'App\\Models\\Admin', 8, 'App\\Models\\Admin', 8, 'App\\Models\\Admin', 8, '', 'finished', '', '2021-01-09 15:48:34', '2021-01-09 15:48:34', NULL, NULL),
(36, '9272ba6a-bc70-4b73-ab5a-fb5e8ab532a6', 1, 'Delete', 'App\\Models\\Admin', 9, 'App\\Models\\Admin', 9, 'App\\Models\\Admin', 9, '', 'finished', '', '2021-01-09 15:48:34', '2021-01-09 15:48:34', NULL, NULL),
(37, '9272ba6a-f375-46c9-be2d-3ddf1a7e42c7', 1, 'Delete', 'App\\Models\\Admin', 10, 'App\\Models\\Admin', 10, 'App\\Models\\Admin', 10, '', 'finished', '', '2021-01-09 15:48:34', '2021-01-09 15:48:34', NULL, NULL),
(38, '9272ba6b-34ba-4686-8476-9d3352f0741a', 1, 'Delete', 'App\\Models\\Admin', 11, 'App\\Models\\Admin', 11, 'App\\Models\\Admin', 11, '', 'finished', '', '2021-01-09 15:48:35', '2021-01-09 15:48:35', NULL, NULL),
(39, '9272ba6b-6c4d-454e-ac5a-ee677afa2996', 1, 'Delete', 'App\\Models\\Admin', 12, 'App\\Models\\Admin', 12, 'App\\Models\\Admin', 12, '', 'finished', '', '2021-01-09 15:48:35', '2021-01-09 15:48:35', NULL, NULL),
(40, '9272ba6b-db72-4011-b15c-8d5e10f96c3a', 1, 'Delete', 'App\\Models\\Admin', 13, 'App\\Models\\Admin', 13, 'App\\Models\\Admin', 13, '', 'finished', '', '2021-01-09 15:48:35', '2021-01-09 15:48:35', NULL, NULL),
(41, '9272ba6c-4329-4385-9292-20cf2ec91976', 1, 'Delete', 'App\\Models\\Admin', 14, 'App\\Models\\Admin', 14, 'App\\Models\\Admin', 14, '', 'finished', '', '2021-01-09 15:48:35', '2021-01-09 15:48:35', NULL, NULL),
(42, '9272ba6c-8e0b-46d3-8018-dd5491324522', 1, 'Delete', 'App\\Models\\Admin', 15, 'App\\Models\\Admin', 15, 'App\\Models\\Admin', 15, '', 'finished', '', '2021-01-09 15:48:36', '2021-01-09 15:48:36', NULL, NULL),
(43, '9272ba6c-dfc2-42e6-93ea-3cc64b54ed56', 1, 'Delete', 'App\\Models\\Admin', 16, 'App\\Models\\Admin', 16, 'App\\Models\\Admin', 16, '', 'finished', '', '2021-01-09 15:48:36', '2021-01-09 15:48:36', NULL, NULL),
(44, '9272ba6d-3dd8-4f5a-a493-2147f295b3f3', 1, 'Delete', 'App\\Models\\Admin', 17, 'App\\Models\\Admin', 17, 'App\\Models\\Admin', 17, '', 'finished', '', '2021-01-09 15:48:36', '2021-01-09 15:48:36', NULL, NULL),
(45, '9272ba6d-ac49-4a03-9a94-278551c56868', 1, 'Delete', 'App\\Models\\Admin', 18, 'App\\Models\\Admin', 18, 'App\\Models\\Admin', 18, '', 'finished', '', '2021-01-09 15:48:36', '2021-01-09 15:48:36', NULL, NULL),
(46, '9272ba6d-f0e9-4ef6-a82e-37e84937898c', 1, 'Delete', 'App\\Models\\Admin', 19, 'App\\Models\\Admin', 19, 'App\\Models\\Admin', 19, '', 'finished', '', '2021-01-09 15:48:36', '2021-01-09 15:48:36', NULL, NULL),
(47, '9272ba6e-2b70-45a4-834d-0ff24f78792c', 1, 'Delete', 'App\\Models\\Admin', 20, 'App\\Models\\Admin', 20, 'App\\Models\\Admin', 20, '', 'finished', '', '2021-01-09 15:48:37', '2021-01-09 15:48:37', NULL, NULL),
(48, '9272ba6e-7668-48b7-8f2c-6c2a046db3a2', 1, 'Delete', 'App\\Models\\Admin', 21, 'App\\Models\\Admin', 21, 'App\\Models\\Admin', 21, '', 'finished', '', '2021-01-09 15:48:37', '2021-01-09 15:48:37', NULL, NULL),
(49, '9272ba6e-b0b7-4d8c-915a-e8622dc1effc', 1, 'Delete', 'App\\Models\\Admin', 22, 'App\\Models\\Admin', 22, 'App\\Models\\Admin', 22, '', 'finished', '', '2021-01-09 15:48:37', '2021-01-09 15:48:37', NULL, NULL),
(50, '9272ba6e-ff2d-40e0-8d01-001ea515f7c5', 1, 'Delete', 'App\\Models\\Admin', 23, 'App\\Models\\Admin', 23, 'App\\Models\\Admin', 23, '', 'finished', '', '2021-01-09 15:48:37', '2021-01-09 15:48:37', NULL, NULL),
(51, '9272bed2-32c2-45c8-bf15-3e5cf688e055', 1, 'Create', 'Spatie\\Permission\\Models\\Role', 7, 'Spatie\\Permission\\Models\\Role', 7, 'Spatie\\Permission\\Models\\Role', 7, '', 'finished', '', '2021-01-09 16:00:53', '2021-01-09 16:00:53', NULL, '{\"guard_name\":\"admin\",\"name\":\"Data Entry\",\"updated_at\":\"2021-01-09T18:00:53.000000Z\",\"created_at\":\"2021-01-09T18:00:53.000000Z\",\"id\":7}'),
(52, '9272bf1b-5aa8-4aeb-81e8-da245077072b', 1, 'Update', 'App\\Models\\Admin', 1, 'App\\Models\\Admin', 1, 'App\\Models\\Admin', 1, '', 'finished', '', '2021-01-09 16:01:41', '2021-01-09 16:01:41', '[]', '[]'),
(53, '9272bf47-5924-48bd-8e7e-927110bd9b4b', 1, 'Update', 'App\\Models\\Admin', 1, 'App\\Models\\Admin', 1, 'App\\Models\\Admin', 1, '', 'finished', '', '2021-01-09 16:02:10', '2021-01-09 16:02:10', '[]', '[]'),
(54, '9272f17f-0fa0-4b74-8864-ce36738f49b0', 1, 'Update', 'Spatie\\Permission\\Models\\Role', 6, 'Spatie\\Permission\\Models\\Role', 6, 'Spatie\\Permission\\Models\\Role', 6, '', 'finished', '', '2021-01-09 18:22:35', '2021-01-09 18:22:35', '[]', '[]'),
(55, '9272f2bf-0ef4-430b-b947-cfa936bab3eb', 1, 'Update', 'Spatie\\Permission\\Models\\Role', 6, 'Spatie\\Permission\\Models\\Role', 6, 'Spatie\\Permission\\Models\\Role', 6, '', 'finished', '', '2021-01-09 18:26:05', '2021-01-09 18:26:05', '[]', '[]'),
(56, '9272fb36-54d8-481c-8a69-528b92de95ba', 1, 'Update', 'App\\Models\\Admin', 2, 'App\\Models\\Admin', 2, 'App\\Models\\Admin', 2, '', 'finished', '', '2021-01-09 18:49:45', '2021-01-09 18:49:45', '[]', '[]'),
(58, '9274f249-b927-4973-b501-7604aadc4cf7', 1, 'Attach', 'Spatie\\Permission\\Models\\Permission', 56, 'App\\Models\\Admin', 2, 'Illuminate\\Database\\Eloquent\\Relations\\MorphPivot', NULL, '', 'finished', '', '2021-01-10 18:16:27', '2021-01-10 18:16:27', NULL, '{\"permission_id\":\"56\",\"model_id\":\"2\",\"model_type\":\"App\\\\Models\\\\Admin\"}'),
(59, '9274f2a5-f9cd-4ef4-835b-7774cf080eab', 1, 'Detach', 'App\\Models\\Admin', 2, 'Spatie\\Permission\\Models\\Permission', 56, 'Illuminate\\Database\\Eloquent\\Relations\\MorphPivot', NULL, '', 'finished', '', '2021-01-10 18:17:28', '2021-01-10 18:17:28', NULL, NULL),
(62, '92767d4b-77c6-4756-8fec-bb758dbc0d7d', 1, 'Update', 'Spatie\\Permission\\Models\\Role', 1, 'Spatie\\Permission\\Models\\Role', 1, 'Spatie\\Permission\\Models\\Role', 1, '', 'finished', '', '2021-01-11 12:40:58', '2021-01-11 12:40:58', '[]', '[]'),
(63, '927680b8-9011-4438-a33d-3af4f8bcb84c', 1, 'Update', 'Spatie\\Permission\\Models\\Role', 1, 'Spatie\\Permission\\Models\\Role', 1, 'Spatie\\Permission\\Models\\Role', 1, '', 'finished', '', '2021-01-11 12:50:33', '2021-01-11 12:50:33', '[]', '[]'),
(64, '927680e0-1db8-4235-a1f6-7bc6ed4837fe', 1, 'Update', 'Spatie\\Permission\\Models\\Role', 1, 'Spatie\\Permission\\Models\\Role', 1, 'Spatie\\Permission\\Models\\Role', 1, '', 'finished', '', '2021-01-11 12:50:59', '2021-01-11 12:50:59', '[]', '[]'),
(65, '92768395-07f6-41fc-8f25-14b067f66a6d', 1, 'Update', 'App\\Models\\Admin', 3, 'App\\Models\\Admin', 3, 'App\\Models\\Admin', 3, '', 'finished', '', '2021-01-11 12:58:33', '2021-01-11 12:58:33', '[]', '[]'),
(66, '927683b5-2690-467a-aa8a-da554b1a9dc4', 1, 'Update', 'App\\Models\\Admin', 3, 'App\\Models\\Admin', 3, 'App\\Models\\Admin', 3, '', 'finished', '', '2021-01-11 12:58:54', '2021-01-11 12:58:54', '[]', '[]'),
(67, '9276cbc5-6549-4bb7-b67a-0efa12ec7275', 1, 'Create', 'App\\Models\\User', 1, 'App\\Models\\User', 1, 'App\\Models\\User', 1, '', 'finished', '', '2021-01-11 16:20:25', '2021-01-11 16:20:25', NULL, '{\"type\":\"individual\",\"name\":\"Mohamed Maher\",\"email\":\"user@youmats.com\",\"phone\":\"01064323735\",\"address\":\"Maadi\",\"address2\":\"Imbaba\",\"created_by\":1,\"updated_at\":\"2021-01-11T18:20:25.000000Z\",\"created_at\":\"2021-01-11T18:20:25.000000Z\",\"id\":1}'),
(68, '927720fa-5cb7-45a2-b339-3d39f9b01eee', 1, 'Create', 'App\\Models\\User', 2, 'App\\Models\\User', 2, 'App\\Models\\User', 2, '', 'finished', '', '2021-01-11 20:18:40', '2021-01-11 20:18:40', NULL, '{\"name\":\"SEOERA\",\"email\":\"seo@seoera.net\",\"phone\":null,\"address\":null,\"address2\":null,\"active\":\"0\",\"type\":\"company\",\"updated_at\":\"2021-01-11T22:18:40.000000Z\",\"created_by\":1,\"created_at\":\"2021-01-11T22:18:40.000000Z\",\"id\":2}'),
(69, '927a5d88-13b9-44aa-bb0b-16fea04b72b0', 1, 'Create', 'App\\Models\\Vendor', 1, 'App\\Models\\Vendor', 1, 'App\\Models\\Vendor', 1, '', 'finished', '', '2021-01-13 10:55:28', '2021-01-13 10:55:28', NULL, '{\"name\":\"Roc\",\"email\":\"roc@gmail.com\",\"phone\":\"010643273\",\"phone2\":null,\"address\":\"maadi\",\"address2\":null,\"active\":\"1\",\"created_by\":1,\"updated_at\":\"2021-01-13T12:55:28.000000Z\",\"created_at\":\"2021-01-13T12:55:28.000000Z\",\"id\":1}'),
(70, '927a6ff1-a0a2-4ff1-876d-91c026bf5419', 1, 'Create', 'App\\Models\\User', 3, 'App\\Models\\User', 3, 'App\\Models\\User', 3, '', 'finished', '', '2021-01-13 11:46:57', '2021-01-13 11:46:57', NULL, '{\"name\":\"Nashwa\",\"email\":\"nashwa@gmail.com\",\"phone\":\"01064323735\",\"address\":null,\"address2\":null,\"active\":\"0\",\"type\":\"individual\",\"created_by\":1,\"updated_at\":\"2021-01-13T13:46:57.000000Z\",\"created_at\":\"2021-01-13T13:46:57.000000Z\",\"id\":3}'),
(71, '927a7774-a90c-4e9e-b00e-ad4f86a7a2f9', 1, 'Create', 'App\\Models\\User', 4, 'App\\Models\\User', 4, 'App\\Models\\User', 4, '', 'finished', '', '2021-01-13 12:07:57', '2021-01-13 12:07:57', NULL, '{\"name\":\"Company\",\"email\":\"company@gmail.com\",\"phone\":null,\"phone2\":null,\"address\":null,\"address2\":null,\"active\":\"0\",\"type\":\"individual\",\"created_by\":1,\"updated_at\":\"2021-01-13T14:07:57.000000Z\",\"created_at\":\"2021-01-13T14:07:57.000000Z\",\"id\":4}'),
(72, '927a77a4-5c56-4f5e-8e8a-930b64281675', 1, 'Update', 'App\\Models\\User', 4, 'App\\Models\\User', 4, 'App\\Models\\User', 4, '', 'finished', '', '2021-01-13 12:08:29', '2021-01-13 12:08:29', '{\"type\":\"individual\"}', '{\"type\":\"company\"}'),
(73, '927a77c5-2f87-4129-ae54-24133baa62e9', 1, 'Update', 'App\\Models\\User', 2, 'App\\Models\\User', 2, 'App\\Models\\User', 2, '', 'finished', '', '2021-01-13 12:08:50', '2021-01-13 12:08:50', '[]', '[]'),
(74, '927a78f2-5f06-41d1-8f06-98ee99fa8ebe', 1, 'Update', 'App\\Models\\User', 2, 'App\\Models\\User', 2, 'App\\Models\\User', 2, '', 'finished', '', '2021-01-13 12:12:08', '2021-01-13 12:12:08', '[]', '[]'),
(75, '927a791b-318e-48a8-8280-db0cd0917222', 1, 'Update', 'App\\Models\\User', 2, 'App\\Models\\User', 2, 'App\\Models\\User', 2, '', 'finished', '', '2021-01-13 12:12:34', '2021-01-13 12:12:34', '[]', '[]'),
(76, '927a794c-80d7-4d3e-b3a4-049139fc07e6', 1, 'Delete', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 41, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 41, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 41, '', 'finished', '', '2021-01-13 12:13:07', '2021-01-13 12:13:07', NULL, NULL),
(77, '927a794e-ce09-4a7b-b07a-74f786566061', 1, 'Delete', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 42, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 42, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 42, '', 'finished', '', '2021-01-13 12:13:08', '2021-01-13 12:13:08', NULL, NULL),
(78, '927a7951-7981-476d-a93d-4366510f013e', 1, 'Delete', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 43, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 43, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 43, '', 'finished', '', '2021-01-13 12:13:10', '2021-01-13 12:13:10', NULL, NULL),
(79, '927a7953-e4f2-465f-8699-2f65d78a3ba7', 1, 'Delete', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 44, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 44, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 44, '', 'finished', '', '2021-01-13 12:13:12', '2021-01-13 12:13:12', NULL, NULL),
(80, '927a7965-0eb8-4e74-b138-c408d7c76c9c', 1, 'Update', 'App\\Models\\Vendor', 1, 'App\\Models\\Vendor', 1, 'App\\Models\\Vendor', 1, '', 'finished', '', '2021-01-13 12:13:23', '2021-01-13 12:13:23', '[]', '[]'),
(81, '927a81cf-004e-42fa-902e-9ba0783c8829', 1, 'Create', 'App\\Models\\User', 5, 'App\\Models\\User', 5, 'App\\Models\\User', 5, '', 'finished', '', '2021-01-13 12:36:54', '2021-01-13 12:36:54', NULL, '{\"name\":\"company2\",\"email\":\"company2@gmail.com\",\"phone\":null,\"phone2\":null,\"address\":null,\"address2\":null,\"active\":\"1\",\"type\":\"company\",\"created_by\":1,\"updated_at\":\"2021-01-13T14:36:54.000000Z\",\"created_at\":\"2021-01-13T14:36:54.000000Z\",\"id\":5}'),
(82, '927a89eb-5906-4795-91f8-2312b88697e1', 1, 'Create', 'App\\Models\\User', 6, 'App\\Models\\User', 6, 'App\\Models\\User', 6, '', 'finished', '', '2021-01-13 12:59:35', '2021-01-13 12:59:35', NULL, '{\"name\":\"Nour\",\"email\":\"nour@gmail.com\",\"phone\":null,\"phone2\":null,\"address\":null,\"address2\":null,\"active\":\"0\",\"type\":\"individual\",\"created_by\":1,\"updated_at\":\"2021-01-13T14:59:35.000000Z\",\"created_at\":\"2021-01-13T14:59:35.000000Z\",\"id\":6}'),
(83, '927ab279-48b2-414a-941e-7456b57eae38', 1, 'Update', 'Spatie\\Permission\\Models\\Role', 1, 'Spatie\\Permission\\Models\\Role', 1, 'Spatie\\Permission\\Models\\Role', 1, '', 'finished', '', '2021-01-13 14:52:59', '2021-01-13 14:52:59', '[]', '[]'),
(84, '927b0a66-53f5-4955-9fb6-dfbac235b07b', 1, 'Create', 'App\\Models\\Order', 1, 'App\\Models\\Order', 1, 'App\\Models\\Order', 1, '', 'finished', '', '2021-01-13 18:58:51', '2021-01-13 18:58:51', NULL, '{\"user_id\":1,\"name\":\"Mohamed Maher\",\"email\":\"user@youmats.com\",\"phone\":\"01064323735\",\"phone2\":null,\"address\":\"Maadi\",\"building_number\":\"4006\",\"street\":\"\\u0627\\u0644\\u0645\\u0642\\u0627\\u0648\\u0644\\u0648\\u0646 \\u0627\\u0644\\u0639\\u0631\\u0628\",\"district\":\"\\u0627\\u0644\\u0645\\u0639\\u0631\\u0627\\u062c\",\"city\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\",\"payment_method\":\"cash\",\"payment_status\":\"pending\",\"order_status\":\"pending\",\"notes\":null,\"refused_notes\":null,\"total_price\":\"402.25\",\"created_by\":1,\"updated_at\":\"2021-01-13T20:58:51.000000Z\",\"created_at\":\"2021-01-13T20:58:51.000000Z\",\"id\":1}'),
(85, '927b0e66-8226-4312-8cad-908b6a186a3f', 1, 'Update', 'App\\Models\\Order', 1, 'App\\Models\\Order', 1, 'App\\Models\\Order', 1, '', 'finished', '', '2021-01-13 19:10:02', '2021-01-13 19:10:02', '{\"total_price\":402.25}', '{\"total_price\":\"34.9\"}'),
(86, '927b60e6-b6da-40d9-ad54-d57628e37c1e', 1, 'Delete', 'App\\Models\\OrderItem', 2, 'App\\Models\\OrderItem', 2, 'App\\Models\\OrderItem', 2, '', 'finished', '', '2021-01-13 23:00:43', '2021-01-13 23:00:43', NULL, NULL),
(87, '927c8f73-6f82-4b18-b301-28c42062d38e', 1, 'Update', 'Spatie\\Permission\\Models\\Role', 1, 'Spatie\\Permission\\Models\\Role', 1, 'Spatie\\Permission\\Models\\Role', 1, '', 'finished', '', '2021-01-14 13:06:43', '2021-01-14 13:06:43', '[]', '[]'),
(88, '927c8f8a-05ba-44cd-abcb-3ee04a453487', 1, 'Update', 'Spatie\\Permission\\Models\\Role', 1, 'Spatie\\Permission\\Models\\Role', 1, 'Spatie\\Permission\\Models\\Role', 1, '', 'finished', '', '2021-01-14 13:06:57', '2021-01-14 13:06:57', '[]', '[]'),
(89, '927c8faf-9a0b-4469-8578-fd26d6ba1da3', 1, 'Update', 'Spatie\\Permission\\Models\\Role', 1, 'Spatie\\Permission\\Models\\Role', 1, 'Spatie\\Permission\\Models\\Role', 1, '', 'finished', '', '2021-01-14 13:07:22', '2021-01-14 13:07:22', '[]', '[]'),
(90, '927c94a3-459d-4882-aa3d-8b1e2ee33848', 1, 'Create', 'Spatie\\Permission\\Models\\Role', 2, 'Spatie\\Permission\\Models\\Role', 2, 'Spatie\\Permission\\Models\\Role', 2, '', 'finished', '', '2021-01-14 13:21:13', '2021-01-14 13:21:13', NULL, '{\"guard_name\":\"admin\",\"name\":\"Data Entry\",\"updated_at\":\"2021-01-14T15:21:13.000000Z\",\"created_at\":\"2021-01-14T15:21:13.000000Z\",\"id\":2}'),
(91, '927c94b2-7965-460c-89bc-7e2b0e0a68a7', 1, 'Update', 'App\\Models\\Admin', 2, 'App\\Models\\Admin', 2, 'App\\Models\\Admin', 2, '', 'finished', '', '2021-01-14 13:21:23', '2021-01-14 13:21:23', '[]', '[]'),
(92, '927cb95f-1c01-46d4-9643-b01d7d8fa53f', 1, 'Update', 'App\\Models\\Order', 1, 'App\\Models\\Order', 1, 'App\\Models\\Order', 1, '', 'finished', '', '2021-01-14 15:03:56', '2021-01-14 15:03:56', '{\"payment_status\":\"pending\"}', '{\"payment_status\":\"refunded\"}'),
(93, '927cb971-8b67-4b07-aa6f-8a04b2c36d5b', 1, 'Update', 'App\\Models\\Order', 1, 'App\\Models\\Order', 1, 'App\\Models\\Order', 1, '', 'finished', '', '2021-01-14 15:04:08', '2021-01-14 15:04:08', '{\"payment_status\":\"refunded\"}', '{\"payment_status\":\"completed\"}'),
(94, '927cb97d-8037-4702-a9f6-eef7f2372bb5', 1, 'Update', 'App\\Models\\Order', 1, 'App\\Models\\Order', 1, 'App\\Models\\Order', 1, '', 'finished', '', '2021-01-14 15:04:16', '2021-01-14 15:04:16', '{\"order_status\":\"pending\"}', '{\"order_status\":\"shipping\"}'),
(95, '927cb98b-e9a5-49fd-bded-2e998d9c5d8b', 1, 'Update', 'App\\Models\\Order', 1, 'App\\Models\\Order', 1, 'App\\Models\\Order', 1, '', 'finished', '', '2021-01-14 15:04:25', '2021-01-14 15:04:25', '{\"order_status\":\"shipping\"}', '{\"order_status\":\"completed\"}'),
(96, '927cb999-b2d0-4dec-a6ab-d91b463bea6b', 1, 'Update', 'App\\Models\\Order', 1, 'App\\Models\\Order', 1, 'App\\Models\\Order', 1, '', 'finished', '', '2021-01-14 15:04:34', '2021-01-14 15:04:34', '{\"order_status\":\"completed\"}', '{\"order_status\":\"refused\"}'),
(97, '927cd1dd-df73-46a4-80eb-04f512328d26', 1, 'Create', 'App\\Models\\User', 7, 'App\\Models\\User', 7, 'App\\Models\\User', 7, '', 'finished', '', '2021-01-14 16:12:25', '2021-01-14 16:12:25', NULL, '{\"name\":\"Nashwa\",\"email\":\"nashwa1@gmail.com\",\"phone\":null,\"phone2\":null,\"address\":null,\"address2\":null,\"active\":\"0\",\"type\":\"individual\",\"created_by\":1,\"updated_at\":\"2021-01-14T18:12:25.000000Z\",\"created_at\":\"2021-01-14T18:12:25.000000Z\",\"id\":7}'),
(98, '927ce1e6-2e22-4d9a-aa12-dc9b1ff93d34', 1, 'Update', 'App\\Models\\Order', 5, 'App\\Models\\Order', 5, 'App\\Models\\Order', 5, '', 'finished', '', '2021-01-14 16:57:15', '2021-01-14 16:57:15', '{\"payment_status\":\"completed\",\"order_status\":\"completed\"}', '{\"payment_status\":\"refunded\",\"order_status\":\"shipping\"}'),
(99, '927ce2ac-4c04-4188-83c1-8fcc86754d7b', 1, 'Update', 'App\\Models\\Order', 1, 'App\\Models\\Order', 1, 'App\\Models\\Order', 1, '', 'finished', '', '2021-01-14 16:59:25', '2021-01-14 16:59:25', '{\"total_price\":340589.9}', '{\"total_price\":\"340.9\"}'),
(100, '92807a90-800c-4899-9e12-7b5a227a48d9', 1, 'Update', 'App\\Models\\User', 7, 'App\\Models\\User', 7, 'App\\Models\\User', 7, '', 'finished', '', '2021-01-16 11:51:37', '2021-01-16 11:51:37', '{\"active\":\"0\"}', '{\"active\":\"1\"}'),
(101, '928080d8-47ce-4afd-b00f-50259671cd5b', 1, 'Update', 'App\\Models\\User', 4, 'App\\Models\\User', 4, 'App\\Models\\User', 4, '', 'finished', '', '2021-01-16 12:09:11', '2021-01-16 12:09:11', '{\"active\":\"0\"}', '{\"active\":true}'),
(102, '92808173-0140-43b8-8f09-d66d709789af', 1, 'Update', 'App\\Models\\User', 5, 'App\\Models\\User', 5, 'App\\Models\\User', 5, '', 'finished', '', '2021-01-16 12:10:52', '2021-01-16 12:10:52', '{\"active\":\"0\"}', '{\"active\":true}'),
(103, '92808184-6da8-411f-b886-601e217ebf3c', 1, 'Update', 'App\\Models\\User', 5, 'App\\Models\\User', 5, 'App\\Models\\User', 5, '', 'finished', '', '2021-01-16 12:11:04', '2021-01-16 12:11:04', '{\"active\":\"0\"}', '{\"active\":true}'),
(104, '928081e9-727a-4675-8864-6106636214c7', 1, 'Update', 'App\\Models\\User', 5, 'App\\Models\\User', 5, 'App\\Models\\User', 5, '', 'finished', '', '2021-01-16 12:12:10', '2021-01-16 12:12:10', '{\"active\":\"0\"}', '{\"active\":1}'),
(105, '928081f0-4028-4682-acaa-707e9b2464f3', 1, 'Update', 'App\\Models\\User', 5, 'App\\Models\\User', 5, 'App\\Models\\User', 5, '', 'finished', '', '2021-01-16 12:12:14', '2021-01-16 12:12:14', '{\"active\":\"0\"}', '{\"active\":1}'),
(106, '92808206-6f4b-49af-a9e2-1bdf2bc01c57', 1, 'Update', 'App\\Models\\User', 5, 'App\\Models\\User', 5, 'App\\Models\\User', 5, '', 'finished', '', '2021-01-16 12:12:29', '2021-01-16 12:12:29', '{\"active\":\"0\"}', '{\"active\":\"1\"}'),
(107, '9280820d-1970-4209-a8ee-7efcbf1e0138', 1, 'Update', 'App\\Models\\User', 5, 'App\\Models\\User', 5, 'App\\Models\\User', 5, '', 'finished', '', '2021-01-16 12:12:33', '2021-01-16 12:12:33', '{\"active\":\"1\"}', '{\"active\":\"0\"}'),
(108, '92808214-59d2-43f8-ae71-ac4fb459ebfb', 1, 'Update', 'App\\Models\\User', 5, 'App\\Models\\User', 5, 'App\\Models\\User', 5, '', 'finished', '', '2021-01-16 12:12:38', '2021-01-16 12:12:38', '{\"active\":\"0\"}', '{\"active\":\"1\"}'),
(109, '9280822f-ea31-4a5d-90e9-6fc01294f695', 1, 'Update', 'App\\Models\\User', 5, 'App\\Models\\User', 5, 'App\\Models\\User', 5, '', 'finished', '', '2021-01-16 12:12:56', '2021-01-16 12:12:56', '{\"active\":\"1\"}', '{\"active\":\"0\"}'),
(110, '928090db-9932-4388-b335-cf6f1de6282e', 1, 'Update', 'App\\Models\\User', 7, 'App\\Models\\User', 7, 'App\\Models\\User', 7, '', 'finished', '', '2021-01-16 12:53:57', '2021-01-16 12:53:57', '{\"active\":1}', '{\"active\":false}'),
(111, '928090e5-8607-484c-88e7-c6a508996ab9', 1, 'Update', 'App\\Models\\User', 7, 'App\\Models\\User', 7, 'App\\Models\\User', 7, '', 'finished', '', '2021-01-16 12:54:04', '2021-01-16 12:54:04', '{\"active\":0}', '{\"active\":true}'),
(112, '928091fa-f118-49ea-a9c9-97fdf732db18', 1, 'Update', 'App\\Models\\Vendor', 1, 'App\\Models\\Vendor', 1, 'App\\Models\\Vendor', 1, '', 'finished', '', '2021-01-16 12:57:06', '2021-01-16 12:57:06', '{\"active\":1}', '{\"active\":false}'),
(113, '92809203-a1cd-49a4-b156-a6f31f8f0e8a', 1, 'Update', 'App\\Models\\Vendor', 1, 'App\\Models\\Vendor', 1, 'App\\Models\\Vendor', 1, '', 'finished', '', '2021-01-16 12:57:11', '2021-01-16 12:57:11', '{\"active\":0}', '{\"active\":true}'),
(114, '9280b881-df83-4c0c-bb14-aee49d93cd34', 1, 'Update', 'App\\Models\\Product', 1, 'App\\Models\\Product', 1, 'App\\Models\\Product', 1, '', 'finished', '', '2021-01-16 14:44:50', '2021-01-16 14:44:50', '{\"active\":0,\"quantity\":0}', '{\"active\":false,\"quantity\":\"218\"}'),
(115, '9280b944-9097-41c8-954e-de06b4baad3d', 1, 'Update', 'App\\Models\\Product', 1, 'App\\Models\\Product', 1, 'App\\Models\\Product', 1, '', 'finished', '', '2021-01-16 14:46:57', '2021-01-16 14:46:57', '{\"type\":\"product\",\"price\":\"10.00\",\"unit\":{\"en\":\"Kilo\",\"ar\":\"\\u0643\\u064a\\u0644\\u0648\"},\"active\":0}', '{\"type\":\"service\",\"price\":null,\"unit\":\"{\\\"en\\\":null,\\\"ar\\\":\\\"\\\\u0643\\\\u064a\\\\u0644\\\\u0648\\\"}\",\"active\":false}'),
(116, '9280bcdb-20dc-4d4f-b73e-f0db28f1a2b4', 1, 'Create', 'App\\Models\\Product', 3, 'App\\Models\\Product', 3, 'App\\Models\\Product', 3, '', 'finished', '', '2021-01-16 14:56:59', '2021-01-16 14:56:59', NULL, '{\"subCategory_id\":2,\"vendor_id\":1,\"name\":{\"en\":\"Service\",\"ar\":\"\\u062e\\u062f\\u0645\\u0629\"},\"short_desc\":{\"en\":\"Service\",\"ar\":\"Service\"},\"desc\":{\"en\":\"<p>Service<\\/p>\",\"ar\":\"<p>Service<\\/p>\"},\"type\":\"service\",\"price\":null,\"unit\":{\"en\":null},\"SKU\":\"FGEERR1252\",\"rate\":\"2.5\",\"active\":true,\"slug\":\"service\",\"meta_title\":{\"ar\":null},\"meta_keywords\":{\"ar\":null},\"meta_desc\":{\"ar\":null},\"created_by\":1,\"sort\":3,\"updated_at\":\"2021-01-16T16:56:59.000000Z\",\"created_at\":\"2021-01-16T16:56:59.000000Z\",\"id\":3}'),
(117, '92812104-21d5-4457-a46d-bf3178439b60', 1, 'Create', 'App\\Models\\Membership', 1, 'App\\Models\\Membership', 1, 'App\\Models\\Membership', 1, '', 'finished', '', '2021-01-16 19:37:03', '2021-01-16 19:37:03', NULL, '{\"name\":{\"en\":\"Free\",\"ar\":\"\\u0645\\u062c\\u0627\\u0646\\u0649\"},\"price\":\"0.00\",\"days\":\"100\",\"product_limit\":\"5\",\"created_by\":1,\"sort\":1,\"updated_at\":\"2021-01-16T21:37:03.000000Z\",\"created_at\":\"2021-01-16T21:37:03.000000Z\",\"id\":1}'),
(118, '9281218c-da86-4560-a993-1d967a1ab774', 1, 'Create', 'App\\Models\\Membership', 2, 'App\\Models\\Membership', 2, 'App\\Models\\Membership', 2, '', 'finished', '', '2021-01-16 19:38:33', '2021-01-16 19:38:33', NULL, '{\"name\":{\"en\":\"Silver\",\"ar\":\"\\u0641\\u0636\\u0649\"},\"price\":\"150\",\"days\":\"100\",\"product_limit\":\"20\",\"created_by\":1,\"sort\":2,\"updated_at\":\"2021-01-16T21:38:33.000000Z\",\"created_at\":\"2021-01-16T21:38:33.000000Z\",\"id\":2}'),
(119, '928121a5-9a19-4631-8e23-c7f4f025a8de', 1, 'Create', 'App\\Models\\Membership', 3, 'App\\Models\\Membership', 3, 'App\\Models\\Membership', 3, '', 'finished', '', '2021-01-16 19:38:49', '2021-01-16 19:38:49', NULL, '{\"name\":{\"en\":\"Gold\",\"ar\":\"\\u0630\\u0647\\u0628\\u0649\"},\"price\":\"500\",\"days\":\"100\",\"product_limit\":\"100\",\"created_by\":1,\"sort\":3,\"updated_at\":\"2021-01-16T21:38:49.000000Z\",\"created_at\":\"2021-01-16T21:38:49.000000Z\",\"id\":3}'),
(120, '92812291-332b-4fff-8899-7ce259217351', 1, 'Update', 'App\\Models\\Membership', 1, 'App\\Models\\Membership', 1, 'App\\Models\\Membership', 1, '', 'finished', '', '2021-01-16 19:41:23', '2021-01-16 19:41:23', '{\"days\":\"100\"}', '{\"days\":\"Lifetime\"}'),
(121, '92826ad9-1425-4289-8541-f9fa494cddd7', 1, 'Create', 'App\\Models\\Country', 1, 'App\\Models\\Country', 1, 'App\\Models\\Country', 1, '', 'finished', '', '2021-01-17 10:59:20', '2021-01-17 10:59:20', NULL, '{\"name\":{\"en\":\"Saudi Arabia\",\"ar\":\"\\u0627\\u0644\\u0633\\u0639\\u0648\\u062f\\u064a\\u0629\"},\"active\":true,\"created_by\":1,\"sort\":1,\"updated_at\":\"2021-01-17T12:59:19.000000Z\",\"created_at\":\"2021-01-17T12:59:19.000000Z\",\"id\":1}'),
(122, '92826afa-504a-43cc-a049-60ed5805e578', 1, 'Create', 'App\\Models\\Country', 2, 'App\\Models\\Country', 2, 'App\\Models\\Country', 2, '', 'finished', '', '2021-01-17 10:59:41', '2021-01-17 10:59:41', NULL, '{\"name\":{\"en\":\"Egypt\",\"ar\":\"\\u0645\\u0635\\u0631\"},\"active\":false,\"created_by\":1,\"sort\":2,\"updated_at\":\"2021-01-17T12:59:41.000000Z\",\"created_at\":\"2021-01-17T12:59:41.000000Z\",\"id\":2}'),
(123, '92826dfa-f741-4d90-a814-8ddb43c0e930', 1, 'Create', 'App\\Models\\Country', 3, 'App\\Models\\Country', 3, 'App\\Models\\Country', 3, '', 'finished', '', '2021-01-17 11:08:05', '2021-01-17 11:08:05', NULL, '{\"name\":{\"en\":\"Spain\",\"ar\":\"\\u0627\\u0633\\u0628\\u0627\\u0646\\u064a\\u0627\"},\"active\":true,\"created_by\":1,\"sort\":3,\"updated_at\":\"2021-01-17T13:08:05.000000Z\",\"created_at\":\"2021-01-17T13:08:05.000000Z\",\"id\":3}'),
(124, '92826e34-c841-4503-b1a0-ea05cb89c500', 1, 'Create', 'App\\Models\\City', 1, 'App\\Models\\City', 1, 'App\\Models\\City', 1, '', 'finished', '', '2021-01-17 11:08:43', '2021-01-17 11:08:43', NULL, '{\"country_id\":2,\"name\":{\"en\":\"Cairo\",\"ar\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\"},\"created_by\":1,\"updated_at\":\"2021-01-17T13:08:43.000000Z\",\"created_at\":\"2021-01-17T13:08:43.000000Z\",\"id\":1}'),
(125, '92827c13-8a89-4256-972a-05af3ab63629', 1, 'Create', 'App\\Models\\Tag', 1, 'App\\Models\\Tag', 1, 'App\\Models\\Tag', 1, '', 'finished', '', '2021-01-17 11:47:30', '2021-01-17 11:47:30', NULL, '{\"name\":{\"en\":\"Tables\",\"ar\":\"\\u062a\\u0631\\u0627\\u0628\\u064a\\u0632\\u0627\\u062a\"},\"desc\":{\"en\":\"<p>Tables<\\/p>\",\"ar\":\"<p>\\u062a\\u0631\\u0627\\u0628\\u064a\\u0632\\u0627\\u062a<\\/p>\"},\"slug\":\"tables\",\"meta_title\":{\"en\":\"Tables\",\"ar\":null},\"meta_keywords\":{\"en\":\"Tables\",\"ar\":null},\"meta_desc\":{\"en\":\"Tables\",\"ar\":null},\"created_by\":1,\"updated_at\":\"2021-01-17T13:47:30.000000Z\",\"created_at\":\"2021-01-17T13:47:30.000000Z\",\"id\":1}'),
(126, '92829107-3f82-4192-9b79-6c8310fb29c7', 1, 'Create', 'App\\Models\\City', 2, 'App\\Models\\City', 2, 'App\\Models\\City', 2, '', 'finished', '', '2021-01-17 12:46:05', '2021-01-17 12:46:05', NULL, '{\"country_id\":2,\"name\":{\"en\":\"Giza\",\"ar\":\"\\u062c\\u064a\\u0632\\u0629\"},\"created_by\":1,\"updated_at\":\"2021-01-17T14:46:05.000000Z\",\"created_at\":\"2021-01-17T14:46:05.000000Z\",\"id\":2}'),
(127, '928292cb-3d7c-405c-8141-451853c4fa54', 1, 'Create', 'App\\Models\\Vendor', 1, 'App\\Models\\Vendor', 1, 'App\\Models\\Vendor', 1, '', 'finished', '', '2021-01-17 12:51:01', '2021-01-17 12:51:01', NULL, '{\"membership_id\":1,\"city_id\":1,\"name\":\"Roc\",\"email\":\"roc@gmail.com\",\"phone\":\"01064323735\",\"phone2\":null,\"whatsapp_phone\":\"01064323735\",\"address\":null,\"address2\":null,\"facebook_url\":null,\"twitter_url\":null,\"youtube_url\":null,\"instagram_url\":null,\"pinterest_url\":null,\"website_url\":null,\"active\":false,\"created_by\":1,\"updated_at\":\"2021-01-17T14:51:01.000000Z\",\"created_at\":\"2021-01-17T14:51:01.000000Z\",\"id\":1}'),
(128, '9282e889-3ee6-48f4-8aae-ce72ec0a74eb', 1, 'Attach', 'App\\Models\\Product', 1, 'App\\Models\\Tag', 1, 'Illuminate\\Database\\Eloquent\\Relations\\Pivot', NULL, '', 'finished', '', '2021-01-17 16:50:47', '2021-01-17 16:50:47', NULL, '{\"product_id\":\"1\",\"tag_id\":\"1\"}'),
(129, '92836301-a180-4171-a7e1-de8666d1aa97', 1, 'Create', 'App\\Models\\Tag', 2, 'App\\Models\\Tag', 2, 'App\\Models\\Tag', 2, '', 'finished', '', '2021-01-17 22:33:14', '2021-01-17 22:33:14', NULL, '{\"name\":{\"en\":\"Tag 1\",\"ar\":\"Tag 1\"},\"desc\":{\"en\":\"<p>Tag 1<\\/p>\",\"ar\":\"<p>Tag 1<\\/p>\"},\"slug\":\"Tag 1\",\"meta_title\":{\"ar\":null},\"meta_keywords\":{\"ar\":null},\"meta_desc\":{\"ar\":null},\"created_by\":1,\"updated_at\":\"2021-01-18T00:33:14.000000Z\",\"created_at\":\"2021-01-18T00:33:14.000000Z\",\"id\":2}'),
(130, '92836310-2e40-4723-b3e4-f57e8c9dcac9', 1, 'Create', 'App\\Models\\Tag', 3, 'App\\Models\\Tag', 3, 'App\\Models\\Tag', 3, '', 'finished', '', '2021-01-17 22:33:23', '2021-01-17 22:33:23', NULL, '{\"name\":{\"en\":\"Tag 2\",\"ar\":\"Tag 2\"},\"desc\":{\"en\":\"<p>Tag 2<\\/p>\",\"ar\":\"<p>Tag 2<\\/p>\"},\"slug\":\"Tag 2\",\"meta_title\":{\"ar\":null},\"meta_keywords\":{\"ar\":null},\"meta_desc\":{\"ar\":null},\"created_by\":1,\"updated_at\":\"2021-01-18T00:33:23.000000Z\",\"created_at\":\"2021-01-18T00:33:23.000000Z\",\"id\":3}'),
(131, '92836320-2aff-46ea-9d62-d8d2fc1a652b', 1, 'Create', 'App\\Models\\Tag', 4, 'App\\Models\\Tag', 4, 'App\\Models\\Tag', 4, '', 'finished', '', '2021-01-17 22:33:34', '2021-01-17 22:33:34', NULL, '{\"name\":{\"en\":\"Tag 3\",\"ar\":\"Tag 3\"},\"desc\":{\"en\":\"<p>Tag 3<\\/p>\",\"ar\":\"<p>Tag 3<\\/p>\"},\"slug\":\"Tag 3\",\"meta_title\":{\"ar\":null},\"meta_keywords\":{\"ar\":null},\"meta_desc\":{\"ar\":null},\"created_by\":1,\"updated_at\":\"2021-01-18T00:33:34.000000Z\",\"created_at\":\"2021-01-18T00:33:34.000000Z\",\"id\":4}'),
(132, '9283632f-eb30-4038-bb72-eb0d632b299f', 1, 'Create', 'App\\Models\\Tag', 5, 'App\\Models\\Tag', 5, 'App\\Models\\Tag', 5, '', 'finished', '', '2021-01-17 22:33:44', '2021-01-17 22:33:44', NULL, '{\"name\":{\"en\":\"Tag 4\",\"ar\":\"Tag 4\"},\"desc\":{\"en\":\"<p>Tag 4<\\/p>\",\"ar\":\"<p>Tag 4<\\/p>\"},\"slug\":\"Tag 4\",\"meta_title\":{\"ar\":null},\"meta_keywords\":{\"ar\":null},\"meta_desc\":{\"ar\":null},\"created_by\":1,\"updated_at\":\"2021-01-18T00:33:44.000000Z\",\"created_at\":\"2021-01-18T00:33:44.000000Z\",\"id\":5}'),
(133, '92836340-fa93-4d49-adbf-40dcd4a656e1', 1, 'Create', 'App\\Models\\Tag', 6, 'App\\Models\\Tag', 6, 'App\\Models\\Tag', 6, '', 'finished', '', '2021-01-17 22:33:55', '2021-01-17 22:33:55', NULL, '{\"name\":{\"en\":\"Tag 5\",\"ar\":\"Tag 5\"},\"desc\":{\"en\":\"<p>Tag 5<\\/p>\",\"ar\":\"<p>Tag 5<\\/p>\"},\"slug\":\"Tag 5\",\"meta_title\":{\"ar\":null},\"meta_keywords\":{\"ar\":null},\"meta_desc\":{\"ar\":null},\"created_by\":1,\"updated_at\":\"2021-01-18T00:33:55.000000Z\",\"created_at\":\"2021-01-18T00:33:55.000000Z\",\"id\":6}'),
(134, '92836351-9db1-4108-b8e4-5fa484845337', 1, 'Create', 'App\\Models\\Tag', 7, 'App\\Models\\Tag', 7, 'App\\Models\\Tag', 7, '', 'finished', '', '2021-01-17 22:34:06', '2021-01-17 22:34:06', NULL, '{\"name\":{\"en\":\"Tag 6\",\"ar\":\"Tag 6\"},\"desc\":{\"en\":\"<p>Tag 6<\\/p>\",\"ar\":\"<p>Tag 6<\\/p>\"},\"slug\":\"Tag 6\",\"meta_title\":{\"ar\":null},\"meta_keywords\":{\"ar\":null},\"meta_desc\":{\"ar\":null},\"created_by\":1,\"updated_at\":\"2021-01-18T00:34:06.000000Z\",\"created_at\":\"2021-01-18T00:34:06.000000Z\",\"id\":7}'),
(135, '92836361-ff9c-4555-9527-3015a5cee5b2', 1, 'Create', 'App\\Models\\Tag', 8, 'App\\Models\\Tag', 8, 'App\\Models\\Tag', 8, '', 'finished', '', '2021-01-17 22:34:17', '2021-01-17 22:34:17', NULL, '{\"name\":{\"en\":\"Tag 7\",\"ar\":\"Tag 7\"},\"desc\":{\"en\":\"<p>Tag 7<\\/p>\",\"ar\":\"<p>Tag 7<\\/p>\"},\"slug\":\"Tag 7\",\"meta_title\":{\"ar\":null},\"meta_keywords\":{\"ar\":null},\"meta_desc\":{\"ar\":null},\"created_by\":1,\"updated_at\":\"2021-01-18T00:34:17.000000Z\",\"created_at\":\"2021-01-18T00:34:17.000000Z\",\"id\":8}'),
(136, '9283639f-f11c-4f4f-ae8a-734e8bfaf69e', 1, 'Update', 'App\\Models\\Product', 1, 'App\\Models\\Product', 1, 'App\\Models\\Product', 1, '', 'finished', '', '2021-01-17 22:34:57', '2021-01-17 22:34:57', '{\"unit\":{\"en\":null,\"ar\":\"\\u0643\\u064a\\u0644\\u0648\"},\"active\":0}', '{\"unit\":\"{\\\"ar\\\":\\\"\\\\u0643\\\\u064a\\\\u0644\\\\u0648\\\",\\\"en\\\":null}\",\"active\":false}'),
(137, '92836d5c-e7c8-4b77-acb7-f8c7752c3b70', 1, 'Update', 'App\\Models\\Product', 1, 'App\\Models\\Product', 1, 'App\\Models\\Product', 1, '', 'finished', '', '2021-01-17 23:02:11', '2021-01-17 23:02:11', '{\"active\":0}', '{\"active\":false}'),
(138, '928382a7-54e8-4961-9bb8-02864b42dc54', 1, 'Update', 'App\\Models\\Product', 1, 'App\\Models\\Product', 1, 'App\\Models\\Product', 1, '', 'finished', '', '2021-01-18 00:01:43', '2021-01-18 00:01:43', '{\"active\":0}', '{\"active\":false}'),
(139, '9283875d-52b9-441a-8811-aeef58cbedea', 1, 'Update', 'App\\Models\\SubCategory', 2, 'App\\Models\\SubCategory', 2, 'App\\Models\\SubCategory', 2, '', 'finished', '', '2021-01-18 00:14:54', '2021-01-18 00:14:54', '{\"category_id\":2}', '{\"category_id\":1}'),
(140, '9284954b-7aca-46ae-a448-00800c7f4a98', 1, 'Attach', 'App\\Models\\Tag', 2, 'App\\Models\\Product', 2, 'Illuminate\\Database\\Eloquent\\Relations\\Pivot', NULL, '', 'finished', '', '2021-01-18 12:49:41', '2021-01-18 12:49:41', NULL, '{\"tag_id\":\"2\",\"product_id\":\"2\"}'),
(141, '9284a37c-3b32-4046-895a-d9bf9a8298e5', 1, 'Create', 'App\\Models\\Subscriber', 1, 'App\\Models\\Subscriber', 1, 'App\\Models\\Subscriber', 1, '', 'finished', '', '2021-01-18 13:29:21', '2021-01-18 13:29:21', NULL, '{\"email\":\"mohamedmaher055@gmail.com\",\"created_by\":1,\"updated_at\":\"2021-01-18T15:29:21.000000Z\",\"created_at\":\"2021-01-18T15:29:21.000000Z\",\"id\":1}'),
(142, '9284a7fb-5371-41a0-ba42-540a7b542476', 1, 'Create', 'App\\Models\\Contact', 1, 'App\\Models\\Contact', 1, 'App\\Models\\Contact', 1, '', 'finished', '', '2021-01-18 13:41:56', '2021-01-18 13:41:56', NULL, '{\"name\":\"Mohamed Maher\",\"email\":\"mohamedmaher055@gmail.com\",\"phone\":\"01064323735\",\"message\":\"Test\",\"created_by\":1,\"updated_at\":\"2021-01-18T15:41:56.000000Z\",\"created_at\":\"2021-01-18T15:41:56.000000Z\",\"id\":1}'),
(143, '9284a825-1346-4bd7-93a2-c9a6981aa6e1', 1, 'Create', 'App\\Models\\Contact', 2, 'App\\Models\\Contact', 2, 'App\\Models\\Contact', 2, '', 'finished', '', '2021-01-18 13:42:23', '2021-01-18 13:42:23', NULL, '{\"name\":\"Mohamed Maher Tany\",\"email\":\"mohamedmaher055@gmail.com\",\"phone\":\"01064323735\",\"message\":\"Test Tany\",\"created_by\":1,\"updated_at\":\"2021-01-18T15:42:23.000000Z\",\"created_at\":\"2021-01-18T15:42:23.000000Z\",\"id\":2}'),
(144, '9284a8fe-3c7f-4600-b015-73144b6151c7', 1, 'Delete', 'App\\Models\\Contact', 2, 'App\\Models\\Contact', 2, 'App\\Models\\Contact', 2, '', 'finished', '', '2021-01-18 13:44:45', '2021-01-18 13:44:45', NULL, NULL),
(145, '9284a913-c02d-4d62-8b97-5d111338fb1c', 1, 'Restore', 'App\\Models\\Contact', 2, 'App\\Models\\Contact', 2, 'App\\Models\\Contact', 2, '', 'finished', '', '2021-01-18 13:44:59', '2021-01-18 13:44:59', NULL, NULL);
INSERT INTO `action_events` (`id`, `batch_id`, `user_id`, `name`, `actionable_type`, `actionable_id`, `target_type`, `target_id`, `model_type`, `model_id`, `fields`, `status`, `exception`, `created_at`, `updated_at`, `original`, `changes`) VALUES
(153, '92852665-d6d8-492b-8f25-d67b34339642', 1, 'Update', 'App\\Models\\Vendor', 1, 'App\\Models\\Vendor', 1, 'App\\Models\\Vendor', 1, '', 'finished', '', '2021-01-18 19:35:25', '2021-01-18 19:35:25', '{\"location\":null,\"active\":0}', '{\"location\":\"{\\\"administrative\\\":\\\"\\u0645\\u0646\\u0637\\u0642\\u0629 \\u0627\\u0644\\u0631\\u064a\\u0627\\u0636\\\",\\\"country\\\":\\\"Saudi Arabia\\\",\\\"countryCode\\\":\\\"sa\\\",\\\"latlng\\\":{\\\"lat\\\":24.632,\\\"lng\\\":46.7151},\\\"name\\\":\\\"Riyadh\\\",\\\"postcode\\\":\\\"11131\\\",\\\"query\\\":\\\"\\u0627\\u0644\\u0631\\\",\\\"type\\\":\\\"city\\\",\\\"value\\\":\\\"Riyadh, \\u0645\\u0646\\u0637\\u0642\\u0629 \\u0627\\u0644\\u0631\\u064a\\u0627\\u0636, Saudi Arabia\\\"}\",\"active\":false}'),
(154, '92852e1d-e6ec-4596-8687-9ef311f1f59f', 1, 'Delete', 'App\\Models\\Currency', 1, 'App\\Models\\Currency', 1, 'App\\Models\\Currency', 1, '', 'finished', '', '2021-01-18 19:57:00', '2021-01-18 19:57:00', NULL, NULL),
(155, '92852e1e-e572-498a-bdc0-eb13f4a8445c', 1, 'Delete', 'App\\Models\\Currency', 2, 'App\\Models\\Currency', 2, 'App\\Models\\Currency', 2, '', 'finished', '', '2021-01-18 19:57:00', '2021-01-18 19:57:00', NULL, NULL),
(156, '92852e1f-c947-43fe-ac9c-835d6265e1bd', 1, 'Delete', 'App\\Models\\Currency', 3, 'App\\Models\\Currency', 3, 'App\\Models\\Currency', 3, '', 'finished', '', '2021-01-18 19:57:01', '2021-01-18 19:57:01', NULL, NULL),
(157, '92852e20-ad3a-40c8-96cd-e2ebd9932882', 1, 'Delete', 'App\\Models\\Currency', 4, 'App\\Models\\Currency', 4, 'App\\Models\\Currency', 4, '', 'finished', '', '2021-01-18 19:57:01', '2021-01-18 19:57:01', NULL, NULL),
(158, '92852e21-977a-4485-907c-2156646d8170', 1, 'Delete', 'App\\Models\\Currency', 5, 'App\\Models\\Currency', 5, 'App\\Models\\Currency', 5, '', 'finished', '', '2021-01-18 19:57:02', '2021-01-18 19:57:02', NULL, NULL),
(159, '92852e22-98d2-42d5-86e9-807aa0eb0c77', 1, 'Delete', 'App\\Models\\Currency', 6, 'App\\Models\\Currency', 6, 'App\\Models\\Currency', 6, '', 'finished', '', '2021-01-18 19:57:03', '2021-01-18 19:57:03', NULL, NULL),
(160, '92852e23-7fd8-4007-ae5a-b4cf91bd898a', 1, 'Delete', 'App\\Models\\Currency', 7, 'App\\Models\\Currency', 7, 'App\\Models\\Currency', 7, '', 'finished', '', '2021-01-18 19:57:03', '2021-01-18 19:57:03', NULL, NULL),
(161, '92852e24-596a-498a-bcd6-f836a814f2e1', 1, 'Delete', 'App\\Models\\Currency', 8, 'App\\Models\\Currency', 8, 'App\\Models\\Currency', 8, '', 'finished', '', '2021-01-18 19:57:04', '2021-01-18 19:57:04', NULL, NULL),
(162, '92852e25-3106-4706-8fb1-eb126201cf03', 1, 'Delete', 'App\\Models\\Currency', 9, 'App\\Models\\Currency', 9, 'App\\Models\\Currency', 9, '', 'finished', '', '2021-01-18 19:57:04', '2021-01-18 19:57:04', NULL, NULL),
(163, '92852e26-06f9-4e96-b226-8ba97e84c96f', 1, 'Delete', 'App\\Models\\Currency', 10, 'App\\Models\\Currency', 10, 'App\\Models\\Currency', 10, '', 'finished', '', '2021-01-18 19:57:05', '2021-01-18 19:57:05', NULL, NULL),
(164, '92852e26-d832-425b-afc9-cd33dabfc1fb', 1, 'Delete', 'App\\Models\\Currency', 12, 'App\\Models\\Currency', 12, 'App\\Models\\Currency', 12, '', 'finished', '', '2021-01-18 19:57:06', '2021-01-18 19:57:06', NULL, NULL),
(165, '92852e27-ae51-4bf8-814c-168c12a905f3', 1, 'Delete', 'App\\Models\\Currency', 13, 'App\\Models\\Currency', 13, 'App\\Models\\Currency', 13, '', 'finished', '', '2021-01-18 19:57:06', '2021-01-18 19:57:06', NULL, NULL),
(166, '92852e28-8cac-40fa-a2ab-7ec21596747b', 1, 'Delete', 'App\\Models\\Currency', 14, 'App\\Models\\Currency', 14, 'App\\Models\\Currency', 14, '', 'finished', '', '2021-01-18 19:57:07', '2021-01-18 19:57:07', NULL, NULL),
(167, '92852e29-6f90-44bc-8b16-514cdd73e7e5', 1, 'Delete', 'App\\Models\\Currency', 15, 'App\\Models\\Currency', 15, 'App\\Models\\Currency', 15, '', 'finished', '', '2021-01-18 19:57:07', '2021-01-18 19:57:07', NULL, NULL),
(168, '92852e2a-466f-4686-94e8-b57bd6d8a464', 1, 'Delete', 'App\\Models\\Currency', 16, 'App\\Models\\Currency', 16, 'App\\Models\\Currency', 16, '', 'finished', '', '2021-01-18 19:57:08', '2021-01-18 19:57:08', NULL, NULL),
(169, '92852e2b-2b24-42ae-a916-697eb4eaeb49', 1, 'Delete', 'App\\Models\\Currency', 17, 'App\\Models\\Currency', 17, 'App\\Models\\Currency', 17, '', 'finished', '', '2021-01-18 19:57:08', '2021-01-18 19:57:08', NULL, NULL),
(170, '92852e2c-1f6f-471c-b2b0-10686d3a643f', 1, 'Delete', 'App\\Models\\Currency', 18, 'App\\Models\\Currency', 18, 'App\\Models\\Currency', 18, '', 'finished', '', '2021-01-18 19:57:09', '2021-01-18 19:57:09', NULL, NULL),
(171, '92852e2d-1c87-4824-a80b-4c5c5c3c119e', 1, 'Delete', 'App\\Models\\Currency', 19, 'App\\Models\\Currency', 19, 'App\\Models\\Currency', 19, '', 'finished', '', '2021-01-18 19:57:10', '2021-01-18 19:57:10', NULL, NULL),
(172, '92852e2e-21fb-46be-b370-aca2d250617a', 1, 'Delete', 'App\\Models\\Currency', 20, 'App\\Models\\Currency', 20, 'App\\Models\\Currency', 20, '', 'finished', '', '2021-01-18 19:57:10', '2021-01-18 19:57:10', NULL, NULL),
(173, '92852e2f-2327-4729-bba2-0c5a0e49dd71', 1, 'Delete', 'App\\Models\\Currency', 22, 'App\\Models\\Currency', 22, 'App\\Models\\Currency', 22, '', 'finished', '', '2021-01-18 19:57:11', '2021-01-18 19:57:11', NULL, NULL),
(174, '92852e30-13f8-4bc0-85e4-e49a3b4f6a4e', 1, 'Delete', 'App\\Models\\Currency', 23, 'App\\Models\\Currency', 23, 'App\\Models\\Currency', 23, '', 'finished', '', '2021-01-18 19:57:12', '2021-01-18 19:57:12', NULL, NULL),
(175, '92852e31-2288-4b14-b48a-087a522aef8b', 1, 'Delete', 'App\\Models\\Currency', 24, 'App\\Models\\Currency', 24, 'App\\Models\\Currency', 24, '', 'finished', '', '2021-01-18 19:57:12', '2021-01-18 19:57:12', NULL, NULL),
(176, '92852e32-2920-4baa-ad46-820aa67904ce', 1, 'Delete', 'App\\Models\\Currency', 25, 'App\\Models\\Currency', 25, 'App\\Models\\Currency', 25, '', 'finished', '', '2021-01-18 19:57:13', '2021-01-18 19:57:13', NULL, NULL),
(177, '92852e33-7c8d-4c70-8f97-83ffa5d88bf2', 1, 'Delete', 'App\\Models\\Currency', 26, 'App\\Models\\Currency', 26, 'App\\Models\\Currency', 26, '', 'finished', '', '2021-01-18 19:57:14', '2021-01-18 19:57:14', NULL, NULL),
(178, '92852e34-8037-454f-a221-2181e1b15a6f', 1, 'Delete', 'App\\Models\\Currency', 27, 'App\\Models\\Currency', 27, 'App\\Models\\Currency', 27, '', 'finished', '', '2021-01-18 19:57:14', '2021-01-18 19:57:14', NULL, NULL),
(179, '92852e35-9527-4d19-a63c-a247cb088648', 1, 'Delete', 'App\\Models\\Currency', 28, 'App\\Models\\Currency', 28, 'App\\Models\\Currency', 28, '', 'finished', '', '2021-01-18 19:57:15', '2021-01-18 19:57:15', NULL, NULL),
(180, '92852e36-aa9a-424a-a2f1-bb034406cfc0', 1, 'Delete', 'App\\Models\\Currency', 32, 'App\\Models\\Currency', 32, 'App\\Models\\Currency', 32, '', 'finished', '', '2021-01-18 19:57:16', '2021-01-18 19:57:16', NULL, NULL),
(181, '92852e37-d543-42df-a941-bc3554113efb', 1, 'Delete', 'App\\Models\\Currency', 33, 'App\\Models\\Currency', 33, 'App\\Models\\Currency', 33, '', 'finished', '', '2021-01-18 19:57:17', '2021-01-18 19:57:17', NULL, NULL),
(182, '92852e38-e143-4491-bcdf-9b5c5dc55142', 1, 'Delete', 'App\\Models\\Currency', 34, 'App\\Models\\Currency', 34, 'App\\Models\\Currency', 34, '', 'finished', '', '2021-01-18 19:57:17', '2021-01-18 19:57:17', NULL, NULL),
(183, '92852e39-f923-4672-900b-b5477e1bb448', 1, 'Delete', 'App\\Models\\Currency', 36, 'App\\Models\\Currency', 36, 'App\\Models\\Currency', 36, '', 'finished', '', '2021-01-18 19:57:18', '2021-01-18 19:57:18', NULL, NULL),
(184, '92852e3b-00b8-4322-a5cb-d90d2bf36a50', 1, 'Delete', 'App\\Models\\Currency', 37, 'App\\Models\\Currency', 37, 'App\\Models\\Currency', 37, '', 'finished', '', '2021-01-18 19:57:19', '2021-01-18 19:57:19', NULL, NULL),
(185, '92852e3c-3e8b-42d0-aa0e-7d4a62127462', 1, 'Delete', 'App\\Models\\Currency', 38, 'App\\Models\\Currency', 38, 'App\\Models\\Currency', 38, '', 'finished', '', '2021-01-18 19:57:20', '2021-01-18 19:57:20', NULL, NULL),
(186, '92852e3d-3d1d-4e43-9e9c-f358dba7a72c', 1, 'Delete', 'App\\Models\\Currency', 39, 'App\\Models\\Currency', 39, 'App\\Models\\Currency', 39, '', 'finished', '', '2021-01-18 19:57:20', '2021-01-18 19:57:20', NULL, NULL),
(187, '92852e3e-5fa7-40dd-a453-e4513bc3ca8e', 1, 'Delete', 'App\\Models\\Currency', 40, 'App\\Models\\Currency', 40, 'App\\Models\\Currency', 40, '', 'finished', '', '2021-01-18 19:57:21', '2021-01-18 19:57:21', NULL, NULL),
(188, '92852e3f-8dee-4d9a-ab04-166fee72137e', 1, 'Delete', 'App\\Models\\Currency', 41, 'App\\Models\\Currency', 41, 'App\\Models\\Currency', 41, '', 'finished', '', '2021-01-18 19:57:22', '2021-01-18 19:57:22', NULL, NULL),
(189, '92852e40-9f15-4c6c-9f22-3f0deb36f9cd', 1, 'Delete', 'App\\Models\\Currency', 42, 'App\\Models\\Currency', 42, 'App\\Models\\Currency', 42, '', 'finished', '', '2021-01-18 19:57:22', '2021-01-18 19:57:22', NULL, NULL),
(190, '92852e41-e582-4f56-a9a9-a31f3d999ad2', 1, 'Delete', 'App\\Models\\Currency', 43, 'App\\Models\\Currency', 43, 'App\\Models\\Currency', 43, '', 'finished', '', '2021-01-18 19:57:23', '2021-01-18 19:57:23', NULL, NULL),
(191, '92852e42-fcaf-40ed-a24a-e7a7da2fae73', 1, 'Delete', 'App\\Models\\Currency', 44, 'App\\Models\\Currency', 44, 'App\\Models\\Currency', 44, '', 'finished', '', '2021-01-18 19:57:24', '2021-01-18 19:57:24', NULL, NULL),
(192, '92852e44-4641-4f90-8f7c-d4fea1e46cbf', 1, 'Delete', 'App\\Models\\Currency', 45, 'App\\Models\\Currency', 45, 'App\\Models\\Currency', 45, '', 'finished', '', '2021-01-18 19:57:25', '2021-01-18 19:57:25', NULL, NULL),
(193, '92852e45-8156-48db-93fa-b8ecd91a67ce', 1, 'Delete', 'App\\Models\\Currency', 46, 'App\\Models\\Currency', 46, 'App\\Models\\Currency', 46, '', 'finished', '', '2021-01-18 19:57:26', '2021-01-18 19:57:26', NULL, NULL),
(194, '92852e46-c128-4a55-bbc0-7fbcf551ced4', 1, 'Delete', 'App\\Models\\Currency', 47, 'App\\Models\\Currency', 47, 'App\\Models\\Currency', 47, '', 'finished', '', '2021-01-18 19:57:26', '2021-01-18 19:57:26', NULL, NULL),
(195, '92852e47-d2aa-4784-81e3-45a6a94b0d55', 1, 'Delete', 'App\\Models\\Currency', 48, 'App\\Models\\Currency', 48, 'App\\Models\\Currency', 48, '', 'finished', '', '2021-01-18 19:57:27', '2021-01-18 19:57:27', NULL, NULL),
(196, '92852e48-fd8b-4a77-95fe-76ebbf4ad530', 1, 'Delete', 'App\\Models\\Currency', 49, 'App\\Models\\Currency', 49, 'App\\Models\\Currency', 49, '', 'finished', '', '2021-01-18 19:57:28', '2021-01-18 19:57:28', NULL, NULL),
(197, '92852e4a-499d-4cc4-89b7-de034b2b66dd', 1, 'Delete', 'App\\Models\\Currency', 50, 'App\\Models\\Currency', 50, 'App\\Models\\Currency', 50, '', 'finished', '', '2021-01-18 19:57:29', '2021-01-18 19:57:29', NULL, NULL),
(198, '92852e4b-8fee-4854-bc64-6568017b4a6c', 1, 'Delete', 'App\\Models\\Currency', 51, 'App\\Models\\Currency', 51, 'App\\Models\\Currency', 51, '', 'finished', '', '2021-01-18 19:57:30', '2021-01-18 19:57:30', NULL, NULL),
(199, '92852e4c-a0ae-4b94-9d8f-5ccb12b15e67', 1, 'Delete', 'App\\Models\\Currency', 52, 'App\\Models\\Currency', 52, 'App\\Models\\Currency', 52, '', 'finished', '', '2021-01-18 19:57:30', '2021-01-18 19:57:30', NULL, NULL),
(200, '92852e4d-dfeb-4f10-a17c-1eb0f2e9c1b0', 1, 'Delete', 'App\\Models\\Currency', 53, 'App\\Models\\Currency', 53, 'App\\Models\\Currency', 53, '', 'finished', '', '2021-01-18 19:57:31', '2021-01-18 19:57:31', NULL, NULL),
(201, '92852e4f-11d1-4d51-b904-66f6de8ca69f', 1, 'Delete', 'App\\Models\\Currency', 54, 'App\\Models\\Currency', 54, 'App\\Models\\Currency', 54, '', 'finished', '', '2021-01-18 19:57:32', '2021-01-18 19:57:32', NULL, NULL),
(202, '92852e50-74b3-4df0-8d0a-45d7451534ff', 1, 'Delete', 'App\\Models\\Currency', 55, 'App\\Models\\Currency', 55, 'App\\Models\\Currency', 55, '', 'finished', '', '2021-01-18 19:57:33', '2021-01-18 19:57:33', NULL, NULL),
(203, '92852e51-9368-4539-975e-87832f440073', 1, 'Delete', 'App\\Models\\Currency', 56, 'App\\Models\\Currency', 56, 'App\\Models\\Currency', 56, '', 'finished', '', '2021-01-18 19:57:34', '2021-01-18 19:57:34', NULL, NULL),
(204, '92852e52-dc10-414a-811b-7033db587d2c', 1, 'Delete', 'App\\Models\\Currency', 57, 'App\\Models\\Currency', 57, 'App\\Models\\Currency', 57, '', 'finished', '', '2021-01-18 19:57:34', '2021-01-18 19:57:34', NULL, NULL),
(205, '92852e54-8512-46bf-9c7e-6e53bb0891fb', 1, 'Delete', 'App\\Models\\Currency', 58, 'App\\Models\\Currency', 58, 'App\\Models\\Currency', 58, '', 'finished', '', '2021-01-18 19:57:35', '2021-01-18 19:57:35', NULL, NULL),
(206, '92852e55-d9da-4101-b323-12dc6857a814', 1, 'Delete', 'App\\Models\\Currency', 59, 'App\\Models\\Currency', 59, 'App\\Models\\Currency', 59, '', 'finished', '', '2021-01-18 19:57:36', '2021-01-18 19:57:36', NULL, NULL),
(207, '92852e57-056e-4215-8c98-0fa79f45c7ad', 1, 'Delete', 'App\\Models\\Currency', 60, 'App\\Models\\Currency', 60, 'App\\Models\\Currency', 60, '', 'finished', '', '2021-01-18 19:57:37', '2021-01-18 19:57:37', NULL, NULL),
(208, '92852e58-4166-4162-acbf-a987b2ee7ffb', 1, 'Delete', 'App\\Models\\Currency', 61, 'App\\Models\\Currency', 61, 'App\\Models\\Currency', 61, '', 'finished', '', '2021-01-18 19:57:38', '2021-01-18 19:57:38', NULL, NULL),
(209, '92852e59-a0cb-4e6d-ac2e-4b563dc3f569', 1, 'Delete', 'App\\Models\\Currency', 62, 'App\\Models\\Currency', 62, 'App\\Models\\Currency', 62, '', 'finished', '', '2021-01-18 19:57:39', '2021-01-18 19:57:39', NULL, NULL),
(210, '92852e5a-ed3d-4897-954f-c8aeb1cbb0dd', 1, 'Delete', 'App\\Models\\Currency', 63, 'App\\Models\\Currency', 63, 'App\\Models\\Currency', 63, '', 'finished', '', '2021-01-18 19:57:40', '2021-01-18 19:57:40', NULL, NULL),
(211, '92852e5c-6a32-4eac-ab91-3261de6a749d', 1, 'Delete', 'App\\Models\\Currency', 64, 'App\\Models\\Currency', 64, 'App\\Models\\Currency', 64, '', 'finished', '', '2021-01-18 19:57:41', '2021-01-18 19:57:41', NULL, NULL),
(212, '92852e5d-982b-4771-b1e5-fd42de1fc3c3', 1, 'Delete', 'App\\Models\\Currency', 65, 'App\\Models\\Currency', 65, 'App\\Models\\Currency', 65, '', 'finished', '', '2021-01-18 19:57:41', '2021-01-18 19:57:41', NULL, NULL),
(213, '92852e5e-d4a7-46e9-8b3e-c4b5eaecfc81', 1, 'Delete', 'App\\Models\\Currency', 66, 'App\\Models\\Currency', 66, 'App\\Models\\Currency', 66, '', 'finished', '', '2021-01-18 19:57:42', '2021-01-18 19:57:42', NULL, NULL),
(214, '92852e60-1304-48af-92c9-64ab1aa75bc7', 1, 'Delete', 'App\\Models\\Currency', 67, 'App\\Models\\Currency', 67, 'App\\Models\\Currency', 67, '', 'finished', '', '2021-01-18 19:57:43', '2021-01-18 19:57:43', NULL, NULL),
(215, '92852e61-599b-4807-9173-4de4562376e0', 1, 'Delete', 'App\\Models\\Currency', 68, 'App\\Models\\Currency', 68, 'App\\Models\\Currency', 68, '', 'finished', '', '2021-01-18 19:57:44', '2021-01-18 19:57:44', NULL, NULL),
(216, '92852e62-91eb-467e-87e0-01b41d39f782', 1, 'Delete', 'App\\Models\\Currency', 69, 'App\\Models\\Currency', 69, 'App\\Models\\Currency', 69, '', 'finished', '', '2021-01-18 19:57:45', '2021-01-18 19:57:45', NULL, NULL),
(217, '92852e63-fe72-4354-9778-8d5ca2421a52', 1, 'Delete', 'App\\Models\\Currency', 70, 'App\\Models\\Currency', 70, 'App\\Models\\Currency', 70, '', 'finished', '', '2021-01-18 19:57:46', '2021-01-18 19:57:46', NULL, NULL),
(218, '92852e65-7477-44ea-8781-ef841d9f970b', 1, 'Delete', 'App\\Models\\Currency', 71, 'App\\Models\\Currency', 71, 'App\\Models\\Currency', 71, '', 'finished', '', '2021-01-18 19:57:47', '2021-01-18 19:57:47', NULL, NULL),
(219, '92852e66-cd5e-4528-b558-471270fa20ea', 1, 'Delete', 'App\\Models\\Currency', 72, 'App\\Models\\Currency', 72, 'App\\Models\\Currency', 72, '', 'finished', '', '2021-01-18 19:57:47', '2021-01-18 19:57:47', NULL, NULL),
(220, '92852e68-36ea-46f4-aa28-f2905da2aca8', 1, 'Delete', 'App\\Models\\Currency', 73, 'App\\Models\\Currency', 73, 'App\\Models\\Currency', 73, '', 'finished', '', '2021-01-18 19:57:48', '2021-01-18 19:57:48', NULL, NULL),
(221, '92852e69-8022-4df0-a9ab-8ffa9fbc47b3', 1, 'Delete', 'App\\Models\\Currency', 74, 'App\\Models\\Currency', 74, 'App\\Models\\Currency', 74, '', 'finished', '', '2021-01-18 19:57:49', '2021-01-18 19:57:49', NULL, NULL),
(222, '92852e6a-f017-48f6-be5c-5cd00ea02a89', 1, 'Delete', 'App\\Models\\Currency', 75, 'App\\Models\\Currency', 75, 'App\\Models\\Currency', 75, '', 'finished', '', '2021-01-18 19:57:50', '2021-01-18 19:57:50', NULL, NULL),
(223, '92852e6c-526e-44f6-ade5-a5349a338aa5', 1, 'Delete', 'App\\Models\\Currency', 76, 'App\\Models\\Currency', 76, 'App\\Models\\Currency', 76, '', 'finished', '', '2021-01-18 19:57:51', '2021-01-18 19:57:51', NULL, NULL),
(224, '92852e6d-b55c-43b5-b4fb-a30acad92a3a', 1, 'Delete', 'App\\Models\\Currency', 77, 'App\\Models\\Currency', 77, 'App\\Models\\Currency', 77, '', 'finished', '', '2021-01-18 19:57:52', '2021-01-18 19:57:52', NULL, NULL),
(225, '92852e6f-c925-408a-87ab-47b7af7a41fb', 1, 'Delete', 'App\\Models\\Currency', 78, 'App\\Models\\Currency', 78, 'App\\Models\\Currency', 78, '', 'finished', '', '2021-01-18 19:57:53', '2021-01-18 19:57:53', NULL, NULL),
(226, '92852e71-6ccb-4932-8f38-38ae28e8d3e7', 1, 'Delete', 'App\\Models\\Currency', 79, 'App\\Models\\Currency', 79, 'App\\Models\\Currency', 79, '', 'finished', '', '2021-01-18 19:57:54', '2021-01-18 19:57:54', NULL, NULL),
(227, '92852e72-e031-4787-b488-2829133fa7dc', 1, 'Delete', 'App\\Models\\Currency', 80, 'App\\Models\\Currency', 80, 'App\\Models\\Currency', 80, '', 'finished', '', '2021-01-18 19:57:55', '2021-01-18 19:57:55', NULL, NULL),
(228, '92852e74-89c9-423c-9deb-faa48d26dca0', 1, 'Delete', 'App\\Models\\Currency', 81, 'App\\Models\\Currency', 81, 'App\\Models\\Currency', 81, '', 'finished', '', '2021-01-18 19:57:56', '2021-01-18 19:57:56', NULL, NULL),
(229, '92852e76-107b-4dc0-80cf-15f2597b5125', 1, 'Delete', 'App\\Models\\Currency', 83, 'App\\Models\\Currency', 83, 'App\\Models\\Currency', 83, '', 'finished', '', '2021-01-18 19:57:57', '2021-01-18 19:57:57', NULL, NULL),
(230, '92852e77-70f2-4720-9bf7-b93b9704a4c1', 1, 'Delete', 'App\\Models\\Currency', 84, 'App\\Models\\Currency', 84, 'App\\Models\\Currency', 84, '', 'finished', '', '2021-01-18 19:57:58', '2021-01-18 19:57:58', NULL, NULL),
(231, '92852e78-f420-4a0f-8fa8-4d5a472d134f', 1, 'Delete', 'App\\Models\\Currency', 85, 'App\\Models\\Currency', 85, 'App\\Models\\Currency', 85, '', 'finished', '', '2021-01-18 19:57:59', '2021-01-18 19:57:59', NULL, NULL),
(232, '92852e7a-6d44-4feb-99b3-451d5a43e540', 1, 'Delete', 'App\\Models\\Currency', 86, 'App\\Models\\Currency', 86, 'App\\Models\\Currency', 86, '', 'finished', '', '2021-01-18 19:58:00', '2021-01-18 19:58:00', NULL, NULL),
(233, '92852e7b-c318-45c8-bd20-9d6cc1014985', 1, 'Delete', 'App\\Models\\Currency', 87, 'App\\Models\\Currency', 87, 'App\\Models\\Currency', 87, '', 'finished', '', '2021-01-18 19:58:01', '2021-01-18 19:58:01', NULL, NULL),
(234, '92852e7d-3355-4864-8f14-4b67d56fa924', 1, 'Delete', 'App\\Models\\Currency', 88, 'App\\Models\\Currency', 88, 'App\\Models\\Currency', 88, '', 'finished', '', '2021-01-18 19:58:02', '2021-01-18 19:58:02', NULL, NULL),
(235, '92852e7e-c424-46b0-a1bd-0942bc7f4d06', 1, 'Delete', 'App\\Models\\Currency', 89, 'App\\Models\\Currency', 89, 'App\\Models\\Currency', 89, '', 'finished', '', '2021-01-18 19:58:03', '2021-01-18 19:58:03', NULL, NULL),
(236, '92852e80-2d67-466b-9bcb-62dc99f4678b', 1, 'Delete', 'App\\Models\\Currency', 90, 'App\\Models\\Currency', 90, 'App\\Models\\Currency', 90, '', 'finished', '', '2021-01-18 19:58:04', '2021-01-18 19:58:04', NULL, NULL),
(237, '92852e81-e470-4943-8425-4b2473ed82d4', 1, 'Delete', 'App\\Models\\Currency', 91, 'App\\Models\\Currency', 91, 'App\\Models\\Currency', 91, '', 'finished', '', '2021-01-18 19:58:05', '2021-01-18 19:58:05', NULL, NULL),
(238, '92852e83-7826-445b-b0a4-15c448d70dbf', 1, 'Delete', 'App\\Models\\Currency', 92, 'App\\Models\\Currency', 92, 'App\\Models\\Currency', 92, '', 'finished', '', '2021-01-18 19:58:06', '2021-01-18 19:58:06', NULL, NULL),
(239, '92852e85-8834-41ee-a4f5-cf3143747708', 1, 'Delete', 'App\\Models\\Currency', 93, 'App\\Models\\Currency', 93, 'App\\Models\\Currency', 93, '', 'finished', '', '2021-01-18 19:58:08', '2021-01-18 19:58:08', NULL, NULL),
(240, '92852e87-4fc5-4503-bea9-a45d85eca362', 1, 'Delete', 'App\\Models\\Currency', 94, 'App\\Models\\Currency', 94, 'App\\Models\\Currency', 94, '', 'finished', '', '2021-01-18 19:58:09', '2021-01-18 19:58:09', NULL, NULL),
(241, '92852e89-21f9-413b-9283-ac1f206ce9e8', 1, 'Delete', 'App\\Models\\Currency', 95, 'App\\Models\\Currency', 95, 'App\\Models\\Currency', 95, '', 'finished', '', '2021-01-18 19:58:10', '2021-01-18 19:58:10', NULL, NULL),
(242, '92852e8b-6509-477d-aef9-8c440bcbe55c', 1, 'Delete', 'App\\Models\\Currency', 96, 'App\\Models\\Currency', 96, 'App\\Models\\Currency', 96, '', 'finished', '', '2021-01-18 19:58:11', '2021-01-18 19:58:11', NULL, NULL),
(243, '92852e8d-670e-4ce8-ac31-a068108a1f0a', 1, 'Delete', 'App\\Models\\Currency', 98, 'App\\Models\\Currency', 98, 'App\\Models\\Currency', 98, '', 'finished', '', '2021-01-18 19:58:13', '2021-01-18 19:58:13', NULL, NULL),
(244, '92852e8f-0c37-43ef-a31b-51fada6f68b9', 1, 'Delete', 'App\\Models\\Currency', 99, 'App\\Models\\Currency', 99, 'App\\Models\\Currency', 99, '', 'finished', '', '2021-01-18 19:58:14', '2021-01-18 19:58:14', NULL, NULL),
(245, '92852e90-c5d6-45e6-aed5-a5adc9ad10c5', 1, 'Delete', 'App\\Models\\Currency', 100, 'App\\Models\\Currency', 100, 'App\\Models\\Currency', 100, '', 'finished', '', '2021-01-18 19:58:15', '2021-01-18 19:58:15', NULL, NULL),
(246, '92852e92-5a2a-4071-8b27-a0bff9e172ea', 1, 'Delete', 'App\\Models\\Currency', 101, 'App\\Models\\Currency', 101, 'App\\Models\\Currency', 101, '', 'finished', '', '2021-01-18 19:58:16', '2021-01-18 19:58:16', NULL, NULL),
(247, '92852e93-e0c1-4b70-816d-6871114f090b', 1, 'Delete', 'App\\Models\\Currency', 102, 'App\\Models\\Currency', 102, 'App\\Models\\Currency', 102, '', 'finished', '', '2021-01-18 19:58:17', '2021-01-18 19:58:17', NULL, NULL),
(248, '92852e95-950c-48f5-9367-9195f9700730', 1, 'Delete', 'App\\Models\\Currency', 103, 'App\\Models\\Currency', 103, 'App\\Models\\Currency', 103, '', 'finished', '', '2021-01-18 19:58:18', '2021-01-18 19:58:18', NULL, NULL),
(249, '92852e97-3c14-489f-b990-311a288624c5', 1, 'Delete', 'App\\Models\\Currency', 104, 'App\\Models\\Currency', 104, 'App\\Models\\Currency', 104, '', 'finished', '', '2021-01-18 19:58:19', '2021-01-18 19:58:19', NULL, NULL),
(250, '92852ebb-2674-4130-b98d-25277755207a', 1, 'Delete', 'App\\Models\\Currency', 11, 'App\\Models\\Currency', 11, 'App\\Models\\Currency', 11, '', 'finished', '', '2021-01-18 19:58:43', '2021-01-18 19:58:43', NULL, NULL),
(251, '92852ebb-74cc-49a5-af7f-6d8371996422', 1, 'Delete', 'App\\Models\\Currency', 21, 'App\\Models\\Currency', 21, 'App\\Models\\Currency', 21, '', 'finished', '', '2021-01-18 19:58:43', '2021-01-18 19:58:43', NULL, NULL),
(252, '92852ebb-c9bd-4e03-b47c-ab3337f8330f', 1, 'Delete', 'App\\Models\\Currency', 29, 'App\\Models\\Currency', 29, 'App\\Models\\Currency', 29, '', 'finished', '', '2021-01-18 19:58:43', '2021-01-18 19:58:43', NULL, NULL),
(253, '92852ebc-1427-4368-aeda-ae5e54284039', 1, 'Delete', 'App\\Models\\Currency', 35, 'App\\Models\\Currency', 35, 'App\\Models\\Currency', 35, '', 'finished', '', '2021-01-18 19:58:43', '2021-01-18 19:58:43', NULL, NULL),
(254, '92852f3f-7795-481b-b9b8-930759720fb4', 1, 'Create', 'App\\Models\\Currency', 105, 'App\\Models\\Currency', 105, 'App\\Models\\Currency', 105, '', 'finished', '', '2021-01-18 20:00:09', '2021-01-18 20:00:09', NULL, '{\"name\":\"United Arab Emirates Dirham\",\"code\":\"AED\",\"symbol\":\"\\u062f.\\u0625\",\"active\":true,\"created_by\":1,\"sort\":4,\"updated_at\":\"2021-01-18T22:00:09.000000Z\",\"created_at\":\"2021-01-18T22:00:09.000000Z\",\"id\":105}'),
(255, '92853136-31ff-416b-a4c9-f8be2f3732fc', 1, 'Update', 'App\\Models\\Currency', 3, 'App\\Models\\Currency', 3, 'App\\Models\\Currency', 3, '', 'finished', '', '2021-01-18 20:05:39', '2021-01-18 20:05:39', '{\"active\":1}', '{\"active\":true}'),
(256, '92853163-073b-4ba8-8578-59cd10e7db82', 1, 'Update', 'App\\Models\\Currency', 4, 'App\\Models\\Currency', 4, 'App\\Models\\Currency', 4, '', 'finished', '', '2021-01-18 20:06:08', '2021-01-18 20:06:08', '{\"active\":1}', '{\"active\":true}'),
(257, '92853174-0842-450e-a1d8-816d2ea5cf43', 1, 'Update', 'App\\Models\\Currency', 2, 'App\\Models\\Currency', 2, 'App\\Models\\Currency', 2, '', 'finished', '', '2021-01-18 20:06:19', '2021-01-18 20:06:19', '{\"active\":1}', '{\"active\":true}'),
(258, '928532bc-2baf-4e38-9c20-47a296c2ce1a', 1, 'Update', 'App\\Models\\Currency', 1, 'App\\Models\\Currency', 1, 'App\\Models\\Currency', 1, '', 'finished', '', '2021-01-18 20:09:54', '2021-01-18 20:09:54', '{\"active\":1}', '{\"active\":true}'),
(259, '928533e0-ae6e-4b44-a36f-808baf101535', 1, 'Update', 'App\\Models\\Currency', 3, 'App\\Models\\Currency', 3, 'App\\Models\\Currency', 3, '', 'finished', '', '2021-01-18 20:13:06', '2021-01-18 20:13:06', '{\"rate\":\"1\",\"active\":1}', '{\"rate\":\"4.18677\",\"active\":true}'),
(260, '92853428-ab44-4d97-8ec0-f3c0335b2e88', 1, 'Update', 'App\\Models\\Currency', 3, 'App\\Models\\Currency', 3, 'App\\Models\\Currency', 3, '', 'finished', '', '2021-01-18 20:13:53', '2021-01-18 20:13:53', '{\"rate\":\"4.00000000\",\"active\":1}', '{\"rate\":\"4.18677\",\"active\":true}'),
(261, '92853492-afc9-464d-af93-e20755c5d98f', 1, 'Update', 'App\\Models\\Currency', 2, 'App\\Models\\Currency', 2, 'App\\Models\\Currency', 2, '', 'finished', '', '2021-01-18 20:15:03', '2021-01-18 20:15:03', '{\"rate\":\"1.000000\",\"active\":1}', '{\"rate\":\"0.266667\",\"active\":true}'),
(262, '928534ae-e828-4e27-95bb-b139fc819674', 1, 'Update', 'App\\Models\\Currency', 4, 'App\\Models\\Currency', 4, 'App\\Models\\Currency', 4, '', 'finished', '', '2021-01-18 20:15:21', '2021-01-18 20:15:21', '{\"rate\":\"1.000000\",\"active\":1}', '{\"rate\":\"0.220791\",\"active\":true}'),
(263, '928534c7-ba73-4cd8-89de-9153fae67228', 1, 'Update', 'App\\Models\\Currency', 5, 'App\\Models\\Currency', 5, 'App\\Models\\Currency', 5, '', 'finished', '', '2021-01-18 20:15:38', '2021-01-18 20:15:38', '{\"rate\":\"1.000000\",\"active\":1}', '{\"rate\":\"0.979333\",\"active\":true}'),
(264, '92853572-6df5-4816-a35d-7ad8677c26fc', 1, 'Delete', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 71, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 71, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 71, '', 'finished', '', '2021-01-18 20:17:29', '2021-01-18 20:17:29', NULL, NULL),
(265, '92853582-ad96-4db7-84b5-6a8928de1425', 1, 'Update', 'App\\Models\\Currency', 2, 'App\\Models\\Currency', 2, 'App\\Models\\Currency', 2, '', 'finished', '', '2021-01-18 20:17:40', '2021-01-18 20:17:40', '{\"active\":1}', '{\"active\":true}'),
(266, '92853589-f21f-425e-bd39-fe9bd664bd7c', 1, 'Delete', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 70, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 70, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 70, '', 'finished', '', '2021-01-18 20:17:45', '2021-01-18 20:17:45', NULL, NULL),
(267, '92853591-0bfa-4547-bb36-a5b245bf2b43', 1, 'Update', 'App\\Models\\Currency', 4, 'App\\Models\\Currency', 4, 'App\\Models\\Currency', 4, '', 'finished', '', '2021-01-18 20:17:50', '2021-01-18 20:17:50', '{\"active\":1}', '{\"active\":true}'),
(268, '9285359a-69e4-42a7-a6c8-3a4cc62d0f44', 1, 'Update', 'App\\Models\\Currency', 1, 'App\\Models\\Currency', 1, 'App\\Models\\Currency', 1, '', 'finished', '', '2021-01-18 20:17:56', '2021-01-18 20:17:56', '{\"active\":1}', '{\"active\":true}'),
(269, '928535a3-20df-4096-ab4b-58acce125af4', 1, 'Update', 'App\\Models\\Currency', 5, 'App\\Models\\Currency', 5, 'App\\Models\\Currency', 5, '', 'finished', '', '2021-01-18 20:18:01', '2021-01-18 20:18:01', '{\"active\":1}', '{\"active\":true}'),
(270, '928535aa-1c32-4a8b-9629-35843cebf7c1', 1, 'Delete', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 69, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 69, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 69, '', 'finished', '', '2021-01-18 20:18:06', '2021-01-18 20:18:06', NULL, NULL),
(271, '928535b1-a181-46f0-b3b7-218320731663', 1, 'Update', 'App\\Models\\Currency', 3, 'App\\Models\\Currency', 3, 'App\\Models\\Currency', 3, '', 'finished', '', '2021-01-18 20:18:11', '2021-01-18 20:18:11', '{\"active\":1}', '{\"active\":true}'),
(272, '92854293-f170-4dcb-88fe-bc2a1f72d004', 1, 'Create', 'App\\Models\\Page', 1, 'App\\Models\\Page', 1, 'App\\Models\\Page', 1, '', 'finished', '', '2021-01-18 20:54:12', '2021-01-18 20:54:12', NULL, '{\"title\":{\"en\":\"About Us\",\"ar\":\"\\u0639\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\"},\"short_desc\":{\"en\":\"About Us\",\"ar\":\"\\u0639\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\"},\"desc\":{\"en\":\"<p>About Us<\\/p>\",\"ar\":\"<p>\\u0639\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639<\\/p>\"},\"slug\":\"About-Us\",\"meta_title\":{\"ar\":null},\"meta_keywords\":{\"ar\":null},\"meta_desc\":{\"ar\":null},\"created_by\":1,\"sort\":1,\"updated_at\":\"2021-01-18T22:54:12.000000Z\",\"created_at\":\"2021-01-18T22:54:12.000000Z\",\"id\":1}'),
(273, '9285433a-1c8a-4866-98d7-cc47cd16a3db', 1, 'Update', 'App\\Models\\Page', 1, 'App\\Models\\Page', 1, 'App\\Models\\Page', 1, '', 'finished', '', '2021-01-18 20:56:01', '2021-01-18 20:56:01', '[]', '[]'),
(274, '928690c3-a4d2-4911-a5c5-54c0de72d330', 1, 'Update', 'App\\Models\\Order', 5, 'App\\Models\\Order', 5, 'App\\Models\\Order', 5, '', 'finished', '', '2021-01-19 12:28:40', '2021-01-19 12:28:40', '[]', '[]'),
(276, '92869452-08dc-4b50-a723-f1993b640a44', 1, 'Update', 'App\\Models\\Quote', 1, 'App\\Models\\Quote', 1, 'App\\Models\\Quote', 1, '', 'finished', '', '2021-01-19 12:38:36', '2021-01-19 12:38:36', '{\"estimated_price\":1}', '{\"estimated_price\":null}'),
(277, '9286b88f-8241-461c-bffc-de362d6781b5', 1, 'Update', 'App\\Models\\Quote', 1, 'App\\Models\\Quote', 1, 'App\\Models\\Quote', 1, '', 'finished', '', '2021-01-19 14:19:56', '2021-01-19 14:19:56', '{\"status\":\"pending\"}', '{\"status\":\"processing\"}'),
(278, '9286f9fc-9621-496a-9b5e-aaa8244c5351', 1, 'Update', 'App\\Models\\Category', 1, 'App\\Models\\Category', 1, 'App\\Models\\Category', 1, '', 'finished', '', '2021-01-19 17:22:53', '2021-01-19 17:22:53', '{\"meta_desc\":{\"en\":\"desc\",\"ar\":null}}', '{\"meta_desc\":\"{\\\"en\\\":\\\"desca\\\",\\\"ar\\\":null}\"}'),
(279, '928708c0-5c0e-475e-bb04-cb3569596e25', 1, 'Create', 'App\\Models\\SubCategory', 3, 'App\\Models\\SubCategory', 3, 'App\\Models\\SubCategory', 3, '', 'finished', '', '2021-01-19 18:04:10', '2021-01-19 18:04:10', NULL, '{\"category_id\":1,\"name\":{\"en\":\"SubCategory 1\",\"ar\":\"SubCategory 1\"},\"short_desc\":{\"en\":\"SubCategory 1\",\"ar\":\"SubCategory 1\"},\"desc\":{\"en\":\"<p>SubCategory 1<\\/p>\",\"ar\":\"<p>SubCategory 1<\\/p>\"},\"slug\":\"SubCategory 1\",\"meta_title\":{\"ar\":null},\"meta_keywords\":{\"ar\":null},\"meta_desc\":{\"ar\":null},\"created_by\":1,\"sort\":3,\"updated_at\":\"2021-01-19T20:04:10.000000Z\",\"created_at\":\"2021-01-19T20:04:10.000000Z\",\"id\":3}'),
(280, '92870909-7514-4519-96fa-44ccd7b1fba9', 1, 'Update', 'App\\Models\\SubCategory', 3, 'App\\Models\\SubCategory', 3, 'App\\Models\\SubCategory', 3, '', 'finished', '', '2021-01-19 18:04:58', '2021-01-19 18:04:58', '{\"slug\":\"SubCategory 1\"}', '{\"slug\":\"SubCategory 11\"}'),
(284, '928896c3-e49a-492a-a104-9a6bdd070704', 1, 'Delete', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 36, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 36, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 36, '', 'finished', '', '2021-01-20 12:37:06', '2021-01-20 12:37:06', NULL, NULL),
(285, '928896d5-06d9-4b92-9b67-7d7760942d9e', 1, 'Update', 'App\\Models\\Language', 2, 'App\\Models\\Language', 2, 'App\\Models\\Language', 2, '', 'finished', '', '2021-01-20 12:37:17', '2021-01-20 12:37:17', '[]', '[]'),
(286, '928897bf-400f-46bc-9b7f-ee368b787292', 1, 'Create', 'Spatie\\Permission\\Models\\Role', 2, 'Spatie\\Permission\\Models\\Role', 2, 'Spatie\\Permission\\Models\\Role', 2, '', 'finished', '', '2021-01-20 12:39:51', '2021-01-20 12:39:51', NULL, '{\"guard_name\":\"admin\",\"name\":\"DataEnty\",\"updated_at\":\"2021-01-20T14:39:50.000000Z\",\"created_at\":\"2021-01-20T14:39:50.000000Z\",\"id\":2}'),
(287, '9288ca82-2763-47d9-b535-dbd8de6982b8', 1, 'Update', 'App\\Models\\Quote', 1, 'App\\Models\\Quote', 1, 'App\\Models\\Quote', 1, '', 'finished', '', '2021-01-20 15:01:47', '2021-01-20 15:01:47', '{\"estimated_price\":null}', '{\"estimated_price\":\"1000\"}'),
(288, '9288d27b-e861-4269-a548-8bbb110ccef6', 1, 'Create', 'Spatie\\Permission\\Models\\Role', 3, 'Spatie\\Permission\\Models\\Role', 3, 'Spatie\\Permission\\Models\\Role', 3, '', 'finished', '', '2021-01-20 15:24:05', '2021-01-20 15:24:05', NULL, '{\"guard_name\":\"admin\",\"name\":\"SEO\",\"updated_at\":\"2021-01-20T17:24:05.000000Z\",\"created_at\":\"2021-01-20T17:24:05.000000Z\",\"id\":3}'),
(289, '9288d2e2-366a-4abe-99fd-9e1704ecd951', 1, 'Create', 'App\\Models\\Admin', 24, 'App\\Models\\Admin', 24, 'App\\Models\\Admin', 24, '', 'finished', '', '2021-01-20 15:25:12', '2021-01-20 15:25:12', NULL, '{\"name\":\"Sameh\",\"email\":\"sameh@gmail.com\",\"created_by\":1,\"updated_at\":\"2021-01-20T17:25:12.000000Z\",\"created_at\":\"2021-01-20T17:25:12.000000Z\",\"id\":24}'),
(290, '928a77d4-f79d-428d-bc59-54fc35b1e5cb', 1, 'Delete', 'App\\Models\\Order', 5, 'App\\Models\\Order', 5, 'App\\Models\\Order', 5, '', 'finished', '', '2021-01-21 11:02:15', '2021-01-21 11:02:15', NULL, NULL),
(291, '928a78fa-8da4-4b7f-bac0-287bce177e49', 1, 'Update', 'App\\Models\\Quote', 1, 'App\\Models\\Quote', 1, 'App\\Models\\Quote', 1, '', 'finished', '', '2021-01-21 11:05:28', '2021-01-21 11:05:28', '{\"estimated_price\":1000}', '{\"estimated_price\":\"2000\"}'),
(292, '928a8a08-2b7a-44ea-accd-a7d76b8e38fc', 1, 'Create', 'Spatie\\Permission\\Models\\Role', 4, 'Spatie\\Permission\\Models\\Role', 4, 'Spatie\\Permission\\Models\\Role', 4, '', 'finished', '', '2021-01-21 11:53:09', '2021-01-21 11:53:09', NULL, '{\"guard_name\":\"admin\",\"name\":\"Super Visor\",\"updated_at\":\"2021-01-21T13:53:09.000000Z\",\"created_at\":\"2021-01-21T13:53:09.000000Z\",\"id\":4}'),
(293, '92909e10-05bc-4963-b845-7c077ed217a4', 1, 'Update', 'App\\Models\\Currency', 3, 'App\\Models\\Currency', 3, 'App\\Models\\Currency', 3, '', 'finished', '', '2021-01-24 12:24:07', '2021-01-24 12:24:07', '{\"symbol\":\"\\u00a3\",\"active\":1}', '{\"symbol\":\"E\\u00a3\",\"active\":true}'),
(294, '92a296e7-4bfa-4511-9c67-9d56b333bec1', 1, 'Update', 'App\\Models\\Admin', 1, 'App\\Models\\Admin', 1, 'App\\Models\\Admin', 1, '', 'finished', '', '2021-02-02 10:49:01', '2021-02-02 10:49:01', '{\"name\":\"Mohamed\"}', '{\"name\":\"Super Admin\"}'),
(295, '92a6bf2c-ab16-457b-b3ca-ca458304dceb', 1, 'Update', 'App\\Models\\Category', 1, 'App\\Models\\Category', 1, 'App\\Models\\Category', 1, '', 'finished', '', '2021-02-04 12:24:56', '2021-02-04 12:24:56', '{\"name\":{\"en\":\"Category 1\",\"ar\":\"\\u0635\\u0646\\u0641 1\"},\"desc\":{\"en\":\"<p>category 1<\\/p>\",\"ar\":\"<p>\\u0635\\u0646\\u0641 1<\\/p>\"},\"short_desc\":{\"en\":\"Category 1\",\"ar\":\"\\u0635\\u0646\\u0641 1\"}}', '{\"name\":\"{\\\"en\\\":\\\"Building Material\\\",\\\"ar\\\":\\\"\\\\u0635\\\\u0646\\\\u0641 1\\\"}\",\"desc\":\"{\\\"en\\\":\\\"<pre>\\\\nBuilding Material<\\\\\\/pre>\\\",\\\"ar\\\":\\\"<p>\\\\u0635\\\\u0646\\\\u0641 1<\\\\\\/p>\\\"}\",\"short_desc\":\"{\\\"en\\\":\\\"Building Material\\\",\\\"ar\\\":\\\"\\\\u0635\\\\u0646\\\\u0641 1\\\"}\"}'),
(296, '92a6bf39-57d7-4f74-8cf5-141e26d92866', 1, 'Delete', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 2, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 2, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 2, '', 'finished', '', '2021-02-04 12:25:04', '2021-02-04 12:25:04', NULL, NULL),
(297, '92a6bf50-5cf2-4d16-95bc-370e57f35bc9', 1, 'Delete', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 88, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 88, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 88, '', 'finished', '', '2021-02-04 12:25:19', '2021-02-04 12:25:19', NULL, NULL),
(298, '92a6bff6-df2a-41fd-8ad7-49f4817efbfd', 1, 'Delete', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 89, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 89, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 89, '', 'finished', '', '2021-02-04 12:27:08', '2021-02-04 12:27:08', NULL, NULL),
(299, '92a6c568-0201-43ae-a425-c441fed82242', 1, 'Update', 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 90, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 90, 'Spatie\\MediaLibrary\\MediaCollections\\Models\\Media', 90, '', 'finished', '', '2021-02-04 12:42:21', '2021-02-04 12:42:21', '{\"img_title\":null,\"img_alt\":null}', '{\"img_title\":\"Building Material\",\"img_alt\":\"Building Material\"}');

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
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superAdmin@youmats.com', NULL, '$2y$10$e9ahnIL03i6tABLd2lryKOXK4S0mEQilXbK44tbs670BsE/QvBkKW', 'hamuA3nqAwd783Lk9XpB62z1reO8i9an7SeYIARFbNVkEfpxjC7GmF9QBrqU', NULL, 1, NULL, NULL, '2021-01-06 22:31:23', '2021-02-02 10:49:01'),
(2, 'Nour', 'nour@youmats.com', NULL, '$2y$10$GyuX6D3zjpx/9.a9n4ZxWOQs.f8QKj2CZRHzJ9U2RgJA9Ayyhh76C', NULL, 1, 1, NULL, NULL, '2021-01-08 21:39:53', '2021-01-09 18:49:45'),
(3, 'Basma', 'basma@youmats.com', NULL, '$2y$10$.l6Ud0iAB3lXTfXinflJ/eYF8e3OS7CCXx8zjTcfUYzDCbYq5FwrO', NULL, 1, 1, NULL, NULL, '2021-01-08 21:40:05', '2021-01-11 12:58:33'),
(24, 'Sameh', 'sameh@gmail.com', NULL, '$2y$10$CzISfXqLVsRWtfEZz/bDkOq7tlVQLfsnRHY6tk40youwWwsgDrikW', NULL, 1, NULL, NULL, NULL, '2021-01-20 15:25:12', '2021-01-20 15:25:12');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `desc`, `short_desc`, `slug`, `meta_title`, `meta_desc`, `meta_keywords`, `sort`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Building Material\",\"ar\":\"\\u0635\\u0646\\u0641 1\"}', '{\"en\":\"<pre>\\nBuilding Material<\\/pre>\",\"ar\":\"<p>\\u0635\\u0646\\u0641 1<\\/p>\"}', '{\"en\":\"Building Material\",\"ar\":\"\\u0635\\u0646\\u0641 1\"}', 'CATEGORY_1', '{\"ar\":null}', '{\"en\":\"desca\",\"ar\":null}', '{\"ar\":null}', 1, 1, 1, NULL, NULL, '2021-01-06 22:36:46', '2021-02-04 12:24:56'),
(2, '{\"en\":\"Oils\",\"ar\":\"\\u0632\\u064a\\u0648\\u062a\"}', '{\"en\":\"<p>Oils<\\/p>\",\"ar\":\"<p>\\u0632\\u064a\\u0648\\u062a<\\/p>\"}', '{\"en\":\"Oils\",\"ar\":null}', 'oils', '{\"ar\":null}', '{\"ar\":null}', '{\"ar\":null}', 2, 1, NULL, NULL, NULL, '2021-01-08 21:07:51', '2021-01-11 20:54:38');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `name`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, '{\"en\":\"Cairo\",\"ar\":\"\\u0627\\u0644\\u0642\\u0627\\u0647\\u0631\\u0629\"}', 1, NULL, NULL, NULL, '2021-01-17 11:08:43', '2021-01-17 11:08:43'),
(2, 2, '{\"en\":\"Giza\",\"ar\":\"\\u062c\\u064a\\u0632\\u0629\"}', 1, NULL, NULL, NULL, '2021-01-17 12:46:05', '2021-01-17 12:46:05');

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
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Mohamed Maher', 'mohamedmaher055@gmail.com', '01064323735', 'Test', 1, NULL, NULL, NULL, '2021-01-18 13:41:56', '2021-01-18 13:41:56'),
(2, 'Mohamed Maher Tany', 'mohamedmaher055@gmail.com', '01064323735', 'Test Tany', 1, 1, 1, NULL, '2021-01-18 13:42:23', '2021-01-18 13:44:59');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `sort` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `active`, `sort`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Saudi Arabia\",\"ar\":\"\\u0627\\u0644\\u0633\\u0639\\u0648\\u062f\\u064a\\u0629\"}', 1, 1, 1, NULL, NULL, NULL, '2021-01-17 10:59:19', '2021-01-17 10:59:19'),
(2, '{\"en\":\"Egypt\",\"ar\":\"\\u0645\\u0635\\u0631\"}', 0, 2, 1, NULL, NULL, NULL, '2021-01-17 10:59:41', '2021-01-17 10:59:41'),
(3, '{\"en\":\"Spain\",\"ar\":\"\\u0627\\u0633\\u0628\\u0627\\u0646\\u064a\\u0627\"}', 1, 3, 1, NULL, NULL, NULL, '2021-01-17 11:08:05', '2021-01-17 11:08:05');

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
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `symbol`, `rate`, `active`, `sort`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Saudi Riyal', 'SAR', '﷼', '1.000000', 1, 3, NULL, 1, NULL, NULL, NULL, '2021-01-18 20:17:56'),
(2, 'US Dollar', 'USD', '$', '0.266667', 1, 1, NULL, 1, NULL, NULL, NULL, '2021-01-18 20:17:40'),
(3, 'Egyptian Pound', 'EGP', 'E£', '4.186770', 1, 0, NULL, 1, NULL, NULL, NULL, '2021-01-24 12:24:07'),
(4, 'Euro', 'EUR', '€', '0.220791', 1, 2, NULL, 1, NULL, NULL, NULL, '2021-01-18 20:17:50'),
(5, 'United Arab Emirates Dirham', 'AED', 'د.إ', '0.979333', 1, 4, 1, 1, NULL, NULL, '2021-01-18 20:00:09', '2021-01-18 20:18:01');

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
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `sort`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Question 1\",\"ar\":\"\\u0633\\u0648\\u0627\\u0644 1\"}', '{\"en\":\"<p>Answer 1<\\/p>\",\"ar\":\"<p>\\u0627\\u062c\\u0627\\u0628\\u0629 1<\\/p>\"}', 1, 1, 1, NULL, NULL, '2021-01-06 22:57:01', '2021-01-08 21:20:03');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `slug`, `sort`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"English\",\"ar\":\"\\u0627\\u0644\\u0627\\u0646\\u062c\\u0644\\u064a\\u0632\\u064a\\u0629\"}', 'en', 2, 1, 1, NULL, NULL, '2021-01-08 21:33:20', '2021-01-11 20:54:47'),
(2, '{\"en\":\"Arabic\",\"ar\":\"\\u0627\\u0644\\u0639\\u0631\\u0628\\u064a\\u0629\"}', 'ar', 1, 1, 1, NULL, NULL, '2021-01-08 21:34:15', '2021-01-11 20:54:47');

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
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `img_title`, `img_alt`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(4, 'App\\Models\\SubCategory', 1, '5ddd37c1-4bd0-40e7-87e3-79f976a25e8c', 'subCategory', 'tour-1', 'tour-1.jpg', 'Sub Category 1', 'Sub Category 1', 'image/jpeg', 'public', 'public', 41503, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 2, '2021-01-06 22:51:16', '2021-01-06 22:53:08'),
(8, 'App\\Models\\Product', 1, 'c83e65b0-c9f6-4c51-84d2-41822965f963', 'product', 'dest-2', 'dest-2.jpg', NULL, NULL, 'image/jpeg', 'public', 'public', 43261, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 3, '2021-01-06 22:55:08', '2021-01-06 22:55:08'),
(9, 'App\\Models\\Product', 1, '7895981d-559c-4782-8f28-d1783c120177', 'product', 'dest-3', 'dest-3.jpg', NULL, 'sda', 'image/jpeg', 'public', 'public', 26863, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 4, '2021-01-06 22:55:08', '2021-01-06 22:55:42'),
(10, 'App\\Models\\Product', 1, '39f5f60b-13ac-4d53-839f-51be7e04f4f6', 'product', 'dest-4', 'dest-4.jpg', NULL, NULL, 'image/jpeg', 'public', 'public', 23546, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 5, '2021-01-06 22:55:09', '2021-01-06 22:55:10'),
(12, 'App\\Models\\Category', 2, 'c095bfde-9359-4f7f-bd9c-53267afca878', 'category', 'pro_10', 'pro_10.jpg', NULL, NULL, 'image/jpeg', 'public', 'public', 133313, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 6, '2021-01-08 21:07:52', '2021-01-08 21:07:53'),
(14, 'App\\Models\\SubCategory', 2, '791c8239-55dc-4348-aa7f-cccc2f138f04', 'subCategory', 'pro_7', 'pro_7.jpg', NULL, NULL, 'image/jpeg', 'public', 'public', 10899, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 7, '2021-01-08 21:09:20', '2021-01-08 21:09:21'),
(24, 'App\\Models\\Product', 2, 'f308a62d-0f8d-4a88-b4c5-741acb6da2e0', 'product', 'img6', 'img6.jpg', NULL, NULL, 'image/jpeg', 'public', 'public', 7295, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 8, '2021-01-08 21:13:10', '2021-01-08 21:13:11'),
(25, 'App\\Models\\Product', 2, '0466f53c-9bde-4b49-9153-0f964b99b54e', 'product', 'img10', 'img10.png', NULL, NULL, 'image/png', 'public', 'public', 58411, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 9, '2021-01-08 21:13:11', '2021-01-08 21:13:11'),
(26, 'App\\Models\\Product', 2, '7b362085-3654-425a-8acc-7890ac6764ba', 'product', 'kisspng-air-conditioners-electrical-air-conditioning-unit-5beaba3415e638.2605433915421097480897', 'kisspng-air-conditioners-electrical-air-conditioning-unit-5beaba3415e638.2605433915421097480897.png', NULL, NULL, 'image/png', 'public', 'public', 132773, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 10, '2021-01-08 21:13:11', '2021-01-08 21:13:12'),
(27, 'App\\Models\\Product', 2, 'b5689b26-0324-4143-9daa-e6ca36e0babe', 'product', 'kisspng-air-conditioners-british-thermal-unit-air-conditio-5be1664b91c5e0.8221409015414984435971', 'kisspng-air-conditioners-british-thermal-unit-air-conditio-5be1664b91c5e0.8221409015414984435971.png', NULL, NULL, 'image/png', 'public', 'public', 356254, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 11, '2021-01-08 21:13:12', '2021-01-08 21:13:13'),
(28, 'App\\Models\\Product', 2, '4f7f028a-6f83-41c2-9722-8813db28f7f3', 'product', 'kisspng-bollard-car-park-boom-barrier-parking-5addb03f5983d6.1681267215244780153667', 'kisspng-bollard-car-park-boom-barrier-parking-5addb03f5983d6.1681267215244780153667.png', NULL, NULL, 'image/png', 'public', 'public', 463595, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 12, '2021-01-08 21:13:13', '2021-01-08 21:13:13'),
(29, 'App\\Models\\Product', 2, '3dbc62c9-4b89-444a-9fd8-d0798fba79be', 'product', 'kisspng-cement-building-materials-bulk-cargo-concrete-pric-5afa96b68e6553.3268157515263720225833', 'kisspng-cement-building-materials-bulk-cargo-concrete-pric-5afa96b68e6553.3268157515263720225833.png', NULL, NULL, 'image/png', 'public', 'public', 442321, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 13, '2021-01-08 21:13:13', '2021-01-08 21:13:14'),
(30, 'App\\Models\\Product', 2, '1cad7dc7-ec07-489d-898b-371dcefa83c9', 'product', 'kisspng-concrete-masonry-unit-architectural-engineering-br-concrete-5ac6a0bc9bc2a6.464077561522966716638', 'kisspng-concrete-masonry-unit-architectural-engineering-br-concrete-5ac6a0bc9bc2a6.464077561522966716638.png', NULL, NULL, 'image/png', 'public', 'public', 532356, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 14, '2021-01-08 21:13:14', '2021-01-08 21:13:15'),
(31, 'App\\Models\\Product', 2, 'd48018c4-0959-4496-bd9e-165aaa834b90', 'product', 'kisspng-concrete-masonry-unit-autoclaved-aerated-concrete-cement-5acc11f534f723.289607961523323381217', 'kisspng-concrete-masonry-unit-autoclaved-aerated-concrete-cement-5acc11f534f723.289607961523323381217.png', NULL, NULL, 'image/png', 'public', 'public', 516205, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 15, '2021-01-08 21:13:15', '2021-01-08 21:13:15'),
(32, 'App\\Models\\Product', 2, 'eb4b5e91-cf52-4562-afbc-a57a63dbfc30', 'product', 'kisspng-barbed-wire-barbed-tape-steel-chain-link-fencing-barbed-wire-5b0f29a1e04777.0791591815277203539187', 'kisspng-barbed-wire-barbed-tape-steel-chain-link-fencing-barbed-wire-5b0f29a1e04777.0791591815277203539187.png', NULL, NULL, 'image/png', 'public', 'public', 759629, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 16, '2021-01-08 21:13:15', '2021-01-08 21:13:16'),
(34, 'App\\Models\\Language', 1, '3017d43e-c515-472c-b3e6-5dc15045a9a4', 'language', 'en', 'en.png', NULL, NULL, 'image/png', 'public', 'public', 15946, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 17, '2021-01-08 21:33:20', '2021-01-08 21:33:21'),
(45, 'DmitryBubyakin\\NovaMedialibraryField\\TransientModel', 1, 'c2a277ff-29bd-426e-a68c-b259258bc192', '64cedadf-593e-4d2d-81ab-07148ae645ad', 'payment-1', 'payment-1.png', NULL, NULL, 'image/png', 'public', 'public', 5627, '[]', '{\"__target_props__\":{\"target\":\"App\\\\Models\\\\User\",\"collectionName\":\"company\"}}', '[]', '[]', 23, '2021-01-13 11:48:39', '2021-01-13 11:48:39'),
(46, 'DmitryBubyakin\\NovaMedialibraryField\\TransientModel', 1, '3c7ece94-b371-4356-9ca2-f9c1aea2b0a0', '64cedadf-593e-4d2d-81ab-07148ae645ad', 'payment-2', 'payment-2.png', NULL, NULL, 'image/png', 'public', 'public', 7130, '[]', '{\"__target_props__\":{\"target\":\"App\\\\Models\\\\User\",\"collectionName\":\"company\"}}', '[]', '[]', 24, '2021-01-13 11:48:39', '2021-01-13 11:48:39'),
(47, 'DmitryBubyakin\\NovaMedialibraryField\\TransientModel', 1, '892808c2-ec92-490c-9699-e61ea87e7fea', '64cedadf-593e-4d2d-81ab-07148ae645ad', 'payment-3', 'payment-3.png', NULL, NULL, 'image/png', 'public', 'public', 6219, '[]', '{\"__target_props__\":{\"target\":\"App\\\\Models\\\\User\",\"collectionName\":\"company\"}}', '[]', '[]', 25, '2021-01-13 11:48:40', '2021-01-13 11:48:40'),
(48, 'DmitryBubyakin\\NovaMedialibraryField\\TransientModel', 1, '1f17d604-1cee-40e9-b441-3dde69bf2cad', '64cedadf-593e-4d2d-81ab-07148ae645ad', 'payment-4', 'payment-4.png', NULL, NULL, 'image/png', 'public', 'public', 5953, '[]', '{\"__target_props__\":{\"target\":\"App\\\\Models\\\\User\",\"collectionName\":\"company\"}}', '[]', '[]', 26, '2021-01-13 11:48:40', '2021-01-13 11:48:40'),
(49, 'DmitryBubyakin\\NovaMedialibraryField\\TransientModel', 1, '4ae0629d-7350-41d4-907f-27659f8e0b31', 'e37c6922-ef84-4a8e-921f-c6ddab95402f', 'payment-2', 'payment-2.png', NULL, NULL, 'image/png', 'public', 'public', 7130, '[]', '{\"__target_props__\":{\"target\":\"App\\\\Models\\\\User\",\"collectionName\":\"company\"}}', '[]', '[]', 27, '2021-01-13 11:59:38', '2021-01-13 11:59:38'),
(50, 'App\\Models\\User', 4, '23d55125-19c8-4597-a81c-cddabe1683e6', 'company', 'payment-2', 'payment-2.png', NULL, NULL, 'image/png', 'public', 'public', 7130, '[]', '[]', '[]', '[]', 28, '2021-01-13 12:08:09', '2021-01-13 12:08:09'),
(51, 'App\\Models\\User', 4, 'ddf4e38f-fbac-4dad-9cb4-0b0d9e3e2757', 'company', 'payment-1', 'payment-1.png', NULL, NULL, 'image/png', 'public', 'public', 5627, '[]', '[]', '[]', '[]', 29, '2021-01-13 12:08:09', '2021-01-13 12:08:09'),
(52, 'DmitryBubyakin\\NovaMedialibraryField\\TransientModel', 1, '6bdbaf81-6b8a-4e86-a148-06da5a1bda25', 'a92ace8e-759a-404c-bf52-f430e8771cc3', 'payment-1', 'payment-1.png', NULL, NULL, 'image/png', 'public', 'public', 5627, '[]', '{\"__target_props__\":{\"target\":\"App\\\\Models\\\\Vendor\",\"collectionName\":\"vendor\"}}', '[]', '[]', 30, '2021-01-13 12:12:55', '2021-01-13 12:12:55'),
(53, 'App\\Models\\Vendor', 1, '69540285-8079-443f-b683-7eaa32a0b9f1', 'vendor', 'payment-1', 'payment-1.png', NULL, NULL, 'image/png', 'public', 'public', 5627, '[]', '[]', '[]', '[]', 31, '2021-01-13 12:13:20', '2021-01-13 12:13:20'),
(54, 'App\\Models\\Vendor', 1, 'd91398df-d443-4679-8f13-5881cbccc9b2', 'vendor', 'payment-2', 'payment-2.png', NULL, NULL, 'image/png', 'public', 'public', 7130, '[]', '[]', '[]', '[]', 32, '2021-01-13 12:13:20', '2021-01-13 12:13:20'),
(55, 'App\\Models\\Vendor', 1, '8a3188b4-fa49-457d-8606-1f00436a5d30', 'vendor', 'payment-3', 'payment-3.png', NULL, NULL, 'image/png', 'public', 'public', 6219, '[]', '[]', '[]', '[]', 33, '2021-01-13 12:13:20', '2021-01-13 12:13:20'),
(56, 'App\\Models\\Vendor', 1, 'ac7b4ce5-4abe-48be-883c-c225c9323c2c', 'vendor', 'payment-4', 'payment-4.png', NULL, NULL, 'image/png', 'public', 'public', 5953, '[]', '[]', '[]', '[]', 34, '2021-01-13 12:13:21', '2021-01-13 12:13:21'),
(57, 'App\\Models\\User', 2, 'f414c6fe-090f-450f-8ecd-3ca8454bb04c', 'company', 'payment-1', 'payment-1.png', NULL, NULL, 'image/png', 'public', 'public', 5627, '[]', '[]', '[]', '[]', 35, '2021-01-13 12:35:55', '2021-01-13 12:35:55'),
(58, 'App\\Models\\User', 2, 'd7f148b4-9115-47ed-9570-1787fbf4e8af', 'company', 'payment-2', 'payment-2.png', NULL, NULL, 'image/png', 'public', 'public', 7130, '[]', '[]', '[]', '[]', 36, '2021-01-13 12:35:56', '2021-01-13 12:35:56'),
(59, 'App\\Models\\User', 2, '8790b4dd-8bba-4922-a012-e17b9abe6d06', 'company', 'payment-3', 'payment-3.png', NULL, NULL, 'image/png', 'public', 'public', 6219, '[]', '[]', '[]', '[]', 37, '2021-01-13 12:35:56', '2021-01-13 12:35:56'),
(60, 'App\\Models\\User', 2, '541b98f7-b250-4a5a-8366-ecd006c69aff', 'company', 'payment-4', 'payment-4.png', NULL, NULL, 'image/png', 'public', 'public', 5953, '[]', '[]', '[]', '[]', 38, '2021-01-13 12:35:56', '2021-01-13 12:35:56'),
(62, 'App\\Models\\User', 5, '1192e0a6-f992-4a7e-8a0f-739f8bb80c01', 'company', 'payment-1', 'payment-1.png', NULL, NULL, 'image/png', 'public', 'public', 5627, '[]', '[]', '[]', '[]', 39, '2021-01-13 12:36:55', '2021-01-13 12:36:55'),
(64, 'App\\Models\\Product', 3, '83e14015-1840-4f63-93ce-25a11ab7138d', 'product', 'cat_1', 'cat_1.png', NULL, NULL, 'image/png', 'public', 'public', 661755, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 40, '2021-01-16 14:56:59', '2021-01-16 14:57:00'),
(67, 'App\\Models\\Vendor', 1, '1880a87c-eff6-46e5-952f-a97d66d85d99', 'vendor', 'menu_8', 'menu_8.png', NULL, NULL, 'image/png', 'public', 'public', 130158, '[]', '[]', '[]', '[]', 41, '2021-01-17 12:51:02', '2021-01-17 12:51:02'),
(68, 'App\\Models\\Vendor', 1, '9a3dcca9-0681-4cf9-9f44-45de454488da', 'vendor', 'menu_7', 'menu_7.png', NULL, NULL, 'image/png', 'public', 'public', 457256, '[]', '[]', '[]', '[]', 42, '2021-01-17 12:51:02', '2021-01-17 12:51:02'),
(72, 'App\\Models\\Currency', 2, '98d4fc8f-1bd7-4899-8a3a-e5886f15d4f8', 'currency', 'usd.static.fe6255371a9e6537722f42f790d1cfe7', 'usd.static.fe6255371a9e6537722f42f790d1cfe7.svg', NULL, NULL, 'image/svg', 'public', 'public', 11413, '[]', '[]', '[]', '[]', 45, '2021-01-18 20:17:39', '2021-01-18 20:17:39'),
(73, 'App\\Models\\Currency', 4, '8aff5d8b-2074-42d3-8e3d-9b4f23d011bd', 'currency', 'eur.static.6628f0f9275f944c6bedc570cee14c96', 'eur.static.6628f0f9275f944c6bedc570cee14c96.svg', NULL, NULL, 'image/svg', 'public', 'public', 1874, '[]', '[]', '[]', '[]', 46, '2021-01-18 20:17:48', '2021-01-18 20:17:48'),
(74, 'App\\Models\\Currency', 1, '2ae75bde-7b42-496d-b36f-32a47c097de6', 'currency', 'sar.static.ca2bdde73cfc147408c3aa64123f4e96', 'sar.static.ca2bdde73cfc147408c3aa64123f4e96.svg', NULL, NULL, 'image/svg', 'public', 'public', 15639, '[]', '[]', '[]', '[]', 47, '2021-01-18 20:17:54', '2021-01-18 20:17:54'),
(75, 'App\\Models\\Currency', 5, '9b7ea92f-2915-4d9d-b6c2-227468dcc3df', 'currency', 'aed.static.21d9506d196783ca7aa14b14960886c3', 'aed.static.21d9506d196783ca7aa14b14960886c3.svg', NULL, NULL, 'image/svg', 'public', 'public', 790, '[]', '[]', '[]', '[]', 48, '2021-01-18 20:18:00', '2021-01-18 20:18:00'),
(76, 'App\\Models\\Currency', 3, '70a737d4-044e-46f3-959c-e0ab759b0a25', 'currency', 'egp.static.817afc87601bca7854ebd7c6930df67b', 'egp.static.817afc87601bca7854ebd7c6930df67b.svg', NULL, NULL, 'image/svg', 'public', 'public', 21428, '[]', '[]', '[]', '[]', 49, '2021-01-18 20:18:09', '2021-01-18 20:18:09'),
(77, 'App\\Models\\Page', 1, 'c96a747f-a68e-4b5c-b4e9-076aed7da35a', 'page', 'glass_4', 'glass_4.jpg', NULL, NULL, 'image/jpeg', 'public', 'public', 40146, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 50, '2021-01-18 20:55:59', '2021-01-18 20:55:59'),
(79, 'App\\Models\\SubCategory', 3, 'e40cf38e-18fe-4f98-9789-b86f30fe7cd5', 'subCategory', 'cat_home_2', 'cat_home_2.png', NULL, NULL, 'image/png', 'public', 'public', 341058, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 51, '2021-01-19 18:04:10', '2021-01-19 18:04:11'),
(80, 'App\\Models\\Language', 2, '392efe70-9bb4-4fa2-901a-492d45dc3e4f', 'language', 'egp.static.817afc87601bca7854ebd7c6930df67b', 'egp.static.817afc87601bca7854ebd7c6930df67b.svg', NULL, NULL, 'image/svg', 'public', 'public', 21428, '[]', '[]', '[]', '[]', 52, '2021-01-20 12:37:15', '2021-01-20 12:37:15'),
(81, 'App\\Models\\Product', 2, 'b688f31f-1b95-4bcd-898a-3da0f2e9b354', 'product', '2', '2.png', NULL, NULL, 'image/png', 'public', 'public', 108250, '[]', '[]', '[]', '[]', 53, '2021-01-21 11:18:17', '2021-01-21 11:18:17'),
(82, 'App\\Models\\Product', 2, 'd45ef6e0-66d0-4c40-88c3-4aea033d257b', 'product', '1', '1.png', NULL, NULL, 'image/png', 'public', 'public', 111326, '[]', '[]', '[]', '[]', 54, '2021-01-21 11:18:18', '2021-01-21 11:18:18'),
(83, 'App\\Models\\Product', 2, '655f0854-ac88-4f03-b92d-fb6dd66a40cc', 'product', '1', '1.png', NULL, NULL, 'image/png', 'public', 'public', 111326, '[]', '[]', '[]', '[]', 55, '2021-01-21 11:18:33', '2021-01-21 11:18:33'),
(84, 'App\\Models\\Product', 2, 'e957b207-516f-4103-a533-b67675b47146', 'product', '2', '2.png', NULL, NULL, 'image/png', 'public', 'public', 108250, '[]', '[]', '[]', '[]', 56, '2021-01-21 11:18:34', '2021-01-21 11:18:34'),
(85, 'DmitryBubyakin\\NovaMedialibraryField\\TransientModel', 1, 'dab5b10c-0d17-43b1-8d90-fc9f761310ee', '53d84028-cfd6-41ea-ae26-c4df64a5fe3e', 'eBQhVOinF9Isp3rXVAHekhDVnT89cVbxcaRPawKA', 'eBQhVOinF9Isp3rXVAHekhDVnT89cVbxcaRPawKA.png', NULL, NULL, 'image/png', 'public', 'public', 9103, '[]', '{\"__target_props__\":{\"target\":\"App\\\\Models\\\\Product\",\"collectionName\":\"product\"}}', '{\"thumb\":true,\"cropper\":true}', '[]', 57, '2021-02-01 10:42:10', '2021-02-01 10:42:12'),
(86, 'DmitryBubyakin\\NovaMedialibraryField\\TransientModel', 1, 'a12a6f46-0965-4a45-aef0-383d95bbfee8', '53d84028-cfd6-41ea-ae26-c4df64a5fe3e', 'ar', 'ar.png', NULL, NULL, 'image/png', 'public', 'public', 9103, '[]', '{\"__target_props__\":{\"target\":\"App\\\\Models\\\\Product\",\"collectionName\":\"product\"}}', '{\"thumb\":true,\"cropper\":true}', '[]', 58, '2021-02-01 10:42:13', '2021-02-01 10:42:13'),
(87, 'DmitryBubyakin\\NovaMedialibraryField\\TransientModel', 1, 'd1497204-bf86-4612-b25d-2c35dd38b8f3', '53d84028-cfd6-41ea-ae26-c4df64a5fe3e', 'banner', 'banner.jpg', NULL, NULL, 'image/jpeg', 'public', 'public', 140203, '[]', '{\"__target_props__\":{\"target\":\"App\\\\Models\\\\Product\",\"collectionName\":\"product\"}}', '{\"thumb\":true,\"cropper\":true}', '[]', 59, '2021-02-01 10:42:15', '2021-02-01 10:42:16'),
(90, 'App\\Models\\Category', 1, '641ed17d-5159-495e-a619-c4e34eb19c7c', 'category', 'cat_1', 'cat_1.png', 'Building Material', 'Building Material', 'image/png', 'public', 'public', 661755, '[]', '[]', '{\"thumb\":true,\"cropper\":true}', '[]', 60, '2021-02-04 12:27:12', '2021-02-04 12:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `days` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_limit` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`id`, `name`, `price`, `days`, `product_limit`, `sort`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Free\",\"ar\":\"\\u0645\\u062c\\u0627\\u0646\\u0649\"}', 0, 'Lifetime', 5, 1, 1, 1, NULL, NULL, '2021-01-16 19:37:03', '2021-01-16 19:42:58'),
(2, '{\"en\":\"Silver\",\"ar\":\"\\u0641\\u0636\\u0649\"}', 150, '100', 20, 2, 1, 1, NULL, NULL, '2021-01-16 19:38:33', '2021-01-16 19:42:58'),
(3, '{\"en\":\"Gold\",\"ar\":\"\\u0630\\u0647\\u0628\\u0649\"}', 500, '100', 100, 3, 1, 1, NULL, NULL, '2021-01-16 19:38:49', '2021-01-16 19:42:53');

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
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2018_01_01_000000_create_action_events_table', 1),
(6, '2019_05_10_000000_add_fields_to_action_events_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_12_30_155516_create_faqs_table', 1),
(10, '2020_12_30_173130_create_categories_table', 1),
(11, '2020_12_30_173708_create_sub_categories_table', 1),
(12, '2021_01_05_140752_create_products_table', 1),
(13, '2021_01_06_130036_create_media_table', 1),
(16, '2021_01_11_142658_create_permission_tables', 2),
(18, '2014_10_12_000000_create_users_table', 3),
(20, '2021_01_13_152145_create_orders_table', 5),
(21, '2021_01_13_154951_create_order_items_table', 5),
(22, '2020_12_16_192147_create_memberships_table', 6),
(23, '2020_12_16_192405_create_countries_table', 6),
(24, '2020_12_16_192414_create_cities_table', 6),
(25, '2020_12_30_155247_create_vendors_table', 6),
(26, '2021_01_16_192356_create_tags_table', 6),
(27, '2021_01_17_172730_create_product_tags_table', 7),
(28, '2021_01_18_151641_create_subscribers_table', 8),
(30, '2021_01_18_153215_create_contacts_table', 9),
(31, '2021_01_18_155024_create_currencies_table', 10),
(32, '2021_01_18_224614_create_pages_table', 11),
(33, '2021_01_19_125707_create_quotes_table', 12),
(34, '2021_01_19_134340_create_quote_items_table', 13),
(35, '2021_01_19_200040_create_activity_log_table', 14),
(36, '2021_01_20_133136_create_contents_table', 15);

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
(1, 'App\\Models\\Admin', 1),
(3, 'App\\Models\\Admin', 24);

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

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('f7f6df78-a91f-43bd-89ef-242c9cb099c5', 'App\\Notifications\\Notification', 'App\\Models\\Admin', 1, '{\"level\":\"info\",\"message\":\"Test Notifications.\",\"url\":\"https:\\/\\/coreproc.com\",\"target\":\"_self\"}', '2021-01-21 15:42:30', '2021-01-21 15:36:38', '2021-01-21 15:42:30');

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
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `name`, `email`, `phone`, `phone2`, `address`, `building_number`, `street`, `district`, `city`, `payment_method`, `reference_number`, `card_number`, `card_type`, `card_name`, `card_exp_date`, `transaction_date`, `payment_status`, `order_status`, `notes`, `refused_notes`, `total_price`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ORD-5FFF610CC557E', 1, 'Mohamed Maher', 'user@youmats.com', '01064323735', NULL, 'Maadi', '4006', 'المقاولون العرب', 'المعراج', 'القاهرة', 'cash', NULL, NULL, NULL, NULL, NULL, NULL, 'completed', 'refused', NULL, NULL, 340.9, 1, 1, NULL, NULL, '2021-01-13 18:58:51', '2021-01-14 16:59:25'),
(2, 'ORD-5FFF610CC554F', 6, 'Nour Tarek', 'nour@gmail.com', '01064323735', NULL, 'ddd', NULL, NULL, NULL, NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', NULL, NULL, 520.65, NULL, NULL, NULL, NULL, '2021-01-13 22:03:00', NULL),
(3, 'ORD-5FFF610CC554C', 6, 'Nour Tarek', 'nour@gmail.com', '01064323735', NULL, 'ddd', NULL, NULL, NULL, NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', NULL, NULL, 20.65, NULL, NULL, NULL, NULL, '2021-01-13 22:03:47', NULL),
(4, 'ORD-5FFF610C6667E', 6, 'Nashwa', 'nashwa@gmail.com', '01064323735', NULL, 'dasda', NULL, NULL, NULL, NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, 'completed', 'completed', NULL, NULL, 524.65, NULL, NULL, NULL, NULL, '2021-01-13 22:03:49', NULL),
(5, 'ORD-5FFF610C2167E', 6, 'Nashwa', 'nashwa@gmail.com', '01064323735', NULL, 'dasda', NULL, NULL, NULL, NULL, 'cash', NULL, NULL, NULL, NULL, NULL, NULL, 'refunded', 'shipping', NULL, NULL, 5, NULL, 1, 1, '2021-01-21 11:02:15', '2021-01-13 22:03:51', '2021-01-21 11:02:15');

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

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `SKU`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'FW511948213', 2, 2.45, NULL, NULL),
(3, 1, 2, 'FW511948218', 3, 10, NULL, NULL),
(4, 2, 1, 'FW511948213', 2, 2.45, NULL, NULL),
(5, 3, 2, 'FW511948218', 3, 10, NULL, NULL),
(6, 4, 1, 'FW511948213', 2, 2.45, NULL, NULL),
(7, 5, 2, 'FW511948218', 3, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `desc`, `short_desc`, `slug`, `meta_title`, `meta_desc`, `meta_keywords`, `sort`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"About Us\",\"ar\":\"\\u0639\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\"}', '{\"en\":\"<p>About Us<\\/p>\",\"ar\":\"<p>\\u0639\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639<\\/p>\"}', '{\"en\":\"About Us\",\"ar\":\"\\u0639\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\"}', 'About-Us', '{\"ar\":null}', '{\"ar\":null}', '{\"ar\":null}', 1, 1, 1, NULL, NULL, '2021-01-18 20:54:12', '2021-01-18 20:56:01');

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
(1, 'viewAny users', 'admin', '2021-01-20 12:12:29', '2021-01-20 12:12:29'),
(2, 'view users', 'admin', '2021-01-20 12:12:29', '2021-01-20 12:12:29'),
(3, 'create users', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(4, 'update users', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(5, 'delete users', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(6, 'restore users', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(7, 'forceDelete users', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(8, 'viewAny vendors', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(9, 'view vendors', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(10, 'create vendors', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(11, 'update vendors', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(12, 'delete vendors', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(13, 'restore vendors', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(14, 'forceDelete vendors', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(15, 'viewAny categories', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(16, 'view categories', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(17, 'create categories', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(18, 'update categories', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(19, 'delete categories', 'admin', '2021-01-20 12:12:30', '2021-01-20 12:12:30'),
(20, 'restore categories', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(21, 'forceDelete categories', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(22, 'viewAny subCategories', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(23, 'view subCategories', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(24, 'create subCategories', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(25, 'update subCategories', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(26, 'delete subCategories', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(27, 'restore subCategories', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(28, 'forceDelete subCategories', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(29, 'viewAny products', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(30, 'view products', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(31, 'create products', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(32, 'update products', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(33, 'delete products', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(34, 'restore products', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(35, 'forceDelete products', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(36, 'viewAny languages', 'admin', '2021-01-20 12:12:31', '2021-01-20 12:12:31'),
(37, 'view languages', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(38, 'create languages', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(39, 'update languages', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(40, 'delete languages', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(41, 'restore languages', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(42, 'forceDelete languages', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(43, 'viewAny faqs', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(44, 'view faqs', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(45, 'create faqs', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(46, 'update faqs', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(47, 'delete faqs', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(48, 'restore faqs', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(49, 'forceDelete faqs', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(50, 'viewAny orders', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(51, 'view orders', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(52, 'create orders', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(53, 'update orders', 'admin', '2021-01-20 12:12:32', '2021-01-20 12:12:32'),
(54, 'delete orders', 'admin', '2021-01-20 12:12:33', '2021-01-20 12:12:33'),
(55, 'restore orders', 'admin', '2021-01-20 12:12:33', '2021-01-20 12:12:33'),
(56, 'forceDelete orders', 'admin', '2021-01-20 12:12:33', '2021-01-20 12:12:33'),
(57, 'viewAny quotes', 'admin', '2021-01-20 12:12:33', '2021-01-20 12:12:33'),
(58, 'view quotes', 'admin', '2021-01-20 12:12:33', '2021-01-20 12:12:33'),
(59, 'create quotes', 'admin', '2021-01-20 12:12:33', '2021-01-20 12:12:33'),
(60, 'update quotes', 'admin', '2021-01-20 12:12:33', '2021-01-20 12:12:33'),
(61, 'delete quotes', 'admin', '2021-01-20 12:12:33', '2021-01-20 12:12:33'),
(62, 'restore quotes', 'admin', '2021-01-20 12:12:33', '2021-01-20 12:12:33'),
(63, 'forceDelete quotes', 'admin', '2021-01-20 12:12:33', '2021-01-20 12:12:33'),
(64, 'viewAny countries', 'admin', '2021-01-20 12:12:33', '2021-01-20 12:12:33'),
(65, 'view countries', 'admin', '2021-01-20 12:12:33', '2021-01-20 12:12:33'),
(66, 'create countries', 'admin', '2021-01-20 12:12:33', '2021-01-20 12:12:33'),
(67, 'update countries', 'admin', '2021-01-20 12:12:33', '2021-01-20 12:12:33'),
(68, 'delete countries', 'admin', '2021-01-20 12:12:33', '2021-01-20 12:12:33'),
(69, 'restore countries', 'admin', '2021-01-20 12:12:34', '2021-01-20 12:12:34'),
(70, 'forceDelete countries', 'admin', '2021-01-20 12:12:34', '2021-01-20 12:12:34'),
(71, 'viewAny cities', 'admin', '2021-01-20 12:12:34', '2021-01-20 12:12:34'),
(72, 'view cities', 'admin', '2021-01-20 12:12:34', '2021-01-20 12:12:34'),
(73, 'create cities', 'admin', '2021-01-20 12:12:34', '2021-01-20 12:12:34'),
(74, 'update cities', 'admin', '2021-01-20 12:12:34', '2021-01-20 12:12:34'),
(75, 'delete cities', 'admin', '2021-01-20 12:12:34', '2021-01-20 12:12:34'),
(76, 'restore cities', 'admin', '2021-01-20 12:12:34', '2021-01-20 12:12:34'),
(77, 'forceDelete cities', 'admin', '2021-01-20 12:12:34', '2021-01-20 12:12:34'),
(78, 'viewAny contacts', 'admin', '2021-01-20 12:12:34', '2021-01-20 12:12:34'),
(79, 'view contacts', 'admin', '2021-01-20 12:12:34', '2021-01-20 12:12:34'),
(80, 'create contacts', 'admin', '2021-01-20 12:12:34', '2021-01-20 12:12:34'),
(81, 'update contacts', 'admin', '2021-01-20 12:12:34', '2021-01-20 12:12:34'),
(82, 'delete contacts', 'admin', '2021-01-20 12:12:34', '2021-01-20 12:12:34'),
(83, 'restore contacts', 'admin', '2021-01-20 12:12:34', '2021-01-20 12:12:34'),
(84, 'forceDelete contacts', 'admin', '2021-01-20 12:12:35', '2021-01-20 12:12:35'),
(85, 'viewAny subscribers', 'admin', '2021-01-20 12:12:35', '2021-01-20 12:12:35'),
(86, 'view subscribers', 'admin', '2021-01-20 12:12:35', '2021-01-20 12:12:35'),
(87, 'create subscribers', 'admin', '2021-01-20 12:12:35', '2021-01-20 12:12:35'),
(88, 'update subscribers', 'admin', '2021-01-20 12:12:35', '2021-01-20 12:12:35'),
(89, 'delete subscribers', 'admin', '2021-01-20 12:12:35', '2021-01-20 12:12:35'),
(90, 'restore subscribers', 'admin', '2021-01-20 12:12:35', '2021-01-20 12:12:35'),
(91, 'forceDelete subscribers', 'admin', '2021-01-20 12:12:35', '2021-01-20 12:12:35'),
(92, 'viewAny tags', 'admin', '2021-01-20 12:12:35', '2021-01-20 12:12:35'),
(93, 'view tags', 'admin', '2021-01-20 12:12:35', '2021-01-20 12:12:35'),
(94, 'create tags', 'admin', '2021-01-20 12:12:36', '2021-01-20 12:12:36'),
(95, 'update tags', 'admin', '2021-01-20 12:12:36', '2021-01-20 12:12:36'),
(96, 'delete tags', 'admin', '2021-01-20 12:12:36', '2021-01-20 12:12:36'),
(97, 'restore tags', 'admin', '2021-01-20 12:12:36', '2021-01-20 12:12:36'),
(98, 'forceDelete tags', 'admin', '2021-01-20 12:12:36', '2021-01-20 12:12:36'),
(99, 'viewAny currencies', 'admin', '2021-01-20 12:12:36', '2021-01-20 12:12:36'),
(100, 'view currencies', 'admin', '2021-01-20 12:12:36', '2021-01-20 12:12:36'),
(101, 'create currencies', 'admin', '2021-01-20 12:12:36', '2021-01-20 12:12:36'),
(102, 'update currencies', 'admin', '2021-01-20 12:12:36', '2021-01-20 12:12:36'),
(103, 'delete currencies', 'admin', '2021-01-20 12:12:36', '2021-01-20 12:12:36'),
(104, 'restore currencies', 'admin', '2021-01-20 12:12:36', '2021-01-20 12:12:36'),
(105, 'forceDelete currencies', 'admin', '2021-01-20 12:12:36', '2021-01-20 12:12:36'),
(106, 'viewAny memberships', 'admin', '2021-01-20 12:12:37', '2021-01-20 12:12:37'),
(107, 'view memberships', 'admin', '2021-01-20 12:12:37', '2021-01-20 12:12:37'),
(108, 'create memberships', 'admin', '2021-01-20 12:12:37', '2021-01-20 12:12:37'),
(109, 'update memberships', 'admin', '2021-01-20 12:12:37', '2021-01-20 12:12:37'),
(110, 'delete memberships', 'admin', '2021-01-20 12:12:37', '2021-01-20 12:12:37'),
(111, 'restore memberships', 'admin', '2021-01-20 12:12:37', '2021-01-20 12:12:37'),
(112, 'forceDelete memberships', 'admin', '2021-01-20 12:12:37', '2021-01-20 12:12:37'),
(113, 'viewAny pages', 'admin', '2021-01-20 12:12:37', '2021-01-20 12:12:37'),
(114, 'view pages', 'admin', '2021-01-20 12:12:37', '2021-01-20 12:12:37'),
(115, 'create pages', 'admin', '2021-01-20 12:12:37', '2021-01-20 12:12:37'),
(116, 'update pages', 'admin', '2021-01-20 12:12:38', '2021-01-20 12:12:38'),
(117, 'delete pages', 'admin', '2021-01-20 12:12:38', '2021-01-20 12:12:38'),
(118, 'restore pages', 'admin', '2021-01-20 12:12:38', '2021-01-20 12:12:38'),
(119, 'forceDelete pages', 'admin', '2021-01-20 12:12:38', '2021-01-20 12:12:38');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subCategory_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` decimal(10,1) NOT NULL,
  `type` enum('product','service') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SKU` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stoke` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `views` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `subCategory_id`, `vendor_id`, `name`, `desc`, `short_desc`, `rate`, `type`, `price`, `unit`, `SKU`, `stoke`, `active`, `views`, `slug`, `meta_title`, `meta_desc`, `meta_keywords`, `sort`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '{\"en\":\"Product 1\",\"ar\":\"\\u0645\\u0646\\u062a\\u062c1\"}', '{\"en\":\"<p>desc<\\/p>\",\"ar\":\"<p>desc<\\/p>\"}', '{\"ar\":null}', '1.0', 'service', NULL, '{\"ar\":\"\\u0643\\u064a\\u0644\\u0648\",\"en\":null}', 'FW511948218', 26, 0, 0, 'pr', '{\"ar\":null}', '{\"ar\":null}', '{\"ar\":null}', 1, 1, 1, NULL, NULL, '2021-01-06 22:55:08', '2021-01-21 11:10:51'),
(2, 2, 1, '{\"en\":\"Gas\",\"ar\":\"\\u062c\\u0627\\u0632\"}', '{\"en\":\"<p>Gas<\\/p>\",\"ar\":\"<p>\\u062c\\u0627\\u0632<\\/p>\"}', '{\"en\":\"Gas\",\"ar\":\"\\u062c\\u0627\\u0632\"}', '5.0', 'product', '2.45', '{\"en\":\"Liter\",\"ar\":\"\\u0644\\u062a\\u0631\"}', 'FW511948213', 5000, 1, 0, 'gas', '{\"ar\":null}', '{\"ar\":null}', '{\"ar\":null}', 2, 1, 1, NULL, NULL, '2021-01-08 21:13:10', '2021-01-11 20:54:54'),
(3, 2, 1, '{\"en\":\"Service\",\"ar\":\"\\u062e\\u062f\\u0645\\u0629\"}', '{\"en\":\"<p>Service<\\/p>\",\"ar\":\"<p>Service<\\/p>\"}', '{\"en\":\"Service\",\"ar\":\"Service\"}', '3.0', 'service', NULL, '{\"en\":null}', 'FGEERR1252', 0, 1, 0, 'service', '{\"ar\":null}', '{\"ar\":null}', '{\"ar\":null}', 3, 1, NULL, NULL, NULL, '2021-01-16 14:56:59', '2021-01-16 14:56:59');

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

--
-- Dumping data for table `product_tag`
--

INSERT INTO `product_tag` (`id`, `product_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(2, 1, 1, NULL, NULL),
(3, 1, 2, NULL, NULL),
(4, 1, 3, NULL, NULL),
(5, 1, 4, NULL, NULL),
(6, 1, 5, NULL, NULL),
(7, 1, 6, NULL, NULL),
(8, 2, 2, NULL, NULL);

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
  `status` enum('pending','processing','completed','refused') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_price` double DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `quote_no`, `user_id`, `name`, `email`, `phone`, `phone2`, `address`, `status`, `notes`, `estimated_price`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'QUO-6006EE79AE229', 2, 'Roc', 'roc@gmail.com', '01064323735', NULL, 'Maadi, Cairo', 'processing', NULL, 2000, NULL, 1, NULL, NULL, '2021-01-19 12:38:36', '2021-01-21 11:05:28');

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

--
-- Dumping data for table `quote_items`
--

INSERT INTO `quote_items` (`id`, `quote_id`, `product_id`, `SKU`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'FGEERR1252', 2, NULL, NULL);

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
(1, 'Super Admin', 'admin', '2021-01-20 12:12:38', '2021-01-20 12:12:38'),
(2, 'DataEnty', 'admin', '2021-01-20 12:39:50', '2021-01-20 12:39:50'),
(3, 'SEO', 'admin', '2021-01-20 15:24:05', '2021-01-20 15:24:05'),
(4, 'Super Visor', 'admin', '2021-01-21 11:53:09', '2021-01-21 11:53:09');

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
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(6, 2),
(6, 3),
(7, 1),
(7, 2),
(7, 3),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(16, 4),
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
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'mohamedmaher055@gmail.com', 1, NULL, NULL, NULL, '2021-01-18 13:29:21', '2021-01-18 13:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `desc`, `short_desc`, `slug`, `meta_title`, `meta_desc`, `meta_keywords`, `sort`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"en\":\"Sub Category 1\",\"ar\":\"\\u0635\\u0646\\u0641 1\"}', '{\"en\":\"<p>Sub Category 1<\\/p>\",\"ar\":\"<p>\\u0633<\\/p>\"}', '{\"en\":\"Sub Category 1\",\"ar\":\"\\u0633\"}', 'Sub Category 1', '{\"ar\":null}', '{\"ar\":null}', '{\"ar\":null}', 2, 1, 1, NULL, NULL, '2021-01-06 22:51:16', '2021-01-11 20:55:00'),
(2, 1, '{\"en\":\"Petrol Oils\",\"ar\":\"\\u0632\\u064a\\u0648\\u062a \\u0628\\u062a\\u0631\\u0648\\u0644\\u064a\\u0629\"}', '{\"en\":\"<p>Petrol Oils<\\/p>\",\"ar\":\"<p>\\u0632\\u064a\\u0648\\u062a \\u0628\\u062a\\u0631\\u0648\\u0644\\u064a\\u0629<\\/p>\"}', '{\"en\":\"Petrol Oils\",\"ar\":\"\\u0632\\u064a\\u0648\\u062a \\u0628\\u062a\\u0631\\u0648\\u0644\\u064a\\u0629\"}', 'petrol-oils', '{\"ar\":null}', '{\"ar\":null}', '{\"ar\":null}', 1, 1, 1, NULL, NULL, '2021-01-08 21:09:20', '2021-01-18 00:14:54'),
(3, 1, '{\"en\":\"SubCategory 1\",\"ar\":\"SubCategory 1\"}', '{\"en\":\"<p>SubCategory 1<\\/p>\",\"ar\":\"<p>SubCategory 1<\\/p>\"}', '{\"en\":\"SubCategory 1\",\"ar\":\"SubCategory 1\"}', 'SubCategory 11', '{\"ar\":null}', '{\"ar\":null}', '{\"ar\":null}', 3, 1, 1, NULL, NULL, '2021-01-19 18:04:10', '2021-01-19 18:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `desc`, `slug`, `meta_title`, `meta_desc`, `meta_keywords`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Tables\",\"ar\":\"\\u062a\\u0631\\u0627\\u0628\\u064a\\u0632\\u0627\\u062a\"}', '{\"en\":\"<p>Tables<\\/p>\",\"ar\":\"<p>\\u062a\\u0631\\u0627\\u0628\\u064a\\u0632\\u0627\\u062a<\\/p>\"}', 'tables', '{\"en\":\"Tables\",\"ar\":null}', '{\"en\":\"Tables\",\"ar\":null}', '{\"en\":\"Tables\",\"ar\":null}', 1, NULL, NULL, NULL, '2021-01-17 11:47:30', '2021-01-17 11:47:30'),
(2, '{\"en\":\"Tag 1\",\"ar\":\"Tag 1\"}', '{\"en\":\"<p>Tag 1<\\/p>\",\"ar\":\"<p>Tag 1<\\/p>\"}', 'Tag 1', '{\"ar\":null}', '{\"ar\":null}', '{\"ar\":null}', 1, NULL, NULL, NULL, '2021-01-17 22:33:14', '2021-01-17 22:33:14'),
(3, '{\"en\":\"Tag 2\",\"ar\":\"Tag 2\"}', '{\"en\":\"<p>Tag 2<\\/p>\",\"ar\":\"<p>Tag 2<\\/p>\"}', 'Tag 2', '{\"ar\":null}', '{\"ar\":null}', '{\"ar\":null}', 1, NULL, NULL, NULL, '2021-01-17 22:33:23', '2021-01-17 22:33:23'),
(4, '{\"en\":\"Tag 3\",\"ar\":\"Tag 3\"}', '{\"en\":\"<p>Tag 3<\\/p>\",\"ar\":\"<p>Tag 3<\\/p>\"}', 'Tag 3', '{\"ar\":null}', '{\"ar\":null}', '{\"ar\":null}', 1, NULL, NULL, NULL, '2021-01-17 22:33:34', '2021-01-17 22:33:34'),
(5, '{\"en\":\"Tag 4\",\"ar\":\"Tag 4\"}', '{\"en\":\"<p>Tag 4<\\/p>\",\"ar\":\"<p>Tag 4<\\/p>\"}', 'Tag 4', '{\"ar\":null}', '{\"ar\":null}', '{\"ar\":null}', 1, NULL, NULL, NULL, '2021-01-17 22:33:44', '2021-01-17 22:33:44'),
(6, '{\"en\":\"Tag 5\",\"ar\":\"Tag 5\"}', '{\"en\":\"<p>Tag 5<\\/p>\",\"ar\":\"<p>Tag 5<\\/p>\"}', 'Tag 5', '{\"ar\":null}', '{\"ar\":null}', '{\"ar\":null}', 1, NULL, NULL, NULL, '2021-01-17 22:33:55', '2021-01-17 22:33:55'),
(7, '{\"en\":\"Tag 6\",\"ar\":\"Tag 6\"}', '{\"en\":\"<p>Tag 6<\\/p>\",\"ar\":\"<p>Tag 6<\\/p>\"}', 'Tag 6', '{\"ar\":null}', '{\"ar\":null}', '{\"ar\":null}', 1, NULL, NULL, NULL, '2021-01-17 22:34:06', '2021-01-17 22:34:06'),
(8, '{\"en\":\"Tag 7\",\"ar\":\"Tag 7\"}', '{\"en\":\"<p>Tag 7<\\/p>\",\"ar\":\"<p>Tag 7<\\/p>\"}', 'Tag 7', '{\"ar\":null}', '{\"ar\":null}', '{\"ar\":null}', 1, NULL, NULL, NULL, '2021-01-17 22:34:17', '2021-01-17 22:34:17');

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
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `name`, `email`, `phone`, `phone2`, `email_verified_at`, `password`, `address`, `address2`, `remember_token`, `created_by`, `updated_by`, `deleted_by`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'individual', 'Mohamed Maher', 'user@youmats.com', '01064323735', NULL, NULL, '$2y$10$WNq8LR0wxLSzCQp4XBQ5S.JPGpblhgkWH4VavJmEGnpsvg2a0EFm2', 'Maadi', 'Imbaba', NULL, 1, NULL, NULL, 1, NULL, '2021-01-11 16:20:25', '2021-01-11 16:20:25'),
(2, 'company', 'SEOERA', 'seo@seoera.net', NULL, NULL, NULL, '$2y$10$roimQzMyldHB/kRQpywTaeP2ld3dRG353XzYg4mDvhFwT9bjpo4tW', NULL, NULL, NULL, 1, 1, NULL, 1, NULL, '2021-01-11 20:18:40', '2021-01-13 12:08:50'),
(3, 'individual', 'Nashwa', 'nashwa@gmail.com', '01064323735', NULL, NULL, '$2y$10$V.htI38e5zg6ORwc0GL9aun4HpBetpoc.PTgSda6wg5Hrb7ugOUwa', NULL, NULL, NULL, 1, NULL, NULL, 1, NULL, '2021-01-13 11:46:57', '2021-01-13 11:46:57'),
(4, 'company', 'Company', 'company@gmail.com', NULL, NULL, NULL, '$2y$10$SswvSJmzlAXSieR0lYQ5B.GOjFlnw3p7rLYhrNbkft4Zy2qEV1hry', NULL, NULL, NULL, 1, 1, NULL, 1, NULL, '2021-01-13 12:07:57', '2021-01-16 12:09:11'),
(5, 'company', 'company2', 'company2@gmail.com', NULL, NULL, NULL, '$2y$10$n1ONlc/JZGIRc.XekPrtzOFoU87U6atiQ3Ah58EtOt7.hto8cXkza', NULL, NULL, NULL, 1, 1, NULL, 1, NULL, '2020-01-05 12:36:54', '2021-01-16 12:53:25'),
(6, 'individual', 'Nour', 'nour@gmail.com', NULL, NULL, NULL, '$2y$10$09MAv03hs.ZnY3iMXzIG4OQIFUVKaW8JFintFR3rlnlDzQW184Ruy', NULL, NULL, NULL, 1, 1, NULL, 0, NULL, '2021-01-13 12:59:35', '2021-01-21 11:41:20'),
(7, 'individual', 'Nashwa', 'nashwa1@gmail.com', NULL, NULL, NULL, '$2y$10$Evu5xNN.QehwCHE2vinpKelQikXj6HbGtUwSPaIeg80S4ilko57Fa', NULL, NULL, NULL, 1, 1, NULL, 0, NULL, '2021-01-14 16:12:25', '2021-01-20 15:12:15'),
(8, 'individual', 'Front', 'front@youmats.com', '01064323735', NULL, NULL, '$2y$10$S4Dl.d96dK6gvA8N71cdBufYQfA3j7A9VsWAgc4vPxnkM7Kj5rIWq', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2021-02-02 13:52:32', '2021-02-02 13:52:32'),
(9, 'company', 'Front Company', 'frontcompany@youmats.com', NULL, NULL, NULL, '$2y$10$wKqC6gr/HoXHm980BGGYpesgkfzc39zss6iz5ZIkRvFFOcvgdtbT6', 'Maadi', NULL, NULL, NULL, NULL, NULL, 1, NULL, '2021-02-02 13:53:32', '2021-02-02 13:53:32'),
(11, 'individual', 'Mohamed Maher', 'mohamedmaher055@gmail.com', '01064323735', NULL, '2021-02-04 11:29:56', '$2y$10$rZlM1MbBNv7HGlVVHLSK5e1GBVWYR295bZuwIcY1XgobqFRctERwO', 'Maadi', NULL, 'MU1N604BiPW2i04GhbZNju1rgIjU8csnfvWAcpO414419EcNk3SRPjCfSomF', NULL, NULL, NULL, 1, NULL, '2021-02-04 11:06:34', '2021-02-04 11:41:19');

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
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `membership_id`, `city_id`, `name`, `email`, `phone`, `phone2`, `whatsapp_phone`, `address`, `address2`, `location`, `facebook_url`, `twitter_url`, `youtube_url`, `instagram_url`, `pinterest_url`, `website_url`, `email_verified_at`, `password`, `remember_token`, `active`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Roc', 'roc@gmail.com', '01064323735', NULL, '01064323735', NULL, NULL, '{\"administrative\":\"منطقة الرياض\",\"country\":\"Saudi Arabia\",\"countryCode\":\"sa\",\"latlng\":{\"lat\":24.632,\"lng\":46.7151},\"name\":\"Riyadh\",\"postcode\":\"11131\",\"query\":\"الر\",\"type\":\"city\",\"value\":\"Riyadh, منطقة الرياض, Saudi Arabia\"}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$/UYuJ.FGJoY/WTFELqARBujvr8Lu.OujSPYxD68q/j6Uezp0j9o4K', NULL, 1, 1, 1, NULL, NULL, '2021-01-17 12:51:01', '2021-01-21 11:22:20');

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
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD KEY `admins_created_by_index` (`created_by`),
  ADD KEY `admins_updated_by_index` (`updated_by`),
  ADD KEY `admins_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_created_by_index` (`created_by`),
  ADD KEY `categories_updated_by_index` (`updated_by`),
  ADD KEY `categories_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_index` (`country_id`),
  ADD KEY `cities_created_by_index` (`created_by`),
  ADD KEY `cities_updated_by_index` (`updated_by`),
  ADD KEY `cities_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_created_by_index` (`created_by`),
  ADD KEY `contacts_updated_by_index` (`updated_by`),
  ADD KEY `contacts_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contents_key_unique` (`key`),
  ADD KEY `contents_created_by_index` (`created_by`),
  ADD KEY `contents_updated_by_index` (`updated_by`),
  ADD KEY `contents_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countries_created_by_index` (`created_by`),
  ADD KEY `countries_updated_by_index` (`updated_by`),
  ADD KEY `countries_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_name_unique` (`name`),
  ADD UNIQUE KEY `currencies_code_unique` (`code`),
  ADD KEY `currencies_created_by_index` (`created_by`),
  ADD KEY `currencies_updated_by_index` (`updated_by`),
  ADD KEY `currencies_deleted_by_index` (`deleted_by`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqs_created_by_index` (`created_by`),
  ADD KEY `faqs_updated_by_index` (`updated_by`),
  ADD KEY `faqs_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_slug_unique` (`slug`),
  ADD KEY `languages_created_by_index` (`created_by`),
  ADD KEY `languages_updated_by_index` (`updated_by`),
  ADD KEY `languages_deleted_by_index` (`deleted_by`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberships_created_by_index` (`created_by`),
  ADD KEY `memberships_updated_by_index` (`updated_by`),
  ADD KEY `memberships_deleted_by_index` (`deleted_by`);

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
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `orders_user_id_index` (`user_id`),
  ADD KEY `orders_created_by_index` (`created_by`),
  ADD KEY `orders_updated_by_index` (`updated_by`),
  ADD KEY `orders_deleted_by_index` (`deleted_by`);

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
  ADD UNIQUE KEY `pages_slug_unique` (`slug`),
  ADD KEY `pages_created_by_index` (`created_by`),
  ADD KEY `pages_updated_by_index` (`updated_by`),
  ADD KEY `pages_deleted_by_index` (`deleted_by`);

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
  ADD KEY `products_vendor_id_index` (`vendor_id`),
  ADD KEY `products_created_by_index` (`created_by`),
  ADD KEY `products_updated_by_index` (`updated_by`),
  ADD KEY `products_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_tags_product_id_index` (`product_id`),
  ADD KEY `product_tags_tag_id_index` (`tag_id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quotes_order_id_unique` (`quote_no`),
  ADD KEY `quotes_user_id_index` (`user_id`),
  ADD KEY `quotes_created_by_index` (`created_by`),
  ADD KEY `quotes_updated_by_index` (`updated_by`),
  ADD KEY `quotes_deleted_by_index` (`deleted_by`);

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
  ADD UNIQUE KEY `subscribers_email_unique` (`email`),
  ADD KEY `subscribers_created_by_index` (`created_by`),
  ADD KEY `subscribers_updated_by_index` (`updated_by`),
  ADD KEY `subscribers_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_categories_slug_unique` (`slug`),
  ADD KEY `sub_categories_category_id_index` (`category_id`),
  ADD KEY `sub_categories_created_by_index` (`created_by`),
  ADD KEY `sub_categories_updated_by_index` (`updated_by`),
  ADD KEY `sub_categories_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`),
  ADD KEY `tags_created_by_index` (`created_by`),
  ADD KEY `tags_updated_by_index` (`updated_by`),
  ADD KEY `tags_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_created_by_index` (`created_by`),
  ADD KEY `users_updated_by_index` (`updated_by`),
  ADD KEY `users_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`),
  ADD KEY `vendors_membership_id_index` (`membership_id`),
  ADD KEY `vendors_city_id_index` (`city_id`),
  ADD KEY `vendors_created_by_index` (`created_by`),
  ADD KEY `vendors_updated_by_index` (`updated_by`),
  ADD KEY `vendors_deleted_by_index` (`deleted_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_events`
--
ALTER TABLE `action_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_tag`
--
ALTER TABLE `product_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quote_items`
--
ALTER TABLE `quote_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `admins_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `admins_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `categories_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `categories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cities_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `cities_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `cities_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`);

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `contacts_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `contacts_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`);

--
-- Constraints for table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `contents_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `contents_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`);

--
-- Constraints for table `countries`
--
ALTER TABLE `countries`
  ADD CONSTRAINT `countries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `countries_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `countries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`);

--
-- Constraints for table `currencies`
--
ALTER TABLE `currencies`
  ADD CONSTRAINT `currencies_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `currencies_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `currencies_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`);

--
-- Constraints for table `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `faqs_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `faqs_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`);

--
-- Constraints for table `languages`
--
ALTER TABLE `languages`
  ADD CONSTRAINT `languages_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `languages_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `languages_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`);

--
-- Constraints for table `memberships`
--
ALTER TABLE `memberships`
  ADD CONSTRAINT `memberships_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `memberships_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `memberships_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`);

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
  ADD CONSTRAINT `orders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `orders_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `orders_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `pages_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `pages_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `products_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subCategory_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `products_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD CONSTRAINT `product_tags_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quotes`
--
ALTER TABLE `quotes`
  ADD CONSTRAINT `quotes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `quotes_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `quotes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`),
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
-- Constraints for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD CONSTRAINT `subscribers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `subscribers_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `subscribers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`);

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `sub_categories_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `sub_categories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`);

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `tags_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `tags_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `users_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `users_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`);

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `vendors_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `vendors_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `vendors_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `vendors_membership_id_foreign` FOREIGN KEY (`membership_id`) REFERENCES `memberships` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `vendors_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
