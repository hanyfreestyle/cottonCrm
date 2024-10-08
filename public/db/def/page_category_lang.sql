-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 11:01 AM
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
-- Dumping data for table `page_category_lang`
--

INSERT INTO `page_category_lang` (`id`, `category_id`, `locale`, `slug`, `name`, `des`, `g_title`, `g_des`) VALUES
(1, 1, 'ar', 'الصفحات-الرئيسية', 'الصفحات الرئيسية', 'الصفحات الرئيسية', NULL, NULL),
(2, 1, 'en', 'main-page', 'Main Page', 'Main Page', NULL, NULL),
(3, 2, 'ar', 'الخدمات', 'الخدمات', 'الخدمات', NULL, NULL),
(4, 2, 'en', 'services', 'Services', 'Services', NULL, NULL),
(5, 3, 'ar', 'قائمة-العملاء', 'قائمة العملاء', 'قائمة العملاء', NULL, NULL),
(6, 3, 'en', 'our-client', 'Our Client', 'Our Client', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
