--
-- MySQL database dump
-- Created by DBManage class, Power By yanue. 
-- http://yanue.net 
--
-- 主机: localhost
-- 生成日期: 2015 年  11 月 11 日 19:20
-- MySQL版本: 5.1.63
-- PHP 版本: 5.5.29

--
-- 数据库: `coach_system`
--

-- -------------------------------------------------------

--
-- 表的结构activity
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '',
  `code` varchar(45) NOT NULL DEFAULT '' COMMENT '??',
  `category` tinyint(3) NOT NULL DEFAULT '0' COMMENT '??1??2??',
  `level_id` int(11) NOT NULL DEFAULT '0' COMMENT '??id',
  `recruit_count` tinyint(3) NOT NULL DEFAULT '0' COMMENT '????',
  `sign_up_begin_time` datetime DEFAULT NULL COMMENT '??????',
  `sign_up_end_time` datetime DEFAULT NULL COMMENT '??????',
  `sign_up_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '????0???1????2????',
  `begin_time` datetime DEFAULT NULL COMMENT '????',
  `end_time` datetime DEFAULT NULL COMMENT '????',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '??1???2???3??',
  `content` text COMMENT '??',
  `lesson` int(11) NOT NULL DEFAULT '0' COMMENT '????',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '????',
  `address` varchar(100) NOT NULL DEFAULT '' COMMENT '??',
  `bus` varchar(100) NOT NULL DEFAULT '',
  `near_site` varchar(100) NOT NULL DEFAULT '',
  `launch` varchar(50) NOT NULL DEFAULT '' COMMENT '???',
  `organizers` varchar(50) NOT NULL DEFAULT '' COMMENT '???',
  `join_teams` varchar(50) NOT NULL DEFAULT '' COMMENT '?????',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `index_level_id` (`level_id`),
  KEY `index_create_time_type_category_status` (`create_time`,`category`,`status`),
  CONSTRAINT `fk_activity_level` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='???';

--
-- 转存表中的数据 activity
--

INSERT INTO `activity` VALUES('1','??????','','1','2','13','2015-08-07 00:00:00','2015-08-16 00:00:00','1','2015-08-17 00:00:00','2015-08-22 00:00:00','1','????','10','11','????????','115,221','???','????','????','???????','2015-08-22 15:08:59','admin','2015-10-28 14:26:26','admin');
INSERT INTO `activity` VALUES('2','??????1','','1','3','13','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','1','111','1','11','111','','','11','111','1','2015-08-22 16:15:56','admin','2015-10-27 14:38:10','admin');
INSERT INTO `activity` VALUES('3','???','','1','2','12','2015-10-01 00:00:00','2015-10-02 00:00:00','0','2015-10-24 00:00:00','2015-10-31 00:00:00','4','???','10','30000','??????','115,221','???','??????','??','??','2015-10-24 08:09:19','admin','2015-10-29 16:18:19','admin');
INSERT INTO `activity` VALUES('4','2015????','','2','2','13','2015-10-01 00:00:00','2015-10-10 00:00:00','0','2015-10-11 00:00:00','2015-10-24 00:00:00','1','2015????','10','2000','??????','','','??????','??','??','2015-10-24 10:35:03','admin','2015-10-24 10:35:11','admin');
INSERT INTO `activity` VALUES('5','2015????','','1','2','14','2015-10-01 00:00:00','2015-10-09 00:00:00','0','2015-10-16 00:00:00','2015-10-24 00:00:00','1','2015????','10','2000','????','115,221','???','??????','??','??','2015-10-29 16:12:32','admin','2015-10-29 16:12:32','admin');
INSERT INTO `activity` VALUES('6','2015?????','','1','2','14','2015-10-01 00:00:00','2015-10-09 00:00:00','0','2015-10-11 00:00:00','2015-10-31 00:00:00','2','2015????','10','2000','??????','115,221','???','??????','??','??','2015-10-29 16:13:48','admin','2015-10-29 16:14:02','admin');
--
-- 表的结构activity_category
--

DROP TABLE IF EXISTS `activity_category`;
CREATE TABLE `activity_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='?????';

--
-- 转存表中的数据 activity_category
--

INSERT INTO `activity_category` VALUES('1','???','2015-10-24 10:32:52','admin','2015-10-24 10:32:52','admin');
INSERT INTO `activity_category` VALUES('2','??','2015-10-24 10:34:11','admin','2015-10-24 10:34:11','admin');
--
-- 表的结构activity_process
--

DROP TABLE IF EXISTS `activity_process`;
CREATE TABLE `activity_process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `day` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1??2???',
  PRIMARY KEY (`id`),
  KEY `activity_id_user_id_index` (`activity_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='???';

--
-- 转存表中的数据 activity_process
--

INSERT INTO `activity_process` VALUES('1','3','91','2015-10-24 00:00:00','2');
INSERT INTO `activity_process` VALUES('2','3','91','2015-10-25 00:00:00','1');
INSERT INTO `activity_process` VALUES('3','3','91','2015-10-26 00:00:00','1');
INSERT INTO `activity_process` VALUES('4','3','91','2015-10-27 00:00:00','1');
INSERT INTO `activity_process` VALUES('5','3','91','2015-10-28 00:00:00','1');
INSERT INTO `activity_process` VALUES('6','3','91','2015-10-29 00:00:00','1');
INSERT INTO `activity_process` VALUES('7','3','91','2015-10-30 00:00:00','1');
--
-- 表的结构activity_users
--

DROP TABLE IF EXISTS `activity_users`;
CREATE TABLE `activity_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `level_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '??0???1???2???3???4??',
  `orders` tinyint(3) NOT NULL DEFAULT '0',
  `practice_score` int(11) NOT NULL DEFAULT '0' COMMENT '????',
  `theory_score` int(11) NOT NULL DEFAULT '0' COMMENT '????',
  `rule_score` int(11) NOT NULL DEFAULT '0' COMMENT '????',
  `score_appraise` int(11) NOT NULL DEFAULT '0' COMMENT '????',
  `appraise_result` varchar(45) NOT NULL DEFAULT '' COMMENT '????',
  `attendance_appraise` varchar(45) NOT NULL DEFAULT '' COMMENT '????',
  `practice_comment` varchar(45) NOT NULL DEFAULT '' COMMENT '????',
  `theory_comment` varchar(45) NOT NULL DEFAULT '' COMMENT '????',
  `rule_comment` varchar(45) NOT NULL DEFAULT '' COMMENT '????',
  `total_comment` varchar(45) NOT NULL DEFAULT '' COMMENT '??',
  `result_comment` varchar(45) NOT NULL DEFAULT '' COMMENT '????',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `index_activity_id_user_id` (`activity_id`,`user_id`),
  KEY `fk_activity_users_users_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='???????';

--
-- 转存表中的数据 activity_users
--

INSERT INTO `activity_users` VALUES('14','6','141','0','2','0','0','0','0','0','','','','','','','','2015-11-10 14:38:39','admin','2015-11-10 14:38:39','admin');
INSERT INTO `activity_users` VALUES('15','6','141','0','2','0','0','0','0','0','','','','','','','','2015-11-10 14:45:21','admin','2015-11-10 14:45:21','admin');
--
-- 表的结构admin
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL DEFAULT '',
  `password` varchar(45) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '??1??2??',
  `last_login_time` datetime DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL DEFAULT '',
  `group_id` int(11) NOT NULL COMMENT '???id',
  `authKey` varchar(100) NOT NULL DEFAULT '',
  `accessToken` varchar(100) NOT NULL DEFAULT '',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `fk_admin_admin_group_idx` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='????';

--
-- 转存表中的数据 admin
--

INSERT INTO `admin` VALUES('1','admin','21232f297a57a5a743894a0e4a801fc3','22@22.com','1','','','1','','','2015-08-24 16:40:18','admin','2015-08-25 13:59:35','admin');
--
-- 表的结构admin_group
--

DROP TABLE IF EXISTS `admin_group`;
CREATE TABLE `admin_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(45) NOT NULL DEFAULT '',
  `model` varchar(500) NOT NULL DEFAULT '' COMMENT '??',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='??????	';

--
-- 转存表中的数据 admin_group
--

INSERT INTO `admin_group` VALUES('1','????','train,activity,pages,news','','','2015-08-24 16:16:51','admin');
INSERT INTO `admin_group` VALUES('2','???','users,level','2015-08-24 16:30:26','admin','2015-08-24 16:30:50','admin');
--
-- 表的结构attendance
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `train_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `day` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1??2??3??4??5??',
  PRIMARY KEY (`id`),
  KEY `train_id_user_id_index` (`train_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COMMENT='???';

--
-- 转存表中的数据 attendance
--

INSERT INTO `attendance` VALUES('31','2','24','2015-08-22 00:00:00','2');
INSERT INTO `attendance` VALUES('32','2','24','2015-08-23 00:00:00','3');
INSERT INTO `attendance` VALUES('33','2','24','2015-08-24 00:00:00','2');
INSERT INTO `attendance` VALUES('34','2','24','2015-08-25 00:00:00','4');
INSERT INTO `attendance` VALUES('35','2','24','2015-08-26 00:00:00','5');
INSERT INTO `attendance` VALUES('36','2','24','2015-08-27 00:00:00','1');
INSERT INTO `attendance` VALUES('37','2','1','2015-08-22 00:00:00','2');
INSERT INTO `attendance` VALUES('38','2','1','2015-08-23 00:00:00','1');
INSERT INTO `attendance` VALUES('39','2','1','2015-08-24 00:00:00','1');
INSERT INTO `attendance` VALUES('40','2','1','2015-08-25 00:00:00','1');
INSERT INTO `attendance` VALUES('41','2','1','2015-08-26 00:00:00','1');
INSERT INTO `attendance` VALUES('42','2','1','2015-08-27 00:00:00','1');
INSERT INTO `attendance` VALUES('43','2','2','2015-08-22 00:00:00','2');
INSERT INTO `attendance` VALUES('44','2','2','2015-08-23 00:00:00','3');
INSERT INTO `attendance` VALUES('45','2','2','2015-08-24 00:00:00','4');
INSERT INTO `attendance` VALUES('46','2','2','2015-08-25 00:00:00','1');
INSERT INTO `attendance` VALUES('47','2','2','2015-08-26 00:00:00','1');
INSERT INTO `attendance` VALUES('48','2','2','2015-08-27 00:00:00','1');
INSERT INTO `attendance` VALUES('49','2','3','2015-08-22 00:00:00','2');
INSERT INTO `attendance` VALUES('50','2','3','2015-08-23 00:00:00','3');
INSERT INTO `attendance` VALUES('51','2','3','2015-08-24 00:00:00','1');
INSERT INTO `attendance` VALUES('52','2','3','2015-08-25 00:00:00','1');
INSERT INTO `attendance` VALUES('53','2','3','2015-08-26 00:00:00','1');
INSERT INTO `attendance` VALUES('54','2','3','2015-08-27 00:00:00','1');
INSERT INTO `attendance` VALUES('55','6','47','2015-08-03 00:00:00','1');
INSERT INTO `attendance` VALUES('56','6','28','2015-08-03 00:00:00','1');
INSERT INTO `attendance` VALUES('57','2','91','2015-08-22 00:00:00','1');
INSERT INTO `attendance` VALUES('58','2','91','2015-08-23 00:00:00','1');
INSERT INTO `attendance` VALUES('59','2','91','2015-08-24 00:00:00','1');
INSERT INTO `attendance` VALUES('60','2','91','2015-08-25 00:00:00','1');
INSERT INTO `attendance` VALUES('61','2','91','2015-08-26 00:00:00','1');
INSERT INTO `attendance` VALUES('62','2','91','2015-08-27 00:00:00','1');
INSERT INTO `attendance` VALUES('63','9','91','2015-08-03 00:00:00','1');
INSERT INTO `attendance` VALUES('64','12','92','2015-08-03 00:00:00','1');
--
-- 表的结构auth_assignment
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 auth_assignment
--

INSERT INTO `auth_assignment` VALUES('admin','1','1445872312');
INSERT INTO `auth_assignment` VALUES('author','2','1445872312');
--
-- 表的结构auth_item
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `web_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 auth_item
--

INSERT INTO `auth_item` VALUES('admin','1','','','','1445872312','1445872312');
INSERT INTO `auth_item` VALUES('author','1','','','','1445872312','1445872312');
INSERT INTO `auth_item` VALUES('createPost','2','Create a post','','','1445872312','1445872312');
INSERT INTO `auth_item` VALUES('updatePost','2','Update post','','','1445872312','1445872312');
--
-- 表的结构configuration
--

DROP TABLE IF EXISTS `configuration`;
CREATE TABLE `configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `web_name` varchar(45) NOT NULL DEFAULT '',
  `contact_email` varchar(100) NOT NULL DEFAULT '',
  `attach_size` int(11) NOT NULL DEFAULT '0' COMMENT '????M',
  `keyword` varchar(500) NOT NULL DEFAULT '',
  `description` varchar(500) NOT NULL DEFAULT '',
  `copyright` varchar(45) NOT NULL DEFAULT '',
  `address` varchar(100) NOT NULL DEFAULT '',
  `contact_phone` varchar(45) NOT NULL DEFAULT '',
  `icp` varchar(45) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='?????';

--
-- 转存表中的数据 configuration
--

INSERT INTO `configuration` VALUES('2','??????','admin@coach.com','10','???????','???????','????as','??','291393212','?icp?13123123','','','','');
--
-- 表的结构level
--

DROP TABLE IF EXISTS `level`;
CREATE TABLE `level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '' COMMENT '????',
  `code` varchar(45) NOT NULL DEFAULT '' COMMENT '??',
  `lesson` int(11) NOT NULL DEFAULT '0' COMMENT '??????',
  `credit` int(11) NOT NULL DEFAULT '0' COMMENT '??????',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '??????',
  `login_duration` int(11) NOT NULL DEFAULT '0' COMMENT '????????',
  `register_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '???',
  `content` varchar(500) NOT NULL DEFAULT '' COMMENT '????',
  `order` int(3) NOT NULL DEFAULT '1' COMMENT '????',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='?????';

--
-- 转存表中的数据 level
--

INSERT INTO `level` VALUES('1','????','ZC','0','0','0','0','0.00','????','1','2015-08-20 00:00:00','admin','2015-09-07 15:59:34','admin');
INSERT INTO `level` VALUES('2','??','SJ','10000','0','0','0','200.00','????','2','2015-08-20 00:00:00','admin','2015-11-01 20:20:20','admin');
INSERT INTO `level` VALUES('3','D?','DJ','30000','30000','30000','24','999.00','??B?','3','2015-08-22 15:36:54','admin','2015-09-07 16:00:44','admin');
INSERT INTO `level` VALUES('4','C?','CJ','30000','30000','30000','36','30000.00','','4','2015-08-27 08:12:52','admin','2015-09-07 16:01:05','admin');
INSERT INTO `level` VALUES('5','B?','BJ','40000','40000','40000','48','40000.00','','5','2015-08-27 08:13:09','admin','2015-09-07 16:01:13','admin');
INSERT INTO `level` VALUES('6','A?','AJ','50000','50000','50000','60','50000.00','50000','6','2015-08-27 08:13:32','admin','2015-09-07 16:01:23','admin');
INSERT INTO `level` VALUES('7','???','ZYJ','60000','60000','60000','72','60000.00','60000','7','2015-08-29 16:50:02','admin','2015-09-07 16:01:41','admin');
--
-- 表的结构message_category
--

