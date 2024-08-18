-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2024 at 09:57 AM
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
-- Dumping data for table `faq_post`
--

INSERT INTO `faq_post` (`id`, `user_id`, `is_active`, `photo`, `photo_thum_1`, `url_type`, `youtube`, `published_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 0, NULL, '2024-08-18', NULL, '2024-08-18 06:54:41', '2024-08-18 07:54:41'),
(2, 1, 1, NULL, NULL, 0, NULL, '2024-08-18', NULL, '2024-08-18 06:55:55', '2024-08-18 07:55:55'),
(3, 1, 1, NULL, NULL, 0, NULL, '2024-08-18', NULL, '2024-08-18 06:56:17', '2024-08-18 07:56:17'),
(4, 1, 1, NULL, NULL, 0, NULL, '2024-08-18', NULL, '2024-08-18 06:56:44', '2024-08-18 07:56:44');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
