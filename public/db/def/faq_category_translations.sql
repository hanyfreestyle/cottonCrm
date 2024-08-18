-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2024 at 08:10 PM
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
-- Dumping data for table `faq_category_translations`
--

INSERT INTO `faq_category_translations` (`id`, `category_id`, `locale`, `slug`, `name`, `des`, `g_title`, `g_des`) VALUES
(1, 1, 'ar', 'لماذا-نحن', 'لماذا نحن', '<p>لماذا نحن</p>', 'لماذا نحن', 'لماذا نحن'),
(2, 2, 'ar', 'الخدمات', 'الخدمات', '<p>الخدمات</p>', 'الخدمات', 'الخدمات'),
(3, 3, 'ar', 'تصميم-الشعارات', 'تصميم الشعارات', '<p>تصميم الشعارات</p>', NULL, NULL),
(4, 4, 'ar', 'تصميم-المواقع', 'تصميم المواقع', '<p>تصميم المواقع</p>', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
