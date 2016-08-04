/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50626
Source Host           : 127.0.0.1:3306
Source Database       : seaweed

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-07-28 15:49:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for adm_pengguna
-- ----------------------------
DROP TABLE IF EXISTS `adm_pengguna`;
CREATE TABLE `adm_pengguna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `warehouseid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `levelid` int(11) NOT NULL,
  `profileid` int(11) NOT NULL,
  `companyid` int(11) NOT NULL,
  `seaweed_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(150) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(150) DEFAULT NULL,
  `deviceId` varchar(150) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of adm_pengguna
-- ----------------------------

-- ----------------------------
-- Table structure for authassignment
-- ----------------------------
DROP TABLE IF EXISTS `authassignment`;
CREATE TABLE `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of authassignment
-- ----------------------------
INSERT INTO `authassignment` VALUES ('CompanyA', '4', null, 'N;');
INSERT INTO `authassignment` VALUES ('CompanyB', '3', null, 'N;');
INSERT INTO `authassignment` VALUES ('SuperAdmin', '1', null, 'N;');

-- ----------------------------
-- Table structure for authitem
-- ----------------------------
DROP TABLE IF EXISTS `authitem`;
CREATE TABLE `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of authitem
-- ----------------------------
INSERT INTO `authitem` VALUES ('Admin', '2', 'User that can create user based on their company', null, 'N;');
INSERT INTO `authitem` VALUES ('Commodity.*', '1', 'Commodity', null, 'N;');
INSERT INTO `authitem` VALUES ('Company.*', '1', 'Company ', null, 'N;');
INSERT INTO `authitem` VALUES ('CompanyA', '2', 'Company Group Of Users A', null, 'N;');
INSERT INTO `authitem` VALUES ('CompanyB', '2', 'Company Group Of Users B', null, 'N;');
INSERT INTO `authitem` VALUES ('Groups.*', '1', 'Group Of Company B', null, 'N;');
INSERT INTO `authitem` VALUES ('Pengguna.*', '1', 'An Admin Group For Users Access', null, 'N;');
INSERT INTO `authitem` VALUES ('Petani.*', '1', 'A Controller that just petani user can access', null, 'N;');
INSERT INTO `authitem` VALUES ('SuperAdmin', '1', 'A Super User that have all access to manage the application', null, 'N;');

-- ----------------------------
-- Table structure for authitemchild
-- ----------------------------
DROP TABLE IF EXISTS `authitemchild`;
CREATE TABLE `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`) USING BTREE,
  CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of authitemchild
-- ----------------------------
INSERT INTO `authitemchild` VALUES ('Admin', 'Commodity.*');
INSERT INTO `authitemchild` VALUES ('CompanyB', 'Groups.*');
INSERT INTO `authitemchild` VALUES ('Admin', 'Pengguna.*');
INSERT INTO `authitemchild` VALUES ('CompanyA', 'Petani.*');

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES ('1', 'Kospermindo', 'Indonesia', '081354720203', 'Jln. Kerukunan Barat 18\r\nBTP Blok J No 384', '0');

-- ----------------------------
-- Table structure for gudang
-- ----------------------------
DROP TABLE IF EXISTS `gudang`;
CREATE TABLE `gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `seaweedid` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `lokasi` varchar(150) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `stok_masuk` double(30,5) NOT NULL,
  `stok_keluar` double(30,5) NOT NULL,
  `jumlah_stok` mediumint(30) NOT NULL DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `created_by` varchar(150) NOT NULL,
  `updated_by` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gudang
-- ----------------------------

-- ----------------------------
-- Table structure for kelompok_gudang
-- ----------------------------
DROP TABLE IF EXISTS `kelompok_gudang`;
CREATE TABLE `kelompok_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gudangid` int(11) NOT NULL,
  `penggunaid` int(11) NOT NULL,
  `kelompokid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kelompok_gudang
-- ----------------------------

-- ----------------------------
-- Table structure for kelompok_tani
-- ----------------------------
DROP TABLE IF EXISTS `kelompok_tani`;
CREATE TABLE `kelompok_tani` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelompok` varchar(150) NOT NULL,
  `ketua_kelompok` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of kelompok_tani
