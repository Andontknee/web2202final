-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 08:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db1`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `code`, `image`, `price`) VALUES
(1, 'TOTE BAG ', 'E01', 'images/product1.jpg', 25.00),
(2, 'TEE-SHIRT UNISEX', 'E02', 'images/product2.jpg', 10.00),
(3, 'DURABLE WATER BOTTLE', 'E03', 'images/product3.jpg', 50.00),
(4, 'NOTEBOOKS RECYCLABLE', 'E04', 'images/product4.jpg', 5.00),
(5, 'STAINLESS STEEL MULTI-LAYER CONTAINER', 'E04', 'images/product5.jpg', 50.00),
(6, 'BASIN WASTE FILTER', 'E06', 'images/product6.jpg', 30.00),
(7, 'WOODEN CHOPPING BOARD', 'E07', 'images/product7.jpg', 25.00),
(8, 'AIR TIGHT SEAL TUPPERWARE', 'E08', 'images/product8.jpg', 35.00),
(9, 'COMPOST SOIL FOR DECOMPOSING FOOD', 'E09', 'images/product9.jpg', 60.00),
(10, 'NATURAL ALOE VERA', 'E10', 'images/product10.jpg', 35.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pass` char(40) NOT NULL,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `pass`, `registration_date`) VALUES
(7, 'jack', 'sparrow', 'piratecaptain@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-12-15 20:20:19'),
(8, 'john', 'doe', 'john.doe@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2024-12-15 20:20:42'),
(9, 'chester', 'bennington', 'linkinpark@outlook.com', 'dd5fef9c1c1da1394d6d34b248c51be2ad740840', '2024-12-15 20:22:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
