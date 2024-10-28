-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 06:03 PM
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
-- Database: `cottton_shop_web`
--

--
-- Dumping data for table `pro_attribute_translations`
--

INSERT INTO `pro_attribute_translations` (`id`, `attribute_id`, `locale`, `slug`, `name`, `des`) VALUES
(1, 1, 'ar', 'الطول', 'الطول', NULL),
(2, 1, 'en', 'height', 'Height', NULL),
(3, 2, 'ar', 'العرض', 'العرض', NULL),
(4, 2, 'en', 'width', 'Width', NULL),
(5, 3, 'ar', 'الارتفاع', 'الارتفاع', NULL),
(6, 3, 'en', 'الارتفاع', 'الارتفاع', NULL),
(7, 4, 'ar', 'المقاس37-54', 'المقاس', NULL),
(8, 4, 'en', 'size', 'Size', NULL),
(9, 5, 'ar', 'الوزن', 'الوزن', NULL),
(10, 5, 'en', 'weight', 'Weight', NULL),
(11, 6, 'ar', '220x240', '220x240', NULL),
(12, 7, 'ar', '240x220', '240x220', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