DROP TABLE IF EXISTS `message_category`;
CREATE TABLE `message_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='?????????';

--
-- 转存表中的数据 message_category
--

--
-- 表的结构messages
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL DEFAULT '' COMMENT '??',
  `content` varchar(500) NOT NULL DEFAULT '' COMMENT '??',
  `type` tinyint(3) NOT NULL DEFAULT '1' COMMENT '?? 1???? 2????',
  `status` tinyint(2) NOT NULL COMMENT '?? ',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `index_type` (`type`),
  KEY `index_create_user` (`create_user`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='???';

--
-- 转存表中的数据 messages
--

INSERT INTO `messages` VALUES('1','????1','????????????????????????????????????????????????????','1','0','2015-09-26 16:49:08','admin','2015-09-26 16:57:27','admin');
INSERT INTO `messages` VALUES('8','????','????????????????????????','3','0','2015-09-27 13:37:49','admin','2015-10-31 07:43:45','admin');
INSERT INTO `messages` VALUES('12','23232323','232323','2','1','2015-09-27 13:47:07','admin','2015-10-31 07:43:57','admin');
INSERT INTO `messages` VALUES('13','2323','23233','4','0','2015-09-27 13:37:49','admin','2015-10-31 07:44:05','admin');
INSERT INTO `messages` VALUES('14','2323','23233','5','0','2015-09-27 13:37:49','admin','2015-10-31 07:44:14','admin');
INSERT INTO `messages` VALUES('15','2323','23233','6','0','2015-09-27 13:37:49','admin','2015-10-31 07:44:27','admin');
INSERT INTO `messages` VALUES('16','2323','23233','1','0','2015-09-27 13:37:49','admin','2015-09-27 13:37:49','admin');
INSERT INTO `messages` VALUES('17','2323','23233','1','0','2015-09-27 13:37:49','admin','2015-09-27 13:37:49','admin');
INSERT INTO `messages` VALUES('18','2323','23233','1','0','2015-09-27 13:37:49','admin','2015-09-27 13:37:49','admin');
INSERT INTO `messages` VALUES('19','2323','23233','1','0','2015-09-27 13:37:49','admin','2015-09-27 13:37:49','admin');
INSERT INTO `messages` VALUES('20','????','????????????????????????','2','0','2015-09-27 13:37:49','admin','2015-09-27 13:37:49','admin');
INSERT INTO `messages` VALUES('21','????','????????????????????????','2','0','2015-09-27 13:37:49','admin','2015-09-27 13:37:49','admin');
INSERT INTO `messages` VALUES('22','????','????????????????????????','2','0','2015-09-27 13:37:49','admin','2015-09-27 13:37:49','admin');
INSERT INTO `messages` VALUES('23','????','????????????????????????','2','0','2015-09-27 13:37:49','admin','2015-09-27 13:37:49','admin');
INSERT INTO `messages` VALUES('24','????','????????????????????????','2','0','2015-09-27 13:37:49','admin','2015-09-27 13:37:49','admin');
INSERT INTO `messages` VALUES('25','????','????????????????????????','2','0','2015-09-27 13:37:49','admin','2015-09-27 13:37:49','admin');
INSERT INTO `messages` VALUES('26','????','????????????????????????','2','0','2015-09-27 13:37:49','admin','2015-09-27 13:37:49','admin');
INSERT INTO `messages` VALUES('27','????','????????????????????????','2','0','2015-09-27 13:37:49','admin','2015-09-27 13:37:49','admin');
INSERT INTO `messages` VALUES('28','????','????????????????????????','2','0','2015-09-27 13:37:49','admin','2015-09-27 13:37:49','admin');
INSERT INTO `messages` VALUES('29','????????','????????????????????????????????','2','0','2015-10-29 15:46:38','admin','2015-10-29 15:46:38','admin');
INSERT INTO `messages` VALUES('30','????????','????????','2','1','2015-10-29 15:57:19','admin','2015-10-31 07:40:20','admin');
INSERT INTO `messages` VALUES('32','????????','????????','1','1','2015-10-31 14:24:03','admin','2015-10-31 14:24:03','admin');
INSERT INTO `messages` VALUES('33','??????????1','??????????1','6','1','2015-10-31 17:27:36','admin','2015-10-31 17:28:32','admin');
--
-- 表的结构messages_users
--

DROP TABLE IF EXISTS `messages_users`;
CREATE TABLE `messages_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `messages_id` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(3) NOT NULL DEFAULT '0',
  `users_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '??0??1??',
  `content` varchar(500) NOT NULL DEFAULT '',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `index_users_id_status` (`users_id`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=460 DEFAULT CHARSET=utf8 COMMENT='???????';

--
-- 转存表中的数据 messages_users
--

INSERT INTO `messages_users` VALUES('4','8','1','1','0','','','','','');
INSERT INTO `messages_users` VALUES('5','12','1','10','1','','','','','');
INSERT INTO `messages_users` VALUES('6','12','1','11','1','','','','','');
INSERT INTO `messages_users` VALUES('7','12','1','2','1','','','','','');
INSERT INTO `messages_users` VALUES('8','12','1','3','1','','','','','');
INSERT INTO `messages_users` VALUES('9','12','1','4','1','','','','','');
INSERT INTO `messages_users` VALUES('10','12','1','5','1','','','','','');
INSERT INTO `messages_users` VALUES('11','12','1','6','1','','','','','');
INSERT INTO `messages_users` VALUES('13','12','1','1','1','','','','','');
INSERT INTO `messages_users` VALUES('14','12','1','8','1','','','','','');
INSERT INTO `messages_users` VALUES('15','12','1','9','1','','','','','');
INSERT INTO `messages_users` VALUES('16','12','1','12','1','','','','','');
INSERT INTO `messages_users` VALUES('17','12','1','14','1','','','','','');
INSERT INTO `messages_users` VALUES('18','12','1','15','1','','','','','');
INSERT INTO `messages_users` VALUES('19','12','1','16','1','','','','','');
INSERT INTO `messages_users` VALUES('20','12','1','17','1','','','','','');
INSERT INTO `messages_users` VALUES('28','12','1','24','1','','','','','');
INSERT INTO `messages_users` VALUES('29','12','1','25','1','','','','','');
INSERT INTO `messages_users` VALUES('30','12','1','26','1','','','','','');
INSERT INTO `messages_users` VALUES('31','12','1','27','1','','','','','');
INSERT INTO `messages_users` VALUES('32','12','1','28','1','','','','','');
INSERT INTO `messages_users` VALUES('33','12','1','29','1','','','','','');
INSERT INTO `messages_users` VALUES('34','12','1','30','1','','','','','');
INSERT INTO `messages_users` VALUES('35','12','1','31','1','','','','','');
INSERT INTO `messages_users` VALUES('36','12','1','32','1','','','','','');
INSERT INTO `messages_users` VALUES('37','12','1','33','1','','','','','');
INSERT INTO `messages_users` VALUES('38','12','1','34','1','','','','','');
INSERT INTO `messages_users` VALUES('39','12','1','35','1','','','','','');
INSERT INTO `messages_users` VALUES('40','12','1','36','1','','','','','');
INSERT INTO `messages_users` VALUES('41','12','1','37','1','','','','','');
INSERT INTO `messages_users` VALUES('42','12','1','38','1','','','','','');
INSERT INTO `messages_users` VALUES('43','12','1','39','1','','','','','');
INSERT INTO `messages_users` VALUES('44','12','1','40','1','','','','','');
INSERT INTO `messages_users` VALUES('45','12','1','41','1','','','','','');
INSERT INTO `messages_users` VALUES('46','12','1','42','1','','','','','');
INSERT INTO `messages_users` VALUES('47','12','1','43','1','','','','','');
INSERT INTO `messages_users` VALUES('48','12','1','44','1','','','','','');
INSERT INTO `messages_users` VALUES('49','12','1','45','1','','','','','');
INSERT INTO `messages_users` VALUES('50','12','1','46','1','','','','','');
INSERT INTO `messages_users` VALUES('51','12','1','47','1','','','','','');
INSERT INTO `messages_users` VALUES('52','13','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('53','14','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('54','15','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('55','16','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('56','17','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('57','18','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('58','20','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('59','21','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('60','22','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('61','23','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('62','24','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('63','25','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('64','26','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('65','27','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('66','28','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('67','21','1','13','0','','','','','');
INSERT INTO `messages_users` VALUES('68','22','1','13','0','','','','','');
INSERT INTO `messages_users` VALUES('70','24','1','13','0','','','','','');
INSERT INTO `messages_users` VALUES('71','25','1','13','0','','','','','');
INSERT INTO `messages_users` VALUES('72','29','1','10','0','','','','','');
INSERT INTO `messages_users` VALUES('73','29','1','11','0','','','','','');
INSERT INTO `messages_users` VALUES('74','29','1','2','0','','','','','');
INSERT INTO `messages_users` VALUES('75','29','1','3','0','','','','','');
INSERT INTO `messages_users` VALUES('76','29','1','4','0','','','','','');
INSERT INTO `messages_users` VALUES('77','29','1','5','0','','','','','');
INSERT INTO `messages_users` VALUES('78','29','1','6','0','','','','','');
INSERT INTO `messages_users` VALUES('79','29','1','7','0','','','','','');
INSERT INTO `messages_users` VALUES('80','29','1','1','0','','','','','');
INSERT INTO `messages_users` VALUES('81','29','1','8','0','','','','','');
INSERT INTO `messages_users` VALUES('82','29','1','9','0','','','','','');
INSERT INTO `messages_users` VALUES('83','29','1','12','0','','','','','');
INSERT INTO `messages_users` VALUES('84','29','1','14','0','','','','','');
INSERT INTO `messages_users` VALUES('85','29','1','15','0','','','','','');
INSERT INTO `messages_users` VALUES('86','29','1','16','0','','','','','');
INSERT INTO `messages_users` VALUES('87','29','1','17','0','','','','','');
INSERT INTO `messages_users` VALUES('88','29','1','18','0','','','','','');
INSERT INTO `messages_users` VALUES('89','29','1','19','0','','','','','');
INSERT INTO `messages_users` VALUES('90','29','1','20','0','','','','','');
INSERT INTO `messages_users` VALUES('91','29','1','21','0','','','','','');
INSERT INTO `messages_users` VALUES('92','29','1','13','0','','','','','');
INSERT INTO `messages_users` VALUES('93','29','1','22','0','','','','','');
INSERT INTO `messages_users` VALUES('94','29','1','23','0','','','','','');
INSERT INTO `messages_users` VALUES('95','29','1','24','0','','','','','');
INSERT INTO `messages_users` VALUES('96','29','1','25','0','','','','','');
INSERT INTO `messages_users` VALUES('97','29','1','26','0','','','','','');
INSERT INTO `messages_users` VALUES('98','29','1','27','0','','','','','');
INSERT INTO `messages_users` VALUES('99','29','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('100','29','1','29','0','','','','','');
INSERT INTO `messages_users` VALUES('101','29','1','30','0','','','','','');
INSERT INTO `messages_users` VALUES('102','29','1','31','0','','','','','');
INSERT INTO `messages_users` VALUES('103','29','1','32','0','','','','','');
INSERT INTO `messages_users` VALUES('104','29','1','33','0','','','','','');
INSERT INTO `messages_users` VALUES('105','29','1','34','0','','','','','');
INSERT INTO `messages_users` VALUES('106','29','1','35','0','','','','','');
INSERT INTO `messages_users` VALUES('107','29','1','36','0','','','','','');
INSERT INTO `messages_users` VALUES('108','29','1','37','0','','','','','');
INSERT INTO `messages_users` VALUES('109','29','1','38','0','','','','','');
INSERT INTO `messages_users` VALUES('110','29','1','39','0','','','','','');
INSERT INTO `messages_users` VALUES('111','29','1','40','0','','','','','');
INSERT INTO `messages_users` VALUES('112','29','1','41','0','','','','','');
INSERT INTO `messages_users` VALUES('113','29','1','42','0','','','','','');
INSERT INTO `messages_users` VALUES('114','29','1','43','0','','','','','');
INSERT INTO `messages_users` VALUES('115','29','1','44','0','','','','','');
INSERT INTO `messages_users` VALUES('116','29','1','45','0','','','','','');
INSERT INTO `messages_users` VALUES('117','29','1','46','0','','','','','');
INSERT INTO `messages_users` VALUES('118','29','1','47','0','','','','','');
INSERT INTO `messages_users` VALUES('119','29','1','48','0','','','','','');
INSERT INTO `messages_users` VALUES('120','29','1','49','0','','','','','');
INSERT INTO `messages_users` VALUES('121','29','1','50','0','','','','','');
INSERT INTO `messages_users` VALUES('122','29','1','51','0','','','','','');
INSERT INTO `messages_users` VALUES('123','29','1','52','0','','','','','');
INSERT INTO `messages_users` VALUES('124','29','1','53','0','','','','','');
INSERT INTO `messages_users` VALUES('125','29','1','54','0','','','','','');
INSERT INTO `messages_users` VALUES('126','29','1','55','0','','','','','');
INSERT INTO `messages_users` VALUES('127','29','1','56','0','','','','','');
INSERT INTO `messages_users` VALUES('128','29','1','57','0','','','','','');
INSERT INTO `messages_users` VALUES('129','29','1','58','0','','','','','');
INSERT INTO `messages_users` VALUES('130','29','1','59','0','','','','','');
INSERT INTO `messages_users` VALUES('131','29','1','73','0','','','','','');
INSERT INTO `messages_users` VALUES('132','29','1','74','0','','','','','');
INSERT INTO `messages_users` VALUES('133','29','1','75','0','','','','','');
INSERT INTO `messages_users` VALUES('134','29','1','76','0','','','','','');
INSERT INTO `messages_users` VALUES('135','29','1','77','0','','','','','');
INSERT INTO `messages_users` VALUES('136','29','1','78','0','','','','','');
INSERT INTO `messages_users` VALUES('137','29','1','88','0','','','','','');
INSERT INTO `messages_users` VALUES('138','29','1','91','0','','','','','');
INSERT INTO `messages_users` VALUES('139','30','1','10','0','','','','','');
INSERT INTO `messages_users` VALUES('140','30','1','11','0','','','','','');
INSERT INTO `messages_users` VALUES('141','30','1','2','0','','','','','');
INSERT INTO `messages_users` VALUES('142','30','1','3','0','','','','','');
INSERT INTO `messages_users` VALUES('143','30','1','4','0','','','','','');
INSERT INTO `messages_users` VALUES('144','30','1','5','0','','','','','');
INSERT INTO `messages_users` VALUES('145','30','1','6','0','','','','','');
INSERT INTO `messages_users` VALUES('146','30','1','7','0','','','','','');
INSERT INTO `messages_users` VALUES('147','30','1','1','0','','','','','');
INSERT INTO `messages_users` VALUES('148','30','1','8','0','','','','','');
INSERT INTO `messages_users` VALUES('149','30','1','9','0','','','','','');
INSERT INTO `messages_users` VALUES('150','30','1','12','0','','','','','');
INSERT INTO `messages_users` VALUES('151','30','1','14','0','','','','','');
INSERT INTO `messages_users` VALUES('152','30','1','15','0','','','','','');
INSERT INTO `messages_users` VALUES('153','30','1','16','0','','','','','');
INSERT INTO `messages_users` VALUES('154','30','1','17','0','','','','','');
INSERT INTO `messages_users` VALUES('155','30','1','18','0','','','','','');
INSERT INTO `messages_users` VALUES('156','30','1','19','0','','','','','');
INSERT INTO `messages_users` VALUES('157','30','1','20','0','','','','','');
INSERT INTO `messages_users` VALUES('158','30','1','21','0','','','','','');
INSERT INTO `messages_users` VALUES('159','30','1','13','0','','','','','');
INSERT INTO `messages_users` VALUES('160','30','1','22','0','','','','','');
INSERT INTO `messages_users` VALUES('161','30','1','23','0','','','','','');
INSERT INTO `messages_users` VALUES('162','30','1','24','0','','','','','');
INSERT INTO `messages_users` VALUES('163','30','1','25','0','','','','','');
INSERT INTO `messages_users` VALUES('164','30','1','26','0','','','','','');
INSERT INTO `messages_users` VALUES('165','30','1','27','0','','','','','');
INSERT INTO `messages_users` VALUES('166','30','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('167','30','1','29','0','','','','','');
INSERT INTO `messages_users` VALUES('168','30','1','30','0','','','','','');
INSERT INTO `messages_users` VALUES('169','30','1','31','0','','','','','');
INSERT INTO `messages_users` VALUES('170','30','1','32','0','','','','','');
INSERT INTO `messages_users` VALUES('171','30','1','33','0','','','','','');
INSERT INTO `messages_users` VALUES('172','30','1','34','0','','','','','');
INSERT INTO `messages_users` VALUES('173','30','1','35','0','','','','','');
INSERT INTO `messages_users` VALUES('174','30','1','36','0','','','','','');
INSERT INTO `messages_users` VALUES('175','30','1','37','0','','','','','');
INSERT INTO `messages_users` VALUES('176','30','1','38','0','','','','','');
INSERT INTO `messages_users` VALUES('177','30','1','39','0','','','','','');
INSERT INTO `messages_users` VALUES('178','30','1','40','0','','','','','');
INSERT INTO `messages_users` VALUES('179','30','1','41','0','','','','','');
INSERT INTO `messages_users` VALUES('180','30','1','42','0','','','','','');
INSERT INTO `messages_users` VALUES('181','30','1','43','0','','','','','');
INSERT INTO `messages_users` VALUES('182','30','1','44','0','','','','','');
INSERT INTO `messages_users` VALUES('183','30','1','45','0','','','','','');
INSERT INTO `messages_users` VALUES('184','30','1','46','0','','','','','');
INSERT INTO `messages_users` VALUES('185','30','1','47','0','','','','','');
INSERT INTO `messages_users` VALUES('186','30','1','48','0','','','','','');
INSERT INTO `messages_users` VALUES('187','30','1','49','0','','','','','');
INSERT INTO `messages_users` VALUES('188','30','1','50','0','','','','','');
INSERT INTO `messages_users` VALUES('189','30','1','51','0','','','','','');
INSERT INTO `messages_users` VALUES('190','30','1','52','0','','','','','');
INSERT INTO `messages_users` VALUES('191','30','1','53','0','','','','','');
INSERT INTO `messages_users` VALUES('192','30','1','54','0','','','','','');
INSERT INTO `messages_users` VALUES('193','30','1','55','0','','','','','');
INSERT INTO `messages_users` VALUES('194','30','1','56','0','','','','','');
INSERT INTO `messages_users` VALUES('195','30','1','57','0','','','','','');
INSERT INTO `messages_users` VALUES('196','30','1','58','0','','','','','');
INSERT INTO `messages_users` VALUES('197','30','1','59','0','','','','','');
INSERT INTO `messages_users` VALUES('198','30','1','73','0','','','','','');
INSERT INTO `messages_users` VALUES('199','30','1','74','0','','','','','');
INSERT INTO `messages_users` VALUES('200','30','1','75','0','','','','','');
INSERT INTO `messages_users` VALUES('201','30','1','76','0','','','','','');
INSERT INTO `messages_users` VALUES('202','30','1','77','0','','','','','');
INSERT INTO `messages_users` VALUES('203','30','1','78','0','','','','','');
INSERT INTO `messages_users` VALUES('204','30','1','88','0','','','','','');
INSERT INTO `messages_users` VALUES('205','30','1','91','0','','','','','');
INSERT INTO `messages_users` VALUES('206','31','1','10','0','','','','','');
INSERT INTO `messages_users` VALUES('207','31','1','11','0','','','','','');
INSERT INTO `messages_users` VALUES('208','31','1','2','0','','','','','');
INSERT INTO `messages_users` VALUES('209','31','1','3','0','','','','','');
INSERT INTO `messages_users` VALUES('210','31','1','4','0','','','','','');
INSERT INTO `messages_users` VALUES('211','31','1','5','0','','','','','');
INSERT INTO `messages_users` VALUES('212','31','1','6','0','','','','','');
INSERT INTO `messages_users` VALUES('213','31','1','7','0','','','','','');
INSERT INTO `messages_users` VALUES('214','31','1','1','0','','','','','');
INSERT INTO `messages_users` VALUES('215','31','1','8','0','','','','','');
INSERT INTO `messages_users` VALUES('216','31','1','9','0','','','','','');
INSERT INTO `messages_users` VALUES('217','31','1','12','0','','','','','');
INSERT INTO `messages_users` VALUES('218','31','1','14','0','','','','','');
INSERT INTO `messages_users` VALUES('219','31','1','15','0','','','','','');
INSERT INTO `messages_users` VALUES('220','31','1','16','0','','','','','');
INSERT INTO `messages_users` VALUES('221','31','1','17','0','','','','','');
INSERT INTO `messages_users` VALUES('222','31','1','18','0','','','','','');
INSERT INTO `messages_users` VALUES('223','31','1','19','0','','','','','');
INSERT INTO `messages_users` VALUES('224','31','1','20','0','','','','','');
INSERT INTO `messages_users` VALUES('225','31','1','21','0','','','','','');
INSERT INTO `messages_users` VALUES('226','31','1','13','0','','','','','');
INSERT INTO `messages_users` VALUES('227','31','1','22','0','','','','','');
INSERT INTO `messages_users` VALUES('228','31','1','23','0','','','','','');
INSERT INTO `messages_users` VALUES('229','31','1','24','0','','','','','');
INSERT INTO `messages_users` VALUES('230','31','1','25','0','','','','','');
INSERT INTO `messages_users` VALUES('231','31','1','26','0','','','','','');
INSERT INTO `messages_users` VALUES('232','31','1','27','0','','','','','');
INSERT INTO `messages_users` VALUES('233','31','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('234','31','1','29','0','','','','','');
INSERT INTO `messages_users` VALUES('235','31','1','30','0','','','','','');
INSERT INTO `messages_users` VALUES('236','31','1','31','0','','','','','');
INSERT INTO `messages_users` VALUES('237','31','1','32','0','','','','','');
INSERT INTO `messages_users` VALUES('238','31','1','33','0','','','','','');
INSERT INTO `messages_users` VALUES('239','31','1','34','0','','','','','');
INSERT INTO `messages_users` VALUES('240','31','1','35','0','','','','','');
INSERT INTO `messages_users` VALUES('241','31','1','36','0','','','','','');
INSERT INTO `messages_users` VALUES('242','31','1','37','0','','','','','');
INSERT INTO `messages_users` VALUES('243','31','1','38','0','','','','','');
INSERT INTO `messages_users` VALUES('244','31','1','39','0','','','','','');
INSERT INTO `messages_users` VALUES('245','31','1','40','0','','','','','');
INSERT INTO `messages_users` VALUES('246','31','1','41','0','','','','','');
INSERT INTO `messages_users` VALUES('247','31','1','42','0','','','','','');
INSERT INTO `messages_users` VALUES('248','31','1','43','0','','','','','');
INSERT INTO `messages_users` VALUES('249','31','1','44','0','','','','','');
INSERT INTO `messages_users` VALUES('250','31','1','45','0','','','','','');
INSERT INTO `messages_users` VALUES('251','31','1','46','0','','','','','');
INSERT INTO `messages_users` VALUES('252','31','1','47','0','','','','','');
INSERT INTO `messages_users` VALUES('253','31','1','48','0','','','','','');
INSERT INTO `messages_users` VALUES('254','31','1','49','0','','','','','');
INSERT INTO `messages_users` VALUES('255','31','1','50','0','','','','','');
INSERT INTO `messages_users` VALUES('256','31','1','51','0','','','','','');
INSERT INTO `messages_users` VALUES('257','31','1','52','0','','','','','');
INSERT INTO `messages_users` VALUES('258','31','1','53','0','','','','','');
INSERT INTO `messages_users` VALUES('259','31','1','54','0','','','','','');
INSERT INTO `messages_users` VALUES('260','31','1','55','0','','','','','');
INSERT INTO `messages_users` VALUES('261','31','1','56','0','','','','','');
INSERT INTO `messages_users` VALUES('262','31','1','57','0','','','','','');
INSERT INTO `messages_users` VALUES('263','31','1','58','0','','','','','');
INSERT INTO `messages_users` VALUES('264','31','1','59','0','','','','','');
INSERT INTO `messages_users` VALUES('265','31','1','73','0','','','','','');
INSERT INTO `messages_users` VALUES('266','31','1','74','0','','','','','');
INSERT INTO `messages_users` VALUES('267','31','1','75','0','','','','','');
INSERT INTO `messages_users` VALUES('268','31','1','76','0','','','','','');
INSERT INTO `messages_users` VALUES('269','31','1','77','0','','','','','');
INSERT INTO `messages_users` VALUES('270','31','1','78','0','','','','','');
INSERT INTO `messages_users` VALUES('271','31','1','88','0','','','','','');
INSERT INTO `messages_users` VALUES('272','31','1','91','0','','','','','');
INSERT INTO `messages_users` VALUES('273','31','1','92','0','','','','','');
INSERT INTO `messages_users` VALUES('274','32','1','10','0','','','','','');
INSERT INTO `messages_users` VALUES('275','32','1','11','0','','','','','');
INSERT INTO `messages_users` VALUES('276','32','1','2','0','','','','','');
INSERT INTO `messages_users` VALUES('277','32','1','3','0','','','','','');
INSERT INTO `messages_users` VALUES('278','32','1','4','0','','','','','');
INSERT INTO `messages_users` VALUES('279','32','1','5','0','','','','','');
INSERT INTO `messages_users` VALUES('280','32','1','6','0','','','','','');
INSERT INTO `messages_users` VALUES('281','32','1','7','0','','','','','');
INSERT INTO `messages_users` VALUES('282','32','1','1','0','','','','','');
INSERT INTO `messages_users` VALUES('283','32','1','8','0','','','','','');
INSERT INTO `messages_users` VALUES('284','32','1','9','0','','','','','');
INSERT INTO `messages_users` VALUES('285','32','1','12','0','','','','','');
INSERT INTO `messages_users` VALUES('286','32','1','14','0','','','','','');
INSERT INTO `messages_users` VALUES('287','32','1','15','0','','','','','');
INSERT INTO `messages_users` VALUES('288','32','1','16','0','','','','','');
INSERT INTO `messages_users` VALUES('289','32','1','17','0','','','','','');
INSERT INTO `messages_users` VALUES('290','32','1','18','0','','','','','');
INSERT INTO `messages_users` VALUES('291','32','1','19','0','','','','','');
INSERT INTO `messages_users` VALUES('292','32','1','20','0','','','','','');
INSERT INTO `messages_users` VALUES('293','32','1','21','0','','','','','');
INSERT INTO `messages_users` VALUES('294','32','1','13','0','','','','','');
INSERT INTO `messages_users` VALUES('295','32','1','22','0','','','','','');
INSERT INTO `messages_users` VALUES('296','32','1','23','0','','','','','');
INSERT INTO `messages_users` VALUES('297','32','1','24','0','','','','','');
INSERT INTO `messages_users` VALUES('298','32','1','25','0','','','','','');
INSERT INTO `messages_users` VALUES('299','32','1','26','0','','','','','');
INSERT INTO `messages_users` VALUES('300','32','1','27','0','','','','','');
INSERT INTO `messages_users` VALUES('301','32','1','28','0','','','','','');
INSERT INTO `messages_users` VALUES('302','32','1','29','0','','','','','');
INSERT INTO `messages_users` VALUES('303','32','1','30','0','','','','','');
INSERT INTO `messages_users` VALUES('304','32','1','31','0','','','','','');
INSERT INTO `messages_users` VALUES('305','32','1','32','0','','','','','');
INSERT INTO `messages_users` VALUES('306','32','1','33','0','','','','','');
INSERT INTO `messages_users` VALUES('307','32','1','34','0','','','','','');
INSERT INTO `messages_users` VALUES('308','32','1','35','0','','','','','');
INSERT INTO `messages_users` VALUES('309','32','1','36','0','','','','','');
INSERT INTO `messages_users` VALUES('310','32','1','37','0','','','','','');
INSERT INTO `messages_users` VALUES('311','32','1','38','0','','','','','');
INSERT INTO `messages_users` VALUES('312','32','1','39','0','','','','','');
INSERT INTO `messages_users` VALUES('313','32','1','40','0','','','','','');
INSERT INTO `messages_users` VALUES('314','32','1','41','0','','','','','');
INSERT INTO `messages_users` VALUES('315','32','1','42','0','','','','','');
INSERT INTO `messages_users` VALUES('316','32','1','43','0','','','','','');
INSERT INTO `messages_users` VALUES('317','32','1','44','0','','','','','');
INSERT INTO `messages_users` VALUES('318','32','1','45','0','','','','','');
INSERT INTO `messages_users` VALUES('319','32','1','46','0','','','','','');
INSERT INTO `messages_users` VALUES('320','32','1','47','0','','','','','');
INSERT INTO `messages_users` VALUES('321','32','1','48','0','','','','','');
INSERT INTO `messages_users` VALUES('322','32','1','49','0','','','','','');
INSERT INTO `messages_users` VALUES('323','32','1','50','0','','','','','');
INSERT INTO `messages_users` VALUES('324','32','1','51','0','','','','','');
INSERT INTO `messages_users` VALUES('325','32','1','52','0','','','','','');
INSERT INTO `messages_users` VALUES('326','32','1','53','0','','','','','');
INSERT INTO `messages_users` VALUES('327','32','1','54','0','','','','','');
INSERT INTO `messages_users` VALUES('328','32','1','55','0','','','','','');
INSERT INTO `messages_users` VALUES('329','32','1','56','0','','','','','');
INSERT INTO `messages_users` VALUES('335','32','1','75','0','','','','','');
INSERT INTO `messages_users` VALUES('336','32','1','76','0','','','','','');
INSERT INTO `messages_users` VALUES('337','32','1','77','0','','','','','');
INSERT INTO `messages_users` VALUES('338','32','1','78','0','','','','','');
INSERT INTO `messages_users` VALUES('339','32','1','88','0','','','','','');
INSERT INTO `messages_users` VALUES('340','32','1','91','0','','','','','');
INSERT INTO `messages_users` VALUES('341','32','1','92','0','','','','','');
INSERT INTO `messages_users` VALUES('342','32','2','0','0','????????','2015-10-31 18:15:48','admin','2015-10-31 18:15:48','admin');
INSERT INTO `messages_users` VALUES('343','32','2','0','0','????????','2015-10-31 18:20:23','admin','2015-10-31 18:20:23','admin');
INSERT INTO `messages_users` VALUES('344','1','2','92','0','????????????????????????????????????????????????????','2015-10-31 18:26:52','admin','2015-10-31 18:26:52','admin');
INSERT INTO `messages_users` VALUES('345','1','1','0','0','????????????????????????????????????????????????????','2015-10-31 18:47:06','admin','2015-10-31 18:47:06','admin');
INSERT INTO `messages_users` VALUES('346','1','1','91','0','????????????????????????????????????????????????????','2015-10-31 19:10:37','admin','2015-10-31 19:10:37','admin');
INSERT INTO `messages_users` VALUES('347','1','1','92','0','????????????????????????????????????????????????????','2015-10-31 19:10:37','admin','2015-10-31 19:10:37','admin');
INSERT INTO `messages_users` VALUES('348','1','1','91','0','????????????????????????????????????????????????????','2015-10-31 19:10:49','admin','2015-10-31 19:10:49','admin');
INSERT INTO `messages_users` VALUES('349','1','1','92','0','????????????????????????????????????????????????????','2015-10-31 19:10:49','admin','2015-10-31 19:10:49','admin');
INSERT INTO `messages_users` VALUES('350','1','1','1','0','????????????????????????????????????????????????????','2015-10-31 19:11:13','admin','2015-10-31 19:11:13','admin');
INSERT INTO `messages_users` VALUES('351','1','6','92','0','???????????????????????BJSJ0201510310001??????????????','2015-10-31 19:41:02','admin','2015-10-31 19:41:02','admin');
INSERT INTO `messages_users` VALUES('369','1','5','94','0','????????????????????????????????','2015-11-01 14:04:37','admin','2015-11-01 14:04:37','admin');
INSERT INTO `messages_users` VALUES('373','1','5','101','1','??????????????????3??????????????','2015-11-01 18:54:41','admin','2015-11-01 18:54:41','admin');
INSERT INTO `messages_users` VALUES('374','1','5','101','1','??????????????????3??????????????','2015-11-01 18:54:53','admin','2015-11-01 18:54:53','admin');
INSERT INTO `messages_users` VALUES('375','1','7','101','0','?????????????????????????','2015-11-01 18:55:40','admin','2015-11-01 18:55:40','admin');
INSERT INTO `messages_users` VALUES('376','1','7','101','0','?????????????????????????','2015-11-01 18:56:29','admin','2015-11-01 18:56:29','admin');
INSERT INTO `messages_users` VALUES('377','1','7','101','0','?????????????????????????','2015-11-01 18:56:32','admin','2015-11-01 18:56:32','admin');
INSERT INTO `messages_users` VALUES('378','1','7','101','0','?????????????????????????','2015-11-01 18:56:44','admin','2015-11-01 18:56:44','admin');
INSERT INTO `messages_users` VALUES('379','1','7','101','0','?????????????????????????','2015-11-01 18:57:40','admin','2015-11-01 18:57:40','admin');
INSERT INTO `messages_users` VALUES('380','1','6','101','0','???????????????????????BJSJ0201511010003??????????????','2015-11-01 18:58:33','admin','2015-11-01 18:58:33','admin');
INSERT INTO `messages_users` VALUES('381','1','5','86','0','??????????????????1??????????????','2015-11-01 21:22:12','admin','2015-11-01 21:22:12','admin');
INSERT INTO `messages_users` VALUES('382','1','5','88','0','??????????????????1??????????????','2015-11-01 21:38:01','admin','2015-11-01 21:38:01','admin');
INSERT INTO `messages_users` VALUES('388','1','6','106','0','???????????????????????BJSJ0201511050001??????????????','2015-11-05 15:13:16','admin','2015-11-05 15:13:16','admin');
INSERT INTO `messages_users` VALUES('389','1','10','121','0','?????????????????????????????','2015-11-07 02:24:06','admin','2015-11-07 02:24:06','admin');
INSERT INTO `messages_users` VALUES('390','1','10','122','0','?????????????????????????????','2015-11-07 02:24:49','admin','2015-11-07 02:24:49','admin');
INSERT INTO `messages_users` VALUES('391','1','10','123','0','?????????????????????????????','2015-11-07 02:28:17','admin','2015-11-07 02:28:17','admin');
INSERT INTO `messages_users` VALUES('392','1','10','124','0','?????????????????????????????','2015-11-07 02:30:37','admin','2015-11-07 02:30:37','admin');
INSERT INTO `messages_users` VALUES('393','1','10','126','0','?????????????????????????????','2015-11-07 02:35:36','admin','2015-11-07 02:35:36','admin');
INSERT INTO `messages_users` VALUES('394','1','10','127','0','?????????????????????????????','2015-11-07 02:38:45','admin','2015-11-07 02:38:45','admin');
INSERT INTO `messages_users` VALUES('395','1','10','127','0','?????????????????????????????','2015-11-07 02:42:03','admin','2015-11-07 02:42:03','admin');
INSERT INTO `messages_users` VALUES('396','1','10','128','0','?????????????????????????????','2015-11-07 02:43:27','admin','2015-11-07 02:43:27','admin');
INSERT INTO `messages_users` VALUES('397','1','10','129','0','?????????????????????????????','2015-11-07 02:44:20','admin','2015-11-07 02:44:20','admin');
INSERT INTO `messages_users` VALUES('398','1','10','129','0','?????????????????????????????','2015-11-07 02:45:52','admin','2015-11-07 02:45:52','admin');
INSERT INTO `messages_users` VALUES('399','1','10','131','1','?????????????????????????????','2015-11-07 02:48:48','admin','2015-11-07 02:48:48','admin');
INSERT INTO `messages_users` VALUES('400','1','5','131','1','???????????????????????????????????????????????','2015-11-07 17:54:08','admin','2015-11-07 17:54:08','admin');
INSERT INTO `messages_users` VALUES('401','1','6','131','1','??????????????????????????-?????????????','2015-11-07 17:54:37','admin','2015-11-07 17:54:37','admin');
INSERT INTO `messages_users` VALUES('402','1','3','131','1','?????????????????????????????1???????????????????????','2015-11-07 18:06:43','admin','2015-11-07 18:06:43','admin');
INSERT INTO `messages_users` VALUES('403','1','3','131','1','?????????????????????????????1???????????????????????','2015-11-07 18:07:22','admin','2015-11-07 18:07:22','admin');
INSERT INTO `messages_users` VALUES('404','1','3','131','0','?????????????????????????????1???????????????????????','2015-11-07 18:10:04','admin','2015-11-07 18:10:04','admin');
INSERT INTO `messages_users` VALUES('405','1','10','135','0','?????????????????????????????','2015-11-08 18:19:30','admin','2015-11-08 18:19:30','admin');
INSERT INTO `messages_users` VALUES('408','1','7','135','0','?????????????????????????','2015-11-08 18:35:13','admin','2015-11-08 18:35:13','admin');
INSERT INTO `messages_users` VALUES('409','1','10','136','0','?????????????????????????????','2015-11-08 18:51:04','admin','2015-11-08 18:51:04','admin');
INSERT INTO `messages_users` VALUES('411','1','5','136','0','???????????????????????????????????????????????','2015-11-08 18:55:46','admin','2015-11-08 18:55:46','admin');
INSERT INTO `messages_users` VALUES('412','1','5','136','0','???????????????????????????????????????????????','2015-11-08 19:03:43','admin','2015-11-08 19:03:43','admin');
INSERT INTO `messages_users` VALUES('413','1','5','136','0','???????????????????????????????????????????????','2015-11-08 19:03:46','admin','2015-11-08 19:03:46','admin');
INSERT INTO `messages_users` VALUES('414','1','7','136','0','?????????????????????????','2015-11-08 19:04:00','admin','2015-11-08 19:04:00','admin');
INSERT INTO `messages_users` VALUES('415','1','7','136','0','?????????????????????????','2015-11-08 19:12:20','admin','2015-11-08 19:12:20','admin');
INSERT INTO `messages_users` VALUES('416','1','3','131','0','?????????????????????????????1???????????????????????','2015-11-09 06:53:08','admin','2015-11-09 06:53:08','admin');
INSERT INTO `messages_users` VALUES('417','1','3','131','0','?????????????????????????????1???????????????????????','2015-11-09 06:58:13','admin','2015-11-09 06:58:13','admin');
INSERT INTO `messages_users` VALUES('418','1','3','136','0','?????????????????????????????1???????????????????????','2015-11-09 10:54:40','admin','2015-11-09 10:54:40','admin');
INSERT INTO `messages_users` VALUES('419','1','3','136','0','?????????????????????????????1???????????????????????','2015-11-09 10:56:52','admin','2015-11-09 10:56:52','admin');
INSERT INTO `messages_users` VALUES('420','1','3','136','0','?????????????????????????????1???????????????????????','2015-11-09 11:01:11','admin','2015-11-09 11:01:11','admin');
INSERT INTO `messages_users` VALUES('421','1','5','136','0','???????????????????????????????????????????????','2015-11-09 11:28:03','admin','2015-11-09 11:28:03','admin');
INSERT INTO `messages_users` VALUES('422','1','6','136','0','??????????????????????????-?????????????','2015-11-09 11:28:11','admin','2015-11-09 11:28:11','admin');
INSERT INTO `messages_users` VALUES('423','1','10','137','0','?????????????????????????????','2015-11-09 12:12:52','admin','2015-11-09 12:12:52','admin');
INSERT INTO `messages_users` VALUES('425','1','5','137','0','???????????????????????????????????????????????','2015-11-09 12:16:19','admin','2015-11-09 12:16:19','admin');
INSERT INTO `messages_users` VALUES('426','1','6','137','0','??????????????????????????-?????????????','2015-11-09 12:17:02','admin','2015-11-09 12:17:02','admin');
INSERT INTO `messages_users` VALUES('427','1','3','137','0','?????????????????????????????1???????????????????????','2015-11-09 17:22:16','admin','2015-11-09 17:22:16','admin');
INSERT INTO `messages_users` VALUES('428','1','10','138','0','?????????????????????????????','2015-11-09 17:50:25','admin','2015-11-09 17:50:25','admin');
INSERT INTO `messages_users` VALUES('429','1','8','138','0','???????????????????????????','2015-11-09 17:52:43','admin','2015-11-09 17:52:43','admin');
INSERT INTO `messages_users` VALUES('430','1','8','138','0','???????????????????????????','2015-11-09 18:03:46','admin','2015-11-09 18:03:46','admin');
INSERT INTO `messages_users` VALUES('431','1','8','138','0','???????????????????????????','2015-11-09 18:04:38','admin','2015-11-09 18:04:38','admin');
INSERT INTO `messages_users` VALUES('432','1','8','138','0','???????????????????????????','2015-11-09 18:06:37','admin','2015-11-09 18:06:37','admin');
INSERT INTO `messages_users` VALUES('433','1','8','138','0','???????????????????????????','2015-11-09 18:09:04','admin','2015-11-09 18:09:04','admin');
INSERT INTO `messages_users` VALUES('434','1','5','141','1','???????????????????????????????????????????????','2015-11-10 13:37:58','admin','2015-11-10 13:37:58','admin');
INSERT INTO `messages_users` VALUES('435','1','5','141','0','???????????????????????????????????????????????','2015-11-10 13:38:14','admin','2015-11-10 13:38:14','admin');
INSERT INTO `messages_users` VALUES('436','1','6','141','0','??????????????????????????-?????????????','2015-11-10 13:38:30','admin','2015-11-10 13:38:30','admin');
INSERT INTO `messages_users` VALUES('437','1','6','141','0','??????????????????????????-?????????????','2015-11-10 13:45:50','admin','2015-11-10 13:45:50','admin');
INSERT INTO `messages_users` VALUES('438','1','6','141','0','??????????????????????????-?????????????','2015-11-10 13:46:52','admin','2015-11-10 13:46:52','admin');
INSERT INTO `messages_users` VALUES('439','1','3','141','0','?????????????????????????????1???????????????????????','2015-11-10 13:47:17','admin','2015-11-10 13:47:17','admin');
INSERT INTO `messages_users` VALUES('440','1','10','143','0','?????????????????????????????','2015-11-11 08:53:23','admin','2015-11-11 08:53:23','admin');
INSERT INTO `messages_users` VALUES('441','1','8','143','0','???????????????????????????','2015-11-11 09:32:21','admin','2015-11-11 09:32:21','admin');
INSERT INTO `messages_users` VALUES('442','1','8','143','0','???????????????????????????','2015-11-11 09:33:12','admin','2015-11-11 09:33:12','admin');
INSERT INTO `messages_users` VALUES('443','1','6','141','0','??????????????????????????-?????????????','2015-11-11 11:51:48','admin','2015-11-11 11:51:48','admin');
INSERT INTO `messages_users` VALUES('444','1','5','143','0','???????????????????????????????????????????????','2015-11-11 11:54:45','admin','2015-11-11 11:54:45','admin');
INSERT INTO `messages_users` VALUES('445','1','6','143','0','??????????????????????????-?????????????','2015-11-11 11:54:59','admin','2015-11-11 11:54:59','admin');
INSERT INTO `messages_users` VALUES('446','1','10','150','1','?????????????????????????????','2015-11-11 15:35:51','admin','2015-11-11 15:35:51','admin');
INSERT INTO `messages_users` VALUES('449','1','8','150','1','???????????????????????????','2015-11-11 15:42:44','admin','2015-11-11 15:42:44','admin');
INSERT INTO `messages_users` VALUES('450','1','8','150','1','???????????????????????????','2015-11-11 15:48:49','admin','2015-11-11 15:48:49','admin');
INSERT INTO `messages_users` VALUES('451','1','11','150','0','??????????????????????????','2015-11-11 16:14:50','admin','2015-11-11 16:14:50','admin');
INSERT INTO `messages_users` VALUES('452','1','12','150','0','??????????????????????????????????','2015-11-11 16:51:09','admin','2015-11-11 16:51:09','admin');
INSERT INTO `messages_users` VALUES('453','1','12','149','0','??????????????????????????????????','2015-11-11 16:51:10','admin','2015-11-11 16:51:10','admin');
INSERT INTO `messages_users` VALUES('454','1','12','148','0','??????????????????????????????????','2015-11-11 16:51:10','admin','2015-11-11 16:51:10','admin');
INSERT INTO `messages_users` VALUES('455','1','12','143','0','??????????????????????????????????','2015-11-11 16:51:10','admin','2015-11-11 16:51:10','admin');
INSERT INTO `messages_users` VALUES('456','1','7','150','0','?????????????????????????','2015-11-11 17:07:04','admin','2015-11-11 17:07:04','admin');
INSERT INTO `messages_users` VALUES('457','1','5','150','0','???????????????????????????????????????????????','2015-11-11 17:31:41','admin','2015-11-11 17:31:41','admin');
INSERT INTO `messages_users` VALUES('458','1','11','150','0','??????????????????????????','2015-11-11 18:08:05','admin','2015-11-11 18:08:05','admin');
INSERT INTO `messages_users` VALUES('459','1','6','150','0','??????????????????????????-?????????????','2015-11-11 18:12:14','admin','2015-11-11 18:12:14','admin');
--
-- 表的结构migration
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 migration
--

INSERT INTO `migration` VALUES('m000000_000000_base','1445869380');
INSERT INTO `migration` VALUES('m140506_102106_rbac_init','1445870155');
--
-- 表的结构news
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL DEFAULT '' COMMENT '??',
  `content` text COMMENT '??',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '????',
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '??ID',
  `status` tinyint(2) NOT NULL COMMENT '??0???1???',
  `thumb` varchar(45) DEFAULT NULL COMMENT '???',
  `is_pic` tinyint(2) NOT NULL DEFAULT '0' COMMENT '??????1?0??',
  `is_recommend` tinyint(2) NOT NULL DEFAULT '0' COMMENT '????',
  `tag` varchar(50) NOT NULL DEFAULT '' COMMENT '??',
  `related_news` varchar(100) NOT NULL DEFAULT '' COMMENT '????',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `index_user_id` (`user_id`),
  KEY `index_category_id` (`category_id`),
  KEY `index_create_time_is_pic_is_recommend` (`create_time`,`is_pic`,`is_recommend`)
) ENGINE=InnoDB AUTO_INCREMENT=234 DEFAULT CHARSET=utf8 COMMENT='???';

--
-- 转存表中的数据 news
--

INSERT INTO `news` VALUES('39','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('40','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('41','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('42','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('43','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('44','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('45','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('46','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('47','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('48','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('49','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('50','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('51','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('52','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('53','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('54','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('55','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('56','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('57','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('58','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('59','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('60','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('61','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('62','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('63','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('64','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('65','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('66','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('67','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('68','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('69','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('70','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('71','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('72','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('73','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('74','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('75','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('76','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('77','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('78','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('79','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('80','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('81','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('82','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('83','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('84','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('85','????????????????12','????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12????????????????12','0','4','1','1441806606.jpg','1','1','','','2015-08-24 14:00:33','admin','2015-08-24 14:32:33','admin');
INSERT INTO `news` VALUES('86','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','2','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('87','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','2','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('88','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','2','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('89','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','2','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('90','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','2','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('105','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','5','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('106','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','5','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('107','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','5','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('108','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','5','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('109','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','5','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('110','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','5','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('111','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','5','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('112','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','5','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('113','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','5','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('114','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','5','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('115','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','5','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('116','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','5','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('117','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','5','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('118','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','8','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('119','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','8','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('120','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','8','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('121','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','8','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('122','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','8','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('123','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','7','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('124','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','7','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('125','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','7','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('126','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','7','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('127','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','7','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('128','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','6','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('129','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','6','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('130','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','6','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('131','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','6','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('132','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','6','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('134','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','2','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('135','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','2','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('137','????????????????????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','2','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-11-07 06:03:30','admin');
INSERT INTO `news` VALUES('141','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','4','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('142','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','4','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('143','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','4','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('144','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','4','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('145','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','4','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('146','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','4','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('147','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','4','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('148','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','4','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('149','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','4','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('150','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','4','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('151','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','4','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('152','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','4','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('153','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','4','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('154','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','4','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('155','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','4','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('156','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','1','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('157','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','1','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('158','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','1','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('159','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','1','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('160','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','1','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('161','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','1','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('162','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','1','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('163','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','1','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('164','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','1','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('165','????????????????','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','1','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('166','????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','3','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('167','????2','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','3','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('168','????3','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','3','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('169','????4','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','3','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('170','????5','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','3','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('171','????6','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','3','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('172','????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','9','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('173','????2','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','9','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('174','????3','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','9','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('175','????4','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','9','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('176','????5','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','9','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('177','????16','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','9','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('178','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('179','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('180','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('181','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('182','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('183','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('184','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('185','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('186','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('187','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('188','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('189','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('190','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('191','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('192','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('193','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('194','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('195','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('196','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('197','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('198','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('199','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('200','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('201','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('202','?????????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','2','11','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('203','????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','0','8','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('204','????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','0','8','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('205','????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','0','8','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('206','????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','0','8','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('207','????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','0','8','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('208','????1','<span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;background-color:#FFFFFF;\">?????</span><span style=\"color:#A94442;fo','0','8','1','1441806606.jpg','1','1','','','2015-08-23 16:25:52','admin','2015-08-26 15:35:52','admin');
INSERT INTO `news` VALUES('209','dd','<blockquote>?????<a href=\"https://jellybool.com/post/programming-with-yii2-rich-text-input-with-redactor\">https://jellybool.com/post/programming-with-yii2-rich-text-input-with-redactor</a></blockquote><p>?????????????????????????????????????????????????????????</p><p>??????????????????????????RBAC?????????????????????????????????Yii2???????????????????????????textarea????????????????????????????????????????????????????????????????????????????????????????????(????????)????????????????????????</p>','0','1','1','1446603778.jpg','1','0','','','2015-11-04 02:10:51','admin','2015-11-04 02:23:02','admin');
INSERT INTO `news` VALUES('210','e','e3','0','1','1','','0','0','','','2015-11-06 05:48:51','admin','2015-11-06 05:49:01','admin');
INSERT INTO `news` VALUES('211','??','???','0','0','1','','0','0','','','2015-11-06 05:49:11','admin','2015-11-06 05:49:11','admin');
INSERT INTO `news` VALUES('212','???','a\'s????','0','0','1','','0','0','','','2015-11-06 05:49:34','admin','2015-11-06 05:49:34','admin');
INSERT INTO `news` VALUES('213','???','2323','0','0','1','','0','0','','','2015-11-06 05:53:29','admin','2015-11-06 05:53:29','admin');
INSERT INTO `news` VALUES('214','2332','232','0','0','1','','0','0','','','2015-11-06 05:53:39','admin','2015-11-06 05:53:39','admin');
INSERT INTO `news` VALUES('215','232','2323','0','0','1','','0','0','','','2015-11-06 05:53:49','admin','2015-11-06 05:53:57','admin');
INSERT INTO `news` VALUES('216','2323','2323','0','1','1','','0','0','','','2015-11-06 05:54:42','admin','2015-11-06 05:54:42','admin');
INSERT INTO `news` VALUES('217','2323','2323','0','1','1','','0','1','','','2015-11-06 05:54:51','admin','2015-11-06 05:54:51','admin');
INSERT INTO `news` VALUES('218','??','??','0','1','1','','0','0','','','2015-11-06 07:47:54','admin','2015-11-06 07:47:54','admin');
INSERT INTO `news` VALUES('219','333','33','0','1','1','','0','0','','','2015-11-06 07:49:48','admin','2015-11-06 07:49:48','admin');
INSERT INTO `news` VALUES('220','333','\r\n?????????? ??????\r\n\r\n2015-11-06 14:47:00???? ?? ??\r\n\r\n???????????11?6???????????????????????????????????????????????????????????????????????????????????????\r\n???????????????�??�??????�??????�?�???????�?????????????????????????????????????????????????????\r\n???????????????????????????????????????????????????????????????????????\r\n\r\n??????????????????????????????????????????????�211???�?????????????????????????2000?????????????????????????????????????????????????????????????\r\n?????????????????????','0','1','1','','0','0','','','2015-11-06 07:55:47','admin','2015-11-06 07:55:47','admin');
INSERT INTO `news` VALUES('221','2323','\r\n?????????? ??????\r\n\r\n2015-11-06 14:47:00???? ?? ??\r\n\r\n???????????11?6???????????????????????????????????????????????????????????????????????????????????????\r\n???????????????�??�??????�??????�?�???????�?????????????????????????????????????????????????????\r\n???????????????????????????????????????????????????????????????????????\r\n\r\n??????????????????????????????????????????????�211???�?????????????????????????2000?????????????????????????????????????????????????????????????\r\n?????????????????????????????????????????????????????????????????????????????????????????????????2014???????????????????????????????????????\r\n??2015?9???????????????????????????????????????????????????????????????????�??????�?�????? ?????�?�???????�???????????????????????\r\n???????????????�???�????????????????????????11??????????????????�???�??????????????????????????????�???�???????????20:00???????22:00???????\r\n?????????????????????????????????????????????????????????????????????????????????????????????????????????�???�?????????????????????????????????????????????50%?????????????????????????�???�????????????????????????????????????????????????????????????\r\n?????????????????????????????????????????????????????????????????????????????????????????????????????????????\r\n??1.?????????????????????????????�????????????�?�????? ?????�?�???????�???????\r\n??2.??????????????????????????????????????????????????�??????�?�????? ?????�?�???????�????????????????\r\n??3.????????????????????????????????????????????????????????????????????????????????????????????????????????4.?????????????????????????\r\n??5.???????????????????\r\n???????????????????????????\r\n','0','1','1','','0','0','','','2015-11-06 07:56:44','admin','2015-11-06 07:56:44','admin');
INSERT INTO `news` VALUES('222','??','??','0','1','1','','0','0','','','2015-11-06 11:45:06','admin','2015-11-06 11:45:06','admin');
INSERT INTO `news` VALUES('223','??','??','0','10','1','','0','0','','','2015-11-06 11:45:29','admin','2015-11-06 11:45:29','admin');
INSERT INTO `news` VALUES('224','????','??','0','10','1','','0','0','','','2015-11-06 11:45:42','admin','2015-11-06 11:45:42','admin');
INSERT INTO `news` VALUES('225','233232','23223','0','1','1','','0','0','','','2015-11-07 05:25:36','admin','2015-11-07 05:25:36','admin');
INSERT INTO `news` VALUES('226','2323','2323','0','9','1','','0','0','','','2015-11-07 05:25:51','admin','2015-11-07 05:25:51','admin');
INSERT INTO `news` VALUES('227','22323','23233','0','5','1','','0','0','','','2015-11-07 05:30:22','admin','2015-11-07 05:30:22','admin');
INSERT INTO `news` VALUES('228','23322','32332','0','9','1','','0','0','','','2015-11-07 05:30:29','admin','2015-11-07 05:30:29','admin');
INSERT INTO `news` VALUES('229','2333','2333','0','9','1','','0','0','','','2015-11-07 05:31:29','admin','2015-11-07 05:31:29','admin');
INSERT INTO `news` VALUES('230','2323','22323','0','5','1','','0','0','','','2015-11-07 05:34:10','admin','2015-11-07 05:34:10','admin');
INSERT INTO `news` VALUES('231','22323','32323','0','3','1','','0','0','','','2015-11-07 05:38:17','admin','2015-11-07 05:38:17','admin');
INSERT INTO `news` VALUES('232','2332','3333','0','10','1','','0','0','','','2015-11-07 05:38:26','admin','2015-11-07 05:38:26','admin');
INSERT INTO `news` VALUES('233','2323','sss','0','5','1','1446903476.jpg','0','0','','','2015-11-07 13:37:56','admin','2015-11-07 13:37:56','admin');
--
-- 表的结构news_category
--

DROP TABLE IF EXISTS `news_category`;
CREATE TABLE `news_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='?????';

