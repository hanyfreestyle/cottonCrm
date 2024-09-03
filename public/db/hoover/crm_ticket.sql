-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 02:07 PM
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
(1, 1, 1, 2, 6, NULL, 2, 5, 1, 95, 12, NULL, 'العطل', '2024-09-03', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-03 07:08:33', '2024-09-03 07:31:53', '55f8c599-713a-4708-861f-eb07d51e6a82'),
(4, 1, 1, 2, 2, NULL, 2, 5, 1, 95, 12, NULL, 'العطل', '2024-09-03', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-03 07:10:28', '2024-09-03 07:33:10', '18a45d9d-07c5-45bf-bbdb-4394a39606b1'),
(5, 1, 1, 1, 1, '2024-09-03', 2, 5, 1, 96, 12, 'ملاحظات', 'العطل', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-03 07:31:00', '2024-09-03 07:31:00', '61ec1a20-da4c-43bd-9edb-c82d547dd2ef');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
