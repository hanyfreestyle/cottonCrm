-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2024 at 06:41 AM
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
-- Dumping data for table `pro_attribute_value_lang`
--

INSERT INTO `pro_attribute_value_lang` (`id`, `value_id`, `locale`, `slug`, `name`, `count`) VALUES
(1, 1, 'ar', 'كبير', 'كبير', NULL),
(2, 1, 'en', 'كبير', 'كبير', NULL),
(3, 2, 'ar', 'وسط', 'وسط', NULL),
(4, 2, 'en', 'وسط', 'وسط', NULL),
(5, 3, 'ar', 'صغير', 'صغير', NULL),
(6, 3, 'en', 'صغير', 'صغير', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
