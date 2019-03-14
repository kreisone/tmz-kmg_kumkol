-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 11, 2019 at 06:45 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tmz`
--
CREATE DATABASE IF NOT EXISTS `tmz` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tmz`;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(10) UNSIGNED NOT NULL,
  `pagination` int(2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `pagination`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group_of_personnel`
--

CREATE TABLE `group_of_personnel` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_shopfloor` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_of_personnel`
--

INSERT INTO `group_of_personnel` (`id`, `title`, `id_shopfloor`, `created_at`, `updated_at`) VALUES
(1, 'Арматурщик', 1, '2019-02-05 03:00:00', NULL),
(2, 'Бармен', 2, '2019-02-05 03:00:00', NULL),
(3, 'Бухгалтер', 3, '2019-02-05 04:00:00', NULL),
(4, 'Бухгалтер №1', 3, '2019-02-05 03:00:00', NULL),
(5, 'Бухгалтер №2', 3, '2019-02-05 04:00:00', NULL),
(6, 'Бухгалтер №3', 3, '2019-02-05 07:00:00', NULL),
(7, 'Бухгалтер №4', 3, '2019-02-05 07:00:00', NULL),
(8, 'Вед. инженер по АСУП', 4, '2019-02-05 07:00:00', NULL),
(9, 'Вед. инженер-прогаммист', 4, '2019-02-05 10:00:00', NULL),
(10, 'Вед. инженер прогаммист 1', 4, '2019-02-05 05:00:00', NULL),
(11, 'Вед. инженер прогаммист 1', 5, '2019-02-05 05:00:00', NULL),
(12, 'Арматурщик1', 1, NULL, NULL),
(13, 'Работник1', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `list_of_materials`
--

CREATE TABLE `list_of_materials` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_personnel` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `list_of_materials`
--

INSERT INTO `list_of_materials` (`id`, `id_personnel`, `id_material`, `created_at`, `updated_at`) VALUES
(1, 3, 5, '2019-02-05 06:00:00', NULL),
(3, 3, 3, '2019-02-05 03:00:00', NULL),
(6, 3, 6, '2019-02-05 06:00:00', NULL),
(20, 9, 2, NULL, NULL),
(21, 9, 9, NULL, NULL),
(22, 9, 11, NULL, NULL),
(23, 11, 3, NULL, NULL),
(24, 11, 7, NULL, NULL),
(25, 2, 2, NULL, NULL),
(26, 2, 3, NULL, NULL),
(28, 1, 1, NULL, NULL),
(29, 1, 2, NULL, NULL),
(30, 4, 6, NULL, NULL),
(31, 13, 17, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `list_of_personnel_of_worker`
--

CREATE TABLE `list_of_personnel_of_worker` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_worker` int(11) NOT NULL,
  `id_personnel` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `list_of_personnel_of_worker`
--

INSERT INTO `list_of_personnel_of_worker` (`id`, `id_worker`, `id_personnel`, `created_at`, `updated_at`) VALUES
(2, 2, 3, '2019-02-05 02:00:00', NULL),
(3, 3, 9, '2019-02-05 02:00:00', NULL),
(4, 3, 8, '2019-02-05 02:00:00', NULL),
(5, 2, 2, '2019-02-05 02:00:00', NULL),
(8, 4, 4, NULL, NULL),
(9, 1, 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Brain-терминал', '2019-02-05 06:00:00', NULL),
(2, 'CD/DVD-диски', '2019-02-05 06:00:00', NULL),
(3, 'Flash-носители', '2019-02-05 04:00:00', NULL),
(4, 'HARD-коммуникатор', '2019-02-05 04:00:00', NULL),
(5, 'USB Flash Drive 8Gb', '2019-02-05 04:00:00', NULL),
(6, 'USB Storage', '2019-02-05 04:00:00', NULL),
(7, 'Аккамулятор', '2019-02-05 04:00:00', NULL),
(8, 'Акустико-эмиссионный комплекс A-Line 32D', '2019-02-05 00:00:00', NULL),
(9, 'Амперметр', '2019-02-05 01:00:00', NULL),
(10, 'Анализатор металлов X-MET5000 (в комплекте , в кейсе)', '2019-02-05 03:00:00', NULL),
(11, 'Анемометр-термометр', '2019-02-05 04:00:00', NULL),
(12, 'Анемометр чашечный', '2019-02-05 05:00:00', NULL),
(16, '%№5', NULL, NULL),
(17, 'ПК', NULL, NULL);

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
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2017_09_03_144628_create_permission_tables', 1),
(12, '2017_09_11_174816_create_social_accounts_table', 1),
(13, '2017_09_26_140332_create_cache_table', 1),
(14, '2017_09_26_140528_create_sessions_table', 1),
(15, '2017_09_26_140609_create_jobs_table', 1),
(16, '2018_04_08_033256_create_password_histories_table', 1),
(23, '2019_02_05_074502_create_materials_table', 2),
(24, '2019_02_05_082800_create_list_of_materials_table', 2),
(25, '2019_02_05_082843_create_group_of_personnel_table', 2),
(26, '2019_02_05_082923_create_shopfloor_table', 2),
(27, '2019_02_05_082956_create_workers_table', 3),
(28, '2019_02_05_083036_create_list_of_personnel_of_worker_table', 3),
(29, '2019_03_10_110445_create_config_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Auth\\User', 1),
(3, 'App\\Models\\Auth\\User', 3),
(4, 'App\\Models\\Auth\\User', 2),
(5, 'App\\Models\\Auth\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_histories`
--

CREATE TABLE `password_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_histories`
--

INSERT INTO `password_histories` (`id`, `user_id`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, '$2y$10$87PEhSr/jSc0o5JANqa5nejv94cJZqkFeiU/E5Ap.iW9gB5Y1XAdS', '2019-02-06 07:17:48', '2019-02-06 07:17:48'),
(2, 2, '$2y$10$GrPOEWfvSi1EAFubI57N8.ShFjXzTuCirPPwJnXt5WETqFDYA184G', '2019-02-06 07:17:48', '2019-02-06 07:17:48'),
(3, 3, '$2y$10$HlGEPZCzZWgF0xb9s/5QSOsO.CZmQIvWmg1dsCLzQlUSBWqshcFBC', '2019-02-06 07:17:49', '2019-02-06 07:17:49'),
(4, 4, '$2y$10$OBA/paakGw0Z9gEMPRb26uy3sAavj3NhUySSIFybpDPUVIfIOEa0G', '2019-02-06 07:17:49', '2019-02-06 07:17:49'),
(5, 5, '$2y$10$RTRV3aIdznRroUjroBVdKOquEtkkcBBzAETfJcRBtmPPW2poaJUZC', '2019-02-06 07:17:49', '2019-02-06 07:17:49');

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
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view backend', 'web', '2019-02-06 07:17:49', '2019-02-06 07:17:49'),
(2, 'service of security', 'web', '2019-02-06 07:17:50', '2019-02-06 07:17:50'),
(3, 'pass bureau', 'web', '2019-02-06 07:17:50', '2019-02-06 07:17:50');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'web', '2019-02-06 07:17:49', '2019-02-06 07:17:49'),
(2, 'executive', 'web', '2019-02-06 07:17:49', '2019-02-06 07:17:49'),
(3, 'user', 'web', '2019-02-06 07:17:49', '2019-02-06 07:17:49'),
(4, 'service_of_security', 'web', '2019-02-06 07:17:49', '2019-02-06 07:17:49'),
(5, 'pass_bureau', 'web', '2019-02-06 07:17:49', '2019-02-06 07:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 4),
(1, 5),
(2, 1),
(2, 4),
(3, 1),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopfloor`
--

CREATE TABLE `shopfloor` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shopfloor`
--

INSERT INTO `shopfloor` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Цех №12 Ремонтно-строительный цех', '2019-02-05 05:00:00', NULL),
(2, 'Цех №35 Цех общественного питания и р.т.', '2019-02-05 05:00:00', NULL),
(3, 'Цех №67 Управление бухгатерского учёта', '2019-02-05 06:00:00', NULL),
(4, 'Цех №21 АСУ', '2019-02-05 03:00:00', NULL),
(5, 'Центральный аппарат', '2019-02-05 06:00:00', NULL),
(6, 'Цех №21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_accounts`
--

CREATE TABLE `social_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `provider` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'gravatar',
  `avatar_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_changed_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `confirmation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `timezone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `first_name`, `last_name`, `email`, `avatar_type`, `avatar_location`, `password`, `password_changed_at`, `active`, `confirmation_code`, `confirmed`, `timezone`, `last_login_at`, `last_login_ip`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '0db8557d-58e2-4da3-9bb9-2d2c600c1a55', 'Главный', 'Администратор', 'admin@kmg.kz', 'gravatar', NULL, '$2y$10$87PEhSr/jSc0o5JANqa5nejv94cJZqkFeiU/E5Ap.iW9gB5Y1XAdS', NULL, 1, 'f73b6a327ef735f892549381ee7eae17', 1, 'America/New_York', '2019-03-10 05:59:39', '::1', '7o0P85a8jvfP8uZELNZ8iHKx6vqALsJXhe4XzcNtNG2mSHye5vhfUU96rCEQ', '2019-02-06 07:17:48', '2019-03-10 05:59:39', NULL),
(2, '8d022fd4-b5a0-4083-a8be-0bf6cfb94a3b', 'Служба', 'Безопаности', 'service_of_security@kmg.kz', 'gravatar', NULL, '$2y$10$GrPOEWfvSi1EAFubI57N8.ShFjXzTuCirPPwJnXt5WETqFDYA184G', NULL, 1, '198cb9c3dc3e2bb47bdfd9659e7fbff9', 1, 'America/New_York', '2019-03-10 07:12:47', '::1', 'e8uZLOyfnUfUr6wxHARGuHhyy6U176CzZF6njRoAsL6w0UbP1Wm2Lss2QM0m', '2019-02-06 07:17:48', '2019-03-10 07:12:48', NULL),
(3, '28415eca-842c-40e7-8af4-6e2dd5645744', 'Охрана', 'Проходной', 'security@kmg.kz', 'gravatar', NULL, '$2y$10$HlGEPZCzZWgF0xb9s/5QSOsO.CZmQIvWmg1dsCLzQlUSBWqshcFBC', NULL, 1, '5dcae341b064368cf0af73310e09cfb6', 1, 'America/New_York', '2019-03-03 02:10:26', '::1', 'OvTkthN1WjTGWRCFUqJAc1JvHEm3pIDhwpZTx2XKZxyTEFJuzPAExhB6tIBj', '2019-02-06 07:17:49', '2019-03-03 02:10:27', NULL),
(4, '1b7bd55c-bfb4-48f5-ab43-3a1fbc56b787', 'Бюро', 'Пропусков', 'pass_bureau@kmg.kz', 'gravatar', NULL, '$2y$10$OBA/paakGw0Z9gEMPRb26uy3sAavj3NhUySSIFybpDPUVIfIOEa0G', NULL, 1, '0dfb15ca5ba138213d9b06e17fab7a04', 1, 'America/New_York', '2019-03-10 05:50:49', '::1', 'VSWlSnV2td59QQkhNwJtXCftxJs4mP7PA4dQSwoVVJ0dargGWUOdutJl8qem', '2019-02-06 07:17:49', '2019-03-10 05:50:50', NULL),
(5, '160f1e5b-2263-4d76-826e-3de4e492ac2e', 'Вася', 'Пупкин', 'vasya@gmail.com', 'gravatar', NULL, '$2y$10$RTRV3aIdznRroUjroBVdKOquEtkkcBBzAETfJcRBtmPPW2poaJUZC', NULL, 1, 'bf0343071239f33f22296dfcc3a334f1', 1, 'America/New_York', '2019-02-07 07:50:50', '::1', '1MjDtetjmAZp6n5LhiMQuODaG22M1Q19RWJEUzibCWbKUdXMKMvSg2OpENq8', '2019-02-06 07:17:49', '2019-02-07 07:50:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_shopfloor` int(11) NOT NULL,
  `card_number` int(11) NOT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id`, `name`, `lastname`, `middlename`, `id_shopfloor`, `card_number`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'Бауржан', 'Абдирасилов', 'Есенгельдиевич', 1, 15697345, 'img/frontend/worker/420x560(1).jpeg', '2019-02-05 00:15:00', NULL),
(2, 'Гайни', 'Абдрахманова', 'Кулатаевна', 2, 12946853, 'img/frontend/worker/420x560.jpeg', '2019-02-05 02:00:00', NULL),
(3, 'Айнур', 'Абыкешова', 'Каировна', 3, 97314522, 'img/frontend/worker/420x560(2).jpeg', '2019-02-05 00:00:00', NULL),
(4, 'Гульнара', 'Акимова', 'Шаймуратовна', 4, 94675384, 'img/frontend/worker/420x560.jpeg', '2019-02-05 07:00:00', NULL),
(5, 'Ботагоз', 'Акинжанова', 'Акинжановна', 2, 89546853, 'img/frontend/worker/420x560.jpeg', '2019-02-05 04:00:00', NULL),
(6, 'Назгуль', 'Акылбекова', 'Тохсыновна', 3, 78865498, 'img/frontend/worker/420x560.jpeg', '2019-02-04 23:00:00', NULL),
(7, 'Екатерина', 'Алёхина', 'Владимировна', 1, 12548465, 'img/frontend/worker/420x560.jpeg', '2019-02-05 03:00:00', NULL),
(8, 'Оспанбек', 'Алсеитов', 'Балтабаевич', 3, 98764987, 'img/frontend/worker/420x560.jpeg', '2019-02-04 23:00:00', NULL),
(9, 'Серик', 'Алтынбаев', 'Балтабаевич', 2, 79864685, 'img/frontend/worker/420x560.jpeg', '2019-02-05 06:00:00', NULL),
(10, 'Айгуль', 'Ангоноева', 'Сембаевна', 5, 87541599, 'img/frontend/worker/420x560.jpeg', '2019-02-05 04:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD UNIQUE KEY `cache_key_unique` (`key`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_of_personnel`
--
ALTER TABLE `group_of_personnel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `list_of_materials`
--
ALTER TABLE `list_of_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_of_personnel_of_worker`
--
ALTER TABLE `list_of_personnel_of_worker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
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
  ADD KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `password_histories`
--
ALTER TABLE `password_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_histories_user_id_foreign` (`user_id`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_name_index` (`name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `shopfloor`
--
ALTER TABLE `shopfloor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_accounts_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group_of_personnel`
--
ALTER TABLE `group_of_personnel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_of_materials`
--
ALTER TABLE `list_of_materials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `list_of_personnel_of_worker`
--
ALTER TABLE `list_of_personnel_of_worker`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `password_histories`
--
ALTER TABLE `password_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shopfloor`
--
ALTER TABLE `shopfloor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `social_accounts`
--
ALTER TABLE `social_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `password_histories`
--
ALTER TABLE `password_histories`
  ADD CONSTRAINT `password_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD CONSTRAINT `social_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
