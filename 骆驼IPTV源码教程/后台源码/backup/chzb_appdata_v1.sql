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
-- 表的结构chzb_appdata
--

DROP TABLE IF EXISTS `chzb_appdata`;
CREATE TABLE `chzb_appdata` (
  `dataver` int(11) NOT NULL,
  `appver` varchar(16) NOT NULL,
  `setver` int(11) NOT NULL DEFAULT '0',
  `dataurl` varchar(255) NOT NULL,
  `appurl` varchar(255) NOT NULL,
  `adtext` varchar(1024) NOT NULL,
  `showtime` int(11) NOT NULL,
  `showinterval` int(11) NOT NULL,
  `needauthor` int(11) NOT NULL DEFAULT '1',
  `splashbj` varchar(255) NOT NULL,
  `exitbj` varchar(255) NOT NULL,
  `decoder` int(11) NOT NULL DEFAULT '0',
  `buffTimeOut` int(11) NOT NULL DEFAULT '10',
  `tipusernoreg` varchar(100) NOT NULL,
  `tipuserexpired` varchar(100) NOT NULL,
  `tipuserforbidden` varchar(100) NOT NULL,
  `tiploading` varchar(100) NOT NULL,
  `tipmatcherror` varchar(100) NOT NULL,
  `ipcount` int(11) NOT NULL DEFAULT '5',
  `trialdays` int(11) DEFAULT NULL,
  `qqinfo` varchar(255) DEFAULT NULL,
  `autoupdate` int(11) DEFAULT '1',
  `randkey` varchar(100) DEFAULT '827ccb0eea8a706c4c34a16891f84e7b'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 chzb_appdata
--

INSERT INTO `chzb_appdata` VALUES('478','1.0','26','http://xctv.gz01.bdysite.com/chzb/data.php','https://www.baidu.com/1.apk','欢迎测试骆驼壳无授权展示版本.','0','100','1','http://www.iptv888.top/20191005/bj/1.png','http://localhost/bj/del.png','0','10','输入授权码登录，或将MAC拍照发给提供商。','已到期请联系提供商续费。','因非法操作已被管理员禁用请联系提供商。','节目读取中  请耐心等待','设备码与绑定的不一致，请联系提供商。','5','0','骆驼壳授权版或无授权都是带有WEB后台的，请勿轻易相信他人以免受骗，正版购买渠道请联系QQ：26206960。','1','13ae41c997b396765bd57e3f8786dbf7');
