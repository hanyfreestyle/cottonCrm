-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 08:41 PM
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
-- Database: `a_cart`
--

--
-- Dumping data for table `config_branch_translations`
--

INSERT INTO `config_branch_translations` (`id`, `branch_id`, `locale`, `title`, `address`, `phone`, `work_hours`) VALUES
(1, 1, 'ar', 'المقر الرئيسي', '14 ش خليل بك متفرع من شارع\r\nاسماعيل صبري - الجمرك\r\nالاسكندرية - مصر', '+2 0100 618 0117\r\n+203 48 67 311\r\n+203 48 15 941', 'طول ايام الاسبوع\r\nمن 9 صباحا وحتى 9 مساءا'),
(2, 1, 'en', 'Head Office', '14 Khalil Bek St., from Ismail Sabry El Gommork\r\nAlexandria - Egypt', '+2 0100 618 0117\r\n+203 48 67 311\r\n+203 48 15 941', 'All week days\r\nFrom 9:00 AM To 8:00 PM'),
(3, 2, 'ar', 'المقر الادارى', '336 طريق الجيش امام نادي التجاريين\r\nعمارات رويال بلازا - سابا باشا\r\nالاسكندرية - مصر', '+203 58 68 324\r\n+203 58 68 325', 'من السبت الى الخميس\r\n9 صباحا وحتى 5 مساءا'),
(4, 2, 'en', 'Managerial Office', '336 El Geish Road in front of Al Tegareen Club\r\nRoyal Plaza Buildings - Saba Basha\r\nAlexandria - Egypt', '+203 58 68 324\r\n+203 58 68 325', 'From Saturday to Thursday\r\n9:00 AM To 5:00 PM');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
