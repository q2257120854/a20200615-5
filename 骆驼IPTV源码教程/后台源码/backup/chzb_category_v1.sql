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
-- 表的结构chzb_category
--

DROP TABLE IF EXISTS `chzb_category`;
CREATE TABLE `chzb_category` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `isprov` tinyint(4) NOT NULL DEFAULT '0',
  `canseek` tinyint(4) NOT NULL DEFAULT '0',
  `enable` tinyint(4) NOT NULL DEFAULT '1',
  `updateurl` varchar(500) DEFAULT '',
  `psw` varchar(16) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 chzb_category
--

INSERT INTO `chzb_category` VALUES('103','精彩轮播','0','0','1','','');
INSERT INTO `chzb_category` VALUES('102','卫视频道','0','0','1','','');
INSERT INTO `chzb_category` VALUES('101','央视频道','0','0','1','','');
INSERT INTO `chzb_category` VALUES('104','快进分类','0','0','1','','');
INSERT INTO `chzb_category` VALUES('105','密码分类','0','0','1','','13800');
