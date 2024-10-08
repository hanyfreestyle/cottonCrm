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
-- Dumping data for table `crm_customers_address`
--

INSERT INTO `crm_customers_address` (`id`, `uuid`, `is_default`, `customer_id`, `country_id`, `city_id`, `area_id`, `address`, `floor`, `unit_num`, `post_code`, `latitude`, `longitude`) VALUES
(1, 'c4290c63-054c-479c-b8e5-856c0eb1ba1a', 1, 1, 66, 4, 1, '29 شارع الشيخ محمد عبده الجمرك', '5', '1', '21111', '12.22222', '12.2222'),
(2, '586a1ca5-3528-484f-95f6-93247eeecac0', 1, 2, 66, 1, 48, 'التجمع الخامس', NULL, NULL, NULL, NULL, NULL),
(3, '240496ed-4bf4-40e7-bb3b-b5b70d0936ff', 1, 3, 66, 1, 49, 'العاصمة الادارية', '14', '5', NULL, NULL, NULL),
(4, '90d611b0-0422-4487-bc70-460e209ab8b9', 1, 4, 66, 4, 8, '6 شارع حسين كامل محمود بجوار نفق الابراهيمية', '5', '6', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
