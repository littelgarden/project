-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2022 at 01:04 PM
-- Server version: 5.7.33-0ubuntu0.16.04.1-log
-- PHP Version: 7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `image`, `created`) VALUES
(20, 'GARDEN', '1633419815.png', 1633419815),
(21, 'GARDEN2', '1633419929.jpg', 1633419929),
(22, 'GARDEN3', '1633419976.webp', 1633419976);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1-user,2-admin',
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `created` bigint(20) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-active,2-inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `parent_id`, `type`, `user_id`, `title`, `message`, `created`, `status`) VALUES
(1, 0, 1, 1, ' Android App Development', 'sadadasd', 1597345473, 2),
(2, 0, 1, 27, 'problems ', 'ukfha;', 1633426314, 1),
(6, 2, 2, 27, '', 'fdsfsdf', 1649962653, 1),
(7, 0, 1, 27, 'sdfsdf', 'sdfsdfsdf', 1649963670, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-pay received,2-refunded,3-completed,4-COD',
  `created` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `price`, `status`, `created`) VALUES
(1, 20, 5, 1, 55, 1, 1597493999),
(2, 20, 6, 1, 110, 1, 1597493999),
(3, 20, 7, 1, 85, 1, 1597493999);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `in_stock` int(11) NOT NULL,
  `short_description` text NOT NULL,
  `created` bigint(20) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-active,2-inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `image`, `title`, `price`, `currency`, `tags`, `in_stock`, `short_description`, `created`, `status`) VALUES
