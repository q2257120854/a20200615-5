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
-- 表的结构chzb_proxy
--

DROP TABLE IF EXISTS `chzb_proxy`;
CREATE TABLE `chzb_proxy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` varchar(500) NOT NULL,
  `proxy` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 chzb_proxy
--

INSERT INTO `chzb_proxy` VALUES('124','eJzLKCkpsNLXLy8v18ssKCmzsLDQK8kv0DcyMLQ0NDAw1QcAtMcJyA==','eJwrzi+w0tcHAAfeAes=');
