-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2024 at 04:54 PM
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
-- Dumping data for table `config_app_menu_translations`
--

INSERT INTO `config_app_menu_translations` (`id`, `menu_id`, `locale`, `url`, `label`, `icon`, `title`) VALUES
(1, 2, 'ar', 'https://freestyle4u.net/et8/public/EtmanShop/CartView/?mobile=1', 'السلة', 60562, 1),
(2, 1, 'ar', 'https://freestyle4u.net/et8/public/EtmanShop/profile/?mobile=1', 'الملف الشخصي', 58519, 1),
(3, 3, 'ar', 'https://freestyle4u.net/et8/public/اتصل-بنا/?mobile=1', 'اتصل بنا', 57738, 1),
(4, 4, 'ar', 'https://freestyle4u.net/et8/public/EtmanShop/عروض-تجار-الجملة/?mobile=1', 'عروض الجمله', 61828, 1),
(5, 5, 'ar', 'https://freestyle4u.net/et8/public/EtmanShop//?mobile=1', 'الرئيسية', 58519, 1),
(6, 1, 'en', 'https://freestyle4u.net/et8/public/EtmanShop/profile/?mobile=1', 'Profile', 58519, 1),
(7, 2, 'en', 'https://freestyle4u.net/et8/public/EtmanShop/CartView/?mobile=1', 'Cart', 60562, 1),
(8, 5, 'en', 'https://freestyle4u.net/et8/public/EtmanShop//?mobile=1', 'Home', 58519, 1),
(9, 4, 'en', 'https://freestyle4u.net/et8/public/EtmanShop/عروض-تجار-الجملة/?mobile=1', 'Offers', 61828, 1),
(10, 3, 'en', 'https://freestyle4u.net/et8/public/اتصل-بنا/?mobile=1', 'Contact Us', 57738, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
