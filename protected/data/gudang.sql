/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50626
Source Host           : 127.0.0.1:3306
Source Database       : seaweed

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-08-02 16:13:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for gudang
-- ----------------------------
DROP TABLE IF EXISTS `gudang`;
CREATE TABLE `gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(100) DEFAULT NULL,
  `lokasi` varchar(150) NOT NULL,
  `stok_masuk` double(30,2) NOT NULL,
  `stok_keluar` double(30,2) NOT NULL,
  `jumlah_stok` double(30,2) NOT NULL DEFAULT '0.00',
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `created_by` varchar(150) NOT NULL,
  `updated_by` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
