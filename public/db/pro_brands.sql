-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 01:11 PM
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
-- Dumping data for table `pro_brands`
--

INSERT INTO `pro_brands` (`id`, `parent_id`, `old_id`, `deep`, `photo`, `photo_thum_1`, `icon`, `is_active`, `postion`, `created_at`, `updated_at`) VALUES
(1, NULL, 311, 0, 'wp-content/uploads/2023/10/logo5.png', 'wp-content/uploads/2023/10/logo5.png', NULL, 1, 0, '2024-03-08 06:27:57', '2024-03-08 06:27:57'),
(2, NULL, 312, 0, 'wp-content/uploads/2021/07/مرتبة-انجلندر-سيتى.jpg', 'wp-content/uploads/2023/10/logo8.png', NULL, 1, 0, '2024-03-08 06:27:57', '2024-03-08 06:27:57'),
(3, NULL, 313, 0, 'wp-content/uploads/2023/10/logo3.jpg', 'wp-content/uploads/2023/10/logo3.jpg', NULL, 1, 0, '2024-03-08 06:27:57', '2024-03-08 06:27:57'),
(4, NULL, 314, 0, 'wp-content/uploads/2021/06/اسكاندي-يانسن.png', 'wp-content/uploads/2023/10/يانسن.png', NULL, 1, 0, '2024-03-08 06:27:57', '2024-03-08 06:27:57'),
(5, NULL, 315, 0, 'wp-content/uploads/2023/10/logo14.png', 'wp-content/uploads/2023/10/logo14.png', NULL, 1, 0, '2024-03-08 06:27:57', '2024-03-08 06:27:57'),
(6, NULL, 317, 0, 'wp-content/uploads/2023/10/logo1.png', 'wp-content/uploads/2023/10/logo1.png', NULL, 1, 0, '2024-03-08 06:27:57', '2024-03-08 06:27:57'),
(7, NULL, 319, 0, 'wp-content/uploads/2023/10/logo10.png', 'wp-content/uploads/2023/10/logo10.png', NULL, 1, 0, '2024-03-08 06:27:57', '2024-03-08 06:27:57'),
(8, NULL, 321, 0, 'wp-content/uploads/2023/10/دورا.png', 'wp-content/uploads/2023/10/دورا.png', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:37:20'),
(9, NULL, 322, 0, 'wp-content/uploads/2023/10/logo27.png', 'wp-content/uploads/2023/10/logo27.png', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(10, NULL, 330, 0, 'wp-content/uploads/2022/08/سليبي.jpg', 'wp-content/uploads/2022/08/سليبي.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:37:20'),
(11, NULL, 332, 0, 'wp-content/uploads/2022/08/ماستربد.jpg', 'wp-content/uploads/2022/08/ماستربد.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:37:20'),
(12, NULL, 335, 0, 'wp-content/uploads/2022/08/سيلي.jpg', 'wp-content/uploads/2022/08/سيلي.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:37:20'),
(13, NULL, 339, 0, 'wp-content/uploads/2023/10/logo-28.jpg', 'wp-content/uploads/2023/10/logo-28.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(14, NULL, 341, 0, 'wp-content/uploads/2023/10/mora-2.png', 'wp-content/uploads/2023/10/mora-2.png', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(15, NULL, 342, 0, 'wp-content/uploads/2022/08/ريتا-1.jpg', 'wp-content/uploads/2022/08/ريتا.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(16, NULL, 343, 0, 'wp-content/uploads/2023/10/logo4.png', 'wp-content/uploads/2023/10/logo4.png', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(17, NULL, 347, 0, 'wp-content/uploads/2023/10/logo9.jpg', 'wp-content/uploads/2023/10/logo9.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(18, NULL, 348, 0, 'wp-content/uploads/2023/10/logo11.jpg', 'wp-content/uploads/2023/10/logo11.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(19, NULL, 351, 0, 'wp-content/uploads/2022/08/مون-لايت-1.jpg', 'wp-content/uploads/2022/08/مون-لايت.webp', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(20, NULL, 352, 0, 'wp-content/uploads/2022/08/فلورندا.jpg', 'wp-content/uploads/2022/08/فلورندا.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:37:20'),
(21, NULL, 355, 0, 'wp-content/uploads/2023/10/logo29.jpg', 'wp-content/uploads/2023/10/logo29.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(22, NULL, 358, 0, 'wp-content/uploads/2022/08/مراتب-تاكي-ستار.jpg', 'wp-content/uploads/2022/08/مراتب-تاكي-ستار.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:37:20'),
(23, NULL, 360, 0, 'wp-content/uploads/2022/08/فيمارك.jpg', 'wp-content/uploads/2022/08/فيمارك-1.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(24, NULL, 361, 0, 'wp-content/uploads/2022/08/سكاي-بد-1.jpg', 'wp-content/uploads/2022/08/سكاي-بد.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(25, NULL, 362, 0, 'wp-content/uploads/2022/08/داماس-1.jpg', 'wp-content/uploads/2022/08/داماس.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(26, NULL, 363, 0, 'wp-content/uploads/2022/08/سليب-فاين-1.jpg', 'wp-content/uploads/2022/08/سليب-فاين.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(27, NULL, 364, 0, 'wp-content/uploads/2022/08/سليب-بيست-1.jpg', 'wp-content/uploads/2022/08/سليب-بيست.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(28, NULL, 365, 0, 'wp-content/uploads/2022/08/بد-اند-بد-1.jpg', 'wp-content/uploads/2022/08/بد-اند-بد.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(29, NULL, 370, 0, 'wp-content/uploads/2022/09/فينوس-1.jpg', 'wp-content/uploads/2022/09/فينوس.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(30, NULL, 371, 0, 'wp-content/uploads/2022/09/ماي-بد-1.jpg', 'wp-content/uploads/2022/09/ماي-بد.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(31, NULL, 373, 0, 'wp-content/uploads/2023/10/logo20.png', 'wp-content/uploads/2023/10/logo20.png', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(32, NULL, 377, 0, 'wp-content/uploads/2023/10/logo23.jpg', 'wp-content/uploads/2023/10/logo23.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(33, NULL, 379, 0, 'wp-content/uploads/2023/10/بريمو.jpg', 'wp-content/uploads/2023/10/بريمو.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(34, NULL, 381, 0, 'wp-content/uploads/2022/09/جيرمان-كونفرت.jpg', 'wp-content/uploads/2022/09/جيرمان-كونفرت.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:37:20'),
(35, NULL, 383, 0, 'wp-content/uploads/2022/09/دريم-ستار.jpg', 'wp-content/uploads/2022/09/دريم-ستار.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:37:20'),
(36, NULL, 385, 0, 'wp-content/uploads/2022/09/روكا.jpg', 'wp-content/uploads/2022/09/روكا.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:37:20'),
(37, NULL, 387, 0, 'wp-content/uploads/2022/09/رومانس-سليب.jpg', 'wp-content/uploads/2022/09/رومانس-سليب-1.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(38, NULL, 389, 0, 'wp-content/uploads/2022/09/رويال-كراون.jpg', 'wp-content/uploads/2022/09/رويال-كراون.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:37:20'),
(39, NULL, 392, 0, 'wp-content/uploads/2022/09/فور-سليب-1.jpg', 'wp-content/uploads/2022/09/فور-سليب.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(40, NULL, 394, 0, 'wp-content/uploads/2022/09/فومكس-جولد.png', 'wp-content/uploads/2022/09/فومكس.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(41, NULL, 396, 0, 'wp-content/uploads/2022/08/مراتب-بورتو.jpg', 'wp-content/uploads/2022/08/مراتب-بورتو.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:37:20'),
(42, NULL, 398, 0, 'wp-content/uploads/2023/10/logo26.png', 'wp-content/uploads/2023/10/logo26.png', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:27:58'),
(43, NULL, 399, 0, 'wp-content/uploads/2022/08/مراتب-سيتا-بد.jpg', 'wp-content/uploads/2022/08/مراتب-سيتا-بد.jpg', NULL, 1, 0, '2024-03-08 06:27:58', '2024-03-08 06:37:20'),
(44, NULL, 400, 0, 'wp-content/uploads/2022/08/مراتب-توب-تاون.jpg', 'wp-content/uploads/2022/08/مراتب-توب-تاون.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(45, NULL, 402, 0, 'wp-content/uploads/2022/08/مراتب-فايف-بد.jpg', 'wp-content/uploads/2022/08/مراتب-فايف-بد.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(46, NULL, 405, 0, 'wp-content/uploads/2022/09/فاب.jpg', 'wp-content/uploads/2022/09/فاب.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(47, NULL, 407, 0, 'wp-content/uploads/2022/09/جود-نايت-1.jpg', 'wp-content/uploads/2022/09/جود-نايت.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:27:59'),
(48, NULL, 409, 0, 'wp-content/uploads/2022/09/جولدن-هوم.jpg', 'wp-content/uploads/2022/09/جولدن-هوم.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(49, NULL, 411, 0, 'wp-content/uploads/2022/08/مراتب-فيجن.jpg', 'wp-content/uploads/2022/08/مراتب-فيجن.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(50, NULL, 412, 0, 'wp-content/uploads/2022/09/وايت-بد.jpg', 'wp-content/uploads/2022/09/وايت-بد.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(51, NULL, 413, 0, 'wp-content/uploads/2022/09/ميلانو.jpg', 'wp-content/uploads/2022/09/ميلانو.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(52, NULL, 414, 0, 'wp-content/uploads/2022/08/مراتب-دولسي-فيتا.jpg', 'wp-content/uploads/2022/08/مراتب-دولسي-فيتا.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(53, NULL, 415, 0, 'wp-content/uploads/2022/07/اسعار-مراتب-سيجما.jpg', 'wp-content/uploads/2022/07/اسعار-مراتب-سيجما.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(54, NULL, 416, 0, 'wp-content/uploads/2022/07/مراتب-فيرجينيا.png', 'wp-content/uploads/2022/07/مراتب-فيرجينيا.png', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(55, NULL, 417, 0, 'wp-content/uploads/2023/10/logo21.jpg', 'wp-content/uploads/2023/10/logo21.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:27:59'),
(56, NULL, 418, 0, 'wp-content/uploads/2022/07/مراتب-دايموند.jpg', 'wp-content/uploads/2022/07/مراتب-دايموند.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(57, NULL, 419, 0, 'wp-content/uploads/2022/07/مراتب-سوا.jpg', 'wp-content/uploads/2022/07/مراتب-سوا.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(58, NULL, 420, 0, 'wp-content/uploads/2022/07/مراتب-لورد-بد.jpg', 'wp-content/uploads/2022/07/مراتب-لورد-بد.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(59, NULL, 421, 0, 'wp-content/uploads/2022/07/مراتب-مدريد.jpg', 'wp-content/uploads/2022/07/مراتب-مدريد.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(60, NULL, 422, 0, 'wp-content/uploads/2022/08/مراتب-لاما.jpg', 'wp-content/uploads/2022/08/مراتب-لاما.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(61, NULL, 423, 0, 'wp-content/uploads/2022/08/مراتب-هاي-سينس.jpg', 'wp-content/uploads/2022/08/مراتب-هاي-سينس.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(62, NULL, 424, 0, 'wp-content/uploads/2022/08/مراتب-هابي-فوم.jpg', 'wp-content/uploads/2022/08/مراتب-هابي-فوم.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(63, NULL, 425, 0, 'wp-content/uploads/2022/08/مراتب-نيو-مايند.jpg', 'wp-content/uploads/2022/08/مراتب-نيو-مايند.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(64, NULL, 426, 0, 'wp-content/uploads/2022/08/مراتب-ماموث.jpg', 'wp-content/uploads/2022/08/مراتب-ماموث.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(65, NULL, 444, 0, 'wp-content/uploads/2023/10/logo24.jpg', 'wp-content/uploads/2023/10/logo24.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:27:59'),
(71, NULL, 500, 0, 'wp-content/uploads/2023/10/logo6.png', 'wp-content/uploads/2023/10/logo6.png', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:27:59'),
(76, NULL, 2811, 0, 'wp-content/uploads/2023/10/logo99.jpg', 'wp-content/uploads/2023/10/logo99.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:27:59'),
(77, NULL, 2847, 0, 'wp-content/uploads/2023/10/logo13.png', 'wp-content/uploads/2023/10/logo13.png', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:27:59'),
(78, NULL, 2940, 0, 'wp-content/uploads/2023/10/logo15.png', 'wp-content/uploads/2023/10/logo15.png', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:27:59'),
(79, NULL, 2941, 0, 'wp-content/uploads/2022/08/مراتب-جولدن-بد.jpg', 'wp-content/uploads/2022/08/مراتب-جولدن-بد.jpg', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:37:20'),
(81, NULL, 3282, 0, 'wp-content/uploads/2023/10/logo12.png', 'wp-content/uploads/2023/10/logo12.png', NULL, 1, 0, '2024-03-08 06:27:59', '2024-03-08 06:27:59'),
(83, NULL, 3933, 0, 'wp-content/uploads/2023/12/افضل-مراتب-سرير-طبية.jpg', 'wp-content/uploads/2023/12/افضل-مراتب-سرير-طبية.jpg', NULL, 1, 0, '2024-03-08 06:28:00', '2024-03-08 06:37:20'),
(85, NULL, 4591, 0, NULL, NULL, NULL, 1, 0, '2024-03-08 06:28:00', '2024-03-08 06:28:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
