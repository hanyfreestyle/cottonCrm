-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 07:07 AM
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
-- Database: `onfire_new`
--

--
-- Dumping data for table `pro_product`
--

INSERT INTO `pro_product` (`id`, `sku`, `price`, `regular_price`, `qty_left`, `qty_max`, `unit`, `photo`, `photo_thum_1`, `is_active`, `is_archived`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 95.00, NULL, 10, 10, NULL, 'images/product/1/1696769522_SVqrAch1Dr3iAFM_.webp', 'images/product/1/1696769522_UjLnqB0xjLF7u7K_.webp', 1, 0, '2023-10-08 11:50:00', '2023-10-08 11:52:02', NULL),
(2, NULL, 100.00, NULL, 10, 10, NULL, 'images/product/2/1696769637_N4P4E9dzCfVifF0_.webp', 'images/product/2/1696769637_ozO7SkjHrLmzbVQ_.webp', 1, 0, '2023-10-08 11:52:48', '2023-10-08 11:53:57', NULL),
(3, NULL, 100.00, NULL, 10, 10, NULL, 'images/product/3/1696769708_s84Kb7HgcRYYZ3S_.webp', 'images/product/3/1696769708_Whc9gWBfcH71QwO_.webp', 1, 0, '2023-10-08 11:54:56', '2023-10-08 11:55:08', NULL),
(4, NULL, 105.00, NULL, 10, 10, NULL, 'images/product/4/1696769758_1P28PNM3tS2NyL6_.webp', 'images/product/4/1696769758_7A7DZuzpITWvUgN_.webp', 1, 0, '2023-10-08 11:55:58', '2023-10-08 11:55:58', NULL),
(5, NULL, 105.00, NULL, 10, 10, NULL, 'images/product/5/1696769787_574ZDVGFE8unnon_.webp', 'images/product/5/1696769787_qXvcXMAFROwm0h6_.webp', 1, 0, '2023-10-08 11:56:27', '2023-10-08 11:56:27', NULL),
(6, NULL, 105.00, NULL, 10, 10, NULL, 'images/product/6/1696769813_nEqSYss52nPa2F6_.webp', 'images/product/6/1696769813_D8ExFPtODbB00tN_.webp', 1, 0, '2023-10-08 11:56:53', '2023-10-08 11:56:53', NULL),
(7, NULL, 100.00, NULL, 10, 10, NULL, 'images/product/7/1696769848_uGA03oOHVugfWHA_.webp', 'images/product/7/1696769849_YxETO27EsXkyv4u_.webp', 1, 0, '2023-10-08 11:57:28', '2023-10-08 11:57:29', NULL),
(8, NULL, 100.00, NULL, 10, 10, NULL, 'images/product/8/1696769877_ClRZLofV5RmQekV_.webp', 'images/product/8/1696769877_avcms1JnRFdI3pA_.webp', 1, 0, '2023-10-08 11:57:57', '2023-10-08 11:57:58', NULL),
(9, NULL, 100.00, NULL, 10, 10, NULL, 'images/product/9/1696769902_Uz3HShmV6qhYeCT_.webp', 'images/product/9/1696769902_qp158JXXbZvYpmq_.webp', 1, 0, '2023-10-08 11:58:22', '2023-10-08 11:58:22', NULL),
(10, NULL, 100.00, NULL, 10, 10, NULL, 'images/product/10/1696769928_zFTDCCEKjlMqOMN_.webp', 'images/product/10/1696769928_GAQGRw41fC1aC1N_.webp', 1, 0, '2023-10-08 11:58:48', '2023-10-08 11:58:48', NULL),
(11, NULL, 100.00, NULL, 10, 10, NULL, 'images/product/11/1696769955_yGM3AA7PCZvQlPM_.webp', 'images/product/11/1696769955_bjRzVeFllgKSDLg_.webp', 1, 0, '2023-10-08 11:59:15', '2023-10-08 11:59:15', NULL),
(12, NULL, 100.00, NULL, 10, 10, NULL, 'images/product/12/1696769981_ipuvl6I9Py9dJEn_.webp', 'images/product/12/1696769981_7jyckjk0qcuI1tS_.webp', 1, 0, '2023-10-08 11:59:41', '2023-10-08 11:59:41', NULL),
(13, NULL, 99.00, NULL, 10, 10, NULL, 'images/product/13/1696770024_8jywjcN7qY2c9eW_.webp', 'images/product/13/1696770024_4tW3vEnnIDPsa3s_.webp', 1, 0, '2023-10-08 12:00:07', '2023-10-08 12:00:24', NULL),
(14, NULL, 190.00, NULL, 10, 10, NULL, 'images/product/14/1696770091_rjrfBrNRYChvfP9_.webp', 'images/product/14/1696770091_Ago6CUIPM1A9nba_.webp', 1, 0, '2023-10-08 12:01:30', '2023-10-08 12:01:31', NULL),
(15, NULL, 215.00, NULL, 10, 10, NULL, 'images/product/15/1696770167_M787jhyC8cdcDAB_.webp', 'images/product/15/1696770167_quM48SnIXCfQ8l2_.webp', 1, 0, '2023-10-08 12:02:47', '2023-10-08 12:02:47', NULL),
(16, NULL, 350.00, NULL, 10, 10, NULL, 'images/product/16/1696770196_h3wBvq6xO7FHJNx_.webp', 'images/product/16/1696770197_G4r4SQrzn7oBYgi_.webp', 1, 0, '2023-10-08 12:03:16', '2023-10-08 12:03:17', NULL),
(17, NULL, 555.00, NULL, 10, 10, NULL, 'images/product/17/1696770230_1s0afkcMIlzdv4i_.webp', 'images/product/17/1696770230_EsfGpXaQMReRLbt_.webp', 1, 0, '2023-10-08 12:03:49', '2023-10-08 12:03:50', NULL),
(18, NULL, 129.00, NULL, 10, 10, NULL, 'images/product/18/1696770269_lJJbYqzo6oaC9A1_.webp', 'images/product/18/1696770269_JUS5R9YN1S1LXNN_.webp', 1, 0, '2023-10-08 12:04:29', '2023-10-08 12:04:30', NULL),
(19, NULL, 129.00, NULL, 10, 10, NULL, 'images/product/19/1696770300_xbBIcKM9oIINRi0_.webp', 'images/product/19/1696770300_5CMbbXUuE3i4Ewf_.webp', 1, 0, '2023-10-08 12:05:00', '2023-10-08 12:05:00', NULL),
(20, NULL, 300.00, NULL, 10, 10, NULL, 'images/product/20/1696770338_0VRGqIHL12uwknQ_.webp', 'images/product/20/1696770339_jOuWZlyoR5BpRZ9_.webp', 1, 0, '2023-10-08 12:05:38', '2023-10-08 12:05:39', NULL),
(21, NULL, 45.00, NULL, 10, 10, NULL, 'images/product/21/1696770368_H72myxiaLBLvurI_.webp', 'images/product/21/1696770368_nlSD3MV6gjKh5Mm_.webp', 1, 0, '2023-10-08 12:06:08', '2023-10-08 12:06:09', NULL),
(22, NULL, 15.00, NULL, 10, 10, NULL, 'images/product/22/1696770411_YnRQgtyNBRsYe1f_.webp', 'images/product/22/1696770411_huox8j2meSivkiR_.webp', 1, 0, '2023-10-08 12:06:51', '2023-10-08 12:06:51', NULL),
(23, NULL, 15.00, NULL, 10, 10, NULL, 'images/product/23/1696770441_uwhnpqagjxQBapZ_.webp', 'images/product/23/1696770441_plXHV6HuvvZ6YKn_.webp', 1, 0, '2023-10-08 12:07:21', '2023-10-08 12:07:21', NULL),
(24, NULL, 55.00, NULL, 10, 10, NULL, 'images/product/24/1696770478_50DajoAZdeJ3k78_.webp', 'images/product/24/1696770478_TTzudUpdSo6uyLL_.webp', 1, 0, '2023-10-08 12:07:58', '2023-10-08 12:07:59', NULL),
(25, NULL, 50.00, NULL, NULL, 10, NULL, 'images/product/25/classic-tiramisu-3QG0Dluppd.webp', 'images/product/25/classic-tiramisu-qlL1PdkniX.webp', 1, 0, '2024-10-27 10:54:47', '2024-10-27 12:05:26', NULL),
(26, NULL, 60.00, NULL, NULL, 10, NULL, 'images/product/26/waffles-with-ice-cream-OCPoRjQZpJ.webp', 'images/product/26/waffles-with-ice-cream-GHuGdb9PSj.webp', 1, 0, '2024-10-27 10:55:40', '2024-10-27 12:08:03', NULL),
(27, NULL, 30.00, NULL, NULL, 10, NULL, 'images/product/27/crème-brûlée-W0muRiZTDW.webp', 'images/product/27/crème-brûlée-HuY95KhIG3.webp', 1, 0, '2024-10-27 10:56:17', '2024-10-27 12:10:42', NULL),
(28, NULL, 30.00, NULL, NULL, 10, NULL, 'images/product/28/vanilla-ice-cream-with-fruits-qSyLenglBR.webp', 'images/product/28/vanilla-ice-cream-with-fruits-skTjS7zo2E.webp', 1, 0, '2024-10-27 10:56:55', '2024-10-27 12:13:25', NULL),
(29, NULL, 5.00, NULL, NULL, 10, NULL, 'images/product/29/water-TKgz8HSsbF.webp', 'images/product/29/water-tKuPGtoF8j.webp', 1, 0, '2024-10-27 11:01:39', '2024-10-27 11:56:23', NULL),
(30, NULL, 15.00, NULL, NULL, 10, NULL, 'images/product/30/sparkling-water-vO7xDvctuD.webp', 'images/product/30/sparkling-water-MQGq4aflbT.webp', 1, 0, '2024-10-27 11:02:15', '2024-10-27 11:48:16', NULL),
(31, NULL, 50.00, NULL, NULL, 10, NULL, 'images/product/31/orange-juice-H5xCbkmQxT.webp', 'images/product/31/orange-juice-gfuaxlSKaB.webp', 1, 0, '2024-10-27 11:03:03', '2024-10-27 11:58:26', NULL),
(32, NULL, 80.00, NULL, NULL, 10, NULL, 'images/product/32/mango-juice-t96LLtwopH.webp', 'images/product/32/mango-juice-jyo72VLdXS.webp', 1, 0, '2024-10-27 11:04:31', '2024-10-27 12:04:19', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
