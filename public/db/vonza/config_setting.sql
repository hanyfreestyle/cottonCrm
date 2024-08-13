-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2024 at 09:06 PM
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
-- Dumping data for table `config_setting`
--

INSERT INTO `config_setting` (`id`, `web_url`, `web_status`, `switch_lang`, `users_login`, `phone_num`, `whatsapp_num`, `phone_call`, `whatsapp_send`, `email`, `def_url`, `facebook`, `youtube`, `twitter`, `instagram`, `linkedin`, `google_api`, `telegram_send`, `telegram_key`, `telegram_phone`, `telegram_group`, `page_about`, `page_warranty`, `page_shipping`, `pro_sale_lable`, `pro_quick_view`, `pro_quick_shop`, `pro_warranty_tab`, `pro_shipping_tab`, `pro_social_share`, `serach`, `serach_type`, `wish_list`, `schema_type`, `schema_lat`, `schema_long`, `schema_postal_code`, `schema_country`) VALUES
(1, '#', 1, NULL, NULL, '0100-34-00002', '0100-34-00002', '01003400002', '201003400002', 'shopcottton@gmail.com', 'https://cottton.shop', 'https://www.facebook.com/', 'https://www.youtube.com', 'https://www.twitter.com/', 'https://www.Instagram.com/', 'https://www.linkedin.com/', NULL, 0, 'eyJpdiI6InBnSTNHbEVHcHZ0VnlXK1JBejNhYWc9PSIsInZhbHVlIjoicStKZ2FSYWRicm8yUHBvQkNwaWtUT0RHZWEvY0NYcDQyOHAwRThKTWZYclJHQ0dhZERab1VDNHpLL3VnbVVEdCIsIm1hYyI6IjJiOTAwYjJiZDQwNjhkNDJiZDlkNmRiOWEwZjhjODVjZDkxMGM0OWJjMTU0OGJjNmZlNjAxMDM3YjI3NmNmOWIiLCJ0YWciOiIifQ==', 'eyJpdiI6IlhoMGtNMW4vTWdQSG5TenhVZ2lrL3c9PSIsInZhbHVlIjoiNjBtcDQwc0hjdmlLbjZ0SnpSekF2UT09IiwibWFjIjoiMWQyNTkyNGZhMWMzNDBmOTUyMWUwNDNmOTY3YTA0Y2VhZjRhZGZmOTAyMzc4YjdhMTc3MGMxYWJiOTYxMzI1ZCIsInRhZyI6IiJ9', 'eyJpdiI6Ii9aU0xtalVlUDc2TnNaVW9IR3VneUE9PSIsInZhbHVlIjoidkdKYVZJL2pITzZ1MjFDdGwvSEM4QT09IiwibWFjIjoiOTE0YjkyNjE2YjVhMDQ5ZDM5ZDdjMDFiYWU1MzhhMDUyYzFkODczZDUzMTI0Y2I2ODcyN2YxOTczODdhNjE3OCIsInRhZyI6IiJ9', 1, 2, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Store', NULL, NULL, '21111', 'EG');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
