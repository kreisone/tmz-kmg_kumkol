-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2019 at 12:35 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.26

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
(12, 'Арматурщик1', 1, NULL, NULL);

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
(29, 1, 2, NULL, NULL);

--
-- Dumping data for table `list_of_personnel_of_worker`
--

INSERT INTO `list_of_personnel_of_worker` (`id`, `id_worker`, `id_personnel`, `created_at`, `updated_at`) VALUES
(2, 2, 3, '2019-02-05 02:00:00', NULL),
(3, 3, 9, '2019-02-05 02:00:00', NULL),
(4, 3, 8, '2019-02-05 02:00:00', NULL),
(5, 2, 2, '2019-02-05 02:00:00', NULL),
(7, 1, 5, NULL, NULL);

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
(16, '%№5', NULL, NULL);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
