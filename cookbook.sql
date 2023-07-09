-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2023 at 12:34 AM
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
-- Database: `cookbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipe_desc`
--

CREATE TABLE `recipe_desc` (
  `user_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `food_description` text NOT NULL,
  `date_created` datetime NOT NULL,
  `food_image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipe_desc`
--

INSERT INTO `recipe_desc` (`user_id`, `recipe_id`, `food_name`, `food_description`, `date_created`, `food_image`) VALUES
(48, 15, 'Beef Morcon', '<h2 style=\"text-align: center;\">Beef Morcon</h2>\r\n<p>Beef Morcon has been a favorite dish during special occasions. I like morcon because it is delicious and all the ingredients blends well into a unified flavor that makes my palate happy. It goes well with java rice.</p>', '2023-07-05 15:43:36', 0x75706c6f6164732f3334373237313936365f3632373235343335393333333933355f363836333230383036383633393335383031335f6e2e6a7067),
(48, 16, 'Crispy Pata', '<h2 style=\"text-align: center;\"><span style=\"text-decoration: underline;\"><strong><span id=\"what-is-crispy-pata\">WHAT IS CRISPY PATA?</span></strong></span></h2>\r\n<p>It is a Filipino dish made from pork leg, usually from the hock to the trotters. Traditionally, t is cooked deep-fried but it can also be cooked in the oven. The main target is to have a crispy skin, as the name implies.</p>\r\n<p>As this dish normally requires some time to prepare, it is usually reserved for special occasions or for the holidays. Many Filipino restaurants would also have&nbsp; Crispy Pata in their menus, including pubs as it is a well-loved&nbsp;<em>pulutan</em>&nbsp;or \"booze appetizer\". Some even offer boneless versions of it.</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>', '2023-07-05 16:22:17', 0x75706c6f6164732f3333373939373037355f333539353432393836303639323831385f333035343236383439303539383239313030315f6e2e6a7067),
(48, 17, 'Crispy Pata', '<h2 style=\"text-align: center;\"><span style=\"text-decoration: underline;\"><strong><span id=\"what-is-crispy-pata\">WHAT IS CRISPY PATA?</span></strong></span></h2>\r\n<p>It is a Filipino dish made from pork leg, usually from the hock to the trotters. Traditionally, t is cooked deep-fried but it can also be cooked in the oven. The main target is to have a crispy skin, as the name implies.</p>\r\n<p>As this dish normally requires some time to prepare, it is usually reserved for special occasions or for the holidays. Many Filipino restaurants would also have&nbsp; Crispy Pata in their menus, including pubs as it is a well-loved&nbsp;<em>pulutan</em>&nbsp;or \"booze appetizer\". Some even offer boneless versions of it.</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>', '2023-07-05 16:27:47', 0x75706c6f6164732f3333373939373037355f333539353432393836303639323831385f333035343236383439303539383239313030315f6e2e6a7067),
(48, 18, 'Crispy Pata', '<h2 style=\"text-align: center;\"><span style=\"text-decoration: underline;\"><strong><span id=\"what-is-crispy-pata\">WHAT IS CRISPY PATA?</span></strong></span></h2>\r\n<p>It is a Filipino dish made from pork leg, usually from the hock to the trotters. Traditionally, t is cooked deep-fried but it can also be cooked in the oven. The main target is to have a crispy skin, as the name implies.</p>\r\n<p>As this dish normally requires some time to prepare, it is usually reserved for special occasions or for the holidays. Many Filipino restaurants would also have&nbsp; Crispy Pata in their menus, including pubs as it is a well-loved&nbsp;<em>pulutan</em>&nbsp;or \"booze appetizer\". Some even offer boneless versions of it.</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>', '2023-07-05 16:32:10', 0x75706c6f6164732f3333373939373037355f333539353432393836303639323831385f333035343236383439303539383239313030315f6e2e6a7067),
(48, 19, 'Macaroni Salad', '<h1 style=\"text-align: center;\">Macaroni Salad</h1>\r\n<p>The arrival of the holidays calls for food that&rsquo;s as bright and colorful as the season. Filipinos are famous for having one of the longest Christmas seasons in the world. While it usually starts in December for most, Christmas carols and yuletide plans can often start as early as September! It&rsquo;s no secret that Filipinos love Christmas for several reasons, one of which is getting to spend time with all your loved ones. Despite the unusual circumstances of the world today, nothing should stop us from being able to enjoy a happy, healthy holiday season.</p>', '2023-07-05 16:49:07', 0x75706c6f6164732f3333393537303533365f3534333930323037343535363532395f373339343734353935393135393333343931365f6e2e6a7067),
(48, 20, 'Macaroni Salad', '<h1 style=\"text-align: center;\">Macaroni Salad</h1>\r\n<p>The arrival of the holidays calls for food that&rsquo;s as bright and colorful as the season. Filipinos are famous for having one of the longest Christmas seasons in the world. While it usually starts in December for most, Christmas carols and yuletide plans can often start as early as September! It&rsquo;s no secret that Filipinos love Christmas for several reasons, one of which is getting to spend time with all your loved ones. Despite the unusual circumstances of the world today, nothing should stop us from being able to enjoy a happy, healthy holiday season.</p>', '2023-07-05 16:50:17', 0x75706c6f6164732f3333393537303533365f3534333930323037343535363532395f373339343734353935393135393333343931365f6e2e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ingredients`
--

CREATE TABLE `tbl_ingredients` (
  `recipe_id` int(11) NOT NULL,
  `ingredient` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ingredients`
--

INSERT INTO `tbl_ingredients` (`recipe_id`, `ingredient`) VALUES
(16, '1 whole pork leg - about 1.7 to 2 kgs with nails trimmed'),
(16, '1 tablespoons peppercorn'),
(16, '⅓ cup rock salt'),
(16, '1 head garlic - cut across into half'),
(16, '1 medium onion - cut into quarters'),
(16, '3 pieces bay leaves'),
(17, '1 whole pork leg - about 1.7 to 2 kgs with nails trimmed'),
(17, '1 tablespoons peppercorn'),
(17, '⅓ cup rock salt'),
(17, '1 head garlic - cut across into half'),
(17, '1 medium onion - cut into quarters'),
(17, '3 pieces bay leaves'),
(18, '1 whole pork leg - about 1.7 to 2 kgs with nails trimmed'),
(18, '1 tablespoons peppercorn'),
(18, '⅓ cup rock salt'),
(18, '1 head garlic - cut across into half'),
(18, '1 medium onion - cut into quarters'),
(18, '3 pieces bay leaves'),
(19, '500 grams elbow macaroni'),
(19, '470 ml Lady’s Choice real mayonnaise'),
(19, '300 ml condensed milk'),
(19, '250 ml all-purpose cream'),
(19, '250 grams sharp cheddar cheese diced'),
(19, '250 grams nata de coco red, drained'),
(19, '250 grams nata de coco green, drained'),
(19, '350 grams kaong (sugar palm) drained'),
(19, '850 grams fruit cocktail drained'),
(20, '500 grams elbow macaroni'),
(20, '470 ml Lady’s Choice real mayonnaise'),
(20, '300 ml condensed milk'),
(20, '250 ml all-purpose cream'),
(20, '250 grams sharp cheddar cheese diced'),
(20, '250 grams nata de coco red, drained'),
(20, '250 grams nata de coco green, drained'),
(20, '350 grams kaong (sugar palm) drained'),
(20, '850 grams fruit cocktail drained'),
(15, '2 lbs. flank steak thinly sliced'),
(15, '1 medium carrot sliced into sticks'),
(15, '1 serving flank steak marinade see recipe here'),
(15, '4 pieces hard boiled eggs wedged'),
(15, '▢3 pieces medium whole sweet pickles sliced into 4 long sticks');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_procedure`
--

CREATE TABLE `tbl_procedure` (
  `recipe_id` int(11) NOT NULL,
  `procedures` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(48, 'chichi', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'admin@yahoo.com'),
(49, 'user', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'user@yahoo.com'),
(50, 'Chinachi_143', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'hannah33002@gmail.com'),
(51, 'sana_shashasha', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'snmtzk.minatozaki.jypentertainment@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipe_desc`
--
ALTER TABLE `recipe_desc`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipe_desc`
--
ALTER TABLE `recipe_desc`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
