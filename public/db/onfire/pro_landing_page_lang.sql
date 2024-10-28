-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 12:57 PM
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
-- Dumping data for table `pro_landing_page_lang`
--

INSERT INTO `pro_landing_page_lang` (`id`, `page_id`, `locale`, `slug`, `name`, `des`, `des_up`, `g_title`, `g_des`) VALUES
(1, 1, 'ar', 'اسم-العرض', 'اسم العرض', '<p>وصف الصفحة يظهر اسفل المنتجات (ar)</p>', '<p>وصف الصفحة يظهر اعلى المنتجات</p>', NULL, NULL),
(2, 1, 'en', 'offers-name', 'Offers Name', NULL, NULL, NULL, NULL),
(3, 2, 'ar', 'اسم-العرض-الثانى', 'اسم العرض الثانى', NULL, NULL, NULL, NULL),
(4, 2, 'en', 'اسم-العرض-الثانى', 'اسم العرض الثانى', NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
