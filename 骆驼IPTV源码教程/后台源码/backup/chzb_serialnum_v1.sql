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
-- 表的结构chzb_serialnum
--

DROP TABLE IF EXISTS `chzb_serialnum`;
CREATE TABLE `chzb_serialnum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sn` bigint(15) NOT NULL,
  `regid` int(11) NOT NULL,
  `regtime` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `author` varchar(16) NOT NULL,
  `createtime` int(11) NOT NULL,
  `enable` int(11) NOT NULL,
  `marks` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=567 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 chzb_serialnum
--

