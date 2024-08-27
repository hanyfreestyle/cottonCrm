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
-- Dumping data for table `crm_ticket`
--

INSERT INTO `crm_ticket` (`id`, `customer_id`, `open_type`, `state`, `follow_state`, `follow_date`, `user_id`, `sours_id`, `ads_id`, `device_id`, `brand_id`, `notes`, `notes_err`, `close_date`, `review_state`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 6, NULL, 2, 5, 1, 93, 12, 'ملاحظات', 'العطل المبدئى', '2024-08-27 10:42:12', 0, '2024-08-02 08:56:19', '2024-08-27 06:42:12'),
(2, 1, 1, 2, 6, NULL, 3, 7, 2, 94, 12, 'ملاحظات  2', 'العطل المبدئى 2', '2024-08-27 16:52:55', 0, '2024-08-02 08:57:50', '2024-08-27 12:52:55'),
(3, 1, 1, 2, 6, NULL, 3, 5, 2, 93, 14, 'العطل المبدئى', 'العطل المبدئى', '2024-08-27 16:53:12', 0, '2024-08-09 09:01:34', '2024-08-27 12:53:12'),
(4, 2, 1, 2, 6, NULL, 2, 5, 2, 93, 15, 'شسيشسيشس', 'شسيشسيشس', '2024-08-27 16:54:10', 0, '2024-08-18 21:00:00', '2024-08-27 12:54:10'),
(5, 3, 1, 2, 6, NULL, 2, 6, 1, 95, 13, 'ملاحظات تكتب هنا', 'العطل المبدئى يكتب هنا', '2024-08-27 16:54:25', 0, '2024-08-22 16:44:06', '2024-08-27 12:54:25'),
(6, 4, 1, 2, 6, NULL, 2, 6, 1, 93, 12, NULL, 'العطل المبدئى', '2024-08-27 10:44:12', 0, '2024-08-24 06:17:17', '2024-08-27 06:44:12'),
(7, 3, 1, 2, 6, NULL, 2, 5, 2, 93, 14, NULL, 'العطل المبدئى', '2024-08-27 16:53:31', 0, '2024-08-26 06:40:01', '2024-08-27 12:53:31'),
(8, 1, 1, 2, 6, NULL, 2, 11, 4, 102, 15, NULL, 'العطل', '2024-08-27 16:54:47', 0, '2024-08-26 14:00:53', '2024-08-27 12:54:47'),
(9, 1, 1, 2, 6, NULL, 3, 6, 3, 95, 14, 'ملاحظات ملاحظات ملاحظات', 'العطل العطل العطل العطل', '2024-08-27 16:53:50', 0, '2024-08-26 15:51:54', '2024-08-27 12:53:50');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