--
-- 转存表中的数据 news_category
--

INSERT INTO `news_category` VALUES('1','????','2015-08-23 08:11:23','admin','2015-08-23 08:13:26','admin');
INSERT INTO `news_category` VALUES('2','????','2015-08-23 08:13:36','admin','2015-08-23 08:13:36','admin');
INSERT INTO `news_category` VALUES('3','????','2015-08-23 16:12:18','admin','2015-08-23 16:12:18','admin');
INSERT INTO `news_category` VALUES('4','????','2015-08-26 14:40:37','admin','2015-08-26 14:40:37','admin');
INSERT INTO `news_category` VALUES('5','?????','2015-08-26 14:40:49','admin','2015-08-26 14:40:49','admin');
INSERT INTO `news_category` VALUES('6','?????','2015-08-26 14:41:30','admin','2015-08-26 14:41:30','admin');
INSERT INTO `news_category` VALUES('7','????','2015-08-26 14:41:45','admin','2015-08-26 14:41:45','admin');
INSERT INTO `news_category` VALUES('8','????','2015-08-26 14:43:26','admin','2015-08-26 14:43:26','admin');
INSERT INTO `news_category` VALUES('9','????','2015-08-26 14:44:08','admin','2015-08-26 14:44:08','admin');
INSERT INTO `news_category` VALUES('10','????','2015-08-26 14:47:25','admin','2015-08-26 14:47:25','admin');
INSERT INTO `news_category` VALUES('11','?????????','2015-09-10 07:45:38','admin','2015-09-10 07:45:38','admin');
--
-- 表的结构orders
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` varchar(200) NOT NULL DEFAULT '' COMMENT '??',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(3) NOT NULL COMMENT '???0???1???2???3??',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '??1????2????',
  `level_id` int(11) NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `index_user_id` (`user_id`),
  KEY `index_search` (`create_time`,`level_id`,`type`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='???';

--
-- 转存表中的数据 orders
--

--
-- 表的结构pages
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL DEFAULT '',
  `content` text,
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='???????';

--
-- 转存表中的数据 pages
--

INSERT INTO `pages` VALUES('1','????','<span style=\"color:#494949;font-family:\'Microsoft Yahei\';font-size:13px;font-style:normal;font-weight:normal;line-height:30px;background-color:#EFEFEF;\">???????????????????????Beijing Football Association????BFA????1992?8?31?????????????????????2???????????????????????????????????????????????????????????????????????</span><br />\r\n<span style=\"color:#494949;font-family:\'Microsoft Yahei\';font-size:13px;font-style:normal;font-weight:normal;line-height:30px;background-color:#EFEFEF;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</span><br />\r\n<span style=\"color:#494949;font-family:\'Microsoft Yahei\';font-size:13px;font-style:normal;font-weight:normal;line-height:30px;background-color:#EFEFEF;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;???????????????????????????????????????????????????????????</span><br />\r\n<span style=\"color:#494949;font-family:\'Microsoft Yahei\';font-size:13px;font-style:normal;font-weight:normal;line-height:30px;background-color:#EFEFEF;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;???????????????????????????????????????????????????????????????????????????????????????????????????????????29????????????10????????????????????2003?????????????????2004??????????????????2005?????????????????????????????2007??????????????????2008?????????????????????????????????????????????</span>','','','2015-09-16 16:42:25','admin');
INSERT INTO `pages` VALUES('2','???????','<p>\r\n	??????????????????????????????????????????\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	?????????????????????\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img src=\"/upload/images/pages/image/20150823/20150823050009_30513.jpg\" alt=\"\" /> \r\n</p>','2015-08-23 05:00:11','admin','2015-08-23 05:00:32','admin');
INSERT INTO `pages` VALUES('3','????','<pre>????11????11????11????11????11????11????11\r\n</pre>','2015-08-23 16:27:19','admin','2015-08-26 14:45:30','admin');
INSERT INTO `pages` VALUES('4','???????','??????????????????????????????????????????','2015-08-26 14:44:41','admin','2015-08-26 14:44:46','admin');
INSERT INTO `pages` VALUES('5','????tt','<p>\r\n	<img src=\"http://coach.lfm123.com/images/adv.jpg\" /> \r\n</p>\r\n<p>\r\n	?&nbsp;&nbsp;?&nbsp;?????????\r\n</p>\r\n?????010 89898787<br />\r\n?????2015?05?10?<br />\r\n?????????????????\r\n<div id=\"xunlei_com_thunder_helper_plugin_d462f475-c18e-46be-bd10-327458d045bd\">\r\n</div>\r\n<div id=\"xunlei_com_thunder_helper_plugin_d462f475-c18e-46be-bd10-327458d045bd\">\r\n</div>','2015-11-11 08:35:04','admin','2015-11-11 08:45:42','admin');
INSERT INTO `pages` VALUES('6','test','<div id=\"xunlei_com_thunder_helper_plugin_d462f475-c18e-46be-bd10-327458d045bd\">\r\n</div>','2015-11-11 08:45:19','admin','2015-11-11 08:45:19','admin');
INSERT INTO `pages` VALUES('7','123','<div id=\"xunlei_com_thunder_helper_plugin_d462f475-c18e-46be-bd10-327458d045bd\">\r\n</div>','2015-11-11 08:45:27','admin','2015-11-11 08:45:27','admin');
INSERT INTO `pages` VALUES('8','1345','<div id=\"xunlei_com_thunder_helper_plugin_d462f475-c18e-46be-bd10-327458d045bd\">\r\n</div>','2015-11-11 08:45:32','admin','2015-11-11 08:45:32','admin');
INSERT INTO `pages` VALUES('9','????','<p>\r\n	<img src=\"http://coach.lfm123.com/images/adv.jpg\" /> \r\n</p>\r\n<p>\r\n	?&nbsp;&nbsp;?&nbsp;?????????\r\n</p>\r\n?????010 89898787<br />\r\n?????2015?05?10?<br />\r\n?????????????????\r\n<div id=\"xunlei_com_thunder_helper_plugin_d462f475-c18e-46be-bd10-327458d045bd\">\r\n</div>','2015-11-11 08:45:52','admin','2015-11-11 08:45:52','admin');
--
-- 表的结构teachers
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '',
  `sex` int(3) NOT NULL DEFAULT '1',
  `age` int(3) NOT NULL DEFAULT '0',
  `photo` varchar(45) NOT NULL DEFAULT '' COMMENT '??',
  `level` int(3) NOT NULL DEFAULT '1' COMMENT '1???A??????2???B??????3???C??????4????D??????',
  `phone` varchar(45) NOT NULL DEFAULT '',
  `email` varchar(45) NOT NULL DEFAULT '',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '??0???1???2??',
  `lesson` int(3) NOT NULL DEFAULT '0' COMMENT '??',
  `score` int(7) NOT NULL DEFAULT '0' COMMENT '??',
  `register_district` varchar(45) NOT NULL DEFAULT '' COMMENT '????',
  `certificate_number` varchar(45) NOT NULL DEFAULT '' COMMENT '????',
  `content` text,
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `create_time_level_index` (`create_time`,`level`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='???';

--
-- 转存表中的数据 teachers
--

INSERT INTO `teachers` VALUES('1','??','1','47','1445346098.jpg','2','','','2','0','0','???','123123','????????????????????????????????????????<br />???????<br />1995??2005? ??????????<br />2005??2008? ???????????<br />2008??? ????????????????','2015-08-30 12:39:37','admin','2015-10-24 10:02:17','admin');
INSERT INTO `teachers` VALUES('2','???','1','47','1441535941.jpg','1','13122222222','32@3.com','0','0','0','','','','2015-08-30 12:39:37','admin','2015-09-06 10:39:01','admin');
INSERT INTO `teachers` VALUES('3','??','1','47','','2','','','0','0','0','???','','','2015-08-30 12:39:37','admin','2015-10-24 10:03:01','admin');
INSERT INTO `teachers` VALUES('4','????','1','47','1441535958.jpg','1','','','0','0','0','','','','2015-08-30 12:39:37','admin','2015-09-06 10:39:18','admin');
INSERT INTO `teachers` VALUES('5','????','1','47','1441535972.jpg','1','','','0','0','0','','','','2015-08-30 12:39:37','admin','2015-09-06 10:39:32','admin');
INSERT INTO `teachers` VALUES('6','???','1','47','','1','','','0','0','0','','','','2015-08-30 12:39:37','admin','2015-08-30 12:39:37','admin');
INSERT INTO `teachers` VALUES('7','??','1','47','1441535512.jpg','1','','','0','0','0','','','','2015-09-06 10:02:12','admin','2015-09-06 10:31:52','admin');
INSERT INTO `teachers` VALUES('8','??','1','47','1441535577.jpg','1','','','0','0','0','','','','2015-09-06 10:32:57','admin','2015-09-06 10:32:57','admin');
INSERT INTO `teachers` VALUES('9','??1','1','47','1441871928.jpg','1','','','0','0','0','???','TEHFSDWDDADDSD','','2015-09-06 10:32:57','admin','2015-09-10 07:58:48','admin');
INSERT INTO `teachers` VALUES('10','??2','1','47','1441535577.jpg','1','','','0','0','0','','','','2015-09-06 10:32:57','admin','2015-09-06 10:32:57','admin');
INSERT INTO `teachers` VALUES('11','??3','1','47','1441535577.jpg','1','','','0','0','0','','','','2015-09-06 10:32:57','admin','2015-09-06 10:32:57','admin');
INSERT INTO `teachers` VALUES('12','??4','1','47','1441535577.jpg','1','','','0','0','0','','','','2015-09-06 10:32:57','admin','2015-09-06 10:32:57','admin');
INSERT INTO `teachers` VALUES('13','??5','1','47','1441535577.jpg','1','','','0','0','0','','','','2015-09-06 10:32:57','admin','2015-09-06 10:32:57','admin');
INSERT INTO `teachers` VALUES('16','???','1','68','1441823438.jpg','1','','','0','0','0','???','TEHFSDWDDADDSD','','2015-09-09 18:30:38','admin','2015-09-09 18:30:38','admin');
INSERT INTO `teachers` VALUES('17','???1','1','11','1446789813.jpg','1','','','0','0','0','???','','','2015-11-06 06:03:33','admin','2015-11-06 06:03:33','admin');
INSERT INTO `teachers` VALUES('18','???113213','1','11','1447064507.jpg','1','12312312','123321@211.com','0','0','0','???','123123','123123','2015-11-09 10:21:47','admin','2015-11-09 10:21:47','admin');
--
-- 表的结构teachers_level
--

DROP TABLE IF EXISTS `teachers_level`;
CREATE TABLE `teachers_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '' COMMENT '????',
  `code` varchar(45) NOT NULL DEFAULT '' COMMENT '??',
  `content` varchar(500) NOT NULL DEFAULT '' COMMENT '??',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='j???????';

