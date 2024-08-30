-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 12:11 PM
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
-- Dumping data for table `data_area_translations`
--

INSERT INTO `data_area_translations` (`id`, `area_id`, `locale`, `name`, `g_title`, `g_des`, `slug`) VALUES
(1, 1, 'ar', 'الانفوشي', NULL, NULL, NULL),
(2, 2, 'ar', 'العصافرة', NULL, NULL, NULL),
(3, 3, 'ar', 'العطارين', NULL, NULL, NULL),
(4, 4, 'ar', 'الازاريطة', NULL, NULL, NULL),
(5, 5, 'ar', 'بحري 	', NULL, NULL, NULL),
(6, 6, 'ar', 'باكوس 	', NULL, NULL, NULL),
(7, 7, 'ar', 'بولكلي 	', NULL, NULL, NULL),
(8, 8, 'ar', 'كامب شيزار 	', NULL, NULL, NULL),
(9, 9, 'ar', 'كليوباترا 	', NULL, NULL, NULL),
(10, 10, 'ar', 'الدخيلة 	', NULL, NULL, NULL),
(11, 11, 'ar', 'فلمنج 	', NULL, NULL, NULL),
(12, 12, 'ar', 'جناكليس', NULL, NULL, NULL),
(13, 13, 'ar', 'جليم 	', NULL, NULL, NULL),
(14, 14, 'ar', 'الحضرة 	', NULL, NULL, NULL),
(15, 15, 'ar', 'الابراهيمية', NULL, NULL, NULL),
(16, 16, 'ar', 'كفر عبده 	', NULL, NULL, NULL),
(17, 17, 'ar', 'كرموز 	', NULL, NULL, NULL),
(18, 18, 'ar', 'كوم الدكة ', NULL, NULL, NULL),
(19, 19, 'ar', 'اللبان 	', NULL, NULL, NULL),
(20, 20, 'ar', 'لوران 	', NULL, NULL, NULL),
(21, 21, 'ar', 'المعمورة 	', NULL, NULL, NULL),
(22, 22, 'ar', 'محطة الرمل', NULL, NULL, NULL),
(23, 23, 'ar', 'المندرة 	', NULL, NULL, NULL),
(24, 24, 'ar', 'المنشية 	', NULL, NULL, NULL),
(25, 25, 'ar', 'المكس 	', NULL, NULL, NULL),
(26, 26, 'ar', 'ميامي 	', NULL, NULL, NULL),
(27, 27, 'ar', 'محرم بك', NULL, NULL, NULL),
(28, 28, 'ar', 'القباري 	', NULL, NULL, NULL),
(29, 29, 'ar', 'رشدي 	', NULL, NULL, NULL),
(30, 30, 'ar', 'سابا باشا 	', NULL, NULL, NULL),
(31, 31, 'ar', 'سان ستيفانو', NULL, NULL, NULL),
(32, 32, 'ar', ' السرايا 	', NULL, NULL, NULL),
(33, 33, 'ar', 'سيدي بشر 	', NULL, NULL, NULL),
(34, 34, 'ar', 'سيدي جابر 	', NULL, NULL, NULL),
(35, 35, 'ar', 'سموحة 	', NULL, NULL, NULL),
(36, 36, 'ar', 'الشاطبي 	', NULL, NULL, NULL),
(37, 37, 'ar', 'شدس 	', NULL, NULL, NULL),
(38, 38, 'ar', 'السيوف 	', NULL, NULL, NULL),
(39, 39, 'ar', 'ابيس', NULL, NULL, NULL),
(40, 40, 'ar', 'العوايد 	', NULL, NULL, NULL),
(41, 41, 'ar', 'سبورتنج 	', NULL, NULL, NULL),
(42, 42, 'ar', 'ستانلي 	', NULL, NULL, NULL),
(43, 43, 'ar', 'ثروت 	', NULL, NULL, NULL),
(44, 44, 'ar', 'فكتوريا 	', NULL, NULL, NULL),
(45, 45, 'ar', 'الورديان 	', NULL, NULL, NULL),
(46, 46, 'ar', 'زيزينيا 	', NULL, NULL, NULL),
(47, 47, 'ar', 'راس التين', NULL, NULL, NULL),
(48, 48, 'ar', 'التجمع الخامس', NULL, NULL, NULL),
(49, 49, 'ar', 'العاصمة الادارية', NULL, NULL, NULL),
(50, 50, 'ar', 'كفر الدوار', NULL, NULL, NULL),
(51, 51, 'ar', 'البيطاش', NULL, NULL, NULL),
(52, 52, 'ar', 'ابوقير', NULL, NULL, NULL),
(53, 53, 'ar', 'الراس السودة', NULL, NULL, NULL),
(54, 54, 'ar', 'العجمي', NULL, NULL, NULL),
(55, 55, 'ar', 'الجلاء', NULL, NULL, NULL),
(56, 56, 'ar', 'كوبرى الناموس', NULL, NULL, NULL),
(57, 57, 'ar', 'حجر النواتية', NULL, NULL, NULL),
(58, 58, 'ar', 'خالد بن الوليد', NULL, NULL, NULL),
(59, 59, 'ar', 'القاهره', NULL, NULL, NULL),
(60, 60, 'ar', 'محطة مصر', NULL, NULL, NULL),
(61, 61, 'ar', 'تسون', NULL, NULL, NULL),
(62, 62, 'ar', 'المعدية', NULL, NULL, NULL),
(63, 63, 'ar', 'الفلكي', NULL, NULL, NULL),
(64, 64, 'ar', 'فيصل', NULL, NULL, NULL),
(65, 65, 'ar', 'برج العرب', NULL, NULL, NULL),
(66, 66, 'ar', 'مصطفي كامل', NULL, NULL, NULL),
(67, 67, 'ar', 'طوسون', NULL, NULL, NULL),
(68, 68, 'ar', 'جمال عبدالناصر', NULL, NULL, NULL),
(69, 69, 'ar', 'الظاهرية', NULL, NULL, NULL),
(70, 70, 'ar', 'غبريال', NULL, NULL, NULL),
(71, 71, 'ar', 'كفر الدوار', NULL, NULL, NULL),
(72, 72, 'ar', 'العامرية', NULL, NULL, NULL),
(73, 73, 'ar', 'الاصلاح', NULL, NULL, NULL),
(74, 74, 'ar', 'المنتزة', NULL, NULL, NULL),
(75, 75, 'ar', 'العيسوي', NULL, NULL, NULL),
(76, 76, 'ar', 'كفر الشيخ', NULL, NULL, NULL),
(77, 77, 'ar', 'خورشيد', NULL, NULL, NULL),
(78, 78, 'ar', 'شارع 45', NULL, NULL, NULL),
(79, 79, 'ar', 'المراغي', NULL, NULL, NULL),
(80, 80, 'ar', 'بشاير الخير', NULL, NULL, NULL),
(81, 81, 'ar', 'الزوايدة', NULL, NULL, NULL),
(82, 82, 'ar', 'خليل حمادة', NULL, NULL, NULL),
(83, 83, 'ar', 'الحي السادس 6 اكتوبر', NULL, NULL, NULL),
(84, 84, 'ar', 'مدينة الضباط', NULL, NULL, NULL),
(85, 85, 'ar', 'وينجت', NULL, NULL, NULL),
(86, 86, 'ar', 'الساحل الشمالي', NULL, NULL, NULL),
(87, 87, 'ar', 'ونجت', NULL, NULL, NULL),
(88, 88, 'ar', 'ابو سليمان', NULL, NULL, NULL),
(89, 89, 'ar', 'بوكلة', NULL, NULL, NULL),
(90, 90, 'ar', 'الهانوفيل', NULL, NULL, NULL),
(91, 91, 'ar', 'هدي الاسلام', NULL, NULL, NULL),
(92, 92, 'ar', 'دربالة', NULL, NULL, NULL),
(93, 93, 'ar', 'محطه الهداية', NULL, NULL, NULL),
(94, 94, 'ar', 'صفر', NULL, NULL, NULL),
(95, 95, 'ar', 'لم تحدد', NULL, NULL, NULL),
(96, 96, 'ar', 'نجع العرب', NULL, NULL, NULL),
(97, 97, 'ar', 'شيكوس', NULL, NULL, NULL),
(98, 98, 'ar', 'رشيد', NULL, NULL, NULL),
(99, 99, 'ar', 'استانلي', NULL, NULL, NULL),
(100, 100, 'ar', 'النزهة', NULL, NULL, NULL),
(101, 101, 'ar', 'الضاهرية', NULL, NULL, NULL),
(102, 102, 'ar', 'بابور الميه', NULL, NULL, NULL),
(103, 103, 'ar', 'الساعة', NULL, NULL, NULL),
(104, 104, 'ar', 'غيط العنب', NULL, NULL, NULL),
(105, 105, 'ar', 'العماروة', NULL, NULL, NULL),
(106, 106, 'ar', 'الترعة', NULL, NULL, NULL),
(107, 107, 'ar', 'الكيلو 22', NULL, NULL, NULL),
(108, 108, 'ar', 'محطة الوزارة', NULL, NULL, NULL),
(109, 109, 'ar', 'شدس', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
