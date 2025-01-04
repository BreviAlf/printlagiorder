/*
Navicat MySQL Data Transfer

Source Server         : localdb
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_katalog_2021

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-01-14 23:18:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_random_name
-- ----------------------------
DROP TABLE IF EXISTS `tb_random_name`;
CREATE TABLE `tb_random_name` (
  `random_name_id` int(11) NOT NULL AUTO_INCREMENT,
  `random_name` varchar(50) DEFAULT NULL,
  `random_gender` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`random_name_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_random_name
-- ----------------------------
INSERT INTO `tb_random_name` VALUES ('1', 'Bagus', 'Pria');
INSERT INTO `tb_random_name` VALUES ('2', 'Budi', 'Pria');
INSERT INTO `tb_random_name` VALUES ('3', 'Andi', 'Pria');
INSERT INTO `tb_random_name` VALUES ('4', 'Citra', 'Wanita');
INSERT INTO `tb_random_name` VALUES ('5', 'Asri', 'Wanita');
INSERT INTO `tb_random_name` VALUES ('6', 'Agung', 'Pria');
INSERT INTO `tb_random_name` VALUES ('7', 'Doni', 'Pria');
INSERT INTO `tb_random_name` VALUES ('8', 'Clara', 'Wanita');
INSERT INTO `tb_random_name` VALUES ('9', 'Nindi', 'Wanita');
