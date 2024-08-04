-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2024 at 10:50 AM
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
-- Database: `cottton_crm`
--

--
-- Dumping data for table `crm_ticket`
--

INSERT INTO `crm_ticket` (`id`, `customer_id`, `open_type`, `state`, `follow_state`, `follow_date`, `user_id`, `sours_id`, `ads_id`, `device_id`, `brand_id`, `notes`, `notes_err`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 1, '2024-08-01 00:00:00', 2, 5, 1, 93, 12, 'ملاحظات', 'العطل المبدئى', '2024-08-02 08:56:19', '2024-08-03 10:47:13', NULL),
(2, 1, 1, 2, 5, '2024-08-02 00:00:00', 3, 7, 2, 94, 12, 'ملاحظات  2', 'العطل المبدئى 2', '2024-08-02 08:57:50', '2024-08-03 10:47:19', NULL),
(3, 1, 1, 1, 3, '2024-08-10 00:00:00', 3, 5, 2, 93, 14, 'العطل المبدئى', 'العطل المبدئى', '2024-08-02 09:01:34', '2024-08-03 10:47:19', NULL),
(4, 2, 1, 1, 4, '2024-08-02 00:00:00', 2, 5, 2, 93, 15, 'شسيشسيشس', 'شسيشسيشس', '2024-08-02 13:35:59', '2024-08-03 10:47:13', NULL),
(5, 3, 1, 1, 1, '2024-08-03 00:00:00', 2, 6, 1, 95, 13, 'ملاحظات تكتب هنا', 'العطل المبدئى يكتب هنا', '2024-08-03 16:44:06', '2024-08-03 16:44:06', NULL),
(6, 4, 1, 1, 1, '2024-08-04 00:00:00', 2, 6, 1, 93, 12, NULL, 'العطل المبدئى', '2024-08-04 06:17:17', '2024-08-04 06:22:22', NULL),
(7, 3, 1, 1, 1, '2024-08-05 00:00:00', NULL, 5, 2, 93, 14, NULL, 'العطل المبدئى', '2024-08-04 06:40:01', '2024-08-04 06:40:01', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
