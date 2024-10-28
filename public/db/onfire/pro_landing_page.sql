-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 12:56 PM
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
-- Database: `app_crm_hoover`
--

--
-- Dumping data for table `pro_landing_page`
--

INSERT INTO `pro_landing_page` (`id`, `is_active`, `is_soft`, `is_des`, `brand_id`, `product_id`, `photo`, `photo_thum_1`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, NULL, '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 'images/lp/1/اسم-العرض-Pp2IUS9Yt3.webp', 'images/lp/1/اسم-العرض-WXxCLCgEbj.webp', '2024-10-28 10:22:14', '2024-10-28 10:32:21'),
(2, 1, 0, 0, NULL, '[\"1\",\"2\",\"3\",\"4\"]', 'images/lp/2/اسم-العرض-الثانى-jiwz7dGUOn.webp', 'images/lp/2/اسم-العرض-الثانى-fM6ZhMTwlg.webp', '2024-10-28 10:54:03', '2024-10-28 10:54:03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
