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
-- Dumping data for table `crm_ticket`
--

INSERT INTO `crm_ticket` (`id`, `customer_id`, `open_type`, `state`, `follow_state`, `follow_date`, `user_id`, `sours_id`, `ads_id`, `device_id`, `brand_id`, `notes`, `notes_err`, `close_date`, `review_state`, `old_id`, `old_customer_id`, `old_sours_id`, `old_ads_id`, `old_device_id`, `old_brand_id`, `done_price`, `done_price_prepaid`, `done_notes`, `reject_notes`, `cancellation_notes`, `created_at`, `updated_at`, `uuid`) VALUES
(1, 1, 1, 2, 5, NULL, 2, 6, 2, 96, 12, NULL, 'العطل', '2024-09-01', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-15 15:11:27', '2024-09-01 15:18:00', 'cc5dc802-8c12-41bf-9a57-131ea4e53074'),
(2, 1, 1, 2, 6, NULL, 2, 5, 1, 95, 12, NULL, 'العطل', '2024-09-01', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-01 16:10:57', '2024-09-01 16:11:44', '66fa82e3-e2d4-4e32-accd-7224fd9d3443');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
