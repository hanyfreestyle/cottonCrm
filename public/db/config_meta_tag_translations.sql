-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2024 at 12:43 PM
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
-- Dumping data for table `config_meta_tag_translations`
--

INSERT INTO `config_meta_tag_translations` (`id`, `meta_tag_id`, `locale`, `name`, `des`, `g_title`, `g_des`) VALUES
(1, 1, 'ar', NULL, NULL, 'متجر قطن لبيع كل براندات وانواع مراتب السرير', 'متجر قطن لبيع كل براندات وانواع مراتب السرير'),
(2, 1, 'en', NULL, NULL, 'A cotton store that sells all brands and types of bed mattresses', 'A cotton store that sells all brands and types of bed mattresses'),
(3, 2, 'ar', 'من نحن', NULL, 'من نحن | متجر قطن لبيع كل براندات وانواع مراتب السرير', 'من نحن | متجر قطن لبيع كل براندات وانواع مراتب السرير'),
(4, 2, 'en', NULL, NULL, 'About Us | A cotton store that sells all brands and types of bed mattresses', 'About Us | A cotton store that sells all brands and types of bed mattresses'),
(5, 3, 'ar', NULL, NULL, 'المدونة | متجر قطن لبيع كل براندات وانواع مراتب السرير', 'المدونة | متجر قطن لبيع كل براندات وانواع مراتب السرير'),
(6, 3, 'en', NULL, NULL, 'Blog | Blog A cotton store that sells all brands and types of bed mattresses', 'Blog A cotton store that sells all brands and types of bed mattresses'),
(7, 4, 'ar', 'اتصل بنا', NULL, 'اتصل بنا |متجر قطن لبيع كل براندات وانواع مراتب السرير', 'اتصل بنا متجر قطن لبيع كل براندات وانواع مراتب السرير'),
(8, 4, 'en', NULL, NULL, 'Contact Us | A cotton store that sells all brands and types of bed mattresses', 'Contact Us A cotton store that sells all brands and types of bed mattresses'),
(9, 5, 'ar', 'سياسية الاستخدام', 'سياسية الاستخدام متجر قطن لبيع كل براندات وانواع مراتب السرير', 'سياسية الاستخدام متجر قطن لبيع كل براندات وانواع مراتب السرير', 'سياسية الاستخدام متجر قطن لبيع كل براندات وانواع مراتب السرير'),
(10, 5, 'en', NULL, NULL, 'Terms & Conditions', 'Terms & Conditions'),
(11, 6, 'ar', 'العروض والخصومات', 'العروض والخصومات متجر قطن لبيع كل براندات وانواع مراتب السرير', 'العروض والخصومات متجر قطن لبيع كل براندات وانواع مراتب السرير', 'العروض والخصومات متجر قطن لبيع كل براندات وانواع مراتب السرير'),
(12, 6, 'en', NULL, NULL, 'Offers A cotton store that sells all brands and types of bed mattresses', 'Offers A cotton store that sells all brands and types of bed mattresses'),
(13, 7, 'ar', 'خطاء 404', NULL, 'عذرًا !! الصفحة التي تبحث عنها غير موجودة.', 'عذرًا !! الصفحة التي تبحث عنها غير موجودة.'),
(14, 7, 'en', 'Error 404', NULL, 'Oops !! Page Not Found', 'Oops !! Page Not Found'),
(15, 8, 'ar', 'القائمة المفضلة', NULL, 'القائمة المفضلة | متجر قطن لبيع كل براندات وانواع مراتب السرير', 'القائمة المفضلة  متجر قطن لبيع كل براندات وانواع مراتب السرير'),
(16, 8, 'en', NULL, NULL, 'Wish List | A cotton store that sells all brands and types of bed mattresses', 'Wish List A cotton store that sells all brands and types of bed mattresses'),
(17, 9, 'ar', 'المتجر', 'متجر قطن لبيع كل براندات وانواع مراتب السرير', 'المتجر | متجر قطن لبيع كل براندات وانواع مراتب السرير', 'المتجر متجر قطن لبيع كل براندات وانواع مراتب السرير'),
(18, 9, 'en', NULL, NULL, 'Shop | A cotton store that sells all brands and types of bed mattresses', 'Shop A cotton store that sells all brands and types of bed mattresses'),
(19, 10, 'ar', 'العلامات التجارية', 'يعتبر متجر Cottton.shop أحد أشهر المتاجر الإلكترونية في مصر، حيث يوفر مجموعة كبيرة ومتنوعة من المنتجات المنزلية، بما في ذلك مُراتِب السَّرِير الفاخرة وذات الجودة العالية. ولتسهيل هذه المهمة عليكم، قُمنا بتجميع قائمة بأفضل ماركات المُراتِب التي يتوفرها المتجر، وذلك لتسهيل عليكم الاختيار المناسب لأحتياجاتكم.', 'العلامات التجارية | متجر قطن لبيع كل براندات وانواع مراتب السرير', 'يعتبر متجر Cottton.shop أحد أشهر المتاجر الإلكترونية في مصر، حيث يوفر مجموعة كبيرة ومتنوعة من المنتجات المنزلية،'),
(20, 10, 'en', NULL, NULL, 'العلامات التجارية', 'يعتبر متجر Cottton.shop أحد أشهر المتاجر الإلكترونية في مصر، حيث يوفر مجموعة كبيرة ومتنوعة من المنتجات المنزلية، بما في ذلك مُراتِب السَّرِير الفاخرة وذات الجودة العالية. ولتسهيل هذه المهمة عليكم، قُمنا بتجميع قائمة بأفضل ماركات المُراتِب التي يتوفرها المتجر، وذلك لتسهيل عليكم الاختيار المناسب لأحتياجاتكم.'),
(21, 11, 'ar', 'تسجيل دخول', 'انشاء حساب على الموقع يساعدك على اتمام عمليه الشراء والاستفادة من العروض والخصومات على منتجات الموقع', '%SiteName% تسجيل دخول', '%SiteName% تسجيل دخول'),
(22, 11, 'en', 'Login', 'Creating an account on the site will help you complete the purchase process and benefit from offers and discounts on the site’s products', '%SiteName% Login Page', '%SiteName% Login Page'),
(23, 12, 'ar', 'انشاء حساب جديد', 'انشاء حساب على الموقع يساعدك على اتمام عمليه الشراء والاستفادة من العروض والخصومات على منتجات الموقع', '%SiteName% انشاء حساب جديد', '%SiteName% انشاء حساب جديد'),
(24, 12, 'en', 'Sign Up', 'Creating an account on the site will help you complete the purchase process and benefit from offers and discounts on the site’s products', '%SiteName% Sign Up Page', '%SiteName% Sign Up Page'),
(25, 13, 'ar', 'حسابى', NULL, '%SiteName% حسابى', '%SiteName% حسابى'),
(26, 13, 'en', 'My Profile', NULL, '%SiteName% My Profile', '%SiteName% My Profile'),
(27, 14, 'ar', 'الاقسام', 'يعتبر متجر Cottton.shop أحد أشهر المتاجر الإلكترونية في مصر، حيث يوفر مجموعة كبيرة ومتنوعة من المنتجات المنزلية، بما في ذلك مُراتِب السَّرِير الفاخرة وذات الجودة العالية. ولتسهيل هذه المهمة عليكم، قُمنا بتجميع قائمة بأفضل ماركات المُراتِب التي يتوفرها المتجر، وذلك لتسهيل عليكم الاختيار المناسب لأحتياجاتكم.', '%SiteName% الاقسام', 'يعتبر متجر Cottton.shop أحد أشهر المتاجر الإلكترونية في مصر، حيث يوفر مجموعة كبيرة ومتنوعة من المنتجات المنزلية،'),
(28, 14, 'en', NULL, NULL, 'Categories', 'Categories'),
(29, 15, 'ar', 'البحث', 'البحث', '%SiteName%  البحث', '%SiteName%  البحث'),
(30, 15, 'en', '%SiteName%  البحث', '%SiteName%  البحث', '%SiteName%  البحث', '%SiteName%  البحث'),
(31, 16, 'ar', 'سلة المشتريات', 'سلة المشتريات متجر قطن لبيع كل براندات وانواع مراتب السرير', 'سلة المشتريات | متجر قطن لبيع كل براندات وانواع مراتب السرير', 'سلة المشتريات متجر قطن لبيع كل براندات وانواع مراتب السرير'),
(32, 16, 'en', 'Shopping cart', NULL, 'Shopping cart', 'Shopping cart');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
