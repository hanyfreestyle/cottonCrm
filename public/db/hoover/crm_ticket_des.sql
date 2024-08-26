-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 11:54 AM
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
(1, '2024-08-26 12:46:37', NULL, 1, 1, 6, 'سبب الرفض للتذكرة 1'),
(2, '2024-08-26 12:46:58', NULL, 5, 1, 6, 'سبب الرفض للتذكرة 2'),
(3, '2024-08-26 12:47:18', NULL, 6, 1, 6, 'سبب الرفض للتذكرة 3'),
(4, '2024-08-26 12:47:50', NULL, 3, 1, 5, 'سيتم اغلاق المتابعة برجاء ذكر سبب الالغاء 3'),
(5, '2024-08-26 12:48:12', NULL, 4, 1, 5, 'سيتم اغلاق المتابعة برجاء ذكر سبب الالغاء 4'),
(6, '2024-08-26 12:50:12', NULL, 7, 1, 6, 'علشان الرفض يبقى اكتر');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
