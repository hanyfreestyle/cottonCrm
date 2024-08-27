-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2024 at 07:09 PM
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
-- Dumping data for table `crm_ticket_cash`
--

INSERT INTO `crm_ticket_cash` (`id`, `ticket_id`, `customer_id`, `follow_state`, `created_at`, `created_at_time`, `confirm_date`, `confirm_date_time`, `user_id`, `confirm_user_id`, `amount_type`, `pay_type`, `amount`, `amount_paid`) VALUES
(1, 1, 1, 6, '2024-08-25', '00:00:00', '2024-08-25', '16:50:16', 2, 1, 3, 1, '150.00', '150.00'),
(2, 6, 4, 6, '2024-08-25', '00:00:00', '2024-08-25', '16:50:22', 3, 1, 3, 1, '350.00', '350.00'),
(3, 2, 1, 6, '2024-08-26', '16:52:55', '2024-08-26', '19:35:46', 2, 1, 3, 1, '50.00', '50.00'),
(4, 3, 1, 6, '2024-08-26', '16:53:12', '2024-08-26', '19:35:51', 2, 1, 3, 1, '75.00', '75.00'),
(5, 7, 3, 6, '2024-08-26', '16:53:31', '2024-08-26', '19:36:05', 3, 1, 3, 1, '125.00', '125.00'),
(6, 9, 1, 6, '2024-08-27', '16:53:50', '2024-08-27', '19:35:56', 2, 1, 3, 1, '200.00', '200.00'),
(7, 4, 2, 6, '2024-08-27', '16:54:10', '2024-08-27', '19:36:09', 3, 1, 3, 1, '250.00', '250.00'),
(8, 5, 3, 6, '2024-08-27', '16:54:25', '2024-08-27', '19:36:13', 3, 1, 3, 1, '225.00', '225.00'),
(9, 8, 1, 6, '2024-08-27', '16:54:47', '2024-08-27', '19:36:00', 2, 1, 3, 1, '100.00', '100.00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
