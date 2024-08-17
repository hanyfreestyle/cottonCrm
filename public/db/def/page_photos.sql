-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 10:18 PM
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
-- Dumping data for table `page_photos`
--

INSERT INTO `page_photos` (`id`, `page_id`, `photo`, `photo_thum_1`, `photo_thum_2`, `position`, `print_photo`, `is_default`) VALUES
(2, 1, 'images/pages/1/1723818777_OaqkOAgTrEhN0Rh_.jpg', NULL, NULL, 0, 2, 0),
(3, 1, 'images/pages/1/1723818793_nEDAiLAIcRXtmNm_.webp', 'images/pages/1/1723818793_tWgeu4Ok7ZjqWGV_.webp', NULL, 0, 2, 0),
(4, 1, 'images/pages/1/1723818793_NIC2jB5UI75gSFy_.webp', 'images/pages/1/1723818793_gQ56gzcXPrXfo6j_.webp', NULL, 0, 2, 0),
(5, 1, 'images/pages/1/1723818793_XYnrPuPloAcbk4y_.webp', 'images/pages/1/1723818793_BMoQjkHsv6WJaFY_.webp', NULL, 0, 2, 0),
(6, 1, 'images/pages/1/1723818794_CwRjugWsGM9zWE5_.webp', 'images/pages/1/1723818794_jwuoMQ7mjYlj1tg_.webp', NULL, 0, 2, 0),
(7, 1, 'images/pages/1/1723818794_SThN6SRYHxuS4Ez_.webp', 'images/pages/1/1723818795_0HQXGqv9VHi7hPG_.webp', NULL, 0, 2, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
