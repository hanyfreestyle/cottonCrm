-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2024 at 08:20 PM
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
-- Database: `cottton_shop`
--

--
-- Dumping data for table `pro_landing_page_translations`
--

INSERT INTO `pro_landing_page_translations` (`id`, `page_id`, `locale`, `slug`, `name`, `des`, `desup`, `g_title`, `g_des`) VALUES
(1, 1, 'ar', 'عرض-العروسين-من-المامون', 'عرض العروسين من المامون', '<p>وصف الصفحة يظهر اسفل المنتجات</p>', '<p>وصف الصفحة يظهر اعلى المنتجات</p>', 'عنوان الصفحة', 'وصف الصفحة'),
(2, 2, 'ar', 'عرض-العروسين-من-انجلندر', 'عرض العروسين من انجلندر', NULL, NULL, NULL, NULL),
(3, 3, 'ar', 'عرض-العروسين-من-ماستر-بد', 'عرض العروسين من ماستر بد', NULL, NULL, NULL, NULL),
(4, 4, 'ar', 'عرض-الصيف-من-موقع-قطن', 'عرض الصيف من موقع قطن', '<p style=\"text-align:center\"><strong><span style=\"font-size:28px\">اطلب العرض الان واستمتع بشحن مجانى لاول 5 عروض</span></strong></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"color:#e74c3c\"><strong><span style=\"font-size:28px\">مستنى ايه اطلب الان ......</span></strong></span></p>\r\n\r\n<p style=\"text-align:center\"><img alt=\"\" src=\"https://cottton.shop/offer/free.jpg\" style=\"height:360px; width:656px\" /></p>\r\n\r\n<p>&nbsp;</p>', '<p style=\"text-align:center\"><span style=\"font-size:18px\"><strong>اقوى العروض من موقع قطن احصل على العرض الان ولا تترك هذه الفرص </strong></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:18px\"><strong><img alt=\"\" src=\"https://cottton.shop/offer/offer.webp\" /></strong></span></p>', NULL, NULL),
(5, 5, 'ar', 'عرض-المخدات-من-قطن', 'عرض المخدات من قطن', NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
