-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2024 at 04:04 PM
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
-- Database: `app_crm`
--

--
-- Dumping data for table `crm_ticket_des`
--

INSERT INTO `crm_ticket_des` (`id`, `created_at`, `follow_date`, `ticket_id`, `user_id`, `follow_state`, `des`) VALUES
(1, '2024-08-27 10:42:12', NULL, 1, 1, 6, 'سبب الرفض'),
(2, '2024-08-27 10:44:12', NULL, 6, 1, 6, 'مصاريف كشف'),
(3, '2024-08-27 16:52:55', NULL, 2, 1, 6, 'سيتم اغلاق المتابعة برجاء ذكر سبب الرفض'),
(4, '2024-08-27 16:53:12', NULL, 3, 1, 6, 'سيتم اغلاق المتابعة برجاء ذكر سبب الرفض75'),
(5, '2024-08-27 16:53:31', NULL, 7, 1, 6, 'سيتم اغلاق المتابعة برجاء ذكر سبب الرفض 125'),
(6, '2024-08-27 16:53:50', NULL, 9, 1, 6, 'سيتم اغلاق المتابعة برجاء ذكر سبب الرفض'),
(7, '2024-08-27 16:54:10', NULL, 4, 1, 6, 'سيتم اغلاق المتابعة برجاء ذكر سبب الرفض'),
(8, '2024-08-27 16:54:25', NULL, 5, 1, 6, 'سيتم اغلاق المتابعة برجاء ذكر سبب الرفض'),
(9, '2024-08-27 16:54:47', NULL, 8, 1, 6, 'سيتم اغلاق المتابعة برجاء ذكر سبب الرفض');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