-- ----------------------------
INSERT INTO `kelompok_tani` VALUES ('1', 'Assamaturu', 'Darwis', 'Kelompok Assamaturu', '2016-06-27 05:54:32', '4', '2016-06-27 05:54:50', '4', '1');
INSERT INTO `kelompok_tani` VALUES ('2', 'Anugrah', 'Abd. Majid Bundu', 'Kelompok Tani Anugrah', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0', '1');
INSERT INTO `kelompok_tani` VALUES ('3', 'Usaha Bersama', 'Nurdin Dg. Bali', 'Kelompok Tani Usaha Bersama', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0', '1');
INSERT INTO `kelompok_tani` VALUES ('4', 'Resky Utama', 'Husein Sore\'', 'Kelompok Tani Resky Utama', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0', '1');
INSERT INTO `kelompok_tani` VALUES ('5', 'Setia Maju', 'Tola', 'Kelompok Tani Setia Maju', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0', '1');
INSERT INTO `kelompok_tani` VALUES ('6', 'Sumber Bahagia', 'Muh. Ali Awing', 'Kelompok Tani Sumber Bahagia', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0', '1');
INSERT INTO `kelompok_tani` VALUES ('7', 'Barisan Tani', 'Dg. Lalang', 'Kelompok Tani Barisan Tani', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0', '1');
INSERT INTO `kelompok_tani` VALUES ('8', 'Sango Sejahtera', 'H. Muhtar', 'Kelompok Tani Sango Sejahtera', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '0', '1');

-- ----------------------------
-- Table structure for komoditi
-- ----------------------------
DROP TABLE IF EXISTS `komoditi`;
CREATE TABLE `komoditi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_komoditi` varchar(50) NOT NULL,
  `nama_komoditi` varchar(255) NOT NULL,
  `deskripsi` text,
  `kadar_air` double(30,5) NOT NULL,
  `jumlah_bentangan` double(30,5) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `total_panen` double(30,5) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(150) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_komoditi` (`id_komoditi`) USING BTREE,
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='			';

-- ----------------------------
-- Records of komoditi
-- ----------------------------
INSERT INTO `komoditi` VALUES ('1', '1', '', null, '0.00000', '23424.00000', '1', '0.00000', '158', '2016-07-28 15:11:26', null, null, null);

-- ----------------------------
-- Table structure for komoditi_type
-- ----------------------------
DROP TABLE IF EXISTS `komoditi_type`;
CREATE TABLE `komoditi_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(150) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of komoditi_type
-- ----------------------------
INSERT INTO `komoditi_type` VALUES ('1', 'Gracilaria KW3', '');
INSERT INTO `komoditi_type` VALUES ('2', 'Gracilaria KW4', null);
INSERT INTO `komoditi_type` VALUES ('3', 'Gracilaria BS', null);
INSERT INTO `komoditi_type` VALUES ('4', 'Sango-Sango Laut', null);
INSERT INTO `komoditi_type` VALUES ('5', 'Euchema Cotoni', null);
INSERT INTO `komoditi_type` VALUES ('6', 'Spinosom', null);

-- ----------------------------
-- Table structure for level
-- ----------------------------
DROP TABLE IF EXISTS `level`;
CREATE TABLE `level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(150) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of level
-- ----------------------------
INSERT INTO `level` VALUES ('1', 'Moderator', 'Moderator');
INSERT INTO `level` VALUES ('2', 'Admin', 'Admin');
INSERT INTO `level` VALUES ('3', 'User', 'User');

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `tagsid` int(11) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `from` varchar(150) NOT NULL,
  `to` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `date_send` datetime NOT NULL,
  `date_receive` datetime NOT NULL,
  `sent_status` tinyint(1) NOT NULL DEFAULT '0',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `is_draft` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of messages
-- ----------------------------
INSERT INTO `messages` VALUES ('1', '1', '1', '1', 'Reset Password', '', '1', '\r\n\r\nLose away off why half led have near bed. At engage simple father of period others except. My giving do summer of though narrow marked at. Spring formal no county ye waited. My whether cheered at regular it of promise blushes perhaps. Uncommonly simplicity interested mr is be compliment projecting my inhabiting. Gentleman he september in oh excellent.\r\n\r\nNew the her nor case that lady paid read. Invitation friendship travelling eat everything the out two. Shy you who scarcely expenses debating hastened resolved. Always polite moment on is warmth spirit it to hearts. Downs those still witty an balls so chief so. Moment an little remain no up lively no. Way brought may off our regular country towards adapted cheered.\r\n\r\nUse securing confined his shutters. Delightful as he it acceptance an solicitude discretion reasonably. Carriage we husbands advanced an perceive greatest. Totally dearest expense on demesne ye he. Curiosity excellent commanded in me. Unpleasing impression themselves to at assistance acceptance my or. On consider laughter civility offended oh.\r\n\r\nOh he decisively impression attachment friendship so if everything. Whose her enjoy chief new young. Felicity if ye required likewise so doubtful. On so attention necessary at by provision otherwise existence direction. Unpleasing up announcing unpleasant themselves oh do on. Way advantage age led listening belonging supposing.\r\n\r\nSo by colonel hearted ferrars. Draw from upon here gone add one. He in sportsman household otherwise it perceived instantly. Is inquiry no he several excited am. Called though excuse length ye needed it he having. Whatever throwing we on resolved entrance together graceful. Mrs assured add private married removed believe did she.\r\n\r\n\r\nLose away off why half led have near bed. At engage simple father of period others except. My giving do summer of though narrow marked at. Spring formal no county ye waited. My whether cheered at regular it of promise blushes perhaps. Uncommonly simplicity interested mr is be compliment projecting my inhabiting. Gentleman he september in oh excellent.\r\n\r\nNew the her nor case that lady paid read. Invitation friendship travelling eat everything the out two. Shy you who scarcely expenses debating hastened resolved. Always polite moment on is warmth spirit it to hearts. Downs those still witty an balls so chief so. Moment an little remain no up lively no. Way brought may off our regular country towards adapted cheered.\r\n\r\nUse securing confined his shutters. Delightful as he it acceptance an solicitude discretion reasonably. Carriage we husbands advanced an perceive greatest. Totally dearest expense on demesne ye he. Curiosity excellent commanded in me. Unpleasing impression themselves to at assistance acceptance my or. On consider laughter civility offended oh.\r\n\r\nOh he decisively impression attachment friendship so if everything. Whose her enjoy chief new young. Felicity if ye required likewise so doubtful. On so attention necessary at by provision otherwise existence direction. Unpleasing up announcing unpleasant themselves oh do on. Way advantage age led listening belonging supposing.\r\n\r\nSo by colonel hearted ferrars. Draw from upon here gone add one. He in sportsman household otherwise it perceived instantly. Is inquiry no he several excited am. Called though excuse length ye needed it he having. Whatever throwing we on resolved entrance together graceful. Mrs assured add private married removed believe did she.\r\n\r\n\r\nLose away off why half led have near bed. At engage simple father of period others except. My giving do summer of though narrow marked at. Spring formal no county ye waited. My whether cheered at regular it of promise blushes perhaps. Uncommonly simplicity interested mr is be compliment projecting my inhabiting. Gentleman he september in oh excellent.\r\n\r\nNew the her nor case that lady paid read. Invitation friendship travelling eat everything the out two. Shy you who scarcely expenses debating hastened resolved. Always polite moment on is warmth spirit it to hearts. Downs those still witty an balls so chief so. Moment an little remain no up lively no. Way brought may off our regular country towards adapted cheered.\r\n\r\nUse securing confined his shutters. Delightful as he it acceptance an solicitude discretion reasonably. Carriage we husbands advanced an perceive greatest. Totally dearest expense on demesne ye he. Curiosity excellent commanded in me. Unpleasing impression themselves to at assistance acceptance my or. On consider laughter civility offended oh.\r\n\r\nOh he decisively impression attachment friendship so if everything. Whose her enjoy chief new young. Felicity if ye required likewise so doubtful. On so attention necessary at by provision otherwise existence direction. Unpleasing up announcing unpleasant themselves oh do on. Way advantage age led listening belonging supposing.\r\n\r\nSo by colonel hearted ferrars. Draw from upon here gone add one. He in sportsman household otherwise it perceived instantly. Is inquiry no he several excited am. Called though excuse length ye needed it he having. Whatever throwing we on resolved entrance together graceful. Mrs assured add private married removed believe did she.\r\n', '2016-07-12 03:24:22', '2016-07-12 03:24:25', '0', '0', '0');
INSERT INTO `messages` VALUES ('2', '1', '1', '2', 'Send Messages To Mobile', 'vero', 'nuarz', 'Hi Again from hansen', '2016-07-26 14:06:21', '2016-07-26 14:06:21', '1', '0', '0');
INSERT INTO `messages` VALUES ('5', '172', '1', '2', 'Send Messages To Mobile', 'vero', 'vero', 'Hi..sist', '2016-07-27 16:02:34', '2016-07-27 16:02:34', '1', '0', '0');
INSERT INTO `messages` VALUES ('6', '158', '1', '2', 'Send Messages To Mobile', 'vero', 'nuarz', 'Hiii', '2016-07-27 16:03:03', '2016-07-27 16:03:03', '1', '0', '0');
INSERT INTO `messages` VALUES ('7', '158', '1', '2', 'Send Messages To Mobile', 'vero', 'nuarz', 'Testtttttttttttt', '2016-07-27 16:08:17', '2016-07-27 16:08:17', '1', '0', '0');
INSERT INTO `messages` VALUES ('8', '172', '1', '2', 'Send Messages To Mobile', 'vero', 'vero', 'testttt', '2016-07-27 16:10:38', '2016-07-27 16:10:38', '1', '0', '0');
INSERT INTO `messages` VALUES ('9', '172', '1', '2', 'Send Messages To Mobile', 'vero', 'vero', 'Hi sist', '2016-07-27 16:11:22', '2016-07-27 16:11:22', '1', '0', '0');
INSERT INTO `messages` VALUES ('10', '172', '1', '2', 'Send Messages To Mobile', 'vero', 'vero', 'hheelloo', '2016-07-27 16:12:20', '2016-07-27 16:12:20', '1', '0', '0');

-- ----------------------------
-- Table structure for message_group
-- ----------------------------
DROP TABLE IF EXISTS `message_group`;
CREATE TABLE `message_group` (
  `messageid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message_group
-- ----------------------------

-- ----------------------------
-- Table structure for message_tags
-- ----------------------------
DROP TABLE IF EXISTS `message_tags`;
CREATE TABLE `message_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tags` varchar(255) NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message_tags
-- ----------------------------
INSERT INTO `message_tags` VALUES ('1', 'Group', 'badge-danger', 'Group Message Category');
INSERT INTO `message_tags` VALUES ('2', 'Farmers', 'badge-default', 'Farmers Messages');

-- ----------------------------
-- Table structure for pengguna
-- ----------------------------
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int(11) NOT NULL,
  `levelid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(150) DEFAULT NULL,
  `idkelompok` int(11) DEFAULT NULL,
  `idkoordinator` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `deviceId` text,
  `level_user` int(11) DEFAULT NULL,
  `is_moderator` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pengguna
-- ----------------------------
INSERT INTO `pengguna` VALUES ('156', '3', '1', 'KOR656766', '$2y$13$lZXTF/ywi5OlWWGfiYk5ye6CeFQkFhmz9P.t3hA2K6erJfdhkBB5K', null, null, '1', null, null, null);
INSERT INTO `pengguna` VALUES ('157', '3', '2', 'KEL165026', '$2y$13$D81MECUvvIs9hkzcUT23H.6rDTcTpw5t5wsRG4zCUyjibLEzDGu9i', null, '156', '1', null, null, null);
INSERT INTO `pengguna` VALUES ('158', '3', '3', 'nuarz', '$2y$13$k0mp1JZeRWi90Loj.K/o5uWYt3NuCXJ6TM4xS9S/OmeYswDyzol.2', '157', '156', '1', 'cdoo3MfPRjU:APA91bGw1cyqZFzIsdZ0QdGhdN4EoF_5g_CbHXyQf3TPVTCwVG9sfEnZZT1W1kz_Xxboh318n1uIlp4N5qyb0NEwRAVCdVmtBOBkWV-wFNBDBV7aMOwtZZj312zlX9bRL4wpVtJVIqh7', '2', null);
INSERT INTO `pengguna` VALUES ('159', '3', '1', 'KOR156041', '$2y$13$ypp9JcHW/cAykKkTdGzGPOkBBvYOshQ8bvyo/Esrb9aJWoArMiE.6', null, null, '1', null, null, null);
INSERT INTO `pengguna` VALUES ('160', '3', '2', 'KEL561177', '$2y$13$cbw6EQr2sYfQBb0qh1G.2OfhycAE/cqDHMVe9n8thK65U1IPKAAUS', null, '159', '1', null, null, null);
INSERT INTO `pengguna` VALUES ('161', '3', '3', 'ikki', '$2y$13$C/X29gzGq3JvzcUWqJpz/..RlEmWikzkY8XcmjfJPTfVIoAH66jB6', '160', '159', '1', null, '2', null);
INSERT INTO `pengguna` VALUES ('162', '3', '1', 'kor790419', '$2y$13$5AUhjelQMhL7TcMl7YqNIOEoX9IrGGldCOMwZa2L7gW/sosNYceAC', null, null, '0', null, null, null);
INSERT INTO `pengguna` VALUES ('163', '3', '4', 'asdas', '$2y$13$bZi1fJsrAriGp75XheZwvOjZkk2tMYLY5mTNQvkmY70ogCSmZFG/G', null, null, '1', null, '1', null);
INSERT INTO `pengguna` VALUES ('164', '3', '1', 'KOR947675', '$2y$13$eHSO9MrFqGr7NWQ.UmvhLem0dDCmvO2jBK47/533r8XPJSSvyShwC', null, null, '1', null, null, null);
INSERT INTO `pengguna` VALUES ('165', '3', '2', 'KEL527171', '$2y$13$iUR/9W1FoxYCtOfg3e5XvOoq7bTEqb1JU9V14DfnbXMYJMq0pMW56', null, '164', '1', null, null, null);
INSERT INTO `pengguna` VALUES ('166', '3', '3', 'colleng', '$2y$13$R9VGLVWMoBnUs86RjW8et.uDStudvJNs0p4yZ6pEGUTaz6S0UKAu.', '160', '159', '1', null, '2', null);
INSERT INTO `pengguna` VALUES ('167', '3', '1', 'KOR184160', '$2y$13$N.ck/lMaWjST04epg/JL1.coHaPyeL2mzrL3ETInhEEYGhGvdnm0u', null, null, '1', null, null, null);
INSERT INTO `pengguna` VALUES ('168', '3', '3', 'atto', '$2y$13$zT.av34iJK8p6NQ9SDZj3.FL8TQZp36uS.elq4rFpkr67JufQ8m2K', '165', '164', '1', null, '2', null);
INSERT INTO `pengguna` VALUES ('169', '3', '1', 'KOR828346', '$2y$13$FwHSQN5FVqgg.kUCDIITteXro3s3yTZbf9K0ZJ4Lmwo8DR6oz4X2y', null, null, '1', null, null, null);
INSERT INTO `pengguna` VALUES ('170', '3', '2', 'KEL230873', '$2y$13$enhYkhn4d6ZvtJNZj52uOeGWvCYddUyWQwYqBc2UHKoRZC3A4CPiC', null, '156', '0', null, null, null);
INSERT INTO `pengguna` VALUES ('171', '3', '1', 'KOR734811', '$2y$13$/CYsZhbK4YnHeIuraiCTyOH5oLb0ZFcZNlgKbwf6ljQifPX/YwGK2', null, null, '1', null, null, null);
INSERT INTO `pengguna` VALUES ('172', '3', '3', 'vero', '$2y$13$5ThsaQUtiaC./Bx43bKWWuBsk4PQelGFIxeA7.qZbYpmFuFA4PX8K', '160', '159', '1', 'fPkq8g18Zf8:APA91bGAjOB54o1i1kHde4TcUjID6nRZPEUxmCRCm-DDi_UGBpsjBU2YGG3ksKeyp85nYZ6kneWDYHVsjbOEH2R5yfFK3xramu0JSz8OP26s2YDj7lLgoi66lXVSxxfgUpGnimlxNERt', '2', null);
INSERT INTO `pengguna` VALUES ('173', '3', '3', 'ince', '$2y$13$Xyi67AnzuTER6t/0mfPYiunDwOWh6YT/GUn.4hOtyv/0a3eJU/U0K', '160', '159', '1', null, '2', null);
INSERT INTO `pengguna` VALUES ('174', '3', '2', 'KEL487028', '$2y$13$nwVJshwQ5luGiNUsotyJ8.SWuV8KwrFO1WZj7JVfCVerEX2uIbuBu', null, '156', '1', null, null, null);
INSERT INTO `pengguna` VALUES ('175', '3', '2', 'KEL926292', '$2y$13$5wuymttKw27uGKCm6LlJ1OfAX0tnTauIgx14SDVD3ajrE8Cp58qx2', null, '156', '1', null, null, null);

-- ----------------------------
-- Table structure for petani
-- ----------------------------
DROP TABLE IF EXISTS `petani`;
CREATE TABLE `petani` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `penggunaid` int(11) NOT NULL,
  `profileid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `warehouseid` int(11) NOT NULL,
  `seaweedid` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(150) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of petani
-- ----------------------------

-- ----------------------------
-- Table structure for profiles
-- ----------------------------
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `nmr_identitas` varchar(25) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `deskripsi` text,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of profiles
-- ----------------------------
INSERT INTO `profiles` VALUES ('1', '1', 'Hansen Makangiras', null, 'Hansen', 'Makangiras', '08114199010', 'BTP Blok J No. 384', '', '', '0000-00-00', null);
INSERT INTO `profiles` VALUES ('2', '2', 'Ancen Kibow', null, 'Ancen', 'Kibow', '08234234234', 'BTP Blok J No. 384', '', '', '0000-00-00', null);

-- ----------------------------
-- Table structure for profiles_fields
-- ----------------------------
DROP TABLE IF EXISTS `profiles_fields`;
CREATE TABLE `profiles_fields` (
  `id` int(11) NOT NULL,
  `varname` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `field_type` varchar(50) NOT NULL DEFAULT '',
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` text,
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` text,
  `position` int(1) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of profiles_fields
-- ----------------------------

-- ----------------------------
-- Table structure for rights
-- ----------------------------
DROP TABLE IF EXISTS `rights`;
CREATE TABLE `rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`),
  CONSTRAINT `rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rights
-- ----------------------------
INSERT INTO `rights` VALUES ('Admin', '2', '0');
INSERT INTO `rights` VALUES ('CompanyA', '2', '2');
INSERT INTO `rights` VALUES ('CompanyB', '2', '3');

-- ----------------------------
-- Table structure for seaweed
-- ----------------------------
DROP TABLE IF EXISTS `seaweed`;
CREATE TABLE `seaweed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `id_seaweed` int(11) NOT NULL,
  `nama_komoditi` varchar(255) NOT NULL,
  `jenis_komoditi` int(11) NOT NULL,
  `deskripsi` text,
  `kadar_air` double(10,3) NOT NULL,
  `jumlah_bentangan` int(11) NOT NULL,
  `total_panen` double(10,3) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  KEY `komoditi_ibfk_1` (`jenis_komoditi`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of seaweed
-- ----------------------------
INSERT INTO `seaweed` VALUES ('1', '150', '1', 'Sango-sango Laut', '2', null, '567.000', '0', '3455.000', '2016-07-16 21:46:02', 'nuarz', '0');
INSERT INTO `seaweed` VALUES ('2', '150', '2', 'Sango-sango Laut', '2', null, '75.000', '0', '80.000', '2016-07-18 13:40:06', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('3', '150', '4', 'Sango-sango Laut', '2', null, '75.000', '0', '65.000', '2016-07-18 14:56:01', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('4', '150', '1', 'Sango-sango Laut', '2', null, '99.000', '0', '99.000', '2016-07-18 14:57:29', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('5', '150', '4', 'Sango-sango Laut', '2', null, '23.000', '0', '12.000', '2016-07-18 15:01:44', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('6', '150', '4', 'Sango-sango Laut', '2', null, '23.000', '0', '12.000', '2016-07-18 15:02:23', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('7', '150', '1', 'Sango-sango Laut', '2', null, '23.000', '0', '12.000', '2016-07-18 15:02:32', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('8', '154', '2', 'Sango-sango Laut', '2', null, '86.000', '0', '12.000', '2016-07-18 15:15:58', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('9', '154', '6', 'Sango-sango Laut', '2', null, '86.000', '0', '12.000', '2016-07-18 15:16:19', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('10', '154', '6', 'Sango-sango Laut', '2', null, '86.000', '0', '12.000', '2016-07-18 15:16:40', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('11', '154', '2', 'Sango-sango Laut', '2', null, '23.000', '0', '12.000', '2016-07-18 15:17:35', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('12', '158', '2', 'Sango-sango Laut', '2', null, '68.000', '0', '53.000', '2016-07-18 22:56:53', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('13', '158', '1', 'Sango-sango Laut', '2', null, '60.000', '0', '56.000', '2016-07-18 23:28:59', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('14', '158', '2', 'Sango-sango Laut', '2', null, '78.000', '0', '87.000', '2016-07-19 00:06:43', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('15', '158', '2', 'Sango-sango Laut', '2', null, '78.000', '0', '87.500', '2016-07-19 00:10:15', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('16', '158', '2', 'Sango-sango Laut', '2', null, '78.000', '0', '87.500', '2016-07-19 00:13:41', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('17', '158', '2', 'Sango-sango Laut', '2', null, '79.000', '0', '87.500', '2016-07-19 00:14:01', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('18', '158', '2', 'Sango-sango Laut', '2', null, '78.600', '0', '87.500', '2016-07-19 00:14:35', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('19', '158', '2', 'Sango-sango Laut', '2', null, '78.000', '0', '88.000', '2016-07-19 00:14:52', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('20', '158', '2', 'Sango-sango Laut', '2', null, '78.000', '0', '88.000', '2016-07-19 00:22:04', 'Guest', '0');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_title` varchar(255) DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `site_url` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date_format` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of settings
-- ----------------------------

-- ----------------------------
-- Table structure for sub_seaweed
-- ----------------------------
DROP TABLE IF EXISTS `sub_seaweed`;
CREATE TABLE `sub_seaweed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(150) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sub_seaweed
-- ----------------------------
INSERT INTO `sub_seaweed` VALUES ('1', 'Gracilaria KW3', '');
INSERT INTO `sub_seaweed` VALUES ('2', 'Gracilaria KW 4', null);
INSERT INTO `sub_seaweed` VALUES ('3', 'Gracilaria BS', null);
INSERT INTO `sub_seaweed` VALUES ('4', 'Euchema Cotoni', null);
INSERT INTO `sub_seaweed` VALUES ('5', 'Sango-Sango Laut', null);
INSERT INTO `sub_seaweed` VALUES ('6', 'Spinosom', null);

-- ----------------------------
-- Table structure for tabel_kelompok
-- ----------------------------
DROP TABLE IF EXISTS `tabel_kelompok`;
CREATE TABLE `tabel_kelompok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelompok` varchar(255) NOT NULL,
  `ketua_kelompok` varchar(100) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `idgudang` varchar(100) CHARACTER SET latin1 NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tabel_kelompok
-- ----------------------------

-- ----------------------------
-- Table structure for tabel_komoditi
-- ----------------------------
DROP TABLE IF EXISTS `tabel_komoditi`;
CREATE TABLE `tabel_komoditi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_komoditi` varchar(255) NOT NULL,
  `nama_komoditi` varchar(255) NOT NULL,
  `jenis_komoditi` varchar(255) DEFAULT NULL,
  `kadar_air` int(11) DEFAULT NULL,
  `jumlah_bentanga` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`id_komoditi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tabel_komoditi
-- ----------------------------

-- ----------------------------
-- Table structure for tabel_koordinator
-- ----------------------------
DROP TABLE IF EXISTS `tabel_koordinator`;
CREATE TABLE `tabel_koordinator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_gudang` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `nama_koordinator` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `lokasi_gudang` varchar(255) DEFAULT NULL,
  `id_user` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `status` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tabel_koordinator
-- ----------------------------

-- ----------------------------
-- Table structure for tabel_petani
-- ----------------------------
DROP TABLE IF EXISTS `tabel_petani`;
CREATE TABLE `tabel_petani` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_petani` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `alamat` varchar(100) CHARACTER SET latin1 NOT NULL,
  `no_telp` varchar(20) CHARACTER SET latin1 NOT NULL,
  `nmr_identitas` varchar(25) CHARACTER SET latin1 NOT NULL,
  `tempat_lahir` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `luas_lokasi` int(20) NOT NULL,
  `jenis_komoditi` varchar(255) CHARACTER SET latin1 NOT NULL,
  `kadar_air` int(11) NOT NULL,
  `jumlah_bentangan` int(11) NOT NULL,
  `id_user` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  `idkelompok` int(11) NOT NULL,
  `idgudang` int(11) NOT NULL,
  `status` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tabel_petani
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_migration
-- ----------------------------
DROP TABLE IF EXISTS `tbl_migration`;
CREATE TABLE `tbl_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_migration
-- ----------------------------
INSERT INTO `tbl_migration` VALUES ('m000000_000000_base', '1467550492');

-- ----------------------------
-- Table structure for tbl_profiles
-- ----------------------------
DROP TABLE IF EXISTS `tbl_profiles`;
CREATE TABLE `tbl_profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_profiles
-- ----------------------------
INSERT INTO `tbl_profiles` VALUES ('1', 'Admin', 'Administrator');
INSERT INTO `tbl_profiles` VALUES ('2', 'Demo', 'Demo');

-- ----------------------------
-- Table structure for tbl_profiles_fields
-- ----------------------------
DROP TABLE IF EXISTS `tbl_profiles_fields`;
CREATE TABLE `tbl_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_profiles_fields
-- ----------------------------
INSERT INTO `tbl_profiles_fields` VALUES ('1', 'lastname', 'Last Name', 'VARCHAR', '50', '3', '1', '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', '1', '3');
INSERT INTO `tbl_profiles_fields` VALUES ('2', 'firstname', 'First Name', 'VARCHAR', '50', '3', '1', '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', '0', '3');

-- ----------------------------
-- Table structure for tbl_users
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', '9a24eff8c15a6a141ece27eb6947da0f', '2016-06-15 14:05:11', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `tbl_users` VALUES ('2', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', '099f825543f7850cc038b90aaff39fac', '2016-06-15 14:05:11', '0000-00-00 00:00:00', '0', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `pass` varchar(128) DEFAULT NULL,
  `salt` varchar(125) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `login` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `email_expired` datetime DEFAULT NULL,
  `email_created` datetime DEFAULT NULL,
  `email_status` int(1) DEFAULT NULL,
  `id_status` int(11) DEFAULT NULL,
  `url` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `subscribe` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `additional_info` text CHARACTER SET utf8,
  `ban_expires` int(11) unsigned DEFAULT NULL,
  `ban_reason` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `new_password` char(64) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `name_unique` (`name`) USING BTREE,
  UNIQUE KEY `email_unique` (`email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '$2a$10$OcwP3Bho8JK7gANBEu.Buu7NoPxxQUukbYY2C2Qj0zM06gQHwkZwi', null, 'info@docotel.com', '1371010684', '1450776710', '1450776710', '1', null, null, null, null, null, null, '0', null, null, null, null);
INSERT INTO `user` VALUES ('2', 'creator', '$2a$10$rGWMc84y39ldadTGXQR9rOvuAH8tCFPrfn9ebkdo4.xmqAm7OygCm', null, 'creator@docotel.com', '1371097109', '1380785123', '1380785123', '1', null, null, null, null, null, null, '0', null, null, null, null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `companyid` int(11) NOT NULL,
  `komoditi` varchar(200) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_handphone` varchar(15) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `levelid` int(11) NOT NULL DEFAULT '2',
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  `superuser` tinyint(1) NOT NULL DEFAULT '0',
  `registrationid` text,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '0', '0', '', 'hansen', '$2y$13$Lblbi8vHqceQt8xB3xjsEelwojS6WdN2taqilZssvIvVMG931EmYa', null, '085399450010', '2016-06-01 14:14:25', null, '0', '0', '1', null, '1', '2016-07-24 18:55:25');
INSERT INTO `users` VALUES ('2', '0', '0', 'Jagung', 'rahmat', '$2y$13$9q0xDCS7BCOZj2v82ACTHuyVPYFnomJ5/3g3YD8AVN1o3umb9PHC6', null, '081423423423', '2016-06-01 15:23:47', '2016-06-29 21:33:36', '2', '0', '0', null, '0', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('3', '0', '1', 'Rumput Laut', 'vero', '$2y$13$Y/uN5d.1UUzeqbOy2UKZkeFYJx1LJTCNCzBUXAMBHT.T0zmCSf/xe', 'vero@docotel.com', '081423423423', '2016-06-10 02:08:46', '2016-07-01 23:58:32', '2', '1', '0', null, '1', '2016-07-24 18:38:09');
INSERT INTO `users` VALUES ('4', '0', '0', 'Beras', 'kospermindo', '$2y$13$e87B0L1ry/qbagmUe5gWouHGxwahuXR18kH4uSuL75OOv0QOvf1h.', 'kospermindo@gmail.com', '081423423423', null, '2016-07-01 23:57:53', '3', '1', '0', null, '1', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('5', '0', '0', 'Tomat', 'panrita', '$2y$13$JAJU5CEP2Dml/CkO8ozT/.8M/69sk5Iq9aCdetUIHCUBVioZu4sFu', 'hansenmakangiras@gmail.com', '+62411588672', '2016-06-24 02:30:42', '2016-06-24 11:17:56', '2', '1', '0', null, '1', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('6', '0', '0', 'Rumput Laut', 'ancen', '$2y$13$W2do0DvgA/TCqzNU/.G00uo4MNxj.s9gIWNfa6dWD8yY.iCSR6.ym', 'hansenmakangiras@gmail.com', '+6281354720203', '2016-06-29 06:35:57', '2016-07-01 23:58:20', '3', '1', '0', null, '1', '2016-07-14 05:04:47');

-- ----------------------------
-- Table structure for users_group
-- ----------------------------
DROP TABLE IF EXISTS `users_group`;
CREATE TABLE `users_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `levelid` int(11) NOT NULL COMMENT '0',
  `group_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` tinyint(1) NOT NULL,
  `updated_by` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_admin` (`userid`,`levelid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users_group
-- ----------------------------
INSERT INTO `users_group` VALUES ('1', '4', '1', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `users_group` VALUES ('2', '4', '2', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `users_group` VALUES ('3', '4', '3', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `users_group` VALUES ('4', '3', '1', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `users_group` VALUES ('5', '3', '2', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');
INSERT INTO `users_group` VALUES ('6', '3', '3', '0', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1');

-- ----------------------------
-- Table structure for warehouse
-- ----------------------------
DROP TABLE IF EXISTS `warehouse`;
CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `penanggungjawab` varchar(150) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` varchar(150) NOT NULL,
  `deskripsi` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of warehouse
-- ----------------------------
INSERT INTO `warehouse` VALUES ('1', 'Takalar', 'Takalar', 'Vero', '2016-07-17 15:57:48', 'vero', '2016-07-17 17:29:21', 'vero', 'Gudang yang terletak di daerah takalar', '1');

-- ----------------------------
-- Table structure for yiilog
-- ----------------------------
DROP TABLE IF EXISTS `yiilog`;
CREATE TABLE `yiilog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(128) DEFAULT NULL,
  `category` varchar(128) DEFAULT NULL,
  `logtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IP_User` varchar(50) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `request_URL` text,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yiilog
-- ----------------------------

-- ----------------------------
-- View structure for v_komoditibygroup
-- ----------------------------
DROP VIEW IF EXISTS `v_komoditibygroup`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `v_komoditibygroup` AS select `tabel_petani`.`idkelompok` AS `idkelompok`,sum(`komoditi`.`total_panen`) AS `total` from (`tabel_petani` join `komoditi`) where (convert(`tabel_petani`.`id_user` using utf8) = `komoditi`.`id_user`) group by `tabel_petani`.`idkelompok` ;
