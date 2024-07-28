-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 05:02 PM
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
-- Dumping data for table `data_area_translations`
--

INSERT INTO `data_area_translations` (`id`, `area_id`, `locale`, `name`, `g_title`, `g_des`, `slug`) VALUES
(1, 1, 'ar', 'نزوى', NULL, NULL, NULL),
(2, 1, 'en', 'Nizwa', NULL, NULL, NULL),
(3, 2, 'ar', 'سمائل', NULL, NULL, NULL),
(4, 2, 'en', 'Samail', NULL, NULL, NULL),
(5, 3, 'ar', 'بهلا', NULL, NULL, NULL),
(6, 3, 'en', 'Bahla', NULL, NULL, NULL),
(7, 4, 'ar', 'منح', NULL, NULL, NULL),
(8, 4, 'en', 'Manah', NULL, NULL, NULL),
(9, 5, 'ar', 'الحمراء', NULL, NULL, NULL),
(10, 5, 'en', 'Al Hamra', NULL, NULL, NULL),
(11, 6, 'ar', 'أدم', NULL, NULL, NULL),
(12, 6, 'en', 'Adam', NULL, NULL, NULL),
(13, 7, 'ar', 'إزكي', NULL, NULL, NULL),
(14, 7, 'en', 'Izki', NULL, NULL, NULL),
(15, 8, 'ar', 'بدبد', NULL, NULL, NULL),
(16, 8, 'en', 'Bid Bid', NULL, NULL, NULL),
(17, 9, 'ar', 'الجبل الأخضر', NULL, NULL, NULL),
(18, 9, 'en', 'Jebel Akhdar', NULL, NULL, NULL),
(19, 10, 'ar', 'عبري', NULL, NULL, NULL),
(20, 10, 'en', 'Ibri', NULL, NULL, NULL),
(21, 11, 'ar', 'ضنك', NULL, NULL, NULL),
(22, 11, 'en', 'Dhank', NULL, NULL, NULL),
(23, 12, 'ar', 'ينقل', NULL, NULL, NULL),
(24, 12, 'en', 'Yanqul', NULL, NULL, NULL),
(25, 13, 'ar', 'صحار', NULL, NULL, NULL),
(26, 13, 'en', 'Sohar', NULL, NULL, NULL),
(27, 14, 'ar', 'شناص', NULL, NULL, NULL),
(28, 14, 'en', 'Shinas', NULL, NULL, NULL),
(29, 15, 'ar', 'السويق', NULL, NULL, NULL),
(30, 15, 'en', 'Suwayq', NULL, NULL, NULL),
(31, 16, 'ar', 'لوى', NULL, NULL, NULL),
(32, 16, 'en', 'Liwa', NULL, NULL, NULL),
(33, 17, 'ar', 'صحم', NULL, NULL, NULL),
(34, 17, 'en', 'Saham', NULL, NULL, NULL),
(35, 18, 'ar', 'الخابورة', NULL, NULL, NULL),
(36, 18, 'en', 'Al Khaboura', NULL, NULL, NULL),
(37, 19, 'ar', 'الرستاق', NULL, NULL, NULL),
(38, 19, 'en', 'Rustaq', NULL, NULL, NULL),
(39, 20, 'ar', 'بركاء', NULL, NULL, NULL),
(40, 20, 'en', 'Barka', NULL, NULL, NULL),
(41, 21, 'ar', 'نخل', NULL, NULL, NULL),
(42, 21, 'en', 'Nakhal', NULL, NULL, NULL),
(43, 22, 'ar', 'وادي المعاول', NULL, NULL, NULL),
(44, 22, 'en', 'Wadi Al Maawil', NULL, NULL, NULL),
(45, 23, 'ar', 'العوابي', NULL, NULL, NULL),
(46, 23, 'en', 'Al Awabi', NULL, NULL, NULL),
(47, 24, 'ar', 'المصنعة', NULL, NULL, NULL),
(48, 24, 'en', 'Al Musannah', NULL, NULL, NULL),
(49, 25, 'ar', 'البريمي', NULL, NULL, NULL),
(50, 25, 'en', 'Al Buraymi', NULL, NULL, NULL),
(51, 26, 'ar', 'محضة', NULL, NULL, NULL),
(52, 26, 'en', 'محضة', NULL, NULL, NULL),
(53, 27, 'ar', 'السنينة', NULL, NULL, NULL),
(54, 27, 'en', 'السنينة', NULL, NULL, NULL),
(55, 28, 'ar', 'محوت', NULL, NULL, NULL),
(56, 28, 'en', 'Mahout', NULL, NULL, NULL),
(57, 29, 'ar', 'الدقم', NULL, NULL, NULL),
(58, 29, 'en', 'Duqm', NULL, NULL, NULL),
(59, 30, 'ar', 'هيما', NULL, NULL, NULL),
(60, 30, 'en', 'Haima', NULL, NULL, NULL),
(61, 31, 'ar', 'الجازر', NULL, NULL, NULL),
(62, 31, 'en', 'Al Jazer', NULL, NULL, NULL),
(63, 32, 'ar', 'إبراء', NULL, NULL, NULL),
(64, 32, 'en', 'Ibra', NULL, NULL, NULL),
(65, 33, 'ar', 'المضيبي', NULL, NULL, NULL),
(66, 33, 'en', 'Al Mudhaibi', NULL, NULL, NULL),
(67, 34, 'ar', 'بدية', NULL, NULL, NULL),
(68, 34, 'en', 'Bidiya', NULL, NULL, NULL),
(69, 35, 'ar', 'القابل', NULL, NULL, NULL),
(70, 35, 'en', 'Al Qabil', NULL, NULL, NULL),
(71, 36, 'ar', 'وادي بني خالد', NULL, NULL, NULL),
(72, 36, 'en', 'Wadi Bani Khalid', NULL, NULL, NULL),
(73, 37, 'ar', 'دماء الطائيين', NULL, NULL, NULL),
(74, 37, 'en', 'Dema Wa Thaieen', NULL, NULL, NULL),
(75, 38, 'ar', 'صور', NULL, NULL, NULL),
(76, 38, 'en', 'Sur', NULL, NULL, NULL),
(77, 39, 'ar', 'الكامل والوافي', NULL, NULL, NULL),
(78, 39, 'en', 'Al-Kamil and Al-Wafi', NULL, NULL, NULL),
(79, 40, 'ar', 'جعلان بني بوحسن', NULL, NULL, NULL),
(80, 40, 'en', 'Jalan Bani Bu Hassan', NULL, NULL, NULL),
(81, 41, 'ar', 'جعلان بني بوعلي', NULL, NULL, NULL),
(82, 41, 'en', 'Jalan Bani Bu Ali', NULL, NULL, NULL),
(83, 42, 'ar', 'مصيرة', NULL, NULL, NULL),
(84, 42, 'en', 'Masirah', NULL, NULL, NULL),
(85, 43, 'ar', 'صلالة', NULL, NULL, NULL),
(86, 43, 'en', 'Salalah', NULL, NULL, NULL),
(87, 44, 'ar', 'ثمريت', NULL, NULL, NULL),
(88, 44, 'en', 'Thumrait', NULL, NULL, NULL),
(89, 45, 'ar', 'طاقة', NULL, NULL, NULL),
(90, 45, 'en', 'Taqah', NULL, NULL, NULL),
(91, 46, 'ar', 'مرباط', NULL, NULL, NULL),
(92, 46, 'en', 'Mirbat', NULL, NULL, NULL),
(93, 47, 'ar', 'رخيوت', NULL, NULL, NULL),
(94, 47, 'en', 'Rakhyut', NULL, NULL, NULL),
(95, 48, 'ar', 'ضلكوت', NULL, NULL, NULL),
(96, 48, 'en', 'Ḍalkut', NULL, NULL, NULL),
(97, 49, 'ar', 'سدح', NULL, NULL, NULL),
(98, 49, 'en', 'Sadah', NULL, NULL, NULL),
(99, 50, 'ar', 'شليم وجزر الحلانيات', NULL, NULL, NULL),
(100, 50, 'en', 'Shalim and the Hallaniyat Islands', NULL, NULL, NULL),
(101, 51, 'ar', 'مقشن', NULL, NULL, NULL),
(102, 51, 'en', 'Muqshin', NULL, NULL, NULL),
(103, 52, 'ar', 'المزيونة', NULL, NULL, NULL),
(104, 52, 'en', 'Al Mazyunah', NULL, NULL, NULL),
(105, 53, 'ar', 'مسقط', NULL, NULL, NULL),
(106, 53, 'en', 'Muscat', NULL, NULL, NULL),
(107, 54, 'ar', 'مطرح', NULL, NULL, NULL),
(108, 54, 'en', 'Muttrah', NULL, NULL, NULL),
(109, 55, 'ar', 'بوشر', NULL, NULL, NULL),
(110, 55, 'en', 'Bawshar', NULL, NULL, NULL),
(111, 56, 'ar', 'السيب', NULL, NULL, NULL),
(112, 56, 'en', 'Al Seeb', NULL, NULL, NULL),
(113, 57, 'ar', 'العامرات', NULL, NULL, NULL),
(114, 57, 'en', 'Al Amarat', NULL, NULL, NULL),
(115, 58, 'ar', 'قريات', NULL, NULL, NULL),
(116, 58, 'en', 'Qurayyat', NULL, NULL, NULL),
(117, 59, 'ar', 'خصب', NULL, NULL, NULL),
(118, 59, 'en', 'Khasab', NULL, NULL, NULL),
(119, 60, 'ar', 'بخا', NULL, NULL, NULL),
(120, 60, 'en', 'Bukha', NULL, NULL, NULL),
(121, 61, 'ar', 'دباء', NULL, NULL, NULL),
(122, 61, 'en', 'Dibba Al-Bay\'ah', NULL, NULL, NULL),
(123, 62, 'ar', 'مدحاء', NULL, NULL, NULL),
(124, 62, 'en', 'Madha', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
