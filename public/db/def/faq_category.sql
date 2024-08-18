-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2024 at 08:09 PM
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
-- Dumping data for table `faq_category`
--

INSERT INTO `faq_category` (`id`, `parent_id`, `deep`, `icon`, `photo`, `photo_thum_1`, `is_active`, `postion`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, NULL, NULL, NULL, 1, 0, '2024-08-17 17:07:10', '2024-08-17 18:07:10'),
(2, NULL, 0, NULL, NULL, NULL, 1, 0, '2024-08-17 17:07:34', '2024-08-17 18:07:34'),
(3, NULL, 0, NULL, NULL, NULL, 1, 0, '2024-08-17 17:07:50', '2024-08-17 18:07:50'),
(4, NULL, 0, NULL, NULL, NULL, 1, 0, '2024-08-17 17:08:36', '2024-08-17 18:08:36');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
