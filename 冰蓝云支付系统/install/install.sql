SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `panel_log`;
CREATE TABLE `panel_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `date` datetime NOT NULL,
  `city` varchar(20) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `panel_user`;
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
DROP TABLE IF EXISTS `pay_batch`;
CREATE TABLE `pay_batch` (
  `batch` varchar(20) NOT NULL,
  `allmoney` decimal(10,2) NOT NULL,
  `time` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`batch`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `pay_order`;
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
DROP TABLE IF EXISTS `pay_regcode`;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `pay_settle`;
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
DROP TABLE IF EXISTS `pay_user`;
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
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `pay_config`;
CREATE TABLE `pay_config` (
  `k` varchar(200) NOT NULL,
  `v` text,
  PRIMARY KEY (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `pay_config` VALUES ('admin_user', 'admin');
INSERT INTO `pay_config` VALUES ('admin_pwd', 'ecc0e3c226d4c56f38087a7fbff24833');
INSERT INTO `pay_config` VALUES ('local_domain', 'pay.52saf.com');
INSERT INTO `pay_config` VALUES ('wxtransfer_desc', 'SAF易支付平台自动结算');
INSERT INTO `pay_config` VALUES ('payer_show_name', 'SAF支付平台');
INSERT INTO `pay_config` VALUES ('alipay_appid', '');
INSERT INTO `pay_config` VALUES ('money_rate', '97');
INSERT INTO `pay_config` VALUES ('settle_money', '10');
INSERT INTO `pay_config` VALUES ('settle_rate', '0.005');
INSERT INTO `pay_config` VALUES ('settle_fee_min', '0.1');
INSERT INTO `pay_config` VALUES ('settle_fee_max', '20');
INSERT INTO `pay_config` VALUES ('settle_open', '0');
INSERT INTO `pay_config` VALUES ('web_name', 'SAF易支付');
INSERT INTO `pay_config` VALUES ('web_qq', '1601695161');
INSERT INTO `pay_config` VALUES ('quicklogin', '1');
INSERT INTO `pay_config` VALUES ('is_reg', '1');
INSERT INTO `pay_config` VALUES ('is_payreg', '1');
INSERT INTO `pay_config` VALUES ('reg_pid', '1001');
INSERT INTO `pay_config` VALUES ('reg_price', '0.01');
INSERT INTO `pay_config` VALUES ('verifytype', '0');
INSERT INTO `pay_config` VALUES ('stype_1', '1');
INSERT INTO `pay_config` VALUES ('stype_2', '1');
INSERT INTO `pay_config` VALUES ('stype_3', '0');
INSERT INTO `pay_config` VALUES ('stype_4', '1');
INSERT INTO `pay_config` VALUES ('mail_cloud', '0');
INSERT INTO `pay_config` VALUES ('mail_smtp', 'smtp.qq.com');
INSERT INTO `pay_config` VALUES ('mail_port', '465');
INSERT INTO `pay_config` VALUES ('mail_name', '');
INSERT INTO `pay_config` VALUES ('mail_pwd', '');
INSERT INTO `pay_config` VALUES ('mail_apiuser', '');
INSERT INTO `pay_config` VALUES ('mail_apikey', '');
INSERT INTO `pay_config` VALUES ('sms_appkey', '');
INSERT INTO `pay_config` VALUES ('CAPTCHA_ID', 'b31335edde91b2f98dacd393f6ae6de8');
INSERT INTO `pay_config` VALUES ('PRIVATE_KEY', '170d2349acef92b7396c7157eb9d8f47');
INSERT INTO `pay_config` VALUES ('submit', '保存修改');
INSERT INTO `pay_config` VALUES ('alipay_api', '3');
INSERT INTO `pay_config` VALUES ('ali_api_partner', '');
INSERT INTO `pay_config` VALUES ('ali_api_seller_email', '');
INSERT INTO `pay_config` VALUES ('ali_api_key', '');
INSERT INTO `pay_config` VALUES ('ali_epay_api_url', 'http://epay.52saf.com/');
INSERT INTO `pay_config` VALUES ('ali_epay_api_id', '');
INSERT INTO `pay_config` VALUES ('ali_epay_api_key', '');
INSERT INTO `pay_config` VALUES ('ali_codepay_api_id', '');
INSERT INTO `pay_config` VALUES ('ali_codepay_api_key', '');
INSERT INTO `pay_config` VALUES ('ali_close_info', '暂时维护');
INSERT INTO `pay_config` VALUES ('wxpay_api', '2');
INSERT INTO `pay_config` VALUES ('wx_api_appid', '');
INSERT INTO `pay_config` VALUES ('wx_api_mchid', '');
INSERT INTO `pay_config` VALUES ('wx_api_key', '');
INSERT INTO `pay_config` VALUES ('wx_api_appsecret', '');
INSERT INTO `pay_config` VALUES ('wx_epay_api_url', 'http://epay.52saf.com/');
INSERT INTO `pay_config` VALUES ('wx_epay_api_id', '');
INSERT INTO `pay_config` VALUES ('wx_epay_api_key', '');
INSERT INTO `pay_config` VALUES ('wx_codepay_api_id', '');
INSERT INTO `pay_config` VALUES ('wx_codepay_api_key', '');
INSERT INTO `pay_config` VALUES ('wx_close_info', '微信通道暂时维护');
INSERT INTO `pay_config` VALUES ('qqpay_api', '3');
INSERT INTO `pay_config` VALUES ('qq_api_mchid', '123132');
INSERT INTO `pay_config` VALUES ('qq_api_mchkey', '1213');
INSERT INTO `pay_config` VALUES ('qq_epay_api_url', 'http://epay.52saf.com/');
INSERT INTO `pay_config` VALUES ('qq_epay_api_id', '');
INSERT INTO `pay_config` VALUES ('qq_epay_api_key', '');
INSERT INTO `pay_config` VALUES ('qq_codepay_api_id', '');
INSERT INTO `pay_config` VALUES ('qq_codepay_api_key', '');
INSERT INTO `pay_config` VALUES ('qq_close_info', 'QQ钱包暂时维护');
INSERT INTO `pay_config` VALUES ('goods_lj', '刷钻、黑号、AV、');
INSERT INTO `pay_config` VALUES ('goods_ljtis', '您的购买的商品涉及违法违规，请您停止购买');