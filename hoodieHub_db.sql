-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 02, 2024 at 09:55 PM
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
-- Database: `hoodieHub`
--

-- --------------------------------------------------------

--
-- Table structure for table `hoodies`
--

CREATE TABLE `hoodies` (
  `HoodieID` int(11) NOT NULL,
  `HoodieName` varchar(100) NOT NULL,
  `HoodieDescription` text NOT NULL,
  `QuantityAvailable` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `ProductAddedBy` varchar(50) NOT NULL DEFAULT 'Ipseeka Malla',
  `Size` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoodies`
--

INSERT INTO `hoodies` (`HoodieID`, `HoodieName`, `HoodieDescription`, `QuantityAvailable`, `Price`, `ProductAddedBy`, `Size`) VALUES
(1, 'Classic Black Hoodie', 'A stylish and comfortable black hoodie.', 20, 49.99, 'Ipseeka Malla', 'M'),
(2, 'Oversized Red Hoodie', 'A cozy oversized hoodie in red.', 15, 59.99, 'Ipseeka Malla', 'L'),
(3, 'Graphic White Hoodie', 'A white hoodie with a custom graphic print.', 10, 69.98, 'Ipseeka Malla', 'S'),
(5, 'w', 'w', 3, 23.00, 'Ipseeka Malla', 'm'),
(6, 'Classic Black Hoodie', 'A stylish and comfortable black hoodie.', 20, 49.99, 'Ipseeka Malla', 'L'),
(7, 'Classic Black Hoodie', 'A stylish and comfortable black hoodie.', 20, 49.99, 'Ipseeka Malla', 'L'),
(11, 'ww', 'ww', 11, 11.00, 'Ipseeka Malla', 'S'),
(12, 'ww', 'ww', 11, 11.00, 'Ipseeka Malla', 'S'),
(13, 'Hello', 'eee', 2, 2.00, 'Ipseeka Malla', 'w'),
(16, 'bb', 'bb', 12, 13.00, 'Ipseeka Malla', 'm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hoodies`
--
ALTER TABLE `hoodies`
  ADD PRIMARY KEY (`HoodieID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hoodies`
--
ALTER TABLE `hoodies`
  MODIFY `HoodieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