(1, '1597333505.png', 'Mohit1', 29, 'INR', 'Body', 30, 'Mohit is a very good player', 1597325255, 2),
(2, '1597325255.jpg', 'Mohit1', 29, 'INR', 'Facial', 30, 'Mohit is a very good player', 1597325255, 2),
(3, '1597263242.jpg', 'Mohit', 29, 'INR', 'Cosmetic', 0, 'Data', 1597263242, 2),
(4, '1597263242.jpg', 'Shampoo', 29, 'USD', 'Hair Care', 20, 'Shampoo (/?æm?pu?/) is a hair care product, typically in the form of a viscous liquid, that is used for cleaning hair. Less commonly, shampoo is available in bar form, like a bar of soap. Shampoo is used by applying it to wet hair, massaging the product into the scalp, and then rinsing it out.', 1597263242, 2),
(5, '1597426208.jpeg', 'Fran Ngong - Handmade Organic Bodycare', 55, 'AUD', 'Body Care', 20, 'Established in 2008 as BUHDZE Natural Body Nourishment and rebranded, in 2014, to Fran Ngong, Organic Bodycare. Fran Ngong specializes in creating all-organic, handmade products. Our soaps, moisturizers, deodorants and scrubs provide an unique blend of earth and plant based ingredients which support youthful, healthy skin! Join us in Making the Transition to Organic Lifestyle! ', 1597426208, 2),
(6, '1597426392.jpg', 'Lemon Myrtle & Thyme Body Butter', 110, 'AUD', 'Body Care', 55, 'SBC’s luxurious Lemon Myrtle & Thyme Body Butter with a citrus infusion of Lemon Myrtle, Thyme and Lemon Peel oils to invigorate the skin and the senses. 100% naturally fragranced, by the zesty trio of essential oils, to boost your mood and leave skin smelling beautifully fresh all day long. The creamy texture blends Macadamia Oil, Sweet Almond Oil and Shea Butter, which is quickly absorbed to intensely hydrate the skin, leaving it silky soft, nourished and radiant.\r\nSuitable for the whole family and all skin types. Ideal for dry, dull or dehydrated skin.', 1597426392, 2),
(7, '1597426519.png', 'Body Care Cream Wash Extra Rich Moisturising 1l', 85, 'AUD', 'Body Care', 90, 'Griffith FoodWorks aims to include in the product list up to date pictures of the products and accurate ingredients, nutritional information and other information. However, product detail may change from time to time and there may be a delay in making updates. When precise information is important, we recommend that you read the label on the products you purchase or contact the manufacturer of the product.', 1597426519, 2),
(8, '1597426664.png', 'Organic Care Normal Balance Shampoo 400ml', 155, 'AUD', 'Hair Care', 45, 'King Island aims to include in the product list up to date pictures of the products and accurate ingredients, nutritional information and other information. However, product detail may change from time to time and there may be a delay in making updates. When precise information is important, we recommend that you read the label on the products you purchase or contact the manufacturer of the product.', 1597426664, 2),
(9, '1597426738.png', 'Schwarzkopf Napro Palette Hair Colour Chocolate Brown 3. 65pk', 65, 'AUD', 'Hair Care', 22, 'King Island aims to include in the product list up to date pictures of the products and accurate ingredients, nutritional information and other information. However, product detail may change from time to time and there may be a delay in making updates. When precise information is important, we recommend that you read the label on the products you purchase or contact the manufacturer of the product.', 1597426738, 2),
(10, '1597426848.png', 'Palmolive Naturals Conditioner Vibrant 350ml', 45, 'AUD', 'Hair Care', 55, 'King Island aims to include in the product list up to date pictures of the products and accurate ingredients, nutritional information and other information. However, product detail may change from time to time and there may be a delay in making updates. When precise information is important, we recommend that you read the label on the products you purchase or contact the manufacturer of the product.', 1597426848, 2),
(11, '1597426975.jpg', 'Nature’s Way Complete Daily Multivitamin 200 Tablets', 260, 'AUD', 'Vitamins', 55, ' complete Daily Multivitamin with vitamins, minerals & antioxidants to help promote everyday health, energy and wellbeing.\r\n\r\nEnergy Production\r\nA busy lifestyle can often contribute to feeling tired & lacking energy. Nature’s Way Complete Daily Multivitamin can help promote everyday energy.', 1597426975, 2),
(12, '1597427050.jpg', 'Caruso’s Women’s Super Multi 60 Tablets', 180, 'AUD', 'Vitamins', 450, 'Caruso’s Women’s Super Multi is a high potency multi-vitamin specifically formulated to assist women with their nutritional demands by supplementing with vitamins, minerals and nutrients required for the general health and wellbeing specifically of women.', 1597427050, 2),
(13, '1633419640.jpg', 'Gardening tool set', 75, 'AUD', 'GARDENING TOOL', 10, 'The Garden Tool Set Bag is able to hold your garden tool in its wide open compartments, making it easy to carry around. Comes with a wooden handle trowel, transplanter, weeding fork, rake, digger and protection cover.\r\n\r\nLightweight - compact, easy to pack and great for travelling\r\nCarry Handles - Two handles which can be kept together by velcro which also offers some padding', 1633418811, 1),
(14, '1633420284.WATERCAN', 'Watering jar', 15, 'AUD', 'GARDENING TOOL', 5, 'Made from Durable Plastic\r\n Volume: 10 LTR\r\n Strong and durable handles.', 1633420284, 1),
(15, '1633420601.housedoll', 'Mini Garden House', 50, 'AUD', 'GARDENING DECORATIONS', 6, 'have you decorated your house? How about your garden? The garden is a great place to decorate not only because it is outside of your house, but it’s spacious and it can have numerous styles of decorations. For today, we’ve prepared miniature garden decorations for this fall. ', 1633420601, 1),
(16, '1633420771.Decoration 2', 'Garden Clock', 55, 'AUD', 'GARDENING DECORATIONS', 2, 'Amazing garden decoration to make your garden more beautiful. The Garden clock table is the perfect centerpiece for your garden. ', 1633420771, 1),
(17, '', 'flower', 200, '$', 'decoration', 1, 'good flower', 1633423876, 1),
(18, '', 'Yellow flower', 100, '$', 'decoration', 4, 'good flower', 1633423930, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_feedback`
--

CREATE TABLE `product_feedback` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `created` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_feedback`
--

INSERT INTO `product_feedback` (`id`, `product_id`, `user_id`, `description`, `created`) VALUES
(1, 2, 14, 'dsfdsf', 1597346028),
(2, 2, 14, 'sddsfasd', 1597346137);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL COMMENT '1-users, 2-admin, 3-staff',
  `permission_group_id` int(11) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `reset_status` int(11) NOT NULL COMMENT '0-no,1-yes',
  `created` bigint(20) NOT NULL,
  `modified` bigint(20) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-active,2-deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `email`, `password`, `user_type`, `permission_group_id`, `profile_image`, `reset_status`, `created`, `modified`, `status`) VALUES
