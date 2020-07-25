-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2020 at 02:09 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pass` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `pass`, `email`, `phone`, `role`, `status`) VALUES
(1, 'Admin', 'admin', '', '', 0, 0),
(2, 'Manishankar', 'manish', 'indaljaiswal152207@gmail.com', '9817275642', 1, 1),
(3, 'Indal', '123456', 'manishankar@gmail.com', '9807253226', 1, 1),
(4, 'Manish', '152207', 'manishjaiswal152207@gmail.com', '9827242925', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`, `status`) VALUES
(1, 'Gents', 1),
(2, 'Ladies', 1),
(3, 'Ranger', 1),
(4, 'Kids', 1),
(5, 'Baby', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_detail`
--

CREATE TABLE `coupon_detail` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_type` varchar(50) NOT NULL,
  `coupon_value` float NOT NULL,
  `cart_min_value` float NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon_detail`
--

INSERT INTO `coupon_detail` (`id`, `coupon_code`, `coupon_type`, `coupon_value`, `cart_min_value`, `status`) VALUES
(2, 'first100', 'Rupee', 100, 800, 1),
(3, 'first10', 'Rupee', 150, 25000, 1),
(6, 'first5', 'percent', 15, 1500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `name`, `email`, `phone`, `message`, `date_time`) VALUES
(2, 'prince', 'prince@gmail.com', '9817275642', 'hi,my name is prince', '2020-07-06 14:12:40'),
(3, 'manish', 'manishjaiswal1522@outlook.com', '9817275642', 'good', '0000-00-00 00:00:00'),
(4, 'Manish', 'manishjaiswal152207@gmail.com', '9817275642', 'pass', '0000-00-00 00:00:00'),
(5, 'Manish', 'manishankar@gmail.com', '9817275642', '152207', '0000-00-00 00:00:00'),
(6, 'Manish', 'manishjaiswal152207@gmail.com', '9817275642', '121', '2020-07-09 11:11:26'),
(7, 'Manish', 'manishjaiswal152207@gmail.com', '9817275642', '121', '2020-07-09 11:11:33'),
(8, 'Manish', 'manishjaiswal152207@gmail.com', '9817275642', 'qwqe', '2020-07-09 11:13:39'),
(10, 'Manish', 'manishjaiswal1522@outlook.com', '9817275642', 'hi', '2020-07-23 10:20:38'),
(12, 'Manish', 'manishjaiswal1522@outlook.com', '9817275642', 'city', '2020-07-23 10:23:40'),
(13, 'Manish', 'manishjaiswal152207@gmail.com', '9817275642', 'buy', '2020-07-25 01:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `like_dislike`
--

CREATE TABLE `like_dislike` (
  `id` int(11) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `like_count` int(11) NOT NULL,
  `dislike_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `like_dislike`
--

INSERT INTO `like_dislike` (`id`, `profile`, `like_count`, `dislike_count`) VALUES
(1, 'profile', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `login_log`
--

CREATE TABLE `login_log` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `try_time` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `qty`, `price`) VALUES
(1, 1, 12, 1, 6600);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status`) VALUES
(1, 'pending'),
(2, 'processing'),
(3, 'shipped'),
(4, 'cancelled'),
(5, 'complete');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `best_seller` int(11) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(2000) NOT NULL,
  `meta_desc` varchar(2000) NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `name`, `mrp`, `price`, `qty`, `image`, `best_seller`, `short_desc`, `description`, `meta_title`, `meta_desc`, `meta_keyword`, `added_by`, `status`) VALUES
(8, 5, 'walker', 1250, 1050, 100, '55735249_vipwalker.jpg', 0, 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'as', 'as', 'as', 0, 1),
(11, 1, 'Royal cycle', 6600, 6500, 100, '29097287_herojets.jpg', 0, 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'asd', 'acd', 'sad', 0, 1),
(12, 1, 'Hero Cycle', 6900, 6600, 17, '41770768_herojets.jpg', 0, 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'as', 'as', 'as', 0, 1),
(13, 3, 'Gear Cycle', 25000, 21000, 100, '79871110_gear.jpg', 0, 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'asas', 'as', 'sa', 'ss', 0, 1),
(14, 4, 'Zenta Cycle', 3200, 2600, 100, '48043378_23kids.jpg', 0, 'for 2-3 years kids', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'baby', 0, 1),
(15, 2, 'ladies cycle', 6200, 6200, 100, '80921716_novaladies.jpg', 0, 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'ASS', 'ass', 'as', 0, 1),
(17, 3, 'Ranger cycle', 10500, 10500, 100, '33586265_Ranger.jpg', 0, 'size:26inch\r\n  color:Blue\r\n  wt:Light Weight\r\n  Suitable for all type people', 'Hero Cycles India\'s largest manufacturer of cycles: bikes for kids, bikes for kids, mountain bikes, Mountain bikes. Bikes for all.Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'for young boys', 'for young boys', 'Rangercucle', 0, 1),
(18, 5, 'Baby Scotiee', 2500, 1550, 100, '80207159_babyscootie.jpg', 0, 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 0, 1),
(19, 4, 'Kids Cycle', 6000, 5000, 100, '37096149_89kids.jpg', 0, 'for 8-12 yrs kid', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 0, 1),
(20, 5, 'pulsar 220', 1600, 1500, 100, '93142943_plastic1.jpg', 0, 'for small baby', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 0, 1),
(21, 4, 'kidz cycle', 6000, 5500, 100, '29798449_89kid.jpg', 0, 'for 9-12 yrs kids', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 0, 1),
(22, 4, '2-3 yr kid', 3200, 3200, 1000, '19977327_kids.jpg', 0, 'for 2-3 yrs kids', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 0, 1),
(23, 2, 'Hero Queen', 7200, 6600, 32, '24792997_queen.jpg', 1, 'for school girls and all women', 'for school girls and all women', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 'Hero Cycles in India Find Hero cycle prices, Hero cycle models, photos, and new Hero cycles reviews in India. ... Hero Ranger DTB VX Pictures. Interested to ...', 0, 1),
(24, 2, 'Terrian cycle', 6600, 6500, 100, '75546024_Terrian.png', 0, 'for ladies', 'for school girls and all women', 'for school girls and all women', 'for school girls and all women', 'for school girls and all women', 0, 1),
(25, 2, 'Pink ladies', 6500, 6200, 100, '98676659_Terrain1.png', 0, 'for all ladies', 'for school girls and all women', 'for school girls and all women', 'for school girls and all women', 'for school girls and all women', 0, 1),
(26, 5, 'Plastic cycle', 1550, 1500, 100, '91545413_plasticcycle.jpg', 0, 'for small baby', 'small baby cycle', 'for school girls and all women', 'for school girls and all women', 'for school girls and all women', 0, 1),
(27, 5, 'Baby walker', 1500, 1350, 100, '47685233_walker.jpg', 0, 'for newly born baby', 'walker for newly born small baby', 'for school girls and all women', 'for school girls and all women', 'for school girls and all women', 0, 1),
(28, 5, 'Vip model cycle', 3200, 2850, 100, '15723459_vip.jpg', 1, 'for small baby', 'for baby girls and all women', 'for school girls and all women', 'for school girls and all women', 'baby cycle', 0, 1),
(29, 3, 'Afro Ranger (Ranger)', 5500, 5050, 8, '80891631_89kids.jpg', 1, 'Best Cycle for School Boys and even for girls.', 'Best Cycle for School Boys and even for girls.', 'Afro Cycle(Ranger)', 'Afro Cycle(Ranger)', 'Afro Cycle(Ranger)', 3, 1),
(30, 1, 'bell', 110, 100, 100, '47848412_contact.jpg', 0, 'Baby bell', 'Baby bell', '', '', '', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `pincode` int(11) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `total_price` float NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `order_status` int(11) NOT NULL,
  `txnid` varchar(50) NOT NULL,
  `mihpayid` varchar(50) NOT NULL,
  `payu_status` varchar(50) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_value` float NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(225) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `name`, `email`, `pass`, `Phone`, `date_time`) VALUES
(21, 'Manish', 'manishjaiswal152207@gmail.com', '152207', '9817275642', '2020-07-25 17:14:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_detail`
--
ALTER TABLE `coupon_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_dislike`
--
ALTER TABLE `like_dislike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_log`
--
ALTER TABLE `login_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `coupon_detail`
--
ALTER TABLE `coupon_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `like_dislike`
--
ALTER TABLE `like_dislike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_log`
--
ALTER TABLE `login_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
