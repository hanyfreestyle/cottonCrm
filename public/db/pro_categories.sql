-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 01:12 PM
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
-- Database: `cottton_backup`
--

--
-- Dumping data for table `pro_categories`
--

INSERT INTO `pro_categories` (`id`, `parent_id`, `old_id`, `old_parent`, `deep`, `photo`, `photo_thum_1`, `icon`, `is_active`, `postion`, `product_count`, `created_at`, `updated_at`) VALUES
(1, NULL, 16, 0, 0, 'images/category/1/levels-YQZVPMjlJ8.webp', 'images/category/1/levels-uMUESGu1eR.webp', NULL, 1, 0, 236, '2024-03-08 07:09:41', '2024-04-27 06:06:46'),
(2, 1, 229, 0, 1, NULL, NULL, NULL, 1, 0, 9, '2024-03-08 07:09:41', '2024-05-03 06:08:04'),
(3, NULL, 230, 0, 0, 'wp-content/uploads/2023/10/33.jpg', 'wp-content/uploads/2023/10/33.jpg', NULL, 1, 0, 66, '2024-03-08 07:09:41', '2024-03-08 07:09:41'),
(4, NULL, 231, 0, 0, 'images/category/4/protection-covers-tXKlhHGOL5.webp', 'images/category/4/protection-covers-qrkkqnS8hJ.webp', NULL, 1, 0, 10, '2024-03-08 07:09:41', '2024-04-27 06:16:08'),
(5, NULL, 232, 0, 0, 'images/category/5/blanket-BnF2rxg8eR.webp', 'images/category/5/blanket-Z3SZU48baC.webp', NULL, 1, 0, 131, '2024-03-08 07:09:41', '2024-04-27 06:10:33'),
(7, 1, 295, 16, 0, NULL, NULL, NULL, 1, 0, 49, '2024-03-08 07:09:41', '2024-03-08 07:09:41'),
(8, 1, 296, 16, 0, NULL, NULL, NULL, 1, 0, 83, '2024-03-08 07:09:41', '2024-03-08 07:09:41'),
(9, 1, 297, 16, 0, NULL, NULL, NULL, 1, 0, 152, '2024-03-08 07:09:41', '2024-03-08 07:09:41'),
(10, 2, 298, 229, 0, NULL, NULL, NULL, 1, 0, 1, '2024-03-08 07:09:41', '2024-03-08 07:09:41'),
(11, 2, 299, 229, 0, NULL, NULL, NULL, 1, 0, 3, '2024-03-08 07:09:41', '2024-03-08 07:09:41'),
(12, 1, 300, 229, 1, NULL, NULL, NULL, 1, 0, 0, '2024-03-08 07:09:41', '2024-05-06 07:25:41'),
(13, 3, 301, 230, 0, NULL, NULL, NULL, 1, 0, 8, '2024-03-08 07:09:41', '2024-03-08 07:09:41'),
(14, 3, 302, 230, 0, NULL, NULL, NULL, 1, 0, 20, '2024-03-08 07:09:41', '2024-03-08 07:09:41'),
(18, 1, 326, 0, 1, NULL, NULL, NULL, 1, 0, 0, '2024-03-08 07:09:41', '2024-05-03 06:07:09'),
(20, 1, 469, 0, 1, NULL, NULL, NULL, 1, 0, 0, '2024-03-08 07:09:41', '2024-05-03 06:21:15'),
(23, NULL, 1011, 0, 0, 'images/category/23/sheets-4WEtMB61vG.webp', 'images/category/23/sheets-I6fSxo6Cxb.webp', NULL, 1, 0, 36, '2024-03-08 07:09:41', '2024-04-27 06:12:18'),
(24, NULL, 1619, 0, 0, NULL, NULL, NULL, 1, 0, 9, '2024-03-08 07:09:41', '2024-03-08 07:09:41'),
(25, NULL, 1818, 0, 0, 'images/category/25/towels-and-bathrobes-NHbrqDDwLZ.webp', 'images/category/25/towels-and-bathrobes-nkkcFjK8bS.webp', NULL, 1, 0, 56, '2024-03-08 07:09:41', '2024-04-27 06:13:52'),
(26, NULL, 2263, 0, 0, NULL, NULL, NULL, 1, 0, 10, '2024-03-08 07:09:41', '2024-03-08 07:09:41'),
(27, NULL, 2370, 0, 0, NULL, NULL, NULL, 1, 0, 7, '2024-03-08 07:09:41', '2024-03-08 07:09:41'),
(28, NULL, 2439, 0, 0, NULL, NULL, NULL, 1, 0, 1, '2024-03-08 07:09:41', '2024-03-08 07:09:41'),
(30, 1, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 0, '2024-05-03 06:29:06', '2024-05-06 09:47:46'),
(31, 3, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 0, '2024-05-07 10:22:40', '2024-05-07 10:22:40'),
(32, 13, NULL, NULL, 2, NULL, NULL, NULL, 1, 0, 0, '2024-05-22 11:55:33', '2024-05-22 11:55:33'),
(33, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, 0, '2024-06-02 06:57:05', '2024-06-02 06:57:05');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
