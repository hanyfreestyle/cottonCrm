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
-- Dumping data for table `config_meta_tag_translations`
--

INSERT INTO `config_meta_tag_translations` (`id`, `meta_tag_id`, `locale`, `name`, `des`, `g_title`, `g_des`) VALUES
(1, 1, 'ar', NULL, NULL, 'متجر قطن لبيع كل براندات وانواع مراتب السرير', 'متجر قطن لبيع كل براندات وانواع مراتب السرير'),
(2, 1, 'en', NULL, NULL, 'A cotton store that sells all brands and types of bed mattresses', 'A cotton store that sells all brands and types of bed mattresses'),
(3, 2, 'ar', 'من نحن', NULL, 'من نحن | متجر قطن لبيع كل براندات وانواع مراتب السرير', 'من نحن | متجر قطن لبيع كل براندات وانواع مراتب السرير'),
(4, 2, 'en', NULL, NULL, 'About Us | A cotton store that sells all brands and types of bed mattresses', 'About Us | A cotton store that sells all brands and types of bed mattresses'),
(5, 3, 'ar', 'سياسية الاستخدام', 'سياسية الاستخدام متجر قطن لبيع كل براندات وانواع مراتب السرير', 'سياسية الاستخدام متجر قطن لبيع كل براندات وانواع مراتب السرير', 'سياسية الاستخدام متجر قطن لبيع كل براندات وانواع مراتب السرير'),
(6, 3, 'en', NULL, NULL, 'Terms & Conditions', 'Terms & Conditions'),
(7, 4, 'ar', 'خطاء 404', NULL, 'عذرًا !! الصفحة التي تبحث عنها غير موجودة.', 'عذرًا !! الصفحة التي تبحث عنها غير موجودة.'),
(8, 4, 'en', 'Error 404', NULL, 'Oops !! Page Not Found', 'Oops !! Page Not Found');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
