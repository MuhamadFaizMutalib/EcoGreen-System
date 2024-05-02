-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2023 at 11:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `growgreen_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `id` int(255) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(4, 'syaif', 'syaf', 'syaif@e.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `tree_id` int(20) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(20) NOT NULL,
  `image` varchar(25) NOT NULL,
  `quantity` int(25) NOT NULL,
  `total` double(10,2) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `confirm_order`
--

CREATE TABLE `confirm_order` (
  `order_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` int(12) NOT NULL,
  `address` varchar(500) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `total_trees` varchar(500) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `date` varchar(20) NOT NULL,
  `total_price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tree_info`
--

CREATE TABLE `tree_info` (
  `tid` int(255) NOT NULL,
  `name` varchar(20) NOT NULL,
  `species` varchar(20) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(10) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tree_info`
--

INSERT INTO `tree_info` (`tid`, `name`, `species`, `price`, `description`, `image`, `date`) VALUES
(6, 'Tree1', 'Desert', 12, 'Tree', 'tree1.jpg', '2023-07-04 22:38:44'),
(7, 'Tree2', 'Desert', 12, 'Tree', 'tree2.jpg', '2023-07-04 22:39:19'),
(8, 'Tree3', 'Desert', 12, 'Tree', 'tree3.jpg', '2023-07-04 22:39:37'),
(9, 'Tree4', 'Desert', 12, 'Tree', 'tree4.jpg', '2023-07-04 22:39:53'),
(10, 'Tree5', 'Desert', 12, 'Tree', 'tree5.jpg', '2023-07-04 22:40:24'),
(11, 'Tree6', 'Desert', 12, 'Tree', 'tree6.jpg', '2023-07-04 22:40:40'),
(12, 'Tree7', 'Desert', 12, 'Tree', 'tree7.jpg', '2023-07-04 22:40:55'),
(13, 'Tree8', 'Gotham', 12, 'Tree', 'tree8.jpg', '2023-07-04 22:41:27'),
(14, 'Tree9', 'Gotham', 12, 'Tree', 'tree9.jpg', '2023-07-04 22:41:51'),
(15, 'Tree0', 'Gotham', 13, 'TreeReally', 'tree10.jpg', '2023-07-04 22:42:08'),
(17, 'Ultraman', 'Gotham', 2113, 'aDAa', 'tree4.jpg', '2023-07-05 14:59:21'),
(18, 'gggg', 'ttt', 112, 'dfffd', 'tree2.jpg', '2023-07-05 15:53:06');

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE `users_info` (
  `id` int(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`id`, `name`, `surname`, `email`, `password`) VALUES
(5, 'riyaaz', 'ryz', 'ryz@e.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `confirm_order`
--
ALTER TABLE `confirm_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tree_info`
--
ALTER TABLE `tree_info`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `confirm_order`
--
ALTER TABLE `confirm_order`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tree_info`
--
ALTER TABLE `tree_info`
  MODIFY `tid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
