-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 04:24 PM
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
-- Dumping data for table `data_area`
--

INSERT INTO `data_area` (`id`, `old_id`, `country_id`, `city_id`, `is_active`, `postion`, `photo`, `photo_thum_1`) VALUES
(1, 5, 66, 4, 1, 0, NULL, NULL),
(2, 6, 66, 4, 1, 0, NULL, NULL),
(3, 7, 66, 4, 1, 0, NULL, NULL),
(4, 8, 66, 4, 1, 0, NULL, NULL),
(5, 9, 66, 4, 1, 0, NULL, NULL),
(6, 10, 66, 4, 1, 0, NULL, NULL),
(7, 11, 66, 4, 1, 0, NULL, NULL),
(8, 12, 66, 4, 1, 0, NULL, NULL),
(9, 13, 66, 4, 1, 0, NULL, NULL),
(10, 14, 66, 4, 1, 0, NULL, NULL),
(11, 15, 66, 4, 1, 0, NULL, NULL),
(12, 16, 66, 4, 1, 0, NULL, NULL),
(13, 17, 66, 4, 1, 0, NULL, NULL),
(14, 18, 66, 4, 1, 0, NULL, NULL),
(15, 19, 66, 4, 1, 0, NULL, NULL),
(16, 20, 66, 4, 1, 0, NULL, NULL),
(17, 21, 66, 4, 1, 0, NULL, NULL),
(18, 22, 66, 4, 1, 0, NULL, NULL),
(19, 23, 66, 4, 1, 0, NULL, NULL),
(20, 24, 66, 4, 1, 0, NULL, NULL),
(21, 25, 66, 4, 1, 0, NULL, NULL),
(22, 26, 66, 4, 1, 0, NULL, NULL),
(23, 27, 66, 4, 1, 0, NULL, NULL),
(24, 28, 66, 4, 1, 0, NULL, NULL),
(25, 29, 66, 4, 1, 0, NULL, NULL),
(26, 30, 66, 4, 1, 0, NULL, NULL),
(27, 31, 66, 4, 1, 0, NULL, NULL),
(28, 32, 66, 4, 1, 0, NULL, NULL),
(29, 33, 66, 4, 1, 0, NULL, NULL),
(30, 34, 66, 4, 1, 0, NULL, NULL),
(31, 35, 66, 4, 1, 0, NULL, NULL),
(32, 36, 66, 4, 1, 0, NULL, NULL),
(33, 37, 66, 4, 1, 0, NULL, NULL),
(34, 38, 66, 4, 1, 0, NULL, NULL),
(35, 39, 66, 4, 1, 0, NULL, NULL),
(36, 40, 66, 4, 1, 0, NULL, NULL),
(37, 41, 66, 4, 1, 0, NULL, NULL),
(38, 42, 66, 4, 1, 0, NULL, NULL),
(39, 43, 66, 4, 1, 0, NULL, NULL),
(40, 44, 66, 4, 1, 0, NULL, NULL),
(41, 45, 66, 4, 1, 0, NULL, NULL),
(42, 46, 66, 4, 1, 0, NULL, NULL),
(43, 47, 66, 4, 1, 0, NULL, NULL),
(44, 48, 66, 4, 1, 0, NULL, NULL),
(45, 49, 66, 4, 1, 0, NULL, NULL),
(46, 50, 66, 4, 1, 0, NULL, NULL),
(47, 51, 66, 4, 1, 0, NULL, NULL),
(48, 177, 66, 1, 1, 0, NULL, NULL),
(49, 178, 66, 1, 1, 0, NULL, NULL),
(50, 190, 66, 10, 1, 0, NULL, NULL),
(51, 194, 66, 4, 1, 0, NULL, NULL),
(52, 196, 66, 4, 1, 0, NULL, NULL),
(53, 197, 66, 4, 1, 0, NULL, NULL),
(54, 199, 66, 4, 1, 0, NULL, NULL),
(55, 201, 66, 4, 1, 0, NULL, NULL),
(56, 203, 66, 4, 1, 0, NULL, NULL),
(57, 204, 66, 4, 1, 0, NULL, NULL),
(58, 205, 66, 4, 1, 0, NULL, NULL),
(59, 206, 66, 1, 1, 0, NULL, NULL),
(60, 207, 66, 4, 1, 0, NULL, NULL),
(61, 209, 66, 4, 1, 0, NULL, NULL),
(62, 211, 66, 4, 1, 0, NULL, NULL),
(63, 213, 66, 4, 1, 0, NULL, NULL),
(64, 214, 66, 4, 1, 0, NULL, NULL),
(65, 217, 66, 4, 1, 0, NULL, NULL),
(66, 218, 66, 4, 1, 0, NULL, NULL),
(67, 219, 66, 4, 1, 0, NULL, NULL),
(68, 220, 66, 4, 1, 0, NULL, NULL),
(69, 222, 66, 4, 1, 0, NULL, NULL),
(70, 223, 66, 4, 1, 0, NULL, NULL),
(71, 224, 66, 4, 1, 0, NULL, NULL),
(72, 226, 66, 4, 1, 0, NULL, NULL),
(73, 228, 66, 4, 1, 0, NULL, NULL),
(74, 229, 66, 4, 1, 0, NULL, NULL),
(75, 230, 66, 4, 1, 0, NULL, NULL),
(76, 233, 66, 4, 1, 0, NULL, NULL),
(77, 235, 66, 4, 1, 0, NULL, NULL),
(78, 236, 66, 4, 1, 0, NULL, NULL),
(79, 237, 66, 4, 1, 0, NULL, NULL),
(80, 238, 66, 4, 1, 0, NULL, NULL),
(81, 239, 66, 4, 1, 0, NULL, NULL),
(82, 241, 66, 4, 1, 0, NULL, NULL),
(83, 242, 66, 1, 1, 0, NULL, NULL),
(84, 243, 66, 4, 1, 0, NULL, NULL),
(85, 246, 66, 4, 1, 0, NULL, NULL),
(86, 248, 66, 4, 1, 0, NULL, NULL),
(87, 253, 66, 4, 1, 0, NULL, NULL),
(88, 254, 66, 4, 1, 0, NULL, NULL),
(89, 261, 66, 4, 1, 0, NULL, NULL),
(90, 263, 66, 4, 1, 0, NULL, NULL),
(91, 266, 66, 4, 1, 0, NULL, NULL),
(92, 268, 66, 4, 1, 0, NULL, NULL),
(93, 271, 66, 4, 1, 0, NULL, NULL),
(94, 275, 66, 4, 1, 0, NULL, NULL),
(95, 277, 66, 4, 1, 0, NULL, NULL),
(96, 279, 66, 4, 1, 0, NULL, NULL),
(97, 280, 66, 4, 1, 0, NULL, NULL),
(98, 282, 66, 4, 1, 0, NULL, NULL),
(99, 284, 66, 4, 1, 0, NULL, NULL),
(100, 291, 66, 4, 1, 0, NULL, NULL),
(101, 292, 66, 4, 1, 0, NULL, NULL),
(102, 293, 66, 4, 1, 0, NULL, NULL),
(103, 295, 66, 4, 1, 0, NULL, NULL),
(104, 297, 66, 4, 1, 0, NULL, NULL),
(105, 298, 66, 4, 1, 0, NULL, NULL),
(106, 299, 66, 4, 1, 0, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
