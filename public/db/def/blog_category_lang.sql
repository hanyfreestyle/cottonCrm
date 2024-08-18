-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 05:37 AM
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
-- Dumping data for table `blog_category_lang`
--

INSERT INTO `blog_category_lang` (`id`, `category_id`, `locale`, `slug`, `name`, `des`, `g_title`, `g_des`) VALUES
(1, 1, 'ar', 'uncategorized', 'Uncategorized', '', 'Uncategorized', ''),
(2, 2, 'ar', 'المراتب', 'المراتب', 'تعتبر المراتب من العناصر الأساسية في أي غرفة نوم، حيث تساعد الشخص على الحصول على نوم مريح ومنعش. توجد العديد من أنواع المراتب المختلفة، فمنها المراتب السوست والمراتب الإسفنجية والميموري فوم والجيل وغيرها. تختلف كل نوع من المراتب في الخامات والمواد المستخدمة في صناعتها، وكذلك في الراحة والمتانة والأداء. يبحث الكثير من المستخدمين عن أفضل نوع من المراتب، ولذلك فإن الاطلاع على معلومات فنية حول كل نوع يساعد على اتخاذ القرار الصحيح عند الشراء. ومن المهم التأكد من جودة المرتبة وارتفاع مستوى الراحة التي تقدمها للشخص وتلبية احتياجات نومه وراحته.', 'المراتب', 'تعتبر المراتب من العناصر الأساسية في أي غرفة نوم، حيث تساعد الشخص على الحصول على نوم مريح ومنعش. توجد العديد من أنواع المراتب المختلفة، فمنها المراتب'),
(3, 3, 'ar', 'مخدات', 'مخدات', 'تعد المخدات من الأشياء الأساسية في غرفة النوم، حيث تساعد على الحصول على نوم مريح وصحي. وتتوفر العديد من أنواع المخدات في الأسواق بأسعار مختلفة ومن مواد مختلفة أيضًا، مثل البوليستر والإسفنج والفايبر العالي الجودة. وتوجد بعض المخدات الطبية التي تتميز بحشوات وأوزان مختلفة لتناسب جميع احتياجات الأفراد. من المهم اختيار المخدة التي تناسب وضعية النوم المفضلة لديهم وتقدم لهم الدعم والراحة المناسبين. وتقدم بعض الشركات مخدات ذات جودة عالية ومواصفات محددة، ويمكن شراؤها عبر الإنترنت أو من متجر قطن بأسعار مناسبة.', 'مخدات', 'تعد المخدات من الأشياء الأساسية في غرفة النوم، حيث تساعد على الحصول على نوم مريح وصحي. وتتوفر العديد من أنواع المخدات في الأسواق بأسعار مختلفة ومن مواد'),
(4, 3, 'en', 'pillows', 'Pillows', '<p>Pillows</p>', 'Pillows', 'Pillows'),
(5, 2, 'en', 'mattresses', 'Mattresses', '<p>Mattresses</p>', 'Mattresses', 'Mattresses');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
