-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2024 at 06:12 PM
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
(1, 'عصام عبد المنعم', 'عصام-عبد-المنعم', 'hany.freestyle4u@gmail.com', NULL, NULL, NULL, '[\"admin\"]', 1, NULL, '$2y$10$pRw3CJN3gNaZUL1MS3Kii.HIM5svwrAXAn.gauJkCdQC8vc5ltrLG', NULL, 0, 0, 0, NULL, NULL, '2024-08-28 15:10:47', '2024-08-28 15:10:47', NULL),
(2, 'هانى درويش', 'hanydarwish', 'HanyDarwish@hoover-eg.com', NULL, NULL, NULL, '[\"technician\"]', 1, NULL, '$2y$10$5UY8UlIdHA04vncOlZA0SewdbRqRdmxTzGnmDAW/rlulISlDtfHYG', NULL, 0, 0, 1, NULL, NULL, '2024-08-28 15:10:47', '2024-08-28 15:10:47', NULL),
(3, 'احمد ذكي', 'ahmed-zaki', 'ahmed_zaki@hoover-eg.com', NULL, NULL, NULL, '[\"technician\"]', 1, NULL, '$2y$10$cuRDx2H4Rhy4NHQbKtDdzOOB6keQ/wbbLi794TB3rhCgBiUu2smnm', NULL, 0, 0, 1, NULL, NULL, '2024-08-28 15:10:47', '2024-08-28 15:10:47', NULL),
(4, 'محمد فهمي', 'mohamed-fahmy', 'mohamed_fahmy@hoover-eg.com', NULL, NULL, NULL, '[\"technician\"]', 1, NULL, '$2y$10$2oH5wCGwAtPo9KWkx3uC2uCp7YsWBm4xluQV.lujeXrHevr0AfLzy', NULL, 0, 0, 1, NULL, NULL, '2024-08-28 15:10:47', '2024-08-28 15:10:47', NULL),
(5, 'خدمة العملاء', 'custserv', 'custserv@hoover-eg.com', NULL, NULL, NULL, '[\"technician\"]', 1, NULL, '$2y$10$.uSHDnsb6rMHZgo/pQ/jcu3e2KPtly8WoRKZ9FdlC2Uhp2nTPHcMq', NULL, 0, 0, 1, NULL, NULL, '2024-08-28 15:10:47', '2024-08-28 15:10:47', NULL),
(6, 'حماده مصطفى', 'hamada-mustafa', 'hamada_mustafa@hoover-eg.com', NULL, NULL, NULL, '[\"technician\"]', 1, NULL, '$2y$10$INNaNdQwANjtdtGkxb3nmuTspysmVfxt3/SyVdl0rcYu/ZHnJ.HhK', NULL, 0, 0, 1, NULL, NULL, '2024-08-28 15:10:47', '2024-08-28 15:10:47', NULL),
(7, 'شعبان محمد', 'office-user', 'office_user@hoover-eg.com', NULL, NULL, NULL, '[\"technician\"]', 1, NULL, '$2y$10$X.htFBiyMA5yLP9JJfxZjOHDNqZU8tZNegCLJnBnjAwt0LFSARBV6', NULL, 0, 0, 1, NULL, NULL, '2024-08-28 15:10:48', '2024-08-28 15:10:48', NULL),
(8, 'عادل عبد المنعم', 'adlabdelmoam', 'Adlabdelmoam@hoover-eg.com', NULL, NULL, NULL, '[\"technician\"]', 1, NULL, '$2y$10$vahPB9.BksPwJI90i5.YguMuNxv6ATbNRF.DuDst9j0kNSIU54iEO', NULL, 0, 0, 1, NULL, NULL, '2024-08-28 15:10:48', '2024-08-28 15:10:48', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
