/*
Navicat MySQL Data Transfer

Source Server         : localdb
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_katalog_2021

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-01-14 23:18:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_app
-- ----------------------------
DROP TABLE IF EXISTS `tb_app`;
CREATE TABLE `tb_app` (
  `app_id` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(50) DEFAULT NULL,
  `app_desc` varchar(255) DEFAULT NULL,
  `app_date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_app
-- ----------------------------
INSERT INTO `tb_app` VALUES ('1', 'Watzap', 'Non-Verified', '2022-01-14 13:13:56');
INSERT INTO `tb_app` VALUES ('2', 'Qontak', 'Verified By Facebook', '2022-01-14 13:13:56');
