-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2024 at 08:02 AM
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
-- Dumping data for table `faq_tags_lang`
--

INSERT INTO `faq_tags_lang` (`id`, `tag_id`, `locale`, `slug`, `name`) VALUES
(1, 1, 'ar', 'خدمة-العملاء', 'خدمة العملاء'),
(2, 2, 'ar', 'الدعم-الفنى', 'الدعم الفنى'),
(3, 3, 'ar', 'المبيعات', 'المبيعات'),
(4, 4, 'ar', 'خدمة-حجز-النطاق', 'خدمة حجز النطاق'),
(5, 5, 'ar', 'خدمة-الاستضافة', 'خدمة الاستضافة'),
(6, 6, 'ar', 'الاشهار-على-محركات-البحث', 'الاشهار على محركات البحث');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
