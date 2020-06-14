--
-- MySQL database dump
-- Created by DbManage class, Power By yanue. 
-- http://yanue.net 
--
-- 生成日期: 2019 年  05 月 18 日 17:46
-- MySQL版本: 5.7.17-baidu-rds-3.0.0.1-log
-- PHP 版本: 5.4.20

--
-- 数据库: ``
--

-- -------------------------------------------------------

--
-- 表的结构chzb_category_gd
--

DROP TABLE IF EXISTS `chzb_category_gd`;
CREATE TABLE `chzb_category_gd` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `isprov` tinyint(4) NOT NULL DEFAULT '0',
  `canseek` tinyint(4) NOT NULL DEFAULT '0',
  `enable` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 chzb_category_gd
--

INSERT INTO `chzb_category_gd` VALUES('1','央视频道','0','0','1');
INSERT INTO `chzb_category_gd` VALUES('2','卫视频道','0','0','1');
