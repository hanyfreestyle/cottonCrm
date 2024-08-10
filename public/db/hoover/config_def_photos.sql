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
-- Dumping data for table `config_def_photos`
--

INSERT INTO `config_def_photos` (`id`, `cat_id`, `photo`, `photo_thum_1`, `photo_thum_2`, `postion`, `created_at`, `updated_at`) VALUES
(1, 'dark_logo', 'images/def-photo/dark-logo-HASwbTTlt3.webp', NULL, NULL, 4, '2023-08-16 09:18:40', '2024-04-19 01:40:06'),
(3, 'sign_up', 'images/def-photo/sign-up-ExTDVJQ0jZ.webp', NULL, NULL, 10, '2023-08-16 09:18:40', '2024-04-29 21:39:14'),
(4, 'blog', 'images/def-photo/blog-sSiLq8bAtP.webp', 'images/def-photo/blog-5ZB06Gizki.webp', NULL, 6, '2023-08-16 09:18:40', '2024-04-29 21:39:14'),
(6, 'user_avatar', 'images/def-photo/user-avatar-y7fe0iAfe8.webp', NULL, NULL, 11, '2023-08-16 09:18:40', '2024-04-29 21:39:14'),
(7, 'contact_us', 'images/def-photo/contact-us-jWLeFp2u3v.webp', NULL, NULL, 9, '2023-08-16 11:28:03', '2024-04-29 21:39:14'),
(8, 'light_logo', 'images/def-photo/light-logo-RSSAIbGHFt.webp', NULL, NULL, 3, '2023-10-15 07:03:47', '2024-04-19 01:40:06'),
(9, 'categories', 'images/def-photo/categories-5Gbu0VR063.webp', 'images/def-photo/categories-vNt0Zh3qaO.webp', NULL, 8, '2023-10-17 06:11:28', '2024-04-29 21:39:14'),
(10, 'login', 'images/def-photo/login-ad8IkyUlcJ.webp', NULL, NULL, 12, '2023-10-17 15:36:15', '2024-04-29 21:39:14'),
(11, 'brand', 'images/def-photo/brand-n11stvanrV.webp', 'images/def-photo/brand-041rmiKQAN.webp', NULL, 7, '2024-01-24 08:02:39', '2024-04-29 21:39:14'),
(12, 'err_404', 'images/def-photo/err-404-sA6Pr2Ct2H.webp', NULL, NULL, 13, '2024-01-25 09:48:47', '2024-04-29 21:39:14'),
(13, 'thanks', 'images/def-photo/thanks-kc7RWwQE9g.webp', NULL, NULL, 14, '2024-01-28 16:23:45', '2024-04-29 21:39:14'),
(14, 'no_data', 'images/def-photo/no-data-fk1XLeMYcF.webp', NULL, NULL, 17, '2024-01-30 16:37:25', '2024-04-29 21:39:14'),
(15, 'logo', 'images/def-photo/logo-Y9LFly41Tg.webp', NULL, NULL, 2, '2024-02-21 14:53:44', '2024-04-19 01:40:06'),
(16, 'product', 'images/def-photo/product-R3103paOuR.webp', 'images/def-photo/product-0KqmTwpVJ5.webp', NULL, 1, '2024-04-14 23:19:18', '2024-04-25 02:48:01'),
(17, 'shipping', 'images/def-photo/shipping-sk3oDtqxOg.webp', NULL, NULL, 15, '2024-04-16 03:56:10', '2024-04-29 21:39:14'),
(18, 'search_start', 'images/def-photo/search-start-pqbJrKdx9S.webp', NULL, NULL, 16, '2024-04-19 01:38:41', '2024-04-29 21:39:14'),
(19, 'no_result', 'images/def-photo/no-result-71LgjcBIF0.webp', NULL, NULL, 18, '2024-04-19 01:39:24', '2024-04-29 21:39:14'),
(20, 'blog_t', 'images/def-photo/blog-t-BFirabuYZB.webp', 'images/def-photo/blog-t-JPshscLovA.webp', NULL, 5, '2024-04-29 21:38:55', '2024-04-29 21:39:14');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
