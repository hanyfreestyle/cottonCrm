-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 05:02 PM
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
-- Dumping data for table `data_city_translations`
--

INSERT INTO `data_city_translations` (`id`, `city_id`, `locale`, `name`, `g_title`, `g_des`, `slug`) VALUES
(1, 1, 'ar', 'الداخلية', NULL, NULL, NULL),
(2, 1, 'en', 'Ad Dakhiliyah', NULL, NULL, NULL),
(3, 2, 'ar', 'الظاهرة', NULL, NULL, NULL),
(4, 2, 'en', 'Ad Dhahirah', NULL, NULL, NULL),
(5, 3, 'ar', 'شمال الباطنة', NULL, NULL, NULL),
(6, 3, 'en', 'Al Batinah North', NULL, NULL, NULL),
(7, 4, 'ar', 'جنوب الباطنة', NULL, NULL, NULL),
(8, 4, 'en', 'Al Batinah South', NULL, NULL, NULL),
(9, 5, 'ar', 'البريمي', NULL, NULL, NULL),
(10, 5, 'en', 'Al Buraymi', NULL, NULL, NULL),
(11, 6, 'ar', 'الوسطى', NULL, NULL, NULL),
(12, 6, 'en', 'Al Wusta', NULL, NULL, NULL),
(13, 7, 'ar', 'شمال الشرقية', NULL, NULL, NULL),
(14, 7, 'en', 'Ash Sharqiyah North', NULL, NULL, NULL),
(15, 8, 'ar', 'جنوب الشرقية', NULL, NULL, NULL),
(16, 8, 'en', 'Ash Sharqiyah South', NULL, NULL, NULL),
(17, 9, 'ar', 'ظفار', NULL, NULL, NULL),
(18, 9, 'en', 'Dhofar', NULL, NULL, NULL),
(19, 10, 'ar', 'مسقط', NULL, NULL, NULL),
(20, 10, 'en', 'Muscat', NULL, NULL, NULL),
(21, 11, 'ar', 'مسندم', NULL, NULL, NULL),
(22, 11, 'en', 'Musandam', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
