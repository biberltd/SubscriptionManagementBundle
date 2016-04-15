/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : 127.0.0.1
 Source Database       : database-structure

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 04/15/2016 10:49:02 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `packages`
-- ----------------------------
DROP TABLE IF EXISTS `packages`;
CREATE TABLE `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_code` int(11) NOT NULL,
  `package_fee` decimal(5,2) DEFAULT NULL,
  `type` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- ----------------------------
--  Table structure for `subscription`
-- ----------------------------
DROP TABLE IF EXISTS `subscription`;
CREATE TABLE `subscription` (
  `member_id` int(10) NOT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `date_start` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `date_cancel` date DEFAULT NULL,
  `status` text CHARACTER SET utf8 NOT NULL,
  `package` text CHARACTER SET utf8 NOT NULL,
  `promotion` text CHARACTER SET utf8,
  `payment_status` text CHARACTER SET utf8 NOT NULL,
  `remain_amount` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `idxFMemberSubscription` FOREIGN KEY (`member_id`) REFERENCES `subscription` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

SET FOREIGN_KEY_CHECKS = 1;
