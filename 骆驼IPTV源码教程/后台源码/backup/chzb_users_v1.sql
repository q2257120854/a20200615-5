--
-- MySQL database dump
-- Created by DbManage class, Power By yanue. 
-- http://yanue.net 
--
-- 生成日期: 2019 年  10 月 11 日 22:00
-- MySQL版本: 5.1.73-log
-- PHP 版本: 5.4.45

--
-- 数据库: ``
--

-- -------------------------------------------------------

--
-- 表的结构chzb_users
--

DROP TABLE IF EXISTS `chzb_users`;
CREATE TABLE `chzb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` bigint(15) NOT NULL,
  `mac` varchar(32) NOT NULL,
  `deviceid` varchar(32) NOT NULL,
  `model` varchar(200) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `region` varchar(50) NOT NULL,
  `exp` int(11) NOT NULL,
  `vpn` int(11) NOT NULL DEFAULT '0',
  `author` varchar(16) NOT NULL,
  `authortime` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '-1',
  `lasttime` int(11) NOT NULL,
  `marks` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7443 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 chzb_users
--

INSERT INTO `chzb_users` VALUES('7410','118805','','da43048a00a96fed','','123.161.231.195','河南省平顶山市电信','1601913600','0','admin','1570450274','999','1570450382','已授权');
INSERT INTO `chzb_users` VALUES('7415','656809','08:00:27:4e:c1:4e','bf215aae25f75e53','','113.102.34.161','广东省肇庆市电信','1602000000','0','admin','1570505259','1','1570534499','已授权');
