-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 06:26 PM
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
-- Dumping data for table `config_data`
--

INSERT INTO `config_data` (`id`, `old_id`, `cat_id`, `is_active`) VALUES
(1, 126, 'BookLang', 1),
(2, 127, 'BookLang', 1),
(3, 120, 'BookRelease', 1),
(4, 121, 'BookRelease', 1),
(5, 122, 'BookRelease', 1),
(6, 123, 'BookRelease', 1),
(7, 124, 'BookRelease', 1),
(8, 125, 'BookRelease', 1),
(9, 128, 'BookRelease', 1),
(10, 129, 'BookRelease', 1),
(11, 130, 'BookRelease', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
