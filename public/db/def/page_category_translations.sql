-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2024 at 07:53 AM
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
-- Database: `a_cart`
--

--
-- Dumping data for table `page_category_translations`
--

INSERT INTO `page_category_translations` (`id`, `category_id`, `locale`, `slug`, `name`, `des`, `g_title`, `g_des`) VALUES
(1, 1, 'ar', 'الصفحات-الرئيسية', 'الصفحات الرئيسية', 'الصفحات الرئيسية', 'الصفحات الرئيسية', 'الصفحات الرئيسية'),
(2, 1, 'en', 'main-cat', 'Main Cat', 'Main Cat', 'Main Cat', 'Main Cat'),
(3, 2, 'ar', 'محتوى-المنتجات', 'محتوى المنتجات', 'محتوى المنتجات', 'محتوى المنتجات', 'محتوى المنتجات'),
(4, 2, 'en', 'محتوى-المنتجات', 'محتوى المنتجات', 'محتوى المنتجات', 'محتوى المنتجات', 'محتوى المنتجات');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
