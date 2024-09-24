-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2024 at 09:22 AM
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
-- Database: `ims_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory_trans`
--

CREATE TABLE `inventory_trans` (
  `id` int(11) NOT NULL,
  `productid` int(11) DEFAULT NULL,
  `transaction_type` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `inventory_trans`
--

INSERT INTO `inventory_trans` (`id`, `productid`, `transaction_type`, `quantity`, `transaction_date`) VALUES
(1, 10, 'In', '123', '2024-09-26'),
(2, 11, 'In', '222222', '2024-09-13'),
(3, 10, 'In', '1', '2024-09-26'),
(4, 10, 'In', '', '2024-09-26'),
(5, 10, 'In', '', '2024-09-26');

-- --------------------------------------------------------

--
-- Table structure for table `meat_db`
--

CREATE TABLE `meat_db` (
  `id` int(11) NOT NULL,
  `meat_type` varchar(255) NOT NULL,
  `meat_parts` varchar(255) NOT NULL,
  `meat_price` decimal(10,2) NOT NULL,
  `purchased_date` date NOT NULL,
  `supplier_id` varchar(255) NOT NULL,
  `meat_disposed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `meat_db`
--

INSERT INTO `meat_db` (`id`, `meat_type`, `meat_parts`, `meat_price`, `purchased_date`, `supplier_id`, `meat_disposed`) VALUES
(10, 'Chicken', 'breast', 12311.99, '2024-09-18', '123', NULL),
(12, 'Beef', 'tenderloin', 276.00, '2024-09-12', 'Mistery', '2024-09-19');

-- --------------------------------------------------------

--
-- Table structure for table `meat_registration`
--

CREATE TABLE `meat_registration` (
  `id` int(11) NOT NULL,
  `meat_type` enum('beef','pork','chicken') NOT NULL,
  `part` varchar(50) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `batch_number` varchar(50) NOT NULL,
  `received_date` date NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `meat_type_id` int(11) DEFAULT NULL,
  `batch_number` int(11) NOT NULL,
  `received_date` date NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `meat_type_id`, `batch_number`, `received_date`, `supplier`, `order_date`) VALUES
(1, 1, 2222, '2024-09-26', '', '2024-09-24 07:18:39'),
(2, 1, 2222, '2024-09-26', '', '2024-09-24 07:18:54'),
(3, 1, 333, '2024-09-27', '1238', '2024-09-24 07:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `shopname` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `supplier_contact` varchar(255) DEFAULT NULL,
  `supplier_shop_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `shopname`, `location`, `supplier_contact`, `supplier_shop_name`) VALUES
(1238, 'Mistery', 'gensan', '111', 'starbright'),
(1239, 'a', 'das', 'asd', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `type_meat_db`
--

CREATE TABLE `type_meat_db` (
  `id` int(11) NOT NULL,
  `meatname` varchar(100) NOT NULL,
  `meat_type` varchar(50) NOT NULL,
  `meat_part` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_meat_db`
--

INSERT INTO `type_meat_db` (`id`, `meatname`, `meat_type`, `meat_part`, `created_at`) VALUES
(1, 'bagaso', 'Pork', 'Shoulder', '2024-09-23 19:31:17'),
(2, 'whole', 'Beef', 'Sirloin', '2024-09-23 19:31:49'),
(3, 'whole', 'Chicken', 'Wings', '2024-09-23 19:31:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_db`
--

CREATE TABLE `user_db` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user_db`
--

INSERT INTO `user_db` (`id`, `firstname`, `lastname`, `email`, `username`, `password`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory_trans`
--
ALTER TABLE `inventory_trans`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `meat_db`
--
ALTER TABLE `meat_db`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `meat_registration`
--
ALTER TABLE `meat_registration`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`) USING BTREE;

--
-- Indexes for table `type_meat_db`
--
ALTER TABLE `type_meat_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_db`
--
ALTER TABLE `user_db`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory_trans`
--
ALTER TABLE `inventory_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meat_db`
--
ALTER TABLE `meat_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `meat_registration`
--
ALTER TABLE `meat_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1240;

--
-- AUTO_INCREMENT for table `type_meat_db`
--
ALTER TABLE `type_meat_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_db`
--
ALTER TABLE `user_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
