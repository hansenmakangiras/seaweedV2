/*
Navicat MySQL Data Transfer

Source Server         : Tunnel DB Panrita
Source Server Version : 50546
Source Host           : localhost:3306
Source Database       : db_panrita

Target Server Type    : MYSQL
Target Server Version : 50546
File Encoding         : 65001

Date: 2016-07-27 17:15:02
*/

SET FOREIGN_KEY_CHECKS=0;

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
INSERT INTO `authassignment` VALUES ('Company A', '4', null, 'N;');
INSERT INTO `authassignment` VALUES ('Company B', '3', null, 'N;');
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
INSERT INTO `authitem` VALUES ('Authenticated', '2', 'Authenticated User', null, 'N;');
INSERT INTO `authitem` VALUES ('Commodity.*', '1', 'Commodity', null, 'N;');
INSERT INTO `authitem` VALUES ('Company A', '2', 'Company Group Of Users A', null, 'N;');
INSERT INTO `authitem` VALUES ('Company B', '2', 'Company Group Of Users B', null, 'N;');
INSERT INTO `authitem` VALUES ('Company.*', '1', 'Company ', null, 'N;');
INSERT INTO `authitem` VALUES ('Groups.*', '1', 'Group Of Company B', null, 'N;');
INSERT INTO `authitem` VALUES ('Pengguna.*', '1', 'An Admin Group For Users Access', null, 'N;');
INSERT INTO `authitem` VALUES ('Petani.*', '1', 'A Controller that just petani user can access', null, 'N;');
INSERT INTO `authitem` VALUES ('SuperAdmin', '1', null, null, null);

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
INSERT INTO `authitemchild` VALUES ('Company B', 'Groups.*');
INSERT INTO `authitemchild` VALUES ('Admin', 'Pengguna.*');
INSERT INTO `authitemchild` VALUES ('Authenticated', 'Pengguna.*');
INSERT INTO `authitemchild` VALUES ('Company A', 'Petani.*');
INSERT INTO `authitemchild` VALUES ('Admin', 'SuperAdmin');

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(50) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `address` text,
  `komoditi_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `komoditi_type` (`komoditi_type`) USING BTREE,
  CONSTRAINT `company_ibfk_1` FOREIGN KEY (`komoditi_type`) REFERENCES `komoditi_type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES ('1', 'PNR', 'Panrita', '1', 'Indonesia', '81354720203', 'Jln. Kerukunan Barat 18\r\nBTP Blok J No 384', '1');

