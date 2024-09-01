-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2024 at 06:10 PM
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
-- Dumping data for table `crm_customers`
--

INSERT INTO `crm_customers` (`id`, `old_id`, `evaluation_id`, `gender_id`, `type_id`, `name`, `mobile`, `mobile_code`, `mobile_2`, `mobile_2_code`, `phone`, `phone_code`, `whatsapp`, `whatsapp_code`, `email`, `notes`, `is_active`, `created_at`, `updated_at`, `deleted_at`, `uuid`) VALUES
(1, NULL, NULL, 1, NULL, 'هانى محمد محمد درويش', '01221563252', 'eg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-09-01 15:07:51', '2024-09-01 15:07:51', NULL, 'e6809509-1ef8-4e88-a136-864c63f95776');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
