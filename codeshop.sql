-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2023 at 02:52 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `date`) VALUES
(1, 'admin', 'admin', '2023-01-24 19:57:47');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categories` varchar(225) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categories`, `status`) VALUES
(26, 'hat', 1),
(27, 'bags', 1),
(33, 'cat4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `added_on`) VALUES
(3, 'rahul', 'rahul@gmail.com', '+911123456789', 'hello there', '2023-01-26 18:36:32');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_name` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `selling_price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `meta_title` text NOT NULL,
  `meta_desc` text NOT NULL,
  `meta_short_desc` varchar(2000) NOT NULL,
  `meta_keyword` varchar(2000) NOT NULL,
  `description` text NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_name`, `name`, `mrp`, `selling_price`, `qty`, `image`, `meta_title`, `meta_desc`, `meta_short_desc`, `meta_keyword`, `description`, `short_desc`, `status`) VALUES
(6, 'cat4', 'Canon IXUS 2200', 24995, 24995, 45, 'ixus-63d50c3c8cfd2.png', 'fdgsdfg', 'Perfect for any oc', 'dsfgsdf', 'dfgsdfgsdffghf', 'Perfect for any occasion, the IXUS 285 HS cap', 'Perfect for any occasion, t', 1),
(7, 'cat4', 'laptop by ProArt', 12345, 18000, 12, 'asus laptop-63d50df692d0b.jpg', 'laptop by ProArt', 'laptop has 1tb ssd, 1tb hdd, 32gb ram and intel i9 11th gen processor', 'laptop is awesome', 'laptop proart', 'laptop has 1tb ssd, 1tb hdd, 32gb ram and intel i9 11th gen processor', 'laptop is awesome', 1),
(8, 'bags', '32 Ltrs Grey Casual Backpack (AMT FIZZ SCH BAG 02 - GREY) american tourister', 199, 99, 33, 'american tourister bag-63d5267468746.jpg', '32 Ltrs Grey Casual Backpack (AMT FIZZ SCH BAG 02 - GREY) american tourister', 'Laptop Compatibility: No, Strap Type: Adjustable,\r\nOuter Material: Polyester, Color: Grey\r\nWater Resistance: Water resistant\r\nCapacity: 32 liters; Dimensions: 32.5 cms x 18 cms x 50 cms (LxWxH)\r\nNumber of Wheels: 0, Number of compartments: 3\r\nWarranty type: Manufacturer; 1 year International warranty valid for 1 year from the original date of purchase\r\nMesh pockets on both sides to accommodate your sipper or bottle and umbrella', 'Laptop Compatibility: No, Strap Type: Adjustable,\r\nOuter Material: Polyester, Color: Grey\r\nWater Resistance: Water resistant', 'bags', 'Laptop Compatibility: No, Strap Type: Adjustable,\r\nOuter Material: Polyester, Color: Grey\r\nWater Resistance: Water resistant\r\nCapacity: 32 liters; Dimensions: 32.5 cms x 18 cms x 50 cms (LxWxH)\r\nNumber of Wheels: 0, Number of compartments: 3\r\nWarranty type: Manufacturer; 1 year International warranty valid for 1 year from the original date of purchase\r\nMesh pockets on both sides to accommodate your sipper or bottle and umbrella', 'Laptop Compatibility: No, Strap Type: Adjustable,\r\nOuter Material: Polyester, Color: Grey\r\nWater Resistance: Water resistant', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `date`) VALUES
(2, 'pawan', 'pawan@gmail.com', 'pawan', 'pawan', '2023-01-26 19:18:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories` (`categories`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
