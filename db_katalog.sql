-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2021 at 03:55 AM
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
-- Database: `db_katalog`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bc_batch`
--

CREATE TABLE `tb_bc_batch` (
  `bc_batch_id` int(11) NOT NULL,
  `bc_batch_name` varchar(255) DEFAULT NULL,
  `bc_batch_landing_id` int(11) DEFAULT NULL,
  `bc_batch_cust_batch_id` int(11) NOT NULL,
  `bc_batch_msg` text NOT NULL,
  `bc_batch_date_created` datetime DEFAULT current_timestamp(),
  `bc_batch_file_generate_created` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_bc_batch`
--

INSERT INTO `tb_bc_batch` (`bc_batch_id`, `bc_batch_name`, `bc_batch_landing_id`, `bc_batch_cust_batch_id`, `bc_batch_msg`, `bc_batch_date_created`, `bc_batch_file_generate_created`) VALUES
(8, 'BC_KARTUN', 1, 2, 'kartun msg', '2021-12-25 17:39:40', '0000-00-00'),
(7, 'BC_ANIME', 2, 1, 'msg bc anime', '2021-12-25 17:39:10', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_broadcast`
--

CREATE TABLE `tb_broadcast` (
  `bc_id` int(11) NOT NULL,
  `bc_cust_id` int(11) DEFAULT NULL,
  `bc_batch_name` varchar(50) DEFAULT '',
  `bc_cust_name` varchar(50) DEFAULT NULL,
  `bc_cust_uid` varchar(50) DEFAULT NULL,
  `bc_date_created` datetime DEFAULT NULL,
  `bc_cust_phone` varchar(100) DEFAULT '',
  `bc_niche_id` int(11) DEFAULT NULL,
  `bc_landing_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `cat_desc` varchar(255) DEFAULT NULL,
  `cat_img_url` varchar(255) DEFAULT NULL,
  `cat_date_created` datetime DEFAULT NULL,
  `cat_status` enum('Y','N') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`cat_id`, `cat_name`, `cat_desc`, `cat_img_url`, `cat_date_created`, `cat_status`) VALUES
(1, 'T-Shirt', 'Kategori T Shirt', NULL, '2021-12-12 20:55:14', 'Y'),
(2, 'Hoodie', 'Kategori Hoodie', NULL, '2021-12-12 20:58:47', 'Y'),
(3, 'new catASasAS', 'necw cat aSas', 'public/photo/adat.jpg', NULL, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `cust_id` int(11) NOT NULL,
  `cust_uid` varchar(10) NOT NULL,
  `cust_cust_batch_id` int(11) NOT NULL,
  `cust_name` varchar(50) DEFAULT NULL,
  `cust_email` varchar(255) DEFAULT NULL,
  `cust_phone` varchar(255) DEFAULT NULL,
  `cust_status` enum('N','Y') DEFAULT NULL,
  `cust_gender` char(20) DEFAULT NULL,
  `cust_product_batch` varchar(50) NOT NULL,
  `cust_date_order` date NOT NULL,
  `cust_prov` varchar(50) NOT NULL,
  `cust_city` varchar(50) NOT NULL,
  `cust_district` varchar(50) NOT NULL,
  `cust_address_full` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`cust_id`, `cust_uid`, `cust_cust_batch_id`, `cust_name`, `cust_email`, `cust_phone`, `cust_status`, `cust_gender`, `cust_product_batch`, `cust_date_order`, `cust_prov`, `cust_city`, `cust_district`, `cust_address_full`) VALUES
