-- MySQL dump 10.13  Distrib 5.5.54, for Win64 (AMD64)
--
-- Host: localhost    Database: pay12345
-- ------------------------------------------------------
-- Server version	5.5.54-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `panel_log`
--

DROP TABLE IF EXISTS `panel_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `panel_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `date` datetime NOT NULL,
  `city` varchar(20) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel_log`
--

LOCK TABLES `panel_log` WRITE;
/*!40000 ALTER TABLE `panel_log` DISABLE KEYS */;
INSERT INTO `panel_log` VALUES (1,1,'登录系统','2018-12-20 07:40:42','','IP:61.158.146.167'),(2,1,'登录系统','2018-12-20 07:42:04','','IP:61.158.146.167'),(3,1,'登录系统','2018-12-20 07:42:14','','IP:61.158.146.167'),(4,1,'登录系统','2018-12-20 08:18:31','','IP:61.158.146.167'),(5,1001,'登录用户中心','2018-12-20 08:19:32','','61.158.146.167');
/*!40000 ALTER TABLE `panel_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panel_user`
--

DROP TABLE IF EXISTS `panel_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `panel_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(32) NOT NULL,
  `user` varchar(32) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `email` varchar(32) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `name` varchar(10) DEFAULT NULL,
  `regtime` datetime DEFAULT NULL,
  `logtime` datetime DEFAULT NULL,
  `level` int(1) NOT NULL DEFAULT '1',
  `type` int(1) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panel_user`
--

