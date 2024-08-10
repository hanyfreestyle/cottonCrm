-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2024 at 12:44 PM
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
-- Dumping data for table `config_meta_tags`
--

INSERT INTO `config_meta_tags` (`id`, `cat_id`, `photo`, `photo_thum_1`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'home', NULL, NULL, '2023-08-16 09:18:40', '2023-08-16 09:18:40', NULL),
(2, 'about', NULL, NULL, '2023-08-16 11:16:16', '2024-04-10 23:29:43', NULL),
(3, 'blog', NULL, NULL, '2023-08-16 11:30:42', '2023-08-16 11:30:42', NULL),
(4, 'contact', NULL, NULL, '2023-08-16 11:32:36', '2024-04-10 23:29:51', NULL),
(5, 'trems', NULL, NULL, '2023-10-29 08:05:33', '2024-04-10 23:26:17', NULL),
(6, 'offers', NULL, NULL, '2023-10-29 08:38:58', '2024-04-10 23:27:18', NULL),
(7, 'err_404', NULL, NULL, '2024-01-25 13:35:18', '2024-01-25 13:35:18', NULL),
(8, 'wish_list', NULL, NULL, '2024-01-30 16:23:20', '2024-04-21 07:37:14', NULL),
(9, 'shop', NULL, NULL, '2024-04-10 23:30:32', '2024-04-10 23:30:44', NULL),
(10, 'brand', NULL, NULL, '2024-04-12 05:00:57', '2024-04-12 05:00:57', NULL),
(11, 'login', NULL, NULL, '2024-04-13 16:10:11', '2024-04-13 16:10:11', NULL),
(12, 'sign_up', NULL, NULL, '2024-04-13 16:55:03', '2024-04-13 16:55:03', NULL),
(13, 'profile_page', NULL, NULL, '2024-04-13 19:27:46', '2024-04-13 19:27:46', NULL),
(14, 'products_categories', NULL, NULL, '2024-04-14 18:06:37', '2024-04-14 18:06:37', NULL),
(15, 'search', NULL, NULL, '2024-04-19 01:27:47', '2024-04-19 01:27:47', NULL),
(16, 'cart', NULL, NULL, '2024-04-22 04:18:32', '2024-04-22 04:18:32', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
