-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2024 at 07:14 PM
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
-- Dumping data for table `crm_ticket_cash`
--

INSERT INTO `crm_ticket_cash` (`id`, `ticket_id`, `customer_id`, `follow_state`, `created_at`, `created_at_time`, `confirm_date`, `confirm_date_time`, `user_id`, `confirm_user_id`, `amount_type`, `pay_type`, `amount`, `amount_paid`) VALUES
(1, 2, 1, 6, '2024-09-01', '20:11:44', '2024-09-01', '20:13:35', 2, 1, 3, 1, '150.00', '150.00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
