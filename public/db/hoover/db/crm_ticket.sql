-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 12:34 PM
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

INSERT INTO `crm_ticket` (`id`, `customer_id`, `open_type`, `state`, `follow_state`, `follow_date`, `user_id`, `sours_id`, `ads_id`, `device_id`, `brand_id`, `notes`, `notes_err`, `close_date`, `cost`, `cost_service`, `deposit`, `cost_get`, `cost_service_get`, `deposit_get`, `review_state`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2024-08-02 00:00:00', 2, 5, 1, 93, 12, 'ملاحظات', 'العطل المبدئى', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-02 08:56:19', '2024-08-03 10:47:13'),
(2, 1, 1, 1, 1, '2024-08-02 00:00:00', 3, 7, 2, 94, 12, 'ملاحظات  2', 'العطل المبدئى 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-02 08:57:50', '2024-08-03 10:47:19'),
(3, 1, 1, 1, 1, '2024-08-09 00:00:00', 3, 5, 2, 93, 14, 'العطل المبدئى', 'العطل المبدئى', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-09 09:01:34', '2024-08-03 10:47:19'),
(4, 2, 1, 1, 1, '2024-08-19 00:00:00', 2, 5, 2, 93, 15, 'شسيشسيشس', 'شسيشسيشس', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-18 21:00:00', '2024-08-03 10:47:13'),
(5, 3, 1, 1, 1, '2024-08-22 00:00:00', 2, 6, 1, 95, 13, 'ملاحظات تكتب هنا', 'العطل المبدئى يكتب هنا', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-22 16:44:06', '2024-08-03 16:44:06'),
(6, 4, 1, 1, 1, '2024-08-24 00:00:00', 2, 6, 1, 93, 12, NULL, 'العطل المبدئى', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-24 06:17:17', '2024-08-04 06:22:22'),
(7, 3, 1, 1, 1, '2024-08-26 00:00:00', 2, 5, 2, 93, 14, NULL, 'العطل المبدئى', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-08-26 06:40:01', '2024-08-04 06:40:01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
