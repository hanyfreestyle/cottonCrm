-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2024 at 09:46 AM
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

INSERT INTO `crm_ticket_cash` (`id`, `ticket_id`, `customer_id`, `follow_state`, `created_at`, `confirm_date`, `user_id`, `confirm_user_id`, `amount_type`, `pay_type`, `amount`, `amount_paid`, `des`) VALUES
(1, 1, 1, 6, '2024-08-27 10:42:12', NULL, 1, NULL, 3, 1, '150.00', NULL, 'سبب الرفض'),
(2, 6, 4, 6, '2024-08-27 10:44:12', NULL, 1, NULL, 3, 1, '350.00', NULL, 'مصاريف كشف');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
