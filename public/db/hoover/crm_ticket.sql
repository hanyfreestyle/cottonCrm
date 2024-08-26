-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 11:53 AM
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
-- Dumping data for table `crm_ticket`
--

INSERT INTO `crm_ticket` (`id`, `customer_id`, `open_type`, `state`, `follow_state`, `follow_date`, `user_id`, `sours_id`, `ads_id`, `device_id`, `brand_id`, `notes`, `notes_err`, `close_date`, `cost`, `deposit`, `review_state`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 6, '2024-08-01 00:00:00', 2, 5, 1, 93, 12, 'ملاحظات', 'العطل المبدئى', '2024-08-26 12:46:37', NULL, NULL, 0, '2024-08-02 08:56:19', '2024-08-26 08:46:37'),
(3, 1, 1, 2, 5, '2024-08-10 00:00:00', 3, 5, 2, 93, 14, 'العطل المبدئى', 'العطل المبدئى', '2024-08-26 12:47:50', NULL, NULL, 0, '2024-08-02 09:01:34', '2024-08-26 08:47:50'),
(4, 2, 1, 2, 5, '2024-08-02 00:00:00', 2, 5, 2, 93, 15, 'شسيشسيشس', 'شسيشسيشس', '2024-08-26 12:48:12', NULL, NULL, 0, '2024-08-02 13:35:59', '2024-08-26 08:48:12'),
(5, 3, 1, 2, 6, '2024-08-03 00:00:00', 2, 6, 1, 95, 13, 'ملاحظات تكتب هنا', 'العطل المبدئى يكتب هنا', '2024-08-26 12:46:58', NULL, NULL, 0, '2024-08-03 16:44:06', '2024-08-26 08:46:58'),
(6, 4, 1, 2, 6, '2024-08-04 00:00:00', 2, 6, 1, 93, 12, NULL, 'العطل المبدئى', '2024-08-26 12:47:18', NULL, NULL, 0, '2024-08-04 06:17:17', '2024-08-26 08:47:18'),
(7, 3, 1, 2, 6, '2024-08-26 00:00:00', 2, 5, 2, 93, 14, NULL, 'العطل المبدئى', '2024-08-26 12:50:12', NULL, NULL, 0, '2024-08-04 06:40:01', '2024-08-26 08:50:12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
