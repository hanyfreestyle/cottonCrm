-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2024 at 06:09 AM
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
-- Dumping data for table `pro_category_lang`
--

INSERT INTO `pro_category_lang` (`id`, `category_id`, `locale`, `slug`, `name`, `des`, `g_title`, `g_des`) VALUES
(1, 1, 'ar', 'سندوتشات-برجر', 'سندوتشات برجر', 'تذوّق الطعم الأصيل لكل قضمة – برجر شهي، لا يُقاوم!', 'سندوتشات برجر', 'تذوّق الطعم الأصيل لكل قضمة – برجر شهي، لا يُقاوم!'),
(2, 2, 'ar', 'سندوتشات-الفراخ', 'سندوتشات الفراخ', 'استمتع بمذاق الدجاج الطازج المحضّر بعناية، لا تفوّت النكهة!', 'سندوتشات الفراخ', 'استمتع بمذاق الدجاج الطازج المحضّر بعناية، لا تفوّت النكهة!'),
(3, 3, 'ar', 'فرايد-تشيكن', 'فرايد تشيكن', 'قرمشة لا تُنسى – جربها الآن واستمتع بالنكهة الفريدة!', 'فرايد تشيكن', 'قرمشة لا تُنسى – جربها الآن واستمتع بالنكهة الفريدة!'),
(4, 4, 'ar', 'مقبلات', 'مقبلات', 'ابدأ وجبتك بمقبلات لذيذة تمهّد للطعم المميز!', 'مقبلات', 'ابدأ وجبتك بمقبلات لذيذة تمهّد للطعم المميز!'),
(5, 5, 'ar', 'العروض', 'العروض', 'لا تفوّت الفرصة – عروض مميزة بأفضل الأسعار!', 'العروض', 'لا تفوّت الفرصة – عروض مميزة بأفضل الأسعار!'),
(6, 6, 'ar', 'الحلويات', 'الحلويات', 'حلِّ اليوم بلمسة حلوة – اختتم وجبتك مع أفضل الحلويات!', 'الحلويات', 'حلِّ اليوم بلمسة حلوة – اختتم وجبتك مع أفضل الحلويات!'),
(7, 6, 'en', 'desserts', 'Desserts', 'End your meal with a sweet touch – indulge in our finest desserts!', 'Desserts', 'End your meal with a sweet touch – indulge in our finest desserts!'),
(8, 7, 'ar', 'المشروبات', 'المشروبات', 'انتعش مع مشروباتنا المنعشة – اختر ما يناسب ذوقك!', 'المشروبات', 'انتعش مع مشروباتنا المنعشة – اختر ما يناسب ذوقك!'),
(9, 7, 'en', 'drinks', 'Drinks', 'Refresh yourself with our delightful drinks – pick your favorite!', 'Drinks', 'Refresh yourself with our delightful drinks – pick your favorite!'),
(10, 1, 'en', 'burger-sandwiches', 'Burger Sandwiches', 'Savor the authentic taste in every bite – irresistible burgers!', 'Burger Sandwiches', 'Savor the authentic taste in every bite – irresistible burgers!'),
(11, 2, 'en', 'chicken-sandwiches', 'Chicken Sandwiches', 'Enjoy the flavor of freshly prepared chicken, don’t miss out!', 'Chicken Sandwiches', 'Enjoy the flavor of freshly prepared chicken, don’t miss out!'),
(12, 3, 'en', 'fried-chicken', 'Fried Chicken', 'Unforgettable crunch – try it now and enjoy the unique taste!', 'Fried Chicken', 'Unforgettable crunch – try it now and enjoy the unique taste!'),
(13, 4, 'en', 'appetizers', 'Appetizers', 'Kickstart your meal with delicious appetizers that set the tone!', 'Appetizers', 'Kickstart your meal with delicious appetizers that set the tone!'),
(14, 5, 'en', 'special-offers', 'Special Offers', 'Don’t miss out – exclusive deals at the best prices!', 'Special Offers', 'Don’t miss out – exclusive deals at the best prices!');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