(1, 'Admin', 0, 'admin@gmail.com', '25d55ad283aa400af464c76d713c07ad', 2, 1, '', 1, 1579009948, 1579009948, 1),
(19, 'Staff Man', 9555294037, 'staff@gmail.com', '25d55ad283aa400af464c76d713c07ad', 2, 1, '', 0, 1597383980, 0, 1),
(21, 'Staffs Man', 123456789, 'staffs@gmail.com', '25d55ad283aa400af464c76d713c07ad', 3, 2, '', 0, 1597427879, 0, 1),
(22, '', 0, 'Janamtamu01@gmail.com', '6ce59d99d42efaaef81f9449697ba5da', 1, 0, '', 0, 1633416589, 0, 1),
(23, '', 0, 'Kalpit@gmail.com', '54dd5e6f772df72a950b848f6a03fb6d', 1, 0, '', 0, 1633418107, 0, 1),
(24, '', 0, 'Roshan@gmail.com', '25f9e794323b453885f5181f1b624d0b', 1, 0, '', 0, 1633422255, 0, 1),
(25, '', 0, 'Sashang12@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 0, '', 0, 1633444445, 0, 1),
(26, '', 0, 'borisswijaya@gmail.com', '9559399fbfcf14ec239cbed8fd2a4e7f', 1, 0, '', 0, 1633455772, 0, 1),
(27, 'Web', 23456345, 'web@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 0, '', 1, 1579009948, 1579009948, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE `user_permission` (
  `id` int(11) NOT NULL,
  `permission_merge` varchar(255) NOT NULL,
  `permission_name` varchar(255) NOT NULL,
  `permission_perm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_permission`
--

INSERT INTO `user_permission` (`id`, `permission_merge`, `permission_name`, `permission_perm`) VALUES
(1, 'DASHBOARD', 'Dashboard', 'admin/index'),
(2, 'ROLE MANAGEMENT', 'ADD ROLE', 'admin/add_role'),
(3, 'ROLE MANAGEMENT', 'ADD ROLE', 'admin/add_user'),
(4, 'Users', 'Users', 'users/users'),
(5, 'Users', 'Staff', 'users/staff'),
(6, 'PROFILE', 'Change Password', 'profile/change_password'),
(7, 'PRODUCT MANAGEMENT', 'Add/Edit Product', 'product/index'),
(8, 'ORDER MANAGEMENT', 'Order Management', 'orders/order_management'),
(9, 'FEEDBACK', 'Feddback', 'feedback/index'),
(10, 'BANNERS MANAGEMENT', 'Banners', 'banner/index'),
(11, 'ORDERS MANAGEMENT', 'Orders', 'orders/index'),
(12, 'FEEDBACK', 'View Feddback', 'feedback/view_feedback');

-- --------------------------------------------------------

--
-- Table structure for table `user_permission_group`
--

CREATE TABLE `user_permission_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_permission_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_permission_group`
--

INSERT INTO `user_permission_group` (`id`, `name`, `user_permission_id`) VALUES
(1, 'SUPER ADMIN', '1,4,5,6,7,8,9,10,11,12'),
(2, 'APPLICATION', '1,6,7,8,9,10,11,12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_feedback`
--
ALTER TABLE `product_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_permission_group`
--
ALTER TABLE `user_permission_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `product_feedback`
--
ALTER TABLE `product_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `user_permission`
--
ALTER TABLE `user_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user_permission_group`
--
ALTER TABLE `user_permission_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