--
-- 转存表中的数据 teachers_level
--

INSERT INTO `teachers_level` VALUES('1','???A??????','A','???A???????','2015-10-24 09:47:18','admin','2015-10-24 09:48:42','admin');
INSERT INTO `teachers_level` VALUES('2','???B??????','B','???B??????$result','2015-10-24 09:59:01','admin','2015-10-24 09:59:01','admin');
--
-- 表的结构train
--

DROP TABLE IF EXISTS `train`;
CREATE TABLE `train` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '',
  `code` varchar(45) NOT NULL DEFAULT '' COMMENT '??',
  `category` tinyint(3) NOT NULL DEFAULT '0' COMMENT '??1????2???',
  `train_land_id` int(11) NOT NULL COMMENT '???id',
  `level_id` int(11) NOT NULL DEFAULT '0' COMMENT '??id',
  `recruit_count` tinyint(3) NOT NULL DEFAULT '0' COMMENT '????',
  `sign_up_begin_time` datetime DEFAULT NULL COMMENT '??????',
  `sign_up_end_time` datetime DEFAULT NULL COMMENT '??????',
  `sign_up_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '????0???1????2????',
  `begin_time` datetime DEFAULT NULL COMMENT '????',
  `end_time` datetime DEFAULT NULL COMMENT '????',
  `district` varchar(45) NOT NULL DEFAULT '' COMMENT '?/?',
  `period_num` int(3) NOT NULL DEFAULT '0' COMMENT '??',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '??1???2???3??',
  `lesson` tinyint(3) NOT NULL DEFAULT '0' COMMENT '????',
  `address` varchar(100) NOT NULL DEFAULT '' COMMENT '??',
  `bus` varchar(100) NOT NULL DEFAULT '' COMMENT '????',
  `near_site` varchar(100) NOT NULL DEFAULT '' COMMENT '????',
  `content` text COMMENT '??',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `index_level_id` (`level_id`),
  KEY `index_create_time_type_category_status` (`create_time`,`category`,`status`),
  CONSTRAINT `fk_train_level` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8 COMMENT='?????';

--
-- 转存表中的数据 train
--

INSERT INTO `train` VALUES('2','2015????','0','2','0','2','20','2015-08-01 00:00:00','2015-08-21 00:00:00','3','2015-08-22 00:00:00','2015-08-28 00:00:00','???','0','5','6','??????','444?,555?,666,777?','?????????????????...','??','2015-08-20 16:52:56','admin','2015-10-20 18:02:21','admin');
INSERT INTO `train` VALUES('3','D??????','0','1','0','4','12','2015-08-01 00:00:00','2015-08-02 00:00:00','3','2015-08-06 00:00:00','2015-08-08 00:00:00','','0','2','6','????','','','????????????','2015-08-23 02:03:04','admin','2015-08-30 16:13:10','admin');
INSERT INTO `train` VALUES('4','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','2','2015-08-03 00:00:00','2015-08-04 00:00:00','???','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-09-13 16:47:54','admin');
INSERT INTO `train` VALUES('5','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('6','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','3','2015-08-03 00:00:00','2015-08-04 00:00:00','???','0','3','123','????','223,300','???','????????????','2015-08-23 16:08:21','admin','2015-09-28 16:11:24','admin');
INSERT INTO `train` VALUES('7','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','3','2015-08-03 00:00:00','2015-08-04 00:00:00','???','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-09-28 15:33:09','admin');
INSERT INTO `train` VALUES('8','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('9','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','2','2015-08-03 00:00:00','2015-08-04 00:00:00','???','0','5','123','????','23234','sadsad','????????????','2015-08-23 16:08:21','admin','2015-10-24 05:51:32','admin');
INSERT INTO `train` VALUES('10','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('11','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('12','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','???','0','4','123','????','23234','???','????????????','2015-08-23 16:08:21','admin','2015-10-30 07:58:54','admin');
INSERT INTO `train` VALUES('13','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('14','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('15','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','???','0','3','123','????????','112,464','???','????????????','2015-08-23 16:08:21','admin','2015-11-01 13:33:41','admin');
INSERT INTO `train` VALUES('16','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('17','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('18','2015??????','20150931','2','1','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('22','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('25','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('26','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('27','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('28','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('29','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('30','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('31','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('32','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('33','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('34','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('35','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('36','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('37','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('38','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('39','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('40','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('41','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('42','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('43','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('44','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('45','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('46','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('47','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('48','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('49','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('50','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('51','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('52','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('53','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('54','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('55','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('56','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('57','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('58','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('59','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('60','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('61','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('62','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('63','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('64','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('65','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('66','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('67','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('68','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('69','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('70','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('71','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('72','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('73','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('74','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('75','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('76','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('77','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('78','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('79','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('80','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('81','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('82','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('83','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('84','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('85','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('86','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('87','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('88','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('89','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('90','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('91','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('92','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('93','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('94','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('95','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('96','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('97','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('98','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('99','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('100','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('101','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('102','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('103','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('104','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('105','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('106','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('107','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('108','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('109','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('110','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('111','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('112','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('113','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('114','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('115','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('116','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('117','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('118','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('119','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('120','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('121','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('122','2015????121','0','1','0','4','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('123','2015????121','0','2','0','2','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('124','2015????121','0','2','0','3','123','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-03 00:00:00','2015-08-04 00:00:00','','0','2','123','????','','','????????????','2015-08-23 16:08:21','admin','2015-08-23 16:08:21','admin');
INSERT INTO `train` VALUES('128','2015?????','0','1','0','2','11','2015-08-01 00:00:00','2015-08-08 00:00:00','1','2015-08-09 00:00:00','2015-08-30 00:00:00','','0','2','10','??','','','','2015-08-30 13:44:59','admin','2015-08-30 13:44:59','admin');
INSERT INTO `train` VALUES('129','2015?????','0','1','0','1','12','2015-08-01 00:00:00','2015-08-08 00:00:00','1','2015-08-15 00:00:00','2015-08-29 00:00:00','','0','2','12','','','','','2015-08-30 13:46:20','admin','2015-08-30 13:46:20','admin');
INSERT INTO `train` VALUES('130','','0','1','0','1','2','','','1','','','','0','2','1','','','','','2015-08-30 13:47:07','admin','2015-08-30 13:47:07','admin');
INSERT INTO `train` VALUES('131','2015?????','0','1','0','1','11','2015-08-01 00:00:00','2015-08-08 00:00:00','1','2015-08-08 00:00:00','2015-08-29 00:00:00','','0','2','1','','','','','2015-08-30 13:48:55','admin','2015-08-30 13:48:55','admin');
INSERT INTO `train` VALUES('132','2015?????','0','1','0','1','1','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-08 00:00:00','2015-08-30 00:00:00','','0','2','1','','','','','2015-08-30 13:50:46','admin','2015-08-30 13:50:46','admin');
INSERT INTO `train` VALUES('133','2015?????','0','1','0','1','1','2015-08-01 00:00:00','2015-08-08 00:00:00','1','2015-08-15 00:00:00','2015-08-29 00:00:00','','0','2','1','','','','','2015-08-30 13:51:20','admin','2015-08-30 13:51:20','admin');
INSERT INTO `train` VALUES('134','2015?????','0','1','0','1','12','2015-08-01 00:00:00','2015-08-09 00:00:00','1','2015-08-14 00:00:00','2015-08-29 00:00:00','','0','2','12','','','','','2015-08-30 13:52:00','admin','2015-08-30 13:52:00','admin');
INSERT INTO `train` VALUES('135','2015?????','0','1','0','1','12','2015-08-01 00:00:00','2015-08-09 00:00:00','1','2015-08-14 00:00:00','2015-08-29 00:00:00','','0','2','12','','','','','2015-08-30 13:53:47','admin','2015-08-30 13:53:47','admin');
INSERT INTO `train` VALUES('136','2015?????','0','1','0','1','12','2015-08-01 00:00:00','2015-08-09 00:00:00','1','2015-08-14 00:00:00','2015-08-29 00:00:00','','0','2','12','','','','','2015-08-30 13:54:00','admin','2015-08-30 13:54:00','admin');
INSERT INTO `train` VALUES('137','2015?????','0','1','0','1','11','2015-08-01 00:00:00','2015-08-02 00:00:00','1','2015-08-15 00:00:00','2015-08-22 00:00:00','','0','2','12','','','','','2015-08-30 13:54:51','admin','2015-08-30 13:54:51','admin');
INSERT INTO `train` VALUES('138','2015?????','0','1','0','1','1','2015-08-01 00:00:00','2015-08-09 00:00:00','1','2015-08-08 00:00:00','2015-08-23 00:00:00','','0','2','12','','','','','2015-08-30 13:58:30','admin','2015-08-30 13:58:30','admin');
INSERT INTO `train` VALUES('139','2015?????23','0','1','0','2','12','2015-09-01 00:00:00','2015-09-08 00:00:00','1','2015-09-15 00:00:00','2015-09-22 00:00:00','???','0','2','12','??','','','','2015-08-31 17:04:15','admin','2015-08-31 17:06:09','admin');
INSERT INTO `train` VALUES('140','2015?????231','0','1','0','2','12','2015-09-07 00:00:00','2015-09-10 00:00:00','1','2015-09-11 00:00:00','2015-09-18 00:00:00','???','0','2','12','??','','','??','2015-09-06 16:17:00','admin','2015-09-06 16:19:56','admin');
INSERT INTO `train` VALUES('141','2015?????23123123','19700101','1','3','2','12','2015-09-01 00:00:00','2015-09-03 00:00:00','1','2015-09-10 00:00:00','2015-09-24 00:00:00','????','5','2','12','??','444?,555?,666,777?','?????????????????...','??','2015-09-06 16:20:48','admin','2015-11-11 16:14:14','admin');
INSERT INTO `train` VALUES('142','??1','19700101','1','3','2','11','2015-09-01 00:00:00','2015-09-10 00:00:00','2','2015-09-17 00:00:00','2015-09-24 00:00:00','???','1','2','12','????','333?3333?223','??','????','2015-09-07 10:01:51','admin','2015-11-11 14:09:55','admin');
INSERT INTO `train` VALUES('143','??1','20151018','1','1','2','20','2015-10-01 00:00:00','2015-10-09 00:00:00','0','2015-10-10 00:00:00','2015-10-23 00:00:00','???','0','3','123','????','223,300','???','????','2015-10-18 16:03:28','admin','2015-10-18 16:04:16','admin');
INSERT INTO `train` VALUES('144','2015?10?????','20151024','2','2','3','20','2015-10-01 00:00:00','2015-10-10 00:00:00','0','2015-10-11 00:00:00','2015-10-24 00:00:00','???','0','1','20','??','441','???','2015?10?????','2015-10-24 10:24:42','admin','2015-10-24 10:24:42','admin');
INSERT INTO `train` VALUES('145','2015?10?????','20151105','1','3','2','20','2015-11-01 00:00:00','2015-11-17 00:00:00','0','2015-11-18 00:00:00','2015-11-30 00:00:00','???','0','1','19','','','','','2015-11-05 17:04:11','admin','2015-11-05 17:07:57','admin');
INSERT INTO `train` VALUES('146','2015?10?????','20151106','1','4','2','20','2015-11-01 00:00:00','2015-11-12 00:00:00','0','2015-11-13 00:00:00','2015-11-27 00:00:00','???','0','1','22','','','','','2015-11-06 05:33:41','admin','2015-11-06 05:33:41','admin');
INSERT INTO `train` VALUES('147','2015?10?????','20151107','1','1','2','20','2015-11-01 00:00:00','2015-11-07 00:00:00','0','2015-11-14 00:00:00','2015-11-28 00:00:00','???','7','1','19','','','','','2015-11-07 15:35:30','admin','2015-11-07 15:36:53','admin');
INSERT INTO `train` VALUES('148','2015?10?????1213','20151107','2','4','2','20','2015-11-02 00:00:00','2015-11-10 00:00:00','0','2015-11-19 00:00:00','2015-11-30 00:00:00','???','4','1','19','','','','','2015-11-07 15:40:55','admin','2015-11-09 16:06:05','admin');
INSERT INTO `train` VALUES('149','testtest','20151115','1','1','2','10','2015-11-01 00:00:00','2015-11-07 00:00:00','0','2015-11-15 00:00:00','2015-11-29 00:00:00','???','1','2','19','','','','','2015-11-09 16:18:07','admin','2015-11-11 17:27:30','admin');
--
-- 表的结构train_category
--

DROP TABLE IF EXISTS `train_category`;
CREATE TABLE `train_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='?????';