(1, '', 1, 'IrAgusSulistyo', '', '62﻿811127887', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-06', 'Banten', 'Serang', 'Kramatwatu', 'Griya Serdang Indah\nBlok F1  No 14   Rt 01/Rw 03\nDs Harjatani-Kec Kramatwatu-Serang Banten\n42161'),
(2, '', 1, 'IndraPribadi', '', '62811151116', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-14', 'Dki Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', 'Jl  Pati Unus No 28 ,Rt 03/08 ,Kel Gunung,, Kec  Kby  Baru'),
(3, '', 1, 'Yoga Tandaki', '', '62811163693', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-27', 'Banten', 'Tangerang Selatan', 'Pamulang', 'Warung Pecel Arema, Komplek Ruko Pondok Cabe Mutiara Blok B-27 (Perempatan Gaplek), Pondok Cabe, Pamulang - Tangsel 15418'),
(4, '', 1, 'JoshuaYoung', '', '62811164347', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-03', 'Dki Jakarta', 'Jakarta Utara', 'Penjaringan', 'Apt Riverside, Jalan Muara Karang Barat No 50, Rt 1/Rw 8, Pluit, Penjaringan (Tower2A Lt20Cd), Kota Jakarta Utara, Penjaringan, Dki Jakarta, Id, 14450'),
(5, '', 1, 'Peter J Hibberd', '', '62811171723', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-18', 'Bali', 'Badung', 'Kuta Utara', 'Villa 1, Zin Berawa Villa & Bungalow, Jl  Subak Sari 13 No 8, Tibubeneng, Kec  Kuta Utara, Kabupaten Badung, Bali 80361, Indonesia'),
(6, '', 1, 'Suhartoyo', '', '62811177917', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-25', 'Jawa Barat', 'Bogor', 'Bogor Selatan - Kota', 'Komplek Bbia No 21, Rt 01 / Rw Xi, Kel. Cikaret, Kec. Bogor Selatan, Kota Bogor 16132'),
(7, '', 1, 'BpkHmHatta', '', '62811182358', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-13', 'Dki Jakarta', 'Jakarta Selatan', 'Tebet', 'Pak  Hm Hatta, 0811182358\nJl  H No 7, Rt 7/Rw 6, Kb  Baru, Kec  Tebet, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12830'),
(8, '', 1, 'BpkYannie', '', '62811188581', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-10', 'Jawa Barat', 'Bekasi', 'Bekasi Barat', 'Perumahan Harapan Baru 2 - Jl  Tawes Raya No 14 Rt 06/02 Kel  Kota Baru'),
(9, '', 1, 'Hartono', '', '62811211521', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-23', 'Jawa Barat', 'Bandung', 'Margahayu', 'Komplek Taman Kopo Indah 1 Blok O Nomor 111, Margahayu,Kabupaten Bandung,Jawa Barat,40228'),
(10, '', 1, 'Yogie Dwimaz S', '', '62811218926', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-17', 'Jawa Barat', 'Bandung', 'Ujung Berung', 'Jl. Vijayakusuma I Blok G No. 08, Kompleks Cijambe Indah, Kelurahan Pasir Endah, Kec Ujung Berung, Kota Bandung\nKode Pos 40619'),
(11, '6512bd', 2, 'AMFauzan', '', '62811413314', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-09', 'Jawa Barat', 'Bogor', 'Gunung Putri', 'Komplek Cibubur Country, Cluster Eagle Wood Ew 3 No 3, Cikeas, Gunung Putri, Bogor 16966'),
(12, 'c20ad4', 2, 'Russel Winardy', '', '62811434444', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-20', 'Sulawesi Utara', 'Manado', 'Mapanget', 'Jalan A.A. Maramis, No. 89, Toko Sinar Bahari, Kairagi 2, Lingkungan 3, Manado Mapanget, Kota Manado 95254 Sulawesi Utara'),
(13, 'c51ce4', 2, 'AriWibowo', '', '62811446203', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-26', 'Jawa Barat', 'Bekasi', 'Medan Satria', 'Jl  Palem Hijau Iii Blok G9 No 21 Rt 007/024 Bulevar Hijau, Pejuang, Medan Satria, Jawa Barat 17131'),
(14, 'aab323', 2, 'AzizNikiyuluw', '', '62811489772', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-31', 'Papua', 'Jayapura', 'Jayapura Selatan', 'Jl  Koti No  22 (Bank Btn, Depan Sub Terminal\nMesran), Jayapura Selatan, Kota Jayapura,\nPapua'),
(15, '9bf31c', 2, 'AnthonySalim', '', '62811503188', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-01', 'Jawa Timur', 'Surabaya', 'Sukolilo', 'Galaxi Bumi Permai B5/1 (Araya Tahap 1), 60111'),
(16, 'c74d97', 2, 'Mahdi', '', '62811515874', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-04', 'Kalimantan Selatan', 'Banjarmasin', 'Banjarmasin Timur', 'Jln Dharma Bakti 5D Rt 13 No 28'),
(17, '70efdf', 2, 'Setiawan Setiawan', '', '62811526622', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-06', 'Jawa Timur', 'Surabaya', 'Wiyung', 'Apartemen Waterplace Tower E Unit Rme-08, Jl. Pakuwon Indah Lontar Timur, Surabaya Wiyung, Kota Surabaya, Jawa Timur 60227'),
(18, '6f4922', 2, 'Helsi', '', '62811528115', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-25', 'Kalimantan Tengah', 'Palangkaraya', 'Palangkaraya', 'Jl Kyai Maja No 35\nKota: Palangkaraya\nKecamatan: Menteng\nKodepos: 73112'),
(19, '1f0e3d', 2, 'Togu Manulang', '', '62811576811', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-15', 'Kalimantan Barat', 'Pontianak', 'Pontianak Kota', 'Jalan Sultan Abdurrahman Komp Tongie No.39 A (Samping Kantor Pos)'),
(20, '98f137', 2, 'Muhammad Firdaus', '', '62811587767', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-13', 'Jawa Barat', 'Bekasi', 'Bekasi Barat', 'Kp Rawa Bebek Rt 006/Rw 011 Blok C No 100'),
(21, '3c59dc', 2, 'Simon Adriel Siagian', '', '62811601488', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-24', 'Sumatera Utara', 'Medan', 'Medan Petisah', 'Jalan Ketapang No.6A, S E K I P Kel., Medan Petisah, Kota Medan, Medan Petisah, Sumatera Utara'),
(22, 'b6d767', 2, 'Sarbudin Panjaitan', '', '62811601963', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-12', 'Sumatera Utara', 'Pematang Siantar', 'Siantar Barat', 'Jalan Nusa Indah No 44A. Kelurahan Simarito,Sumatera Utara, Id, 21113'),
(23, '37693c', 2, 'AnggiHutasoit', '', '62811627414', 'Y', 'Laki - Laki', 'T-Shirt', '2019-01-17', 'Jawa Barat', 'Bandung', 'Sukajadi', 'Pengantaran Ke Anggi Maniur Hutasoit Hotel Sweet Karina Kamar 202 Jl  Terusan Babakan Jeruk Iv No 38, Sukagalih, Kec  Sukajadi, Kota Bandung, Jawa Bar'),
(24, '1ff1de', 2, 'AnggiManiurHutasoit', '', '62811627414', 'Y', 'Laki - Laki', 'T-Shirt', '2019-01-17', 'Jawa Barat', 'Cimahi', 'Cimahi Utara', 'Syngenta West Java Office \nJalan Gunung Batu Dalam 2, Komplek Gunung Batu Resident, Rt  01, Rw 11, No  20, Kelurahan Pasirkaliki'),
(25, '8e296a', 2, 'Yulindo', '', '62811661699', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-07', 'Sumatera Barat', 'Padang', 'Koto Tangah', 'Komplek Perumahan Citra Berlindo 2 Rt. 002, Rw 002'),
(26, '4e732c', 2, 'Safar', '', '62811687330', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-01', 'Nanggroe Aceh Darussalam (Nad)', 'Banda Aceh', 'Banda Raya', 'Jln.Tgk.Dilhong Ll , Lorong Juroeng Raya No. 88 ( Dusun Mulia ) Gampoeng Lhong Raya , Kec. Banda Raya Kota Banda Aceh ,23238'),
(27, '02e74f', 2, 'AnggaHidayat', '', '62811711984', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-22', 'Jawa Tengah', 'Surakarta', 'Banjarsari', 'Cv  Seven Touch\nJln  Pleret Raya Barat Ii Rt 03 Rw 012 (Gang Buntu) Banyuanyar, Banjarsari, Surakarta'),
(28, '33e75f', 2, 'Robby Kusuma', '', '62811718699', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-18', 'Sumatera Selatan', 'Lahat', 'Lahat', 'Toko Cemerlang Jaya. Jl Letnan Amir Hamzah No 191. Lahat Sumatera Selatan'),
(29, '6ea9ab', 2, 'Muhammad Daffa Kusnadi', '', '62811724050', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-20', 'Lampung', 'Bandar Lampung', 'Kedaton', 'Jl  Danau Toba No 24B, Surabaya, Kec  Kedaton, Kota Bandar Lampung, Lampung 35148'),
(30, '34173c', 2, 'DrThNikenW', '', '62811728326', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-10', 'Lampung', 'Pringsewu', 'Pringsewu', 'Jl Melati Iii No 261, Pringombo, Pringsewu, Lampung 35373\nKel Pringsewu Timur'),
(31, 'c16a53', 2, 'Roni Amriel', '', '62811762305', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-13', 'Riau', 'Pekanbaru', 'Sukajadi', 'Jl Wijaya No 29 A, Kel Kesungsari Kec Sukajadi\nPekanbaru Riau 28123'),
(32, '6364d3', 2, 'JhonDamanik', '', '62811767621', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-30', 'Riau', 'Indragiri Hulu', 'Seberida', 'Jl  Lintas Timur Simpang Pt  Kat (Ruko Ke Empat Dari Belilas) Kel  Pangkalan Kasai, 29371'),
(33, '182be0', 2, 'Yoan', '', '62811796910', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-19', 'Banten', 'Tangerang Selatan', 'Serpong', 'Taman Tirta Golf C16 Bsd Serpong, Kota Tangerang Selatan, Banten 15310'),
(34, 'e36985', 2, 'BpkIkangFauzie', '', '62811806680', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-15', 'Banten', 'Tangerang Selatan', 'Ciputat Timur', 'Perumahan Pelangi Bintaro No 9, Jln Wr Supratman, Rengas, Ciputat Timur, Tangsel 15412'),
(35, '1c383c', 2, 'KennethChristianMTampubolon', '', '62811817528', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-13', 'Dki Jakarta', 'Jakarta Timur', 'Jatinegara', 'Jalan Cakrawijaya V Blok Y No 1, Cipinang Muara, Jatinegara (Masjud Baitul Hakim), Kota Jakarta Timur, Jatinegara, Dki Jakarta, Id, 13420'),
(36, '19ca14', 2, 'Fernall', '', '62811825028', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-04', 'Dki Jakarta', 'Jakarta Selatan', 'Setia Budi', 'The Bellagio Mansion Lt 15 Unit 8-B Jl  Mega Kuningan Timur I No E 1,2, Rt 5/Rw 2'),
(37, 'a5bfc9', 2, 'AristoSutandi', '', '62811832729', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-05', 'Dki Jakarta', 'Jakarta Selatan', 'Kebayoran Lama', 'Jl  Sultan Iskandar Muda Kav 30  Kebayoran Lama  Jaksel 12240'),
(38, 'a5771b', 2, 'Yoel Lucky Suryawinata', '', '62811838119', 'Y', 'Laki - Laki', 'T-Shirt', '2020-11-16', 'Jawa Barat', 'Bandung', 'Buahbatu (Margacinta)', 'Jl. Sanggar Kencana Xxvii No.48-50, Jatisari, Kec. Buahbatu, Kota Bandung, Jawa Barat 40286 (Emerald Towers Apartment)'),
(39, 'd67d8a', 2, 'Yoel Lucky Suryawinata', '', '62811838119', 'Y', 'Laki - Laki', 'T-Shirt', '2020-11-16', 'Jawa Barat', 'Bandung', 'Margahayu', 'Kopo Permai Blok 53Cd No.32, Rt.001/Rw.012, Desa Sukamenak, Kecamatan Margahayu, Kabupaten Bandung, 40227'),
(40, 'd64592', 2, 'Fadhil', '', '62811850587', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-07', 'Jawa Barat', 'Bogor', 'Gunung Putri', 'Cluster Paris Blok C5 No 15 Kota Wisata Gunung Putri Kab  Bogor 16968'),
(41, '3416a7', 2, 'Petrus', '', '62811872904', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-23', 'Banten', 'Tangerang Selatan', 'Serpong Utara', 'Ruko Orlin Arcade 1 Jln  Boulevard Graha Raya Blok Ja No 36-37 Paku Jaya, Kec  Serpong Utara, Kota Tangerang Selatan, Banten 15324'),
(42, 'a1d0c6', 2, 'Made', '', '62811874897', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-21', 'Dki Jakarta', 'Jakarta Selatan', 'Jagakarsa', 'Jalan Manggis 12A, Rt01 Rw01, Ciganjur, Jagakarsa'),
(43, '17e621', 2, 'Satria Arya Perdana', '', '62811879788', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-25', 'Dki Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', 'Panglima Polim Vii No 147A\nKebayoran Baru, Kota Administrasi Jakarta Selatan, Dki Jakarta 12160'),
(44, 'f71771', 2, 'HerySeptiadi', '', '62811881626', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-18', 'Sumatera Barat', 'Bukittinggi', 'Guguk Panjang (Guguak Panjang)', 'Jl  Ahmad Yani No  1\nKode Pos : 26113'),
(45, '6c8349', 2, 'Riko Hardiman', '', '62811888012', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-19', 'Dki Jakarta', 'Jakarta Selatan', 'Pasar Minggu', 'Jl. Benda Atas No. 7C (Komplek Benda Residence - Disamping Smp 212)\nPasar Minggu, Kota Administrasi Jakarta Selatan, Dki Jakarta 12560'),
(46, 'd9d4f4', 2, 'Nono Sutrisno', '', '62811899969', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-22', 'Jawa Barat', 'Cikarang', 'Cikarang Utara', 'Kp Tanah Baru Rt 05 Rw 02 Ds Harjamekar'),
(47, '67c6a1', 2, 'Riyandajati Gunawan', '', '62811911221', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-30', 'Dki Jakarta', 'Jakarta Selatan', 'Setia Budi', 'Pearl Garden Resort Apartments, Tower 10 Unit Bp02B01, Jalan Jendral Gatot Subroto Kavling 5-7\nSetiabudi, Jakarta Selatan, Dki Jakarta 12930'),
(48, '642e92', 2, 'AdriT', '', '62811948083', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-02', 'Jawa Barat', 'Bekasi', 'Medan Satria', 'Cluster Lotus Blok If 02 Summarecon Bekasi, Kec  Medan Satria Kel  Harapan Mulya\nBekasi, Jawa Barat\nKode Pos: 17143'),
(49, 'f457c5', 2, 'Alung', '', '62811949579', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-28', 'Jawa Barat', 'Depok', 'Cilodong', 'Cluster Singkarak Icon Kav  F Jl  Rri No 76 Rt 01/Rw 08 Kel  Sukamaju, Kec  Cilodong, Depok Timur'),
(50, 'c0c7c7', 2, 'Anto', '', '62811952686', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-23', 'Dki Jakarta', 'Jakarta Selatan', 'Setia Budi', 'Jl Setiabudi 6 Gang 4 No 2 Setiabudi, Kota Administrasi Jakarta Selatan, Dki Jakarta 12910'),
(51, '283802', 2, 'Merna Ulfah', '', '62811956420', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-19', 'Jawa Barat', 'Bekasi', 'Pondok Melati', 'Perum  Bulog 2, Jln  Yanatera 5, Cluster Oriza No  7, Kota Bekasi, Pondok Melati, Jawa Barat'),
(52, '9a1158', 2, 'JackyArjono', '', '62811957557', 'Y', 'Laki - Laki', 'T-Shirt', '2020-08-17', 'Dki Jakarta', 'Jakarta Selatan', 'Jagakarsa', 'Jl  H  Montong No  58 Rt 06/02 Ciganjur'),
(53, 'd82c8d', 2, 'JackyArjuno', '', '62811957557', 'Y', 'Laki - Laki', 'T-Shirt', '2020-08-17', 'Dki Jakarta', 'Jakarta Selatan', 'Jagakarsa', 'Jl  H  Montong No  58 Rt06/Rw02 Ciganjur 12630'),
(54, 'a684ec', 2, 'ClaarkRichardAugustKussoy', '', '62811959024', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-25', 'Dki Jakarta', 'Jakarta Timur', 'Cakung', 'Rusunawa Penggilingan Tower D2 Lt 11, Jl  Raya  Penggilingan No 25, Rt006/Rw019, Penggilingan, Cakung, Jakarta Timur, Cakung, Dki Jakarta, 13940'),
(55, 'b53b3a', 2, 'AndyThomas', '', '62811963986', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-29', 'Sumatera Utara', 'Medan', 'Medan Johor', 'Jl  Karyawisata Perum Taman Johor Baru  Blok A2 No  7 Gedung Johor 20144'),
(56, '9f6140', 2, 'DennyMt', '', '62811977313', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-19', 'Dki Jakarta', 'Jakarta Utara', 'Tanjung Priok', 'Pt  Hpm\nJl  Gaya Motor 1, Sunter 2 Sungai Bambu - Tanjung Priok\nJakarta Utara 14330'),
(57, '72b32a', 2, 'Inggadewi', '', '62811978793', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-05', 'Banten', 'Tangerang Selatan', 'Serpong', 'Jl  Bulevard Gading Serpong, Ruko Paramount Spark Blok C No  30, Gading Serpong 15810'),
(58, '66f041', 2, 'GanangChandraEkayana', '', '62811981136', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-25', 'Jawa Barat', 'Depok', 'Cimanggis', 'Perum Lembah Ciliwung  Jl  Radar Baru Ujung No 70 Rt 004 Rw 012 Kecamatan Pasir Gunung Selatan\nCimanggis, Kota Depok, Jawa Barat 16451'),
(59, '093f65', 2, 'Sandy', '', '62811999817', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-15', 'Banten', 'Tangerang Selatan', 'Pondok Aren', 'Kompleks Taman Mangu Indah Jl. Flamboyan 5 Blok F5 No. 15,Pondok Aren , Kota Tangerang Selatan Provinsi Banten 15224'),
(60, '072b03', 2, 'Joan', '', '62812102431', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-28', 'Dki Jakarta', 'Jakarta Utara', 'Kelapa Gading', 'Apartment The Summit Tower Alpen 2 - 03B Jl Boulevard Sentra\nKelapa Gading, Kota Administrasi Jakarta Utara, Dki Jakarta 14240'),
(61, '7f39f8', 2, 'Trias Marliansix Eyvan', '', '62812224162', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-12', 'Jawa Barat', 'Bandung', 'Rancaekek', 'Perum Griya Permata Raya, Blok B1 No.24 Rt05/014. Nanjungmekar, Rancaekek, Bandung 21349'),
(62, '44f683', 2, 'FirmanMendrofa', '', '62812758202', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-10', 'Lampung', 'Lampung Tengah', 'Bandar Mataram', 'Site Pt  Gpm Housing 1 Blok G  No 8'),
(63, '03afdb', 2, 'Samsul', '', '62815646772', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-29', 'Dki Jakarta', 'Jakarta Barat', 'Kebon Jeruk', 'Bintang Arum Dekorasi  Pasar Bunga Rawa Belong Lantai 2 Blok Kt No 9/10 Jln Sulaiman Kel Sukabumi Utara Kebon Jeruk Jakarta Barat'),
(64, 'ea5d2f', 2, 'Naval Setia Wardana', '', '62815744394', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-13', 'Jawa Tengah', 'Sragen', 'Sragen', 'Jl Nakulo No 17 Sragen, Kab  Sragen, Jawa Tengah 57212'),
(65, 'fc490c', 2, 'Yatmanto', '', '62816101664', 'Y', 'Laki - Laki', 'T-Shirt', '2019-12-23', 'Dki Jakarta', 'Jakarta Barat', 'Cengkareng', 'Jembatan Gantung No. 82 Rt.007 Rw.08, 11710\nPinggir Kali Samping Bakso Pakde No'),
(66, '3295c7', 2, 'Yatmanto', '', '62816101664', 'Y', 'Laki - Laki', 'T-Shirt', '2019-12-23', 'Dki Jakarta', 'Jakarta Barat', 'Cengkareng', 'Jl. Jembatan Gantung Rt.007 Rw.08 No. 82\nKel. Kedaung Kaliangke'),
(67, '735b90', 2, 'Shanata Zein', '', '62816202007', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-23', 'Jawa Barat', 'Bandung', 'Andir', 'Jendral Sudirman, Perumahan Sudirman Town House B14'),
(68, 'a3f390', 2, 'DrImam', '', '62816211713', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-28', 'Banten', 'Tangerang', 'Tangerang', 'Le Paris Syariah Residence\nKamar : 215\nJln Daan Mogot Km 23 No 20 Tanah Tinggi'),
(69, '14bfa6', 2, 'Salman Alfarisi', '', '62816241919', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-27', 'Sulawesi Selatan', 'Makassar', 'Biring Kanaya', 'Jalan Taman Sudiang Indah Block N7.12 (Taman Sudiang Indah N7/12), Kota Makassar, Biring Kanaya, Sulawesi Selatan, Id, 90241'),
(70, '7cbbc4', 2, 'IpikJulpikar', '', '62816283917', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-17', 'Jawa Barat', 'Bogor', 'Cibungbulang', 'Kp  Purwabakti Rt  02/04 Desa Cijujung, Kec Cibungbulang Kab Bogor 16630'),
(71, 'e2c420', 2, 'Michael Jon', '', '62816383288', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-03', 'Sumatera Selatan', 'Palembang', 'Kalidoni', 'Perumahan Grand Garden Jalan Monalisa Blok B Nomor 11 \nKode Pos 30114'),
(72, '32bb90', 2, 'AriesHariyanto', '', '62816554075', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-04', 'Jawa Timur', 'Malang', 'Klojen', 'Jl  Galunggung 67 B-C'),
(73, 'd2ddea', 2, 'Djoko', '', '62816554434', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-09', 'Jawa Timur', 'Malang', 'Blimbing', 'Jln Karya Timur No19 , Kec Blimbing ,Kota Malang'),
(74, 'ad61ab', 2, 'Achlan', '', '62816645630', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-20', 'Jawa Barat', 'Sukabumi', 'Sukalarang', 'Jalan Kadu Gede Rt 004 Rw 004, Sukalarang, Sukabumi, 43191'),
(75, 'd09bf4', 2, 'Gio', '', '62816667800', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-01', 'Jawa Tengah', 'Semarang', 'Candisari', 'Sultan Agung No 88 Semarang'),
(76, 'fbd793', 2, 'AgnesMSoegijanto', '', '62816681832', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-18', 'Di Yogyakarta', 'Sleman', 'Depok', 'Pandega Widya Ct I/Pw 9 Sarimulyo Jl  Kaliurang Km  5,6 Yogyakarta 55281'),
(77, '28dd2c', 2, 'Mifi', '', '62816710279', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-23', 'Dki Jakarta', 'Jakarta Pusat', 'Gambir', 'Jl  Tanah Abang 5 No 5\nRt/Rw : 01/02\nPetojo Selatan\nGambir\n10160'),
(78, '35f4a8', 2, 'Yus Rustandi', '', '62816712223', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-26', 'Jawa Barat', 'Bogor', 'Sukaraja', 'Jl. Cempaka No 21 Kpmpl. Cimahpar Endah I Ds/Kec. Sukaraja Kab. Sukabumi\nSukaraja, Kab. Sukabumi, Jawa Barat 43192'),
(79, 'd1fe17', 2, 'Yogi B', '', '62816716956', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-18', 'Dki Jakarta', 'Jakarta Pusat', 'Cempaka Putih', 'Jl Pramuka Sari 3 No 16 Rt 14 Rw 07 ( Masuk Setelah Bengkel / Showroom Mobil Dfsk )'),
(80, 'f033ab', 2, 'IrwanGunawan', '', '62816740909', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-01', 'Dki Jakarta', 'Jakarta Utara', 'Penjaringan', 'Mediterania Boulevard Florence 5 No 19 Pik Jakarta Utara 14460'),
(81, '43ec51', 2, 'Yudhi', '', '62816752316', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-25', 'Jawa Barat', 'Bekasi', 'Bekasi Selatan', 'Taman Sentosa Blok G4 No.9El. Pasir Sari, Kec. Cikarang Selatan, Kab. Bekasi Jawa Barat 17550, Kab. Bekasi, Cikarang Selatan, Jawa Barat, Id, 17851'),
(82, '9778d5', 2, 'IskaAjiSetyawan', '', '62816782869', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-09', 'Jawa Tengah', 'Tegal', 'Tegal Barat', 'Kantor Dinas Pekerjaan Umum Dan Penataan Ruang Kota Tegal, Jl  Proklamasi No 11  Kota Tegal'),
(83, 'fe9fc2', 2, 'Restu Adi Setiawan', '', '62816794742', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-21', 'Jawa Barat', 'Bekasi', 'Bekasi Utara', 'Teluk Pucung,Masjid Nurul Hidayah .Kampung Bulak Asri Rt 5 Rw 23'),
(84, '68d30a', 2, 'Restu Jait', '', '62816794742', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-21', 'Jawa Barat', 'Bekasi', 'Bekasi Utara', 'Masjid Nurul Hidayah. Kp. Bulak Asri Rt 5 Rw23 (Kontrakan 4 Pintu),Teluk Pucung . Bekasi Utara. Jawa Barat 17121'),
(85, '3ef815', 2, 'Rians Hidayat', '', '62816845557', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-05', 'Jawa Barat', 'Bogor', 'Nanggung', 'Kp. Cisangku Rt/Rw 001/005, Desa Malasari, Kecamatan Nanggung, Kab Bogor, Jawa Barat\nKelurahan : Malasari'),
(86, '93db85', 2, 'Pohan Lionardi', '', '62816845808', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-02', 'Dki Jakarta', 'Jakarta Barat', 'Kalideres', 'Citra 2 Extention, Bg 6 / 19 (Pos 5)  Pegadungan, Kalideres Citragarden City\nKalideres, Kota Administrasi Jakarta Barat, Dki Jakarta 11830'),
(87, 'c7e124', 2, 'AgusSugianto', '', '62816847553', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-12', 'Banten', 'Tangerang', 'Kronjo', 'Kp Gaga Warung Rt 003 Rw 003 Kel Pagedangan Ilir Kec Krojo Kab Tangerang Kode Pos 15550'),
(88, '2a38a4', 2, 'HelmaDewiGaoh', '', '62816868865', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-19', 'Banten', 'Tangerang', 'Pasar Kemis', 'Pt  Inti Metalindo Lestari (Pabrik Paku) Jalan Raya Rajeg Km9 Kampung Picung Rt 005 Rw 005'),
(89, '764796', 2, 'BudiUtomo', '', '62816886817', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-07', 'Dki Jakarta', 'Jakarta Barat', 'Kebon Jeruk', 'Duri Permai 1 No 20,Duri Kepa'),
(90, '861398', 2, 'AchmadAdityaAkbar', '', '62816897324', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-28', 'Dki Jakarta', 'Jakarta Timur', 'Duren Sawit', 'Apartemen Casablanca East Residence Cer2 Tower Casa B Lt 3A/16 Jalan Pahlawan Revolusi No 2 Pondok Bambu Duren Sawit Jakarta Timur'),
(91, '54229a', 2, 'Sevianto Nismara', '', '62816908190', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-17', 'Dki Jakarta', 'Jakarta Selatan', 'Jakarta Selatan', 'Sevianto Nismara\nJl. Kencana Permai Vii  No.8\nJakarta Selatan\nJk 12310\nIndonesia'),
(92, '92cc22', 2, 'Uchok S Nismara', '', '62816908190', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-17', 'Dki Jakarta', 'Jakarta Selatan', 'Kebayoran Lama', 'Jln. Kencana Permai Vii No. 8'),
(93, '98dce8', 2, 'Supriyanto', '', '62816939903', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-17', 'Jawa Barat', 'Bogor', 'Gunung Putri', 'Desa.Nagrak.Perumahan Legenda Wisata.Klaster Eintein.Blok.R.09/16.Cibubur'),
(94, 'f4b9ec', 2, 'Paulus Bambang', '', '62816950799', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-16', 'Jawa Barat', 'Bekasi', 'Medan Satria', 'Jl  Taman Harapan Baru Tim  I, Kecamatan Medan Satria, Kota Bks, Jawa Barat, 17125\nBlok P2 No  3 Rt 005, Rw 023'),
(95, '812b4b', 2, 'Evelin', '', '62816956132', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-10', 'Dki Jakarta', 'Jakarta Barat', 'Kembangan', 'Taman Kebon Jeruk Blok I-5 No 26\nJakarta Barat 11630'),
(96, '26657d', 2, 'Aris', '', '62816956341', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-12', 'Jawa Barat', 'Cikarang', 'Cikarang Selatan', 'Jl  Tidar 3 No 7 Taman Sriwijaya, Lippo Cikarang\nKodepos:17530'),
(97, 'e2ef52', 2, 'HandiSaptaMukti', '', '62816960826', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-06', 'Dki Jakarta', 'Jakarta Timur', 'Duren Sawit', 'Jalan Selat Lombok-I Blok G7/6 Rt002/Rw017 Kav  Tni-Al'),
(98, 'ed3d2c', 2, 'HandiSm', '', '62816960826', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-06', 'Dki Jakarta', 'Jakarta Timur', 'Duren Sawit', 'Jalan Selat Lombok-1 Blok G7/6 Kav  Tni-Al Rt 002 Rw 017'),
(99, 'ac627a', 2, 'JenniferJovancaChandra', '', '62816971817', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-17', 'Dki Jakarta', 'Jakarta Barat', 'Kembangan', 'Taman Permata Buana, Jl  Buana Biru Besar Blok O1 No  2, Rt: 07 / Rw: 11, Kembangan Utara, Kembangan, Jakarta Barat, Dki Jakarta 11610'),
(100, 'f89913', 2, 'Redo', '', '62816999891', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-13', 'Dki Jakarta', 'Jakarta Timur', 'Pulo Gadung', 'Tower A, Unit 604, Taman Pasadenia Pulomas, Jl. Pacuan Kuda Raya, 13210'),
(101, '38b3ef', 2, 'Zaenul Mutaqin', '', '62817107400', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-22', 'Jawa Barat', 'Bogor', 'Bogor Barat - Kota', 'Kampung Pilar 2 No.80 Rt04 Rw01 Jalan Cifor, Kel. Bubulak'),
(102, 'ec8956', 2, 'Siswanto', '', '62817172745', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-15', 'Jawa Tengah', 'Pemalang', 'Pemalang', 'Jln Wora Wari 2 Rt003/Rw011 Dusun 6 Desa Kabunan Kec. Taman Kab. Pemalang Jawa Tengah'),
(103, '6974ce', 2, 'DrRyan', '', '62817212107', 'Y', 'Laki - Laki', 'T-Shirt', '2019-01-26', 'Jawa Barat', 'Bandung', 'Sukajadi', '(Laboratorium Kesehatan Provinsi Jawa Barat), Jl Sederhana No 3-5\n(Ctk Namanya Kcil Saja, Sepanjang Logo Saja)'),
(104, 'c9e107', 2, 'Ryan  B', '', '62817212107', 'Y', 'Laki - Laki', 'T-Shirt', '2019-01-26', 'Jawa Barat', 'Bandung', 'Margahayu', 'Taman Kopo Indah 1 Blok F 120\nKec. Margahayu,Bandung'),
(105, '65b9ee', 2, 'BrianNovianWiyono', '', '62817297334', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-01', 'Jawa Tengah', 'Sukoharjo', 'Baki', 'Jl  Rojolele No 24 Rt 02 Rw 04 Sawahan, Kudu, Baki Sukoharjo, Jawa Tengah'),
(106, 'f0935e', 2, 'Arran', '', '62817332001', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-25', 'Dki Jakarta', 'Jakarta Barat', 'Taman Sari', 'Jl Terong A No 119A, Kelurahan : Mangga Besar, Rt/Rw : 010/001, Kota Jakarta Barat, Taman Sari, Dki Jakarta'),
(107, 'a97da6', 2, 'Amirudin', '', '62817402069', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-20', 'Jawa Barat', 'Bogor', 'Tanah Sereal', 'Jalan :Pemuda, No Rumah : 26 ,Cuci Steem 24 Jam Rt/Rw :04 /02 Kode Pos:16161'),
(108, 'a3c65c', 2, 'BarryTasman', '', '62817720277', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-10', 'Dki Jakarta', 'Jakarta Pusat', 'Gambir', 'Jl Kh Zainul Arifin No 27 Ruko B4 , Rt 02/Rw 01 Petojo Utara ,Kecamatan Gambir ,Kota Jakarta Pusat ,Daerah Khusus Ibukota Jakarta , 10130'),
(109, '2723d0', 2, 'M  Lukmanul Hakim', '', '62817722447', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-04', 'Banten', 'Tangerang Selatan', 'Pondok Aren', 'Tamani Residence Blok A No  5 Jalan Amal Bakti, Jurangmangu Barat, Pondok Aren, Tangerang Selatan\nPondok Aren, Kota Tangerang Selatan  15223'),
(110, '5f93f9', 2, 'BillyYoelHalim', '', '62817725799', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-10', 'Dki Jakarta', 'Jakarta Barat', 'Tambora', 'Jalan Sawah Lio Gang 4 No 21E, Rt12 Rw08, Kecamatan Tambora, Kelurahan Jembatan Lima, 11250'),
(111, '698d51', 2, 'Rusdian', '', '62817744539', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-23', 'Bali', 'Badung', 'Kuta Utara', 'Jl. Raya Gadon Gg. Kemoning R8'),
(112, '7f6ffa', 2, 'Sean Richard', '', '62817770157', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-12', 'Dki Jakarta', 'Jakarta Utara', 'Penjaringan', 'Muara Karang Blok G.8. Utara Nomor. 1, Rt004/Rw012, Pluit, Penjaringan, Jakarta Utara, Dki Jakarta, 14450'),
(113, '73278a', 2, 'Risty Pena', '', '62817775830', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-06', 'Jawa Barat', 'Bogor', 'Bogor Timur - Kota', 'Jl. Pakuan (Ciheuleut) No.3 Bogor Timur-16143'),
(114, '5fd0b3', 2, 'HAdiy', '', '62817776191', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-17', 'Jawa Barat', 'Bekasi', 'Mustika Jaya', 'Mutiara Gading Timur F10 37 Mustika Jaya, Bekasi Kota'),
(115, '2b4492', 2, 'Hadiy', '', '62817776191', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-17', 'Dki Jakarta', 'Jakarta Timur', 'Pulo Gadung', 'Pt Miwon Indonesia Jl Perintis Kemerdekaan No 1-3, Pulo Gadung, Jakarta Timur'),
(116, 'c45147', 2, 'JevierJustin', '', '62817778040', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-06', 'Dki Jakarta', 'Jakarta Barat', 'Kebon Jeruk', 'Jln Duri Intan 6, No 173, Duri Kepa, Jakarta Barat'),
(117, 'eb160d', 2, 'Avis', '', '62817793211', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-27', 'Dki Jakarta', 'Jakarta Pusat', 'Senen', 'Toko Karunia Aluminium\nJl  Letjend Soeparpto, Pasar Poncol, No 3\nJakarta Pusat\n10460'),
(118, '5ef059', 2, 'AgoesH', '', '62817851784', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-01', 'Jawa Barat', 'Bekasi', 'Bekasi Selatan', 'Jl Rajawali 7 No 98 Perumnas 1 Kayu Ringin Bekasi Selatan Kota Bekasi'),
(119, '07e1cd', 2, 'DenyDwiHeryanti', '', '62817868762', 'Y', 'Laki - Laki', 'T-Shirt', '2019-06-20', 'Banten', 'Tangerang Selatan', 'Ciputat', 'Jl  Cendrawasih / Gang Asem, Komplek Grand Cendrawasih Asri Blok C No 22  Kel  Cipayung Kec  Ciputat Tangerang Selatan'),
(120, 'da4fb5', 2, 'DenyDwiHeryanty', '', '62817868762', 'Y', 'Laki - Laki', 'T-Shirt', '2019-06-20', 'Banten', 'Tangerang Selatan', 'Ciputat', 'Jl Cendrawasih / Gg Asem Komplek Grand Cendrawasih Asri Blok C No 22 Cipayung Ciputat Tangsel\nCiputat, Kota Tangerang Selatan, Banten 15411'),
(121, '4c56ff', 2, 'Basuki', '', '62817880000', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-16', 'Dki Jakarta', 'Jakarta Selatan', 'Tebet', 'Jl  Tebet Utara I No 11, Kec  Tebet, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, 12820'),
(122, 'a0a080', 2, 'Realme', '', '62817897724', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-28', 'Jawa Timur', 'Madiun', 'Kartoharjo', 'Jl. Thamrin No.85 A-B ( Depan Nakamura ), Klegen, Kec. Kartoharjo, Kota Madiun, Jawa Timur 63117'),
(123, '202cb9', 2, 'Anto', '', '62818110359', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-26', 'Banten', 'Serang', 'Curug', 'Jalan Amani No 2 Taman Okinawa Lippo Karawaci\nCurug, Kab  Tangerang, Banten 15810'),
(124, 'c8ffe9', 2, 'Pawana Segara', '', '62818119550', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-16', 'Dki Jakarta', 'Jakarta Selatan', 'Pancoran', 'Komplek Kalibata Indah\nJl Salak K 36 Pancoran, Kota Administrasi Jakarta Selatan 12750\nDki Jakarta'),
(125, '3def18', 2, 'Fiky', '', '62818131951', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-17', 'Banten', 'Tangerang Selatan', 'Setu', 'Jalan Sari Mulya No  45 ( Pagar Biru )'),
(126, '069059', 2, 'Muhammad Arif  Nahrulah', '', '62818142388', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-03', 'Banten', 'Serang', 'Serang', 'Lontar Pos Selatan\nNo 60-64\nRt01/02\nSerang\nBanten\n42115'),
(127, 'ec5dec', 2, 'Katty', '', '62818146722', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-05', 'Dki Jakarta', 'Jakarta Barat', 'Cengkareng', 'Taman Palem Lestari Blok G1 No 11, 11730'),
(128, '76dc61', 2, 'Katty', '', '62818146722', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-05', 'Dki Jakarta', 'Jakarta Barat', 'Cengkareng', 'Taman Palem Lestari Blok G1/11,\nJakarta Barat - 11730'),
(129, 'd1f491', 2, 'IwanLudijanto', '', '62818181802', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-27', 'Dki Jakarta', 'Jakarta Selatan', 'Mampang Prapatan', 'Kemang Dalam Iv No K18  Rt/Rw  03/03'),
(130, '9b8619', 2, 'IwanSetiawan', '', '62818183863', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-03', 'Dki Jakarta', 'Jakarta Barat', 'Grogol Petamburan', 'Grand Tropic Apartment Tower 1 Unit 502 Jl  S  Parman Kav  3\nGrogol, Kota Administrasi Jakarta Barat, Dki Jakarta 11470'),
(131, '1afa34', 2, 'Marko Hermawan', '', '62818201913', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-24', 'Dki Jakarta', 'Jakarta Selatan', 'Pasar Minggu', 'Jl  Margasatwa Barat No 5 Kav 14A Komplek Bukit Indah, Cilandak Timur\nKodepos: 12560'),
(132, '65ded5', 2, 'FerryFauzi', '', '62818226014', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-01', 'Jawa Barat', 'Bandung', 'Kutawaringin', 'Bojong Waru Rt 001 Rw 003 Kel  Kopo Kec Kutawaringin Bandung'),
(133, '9fc3d7', 2, 'AwanFirmanto', '', '62818227100', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-26', 'Jawa Barat', 'Garut', 'Tarogong Kidul', 'Jl  Guntur Melati No 30, Kec  Tarogong Kidul, Kabupaten Garut, Jawa Barat, 44151 [Note: Pd Mandala]'),
(134, '02522a', 2, 'Paulus Wilson', '', '62818227808', 'Y', 'Laki - Laki', 'T-Shirt', '2020-06-14', 'Sumatera Utara', 'Medan', 'Medan Baru', 'House Of Joker\nJl  Darat No 104, Darat'),
(135, '7f1de2', 2, 'Paulus Wilson', '', '62818227808', 'Y', 'Laki - Laki', 'T-Shirt', '2020-06-14', 'Sumatera Utara', 'Medan', 'Medan Baru', 'Gramedia Gajah Mada\n\nJl Gajah Mada No 23, Petisah Hulu'),
(136, '42a0e1', 2, 'HendraIrawan', '', '62818228657', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-05', 'Banten', 'Serang', 'Serang', 'Jlm Maulana Yusuf No 110 Perempatan Taman Sari - Royal, Kelurahan Cimuncang, Desa Pegantungan Royal'),
(137, '3988c7', 2, 'BayuKurniawan', '', '62818250214', 'Y', 'Laki - Laki', 'T-Shirt', '2019-02-16', 'Jawa Tengah', 'Karanganyar', 'Colomadu', 'Perum Dosen Uns, Griyan Baru Gang V No 51, Baturan, Colomadu, Karanganyar, Jawa Tengah'),
(138, '013d40', 2, 'BayuKurniawan', '', '62818250214', 'Y', 'Laki - Laki', 'T-Shirt', '2019-02-16', 'Jawa Tengah', 'Karanganyar', 'Colomadu', 'Perum Dosen Uns, Griyan Baru Gang V No 51, Baturan, Colomadu, Karanganyar, Jawa Tengah'),
(139, 'e00da0', 2, 'Saladin Siregar', '', '62818280290', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-12', 'Dki Jakarta', 'Jakarta Barat', 'Kembangan', 'Jl. Michelia 2 Blok I 3 No 16. Puri Botanical Residence. Kelurahan Joglo'),
(140, '138597', 2, 'JabhezPriyantoro', '', '62818291797', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-13', 'Jawa Tengah', 'Semarang', 'Tembalang', 'Jl Bukit Kelapa Gading 1 Blok Ak 28-29 Bukit Kencana Jaya Tembalang Semarang 50271'),
(141, '0f28b5', 2, 'BataraAruMantra', '', '62818297542', 'Y', 'Laki - Laki', 'T-Shirt', '2020-02-19', 'Jawa Tengah', 'Semarang', 'Semarang Tengah', 'Jl  Sekayu Raya 2 No 347 (Belakang Thamrin Square)'),
(142, 'a8baa5', 2, 'BataraAruMantra', '', '62818297542', 'Y', 'Laki - Laki', 'T-Shirt', '2020-02-19', 'Jawa Tengah', 'Semarang', 'Semarang Tengah', 'Jln  Sekayu Baru 7 No  32 \nSemarang \nKode Pos 50132'),
(143, '903ce9', 2, 'Thea', '', '62818302303', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-25', 'Jawa Barat', 'Bogor', 'Cileungsi', 'Kota Wisata Pesona Kyoto D3 Nomor 42 Cileungsi Cibubur, K'),
(144, '0a09c8', 2, 'Stanley Setiawan', '', '62818316568', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-29', 'Jawa Timur', 'Surabaya', 'Sukolilo', 'Jl. Sukolilo Rejeki 1 No 38,\nSukolilo Dian Regency,\nKeputih, Surabaya 60111'),
(145, '2b24d4', 2, 'CarolineBudiman', '', '62818333112', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-07', 'Jawa Timur', 'Surabaya', 'Dukuh Pakis', 'Darmo Hill Blok Q No 9\nSurabaya 60225'),
(146, 'a5e001', 2, 'Putrantos Madedi Budiawan', '', '62818390111', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-01', 'Jawa Timur', 'Surabaya', 'Wonokromo', 'Jl. Lombok 28 Surabaya'),
(147, '8d5e95', 2, 'Ovic Yulkarnain', '', '62818414362', 'Y', 'Laki - Laki', 'T-Shirt', '2020-09-10', 'Dki Jakarta', 'Jakarta Pusat', 'Senen', 'Jl Kramat Raya No 61 (Ex Polres Jakarta Pusat) Lt 3 No 20 Senen Jakarta Pusat 10450'),
(148, '47d1e9', 2, 'Ovic Yulkarnain', '', '62818414362', 'Y', 'Laki - Laki', 'T-Shirt', '2020-09-10', 'Dki Jakarta', 'Jakarta Pusat', 'Senen', 'Jl Kramat Raya No 61 (Ex Polres Jakarta Pusat) Lt 3 No 20 Senen Jakarta Pusat 10450'),
(149, 'f22170', 2, 'DedySPermana', '', '62818426955', 'Y', 'Laki - Laki', 'T-Shirt', '2020-06-06', 'Jawa Barat', 'Cirebon', 'Kesambi', 'Jl  Sutomo Gg  Cempaka Dalam I No  45A\nKesambi Cirebon Jawa Barat 45131'),
(150, '7ef605', 2, 'Tira Sari', '', '62818426955', 'Y', 'Laki - Laki', 'T-Shirt', '2020-06-06', 'Jawa Barat', 'Cirebon', 'Kesambi', 'Jl. Sutomo Gg. Cempaka Dalam 1 No. 45A Rt 01 Rw 10 Sidamulya Utara Pekiringan Kesambi Kota Cirebon 45131'),
(151, 'a8f15e', 2, 'Vicki Christina', '', '62818455747', 'Y', 'Laki - Laki', 'T-Shirt', '2020-09-14', 'Dki Jakarta', 'Jakarta Pusat', 'Jakarta Pusat', 'Pt Sinarmas Asset Management Sinarmas Land Plaza\nTower 3 Lt 7\nJl Mh Thamrin No 51 10350'),
(152, '37a749', 2, 'Vicky Tomo', '', '62818455747', 'Y', 'Laki - Laki', 'T-Shirt', '2020-09-14', 'Dki Jakarta', 'Jakarta Pusat', 'Tanah Abang', 'Sudirman Park Apartemenunit A10Ae Jl. Kh. Mas Mansyur Kav.35 10250'),
(153, 'b3e3e3', 2, 'HeryArifListiyanto', '', '62818456133', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-05', 'Jawa Barat', 'Depok', 'Sukmajaya', 'Jl  H Bain Jinun, Perumahan Pondok Sari Alam 2 No  7, Rt  01 /Rw 09'),
(154, '1d7f7a', 2, 'CupyAktoyo', '', '62818456690', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-03', 'Jawa Tengah', 'Semarang', 'Semarang Barat', 'Jl Wiroto Iii No  20 Rt 07 Rw 05 Kel Krobokan Kec Semarang Barat 50141'),
(155, '2a79ea', 2, 'Qudwatullah', '', '62818484211', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-13', 'Banten', 'Cilegon', 'Ciwandan', 'Cilegon Kec: Ciwandan Desa Tegal Ratu Rt 12/06 Kubang Lumbra'),
(156, '1c9ac0', 2, 'AnggiMilenia', '', '62818522761', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-26', 'Dki Jakarta', 'Jakarta Utara', 'Kelapa Gading', 'Jln  Gading 8 No  D6, Kodamar, Kelapa Gading Barat,'),
(157, '6c4b76', 2, 'DarmawanSiregar', '', '62818566541', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-07', 'Jawa Barat', 'Bekasi', 'Jatiasih', 'Komplek Tni Au Kebantenan Indah Jl Hercules A1 No 12 Jatiasih Kota Bekasi 17423'),
(158, '064096', 2, 'DefitMiorudin', '', '62818575756', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-10', 'Jawa Barat', 'Cirebon', 'Harjamukti', 'Firdaus Florist Jl  Jend  Sudirman (Persis Disebrang Rumah Dinas Wakil Walikota Cirebon), Wanacala Rt/Rw : 005/008 Kel Harjamukti Kec  Harjamukti Kota'),
(159, '140f69', 2, 'Andre', '', '62818578063', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-18', 'Jawa Timur', 'Pamekasan', 'Waru', 'Jl  Semangka 1 No 47 Pondok Candra Indah'),
(160, 'b73ce3', 2, 'AsepMukti', '', '62818604700', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-17', 'Dki Jakarta', 'Jakarta Pusat', 'Cempaka Putih', 'Jl Taman Lagura Indah No 25 Rt 01 Rw 02 Cempaka Putih Timur Jakarta Pusat, Kota Jakarta Pusat, Cempaka Putih, Dki Jakarta, Id, 10510'),
(161, 'bd4c9a', 2, 'Novel', '', '62818615716', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-03', 'Jawa Barat', 'Bandung', 'Bojongloa Kaler', 'Jl Bbk Irigasi Gg Amd 8 Rt 07/03\nKel Bbk Tarogong \nKec Bojong Loa Kaler'),
(162, '82aa4b', 2, 'Nasori', '', '62818627452', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-23', 'Jawa Barat', 'Indramayu', 'Indramayu', 'Pt Azizan Wesi Utama  Jl Raya Soekarno Hatta No 81 Desa  Gelar Mendala Balongan, Kecamatan Balongan'),
(163, '0777d5', 2, 'LaluHermanHendro', '', '62818633403', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-20', 'Nusa Tenggara Barat (Ntb)', 'Lombok Timur', 'Sakra', 'Gubuk Sawo Desa Sakra\nKecamatan : Sakra\nKabupaten : Lombok Timur Nusa Tenggara Barat'),
(164, 'fa7cdf', 2, 'AlexanderGiovanni', '', '62818669020', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-09', 'Dki Jakarta', 'Jakarta Barat', 'Grogol Petamburan', 'Apartemen Mediterania 2 Tanjung Duren, Jl Letjen S  Parman, Kec  Grogol Petamburan, Kota Jakarta Barat 11470 (Apartemen Mediterania 2 Tower E Lt 5H)'),
(165, '976652', 2, 'Rully J  Anwar', '', '62818710755', 'Y', 'Laki - Laki', 'T-Shirt', '2020-05-12', 'Dki Jakarta', 'Jakarta Selatan', 'Cilandak', 'D Puri Gandaria Mansion Unit 1912 Jalan Haji Syaip No 17-19 Rt 13/Rw 02'),
(166, '7e7757', 2, 'Rully J Anwar', '', '62818710755', 'Y', 'Laki - Laki', 'T-Shirt', '2020-05-12', 'Dki Jakarta', 'Jakarta Selatan', 'Cilandak', 'D Puri Gandaria Mansion Unit 1912 Jalan Haji Syaip No 17-19 Rt 13/Rw 02 Gandaria Selatan Jaksel 12420'),
(167, '5878a7', 2, 'FredrickSutjiady', '', '62818723198', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-07', 'Banten', 'Serang', 'Curug', 'Jl  Taman Pattaya 5 No 12, Karawaci\nKabupaten Tangerang, Curug, Banten -15810'),
(168, '006f52', 2, 'FredrickSutjiady', '', '62818723198', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-07', 'Jawa Barat', 'Serang', 'Curug', 'Jl Taman Pattaya 5 No 12 Curug ,Kab Tangerang 15810'),
(169, '363663', 2, 'Ereskayanto', '', '62818740106', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-17', 'Jambi', 'Jambi', 'Jambi', 'Jln  Patimura, Lrg Rcti (Jln Mukhtar), Rt 70, No 27  Kel Kenali Besar, Kec  Alam Barajo'),
(170, '149e96', 2, 'Renina Moeli', '', '62818742355', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-04', 'Banten', 'Tangerang Selatan', 'Serpong', 'Bumi Serpong Residence Jl. Gunung Krakatau Iv Blok J 18, Buaran'),
(171, 'a4a042', 2, 'Rakha Attalla Rahman', '', '62818780580', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-13', 'Jawa Barat', 'Depok', 'Sukmajaya', 'Pondok Sukmajaya Permai Blok D3 No 11, Rt 11/03, Kel Sukmajaya'),
(172, '1ff8a7', 2, 'Novembiyanto Yuwono', '', '62818849225', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-02', 'Banten', 'Tangerang', 'Cikupa', 'Jl  Raya Serang Km 16 8  Cikupa - Tangerang 15710 (Gudang Besi)\nCikupa, Kab  Tangerang, Banten 15710'),
(173, 'f7e6c8', 2, 'FerioHamlet', '', '62818853537', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-21', 'Dki Jakarta', 'Jakarta Utara', 'Penjaringan', 'Pluit Karang Sari Iii No 31\nKodepos : 14450'),
(174, 'bf8229', 2, 'Budiyanto', '', '62818877834', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-15', 'Banten', 'Tangerang Selatan', 'Pondok Aren', 'Perum Vila Japos Graha Lestari Blok B1 No 11, Jurangmangu Barat'),
(175, '821612', 2, 'AndrySoetiawan', '', '62818880025', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-26', 'Dki Jakarta', 'Jakarta Selatan', 'Kebayoran Lama', 'Kebayoran Lama Raya, No 31, Menteng Motor, Samping Gang Tepekong, Rt/Rw : 002/011\nKebayoran Lama, Jakarta Selatan, Dki Jakarta 12220'),
(176, '38af86', 2, 'Triyanto', '', '62818881018', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-06', 'Jawa Timur', 'Malang', 'Lowokwaru', 'Perumahan Green Orchid Cluster Grande Blok E No 10 Mojolangu'),
(177, '96da2f', 2, 'Yoseph', '', '62818904838', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-11', 'Banten', 'Tangerang', 'Pinang (Penang)', 'Perumahan Banjar Wijaya Cluster Viola B79/6, Pinang, Tangerang'),
(178, '8f8551', 2, 'Sutanto', '', '62818905132', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-10', 'Dki Jakarta', 'Jakarta Utara', 'Penjaringan', 'Jl Katamaran Indah 2 No 39, Pantai Indah Kapuk'),
(179, '8f5329', 2, 'Morry Hudson', '', '62818911956', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-28', 'Banten', 'Tangerang', 'Karang Tengah', 'Gedung Ctv Banten Jl Wanamulya No 7 Karang Mulya Kec Karang Tengah Kota Tangerang'),
(180, '045117', 2, 'Muchlisin', '', '62818914327', 'Y', 'Laki - Laki', 'T-Shirt', '2019-04-30', 'Banten', 'Serang', 'Anyar', 'Jln Raya Anyar Kp  Kepuh No:1 Rt/Rw:01/03 Toko Azil Jaya Depan Prapatan Pelabuhan Paku Anyar Serang-Banten, Kab  Serang, Anyar, Banten, Id, 42166'),
(181, 'fc2213', 2, 'Muchlisin', '', '62818914327', 'Y', 'Laki - Laki', 'T-Shirt', '2019-04-30', 'Jawa Barat', 'Cilegon', 'Cilegon', 'Muchlisin\nJln  Raya Anyer Kp Kepuh Rt/Rw:01/03 No:1 Toko Azil Jaya Depan Prapatan Paku Anyer Serang-Banten  42166'),
(182, '4c5bde', 2, 'GravinSb', '', '62818939348', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-06', 'Jawa Barat', 'Depok', 'Sukmajaya', 'Pesona Khayangan Blok El No  6/7 Margonda Raya Depok\nSukmajaya, Kota Depok, Jawa Barat 16411'),
(183, 'cedebb', 2, 'Widi Hartono', '', '62818941432', 'Y', 'Laki - Laki', 'T-Shirt', '2019-07-15', 'Jawa Barat', 'Bekasi', 'Bekasi Utara', 'Pesona Anggrek Harapan Blok B 14 No.14\nRt.006 Rw.027 Kel.Harapan Jaya Kec.Bekasi Utara\nJawa Barat'),
(184, '6cdd60', 2, 'Widi Hartono', '', '62818941432', 'Y', 'Laki - Laki', 'T-Shirt', '2019-07-15', 'Jawa Barat', 'Bekasi', 'Bekasi Utara', 'Pesona Anggrek Harapan Blok B 14 No 14 Rt 004 Rw 027 Kelurahan Harapan Jaya Kecamatan Bekasi Utara'),
(185, 'eecca5', 2, 'IieIskandarIdris', '', '62818956524', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-17', 'Banten', 'Tangerang', 'Cipondoh', 'Jl  Kh  Ahmad Dahlan Gg Kecapi Rt 007/01 No 24-25 Kel  Petir'),
(186, '9872ed', 2, 'Bagoes', '', '62818959689', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-07', 'Dki Jakarta', 'Jakarta Timur', 'Matraman', 'Jl  Pengayoman I No 98, Komp Kehakiman'),
(187, '31fefc', 2, 'Cencen', '', '62819873036', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-09', 'Sumatera Utara', 'Deli Serdang', 'Percut Sei Tuan', 'Kompleks Cemara Asri Jl Kasuari 68 L, Kab  Deli Serdang, Percut Sei Tuan, Sumatera Utara'),
(188, '9dcb88', 2, 'Zikri', '', '62822533665', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-10', 'Jambi', 'Tanjung Jabung Barat', 'Tebing Tinggi', 'Jln.Telkom Kecamatan Tebing Tinggi ,Id 36556 (Hp :0822533665 & 082181722682).'),
(189, 'a2557a', 2, 'DeZulian', '', '62857794578', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-28', 'Jawa Barat', 'Tasikmalaya', 'Singaparna', 'Jln Cikunir Depan Stikes Respati Tasikmalaya,Rumah Fotocopyan (Reva Copy )'),
(190, 'cfecdb', 2, 'Aldi', '', '62878788358', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-03', 'Dki Jakarta', 'Jakarta Selatan', 'Pasar Minggu', 'Ditempat'),
(191, '0aa188', 2, 'HudhanyOkyListiani', '', '62899195163', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-20', 'Jawa Tengah', 'Semarang', 'Gayamsari', 'Jl  Wisma Prasetya Iv Nomor 5, Perum Korpri Sambirejo,'),
(192, '58a2fc', 2, 'Yassir Hassan Albalushi', '', '622129603333', 'Y', 'Laki - Laki', 'T-Shirt', '2019-03-24', 'Dki Jakarta', 'Jakarta Pusat', 'Menteng', '(Sns) Jl.Blora No 16 Menteng \nMct 216744\nJakarta Pusat'),
(193, 'bd686f', 2, 'Kexin', '', '628108012875', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-28', 'Dki Jakarta', 'Jakarta Utara', 'Pademangan', 'Pademangan 3 Gg 33 No 24 Rt 010 Rw 02\nKota/Kabupaten : Pademangan\nKecamatan : Pademangan Timur'),
(194, 'a597e5', 2, 'Melliza Limansah', '', '628111000727', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-13', 'Dki Jakarta', 'Jakarta Utara', 'Penjaringan', 'Orchestra Beach 3 No  8, Golf Island, Pik\nKamal Muara, Pantai Indah Kapuk, 14460'),
(195, '0336dc', 2, 'Anol', '', '628111007999', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-01', 'Dki Jakarta', 'Jakarta Timur', 'Cakung', 'Jalan Jati No 25\nEramas 2000'),
(196, '084b6f', 2, 'Boyke', '', '628111018483', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-20', 'Dki Jakarta', 'Jakarta Selatan', 'Setia Budi', 'Bellagio Residence / Mall Tower A 20Af7 (Pak Boy) Mega Kuningan'),
(197, '85d8ce', 2, 'IkbalRizkyAfrizal', '', '628111031995', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-19', 'Jawa Barat', 'Purwakarta', 'Babakancikao', 'Kp Mekarsari Rt/Rw 003/002 Kel/Desa Ciwareng (Gg Rambutan, Dekat Mesjid Al-Barokah, Rumah Ibu Neneng S)'),
(198, '0e6597', 2, 'Romy', '', '628111036727', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-05', 'Dki Jakarta', 'Jakarta Barat', 'Cengkareng', 'Komplek Perumahan Casa Jardin, Jl. Daan Mogot Raya Km. 11. Cluster Gladiola, Blok G5 No. 25'),
(199, '84d9ee', 2, 'Abin', '', '628111040021', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-04', 'Banten', 'Tangerang Selatan', 'Ciputat Timur', 'Jalan Legoso Raya Gg  H  Koweng Kav 2 No 7\nCiputat Timur, Kota Tangerang Selatan 15419'),
(200, '3644a6', 2, 'DimasPrabowo', '', '628111040728', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-01', 'Jawa Barat', 'Bekasi', 'Mustika Jaya', 'Royal Park Residence, Cluster Europa, Blok C10/15, Kelurahan Padurenan'),
(201, '757b50', 2, 'Andreas', '', '628111045068', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-31', 'Dki Jakarta', 'Jakarta Utara', 'Penjaringan', 'Jl  Katamaran Indah 4 No 17, Pantai Indah Kapuk, 14470, Kamal Muara'),
(202, '854d6f', 2, 'Sharen Hendri', '', '628111049194', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-03', 'Dki Jakarta', 'Jakarta Utara', 'Penjaringan', 'Jalan V No 20.O (Teluk Gong Selatan 3) Rt 007/Rw 017 , Kota Jakarta Utara, Penjaringan, Dki Jakarta'),
(203, 'e2c0be', 2, 'DhimasYuniarso', '', '628111071976', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-03', 'Dki Jakarta', 'Jakarta Barat', 'Kebon Jeruk', 'Jalan Sasak Iii No 15F  Kelurahan Kelapa Dua, Kecamatan Kebon Jeruk  Jakarta Barat\nKebon Jeruk, Kota Administrasi Jakarta Barat, Dki Jakarta 11550'),
(204, '274ad4', 2, 'AntoniusDjojopranoto', '', '628111088547', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-28', 'Dki Jakarta', 'Jakarta Barat', 'Kembangan', 'Jl  Kembang Elok V Blok H6 No 26, Rt 8/Rw 6, Kembangan Sel , Kec  Kembangan, 11610'),
(205, 'eae27d', 2, 'AntoniusDjojopranoto', '', '628111088547', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-28', 'Dki Jakarta', 'Jakarta Barat', 'Kembangan', 'Jl  Kembang Elok V Blok H6 No 26, Rt 8/Rw 6, Kembangan Sel , Kec  Kembangan, 11610'),
(206, '7eabe3', 2, 'DonnyDunda', '', '628111089496', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-02', 'Jawa Timur', 'Jember', 'Sumber Sari', 'Perum Demang Mulia Blok D/10, Rt  2 Rw  6\nJl  Letjen Soeprapto Xviii, Kebonsari 68122'),
(207, '69adc1', 2, 'Muhammad Hafiz Arkana Harahap', '', '628111091907', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-24', 'Banten', 'Cilegon', 'Pulomerak', 'Jalan Yos Sudarso Komplek Ptk No 8, Rt 3/Rw 7, Lebak Gede, Pulomerak, Kota Cilegon, Pulomerak, Banten, Id, 42439'),
(208, '091d58', 2, 'Yerri M', '', '628111101635', 'Y', 'Laki - Laki', 'T-Shirt', '2020-11-19', 'Jawa Barat', 'Depok', 'Cilodong', 'Jl.Raya Kp. Sawah No.1 Rt 03 Rw 004 (Sebelah Komplek Puri Arsama) Kelurahan :Jatimulya , 16413'),
(209, 'b1d10e', 2, 'Yerri M', '', '628111101635', 'Y', 'Laki - Laki', 'T-Shirt', '2020-11-19', 'Jawa Barat', 'Depok', 'Cilodong', 'Jl.Raya Kp. Sawah No.1 Rt 03 Rw 004 (Sebelah Komplek Puri Arsama) Jatimulya,16413'),
(210, '6f3ef7', 2, 'Raditta Pondok Betung', '', '628111110997', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-10', 'Banten', 'Tangerang Selatan', 'Pondok Aren', 'Jalan Mesjid Al-Abror, Nomer 4. Rumah Tembok Batu Bata & Pager Tinggi Warna Hitam., Kota Tangerang Selatan, Pondok Aren, Banten'),
(211, 'eb1637', 2, 'DedeIlmawan', '', '628111112249', 'Y', 'Laki - Laki', 'T-Shirt', '2020-04-09', 'Jawa Barat', 'Sukabumi', 'Pelabuhanratu', 'Jalan Siliwangi, No  62, Rt 03/ Rw 17 (Toko Sinar Agung Kosmetik)\nKode Pos 43364'),
(212, '1534b7', 2, 'DedeIlmawan', '', '628111112249', 'Y', 'Laki - Laki', 'T-Shirt', '2020-04-09', 'Jawa Barat', 'Sukabumi', 'Pelabuhanratu', 'Jl Siliwangi No 62 Toko Sinar Agung 97 Kosmetik  Rt 3/17'),
(213, '979d47', 2, 'HiltonWinoto', '', '628111129938', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-11', 'Dki Jakarta', 'Jakarta Barat', 'Tambora', 'Krendang Timur No 8 Rt9 Rw2, Dki Jakarta 11260'),
(214, 'ca46c1', 2, 'Sandy Fazrianto', '', '628111173536', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-29', 'Dki Jakarta', 'Jakarta Timur', 'Matraman', 'Jl. Utan Kayu Raya No.40\nRt.5/Rw.5, Utan Kayu Utara, \nKec. Matraman, Kota Jakarta Timur, \nDaerah Khusus Ibukota Jakarta \n13120'),
(215, '3b8a61', 2, 'Sakti Pratomo', '', '628111180218', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-02', 'Jawa Barat', 'Depok', 'Tapos', 'Perum The Address,Cluster Deluxe Blok G ,No.82, Rt01/Rw03, Kel. Leuwinanggung, 16454.'),
(216, '45fbc6', 2, 'Sakti Pratomo Siswoyo', '', '628111180218', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-02', 'Jawa Barat', 'Depok', 'Tapos', 'Perum The Address,Cluster Deluxe Blok G ,No.82, Rt01/Rw03, Kel. Leuwinanggung, 16454.'),
(217, '63dc7e', 2, 'AdeJohanes', '', '628111191170', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-21', 'Jawa Barat', 'Bogor', 'Bogor Utara - Kota', 'Perumahan Ciluar Asri Jln Bukit Permatasari Blok A1\nNo B1 Kelurahan Ciluar Kecamatan Bogor Utara,\nBogor Utara - Kota, Kota Bogor, Jawa\nBarat'),
(218, 'e96ed4', 2, 'FuscaFawwaza', '', '628111199628', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-16', 'Dki Jakarta', 'Jakarta Selatan', 'Cilandak', 'Jl  Swakarya Blok C No 4, Pd  Labu, Cilandak Kota Jakarta Selatan 12450'),
(219, 'c0e190', 2, 'Yongki Ardinata', '', '628111205263', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-07', 'Sumatera Selatan', 'Palembang', 'Sako', 'Jl Sematang Borang Perum Berlian Residen Blok B 23 Kel. Sako Kec. Sako Palembang Sum-Sel (Di Seberang Indomaret Sematang Borang Dalam)');
INSERT INTO `tb_customer` (`cust_id`, `cust_uid`, `cust_cust_batch_id`, `cust_name`, `cust_email`, `cust_phone`, `cust_status`, `cust_gender`, `cust_product_batch`, `cust_date_order`, `cust_prov`, `cust_city`, `cust_district`, `cust_address_full`) VALUES
(220, 'ec8ce6', 2, 'AdenSuryadi', '', '628111226059', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-22', 'Banten', 'Serang', 'Anyar', 'Komp  Bumi Agung Permai  I\nBlok N 9 No  6 Rt 08/12\nAnyar - Kota Serang 42111\nBanten'),
(221, '060ad9', 2, 'Richo Mampouw', '', '628111238686', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-21', 'Jawa Timur', 'Surabaya', 'Gayungan', 'Amg Tower, Pt Sinergi Tridaya Medical Lt.8 Blok 01-A,Jalan Dukuh Menanggal, Gayungan, Surabaya, Jawa Timur'),
(222, 'bcbe33', 2, 'Honey', '', '628111288093', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-13', 'Dki Jakarta', 'Jakarta Barat', 'Palmerah', 'Jl  Mangga No 21 , Tomang Asli, Tomang  Jakarta Barat, Kota Jakarta Barat, Palmerah, Dki Jakarta'),
(223, '115f89', 2, 'Renny Roxiany', '', '628111288776', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-14', 'Dki Jakarta', 'Jakarta Utara', 'Cilincing', 'Perumahan Green Garden Blok A2 No 22 Rorotan Cilincing Jakarta Utara 14140 , Kota Jakarta Utara, Cilincing, Dki Jakarta, Id, 14140'),
(224, '13fe9d', 2, 'HarrisPrayogo', '', '628111314225', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-23', 'Dki Jakarta', 'Jakarta Timur', 'Ciracas', 'Komplek Hankam Cibubur No A30  Jl  Rambutan Rt 7/Rw 3 Kel Kelapa Dua Wetan  Kode Pos : 13730'),
(225, 'd1c38a', 2, 'AkhmadZulfikri', '', '628111335135', 'Y', 'Laki - Laki', 'T-Shirt', '2020-10-19', 'Dki Jakarta', 'Jakarta Selatan', 'Tebet', 'Grha Inna  Jl  Prof  Dr  Soepomo Blok A No 8, Rt 1/Rw 6, Tebet Barat , Kec  Tebet, Kota Jakarta Selatan,\n Daerah Khusus Ibukota Jakarta 12810'),
(226, '9cfdf1', 2, 'AkhmadZulfikri', '', '628111335135', 'Y', 'Laki - Laki', 'T-Shirt', '2020-10-19', 'Dki Jakarta', 'Jakarta Selatan', 'Tebet', 'Grha Inna  Jl  Prof  Dr  Soepomo Blok A No 8, Rt 1/Rw 6, Tebet Bar'),
(227, '705f21', 2, 'ApriSupriyatno', '', '628111338234', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-07', 'Jawa Barat', 'Cianjur', 'Cibinong', 'Grand Cibinong Indah, Jl  Pajeleran No  07, Kelurahan Sukahati'),
(228, '74db12', 2, 'Suhendi', '', '628111347405', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-02', 'Dki Jakarta', 'Jakarta Utara', 'Penjaringan', 'Jln Sili Raya Blok P2 No 10 Teluk Gong Jakarta Utara, 14450'),
(229, '57aeee', 2, 'HendrikSilitonga', '', '628111381210', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-07', 'Dki Jakarta', 'Jakarta Timur', 'Pasar Rebo', 'Jalan Lapan No  27 Rt 10 Rw 01 Pekayon'),
(230, '6da900', 2, 'Vincent', '', '628111441114', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-09', 'Banten', 'Tangerang Selatan', 'Serpong Utara', 'Brooklyn Alam Sutera, Soho & Apartment Unit B/9/S\nJl. Sutera Boulevard, Pakualam, Serpong Utara Banten 15320'),
(231, '9b04d1', 2, 'Miranti Widjoko', '', '628111460537', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-16', 'Dki Jakarta', 'Jakarta Selatan', 'Mampang Prapatan', 'Jl  Bangka Vii No  7B Baru Pela Mampang Mampang Prapatan Jakarta Selatan Dki Jakarta 12720'),
(232, 'be83ab', 2, 'BudiSukandi', '', '628111505708', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-21', 'Banten', 'Tangerang', 'Pagedangan', 'Perumahan De Park Cluster De Maja\nBlok E1 No 3 , Pagedangan, Kab \nTangerang, Banten 15330'),
(233, 'e16542', 2, 'Rosnelly', '', '628111516103', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-17', 'Dki Jakarta', 'Jakarta Utara', 'Cilincing', 'Jl Tipar Cakung Gg Swadaya Rt 004 Rw 02 No 12, Kota Jakarta Utara, Cilincing, Dki Jakarta, Id, 14140'),
(234, '289dff', 2, 'Slamet Riyadi', '', '628111545123', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-07', 'Dki Jakarta', 'Jakarta Barat', 'Tambora', 'Jl. Duri Selatan Viii No.9 Rt.08 Rw.06 Tambora - Jakarta Barat 11270 \nNote: Masuk Dari Gang Bakso Yadi ,Rumah Disebelah Gejera Bethel.'),
(235, '577ef1', 2, 'HironimusHilapok', '', '628111559595', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-25', 'Banten', 'Tangerang Selatan', 'Ciputat Timur', '(Hubungi No Wa) \nJln Cherry No 37H Komp  Pu Mabad\nRt/Rw 01/04\nKelurahan Rengas'),
(236, '01161a', 2, 'KatherineHidajat', '', '628111590333', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-14', 'Dki Jakarta', 'Jakarta Selatan', 'Setia Budi', 'Jalan Y B R  I No 62, Rt 1/Rw 2, Kuningan Timur, Setia Budi , Kota Jakarta Selatan, Setia Budi, Dki Jakarta'),
(237, '539fd5', 2, 'Mohamad Aldi', '', '628111612525', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-28', 'Dki Jakarta', 'Jakarta Selatan', 'Jagakarsa', 'No  18 A, Pgr Kayu Rumah Kembar 3, Patokan : Sdn 17 Pagi, Jl Cipedak, Rt/Rw : 007/09, Kel : Srengseng Sawah'),
(238, 'ac1dd2', 2, 'Sultan Saladyne Tama', '', '628111680407', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-21', 'Jawa Barat', 'Cibubur', 'Cibubur', 'Cluster Einstein Blok R1 No 3\nLegenda Wisata\nKecamatan Gunung Putri\nKel Wanaherang\nKab Bogor 16965'),
(239, '555d67', 2, 'Muhammad Arfi Raya', '', '628111681848', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-05', 'Dki Jakarta', 'Jakarta Timur', 'Jatinegara', 'Cipinang Elok 2 Blok Ak No 12'),
(240, '335f53', 2, 'JeremyJodi', '', '628111716168', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-14', 'Dki Jakarta', 'Jakarta Utara', 'Kelapa Gading', 'Jalan Kelapa Nias Xii Blok Pd No 12, Kelapa Gading Barat, Kelapa Gading (Blok Pe 6 No 15)'),
(241, 'f340f1', 2, 'Merry Charlene', '', '628111720200', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-22', 'Banten', 'Tangerang', 'Batuceper', 'Batu Ceper Permai Blok D No 13\n15122'),
(242, 'e4a622', 2, 'Wahyu Tri Ningsih', '', '628111778780', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-28', 'Jawa Barat', 'Bekasi', 'Bekasi Selatan', 'Cisadane 3 No 17 Cibodas Lippo Cikarang Bekasi\nKode Pos 17550'),
(243, 'cb70ab', 2, 'Desty', '', '628111819508', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-28', 'Dki Jakarta', 'Jakarta Barat', 'Kalideres', 'Citra Garden 5 Blok E3 No 3A, Pegadungan, Kalideres, Kota Jakarta Barat, Kalideres, Dki Jakarta, Id, 11830'),
(244, '918890', 2, 'DrIGedeKota', '', '628111846810', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-12', 'Jawa Barat', 'Bekasi', 'Bekasi Selatan', 'Green Park Residence Jln  Cotton Wood I No 16, Jati Melati, Pondok Melati, Bekasi - Jawa Barat'),
(245, '0266e3', 2, 'JenniferChristina', '', '628111859667', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-03', 'Banten', 'Tangerang', 'Cibodas', 'Jl Sumbawa Town House Taman Ayu 2 No 295 Lippo Karawaci Utara, Kota Tangerang, Cibodas, Banten'),
(246, '38db3a', 2, 'BillyKurniawan', '', '628111860081', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-08', 'Jawa Barat', 'Bandung', 'Regol', 'Jalan Kembar Tengah No 7 Deket Toko Ubad, Kota Bandung, Regol, Jawa Barat, Id, 40253'),
(247, '3cec07', 2, 'Agung', '', '628111874764', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-19', 'Dki Jakarta', 'Jakarta Selatan', 'Pesanggrahan', 'Bumi Bintaro Permai, Jalan Bintaro Melati I Blok H/17\nPesanggrahan, Kota Administrasi Jakarta Selatan, Dki Jakarta 12330'),
(248, '621bf6', 2, 'Laode', '', '628111875025', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-01', 'Dki Jakarta', 'Jakarta Barat', 'Kembangan', 'Madja Residence @ Puri, Blok F1 Jalan H  Saaba, Kec  Kembangan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta, 11640'),
(249, '077e29', 2, 'FajarAnggoroKasih', '', '628111885889', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-07', 'Dki Jakarta', 'Jakarta Utara', 'Kelapa Gading', 'Bank Bri Cabang Kelapa Gading, Jl  Boulevard\nBarat Blok Lc 6 Kav  No  69-70 Kelapa Gading,\nKelapa Gading, Kota Jakarta Utara, Dki\nJakarta'),
(250, '6c9882', 2, 'AffanZulfikar', '', '628111898956', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-14', 'Jawa Barat', 'Depok', 'Tapos', 'Perumahan The Address Cluster Deluxe Blok F27, Jawa Barat 16456'),
(251, '19f3cd', 2, 'Ony Jamhari', '', '628111909072', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-15', 'Jawa Barat', 'Bogor', 'Ciomas', 'Kebun Raya Residence Blok E No 2 Pasir Kuda Bogor 16119'),
(252, '03c6b0', 2, 'Hermawan', '', '628111913128', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-15', 'Dki Jakarta', 'Jakarta Barat', 'Cengkareng', 'Pt Ardeco Karya Global\nJl  Kopaja No 28 Z, Rt 07/Rw 04, Rawa Buaya, Kecamatan Cengkareng, Kota Jakarta Barat  11740'),
(253, 'c24cd7', 2, 'Sandi Purwanto', '', '628111926200', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-31', 'Jawa Barat', 'Depok', 'Sukmajaya', 'Perumahan Panorama Hijau,  Blok E/4. Jl. Kemang 1 Rt.06/Rw.10, Sukmajaya, Depok-16412'),
(254, 'c52f1b', 2, 'Michiko Ebihara', '', '628111926294', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-22', 'Dki Jakarta', 'Jakarta Utara', 'Kelapa Gading', 'Jl  Pelepah Indah 1 Blok Lb 2 No 12A Kelapa Gading 14240'),
(255, 'fe131d', 2, 'AvieMilkha', '', '628111967908', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-29', 'Dki Jakarta', 'Jakarta Selatan', 'Tebet', 'Jl Tebet Barat Dalam Viiik No 11'),
(256, 'f71849', 2, 'Albert', '', '628111977751', 'Y', 'Laki - Laki', 'T-Shirt', '2019-10-02', 'Jawa Barat', 'Depok', 'Cimanggis', 'Gg Binangkit Rt 02/01 No 63 Kelurahan Curug, Kecamatan Cimanggis, Kota Depok'),
(257, 'd96409', 2, 'Cellin', '', '628111977751', 'Y', 'Laki - Laki', 'T-Shirt', '2019-10-02', 'Jawa Barat', 'Depok', 'Cimanggis', 'Gg Binangkit Rt02/01 No 63'),
(258, '502e4a', 2, 'AndrianSetiabakti', '', '628111988140', 'Y', 'Laki - Laki', 'T-Shirt', '2020-11-02', 'Dki Jakarta', 'Jakarta Pusat', 'Menteng', 'Menteng Park Apartment, Tower Diamond, 29O'),
(259, 'cfa086', 2, 'AndrianSetiabakti', '', '628111988140', 'Y', 'Laki - Laki', 'T-Shirt', '2020-11-02', 'Dki Jakarta', 'Jakarta Pusat', 'Senen', 'Capitol Park Residence, Jl  Salemba Raya No 16  Tower Safir, Unit 0328 A N  Andrian'),
(260, 'a4f236', 2, 'Deden', '', '628111994906', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-28', 'Dki Jakarta', 'Jakarta Timur', 'Ciracas', ':Jln H Baping Gg Tk/ Masjid Faturrahman Rt 04/Rw 09 No 28\nKecamatan : Ciracas\nKota : Jakarta Timur'),
(261, 'b1a59b', 2, 'Rama', '', '628112000143', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-01', 'Sumatera Barat', 'Padang', 'Nanggalo', 'Belakang Kejaksaan Negri Padang, Rumah No.42J Warna Biru, Kp. Olo, Nanggalo Kota Padang 25143'),
(262, '36660e', 2, 'D-IwanKartiwa', '', '628112000149', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-02', 'Jawa Barat', 'Sumedang', 'Ganeas', 'Dsn  Ganeas No 1 Rt 01/05 Desa Ganeas Kecamatan Ganeas Kab Sumedang'),
(263, '8c19f5', 2, 'Pidi', '', '628112001013', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-06', 'Jawa Barat', 'Bandung Barat', 'Padalarang', 'Kantor Bpn Kbb  Jl  Raya Padalarang Ciburuy No  344 Padalarang Kab Bandung Barat, Kab  Bandung Barat, Padalarang, 40553'),
(264, 'd6baf6', 2, 'CutSean', '', '628112002438', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-26', 'Jawa Barat', 'Bandung', 'Arcamanik', 'Komplek Kamayangan Blok B1 12, Kota Bandung, Arcamanik, Jawa Barat'),
(265, 'e56954', 2, 'Muhamad Bayu Saputra', '', '628112011100', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-28', 'Dki Jakarta', 'Jakarta Timur', 'Pasar Rebo', 'Jalan Intisari Raya Gang H  Bambang No 102 Rt 001 Rw  09 Kelurahan Kalisari\nPasar Rebo, Kota Administrasi Jakarta Timur, Dki Jakarta 13790'),
(266, 'f76640', 2, 'Recky Victor Wefa', '', '628112015222', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-22', 'Sumatera Barat', 'Padang', 'Kuranji', 'Jl. Kampung Baru Kelawi No 38 G'),
(267, 'eda80a', 2, 'Kenzo', '', '628112030809', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-26', 'Jawa Timur', 'Surabaya', 'Surabaya', 'Galaksi Bumi Permai L1 No 22, Surabaya'),
(268, '8f121c', 2, 'DzakirahNasywa', '', '628112181908', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-15', 'Kepulauan Riau', 'Batam', 'Batu Ampar', 'Jl Yossudarso\nRumah Pak Dandim\nKelurahan : Seraya Atas'),
(269, '06138b', 2, 'AnitaLukman', '', '628112188172', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-01', 'Jawa Barat', 'Bandung', 'Bandung Wetan', 'Jalan Gajah Lumantung 5, Taman Sari Bandung 40116\nBandung Wetan, Kota Bandung, Jawa Barat 40116'),
(270, '390597', 2, 'Sigit Dwi Nugroho', '', '628112188944', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-25', 'Jawa Barat', 'Bandung', 'Margaasih', 'Komplek Bumi Asri Mekar Rahayu Blok Ii/B7, Margaasih, Kab. Bandung.'),
(271, '7f100b', 2, 'Maryanto', '', '628112215712', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-24', 'Jawa Barat', 'Bandung Barat', 'Padalarang', 'Jl Pita Agung No 18 Tatar Pitaloka Kotabaru Parahyangan Kec Padalarang'),
(272, '7a614f', 2, 'Yosep Deni Cahyadi', '', '628112231975', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-11', 'Jawa Barat', 'Tasikmalaya', 'Tawang', 'Rsud Dr. Soekardjo-Bag.Pengadaan Obat\nJl. Rumah Sakit No.33-Kec.Tawang \nTasikmalaya 46113'),
(273, '4734ba', 2, 'William Hernando', '', '628112311778', 'Y', 'Laki - Laki', 'T-Shirt', '2020-02-06', 'Jawa Barat', 'Bandung', 'Bandung Kulon', 'Jln Melong Asih No.64 (Bengkel Motor ? Erfive Motorshop? Seberang Indomaret), Kota Bandung, Bandung Kulon, Jawa Barat 40213'),
(274, 'd947bf', 2, 'William Hernando', '', '628112311778', 'Y', 'Laki - Laki', 'T-Shirt', '2020-02-06', 'Jawa Barat', 'Bandung', 'Bandung Kulon', 'Jln Melong Asih No 64 Bengkel Erfive Motorshop , Kec : Bandung Kulon , Kel : Cijerah , Bandung'),
(275, '63923f', 2, 'R Tati Kurniawati', '', '628112315087', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-30', 'Jawa Barat', 'Bandung', 'Rancaekek', 'Bumi Abdi Negara Blok D3 No 20 Rt 01 Rw 13 Desa Rancaekek Wetan (40394)'),
(276, 'db8e1a', 2, 'DedenRiyanto', '', '628112327770', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-15', 'Jawa Barat', 'Indramayu', 'Tukdana', 'Blok Sarag Rt 020/ Rw 005 Desa Gadel , Kecamatan Tukdana, Kabupaten Indramayu'),
(277, '20f075', 2, 'Muh  Salim', '', '628112333931', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-16', 'Jawa Barat', 'Bandung', 'Kutawaringin', 'Rusunawa Jatisari Gedung 4 Lantai 3 No 16, Jl Soreang Cipatik'),
(278, '07cdfd', 2, 'Muhammad Salim', '', '628112333931', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-16', 'Dki Jakarta', 'Jakarta Utara', 'Kelapa Gading', 'Alamanda Tower, Jalan Gading Nias Pegangsaan Dua, Kelapa Gading'),
(279, 'd39577', 2, 'IrfanSeptianStaffTataUsaha', '', '628112351235', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-10', 'Jawa Barat', 'Bekasi', 'Bekasi Timur', 'Lapas Kelas Iia Bekasi Jl  Pahlawan No 1 Bulak Kapal Aren Jaya, Bekasi Timur Kota Bekasi 17111'),
(280, '92c8c9', 2, 'ApihUtay', '', '628112393387', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-04', 'Jawa Barat', 'Cianjur', 'Cidaun', 'Kp Puncak Kukun(Puncak Wangi) Rt/Rw 01/02 Desa Karangwangi Kec Cidaun-Cianjur , Kab  Cianjur, Cidaun, Jawa Barat, Id, 4327'),
(281, 'e3796a', 2, 'Purnama', '', '628112399111', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-10', 'Jawa Barat', 'Bandung', 'Sukajadi', 'Ruko Tsi - Jl Sukamulya No 44A Pasteur Kecamatan Sukajadi. Kota Bandung'),
(282, '6a9aed', 2, 'Muhammad Arif Bin Najmudin', '', '628112444117', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-19', 'Jawa Barat', 'Indramayu', 'Lohbener', 'Ds  Langut Blok Tajug Gede, Rt/Rw 10/02'),
(283, '0f49c8', 2, 'Veri Setiadi', '', '628112518420', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-27', 'Jawa Tengah', 'Banyumas', 'Purwokerto', 'Jl.Swadaya Raya, Ds. Kecila Rt 1 Rw 7 \nKec. Kemranjen 53194'),
(284, '46ba9f', 2, 'AhmadAminMustofa', '', '628112530931', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-25', 'Jawa Tengah', 'Kebumen', 'Kebumen', 'Balai Desa Adikarso Kecamatan Kebumen Kabupaten Kebumen'),
(285, '0e0193', 2, 'DanangIndrayana', '', '628112632705', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-26', 'Jawa Tengah', 'Sukoharjo', 'Grogol', 'Pt  Nagabhuana Anekapiranti Unit 1\nJalan Industri I No 88\nDukuh Kutuh\nDesa Telukan\nKecamatan Grogol\nKabupaten Sukoharjo\nJawa Tengah'),
(286, '16a5cd', 2, 'FahmiR', '', '628112650906', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-22', 'Di Yogyakarta', 'Sleman', 'Ngaglik', 'Perum Kaliurang Pratama E5, Jl Kaliurang Km 7,3'),
(287, '918317', 2, 'GaluhMieke', '', '628112651794', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-07', 'Dki Jakarta', 'Jakarta Pusat', 'Senen', 'Capitol Park Residence (Tower Sapphire / U-11-12) Jl  Salemba Raya No  16, Kenari, Kota Jakarta Pusat, Senen, Dki Jakarta, Id, 10430'),
(288, '48aedb', 2, 'BimaGaharaPutra', '', '628112728060', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-04', 'Jawa Tengah', 'Semarang', 'Banyumanik', 'Jl  Tanjung Sari Iv / No 7 Rt 07 Rw 02, Sumurboto, Banyumanik, Semarang, Id 50269'),
(289, '839ab4', 2, 'Dypar', '', '628112747764', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-30', 'Bali', 'Denpasar', 'Denpasar Timur', 'Jl  Gatot Subroto Timur No 900 (Ruko Ayam Dadar Bandung)- Denpasar, Bali'),
(290, 'f90f2a', 2, 'IvanaAdelia', '', '628112772273', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-10', 'Jawa Tengah', 'Temanggung', 'Temanggung', 'Perumahan Dua Sekawan Jaya ( Jl Suyoto 31-32 Temanggung )\nTemanggung, Kab  Temanggung, Jawa Tengah 56216'),
(291, '9c838d', 2, 'DrSlametYulianto', '', '628112802400', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-07', 'Jawa Tengah', 'Cilacap', 'Cilacap Selatan', 'Gading Cluster Blok D-150 Perum Taman Gading, Tegalkamulyan, Cilacap Selatan, Cilacap'),
(292, '170000', 2, 'Nicholas Diporedjo', '', '628112819989', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-11', 'Jawa Tengah', 'Purwokerto', 'Purwokerto Utara', 'Perumahan Permata Hijau Blok 7 No 24, Purwokerto Utara'),
(293, '53c3bc', 2, 'CalvinYusufPrimaditya', '', '628112820197', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-06', 'Jawa Barat', 'Cikarang', 'Tambun Selatan', 'Pondok Timur Indah Jl  Anoa Iii No 78 Jatimulya, Tambun Selatan, Bekasi Timur'),
(294, '688396', 2, 'GabrielNicolas', '', '628112882283', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-29', 'Jawa Tengah', 'Kudus', 'Kudus Kota', 'Pt Bank Sinarmas\nJl  Jenderal Sudirman No  6\nKudus'),
(295, '49182f', 2, 'AugustoSantos', '', '628113048896', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-27', 'Jawa Timur', 'Surabaya', 'Sukolilo', 'Graha Sarjana Kost Ii \nJl  Keputih Tegal Bakti Ii Nomor 5 Blok H Keputih\nCity Home Regency'),
(296, 'd296c1', 2, 'Elho', '', '628113050830', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-03', 'Jawa Timur', 'Surabaya', 'Pabean Cantikan', 'Jl  Pengampon Gang Ll No  23 \nBongkaran'),
(297, '9fd818', 2, 'ChrisWijaya', '', '628113057777', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-26', 'Dki Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', 'Alexandrei I Blok J2 No  15, Permata Hijau, Jakarta Selatan 12210'),
(298, '26e359', 2, 'IlhamAkhsanuRidlo', '', '628113093333', 'Y', 'Laki - Laki', 'T-Shirt', '2020-09-25', 'Jawa Timur', 'Surabaya', 'Rungkut', 'Green Semanggi Mangrove A-05 Cluster Osbornia Wonorejo Rungkut Surabaya 60296, No Hp 08113093333'),
(299, 'ef0d39', 2, 'IlhamAkhsanuRidlo', '', '628113093333', 'Y', 'Laki - Laki', 'T-Shirt', '2020-09-25', 'Jawa Timur', 'Surabaya', 'Rungkut', 'Ilham Akhsanu Ridlo\nGreen Semanggi Mangrove A-05 Cluster Osbornia, Wonorejo Rungkut'),
(300, '94f6d7', 2, 'LucyaneSuseno', '', '628113100288', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-13', 'Jawa Timur', 'Madiun', 'Sawahan', 'Banyu Urip Lor Iii B No 10'),
(301, '34ed06', 2, 'Novan Wibisono', '', '628113227999', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-28', 'Jawa Timur', 'Surabaya', 'Rungkut', 'Wisma Pt Sier  Jln Raya Rungkut Industri 10 Surabaya Lt 5 Divisi Umum & Pengadaan A/N  Novan Wibisono Kode Pos 60293'),
(302, '577bcc', 2, 'Novan Wibisono', '', '628113227999', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-28', 'Jawa Timur', 'Surabaya', 'Rungkut', 'Wisma Pt Sier   Jln Raya Rungkut Industri 10 Surabaya Lt 5 Divisi Umum & Pengadaan A/N  Novan Wibisono Kode Pos 60293'),
(303, '11b984', 2, 'Anggoro', '', '628113291882', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-04', 'Jawa Timur', 'Surabaya', 'Gununganyar', 'Rungkut Mapan Timur 9/Eh 02 Surabaya 60293 Gununganyar, Kota Surabaya, Jawa Timur 60294'),
(304, '37bc2f', 2, 'Wilbert Owen Sugianto', '', '628113357111', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-10', 'Jawa Timur', 'Surabaya', 'Sukolilo', 'Jln. Manyar Kertoadi X - Blok W / 421 (Dekat Kumon) \nKode Pos : 60117'),
(305, '496e05', 2, 'Nimisius Widodo', '', '628113400823', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-05', 'Jawa Timur', 'Surabaya', 'Mulyorejo', 'Kalijudan Taruna V No 27A Rt03 Rw 05 Kel Kalijudan \nKodepos 60114 Surabaya'),
(306, 'b2eb73', 2, 'ErrykWijaya', '', '628113441983', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-12', 'Jawa Timur', 'Sidoarjo', 'Candi', 'Perum Citra Amanda Garden Blok T 2180'),
(307, '8e98d8', 2, 'AnggaArya', '', '628113441986', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-08', 'Jawa Timur', 'Pamekasan', 'Waru', 'Merpati Ii No 1 Rewwin Waru Sidoarjo, Kab  Sidoarjo, Waru, Jawa Timur, Id, 61256'),
(308, 'a8c88a', 2, 'Sandi Hendra Perdana', '', '628113458898', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-23', 'Jawa Timur', 'Lumajang', 'Sukodono', 'Safira Stone Resort C2 No. 10\nMasangan Wetan'),
(309, 'eddea8', 2, 'Naufal Gatra', '', '628113522795', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-26', 'Jawa Timur', 'Surabaya', 'Wiyung', 'De Alamuda Residence Blok B-6, Wiyung, Surabaya Jawa Timur 60222'),
(310, '06eb61', 2, 'Yossy', '', '628113593939', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-12', 'Jawa Timur', 'Kediri', 'Mojoroto', 'Jalan Botolengket, Rt.1/Rw.5, Bujel, Mojoroto (Nomor 66B), Kota Kediri, Mojoroto, Jawa Timur, Id, 64111'),
(311, '9dfcd5', 2, 'DimasFauzi', '', '628113666959', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-19', 'Dki Jakarta', 'Jakarta Timur', 'Duren Sawit', 'Komplek Pu P4S No  B-15 Pondok Bambu Jakarta Timur 13430'),
(312, '950a41', 2, 'Ishak', '', '628113704459', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-04', 'Jawa Timur', 'Surabaya', 'Tambaksari', 'Jl  Ploso Bogen No 26G, Tambaksari, Surabaya, 60136'),
(313, '158f30', 2, 'Krisdian', '', '628113807888', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-30', 'Bali', 'Denpasar', 'Denpasar Timur', 'Jl  Soka No 77, Kec  Denpasar Timur, Kota Denpasar, Bali 80237'),
(314, '758874', 2, 'Rex Ardellius', '', '628113808668', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-18', 'Bali', 'Denpasar', 'Denpasar Selatan', 'Jalan Tukad Balian Perumahan Bale Garden No.11, Renon Denpasar Selatan 80227'),
(315, 'ad13a2', 2, 'AgusAran', '', '628113838717', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-18', 'Dki Jakarta', 'Jakarta Barat', 'Kembangan', 'Jl  Delima 2, No 23 \nPerumahan Btn Kembangan Utara \nJakarta Barat'),
(316, '3fe94a', 2, 'Khakim', '', '628113851922', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-01', 'Bali', 'Badung', 'Kuta Utara', 'Pt  Canggu Internasional Jl  Pantai Batu Bolong / Jl  Pantai Munduk Catu, Desa Canggu (Proyek)'),
(317, '5b8add', 2, 'Andre', '', '628113977739', 'Y', 'Laki - Laki', 'T-Shirt', '2019-09-08', 'Bali', 'Badung', 'Kuta', 'Jl Sriwijaya Gg Darma Kerti No 12'),
(318, '432aca', 2, 'Andrianto', '', '628113977739', 'Y', 'Laki - Laki', 'T-Shirt', '2019-09-08', 'Dki Jakarta', 'Jakarta Selatan', 'Pasar Minggu', 'Jl  Gotong Royong I No 29B, Rw 2, Ragunan, Kec  Ps  Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12550'),
(319, '8d3bba', 2, 'Dharmanta', '', '628113991788', 'Y', 'Laki - Laki', 'T-Shirt', '2020-05-16', 'Bali', 'Denpasar', 'Denpasar Timur', 'Jl  Jayagiri Xxvi No  7X (Mentok Belok Kanan)\nDesa Sumerta Kauh\n(Hubungi No Wa)'),
(320, '320722', 2, 'Dharmanta', '', '628113991788', 'Y', 'Laki - Laki', 'T-Shirt', '2020-05-16', 'Bali', 'Badung', 'Kuta Utara', 'Bpr Kas Indonesia, Jl  Gatot Subroto Barat No  8X'),
(321, 'caf1a3', 2, 'IPutuSuiyana', '', '628114036312', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-16', 'Sulawesi Tenggara', 'Kendari', 'Kambu', 'Btn Unhalu Perdos Blok J No 1 Kel Kambu Kec Kambu Kota Kendari Sulawesi Tenggara'),
(322, '5737c6', 2, 'AswinSyafiuddin', '', '628114082448', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-20', 'Sulawesi Tenggara', 'Buton Utara', 'Kulisusu (Kalingsusu/Kalisusu)', 'Jalan Murhum Kulisusu,Kelurahan Bangkudu Kecamatan Kulisusu (Radio Galaksi,Depan Atm Bank Sultra Bangkudu)'),
(323, 'bc6dc4', 2, 'Rahmat Yunus', '', '628114091479', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-13', 'Sulawesi Tenggara', 'Kendari', 'Puuwatu', 'Jl. R. Soeprapto Lr. Salemba No. 100 Kel. Punggolaka Kec. Puuwatu Kota Kendari Sultra, Kota Kendari, Puuwatu, Sulawesi Tenggara, Id, 93115'),
(324, 'f2fc99', 2, 'ErwinHaeruddn', '', '628114110802', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-29', 'Sulawesi Selatan', 'Makassar', 'Tamalanrea', 'Perum Btp Blok M No  1; Jl  Tamalanrea Selatan Iia (Pt Almira Lintang Pratama)'),
(325, '89f0fd', 2, 'Yakob Tandiayu', '', '628114118334', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-24', 'Sulawesi Selatan', 'Luwu Timur', 'Towuti', '(Hubungi No Wa) \nJl.Gunung Wawomeusa No.30 \nRt/Rw : 009\nDesa Wawondula'),
(326, 'a66658', 2, 'Edy', '', '628114119058', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-22', 'Banten', 'Tangerang Selatan', 'Ciputat', 'Harvest Bintaro Residence Kav C-21 Jl  Merpati Raya Rt 002 / Rw 003 Kecamatan Ciputat Kelurahan Sawah Baru Ciputat 15413'),
(327, 'b83aac', 2, 'Edy', '', '628114119058', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-22', 'Banten', 'Tangerang Selatan', 'Ciputat', 'Harvest Bintaro Residence Kav C-21\nJl  Merpati Raya\nRt 002 / Rw 003\nKecamatan Ciputat\nKelurahan Sawah Baru\nCiputat 15413'),
(328, 'cd0069', 2, 'Muhammad Taufiq', '', '628114158892', 'Y', 'Laki - Laki', 'T-Shirt', '2020-01-19', 'Sulawesi Selatan', 'Soppeng', 'Mario Riawa', 'Toko Teruna\nJalan Veteran No  15 Panincong Kec  Marioriawa Kab  Soppeng Sulsel 90852'),
(329, '6faa80', 2, 'Muhammad Taufiq S', '', '628114158892', 'Y', 'Laki - Laki', 'T-Shirt', '2020-01-19', 'Sulawesi Selatan', 'Soppeng', 'Mario Riawa', 'Jalan Veteran No  15 Panincong Kecamatan Marioriawa Kabupaten Soppeng Sul-Sel 90852'),
(330, 'fe73f6', 2, 'Puang Usman', '', '628114165627', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-27', 'Sulawesi Selatan', 'Wajo', 'Pitumpanua', 'Warkop Bbg Siwa (Depan Puskesmas) Jalan Poros Palopo-Makassar Kec. Pitumpanua Kab. Wajo Sulawesi Selatan 90992'),
(331, '6da37d', 2, 'Ronny Roring', '', '628114341248', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-27', 'Sulawesi Utara', 'Manado', 'Malalayang', 'Jln. Bethel Bahu Lingkungan 9 \nKecamatan : Malalayang, Manado'),
(332, 'c042f4', 2, 'Yulius P Tingginehe', '', '628114342000', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-17', 'Sulawesi Utara', 'Kepulauan Talaud', 'Melonguane', 'Gereja Ggp Batu Karang Sejati Melonguane Kompleks Pemda Kepulauan Talaud'),
(333, '310dcb', 2, 'Steven', '', '628114343600', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-08', 'Sulawesi Utara', 'Manado', 'Wanea', 'Teling Motor\nJl. 14 Februari No.68 Teling Atas\nManado - 95119'),
(334, '2f2b26', 2, 'FahmiEngelen', '', '628114344110', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-27', 'Dki Jakarta', 'Jakarta Timur', 'Cakung', 'Pergudangan Top Jaya Antariksa - Gudang 3, Jl  Raya Bekasi Km 26 Kelurahan Ujung Menteng'),
(335, 'f9b902', 2, 'Adnan', '', '628114409118', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-02', 'Sulawesi Selatan', 'Makassar', 'Mamajang', 'Jalan Baji Areng No  1 (Fotocopy Matrix) Kel  Baji Mappakasunggu, Kec  Mamajang, Makassar'),
(336, '685545', 2, 'Jefri', '', '628114444180', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-11', 'Sulawesi Selatan', 'Makassar', 'Mamajang', 'Jln  Kancil Tengah No 67'),
(337, '357a6f', 2, 'Juang', '', '628114500099', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-06', 'Sulawesi Tengah', 'Banggai', 'Luwuk', 'Kantor Bank Bni Cabang Luwuk Jl Ahmad Yani No 51'),
(338, '819f46', 2, 'Ronny Rumambi', '', '628114519780', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-02', 'Sulawesi Tengah', 'Palu', 'Palu Selatan', 'My Home Ruko Graha Towua Blok C 14-15 Jl. Towua Palu Sulawesi Tengah'),
(339, '040259', 2, 'Muhammad Rezza', '', '628114565088', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-07', 'Sulawesi Tengah', 'Palu', 'Ulujadi', 'Jl Kelapa Gading No 7 , Kel : Kabonena , Kec : Ulujadi'),
(340, '40008b', 2, 'HendraDanielWillar', '', '628114586488', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-26', 'Dki Jakarta', 'Jakarta Timur', 'Pasar Rebo', 'Jl Sukarela 1 No 81 Rt 011 Rw 011, Kelurahan Cijantung Kodepos 13770'),
(341, '3dd48a', 2, 'Robin Johan', '', '628114603379', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-25', 'Sulawesi Selatan', 'Makassar', 'Ujung Pandang', '(Hubungi No Wa) \nJl. St. Hasanuddi No.22/28 Samping Hotel Fox, Desa Baru Rt/Rw 01/03,'),
(342, '58238e', 2, 'GlenNando', '', '628114822074', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-05', 'Papua Barat', 'Sorong', 'Sorong Manoi', 'Jl  A  Yani Klademak Iii C, \nKantor Pt  Pdka \nKel : Malabutor \nKdpos : 98415'),
(343, '3ad7c2', 2, 'Mahyuddin Makmur Sh Mh', '', '628114850585', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-28', 'Sulawesi Tenggara', 'Kendari', 'Mandonga', 'Kantor Kpknl Kendari, Jl  Made Sabara No  6, Mandonga 93111'),
(344, 'b3967a', 2, 'DifainLahamid', '', '628114877213', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-11', 'Papua Barat', 'Fakfak', 'Fakfak', 'Kantor Dinas Pekerjaan Umum Jl  Jend  A  Yani Fakfak Papua Barat'),
(345, 'd81f9c', 2, 'GunawanEkaSaputra', '', '628114909050', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-17', 'Banten', 'Tangerang Selatan', 'Serpong Utara', 'Viola Residence, Vl/G/9  Graha Raya Bintaro , Pondok Jagung  \nSerpong Utara, Kota Tangerang Selatan, Banten 15326'),
(346, '13f989', 2, 'Najamuddin Yakub', '', '628114914024', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-16', 'Papua', 'Mimika', 'Mimika Baru', 'Jl  Hasanuddin Depan Bank Mandiri Hasanuddin Ruko Nomor 03\nKode Pos : 99910'),
(347, 'c5ff25', 2, 'GangsarErwanSujatmiko', '', '628115011177', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-29', 'Kalimantan Selatan', 'Banjarmasin', 'Banjarmasin Timur', 'Jl Pramuka Simpang Tirta Dharma Komplek Bersama B 23 Km 6 Rt018'),
(348, '01386b', 2, 'Risky Ananda', '', '628115036989', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-22', 'Kalimantan Selatan', 'Banjarbaru', 'Landasan Ulin', 'Jl.Sukamara Komplek Pertokoan Sinar Lestari Ruko No.1&4\nLandasan Ulin (A.Yani Km 23) Banjarbaru Kalimantan Selatan'),
(349, '0bb4ae', 2, 'Yehezkiel', '', '628115444017', 'Y', 'Laki - Laki', 'T-Shirt', '2020-09-03', 'Kalimantan Timur', 'Bontang', 'Bontang Utara', 'Wisma Kpi,Guntung,Bontang Utara'),
(350, '9de6d1', 2, 'Yehezkiel Palit', '', '628115444017', 'Y', 'Laki - Laki', 'T-Shirt', '2020-09-03', 'Kalimantan Timur', 'Bontang', 'Bontang Utara', 'Wisma Kpi Jl.Pupuk Raya Km.2 Rt.52 Kelurahan Loktuan Kecamatan Bontang Utara Kota Bontang 75314 Kalimantan Timur'),
(351, 'efe937', 2, 'Sahat M Sitanggang', '', '628115499902', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-21', 'Kalimantan Timur', 'Bontang', 'Bontang', 'Jl. Kol 10 No. 139.\nRt. 08.\nKel :  Gn Elai  Bontang Utara.\nKota Bontang.\n\n\n\n\nKota Bontang Kaltim'),
(352, '371bce', 2, 'EriePrihartono', '', '628115559082', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-06', 'Kalimantan Timur', 'Samarinda', 'Sungai Kunjang', 'Jl Ir Sutami Komp Pergudangan ( Kantor Pt Cipta Niaga Semesta/Mayora ) \nRt/Rw : 26\nDesa Karang Asam Ulu'),
(353, '138bb0', 2, 'D-Akli', '', '628115564646', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-19', 'Kalimantan Timur', 'Samarinda', 'Samarinda Ulu', 'Jl Ks Tubun No 99 Rt 008 Kel  Dadi Mulya Kec  Samarinda Ulu - Samarinda 75124'),
(354, '8dd48d', 2, 'Jimmy', '', '628115582243', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-07', 'Kalimantan Tengah', 'Sampit', 'Sampit', 'Perum  Bumi Raya Residence No  124, Rt  37, Rw  08, Baamang Tengah, Sampit, Kalteng'),
(355, '82cec9', 2, 'Jimmy', '', '628115582244', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-04', 'Kalimantan Tengah', 'Sampit', 'Sampit', 'Perumahan Bumi Raya Residence No  124, Rt  37, Rw  08, Baamang Tengah, Sampit, Kalimantan Tengah 74312'),
(356, '6c524f', 2, 'EfiksonSinaga', '', '628115585189', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-19', 'Kalimantan Timur', 'Balikpapan', 'Balikpapan Selatan', 'Jl Marsma R Iswahyudi  Rt  15  No 32 \nSepinggan'),
(357, 'fb7b9f', 2, 'Johanes', '', '628115720106', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-12', 'Kalimantan Barat', 'Bengkayang', 'Sungai Raya', 'Toko Eka Jaya Electronic\nJalan Sungai Raya Dalam Kompleks Spring Park No 1\n(Depan Kompleks Royal Serdam 1)\nPontianak\nKubu Raya\nKalimantan Barat'),
(358, 'aa942a', 2, 'Reyza', '', '628116007007', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-13', 'Kalimantan Selatan', 'Tanah Bumbu', 'Batulicin', 'Jl. Cappa Padang No 18 Rt 7 Rw 2 Simpang Empat Batulicin Kalimantan Selatan 72271'),
(359, 'c058f5', 2, 'Rezy Walandouw', '', '628116060203', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-18', 'Sumatera Utara', 'Asahan', 'Tanjung Balai', 'Jl Ampera Dusun 5 Bagan Asahan Pekan Tanjung Balai Asahan'),
(360, 'e7b24b', 2, 'HarryPrasetya', '', '628116111975', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-27', 'Sumatera Utara', 'Medan', 'Medan Selayang', 'Jl Pasar 1 Komplek Setia Budi Estate Blok G No 6, Tanjung Sari Medan Selayang, Kota Medan, Sumatera Utara 20132'),
(361, '52720e', 2, 'Stanlay Surya', '', '628116141997', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-02', 'Sumatera Utara', 'Medan', 'Medan Barat', 'Newton Education Group\nJln. Pertempuran Komplek Brayan City Blok-A No. 12A'),
(362, 'c3e878', 2, 'AgusPramulyo', '', '628116145000', 'Y', 'Laki - Laki', 'T-Shirt', '2020-11-30', 'Sumatera Utara', 'Medan', 'Medan Helvetia', 'Jl  Asrama No26A Kelurahan Sei Kambing Cii\nMedan Helvetia\nMedan, Sumatera Utara'),
(363, '004114', 2, 'AgusPramulyo', '', '628116145000', 'Y', 'Laki - Laki', 'T-Shirt', '2020-11-30', 'Sumatera Utara', 'Medan', 'Medan Helvetia', 'Jalan Asrama No 26A Kelurahan Sei Sikambing C Ii\nPos  20123'),
(364, 'bac916', 2, 'JanpiterSiregar', '', '628116260710', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-04', 'Banten', 'Serang', 'Kramatwatu', 'Jl  Anggrek Iv No  16\nKel : Kramat Watu\nKdpos : 42161'),
(365, '9be40c', 2, 'Girvin', '', '628116337728', 'Y', 'Laki - Laki', 'T-Shirt', '2020-08-04', 'Sumatera Utara', 'Medan', 'Medan Maimun', 'Jl Ir H  Juanda No 35 (Simp Jln Slamet Riyadi)Medan Polonia, Kota Medan, Medan Maimun, Sumatera Utara, Id, 20152'),
(366, '5ef698', 2, 'GirvinKenrickDjapardi', '', '628116337728', 'Y', 'Laki - Laki', 'T-Shirt', '2020-08-04', 'Sumatera Utara', 'Medan', 'Medan Polonia', 'Jl Juanda No 35\nMedan Polonia \nKode Pos 20152'),
(367, '05049e', 2, 'Yazid Naufal Aqil', '', '628116381410', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-30', 'Sumatera Utara', 'Medan', 'Medan Area', 'Jl. Sigli No.3 Dekat Perguruan Muhammadiyah 1, Medan Area, Kota Medan 20214'),
(368, 'cf004f', 2, 'JeffriSandyEdricko', '', '628116612125', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-06', 'Sumatera Barat', 'Padang', 'Padang Selatan', 'Tac Padang,\nJl  Cilacap No  25\nTlk  Bayur,\nKec  Padang Sel , Kota Padang, Sumatera Barat\nKdpos : 25215'),
(369, '0c74b7', 2, 'IndraWahyuWendarso', '', '628116644451', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-13', 'Jawa Barat', 'Cirebon', 'Depok', 'Jl  P  Puger 3, Griya Arsita Pugeran Blok A1, Maguwoharjo, Depok, Sleman - Diy 55282'),
(370, 'd709f3', 2, 'Muhammad Refi', '', '628116709891', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-29', 'Sumatera Utara', 'Medan', 'Medan Selayang', 'Komp  Taman Setia Budi Indah 1, Blok V V No 41, Medan , Kota Medan, Medan Selayang, Sumatera Utara, Id, 20133'),
(371, '41f1f1', 2, 'Putra Suryadi', '', '628116802120', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-22', 'Nanggroe Aceh Darussalam (Nad)', 'Banda Aceh', 'Lueng Bata', 'Lr. Bahagia No.9 Desa Cot Mesjid Kec. Lueng Batee, Kota Banda Aceh'),
(372, '24b16f', 2, 'Muammar Aiman', '', '628116802222', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-18', 'Jawa Tengah', 'Karanganyar', 'Karangpandan', 'Ma&#39;Had Tahfizhul Qur An Isy Karima,\nJalan Raya Solo Tawangmangu No 34, Gerdu'),
(373, 'ffd52f', 2, 'Jamali', '', '628116873444', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-16', 'Nanggroe Aceh Darussalam (Nad)', 'Pidie', 'Pidie', 'Awana Mart, Jalan Banda Aceh Medan, Pulo Pisang, Pidie, Kab  Pidie, Pidie, Nanggroe Aceh Darussalam (Nad), Id, 24151'),
(374, 'ad972f', 2, 'AnshariHasbi', '', '628116886680', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-26', 'Nanggroe Aceh Darussalam (Nad)', 'Banda Aceh', 'Jaya Baru', 'Lrg  Tgk Meunara I, Kec  Jaya Baru, Kota Banda Aceh, Aceh, 23232 [Tokopedia Note: Jalan Soekarno Hatta, Lrg Tgk Meunara I No  32]'),
(375, 'f61d69', 2, 'ErwinYeo', '', '628116941214', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-15', 'Kepulauan Riau', 'Tanjung Pinang', 'Tanjung Pinang Barat', 'Jalan Potong, Lembu, Lorong Murai No  34 \nKelurahan : Kemboja\nProvinsi : Kepri \nKodepos: 29111'),
(376, '142949', 2, 'Urai Andri Kurniawan', '', '628117006164', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-03', 'Sumatera Utara', 'Medan', 'Medan Selayang', 'Jl.Permata Bunga No.11 Vila Malina Indah, Tanjung Sari'),
(377, 'd34ab1', 2, 'Raja Muhammad Reezky Hazlam', '', '628117010080', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-15', 'Kepulauan Riau', 'Tanjung Pinang', 'Tanjung Pinang Timur', 'Perumahan Griya Permata Kharisma\nJl. Permata 1\nBlok B No. 3\nKota Tanjung Pinang, Tanjung Pinang Timur\nKep. Riau\n29125'),
(378, '8bf121', 2, 'EdySuradi', '', '628117050646', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-17', 'Dki Jakarta', 'Jakarta Utara', 'Kelapa Gading', 'Gading Mas Barat Ii Blok D-8 No 22 Rt 04 Rw 11, Kel  Pegangsaan Dua \nKode Pos : 14250\n(Depan Masjid Al-Ikhlas)'),
(379, 'a02ffd', 2, 'Velky', '', '628117117117', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-01', 'Riau', 'Pekanbaru', 'Bukit Raya', 'Pt. Gita Riau Makmur. (Hino)\nJl. Kaharudin Nasution Km 12. Simpang Tiga. Bukit Raya\nPekan Baru\nRiau 28284'),
(380, 'bca82e', 2, 'HadiEkaputraLiega', '', '628117176687', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-07', 'Dki Jakarta', 'Jakarta Barat', 'Grogol Petamburan', 'Jl  Tanjung Duren Raya No No Kav 5-9, Rt 3/Rw 5, Tj  Duren Sel , Kec  Grogol Petamburan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11470'),
(381, '00ec53', 2, 'Riswan', '', '628117292015', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-17', 'Lampung', 'Bandar Lampung', 'Tanjung Senang', 'Jl. Ratu Dibalau Pasar Way Kandis (Bakso Ali) Kel. Way Kandis Kec. Tanjung Senang Kota Bandar Lampung Kodepos : 35141'),
(382, '4f6ffe', 2, 'Rahmat Manullang', '', '628117293737', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-16', 'Sumatera Utara', 'Medan', 'Medan Selayang', 'Komplek Taman Setiabudi Indah 1 Blok N No 34 Medan Selayang Medan'),
(383, 'beed13', 2, 'ChristoBobane', '', '628117332764', 'Y', 'Laki - Laki', 'T-Shirt', '2018-12-09', 'Jawa Barat', 'Bekasi', 'Tambun Utara', 'Graha Prima Blok G A No 123 Mangun Jaya - Tambun Selatan (Gpdi Bukit Hermon), \nKab  Bekasi, Tambun Selatan, 17510'),
(384, '0584ce', 2, 'Christofer', '', '628117332764', 'Y', 'Laki - Laki', 'T-Shirt', '2018-12-09', 'Jawa Barat', 'Cikarang', 'Tambun Selatan', 'Graha Prima Blok G A No  123 Desa Mangun Jaya 17510 Rt 010/016 \nAncar2 Alamatnya : (Depan Pos Polisi, Belakang Sman 3 Tambun Selatan )\nKalau Di Maps (Gpdi Bukit Hermon Graha Prima)\nKecamatan: Tambun Selatan\nKabupaten: Bekasi\nProvinsi: Jawa Barat'),
(385, 'dc912a', 2, 'M  Dicky R', '', '628117344442', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-19', 'Dki Jakarta', 'Jakarta Pusat', 'Gambir', 'Jl  Juanda I A No 11 (Kantin Berkat)'),
(386, '39461a', 2, 'AndriZulpan', '', '628117362496', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-01', 'Bengkulu', 'Bengkulu', 'Muara Bangka Hulu', 'Jalan Korpri 4 No 165 Rt  9 Rw 5, Bentiring  Bengkulu\nMuara Bangkahulu, Kota Bengkulu, Bengkulu 38119'),
(387, '8efb10', 2, 'EffendiHatta', '', '628117499700', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-18', 'Jambi', 'Jambi', 'Danau Sipin', 'Jl Katelia 1 No 11 Rt 14 Kel Sungai Putri'),
(388, 'd9fc5b', 2, 'Fendy', '', '628117707880', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-28', 'Kepulauan Riau', 'Batam', 'Batam Kota', 'Jl  Ahmad Yani (Taman Dutamas Blok A9 No 6 Rt001/Rw002 ), Kec  Batam Kota, Kota Batam, Kepulauan Riau, 29444'),
(389, 'c86a7e', 2, 'IcanGanteng', '', '628117750097', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-11', 'Kepulauan Riau', 'Batam', 'Sekupang', 'Jl  Kartini 2 No 3 - Sekupang - Batam\n08117750097'),
(390, 'a01a03', 2, 'DanielLo', '', '628117753828', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-09', 'Kepulauan Riau', 'Batam', 'Batam Kota', 'Ruko Mitra Raya Blok A No 2-3, Kota Batam, Batam Kota, Kepulauan Riau, Id, 29414\n08117753828'),
(391, '5a4b25', 2, 'HendraWinata', '', '628117773421', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-23', 'Kepulauan Riau', 'Batam', 'Sekupang', 'Ruko Ciptaland Blok Anggrek No 12A (Sebelah Cetya Boddhisatva Avalokitesvara)'),
(392, 'f73b76', 2, 'HendraWinata', '', '628117773421', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-23', 'Kepulauan Riau', 'Batam', 'Sekupang', 'Ruko Ciptaland Blok Anggrek No 12A (Sebelah Cetya Boddhisatva Avalokitesvara)'),
(393, '70c639', 2, 'MRezaRialdi', '', '628117887870', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-11', 'Bangka Belitung', 'Bangka Selatan', 'Toboali', 'Bri Kcp Toboali, Teladan, Toboali (Bank Bri Kcp Toboali)\nJl  Jend Sudirman No 26), Kab  Bangka Selatan, Toboali, Bangka Belitung, Id, 33783'),
(394, '28f0b8', 2, 'Ahda', '', '628117917595', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-30', 'Lampung', 'Bandar Lampung', 'Tanjung Karang Barat', 'Jl  Kepodang No 46, Susunan Baru, Tanjung Karang Barat (Rumah Ujung Warna Coklat) 35156'),
(395, '154384', 2, 'JessenJavierKurniawan', '', '628117967770', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-13', 'Lampung', 'Bandar Lampung', 'Way Halim', 'Alamat : Perumahan Villa Citra 2 Blok O1 No 15'),
(396, 'f8c1f2', 2, 'CosmasHendryawan', '', '628118009213', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-13', 'Dki Jakarta', 'Jakarta Timur', 'Duren Sawit', 'Jl  Kelapa Kuning Raya A1 No 26 Pondok Kelapa Indah Kalimalang Duren Sawit Jakarta Timur 13450'),
(397, 'e46de7', 2, 'Yuddy Kurnia', '', '628118086887', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-16', 'Jawa Barat', 'Bandung', 'Margahayu', 'Pasar Segar Taman Kopo Indah 2.\nRuko Rc 6-7.'),
(398, 'b7b16e', 2, 'BimoSetyo', '', '628118163314', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-17', 'Jawa Barat', 'Bekasi', 'Bekasi Selatan', 'Pondok Pekayon Indah Jl  Pakis Raya Barat Rt 007/Rw 012 Blok Aa 8 Nomor 14 B, Kel  Pekayon Jaya, Kec  Bekasi Selatan, Kota Bekasi, Kode Pos 17148'),
(399, '352fe2', 2, 'BpkNugroho', '', '628118178268', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-02', 'Jawa Timur', 'Kediri', 'Pagu', 'Dsn/Ds Kambingan Rt 4 Rw 1 No  144  Kec  Pagu Kab Kediri Jawa Timur Kode Pos 64183'),
(400, '18d804', 2, 'EkoPNugroho', '', '628118178268', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-02', 'Dki Jakarta', 'Jakarta Selatan', 'Pasar Minggu', 'Jl  Gotong Royong I No 29B, Rw 2, Ragunan, Kec  Ps  Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12550'),
(401, '816b11', 2, 'DeddyKuryanto', '', '628118188481', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-04', 'Dki Jakarta', 'Jakarta Timur', 'Kramat Jati', 'Kosan Alm  Masruchi (Suhu), Kamar No 8, Jalan Haji Ali, Gang Mundu Ii No 31, Rt 04 Rw 04, Kel  Kampung Tengah, Kec  Kramat Jati, Jakarta Timur, 13540'),
(402, '69cb3e', 2, 'FarahutamaJafar', '', '628118189119', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-27', 'Dki Jakarta', 'Jakarta Selatan', 'Pasar Minggu', 'Jatipadang I No 5C, Pasar Minggu\nPasar Minggu, Kota Administrasi Jakarta Selatan, Dki Jakarta 12540'),
(403, 'bbf94b', 2, 'IndraPermana', '', '628118241730', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-21', 'Banten', 'Tangerang', 'Cibodas', 'Jl Perunggu Iii No 40, Perumnas Ii, Bencongan Indah, Tangerang, Banten\nKode Pos : 15138'),
(404, '4f4adc', 2, 'Tiur', '', '628118247724', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-21', 'Dki Jakarta', 'Jakarta Utara', 'Pademangan', 'Gd. Wtc Mangga 2 Lt.12 , Jln .Mangga Dua Raya No.8\nAncol-Pademangan , Jakarta Utara'),
(405, 'bbcbff', 2, 'Putra Artadi', '', '628118302705', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-14', 'Dki Jakarta', 'Jakarta Barat', 'Kembangan', 'Jalan Aries Elok Iii Blok F9 No.5, Rt.8/Rw.6, Meruya Utara, Kembangan (F9 No. 5), Kota Jakarta Barat, Kembangan, Dki Jakarta, Id, 11620'),
(406, '8cb22b', 2, 'Shinda', '', '628118333113', 'Y', 'Laki - Laki', 'T-Shirt', '2020-06-22', 'Jawa Barat', 'Bogor', 'Sukaraja', 'Villa Bogor Indah 6 Cluster Davalia Blok C1 No 7 Karadenan Pasir Jambu Bogor 16710'),
(407, 'f4f6dc', 2, 'Shinda Aprilia', '', '628118333113', 'Y', 'Laki - Laki', 'T-Shirt', '2020-06-22', 'Jawa Barat', 'Bogor', 'Sukaraja', 'Villa Bogor Indah 6, Cluster Davalia Blok C1 No 7, Jl. Pemda Pasir Jambu , Karadenan 16710'),
(408, '0d0fd7', 2, 'EricSasono', '', '628118454225', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-19', 'Dki Jakarta', 'Jakarta Selatan', 'Cilandak', 'Apartemen Bona Vista Tower 1B Unit 1104\nJl  Bona Vista Raya, Jakarta 12440'),
(409, 'a96b65', 2, 'KuncoroSediPrayogi', '', '628118458861', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-05', 'Banten', 'Serang', 'Kramatwatu', 'Komplek Puri Hijau Regency\nPuri Asri 3 No16\nToyomerto-Kramatwatu Serang'),
(410, '1068c6', 2, 'FahmiArgubi', '', '628118505504', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-28', 'Jawa Barat', 'Depok', 'Limo', 'Perumahan Alam Persada Cemara, Blok C2 No 4 Jl  Rawa Kalong, Kelurahan Grogol, Kec Limo, Depok \nLimo, Kota Depok, Jawa Barat 16512'),
(411, '17d63b', 2, 'Pringgo', '', '628118607046', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-20', 'Dki Jakarta', 'Jakarta Selatan', 'Kebayoran Lama', 'Jl  H  Muhi Vi No 26 Pondok Pinang\nKode Pos : 12310'),
(412, 'b9228e', 2, 'Aramis', '', '628118681979', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-23', 'Kalimantan Utara', 'Bulungan', 'Tanjung Selor', 'Kantor Gubernur Kalimantan Utara  Jln Kol Soetadji No 1 Desa/Kel  Tanjung Selor Hilir,  Kecamatan Tanjung Selor Kode Pos 77212'),
(413, '0deb1c', 2, 'GuntamasHalim', '', '628118705904', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-27', 'Dki Jakarta', 'Jakarta Selatan', 'Kebayoran Lama', 'Jl  Kemandoran I No 11 Grogol Utara, Kebayoran Lama Jakarta Selatan'),
(414, '66808e', 2, 'AlanKandela', '', '628118706035', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-02', 'Dki Jakarta', 'Jakarta Selatan', 'Tebet', 'Apartemen Casa Grande, Tower Montreal, Unit 03/09\nJakarta Selatan'),
(415, '42e7aa', 2, 'Suwandy', '', '628118716390', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-18', 'Dki Jakarta', 'Jakarta Barat', 'Kembangan', 'Jl. Pulau Pelangi 1 No 79 Taman Permata Buana Puri Kembangan Jakarta Barat\nIndonesia'),
(416, '8fe009', 2, 'FerriyaleMuhammad', '', '628118801189', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-22', 'Banten', 'Tangerang', 'Cisauk', 'The Icon, Cluster Eternity, L2/38, Bsd,  Kel  Sampora, Tangerang'),
(417, '41ae36', 2, 'Rio', '', '628118806890', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-26', 'Dki Jakarta', 'Jakarta Barat', 'Cengkareng', 'Perumahan Hawai Blok C No 26,'),
(418, 'd1f255', 2, 'AkbpHandoyo', '', '628118819797', 'Y', 'Laki - Laki', 'T-Shirt', '2020-09-28', 'Di Yogyakarta', 'Sleman', 'Depok', 'Perumahan  Casagrande, Cluster Andalusia No 226, Kecamatan Depok Timur , Kab  Sleman Jogjakarta\nKode Pos 55282'),
(419, '7eacb5', 2, 'AkbpHandoyo', '', '628118819797', 'Y', 'Laki - Laki', 'T-Shirt', '2020-09-28', 'Di Yogyakarta', 'Sleman', 'Depok', 'Jl  Casa Grande Perumahan Casa Grande Cluster Andalusia No 226'),
(420, 'b6f047', 2, 'CrystalinSuwandi', '', '628118853000', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-27', 'Dki Jakarta', 'Jakarta Utara', 'Penjaringan', 'Taman Resort Mediterania Blok Z7 No  17, Jl  Pantai Indah Utara 2 No 14460, Rt 1/Rw16 , Kota Jakarta Utara, Penjaringan, Dki Jakarta, Id, 14460'),
(421, 'e0c641', 2, 'AudreyKirsten', '', '628118888958', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-17', 'Dki Jakarta', 'Jakarta Barat', 'Grogol Petamburan', 'Tanjung Duren Utara 7C No 507, Rt 03/Rw 03, Jakarta Barat 11470'),
(422, 'f85454', 2, 'LouisTan', '', '628118893023', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-08', 'Dki Jakarta', 'Jakarta Utara', 'Jakarta Utara', 'Villa Gading Indah Blok I No 11B\nJakarta Utara\n14240'),
(423, 'faa9af', 2, 'HeribertusDany', '', '628118897588', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-26', 'Banten', 'Tangerang', 'Pasar Kemis', 'Jl Mawar Iii No 10 B11 Rt04 Rw08 Pondok Indah Kutabumi\nPasarkemis, Kab  Tangerang, Banten 15560'),
(424, '3c7781', 2, 'AlfianSyahril', '', '628118908331', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-16', 'Jawa Barat', 'Depok', 'Cilodong', 'Jl  Raya Kebon Duren Rt 001/004 No 51 Kel  Kalimulya, Kec  Cilodong Kota Depok 16413'),
(425, '25b282', 2, 'DaneshDario', '', '628118991700', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-29', 'Jawa Barat', 'Bogor', 'Bogor Timur - Kota', 'Jl Permata No 38 Villaduta \nBaranangsiang \nBogor, Bogor Timur\n16143'),
(426, '6ecbdd', 2, 'Wilis Mediatek', '', '628119004107', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-24', 'Dki Jakarta', 'Jakarta Pusat', 'Sawah Besar', 'Gedung Graha Astel. \nJl. Pintu Air Raya No.2F, Rt.7/Rw.1, Ps. Baru, Kecamatan Sawah Besar, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10710'),
(427, '189977', 2, 'Wilis Mediatek', '', '628119004107', 'Y', 'Laki - Laki', 'T-Shirt', '2020-12-24', 'Dki Jakarta', 'Jakarta Pusat', 'Sawah Besar', 'Graha Astel Jl. Pintu Air Raya No.2F, Rt.7/Rw.1, Ps. Baru, Daerah Khusus Ibukota Jakarta 10710'),
(428, '8d7d8e', 2, 'Bobby', '', '628119009121', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-15', 'Dki Jakarta', 'Jakarta Selatan', 'Tebet', 'Jalan W Buntu No  4B, Rt 7 / Rw 11, Kebon Baru, Jakarta Selatan'),
(429, '75fc09', 2, 'Nano', '', '628119110156', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-31', 'Dki Jakarta', 'Jakarta Timur', 'Ciracas', 'Pusdiklatkar, Jl  Raya Ciracas No 113, Rt 6/Rw 5, Ciracas, Kec  Ciracas, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13740'),
(430, 'f74909', 2, 'Fabian', '', '628119113303', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-06', 'Dki Jakarta', 'Jakarta Utara', 'Kelapa Gading', 'Gading Kirana Barat 8 Blok E9 No 38, Kelapa Gading, Jakarta Utara 14240'),
(431, '663682', 2, 'Yosuadi Yehuda', '', '628119131090', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-07', 'Dki Jakarta', 'Jakarta Selatan', 'Kebayoran Baru', 'Jl. Pulombangkeng No. 13, Selong, Kebayoran Baru\nKebayoran Baru, Kota Administrasi Jakarta Selatan, Dki Jakarta 12110'),
(432, '248e84', 2, 'Roni', '', '628119192538', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-09', 'Dki Jakarta', 'Jakarta Barat', 'Kalideres', 'Perumahan Taman Kencana Blok E7 No 10 Rt 05 Rw 04 Tegal Alur'),
(433, '019d38', 2, 'Adhika', '', '628119326000', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-30', 'Dki Jakarta', 'Jakarta Utara', 'Kelapa Gading', 'Apartemen French Walk, Tower Lourdes Garden 15C, Kelapa Gading Square, Moi, Kelapa Gading, Kota Jakarta Utara, Kelapa Gading, Dki Jakarta, Id, 14240'),
(434, 'a49e94', 2, 'Timothy Izaak', '', '628119327007', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-22', 'Jawa Barat', 'Bekasi', 'Mustika Jaya', 'Legenda Park Block C8/16 Rt/W 008/017 Kel Padurenan \nKec Mustikajaya\nBekasi 17156');
INSERT INTO `tb_customer` (`cust_id`, `cust_uid`, `cust_cust_batch_id`, `cust_name`, `cust_email`, `cust_phone`, `cust_status`, `cust_gender`, `cust_product_batch`, `cust_date_order`, `cust_prov`, `cust_city`, `cust_district`, `cust_address_full`) VALUES
(435, 'ddb306', 2, 'Yugo', '', '628119334609', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-23', 'Jawa Barat', 'Bekasi', 'Bekasi Utara', 'Jl. Mutiara Gading City, Cluster Royal London Blok J18-22. Setia Asih, Kec. Tarumajaya, Bekasi, Jawa Barat 17215'),
(436, '2421fc', 2, 'Yosua Kapitan', '', '628119472110', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-23', 'Dki Jakarta', 'Jakarta Barat', 'Cengkareng', 'Jln Intan No 159 Rt/Rw 004/007 Kedaung Kali Angke'),
(437, 'fccb60', 2, 'Andry', '', '628119503507', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-29', 'Banten', 'Tangerang Selatan', 'Ciputat', 'Jl  Nusa Indah, No 12 Perumahan Ciputat Baru, Kec  Ciputat, Kota Tangerang Selatan, Banten, 15413'),
(438, '1651cf', 2, 'BrianAryabima', '', '628119512400', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-26', 'Jawa Barat', 'Bekasi', 'Bekasi Utara', 'Perumahan Bintang Metropole Cluster Pluto Blok A3 No 11 Bekasi Utara,17122\nBekasi Utara\nBekasi, Jawa Barat'),
(439, 'eed5af', 2, 'Pak Michael', '', '628119548799', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-05', 'Jawa Barat', 'Bekasi', 'Jati Sampurna', 'Jl  Alternatif Cibubur  Perumahan Citra Gran Blok B 3  No 50, Kec  Jatisampurna, Kota Bekasi, Jatisampurna, Jawa Barat, 17435'),
(440, 'a8abb4', 2, 'Nicolas Djohan', '', '628119621728', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-24', 'Dki Jakarta', 'Jakarta Pusat', 'Sawah Besar', 'Jl  Lautze No  1K-3K (Pt  Ika Wira Niaga), Kota Jakarta Pusat, Sawah Besar, Dki Jakarta, Id, 10710\n08119621728'),
(441, '15d4e8', 2, 'Veroze Waworuntu Saad', '', '628119632349', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-14', 'Dki Jakarta', 'Jakarta Pusat', 'Senen', 'Mitra Oasis Residence Tower C 306, Kota Jakarta Pusat, Senen, Dki Jakarta'),
(442, 'c203d8', 2, 'Muhammad Rifaldo Wirawan', '', '628119721296', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-18', 'Di Yogyakarta', 'Sleman', 'Ngaglik', 'Green Damai Residence  No 143M Jalan Sunan Ampel 1 Banten, Jaban, Ngaglik, Sinduharjo, Sleman, Diy Yogyakarta, Rt : 3, Rw : 25, Kode Pos : 55581'),
(443, '13f3cf', 2, 'Mahesa Surya', '', '628119721308', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-02', 'Jawa Barat', 'Bekasi', 'Bekasi Barat', 'Jalan De&#39;Minimalist V  Blok H 11, Jakasampurna, Bekasi Barat, Kota Bekasi 17145'),
(444, '550a14', 2, 'Henry', '', '628119783012', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-10', 'Banten', 'Tangerang Selatan', 'Serpong Utara', 'Foresta Raya\nCluster Naturale M Blok M3/18'),
(445, '67f7fb', 2, 'HenrySaputra', '', '628119783012', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-10', 'Kepulauan Riau', 'Tangerang Selatan', 'Serpong Utara', 'Foresta Raya, Cluster Naturale M Block M3/8, Bsd'),
(446, '1a5b1e', 2, 'Eston', '', '628119840915', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-17', 'Dki Jakarta', 'Jakarta Pusat', 'Sawah Besar', 'Jl  Gunung Sahari Vi, No  24\nKecamatan Sawah Besar, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta, 10720'),
(447, '9a9687', 2, 'Tel Lee', '', '628119851592', 'Y', 'Laki - Laki', 'T-Shirt', '2020-10-21', 'Dki Jakarta', 'Jakarta Utara', 'Penjaringan', 'Jln. Manyar Permai V Blok U3 No. 10, Kapuk Muara, Kec. Penjaringan - Jakarta Utara'),
(448, '9b70e8', 2, 'Tell Lee', '', '628119851592', 'Y', 'Laki - Laki', 'T-Shirt', '2020-10-21', 'Dki Jakarta', 'Jakarta Utara', 'Penjaringan', 'Jln. Manyar Permai V Blok U3 No. 10\nPantai Indah Kapuk, Kapuk Muara, Penjaringan\nJakarta Utara 14460'),
(449, 'd61e4b', 2, 'AndreLeonardusRajagukguk', '', '628119872905', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-14', 'Sumatera Utara', 'Deli Serdang', 'Lubuk Pakam', 'Toko Borobudur Depan Mode Fashion Jalan Sutomo Lubukpakam'),
(450, 'f5f859', 2, 'AndreLeonardusRajagukguk', '', '628119872905', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-14', 'Jawa Barat', 'Bogor', 'Bogor Timur - Kota', 'Jalan Padi Kosan Samping Kopi Janji Jiwa Baranangsiang'),
(451, '941e1a', 2, 'DhimasHaris', '', '628119919897', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-12', 'Dki Jakarta', 'Jakarta Selatan', 'Pancoran', 'Apartemen Kalibata City Tower Jasmine Unit J10Ba, Kalibata, Kota Jakarta Selatan, Pancoran, Dki Jakarta, Id, 12750'),
(452, '9431c8', 2, 'AfriandiSunarto', '', '628119922852', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-12', 'Jawa Barat', 'Depok', 'Beji', 'Taman Ventura Indah 2 No D-1, Rt 02/10, Kel Tanah Baru, Kec Beji, Depok, 16426'),
(453, '49ae49', 2, 'AlvinLuthfi', '', '628119932774', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-17', 'Dki Jakarta', 'Jakarta Barat', 'Kembangan', 'Perumahan Koriah Toyyibah, Jl Sankis I No  5, Rt 3 / Rw 1, Srengseng, 11630'),
(454, 'e44fea', 2, 'Clarinda', '', '628119936166', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-19', 'Dki Jakarta', 'Jakarta Barat', 'Cengkareng', 'Green Mansion Blok Green Pearl Raya No 1\nKedaung Kali Angke, 11710 , Cengkareng ,Jakarta Barat\nJakarta Barat\nDki Jakarta'),
(455, '821fa7', 2, 'JuanArmando', '', '628119961811', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-18', 'Dki Jakarta', 'Jakarta Utara', 'Tanjung Priok', 'Jl  Alamanda Ii Blok C2 No  13, Sunter, Jakarta Utara, 14350'),
(456, '250cf8', 2, 'Reza Nugraha', '', '628119989288', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-06', 'Dki Jakarta', 'Jakarta Pusat', 'Kemayoran', 'Jalan Selangit No 4 Kavling B 10, Gunug Sahari Selatan, Kemayoran, Jakarta Pusat.\nHermina Tower Di Lobi Hermina Tower'),
(457, '42998c', 2, 'Nuswantoro Aji', '', '628120227822', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-25', 'Jawa Tengah', 'Magelang', 'Secang', 'Krajan 2 Rt 10 Rw 04 Secang ( Depot Es Nusantara )'),
(458, 'd07e70', 2, 'Ridwan', '', '628121034171', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-07', 'Dki Jakarta', 'Jakarta Selatan', 'Jagakarsa', 'Lanata 2 Residence Blok C3, Jl Aselih, Rt 011 Rw 001,  Cipedak, Jagakarsa, 12630'),
(459, '7fe1f8', 2, 'Mateus Sigit', '', '628121034855', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-25', 'Banten', 'Tangerang Selatan', 'Serpong', 'Sevilla Park Blok A8 No  2, Kencana Loka, Bsd\nSerpong, Kota Tangerang Selatan, Banten 15310'),
(460, '98b297', 2, 'JumadilJohar', '', '628121053174', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-18', 'Dki Jakarta', 'Jakarta Pusat', 'Senen', 'Jl  Sedap Malam No 41C Rt 001 Rw 001, Dki Jakarta 10450'),
(461, '0353ab', 2, 'Serlie', '', '628121057573', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-12', 'Dki Jakarta', 'Jakarta Pusat', 'Sawah Besar', 'Halmar - Jl. Mangga Dua Raya Blok F2 No. 6, Kompleks Bahan Bangunan (Antara Harco Dan Hotel Le Grandeur) Sawah Besar, Jakarta Pusat, Dki Jakarta 10730'),
(462, '51d92b', 2, 'IvanPattikawa', '', '628121075607', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-16', 'Banten', 'Tangerang Selatan', 'Ciputat Timur', 'Komp  Dpr, Jln Jalak Vi Blok A5 No 2: Bintaro Sektor 2'),
(463, '428fca', 2, 'Ricky Sanjaya', '', '628121104123', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-13', 'Dki Jakarta', 'Jakarta Barat', 'Palmerah', 'Komplek Dpr Kemanggisan No.46 Rt003/Rw013\nJakarta Barat, Kota Administrasi Jakarta Barat, Dki Jakarta 11480'),
(464, 'f1b6f2', 2, 'HafizhNaufalAlvarozzy', '', '628121106856', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-09', 'Jawa Barat', 'Depok', 'Pancoran Mas', 'Pelita Air Service Blok D8/1 Rt 01 Rw 15'),
(465, '68ce19', 2, 'Sujud Sunawan', '', '628121111800', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-07', 'Dki Jakarta', 'Jakarta Selatan', 'Mampang Prapatan', 'Jl. Kemang Selatan 11 No. 5\nMampang Prapatan, Kota Administrasi Jakarta Selatan, Dki Jakarta 12730'),
(466, 'e836d8', 2, 'Christine', '', '628121132111', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-26', 'Dki Jakarta', 'Jakarta Utara', 'Kelapa Gading', 'Kompleks Bcs  Jl Wibisana Blok I No 25 Rt 12 Rw 08, Kelapa Gading, Jakarta Utara 14240'),
(467, 'ab817c', 2, 'Humam', '', '628121148626', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-24', 'Dki Jakarta', 'Jakarta Timur', 'Pasar Rebo', 'Perumahan Taman Gedong Asri No 19 , Jl Raya\nTengah, Pasar Rebo, Kota Jakarta Timur,\nDki Jakarta'),
(468, '877a9b', 2, 'Tantono', '', '628121191110', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-30', 'Banten', 'Tangerang', 'Kelapa Dua', 'Jl. Kintamani Golf Ix No 11 Kec. Klp. Dua, Tangerang, Banten, 15810 . Kelapa Dua, Kab. Tangerang, Banten 15810'),
(469, 'dc6a64', 2, 'Faustine', '', '628121368738', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-17', 'Banten', 'Serang', 'Kramatwatu', 'Perumahan Griya Serdang Indah Blok G5 No 10 Rt 1 Rw 7 Kelurahan Margatani Kab  Serang - Kramatwatu, Banten, 42112'),
(470, '263373', 2, 'Adji', '', '628121451419', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-09', 'Jawa Barat', 'Bandung', 'Arcamanik', 'Jalan Terbang Layang No  9 , Kel  Suka Miskin'),
(471, '8e6b42', 2, 'DittoSatria', '', '628121509594', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-01', 'Jawa Tengah', 'Semarang', 'Pedurungan', 'Jalan Zebra Dalam Ii Rt 1 Rw 5\nKel Pedurungan Kidul Kec Pedurungan 50192'),
(472, 'ef575e', 2, 'BayuDwi', '', '628121553153', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-20', 'Di Yogyakarta', 'Kulon Progo', 'Wates', 'Rt25/Rw11 Gunung Gempal, Giripeni'),
(473, '2050e0', 2, 'Maickel Tilon', '', '628121629000', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-31', 'Dki Jakarta', 'Jakarta Selatan', 'Kebayoran Lama', 'Jl Niaga Hijau 2 No 1 Pondok Indah - Jakarta Selatan 12310'),
(474, '25ddc0', 2, 'AbdiRahman', '', '628121650474', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-15', 'Kalimantan Timur', 'Samarinda', 'Samarinda Seberang', 'Jl  Teluk Bayur Gg 8 Rt 18 No A/28\nKelurahan Mesjid\nKode Pos 75133'),
(475, '5ef0b4', 2, 'AbdiRahman', '', '628121650474', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-15', 'Kalimantan Timur', 'Samarinda', 'Samarinda Seberang', 'Jl Teluk Bayur \nGang 8 Rt 18\nNo  A/28\nSamarinda Seberang'),
(476, '598b3e', 2, 'Rachmad Kurniawan', '', '628121721445', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-22', 'Jawa Timur', 'Surabaya', 'Karangpilang', 'Griya Kebraon Barat 7 Bg 7 Sby Kel.Kebraon'),
(477, '74071a', 2, 'AbahRudy', '', '628121767299', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-12', 'Jawa Timur', 'Surabaya', 'Sambikerep', 'Jl  Sambikerep Indah Timur I Blok D4 / 11 Surabaya (60217)'),
(478, 'cfee39', 2, 'Ronald Setiawan', '', '628121800090', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-03', 'Jawa Barat', 'Bekasi', 'Bekasi Selatan', 'Jl. Taman Chrisan Ii Blok J3 No 1. Taman Galaxi Indah Bekasi\nBekasi Selatan, Kota Bekasi, Jawa Barat 17147'),
(479, 'd18f65', 2, 'JokoNugroho', '', '628121830453', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-25', 'Dki Jakarta', 'Jakarta Timur', 'Kramat Jati', 'Tamam Residence Kavling 4, Jalan Eretan 1 No 40A, Rt 09 Rw 01, Kel  Balekambang, Kec  Kramat Jati, Jakarta Timur 13530'),
(480, '6ea2ef', 2, 'AgungIndrodewo', '', '628121864372', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-15', 'Dki Jakarta', 'Jakarta Selatan', 'Pasar Minggu', 'Jl  Ampera Raya, Kavling Polri Blok B4 No  6, Ragunan, Pasar Minggu, Jakarta Selatan 12550'),
(481, '9461cc', 2, 'AsepGunawan', '', '628121900736', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-27', 'Dki Jakarta', 'Jakarta Timur', 'Cipayung', 'Jl Binamarga No  9 Rt  007 Rw  05, Ceger-Cipayung, Jakarta Timur 13820'),
(482, 'f770b6', 2, 'Erik', '', '628121922008', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-30', 'Dki Jakarta', 'Jakarta Selatan', 'Jagakarsa', 'Jl  Kedondong Rt  03 Rw 05 No  24\nDki Jakarta 12620'),
(483, 'e1e32e', 2, 'BudiBudiman', '', '628121984267', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-15', 'Banten', 'Cilegon', 'Cilegon', 'Jln Anggrek Kav Blok I No 15 Rt 007/006 Kel  Bendungan  Kec Cilegon 42417'),
(484, 'eba0dc', 2, 'Eggy', '', '628122007422', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-24', 'Jawa Barat', 'Subang', 'Subang', 'Jln  Mt  Haryono 59B Sukamaju'),
(485, '218a0a', 2, 'BapakWenas', '', '628122022272', 'Y', 'Laki - Laki', 'T-Shirt', '2019-05-22', 'Dki Jakarta', 'Jakarta Timur', 'Cakung', 'Cluster La Seine F5 No 10 Jakarta Garden City Cakung Jaktim'),
(486, '7d04bb', 2, 'BramWenas', '', '628122022272', 'Y', 'Laki - Laki', 'T-Shirt', '2019-05-22', 'Dki Jakarta', 'Jakarta Timur', 'Cakung', 'Cluster La Seine F5/10, Jakarta Garden City\nKel  Cakung Timur - 13910\n08122022272'),
(487, 'a516a8', 2, 'Zaenul Arifin', '', '628122030955', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-17', 'Jawa Barat', 'Bandung', 'Coblong', 'Kampus Lipi Gedung 20,  Jl.  Sangkuriang'),
(488, 'c3c59e', 2, 'Indra', '', '628122074970', 'Y', 'Laki - Laki', 'T-Shirt', '2020-06-27', 'Jawa Barat', 'Bandung Barat', 'Lembang', 'Jl  Kp Babakan Rt 04 Rw 09 Desa Cikole ( Rumah Bidan Aminah Sebrang Kopi Luwak Cikole )'),
(489, '854d9f', 2, 'Indra', '', '628122074970', 'Y', 'Laki - Laki', 'T-Shirt', '2020-06-27', 'Jawa Barat', 'Bandung Barat', 'Lembang', 'Kp  Babakan Rt 04 Rw 05 Ds  Cikole ( Rmh Bidan Ami Sebrang Kopi Luwak Cikole )'),
(490, 'c41000', 2, 'Yadi Waluyo', '', '628122080709', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-02', 'Jawa Barat', 'Cirebon', 'Lemahwungkuk', 'Jl. Kesunean No. 1.\nKel : Kasepuhan.\nKdpos : 45114.'),
(491, '559cb9', 2, 'Stefan', '', '628122090594', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-13', 'Jawa Barat', 'Subang', 'Subang', 'Jl Kertawigenda No 35 Subang (Setelah Alfamidi)'),
(492, '55a7cf', 2, 'BudiSantoso', '', '628122090634', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-05', 'Jawa Barat', 'Bandung', 'Bandung Kidul', 'Jl  Batununggal Indah 8 No 100, Cipagalo Kulon Rt 04/03 Kel Mengger Bandung Kidul, Kota Bandung, Jawa Barat 40267'),
(493, '2f5570', 2, 'Raso Irawan', '', '628122097145', 'Y', 'Laki - Laki', 'T-Shirt', '2020-08-01', 'Jawa Barat', 'Bandung', 'Bandung Kulon', 'Cv.Holis Jl.Soekarno Hatta No.25 Gg.Nurkasim Rt02/Rw04 Holis Cibuntu Barat Bandung 40212'),
(494, '1be3bc', 2, 'Raso Irawan', '', '628122097145', 'Y', 'Laki - Laki', 'T-Shirt', '2020-08-01', 'Jawa Barat', 'Bandung', 'Bandung Kulon', 'Jl.Soekarno Hatta No 25 (Cv Holis) Gg Nurkasim Rt02/Rw04 Holis Cibuntu Barat Bandung 40212'),
(495, '350510', 2, 'IwanHermawan', '', '628122208468', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-07', 'Jawa Barat', 'Kuningan', 'Jalaksana', 'Jalan Raya Kuningan Cirebon No 43, Desa Maniskidul Rt 15 Rw 03, Kecamatan Jalaksana, Kabupaten Kuningan, Jawa Barat, 45554'),
(496, 'b534ba', 2, 'Rudy', '', '628122210022', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-22', 'Jawa Barat', 'Cirebon', 'Cirebon', 'Alamat : Perumahan Taman Cipto Blok C2 No 5\nKota : Cirebon\nJawa Barat'),
(497, '7380ad', 2, 'Yoga', '', '628122220902', 'Y', 'Laki - Laki', 'T-Shirt', '2019-08-19', 'Lampung', 'Lampung Tengah', 'Terbanggi Besar', 'Bandar Sari, Bandar Jaya Barat, Belakang Tb. Ali.'),
(498, '05f971', 2, 'Yoga', '', '628122220902', 'Y', 'Laki - Laki', 'T-Shirt', '2019-08-19', 'Lampung', 'Lampung Tengah', 'Terbanggi Besar', 'Rt/Rw 005/001, Desa Bandar Sari, Kel. Bandar Jaya Barat, Kec. Terbanggi Besar'),
(499, '3cf166', 2, 'DrgGinanjarAdhie', '', '628122231352', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-28', 'Jawa Tengah', 'Banjarnegara', 'Batur', 'Jl  Raya Batur No 35 Rt 02/Rw  01\nBatur, Banjarnegara Jawatengah\nKode Pos : 53456'),
(500, 'cee631', 2, 'ArdiPramudito', '', '628122269229', 'Y', 'Laki - Laki', 'T-Shirt', '2020-09-09', 'Jawa Barat', 'Cimahi', 'Cimahi Tengah', 'Komplek Taman Mutiara C2 No 19 Cimahi'),
(501, '5b69b9', 2, 'ArdiPramudito', '', '628122269229', 'Y', 'Laki - Laki', 'T-Shirt', '2020-09-09', 'Jawa Barat', 'Cimahi', 'Cimahi Tengah', 'Komplek Taman Mutiara C2 No 20 Cimahi 40523'),
(502, 'b5b41f', 2, 'IvonBebenTarliman', '', '628122283489', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-28', 'Jawa Barat', 'Tasikmalaya', 'Cihideung', 'Jl  Paseh No 87, Cihideung, Tasikmalaya'),
(503, '285e19', 2, 'AwaludinWa', '', '628122290705', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-05', 'Jawa Barat', 'Ciamis', 'Ciamis', 'Dinas Kb Kab Ciamis\nJl  Ahmad Yani No 38\n(Hubungi No Wa)'),
(504, 'b337e8', 2, 'Saiful', '', '628122373417', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-25', 'Jawa Barat', 'Bandung', 'Rancasari', 'Jl. Merkuri Utara Iii No.28 Rt.06 Rw.03 Kel. Manjahlega'),
(505, 'e8c065', 2, 'Saiful', '', '628122373417', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-25', 'Jawa Barat', 'Bandung', 'Rancasari', 'Jl. Merkuri Utara Iii No.28 Rt.06 Rw.03\nKel. Manjahlega'),
(506, 'ff4d5f', 2, 'HariCahyono', '', '628122551360', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-02', 'Jawa Tengah', 'Sragen', 'Plupuh', 'Pedak Rt 26/ Rw 12 Sambirejo, Plupuh, Sragen Jawa Tengah \nKode Pos 57283'),
(507, '2d6cc4', 2, 'Ferry', '', '628122568888', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-18', 'Jawa Tengah', 'Kudus', 'Kudus Kota', 'Jl  Kenari 18 Rt 02 Rw 03\nKota Kudus, Kab  Kudus, Jawa Tengah 59317'),
(508, '389bc7', 2, 'EkoSupriyati', '', '628122572773', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-06', 'Jawa Tengah', 'Semarang', 'Ambarawa', 'Salon Cantik, Jalan R A Kartini Tambakboyo, Rt 5/Rw 1, Tambakboyo, Ambarawa , Kab  Semarang, Ambarawa, Jawa Tengah, Id, 50612'),
(509, 'e2230b', 2, 'DwiHardjantoPedro', '', '628122633607', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-24', 'Jawa Tengah', 'Surakarta', 'Banjarsari', 'Pt Bank Cimb Niaga\nJl Slamet Riyadi 136 Timuran Banjarsari Surakarta'),
(510, '087408', 2, 'Guncar', '', '628122700717', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-22', 'Jawa Tengah', 'Purbalingga', 'Kalimanah', 'Dusun 2 Rt 02 Rw 04 Desa Karangpetir ,Kec  Kalimanah ,Purbalingga, Jawa Tengah\nKab  Purbalingga - Kalimanah\nJawa Tengah\nId 53371'),
(511, 'a76088', 2, 'Murdjaka Surya', '', '628122717410', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-22', 'Jawa Tengah', 'Magelang', 'Magelang Utara', 'Jl Duku Ii No 32 Rt 03 Rw 10 Kramat Magelang 56115'),
(512, '10a7cd', 2, 'FeriSapi', '', '628122750132', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-06', 'Jawa Tengah', 'Purworejo', 'Bener', 'Jl Magelang Km 14  Rt 04/05 Bener Kec Bener Kab Purworejo Jateng'),
(513, '3dc487', 2, 'DrIgnHapsoroWMsi', '', '628122801159', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-17', 'Jawa Barat', 'Cirebon', 'Mundu', 'Pamengkang Raya No 89 Blok Pon Rt6/Rw5 Kec Mundu Kab Cirebon{Tlpon Saat Diantar}'),
(514, '59b90e', 2, 'IswantoAdiSetyaUtomo', '', '628122805725', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-10', 'Jawa Tengah', 'Sukoharjo', 'Tawangsari', 'Iswanto Adi Setya Utomo 628122805725 Rumah Pak Iskandar, Dk  Tanjungsari Rt 02/Rw 06 Desa Tangkisan, Kab  Sukoharjo, Tawangsari, Jawa Tengah, Id, 5756'),
(515, '2b8a61', 2, 'Subagyo', '', '628122810909', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-18', 'Jawa Tengah', 'Semarang', 'Genuk', 'Jl.Kapas Timur, Gang Vii/ Blog G/ No. 1052. Perumahan Genuk Indah Semarang'),
(516, 'f3f27a', 2, 'LukmanDeddy', '', '628122848960', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-17', 'Jawa Tengah', 'Semarang', 'Semarang Barat', 'Jl  Abdulrahman Saleh No 63'),
(517, '38913e', 2, 'Yoga', '', '628122870221', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-22', 'Jawa Tengah', 'Magelang', 'Magelang Tengah', 'Jl. Sriwijaya No.5,Kel.Panjang, Magelang'),
(518, 'ebd962', 2, 'Yustinus Dodik Adiyanto', '', '628122878222', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-07', 'Jawa Tengah', 'Kudus', 'Bae', 'Perum Muria Indah A-442 Gondangmanis\nBae, Kab. Kudus, Jawa Tengah 59327'),
(519, '63538f', 2, 'AnangYulianto', '', '628122882800', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-22', 'Jawa Tengah', 'Semarang', 'Semarang Selatan', 'Jl Sriwijaya No 60'),
(520, 'cf6735', 2, 'Tukimin', '', '628122907917', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-05', 'Jawa Tengah', 'Semarang', 'Semarang Barat', 'D/A Pt. Meka Adipratama Semarang Jl. Puspowarno Tengah No. 7 - 11'),
(521, '07563a', 2, 'BambangY', '', '628122912090', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-27', 'Jawa Tengah', 'Semarang', 'Semarang Barat', 'Jl Taman Borobudur Timur 19 Nomer 19'),
(522, '53fde9', 2, 'FaldyHildan', '', '628122994654', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-18', 'Jawa Timur', 'Malang', 'Sukun', 'Jl  Keben Iia No  2, Kecamatan Sukun, Kelurahan Bandungrejosari, Malang (Depan Tk Permata Iman)'),
(523, '2bb232', 2, 'Tjipto Sunjaya', '', '628123019991', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-06', 'Jawa Timur', 'Mojokerto', 'Magersari', 'Karyawan Baru No.53 (Toko Sumber Jaya 2), Kota Mojokerto, Magersari, Jawa Timur, Id, 61312'),
(524, 'ba2fd3', 2, 'Wahyudi Andrion', '', '628123090709', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-28', 'Bali', 'Denpasar', 'Denpasar Selatan', 'Jalan Lantang Hidung No. 808 Finn, Sanur Kauh'),
(525, '69421f', 2, 'FranzvilosyaRizqi', '', '628123289494', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-16', 'Jawa Timur', 'Surabaya', 'Rungkut', 'Jalan Rungkut Asri Utara No  35 (Rungkut Lor Ii Blok G No  26) , Kota Surabaya, Rungkut, Jawa Timur'),
(526, '85422a', 2, 'Mas Nahar', '', '628123321332', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-30', 'Di Yogyakarta', 'Sleman', 'Depok', 'Perumahan Sari Asih, Jl  Pandega Asih Vi Blok G No G3 Rt16 Rw06, Manggung, Caturtunggal, Depok, Kab  Sleman, D I  Yogyakarta 55281'),
(527, '13f320', 2, 'D-Fandy', '', '628123398762', 'Y', 'Laki - Laki', 'T-Shirt', '2020-02-29', 'Jawa Timur', 'Malang', 'Kedungkandang', 'Jl Ki Ageng Gribig 377\nKec  Kedungkandang, Kel  Kedungkandang\nMalang, Jatim'),
(528, 'f4be00', 2, 'Fandy', '', '628123398762', 'Y', 'Laki - Laki', 'T-Shirt', '2020-02-29', 'Jawa Timur', 'Malang', 'Kedungkandang', 'Nama :Fandy\nNo Hp :08123398762\nAlamat : Jl Ki Ageng Gribig No 377\nKecamatan:Kedungkandang\nKota/Kab:Malang\nProvinsi:Jatim'),
(529, '37f0e8', 2, 'AdiKurniawan', '', '628123400985', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-16', 'Jawa Timur', 'Bojonegoro', 'Bojonegoro', 'Jl  Basuki Rahmat, Perum Graha Citra Harmoni C3, Kec  Bojonegoro, Kabupaten Bojonegoro, Jawa Timur, 62115'),
(530, 'd64a34', 2, 'Supartono', '', '628123408407', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-13', 'Jawa Timur', 'Bojonegoro', 'Bojonegoro', 'Jl. Serma Maun Gang Sukidin N0. 8 Kelurahan Banjarejo Kec./Kab. Bojonegoro Jawa Timur 62118'),
(531, '0fcbc6', 2, 'Obed', '', '628123518498', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-01', 'Jawa Timur', 'Surabaya', 'Sambikerep', 'Graha Natura A65'),
(532, '298f95', 2, 'AmanBuanaPutera', '', '628123542498', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-13', 'Jawa Timur', 'Surabaya', 'Sambikerep', 'Pakuwon Indah, Villa Bukit Regency 3, Blok Pe1, Nomor 62, 60216'),
(533, 'df877f', 2, 'DrBobiPrabowo', '', '628123569223', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-21', 'Jawa Timur', 'Malang', 'Dau', 'Jl  Villa Puncak Tidar Blok Ab No  46  Dau  Malang  Kode Pos 65151'),
(534, 'c39986', 2, 'BintangTandoyo', '', '628123626956', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-10', 'Nusa Tenggara Timur (Ntt)', 'Ngada', 'Bajawa', 'Bengkel Bintang Motor, Kab  Ngada, Bajawa, Nusa Tenggara Timur (Ntt), Id, 86411'),
(535, '33e807', 2, 'Wawan Gunawan', '', '628123845350', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-30', 'Bali', 'Denpasar', 'Denpasar Barat', 'Jalan Gunung Catur Iii No. 3 Dps 80117'),
(536, '65658f', 2, 'Bob', '', '628123921228', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-31', 'Bali', 'Badung', 'Kuta Selatan', 'Dfc Gym, Jln Kahuripan Iv, Ungasan, Kuta Selatan'),
(537, '5ea164', 2, 'Andra', '', '628123932287', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-03', 'Bali', 'Denpasar', 'Denpasar Barat', 'Jl P Nusa Penida No 10A, Sanglah'),
(538, '7bcdf7', 2, 'IWayanSuyadnya', '', '628123957878', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-19', 'Bali', 'Badung', 'Kuta Utara', 'Alamat Jl Raya Batu Bolong No 26A  Br Canggu, Ds Canggu  Kec Kuta Utara'),
(539, '573703', 2, 'FebbianaBatul', '', '628123989603', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-18', 'Nusa Tenggara Timur (Ntt)', 'Manggarai', 'Langke Rembong', 'Belakang Sdk Kumba 1 Ruteng, Depan Susteran Bps Kumba  , Kab  Manggarai, Langke Rembong, Nusa Tenggara Timur (Ntt), Id, 86511'),
(540, '9b72e3', 2, 'EvanImoliana', '', '628124055161', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-27', 'Papua', 'Jayapura', 'Abepura', '(Hubungi No Wa) \nKpr Bpd Blok K No 265 Furia Kotaraja Kelurahan Wahno 99225'),
(541, '16c222', 2, 'Nico Gara', '', '628124062232', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-13', 'Sulawesi Utara', 'Minahasa Tenggara', 'Ratahan', 'Lpa   Lingkungan 3 \nKel: Nataan'),
(542, '7dcd34', 2, 'HAhamadAli', '', '628124100845', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-11', 'Sulawesi Selatan', 'Makassar', 'Biring Kanaya', 'Jl Dg Ramang No 1 (Tk Hikmah Bangunan) Makassar Sul Sel Kec Biringkanya'),
(543, '814481', 2, 'Risky Hiskia Poluan', '', '628124109792', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-30', 'Dki Jakarta', 'Jakarta Pusat', 'Tanah Abang', 'Jl. Taman Rawa Pening Iv No. 4 Bendungan Hilir, 10210'),
(544, '97e852', 2, 'FittyValdiArie', '', '628124124281', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-25', 'Sulawesi Utara', 'Manado', 'Malalayang', 'Citra Land Crystal Park Ii No  28 \nWinangun \nKdpos : 95161'),
(545, '647bba', 2, 'Roger Karundeng', '', '628124127350', 'Y', 'Laki - Laki', 'T-Shirt', '2019-12-19', 'Sulawesi Utara', 'Manado', 'Mapanget', 'Pt. Angkasa Pura Suport, Jl. Mr. Aa. Maramis, Komp. Kantor Admin Bandara Sam Ratulangi Manado Mapanget Manado'),
(546, 'ed265b', 2, 'Roger Karundeng', '', '628124127350', 'Y', 'Laki - Laki', 'T-Shirt', '2019-12-19', 'Sulawesi Utara', 'Manado', 'Mapanget', 'Mr. Aa. Maramis Komp. Rumah Dinas Bandara Sam Ratulangi\nKantor : Pt. Angkasa Pura Suport'),
(547, 'c75b6f', 2, 'Yontak', '', '628124217338', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-15', 'Sulawesi Selatan', 'Kepulauan Selayar', 'Benteng', 'Jln Kha Dahlan No. 64\nKel. Benteng Selatan\nKode Pos: 92812'),
(548, '8d3420', 2, 'DewaDody', '', '628124631967', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-27', 'Bali', 'Denpasar', 'Denpasar Timur', 'Jl  Kenyeri Gg  Anggrek 1B No  10\nKelurahan Sumerta Kaja\n80236'),
(549, 'ccb1d4', 2, 'Putu Ramjaya', '', '628124666118', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-13', 'Bali', 'Klungkung', 'Klungkung', 'Toko Bangunan Karya Widana, Jln Rama 88 X.'),
(550, '01f78b', 2, 'Turah Wiratha', '', '628124671115', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-13', 'Bali', 'Tabanan', 'Tabanan', 'Jln Mt Haryono Pitstop Cafe Tabanan Bali'),
(551, '7f24d2', 2, 'Tahmijudin', '', '628125130269', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-14', 'Kalimantan Selatan', 'Banjarmasin', 'Banjarmasin Barat', 'Jl Pangeran M Noor No 1 Rt 40 Kelurahan Kuin Cerucuk Kecamatan Banjarmasin Barat Kotamadya Banjarmasin'),
(552, '94c7bb', 2, 'AhmadSyairoji', '', '628125165018', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-17', 'Kalimantan Selatan', 'Banjar', 'Martapura Kota', 'Jl  P  Abdul Rahman No89 Rt4 Rw22 Rasayangan Barat, Pelangi Aquarium\nWa 0822-5214-8928'),
(553, 'f38762', 2, 'IrwanGuniawan', '', '628125304019', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-25', 'Kalimantan Timur', 'Samarinda', 'Samarinda Kota', 'Jl  Kh  Ahmad Dahlan Rt Xi No 114 75117\n(Ruko 4 Pintu, Rollingdoor Warna Kuning)'),
(554, '5e3881', 2, 'Mark Dhany L', '', '628125318950', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-22', 'Sulawesi Selatan', 'Parepare', 'Soreang', 'Jl  Industri Kecil   No  98 ,\nRt 03 Rw 10  (Dekat Sd 70 Kota Parepare)\nKel : Bukit Ndah \nKdpos : 91132'),
(555, '15de21', 2, 'BapakEdson', '', '628125465129', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-24', 'Kalimantan Timur', 'Samarinda', 'Samarinda Kota', 'Jl  Niaga Selatan No 11 ( Toko Sidomulyo ) Kelurahan Pelabuhan Samarinda Kota Kalimantan Timur'),
(556, '11b921', 2, 'AnwarFarisi-Indra', '', '628125559123', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-04', 'Kalimantan Selatan', 'Banjarmasin', 'Banjarmasin Utara', 'Jl  Brigjen H Hasan Basri/Gg Sasamaan, Rt/Rw 040/003, No 38 Kel/Desa Alalak Utara, Kecamatan Banjarmasin Utara'),
(557, '6e2713', 2, 'Juhari', '', '628125575028', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-06', 'Kalimantan Selatan', 'Banjarmasin', 'Banjarmasin Barat', 'Jl Belitung Darat No 1 A \nBanjarmasin -Kalsel'),
(558, '1bb91f', 2, 'Riski Brasto Adi', '', '628125583725', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-03', 'Kalimantan Timur', 'Samarinda', 'Samarinda Ulu', 'Jalan Wiraguna Gg Gotong Royong No.28, Rt.5, Sidodadi, Samarinda Ulu, Kota Samarinda, Samarinda Ulu, Kalimantan Timur, Id'),
(559, '3a0772', 2, 'Tiara Anggarini', '', '628125741515', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-17', 'Kalimantan Barat', 'Pontianak', 'Pontianak Selatan', 'Jl. W.R Supratman No.40 (Gereja Ppik Bukit Zaitun), Kota Pontianak, Pontianak Selatan, Kalimantan Barat, Id 78122'),
(560, 'a9a665', 2, 'BahyatTalhouni', '', '628125841112', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-07', 'Kalimantan Timur', 'Balikpapan', 'Balikpapan Selatan', 'Ruko Balikpapan Baru Blok D2 No  20 Jl Mt Haryono, Kel Gunung Bahagia 76114'),
(561, '58ae74', 2, 'BahyatTalhouni', '', '628125841112', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-07', 'Kalimantan Timur', 'Balikpapan', 'Balikpapan Selatan', 'Ruko Balikpapan Baru Blok D2 No  20\nJl Mt Haryono, Kel Gunung Bahagia 76114'),
(562, '4e4b5f', 2, 'AriesH', '', '628125999567', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-18', 'Jawa Timur', 'Madiun', 'Manguharjo', 'Jl Trunjoyo No 151 ( Toko Usaha Tani ) Pandean'),
(563, '8eefcf', 2, 'AriesHS', '', '628125999567', 'Y', 'Laki - Laki', 'T-Shirt', '2020-07-18', 'Jawa Timur', 'Madiun', 'Manguharjo', 'Jln Trunojoyo No 151\nNambangan Kidul Kec  Manguharjo \nKota : Madiun'),
(564, '1728ef', 2, 'Suhendra', '', '628126073234', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-27', 'Sumatera Utara', 'Medan', 'Medan Amplas', 'Auto 2000 Amplas Parts Depo Medan\nJl. Sm. Raja Km 9.8 No. 204 Medan 20148'),
(565, 'cbcb58', 2, 'DarwisSoesanto', '', '628126075422', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-21', 'Sumatera Utara', 'Medan', 'Medan Kota', 'Pd Nefo - Jl  Pandu No  1G, Kota Medan, Medan Kota, Sumatera Utara, Id, 20212'),
(566, 'db85e2', 2, 'HadiSusanto', '', '628126091788', 'Y', 'Laki - Laki', 'T-Shirt', '2020-05-14', 'Sumatera Utara', 'Medan', 'Medan Timur', 'Asian Agri, Uniplaza, East Tower Lantai 7, Jl Letjen Mt Haryono No A-1, Kota Medan, Medan Timur, Sumatera Utara, Id, 20231'),
(567, '99c5e0', 2, 'HadiSusanto', '', '628126091788', 'Y', 'Laki - Laki', 'T-Shirt', '2020-05-14', 'Sumatera Utara', 'Medan', 'Medan Timur', 'Asian Agri, Uniplaza East Tower Lantai 7, Jl Letjen Mt Haryono No A-1'),
(568, 'dd4585', 2, 'GixsonRumapea', '', '628126092076', 'Y', 'Laki - Laki', 'T-Shirt', '2020-06-14', 'Sumatera Utara', 'Pematang Siantar', 'Siantar Utara', 'Jln  Siak No  65 \nKel  Martoba \nKode Pos 21143'),
(569, '8b16eb', 2, 'GixsonRumapea', '', '628126092076', 'Y', 'Laki - Laki', 'T-Shirt', '2020-06-14', 'Sumatera Utara', 'Pematang Siantar', 'Siantar Utara', 'Jl Siak No 65\nKelurahan Martoba\n21143'),
(570, 'a86c45', 2, 'AlbertJeremia', '', '628126476065', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-09', 'Sumatera Utara', 'Medan', 'Medan Tembung', '(Hubungi No Wa) \nJl  Taduan No  98 Medan\nDesa Sidorejo'),
(571, 'c9892a', 2, 'T Mursalim', '', '628126482026', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-29', 'Sumatera Utara', 'Medan', 'Medan Helvetia', 'Jl.Asrama No.9D Medan, Kota Medan'),
(572, 'e6b4b2', 2, 'Resonberth B  A  Panjaitan', '', '628126509897', 'Y', 'Laki - Laki', 'T-Shirt', '2021-10-02', 'Sumatera Utara', 'Medan', 'Medan Tuntungan', 'Jl Nilam Raya No. 127, Kota Medan, Medan Tuntungan, Sumatera Utara, Id, 20141'),
(573, 'e5f6ad', 2, 'DrEmirElNewi', '', '628126511357', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-01', 'Sumatera Utara', 'Medan', 'Medan Petisah', 'Jl  Jangka No  6, Sei Putih Barat, Medan - 20118'),
(574, 'f0e52b', 2, 'Alun', '', '628126559888', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-16', 'Sumatera Utara', 'Medan', 'Medan Perjuangan', 'Jalan Panglima No  8D,,  Kelurahan  Sei Kera Hilir I, Kec  Medan Perjuangan, Kota Medan, Sumatera Utara 20222'),
(575, 'ffeabd', 2, 'Hasbi', '', '628126693732', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-01', 'Sumatera Barat', 'Payakumbuh', 'Payakumbuh Utara', 'Bkpsdm Kota Payakumbuh, Jalan Jambu\nDesa Koto Kaciak Kubu Tapak Rajo\n(Hubungi No Wa)'),
(576, 'a7aeed', 2, 'Paulus Yozua Martheo', '', '628126729699', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-23', 'Riau', 'Pekanbaru', 'Senapelan', 'Jl  Riau Gang Riau Iii No  33\nKota Pekanbaru - Senapelan, Riau, 28155'),
(577, 'fde926', 2, 'HarryEkaPutra', '', '628126735489', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-07', 'Sumatera Barat', 'Padang', 'Padang Utara', 'Jln Khatib Sulaiman No 06A (Press Per Mobil Indoria), Kota Padang, Padang Utara, Sumatera Barat, Id, 25137'),
(578, 'a8849b', 2, 'EdoRendra', '', '628126803431', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-08', 'Riau', 'Rokan Hilir', 'Bangko', 'Jln Kecamatan Batu 6 (Kantor Bpbd), Kota Bagansiapiapi'),
(579, '258be1', 2, 'LukmanulHakim', '', '628126900515', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-13', 'Nanggroe Aceh Darussalam (Nad)', 'Banda Aceh', 'Baiturrahman', 'Jl  Sulaiman Daud No 28 A \nKelurahan : Peuniti\n(Hubungi No Wa)'),
(580, '069d3b', 2, 'Ipan', '', '628126900788', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-20', 'Dki Jakarta', 'Jakarta Timur', 'Kramat Jati', 'Jl  Batu Ampar 1, No  19 Rt 11/Rw 2\nKel  Batu Ampar, Kec  Kramat Jati, \nKota Jakarta Timur, \nDaerah Khusus Ibukota Jakarta \n13520'),
(581, 'c6e19e', 2, 'Reza Faisal', '', '628126916105', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-04', 'Nanggroe Aceh Darussalam (Nad)', 'Banda Aceh', 'Banda Raya', 'Toko Nuril / Ro Jln Sultan Malikussaleh Lamlagang Kec. Banda Raya Kota Banda Aceh'),
(582, '46922a', 2, 'DrAbdulRazakKi', '', '628126921036', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-10', 'Nanggroe Aceh Darussalam (Nad)', 'Aceh Timur', 'Idi Rayeuk', 'Rs Graha Bunda, Jl  B  Aceh - Medan, Buket Pala, Idi Rayeuk, Aceh Timur'),
(583, '9ad6aa', 2, 'HErfinShahNst', '', '628126933755', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-07', 'Sumatera Utara', 'Labuhanbatu Selatan', 'Kota Pinang', 'Jl  Kalapane Gg  Pancasila No  73, Kota Pinang 21464'),
(584, 'f5deae', 2, 'Kennardi', '', '628127012012', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-02', 'Banten', 'Tangerang Selatan', 'Serpong', 'Rumah Jendral Raden Budi Winarso,  Jalan Lengkong Gudang Timur 3 No 9A Rt 02 Rw 04, Jl  Raya Astek, Kec  Serpong, Tangerang Selatan, Banten, 15321'),
(585, 'a9a1d5', 2, 'KemasDediSyafrudin', '', '628127111711', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-02', 'Sumatera Selatan', 'Palembang', 'Ilir Timur Ii', 'Jalan Taman Kenten Lorong Sebatok Komplek Permata Taman Golf Blok G No  10'),
(586, '605ff7', 2, 'Renta Manik', '', '628127314190', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-22', 'Bangka Belitung', 'Belitung Timur', 'Manggar', 'Kompleks Perkantoran Terpadu Pemda Beltim (Bagian Lpse) Jalan Raya Manggar-Gantung Manggarawan Belitung Timur (33517)'),
(587, '766ebc', 2, 'BabaAkbar', '', '628127345979', 'Y', 'Laki - Laki', 'T-Shirt', '2021-02-23', 'Lampung', 'Bandar Lampung', 'Sukarame', 'Jalan Ryacudu Perumahan Korpri Blok B13 Nomor 19 Kelurahan Korpri Raya Kecamatan Sukarame Kota Bandar Lampung'),
(588, 'daca41', 2, 'FajarYulianto', '', '628127354359', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-20', 'Sumatera Selatan', 'Musi Banyuasin', 'Sungai Lilin', 'Dusun 3, Rt 09, Desa Sumber Rezeki ( Blok C ) (Dusun 3, Rt 09, Desa Sumber Rezeki), Kab  Musi Banyuasin, Sungai Lilin, Sum'),
(589, '30bb38', 2, 'Saut Maruli Panggabean', '', '628127357333', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-16', 'Bengkulu', 'Bengkulu', 'Gading Cempaka', 'Gereja Gekisia Sadang 2 No 1 Rt 07 Rw 02 Kel Lingkar Barat Gading Cempaka Bengkulu'),
(590, '08b255', 2, 'Riky', '', '628127534293', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-06', 'Riau', 'Pekanbaru', 'Sukajadi', 'Jl. Durian 61/19 Rt 003 Rw.001 Kampung Tengah, Sukajadi, Pekanbaru 28128.'),
(591, '349389', 2, 'Riki', '', '628127543784', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-16', 'Jawa Barat', 'Depok', 'Tapos', 'Jln.Raya Pekapuran Rt 04/06 No.2C(Simpang Dongkal) Kel Sukamaju'),
(592, 'dbe272', 2, 'Max Hendrik N', '', '628127575468', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-29', 'Kalimantan Timur', 'Kutai Timur', 'Sangkulirang', 'Pt Wira Inova Nusantara Balkin Segara Desa Pridan Kecamatan Sangkulirang Kabupaten Kutai Timur Kalimantan Timur'),
(593, 'acc3e0', 2, 'Tegar Indrayana', '', '628127601246', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-30', 'Riau', 'Pekanbaru', 'Rumbai Pesisir', 'Apotek Al-Fakih, Jalan Yos Sudarso No 684, Kec. Rumbai Pesisir, Kota Pekanbaru,'),
(594, '076a0c', 2, 'AipddiCandra', '', '628127624496', 'Y', 'Laki - Laki', 'T-Shirt', '2020-08-23', 'Riau', 'Indragiri Hulu', 'Rengat Barat', 'Samsat Indragiri Hulu\nJl Raya Rengat Pematang Reba'),
(595, '04ecb1', 2, 'AipddiChandra', '', '628127624496', 'Y', 'Laki - Laki', 'T-Shirt', '2020-08-23', 'Riau', 'Indragiri Hulu', 'Rengat Barat', 'Kantor Samsat Inhu Jl Raya Rengat P Reba Kec Rengat Barat Kab Indragiri Hulu Prov  Riau'),
(596, 'b2eeb7', 2, 'Afrizal', '', '628127636701', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-28', 'Riau', 'Dumai', 'Dumai Timur', 'Kantor Kesehatan Pelabuhan Kelas Iii Dumai\nJalan Datuk Laksamana\nKelurahan Buluh Kasab'),
(597, '08c543', 2, 'Abie', '', '628127649358', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-10', 'Riau', 'Pekanbaru', 'Tampan', 'Jl Hrs Subrantas No 3/5 Toko Panam Jaya(500Mtr Dari Hotel Mona Sebelah Alfamart)Rt 06 Rw 09 Kec Tampan Kota Pekanbaru'),
(598, '6aca97', 2, 'Ray Rizky', '', '628127731664', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-31', 'Banten', 'Tangerang', 'Tigaraksa', 'Kampung Bolang Desa Pasir Bolang Rt 003 / Rw 001 Rm Sikumbang'),
(599, '3435c3', 2, 'Muhd Zabur', '', '628127743001', 'Y', 'Laki - Laki', 'T-Shirt', '2021-07-02', 'Kepulauan Riau', 'Karimun', 'Karimun', 'Perum Taman Melia Indah/Laixing Blok R No 15 Kapling Kecamatan Karimun,Kab Karimun,Kepulauan Riau 29611'),
(600, 'd490d7', 2, 'Dedy', '', '628127794834', 'Y', 'Laki - Laki', 'T-Shirt', '2021-06-17', 'Kepulauan Riau', 'Karimun', 'Kundur', 'Sma 2 Kundur \nPro  Kepri\nKode Pos 29662'),
(601, 'b2f627', 2, 'AnggiAditya', '', '628127853915', 'Y', 'Laki - Laki', 'T-Shirt', '2021-09-19', 'Sumatera Utara', 'Deli Serdang', 'Tanjung Morawa', 'Jln Tirta Deli Gang Alfalah No Rumah 24 Tanjung Morawa A, Kab  Deli Serdang, Tanjung Morawa, Sumatera Utara, Id, 20362'),
(602, 'c3992e', 2, 'AdetyaAgungKBawono', '', '628127857200', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-23', 'Dki Jakarta', 'Jakarta Timur', 'Kramat Jati', 'Gedung B Lantai 3, Divisi Accounting & Tax Group, Kantor Pusat Pt Jasa Marga Plaza Tol Tmii Jakarta Timur 13550'),
(603, 'd86ea6', 2, 'HendryKusumo', '', '628127877887', 'Y', 'Laki - Laki', 'T-Shirt', '2021-05-23', 'Jawa Tengah', 'Pemalang', 'Taman', 'Komplek Bale Agung Banjardawa No  A 20 Jl  Dr  Wahidin, Kec  Taman Kabupaten Pemalang, Jawa Tengah 52361'),
(604, '9cf81d', 2, 'Pudji Lestanto', '', '628127969572', 'Y', 'Laki - Laki', 'T-Shirt', '2021-01-29', 'Dki Jakarta', 'Jakarta Utara', 'Cilincing', 'Asrama Airud Blok C4 No5 Rtoo5 Rw009 Kec.Cilincing Kel.Semper Timur'),
(605, 'c361bc', 2, 'IwanSurjadi', '', '628128019613', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-07', 'Banten', 'Tangerang Selatan', 'Ciputat', 'Jl  Gelatik 1 No 192 Rt 003/03, Kel  Sawah, Ciputat, Kota Tangerang Selatan, Ciputat, Banten, Id, 15413'),
(606, '44c4c1', 2, 'BobbyPramana', '', '628128028298', 'Y', 'Laki - Laki', 'T-Shirt', '2021-04-19', 'Banten', 'Tangerang Selatan', 'Pamulang', 'Komplek Taman Kedaung, Jalan Kemuning X Blok F6 No 29 , Kedaung Pamulang, Tangerang Selatan 15415\nPamulang, Kab  Tangerang, Banten 15415'),
(607, 'dc82d6', 2, 'Gunarso', '', '628128155546', 'Y', 'Laki - Laki', 'T-Shirt', '2021-08-12', 'Banten', 'Cilegon', 'Cibeber', 'Perum Gedong Cilegon Damai Blok C23 No  04 - Cibeber - Cilegon -42424'),
(608, '996a7f', 2, 'BahruSetia', '', '628128169368', 'Y', 'Laki - Laki', 'T-Shirt', '2021-03-13', 'Dki Jakarta', 'Jakarta Utara', 'Kelapa Gading', 'Kokan Permata Blok A No 21 Jln  Bukit Gading Raya, Kelapa Gading Jakarta Utara\nKelapa Gading, Jakarta Utara 14240, Dki Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cust_batch`
--

CREATE TABLE `tb_cust_batch` (
  `cust_batch_id` int(11) NOT NULL,
  `cust_batch_name` varchar(255) DEFAULT NULL,
  `cust_file_name` varchar(100) NOT NULL,
  `cust_file_path` varchar(255) NOT NULL,
  `cust_batch_count_upload` int(11) NOT NULL,
  `cust_batch_date_created` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_cust_batch`
--

INSERT INTO `tb_cust_batch` (`cust_batch_id`, `cust_batch_name`, `cust_file_name`, `cust_file_path`, `cust_batch_count_upload`, `cust_batch_date_created`) VALUES
(1, 'CUSTOMER_ANIME', 'CUSTOMER_ANIME.csv', 'public/csv/CUSTOMER_ANIME.csv', 10, '2021-12-25 17:37:57'),
(2, 'CUSTOMER_KARTUN', 'CUSTOMER_KARTUN.csv', 'public/csv/CUSTOMER_KARTUN.csv', 598, '2021-12-25 17:38:16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_landing`
--

CREATE TABLE `tb_landing` (
  `landing_id` int(11) NOT NULL,
  `landing_name` varchar(255) DEFAULT NULL,
  `landing_fb_pixel` text DEFAULT NULL,
  `landing_google_tag` text DEFAULT NULL,
  `landing_slug` varchar(255) DEFAULT NULL,
  `landing_product_list_id` int(11) DEFAULT NULL,
  `landing_date_created` datetime DEFAULT NULL,
  `landing_status` enum('N','Y') DEFAULT NULL,
  `landing_header_img_url` varchar(255) NOT NULL,
  `landing_header_img_url_mobile` varchar(255) NOT NULL,
  `landing_hedaer_content` text NOT NULL,
  `landing_body_content_1` text NOT NULL,
  `landing_body_content_2` text NOT NULL,
  `landing_body_content_3` text NOT NULL,
  `landing_body_content_4` text NOT NULL,
  `landing_body_content_5` text NOT NULL,
  `landing_footer_img_url` varchar(255) NOT NULL,
  `landing_footer_img_url_mobile` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_landing`
--

INSERT INTO `tb_landing` (`landing_id`, `landing_name`, `landing_fb_pixel`, `landing_google_tag`, `landing_slug`, `landing_product_list_id`, `landing_date_created`, `landing_status`, `landing_header_img_url`, `landing_header_img_url_mobile`, `landing_hedaer_content`, `landing_body_content_1`, `landing_body_content_2`, `landing_body_content_3`, `landing_body_content_4`, `landing_body_content_5`, `landing_footer_img_url`, `landing_footer_img_url_mobile`) VALUES
(1, 'Landing Kartun', 'fb pixel', 'google tag', 'ondel', NULL, NULL, 'Y', 'public/photo/pngegg5.png', '', 'header content', '<p>body 1</p>', '<p>body 2</p>', '<p>body 3</p>', '', '', '', ''),
(2, 'Landing Anime', 'fb tag', 'gtag', 'anime', NULL, NULL, 'Y', 'public/photo/50015413.jpg', 'public/photo/pngegg6.png', 'content header edit', '<h1>content 1 edit</h1>', '<p><strong>content 2 edit</strong></p>', '<p><em><strong>content 3 edit</strong></em></p>', '', '', '', ''),
(3, 'Sample Landing', '', '', 'sample-landing', NULL, NULL, 'Y', 'public/photo/new_bg.jpg', 'public/photo/mobile_bg.jpg', '                    <h4 class=\"h4-medium\">Dapatkan Kaos kualitas <span style=\"color: rgb(194, 13, 13)\">PREMIUM</span>  hanya di ISAMU.ID</h4>\r\n                    <p class=\"p-large\">Kami adalah produsen T-Shirt dengan desain kekinian dan diproduksi dengan jumlah terbatas</p>\r\n                    <a class=\"btn-solid-lg\" href=\"#\">Dapatkan PROMO Sekarang!!!</a>', '<div class=\"row\">\r\n<div class=\"col-lg-12 mb-5\">\r\n<h4 class=\"mb-2\">Kamu pernah mengalami hal seperti ini?</h4>\r\n<div style=\"margin: auto; height: 2px; width: 30px; border-bottom: solid 5px #c20d0d;\">&nbsp;</div>\r\n</div>\r\n<div class=\"col-lg-12\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-3 col-md-6 col-12 mb-4\" style=\"padding: 5px;\">\r\n<div class=\"single-work\">\r\n<div class=\"serial\"><img class=\"img-thumbnail\" src=\"../../../public/media/img_content_1_1.jpg\" width=\"800\" height=\"800\" /></div>\r\n<h3 class=\"mt-3 mb-3\">Cetakan gampang terkelupas setelah dicuci berulang kali</h3>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-3 col-md-6 col-12 mb-4\" style=\"padding: 5px;\">\r\n<div class=\"single-work\">\r\n<div class=\"serial\"><img class=\"img-thumbnail\" src=\"../../../public/media/img_content_1_2.jpg\" width=\"800\" height=\"800\" /></div>\r\n<h3 class=\"mt-3 mb-3\">Bahan panas saat digunakan dan tidak menyerap keringat</h3>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-3 col-md-6 col-12 mb-4\" style=\"padding: 5px;\">\r\n<div class=\"single-work\">\r\n<div class=\"serial\"><img class=\"img-thumbnail\" src=\"../../../public/media/img_content_1_3.jpg\" width=\"800\" height=\"800\" /></div>\r\n<h3 class=\"mt-3 mb-3\">Cepat melar atau malah menyusut setelah dicuci</h3>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-3 col-md-6 col-12 mb-4\" style=\"padding: 5px;\">\r\n<div class=\"single-work\">\r\n<div class=\"serial\"><img class=\"img-thumbnail\" src=\"../../../public/media/img_content_1_4.jpg\" width=\"800\" height=\"800\" /></div>\r\n<h3 class=\"mt-3 mb-3\">Malu karena ketemu orang dengan desain kaos sama</h3>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- end of col --></div>\r\n<!-- end of row -->\r\n<p>&nbsp;</p>', '<div class=\"row justify-content-md-center mt-1\">\r\n<div class=\"col-lg-8\">\r\n<h4 class=\"mt-5\">Masalah itu bisa kamu hindari!!!!</h4>\r\n</div>\r\n<div class=\"col-lg-8 mb-4 mt-4\">\r\n<p class=\"p-large\">Tampil beda &amp; penuh percaya diri didepan banyak orang</p>\r\n<p class=\"p-medium\">Kami berikan solusi ampuh untuk mengatasinya. Telah banyak orang terbantu dan tidak lagi menghadapi permasalahan yang sama.</p>\r\n<a id=\"cta_unboxing\" class=\"btn-solid-lg mt-4\" href=\"https://api.whatsapp.com/send?phone=6281211770553&amp;text=Hallo%20Packlagi,%20Saya%20mau%20konsultasi%20pembuatan%20HARDBOX%20agar%20produk%20lebih%20menarik%20saat%20UNBOXING.\" target=\"_blank\" rel=\"noopener\">Tampil Beda Sekarang!!!</a></div>\r\n</div>\r\n<!-- end of row -->\r\n<p>&nbsp;</p>', '<div class=\"row\">\r\n<div class=\"col-lg-12 mb-5\">\r\n<h4 class=\"mb-2\">Dapatkan kesempatan terbatas terbatas ini</h4>\r\n<div style=\"margin: auto; height: 2px; width: 30px; border-bottom: solid 5px #c20d0d;\">&nbsp;</div>\r\n</div>\r\n<div class=\"col-lg-12\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-3 col-md-6 col-12 mb-4\" style=\"padding: 5px;\">\r\n<div class=\"single-work\">\r\n<div class=\"serial\"><img class=\"img-thumbnail\" src=\"../../../public/media/img_content_2_1.jpg\" width=\"800\" height=\"800\" /></div>\r\n<h3 class=\"mt-3 mb-3\">Bahan elastis sehingga tidak mudah melar walaupun pemakain berulang-ulang</h3>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-3 col-md-6 col-12 mb-4\" style=\"padding: 5px;\">\r\n<div class=\"single-work\">\r\n<div class=\"serial\"><img class=\"img-thumbnail\" src=\"../../../public/media/img_content_2_2.jpg\" width=\"800\" height=\"800\" /></div>\r\n<h3 class=\"mt-3 mb-3\">Lembut dan sangat nyaman saat dipakai apapun aktifitasnya</h3>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-3 col-md-6 col-12 mb-4\" style=\"padding: 5px;\">\r\n<div class=\"single-work\">\r\n<div class=\"serial\"><img class=\"img-thumbnail\" src=\"../../../public/media/img_content_2_3.jpg\" width=\"800\" height=\"800\" /></div>\r\n<h3 class=\"mt-3 mb-3\">Bahan menyerap keringat sehingga mengurangi kuman penyebab gatal pada kulit</h3>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-3 col-md-6 col-12 mb-4\" style=\"padding: 5px;\">\r\n<div class=\"single-work\">\r\n<div class=\"serial\"><img class=\"img-thumbnail\" src=\"../../../public/media/img_content_2_4.jpg\" width=\"800\" height=\"800\" /></div>\r\n<h3 class=\"mt-3 mb-3\">Desain sangat limited hanya untuk kamu yang ingin tampil beda</h3>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- end of col --></div>\r\n<!-- end of row -->\r\n<p>&nbsp;</p>', '<div class=\"row justify-content-md-center mt-1\">\r\n<div class=\"col-lg-8\">\r\n<h4 class=\"mt-5\">ISAMU.ID hanya memberikan produk spesial untuk kamu!!!</h4>\r\n</div>\r\n<div class=\"col-lg-8 mb-4 mt-4\">\r\n<p class=\"p-large\">Kenapa kamu harus ambil kesempatan ini? Karena di sini kamu berhak untuk mendapatkan produk spesial berupa :</p>\r\n</div>\r\n</div>\r\n<!-- end of row -->\r\n<div class=\"col-lg-12\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-4 col-md-6 col-12 mb-4\">\r\n<div class=\"single-work\">\r\n<div class=\"serial\"><img class=\"img-thumbnail\" src=\"../../../public/media/img_content_4_1.jpg\" width=\"1200\" height=\"699\" /></div>\r\n<p class=\"p-medium\" style=\"padding-left: 10px; padding-right: 10px;\">Design kaos Exclusive, Dibuat sepenuh hati dan penuh perhatian sehingga produk yang di hasilkan merupakan produk unggulan!</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-6 col-12 mb-4\">\r\n<div class=\"single-work\">\r\n<div class=\"serial\"><img class=\"img-thumbnail\" src=\"../../../public/media/img_content_4_2.jpg\" width=\"1200\" height=\"699\" /></div>\r\n<p class=\"p-medium\" style=\"padding-left: 10px; padding-right: 10px;\">Kami Melakukan Pencetakan Mengunakan Tinta Khusus yang Hanya Diproduksi di Eropa dengan kualitas Tinta Yang Premium</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-6 col-12 mb-4\">\r\n<div class=\"single-work\">\r\n<div class=\"serial\"><img class=\"img-thumbnail\" src=\"../../../public/media/img_content_4_3.jpg\" width=\"1200\" height=\"699\" /></div>\r\n<p class=\"p-medium\" style=\"padding-left: 10px; padding-right: 10px;\">Produk Kami Terbatas, Dan merupakan Produk <strong>Fresh From the Oven</strong>, yang berarti <strong>Pesan hari ini produksi hari ini bukan barang ready stok berbulan bulan</strong></p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '<div class=\"row\">\r\n<div class=\"col-lg-12\">\r\n<h4 class=\"h2-heading mb-5\" style=\"color: white;\">Dapatkan DISKON <span style=\"color: red;\">20%</span> <br />Khusus untuk minggu ini!!!<br />Hanya untuk 3 pembeli pertama</h4>\r\n<div style=\"margin: auto; text-align: center;\"><a id=\"cta_free_open\" class=\"btn-solid-lg\" href=\"#\" data-toggle=\"modal\" data-target=\"#exampleModal\">Ambil Kaos Sekarang!!!</a></div>\r\n</div>\r\n</div>', 'public/photo/bg-moblie-footer.jpg', 'public/photo/bg-moblie-footer1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_media`
--

CREATE TABLE `tb_media` (
  `media_id` int(11) NOT NULL,
  `media_url` varchar(255) DEFAULT NULL,
  `media_name` varchar(255) DEFAULT '',
  `media_type` varchar(255) DEFAULT NULL,
  `media_created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_media`
--

INSERT INTO `tb_media` (`media_id`, `media_url`, `media_name`, `media_type`, `media_created_date`) VALUES
(5, 'public/media/img_content_4_3.jpg', 'img_content_4_3.jpg', 'image/jpeg', NULL),
(6, 'public/media/img_content_4_2.jpg', 'img_content_4_2.jpg', 'image/jpeg', NULL),
(7, 'public/media/img_content_4_1.jpg', 'img_content_4_1.jpg', 'image/jpeg', NULL),
(8, 'public/media/img_content_2_4.jpg', 'img_content_2_4.jpg', 'image/jpeg', NULL),
(9, 'public/media/img_content_2_3.jpg', 'img_content_2_3.jpg', 'image/jpeg', NULL),
(10, 'public/media/img_content_2_2.jpg', 'img_content_2_2.jpg', 'image/jpeg', NULL),
(12, 'public/media/img_content_2_1.jpg', 'img_content_2_1.jpg', 'image/jpeg', NULL),
(13, 'public/media/img_content_1_4.jpg', 'img_content_1_4.jpg', 'image/jpeg', NULL),
(14, 'public/media/img_content_1_3.jpg', 'img_content_1_3.jpg', 'image/jpeg', NULL),
(15, 'public/media/img_content_1_2.jpg', 'img_content_1_2.jpg', 'image/jpeg', NULL),
(16, 'public/media/img_content_1_1.jpg', 'img_content_1_1.jpg', 'image/jpeg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_niche`
--

CREATE TABLE `tb_niche` (
  `niche_id` int(11) NOT NULL,
  `niche_name` varchar(255) DEFAULT NULL,
  `niche_desc` varchar(255) DEFAULT NULL,
  `niche_img_url` varchar(255) DEFAULT NULL,
  `niche_date_created` datetime DEFAULT NULL,
  `niche_status` enum('Y','N') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_niche`
--

INSERT INTO `tb_niche` (`niche_id`, `niche_name`, `niche_desc`, `niche_img_url`, `niche_date_created`, `niche_status`) VALUES
(1, 'Anime', 'market niche sample', NULL, '2021-12-12 20:59:11', 'Y'),
(4, 'ONdel', 'ondel', NULL, NULL, 'Y'),
(5, 'Sample', 'Sample', 'public/photo/logo1.png', NULL, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(255) DEFAULT NULL,
  `prod_code` varchar(10) DEFAULT NULL,
  `prod_sku` varchar(10) DEFAULT NULL,
  `prod_price` varchar(20) NOT NULL,
  `prod_price_disc` varchar(20) NOT NULL,
  `prod_desc` varchar(255) DEFAULT NULL,
  `prod_img_id` int(11) DEFAULT NULL,
  `prod_img_mockup_url` varchar(255) DEFAULT NULL,
  `prod_img_banner_url` varchar(255) NOT NULL,
  `prod_img_design_url` varchar(255) NOT NULL,
  `prod_status` enum('N','Y') DEFAULT NULL,
  `prod_date_created` datetime DEFAULT current_timestamp(),
  `prod_cat_id` int(11) DEFAULT NULL,
  `prod_niche_id` int(11) DEFAULT NULL,
  `prod_mp_link_1` varchar(255) DEFAULT NULL,
  `prod_mp_link_2` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`prod_id`, `prod_name`, `prod_code`, `prod_sku`, `prod_price`, `prod_price_disc`, `prod_desc`, `prod_img_id`, `prod_img_mockup_url`, `prod_img_banner_url`, `prod_img_design_url`, `prod_status`, `prod_date_created`, `prod_cat_id`, `prod_niche_id`, `prod_mp_link_1`, `prod_mp_link_2`) VALUES
(25, 'adsad', 'asdasdasd', 'asdaasd', 'asda', 'wrte67', 'asdas', NULL, 'public/photo/pngegg2.png', '', '', 'Y', '2021-12-17 15:56:09', 2, 4, 'asdasd', 'asdasd'),
(26, 'scsc', 'asc', 'acs', 'acs', 'acs', 'asc', NULL, '', '', '', 'Y', '2021-12-17 16:13:19', 1, 1, 'asc', 'asc'),
(27, 'sca', 'asc', 'asc', 'vsdvds', 'sdvds', 'acs', NULL, '', '', '', 'Y', '2021-12-17 16:13:29', 1, 1, 'acsc', 'ascas'),
(28, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 17:10:40', 1, 4, 'https://www.tokopedia.com/brotherholicstor/kaos-import-lengan-pendek-pria-baju-pria-import-polos-kaos-putih', 'https://www.tokopedia.com/brotherholicstor/kaos-import-lengan-pendek-pria-baju-pria-import-polos-kaos-putih\rKaos Game'),
(29, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 18:48:53', 1, 4, 'tokped', 'tokped'),
(30, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 18:48:53', 1, 1, 'tokped', 'tokped'),
(31, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 18:48:53', 1, 4, 'tokped', 'tokped'),
(32, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 18:48:53', 1, 1, 'tokped', 'tokped'),
(20, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', NULL, 'public/photo/5001541.jpg', 'public/photo/pngegg.png', 'public/photo/png-clipart-geisha-japanese-art-japan-fictional-character-flower.png', 'Y', '2021-12-15 12:02:57', 1, 4, 'https://www.tokopedia.com/soundcorebyanker/bundling-speaker-soundcore-flare-s-plus-a3163-soundcore-r500-a3213', 'https://www.tokopedia.com/soundcorebyanker/bundling-speaker-soundcore-flare-s-plus-a3163-soundcore-r500-a3213'),
(21, 'Kaos Game', 'GM001', 'GM001', '60000', '70000', 'Kaos Game', NULL, 'public/photo/png-clipart-geisha-japanese-art-japan-fictional-character-flower1.png', 'public/photo/pngegg1.png', 'public/photo/50015411.jpg', 'Y', '2021-12-15 12:38:20', 1, 1, 'tokped', 'shopee'),
(33, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 18:48:53', 1, 4, 'tokped', 'tokped'),
(34, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 18:48:53', 1, 1, 'tokped', 'tokped'),
(35, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 18:48:53', 1, 4, 'tokped', 'tokped'),
(36, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 18:48:53', 1, 1, 'tokped', 'tokped'),
(37, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 18:48:53', 1, 4, 'tokped', 'tokped'),
(38, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 18:48:53', 1, 1, 'tokped', 'tokped'),
(39, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 18:48:53', 1, 4, 'tokped', 'tokped'),
(40, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 18:48:53', 1, 1, 'tokped', 'tokped'),
(41, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 18:48:53', 1, 4, 'tokped', 'tokped'),
(42, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 18:48:53', 1, 1, 'tokped', 'tokped'),
(43, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 18:48:53', 1, 4, 'tokped', 'tokped'),
(44, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 18:48:53', 1, 1, 'tokped', 'tokped'),
(45, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 18:48:53', 1, 4, 'tokped', 'tokped'),
(46, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 18:48:53', 1, 1, 'tokped', 'tokped'),
(47, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 18:48:53', 1, 4, 'tokped', 'tokped'),
(48, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 18:48:53', 1, 1, 'tokped', 'tokped'),
(49, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 19:57:54', 1, 4, 'tokped', 'tokped'),
(50, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 19:57:54', 1, 1, 'tokped', 'tokped'),
(51, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 19:57:54', 1, 4, 'tokped', 'tokped'),
(52, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 19:57:54', 1, 1, 'tokped', 'tokped'),
(53, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 19:57:54', 1, 4, 'tokped', 'tokped'),
(54, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 19:57:54', 1, 1, 'tokped', 'tokped'),
(55, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 19:57:54', 1, 4, 'tokped', 'tokped'),
(56, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 19:57:54', 1, 1, 'tokped', 'tokped'),
(57, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 19:57:54', 1, 4, 'tokped', 'tokped'),
(58, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 19:57:54', 1, 1, 'tokped', 'tokped'),
(59, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 19:57:54', 1, 4, 'tokped', 'tokped'),
(60, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 19:57:54', 1, 1, 'tokped', 'tokped'),
(61, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 19:57:54', 1, 4, 'tokped', 'tokped'),
(62, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 19:57:54', 1, 1, 'tokped', 'tokped'),
(63, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 19:57:54', 1, 4, 'tokped', 'tokped'),
(64, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 19:57:54', 1, 1, 'tokped', 'tokped'),
(65, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 19:57:54', 1, 4, 'tokped', 'tokped'),
(66, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 19:57:54', 1, 1, 'tokped', 'tokped'),
(67, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 19:57:54', 1, 4, 'tokped', 'tokped'),
(68, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 19:57:54', 1, 1, 'tokped', 'tokped'),
(69, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:08', 1, 4, 'tokped', 'tokped'),
(70, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:08', 1, 1, 'tokped', 'tokped'),
(71, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:08', 1, 4, 'tokped', 'tokped'),
(72, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:08', 1, 1, 'tokped', 'tokped'),
(73, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:08', 1, 4, 'tokped', 'tokped'),
(74, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:08', 1, 1, 'tokped', 'tokped'),
(75, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:08', 1, 4, 'tokped', 'tokped'),
(76, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:08', 1, 1, 'tokped', 'tokped'),
(77, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:08', 1, 4, 'tokped', 'tokped'),
(78, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:08', 1, 1, 'tokped', 'tokped'),
(79, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:08', 1, 4, 'tokped', 'tokped'),
(80, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:08', 1, 1, 'tokped', 'tokped'),
(81, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:08', 1, 4, 'tokped', 'tokped'),
(82, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:08', 1, 1, 'tokped', 'tokped'),
(83, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:08', 1, 4, 'tokped', 'tokped'),
(84, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:08', 1, 1, 'tokped', 'tokped'),
(85, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:08', 1, 4, 'tokped', 'tokped'),
(86, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:08', 1, 1, 'tokped', 'tokped'),
(87, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:08', 1, 4, 'tokped', 'tokped'),
(88, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:08', 1, 1, 'tokped', 'tokped'),
(89, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:25', 1, 4, 'tokped', 'tokped'),
(90, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:25', 1, 1, 'tokped', 'tokped'),
(91, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:25', 1, 4, 'tokped', 'tokped'),
(92, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:25', 1, 1, 'tokped', 'tokped'),
(93, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:25', 1, 4, 'tokped', 'tokped'),
(94, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:25', 1, 1, 'tokped', 'tokped'),
(95, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:25', 1, 4, 'tokped', 'tokped'),
(96, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:25', 1, 1, 'tokped', 'tokped'),
(97, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:25', 1, 4, 'tokped', 'tokped'),
(98, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:25', 1, 1, 'tokped', 'tokped'),
(99, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:25', 1, 4, 'tokped', 'tokped'),
(100, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:25', 1, 1, 'tokped', 'tokped'),
(101, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:25', 1, 4, 'tokped', 'tokped'),
(102, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:25', 1, 1, 'tokped', 'tokped'),
(103, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:25', 1, 4, 'tokped', 'tokped'),
(104, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:25', 1, 1, 'tokped', 'tokped'),
(105, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:25', 1, 4, 'tokped', 'tokped'),
(106, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:25', 1, 1, 'tokped', 'tokped'),
(107, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:01:25', 1, 4, 'tokped', 'tokped'),
(108, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:01:25', 1, 1, 'tokped', 'tokped'),
(109, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:02:55', 1, 4, 'tokped', 'tokped'),
(110, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:02:55', 1, 1, 'tokped', 'tokped'),
(111, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:02:55', 1, 4, 'tokped', 'tokped'),
(112, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:02:55', 1, 1, 'tokped', 'tokped'),
(113, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:02:55', 1, 4, 'tokped', 'tokped'),
(114, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:02:55', 1, 1, 'tokped', 'tokped'),
(115, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:02:55', 1, 4, 'tokped', 'tokped'),
(116, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:02:55', 1, 1, 'tokped', 'tokped'),
(117, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:02:55', 1, 4, 'tokped', 'tokped'),
(118, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:02:55', 1, 1, 'tokped', 'tokped'),
(119, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:02:55', 1, 4, 'tokped', 'tokped'),
(120, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:02:55', 1, 1, 'tokped', 'tokped'),
(121, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:02:55', 1, 4, 'tokped', 'tokped'),
(122, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:02:55', 1, 1, 'tokped', 'tokped'),
(123, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:02:55', 1, 4, 'tokped', 'tokped'),
(124, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:02:55', 1, 1, 'tokped', 'tokped'),
(125, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:02:55', 1, 4, 'tokped', 'tokped'),
(126, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:02:55', 1, 1, 'tokped', 'tokped'),
(127, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:02:55', 1, 4, 'tokped', 'tokped'),
(128, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:02:55', 1, 1, 'tokped', 'tokped'),
(129, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:03:15', 1, 4, 'tokped', 'tokped'),
(130, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:03:15', 1, 1, 'tokped', 'tokped'),
(131, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:03:15', 1, 4, 'tokped', 'tokped'),
(132, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:03:15', 1, 1, 'tokped', 'tokped'),
(133, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:03:15', 1, 4, 'tokped', 'tokped'),
(134, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:03:15', 1, 1, 'tokped', 'tokped'),
(135, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:03:15', 1, 4, 'tokped', 'tokped'),
(136, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:03:15', 1, 1, 'tokped', 'tokped'),
(137, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:03:15', 1, 4, 'tokped', 'tokped'),
(138, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:03:15', 1, 1, 'tokped', 'tokped'),
(139, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:03:15', 1, 4, 'tokped', 'tokped'),
(140, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:03:15', 1, 1, 'tokped', 'tokped'),
(141, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:03:15', 1, 4, 'tokped', 'tokped'),
(142, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:03:15', 1, 1, 'tokped', 'tokped'),
(143, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:03:15', 1, 4, 'tokped', 'tokped'),
(144, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:03:15', 1, 1, 'tokped', 'tokped'),
(145, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:03:15', 1, 4, 'tokped', 'tokped'),
(146, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:03:15', 1, 1, 'tokped', 'tokped'),
(147, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:03:15', 1, 4, 'tokped', 'tokped'),
(148, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:03:15', 1, 1, 'tokped', 'tokped'),
(149, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:09:00', 1, 4, 'tokped', 'tokped'),
(150, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:09:00', 1, 1, 'tokped', 'tokped'),
(151, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:09:00', 1, 4, 'tokped', 'tokped'),
(152, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:09:00', 1, 1, 'tokped', 'tokped'),
(153, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:09:00', 1, 4, 'tokped', 'tokped'),
(154, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:09:00', 1, 1, 'tokped', 'tokped'),
(155, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:09:00', 1, 4, 'tokped', 'tokped'),
(156, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:09:00', 1, 1, 'tokped', 'tokped'),
(157, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:09:00', 1, 4, 'tokped', 'tokped'),
(158, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:09:00', 1, 1, 'tokped', 'tokped'),
(159, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:09:00', 1, 4, 'tokped', 'tokped'),
(160, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:09:00', 1, 1, 'tokped', 'tokped'),
(161, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:09:00', 1, 4, 'tokped', 'tokped'),
(162, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:09:00', 1, 1, 'tokped', 'tokped'),
(163, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:09:00', 1, 4, 'tokped', 'tokped'),
(164, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:09:00', 1, 1, 'tokped', 'tokped'),
(165, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:09:00', 1, 4, 'tokped', 'tokped'),
(166, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:09:00', 1, 1, 'tokped', 'tokped'),
(167, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:09:00', 1, 4, 'tokped', 'tokped'),
(168, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:09:00', 1, 1, 'tokped', 'tokped'),
(169, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:22', 1, 4, 'tokped', 'tokped'),
(170, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:22', 1, 1, 'tokped', 'tokped'),
(171, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:22', 1, 4, 'tokped', 'tokped'),
(172, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:22', 1, 1, 'tokped', 'tokped'),
(173, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:22', 1, 4, 'tokped', 'tokped'),
(174, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:22', 1, 1, 'tokped', 'tokped'),
(175, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:22', 1, 4, 'tokped', 'tokped'),
(176, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:22', 1, 1, 'tokped', 'tokped'),
(177, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:22', 1, 4, 'tokped', 'tokped'),
(178, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:22', 1, 1, 'tokped', 'tokped'),
(179, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:22', 1, 4, 'tokped', 'tokped'),
(180, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:22', 1, 1, 'tokped', 'tokped'),
(181, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:22', 1, 4, 'tokped', 'tokped'),
(182, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:22', 1, 1, 'tokped', 'tokped'),
(183, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:22', 1, 4, 'tokped', 'tokped'),
(184, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:22', 1, 1, 'tokped', 'tokped'),
(185, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:22', 1, 4, 'tokped', 'tokped'),
(186, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:22', 1, 1, 'tokped', 'tokped'),
(187, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:22', 1, 4, 'tokped', 'tokped'),
(188, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:22', 1, 1, 'tokped', 'tokped'),
(189, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:59', 1, 4, 'tokped', 'tokped'),
(190, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:59', 1, 1, 'tokped', 'tokped'),
(191, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:59', 1, 4, 'tokped', 'tokped'),
(192, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:59', 1, 1, 'tokped', 'tokped'),
(193, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:59', 1, 4, 'tokped', 'tokped'),
(194, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:59', 1, 1, 'tokped', 'tokped'),
(195, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:59', 1, 4, 'tokped', 'tokped'),
(196, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:59', 1, 1, 'tokped', 'tokped'),
(197, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:59', 1, 4, 'tokped', 'tokped'),
(198, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:59', 1, 1, 'tokped', 'tokped'),
(199, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:59', 1, 4, 'tokped', 'tokped'),
(200, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:59', 1, 1, 'tokped', 'tokped'),
(201, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:59', 1, 4, 'tokped', 'tokped'),
(202, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:59', 1, 1, 'tokped', 'tokped'),
(203, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:59', 1, 4, 'tokped', 'tokped'),
(204, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:59', 1, 1, 'tokped', 'tokped'),
(205, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:59', 1, 4, 'tokped', 'tokped'),
(206, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:59', 1, 1, 'tokped', 'tokped'),
(207, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:13:59', 1, 4, 'tokped', 'tokped'),
(208, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:13:59', 1, 1, 'tokped', 'tokped'),
(209, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:14:30', 1, 4, 'tokped', 'tokped'),
(210, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:14:30', 1, 1, 'tokped', 'tokped'),
(211, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:14:30', 1, 4, 'tokped', 'tokped'),
(212, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:14:30', 1, 1, 'tokped', 'tokped'),
(213, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:14:30', 1, 4, 'tokped', 'tokped'),
(214, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:14:30', 1, 1, 'tokped', 'tokped'),
(215, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:14:30', 1, 4, 'tokped', 'tokped'),
(216, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:14:30', 1, 1, 'tokped', 'tokped'),
(217, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:14:30', 1, 4, 'tokped', 'tokped'),
(218, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:14:30', 1, 1, 'tokped', 'tokped'),
(219, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:14:30', 1, 4, 'tokped', 'tokped'),
(220, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:14:30', 1, 1, 'tokped', 'tokped'),
(221, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:14:30', 1, 4, 'tokped', 'tokped'),
(222, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:14:30', 1, 1, 'tokped', 'tokped'),
(223, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:14:30', 1, 4, 'tokped', 'tokped'),
(224, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:14:30', 1, 1, 'tokped', 'tokped'),
(225, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:14:30', 1, 4, 'tokped', 'tokped'),
(226, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:14:30', 1, 1, 'tokped', 'tokped'),
(227, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:14:30', 1, 4, 'tokped', 'tokped'),
(228, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:14:30', 1, 1, 'tokped', 'tokped'),
(229, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:15:53', 1, 4, 'tokped', 'tokped'),
(230, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:15:53', 1, 1, 'tokped', 'tokped'),
(231, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:15:53', 1, 4, 'tokped', 'tokped'),
(232, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:15:53', 1, 1, 'tokped', 'tokped'),
(233, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:15:53', 1, 4, 'tokped', 'tokped'),
(234, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:15:53', 1, 1, 'tokped', 'tokped'),
(235, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:15:53', 1, 4, 'tokped', 'tokped'),
(236, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:15:53', 1, 1, 'tokped', 'tokped'),
(237, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:15:53', 1, 4, 'tokped', 'tokped'),
(238, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:15:53', 1, 1, 'tokped', 'tokped'),
(239, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:15:53', 1, 4, 'tokped', 'tokped'),
(240, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:15:53', 1, 1, 'tokped', 'tokped'),
(241, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:15:53', 1, 4, 'tokped', 'tokped'),
(242, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:15:53', 1, 1, 'tokped', 'tokped'),
(243, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:15:53', 1, 4, 'tokped', 'tokped'),
(244, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:15:53', 1, 1, 'tokped', 'tokped'),
(245, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:15:53', 1, 4, 'tokped', 'tokped'),
(246, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:15:53', 1, 1, 'tokped', 'tokped'),
(247, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-21 20:15:53', 1, 4, 'tokped', 'tokped'),
(248, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-21 20:15:53', 1, 1, 'tokped', 'tokped'),
(249, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-22 15:00:45', 1, 4, 'tokped', 'tokped'),
(250, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-22 15:00:45', 1, 1, 'tokped', 'tokped'),
(251, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-22 15:00:45', 1, 4, 'tokped', 'tokped'),
(252, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-22 15:00:45', 1, 1, 'tokped', 'tokped'),
(253, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-22 15:00:45', 1, 4, 'tokped', 'tokped'),
(254, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-22 15:00:45', 1, 1, 'tokped', 'tokped'),
(255, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-22 15:00:45', 1, 4, 'tokped', 'tokped'),
(256, 'Kaos Game', 'GAME001', 'GAME001', '60000', '70000', 'Kaos Game', 1, 'MOCKUP_GAME001.jpg', 'BANNER_GAME001.jpg', 'DESIGN_GAME001.jpg', 'Y', '2021-12-22 15:00:45', 1, 1, 'tokped', 'tokped'),
(257, 'Kaos Ondel Ondel', 'ONDE123', 'ONDE123', '600000', '200000', 'Kaos Ondel Ondel', 1, 'MOCKUP_ONDE123.jpg', 'BANNER_ONDE123.jpg', 'DESIGN_ONDE123.jpg', 'Y', '2021-12-22 15:00:45', 1, 4, 'tokped', 'tokped'),
(258, 'Kaos Sample 6', 'SM006', 'SM006', '135000', '105000', 'Kaos Sample 6', 1, 'public/photo/6.jpg', 'public/photo/6_banner.jpg', 'public/photo/6_design.jpg', 'Y', '2021-12-22 15:00:45', 1, 5, 'tokped', 'tokped'),
(260, 'Kaos Sample 5', 'SM005', 'SM005', '135000', '105000', 'Kaos Sample 5', 1, 'public/photo/5.jpg', 'public/photo/5_banner.jpg', 'public/photo/5_design.jpg', 'Y', '2021-12-22 15:00:45', 1, 5, 'tokped', 'tokped'),
(262, 'Kaos Sample 4', 'SM004', 'SM004', '135000', '105000', 'Kaos Sample 4', 1, 'public/photo/4.jpg', 'public/photo/4_banner.jpg', 'public/photo/4_design.jpg', 'Y', '2021-12-22 15:00:45', 1, 5, 'tokped', 'tokped'),
(264, 'Kaos Sample 3', 'SM003', 'SM003', '135000', '105000', 'Kaos Sample 3', 1, 'public/photo/3.jpg', 'public/photo/3_banner.jpg', 'public/photo/3_design.jpg', 'Y', '2021-12-22 15:00:45', 1, 5, 'tokped', 'tokped'),
(266, 'Kaos Sample 2', 'SM002', 'SM002', '135000', '105000', 'Kaos Sample 2', 1, 'public/photo/2.jpg', 'public/photo/2_banner.jpg', 'public/photo/2_design.jpg', 'Y', '2021-12-22 15:00:45', 1, 5, 'tokped', 'tokped'),
(268, 'Kaos Sample 1', 'SM001', 'SM001', '135000', '105000', 'Kaos Sample 1', 1, 'public/photo/1.jpg', 'public/photo/1_banner.jpg', 'public/photo/1_design.jpg', 'Y', '2021-12-22 15:00:45', 1, 5, 'tokped', 'tokped');

-- --------------------------------------------------------

--
-- Table structure for table `tb_prod_list`
--

CREATE TABLE `tb_prod_list` (
  `prod_list_id` int(11) NOT NULL,
  `prod_list_prod_id` int(11) DEFAULT NULL,
  `prod_list_landing_id` int(11) DEFAULT NULL,
  `prod_list_poup_stat` enum('N','Y') DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_prod_list`
--

INSERT INTO `tb_prod_list` (`prod_list_id`, `prod_list_prod_id`, `prod_list_landing_id`, `prod_list_poup_stat`) VALUES
(29, 25, 2, 'N'),
(11, 25, 1, 'N'),
(19, 20, 1, 'Y'),
(40, 29, 2, 'N'),
(24, 31, 2, 'N'),
(25, 33, 2, 'N'),
(26, 35, 2, 'N'),
(32, 28, 2, 'N'),
(44, 37, 2, 'N'),
(46, 39, 2, 'N'),
(50, 26, 2, 'Y'),
(51, 258, 3, 'N'),
(52, 260, 3, 'N'),
(53, 262, 3, 'N'),
(54, 264, 3, 'N'),
(55, 266, 3, 'N'),
(56, 268, 3, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_response`
--

CREATE TABLE `tb_response` (
  `resp_id` int(11) NOT NULL,
  `resp_type` varchar(25) DEFAULT NULL,
  `resp_cust_id` int(11) DEFAULT NULL,
  `resp_landing_id` varchar(255) DEFAULT NULL,
  `resp_bc_id` varchar(255) DEFAULT NULL,
  `resp_niche_id` int(11) DEFAULT NULL,
  `resp_cat_id` int(11) DEFAULT NULL,
  `resp_date_created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) DEFAULT '',
  `user_display_name` varchar(255) DEFAULT '',
  `user_email` varchar(255) DEFAULT '',
  `user_password` varchar(255) DEFAULT '',
  `user_role` varchar(255) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_name`, `user_display_name`, `user_email`, `user_password`, `user_role`) VALUES
(1, 'admin', 'Admin Isamu', 'admin@mail.com', '21232f297a57a5a743894a0e4a801fc3', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bc_batch`
--
ALTER TABLE `tb_bc_batch`
  ADD PRIMARY KEY (`bc_batch_id`);

--
-- Indexes for table `tb_broadcast`
--
ALTER TABLE `tb_broadcast`
  ADD PRIMARY KEY (`bc_id`);

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `tb_cust_batch`
--
ALTER TABLE `tb_cust_batch`
  ADD PRIMARY KEY (`cust_batch_id`);

--
-- Indexes for table `tb_landing`
--
ALTER TABLE `tb_landing`
  ADD PRIMARY KEY (`landing_id`);

--
-- Indexes for table `tb_media`
--
ALTER TABLE `tb_media`
  ADD PRIMARY KEY (`media_id`);

--
-- Indexes for table `tb_niche`
--
ALTER TABLE `tb_niche`
  ADD PRIMARY KEY (`niche_id`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `tb_prod_list`
--
ALTER TABLE `tb_prod_list`
  ADD PRIMARY KEY (`prod_list_id`);

--
-- Indexes for table `tb_response`
--
ALTER TABLE `tb_response`
  ADD PRIMARY KEY (`resp_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bc_batch`
--
ALTER TABLE `tb_bc_batch`
  MODIFY `bc_batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_broadcast`
--
ALTER TABLE `tb_broadcast`
  MODIFY `bc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=609;

--
-- AUTO_INCREMENT for table `tb_cust_batch`
--
ALTER TABLE `tb_cust_batch`
  MODIFY `cust_batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_landing`
--
ALTER TABLE `tb_landing`
  MODIFY `landing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_media`
--
ALTER TABLE `tb_media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_niche`
--
ALTER TABLE `tb_niche`
  MODIFY `niche_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT for table `tb_prod_list`
--
ALTER TABLE `tb_prod_list`
  MODIFY `prod_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tb_response`
--
ALTER TABLE `tb_response`
  MODIFY `resp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
