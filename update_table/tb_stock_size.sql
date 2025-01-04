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
-- Table structure for table `tb_stock_size`
--

CREATE TABLE `tb_stock_size` (
  `size_color_id` int(11) NOT NULL,
  `size_prod_id` int(11) NOT NULL,
  `size_name` varchar(11) NOT NULL,
  `size_add_price` int(11) DEFAULT NULL,
  `size_add_weight` int(11) NOT NULL,
  `size_stock` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_stock_size`
--

INSERT INTO `tb_stock_size` (`size_color_id`, `size_prod_id`, `size_name`, `size_add_price`, `size_add_weight`, `size_stock`) VALUES
(1, 281, 'S', 0, 500, 10),
(1, 281, 'M', 0, 500, 10),
(1, 281, 'L', 0, 500, 10),
(1, 281, 'XL', 0, 500, 10),
(2, 282, 'S', 0, 500, 10),
(2, 282, 'M', 0, 500, 10),
(2, 282, 'L', 0, 500, 10),
(2, 282, 'XL', 0, 500, 10),
(3, 283, 'S', 0, 500, 10),
(3, 283, 'M', 0, 500, 10),
(3, 283, 'L', 0, 500, 10),
(3, 283, 'XL', 0, 500, 10),
(4, 284, 'S', 0, 500, 10),
(4, 284, 'M', 0, 500, 10),
(4, 284, 'L', 0, 500, 10),
(4, 284, 'XL', 0, 500, 10),
(5, 285, 'S', 0, 500, 10),
(5, 285, 'M', 0, 500, 10),
(5, 285, 'L', 0, 500, 10),
(5, 285, 'XL', 0, 500, 10),
(6, 286, 'S', 0, 500, 10),
(6, 286, 'M', 0, 500, 10),
(6, 286, 'L', 0, 500, 10),
(6, 286, 'XL', 0, 500, 10),
(7, 287, 'S', 0, 500, 10),
(7, 287, 'M', 0, 500, 10),
(7, 287, 'L', 0, 500, 10),
(7, 287, 'XL', 0, 500, 10),
(8, 288, 'S', 0, 500, 10),
(8, 288, 'M', 0, 500, 10),
(8, 288, 'L', 0, 500, 10),
(8, 288, 'XL', 0, 500, 10),
(9, 289, 'S', 0, 500, 10),
(9, 289, 'M', 0, 500, 10),
(9, 289, 'L', 0, 500, 10),
(9, 289, 'XL', 0, 500, 10),
(10, 290, 'S', 0, 500, 10),
(10, 290, 'M', 0, 500, 10),
(10, 290, 'L', 0, 500, 10),
(10, 290, 'XL', 0, 500, 10),
(11, 258, 'S', 0, 500, 10),
(11, 258, 'M', 0, 500, 10),
(11, 258, 'L', 0, 500, 10),
(11, 258, 'XL', 0, 500, 10),
(12, 260, 'S', 0, 500, 10),
(12, 260, 'M', 0, 500, 10),
(12, 260, 'L', 0, 500, 10),
(12, 260, 'XL', 0, 500, 10),
(13, 262, 'S', 0, 500, 10),
(13, 262, 'M', 0, 500, 10),
(13, 262, 'L', 0, 500, 10),
(13, 262, 'XL', 0, 500, 10),
(14, 264, 'S', 0, 500, 10),
(14, 264, 'M', 0, 500, 10),
(14, 264, 'L', 0, 500, 10),
(14, 264, 'XL', 0, 500, 10),
(15, 266, 'S', 0, 500, 10),
(15, 266, 'M', 0, 500, 10),
(15, 266, 'L', 0, 500, 10),
(15, 266, 'XL', 0, 500, 10),
(16, 268, 'S', 0, 500, 10),
(16, 268, 'M', 0, 500, 10),
(16, 268, 'L', 0, 500, 10),
(16, 268, 'XL', 0, 500, 10);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