--
-- 转存表中的数据 train_category
--

INSERT INTO `train_category` VALUES('1','???','','','2015-10-24 10:20:57','admin');
INSERT INTO `train_category` VALUES('2','???','2015-10-24 10:21:11','admin','2015-10-24 10:21:11','admin');
--
-- 表的结构train_land
--

DROP TABLE IF EXISTS `train_land`;
CREATE TABLE `train_land` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '',
  `district` varchar(45) NOT NULL DEFAULT '' COMMENT '??',
  `address` varchar(200) NOT NULL DEFAULT '',
  `contacts` varchar(45) NOT NULL DEFAULT '' COMMENT '???',
  `contact_phone` varchar(45) NOT NULL DEFAULT '',
  `thumb` varchar(200) NOT NULL DEFAULT '',
  `site_type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '????',
  `bus` varchar(45) NOT NULL DEFAULT '',
  `site` varchar(45) NOT NULL DEFAULT '',
  `content` varchar(200) NOT NULL DEFAULT '',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='?????	';

--
-- 转存表中的数据 train_land
--

INSERT INTO `train_land` VALUES('1','????','3','????????????????','???','13112131231','1446907739.jpg','1','532??690??397?','?????????????????','?????????????2??','2015-11-05 16:52:05','admin','2015-11-07 14:48:59','admin');
INSERT INTO `train_land` VALUES('2','????','8','????????????????','???','13112131231','1446907755.jpg','1','532??690??397?','?????????????????','?????????????2??','2015-11-05 17:07:50','admin','2015-11-07 14:49:15','admin');
INSERT INTO `train_land` VALUES('3','??????','9','????????????????','???','13112131231','1446907768.jpg','3','532??690??397?','?????????????????','?????????????2??','2015-11-07 12:28:31','admin','2015-11-07 14:49:28','admin');
INSERT INTO `train_land` VALUES('4','??????2','4','????????????????','???','13112131231','1446907816.jpg','4','532??690??397?','?????????????????','?????????????2??','2015-11-07 13:18:14','admin','2015-11-07 14:50:16','admin');
INSERT INTO `train_land` VALUES('5','??????232','4','????????????????','???','13112131231','1446907794.jpg','2','532??690??397?','?????????????????','?????????????2??','2015-11-07 13:38:55','admin','2015-11-07 14:49:54','admin');
INSERT INTO `train_land` VALUES('6','??????121221','3','????????????????','???','13112131231','1446904038.jpg','1','532??690??397?','?????????????????','?????????????2??','2015-11-07 13:47:18','admin','2015-11-07 13:47:18','admin');
--
-- 表的结构train_teachers
--

DROP TABLE IF EXISTS `train_teachers`;
CREATE TABLE `train_teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `train_id` int(11) NOT NULL DEFAULT '0',
  `teachers_id` int(11) NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='?????	';

