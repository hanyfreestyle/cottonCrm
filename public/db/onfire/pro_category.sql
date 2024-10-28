-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 06:09 AM
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
-- Database: `onfire_new`
--

--
-- Dumping data for table `pro_category`
--

INSERT INTO `pro_category` (`id`, `parent_id`, `photo`, `photo_thum_1`, `icon`, `is_active`, `position`, `created_at`, `updated_at`) VALUES
(1, NULL, 'images/category/1/burger-sandwiches-pYE4S1qO9G.webp', 'images/category/1/burger-sandwiches-FbqotctSFp.webp', NULL, 1, 0, '2023-10-08 07:39:59', '2024-10-27 10:47:13'),
(2, NULL, 'images/category/2/chicken-sandwiches-aBR2lTybzv.webp', 'images/category/2/chicken-sandwiches-fkmT2kl68z.webp', NULL, 1, 0, '2023-10-08 07:40:10', '2024-10-27 10:48:34'),
(3, NULL, 'images/category/3/1696769062_CG3Swekd9EA8JE1_.webp', 'images/category/3/1696769062_ATf46UjA6Jtm5fE_.webp', NULL, 1, 0, '2023-10-08 07:40:30', '2023-10-08 11:44:22'),
(4, NULL, 'images/category/4/1696769080_I2PTFsLPbyZMNuJ_.webp', 'images/category/4/1696769080_CablI9eIEAjbDQR_.webp', NULL, 1, 0, '2023-10-08 07:40:42', '2023-10-08 11:44:40'),
(5, NULL, 'images/category/5/1696769103_44TWzD4W0MtWICH_.webp', 'images/category/5/1696769103_08oOhMiMwumIzyJ_.webp', NULL, 1, 0, '2023-10-08 07:40:49', '2023-10-08 11:45:03'),
(6, NULL, 'images/category/6/desserts-1vyy93QuOR.webp', 'images/category/6/desserts-SqR3jc7de7.webp', NULL, 1, 0, '2024-02-27 16:16:43', '2024-10-27 10:44:38'),
(7, NULL, 'images/category/7/drinks-7lAAJyfrvU.webp', 'images/category/7/drinks-NGuik6jhsV.webp', NULL, 1, 0, '2024-10-27 09:52:23', '2024-10-27 10:45:39');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
