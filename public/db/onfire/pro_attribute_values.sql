-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 06:03 PM
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
-- Database: `cottton_shop_web`
--

--
-- Dumping data for table `pro_attribute_values`
--

INSERT INTO `pro_attribute_values` (`id`, `attribute_id`, `old_id`, `is_active`, `postion`) VALUES
(1, 1, NULL, 1, 0),
(2, 1, NULL, 1, 0),
(3, 1, NULL, 1, 0),
(4, 2, NULL, 1, 0),
(5, 2, NULL, 1, 0),
(6, 2, NULL, 1, 0),
(7, 2, NULL, 1, 0),
(8, 2, NULL, 1, 0),
(9, 2, NULL, 1, 0),
(10, 2, NULL, 1, 0),
(11, 2, NULL, 1, 0),
(12, 2, NULL, 1, 0),
(13, 2, NULL, 1, 0),
(14, 2, NULL, 1, 0),
(15, 2, NULL, 1, 0),
(16, 3, NULL, 1, 0),
(17, 3, NULL, 1, 0),
(18, 3, NULL, 1, 0),
(19, 3, NULL, 1, 0),
(20, 3, NULL, 1, 0),
(21, 3, NULL, 1, 0),
(22, 3, NULL, 1, 0),
(23, 3, NULL, 1, 0),
(24, 3, NULL, 1, 0),
(25, 3, NULL, 1, 0),
(26, 3, NULL, 1, 0),
(27, 3, NULL, 1, 0),
(28, 3, NULL, 1, 0),
(29, 3, NULL, 1, 0),
(30, 3, NULL, 1, 0),
(31, 3, NULL, 1, 0),
(32, 3, NULL, 1, 0),
(33, 3, NULL, 1, 0),
(34, 3, NULL, 1, 0),
(35, 3, NULL, 1, 0),
(36, 3, NULL, 1, 0),
(37, 3, NULL, 1, 0),
(38, 3, NULL, 1, 0),
(39, 3, NULL, 1, 0),
(40, 3, NULL, 1, 0),
(41, 3, NULL, 1, 0),
(42, 3, NULL, 1, 0),
(43, 3, NULL, 1, 0),
(44, 3, NULL, 1, 0),
(45, 3, NULL, 1, 0),
(46, 3, NULL, 1, 0),
(47, 3, NULL, 1, 0),
(48, 3, NULL, 1, 0),
(49, 3, NULL, 1, 0),
(50, 3, NULL, 1, 0),
(51, 3, NULL, 1, 0),
(52, 4, NULL, 1, 0),
(53, 4, NULL, 1, 0),
(54, 4, NULL, 1, 0),
(55, 4, NULL, 1, 0),
(56, 4, NULL, 1, 0),
(57, 4, NULL, 1, 0),
(58, 4, NULL, 1, 0),
(59, 4, NULL, 1, 0),
(60, 4, NULL, 1, 0),
(61, 4, NULL, 1, 0),
(62, 5, NULL, 1, 0),
(63, 5, NULL, 1, 0),
(64, 5, NULL, 1, 0),
(65, 5, NULL, 1, 0),
(66, 5, NULL, 1, 0),
(67, 5, NULL, 1, 0),
(68, 5, NULL, 1, 0),
(69, 4, NULL, 1, 0),
(70, 4, NULL, 1, 0),
(71, 4, NULL, 1, 0),
(72, 4, NULL, 1, 0),
(73, 4, NULL, 1, 0),
(74, 4, NULL, 1, 0),
(75, 4, NULL, 1, 0),
(76, 4, NULL, 1, 0),
(77, 4, NULL, 1, 0),
(78, 5, NULL, 1, 0),
(79, 5, NULL, 1, 0),
(80, 4, NULL, 1, 0),
(81, 5, NULL, 1, 0),
(82, 4, NULL, 1, 0),
(83, 5, NULL, 1, 0),
(84, 4, NULL, 1, 0),
(85, 4, NULL, 1, 0),
(86, 4, NULL, 1, 0),
(87, 4, NULL, 1, 0),
(88, 4, NULL, 1, 0),
(89, 4, NULL, 1, 0),
(90, 5, NULL, 1, 0),
(91, 4, NULL, 1, 0),
(92, 4, NULL, 1, 0),
(93, 4, NULL, 1, 0),
(94, 4, NULL, 1, 0),
(95, 4, NULL, 1, 0),
(96, 4, NULL, 1, 0),
(97, 4, NULL, 1, 0),
(98, 4, NULL, 1, 0),
(99, 4, NULL, 1, 0),
(100, 4, NULL, 1, 0),
(101, 4, NULL, 1, 0),
(102, 4, NULL, 1, 0),
(103, 4, NULL, 1, 0),
(104, 3, NULL, 1, 0),
(105, 3, NULL, 1, 0),
(106, 2, NULL, 1, 0),
(107, 2, NULL, 1, 0),
(108, 2, NULL, 1, 0),
(109, 2, NULL, 1, 0),
(110, 2, NULL, 1, 0),
(111, 2, NULL, 1, 0),
(112, 2, NULL, 1, 0),
(113, 2, NULL, 1, 0),
(114, 2, NULL, 1, 0),
(115, 2, NULL, 1, 0),
(116, 2, NULL, 1, 0),
(117, 5, NULL, 1, 0),
(118, 2, NULL, 1, 0),
(119, 5, NULL, 1, 0),
(120, 5, NULL, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