--
-- 转存表中的数据 train_teachers
--

INSERT INTO `train_teachers` VALUES('4','18','2','2015-09-03 15:35:10','','2015-09-06 09:53:35','admin');
INSERT INTO `train_teachers` VALUES('5','18','4','2015-09-03 15:35:15','','2015-09-03 15:35:15','admin');
INSERT INTO `train_teachers` VALUES('6','18','5','2015-09-03 15:37:39','','2015-09-03 15:50:01','admin');
INSERT INTO `train_teachers` VALUES('7','18','1','2015-09-06 13:44:20','','2015-09-06 13:44:20','admin');
INSERT INTO `train_teachers` VALUES('8','12','2','2015-10-30 07:33:43','','2015-10-30 07:33:43','admin');
INSERT INTO `train_teachers` VALUES('9','144','1','2015-11-05 13:33:50','','2015-11-05 13:33:50','admin');
--
-- 表的结构train_users
--

DROP TABLE IF EXISTS `train_users`;
CREATE TABLE `train_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `train_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `level_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '??1???2???3???4???5??6??',
  `orders` tinyint(3) NOT NULL DEFAULT '0' COMMENT '??',
  `practice_score` int(11) NOT NULL DEFAULT '0' COMMENT '????',
  `theory_score` int(11) NOT NULL DEFAULT '0' COMMENT '????',
  `rule_score` int(11) NOT NULL DEFAULT '0' COMMENT '????',
  `score_appraise` int(11) NOT NULL DEFAULT '0' COMMENT '????',
  `appraise_result` varchar(45) NOT NULL DEFAULT '' COMMENT '????',
  `attendance_appraise` varchar(45) NOT NULL DEFAULT '' COMMENT '????',
  `practice_comment` varchar(45) NOT NULL DEFAULT '' COMMENT '???????',
  `theory_comment` varchar(45) NOT NULL DEFAULT '' COMMENT '????',
  `rule_comment` varchar(45) NOT NULL DEFAULT '' COMMENT '????',
  `total_comment` varchar(45) NOT NULL DEFAULT '' COMMENT '????',
  `result_comment` varchar(45) NOT NULL DEFAULT '' COMMENT '????',
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) NOT NULL DEFAULT '',
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `index_train_id_user_id` (`train_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8 COMMENT='???????';

--
-- 转存表中的数据 train_users
--

