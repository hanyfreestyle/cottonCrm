-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 08:00 PM
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
-- Dumping data for table `config_meta_tag`
--

INSERT INTO `config_meta_tag` (`id`, `cat_id`, `photo`, `photo_thum_1`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'home', NULL, NULL, '2023-08-16 09:18:40', '2023-08-16 09:18:40', NULL),
(2, 'about', NULL, NULL, '2023-08-16 11:16:16', '2024-04-10 23:29:43', NULL),
(3, 'trems', NULL, NULL, '2023-10-29 08:05:33', '2024-04-10 23:26:17', NULL),
(4, 'err_404', NULL, NULL, '2024-01-25 13:35:18', '2024-01-25 13:35:18', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
