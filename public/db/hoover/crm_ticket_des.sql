-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 12:43 PM
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
(1, '2024-08-26 13:36:36', NULL, 7, 1, 6, 'العميل مش مستعد للتكالفه'),
(2, '2024-08-26 13:37:51', NULL, 1, 1, 6, 'العميل مش مستعد للتكالفه'),
(3, '2024-08-26 13:38:19', NULL, 6, 1, 6, 'سبب الرفض'),
(4, '2024-08-26 13:39:19', NULL, 3, 1, 6, 'سبب الرفض 100'),
(5, '2024-08-26 13:39:33', NULL, 2, 1, 5, 'العميل مسافر'),
(6, '2024-08-26 13:39:49', NULL, 4, 1, 5, 'العميل مش بيرد'),
(7, '2024-08-26 13:41:29', NULL, 5, 1, 5, 'أجل وقال لما أتصل تانى');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
