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
-- Dumping data for table `pro_product_lang`
--

INSERT INTO `pro_product_lang` (`id`, `product_id`, `locale`, `slug`, `name`, `des`, `g_title`, `g_des`) VALUES
(1, 1, 'ar', 'كلاسيك-برجر', 'كلاسيك برجر', 'برجر لحم كلاسيكي مشوي مع الجبن والخس والطماطم وصلصة خاصة.', 'كلاسيك برجر', 'برجر لحم كلاسيكي مشوي مع الجبن والخس والطماطم وصلصة خاصة.'),
(2, 2, 'ar', 'هلابينو-برجر', 'هلابينو برجر', 'برجر لحم حار مع شرائح الهلابينو الحارة والجبن الذائب.', 'هلابينو برجر', 'برجر لحم حار مع شرائح الهلابينو الحارة والجبن الذائب.'),
(3, 3, 'ar', 'باربيكيو-برجر', 'باربيكيو برجر', 'برجر لحم مشوي مع صلصة الباربيكيو والبصل المكرمل.', 'باربيكيو برجر', 'برجر لحم مشوي مع صلصة الباربيكيو والبصل المكرمل.'),
(4, 4, 'ar', 'مشروم-برجر', 'مشروم برجر', 'برجر لحم مع شرائح المشروم المقلي والجبن السويسري.', 'مشروم برجر', 'برجر لحم مع شرائح المشروم المقلي والجبن السويسري.'),
(5, 5, 'ar', 'ستيك-برجر', 'ستيك برجر', 'برجر لحم مع شرائح الستيك الطرية والجبن.', 'ستيك برجر', 'برجر لحم مع شرائح الستيك الطرية والجبن.'),
(6, 6, 'ar', 'بيكون-برجر', 'بيكون برجر', 'برجر لحم مع شرائح البيكون المقرمشة والجبن الذائب.', 'بيكون برجر', 'برجر لحم مع شرائح البيكون المقرمشة والجبن الذائب.'),
(7, 7, 'ar', 'زنجر-بسطرمه', 'زنجر بسطرمه', 'سندوتش زنجر مع شرائح البسطرمة الحارة والجبن الذائب.', 'زنجر بسطرمه', 'سندوتش زنجر مع شرائح البسطرمة الحارة والجبن الذائب.'),
(8, 8, 'ar', 'زنجر-تركى', 'زنجر تركى', 'سندوتش زنجر مع الديك الرومي المدخن والصلصة التركية.', 'زنجر تركى', 'سندوتش زنجر مع الديك الرومي المدخن والصلصة التركية.'),
(9, 9, 'ar', 'زنجــر', 'زنجــر', 'سندوتش زنجر مقرمش مع الخس والطماطم والمايونيز.', 'زنجــر', 'سندوتش زنجر مقرمش مع الخس والطماطم والمايونيز.'),
(10, 10, 'ar', 'تشيكن-مشروم', 'تشيكن مشروم', 'سندوتش دجاج مع شرائح المشروم المقلية والجبن السويسري.', 'تشيكن مشروم', 'سندوتش دجاج مع شرائح المشروم المقلية والجبن السويسري.'),
(11, 11, 'ar', 'تشيزي-موزرايلا', 'تشيزي موزرايلا', 'سندوتش دجاج مع الجبن الموزاريلا الذائب وصلصة خاصة.', 'تشيزي موزرايلا', 'سندوتش دجاج مع الجبن الموزاريلا الذائب وصلصة خاصة.'),
(12, 12, 'ar', 'بيج-بيكون', 'بيج بيكون', 'سندوتش دجاج مع شرائح البيكون المقرمشة والجبن الذائب.', 'بيج بيكون', 'سندوتش دجاج مع شرائح البيكون المقرمشة والجبن الذائب.'),
(13, 13, 'ar', 'مينى-ميكس-بوكس', 'مينى ميكس بوكس', 'تشكيلة صغيرة من السندوتشات المتنوعة، مثالية للوجبات السريعة.', 'مينى ميكس بوكس', 'تشكيلة صغيرة من السندوتشات المتنوعة، مثالية للوجبات السريعة.'),
(14, 14, 'ar', 'فاميلي-استريس', 'فاميلي استريس', 'وجبة عائلية تضم مجموعة من السندوتشات والمقبلات، تناسب جميع الأذواق.', 'فاميلي استريس', 'وجبة عائلية تضم مجموعة من السندوتشات والمقبلات، تناسب جميع الأذواق.'),
(15, 15, 'ar', 'ميكس-بوكس', 'ميكس بوكس', 'تشكيلة متنوعة من السندوتشات المفضلة مع المقبلات.', 'ميكس بوكس', 'تشكيلة متنوعة من السندوتشات المفضلة مع المقبلات.'),
(16, 16, 'ar', 'الكومندوز', 'الكومندوز', '4 قطع دجاج - 4 قطع استربس - 6 قطع خبز - 2 ارز - 2 بطاطس - 2 كلوسلو - 2 توميه - 1 سندوتش فاهيتا - 1 لتر بيبسي', NULL, NULL),
(17, 17, 'ar', 'سوبر-ميجا', 'سوبر ميجا', '8 قطع دجاج - 8 قطع استربس - 8 قطع خبز - 2 ارز - 2 بطاطس- 2 كلوسلو - 2 توميه - 2 سندوتش جريلو راوند - 1 لتر بيسبي', NULL, NULL),
(18, 18, 'ar', 'أكسترا-فاير', 'أكسترا فاير', 'وجبة كبيرة بمكونات لذيذة، مثالية للمشاركة لعشاق الطعم الناري، تجربة لا تُنسى', NULL, NULL),
(19, 19, 'ar', 'عرض-التوينز', 'عرض التوينز', 'وجبة مزدوجة لمشاركة النكهة مع شخص آخر', NULL, NULL),
(20, 20, 'ar', 'فامليى-ميل', 'فامليى ميل', 'وجبة عائلية كبيرة تضم تشكيلة متنوعة من الأطباق لتشاركها مع العائلة.', 'فامليى ميل', 'وجبة عائلية كبيرة تضم تشكيلة متنوعة من الأطباق لتشاركها مع العائلة.'),
(21, 21, 'ar', 'ريــزو', 'ريــزو', 'أرز ريزو المتبل والمقرمش، يقدم كطبق جانبي لذيذ.', 'ريــزو', 'أرز ريزو المتبل والمقرمش، يقدم كطبق جانبي لذيذ.'),
(22, 22, 'ar', 'كلوسلو', 'كلوسلو', 'سلطة الكولسلو الطازجة مع صلصة الكريمية، مثالية مع السندوتشات.', 'كلوسلو', 'سلطة الكولسلو الطازجة مع صلصة الكريمية، مثالية مع السندوتشات.'),
(23, 23, 'ar', 'توميه', 'توميه', 'صلصة الثوم الكريمية الحادة، تقدم كغمس لذيذ.', 'توميه', 'صلصة الثوم الكريمية الحادة، تقدم كغمس لذيذ.'),
(24, 24, 'ar', 'بطاطس', 'بطاطس', 'بطاطس مقلية ذهبية ومقرمشة، تقدم ساخنة.', 'بطاطس', 'بطاطس مقلية ذهبية ومقرمشة، تقدم ساخنة.'),
(25, 25, 'ar', 'تيراميسو-كلاسيك', 'تيراميسو كلاسيك', 'طبقات من البسكويت المغموس في القهوة مع طبقة غنية من كريمة الماسكاربوني.', NULL, NULL),
(26, 25, 'en', 'classic-tiramisu', 'Classic Tiramisu', 'Layers of coffee-soaked biscuits topped with a rich mascarpone cream.', NULL, NULL),
(27, 26, 'ar', 'وافلز-مع-الآيس-كريم', 'وافلز مع الآيس كريم', 'وافلز مقرمشة تقدم مع آيس كريم من اختيارك وصلصة الشوكولاتة.', NULL, NULL),
(28, 26, 'en', 'waffles-with-ice-cream', 'Waffles with Ice Cream', 'Crispy waffles served with your choice of ice cream and chocolate sauce.', NULL, NULL),
(29, 27, 'ar', 'كريم-بروليه', 'كريم بروليه', 'كريم بروليه فرنسي كلاسيكي مع طبقة سكر مقرمشة.', NULL, NULL),
(30, 27, 'en', 'crème-brûlée', 'Crème Brûlée', 'Classic French crème brûlée with a crispy caramelized sugar topping.', NULL, NULL),
(31, 28, 'ar', 'آيس-كريم-الفانيليا-بالفواكه', 'آيس كريم الفانيليا بالفواكه', 'آيس كريم فانيليا طازج يقدم مع مجموعة متنوعة من الفواكه الموسمية.', NULL, NULL),
(32, 28, 'en', 'vanilla-ice-cream-with-fruits', 'Vanilla Ice Cream with Fruits', 'Fresh vanilla ice cream served with a variety of seasonal fruits.', NULL, NULL),
(33, 29, 'ar', 'مياه-معدنية', 'مياه معدنية', 'مياه نقية منعشة توفر الترطيب المثالي.', NULL, NULL),
(34, 29, 'en', 'water', 'Water', 'Refreshing pure water for optimal hydration.', NULL, NULL),
(35, 30, 'ar', 'مياه-غازية', 'مياه غازية', 'مياه غازية منعشة بفقاعات لطيفة.', NULL, NULL),
(36, 30, 'en', 'sparkling-water', 'Sparkling Water', 'Refreshing sparkling water with gentle bubbles.', NULL, NULL),
(37, 31, 'ar', 'عصير-برتقال', 'عصير برتقال', 'عصير برتقال طبيعي 100%، منعش ومليء بالفيتامينات.', NULL, NULL),
(38, 31, 'en', 'orange-juice', 'Orange Juice', '100% natural orange juice, refreshing and packed with vitamins.', NULL, NULL),
(39, 32, 'ar', 'عصير-مانجو', 'عصير مانجو', 'عصير مانجو طازج وحلو، مثالي لمحبي الفواكه الاستوائية.', NULL, NULL),
(40, 32, 'en', 'mango-juice', 'Mango Juice', 'Fresh, sweet mango juice, perfect for tropical fruit lovers.', NULL, NULL),
(41, 1, 'en', 'classic-burger', 'Classic Burger', 'Grilled classic beef burger with cheese, lettuce, tomato, and special sauce.', 'Classic Burger', 'Grilled classic beef burger with cheese, lettuce, tomato, and special sauce.'),
(42, 2, 'en', 'jalapeno-burger', 'Jalapeno Burger', 'Spicy beef burger with jalapeno slices and melted cheese.', 'Jalapeno Burger', 'Spicy beef burger with jalapeno slices and melted cheese.'),
(43, 3, 'en', 'bbq-burger', 'BBQ Burger', 'Grilled beef burger with BBQ sauce and caramelized onions.', 'BBQ Burger', 'Grilled beef burger with BBQ sauce and caramelized onions.'),
(44, 4, 'en', 'mushroom-burger', 'Mushroom Burger', 'Beef burger with sautéed mushroom slices and Swiss cheese.', 'Mushroom Burger', 'Beef burger with sautéed mushroom slices and Swiss cheese.'),
(45, 5, 'en', 'steak-burger', 'Steak Burger', 'Beef burger topped with tender steak slices and cheese.', 'Steak Burger', 'Beef burger topped with tender steak slices and cheese.'),
(46, 6, 'en', 'bacon-burger', 'Bacon Burger', 'Beef burger with crispy bacon strips and melted cheese.', 'Bacon Burger', 'Beef burger with crispy bacon strips and melted cheese.'),
(47, 7, 'en', 'pastrami-zinger', 'Pastrami Zinger', 'Zinger sandwich with spicy pastrami slices and melted cheese.', 'Pastrami Zinger', 'Zinger sandwich with spicy pastrami slices and melted cheese.'),
(48, 8, 'en', 'turkish-zinger', 'Turkish Zinger', 'Zinger sandwich with smoked turkey and Turkish sauce.', 'Turkish Zinger', 'Zinger sandwich with smoked turkey and Turkish sauce.'),
(49, 9, 'en', 'zinger', 'Zinger', 'Crispy zinger sandwich with lettuce, tomato, and mayo.', 'Zinger', 'Crispy zinger sandwich with lettuce, tomato, and mayo.'),
(50, 10, 'en', 'chicken-mushroom', 'Chicken Mushroom', 'Chicken sandwich with sautéed mushrooms and Swiss cheese.', 'Chicken Mushroom', 'Chicken sandwich with sautéed mushrooms and Swiss cheese.'),
(51, 11, 'en', 'cheesy-mozzarella', 'Cheesy Mozzarella', 'Chicken sandwich with melted mozzarella cheese and special sauce.', 'Cheesy Mozzarella', 'Chicken sandwich with melted mozzarella cheese and special sauce.'),
(52, 12, 'en', 'big-bacon', 'Big Bacon', 'Chicken sandwich with crispy bacon strips and melted cheese.', 'Big Bacon', 'Chicken sandwich with crispy bacon strips and melted cheese.'),
(53, 13, 'en', 'mini-mix-box', 'Mini Mix Box', 'A small assortment of various sandwiches, perfect for a quick meal.', 'Mini Mix Box', 'A small assortment of various sandwiches, perfect for a quick meal.'),
(54, 14, 'en', 'family-stress', 'Family Stress', 'Family meal featuring a variety of sandwiches and appetizers, catering to all tastes.', 'Family Stress', 'Family meal featuring a variety of sandwiches and appetizers, catering to all tastes.'),
(55, 15, 'en', 'mix-box', 'Mix Box', 'A mixed selection of favorite sandwiches along with appetizers.', 'Mix Box', 'A mixed selection of favorite sandwiches along with appetizers.'),
(56, 20, 'en', 'family-meal', 'Family Meal', 'A large family meal with a variety of dishes to share with the family.', 'Family Meal', 'A large family meal with a variety of dishes to share with the family.'),
(57, 21, 'en', 'rizo', 'Rizo', 'Spiced and crispy Rizo rice, served as a tasty side dish.', 'Rizo', 'Spiced and crispy Rizo rice, served as a tasty side dish.'),
(58, 22, 'en', 'coleslaw', 'Coleslaw', 'Fresh coleslaw salad with creamy dressing, perfect with sandwiches.', 'Coleslaw', 'Fresh coleslaw salad with creamy dressing, perfect with sandwiches.'),
(59, 23, 'en', 'toumia', 'Toumia', 'Tangy creamy garlic sauce, served as a delicious dip.', 'Toumia', 'Tangy creamy garlic sauce, served as a delicious dip.'),
(60, 24, 'en', 'fries', 'Fries', 'Golden, crispy fried potatoes, served hot.', 'Fries', 'Golden, crispy fried potatoes, served hot.'),
(61, 16, 'en', 'commandos', 'Commandos', '4 chicken - 4 strips - 6 bread - 2 rice - 2 potatoes - 2 coleslaw - 2 toumiya - 1 fajita sandwich - 1 liter of Pepsi', NULL, NULL),
(62, 17, 'en', 'super-mega', 'Super Mega', '8 chicken - 8 strips - 8 bread - 2 rice - 2 potatoes - 2 coleslaw - 2 tomato sauce - 2 grilled round sandwiches - 1 liter of Pepsi', NULL, NULL),
(63, 18, 'en', 'extra-fire', 'Extra Fire', 'A large meal with delicious ingredients, perfect for sharing and for spicy food lovers.', NULL, NULL),
(64, 19, 'en', 'twins-offer', 'Twins Offer', 'A double meal to share the flavor with someone else.', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
