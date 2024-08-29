-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2024 at 02:42 PM
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
-- Database: `app_crm`
--

--
-- Dumping data for table `users_back`
--

INSERT INTO `users_back` (`id`, `name`, `slug`, `email`, `phone`, `photo`, `photo_thum_1`, `roles_name`, `status`, `email_verified_at`, `password`, `des`, `crm_sales`, `crm_crm`, `crm_tech`, `crm_team`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'عصام عبد المنعم', 'عصام-عبد-المنعم', 'hany.freestyle4u@gmail.com', NULL, NULL, NULL, '[\"admin\"]', 1, NULL, '$2y$10$lp9y4uY8c4X3xo9gJuEVausK3zjBubmElz2ErdkDNVE0ytxVvRQNW', NULL, 0, 0, 0, NULL, NULL, '2024-08-29 11:40:23', '2024-08-29 11:40:23', NULL),
(2, 'هانى درويش', 'hanydarwish', 'HanyDarwish@hoover-eg.com', NULL, NULL, NULL, '[\"technician\"]', 1, NULL, '$2y$10$bNJtDduY5oJGXC5lYYuNI.iCDeASKVBa.h/4hnAHFAggxBFEimH6a', NULL, 0, 0, 1, NULL, NULL, '2024-08-29 14:40:24', '2024-08-29 14:40:24', NULL),
(3, 'احمد ذكي', 'ahmed-zaki', 'ahmed_zaki@hoover-eg.com', NULL, NULL, NULL, '[\"technician\"]', 1, NULL, '$2y$10$5ZLjzU2PKi3Z0.JKqIaDeOjlBQ8y1SBYlsxHRgCeH/VTVpwUwZntG', NULL, 0, 0, 1, NULL, NULL, '2024-08-29 14:40:24', '2024-08-29 14:40:24', NULL),
(4, 'محمد فهمي', 'mohamed-fahmy', 'mohamed_fahmy@hoover-eg.com', NULL, NULL, NULL, '[\"technician\"]', 1, NULL, '$2y$10$N/NtP8xwnviLRG1hqPOWY.0nVyYb6UblWyMYHQbnkOdtXLqNHPaL6', NULL, 0, 0, 1, NULL, NULL, '2024-08-29 14:40:24', '2024-08-29 14:40:24', NULL),
(5, 'خدمة العملاء', 'custserv', 'custserv@hoover-eg.com', NULL, NULL, NULL, '[\"technician\"]', 1, NULL, '$2y$10$CsX7ym7hUu6C.sl1HU48X.yP6xpgnJwH2DR28r6cwk0HvqMYYCAMa', NULL, 0, 0, 1, NULL, NULL, '2024-08-29 14:40:24', '2024-08-29 14:40:24', NULL),
(6, 'حماده مصطفى', 'hamada-mustafa', 'hamada_mustafa@hoover-eg.com', NULL, NULL, NULL, '[\"technician\"]', 1, NULL, '$2y$10$h6R/O.mkJjK6iGJUUwTZe.8U1ClhSVf2Tahgv.TyD/z7Xk1Hn7uUG', NULL, 0, 0, 1, NULL, NULL, '2024-08-29 14:40:24', '2024-08-29 14:40:24', NULL),
(7, 'شعبان محمد', 'office-user', 'office_user@hoover-eg.com', NULL, NULL, NULL, '[\"technician\"]', 1, NULL, '$2y$10$sKD2338MGdiWa6iwLVP83.Lbci607KClmVY7YLU0L.iOTINxnXdsO', NULL, 0, 0, 1, NULL, NULL, '2024-08-29 14:40:24', '2024-08-29 14:40:24', NULL),
(8, 'عادل عبد المنعم', 'adlabdelmoam', 'Adlabdelmoam@hoover-eg.com', NULL, NULL, NULL, '[\"technician\"]', 1, NULL, '$2y$10$Kh0R65mFb.bBOvC1ziwg9.lQ5LK2BNbVLVBNW21t0aWfZl6SyGzDO', NULL, 0, 0, 1, NULL, NULL, '2024-08-29 14:40:25', '2024-08-29 14:40:25', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