LOCK TABLES `panel_user` WRITE;
/*!40000 ALTER TABLE `panel_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `panel_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_batch`
--

DROP TABLE IF EXISTS `pay_batch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_batch` (
  `batch` varchar(20) NOT NULL,
  `allmoney` decimal(10,2) NOT NULL,
  `time` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`batch`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_batch`
--

LOCK TABLES `pay_batch` WRITE;
/*!40000 ALTER TABLE `pay_batch` DISABLE KEYS */;
/*!40000 ALTER TABLE `pay_batch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_config`
--

DROP TABLE IF EXISTS `pay_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_config` (
  `k` varchar(200) NOT NULL,
  `v` text,
  PRIMARY KEY (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_config`
--

LOCK TABLES `pay_config` WRITE;
/*!40000 ALTER TABLE `pay_config` DISABLE KEYS */;
INSERT INTO `pay_config` VALUES ('admin_user','admin'),('admin_pwd','6323d0b7cc6e2eb0cae8b37d090e27f4'),('local_domain','pay.taonmibao.com'),('wxtransfer_desc','冰蓝易支付平台自动结算'),('payer_show_name','冰蓝易支付平台'),('alipay_appid',''),('money_rate','97'),('settle_money','10'),('settle_rate','0.005'),('settle_fee_min','0.1'),('settle_fee_max','20'),('settle_open','0'),('web_name','冰蓝易支付'),('web_qq','768099878'),('quicklogin','1'),('is_reg','1'),('is_payreg','0'),('reg_pid','1001'),('reg_price','0.01'),('verifytype','0'),('stype_1','1'),('stype_2','1'),('stype_3','0'),('stype_4','1'),('mail_cloud','0'),('mail_smtp','smtp.exmail.qq.com'),('mail_port','465'),('mail_name','yx@xinmazhan.com'),('mail_pwd','asdASD123'),('mail_apiuser',''),('mail_apikey',''),('sms_appkey',''),('CAPTCHA_ID','b31335edde91b2f98dacd393f6ae6de8'),('PRIVATE_KEY','170d2349acef92b7396c7157eb9d8f47'),('submit','保存修改'),('alipay_api','1'),('ali_api_partner','2088202846407450'),('ali_api_seller_email','1038756959@qq.com'),('ali_api_key','nmeb52i7kqlasaa7o6g89i5td8iwxzoz'),('ali_epay_api_url','http://epay.52saf.com/'),('ali_epay_api_id',''),('ali_epay_api_key',''),('ali_codepay_api_id','32845'),('ali_codepay_api_key','PH8TV4hNmWlZYxom25WyZBNRzokM2QxK'),('ali_close_info','暂时维护'),('wxpay_api','3'),('wx_api_appid',''),('wx_api_mchid',''),('wx_api_key',''),('wx_api_appsecret',''),('wx_epay_api_url','http://epay.52saf.com/'),('wx_epay_api_id',''),('wx_epay_api_key',''),('wx_codepay_api_id','32845'),('wx_codepay_api_key','PH8TV4hNmWlZYxom25WyZBNRzokM2QxK'),('wx_close_info','微信通道暂时维护'),('qqpay_api','1'),('qq_api_mchid','15030259618'),('qq_api_mchkey','qwertyuiopqwertyuiopqwertyuiopqw'),('qq_epay_api_url','http://epay.52saf.com/'),('qq_epay_api_id',''),('qq_epay_api_key',''),('qq_codepay_api_id','32845'),('qq_codepay_api_key','PH8TV4hNmWlZYxom25WyZBNRzokM2QxK'),('qq_close_info','QQ钱包暂时维护'),('goods_lj','刷钻、黑号、AV、'),('goods_ljtis','您的购买的商品涉及违法违规，请您停止购买');
/*!40000 ALTER TABLE `pay_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_order`
--

DROP TABLE IF EXISTS `pay_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_order` (
  `trade_no` varchar(64) NOT NULL,
  `out_trade_no` varchar(64) NOT NULL,
  `notify_url` varchar(64) DEFAULT NULL,
  `return_url` varchar(64) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `buyer` varchar(30) DEFAULT NULL,
  `pid` int(11) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `money` varchar(32) NOT NULL,
  `domain` varchar(32) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`trade_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_order`
--

LOCK TABLES `pay_order` WRITE;
/*!40000 ALTER TABLE `pay_order` DISABLE KEYS */;
INSERT INTO `pay_order` VALUES ('2018122007580531955','20181220075803898','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','alipay',NULL,1000,'2018-12-20 07:58:05',NULL,'测试商品','0.01','epay.52saf.com','61.158.146.167',0),('2018122008041144392','20181220080409471','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','alipay',NULL,1000,'2018-12-20 08:04:11',NULL,'测试商品','0.01','epay.52saf.com','61.158.146.167',0),('2018122008041565369','20181220080413784','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','qqpay',NULL,1000,'2018-12-20 08:04:15',NULL,'测试商品','0.01','epay.52saf.com','61.158.146.167',0),('2018122008042583349','20181220080423262','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','wxpay',NULL,1000,'2018-12-20 08:04:25',NULL,'测试商品','0.01','epay.52saf.com','61.158.146.167',0),('2018122010114712033','20181220101143294','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','qqpay',NULL,1000,'2018-12-20 10:11:47',NULL,'测试商品','0.01','epay.52saf.com','118.252.205.107',0),('2018122010115361292','20181220101143294','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','wxpay',NULL,1000,'2018-12-20 10:11:53',NULL,'测试商品','0.01','epay.52saf.com','118.252.205.107',0),('2018122012423449286','20181220124231697','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','alipay',NULL,1000,'2018-12-20 12:42:34',NULL,'测试商品','0.01','epay.52saf.com','183.199.20.154',0),('2018122012424593223','20181220124231697','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','qqpay',NULL,1000,'2018-12-20 12:42:45',NULL,'测试商品','0.01','epay.52saf.com','183.199.20.154',0),('2018122012425362296','20181220124231697','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','wxpay',NULL,1000,'2018-12-20 12:42:53',NULL,'测试商品','0.01','epay.52saf.com','183.199.20.154',0),('2018122015192936805','20181220151925342','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','wxpay',NULL,1000,'2018-12-20 15:19:29',NULL,'测试商品','0.01','epay.52saf.com','106.117.114.133',0),('2018122015194289737','20181220151925342','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','qqpay',NULL,1000,'2018-12-20 15:19:42',NULL,'测试商品','0.01','epay.52saf.com','106.117.114.133',0),('2018122015194623035','20181220151925342','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','alipay',NULL,1000,'2018-12-20 15:19:46',NULL,'测试商品','0.01','epay.52saf.com','106.117.114.133',0),('2018122019185354863','20181220191849352','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','qqpay',NULL,1000,'2018-12-20 19:18:53',NULL,'测试商品','0.01','epay.52saf.com','117.151.238.70',0),('2018122100502715188','20181221005024978','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','qqpay',NULL,1000,'2018-12-21 00:50:27',NULL,'测试商品','0.01','epay.52saf.com','113.246.203.103',0),('2018122100503721831','20181221005024978','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','wxpay',NULL,1000,'2018-12-21 00:50:37',NULL,'测试商品','0.01','epay.52saf.com','113.246.203.103',0),('2018122100510879798','20181221005024978','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','alipay',NULL,1000,'2018-12-21 00:51:07',NULL,'测试商品','0.01','epay.52saf.com','113.246.203.103',0),('2018122100523263492','20181221005024978','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','alipay',NULL,1000,'2018-12-21 00:52:32',NULL,'测试商品','1000','epay.52saf.com','113.246.203.103',0),('2018122100525768096','20181221005024978','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','qqpay',NULL,1000,'2018-12-21 00:52:57',NULL,'测试商品','1000','epay.52saf.com','113.246.203.103',0),('2018122100530058780','20181221005024978','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','wxpay',NULL,1000,'2018-12-21 00:53:00',NULL,'测试商品','1000','epay.52saf.com','113.246.203.103',0),('2018122100531044775','20181221005024978','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','alipay',NULL,1000,'2018-12-21 00:53:10',NULL,'测试商品','1000','epay.52saf.com','113.246.203.103',0),('2018122113491881702','20181221134914524','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','alipay',NULL,1000,'2018-12-21 13:49:18',NULL,'测试商品','0.01','epay.52saf.com','119.141.254.188',0),('2018122113510973838','20181221134914524','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','wxpay',NULL,1000,'2018-12-21 13:51:09',NULL,'测试商品','0.01','epay.52saf.com','119.141.254.188',0),('2018122113511654158','20181221134914524','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','qqpay',NULL,1000,'2018-12-21 13:51:16',NULL,'测试商品','0.01','epay.52saf.com','119.141.254.188',0),('2018122118520672639','20181221185151681','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','qqpay',NULL,1000,'2018-12-21 18:52:06',NULL,'测试商品','0.01','epay.52saf.com','103.244.249.46',0),('2018122118521481079','20181221185151681','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','alipay',NULL,1000,'2018-12-21 18:52:14',NULL,'测试商品','0.01','epay.52saf.com','103.244.249.46',0),('2018122216283931919','20181222162836995','http://epay.52saf.com/SDK/notify_url.php','http://epay.52saf.com/SDK/return_url.php','alipay',NULL,1000,'2018-12-22 16:28:39',NULL,'测试商品','0.01','epay.52saf.com','113.80.85.57',0);
/*!40000 ALTER TABLE `pay_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_regcode`
--

DROP TABLE IF EXISTS `pay_regcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_regcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL DEFAULT '0',
  `code` varchar(32) NOT NULL,
  `email` varchar(32) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `trade_no` varchar(32) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_regcode`
--

LOCK TABLES `pay_regcode` WRITE;
/*!40000 ALTER TABLE `pay_regcode` DISABLE KEYS */;
INSERT INTO `pay_regcode` VALUES (1,0,'7566189','768099878@qq.com',1545264322,'61.158.146.167',1,NULL,NULL);
/*!40000 ALTER TABLE `pay_regcode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_settle`
--

DROP TABLE IF EXISTS `pay_settle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_settle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `batch` varchar(20) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '1',
  `username` varchar(10) NOT NULL,
  `account` varchar(32) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `time` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `transfer_status` int(1) NOT NULL DEFAULT '0',
  `transfer_result` varchar(64) DEFAULT NULL,
  `transfer_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_settle`
--

LOCK TABLES `pay_settle` WRITE;
/*!40000 ALTER TABLE `pay_settle` DISABLE KEYS */;
/*!40000 ALTER TABLE `pay_settle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_user`
--

DROP TABLE IF EXISTS `pay_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `key` varchar(32) NOT NULL,
  `rate` varchar(8) DEFAULT NULL,
  `account` varchar(32) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `alipay_uid` varchar(32) DEFAULT NULL,
  `qq_uid` varchar(32) DEFAULT NULL,
  `money` decimal(10,2) NOT NULL,
  `settle_id` int(1) NOT NULL DEFAULT '1',
  `email` varchar(32) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `url` varchar(64) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `apply` int(1) NOT NULL DEFAULT '0',
  `level` int(1) NOT NULL DEFAULT '1',
  `type` int(1) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1002 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_user`
--

LOCK TABLES `pay_user` WRITE;
/*!40000 ALTER TABLE `pay_user` DISABLE KEYS */;
INSERT INTO `pay_user` VALUES (1000,NULL,'CJ11cepjhu1r2rVjvR2E5vDhJ13RaccH','','100','测试',NULL,NULL,0.00,1,'',NULL,'','','2018-12-20 07:44:02',0,1,1,1),(1001,NULL,'Rl11nO55nz0ytii01oByn55ofnZ0fYB1',NULL,'15888888888','测试1',NULL,NULL,0.00,1,'768099878@qq.com','',NULL,'pay.taonmibao.com','2018-12-20 08:06:15',0,1,0,1);
/*!40000 ALTER TABLE `pay_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zz_pay_config`
--

DROP TABLE IF EXISTS `zz_pay_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zz_pay_config` (
  `k` varchar(200) NOT NULL,
  `v` text,
  PRIMARY KEY (`k`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zz_pay_config`
--

LOCK TABLES `zz_pay_config` WRITE;
/*!40000 ALTER TABLE `zz_pay_config` DISABLE KEYS */;
INSERT INTO `zz_pay_config` VALUES ('admin_pwd','70898114b252396ee336e9bcf74d9221'),('admin_user','admin'),('alipay_api','1'),('alipay_appid','2018051160121372'),('alirate','95'),('ali_api_key','nmeb52i7kqlasaa7o6g89i5td8iwxzoz'),('ali_api_partner','2088202846407450'),('ali_api_seller_email','1038756959@qq.com'),('ali_close_info','暂时维护'),('ali_codepay_api_id','32845'),('ali_codepay_api_key','PH8TV4hNmWlZYxom25WyZBNRzokM2QxK'),('ali_epay_api_id',''),('ali_epay_api_key',''),('ali_epay_api_url',''),('CAPTCHA_ID',''),('gg','欢迎使用新码云支付'),('goods_lj','腾讯、QQ、刷钻、黑号、AV、会员、VIP、vip、svip、SVIP、小号、钻、会、刷、、超、云盘、cdk、CDK、CdK、测试商品、理论、名片赞、赞、名片、黄、赌、毒，Q币，话费充值，直播盒子，百度云盘，王者荣耀CDK，黄片、片、yunpan、博彩、私彩、苍井空、波多野结衣、马云、马化腾、雷军、钻、VPN、外挂、QVIP、SVIP、 轰、券、盘、靓号、烟、代刷、刷、svip、qvip、、会、超、HQ、砖、以及各种抽奖、一元夺宝、金融福利'),('goods_ljtis','您好！<div>您交易的商品是本平台的违禁词，<div>请联系网站管理员告知！<div>谢谢，祝您交易成功，生活圆满，财源滚滚来！</div><div>晓超云支付</div>'),('is_payreg','0'),('is_reg','0'),('local_domain','pay.humaizhan.cn'),('mail_apikey',''),('mail_apiuser',''),('mail_cloud','0'),('mail_name','yx@xinmazhan.com'),('mail_port','465'),('mail_pwd','asdASD123'),('mail_smtp','smtp.exmail.qq.com'),('money_rate','97'),('payer_show_name','新码云支付'),('PRIVATE_KEY',''),('qqpay_api','1'),('qqrate','95'),('qq_api_mchid','1503025961'),('qq_api_mchkey','qwertyuiopqwertyuiopqwertyuiopqw'),('qq_close_info','QQ钱包暂时维护'),('qq_codepay_api_id','32845'),('qq_codepay_api_key','PH8TV4hNmWlZYxom25WyZBNRzokM2QxK'),('qq_epay_api_id',''),('qq_epay_api_key',''),('qq_epay_api_url',''),('quicklogin','2'),('reg_pid','1000'),('reg_price','1'),('settle_fee_max','50'),('settle_fee_min','1'),('settle_money','5'),('settle_open','0'),('settle_rate','0.05'),('sms_appkey',''),('stype_1','1'),('stype_2','0'),('stype_3','1'),('stype_4','1'),('submit','保存修改'),('verifytype','0'),('web_name','新码云支付'),('web_qq','768099878'),('wxpay_api','3'),('wxrate','95'),('wxtransfer_desc','新码云支付平台自动结算'),('wx_api_appid',''),('wx_api_appsecret',''),('wx_api_key',''),('wx_api_mchid',''),('wx_close_info','微信支付暂时维护'),('wx_codepay_api_id','32845'),('wx_codepay_api_key','PH8TV4hNmWlZYxom25WyZBNRzokM2QxK'),('wx_epay_api_id',''),('wx_epay_api_key',''),('wx_epay_api_url','');
/*!40000 ALTER TABLE `zz_pay_config` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-22 17:00:58
