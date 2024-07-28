-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 04:16 PM
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
-- Dumping data for table `data_city_translations`
--

INSERT INTO `data_city_translations` (`id`, `city_id`, `locale`, `name`, `g_title`, `g_des`, `slug`) VALUES
(1, 1, 'ar', 'القاهرة', NULL, NULL, NULL),
(2, 1, 'en', 'Cairo', NULL, NULL, NULL),
(3, 2, 'ar', 'الجيزة', NULL, NULL, NULL),
(4, 2, 'en', 'Giza', NULL, NULL, NULL),
(5, 3, 'ar', 'القليوبية', NULL, NULL, NULL),
(6, 3, 'en', 'Qalyubia', NULL, NULL, NULL),
(7, 4, 'ar', 'الإسكندرية', NULL, NULL, NULL),
(8, 4, 'en', 'Alexandria', NULL, NULL, NULL),
(9, 5, 'ar', 'الإسماعيلية', NULL, NULL, NULL),
(10, 5, 'en', 'Ismailia', NULL, NULL, NULL),
(11, 6, 'ar', 'أسوان', NULL, NULL, NULL),
(12, 6, 'en', 'Aswan', NULL, NULL, NULL),
(13, 7, 'ar', 'أسيوط', NULL, NULL, NULL),
(14, 7, 'en', 'Asyut', NULL, NULL, NULL),
(15, 8, 'ar', 'الأقصر', NULL, NULL, NULL),
(16, 8, 'en', 'Luxor', NULL, NULL, NULL),
(17, 9, 'ar', 'البحر الأحمر', NULL, NULL, NULL),
(18, 9, 'en', 'Red Sea', NULL, NULL, NULL),
(19, 10, 'ar', 'البحيرة', NULL, NULL, NULL),
(20, 10, 'en', 'Beheira', NULL, NULL, NULL),
(21, 11, 'ar', 'بني سويف', NULL, NULL, NULL),
(22, 11, 'en', 'Bani Sweif', NULL, NULL, NULL),
(23, 12, 'ar', 'بورسعيد', NULL, NULL, NULL),
(24, 12, 'en', 'Port Said', NULL, NULL, NULL),
(25, 13, 'ar', 'جنوب سيناء', NULL, NULL, NULL),
(26, 13, 'en', 'South Sinai', NULL, NULL, NULL),
(27, 14, 'ar', 'دمياط', NULL, NULL, NULL),
(28, 14, 'en', 'Damietta', NULL, NULL, NULL),
(29, 15, 'ar', 'سوهاج', NULL, NULL, NULL),
(30, 15, 'en', 'Sohag', NULL, NULL, NULL),
(31, 16, 'ar', 'السويس', NULL, NULL, NULL),
(32, 16, 'en', 'Suez', NULL, NULL, NULL),
(33, 17, 'ar', 'الشرقية', NULL, NULL, NULL),
(34, 17, 'en', 'Eastern', NULL, NULL, NULL),
(35, 18, 'ar', 'شمال سيناء', NULL, NULL, NULL),
(36, 18, 'en', 'North Sinai', NULL, NULL, NULL),
(37, 19, 'ar', 'الغربية', NULL, NULL, NULL),
(38, 19, 'en', 'الغربية', NULL, NULL, NULL),
(39, 20, 'ar', 'الفيوم', NULL, NULL, NULL),
(40, 20, 'en', 'Fayoum', NULL, NULL, NULL),
(41, 21, 'ar', 'قنا', NULL, NULL, NULL),
(42, 21, 'en', 'Qena', NULL, NULL, NULL),
(43, 22, 'ar', 'كفر الشيخ', NULL, NULL, NULL),
(44, 22, 'en', 'Kafr El-Sheikh', NULL, NULL, NULL),
(45, 23, 'ar', 'مطروح', NULL, NULL, NULL),
(46, 23, 'en', 'Matrouh', NULL, NULL, NULL),
(47, 24, 'ar', 'المنوفية', NULL, NULL, NULL),
(48, 24, 'en', 'Menoufia', NULL, NULL, NULL),
(49, 25, 'ar', 'المنيا', NULL, NULL, NULL),
(50, 25, 'en', 'Minya', NULL, NULL, NULL),
(51, 26, 'ar', 'الوادي الجديد', NULL, NULL, NULL),
(52, 26, 'en', 'New Valley', NULL, NULL, NULL),
(53, 27, 'ar', 'الدقهلية', NULL, NULL, NULL),
(54, 27, 'en', 'Dakahlia', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
