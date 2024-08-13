-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2024 at 10:49 AM
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
-- Dumping data for table `crm_customers`
--

INSERT INTO `crm_customers` (`id`, `evaluation_id`, `gender_id`, `name`, `mobile`, `mobile_code`, `mobile_2`, `mobile_2_code`, `phone`, `phone_code`, `whatsapp`, `whatsapp_code`, `email`, `notes`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 119, 1, 'هانى محمد محمد ددرويش', '01221563252', 'eg', '01221563253', 'eg', '4810303', 'eg', '01221563252', 'eg', 'hany@hanydarwish.com', NULL, 1, '2024-07-29 05:59:16', '2024-07-29 06:04:52', NULL),
(2, NULL, NULL, 'كريم درويش', '01221563259', 'eg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-08-03 03:54:41', '2024-08-03 03:54:41', NULL),
(3, NULL, NULL, 'احمد عباس', '01221563255', 'eg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-08-03 16:42:43', '2024-08-03 16:42:43', NULL),
(4, NULL, NULL, 'عصام عبد المنعم', '01095801300', 'eg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-08-04 05:48:00', '2024-08-04 07:47:55', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
