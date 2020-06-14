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
-- 表的结构chzb_category_cc
--

DROP TABLE IF EXISTS `chzb_category_cc`;
CREATE TABLE `chzb_category_cc` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `isprov` tinyint(4) NOT NULL DEFAULT '0',
  `canseek` tinyint(4) NOT NULL DEFAULT '0',
  `enable` tinyint(4) NOT NULL DEFAULT '1',
  `updateurl` varchar(500) DEFAULT '',
  `psw` varchar(16) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 chzb_category_cc
--

INSERT INTO `chzb_category_cc` VALUES('51','央视频道','0','0','1','','');
INSERT INTO `chzb_category_cc` VALUES('52','卫视频道','0','0','1','','');
