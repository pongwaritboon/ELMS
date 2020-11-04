-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2020 at 05:08 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elms`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(2) NOT NULL,
  `categoryName` varchar(25) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`, `description`) VALUES
(1, 'IOT', 'Internet of Things'),
(2, 'Sensor', 'Sensor'),
(3, 'asfdfdsfdsf', 'asdfdsf');

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `itemID` int(2) NOT NULL,
  `device_name` varchar(255) NOT NULL,
  `device_detail` varchar(255) DEFAULT NULL,
  `device_qrcode` varchar(255) DEFAULT NULL,
  `device_image` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`itemID`, `device_name`, `device_detail`, `device_qrcode`, `device_image`, `status`) VALUES
(1, 'Speed Sensor', 'IOT', NULL, '.jpg', 1),
(2, 'Color Sensor', 'IOT', NULL, '200603074018.jpg', 1),
(3, 'Speed Sensor', 'Sensor', 'phpqrcode/gencode.php?name=รหัสอุปกรณ์: ', '', 1),
(4, 'สายไฟ', 'IOT', 'phpqrcode/gencode.php?name=รหัสอุปกรณ์: ', '200603074330.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notiID` int(2) NOT NULL,
  `username` char(10) NOT NULL,
  `deviceID` int(2) NOT NULL,
  `text` varchar(150) NOT NULL,
  `readStatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notiID`, `username`, `deviceID`, `text`, `readStatus`) VALUES
(1, 'ballstripz', 1, 'คุณได้ยืมอุปกรณ์เกินกำหนดวันแล้ว', 0),
(2, 'ballstripz', 1, 'คุณได้ยืมอุปกรณ์เกินกำหนดวันแล้ว', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transactionID` int(10) NOT NULL,
  `username` char(10) CHARACTER SET utf8mb4 NOT NULL,
  `itemID` int(2) NOT NULL,
  `user_comment` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `admin_comment` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `status` int(1) NOT NULL,
  `request_date` datetime DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `borrowed_date` date DEFAULT NULL,
  `returned_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionID`, `username`, `itemID`, `user_comment`, `admin_comment`, `status`, `request_date`, `pickup_date`, `borrowed_date`, `returned_date`) VALUES
(10000, 'ballstripz', 2, '402', NULL, 0, '2563-04-20 11:41:44', NULL, NULL, NULL),
(10001, 'ballstripz', 1, '402', NULL, 4, '2563-04-21 12:00:00', '2020-05-21', '2020-06-01', '2020-06-03'),
(10002, 'ballstripz', 2, '402', 'fdafdafdf', 0, '2563-05-22 12:00:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `position`, `department`, `username`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Administrator', '1', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', 'y', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'number', '', '', 'number', '81dc9bdb52d04dc20036dbd8313ed055', 'user', 'y', '2019-12-17 15:05:38', '2019-12-17 15:05:38'),
(3, 'ball', NULL, NULL, 'ballball', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', 'y', '2019-12-17 15:10:13', '2019-12-17 15:10:13'),
(4, 'assadfsdfad', 'dasfdfdf', '1', 'numnum', '81dc9bdb52d04dc20036dbd8313ed055', 'user', 'y', '2019-12-17 15:13:41', '2019-12-17 15:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `username` char(10) CHARACTER SET utf8 NOT NULL,
  `password` varchar(12) NOT NULL,
  `firstname` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `role` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`username`, `password`, `firstname`, `surname`, `email`, `role`) VALUES
('admin', '1234', 'Administrator', 'Admin', 'admin@admin.com', '1'),
('ballstripz', '1234', 'ณัฐวัฒน์', 'โรจน์บุญนาค', 'ballstripz@gmail.com', '2'),
('number', '1234', 'พงษ์วริษฐ์', 'บุญญาภัทรศิริ', 'number@number.com', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notiID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `itemID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notiID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
