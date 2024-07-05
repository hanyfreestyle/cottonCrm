-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 06:59 AM
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
-- Database: `cottton_test`
--

--
-- Dumping data for table `config_data`
--

INSERT INTO `config_data` (`id`, `old_id`, `cat_id`, `is_active`) VALUES
(1, 1, 'LeadCategory', 1),
(2, 174, 'LeadCategory', 1),
(3, 179, 'LeadCategory', 1),
(4, 193, 'LeadCategory', 1),
(5, 2, 'LeadSours', 1),
(6, 3, 'LeadSours', 1),
(7, 4, 'LeadSours', 1),
(8, 170, 'LeadSours', 1),
(9, 171, 'LeadSours', 1),
(10, 172, 'LeadSours', 1),
(11, 173, 'LeadSours', 1),
(12, 133, 'BrandName', 1),
(13, 134, 'BrandName', 1),
(14, 135, 'BrandName', 1),
(15, 136, 'BrandName', 1),
(16, 137, 'BrandName', 1),
(17, 138, 'BrandName', 1),
(18, 139, 'BrandName', 1),
(19, 140, 'BrandName', 1),
(20, 141, 'BrandName', 1),
(21, 142, 'BrandName', 1),
(22, 143, 'BrandName', 1),
(23, 144, 'BrandName', 1),
(24, 145, 'BrandName', 1),
(25, 146, 'BrandName', 1),
(26, 147, 'BrandName', 1),
(27, 148, 'BrandName', 1),
(28, 149, 'BrandName', 1),
(29, 150, 'BrandName', 1),
(30, 151, 'BrandName', 1),
(31, 152, 'BrandName', 1),
(32, 153, 'BrandName', 1),
(33, 154, 'BrandName', 1),
(34, 155, 'BrandName', 1),
(35, 156, 'BrandName', 1),
(36, 157, 'BrandName', 1),
(37, 158, 'BrandName', 1),
(38, 159, 'BrandName', 1),
(39, 160, 'BrandName', 1),
(40, 161, 'BrandName', 1),
(41, 162, 'BrandName', 1),
(42, 163, 'BrandName', 1),
(43, 164, 'BrandName', 1),
(44, 165, 'BrandName', 1),
(45, 166, 'BrandName', 1),
(46, 167, 'BrandName', 1),
(47, 168, 'BrandName', 1),
(48, 169, 'BrandName', 1),
(49, 188, 'BrandName', 1),
(50, 191, 'BrandName', 1),
(51, 192, 'BrandName', 1),
(52, 198, 'BrandName', 1),
(53, 202, 'BrandName', 1),
(54, 216, 'BrandName', 1),
(55, 221, 'BrandName', 1),
(56, 225, 'BrandName', 1),
(57, 227, 'BrandName', 1),
(58, 231, 'BrandName', 1),
(59, 232, 'BrandName', 1),
(60, 234, 'BrandName', 1),
(61, 240, 'BrandName', 1),
(62, 244, 'BrandName', 1),
(63, 245, 'BrandName', 1),
(64, 247, 'BrandName', 1),
(65, 249, 'BrandName', 1),
(66, 250, 'BrandName', 1),
(67, 251, 'BrandName', 1),
(68, 252, 'BrandName', 1),
(69, 255, 'BrandName', 1),
(70, 256, 'BrandName', 1),
(71, 257, 'BrandName', 1),
(72, 258, 'BrandName', 1),
(73, 259, 'BrandName', 1),
(74, 260, 'BrandName', 1),
(75, 262, 'BrandName', 1),
(76, 264, 'BrandName', 1),
(77, 265, 'BrandName', 1),
(78, 267, 'BrandName', 1),
(79, 269, 'BrandName', 1),
(80, 270, 'BrandName', 1),
(81, 272, 'BrandName', 1),
(82, 273, 'BrandName', 1),
(83, 274, 'BrandName', 1),
(84, 278, 'BrandName', 1),
(85, 281, 'BrandName', 1),
(86, 286, 'BrandName', 1),
(87, 287, 'BrandName', 1),
(88, 288, 'BrandName', 1),
(89, 289, 'BrandName', 1),
(90, 290, 'BrandName', 1),
(91, 294, 'BrandName', 1),
(92, 296, 'BrandName', 1),
(93, 52, 'DeviceType', 1),
(94, 53, 'DeviceType', 1),
(95, 54, 'DeviceType', 1),
(96, 55, 'DeviceType', 1),
(97, 56, 'DeviceType', 1),
(98, 57, 'DeviceType', 1),
(99, 58, 'DeviceType', 1),
(100, 180, 'DeviceType', 1),
(101, 181, 'DeviceType', 1),
(102, 182, 'DeviceType', 1),
(103, 183, 'DeviceType', 1),
(104, 184, 'DeviceType', 1),
(105, 185, 'DeviceType', 1),
(106, 186, 'DeviceType', 1),
(107, 187, 'DeviceType', 1),
(108, 195, 'DeviceType', 1),
(109, 200, 'DeviceType', 1),
(110, 208, 'DeviceType', 1),
(111, 210, 'DeviceType', 1),
(112, 212, 'DeviceType', 1),
(113, 215, 'DeviceType', 1),
(114, 276, 'DeviceType', 1),
(115, 283, 'DeviceType', 1),
(116, 285, 'DeviceType', 1),
(117, NULL, 'EvaluationCust', 1),
(118, NULL, 'EvaluationCust', 1),
(119, NULL, 'EvaluationCust', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
