-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 12:00 AM
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
-- Database: `a_cart_new`
--

--
-- Dumping data for table `blog_category`
--

INSERT INTO `blog_category` (`id`, `parent_id`, `deep`, `icon`, `photo`, `photo_thum_1`, `is_active`, `position`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, NULL, NULL, NULL, 1, 0, '2024-03-07 17:06:42', '2024-03-07 17:06:42'),
(2, NULL, 0, NULL, NULL, NULL, 1, 0, '2024-03-07 17:06:42', '2024-03-07 17:06:42'),
(3, NULL, 0, NULL, NULL, NULL, 1, 0, '2024-03-07 17:06:42', '2024-03-07 17:06:42');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
