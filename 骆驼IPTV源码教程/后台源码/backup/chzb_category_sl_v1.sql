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
-- 表的结构chzb_category_sl
--

DROP TABLE IF EXISTS `chzb_category_sl`;
CREATE TABLE `chzb_category_sl` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `isprov` tinyint(4) NOT NULL DEFAULT '0',
  `canseek` tinyint(4) NOT NULL DEFAULT '0',
  `enable` tinyint(4) NOT NULL DEFAULT '1',
  `updateurl` varchar(500) DEFAULT '',
  `psw` varchar(16) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 chzb_category_sl
--

INSERT INTO `chzb_category_sl` VALUES('154','重庆','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('160','河南','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('155','广东','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('156','湖北','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('157','河北','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('158','安徽','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('159','江西','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('180','黑龙江','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('152','天津','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('153','上海','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('162','山西','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('163','吉林','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('164','江苏','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('165','福建','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('167','海南','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('168','贵州','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('170','云南','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('172','陕西','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('176','西藏','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('174','宁夏','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('179','内蒙古','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('151','北京','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('166','湖南','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('173','广西','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('175','甘肃','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('177','浙江','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('178','新疆','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('171','山东','0','0','1','','');
INSERT INTO `chzb_category_sl` VALUES('169','四川','0','0','1','','');
