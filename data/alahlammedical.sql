-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 09, 2018 at 08:02 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alahlamm_ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoris`
--

CREATE TABLE `categoris` (
  `CatID` int(11) NOT NULL,
  `CatName` varchar(255) NOT NULL,
  `CatDesc` varchar(255) NOT NULL,
  `CatStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `genral-sergery`
--

CREATE TABLE `genral-sergery` (
  `ItemID` int(11) NOT NULL,
  `ItemName` varchar(255) NOT NULL,
  `ItemDesc` text NOT NULL,
  `ItemImgurl` varchar(255) NOT NULL,
  `ItemType` varchar(255) NOT NULL,
  `ItemPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genral-sergery`
--

INSERT INTO `genral-sergery` (`ItemID`, `ItemName`, `ItemDesc`, `ItemImgurl`, `ItemType`, `ItemPrice`) VALUES
(1, 'Water Frog', 'An outstanding teaching model for review of the principles and tools necessary to validate the knowledge and skills needed for\r\n                                Peripherally Inserted Central Catheter (PICC) insertion\r\n                                Features\r\n                                 Portable and lightweight\r\n                                 Anatomically correct superior vena cava, subclavian, jugular, median basilic, basilic and\r\n                                cephalic veins\r\n                                 Moveable chin simulates occlusion of the jugular vein\r\n                                 Practice sterile technique for set-up and insertion of the PICC line\r\nPalpable ribs permit practice of measuring proper catheter length from insertion                                site to second or third intercostal space and the confirmation of proper placement\r\n                                of the distal tip of the catheter in the viewable superior vena cava\r\n                                 Placement of standard IV catheter in the major veins', '', 'ZoS 100/I', 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemID` int(11) NOT NULL,
  `ItemName` varchar(255) NOT NULL,
  `ItemDesc` text NOT NULL,
  `ItemImgurl` varchar(255) NOT NULL,
  `ItemType` varchar(255) NOT NULL,
  `ItemPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `ItemName`, `ItemDesc`, `ItemImgurl`, `ItemType`, `ItemPrice`) VALUES
(1, 'Water Frog', 'An outstanding teaching model for review of the principles and tools necessary to validate the knowledge and skills needed for\r\n                                Peripherally Inserted Central Catheter (PICC) insertion\r\n                                Features\r\n                                 Portable and lightweight\r\n                                 Anatomically correct superior vena cava, subclavian, jugular, median basilic, basilic and\r\n                                cephalic veins\r\n                                 Moveable chin simulates occlusion of the jugular vein\r\n                                 Practice sterile technique for set-up and insertion of the PICC line\r\nPalpable ribs permit practice of measuring proper catheter length from insertion                                site to second or third intercostal space and the confirmation of proper placement\r\n                                of the distal tip of the catheter in the viewable superior vena cava\r\n                                 Placement of standard IV catheter in the major veins', '', 'ZoS 100/I', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoris`
--
ALTER TABLE `categoris`
  ADD PRIMARY KEY (`CatID`);

--
-- Indexes for table `genral-sergery`
--
ALTER TABLE `genral-sergery`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoris`
--
ALTER TABLE `categoris`
  MODIFY `CatID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `genral-sergery`
--
ALTER TABLE `genral-sergery`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
