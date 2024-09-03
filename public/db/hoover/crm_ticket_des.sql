-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 02:08 PM
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
-- Database: `app_crm_hoover`
--

--
-- Dumping data for table `crm_ticket_des`
--

INSERT INTO `crm_ticket_des` (`id`, `created_at`, `follow_date`, `ticket_id`, `user_id`, `follow_state`, `des`) VALUES
(1, '2024-09-03 11:31:53', NULL, 1, 2, 6, 'مصاريف الكشف'),
(2, '2024-09-03 11:32:47', '2024-09-03 00:00:00', 4, 2, 3, 'قطع الغيار المطلوبة'),
(3, '2024-09-03 11:33:10', NULL, 4, 2, 2, 'الاعمال المنفذة');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