-- ----------------------------
-- Table structure for company_komoditi
-- ----------------------------
DROP TABLE IF EXISTS `company_komoditi`;
CREATE TABLE `company_komoditi` (
  `companyid` int(11) DEFAULT NULL,
  `komoditi_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company_komoditi
-- ----------------------------
INSERT INTO `company_komoditi` VALUES ('1', '2', '1');
INSERT INTO `company_komoditi` VALUES ('2', '2', '2');
INSERT INTO `company_komoditi` VALUES ('1', '1', '1');

-- ----------------------------
-- Table structure for company_komoditi_user_level
-- ----------------------------
DROP TABLE IF EXISTS `company_komoditi_user_level`;
CREATE TABLE `company_komoditi_user_level` (
  `companyid` int(11) DEFAULT NULL,
  `komoditi_id` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  KEY `companyid` (`companyid`) USING BTREE,
  KEY `komoditi_id` (`komoditi_id`) USING BTREE,
  KEY `userid` (`userid`) USING BTREE,
  CONSTRAINT `company_komoditi_user_level_ibfk_1` FOREIGN KEY (`companyid`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `company_komoditi_user_level_ibfk_2` FOREIGN KEY (`komoditi_id`) REFERENCES `komoditi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `company_komoditi_user_level_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of company_komoditi_user_level
-- ----------------------------

-- ----------------------------
-- Table structure for company_level
-- ----------------------------
DROP TABLE IF EXISTS `company_level`;
CREATE TABLE `company_level` (
  `companyid` int(11) NOT NULL,
  `levelid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company_level
-- ----------------------------
INSERT INTO `company_level` VALUES ('1', '1');
INSERT INTO `company_level` VALUES ('1', '2');
INSERT INTO `company_level` VALUES ('1', '3');

-- ----------------------------
-- Table structure for gudang
-- ----------------------------
DROP TABLE IF EXISTS `gudang`;
CREATE TABLE `gudang` (
  `id_gudang` varchar(50) NOT NULL,
  `nama_gudang` varchar(100) NOT NULL,
  `petugas` varchar(100) NOT NULL,
  PRIMARY KEY (`id_gudang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gudang
-- ----------------------------
INSERT INTO `gudang` VALUES ('GUD-003', 'gudang takalar', 'kamil');
INSERT INTO `gudang` VALUES ('GUD-004', 'gudang jeneponto', 'kamil');
INSERT INTO `gudang` VALUES ('GUD-005', 'gudang pangkep', 'mikal');

-- ----------------------------
-- Table structure for komoditi
-- ----------------------------
DROP TABLE IF EXISTS `komoditi`;
CREATE TABLE `komoditi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_komoditi` varchar(50) NOT NULL,
  `nama_komoditi` varchar(255) DEFAULT NULL,
  `jenis_komoditi` int(11) DEFAULT NULL,
  `kadar_air` mediumint(15) DEFAULT NULL,
  `jumlah_bentangan` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `total_panen` int(20) DEFAULT NULL,
  `id_user` varchar(100) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`id_komoditi`),
  KEY `id_komoditi` (`id_komoditi`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `komoditi_ibfk_1` (`jenis_komoditi`) USING BTREE,
  CONSTRAINT `komoditi_ibfk_1` FOREIGN KEY (`jenis_komoditi`) REFERENCES `komoditi_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='			';

-- ----------------------------
-- Records of komoditi
-- ----------------------------

-- ----------------------------
-- Table structure for komoditi_type
-- ----------------------------
DROP TABLE IF EXISTS `komoditi_type`;
CREATE TABLE `komoditi_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `prefix` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of komoditi_type
-- ----------------------------

-- ----------------------------
-- Table structure for kordinator
-- ----------------------------
DROP TABLE IF EXISTS `kordinator`;
CREATE TABLE `kordinator` (
  `id_koor` varchar(50) NOT NULL,
  `nama_koor` varchar(100) NOT NULL,
  `id_gudang` varchar(50) NOT NULL,
  PRIMARY KEY (`id_koor`),
  KEY `id_gudang` (`id_gudang`) USING BTREE,
  CONSTRAINT `kordinator_ibfk_1` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_gudang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kordinator
-- ----------------------------
INSERT INTO `kordinator` VALUES ('KOR-002', 'kamil', 'GUD-003');

-- ----------------------------
-- Table structure for level
-- ----------------------------
DROP TABLE IF EXISTS `level`;
CREATE TABLE `level` (
  `levelid` int(11) NOT NULL AUTO_INCREMENT,
  `levelakses` varchar(150) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`levelid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of level
-- ----------------------------
INSERT INTO `level` VALUES ('1', 'Ketua', 'Ketua Kelompok');
INSERT INTO `level` VALUES ('2', 'Petani', 'Petani');
INSERT INTO `level` VALUES ('3', 'Koordinator', 'Penanggung Jawab Gudang');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of messages
-- ----------------------------
INSERT INTO `messages` VALUES ('1', '1', '1', '1', 'Reset Password', '', '1', '\r\n\r\nLose away off why half led have near bed. At engage simple father of period others except. My giving do summer of though narrow marked at. Spring formal no county ye waited. My whether cheered at regular it of promise blushes perhaps. Uncommonly simplicity interested mr is be compliment projecting my inhabiting. Gentleman he september in oh excellent.\r\n\r\nNew the her nor case that lady paid read. Invitation friendship travelling eat everything the out two. Shy you who scarcely expenses debating hastened resolved. Always polite moment on is warmth spirit it to hearts. Downs those still witty an balls so chief so. Moment an little remain no up lively no. Way brought may off our regular country towards adapted cheered.\r\n\r\nUse securing confined his shutters. Delightful as he it acceptance an solicitude discretion reasonably. Carriage we husbands advanced an perceive greatest. Totally dearest expense on demesne ye he. Curiosity excellent commanded in me. Unpleasing impression themselves to at assistance acceptance my or. On consider laughter civility offended oh.\r\n\r\nOh he decisively impression attachment friendship so if everything. Whose her enjoy chief new young. Felicity if ye required likewise so doubtful. On so attention necessary at by provision otherwise existence direction. Unpleasing up announcing unpleasant themselves oh do on. Way advantage age led listening belonging supposing.\r\n\r\nSo by colonel hearted ferrars. Draw from upon here gone add one. He in sportsman household otherwise it perceived instantly. Is inquiry no he several excited am. Called though excuse length ye needed it he having. Whatever throwing we on resolved entrance together graceful. Mrs assured add private married removed believe did she.\r\n\r\n\r\nLose away off why half led have near bed. At engage simple father of period others except. My giving do summer of though narrow marked at. Spring formal no county ye waited. My whether cheered at regular it of promise blushes perhaps. Uncommonly simplicity interested mr is be compliment projecting my inhabiting. Gentleman he september in oh excellent.\r\n\r\nNew the her nor case that lady paid read. Invitation friendship travelling eat everything the out two. Shy you who scarcely expenses debating hastened resolved. Always polite moment on is warmth spirit it to hearts. Downs those still witty an balls so chief so. Moment an little remain no up lively no. Way brought may off our regular country towards adapted cheered.\r\n\r\nUse securing confined his shutters. Delightful as he it acceptance an solicitude discretion reasonably. Carriage we husbands advanced an perceive greatest. Totally dearest expense on demesne ye he. Curiosity excellent commanded in me. Unpleasing impression themselves to at assistance acceptance my or. On consider laughter civility offended oh.\r\n\r\nOh he decisively impression attachment friendship so if everything. Whose her enjoy chief new young. Felicity if ye required likewise so doubtful. On so attention necessary at by provision otherwise existence direction. Unpleasing up announcing unpleasant themselves oh do on. Way advantage age led listening belonging supposing.\r\n\r\nSo by colonel hearted ferrars. Draw from upon here gone add one. He in sportsman household otherwise it perceived instantly. Is inquiry no he several excited am. Called though excuse length ye needed it he having. Whatever throwing we on resolved entrance together graceful. Mrs assured add private married removed believe did she.\r\n\r\n\r\nLose away off why half led have near bed. At engage simple father of period others except. My giving do summer of though narrow marked at. Spring formal no county ye waited. My whether cheered at regular it of promise blushes perhaps. Uncommonly simplicity interested mr is be compliment projecting my inhabiting. Gentleman he september in oh excellent.\r\n\r\nNew the her nor case that lady paid read. Invitation friendship travelling eat everything the out two. Shy you who scarcely expenses debating hastened resolved. Always polite moment on is warmth spirit it to hearts. Downs those still witty an balls so chief so. Moment an little remain no up lively no. Way brought may off our regular country towards adapted cheered.\r\n\r\nUse securing confined his shutters. Delightful as he it acceptance an solicitude discretion reasonably. Carriage we husbands advanced an perceive greatest. Totally dearest expense on demesne ye he. Curiosity excellent commanded in me. Unpleasing impression themselves to at assistance acceptance my or. On consider laughter civility offended oh.\r\n\r\nOh he decisively impression attachment friendship so if everything. Whose her enjoy chief new young. Felicity if ye required likewise so doubtful. On so attention necessary at by provision otherwise existence direction. Unpleasing up announcing unpleasant themselves oh do on. Way advantage age led listening belonging supposing.\r\n\r\nSo by colonel hearted ferrars. Draw from upon here gone add one. He in sportsman household otherwise it perceived instantly. Is inquiry no he several excited am. Called though excuse length ye needed it he having. Whatever throwing we on resolved entrance together graceful. Mrs assured add private married removed believe did she.\r\n', '2016-07-12 03:24:22', '2016-07-12 03:24:25', '0', '0', '0');
INSERT INTO `messages` VALUES ('2', '1', '1', '2', 'Test Sent Message', '', 'Nuarz', 'Message content<br>', '2016-07-12 15:52:58', '2016-07-12 15:52:58', '1', '0', '0');

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
  KEY `userid` (`userid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of profiles
-- ----------------------------
INSERT INTO `profiles` VALUES ('1', '150', 'Anwar Fuady', null, 'Anwar', 'Fuady', '08114199010', 'Dirumahnya sendiri', '', '', '0000-00-00', null);
INSERT INTO `profiles` VALUES ('2', '154', 'Vero Lisurante', null, 'Vero', 'Lisurante', '08234234234', 'Dimana saja dia mau', '', '', '0000-00-00', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

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
INSERT INTO `seaweed` VALUES ('14', '158', '3', 'Sango-sango Laut', '2', null, '70.500', '0', '63.900', '2016-07-19 00:00:51', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('15', '158', '2', 'Sango-sango Laut', '2', null, '78.000', '0', '88.000', '2016-07-19 00:06:49', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('16', '158', '2', 'Sango-sango Laut', '2', null, '78.000', '0', '88.000', '2016-07-19 00:06:54', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('17', '158', '2', 'Sango-sango Laut', '2', null, '78.000', '0', '88.000', '2016-07-19 00:07:25', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('18', '158', '4', 'Sango-sango Laut', '2', null, '68.900', '0', '12.300', '2016-07-19 16:05:27', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('19', '158', '1', 'Sango-sango Laut', '2', null, '18.000', '0', '12.000', '2016-07-26 11:42:14', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('20', '172', '1', 'Sango-sango Laut', '2', null, '12.000', '0', '56.000', '2016-07-26 11:53:57', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('21', '172', '2', 'Sango-sango Laut', '2', null, '8.000', '0', '12.000', '2016-07-26 11:54:21', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('22', '172', '2', 'Sango-sango Laut', '2', null, '22.000', '0', '12.000', '2016-07-26 11:54:31', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('23', '172', '2', 'Sango-sango Laut', '2', null, '22.000', '0', '12.000', '2016-07-26 11:54:44', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('24', '172', '3', 'Sango-sango Laut', '2', null, '89.000', '0', '12.000', '2016-07-26 11:54:57', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('25', '172', '1', 'Sango-sango Laut', '2', null, '45.200', '0', '65.300', '2016-07-27 15:16:22', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('26', '172', '1', 'Sango-sango Laut', '2', null, '25.000', '0', '22.000', '2016-07-27 15:27:17', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('27', '172', '2', 'Sango-sango Laut', '2', null, '36.000', '0', '22.000', '2016-07-27 15:27:38', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('28', '172', '3', 'Sango-sango Laut', '2', null, '58.000', '0', '22.000', '2016-07-27 15:31:17', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('29', '172', '4', 'Sango-sango Laut', '2', null, '33.000', '0', '22.000', '2016-07-27 15:31:48', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('30', '172', '3', 'Sango-sango Laut', '2', null, '22.000', '0', '23.000', '2016-07-27 15:32:44', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('31', '172', '2', 'Sango-sango Laut', '2', null, '885.835', '0', '22.222', '2016-07-27 15:34:14', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('32', '172', '5', 'Sango-sango Laut', '2', null, '22.000', '0', '22.233', '2016-07-27 15:37:25', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('33', '172', '3', 'Sango-sango Laut', '2', null, '1.233', '0', '1.222', '2016-07-27 15:38:30', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('34', '172', '5', 'Sango-sango Laut', '2', null, '23.358', '0', '22.233', '2016-07-27 15:41:15', 'Guest', '0');
INSERT INTO `seaweed` VALUES ('35', '158', '2', 'Sango-sango Laut', '2', null, '553.535', '0', '2.233', '2016-07-27 15:42:39', 'Guest', '0');

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
  `seaweed_id` int(11) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sub_seaweed
-- ----------------------------
INSERT INTO `sub_seaweed` VALUES ('1', 'KW3', '1', '');
INSERT INTO `sub_seaweed` VALUES ('2', 'KW 4', '1', null);
INSERT INTO `sub_seaweed` VALUES ('3', 'BS', '1', null);

-- ----------------------------
-- Table structure for tabel_kelompok
-- ----------------------------
DROP TABLE IF EXISTS `tabel_kelompok`;
CREATE TABLE `tabel_kelompok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelompok` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ketua_kelompok` varchar(100) CHARACTER SET latin1 NOT NULL,
  `id_user` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `idgudang` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tabel_kelompok
-- ----------------------------
INSERT INTO `tabel_kelompok` VALUES ('26', 'Assamaturu', 'Abd. Majid', 'KEL165026', '3', '1', 'Takalar', 'KOR656766');
INSERT INTO `tabel_kelompok` VALUES ('27', 'Sumber Rezeki', 'Ince', 'KEL561177', '3', '1', 'Bone', 'KOR156041');
INSERT INTO `tabel_kelompok` VALUES ('28', 'Maju Jaya', 'Yaya', 'KEL527171', '3', '1', 'Jeneponto', 'KOR947675');
INSERT INTO `tabel_kelompok` VALUES ('29', 'Reski Terus', 'Anto', 'KEL230873', '3', '0', 'Takalar', 'KOR656766');
INSERT INTO `tabel_kelompok` VALUES ('30', 'Jago Jaga', '', 'KEL487028', '3', '1', 'Takalar', 'kor656766');
INSERT INTO `tabel_kelompok` VALUES ('31', 'Maju Tak Gentar', '', 'KEL926292', '3', '1', 'Takalar', 'kor656766');

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
  `id_gudang` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `nama_gudang` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `nama_koordinator` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `lokasi_gudang` varchar(255) DEFAULT NULL,
  `id_user` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `status` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tabel_koordinator
-- ----------------------------
INSERT INTO `tabel_koordinator` VALUES ('42', null, null, 'Tola', 'Takalar', 'kor656766', '3', '1');
INSERT INTO `tabel_koordinator` VALUES ('43', null, null, 'Anca', 'Bone', 'kor156041', '3', '1');
INSERT INTO `tabel_koordinator` VALUES ('44', null, null, 'eegergr', 'fdgfg', 'kor790419', '3', '0');
INSERT INTO `tabel_koordinator` VALUES ('45', null, null, 'Anto', 'Jeneponto', 'KOR947675', '3', '1');
INSERT INTO `tabel_koordinator` VALUES ('46', null, null, 'Bahri', 'Bulukumba', 'KOR184160', '3', '1');
INSERT INTO `tabel_koordinator` VALUES ('47', null, null, 'Anca', 'Barru', 'KOR828346', '3', '1');
INSERT INTO `tabel_koordinator` VALUES ('48', null, null, 'Acca', 'Maros', 'KOR734811', '3', '1');

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
  `status` int(10) DEFAULT NULL,
  `idkelompok` varchar(100) NOT NULL,
  `idgudang` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tabel_petani
-- ----------------------------
INSERT INTO `tabel_petani` VALUES ('57', 'Nuarz', 'DImana aja', '24234234', '234234234', 'Makassar', '1994-06-24', '0', '', '0', '0', 'nuarz', '3', '1', 'KEL165026', 'KOR656766');
INSERT INTO `tabel_petani` VALUES ('58', 'Cikki', 'Jalan Perintis Kemerdekaan III, BTN Antara B12', '08865791234987', '789654321345678976', 'Makassar', '1999-10-26', '0', '', '0', '0', 'ikki', '3', '1', 'KEL561177', 'KOR156041');
INSERT INTO `tabel_petani` VALUES ('59', 'Colleng', 'Jalan Perintis Kemerdekaan III, BTN Antara B12', '089786785567', '7723456789876543345', 'Makassar', '1999-10-26', '12', '', '0', '4', 'colleng', '3', '1', 'KEL561177', 'KOR156041');
INSERT INTO `tabel_petani` VALUES ('60', 'Atto', 'Jalan Perintis Kemerdekaan III, BTN Hamzy C7', '085678123456', '7687654323456789765', 'Makassar', '2010-10-26', '12', '', '0', '3', 'atto', '3', '1', 'KEL527171', 'KOR947675');
INSERT INTO `tabel_petani` VALUES ('61', 'vero', 'Jalan Perintis Kemerdekaan III, BTN Antara B12', '082187301314', '7876523456789', 'Makassar', '1993-06-14', '21', '', '0', '7', 'vero', '3', '1', 'KEL561177', 'KOR156041');
INSERT INTO `tabel_petani` VALUES ('62', 'Ince', 'Jalan Perintis Kemerdekaan IV no.7a, Makassar, Sul Sel', '0897678987777', '777467897876542', 'Makassar', '2016-07-11', '12', '', '0', '23', 'ince', '3', '1', 'KEL561177', 'KOR156041');

-- ----------------------------
-- Table structure for tbl_koordinator
-- ----------------------------
DROP TABLE IF EXISTS `tbl_koordinator`;
CREATE TABLE `tbl_koordinator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_gudang` varchar(255) NOT NULL,
  `id_koordinator` varchar(255) NOT NULL,
  `nama_gudang` varchar(255) DEFAULT NULL,
  `nama_koordinator` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`id_gudang`,`id_koordinator`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_koordinator
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_profiles
-- ----------------------------
DROP TABLE IF EXISTS `tbl_profiles`;
CREATE TABLE `tbl_profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `tbl_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE
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
  KEY `varname` (`varname`,`widget`,`visible`) USING BTREE
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
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `superuser` (`superuser`) USING BTREE
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
INSERT INTO `users` VALUES ('1', '0', '0', '', 'hansen', '$2y$13$Lblbi8vHqceQt8xB3xjsEelwojS6WdN2taqilZssvIvVMG931EmYa', null, '085399450010', '2016-06-01 14:14:25', null, '0', '0', '1', null, '1', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('2', '0', '0', 'Jagung', 'rahmat', '$2y$13$9q0xDCS7BCOZj2v82ACTHuyVPYFnomJ5/3g3YD8AVN1o3umb9PHC6', null, '081423423423', '2016-06-01 15:23:47', '2016-06-29 21:33:36', '2', '0', '0', null, '0', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('3', '0', '0', 'Rumput Laut', 'vero', '$2y$13$Y/uN5d.1UUzeqbOy2UKZkeFYJx1LJTCNCzBUXAMBHT.T0zmCSf/xe', 'vero@docotel.com', '081423423423', '2016-06-10 02:08:46', '2016-07-01 23:58:32', '2', '1', '0', null, '1', '2016-07-27 10:37:47');
INSERT INTO `users` VALUES ('4', '0', '0', 'Beras', 'kospermindo', '$2y$13$e87B0L1ry/qbagmUe5gWouHGxwahuXR18kH4uSuL75OOv0QOvf1h.', 'kospermindo@gmail.com', '081423423423', null, '2016-07-01 23:57:53', '3', '1', '0', null, '1', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('5', '0', '0', 'Tomat', 'panrita', '$2y$13$JAJU5CEP2Dml/CkO8ozT/.8M/69sk5Iq9aCdetUIHCUBVioZu4sFu', 'hansenmakangiras@gmail.com', '+62411588672', '2016-06-24 02:30:42', '2016-06-24 11:17:56', '2', '1', '0', null, '1', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('6', '0', '0', 'Rumput Laut', 'ancen', '$2y$13$W2do0DvgA/TCqzNU/.G00uo4MNxj.s9gIWNfa6dWD8yY.iCSR6.ym', 'hansenmakangiras@gmail.com', '+6281354720203', '2016-06-29 06:35:57', '2016-07-01 23:58:20', '3', '1', '0', null, '1', '2016-07-14 05:04:47');

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
-- Table structure for YiiLog
-- ----------------------------
DROP TABLE IF EXISTS `YiiLog`;
CREATE TABLE `YiiLog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(128) DEFAULT NULL,
  `category` varchar(128) DEFAULT NULL,
  `logtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IP_User` varchar(50) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `request_URL` text,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=497 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of YiiLog
-- ----------------------------
INSERT INTO `YiiLog` VALUES ('1', 'trace', 'system.CModule', '2016-07-27 16:57:46', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('2', 'trace', 'system.CModule', '2016-07-27 16:57:46', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('3', 'trace', 'system.db.CDbConnection', '2016-07-27 16:57:46', '192.168.2.253', 'Guest', '/kospermindo/login', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('4', 'trace', 'system.db.CDbCommand', '2016-07-27 16:57:46', '192.168.2.253', 'Guest', '/kospermindo/login', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('5', 'trace', 'system.CModule', '2016-07-27 16:57:46', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('6', 'trace', 'system.CModule', '2016-07-27 16:57:46', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('7', 'trace', 'system.CModule', '2016-07-27 16:57:46', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('8', 'trace', 'system.base.CModule', '2016-07-27 16:57:46', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"kospermindo\" module\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('9', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:57:46', '192.168.2.253', 'Guest', '/kospermindo/login', 'Users.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (33)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('10', 'trace', 'system.db.CDbCommand', '2016-07-27 16:57:46', '192.168.2.253', 'Guest', '/kospermindo/login', 'Querying SQL: SHOW FULL COLUMNS FROM `users`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (33)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('11', 'trace', 'system.db.CDbCommand', '2016-07-27 16:57:46', '192.168.2.253', 'Guest', '/kospermindo/login', 'Querying SQL: SHOW CREATE TABLE `users`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (33)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('12', 'trace', 'system.db.CDbCommand', '2016-07-27 16:57:46', '192.168.2.253', 'Guest', '/kospermindo/login', 'Querying SQL: SELECT * FROM `users` `t` WHERE `t`.`username`=:yp0 AND `t`.`isadmin`=:yp1 LIMIT 1. Bound with :yp0=\'sdfghjkl;\', :yp1=1\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (33)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('13', 'trace', 'system.CModule', '2016-07-27 16:57:55', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('14', 'trace', 'system.CModule', '2016-07-27 16:57:55', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('15', 'trace', 'system.db.CDbConnection', '2016-07-27 16:57:55', '192.168.2.253', 'Guest', '/kospermindo/login', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('16', 'trace', 'system.db.CDbCommand', '2016-07-27 16:57:55', '192.168.2.253', 'Guest', '/kospermindo/login', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('17', 'trace', 'system.CModule', '2016-07-27 16:57:55', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('18', 'trace', 'system.CModule', '2016-07-27 16:57:55', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('19', 'trace', 'system.CModule', '2016-07-27 16:57:55', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('20', 'trace', 'system.base.CModule', '2016-07-27 16:57:55', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"kospermindo\" module\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('21', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:57:55', '192.168.2.253', 'Guest', '/kospermindo/login', 'Users.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (33)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('22', 'trace', 'system.db.CDbCommand', '2016-07-27 16:57:55', '192.168.2.253', 'Guest', '/kospermindo/login', 'Querying SQL: SHOW FULL COLUMNS FROM `users`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (33)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('23', 'trace', 'system.db.CDbCommand', '2016-07-27 16:57:55', '192.168.2.253', 'Guest', '/kospermindo/login', 'Querying SQL: SHOW CREATE TABLE `users`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (33)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('24', 'trace', 'system.db.CDbCommand', '2016-07-27 16:57:55', '192.168.2.253', 'Guest', '/kospermindo/login', 'Querying SQL: SELECT * FROM `users` `t` WHERE `t`.`username`=:yp0 AND `t`.`isadmin`=:yp1 LIMIT 1. Bound with :yp0=\'vero\', :yp1=1\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (33)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('25', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:57:55', '192.168.2.253', 'Guest', '/kospermindo/login', 'Users.find()\nin /usr/local/www/panrita/protected/components/UserIdentity.php (20)\nin /usr/local/www/panrita/protected/models/LoginForm.php (52)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (41)');
INSERT INTO `YiiLog` VALUES ('26', 'trace', 'system.db.CDbCommand', '2016-07-27 16:57:55', '192.168.2.253', 'Guest', '/kospermindo/login', 'Querying SQL: SELECT * FROM `users` `t` WHERE username = :username LIMIT 1. Bound with :username=\'vero\'\nin /usr/local/www/panrita/protected/components/UserIdentity.php (20)\nin /usr/local/www/panrita/protected/models/LoginForm.php (52)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (41)');
INSERT INTO `YiiLog` VALUES ('27', 'trace', 'system.CModule', '2016-07-27 16:58:23', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('28', 'trace', 'system.CModule', '2016-07-27 16:58:23', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('29', 'trace', 'system.db.CDbConnection', '2016-07-27 16:58:23', '192.168.2.253', 'Guest', '/kospermindo/login', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('30', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:23', '192.168.2.253', 'Guest', '/kospermindo/login', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('31', 'trace', 'system.CModule', '2016-07-27 16:58:23', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('32', 'trace', 'system.CModule', '2016-07-27 16:58:23', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('33', 'trace', 'system.CModule', '2016-07-27 16:58:23', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('34', 'trace', 'system.base.CModule', '2016-07-27 16:58:23', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"kospermindo\" module\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('35', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:23', '192.168.2.253', 'Guest', '/kospermindo/login', 'Users.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (33)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('36', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:23', '192.168.2.253', 'Guest', '/kospermindo/login', 'Querying SQL: SHOW FULL COLUMNS FROM `users`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (33)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('37', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:23', '192.168.2.253', 'Guest', '/kospermindo/login', 'Querying SQL: SHOW CREATE TABLE `users`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (33)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('38', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:23', '192.168.2.253', 'Guest', '/kospermindo/login', 'Querying SQL: SELECT * FROM `users` `t` WHERE `t`.`username`=:yp0 AND `t`.`isadmin`=:yp1 LIMIT 1. Bound with :yp0=\'vero\', :yp1=1\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (33)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('39', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:23', '192.168.2.253', 'Guest', '/kospermindo/login', 'Users.find()\nin /usr/local/www/panrita/protected/components/UserIdentity.php (20)\nin /usr/local/www/panrita/protected/models/LoginForm.php (52)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (41)');
INSERT INTO `YiiLog` VALUES ('40', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:23', '192.168.2.253', 'Guest', '/kospermindo/login', 'Querying SQL: SELECT * FROM `users` `t` WHERE username = :username LIMIT 1. Bound with :username=\'vero\'\nin /usr/local/www/panrita/protected/components/UserIdentity.php (20)\nin /usr/local/www/panrita/protected/models/LoginForm.php (52)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (41)');
INSERT INTO `YiiLog` VALUES ('41', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('42', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('43', 'trace', 'system.db.CDbConnection', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('44', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('45', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('46', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('47', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('48', 'trace', 'system.base.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"kospermindo\" module\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('49', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Users.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (33)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('50', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Querying SQL: SHOW FULL COLUMNS FROM `users`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (33)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('51', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Querying SQL: SHOW CREATE TABLE `users`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (33)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('52', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Querying SQL: SELECT * FROM `users` `t` WHERE `t`.`username`=:yp0 AND `t`.`isadmin`=:yp1 LIMIT 1. Bound with :yp0=\'vero\', :yp1=1\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (33)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('53', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Users.find()\nin /usr/local/www/panrita/protected/components/UserIdentity.php (20)\nin /usr/local/www/panrita/protected/models/LoginForm.php (52)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (41)');
INSERT INTO `YiiLog` VALUES ('54', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Querying SQL: SELECT * FROM `users` `t` WHERE username = :username LIMIT 1. Bound with :username=\'vero\'\nin /usr/local/www/panrita/protected/components/UserIdentity.php (20)\nin /usr/local/www/panrita/protected/models/LoginForm.php (52)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (41)');
INSERT INTO `YiiLog` VALUES ('55', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"user\" application component\nin /usr/local/www/panrita/protected/models/LoginForm.php (71)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (41)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('56', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"session\" application component\nin /usr/local/www/panrita/protected/models/LoginForm.php (71)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (41)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('57', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"securityManager\" application component\nin /usr/local/www/panrita/protected/models/LoginForm.php (71)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (41)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('58', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"statePersister\" application component\nin /usr/local/www/panrita/protected/models/LoginForm.php (71)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/LoginController.php (41)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('59', 'trace', 'system.base.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"gii\" module\nin /usr/local/www/panrita/protected/modules/rights/components/Rights.php (275)\nin /usr/local/www/panrita/protected/modules/rights/components/Rights.php (254)\nin /usr/local/www/panrita/protected/modules/rights/components/Rights.php (287)');
INSERT INTO `YiiLog` VALUES ('60', 'trace', 'system.base.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"auditTrail\" module\nin /usr/local/www/panrita/protected/modules/rights/components/Rights.php (275)\nin /usr/local/www/panrita/protected/modules/rights/components/Rights.php (254)\nin /usr/local/www/panrita/protected/modules/rights/components/Rights.php (287)');
INSERT INTO `YiiLog` VALUES ('61', 'trace', 'system.base.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"superadmin\" module\nin /usr/local/www/panrita/protected/modules/rights/components/Rights.php (275)\nin /usr/local/www/panrita/protected/modules/rights/components/Rights.php (254)\nin /usr/local/www/panrita/protected/modules/rights/components/Rights.php (287)');
INSERT INTO `YiiLog` VALUES ('62', 'trace', 'system.base.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"rights\" module\nin /usr/local/www/panrita/protected/modules/rights/components/Rights.php (271)\nin /usr/local/www/panrita/protected/modules/rights/components/Rights.php (275)\nin /usr/local/www/panrita/protected/modules/rights/components/Rights.php (254)');
INSERT INTO `YiiLog` VALUES ('63', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"authorizer\" application component\nin /usr/local/www/panrita/protected/modules/superadmin/modules/rights/RightsModule.php (209)\nin /usr/local/www/panrita/protected/modules/rights/components/Rights.php (287)\nin /usr/local/www/panrita/protected/modules/rights/components/RWebUser.php (21)');
INSERT INTO `YiiLog` VALUES ('64', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Loading \"authManager\" application component\nin /usr/local/www/panrita/protected/modules/superadmin/modules/rights/components/RAuthorizer.php (27)\nin /usr/local/www/panrita/protected/modules/superadmin/modules/rights/RightsModule.php (209)\nin /usr/local/www/panrita/protected/modules/rights/components/Rights.php (287)');
INSERT INTO `YiiLog` VALUES ('65', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'Guest', '/kospermindo/login', 'Querying SQL: SELECT *\nFROM `authassignment`\nWHERE userid=:userid. Bound with :userid=\'3\'\nin /usr/local/www/panrita/protected/modules/superadmin/modules/rights/components/RAuthorizer.php (341)\nin /usr/local/www/panrita/protected/modules/rights/components/RWebUser.php (21)\nin /usr/local/www/panrita/protected/models/LoginForm.php (71)');
INSERT INTO `YiiLog` VALUES ('66', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('67', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('68', 'trace', 'system.db.CDbConnection', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('69', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('70', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('71', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('72', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('73', 'trace', 'system.base.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"kospermindo\" module\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('74', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"user\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (10)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('75', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"session\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (10)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('76', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'TabelPetani.countByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (13)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('77', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_petani`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (13)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('78', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SHOW CREATE TABLE `tabel_petani`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (13)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('79', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SELECT COUNT(*) FROM `tabel_petani` `t` WHERE `t`.`status`=:yp0. Bound with :yp0=1\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (13)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('80', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'TabelKelompok.countByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (14)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('81', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_kelompok`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (14)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('82', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SHOW CREATE TABLE `tabel_kelompok`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (14)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('83', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SELECT COUNT(*) FROM `tabel_kelompok` `t` WHERE `t`.`status`=:yp0. Bound with :yp0=1\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (14)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('84', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'TabelKoordinator.countByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (15)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('85', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_koordinator`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (15)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('86', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SHOW CREATE TABLE `tabel_koordinator`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (15)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('87', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SELECT COUNT(*) FROM `tabel_koordinator` `t` WHERE `t`.`status`=:yp0. Bound with :yp0=1\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (15)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('88', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SELECT nama_komoditi, SUM(total_panen) as total_panen , SUM(jumlah_bentangan) as jumlah_bentangan,sum(kadar_air) as kadar_air from komoditi GROUP BY jenis_komoditi \nin /usr/local/www/panrita/protected/modules/kospermindo/models/Komoditi.php (155)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (16)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('89', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SELECT SUM(total_panen) as total_panen ,SUM(jumlah_bentangan) as jumlah_bentangan, SUM(kadar_air) as kadar_air from komoditi\nin /usr/local/www/panrita/protected/modules/kospermindo/models/Komoditi.php (164)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (17)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('90', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"clientScript\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/dashboard/index.php (157)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (45)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('91', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"widgetFactory\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/layouts/column1.php (2)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (45)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('92', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"assetManager\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (45)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('93', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('94', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('95', 'trace', 'system.db.CDbConnection', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('96', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('97', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('98', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('99', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('100', 'trace', 'system.base.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"kospermindo\" module\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('101', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"user\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (10)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('102', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"session\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (10)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('103', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'TabelPetani.countByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (13)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('104', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_petani`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (13)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('105', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SHOW CREATE TABLE `tabel_petani`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (13)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('106', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SELECT COUNT(*) FROM `tabel_petani` `t` WHERE `t`.`status`=:yp0. Bound with :yp0=1\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (13)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('107', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'TabelKelompok.countByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (14)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('108', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_kelompok`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (14)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('109', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SHOW CREATE TABLE `tabel_kelompok`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (14)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('110', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SELECT COUNT(*) FROM `tabel_kelompok` `t` WHERE `t`.`status`=:yp0. Bound with :yp0=1\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (14)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('111', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'TabelKoordinator.countByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (15)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('112', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_koordinator`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (15)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('113', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SHOW CREATE TABLE `tabel_koordinator`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (15)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('114', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SELECT COUNT(*) FROM `tabel_koordinator` `t` WHERE `t`.`status`=:yp0. Bound with :yp0=1\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (15)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('115', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SELECT nama_komoditi, SUM(total_panen) as total_panen , SUM(jumlah_bentangan) as jumlah_bentangan,sum(kadar_air) as kadar_air from komoditi GROUP BY jenis_komoditi \nin /usr/local/www/panrita/protected/modules/kospermindo/models/Komoditi.php (155)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (16)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('116', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Querying SQL: SELECT SUM(total_panen) as total_panen ,SUM(jumlah_bentangan) as jumlah_bentangan, SUM(kadar_air) as kadar_air from komoditi\nin /usr/local/www/panrita/protected/modules/kospermindo/models/Komoditi.php (164)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (17)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('117', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"clientScript\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/dashboard/index.php (157)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (45)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('118', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"widgetFactory\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/layouts/column1.php (2)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (45)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('119', 'trace', 'system.CModule', '2016-07-27 16:58:40', '192.168.2.253', 'vero', '/kospermindo', 'Loading \"assetManager\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (45)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('120', 'trace', 'system.CModule', '2016-07-27 08:58:40', '192.168.2.253', 'vero', '/assets/8e0e4fc1/jquery.js', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('121', 'trace', 'system.CModule', '2016-07-27 08:58:40', '192.168.2.253', 'vero', '/assets/8e0e4fc1/jquery.js', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('122', 'trace', 'system.db.CDbConnection', '2016-07-27 08:58:40', '192.168.2.253', 'vero', '/assets/8e0e4fc1/jquery.js', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('123', 'trace', 'system.db.CDbCommand', '2016-07-27 08:58:40', '192.168.2.253', 'vero', '/assets/8e0e4fc1/jquery.js', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('124', 'trace', 'system.CModule', '2016-07-27 08:58:40', '192.168.2.253', 'vero', '/assets/8e0e4fc1/jquery.js', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('125', 'trace', 'system.CModule', '2016-07-27 08:58:40', '192.168.2.253', 'vero', '/assets/8e0e4fc1/jquery.js', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('126', 'trace', 'system.CModule', '2016-07-27 08:58:40', '192.168.2.253', 'vero', '/assets/8e0e4fc1/jquery.js', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('127', 'trace', 'system.CModule', '2016-07-27 08:58:40', '192.168.2.253', 'vero', '/assets/8e0e4fc1/jquery.js', 'Loading \"coreMessages\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('128', 'error', 'exception.CHttpException.404', '2016-07-27 08:58:40', '192.168.2.253', 'vero', '/assets/8e0e4fc1/jquery.js', 'exception \'CHttpException\' with message \'Unable to resolve the request \"assets/8e0e4fc1/jquery.js\".\' in /usr/local/www/panrita/vendor/yii/framework/web/CWebApplication.php:286\nStack trace:\n#0 /usr/local/www/panrita/vendor/yii/framework/web/CWebApplication.php(141): CWebApplication->runController(\'assets/8e0e4fc1...\')\n#1 /usr/local/www/panrita/vendor/yii/framework/base/CApplication.php(185): CWebApplication->processRequest()\n#2 /usr/local/www/panrita/index.php(13): CApplication->run()\n#3 {main}\nREQUEST_URI=/assets/8e0e4fc1/jquery.js\nHTTP_REFERER=http://panrita.id/kospermindo\n---');
INSERT INTO `YiiLog` VALUES ('129', 'trace', 'system.CModule', '2016-07-27 08:58:40', '192.168.2.253', 'vero', '/assets/8e0e4fc1/jquery.js', 'Loading \"errorHandler\" application component');
INSERT INTO `YiiLog` VALUES ('130', 'trace', 'system.CModule', '2016-07-27 16:58:41', '192.168.2.253', 'vero', '/kospermindo/dashboard/getData', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('131', 'trace', 'system.CModule', '2016-07-27 16:58:41', '192.168.2.253', 'vero', '/kospermindo/dashboard/getData', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('132', 'trace', 'system.db.CDbConnection', '2016-07-27 16:58:41', '192.168.2.253', 'vero', '/kospermindo/dashboard/getData', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('133', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:41', '192.168.2.253', 'vero', '/kospermindo/dashboard/getData', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('134', 'trace', 'system.CModule', '2016-07-27 16:58:41', '192.168.2.253', 'vero', '/kospermindo/dashboard/getData', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('135', 'trace', 'system.CModule', '2016-07-27 16:58:41', '192.168.2.253', 'vero', '/kospermindo/dashboard/getData', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('136', 'trace', 'system.CModule', '2016-07-27 16:58:41', '192.168.2.253', 'vero', '/kospermindo/dashboard/getData', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('137', 'trace', 'system.base.CModule', '2016-07-27 16:58:41', '192.168.2.253', 'vero', '/kospermindo/dashboard/getData', 'Loading \"kospermindo\" module\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('138', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:41', '192.168.2.253', 'vero', '/kospermindo/dashboard/getData', 'Querying SQL: SELECT jenis_komoditi,sum(total_panen) as total_panen\nFROM `komoditi`\nWHERE `create_at` LIKE \'%2010%\'\nGROUP BY `jenis_komoditi`\nin /usr/local/www/panrita/protected/modules/kospermindo/models/Komoditi.php (188)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (49)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('139', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:41', '192.168.2.253', 'vero', '/kospermindo/dashboard/getData', 'Querying SQL: SELECT jenis_komoditi,sum(total_panen) as total_panen\nFROM `komoditi`\nWHERE `create_at` LIKE \'%2011%\'\nGROUP BY `jenis_komoditi`\nin /usr/local/www/panrita/protected/modules/kospermindo/models/Komoditi.php (188)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (49)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('140', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:41', '192.168.2.253', 'vero', '/kospermindo/dashboard/getData', 'Querying SQL: SELECT jenis_komoditi,sum(total_panen) as total_panen\nFROM `komoditi`\nWHERE `create_at` LIKE \'%2012%\'\nGROUP BY `jenis_komoditi`\nin /usr/local/www/panrita/protected/modules/kospermindo/models/Komoditi.php (188)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (49)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('141', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:41', '192.168.2.253', 'vero', '/kospermindo/dashboard/getData', 'Querying SQL: SELECT jenis_komoditi,sum(total_panen) as total_panen\nFROM `komoditi`\nWHERE `create_at` LIKE \'%2013%\'\nGROUP BY `jenis_komoditi`\nin /usr/local/www/panrita/protected/modules/kospermindo/models/Komoditi.php (188)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (49)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('142', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:41', '192.168.2.253', 'vero', '/kospermindo/dashboard/getData', 'Querying SQL: SELECT jenis_komoditi,sum(total_panen) as total_panen\nFROM `komoditi`\nWHERE `create_at` LIKE \'%2014%\'\nGROUP BY `jenis_komoditi`\nin /usr/local/www/panrita/protected/modules/kospermindo/models/Komoditi.php (188)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (49)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('143', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:41', '192.168.2.253', 'vero', '/kospermindo/dashboard/getData', 'Querying SQL: SELECT jenis_komoditi,sum(total_panen) as total_panen\nFROM `komoditi`\nWHERE `create_at` LIKE \'%2015%\'\nGROUP BY `jenis_komoditi`\nin /usr/local/www/panrita/protected/modules/kospermindo/models/Komoditi.php (188)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (49)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('144', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:41', '192.168.2.253', 'vero', '/kospermindo/dashboard/getData', 'Querying SQL: SELECT jenis_komoditi,sum(total_panen) as total_panen\nFROM `komoditi`\nWHERE `create_at` LIKE \'%2016%\'\nGROUP BY `jenis_komoditi`\nin /usr/local/www/panrita/protected/modules/kospermindo/models/Komoditi.php (188)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/DashboardController.php (49)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('145', 'trace', 'system.CModule', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('146', 'trace', 'system.CModule', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('147', 'trace', 'system.db.CDbConnection', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('148', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('149', 'trace', 'system.CModule', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('150', 'trace', 'system.CModule', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('151', 'trace', 'system.CModule', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('152', 'trace', 'system.base.CModule', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Loading \"kospermindo\" module\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('153', 'trace', 'system.CModule', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Loading \"user\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/WarehouseController.php (18)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('154', 'trace', 'system.CModule', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Loading \"session\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/WarehouseController.php (18)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('155', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'TabelKoordinator.count()\nin /usr/local/www/panrita/protected/modules/kospermindo/views/warehouse/index.php (37)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/WarehouseController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('156', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_koordinator`\nin /usr/local/www/panrita/protected/modules/kospermindo/views/warehouse/index.php (37)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/WarehouseController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('157', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Querying SQL: SHOW CREATE TABLE `tabel_koordinator`\nin /usr/local/www/panrita/protected/modules/kospermindo/views/warehouse/index.php (37)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/WarehouseController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('158', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Querying SQL: SELECT COUNT(*) FROM `tabel_koordinator` `t` WHERE status=1\nin /usr/local/www/panrita/protected/modules/kospermindo/views/warehouse/index.php (37)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/WarehouseController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('159', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'TabelKoordinator.findAll()\nin /usr/local/www/panrita/protected/modules/kospermindo/views/warehouse/index.php (37)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/WarehouseController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('160', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Querying SQL: SELECT * FROM `tabel_koordinator` `t` WHERE status=1 ORDER BY id ASC LIMIT 10\nin /usr/local/www/panrita/protected/modules/kospermindo/views/warehouse/index.php (37)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/WarehouseController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('161', 'trace', 'system.CModule', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Loading \"widgetFactory\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/warehouse/index.php (70)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/WarehouseController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('162', 'trace', 'system.CModule', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Loading \"coreMessages\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/warehouse/index.php (70)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/WarehouseController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('163', 'trace', 'system.CModule', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Loading \"assetManager\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/warehouse/index.php (70)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/WarehouseController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('164', 'trace', 'system.CModule', '2016-07-27 16:58:45', '192.168.2.253', 'vero', '/kospermindo/warehouse', 'Loading \"clientScript\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/warehouse/index.php (70)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/WarehouseController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('165', 'trace', 'system.CModule', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('166', 'trace', 'system.CModule', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('167', 'trace', 'system.db.CDbConnection', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('168', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('169', 'trace', 'system.CModule', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('170', 'trace', 'system.CModule', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('171', 'trace', 'system.CModule', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('172', 'trace', 'system.base.CModule', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Loading \"kospermindo\" module\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('173', 'trace', 'system.CModule', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Loading \"user\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/GroupsController.php (18)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('174', 'trace', 'system.CModule', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Loading \"session\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/GroupsController.php (18)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('175', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/GroupsController.php (27)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('176', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Querying SQL: SHOW FULL COLUMNS FROM `pengguna`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/GroupsController.php (27)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('177', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Querying SQL: SHOW CREATE TABLE `pengguna`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/GroupsController.php (27)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('178', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`levelid`=:yp0 AND `t`.`status`=:yp1 LIMIT 1. Bound with :yp0=\'1\', :yp1=1\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/GroupsController.php (27)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('179', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'TabelKelompok.count()\nin /usr/local/www/panrita/protected/modules/kospermindo/views/groups/index.php (35)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/GroupsController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('180', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_kelompok`\nin /usr/local/www/panrita/protected/modules/kospermindo/views/groups/index.php (35)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/GroupsController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('181', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Querying SQL: SHOW CREATE TABLE `tabel_kelompok`\nin /usr/local/www/panrita/protected/modules/kospermindo/views/groups/index.php (35)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/GroupsController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('182', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Querying SQL: SELECT COUNT(*) FROM `tabel_kelompok` `t`\nin /usr/local/www/panrita/protected/modules/kospermindo/views/groups/index.php (35)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/GroupsController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('183', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'TabelKelompok.findAll()\nin /usr/local/www/panrita/protected/modules/kospermindo/views/groups/index.php (35)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/GroupsController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('184', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` LIMIT 10\nin /usr/local/www/panrita/protected/modules/kospermindo/views/groups/index.php (35)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/GroupsController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('185', 'trace', 'system.CModule', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Loading \"widgetFactory\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/groups/index.php (71)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/GroupsController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('186', 'trace', 'system.CModule', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Loading \"coreMessages\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/groups/index.php (71)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/GroupsController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('187', 'trace', 'system.CModule', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Loading \"assetManager\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/groups/index.php (71)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/GroupsController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('188', 'trace', 'system.CModule', '2016-07-27 16:58:53', '192.168.2.253', 'vero', '/kospermindo/groups', 'Loading \"clientScript\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/groups/index.php (71)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/GroupsController.php (37)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('189', 'trace', 'system.CModule', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('190', 'trace', 'system.CModule', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('191', 'trace', 'system.db.CDbConnection', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('192', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('193', 'trace', 'system.CModule', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('194', 'trace', 'system.CModule', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('195', 'trace', 'system.CModule', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('196', 'trace', 'system.base.CModule', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Loading \"kospermindo\" module\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('197', 'trace', 'system.CModule', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Loading \"user\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (467)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('198', 'trace', 'system.CModule', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Loading \"session\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (467)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('199', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Users.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (494)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('200', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SHOW FULL COLUMNS FROM `users`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (494)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('201', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SHOW CREATE TABLE `users`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (494)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('202', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `users` `t` WHERE `t`.`isadmin`=:yp0 AND `t`.`superuser`=:yp1 AND `t`.`status`=:yp2 AND `t`.`levelid`=:yp3 AND `t`.`companyid`=:yp4. Bound with :yp0=0, :yp1=0, :yp2=1, :yp3=2, :yp4=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (494)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('203', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Pengguna.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (498)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('204', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SHOW FULL COLUMNS FROM `pengguna`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (498)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('205', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SHOW CREATE TABLE `pengguna`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (498)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('206', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`levelid`=:yp0 AND `t`.`id_perusahaan`=:yp1. Bound with :yp0=3, :yp1=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (498)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('207', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (503)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('208', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'157\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (503)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('209', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (504)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('210', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_kelompok`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (504)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('211', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SHOW CREATE TABLE `tabel_kelompok`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (504)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('212', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL165026\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (504)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('213', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (503)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('214', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'160\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (503)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('215', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (504)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('216', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL561177\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (504)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('217', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (503)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('218', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'160\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (503)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('219', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (504)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('220', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL561177\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (504)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('221', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (503)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('222', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'165\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (503)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('223', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (504)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('224', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL527171\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (504)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('225', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (503)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('226', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'160\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (503)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('227', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (504)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('228', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL561177\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (504)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('229', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (503)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('230', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'160\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (503)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('231', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (504)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('232', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL561177\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (504)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('233', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Komoditi.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (506)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('234', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SHOW FULL COLUMNS FROM `komoditi`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (506)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('235', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SHOW CREATE TABLE `komoditi`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (506)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('236', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `komoditi` `t` WHERE `t`.`status`=:yp0. Bound with :yp0=1\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (506)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('237', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'TabelKelompok.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (514)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('238', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_perusahaan`=:yp0. Bound with :yp0=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (514)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('239', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Users.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (515)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('240', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `users` `t` WHERE `t`.`isadmin`=:yp0 AND `t`.`superuser`=:yp1 AND `t`.`status`=:yp2 AND `t`.`levelid`=:yp3 AND `t`.`groupid`=:yp4 AND `t`.`companyid`=:yp5. Bound with :yp0=0, :yp1=0, :yp2=1, :yp3=2, :yp4=0, :yp5=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (515)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('241', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'TabelKoordinator.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (518)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('242', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_koordinator`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (518)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('243', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SHOW CREATE TABLE `tabel_koordinator`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (518)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('244', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `tabel_koordinator` `t` WHERE `t`.`id_perusahaan`=:yp0. Bound with :yp0=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (518)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('245', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Users.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (519)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('246', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `users` `t` WHERE `t`.`isadmin`=:yp0 AND `t`.`superuser`=:yp1 AND `t`.`status`=:yp2 AND `t`.`levelid`=:yp3 AND `t`.`groupid`=:yp4 AND `t`.`companyid`=:yp5. Bound with :yp0=0, :yp1=0, :yp2=1, :yp3=2, :yp4=0, :yp5=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (519)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('247', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Pengguna.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (523)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('248', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`levelid`=:yp0. Bound with :yp0=3\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (523)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('249', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Pengguna.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (524)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('250', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`levelid`=:yp0. Bound with :yp0=4\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (524)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('251', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Users.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (525)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('252', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT * FROM `users` `t` WHERE `t`.`isadmin`=:yp0 AND `t`.`superuser`=:yp1 AND `t`.`status`=:yp2 AND `t`.`levelid`=:yp3 AND `t`.`groupid`=:yp4 AND `t`.`companyid`=:yp5. Bound with :yp0=0, :yp1=0, :yp2=1, :yp3=2, :yp4=0, :yp5=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (525)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('253', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Querying SQL: SELECT nama_komoditi,sum(total_panen) as total_panen ,SUM(jumlah_bentangan) as jumlah_bentangan,sum(kadar_air) as kadar_air from komoditi GROUP BY nama_komoditi ORDER BY (\n			CASE WHEN nama_komoditi = \"sango-sango laut\" THEN 1 \n				 WHEN nama_komoditi= \"spinosom\" THEN 2\n				 WHEN nama_komoditi= \"euchema cotoni\" THEN 3\n				 WHEN nama_komoditi= \"gracillaria kw 3\" THEN 4\n				 WHEN nama_komoditi= \"gracillaria kw 4\" THEN 5\n				 WHEN nama_komoditi= \"gracillaria bs\" THEN 6 END)\nin /usr/local/www/panrita/protected/modules/kospermindo/models/Komoditi.php (142)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (530)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('254', 'trace', 'system.CModule', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Loading \"clientScript\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/users/warehouse.php (8)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (565)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('255', 'trace', 'system.CModule', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Loading \"widgetFactory\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/layouts/column1.php (2)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (565)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('256', 'trace', 'system.CModule', '2016-07-27 16:58:56', '192.168.2.253', 'vero', '/kospermindo/users/gudang', 'Loading \"assetManager\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (565)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('257', 'trace', 'system.CModule', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('258', 'trace', 'system.CModule', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('259', 'trace', 'system.db.CDbConnection', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('260', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('261', 'trace', 'system.CModule', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('262', 'trace', 'system.CModule', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('263', 'trace', 'system.CModule', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('264', 'trace', 'system.base.CModule', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Loading \"kospermindo\" module\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('265', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'TabelKoordinator.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (132)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('266', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_koordinator`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (132)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('267', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Querying SQL: SHOW CREATE TABLE `tabel_koordinator`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (132)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('268', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Querying SQL: SELECT * FROM `tabel_koordinator` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'kor656766\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (132)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('269', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (133)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('270', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_kelompok`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (133)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('271', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Querying SQL: SHOW CREATE TABLE `tabel_kelompok`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (133)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('272', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'kor656766\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (133)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('273', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'TabelPetani.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (134)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('274', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_petani`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (134)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('275', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Querying SQL: SHOW CREATE TABLE `tabel_petani`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (134)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('276', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Querying SQL: SELECT * FROM `tabel_petani` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'kor656766\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (134)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('277', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (137)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('278', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Querying SQL: SHOW FULL COLUMNS FROM `pengguna`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (137)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('279', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Querying SQL: SHOW CREATE TABLE `pengguna`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (137)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('280', 'trace', 'system.db.CDbCommand', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`username`=:yp0 LIMIT 1. Bound with :yp0=\'kor656766\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (137)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('281', 'trace', 'system.CModule', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Loading \"clientScript\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/update.php (10)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (158)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('282', 'trace', 'system.CModule', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Loading \"widgetFactory\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/_form.php (17)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/update.php (23)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (158)');
INSERT INTO `YiiLog` VALUES ('283', 'trace', 'system.CModule', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Loading \"user\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/layouts/partials/navbar.php (10)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/layouts/main.php (15)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/layouts/column1.php (6)');
INSERT INTO `YiiLog` VALUES ('284', 'trace', 'system.CModule', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Loading \"session\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/layouts/partials/navbar.php (10)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/layouts/main.php (15)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/layouts/column1.php (6)');
INSERT INTO `YiiLog` VALUES ('285', 'trace', 'system.CModule', '2016-07-27 16:58:58', '192.168.2.253', 'vero', '/kospermindo/user/update?id=kor656766', 'Loading \"assetManager\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (158)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('286', 'trace', 'system.CModule', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('287', 'trace', 'system.CModule', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('288', 'trace', 'system.db.CDbConnection', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('289', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('290', 'trace', 'system.CModule', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('291', 'trace', 'system.CModule', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('292', 'trace', 'system.CModule', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('293', 'trace', 'system.base.CModule', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Loading \"kospermindo\" module\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('294', 'trace', 'system.CModule', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Loading \"user\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (669)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('295', 'trace', 'system.CModule', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Loading \"session\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (669)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('296', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Users.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (696)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('297', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SHOW FULL COLUMNS FROM `users`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (696)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('298', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SHOW CREATE TABLE `users`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (696)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('299', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `users` `t` WHERE `t`.`isadmin`=:yp0 AND `t`.`superuser`=:yp1 AND `t`.`status`=:yp2 AND `t`.`levelid`=:yp3 AND `t`.`companyid`=:yp4. Bound with :yp0=0, :yp1=0, :yp2=1, :yp3=2, :yp4=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (696)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('300', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Pengguna.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (700)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('301', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SHOW FULL COLUMNS FROM `pengguna`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (700)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('302', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SHOW CREATE TABLE `pengguna`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (700)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('303', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`levelid`=:yp0 AND `t`.`id_perusahaan`=:yp1. Bound with :yp0=3, :yp1=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (700)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('304', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (705)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('305', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'157\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (705)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('306', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (706)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('307', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_kelompok`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (706)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('308', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SHOW CREATE TABLE `tabel_kelompok`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (706)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('309', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL165026\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (706)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('310', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (705)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('311', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'160\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (705)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('312', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (706)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('313', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL561177\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (706)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('314', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (705)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('315', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'160\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (705)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('316', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (706)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('317', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL561177\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (706)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('318', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (705)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('319', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'165\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (705)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('320', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (706)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('321', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL527171\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (706)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('322', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (705)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('323', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'160\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (705)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('324', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (706)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('325', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL561177\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (706)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('326', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (705)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('327', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'160\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (705)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('328', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (706)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('329', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL561177\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (706)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('330', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Komoditi.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (708)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('331', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SHOW FULL COLUMNS FROM `komoditi`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (708)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('332', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SHOW CREATE TABLE `komoditi`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (708)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('333', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `komoditi` `t` WHERE `t`.`status`=:yp0. Bound with :yp0=1\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (708)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('334', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'TabelKelompok.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (716)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('335', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_perusahaan`=:yp0. Bound with :yp0=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (716)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('336', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Users.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (717)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('337', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `users` `t` WHERE `t`.`isadmin`=:yp0 AND `t`.`superuser`=:yp1 AND `t`.`status`=:yp2 AND `t`.`levelid`=:yp3 AND `t`.`groupid`=:yp4 AND `t`.`companyid`=:yp5. Bound with :yp0=0, :yp1=0, :yp2=1, :yp3=2, :yp4=0, :yp5=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (717)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('338', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'TabelKoordinator.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (720)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('339', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_koordinator`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (720)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('340', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SHOW CREATE TABLE `tabel_koordinator`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (720)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('341', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `tabel_koordinator` `t` WHERE `t`.`id_perusahaan`=:yp0. Bound with :yp0=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (720)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('342', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Users.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (721)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('343', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `users` `t` WHERE `t`.`isadmin`=:yp0 AND `t`.`superuser`=:yp1 AND `t`.`status`=:yp2 AND `t`.`levelid`=:yp3 AND `t`.`groupid`=:yp4 AND `t`.`companyid`=:yp5. Bound with :yp0=0, :yp1=0, :yp2=1, :yp3=2, :yp4=0, :yp5=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (721)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('344', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'TabelPetani.findAll()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (725)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('345', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_petani`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (725)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('346', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SHOW CREATE TABLE `tabel_petani`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (725)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('347', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `tabel_petani` `t`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (725)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('348', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Pengguna.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (726)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('349', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`levelid`=:yp0. Bound with :yp0=3\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (726)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('350', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Pengguna.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (727)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('351', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`levelid`=:yp0. Bound with :yp0=4\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (727)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('352', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Users.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (728)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('353', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT * FROM `users` `t` WHERE `t`.`isadmin`=:yp0 AND `t`.`superuser`=:yp1 AND `t`.`status`=:yp2 AND `t`.`levelid`=:yp3 AND `t`.`groupid`=:yp4 AND `t`.`companyid`=:yp5. Bound with :yp0=0, :yp1=0, :yp2=1, :yp3=2, :yp4=0, :yp5=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (728)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('354', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Querying SQL: SELECT nama_komoditi,sum(total_panen) as total_panen ,SUM(jumlah_bentangan) as jumlah_bentangan,sum(kadar_air) as kadar_air from komoditi GROUP BY nama_komoditi ORDER BY (\n			CASE WHEN nama_komoditi = \"sango-sango laut\" THEN 1 \n				 WHEN nama_komoditi= \"spinosom\" THEN 2\n				 WHEN nama_komoditi= \"euchema cotoni\" THEN 3\n				 WHEN nama_komoditi= \"gracillaria kw 3\" THEN 4\n				 WHEN nama_komoditi= \"gracillaria kw 4\" THEN 5\n				 WHEN nama_komoditi= \"gracillaria bs\" THEN 6 END)\nin /usr/local/www/panrita/protected/modules/kospermindo/models/Komoditi.php (142)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (733)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('355', 'trace', 'system.CModule', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Loading \"clientScript\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/users/petani.php (8)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (768)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('356', 'trace', 'system.CModule', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Loading \"widgetFactory\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/layouts/column1.php (2)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (768)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('357', 'trace', 'system.CModule', '2016-07-27 16:59:02', '192.168.2.253', 'vero', '/kospermindo/users/petani', 'Loading \"assetManager\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (768)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('358', 'trace', 'system.CModule', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('359', 'trace', 'system.CModule', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('360', 'trace', 'system.db.CDbConnection', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('361', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('362', 'trace', 'system.CModule', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('363', 'trace', 'system.CModule', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('364', 'trace', 'system.CModule', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('365', 'trace', 'system.base.CModule', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Loading \"kospermindo\" module\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('366', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'TabelKoordinator.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (132)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('367', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_koordinator`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (132)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('368', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Querying SQL: SHOW CREATE TABLE `tabel_koordinator`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (132)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('369', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Querying SQL: SELECT * FROM `tabel_koordinator` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'ikki\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (132)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('370', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (133)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('371', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_kelompok`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (133)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('372', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Querying SQL: SHOW CREATE TABLE `tabel_kelompok`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (133)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('373', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'ikki\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (133)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('374', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'TabelPetani.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (134)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('375', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_petani`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (134)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('376', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Querying SQL: SHOW CREATE TABLE `tabel_petani`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (134)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('377', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Querying SQL: SELECT * FROM `tabel_petani` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'ikki\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (134)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('378', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (194)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('379', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Querying SQL: SHOW FULL COLUMNS FROM `pengguna`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (194)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('380', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Querying SQL: SHOW CREATE TABLE `pengguna`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (194)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('381', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`username`=:yp0 LIMIT 1. Bound with :yp0=\'ikki\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (194)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('382', 'trace', 'system.CModule', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Loading \"clientScript\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/update.php (64)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (215)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('383', 'trace', 'system.CModule', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Loading \"widgetFactory\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/_form.php (103)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/update.php (77)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (215)');
INSERT INTO `YiiLog` VALUES ('384', 'trace', 'system.CModule', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Loading \"user\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/_form.php (108)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/update.php (77)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (215)');
INSERT INTO `YiiLog` VALUES ('385', 'trace', 'system.CModule', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Loading \"session\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/_form.php (108)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/update.php (77)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (215)');
INSERT INTO `YiiLog` VALUES ('386', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'TabelKoordinator.findAll()\nin /usr/local/www/panrita/protected/modules/kospermindo/models/Pengguna.php (259)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/_form.php (108)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/update.php (77)');
INSERT INTO `YiiLog` VALUES ('387', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Querying SQL: SELECT * FROM `tabel_koordinator` `t` WHERE id_perusahaan = :id_perusahaan AND status = :status. Bound with :id_perusahaan=\'3\', :status=1\nin /usr/local/www/panrita/protected/modules/kospermindo/models/Pengguna.php (259)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/_form.php (108)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/update.php (77)');
INSERT INTO `YiiLog` VALUES ('388', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'TabelKoordinator.findAll()\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/_form.php (118)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/update.php (77)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (215)');
INSERT INTO `YiiLog` VALUES ('389', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Querying SQL: SELECT * FROM `tabel_koordinator` `t`\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/_form.php (118)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/user/update.php (77)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (215)');
INSERT INTO `YiiLog` VALUES ('390', 'trace', 'system.CModule', '2016-07-27 16:59:04', '192.168.2.253', 'vero', '/kospermindo/user/update?id=ikki', 'Loading \"assetManager\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UserController.php (215)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('391', 'trace', 'system.CModule', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('392', 'trace', 'system.CModule', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('393', 'trace', 'system.db.CDbConnection', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('394', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('395', 'trace', 'system.CModule', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('396', 'trace', 'system.CModule', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('397', 'trace', 'system.CModule', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('398', 'trace', 'system.base.CModule', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Loading \"kospermindo\" module\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('399', 'trace', 'system.CModule', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Loading \"user\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (771)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('400', 'trace', 'system.CModule', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Loading \"session\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (771)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('401', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Users.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (798)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('402', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SHOW FULL COLUMNS FROM `users`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (798)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('403', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SHOW CREATE TABLE `users`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (798)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('404', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `users` `t` WHERE `t`.`isadmin`=:yp0 AND `t`.`superuser`=:yp1 AND `t`.`status`=:yp2 AND `t`.`levelid`=:yp3 AND `t`.`companyid`=:yp4. Bound with :yp0=0, :yp1=0, :yp2=1, :yp3=2, :yp4=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (798)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('405', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Pengguna.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (802)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('406', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SHOW FULL COLUMNS FROM `pengguna`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (802)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('407', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SHOW CREATE TABLE `pengguna`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (802)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('408', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`levelid`=:yp0 AND `t`.`id_perusahaan`=:yp1. Bound with :yp0=3, :yp1=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (802)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('409', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (807)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('410', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'157\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (807)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('411', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (808)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('412', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_kelompok`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (808)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('413', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SHOW CREATE TABLE `tabel_kelompok`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (808)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('414', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL165026\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (808)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('415', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (807)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('416', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'160\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (807)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('417', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (808)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('418', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL561177\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (808)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('419', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (807)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('420', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'160\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (807)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('421', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (808)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('422', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL561177\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (808)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('423', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (807)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('424', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'165\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (807)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('425', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (808)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('426', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL527171\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (808)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('427', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (807)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('428', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'160\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (807)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('429', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (808)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('430', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL561177\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (808)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('431', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (807)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('432', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'160\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (807)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('433', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'TabelKelompok.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (808)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('434', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_user`=:yp0 LIMIT 1. Bound with :yp0=\'KEL561177\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (808)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('435', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Komoditi.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (810)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('436', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SHOW FULL COLUMNS FROM `komoditi`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (810)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('437', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SHOW CREATE TABLE `komoditi`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (810)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('438', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `komoditi` `t` WHERE `t`.`status`=:yp0. Bound with :yp0=1\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (810)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('439', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'TabelKelompok.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (818)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('440', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `tabel_kelompok` `t` WHERE `t`.`id_perusahaan`=:yp0. Bound with :yp0=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (818)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('441', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Users.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (819)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('442', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `users` `t` WHERE `t`.`isadmin`=:yp0 AND `t`.`superuser`=:yp1 AND `t`.`status`=:yp2 AND `t`.`levelid`=:yp3 AND `t`.`groupid`=:yp4 AND `t`.`companyid`=:yp5. Bound with :yp0=0, :yp1=0, :yp2=1, :yp3=2, :yp4=0, :yp5=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (819)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('443', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'TabelKoordinator.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (822)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('444', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_koordinator`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (822)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('445', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SHOW CREATE TABLE `tabel_koordinator`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (822)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('446', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `tabel_koordinator` `t` WHERE `t`.`id_perusahaan`=:yp0. Bound with :yp0=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (822)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('447', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Users.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (823)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('448', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `users` `t` WHERE `t`.`isadmin`=:yp0 AND `t`.`superuser`=:yp1 AND `t`.`status`=:yp2 AND `t`.`levelid`=:yp3 AND `t`.`groupid`=:yp4 AND `t`.`companyid`=:yp5. Bound with :yp0=0, :yp1=0, :yp2=1, :yp3=2, :yp4=0, :yp5=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (823)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('449', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Pengguna.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (827)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('450', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`levelid`=:yp0. Bound with :yp0=3\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (827)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('451', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Pengguna.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (828)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('452', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`levelid`=:yp0. Bound with :yp0=4\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (828)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('453', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Users.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (829)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('454', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT * FROM `users` `t` WHERE `t`.`isadmin`=:yp0 AND `t`.`superuser`=:yp1 AND `t`.`status`=:yp2 AND `t`.`levelid`=:yp3 AND `t`.`groupid`=:yp4 AND `t`.`companyid`=:yp5. Bound with :yp0=0, :yp1=0, :yp2=1, :yp3=2, :yp4=0, :yp5=\'3\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (829)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('455', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Querying SQL: SELECT nama_komoditi,sum(total_panen) as total_panen ,SUM(jumlah_bentangan) as jumlah_bentangan,sum(kadar_air) as kadar_air from komoditi GROUP BY nama_komoditi ORDER BY (\n			CASE WHEN nama_komoditi = \"sango-sango laut\" THEN 1 \n				 WHEN nama_komoditi= \"spinosom\" THEN 2\n				 WHEN nama_komoditi= \"euchema cotoni\" THEN 3\n				 WHEN nama_komoditi= \"gracillaria kw 3\" THEN 4\n				 WHEN nama_komoditi= \"gracillaria kw 4\" THEN 5\n				 WHEN nama_komoditi= \"gracillaria bs\" THEN 6 END)\nin /usr/local/www/panrita/protected/modules/kospermindo/models/Komoditi.php (142)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (834)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('456', 'trace', 'system.CModule', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Loading \"clientScript\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/users/moderator.php (8)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (869)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('457', 'trace', 'system.CModule', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Loading \"widgetFactory\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/layouts/column1.php (2)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (869)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('458', 'trace', 'system.CModule', '2016-07-27 16:59:07', '192.168.2.253', 'vero', '/kospermindo/users/moderator', 'Loading \"assetManager\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (869)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('459', 'trace', 'system.CModule', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('460', 'trace', 'system.CModule', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('461', 'trace', 'system.db.CDbConnection', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('462', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('463', 'trace', 'system.CModule', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('464', 'trace', 'system.CModule', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('465', 'trace', 'system.CModule', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('466', 'trace', 'system.base.CModule', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Loading \"kospermindo\" module\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('467', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Querying SQL: SHOW FULL COLUMNS FROM `tabel_petani`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (271)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('468', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Querying SQL: SHOW CREATE TABLE `tabel_petani`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (271)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('469', 'trace', 'system.CModule', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Loading \"user\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (276)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('470', 'trace', 'system.CModule', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Loading \"session\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (276)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('471', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Querying SQL: SHOW FULL COLUMNS FROM `pengguna`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (277)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('472', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Querying SQL: SHOW CREATE TABLE `pengguna`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (277)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('473', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Querying SQL: SHOW FULL COLUMNS FROM `profiles`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (279)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('474', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Querying SQL: SHOW CREATE TABLE `profiles`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (279)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('475', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Pengguna.findByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (280)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('476', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Querying SQL: SELECT * FROM `pengguna` `t` WHERE `t`.`id`=:yp0 LIMIT 1. Bound with :yp0=\'163\'\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (280)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('477', 'trace', 'system.CModule', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Loading \"widgetFactory\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/users/_form.php (16)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/users/update.php (8)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (304)');
INSERT INTO `YiiLog` VALUES ('478', 'trace', 'system.CModule', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Loading \"clientScript\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/users/_form.php (106)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/users/update.php (8)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (304)');
INSERT INTO `YiiLog` VALUES ('479', 'trace', 'system.CModule', '2016-07-27 16:59:11', '192.168.2.253', 'vero', '/kospermindo/users/update?id=163', 'Loading \"assetManager\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (304)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('480', 'trace', 'system.CModule', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Loading \"log\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('481', 'trace', 'system.CModule', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Loading \"db\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('482', 'trace', 'system.db.CDbConnection', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Opening DB connection\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('483', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Executing SQL: DELETE FROM `YiiLog` WHERE 0=1\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('484', 'trace', 'system.CModule', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Loading \"request\" application component\nin /usr/local/www/panrita/index.php (12)');
INSERT INTO `YiiLog` VALUES ('485', 'trace', 'system.CModule', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Loading \"urlManager\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('486', 'trace', 'system.CModule', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Loading \"cache\" application component\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('487', 'trace', 'system.base.CModule', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Loading \"kospermindo\" module\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('488', 'trace', 'system.db.ar.CActiveRecord', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Komoditi.findAllByAttributes()\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (872)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('489', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Querying SQL: SHOW FULL COLUMNS FROM `komoditi`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (872)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('490', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Querying SQL: SHOW CREATE TABLE `komoditi`\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (872)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('491', 'trace', 'system.db.CDbCommand', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Querying SQL: SELECT * FROM `komoditi` `t` WHERE `t`.`status`=:yp0. Bound with :yp0=1\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (872)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('492', 'trace', 'system.CModule', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Loading \"clientScript\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/users/panen.php (8)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (877)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('493', 'trace', 'system.CModule', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Loading \"user\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/models/Users.php (215)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/users/panen.php (33)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (877)');
INSERT INTO `YiiLog` VALUES ('494', 'trace', 'system.CModule', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Loading \"session\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/models/Users.php (215)\nin /usr/local/www/panrita/protected/modules/kospermindo/views/users/panen.php (33)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (877)');
INSERT INTO `YiiLog` VALUES ('495', 'trace', 'system.CModule', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Loading \"widgetFactory\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/views/layouts/column1.php (2)\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (877)\nin /usr/local/www/panrita/index.php (13)');
INSERT INTO `YiiLog` VALUES ('496', 'trace', 'system.CModule', '2016-07-27 16:59:17', '192.168.2.253', 'vero', '/kospermindo/users/panen', 'Loading \"assetManager\" application component\nin /usr/local/www/panrita/protected/modules/kospermindo/controllers/UsersController.php (877)\nin /usr/local/www/panrita/index.php (13)');

-- ----------------------------
-- View structure for v_komoditibygroup
-- ----------------------------
DROP VIEW IF EXISTS `v_komoditibygroup`;
CREATE ALGORITHM=UNDEFINED DEFINER=`usr_panrita`@`localhost` SQL SECURITY DEFINER VIEW `v_komoditibygroup` AS select `tabel_petani`.`idkelompok` AS `idkelompok`,sum(`komoditi`.`total_panen`) AS `total` from (`tabel_petani` join `komoditi`) where (convert(`tabel_petani`.`id_user` using utf8) = `komoditi`.`id_user`) group by `tabel_petani`.`idkelompok` ;

-- ----------------------------
-- View structure for v_panen
-- ----------------------------
DROP VIEW IF EXISTS `v_panen`;
CREATE ALGORITHM=UNDEFINED DEFINER=`usr_panrita`@`localhost` SQL SECURITY DEFINER VIEW `v_panen` AS select `tabel_petani`.`id` AS `id`,`tabel_petani`.`nama_petani` AS `nama_petani`,`tabel_kelompok`.`nama_kelompok` AS `kelompok`,`tabel_kelompok`.`lokasi` AS `lokasi`,`komoditi`.`nama_komoditi` AS `nama_komoditi`,`komoditi`.`total_panen` AS `total_panen`,`komoditi`.`kadar_air` AS `kadar_air`,`komoditi`.`jumlah_bentangan` AS `jumlah_bentangan`,`tabel_petani`.`status` AS `status` from ((`tabel_petani` join `komoditi` on((convert(`tabel_petani`.`id_user` using utf8) = `komoditi`.`id_user`))) join `tabel_kelompok` on((`tabel_petani`.`idkelompok` = convert(`tabel_kelompok`.`id_user` using utf8)))) where (`tabel_petani`.`status` = `komoditi`.`status`) ;
DROP TRIGGER IF EXISTS `tr_gudang`;
DELIMITER ;;
CREATE TRIGGER `tr_gudang` BEFORE INSERT ON `gudang` FOR EACH ROW BEGIN
  INSERT INTO sequences VALUES (NULL);
  SET NEW.id_gudang = CONCAT('GUD','-', LPAD(LAST_INSERT_ID(), 3, '0'));
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `tr_kordinator`;
DELIMITER ;;
CREATE TRIGGER `tr_kordinator` BEFORE INSERT ON `kordinator` FOR EACH ROW BEGIN
  INSERT INTO sequences_2 VALUES (NULL);
  SET NEW.id_koor = CONCAT('KOR','-', LPAD(LAST_INSERT_ID(), 3, '0'));
END
;;
DELIMITER ;
