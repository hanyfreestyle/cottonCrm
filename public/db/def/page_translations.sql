-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2024 at 06:24 PM
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
-- Dumping data for table `page_translations`
--

INSERT INTO `page_translations` (`id`, `page_id`, `locale`, `slug`, `name`, `des`, `g_title`, `g_des`, `youtube_title`) VALUES
(1, 1, 'ar', 'الصفحة-الرئيسية', 'الصفحة الرئيسية', '<p>الصفحة الرئيسية</p>', 'عنوان الصفحة الصفحة الرئيسية', 'الصفحة الرئيسية وصف الصفحة', NULL),
(2, 2, 'ar', 'من-نحن', 'من نحن', '<p>من نحن</p>', NULL, NULL, NULL),
(3, 3, 'ar', 'عملاء-الاستثمار-العقارى', 'عملاء الاستثمار العقارى', '<p>عملاء الاستثمار العقارى</p>', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
