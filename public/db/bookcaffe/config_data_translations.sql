-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 06:27 PM
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
-- Dumping data for table `config_data_translations`
--

INSERT INTO `config_data_translations` (`id`, `data_id`, `locale`, `name`) VALUES
(1, 1, 'ar', 'اللغة العربية'),
(2, 1, 'en', 'اللغة العربية'),
(3, 2, 'ar', 'اللغة الانجليزية'),
(4, 2, 'en', 'اللغة الانجليزية'),
(5, 3, 'ar', 'اسبوعية'),
(6, 3, 'en', 'اسبوعية'),
(7, 4, 'ar', 'شهرية'),
(8, 4, 'en', 'شهرية'),
(9, 5, 'ar', 'نصف سنوية'),
(10, 5, 'en', 'نصف سنوية'),
(11, 6, 'ar', 'سنوية'),
(12, 6, 'en', 'سنوية'),
(13, 7, 'ar', 'عدد خاص'),
(14, 7, 'en', 'عدد خاص'),
(15, 8, 'ar', 'غير منتظمة'),
(16, 8, 'en', 'غير منتظمة'),
(17, 9, 'en', 'نصف شهرية'),
(18, 9, 'ar', 'نصف شهرية'),
(19, 10, 'ar', 'ربع سنوية'),
(20, 10, 'en', 'ربع سنوية'),
(21, 11, 'ar', 'فصلية'),
(22, 11, 'en', 'فصلية');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