INSERT INTO `train_users` VALUES('92','18','131','1','8','1','90','90','90','90','????','?','?','?','?','?','90','2015-11-07 17:53:40','admin','2015-11-07 17:54:37','admin');
INSERT INTO `train_users` VALUES('93','18','134','2','2','1','0','0','0','0','','','','','','','','2015-11-08 14:36:28','admin','2015-11-08 14:36:28','admin');
INSERT INTO `train_users` VALUES('94','18','135','2','9','1','1','1','1','1','???','?','?','?','?','?','1','2015-11-08 18:21:34','admin','2015-11-08 18:35:13','admin');
INSERT INTO `train_users` VALUES('95','18','136','2','9','1','1','1','19','7','???','?','?','?','?','?','7','2015-11-08 18:53:18','admin','2015-11-08 19:12:20','admin');
INSERT INTO `train_users` VALUES('101','18','136','2','8','5','90','90','90','90','????','?','?','?','?','?','90','2015-11-08 19:16:47','admin','2015-11-09 11:28:11','admin');
INSERT INTO `train_users` VALUES('102','18','137','2','8','1','90','90','90','90','????','?','?','?','?','?','90','2015-11-09 12:13:37','admin','2015-11-09 12:17:02','admin');
INSERT INTO `train_users` VALUES('103','18','138','2','2','1','0','0','0','0','','','','','','','','2015-11-09 17:50:42','admin','2015-11-09 18:09:04','admin');
INSERT INTO `train_users` VALUES('104','18','141','2','8','4','90','90','90','90','????','?','?','?','?','?','90','2015-11-10 13:36:57','admin','2015-11-11 11:51:48','admin');
INSERT INTO `train_users` VALUES('108','142','143','2','5','1','0','0','0','0','','','','','','','','2015-11-11 08:58:29','admin','2015-11-11 09:33:11','admin');
INSERT INTO `train_users` VALUES('109','141','143','2','8','1','90','90','90','90','????','?','?','?','?','?','90','2015-11-11 09:38:04','admin','2015-11-11 11:54:59','admin');
INSERT INTO `train_users` VALUES('110','142','148','2','5','0','0','0','0','0','','','','','','','','2015-11-11 11:25:13','admin','2015-11-11 11:25:13','admin');
INSERT INTO `train_users` VALUES('111','142','149','2','5','0','0','0','0','0','','','','','','','','2015-11-11 14:04:32','admin','2015-11-11 14:04:32','admin');
INSERT INTO `train_users` VALUES('114','142','150','2','9','1','9','9','9','9','???','?','?','?','?','?','9','2015-11-11 15:24:13','admin','2015-11-11 17:07:04','admin');
INSERT INTO `train_users` VALUES('116','149','150','2','8','1','90','90','90','90','????','?','?','?','?','?','90','2015-11-11 17:27:35','admin','2015-11-11 18:12:14','admin');
--
-- 表的结构users
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL DEFAULT '' COMMENT '??',
  `password` varchar(200) NOT NULL DEFAULT '' COMMENT '??',
  `level_id` int(11) NOT NULL DEFAULT '1' COMMENT '????',
  `level_order` int(3) NOT NULL DEFAULT '1' COMMENT '????',
  `email_auth` tinyint(3) NOT NULL DEFAULT '0' COMMENT '????',
  `phone_auth` tinyint(3) NOT NULL DEFAULT '0' COMMENT '????',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '??0???1???2??',
  `mobile_phone` varchar(20) NOT NULL DEFAULT '' COMMENT '??',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '????',
  `lesson` int(11) NOT NULL DEFAULT '0' COMMENT '??',
  `credit` int(11) NOT NULL DEFAULT '0' COMMENT '??',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '??',
  `authKey` varchar(100) NOT NULL DEFAULT '',
  `accessToken` varchar(100) NOT NULL DEFAULT '',
  `create_time` datetime DEFAULT NULL COMMENT '????',
  `update_time` datetime DEFAULT NULL COMMENT '????',
  `update_user` varchar(45) NOT NULL DEFAULT '' COMMENT '???',
  PRIMARY KEY (`id`),
  KEY `index_name` (`username`),
  KEY `index_create_time_sex` (`create_time`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8 COMMENT='???';

--
-- 转存表中的数据 users
--

INSERT INTO `users` VALUES('131','','d41d8cd98f00b204e9800998ecf8427e','1','1','0','0','1','13131313131','33@22.com','0','0','0','','','2015-11-07 02:48:07','2015-11-07 02:48:07','admin');
INSERT INTO `users` VALUES('132','????1446864821','0b4e7a0e5fe84ad35fb5f95b9ceeac79','1','1','0','0','0','','212122122@22.om','0','0','0','','','2015-11-07 02:53:41','2015-11-07 02:53:41','admin');
INSERT INTO `users` VALUES('133','??1','0b4e7a0e5fe84ad35fb5f95b9ceeac79','1','1','0','0','0','1321','111@111.com','0','0','0','','','2015-11-08 13:55:35','2015-11-08 13:55:35','admin');
INSERT INTO `users` VALUES('134','??3','7c3d596ed03ab9116c547b0eb678b247','1','1','0','0','1','1221123','444@444.com','0','0','0','','','2015-11-08 14:26:39','2015-11-08 14:36:20','admin');
INSERT INTO `users` VALUES('137','??1311','96e79218965eb72c92a549dd5a330112','1','1','0','0','1','13810862675','121@111.com','0','0','0','','','2015-11-09 12:12:17','2015-11-09 12:12:17','admin');
INSERT INTO `users` VALUES('138','??222222222','0b4e7a0e5fe84ad35fb5f95b9ceeac79','1','1','0','0','1','13122322322','212@212.com','0','0','0','','','2015-11-09 17:49:49','2015-11-09 17:49:49','admin');
INSERT INTO `users` VALUES('139','????1447093154','96e79218965eb72c92a549dd5a330112','1','1','0','0','0','','222@333.com','0','0','0','','','2015-11-09 18:19:14','2015-11-09 18:19:14','admin');
INSERT INTO `users` VALUES('140','????1447158865','0b4e7a0e5fe84ad35fb5f95b9ceeac79','1','1','0','0','0','','222@111.com','0','0','0','','','2015-11-10 12:34:25','2015-11-10 12:34:25','admin');
INSERT INTO `users` VALUES('141','??4','96e79218965eb72c92a549dd5a330112','2','2','0','0','1','13122322324','111@333.com','0','0','0','','','2015-11-10 12:57:33','2015-11-10 12:57:33','admin');
INSERT INTO `users` VALUES('142','????1447170886','0b4e7a0e5fe84ad35fb5f95b9ceeac79','1','1','0','0','0','','111111@211.com','0','0','0','','','2015-11-10 15:54:46','2015-11-10 15:54:46','admin');
INSERT INTO `users` VALUES('143','??1XXX','0b4e7a0e5fe84ad35fb5f95b9ceeac79','1','1','0','0','1','13810862675','1@1.com','0','0','0','','','2015-11-11 08:46:26','2015-11-11 08:46:26','admin');
INSERT INTO `users` VALUES('144','????1447239099','0b4e7a0e5fe84ad35fb5f95b9ceeac79','1','1','0','0','0','','2@2.com','0','0','0','','','2015-11-11 10:51:39','2015-11-11 10:51:39','admin');
INSERT INTO `users` VALUES('145','????1447240664','0b4e7a0e5fe84ad35fb5f95b9ceeac79','1','1','0','0','0','','3@3.com','0','0','0','','','2015-11-11 11:17:44','2015-11-11 11:17:44','admin');
INSERT INTO `users` VALUES('146','????1447240931','0b4e7a0e5fe84ad35fb5f95b9ceeac79','1','1','0','0','0','','4@4.com','0','0','0','','','2015-11-11 11:22:11','2015-11-11 11:22:11','admin');
INSERT INTO `users` VALUES('148','????1447241113','0b4e7a0e5fe84ad35fb5f95b9ceeac79','1','1','0','0','0','13810862675','5@5.com','0','0','0','','','2015-11-11 11:25:13','2015-11-11 11:25:13','admin');
INSERT INTO `users` VALUES('149','??','594f803b380a41396ed63dca39503542','1','1','0','0','1','13810862675','12@12.com','0','0','0','','','2015-11-11 14:04:31','2015-11-11 14:04:31','admin');
INSERT INTO `users` VALUES('150','??','0b4e7a0e5fe84ad35fb5f95b9ceeac79','1','1','0','0','1','13810862675','21@21.com','0','0','0','','','2015-11-11 15:24:13','2015-11-11 15:24:13','admin');
--
-- 表的结构users_education
--

DROP TABLE IF EXISTS `users_education`;
CREATE TABLE `users_education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '??id',
  `school` varchar(45) NOT NULL DEFAULT '' COMMENT '??',
  `begin_time` datetime DEFAULT NULL COMMENT '????',
  `end_time` datetime DEFAULT NULL COMMENT '????',
  `address` varchar(100) NOT NULL DEFAULT '' COMMENT '??',
  `educational_background` varchar(45) NOT NULL DEFAULT '' COMMENT '??',
  `witness` varchar(45) NOT NULL DEFAULT '' COMMENT '???',
  `witness_phone` varchar(20) NOT NULL DEFAULT '' COMMENT '?????',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '??',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `index_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='?????';

--
-- 转存表中的数据 users_education
--

INSERT INTO `users_education` VALUES('2','28','????','2015-09-01 00:00:00','2015-09-17 00:00:00','????','1','???','13113131313','????','','','');
INSERT INTO `users_education` VALUES('3','28','????','2015-09-01 00:00:00','2015-09-18 00:00:00','????','2','???','13113131313','3333','2015-09-08 16:28:48','2015-09-08 16:28:48','admin');
INSERT INTO `users_education` VALUES('4','28','????','2015-09-02 00:00:00','2015-09-24 00:00:00','????','1','???','13113131313','e\'eee','2015-09-08 16:29:50','2015-09-08 16:29:50','admin');
INSERT INTO `users_education` VALUES('6','29','??','1983-02-02 00:00:00','2015-09-08 19:29:19','???','1','???','12311311231','333','2015-09-08 19:29:19','2015-09-08 19:29:19','admin');
INSERT INTO `users_education` VALUES('7','29','??','','2015-09-08 19:43:54','???','1','','12311311231','3333','2015-09-08 19:43:54','2015-09-08 19:43:54','admin');
INSERT INTO `users_education` VALUES('8','42','xuxiao','2015-09-09 00:00:00','','beijin','1','???','131212312','???','2015-09-13 15:58:32','2015-09-13 15:58:32','admin');
INSERT INTO `users_education` VALUES('9','42','xuxiaoxe','2015-09-10 00:00:00','2015-09-13 16:00:58','beijing','1','???','131212312','ddfdf','2015-09-13 16:00:58','2015-09-13 16:00:58','admin');
INSERT INTO `users_education` VALUES('10','42','','2015-09-02 00:00:00','2015-09-13 16:24:42','beijing','0','???','131212312','34434','2015-09-13 16:24:42','2015-09-13 16:24:42','admin');
INSERT INTO `users_education` VALUES('11','42','xuxiaoxe','2015-09-12 00:00:00','2015-09-13 16:32:46','beijing','1','???','','dsfs','2015-09-13 16:32:46','2015-09-13 16:32:46','admin');
INSERT INTO `users_education` VALUES('12','30','xuxiao','2015-09-02 00:00:00','2015-09-15 13:35:37','beijing','1','???','23234234234','???????','2015-09-15 13:35:37','2015-09-15 13:35:37','admin');
INSERT INTO `users_education` VALUES('13','47','?????','2015-09-01 00:00:00','2015-09-23 16:29:53','??','1','???','131212312','????????','2015-09-23 16:29:53','2015-09-23 16:29:53','admin');
INSERT INTO `users_education` VALUES('14','1','????','2015-09-01 00:00:00','2015-09-17 00:00:00','????','1','???','13113131313','????','','','');
INSERT INTO `users_education` VALUES('15','1','?????','2015-09-01 00:00:00','2015-09-23 16:29:53','??','1','???','131212312','????????','2015-09-23 16:29:53','2015-09-23 16:29:53','admin');
INSERT INTO `users_education` VALUES('16','55','????','2015-10-01 00:00:00','2015-10-09 00:00:00','????','1','???','13122222222','??','2015-10-14 16:36:34','2015-10-14 16:36:34','admin');
INSERT INTO `users_education` VALUES('17','91','11','0000-00-00 00:00:00','0000-00-00 00:00:00','111','1','11','11','11','2015-10-20 16:45:33','2015-10-20 16:45:33','admin');
INSERT INTO `users_education` VALUES('18','91','11','0000-00-00 00:00:00','0000-00-00 00:00:00','111','2','11','11','adsafsadfsadf','2015-10-20 16:46:27','2015-10-20 16:46:27','admin');
INSERT INTO `users_education` VALUES('19','92','????','0000-00-00 00:00:00','0000-00-00 00:00:00','??','1','???','13131313131','????','2015-10-30 06:46:12','2015-10-30 06:46:12','admin');
INSERT INTO `users_education` VALUES('20','94','????','2014-10-31 00:00:00','2015-11-02 00:00:00','??','1','???','13131313131','d','2015-11-01 10:00:52','2015-11-01 10:00:52','admin');
INSERT INTO `users_education` VALUES('21','95','????','2014-11-01 00:00:00','2015-11-01 00:00:00','??','1','???','13131313131','D??','2015-11-01 10:26:42','2015-11-01 10:26:42','admin');
INSERT INTO `users_education` VALUES('22','98','????','2014-11-01 00:00:00','2015-11-01 00:00:00','??','1','???','13131313131','??','2015-11-01 11:33:12','2015-11-01 11:33:12','admin');
INSERT INTO `users_education` VALUES('23','99','????','2014-11-01 00:00:00','2015-11-01 00:00:00','??','1','???','13131313131','???','2015-11-01 11:48:50','2015-11-01 11:48:50','admin');
INSERT INTO `users_education` VALUES('24','100','????','2014-11-01 00:00:00','2015-11-01 00:00:00','??','1','???','13131313131','??','2015-11-01 12:36:51','2015-11-01 12:36:51','admin');
INSERT INTO `users_education` VALUES('25','101','????','2014-11-01 00:00:00','2015-11-01 00:00:00','??','1','???','13131313131','????','2015-11-01 13:30:16','2015-11-01 13:30:16','admin');
INSERT INTO `users_education` VALUES('26','106','????','2012-11-01 00:00:00','2015-11-05 00:00:00','??','1','???','13131313131','dddd','2015-11-05 14:00:02','2015-11-05 14:00:02','admin');
INSERT INTO `users_education` VALUES('29','113','????','2014-11-06 00:00:00','2015-11-24 00:00:00','??','1','???','13131313131','dfsdf','2015-11-06 14:18:21','2015-11-06 14:18:21','admin');
INSERT INTO `users_education` VALUES('30','123','????','2014-11-07 00:00:00','2015-11-07 00:00:00','??','1','???','13131313131','232332','2015-11-07 02:28:34','2015-11-07 02:28:34','admin');
INSERT INTO `users_education` VALUES('31','134','????','0000-00-00 00:00:00','0000-00-00 00:00:00','??','1','???','13131313131','dd','2015-11-08 14:37:56','2015-11-08 14:37:56','admin');
INSERT INTO `users_education` VALUES('32','135','????','2014-11-08 00:00:00','2015-11-08 00:00:00','??','1','???','13131313131','hhh','2015-11-08 18:19:45','2015-11-08 18:19:45','admin');
INSERT INTO `users_education` VALUES('33','136','????','0000-00-00 00:00:00','0000-00-00 00:00:00','??','1','???','13131313131','ss','2015-11-08 18:53:05','2015-11-08 18:53:05','admin');
INSERT INTO `users_education` VALUES('34','131','????','0000-00-00 00:00:00','0000-00-00 00:00:00','??','1','???','13131313131','??','2015-11-09 06:11:20','2015-11-09 06:11:20','admin');
INSERT INTO `users_education` VALUES('35','137','????','2014-11-09 00:00:00','2015-11-09 00:00:00','??','1','???','13131313131','ddd','2015-11-09 12:13:33','2015-11-09 12:13:33','admin');
INSERT INTO `users_education` VALUES('36','138','????','2014-11-01 00:00:00','2015-11-09 00:00:00','??','1','???','13131313131','333','2015-11-09 17:50:37','2015-11-09 17:50:37','admin');
INSERT INTO `users_education` VALUES('37','141','????','0000-00-00 00:00:00','0000-00-00 00:00:00','??','1','???','333333','dd','2015-11-10 15:47:26','2015-11-10 15:47:26','admin');
INSERT INTO `users_education` VALUES('38','143','????','2014-11-11 00:00:00','2015-11-11 00:00:00','??','1','???','13131313131','D??','2015-11-11 08:53:39','2015-11-11 08:53:39','admin');
INSERT INTO `users_education` VALUES('39','149','????','2014-11-01 00:00:00','2015-11-11 00:00:00','??','1','???','13131313131','444','2015-11-11 14:21:09','2015-11-11 14:21:09','admin');
INSERT INTO `users_education` VALUES('40','149','????','2014-11-01 00:00:00','2015-11-17 00:00:00','??','??','???','13131313131',';;kkk','2015-11-11 14:24:36','2015-11-11 14:24:36','admin');
INSERT INTO `users_education` VALUES('41','150','????','2014-11-11 00:00:00','2015-11-11 00:00:00','??','??','???','333','333','2015-11-11 15:37:08','2015-11-11 15:37:08','admin');
--
-- 表的结构users_image
--

DROP TABLE IF EXISTS `users_image`;
CREATE TABLE `users_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '??id',
  `level_id` int(11) NOT NULL DEFAULT '0' COMMENT '??id',
  `photo` varchar(50) NOT NULL DEFAULT '' COMMENT '???',
  `credentials_photo` varchar(50) NOT NULL DEFAULT '' COMMENT '???????',
  `create_time` datetime DEFAULT NULL COMMENT '????',
  `update_time` datetime DEFAULT NULL COMMENT '????',
  `update_user` varchar(45) NOT NULL DEFAULT '' COMMENT '???',
  PRIMARY KEY (`id`),
  KEY `index_user_id` (`user_id`),
  KEY `index_create_time` (`create_time`),
  KEY `fk_users_image_level` (`level_id`),
  CONSTRAINT `fk_users_image_level` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_image_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='???????';

--
-- 转存表中的数据 users_image
--

--
-- 表的结构users_info
--

DROP TABLE IF EXISTS `users_info`;
CREATE TABLE `users_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(200) NOT NULL DEFAULT '' COMMENT '�??',
  `sex` tinyint(2) NOT NULL DEFAULT '0' COMMENT '?? 1?2?',
  `birthday` datetime DEFAULT NULL COMMENT '??',
  `credentials_type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '????1???2???3???4???',
  `credentials_number` varchar(25) NOT NULL DEFAULT '' COMMENT '????',
  `account_location` varchar(20) NOT NULL DEFAULT '' COMMENT '?????',
  `telephone` varchar(20) NOT NULL DEFAULT '' COMMENT '??',
  `height` tinyint(3) NOT NULL DEFAULT '0' COMMENT '??',
  `weight` tinyint(3) NOT NULL DEFAULT '0' COMMENT '??',
  `disease_history` tinyint(2) NOT NULL DEFAULT '0' COMMENT '?????0???1?',
  `contact_address` varchar(100) NOT NULL DEFAULT '' COMMENT '????',
  `contact_postcode` varchar(10) NOT NULL DEFAULT '' COMMENT '??????',
  `company_name` varchar(50) NOT NULL DEFAULT '' COMMENT '????',
  `company_address` varchar(100) NOT NULL DEFAULT '' COMMENT '????',
  `company_postcode` varchar(10) NOT NULL DEFAULT '' COMMENT '??????',
  `company_contact_phone` varchar(20) NOT NULL DEFAULT '' COMMENT '??????',
  `clothes_size` tinyint(2) NOT NULL DEFAULT '0' COMMENT '?????1S2M3L4XL5XXL',
  `t_shirt_size` tinyint(2) NOT NULL DEFAULT '0' COMMENT '??T???1S2M3L4XL5XXL',
  `shorts_size` tinyint(2) NOT NULL DEFAULT '0' COMMENT '??????1S2M3L4XL5XXL',
  `language` tinyint(2) NOT NULL DEFAULT '0' COMMENT '??1??',
  `spoken_language` tinyint(2) NOT NULL DEFAULT '0' COMMENT '??1??',
  `write_language` tinyint(2) NOT NULL DEFAULT '0' COMMENT '????1??',
  `photo` varchar(45) NOT NULL DEFAULT '',
  `credentials_photo` varchar(45) NOT NULL DEFAULT '' COMMENT '???',
  PRIMARY KEY (`id`),
  KEY `index_user_id` (`user_id`),
  KEY `index_birthday` (`birthday`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COMMENT='?????';

--
-- 转存表中的数据 users_info
--

INSERT INTO `users_info` VALUES('91','131','??','1','2008-07-04 00:00:00','1','210293929393933936','???','13131313131','127','90','1','????','','???','????','','010-23121221','1','1','1','0','0','0','1447051856.jpg','1446921425.jpg');
INSERT INTO `users_info` VALUES('92','133','??13','1','','1','2102939293939339362','???','131','127','90','1','????','','???','????','','010-23121221','1','1','1','0','0','0','1446992304.jpg','1446992304.jpg');
INSERT INTO `users_info` VALUES('93','134','??3','1','','1','5433','???','3222','127','90','1','????','','???','????','100001','23123','1','1','1','0','0','0','1446993534.jpg','1446993534.jpg');
INSERT INTO `users_info` VALUES('94','135','??19','1','0000-00-00 00:00:00','1','4545','???','45','127','90','0','45','','45','45','','45','1','1','1','0','0','0','1447006770.jpg','1447006770.jpg');
INSERT INTO `users_info` VALUES('95','136','??12','1','1994-04-18 00:00:00','1','232323','???','','127','90','0','????','1221','?','?','?','?','1','1','1','0','0','0','1447008664.jpg','1447008664.jpg');
INSERT INTO `users_info` VALUES('96','137','??1311','1','1990-05-22 00:00:00','1','23423413123123123123','???','','127','90','0','????','','?','?','?','?','1','1','1','0','0','0','1447089722.jpg','1447071172.jpg');
INSERT INTO `users_info` VALUES('97','138','??222222222','1','1990-03-20 00:00:00','1','210293929393933939333','???','','127','90','0','????','','?','?','?','?','1','1','1','0','0','0','1447091425.jpg','1447091425.jpg');
INSERT INTO `users_info` VALUES('98','141','??42','1','','1','2102939293939339364','???','010-2222222','127','90','1','????','100001','???','?','?','?','1','1','1','0','0','0','1447161766.jpg','1447161766.jpg');
INSERT INTO `users_info` VALUES('99','143','??1XXX','1','1994-02-21 00:00:00','1','2342341223','???','','127','90','0','????','','?','?','?','?','1','1','1','0','0','0','1447232003.jpg','1447232003.jpg');
INSERT INTO `users_info` VALUES('100','149','??','1','','1','21029392939393393934','???','13810861675','127','90','1','????','','?','?','?','?','1','1','1','0','0','0','1447253050.jpg','1447253050.jpg');
INSERT INTO `users_info` VALUES('101','150','??','1','1990-06-21 00:00:00','1','1334232','???','13810862675','127','90','0','????','','?','?','?','?','1','1','1','0','0','0','1447256151.jpg','1447256151.jpg');
--
-- 表的结构users_level
--

DROP TABLE IF EXISTS `users_level`;
CREATE TABLE `users_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `level_id` int(11) NOT NULL DEFAULT '0' COMMENT '??id',
  `train_id` int(11) NOT NULL DEFAULT '0',
  `activity_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '0???1???2???3???4???5???6?????',
  `certificate_number` varchar(25) NOT NULL DEFAULT '' COMMENT '????',
  `credentials_number` varchar(45) NOT NULL DEFAULT '' COMMENT '?????',
  `end_date` datetime DEFAULT NULL COMMENT '????',
  `district` varchar(10) NOT NULL DEFAULT '' COMMENT '????',
  `receive_address` varchar(100) NOT NULL DEFAULT '' COMMENT '????',
  `postcode` varchar(10) NOT NULL DEFAULT '' COMMENT '??',
  `pay_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '????1????2????',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) NOT NULL DEFAULT '',
  `photo` varchar(45) NOT NULL DEFAULT '',
  `credentials_photo` varchar(45) NOT NULL DEFAULT '' COMMENT '???',
  `is_pay` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `index_user_id_level` (`user_id`,`level_id`),
  KEY `fk_users_level_level_idx` (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8 COMMENT='?????';

--
-- 转存表中的数据 users_level
--

INSERT INTO `users_level` VALUES('11','1','2','142','0','2','BJSJ201509070001','212121212121212121','','???','','','0','2015-09-10 16:45:26','2015-09-10 17:01:27','???','','','0');
INSERT INTO `users_level` VALUES('12','30','2','2','0','2','BJSJ00001','212121212121212121','','???','??????','100012','0','2015-09-10 16:45:26','2015-09-23 04:15:20','??','1442981720.jpg','','0');
INSERT INTO `users_level` VALUES('14','47','2','6','0','4','BJSJ00001','121212121232323245','','???','??????','100012','0','2015-09-24 16:24:04','2015-09-24 17:29:20','admin','1443114656.jpg','1443115760.jpg','0');
INSERT INTO `users_level` VALUES('15','28','2','6','0','3','BJSJ00001','121212121212121212','','???','??????','100012','0','2015-09-28 15:32:34','2015-09-28 16:15:41','admin','1443456930.jpg','1443456941.jpg','0');
INSERT INTO `users_level` VALUES('16','82','2','9','0','0','','121212121212121212','','','','','0','2015-10-18 14:43:12','2015-10-18 14:43:12','admin','','','0');
INSERT INTO `users_level` VALUES('18','83','2','9','0','0','','','','','','','0','2015-10-18 15:36:20','2015-10-18 15:36:20','admin','','','0');
INSERT INTO `users_level` VALUES('19','84','2','9','0','0','','','','','','','0','2015-10-18 15:36:35','2015-10-18 15:36:35','admin','','','0');
INSERT INTO `users_level` VALUES('20','85','2','9','0','0','','','','','','','0','2015-10-18 15:37:47','2015-10-18 15:37:47','admin','','','0');
INSERT INTO `users_level` VALUES('21','86','2','9','0','0','','','','','','','0','2015-10-18 15:38:42','2015-10-18 15:38:42','admin','','','0');
INSERT INTO `users_level` VALUES('22','87','2','9','0','0','','121212121232323245','','','','','0','2015-10-18 15:42:30','2015-10-18 15:42:30','admin','','','0');
INSERT INTO `users_level` VALUES('23','88','2','9','0','0','','121212121232323245','','','','','0','2015-10-18 15:47:26','2015-10-18 15:47:26','admin','','','0');
INSERT INTO `users_level` VALUES('24','89','2','2','0','0','','2342323423423423423','','','','','0','2015-10-20 14:54:22','2015-10-20 14:54:22','admin','','','0');
INSERT INTO `users_level` VALUES('25','90','2','2','0','0','','2342323423423423423','','','','','0','2015-10-20 15:08:45','2015-10-20 15:08:45','admin','','','0');
INSERT INTO `users_level` VALUES('26','91','2','9','3','3','BJSJ00001','2342323423423423423','','???','?????','100007','0','2015-10-20 15:13:15','2015-10-24 06:18:56','??','','','0');
INSERT INTO `users_level` VALUES('27','92','2','12','6','2','BJSJ0201510310001','210293929393933939','','','?????','100007','0','2015-10-30 06:33:52','2015-10-31 22:01:28','??','1446187487.jpg','1446187487.jpg','0');
INSERT INTO `users_level` VALUES('28','92','2','12','0','1','BJSJ0201510310001','210293929393933939','','','','','0','2015-10-30 06:57:23','2015-10-31 22:01:28','??','1446187487.jpg','1446199728.jpg','0');
INSERT INTO `users_level` VALUES('30','94','2','15','0','0','','210293929393933939','','???','????','100001','0','2015-11-01 04:33:46','2015-11-01 04:33:46','admin','','','0');
INSERT INTO `users_level` VALUES('31','94','2','15','0','0','','210293929393933939','','','','','0','2015-11-01 10:20:24','2015-11-01 10:20:24','admin','','','0');
INSERT INTO `users_level` VALUES('32','95','2','15','0','0','','210293929393933939','','???','????','100001','0','2015-11-01 10:24:16','2015-11-01 10:24:16','admin','','','0');
INSERT INTO `users_level` VALUES('33','96','2','15','0','0','','','','','','','0','2015-11-01 10:28:38','2015-11-01 10:28:38','admin','','','0');
INSERT INTO `users_level` VALUES('34','97','2','30','0','0','','210293929393933939','','???','????','','0','2015-11-01 10:34:46','2015-11-01 10:34:46','admin','','','0');
INSERT INTO `users_level` VALUES('35','98','2','36','0','0','','210293929393933939','','???','????','','0','2015-11-01 10:55:01','2015-11-01 10:55:01','admin','','','0');
INSERT INTO `users_level` VALUES('36','98','2','36','0','0','','210293929393933939','','','','','0','2015-11-01 11:33:40','2015-11-01 11:33:40','admin','','','0');
INSERT INTO `users_level` VALUES('37','99','2','15','0','0','','210293929393933939','','???','????','','0','2015-11-01 11:47:41','2015-11-01 11:47:41','admin','','','0');
INSERT INTO `users_level` VALUES('38','99','2','15','0','0','','210293929393933939','','','','','2','2015-11-01 11:48:56','2015-11-01 11:48:56','admin','','','0');
INSERT INTO `users_level` VALUES('40','100','2','15','0','0','','212121212121212121','','??','???','','0','2015-11-01 12:48:18','2015-11-01 12:48:18','admin','','','0');
INSERT INTO `users_level` VALUES('41','101','1','15','0','4','BJSJ0201511010003','210293929393933939','2016-11-03 00:00:00','???','????','','1','2015-11-01 13:29:22','2015-11-04 14:01:35','??','1446404797.jpg','','0');
INSERT INTO `users_level` VALUES('42','101','2','7','0','0','','','','','','','0','2015-11-01 20:37:33','2015-11-01 20:37:33','admin','','','0');
INSERT INTO `users_level` VALUES('43','103','1','0','0','0','','','','','','','0','2015-11-05 13:42:36','2015-11-05 13:42:36','admin','','','0');
INSERT INTO `users_level` VALUES('44','104','1','0','0','0','','','','','','','0','2015-11-05 13:53:29','2015-11-05 13:53:29','admin','','','0');
INSERT INTO `users_level` VALUES('45','105','1','0','0','0','','','','','','','0','2015-11-05 13:54:22','2015-11-05 13:54:22','admin','','','0');
INSERT INTO `users_level` VALUES('46','106','1','18','0','4','BJSJ0201511050001','210293929393933939','2016-11-04 00:00:00','???','????','','0','2015-11-05 13:57:08','2015-11-05 15:32:45','??','','','0');
INSERT INTO `users_level` VALUES('47','107','1','0','0','0','','210293929393933939','','???','','','0','2015-11-05 14:18:33','2015-11-05 14:18:33','admin','','','0');
INSERT INTO `users_level` VALUES('48','108','1','0','0','0','','','','','','','0','2015-11-05 14:20:37','2015-11-05 14:20:37','admin','','','0');
INSERT INTO `users_level` VALUES('49','109','1','0','0','0','','','','','','','0','2015-11-05 14:27:05','2015-11-05 14:27:05','admin','','','0');
INSERT INTO `users_level` VALUES('50','106','2','18','0','4','BJSJ0201511050001','210293929393933939','2016-11-04 00:00:00','???','????','','0','2015-11-05 13:57:08','2015-11-05 15:32:45','??','','','0');
INSERT INTO `users_level` VALUES('51','106','3','18','0','4','BJSJ0201511050001','210293929393933939','2016-11-04 00:00:00','???','????','','0','2015-11-05 13:57:08','2015-11-05 15:32:45','??','','','0');
INSERT INTO `users_level` VALUES('52','110','1','0','0','0','','','','','','','0','2015-11-06 12:24:53','2015-11-06 12:24:53','admin','','','0');
INSERT INTO `users_level` VALUES('53','111','1','0','0','0','','','','','','','0','2015-11-06 13:44:54','2015-11-06 13:44:54','admin','','','0');
INSERT INTO `users_level` VALUES('54','112','1','0','0','0','','210293929393933939','','???','????','','0','2015-11-06 13:48:33','2015-11-06 13:48:33','admin','','','0');
INSERT INTO `users_level` VALUES('55','113','1','18','0','0','','210293929393933936','','???','????','100001','0','2015-11-06 14:09:26','2015-11-06 14:09:26','admin','','','0');
INSERT INTO `users_level` VALUES('56','114','1','0','0','0','','','','','','','0','2015-11-07 00:41:56','2015-11-07 00:41:56','admin','','','0');
INSERT INTO `users_level` VALUES('57','115','1','0','0','0','','','','','','','0','2015-11-07 01:08:04','2015-11-07 01:08:04','admin','','','0');
INSERT INTO `users_level` VALUES('58','116','1','0','0','0','','','','','','','0','2015-11-07 01:35:14','2015-11-07 01:35:14','admin','','','0');
INSERT INTO `users_level` VALUES('59','117','1','0','0','0','','210293929393933939','','???','????','','0','2015-11-07 01:36:58','2015-11-07 01:36:58','admin','','','0');
INSERT INTO `users_level` VALUES('60','118','1','0','0','0','','210293929393933936','','???','????','','0','2015-11-07 01:40:36','2015-11-07 01:40:36','admin','','','0');
INSERT INTO `users_level` VALUES('61','119','1','0','0','0','','','','','','','0','2015-11-07 01:56:40','2015-11-07 01:56:40','admin','','','0');
INSERT INTO `users_level` VALUES('62','120','1','0','0','0','','','','','','','0','2015-11-07 02:12:52','2015-11-07 02:12:52','admin','','','0');
INSERT INTO `users_level` VALUES('63','121','1','0','0','0','','123123','','???','????','','0','2015-11-07 02:14:09','2015-11-07 02:14:09','admin','','','0');
INSERT INTO `users_level` VALUES('64','122','1','0','0','0','','23223233223','','???','22323','','0','2015-11-07 02:24:25','2015-11-07 02:24:25','admin','','','0');
INSERT INTO `users_level` VALUES('65','123','1','27','0','0','','234234','','???','????','','0','2015-11-07 02:27:33','2015-11-07 02:27:33','admin','','','0');
INSERT INTO `users_level` VALUES('66','124','1','0','0','0','','12312312','','???','123123','','0','2015-11-07 02:30:11','2015-11-07 02:30:11','admin','','','0');
INSERT INTO `users_level` VALUES('67','125','1','0','0','0','','','','','','','0','2015-11-07 02:32:46','2015-11-07 02:32:46','admin','','','0');
INSERT INTO `users_level` VALUES('68','126','1','0','0','0','','23423','','???','????','','0','2015-11-07 02:35:12','2015-11-07 02:35:12','admin','','','0');
INSERT INTO `users_level` VALUES('69','127','1','0','0','0','','11111111231231231212','','???','????','','0','2015-11-07 02:37:51','2015-11-07 02:37:51','admin','','','0');
INSERT INTO `users_level` VALUES('70','128','1','0','0','0','','32234234234','','???','????','','0','2015-11-07 02:43:01','2015-11-07 02:43:01','admin','','','0');
INSERT INTO `users_level` VALUES('71','129','1','0','0','0','','23234234234','','???','????','','0','2015-11-07 02:44:01','2015-11-07 02:44:01','admin','','','0');
INSERT INTO `users_level` VALUES('72','130','1','0','0','0','','','','','','','0','2015-11-07 02:46:49','2015-11-07 02:46:49','admin','','','0');
INSERT INTO `users_level` VALUES('73','131','1','18','0','2','BJSJ000001','210293929393933936','2016-11-08 00:00:00','???','????','','1','2015-11-07 02:48:07','2015-11-09 06:58:13','??','','','0');
INSERT INTO `users_level` VALUES('74','132','1','0','0','0','','','','','','','0','2015-11-07 02:53:41','2015-11-07 02:53:41','admin','','','0');
INSERT INTO `users_level` VALUES('75','133','1','0','0','0','','','','','','','0','2015-11-08 13:55:35','2015-11-08 13:55:35','admin','','','0');
INSERT INTO `users_level` VALUES('76','134','1','18','0','0','','','','','','','0','2015-11-08 14:26:39','2015-11-08 14:26:39','admin','','','0');
INSERT INTO `users_level` VALUES('77','135','1','18','0','5','','4545','','???','45','','0','2015-11-08 18:18:52','2015-11-08 18:18:52','admin','','','0');
INSERT INTO `users_level` VALUES('78','136','1','18','0','2','BJSJ2015093100005','232323','2016-11-08 00:00:00','???','????','1221','0','2015-11-08 18:48:01','2015-11-09 11:28:19','??12','','','0');
INSERT INTO `users_level` VALUES('79','137','1','18','0','4','BJSJ2015093100001','23423413123123123123','2016-11-08 00:00:00','???','????','','1','2015-11-09 12:12:17','2015-11-09 17:22:16','??1311','','','0');
INSERT INTO `users_level` VALUES('80','138','1','18','0','4','','210293929393933939333','','???','????','','0','2015-11-09 17:49:49','2015-11-09 17:49:49','admin','','','0');
INSERT INTO `users_level` VALUES('81','139','1','0','0','4','','','','','','','0','2015-11-09 18:19:14','2015-11-09 18:19:14','admin','','','0');
INSERT INTO `users_level` VALUES('82','140','1','0','0','4','','','','','','','0','2015-11-10 12:34:25','2015-11-10 12:34:25','admin','','','0');
INSERT INTO `users_level` VALUES('83','141','1','18','0','1','BJSJ2015093100004','2102939293939339364','2016-11-09 00:00:00','???','????','100001','1','2015-11-10 12:57:33','2015-11-11 11:51:48','admin','','','0');
INSERT INTO `users_level` VALUES('84','141','2','0','0','0','','','','','','','0','2015-11-10 14:32:05','2015-11-10 14:32:05','admin','','','0');
INSERT INTO `users_level` VALUES('85','142','1','142','0','0','','','','','','','0','2015-11-10 15:54:46','2015-11-10 15:54:46','admin','','','0');
INSERT INTO `users_level` VALUES('86','137','2','18','1','2','BJSJ2015093100001','23423413123123123123','2016-11-08 00:00:00','???','????','','1','2015-11-09 12:12:17','2015-11-09 17:22:16','??1311','','','0');
INSERT INTO `users_level` VALUES('87','143','1','141','0','2','BJSJ000001','2342341223','','???','????','','0','2015-11-11 08:46:26','2015-11-11 11:55:09','??1XXX','','','0');
INSERT INTO `users_level` VALUES('88','144','1','142','0','0','','','','','','','0','2015-11-11 10:51:39','2015-11-11 10:51:39','admin','','','0');
INSERT INTO `users_level` VALUES('89','145','1','142','0','0','','','','','','','0','2015-11-11 11:17:44','2015-11-11 11:17:44','admin','','','0');
INSERT INTO `users_level` VALUES('90','146','1','142','0','0','','','','','','','0','2015-11-11 11:22:11','2015-11-11 11:22:11','admin','','','0');
INSERT INTO `users_level` VALUES('92','148','1','142','0','0','','','','','','','0','2015-11-11 11:25:13','2015-11-11 11:25:13','admin','','','0');
INSERT INTO `users_level` VALUES('93','149','1','142','0','0','','21029392939393393934','','???','????','','0','2015-11-11 14:04:32','2015-11-11 14:04:32','admin','','','0');
INSERT INTO `users_level` VALUES('94','150','1','149','0','2','BJSJ2015111510001','1334232','','???','????','','0','2015-11-11 15:24:13','2015-11-11 18:12:22','??','','','0');
--
-- 表的结构users_login
--

DROP TABLE IF EXISTS `users_login`;
CREATE TABLE `users_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `login_time` datetime DEFAULT NULL COMMENT '????????',
  `logout_time` datetime DEFAULT NULL COMMENT '????????',
  `ip_address` varchar(45) NOT NULL DEFAULT '' COMMENT 'ip',
  PRIMARY KEY (`id`),
  KEY `index_user_id` (`user_id`),
  CONSTRAINT `fk_users_login_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='?????';

--
-- 转存表中的数据 users_login
--

--
-- 表的结构users_players
--

DROP TABLE IF EXISTS `users_players`;
CREATE TABLE `users_players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `team` varchar(25) NOT NULL DEFAULT '' COMMENT '????',
  `begin_time` datetime DEFAULT NULL COMMENT '????',
  `end_time` datetime DEFAULT NULL COMMENT '????',
  `level` varchar(45) NOT NULL DEFAULT '' COMMENT '??',
  `address` varchar(100) NOT NULL DEFAULT '' COMMENT '??',
  `witness` varchar(45) NOT NULL DEFAULT '' COMMENT '???',
  `witness_phone` varchar(20) NOT NULL DEFAULT '' COMMENT '?????',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '??',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='????';

--
-- 转存表中的数据 users_players
--

INSERT INTO `users_players` VALUES('1','29','???','1982-02-02 00:00:00','2015-09-08 20:14:53','1','??','??','123123123','333','','','');
INSERT INTO `users_players` VALUES('2','42','23423423','','2015-09-13 16:41:47','1','','','','','','','');
INSERT INTO `users_players` VALUES('3','30','????','2013-02-01 00:00:00','2015-09-15 13:48:23','1','???','??','232323232','????????','','','');
INSERT INTO `users_players` VALUES('4','47','??','','2015-09-23 16:40:56','1','','','','','','','');
INSERT INTO `users_players` VALUES('5','1','???','1982-02-02 00:00:00','2015-09-08 20:14:53','1','??','??','123123123','333','','','');
INSERT INTO `users_players` VALUES('6','1','????','2013-02-01 00:00:00','2015-09-15 13:48:23','1','???','??','232323232','????????','','','');
INSERT INTO `users_players` VALUES('7','55','??','2015-10-01 00:00:00','2015-10-23 00:00:00','1','???','??','13131313131','?????','','','');
INSERT INTO `users_players` VALUES('8','91','??','2013-02-01 00:00:00','2015-02-02 00:00:00','1','??','??','3234','223423','','','');
INSERT INTO `users_players` VALUES('9','106','??','2014-11-05 00:00:00','2015-11-05 00:00:00','1','???','??','112312312','????','','','');
INSERT INTO `users_players` VALUES('12','113','??','2014-11-06 00:00:00','2015-11-06 00:00:00','1','???','??','112312312','???','','','');
INSERT INTO `users_players` VALUES('13','135','yy','2014-11-08 00:00:00','2015-11-08 00:00:00','1','yy','yy','yy','yy','','','');
INSERT INTO `users_players` VALUES('14','143','??','2014-11-11 00:00:00','2015-11-11 00:00:00','??','???','??','112312312','??','2015-11-11 09:20:58','2015-11-11 09:20:58','admin');
INSERT INTO `users_players` VALUES('15','149','??','2014-10-29 00:00:00','2015-11-25 00:00:00','??','???','??','112312312','dddd','2015-11-11 14:30:55','2015-11-11 14:30:55','admin');
--
-- 表的结构users_train
--

DROP TABLE IF EXISTS `users_train`;
CREATE TABLE `users_train` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `credentials_number` varchar(25) NOT NULL DEFAULT '' COMMENT '????',
  `begin_time` datetime DEFAULT NULL COMMENT '????',
  `end_time` datetime DEFAULT NULL COMMENT '????',
  `level` varchar(45) NOT NULL DEFAULT '' COMMENT '??',
  `address` varchar(100) NOT NULL DEFAULT '' COMMENT '??',
  `witness` varchar(45) NOT NULL DEFAULT '' COMMENT '???',
  `witness_phone` varchar(20) NOT NULL DEFAULT '' COMMENT '?????',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '??',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='?????';

--
-- 转存表中的数据 users_train
--

INSERT INTO `users_train` VALUES('2','29','123123123123123','2018-02-01 00:00:00','2015-09-08 19:56:13','1','??','???','123123123','D??','','','');
INSERT INTO `users_train` VALUES('3','42','234234234','','2015-09-13 16:25:25','1','','','','','','','');
INSERT INTO `users_train` VALUES('4','30','3232323','2015-03-01 00:00:00','2015-09-15 13:40:32','1','??','???','12312312312','123123123','','','');
INSERT INTO `users_train` VALUES('5','47','234234234','','2015-09-23 16:30:19','1','','','','','','','');
INSERT INTO `users_train` VALUES('6','1','123123123123123','2018-02-01 00:00:00','2015-09-08 19:56:13','1','??','???','123123123','D??','','','');
INSERT INTO `users_train` VALUES('7','1','3232323','2015-03-01 00:00:00','2015-09-15 13:40:32','1','??','???','12312312312','123123123','','','');
INSERT INTO `users_train` VALUES('8','55','3333434','','2015-10-14 16:56:28','1','','','','','','','');
INSERT INTO `users_train` VALUES('9','55','3333434','2015-10-02 00:00:00','2015-10-15 00:00:00','1','????','???','23234234234','2312312','','','');
INSERT INTO `users_train` VALUES('10','91','2323323','0000-00-00 00:00:00','0000-00-00 00:00:00','1','??','??','12312','????','','','');
INSERT INTO `users_train` VALUES('11','92','BJCJ210210001','0000-00-00 00:00:00','0000-00-00 00:00:00','1','??','???','13121312131','??????','','','');
INSERT INTO `users_train` VALUES('12','106','BJCJ210210001','2014-11-05 00:00:00','2015-11-05 00:00:00','1','??','???','13121312131','ddd','','','');
INSERT INTO `users_train` VALUES('14','113','BJCJ210210001','2014-11-06 00:00:00','2015-11-06 00:00:00','1','??','???','13121312131','dfsdaf','','','');
INSERT INTO `users_train` VALUES('15','135','yy','2014-11-08 00:00:00','2015-11-08 00:00:00','1','yy','yy','yy','yy','','','');
INSERT INTO `users_train` VALUES('16','136','BJSJ20150931000001','2015-08-03 00:00:00','2015-08-04 00:00:00','1','????????????????','???','13122222222','??????????????????','','','');
INSERT INTO `users_train` VALUES('17','137','BJSJ2015093100001','2015-08-03 00:00:00','2015-08-04 00:00:00','1','????????????????','???','13122222222','??????????????????','2015-11-09 17:22:16','2015-11-09 17:22:16','admin');
INSERT INTO `users_train` VALUES('18','141','BJSJ2015093100004','2015-08-03 00:00:00','2015-08-04 00:00:00','1','????????????????','???','13122222222','??????????????????','2015-11-10 13:47:17','2015-11-10 13:47:17','admin');
INSERT INTO `users_train` VALUES('19','143','BJCJ210210001','2014-11-11 00:00:00','2015-11-11 00:00:00','1','??','???','13121312131','dd','2015-11-11 09:06:54','2015-11-11 09:06:54','admin');
INSERT INTO `users_train` VALUES('20','143','BJCJ210210001','2014-11-11 00:00:00','2015-11-11 00:00:00','??','??','???','13121312131','D??','2015-11-11 09:15:47','2015-11-11 09:15:47','admin');
INSERT INTO `users_train` VALUES('21','149','BJCJ210210001','2014-11-11 00:00:00','2015-11-11 00:00:00','??','??','???','13121312131','ddd ','2015-11-11 14:24:57','2015-11-11 14:24:57','admin');
INSERT INTO `users_train` VALUES('22','150','BJCJ210210001','2014-11-11 00:00:00','2015-11-11 00:00:00','C?','??','???','13121312131','D??','2015-11-11 15:37:41','2015-11-11 15:37:41','admin');
--
-- 表的结构users_vocational
--

DROP TABLE IF EXISTS `users_vocational`;
CREATE TABLE `users_vocational` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `team` varchar(25) NOT NULL DEFAULT '' COMMENT '????',
  `begin_time` datetime DEFAULT NULL COMMENT '????',
  `end_time` datetime DEFAULT NULL COMMENT '????',
  `post` varchar(45) NOT NULL DEFAULT '' COMMENT '??',
  `address` varchar(100) NOT NULL DEFAULT '' COMMENT '??',
  `witness` varchar(45) NOT NULL DEFAULT '' COMMENT '???',
  `witness_phone` varchar(20) NOT NULL DEFAULT '' COMMENT '?????',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '??',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='????';

--
-- 转存表中的数据 users_vocational
--

INSERT INTO `users_vocational` VALUES('1','29','??','2012-09-02 00:00:00','2015-09-08 20:06:58','1','???','???','121212121','222222','','','');
INSERT INTO `users_vocational` VALUES('3','42','','','2015-09-13 16:33:25','0','','','','','','','');
INSERT INTO `users_vocational` VALUES('4','42','','','2015-09-13 16:34:25','0','','','','','','','');
INSERT INTO `users_vocational` VALUES('5','42','','','2015-09-13 16:41:14','0','','','','','','','');
INSERT INTO `users_vocational` VALUES('6','30','??','2013-01-01 00:00:00','2015-09-15 13:43:37','1','??','??','232342342','3423423423','','','');
INSERT INTO `users_vocational` VALUES('7','47','','','2015-09-23 16:30:50','0','','','','','','','');
INSERT INTO `users_vocational` VALUES('8','47','','','2015-09-23 16:31:53','0','','','','','','','');
INSERT INTO `users_vocational` VALUES('9','47','??','2013-01-01 00:00:00','2015-09-23 16:37:46','2','??','??','232342342','sadfsad','','','');
INSERT INTO `users_vocational` VALUES('12','55','??','2015-10-01 00:00:00','2015-10-23 00:00:00','1','???','???','123123123123','??????','','','');
INSERT INTO `users_vocational` VALUES('13','91','??','2015-01-02 00:00:00','2015-05-03 00:00:00','1','??','??','2123123','????','','','');
INSERT INTO `users_vocational` VALUES('14','106','??','2014-11-05 00:00:00','2015-11-05 00:00:00','1','???','??','12312312','????','','','');
INSERT INTO `users_vocational` VALUES('16','113','??','2014-11-06 00:00:00','2015-11-06 00:00:00','2','???','??','12312312','asd','','','');
INSERT INTO `users_vocational` VALUES('17','135','yy','2014-11-08 00:00:00','2015-11-08 00:00:00','1','yy','yy','yy','yy','','','');
INSERT INTO `users_vocational` VALUES('18','143','??','2014-11-11 00:00:00','2015-11-11 00:00:00','???','???','??','12312312','D??','2015-11-11 09:20:40','2015-11-11 09:20:40','admin');
INSERT INTO `users_vocational` VALUES('19','149','??','2014-10-31 00:00:00','2015-11-03 00:00:00','???','???','??','12312312','ddd','2015-11-11 14:30:38','2015-11-11 14:30:38','admin');
INSERT INTO `users_vocational` VALUES('20','150','??','2014-11-11 00:00:00','2015-11-11 00:00:00','???','???','??','12312312','ss','2015-11-11 15:43:10','2015-11-11 15:43:10','admin');
--
-- 表的结构web_auth_item_child
--

DROP TABLE IF EXISTS `web_auth_item_child`;
CREATE TABLE `web_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `web_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `web_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 web_auth_item_child
--

INSERT INTO `web_auth_item_child` VALUES('admin','author');
INSERT INTO `web_auth_item_child` VALUES('author','createPost');
INSERT INTO `web_auth_item_child` VALUES('admin','updatePost');
--
-- 表的结构web_auth_rule
--

DROP TABLE IF EXISTS `web_auth_rule`;
CREATE TABLE `web_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 web_auth_rule
--

