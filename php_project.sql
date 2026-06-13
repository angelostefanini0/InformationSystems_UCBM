-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 04, 2025 at 06:05 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`),
  KEY `idx_orders_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(1, 25.00, 'on hold', 1, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-12 16:27:08'),
(2, 25.00, 'on hold', 1, '29298292', 'Milano', 'Via Deruta 19', '2025-03-12 16:44:26'),
(3, 25.00, 'on hold', 1, '29298292', 'Milano', 'Via Deruta 19', '2025-03-12 16:46:24'),
(4, 25.00, 'on hold', 1, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-12 16:46:52'),
(5, 25.00, 'on hold', 1, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-12 16:47:44'),
(6, 20.00, 'on hold', 1, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-13 07:40:39'),
(7, 5.00, 'on hold', 1, '29298292', 'Milano', 'Via Deruta 19', '2025-03-13 23:00:22'),
(8, 5.00, 'on hold', 1, '29298292', 'Milano', 'Via Deruta 19', '2025-03-14 00:27:42'),
(9, 5.00, 'on hold', 1, '29298292', 'Milano', 'Via Deruta 19', '2025-03-14 14:57:58'),
(10, 5.00, 'on hold', 1, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-14 15:25:48'),
(11, 5.00, 'on hold', 1, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-14 15:30:15'),
(13, 5.00, 'on hold', 4, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-15 18:36:47'),
(14, 5.00, 'on hold', 4, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-15 18:37:59'),
(15, 0.00, 'on hold', 5, '12', '12', '12', '2025-03-15 18:41:56'),
(16, 0.00, 'on hold', 4, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-15 18:46:01'),
(17, 5.00, 'on hold', 7, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-15 18:54:20'),
(18, 55.00, 'on hold', 4, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-15 18:58:47'),
(35, 5.00, 'on hold', 8, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-18 19:20:09'),
(36, 30.00, 'paid', 8, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-18 19:20:55'),
(37, 5.00, 'on hold', 8, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-18 19:22:54'),
(38, 0.00, 'on hold', 8, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-18 19:23:24'),
(109, 29.00, 'paid', 4, '3400072837', 'ROMA', '19 Via Deruta', '2025-03-26 15:08:54'),
(110, 40.00, 'on hold', 11, '112112122', 'Roma', 'Via Deruta 19', '2025-03-26 21:13:11'),
(111, 120.00, 'on hold', 4, '3400072837', 'ROMA', '19 Via Deruta', '2025-03-26 21:55:48'),
(112, 130.00, 'on hold', 4, '3400072837', 'ROMA', '19 Via Deruta', '2025-03-26 22:03:59'),
(113, 120.00, 'on hold', 4, '3400072837', 'ROMA', '19 Via Deruta', '2025-03-26 22:04:22'),
(114, 40.00, 'on hold', 4, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-26 22:25:49'),
(115, 40.00, 'paid', 4, '3400072837', 'ROMA', '19 Via Deruta', '2025-03-26 22:39:40'),
(116, 30.00, 'on hold', 4, '3400072837', 'ROMA', '19 Via Deruta', '2025-03-27 16:19:19'),
(117, 29.00, 'on hold', 4, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-28 09:39:35'),
(118, -435.00, 'on hold', 4, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-28 10:46:03'),
(119, 29.00, 'on hold', 4, '3400072836', 'Padova', 'Via Deruta 19', '2025-03-28 11:33:50'),
(120, 29.00, 'on hold', 4, '3400072837', 'ROMA', '19 Via Deruta', '2025-03-28 12:06:43'),
(121, 522.00, 'paid', 4, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-28 12:07:03'),
(122, 20.00, 'paid', 12, '3400072836', 'ROMA', 'Via Deruta 19', '2025-03-28 12:11:27'),
(123, 30.00, 'on hold', 12, '3400072836', 'Padova', 'Via Deruta 19', '2025-03-28 12:21:22'),
(124, 45.00, 'on hold', 12, '3400072836', 'Padova', 'Via Deruta 19', '2025-03-28 13:33:32'),
(125, 105.00, 'on hold', 12, '3400072837', 'ROMA', '19 Via Deruta', '2025-03-28 21:24:24'),
(126, 105.00, 'on hold', 12, '3400072837', 'ROMA', '19 Via Deruta', '2025-03-28 22:02:28'),
(129, 156.00, 'paid', 13, '3400072837', 'ROMA', '19 Via Deruta', '2025-03-29 14:43:32'),
(132, 15.00, 'on hold', 14, '3400072836', 'ROMA', 'Via Deruta 19', '2025-04-01 14:17:19'),
(136, 20.00, 'paid', 15, '3400072836', 'Padova', 'Via Deruta 19', '2025-04-03 20:24:06'),
(137, 10.00, 'on hold', 4, '3400072837', 'ROMA', '19 Via Deruta', '2025-04-04 08:35:02'),
(138, 10.00, 'on hold', 4, '3400072837', 'ROMA', '19 Via Deruta', '2025-04-04 08:35:55'),
(139, 10.00, 'paid', 4, '3400072837', 'ROMA', '19 Via Deruta', '2025-04-04 08:36:25'),
(140, 10.00, 'on hold', 4, '3400072836', 'Padova', 'Via Deruta 19', '2025-04-04 08:37:10'),
(141, 40.00, 'paid', 4, '3400072837', 'ROMA', '19 Via Deruta', '2025-04-04 08:37:22'),
(142, 48.00, 'paid', 4, '3400072836', 'Padova', 'Via Deruta 19', '2025-04-04 11:46:26');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_quantity` int NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `idx_order_items_order_id` (`order_id`),
  KEY `idx_order_items_product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_quantity`) VALUES
(109, 109, 13, 1),
(110, 110, 4, 4),
(111, 111, 3, 12),
(112, 112, 3, 13),
(113, 113, 3, 13),
(114, 114, 6, 5),
(115, 115, 6, 5),
(116, 116, 4, 3),
(117, 117, 13, 1),
(118, 118, 13, -15),
(119, 119, 13, 1),
(120, 120, 13, 1),
(121, 121, 13, 18),
(122, 122, 4, 2),
(123, 123, 4, 3),
(124, 124, 4, 3),
(125, 124, 15, 1),
(126, 125, 4, 3),
(127, 125, 15, 3),
(128, 125, 14, 2),
(129, 126, 4, 3),
(130, 126, 15, 3),
(131, 126, 14, 2),
(134, 129, 11, 4),
(137, 132, 15, 1),
(142, 136, 17, 2),
(143, 139, 4, 1),
(144, 140, 4, 1),
(145, 141, 4, 4),
(146, 142, 9, 6);

-- --------------------------------------------------------

--
-- Stand-in structure for view `order_summary`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `order_summary`;
CREATE TABLE IF NOT EXISTS `order_summary` (
`order_id` int
,`order_cost` decimal(6,2)
,`order_status` varchar(100)
,`order_date` datetime
,`user_id` int
,`user_name` varchar(100)
,`user_email` varchar(100)
,`user_phone` varchar(255)
,`user_address` varchar(255)
,`product_id` int
,`product_name` varchar(100)
,`product_category` varchar(100)
,`product_price` decimal(6,2)
,`product_quantity` int
,`payment_id` int
,`transaction_id` varchar(250)
,`date_payment` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `user_id` int NOT NULL,
  `transaction_id` varchar(250) NOT NULL,
  `date_payment` datetime NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `idx_payments_order_id` (`order_id`),
  KEY `idx_payments_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `user_id`, `transaction_id`, `date_payment`) VALUES
(6, 36, 8, '9SM38578JE0627500', '2025-03-18 19:21:07'),
(25, 109, 4, '5W663346HX4533335', '2025-03-26 22:12:03'),
(26, 115, 4, '43U54138F71487251', '2025-03-28 09:40:36'),
(27, 121, 4, '35539013DT346824W', '2025-03-28 12:07:23'),
(28, 122, 12, '8AL57216DD917835H', '2025-03-28 12:13:26'),
(31, 129, 13, '27V22091R5436030L', '2025-03-29 14:44:03'),
(36, 136, 15, '9L120810GK6966547', '2025-04-03 20:24:26'),
(37, 139, 4, '0W981807YJ442723M', '2025-04-04 08:36:58'),
(38, 141, 4, '10C655277F652010V', '2025-04-04 08:37:35'),
(39, 142, 4, '9W824836DT162460T', '2025-04-04 11:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `vegan` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_price`, `vegan`) VALUES
(3, 'Protein Cookies', 'Bar', 'I Protein Cookies sono il massimo del piacere: morbidi, golosi e realizzati con ingredienti di prima qualità, pronti a sciogliersi in bocca al primo morso. Una vera delizia al cioccolato che soddisfa ogni voglia di dolce, senza compromessi.  ', 'treat1.avif', 10.00, 1),
(4, 'Protein Wafer', 'Bar', 'Che tu voglia aumentare la massa muscolare, tonificarti o perdere peso, assumere la giusta quantità di proteine è fondamentale. Ecco perché i nostri Protein Wafers sono la scelta perfetta: 15g di proteine per supportare la crescita e il mantenimento della', 'wafer1', 10.00, 1),
(5, 'Peanut Butter', 'Bar', 'Questa iconica barretta è tornata in grande stile ed è pronta a rubare la scena! Ispirata al burro di arachidi americano più amato, racchiude un cuore morbido e cremoso di peanut butter, arricchito da croccanti pezzetti di arachide. Il tutto avvolto da un', 'peanut1', 8.00, 1),
(6, 'Cookies and Cream', 'Bar', 'Cookies and Cream è il gusto classico ispirato ai biscotti americani più amati.', 'cookiescream1.webp', 8.00, 0),
(7, 'Crisp Cookie', 'Bar', 'Il nostro delizioso Holiday Crisp è tornato con un nuovo look! Questo grande favorito si rinnova e diventa Creamy Crisp, ma con lo stesso gusto irresistibile che hai sempre amato.', 'crisp1.webp', 8.00, 1),
(8, 'Variety Pack', 'Bar', 'Goditi tutte le Barebells Protein Bars che ami in un unico, perfetto variety pack!\n', 'variety1.webp', 20.00, 0),
(9, 'Caramel and Cookies', 'Bar', 'Abbiamo portato la nostra iconica Cookies and Cream a un livello superiore, aggiungendo uno strato di caramello dolce e salato. Con un cuore cremoso al cioccolato e biscotto, una copertura croccante di crispies e un irresistibile strato di cioccolato al l', 'caramel1.webp', 8.00, 1),
(10, 'Banana Caramel', 'Bar', 'L’ultima arrivata nella famiglia delle Soft Bars racchiude 16g di proteine, con un cuore soffice alla banana, uno strato di deliziosa salsa al caramello e una copertura di cremoso cioccolato al latte, il tutto senza zuccheri aggiunti*.', 'banana1.webp', 10.00, 1),
(11, '450g Fragola e Kiwi', 'Powder', 'Scopri il perfetto equilibrio tra dolcezza e acidità con la nostra Polvere Fragola e Kiwi! Un mix vibrante che unisce il gusto succoso delle fragole mature con la freschezza esotica del kiwi, creando un\'esperienza unica e rinfrescante.', 'recovery1.avif', 39.00, 1),
(12, '500g Cioccolato', 'Powder', 'Perché accontentarsi quando puoi avere tutto? Il nostro Cioccolato Proteico da 500g è il mix perfetto di gusto e nutrizione, pensato per chi vuole soddisfare la voglia di dolce senza rinunciare alle proteine.', 'gainer1.avif', 49.00, 1),
(13, '500g Impact Vegan Protein', 'Powder', 'Delizioso cioccolato in polvere per un recupero energetico', 'veg1.avif', 29.00, 1),
(14, 'Clear Bottle 1L', 'Accessories', 'Bottiglia trasparente da 1L, design elegante e funzionale', 'borracciapink.webp', 15.00, NULL),
(15, 'Sport Dark Bottle', 'Accessories', 'Affronta ogni sfida con la tua Sport Dark Bottle, progettata per accompagnarti durante gli allenamenti più intensi e le giornate più attive. Il design scuro e deciso esprime forza e carattere, mentre la struttura ergonomica garantisce una presa sicura.', 'sportbottle.webp', 15.00, NULL),
(16, 'Cherry Energy Drink (6 Lattine)', 'Energy', 'Scopri l’energia che sa di ciliegia! Una bibita esplosiva dal gusto unico, pensata per darti la carica ogni giorno, con stile e freschezza.', 'cherry11.jpg', 20.00, 0),
(17, 'Vitamina B', 'Vitamin', 'Supporto energetico naturale, favorisce il benessere generale', 'vitamin1.jpg', 10.00, 0),
(18, 'Smart Band', 'Accessories', 'Bevanda energetica al gusto di ciliegia per energia immediata', 'watch1.webp', 39.00, NULL),
(19, 'Epic Juice Vitamin', 'Vitamin', 'Bracciale smart multifunzionale per il monitoraggio fitness', 'juice1.jpg', 9.00, 1),
(20, 'Smart Band E', 'Accessories', 'Bracciale smart multifunzione ideale per il monitoraggio della temperatura corporea (C°/F°), attività fisica e frequenza cardiaca. ', 'band3.jpg', 30.00, NULL),
(21, 'Fasce Palestra', 'Accessories', 'Le fasce per palestra per migliorare la tua performance durante l\'allenamento', 'fascetta1.jpg', 12.00, NULL),
(22, 'Energetica', 'Energy', 'Bevanda energetica che ti fornisce energia immediata e duratura', 'drink1.webp', 2.50, 1),
(24, 'Fascia', 'Accessories', 'Fascia elastica di supporto per allenamenti intensi, comoda e resistente', 'strap1.jpg', 15.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `image_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `fk_product_image` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `product_id`, `image_path`, `alt_text`) VALUES
(12, 3, 'treat2.avif', 'Protein Cookies - immagine secondaria'),
(13, 4, 'wafer2', 'Protein Wafer - immagine secondaria'),
(14, 5, 'peanut2', 'Peanut Butter - immagine secondaria'),
(15, 6, 'cookiescream2.webp', 'Cookies and Cream - immagine secondaria'),
(16, 7, 'crisp2.webp', 'Crisp Cookie - immagine secondaria'),
(17, 8, 'variety2.jpg', 'Variety Pack - immagine secondaria'),
(18, 9, 'caramel2.webp', 'Caramel and Cookies - immagine secondaria'),
(19, 10, 'banana2.webp', 'Banana Caramel - immagine secondaria'),
(20, 11, 'recovery2.avif', '450g Fragola e Kiwi - immagine secondaria'),
(21, 12, 'gainer2.avif', '500g Cioccolato - immagine secondaria'),
(22, 13, 'veg2.avif', '500g Impact Vegan Protein - immagine secondaria'),
(23, 3, 'void.png', 'Protein Cookies - immagine terziaria'),
(24, 4, 'void.png', 'Protein Wafer - immagine terziaria'),
(25, 5, 'peanut3', 'Peanut Butter - immagine terziaria'),
(26, 6, 'cookiescream3.webp', 'Cookies and Cream - immagine terziaria'),
(27, 7, 'crisp3.webp', 'Crisp Cookie - immagine terziaria'),
(28, 8, 'variety3.webp', 'Variety Pack - immagine terziaria'),
(29, 9, 'caramel3.webp', 'Caramel and Cookies - immagine terziaria'),
(30, 10, 'void.png', 'Banana Caramel - immagine terziaria'),
(31, 11, 'void.png', '450g Fragola e Kiwi - immagine terziaria'),
(32, 12, 'void.png', '500g Cioccolato - immagine terziaria'),
(33, 13, 'veg3.avif', '500g Impact Vegan Protein - immagine terziaria'),
(34, 3, 'void.png', 'Protein Cookies - immagine quaternaria'),
(35, 4, 'void.png', 'Protein Wafer - immagine quaternaria'),
(36, 5, 'peanut4', 'Peanut Butter - immagine quaternaria'),
(37, 6, 'cookiescream4.webp', 'Cookies and Cream - immagine quaternaria'),
(38, 7, 'crisp4.webp', 'Crisp Cookie - immagine quaternaria'),
(39, 8, 'void.png', 'Variety Pack - immagine quaternaria'),
(40, 9, 'void.png', 'Caramel and Cookies - immagine quaternaria'),
(41, 10, 'void.png', 'Banana Caramel - immagine quaternaria'),
(42, 11, 'void.png', '450g Fragola e Kiwi - immagine quaternaria'),
(43, 12, 'void.png', '500g Cioccolato - immagine quaternaria'),
(44, 13, 'veg4.avif', '500g Impact Vegan Protein - immagine quaternaria'),
(45, 14, 'borracciapink2.webp', 'borraccia rosa 2'),
(46, 14, 'borracciapink3.webp', 'borracciapink immagine terziaria'),
(47, 14, 'borracciapink4.webp', 'borracciapink immagine quaternaria'),
(48, 15, 'sportbottle2.webp', 'sportbottle2.webp'),
(49, 15, 'sportbottle3.webp', 'sportbottle3.webp'),
(50, 15, 'sportbottle4.webp', 'sportbottle4'),
(51, 16, 'cherry22.jpg', 'cherry2.avif'),
(52, 16, 'cherry33.jpg', 'cherry immagine terziaria'),
(53, 16, 'void.png', 'cherry immagine quaternaria'),
(54, 17, 'vitamin2.jpg', 'immaginesecondaria'),
(55, 17, 'vitamin3.jpg', 'Immagine terziaria'),
(56, 17, 'vitamin4.jpg', 'Immagine quaternaria-vitamina'),
(57, 18, 'watch2.webp', 'watch2.webp'),
(58, 18, 'watch3.jpg', 'watch3.webp'),
(59, 18, 'watch4.webp', 'watch4.webp'),
(60, 19, 'juice2.jpg', 'juice2.jpg'),
(61, 19, 'juice3.jpg', 'juice3.jpg'),
(62, 19, 'juice4.jpg', 'juice4.jpg'),
(63, 20, 'band2.jpg', 'Banda smart Immagine secondaria'),
(64, 20, 'band3.jpg', 'Banda Smart Immagine Terziarie'),
(65, 20, 'band4.jpg', 'Banda Smart, Immagine Quaternaria'),
(66, 21, 'fascetta2.jpg', 'Fasce Palestra - immagine secondaria 1'),
(67, 21, 'fascetta3.jpg', 'Fasce Palestra - immagine secondaria 2'),
(68, 21, 'fascetta4.jpg', 'Fasce Palestra - immagine secondaria 3'),
(69, 22, 'drink2.webp', 'Energetica - immagine secondaria 1'),
(70, 22, 'drink3.png', 'Energetica - immagine secondaria 2'),
(71, 22, 'drink4.webp', 'Energetica - immagine secondaria 3'),
(72, 24, 'strap2.jpg', ' immagine secondaria 1'),
(73, 24, 'strap3.jpg', 'immagine secondaria 2'),
(74, 24, 'strap4.jpg', 'immagine secondaria 3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `UX_Constraint` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Angelo', 'angelostefanini04@gmail.com', '550d8b48c003bba8a9ff496a8aed2817'),
(4, 'Angelo male Stefanini', 'angelostefanni04@gmail.com', 'ef1783f9f6f62aa8b634246f86d64489'),
(5, 'giovanni', 'paolo', 'fcea920f7412b5da7be0cf42b8c93759'),
(6, 'federico', 'gatto', '0ece8ea9a5c266f6fce2533a07bbf010'),
(7, 'ciao', 'ciao', '895d49aad93f65b212a968557821b4c2'),
(8, 'Lukas', 'lukamoore', 'e10adc3949ba59abbe56e057f20f883e'),
(11, 'Angelo Stefanini', 'b', '896895260b7464c7dcb7c4c9b93baf04'),
(12, 'Angelo Stefanini', 'angelo.stefanini@alcampus.it', 'e1ec7d34a058efe1cb6a73a7b4ccc678'),
(13, 'Angelo Stefanini', 'angelotefanini04@gmail.com', '550d8b48c003bba8a9ff496a8aed2817'),
(14, 'Filippo Paciello', 'paci@gmail.com', '550d8b48c003bba8a9ff496a8aed2817'),
(15, 'Giovanni Floris', 'giovannifloris@gmail.com', '0fe4f43e1dd173abc07ce508a74800e2');

-- --------------------------------------------------------

--
-- Structure for view `order_summary`
--
DROP TABLE IF EXISTS `order_summary`;

DROP VIEW IF EXISTS `order_summary`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_summary`  AS SELECT `o`.`order_id` AS `order_id`, `o`.`order_cost` AS `order_cost`, `o`.`order_status` AS `order_status`, `o`.`order_date` AS `order_date`, `u`.`user_id` AS `user_id`, `u`.`user_name` AS `user_name`, `u`.`user_email` AS `user_email`, `o`.`user_phone` AS `user_phone`, `o`.`user_address` AS `user_address`, `oi`.`product_id` AS `product_id`, `p`.`product_name` AS `product_name`, `p`.`product_category` AS `product_category`, `p`.`product_price` AS `product_price`, `oi`.`product_quantity` AS `product_quantity`, `pay`.`payment_id` AS `payment_id`, `pay`.`transaction_id` AS `transaction_id`, `pay`.`date_payment` AS `date_payment` FROM ((((`orders` `o` join `users` `u` on((`o`.`user_id` = `u`.`user_id`))) join `order_items` `oi` on((`o`.`order_id` = `oi`.`order_id`))) join `products` `p` on((`oi`.`product_id` = `p`.`product_id`))) left join `payments` `pay` on((`o`.`order_id` = `pay`.`order_id`))) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_orderitems_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `fk_payments_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
