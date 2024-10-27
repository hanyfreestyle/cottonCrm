-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2024 at 08:20 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cottton_shop`
--

--
-- Dumping data for table `pro_landing_page`
--

INSERT INTO `pro_landing_page` (`id`, `is_active`, `is_soft`, `brand_id`, `product_id`, `photo`, `photo_thum_1`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"12\",\"28\",\"42\"]', NULL, NULL, '2024-07-25 12:45:39', '2024-07-25 13:01:32'),
(2, 1, 1, 2, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"9\",\"24\"]', NULL, NULL, '2024-07-25 12:56:23', '2024-07-25 12:56:39'),
(3, 1, 0, 11, '[\"2\",\"3\",\"4\",\"5\",\"6\",\"12\",\"16\",\"28\",\"83\"]', NULL, NULL, '2024-07-25 12:57:53', '2024-07-25 14:39:52'),
(4, 1, 1, NULL, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"8\",\"15\"]', 'images/lp/4/عرض-الصيف-من-موقع-قطن-Rgg9Ht9uTS.webp', 'images/lp/4/عرض-الصيف-من-موقع-قطن-JuEa3NodTq.webp', '2024-07-25 13:00:43', '2024-07-25 14:39:40'),
(5, 1, 0, NULL, '[\"296\",\"315\",\"318\",\"332\",\"360\",\"361\",\"363\",\"402\"]', NULL, NULL, '2024-07-25 14:42:38', '2024-07-25 14:42:38');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
