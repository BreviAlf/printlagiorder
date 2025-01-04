-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2022 at 09:57 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_katalog_2021`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_color`
--

CREATE TABLE `tb_color` (
  `color_id` int(11) NOT NULL,
  `color_prod_id` int(11) NOT NULL,
  `color_name` varchar(20) NOT NULL,
  `color_hex` varchar(20) NOT NULL,
  `color_add_price` int(11) DEFAULT NULL,
  `color_img_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_color`
--

INSERT INTO `tb_color` (`color_id`, `color_prod_id`, `color_name`, `color_hex`, `color_add_price`, `color_img_url`) VALUES
(1, 281, 'White', '#FFFFFF', 0, ''),
(2, 282, 'White', '#FFFFFF', 0, ''),
(3, 283, 'White', '#FFFFFF', 0, ''),
(4, 284, 'White', '#FFFFFF', 0, ''),
(5, 285, 'White', '#FFFFFF', 0, ''),
(6, 286, 'White', '#FFFFFF', 0, ''),
(7, 287, 'White', '#FFFFFF', 0, ''),
(8, 288, 'White', '#FFFFFF', 0, ''),
(9, 289, 'White', '#FFFFFF', 0, ''),
(10, 290, 'White', '#FFFFFF', 0, ''),
(11, 258, 'White', '#FFFFFF', 0, ''),
(12, 260, 'White', '#FFFFFF', 0, ''),
(13, 262, 'White', '#FFFFFF', 0, ''),
(14, 264, 'White', '#FFFFFF', 0, ''),
(15, 266, 'White', '#FFFFFF', 0, ''),
(16, 268, 'White', '#FFFFFF', 0, ''),
(17, 281, 'Black', '#000000', NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_color`
--
ALTER TABLE `tb_color`
  ADD PRIMARY KEY (`color_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_color`
--
ALTER TABLE `tb_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
