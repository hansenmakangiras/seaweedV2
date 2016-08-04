/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50626
Source Host           : 127.0.0.1:3306
Source Database       : seaweed

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-08-03 17:03:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tabel_kelompok
-- ----------------------------
DROP TABLE IF EXISTS `tabel_kelompok`;
CREATE TABLE `tabel_kelompok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelompok` varchar(255) NOT NULL,
  `ketua_kelompok` varchar(100) NOT NULL,
  `idgudang` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tabel_kelompok
-- ----------------------------
INSERT INTO `tabel_kelompok` VALUES ('3', 'Assamturu', '', '1', '0', '2016-08-03 10:06:45', 'vero', null, null, '1');
