/*
Navicat MySQL Data Transfer

Source Server         : localdb
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_katalog_2021

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-01-14 23:18:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_bc_cust_detail
-- ----------------------------
DROP TABLE IF EXISTS `tb_bc_cust_detail`;
CREATE TABLE `tb_bc_cust_detail` (
  `bc_cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `bc_cust_cust_id` int(11) NOT NULL,
  `bc_cust_phone` varchar(20) NOT NULL,
  `bc_cust_bc_batch_id` int(11) DEFAULT NULL,
  `bc_cust_status` varchar(10) DEFAULT NULL,
  `bc_cust_app_id` int(2) NOT NULL,
  `bc_cust_landing_id` int(11) NOT NULL,
  PRIMARY KEY (`bc_cust_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16159 DEFAULT CHARSET=utf8mb4;
