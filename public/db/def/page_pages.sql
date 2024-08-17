-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2024 at 06:24 PM
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
-- Database: `cottton_crm`
--

--
-- Dumping data for table `page_pages`
--

INSERT INTO `page_pages` (`id`, `user_id`, `is_active`, `photo`, `photo_thum_1`, `url_type`, `youtube`, `published_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 0, NULL, '2024-08-16', NULL, '2024-08-16 19:30:18', '2024-08-17 16:20:58'),
(2, 1, 1, NULL, NULL, 0, NULL, '2024-08-17', NULL, '2024-08-17 15:22:47', '2024-08-17 16:22:47'),
(3, 1, 1, NULL, NULL, 0, NULL, '2024-08-17', NULL, '2024-08-17 15:23:12', '2024-08-17 16:23:12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
