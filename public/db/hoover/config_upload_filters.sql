-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 02:40 AM
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
-- Database: `a_cart_new`
--

--
-- Dumping data for table `config_upload_filters`
--

INSERT INTO `config_upload_filters` (`id`, `name`, `type`, `convert_state`, `quality_val`, `new_w`, `new_h`, `canvas_back`, `greyscale`, `flip_state`, `flip_v`, `blur`, `blur_size`, `pixelate`, `pixelate_size`, `text_state`, `text_print`, `font_size`, `font_path`, `font_color`, `font_opacity`, `text_position`, `watermark_state`, `watermark_img`, `watermark_position`, `state`, `notes_ar`, `notes_en`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'NoEdit', 1, 1, 85, 100, 100, '#ffffff', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, '2023-10-15 07:42:57', '2023-10-15 07:42:57', NULL),
(2, 'DefPhoto', 4, 1, 85, 800, 420, '#ffffff', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, '2023-10-15 07:42:57', '2023-10-15 07:42:57', NULL),
(3, 'FavIcon', 4, 1, 85, 40, 40, '#ffffff', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, '2023-10-15 07:42:57', '2023-10-15 07:42:57', NULL),
(4, 'اقسام المنتجات', 4, 1, 85, 700, 400, '#FFFFFF', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'برجاء مراعاة ان تكون الصورة مربعة اقل عرض 500 اقل ارتفاع 500 سيتم اعادة ضبط ابعاد الصورة على خلفيه بيضاء فى حالة عدم تساوى النسب', NULL, '2023-10-15 07:42:57', '2024-04-27 06:06:01', NULL),
(5, 'العلامات التجارية', 5, 1, 85, 500, 380, '#FFFFFF', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'برجاء مراعاة ان تكون الصورة مستطيلة  اقل عرض  1024 سيتم ضبط ابعاد الصور وفقا لحجم العرض', NULL, '2023-10-15 07:42:57', '2024-04-14 18:30:53', NULL),
(6, 'المنتجات مربع مع تصغير الخلفية', 5, 1, 85, 730, 730, '#B4B4B4', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'برجاء مراعاة ان تكون الصورة مستطيلة  اقل عرض 420 اقل ارتفاع 500 سيتم قص الصورة وفقا للابعاد المحددة', NULL, '2023-11-16 06:54:14', '2024-04-25 02:40:34', NULL),
(7, 'المنتجات مربع مع قص المصغر', 5, 1, 85, 730, 730, '#B8B8B8', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'برجاء مراعاة ان تكون الصورة مستطيلة  اقل عرض 800 اقل ارتفاع 420 سيتم قص الصورة وفقا للابعاد المحددة', NULL, '2024-01-22 17:51:06', '2024-04-25 02:40:01', NULL),
(8, 'المنتجات مربع قص', 4, 1, 85, 720, 720, '#FFFFFF', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 'برجاء مراعاة ان تكون الصورة مستطيلة  اقل عرض  1024 سيتم ضبط ابعاد الصور وفقا لحجم العرض', NULL, '2024-01-22 19:39:31', '2024-04-25 02:43:48', NULL),
(9, 'صورة المقال', 2, 1, 85, 860, 410, '#FFFFFF', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, '2024-04-29 21:27:02', '2024-04-29 21:27:02', NULL),
(10, 'المقال صورة الافتراضية', 4, 1, 85, 450, 340, '#FFFFFF', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, '2024-04-29 21:34:11', '2024-04-29 21:34:11', NULL),
(11, 'المقالات المزيد من الصور', 2, 1, 85, 1024, 600, '#FFFFFF', 0, 0, 0, 0, '0', 0, '5', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, '2024-04-29 21:37:33', '2024-04-29 21:38:04', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
