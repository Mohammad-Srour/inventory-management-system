-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 08:52 PM
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
-- Database: `inventory_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `name`) VALUES
('1', 'Location X'),
('2', 'Location Y'),
('3', 'Location Z');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`) VALUES
('1', 'Product A'),
('2', 'Product B'),
('3', 'Product C');

-- --------------------------------------------------------

--
-- Table structure for table `product_movements`
--

CREATE TABLE `product_movements` (
  `movement_id` int(11) NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `product_id` varchar(50) DEFAULT NULL,
  `from_location` varchar(50) DEFAULT NULL,
  `to_location` varchar(50) DEFAULT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_movements`
--

INSERT INTO `product_movements` (`movement_id`, `timestamp`, `product_id`, `from_location`, `to_location`, `qty`) VALUES
(1, '2025-05-23 20:20:51', '1', '1', '2', 100),
(2, '2025-05-23 20:20:58', '2', '1', '3', 200),
(3, '2025-05-23 20:21:05', '3', '1', '3', 250),
(4, '2025-05-23 20:21:11', '1', '1', '3', 100),
(5, '2025-05-23 20:21:32', '3', '2', '3', 25),
(6, '2025-05-23 20:21:41', '2', '3', '2', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_movements`
--
ALTER TABLE `product_movements`
  ADD PRIMARY KEY (`movement_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `from_location` (`from_location`),
  ADD KEY `to_location` (`to_location`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_movements`
--
ALTER TABLE `product_movements`
  MODIFY `movement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_movements`
--
ALTER TABLE `product_movements`
  ADD CONSTRAINT `product_movements_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `product_movements_ibfk_2` FOREIGN KEY (`from_location`) REFERENCES `locations` (`location_id`),
  ADD CONSTRAINT `product_movements_ibfk_3` FOREIGN KEY (`to_location`) REFERENCES `locations` (`location_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
