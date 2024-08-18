-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2024 at 08:33 AM
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
(1, 1, 'ar', 'خدمات-الدعم-الفنى', 'خدمات الدعم الفنى', '<p>خدمات الدعم الفنى</p>', NULL, NULL),
(2, 2, 'ar', 'خدمات-التجارة-الالكترونية', 'خدمات التجارة الالكترونية', '<p>خدمات التجارة الالكترونية</p>', NULL, NULL),
(3, 3, 'ar', 'خدمات-الورد-بريس', 'خدمات الورد بريس', '<p>خدمات الورد بريس</p>', NULL, NULL),
(4, 4, 'ar', 'العناوين-والفروع', 'العناوين والفروع', '<p>العناوين والفروع</p>', NULL, NULL),
(5, 5, 'ar', 'الاستفسارت-والشكاوى', 'الاستفسارت والشكاوى', '<p>الاستفسارت والشكاوى</p>', NULL, NULL),
(6, 6, 'ar', 'خدمات-التواصل-عن-بعد', 'خدمات التواصل عن بعد', '<p>خدمات التواصل عن بعد</p>', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
