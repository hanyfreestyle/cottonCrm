-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 11:53 AM
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
-- Dumping data for table `config_settings`
--

INSERT INTO `config_settings` (`id`, `web_url`, `web_status`, `switch_lang`, `users_login`, `serach`, `serach_type`, `wish_list`, `phone_num`, `whatsapp_num`, `phone_call`, `whatsapp_send`, `email`, `def_url`, `facebook`, `youtube`, `twitter`, `instagram`, `linkedin`, `google_api`, `telegram_send`, `telegram_key`, `telegram_phone`, `telegram_group`, `page_about`, `page_warranty`, `page_shipping`, `pro_sale_lable`, `pro_quick_view`, `pro_quick_shop`, `pro_warranty_tab`, `pro_shipping_tab`, `pro_social_share`, `schema_type`, `schema_lat`, `schema_long`, `schema_postal_code`, `schema_country`) VALUES
(1, '#', 1, 0, 1, 1, 1, 1, '0100-34-00002', '0100-34-00002', '01003400002', '201003400002', 'shopcottton@gmail.com', 'https://cottton.shop', 'https://www.facebook.com/', 'https://www.youtube.com', 'https://www.twitter.com/', 'https://www.Instagram.com/', 'https://www.linkedin.com/', NULL, 0, '6313317483:AAEooBTEFel1ej1uaDpXcZzCrbX_ID3aYEw', '-4091280818', '200119925', 1, 2, 3, 1, 1, 1, 1, 1, 1, 'Store', NULL, NULL, '21111', 'EG');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
