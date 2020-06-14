-- MySQL dump 10.13  Distrib 5.5.62, for Linux (x86_64)
--
-- Host: localhost    Database: syzb
-- ------------------------------------------------------
-- Server version	5.5.62-log

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
-- Table structure for table `chzb_admin`
--

DROP TABLE IF EXISTS `chzb_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chzb_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `psw` varchar(16) NOT NULL,
  `showcounts` int(11) NOT NULL DEFAULT '100',
  `author1` tinyint(4) NOT NULL DEFAULT '0',
  `author2` tinyint(4) NOT NULL DEFAULT '0',
  `useradmin` tinyint(4) NOT NULL DEFAULT '0',
  `channeladmin` tinyint(4) NOT NULL DEFAULT '0',
  `ipcheck` tinyint(11) NOT NULL DEFAULT '0',
  `unbind` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chzb_admin`
--

LOCK TABLES `chzb_admin` WRITE;
/*!40000 ALTER TABLE `chzb_admin` DISABLE KEYS */;
INSERT INTO `chzb_admin` VALUES (1,'admin','admin',20,1,1,1,1,1,0);
/*!40000 ALTER TABLE `chzb_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chzb_appdata`
--

DROP TABLE IF EXISTS `chzb_appdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `randkey` varchar(100) DEFAULT '827ccb0eea8a706c4c34a16891f84e7b',
  `updateinterval` int(11) DEFAULT '15'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chzb_appdata`
--

LOCK TABLES `chzb_appdata` WRITE;
/*!40000 ALTER TABLE `chzb_appdata` DISABLE KEYS */;
INSERT INTO `chzb_appdata` VALUES (480,'1.0',26,'http://xctv.gz01.bdysite.com/chzb/data.php','https://www.baidu.com/1.apk','欢迎测试5G云-骆驼壳无授权展示版本.',30,100,1,'http://www.iptv888.top/20191005/bj/1.png','http://localhost/bj/del.png',1,10,'输入授权码登录，或将MAC拍照发给提供商。','已到期请联系提供商续费。','因非法操作已被管理员禁用请联系提供商。','节目读取中  请耐心等待','设备码与绑定的不一致，请联系提供商。',2,3,'                                                                                                                5G云-骆驼壳授权版或无授权都是带后台的请勿轻易相信他人，正版购买渠道请联系QQ：26206960。\r\n',1,'13ae41c997b396765bd57e3f8786dbf7',1);
/*!40000 ALTER TABLE `chzb_appdata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chzb_category`
--

DROP TABLE IF EXISTS `chzb_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chzb_category` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `isprov` tinyint(4) NOT NULL DEFAULT '0',
  `canseek` tinyint(4) NOT NULL DEFAULT '0',
  `enable` tinyint(4) NOT NULL DEFAULT '1',
  `updateurl` varchar(500) DEFAULT '',
  `psw` varchar(16) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chzb_category`
--

LOCK TABLES `chzb_category` WRITE;
/*!40000 ALTER TABLE `chzb_category` DISABLE KEYS */;
INSERT INTO `chzb_category` VALUES (103,'精彩轮播',0,0,1,'',''),(102,'卫视频道',0,0,1,'',''),(101,'央视频道',0,0,1,'',''),(104,'快进分类',0,0,1,'',''),(105,'密码分类',0,0,1,'','13800');
/*!40000 ALTER TABLE `chzb_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chzb_category_cc`
--

DROP TABLE IF EXISTS `chzb_category_cc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chzb_category_cc` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `isprov` tinyint(4) NOT NULL DEFAULT '0',
  `canseek` tinyint(4) NOT NULL DEFAULT '0',
  `enable` tinyint(4) NOT NULL DEFAULT '1',
  `updateurl` varchar(500) DEFAULT '',
  `psw` varchar(16) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chzb_category_cc`
--

LOCK TABLES `chzb_category_cc` WRITE;
/*!40000 ALTER TABLE `chzb_category_cc` DISABLE KEYS */;
INSERT INTO `chzb_category_cc` VALUES (51,'央视频道',0,0,1,'',''),(52,'卫视频道',0,0,1,'','');
/*!40000 ALTER TABLE `chzb_category_cc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chzb_category_dx`
--

DROP TABLE IF EXISTS `chzb_category_dx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chzb_category_dx` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `isprov` tinyint(4) NOT NULL DEFAULT '0',
  `canseek` tinyint(4) NOT NULL DEFAULT '0',
  `enable` tinyint(4) NOT NULL DEFAULT '1',
  `updateurl` varchar(500) DEFAULT '',
  `psw` varchar(16) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chzb_category_dx`
--

LOCK TABLES `chzb_category_dx` WRITE;
/*!40000 ALTER TABLE `chzb_category_dx` DISABLE KEYS */;
INSERT INTO `chzb_category_dx` VALUES (51,'电信专区',0,0,1,'','');
/*!40000 ALTER TABLE `chzb_category_dx` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chzb_category_jw`
--

DROP TABLE IF EXISTS `chzb_category_jw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chzb_category_jw` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `isprov` tinyint(4) NOT NULL DEFAULT '0',
  `canseek` tinyint(4) NOT NULL DEFAULT '0',
  `enable` tinyint(4) NOT NULL DEFAULT '1',
  `updateurl` varchar(500) DEFAULT '',
  `psw` varchar(16) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chzb_category_jw`
--

LOCK TABLES `chzb_category_jw` WRITE;
/*!40000 ALTER TABLE `chzb_category_jw` DISABLE KEYS */;
INSERT INTO `chzb_category_jw` VALUES (51,'隐藏节目',0,0,1,'','');
/*!40000 ALTER TABLE `chzb_category_jw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chzb_category_lt`
--

DROP TABLE IF EXISTS `chzb_category_lt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chzb_category_lt` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `isprov` tinyint(4) NOT NULL DEFAULT '0',
  `canseek` tinyint(4) NOT NULL DEFAULT '0',
  `enable` tinyint(4) NOT NULL DEFAULT '1',
  `psw` varchar(16) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chzb_category_lt`
--

LOCK TABLES `chzb_category_lt` WRITE;
/*!40000 ALTER TABLE `chzb_category_lt` DISABLE KEYS */;
INSERT INTO `chzb_category_lt` VALUES (51,'联通专区',0,0,1,'');
/*!40000 ALTER TABLE `chzb_category_lt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chzb_category_qw`
--

DROP TABLE IF EXISTS `chzb_category_qw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chzb_category_qw` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `isprov` tinyint(4) NOT NULL DEFAULT '0',
  `canseek` tinyint(4) NOT NULL DEFAULT '0',
  `enable` tinyint(4) NOT NULL DEFAULT '1',
  `updateurl` varchar(500) DEFAULT '',
  `psw` varchar(16) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chzb_category_qw`
--

LOCK TABLES `chzb_category_qw` WRITE;
/*!40000 ALTER TABLE `chzb_category_qw` DISABLE KEYS */;
/*!40000 ALTER TABLE `chzb_category_qw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chzb_category_sl`
--

DROP TABLE IF EXISTS `chzb_category_sl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chzb_category_sl` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `isprov` tinyint(4) NOT NULL DEFAULT '0',
  `canseek` tinyint(4) NOT NULL DEFAULT '0',
  `enable` tinyint(4) NOT NULL DEFAULT '1',
  `updateurl` varchar(500) DEFAULT '',
  `psw` varchar(16) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chzb_category_sl`
--

LOCK TABLES `chzb_category_sl` WRITE;
/*!40000 ALTER TABLE `chzb_category_sl` DISABLE KEYS */;
INSERT INTO `chzb_category_sl` VALUES (154,'重庆',0,0,1,'',''),(160,'河南',0,0,1,'',''),(155,'广东',0,0,1,'',''),(156,'湖北',0,0,1,'',''),(157,'河北',0,0,1,'',''),(158,'安徽',0,0,1,'',''),(159,'江西',0,0,1,'',''),(179,'黑龙江',0,0,1,'',''),(152,'天津',0,0,1,'',''),(153,'上海',0,0,1,'',''),(161,'山西',0,0,1,'',''),(162,'吉林',0,0,1,'',''),(163,'江苏',0,0,1,'',''),(164,'福建',0,0,1,'',''),(166,'海南',0,0,1,'',''),(167,'贵州',0,0,1,'',''),(169,'云南',0,0,1,'',''),(171,'陕西',0,0,1,'',''),(175,'西藏',0,0,1,'',''),(173,'宁夏',0,0,1,'',''),(178,'内蒙古',0,0,1,'',''),(151,'北京',0,0,1,'',''),(165,'湖南',0,0,1,'',''),(172,'广西',0,0,1,'',''),(174,'甘肃',0,0,1,'',''),(176,'浙江',0,0,1,'',''),(177,'新疆',0,0,1,'',''),(170,'山东',0,0,1,'',''),(168,'四川',0,0,1,'','');
/*!40000 ALTER TABLE `chzb_category_sl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chzb_category_yd`
--

DROP TABLE IF EXISTS `chzb_category_yd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chzb_category_yd` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `isprov` tinyint(4) NOT NULL DEFAULT '0',
  `canseek` tinyint(4) NOT NULL DEFAULT '0',
  `enable` tinyint(4) NOT NULL DEFAULT '1',
  `updateurl` varchar(500) DEFAULT '',
  `psw` varchar(16) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chzb_category_yd`
--

LOCK TABLES `chzb_category_yd` WRITE;
/*!40000 ALTER TABLE `chzb_category_yd` DISABLE KEYS */;
INSERT INTO `chzb_category_yd` VALUES (51,'移动专区',0,0,1,'','');
/*!40000 ALTER TABLE `chzb_category_yd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chzb_channels`
--

DROP TABLE IF EXISTS `chzb_channels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chzb_channels` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(600) DEFAULT NULL,
  `category` varchar(16) NOT NULL,
  `nettype` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chzb_channels`
--

LOCK TABLES `chzb_channels` WRITE;
/*!40000 ALTER TABLE `chzb_channels` DISABLE KEYS */;
INSERT INTO `chzb_channels` VALUES (1,'CCTV-1HD','http://124.90.32.171:6610/zjhs/2/10079/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(2,'CCTV-2','http://124.90.32.171:6610/zjhs/2/10063/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(3,'CCTV-3HD','http://124.90.32.171:6610/zjhs/2/10069/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(4,'CCTV-4','http://124.90.32.171:6610/zjhs/2/10074/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(5,'CCTV-5HD','http://124.90.32.171:6610/zjhs/2/10076/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(6,'CCTV-6HD','http://124.90.32.171:6610/zjhs/2/10066/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(7,'CCTV-7HD','http://124.90.32.171:6610/zjhs/2/10067/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(8,'CCTV-8HD','http://124.90.32.171:6610/zjhs/2/10062/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(9,'CCTV-9HD','http://124.90.32.171:6610/zjhs/2/10064/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(10,'CCTV-10HD','http://124.90.32.171:6610/zjhs/2/10072/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(11,'CCTV-11','http://124.90.32.171:6610/zjhs/2/10073/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(12,'CCTV-12HD','http://124.90.32.171:6610/zjhs/2/10071/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(13,'CCTV-13','http://124.90.32.171:6610/zjhs/2/10077/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(14,'CCTV-14HD','http://124.90.32.171:6610/zjhs/2/10070/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(15,'CCTV-15','http://124.90.32.171:6610/zjhs/2/10080/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(16,'CGTN','http://124.90.32.171:6610/zjhs/2/10001/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(17,'CETV-1','http://124.90.32.171:6610/zjhs/2/10060/index.m3u8?virtualDomain=zjhs.live_hls.zte.com','测试','全网'),(40001,'【北京】大头腿短A-','http://tx.hls.huya.com/huyalive/1447464854-1447464854-6216814210039414784-3380531312-10057-A-0-1.m3u8','音乐','通用'),(40002,'往前冲不后悔！','http://tx.hls.huya.com/huyalive/99649346-99649346-427990682137788416-4391351254-10057-A-0-1.m3u8','音乐','通用'),(40003,'舒心弹唱.免费点歌','http://tx.hls.huya.com/huyalive/45148197-45148197-193910029588365312-3041687308-10057-A-0-1.m3u8','音乐','通用'),(40004,'打肿脸充胖子的小改改','http://tx.hls.huya.com/huyalive/1447392918-1447392918-6216505247272009728-4905081468-10057-A-0-1.m3u8','音乐','通用'),(40005,'下午一点工会战求助力~','http://tx.hls.huya.com/huyalive/1421606873-1421606873-6105755027303825408-4624673986-10057-A-0-1.m3u8','音乐','通用'),(40006,'新人直播  求订阅','http://tx.hls.huya.com/huyalive/1199518049877-1199518049877-5249198618446921728-2399036223210-10057-A-0-1.m3u8','音乐','通用'),(40007,'吹拉弹唱 稳中带浪','http://tx.hls.huya.com/huyalive/1199513023263-1199513023263-5227609475707305984-2399026169982-10057-A-0-1.m3u8','音乐','通用'),(40008,'点歌 听歌 24小时开车','http://tx.hls.huya.com/huyalive/1445041942-1445041942-6206407882238328832-2936513980-10057-A-0-1.m3u8','音乐','通用'),(40009,'虎牙章小松','http://tx.hls.huya.com/huyalive/1444589703-1444589703-6204465530523353088-2769696264-10057-A-0-1.m3u8','音乐','通用'),(40010,'生活不易猫猫叹气','http://tx.hls.huya.com/huyalive/1445742089-1445742089-6209414990705721344-4722086356-10057-A-0-1.m3u8','音乐','通用'),(40011,'集梦钱多多歌曲放映厅（关注集梦钱多多）','http://tx.hls.huya.com/huyalive/1447393198-1447393198-6216506449862852608-4774608262-10057-A-0-1.m3u8','音乐','通用'),(40012,'第三天的小可怜','http://tx.hls.huya.com/huyalive/1279513351011-1279513351011-16785007495876706304-2559026825478-10057-A-0-1.m3u8','音乐','通用'),(40013,'愿你能找到你想要的声音','http://tx.hls.huya.com/huyalive/1445260798-1445260798-6207347861600862208-4552537756-10057-A-0-1.m3u8','音乐','通用'),(40014,'单眼皮就单眼皮','http://tx.hls.huya.com/huyalive/1199518064335-1199518064335-5249260715084087296-2399036252126-10057-A-0-1.m3u8','音乐','通用'),(40015,'歌曲点一点，每天都开心','http://tx.hls.huya.com/huyalive/36715741-36715741-157692906843406336-3473657388-10057-A-0-1.m3u8','音乐','通用'),(40016,'宇宙最菜猴子','http://tx.hls.huya.com/huyalive/1444298230-1444298230-6203213663520686080-3124644262-10057-A-0-1.m3u8','音乐','通用'),(40017,'失眠的可以进来看看，兴许可以睡着','http://tx.hls.huya.com/huyalive/1199514067346-1199514067346-5232093778046615552-2399028258148-10057-A-0-1.m3u8','音乐','通用'),(40018,'欢迎来到自由人吉他教师的直播间','http://tx.hls.huya.com/huyalive/1420589261-1420589261-6101384417043808256-4552662718-10057-A-0-1.m3u8','音乐','通用'),(40019,'玩的就是心态','http://tx.hls.huya.com/huyalive/1199514732869-1199514732869-5234952177566351360-2399029589194-10057-A-0-1.m3u8','音乐','通用'),(40020,'都累了，进小弟直播间歇歇脚','http://tx.hls.huya.com/huyalive/70367028-70367028-302224083976716288-2272052034-10057-A-0-1.m3u8','音乐','通用'),(40021,'今夜你遇见了我','http://tx.hls.huya.com/huyalive/1199514071848-1199514071848-5232113113989382144-2399028267152-10057-A-0-1.m3u8','音乐','通用'),(40022,'不要标题了','http://tx.hls.huya.com/huyalive/1444177071-1444177071-6202693289578070016-174816808-10057-A-0-1.m3u8','音乐','通用'),(40023,'欢迎来到煜然的直播间','http://tx.hls.huya.com/huyalive/1199512872349-1199512872349-5226961305012797440-2399025868154-10057-A-0-1.m3u8','音乐','通用'),(40024,'主播心情不好，不想说话，请见谅。','http://tx.hls.huya.com/huyalive/1199514072204-1199514072204-5232114642997739520-2399028267864-10057-A-0-1.m3u8','音乐','通用'),(40025,'试下效果','http://tx.hls.huya.com/huyalive/1446738035-1446738035-6213692546204303360-2945970990-10057-A-0-1.m3u8','音乐','通用'),(40026,'欢迎来到安琪家的【L】的直播间','http://tx.hls.huya.com/huyalive/1199518139372-1199518139372-5249582996545077248-2399036402200-10057-A-0-1.m3u8','音乐','通用'),(40027,'欢迎来到中华的直播间','http://tx.hls.huya.com/huyalive/1199515445594-1199515445594-5238013308132392960-2399031014644-10057-A-0-1.m3u8','音乐','通用'),(40028,'大赫师兄的吉他教室的直播间','http://tx.hls.huya.com/huyalive/1421430185-1421430185-0-4476007014-10057-A-1534066022-1.m3u8','音乐','通用'),(40029,'欢迎来到自由人吉他教室的直播间','http://tx.hls.huya.com/huyalive/1420234773-1420234773-6099861902676983808-3659283928-10057-A-0-1.m3u8','音乐','通用'),(40001,'苏昕','http://app.iptv888.top/yy.php?ts=22490906','舞蹈','通用'),(40002,'「 C + 」兔子    赠我深爱与久伴','http://app.iptv888.top/yy.php?ts=36583202','舞蹈','通用'),(40003,'美仙*仙之灵肚皮舞','http://app.iptv888.top/yy.php?ts=1353157279','舞蹈','通用'),(40004,'988蓉儿','http://app.iptv888.top/yy.php?ts=1353114865','舞蹈','通用'),(40005,'毕徒奈奈酱','http://app.iptv888.top/yy.php?ts=39781079','舞蹈','通用'),(40006,'【Z宇】陈姝妍','http://app.iptv888.top/yy.php?ts=27513385','舞蹈','通用'),(40007,'燃舞蹈-小脸脸','http://app.iptv888.top/yy.php?ts=1353021431','舞蹈','通用'),(40008,'邸家、小胖卿，卿妆','http://app.iptv888.top/yy.php?ts=35981198','舞蹈','通用'),(40009,'宠儿','http://app.iptv888.top/yy.php?ts=51109787','舞蹈','通用'),(40010,'【澳音】木子 - 抗揍挨饿主播','http://app.iptv888.top/yy.php?ts=1353020804','舞蹈','通用'),(40011,'阿樂','http://app.iptv888.top/yy.php?ts=1353427661','舞蹈','通用'),(40012,'8519小乔','http://app.iptv888.top/yy.php?ts=38306125','舞蹈','通用'),(40013,'花魂','http://app.iptv888.top/yy.php?ts=1353252502','舞蹈','通用'),(40014,'8999曾好','http://app.iptv888.top/yy.php?ts=50896445','舞蹈','通用'),(40015,'「 C + 」酷野青.','http://app.iptv888.top/yy.php?ts=26583560','舞蹈','通用'),(40016,'舞帝✦.小天使 聊天终结者','http://app.iptv888.top/yy.php?ts=1353062190','舞蹈','通用'),(40017,'小尾巴','http://app.iptv888.top/yy.php?ts=34966321','舞蹈','通用'),(40018,'利徒夕儿','http://app.iptv888.top/yy.php?ts=1421176280','舞蹈','通用'),(40019,'1900D舞团','http://app.iptv888.top/yy.php?ts=13088230','舞蹈','通用'),(40020,'7038小十六','http://app.iptv888.top/yy.php?ts=1346199265','舞蹈','通用'),(40021,'羽希','http://app.iptv888.top/yy.php?ts=35300446','舞蹈','通用'),(40022,'◣热度◥十二','http://app.iptv888.top/yy.php?ts=1453712546','舞蹈','通用'),(40023,'【艺珈】多宝    感恩❤️珍惜','http://app.iptv888.top/yy.php?ts=25455352','舞蹈','通用'),(40024,'▶ iＲ◀金子  饿饿饿 求团宠','http://app.iptv888.top/yy.php?ts=1332317623','舞蹈','通用'),(40025,'青岛程宝er','http://app.iptv888.top/yy.php?ts=1352856560','舞蹈','通用'),(40026,'小蜜兔','http://app.iptv888.top/yy.php?ts=78569422','舞蹈','通用'),(40027,'陈九儿','http://app.iptv888.top/yy.php?ts=1353061754','舞蹈','通用'),(40028,'【炎帝】蚊子','http://app.iptv888.top/yy.php?ts=28901322','舞蹈','通用'),(40029,'花花','http://app.iptv888.top/yy.php?ts=21248146','舞蹈','通用'),(40030,'橙CC','http://app.iptv888.top/yy.php?ts=1351560824','舞蹈','通用'),(40031,'【华星921】艾萌战为华星','http://app.iptv888.top/yy.php?ts=1453615111','舞蹈','通用'),(40032,'【驼仁】萤心.新主播招大哥','http://app.iptv888.top/yy.php?ts=26598226','舞蹈','通用'),(40033,'【星创】小团子','http://app.iptv888.top/yy.php?ts=37335825','舞蹈','通用'),(40034,'84花樣少年-小新','http://app.iptv888.top/yy.php?ts=1353035414','舞蹈','通用'),(40035,'243丫丫','http://app.iptv888.top/yy.php?ts=24398910','舞蹈','通用'),(40036,'心悦曼曼','http://app.iptv888.top/yy.php?ts=27670727','舞蹈','通用'),(40037,'【羽翼】♢小不点~【热舞】','http://app.iptv888.top/yy.php?ts=36756689','舞蹈','通用'),(40038,'上官雨涵','http://app.iptv888.top/yy.php?ts=1351689967','舞蹈','通用'),(40039,'【L&Y】小丸子【虾滑】','http://app.iptv888.top/yy.php?ts=1353208641','舞蹈','通用'),(40040,'【热点】小UU','晚点播 爱你们','舞蹈','通用'),(40041,'梦梦','http://app.iptv888.top/yy.php?ts=27670927','舞蹈','通用'),(40042,'音豪@当当','http://app.iptv888.top/yy.php?ts=35348928','舞蹈','通用'),(40043,'TZ骆小芊','http://app.iptv888.top/yy.php?ts=21166806','舞蹈','通用'),(40044,'乐小小','http://app.iptv888.top/yy.php?ts=38887429','舞蹈','通用'),(40045,'嘉艺 佳佳( 早6下5开）','http://app.iptv888.top/yy.php?ts=37962641','舞蹈','通用'),(40046,'喵喵呜','http://app.iptv888.top/yy.php?ts=65227785','舞蹈','通用'),(40047,'成都美宝宝','http://app.iptv888.top/yy.php?ts=1351831592','舞蹈','通用'),(40048,'燃舞蹈-奎奎','http://app.iptv888.top/yy.php?ts=1353006769','舞蹈','通用'),(40049,'小honey','http://app.iptv888.top/yy.php?ts=1353146569','舞蹈','通用'),(40050,'昊宇-洣露','http://app.iptv888.top/yy.php?ts=21158106','舞蹈','通用'),(40051,'可可','http://app.iptv888.top/yy.php?ts=35125889','舞蹈','通用'),(40052,'988奈奈','http://app.iptv888.top/yy.php?ts=1353395822','舞蹈','通用'),(40053,'243小AA','http://app.iptv888.top/yy.php?ts=24386315','舞蹈','通用'),(40054,'妃儿','http://app.iptv888.top/yy.php?ts=39163853','舞蹈','通用'),(40055,'1076妖儿','http://app.iptv888.top/yy.php?ts=30749944','舞蹈','通用'),(40056,'燃舞蹈-甜品悦','http://app.iptv888.top/yy.php?ts=1349220760','舞蹈','通用'),(40057,'莘可~加油','http://app.iptv888.top/yy.php?ts=1350740025','舞蹈','通用'),(40058,'Dz绒绒','http://app.iptv888.top/yy.php?ts=24609888','舞蹈','通用'),(40059,'243小白白','http://app.iptv888.top/yy.php?ts=55196736','舞蹈','通用'),(40060,'951蜜仙','http://app.iptv888.top/yy.php?ts=1353212353','舞蹈','通用'),(40001,'最强走A， 摇就完事了。','http://tx.hls.huya.com/huyalive/1446426106-1446426106-6212352821350629376-3217726716-10057-A-0-1.m3u8','英雄联盟','通用'),(40002,'峡谷之巅  都想一步登天想要升仙','http://tx.hls.huya.com/huyalive/1445918690-1445918690-6210173486225162240-419423656-10057-A-0-1.m3u8','英雄联盟','通用'),(40003,'峡谷第一现在是女枪！~','http://tx.hls.huya.com/huyalive/90544985-2694051026-11570861050425245696-2332299696-10057-A-0-1.m3u8','英雄联盟','通用'),(40004,'国服祖安大区排位上分','http://tx.hls.huya.com/huyalive/67732491-2739557660-11766310555206287360-204758826-10057-A-0-1.m3u8','英雄联盟','通用'),(40005,'求接生呀~：天才棋手~十把九吃鸡~','http://tx.hls.huya.com/huyalive/23379374-23379374-100413646730952704-2908907584-10057-A-0-1.m3u8','英雄联盟','通用'),(40006,'成都小可爱，五杀送奖励','http://tx.hls.huya.com/huyalive/54002494-2703199382-11610152940257411072-2618712900-10057-A-0-1.m3u8','英雄联盟','通用'),(40007,'黑色小姐姐在线超神，一起玩~','http://tx.hls.huya.com/huyalive/1199518338920-1199518338920-5250440048679059456-2399036801296-10057-A-0-1.m3u8','英雄联盟','通用'),(40008,'河南小姐姐 排位冲鸭','http://tx.hls.huya.com/huyalive/1445831153-1445831153-6209797517672972288-2722942712-10057-A-0-1.m3u8','英雄联盟','通用'),(40009,'人美声甜技术好','http://tx.hls.huya.com/huyalive/94956579-94956579-407835401345040384-250330484-10057-A-0-1.m3u8','英雄联盟','通用'),(40010,'EMM..头铁的女娃娃！日常犯憨','http://tx.hls.huya.com/huyalive/1444707454-1444707454-6204971267217424384-3640356436-10057-A-0-1.m3u8','英雄联盟','通用'),(40011,'艾欧尼亚 是你的治愈系小姐姐丫~','http://tx.hls.huya.com/huyalive/77259038-2733161202-11738837977286049792-4784851762-10057-A-0-1.m3u8','英雄联盟','通用'),(40012,'黑色玫瑰排位最甜主播开车啦~','http://tx.hls.huya.com/huyalive/1446651336-1446651336-6213320176834707456-3594503488-10057-A-0-1.m3u8','英雄联盟','通用'),(40013,'你的女朋友已上线~~黑色湖北人一起玩','http://tx.hls.huya.com/huyalive/95431869-2566096402-11021300124973268992-3275185562-10057-A-0-1.m3u8','英雄联盟','通用'),(40014,'努力搬砖哈哈哈嗝~','http://tx.hls.huya.com/huyalive/20761025-2658301644-11417318623883034624-2212554572-10057-A-0-1.m3u8','英雄联盟','通用'),(40015,'最菜金克斯   在线坑队友','http://tx.hls.huya.com/huyalive/1199516787298-1199516787298-5243775882933305344-2399033698052-10057-A-0-1.m3u8','英雄联盟','通用'),(40016,'一起上王者。陪玩小姐姐一起下棋','http://tx.hls.huya.com/huyalive/49077963-2744366548-11786964571896414208-3512252926-10057-A-0-1.m3u8','英雄联盟','通用'),(40017,'花季少女野区被几个大汉轮番暴打，速来围观','http://tx.hls.huya.com/huyalive/74595331-74595331-320384507079294976-3162793124-10057-A-0-1.m3u8','英雄联盟','通用'),(40018,'世界顶尖锐雯教学全村的希望','http://tx.hls.huya.com/huyalive/25861055-25861055-111072385465057280-3227214786-10057-A-0-1.m3u8','英雄联盟','通用'),(40019,'黑色玫瑰 心里的小花朵在线等基友一起玩.','http://tx.hls.huya.com/huyalive/1447051388-1447051388-6215038387091406848-4789649360-10057-A-0-1.m3u8','英雄联盟','通用'),(40020,'云顶最强讲师：教你套路为王，可劲儿狂！','http://tx.hls.huya.com/huyalive/1448001286-1448001286-6219118167935942656-3190837784-10057-A-0-1.m3u8','英雄联盟','通用'),(40021,'云顶之弈最温柔的小姐姐~','http://tx.hls.huya.com/huyalive/1444799763-1444799763-6205367731353550848-2489881522-10057-A-0-1.m3u8','英雄联盟','通用'),(40022,'大明棋圣冲榜','http://tx.hls.huya.com/huyalive/1350724977-1350724977-5801319602105352192-160546386-10057-A-0-1.m3u8','英雄联盟','通用'),(40023,'江西小姐姐~黑色1血瓶上车 一起玩','http://tx.hls.huya.com/huyalive/16642925-2596701908-11152749772320800768-2799655866-10057-A-0-1.m3u8','英雄联盟','通用'),(40024,'黑玫的同学开黑陪你一起玩','http://tx.hls.huya.com/huyalive/1199517026235-1199517026235-5244802109534109696-2399034175926-10057-A-0-1.m3u8','英雄联盟','通用'),(40025,'黑色玫瑰白银组排3=2一起玩啊！','http://tx.hls.huya.com/huyalive/29943559-2750285532-11812386414601961472-4742945426-10057-A-0-1.m3u8','英雄联盟','通用'),(40026,'守望之海，江西妹纸一起玩嘛~','http://tx.hls.huya.com/huyalive/1420039287-1420039287-6099022296700157952-4511022330-10057-A-0-1.m3u8','英雄联盟','通用'),(40027,'英雄联盟S系列赛回顾','http://tx.hls.huya.com/huyalive/78941969-2639449916-11336351068649947136-3232648604-10057-A-0-1.m3u8','英雄联盟','通用'),(40028,'黑色玫瑰有车位一起玩~多看我会儿我耐看！','http://tx.hls.huya.com/huyalive/95431869-2584042900-11098379746960998400-513402600-10057-A-0-1.m3u8','英雄联盟','通用'),(40029,'云顶之弈（黑色玫瑰排位）第一执棋者','http://tx.hls.huya.com/huyalive/8867170-8867170-38084205158072320-130817000-10057-A-0-1.m3u8','英雄联盟','通用'),(40030,'广州第一凯隐独创思路天赋打法野区教学！','http://tx.hls.huya.com/huyalive/1420140626-1420140626-6099457544390967296-4549554806-10057-A-0-1.m3u8','英雄联盟','通用'),(40001,'CCTV1','http://bytedance.hdllive.ks-cdn.com/live/369ef5291b9e48ae9aac44c34326edcb.flv','中央频道','通用'),(40002,'CCTV2','http://bytedance.hdllive.ks-cdn.com/live/channel6594136eac3a48b7bef68a1383516016.flv','中央频道','通用'),(40003,'CCTV3','http://bytedance.hdllive.ks-cdn.com/live/346d9456f18845a3b6f0bb1e611a34a5.flv','中央频道','通用'),(40004,'CCTV4','http://bytedance.hdllive.ks-cdn.com/live/channela9dd1ec8e14a4e12833aab819875b625.flv','中央频道','通用'),(40005,'体育节目','http://bytedance.hdllive.ks-cdn.com/live/47e5d535cee74657a8be23b8153f1532.flv','中央频道','通用'),(40006,'CCTV6HD','http://hlslive2.ks-cdn.m1905.com/live/LIVEQYR8M567KGOXO.flv','中央频道','通用'),(40007,'CCTV7','http://bytedance.hdllive.ks-cdn.com/live/channel2465c27ed2254e5b871655575deb7e35.flv','中央频道','通用'),(40008,'CCTV8','http://bytedance.hdllive.ks-cdn.com/live/818f51fce6e64d00abc76a9a02e1cdf0.flv','中央频道','通用'),(40009,'CCTV9','http://bytedance.hdllive.ks-cdn.com/live/channel1d6b909ea1f74c8bb8884d052bd64784.flv','中央频道','通用'),(40010,'CCTV10','http://bytedance.hdllive.ks-cdn.com/live/channeld0a5f05dc554416e8370a8e818831e69.flv','中央频道','通用'),(40011,'CCTV11','http://bytedance.hdllive.ks-cdn.com/live/channel8cd15bcb28be4a9eae2a62937ed56966.flv','中央频道','通用'),(40012,'CCTV12','http://bytedance.hdllive.ks-cdn.com/live/channeld2b7c3a8fb8f4aa387f759d1570d400f.flv','中央频道','通用'),(40013,'CCTV13','http://bytedance.hdllive.ks-cdn.com/live/channel2bf888c4938341599bbbee6825e8685d.flv','中央频道','通用'),(40014,'CCTV14','http://bytedance.hdllive.ks-cdn.com/live/channel6007cc587307490781ed6e9c6bc12ff4.flv','中央频道','通用'),(40015,'CCTV15','http://bytedance.hdllive.ks-cdn.com/live/channelcaa3153106ac405d8ad3ad0a02bc491f.flv','中央频道','通用'),(40016,'CCTV-5+','http://qkqxzb.qingk.cn/live/c0591dc2a31e49dcbe71d4a71674311e.flv','中央频道','通用'),(40017,'新华社中文','http://live.xinhuashixun.com/live/chn01.flv','中央频道','通用'),(40018,'新华社英文','http://live.xinhuashixun.com/live/chn02.flv','中央频道','通用'),(40001,'快新闻','http://dlhls.live.cnlive.com/cdn/news/playlist.m3u8','轮播节目','通用'),(40002,'E娱乐','http://dlhls.live.cnlive.com/cdn/eyule/playlist.m3u8','轮播节目','通用'),(40003,'@TV','http://dlhls.live.cnlive.com/cdn/liveshow/playlist.m3u8','轮播节目','通用'),(40004,'潮体育','http://dlhls.live.cnlive.com/cdn/chaotiyu/playlist.m3u8','轮播节目','通用'),(40005,'乐台','http://dlhls.live.cnlive.com/cdn/inyuetai/playlist.m3u8','轮播节目','通用'),(40006,'综艺','http://dlhls.live.cnlive.com/cdn/izongyi/playlist.m3u8','轮播节目','通用'),(40007,'车世界','http://dlhls.live.cnlive.com/cdn/cheshijie/playlist.m3u8','轮播节目','通用'),(40008,'中华美食','http://dlhls.live.cnlive.com/cdn/zhonghuameishi/playlist.m3u8','轮播节目','通用'),(40001,'重庆新闻','http://bytedance.hdllive.ks-cdn.com/live/bf08d233e2154647a79a3e63267573b6.flv','地方节目','通用'),(40002,'重庆都市','http://bytedance.hdllive.ks-cdn.com/live/f34e512004604d17b3746726e6be689b.flv','地方节目','通用'),(40003,'重庆时尚','http://bytedance.hdllive.ks-cdn.com/live/34c23e99958141be914b16cf06eb9fa2.flv','地方节目','通用'),(40004,'重庆影视','http://bytedance.hdllive.ks-cdn.com/live/268d1997e9484fd4a693ade141fadf0e.flv','地方节目','通用'),(40005,'重庆科教','http://bytedance.hdllive.ks-cdn.com/live/04980d49f4874402816117087f059082.flv','地方节目','通用'),(40006,'文体娱乐','http://bytedance.hdllive.ks-cdn.com/live/bb47e034a9f1408ab3848da83c8e7b58.flv','地方节目','通用'),(40007,'重庆移动','http://qxlmlive.cbg.cn:1935/app_2/ls_57.stream/chunklist.m3u8','地方节目','通用'),(40008,'重庆公共农村','http://bytedance.hdllive.ks-cdn.com/live/2f4b07a6225841fd92301bf788755609.flv','地方节目','通用'),(40009,'重庆少儿','http://bytedance.hdllive.ks-cdn.com/live/51583af94bed424ebfe0462bb3deefc6.flv','地方节目','通用'),(40010,'重庆手持电视','http://bytedance.hdllive.ks-cdn.com/live/24f4676502974e93a3ff30c9125e9378.flv','地方节目','通用'),(40011,'广东经济科教','http://nclive.grtn.cn/tvs1hd/hd/live.m3u8','地方节目','通用'),(40012,'广东珠江','http://nclive.grtn.cn/zjpd/sd/live.m3u8','地方节目','通用'),(40013,'广东新闻','http://nclive.grtn.cn/xwpd/sd/live.m3u8','地方节目','通用'),(40014,'广东公共','http://nclive.grtn.cn/ggpd/sd/live.m3u8','地方节目','通用'),(40015,'广东房产','http://nclive.grtn.cn/fcpd/sd/live.m3u8','地方节目','通用'),(40016,'广东会展','http://nclive.grtn.cn/qchzpd/sd/live.m3u8','地方节目','通用'),(40017,'广东国际','http://nclive.grtn.cn/gjpd/sd/live.m3u8','地方节目','通用'),(40018,'广东综艺','http://nclive.grtn.cn/4K/sd/live.m3u8','地方节目','通用'),(40019,'广东影视','http://nclive.grtn.cn/tvs4/sd/live.m3u8','地方节目','通用'),(40020,'广东少儿','http://nclive.grtn.cn/tvs5/sd/live.m3u8','地方节目','通用'),(40021,'南方购物','http://nclive.grtn.cn/nfgw/sd/live.m3u8','地方节目','通用'),(40022,'梨园频道','http://qkqxzb.qingk.cn/live/4c6d8fc52c684b0dab87cb764692f820.flv','地方节目','通用'),(40001,'CCTV高尔夫网球','http://qkqxzb.qingk.cn/live/3e50ef19a39d46fdbf6a411273aefce1.flv','体育频道','通用'),(40002,'高尔夫高清','http://8869.liveplay.myqcloud.com/live/8869_2c300dcf20d911e791eae435c87f075e.m3u8','体育频道','通用'),(40003,'广东体育','http://bytedance.hdllive.ks-cdn.com/live/15971c48b3b7466f85a0907117628afb.flv','体育频道','通用'),(40004,'新视觉','http://hlslive2.ks-cdn.m1905.com/live/channel5a47e73304f24e128542000a09ae90ee.flv','体育频道','通用'),(1,'今日 扫黑“下川帮”','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/3e053a0ab04548e48fba992a8cc24774/1200.m3u8','快进分类','全网'),(2,'今日 撞人的大狗','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/3ec638d6f7ce435fa29e3c1b09eaaf7a/1200.m3u8','快进分类','全网'),(3,'今日 我怎么结婚了（下）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/c9d85b53102d46a9bdffd1f43817ee0c/1200.m3u8','快进分类','全网'),(4,'今日 我怎么结婚了（上）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/90267e906abd4574a723106a871b1c77/1200.m3u8','快进分类','全网'),(5,'今日 红河听证','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/2b953aa0e3dd49158a9fbff2693bbcc4/1200.m3u8','快进分类','全网'),(6,'今日 “热心”的村民','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/9949664a14f244fc8368f0706d378767/1200.m3u8','快进分类','全网'),(7,'今日 “警察”找上门','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/1e3cef1755264f0c90844be2736a3eaa/1200.m3u8','快进分类','全网'),(8,'今日 神秘的举报人（下）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/4fb706277e13420b905e0d5a31b65e5c/1200.m3u8','快进分类','全网'),(9,'今日 神秘的举报人（上）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/9cbd132432ae4d95888a35f38e470069/1200.m3u8','快进分类','全网'),(10,'今日 送上门的儿子（下）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/9745e09cebbc4455bc60e88f240de829/1200.m3u8','快进分类','全网'),(11,'今日 送上门的儿子（上）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/9acebecedfb649e2b7c9e98c22f0b664/1200.m3u8','快进分类','全网'),(12,'今日 登在报上的声明','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/0541980e386c4eccbd5c0c71e0bbaa82/1200.m3u8','快进分类','全网'),(13,'今日 特殊“会长”（下）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/26080d8356b14c778edbf4efa728266a/1200.m3u8','快进分类','全网'),(14,'今日 特殊“会长”（上）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/62d3246a648540de99d559a6a507fa39/1200.m3u8','快进分类','全网'),(15,'今日 美容院里的“抗癌药”','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/1cb6f621f8e946fd95d781d7be434929/1200.m3u8','快进分类','全网'),(16,'今日 一堵圈地的墙','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/c23f1b4ad4264aff998e087ee24e10c7/1200.m3u8','快进分类','全网'),(17,'今日 虚实之间（下）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/174f96a8a8954cdc836e41f68f8abb5d/1200.m3u8','快进分类','全网'),(18,'今日 虚实之间（上）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/a438f9003caa4340ac7d7a36342fdbda/1200.m3u8','快进分类','全网'),(19,'今日 香山路上晚七点（下）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/2df53371162e4f41b9368fff2b347431/1200.m3u8','快进分类','全网'),(20,'今日 香山路上晚七点（上）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/3d707ccee57046f8a2c6185803616772/1200.m3u8','快进分类','全网'),(21,'今日 我家“小明星”','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/501cc939e52f4c478b3b8318caee738f/1200.m3u8','快进分类','全网'),(22,'今日 消失在现场','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/5fa65744899542098041e8349fd63fe1/1200.m3u8','快进分类','全网'),(23,'今日 三个女人的梦','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/ec127ccbdd084691b92fd528178fd712/1200.m3u8','快进分类','全网'),(24,'今日 高压线下的吊车','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/5b2dc06a70ae457db8f4e32c18f23950/1200.m3u8','快进分类','全网'),(25,'一线 毒战英雄·奔袭','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/a9d3b624330b4693a88402963222c633/1200.m3u8','快进分类','全网'),(26,'一线 直击现场·无情之情','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/38866d21ec794e96ae176e85c0f2e0f6/1200.m3u8','快进分类','全网'),(27,'一线 特别的一课','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/0ed2e618cf0c44909aa22371dc844d22/1200.m3u8','快进分类','全网'),(28,'一线 立法监督','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/b85bc157bb1645e9a212ec76ba4581b1/1200.m3u8','快进分类','全网'),(29,'一线 一错再错','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/205ad5a528d94f138619655750cbb89a/1200.m3u8','快进分类','全网'),(30,'一线 “如意郎君”','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/98c1f149a009482c8378ef643f6c9f8a/1200.m3u8','快进分类','全网'),(31,'一线 “网络彩票”陷阱','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/f55f38d1dd8e43bb9fea547d078d356a/1200.m3u8','快进分类','全网'),(32,'一线 因何结仇','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/d12ac3cafc894ae988465587469e4b98/1200.m3u8','快进分类','全网'),(33,'一线 崔道植：初心不改','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/18e3da407af346109f294d9d5814fea3/1200.m3u8','快进分类','全网'),(34,'一线 直击现场·密谋者','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/12a4d6ffe04444e498f28a75084b402b/1200.m3u8','快进分类','全网'),(35,'一线 目标“银发族”','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/6227a62edfb749af873d2a38cb9a2eec/1200.m3u8','快进分类','全网'),(36,'一线 局中局','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/1ea3ddd7cd30407a82d1d5b822b26416/1200.m3u8','快进分类','全网'),(37,'新闻 “操场埋尸”案，如何进一步破局？','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/c1bf976c2d89471291a76bf3c632070b/1200.m3u8','快进分类','全网'),(38,'新闻 海绵城市，如何破解城市内涝？','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/0ad2a66044cc4ddab063d93676eb3f94/1200.m3u8','快进分类','全网'),(39,'新闻 人工智能，怎么帮人“找孩子”？','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/44d3cb29908f433da1a40f36a8e67921/1200.m3u8','快进分类','全网'),(40,'新闻 废除以“耗”养医，拿啥养医？','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/15fc24ca791346d0b4831d6683a0b2f8/1200.m3u8','快进分类','全网'),(41,'新闻 四川长宁6.0级地震，应急22小时！','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/2a1d8bb0c819496f9cc94e73dc421f6e/1200.m3u8','快进分类','全网'),(42,'新闻 男童被砸身亡，高空坠物真没办法？','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/26f32f596f6845b6af5966c7c1a6a67c/1200.m3u8','快进分类','全网'),(43,'新闻 开车用手机，该用“猛药”了','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/736c2e870c5142e78150e24f90648980/1200.m3u8','快进分类','全网'),(44,'新闻 科创板，究竟是个什么板？','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/050f558f099545cdaa13e613103a97ed/1200.m3u8','快进分类','全网'),(45,'新闻 防大汛抗大旱，抢大险救大灾！','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/d4f94dc64bef46dbad56cf4f3b58317a/1200.m3u8','快进分类','全网'),(46,'新闻 好事，如何才能办好？','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/0c15e383132342f68f28b1ecf1fa73ec/1200.m3u8','快进分类','全网'),(47,'新闻 从西班牙引渡电信诈骗犯，然后呢？','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/d35cdbb807e041f4b334c70fe668364b/1200.m3u8','快进分类','全网'),(48,'新闻 取消限购限行，新能源汽车如何行？','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/f17e39016c0f400398a1309444641ebf/1200.m3u8','快进分类','全网'),(49,'新闻 5G“发牌”，未来已来？','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/3f8c352a8e6a43f49445fc0f7d2a0f35/1200.m3u8','快进分类','全网'),(50,'新闻 垃圾分类，什么最重要？','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/fc0264021c4f4419a5d16ef05af395a5/1200.m3u8','快进分类','全网'),(51,'新闻 “5G”一商用，我们会怎样？','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/bad335ced4124639bfc5fade5185730e/1200.m3u8','快进分类','全网'),(52,'新闻 民企要平等，法治如何给？','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/9ed6346e62754ee58fa643db28184f05/1200.m3u8','快进分类','全网'),(53,'焦点 上海国际电影节：激发创作活力','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/a959cfec7d084ded88f7c66eed5e225e/1200.m3u8','快进分类','全网'),(54,'焦点 正当防卫：以正对不正','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/7f92811553854923b3692eadc6172288/1200.m3u8','快进分类','全网'),(55,'焦点 重要读本的重要价值','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/6fece7f79db742a18ed136234002f829/1200.m3u8','快进分类','全网'),(56,'焦点 “被冒名”如何解套','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/0bb8dd3cc3664b6bb2417974cc183847/1200.m3u8','快进分类','全网'),(57,'焦点 “被老板”让人烦','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/0c6dde4c21cc4eb1a5e78d42f9c00fa1/1200.m3u8','快进分类','全网'),(58,'焦点 永不熄灭的理想之火','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/169f2f4a08bf468fa30184a3e193e7c3/1200.m3u8','快进分类','全网'),(59,'焦点 共创上合美好明天','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/5e56342ab45e44eabef22d58eb2dae9a/1200.m3u8','快进分类','全网'),(60,'焦点 越走越宽的合作之路','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/08d8353d7efd4e60a7c958ae9deb0975/1200.m3u8','快进分类','全网'),(61,'焦点 舌尖上的安全','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/061a9ecd11f64db383baa10a8f2c0b72/1200.m3u8','快进分类','全网'),(62,'焦点 公益还是生意？','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/dbd6b9dc4499416fbfd50eab2bcd8788/1200.m3u8','快进分类','全网'),(63,'焦点 守正创新','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/40094bc8efef4c70a45939e444c3f8c5/1200.m3u8','快进分类','全网'),(64,'焦点 乡土中国农村系列调查：老郑家的春天','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/1886baf7ca224d8081939976592fca86/1200.m3u8','快进分类','全网'),(65,'焦点 中俄关系迈入新时代','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/1d17bd9f9fde4f74b419fe0ccd716b1a/1200.m3u8','快进分类','全网'),(66,'焦点 从“走出去”到“走进去”','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/8903f8260c9c465383cc972fd90c1a27/1200.m3u8','快进分类','全网'),(67,'焦点 美国对华贸易逆差的背后','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/754413fedb1842dc9226e118750cea44/1200.m3u8','快进分类','全网'),(68,'焦点 明差距','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/1656e1d36f0a477dbd32d324e98f8b6d/1200.m3u8','快进分类','全网'),(69,'焦点 中国为什么行','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/0f2c8ff9720042369a0ae41045eab0ee/1200.m3u8','快进分类','全网'),(70,'焦点 中国为什么行','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/919c6d56724a4d7680491ff46d2b1c0a/1200.m3u8','快进分类','全网'),(71,'焦点 中国为什么行','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/6bb9110a49eb4c76af6c59a0dc1c9ccc/1200.m3u8','快进分类','全网'),(72,'焦点 闲置的机井','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/ea08fb37aaad4cd8ba9dfbb0e3b0553b/1200.m3u8','快进分类','全网'),(73,'焦点 让科技种子扎根沃土','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/7b4b57b0c0ed4de08802b973ef98a944/1200.m3u8','快进分类','全网'),(74,'焦点 祖国','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/2abb2c149d5b49b0ac5dc351cfe97cb7/1200.m3u8','快进分类','全网'),(75,'焦点 数博会“数说”未来','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/ca858eb0676d43f18627dc444e433779/1200.m3u8','快进分类','全网'),(76,'普法 学费（下集）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/20dbfd6347e44d9fb4cc8ca275887154/1200.m3u8','快进分类','全网'),(77,'普法 学费（上集）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/94da503ed8954e01969e96d725cb7f68/1200.m3u8','快进分类','全网'),(78,'普法 四集迷你剧集·进错门遇对人（大结局）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/09078995a3cb40e9b7c8339784aa2e0e/1200.m3u8','快进分类','全网'),(79,'普法 四集迷你剧集·进错门遇对人（第三集）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/3c62d23960854d6a942a79e2a5a23f55/1200.m3u8','快进分类','全网'),(80,'普法 四集迷你剧集·进错门遇对人（第二集）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/adabfdfaba8343b99293edf909879ea7/1200.m3u8','快进分类','全网'),(81,'普法 四集迷你剧集·进错门遇对人（第一集）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/0844b2b8d34541588e0a97cc1e61a952/1200.m3u8','快进分类','全网'),(82,'普法 父亲节特别剧集·谎言的终点（下集）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/adcb26e51d9e465bb45dd14f72c1ed71/1200.m3u8','快进分类','全网'),(83,'普法 父亲节特别剧集·谎言的终点（上集）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/26fa41b2bbaa4992be4bbd7013c0bc70/1200.m3u8','快进分类','全网'),(84,'普法 身世·精编版（大结局）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/3e0eba706c2044d0bbee6bdb4a243b8f/1200.m3u8','快进分类','全网'),(85,'普法 身世·精编版（二）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/666c35524a2146a59844bef23af863bc/1200.m3u8','快进分类','全网'),(86,'普法 身世·精编版（一）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/9bfc93a874e84a6b8f82a64f22834f28/1200.m3u8','快进分类','全网'),(87,'普法 幸福边缘（大结局）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/aceace3645aa45c68cda2c06bdf15fbd/1200.m3u8','快进分类','全网'),(88,'普法 幸福边缘（中集）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/128f9506037945d98a9195b38cfa8436/1200.m3u8','快进分类','全网'),(89,'普法 幸福边缘（上集）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/92582e24bc00424f860d2da1cbbe7535/1200.m3u8','快进分类','全网'),(90,'普法 我要我的“老丫头”精编版（下）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/6d74b49a778c4483857808628dfb1e77/1200.m3u8','快进分类','全网'),(91,'普法 我要我的“老丫头”精编版（上）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/f54e14c6199d44b6b360074edb16112e/1200.m3u8','快进分类','全网'),(92,'普法 凤仙花开·精编版','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/8e536b24af864c4aa25f911efcffdb1a/1200.m3u8','快进分类','全网'),(93,'普法 橱柜里的秘密（下）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/f939e61dfae14f668a98b68d05999dfc/1200.m3u8','快进分类','全网'),(94,'普法 橱柜里的秘密（上）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/61961b1a594e41ac93b3d2dbeda9a381/1200.m3u8','快进分类','全网'),(95,'普法 亲爱的老闺蜜（下集）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/63e947f2fa9f4d95bab9350a4748b2a0/1200.m3u8','快进分类','全网'),(40001,'今日 人在囧途','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/15155c59b1bd4326b33fd8328961bc4e/1200.m3u8','快进分类','通用'),(40002,'今日 虎口脱险','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/5a7a1ea172f444c1aecf908fc758f503/1200.m3u8','快进分类','通用'),(40003,'今日 散落的碎片（下）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/9b3f0cc630e9463395a68c3af0021bfe/1200.m3u8','快进分类','通用'),(40004,'今日 散落的碎片（上）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/653e466c328a4130a61904a11cf52716/1200.m3u8','快进分类','通用'),(40005,'今日 “宝妈”的减肥陷阱','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/ee76e910d9004d48bc0a31b8b1097f75/1200.m3u8','快进分类','通用'),(40006,'今日 神秘截图','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/34353881368f4cffb5dca5f5ab84d407/1200.m3u8','快进分类','通用'),(40007,'今日 “化妆”的化妆品','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/380f0fccbd1b42eba92eff13f7a70ec7/1200.m3u8','快进分类','通用'),(40008,'今日 网上开庭','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/f6ce34f17fc048f3b96e3d600249834f/1200.m3u8','快进分类','通用'),(40009,'今日 一步一陷阱','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/047977ed266d4c81abb2ae8a6d78f7be/1200.m3u8','快进分类','通用'),(40010,'今日 真高铁','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/b6610f03e88a4192afcb4b4580bd9088/1200.m3u8','快进分类','通用'),(40011,'今日 两个丈夫的争夺（下）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/0664a699d41543a79d8c39a208840de8/1200.m3u8','快进分类','通用'),(40012,'今日 两个丈夫的争夺（上）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/d40d190cb8ee47d49cf653609b34e2b0/1200.m3u8','快进分类','通用'),(40013,'今日 另类玩家','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/c27c36d2e9aa4d499b6d33bec6c07b6d/1200.m3u8','快进分类','通用'),(40014,'今日 破解“催收心经”（下）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/84846cd5feed4adba0dac7717cd86080/1200.m3u8','快进分类','通用'),(40015,'今日 破解“催收心经”（上）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/fc666735083a4a829d56e5c4c36c3606/1200.m3u8','快进分类','通用'),(40016,'今日 “完美”作案','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/fa3ec01a801a4a8790d946a9d875c7bd/1200.m3u8','快进分类','通用'),(40017,'今日 追踪“毒咖啡”','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/3e47c2717c3b4d1e892f7a39f8fd2c03/1200.m3u8','快进分类','通用'),(40018,'今日 起底“杀猪盘”','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/bc0d7e3838c346718b3342374a540f49/1200.m3u8','快进分类','通用'),(40019,'今日 古墓盗洞','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/6f5a85ac2d22414b9f8973e5b5cfde5d/1200.m3u8','快进分类','通用'),(40020,'今日 特殊会见（下）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/3996f53c46904cad877fd1fefdf1c5f5/1200.m3u8','快进分类','通用'),(40021,'今日 特殊会见（上）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/64691bdaf7f0450ca8545312f4665f50/1200.m3u8','快进分类','通用'),(40022,'今日 古法熬制的秘方','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/eabfafd1465d46c883b24c4cfdc4c96c/1200.m3u8','快进分类','通用'),(40023,'今日 车祸中的尿毒症患者','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/052ca135a589469e8484710886b6f72e/1200.m3u8','快进分类','通用'),(40024,'今日 生死时刻大巴山','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/b4a9a22fad194b88819f1ff7a5589a13/1200.m3u8','快进分类','通用'),(40025,'一线 毒战英雄·探查','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/fc92a6b80c134d1c86f5c6afd6f6f576/1200.m3u8','快进分类','通用'),(40026,'一线 毒战英雄·奔袭','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/210dd8373f7f474c91a3b612973d98fd/1200.m3u8','快进分类','通用'),(40027,'一线 二人行','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/e1d9d316d3914edeb11c09169be4a484/1200.m3u8','快进分类','通用'),(40028,'一线 网红的秘方','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/47a019bf23f84b82a6a9c1f4025c1738/1200.m3u8','快进分类','通用'),(40029,'一线 共同主犯','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/672ef4683ace4b708047f3e1fb140951/1200.m3u8','快进分类','通用'),(40030,'一线 401号客房','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/e97eda44a2bd4714a9ebac4dabbe5cfc/1200.m3u8','快进分类','通用'),(40031,'一线 贷入陷阱','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/b890c23e01de41d0b9931cde84da92c9/1200.m3u8','快进分类','通用'),(40032,'一线 投资梦碎','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/0d2436f84ca84c05833ce7bfbda14aaa/1200.m3u8','快进分类','通用'),(40033,'一线 追捕“跑山人”','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/44a2bad0be71421a8fcee04cad345c48/1200.m3u8','快进分类','通用'),(40034,'一线 我的贪玩“女友”','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/9e787bde551b47e29fca0586aded83c6/1200.m3u8','快进分类','通用'),(40035,'一线 裁判者·法治的初心','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/92732ea40c8d4bb699a754e190bde0ae/1200.m3u8','快进分类','通用'),(40036,'一线 裁判者·空前的挑战','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/7c41bd5786034439bd7c9da7b35ef6a5/1200.m3u8','快进分类','通用'),(20001,'野生世界（下）','http://hls.cntv.qingcdn.com/asp/hls/1200/0303000a/3/default/3922d178d5a5416d8a4d1427f58ff17e/1200.m3u8','联通专区','联通'),(20002,'野生世界（上）','http://hls.cntv.qingcdn.com/asp/hls/1200/0303000a/3/default/53b19b6407a1471bbcede76a35acb7ee/1200.m3u8','联通专区','联通'),(40001,'浙江卫视高清','http://ivi.bupt.edu.cn/hls/zjhd.m3u8','卫视频道','通用'),(40002,'江苏卫视高清','http://ivi.bupt.edu.cn/hls/jshd.m3u8','卫视频道','通用'),(40003,'东方卫视高清','http://ivi.bupt.edu.cn/hls/dfhd.m3u8','卫视频道','通用'),(20001,'野生世界（下）','http://hls.cntv.qingcdn.com/asp/hls/1200/0303000a/3/default/3922d178d5a5416d8a4d1427f58ff17e/1200.m3u8','电信专区','电信'),(20002,'野生世界（上）','http://hls.cntv.qingcdn.com/asp/hls/1200/0303000a/3/default/53b19b6407a1471bbcede76a35acb7ee/1200.m3u8','电信专区','电信'),(40001,'今日 非常合伙人','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/06d58ec939ae4ce4be877f702f991909/1200.m3u8','央视栏目','通用'),(40002,'今日 雨城之夜','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/d0aa324f14744863a7a6f4caf8e44afe/1200.m3u8','央视栏目','通用'),(40003,'今日 越还越多的债','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/59c3ce85bb494ee7854bebbe19dd33a8/1200.m3u8','央视栏目','通用'),(40004,'今日 贼后有贼','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/77a1c14ed52a47f5976a858387557727/1200.m3u8','央视栏目','通用'),(40005,'今日 不懈追踪','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/07245b91bd854a24bb0c8d9e5a8d3123/1200.m3u8','央视栏目','通用'),(40006,'今日 谜一样的未婚夫','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/36141d75b79c434f99a9ffa5c7398b5c/1200.m3u8','央视栏目','通用'),(40007,'今日 儿子下了“逐客令”','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/c2c484d014ef40519af419dce150af9c/1200.m3u8','央视栏目','通用'),(40008,'今日 心瘾','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/0e2ef5bfb29245908d7789eb1c2e9779/1200.m3u8','央视栏目','通用'),(40009,'今日 “机”不可失','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/71d0492b996c4e42b6da595db0d701b4/1200.m3u8','央视栏目','通用'),(40010,'今日 逝者无言','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/393874dd5c2c4652909127886c339c7d/1200.m3u8','央视栏目','通用'),(40011,'今日 弃子','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/147002291e6d457184d01e9b537a247a/1200.m3u8','央视栏目','通用'),(40012,'今日 可疑的知情人','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default//1200.m3u8','央视栏目','通用'),(40013,'今日 “猎狼”行动','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/dc4c7c90aa10469fa09fa894c1f155cb/1200.m3u8','央视栏目','通用'),(40014,'今日 拆解“大忽悠”','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/cc1d8a8b0da44b8c9587f3df05d5a2f8/1200.m3u8','央视栏目','通用'),(40015,'今日 兄妹情伤','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/1dfaecafd58341ea93f307a90930d3ec/1200.m3u8','央视栏目','通用'),(40016,'今日 “香烟大盗”落网记','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/321dd169515d4cc7b16a11a90712f262/1200.m3u8','央视栏目','通用'),(40017,'今日 汉江边的毒工厂','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/567b3fbb699c4a9ba67160be525d5728/1200.m3u8','央视栏目','通用'),(40018,'今日 人在囧途','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/15155c59b1bd4326b33fd8328961bc4e/1200.m3u8','央视栏目','通用'),(40019,'今日 虎口脱险','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/5a7a1ea172f444c1aecf908fc758f503/1200.m3u8','央视栏目','通用'),(40020,'今日 散落的碎片（下）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/9b3f0cc630e9463395a68c3af0021bfe/1200.m3u8','央视栏目','通用'),(40021,'今日 散落的碎片（上）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/653e466c328a4130a61904a11cf52716/1200.m3u8','央视栏目','通用'),(40022,'今日 “宝妈”的减肥陷阱','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/ee76e910d9004d48bc0a31b8b1097f75/1200.m3u8','央视栏目','通用'),(40023,'今日 神秘截图','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/34353881368f4cffb5dca5f5ab84d407/1200.m3u8','央视栏目','通用'),(40024,'今日 “化妆”的化妆品','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/380f0fccbd1b42eba92eff13f7a70ec7/1200.m3u8','央视栏目','通用'),(40025,'普法 致命请柬','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/0316d908ec344910b95aa5a650bb1f90/1200.m3u8','央视栏目','通用'),(40026,'普法 夜醉黑','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/07e3f6b268b247a180b23e3bd0a963a1/1200.m3u8','央视栏目','通用'),(40027,'普法 希望的田野系列剧·远山的守望（下集）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/9d4791b26c6543c6921269a214fb2a7f/1200.m3u8','央视栏目','通用'),(40028,'普法 希望的田野系列剧·远山的守望（上集）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/b2882e47888f4a9da7ac14c3b0f18dd3/1200.m3u8','央视栏目','通用'),(40029,'普法 希望的田野系列剧·芦花的晚餐（下集）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/01fee8a3f9ae46f79a2268422f1a0418/1200.m3u8','央视栏目','通用'),(40030,'普法 希望的田野系列剧·芦花的晚餐（上集）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/79e10f9672264942a4902ed70e05e53c/1200.m3u8','央视栏目','通用'),(40031,'普法 唢呐从军记（剧情版）大结局','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/6bfc54f8bd6746a4b162be04ff05db46/1200.m3u8','央视栏目','通用'),(40032,'普法 唢呐从军记（剧情版）中集','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/a0438dcdabe74b1f9f0c3ac9525dd948/1200.m3u8','央视栏目','通用'),(40033,'普法 唢呐从军记（剧情版）上集','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/c481d614802c43fc8604b32f46a12959/1200.m3u8','央视栏目','通用'),(40034,'普法 四集迷你剧集','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/67d87416cf4e4ac982090e49400488e8/1200.m3u8','央视栏目','通用'),(40035,'普法 四集迷你剧集','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/836a62e4e59d49b999a1a4ac713c38b4/1200.m3u8','央视栏目','通用'),(40036,'普法 四集迷你剧集','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/80402e5c9c6c4370bd3b7c93c10b7ea0/1200.m3u8','央视栏目','通用'),(40037,'普法 四集迷你剧集','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/ab7b5d2eacef48a2acdf9cb39fad1403/1200.m3u8','央视栏目','通用'),(40038,'普法 我的宝贝·精编版（大结局）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/5af42c35e4a5481f8cedf0d43d8dcb23/1200.m3u8','央视栏目','通用'),(40039,'普法 我的宝贝·精编版（三）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/dd1fa8fd648b4106be9bfa2e0cbcca3f/1200.m3u8','央视栏目','通用'),(40040,'普法 我的宝贝·精编版（二）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/e933e62309e64fe69b2a5c4e66a1e59e/1200.m3u8','央视栏目','通用'),(40041,'普法 我的宝贝·精编版（一）','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/5ae34e713b8c4d40839bc4479d721757/1200.m3u8','央视栏目','通用'),(40042,'普法 新生·精编版','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/fd72df652166488a98def1b6261ef5bd/1200.m3u8','央视栏目','通用'),(40043,'普法 新生·精编版','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/43a90992f99b4202bbdaf18d8105e917/1200.m3u8','央视栏目','通用'),(40044,'普法 新生·精编版','http://cntv.hls.cdn.myqcloud.com/asp/hls/1200/0303000a/3/default/bd06f9f20f2747bda8cd2eff2a5b81b7/1200.m3u8','央视栏目','通用'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','天津','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','天津','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','北京','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','北京','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','上海','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','上海','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','重庆','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','重庆','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','广东','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','广东','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','湖北','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','湖北','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','河北','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','河北','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','安徽','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','安徽','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','江西','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','江西','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','河南','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','河南','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','山西','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','山西','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','吉林','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','吉林','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','江苏','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','江苏','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','福建','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','福建','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','湖南','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','湖南','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','海南','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','海南','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','贵州','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','贵州','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','四川','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','四川','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','云南','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','云南','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','山东','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','山东','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','陕西','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','陕西','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','广西','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','广西','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','宁夏','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','宁夏','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','甘肃','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','甘肃','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','西藏','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','西藏','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','浙江','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','浙江','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','新疆','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','新疆','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','内蒙古','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','内蒙古','省内'),(50001,'成龙','http://aldirect.hls.huya.com/huyalive/94525224-2460685722-10568564701724147712-2789253838-10057-A-0-1_1200.m3u8','黑龙江','省内'),(50002,'吴京','http://aldirect.hls.huya.com/huyalive/30765679-2554414705-10971127618396487680-3048991636-10057-A-0-1_1200.m3u8','黑龙江','省内'),(20001,'CCTV-1','rtsp://113.136.42.40:554/PLTV/88888888/224/3221226044/10000100000000060000000001581834_0.smil','移动专区','移动'),(20002,'CCTV-2','rtsp://113.136.42.39:554/PLTV/88888888/224/3221226075/10000100000000060000000001759090_0.smil','移动专区','移动'),(20003,'CCTV-3','rtsp://113.136.42.39:554/PLTV/88888888/224/3221226116/10000100000000060000000001759239_0.smil','移动专区','移动'),(20004,'CCTV-4','rtsp://113.136.42.39:554/PLTV/88888888/224/3221226080/10000100000000060000000001759086_0.smil','移动专区','移动'),(20005,'CCTV-5','rtsp://113.136.42.40:554/PLTV/88888888/224/3221226037/10000100000000060000000001581835_0.smil','移动专区','移动'),(20006,'江苏卫视FHD','rtsp://61.156.103.73:554/PLTV/88888888/224/3221225872/10000100000000060000000000215718_0.smil','移动专区','移动'),(20007,'浙江卫视FHD','rtsp://61.156.103.73:554/PLTV/88888888/224/3221225866/10000100000000060000000000219050_0.smil','移动专区','移动'),(20008,'安徽卫视FHD','rtsp://61.156.103.73:554/PLTV/88888888/224/3221225878/10000100000000060000000000215738_0.smil','移动专区','移动'),(20009,'山东卫视FHD','rtsp://61.156.103.73:554/PLTV/88888888/224/3221225869/10000100000000060000000000219044_0.smil','移动专区','移动'),(20010,'湖北卫视FHD','rtsp://61.156.103.73:554/PLTV/88888888/224/3221225879/10000100000000060000000000215740_0.smil','移动专区','移动'),(20011,'湖南卫视FHD','rtsp://61.156.103.73:554/PLTV/88888888/224/3221225870/10000100000000060000000000219041_0.smil','移动专区','移动'),(20012,'广东卫视FHD','rtsp://61.156.103.73:554/PLTV/88888888/224/3221225881/10000100000000060000000000215744_0.smil','移动专区','移动'),(20013,'深圳卫视FHD','rtsp://61.156.103.73:554/PLTV/88888888/224/3221225873/10000100000000060000000000215719_0.smil','移动专区','移动'),(20001,'野生世界（下）','http://hls.cntv.qingcdn.com/asp/hls/1200/0303000a/3/default/3922d178d5a5416d8a4d1427f58ff17e/1200.m3u8','隐藏节目','隐藏'),(20002,'野生世界（上）','http://hls.cntv.qingcdn.com/asp/hls/1200/0303000a/3/default/53b19b6407a1471bbcede76a35acb7ee/1200.m3u8','隐藏节目','隐藏'),(40001,'周星驰','https://tx.hls.huya.com/huyalive/94525224-2460685313-10568562945082523648-2789274524-10057-A-0-1_1200.m3u8','精彩轮播','通用'),(40002,'林正英','https://tx.hls.huya.com/huyalive/94525224-2460686034-10568566041753944064-2789274542-10057-A-0-1_1200.m3u8','精彩轮播','通用'),(40003,'李连杰','https://js.hls.huya.com/huyalive/94525224-2460686093-10568566295157014528-2789253848-10057-A-0-1_1200.m3u8','精彩轮播','通用'),(40004,'好莱坞','https://aldirect.hls.huya.com/huyalive/30765679-2672001664-11476159761737580544-3048991600-10057-A-0-1_1200.m3u8','精彩轮播','通用'),(40005,'洪金宝','http://tx.hls.huya.com/huyalive/29106097-2689406282-11550912026846953472-2789274558-10057-A-0-1.m3u8','精彩轮播','通用'),(40006,'林正英','http://aldirect.hls.huya.com/huyalive/94525224-2460686034-10568566041753944064-2789274542-10057-A-0-1_1200.m3u8','精彩轮播','通用'),(40007,'刘德华','http://aldirect.hls.huya.com/huyalive/94525224-2467341872-10597152648291418112-2789274550-10057-A-0-1_1200.m3u8','精彩轮播','通用'),(40001,'CCTV-1高清','http://ivi.bupt.edu.cn/hls/cctv1hd.m3u8','央视频道','通用'),(40002,'CCTV-3高清','http://ivi.bupt.edu.cn/hls/cctv3hd.m3u8','央视频道','通用'),(40003,'CCTV-6高清','http://ivi.bupt.edu.cn/hls/cctv6hd.m3u8','央视频道','通用'),(40004,'CCTV-1','sop://api/migu.php?id=608807420','央视频道','通用'),(40005,'CCTV-2','sop://api/migu.php?id=631780532','央视频道','通用'),(40006,'CCTV-3','sop://api/migu.php?id=624878270','央视频道','通用'),(40007,'CCTV-4','sop://api/migu.php?id=631780421','央视频道','通用'),(40008,'CCTV-5','sop://api/migu.php?id=641886673','央视频道','通用'),(40009,'CCTV-6','sop://api/migu.php?id=624878379','央视频道','通用'),(40010,'CCTV-8','sop://api/migu.php?id=624878350','央视频道','通用');
/*!40000 ALTER TABLE `chzb_channels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chzb_loginrec`
--

DROP TABLE IF EXISTS `chzb_loginrec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chzb_loginrec` (
  `userid` bigint(15) NOT NULL,
  `deviceid` varchar(32) NOT NULL,
  `mac` varchar(32) NOT NULL,
  `model` varchar(32) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `region` varchar(32) NOT NULL,
  `logintime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chzb_loginrec`
--

LOCK TABLES `chzb_loginrec` WRITE;
/*!40000 ALTER TABLE `chzb_loginrec` DISABLE KEYS */;
INSERT INTO `chzb_loginrec` VALUES (172757,'16d938d49b295ae9','','','59.173.192.52','湖北省武汉市电信',1571895100),(234010,'3249b56fc1aa2ef8','','','175.9.221.146','湖南省长沙市电信',1571767699),(380159,'d5d7919c6aac3eff','','','125.80.186.25','重庆市渝中区电信',1571902884),(144131,'bf215aae25f75e53','08:00:27:4e:c1:4e','MuMu','113.102.34.215','广东肇庆电信 ',1571914707),(851705,'e4c9cc17dff2ba16','60:ab:67:f9:e4:0a','MI 9 SE','113.102.34.215','广东肇庆电信 ',1571905247),(123,'e4c9cc17dff2ba16','60:ab:67:f9:e4:0a','MI 9 SE','183.40.242.154','广东广州电信/基站WiFi ',1571798094),(123,'e4c9cc17dff2ba16','60:ab:67:f9:e4:0a','MI 9 SE','223.104.65.102','广东东莞移动/基站WiFi ',1571798174),(50549533,'bb94533a7b379b5e','','','49.92.81.17','江苏省南京市电信',1571815133),(33588,'2b4fa7dd07b924f5','','','125.80.186.25','重庆市渝中区电信',1571879790),(256501,'3c76070946a30a52','','','120.203.246.56','江西省上饶市移动',1571821633),(945237,'53a19d74af7e837a','','','27.193.105.118','山东省青岛市联通',1571923032),(869571,'f5445e6edb4c564e','','','36.5.132.208','安徽省合肥市电信',1571827791),(342727,'d1058cf587bbdc86','','','114.216.208.117','江苏省苏州市电信',1571839545),(189696,'da18a1c362868d34','','','114.89.161.97','上海市电信',1571839884),(342727,'d1058cf587bbdc86','','','139.162.75.88','日本东京都品川区Linode数据中心',1571839822),(482623,'0f9804c5629528f6','','','182.141.211.235','四川省凉山州电信',1571841509),(68386750,'ccb35ba1e57df35','80:69:33:57:bc:20','EC6110T_gdydx','58.63.0.10','广东省广州市番禺区电信',1571842784),(570075,'9088f8a376731182','','','120.208.14.140','山西省长治市移动',1571843299),(50549533,'bb94533a7b379b5e','','','49.90.171.139','江苏省南京市电信',1572046709),(123,'e4c9cc17dff2ba16','','','113.102.34.215','广东省肇庆市电信',1571905247),(50467503,'3d7fe3b5e14e8caa','cc:bb:fe:f4:3f:3a','EC6110','113.66.32.24','广东省广州市电信',1571875143),(94519942,'2694a37c54d33d42','c4:0b:cb:24:19:90','MI MAX','183.210.71.116','江苏省扬州市移动',1571878335),(336542,'685c35399354bd2e','','','125.80.186.25','重庆市渝中区电信',1571883092),(189696,'da18a1c362868d34','','','101.84.184.233','上海市电信',1571889509),(189696,'da18a1c362868d34','','','114.82.90.29','上海市金山区电信',1571923899),(189696,'da18a1c362868d34','','','34.219.238.148','美国俄勒冈州波特兰Amazon数据中心',1571898547),(53055,'1f9f30e9a69ad9df','9c:a6:9d:11:92:30','WTV43K1','113.102.34.215','广东肇庆电信 ',1571905160),(68386750,'ccb35ba1e57df35','80:69:33:57:bc:20','EC6110T_gdydx','121.33.144.153','广东省广州市天河区电信',1571906818),(809403,'d5d7919c6aac3eff','','','125.80.190.246','重庆市渝中区电信',1571918726),(33588,'2b4fa7dd07b924f5','','','125.80.190.246','重庆市渝中区电信',1571918377),(22045902,'c7be5a4c49f6fb80','00:9e:c8:2e:10:2d','MiBOX3_PRO','112.12.133.137','浙江省温州市移动',1571923428),(189696,'da18a1c362868d34','','','54.201.196.31','美国俄勒冈州波特兰Amazon数据中心',1571924415),(50549533,'bb94533a7b379b5e','','','121.239.45.76','江苏省苏州市电信',1571934413),(33588,'2b4fa7dd07b924f5','','','125.80.189.199','重庆市渝中区电信',1572077353),(136345,'ca74ea70d001f98c','','','139.170.4.86','青海省联通',1571981644),(69915,'3249b56fc1aa2ef8','','','175.9.220.91','湖南省长沙市电信',1571957565),(809403,'d5d7919c6aac3eff','','','125.80.189.199','重庆市渝中区电信',1572073138),(336542,'685c35399354bd2e','','','125.80.189.199','重庆市渝中区电信',1572075456),(84228769,'acde85a45dde3ed5','78:c2:c0:9f:21:9c','H96 Max X2','113.250.242.38','重庆市电信',1571974937),(77647755,'f4eddc2090453860','8c:fd:18:53:82:64','EC6110','113.66.208.246','广东省广州市电信',1571976635),(50549533,'bb94533a7b379b5e','','','192.81.135.111','美国Linode数据中心',1571979268),(267141,'16d938d49b295ae9','','','111.172.207.191','湖北省武汉市电信',1572052437),(123,'e4c9cc17dff2ba16','','','113.102.34.132','广东省肇庆市电信',1572008953),(397043,'202a6e4d0892f5b0','','','114.248.140.101','北京市联通',1572009310),(510427,'b76f3898458b050c','','','111.172.207.191','湖北省武汉市电信',1572054049),(918086,'b9cf35dc58ff05cc','','','183.24.176.81','广东省梅州市电信',1572070258),(857684,'10620a9635f20876','','','117.80.195.84','江苏省苏州市电信',1572073069),(98602329,'f807d361ae70da4e','cc:bb:fe:f3:da:f3','EC6110','223.74.68.13','广东省移动',1572082021),(469812,'1a4c22116a42fedb','','','223.104.64.233','广东省移动',1572090677),(809403,'d5d7919c6aac3eff','','','125.80.186.131','重庆市渝中区电信',1572102264),(33588,'2b4fa7dd07b924f5','','','125.80.186.131','重庆市渝中区电信',1572105412),(33588,'2b4fa7dd07b924f5','','','125.80.187.86','重庆市渝中区电信',1572127727),(50549533,'bb94533a7b379b5e','','','3.112.135.116','日本东京Amazon数据中心',1572132003),(809403,'d5d7919c6aac3eff','','','106.91.57.6','重庆市电信',1572144660),(342727,'d1058cf587bbdc86','','','121.239.45.173','江苏省苏州市电信',1572153592),(40259396,'b49423a7964dabfe','00:15:18:01:81:31','E900V21C-S905L','124.67.20.7','内蒙古呼和浩特市联通',1572178696),(14957664,'d10e5ac260bdb646','cc:bb:fe:f3:ee:91','EC6110','14.209.64.76','广东省肇庆市电信',1572184446),(15934765,'8105b5ba674134ce','70:d9:23:29:94:74','vivo Y66','115.61.85.214','河南省平顶山市联通',1572217911),(397043,'202a6e4d0892f5b0','','','114.242.249.243','北京市联通',1572230586),(692382,'b7c052a34267b911','','','223.104.11.84','陕西省移动',1572241630),(90830,'23c0697b13591565','','','122.136.228.114','吉林省延边州敦化市联通',1572249914),(165546,'a83f811f89b3eb1e','','','120.230.3.229','广东省汕头市移动',1572252342),(98099078,'5e3038cadd4518b9','80:69:33:57:b6:47','EC6110','113.65.131.159','广东省广州市天河区电信',1572258451),(809403,'d5d7919c6aac3eff','','','14.108.28.120','重庆市电信',1572263703),(144131,'bf215aae25f75e53','','','113.102.34.28','广东省肇庆市电信',1573042242),(547842,'dd99953cf4a90319','','','112.41.224.212','辽宁葫芦岛移动 ',1573039671),(521590,'00241dd668c11019','','','171.211.57.23','四川德阳电信 ',1573039858),(894538,'a74f9a70592c9932','','','113.64.122.8','广东梅州电信 ',1573039935),(165546,'a83f811f89b3eb1e','','','120.230.2.178','广东汕头移动 ',1573039986),(656416,'af1711098b02b7c2','','','49.219.140.204','台湾 ',1573042184),(100629,'9a987883da545073','','','120.71.239.38','新疆哈密电信 ',1573040063),(746606,'ebe928669752f045','','','182.88.67.104','广西南宁联通 ',1573096175),(14833,'693a73af8766d271','','','39.149.7.125','河南郑州移动 ',1573040487),(809403,'d5d7919c6aac3eff','','','106.91.63.172','重庆重庆电信 ',1573045437),(126053,'c6f2580e9744a753','','','14.117.233.178','广东江门电信 ',1573062176),(327015,'cca04dbb45b5de05','','','111.165.31.21','天津天津联通 ',1573042719),(443976,'5146aea1abc1eb02','','','140.243.88.21','福建福州电信 ',1573042748),(838766,'eae6e6cbdeec9253','','','182.51.86.228','河北石家庄广电网 ',1573043511),(829926,'1377a2756096b9db','','','223.104.214.80','四川宜宾移动/基站WiFi ',1573043810),(573065,'1e114c07bdcc4e15','','','223.73.97.215','广东湛江移动 ',1573043874),(872924,'f281a8857c674af9','','','171.115.215.158','湖北十堰电信 ',1573043884),(208989,'1c35bb8c1c95fc3c','','','223.73.97.215','广东湛江移动 ',1573044191),(956739,'ae8dc3065f1df79b','','','113.222.228.212','湖南株洲电信 ',1573044578),(711772,'f6bef46fce3ab153','','','113.110.8.84','广东揭阳电信 ',1573044867),(412196,'231d37ec57cc8563','','','36.49.161.136','吉林吉林电信 ',1573045779),(16810,'23c0308676847e0e','','','123.181.202.224','河北秦皇岛电信 ',1573046453),(684753,'de3541fbc8c42b01','','','121.206.61.159','福建漳州电信 ',1573046464),(597510,'7a3fd4f0efba25e8','','','113.102.214.1','广东东莞电信 ',1573046621),(189696,'da18a1c362868d34','','','114.82.92.187','上海上海电信 ',1573516823),(20548,'49cb12931d8aa8e7','','','110.240.44.178','河北石家庄联通 ',1573079608),(805391,'d71877bd916b785d','','','113.205.151.140','重庆重庆联通 ',1573047621),(189696,'da18a1c362868d34','','','18.237.43.205','北美洲美国境外 ',1573090192),(93815,'f3f0e88aad36ba99','','','125.106.204.232','浙江衢州电信 ',1573048459),(240499,'155089fbcafb619c','','','113.251.29.63','重庆重庆电信 ',1573049258),(265129,'92e07549363208a4','','','114.82.92.187','上海上海电信 ',1573181090),(774548,'64a2adc58ab52528','','','112.18.135.15','四川内江移动 ',1573048691),(155228,'fea0ec1b640bddc0','','','43.227.137.140','湖北武汉广电网 ',1573048895),(265129,'92e07549363208a4','','','34.210.159.183','北美洲美国境外 ',1573054229),(145377,'5bb47d4736f0117a','','','223.104.1.152','广东东莞移动/基站WiFi ',1573051552),(905661,'34f39a5f10ef7440','','','171.113.36.19','湖北武汉电信 ',1573051820),(239507,'1c97b186611bfaaf','','','117.157.181.42','甘肃天水移动 ',1573053365),(577818,'66c7968c6a4c7ade','','','117.152.37.166','湖北襄阳移动 ',1573054350),(265129,'92e07549363208a4','','','13.231.165.101','亚洲日本境外 ',1573054840),(894538,'a74f9a70592c9932','','','59.32.93.24','广东梅州电信 ',1573055049),(809403,'d5d7919c6aac3eff','','','14.108.207.58','重庆重庆电信 ',1573062700),(313022,'e7182ba8026f4c89','','','1.82.14.129','陕西商洛电信 ',1573067074),(10649,'36e86bb0a2519a8e','','','14.119.191.26','广东湛江电信 ',1573084921),(393681,'83392826a4abb9cc','','','111.29.73.106','海南文昌移动 ',1573091516),(123,'e4c9cc17dff2ba16','','','113.102.34.28','广东肇庆电信 ',1573084676),(214443,'10c8647f06e8b36e','','','60.184.83.135','浙江丽水电信 ',1573084426),(415713,'4c58347cd85c3629','','','101.80.165.8','上海上海电信 ',1573131462),(798931,'46ea41caf3e0e41b','','','223.104.13.53','河北石家庄移动/基站WiFi ',1573085799),(93815,'f3f0e88aad36ba99','','','125.106.220.109','浙江衢州电信 ',1573086635),(634262,'498edd9d31b6e60f','','','223.104.240.120','云南移动 ',1573091137),(656416,'af1711098b02b7c2','','','117.19.204.184','台湾 ',1573096181),(508227,'9da1ea0b29bf45c3','','','223.104.49.36','北京北京移动/基站WiFi ',1573092825),(710568,'cebf4bfd4ac565ec','','','121.33.145.205','广东广州电信 ',1573093088),(722549,'f1b2319a91084ef2','','','183.198.230.199','河北石家庄移动 ',1573105630),(270009,'cbab07ae3f5364f5','','','120.230.129.156','广东广州移动 ',1573095374),(775629,'6023046156297873','','','182.131.85.220','四川广安电信 ',1573097061),(735092,'8ae625723f614cbd','','','171.126.229.82','山西晋城联通 ',1573134121),(824514,'a41bea2954900e34','','','110.85.216.171','福建漳州电信 ',1573353177),(809403,'d5d7919c6aac3eff','','','119.85.31.10','重庆重庆电信 ',1573100400),(931000,'b1702765e63c028f','','','221.11.61.58','陕西西安联通 ',1573101216),(556459,'b305f91afccea906','','','183.2.114.213','广东江门电信 ',1573105568),(656416,'af1711098b02b7c2','','','101.12.103.111','台湾 ',1573108568),(930828,'3091517d8b99fc95','','','123.134.70.0','山东莱芜联通 ',1573109872),(532409,'2636be4a0d4cc73a','','','116.17.144.192','广东惠州电信 ',1573112272),(132867,'d4371226b16a08e0','','','182.114.94.219','河南三门峡联通 ',1573112382),(838766,'eae6e6cbdeec9253','','','123.183.246.45','河北张家口电信 ',1573115028),(963671,'e87130d4797db0d9','','','113.13.156.242','广西柳州电信 ',1573116630),(809403,'d5d7919c6aac3eff','','','14.108.30.148','重庆重庆电信 ',1573124614),(94094,'7ab14b58ad90a8f2','','','123.170.73.12','山东日照电信 ',1573126049),(189696,'da18a1c362868d34','','','52.68.101.250','亚洲日本境外 ',1573127314),(423085,'1349f95d52e3c49a','','','121.206.24.122','福建漳州电信 ',1573127650),(170000,'bc1af5da8fa1e224','','','45.116.152.23','北京北京腾讯 ',1573127833),(374845,'21522d239b06cd9e','','','124.239.44.18','河北承德电信 ',1573130323),(944434,'044e47ea949893eb','','','114.98.112.136','安徽滁州电信 ',1573133353),(165546,'a83f811f89b3eb1e','','','120.230.3.19','广东汕头移动 ',1573137008),(100629,'9a987883da545073','','','221.181.52.139','新疆乌鲁木齐移动 ',1573141903),(800066,'e6e6a140d095a941','','','125.107.151.65','浙江绍兴电信 ',1573161877),(684753,'de3541fbc8c42b01','','','120.34.4.139','福建漳州电信 ',1573167320),(189696,'da18a1c362868d34','','','114.85.141.110','上海上海电信 ',1573176820),(189696,'da18a1c362868d34','','','54.178.14.188','亚洲日本境外 ',1573172766),(508227,'9da1ea0b29bf45c3','','','27.154.190.142','福建厦门电信 ',1573175207),(189696,'da18a1c362868d34','','','3.113.34.132','亚洲日本境外 ',1573177320),(735092,'8ae625723f614cbd','','','171.126.193.18','山西晋城联通 ',1573216273),(189696,'da18a1c362868d34','','','18.179.51.198','亚洲日本境外 ',1573184535),(144131,'bf215aae25f75e53','','','113.102.34.175','广东肇庆电信',1573196053),(877973,'androidid','mac','model','123.207.167.163','天津天津腾讯云',1573199511),(963671,'e87130d4797db0d9','','','113.13.158.49','广西柳州电信',1573200216),(189696,'da18a1c362868d34','','','3.113.201.215','亚洲日本境外',1573203557),(544972,'1c1866da4a211c2a','','','101.80.165.8','上海上海电信',1573396902),(189696,'da18a1c362868d34','','','34.222.116.37','北美洲美国境外',1573203614),(265129,'92e07549363208a4','','','18.182.31.49','亚洲日本境外',1573204465),(809403,'d5d7919c6aac3eff','','','14.108.162.169','重庆重庆电信',1573220848),(189696,'da18a1c362868d34','','','13.231.233.170','亚洲日本境外',1573222939),(532409,'2636be4a0d4cc73a','','','183.31.65.119','广东惠州电信',1573224199),(978992,'3e3bbfc319bc3165','','','120.230.26.59','广东汕尾移动',1573241969),(735092,'8ae625723f614cbd','','','171.126.229.216','山西晋城联通',1573294209),(809403,'d5d7919c6aac3eff','','','14.108.193.182','重庆重庆电信',1573274223),(772995,'83f8665ab8d477fc','','','122.136.33.143','吉林延边联通',1573279508),(240241,'46c671204b9f720a','','','175.16.0.62','吉林吉林联通',1573288781),(582845,'3bd1615f5c480e0a','','','58.249.110.80','广东广州联通',1573290854),(508227,'9da1ea0b29bf45c3','','','117.30.75.228','福建厦门电信',1573292871),(809403,'d5d7919c6aac3eff','','','14.108.154.133','重庆重庆电信',1573296270),(809403,'d5d7919c6aac3eff','','','119.86.179.145','重庆重庆电信',1573296376),(825641,'c9f2bb7ba80ce66d','','','223.73.10.77','广东汕头移动',1573297027),(809403,'d5d7919c6aac3eff','','','14.108.152.181','重庆重庆电信',1573298005),(735092,'8ae625723f614cbd','','','171.126.195.146','山西晋城联通',1573304596),(809403,'d5d7919c6aac3eff','','','119.86.119.19','重庆重庆电信',1573315330),(100629,'9a987883da545073','','','43.242.152.158','新疆乌鲁木齐联通',1573313790),(963671,'e87130d4797db0d9','','','171.110.53.10','广西柳州电信',1573319775),(689228,'12c61c26e00e3369','','','183.228.13.184','重庆重庆移动',1573338390),(689228,'12c61c26e00e3369','','','123.147.250.176','重庆重庆联通',1573338506),(577818,'66c7968c6a4c7ade','','','111.177.106.71','湖北襄阳电信',1573343690),(298120,'920da6e8070e3be2','','','183.211.74.138','江苏苏州移动',1573360975),(88308,'da43048a00a96fed','08:00:27:f5:be:d4','MuMu','223.112.135.127','江苏无锡移动',1573465977),(987981,'8ea660ca766687f0','','','14.28.178.16','广东深圳电信',1573365620),(165546,'a83f811f89b3eb1e','','','120.230.2.159','广东汕头移动',1573366245),(80646151,'da43048a00a96fed','08:00:27:f5:be:d4','MuMu','123.161.231.155','河南信阳电信',1573559304),(80646151,'da43048a00a96fed','08:00:27:f5:be:d4','MuMu','223.90.96.193','河南信阳移动',1573366644),(735092,'8ae625723f614cbd','','','183.187.219.51','山西晋城联通',1573377415),(809403,'d5d7919c6aac3eff','','','14.108.187.121','重庆重庆电信',1573380289),(956739,'ae8dc3065f1df79b','','','113.222.234.70','湖南株洲电信',1573383825),(809403,'d5d7919c6aac3eff','','','119.85.19.250','重庆重庆电信',1573387894),(684753,'de3541fbc8c42b01','','','110.82.55.17','福建漳州电信',1573558516),(488695,'554c81ec1caa76d','','','1.27.232.125','内蒙古通辽联通',1573399612),(866735,'b5241abe7e9b22eb','','','116.26.158.154','广东汕头电信',1573402694),(809403,'d5d7919c6aac3eff','','','14.106.166.14','重庆重庆电信',1573404662),(100629,'9a987883da545073','','','221.181.52.146','新疆乌鲁木齐移动',1573406285),(189696,'da18a1c362868d34','','','114.85.149.102','上海上海电信',1573438731),(189696,'da18a1c362868d34','','','54.249.76.39','亚洲日本境外',1573440792),(359350,'66b6a6a5a8f6b50b','','','27.192.166.35','山东潍坊联通',1573458711),(144131,'bf215aae25f75e53','08:00:27:4e:c1:4e','MuMu','113.102.34.191','广东肇庆电信',1573472326),(801454,'871544fa3caeb847','08:00:27:80:b8:3b','vivo X9','59.37.97.18','广东深圳电信',1573468671),(498037,'da18a1c362868d34','','','13.230.37.142','亚洲日本境外',1573471389),(741749,'83f8665ab8d477fc','','','122.136.231.173','吉林延边联通',1573517411),(839654,'4132b7fdf75bdabc','','','182.131.85.164','四川广安电信',1573523904),(664844,'de3541fbc8c42b01','','','27.157.96.174','福建漳州电信',1573531233),(498037,'da18a1c362868d34','','','114.87.2.47','上海上海电信',1573529099),(890167,'d669111f237b95f3','','','117.136.119.168','上海上海移动/基站WiFi',1573529559),(664844,'de3541fbc8c42b01','','','140.224.132.163','福建漳州电信',1573551802),(879999,'90504be4485ab562','','','58.219.179.27','江苏盐城电信',1573547387),(890167,'d669111f237b95f3','','','117.143.170.149','上海上海移动',1573561137);
/*!40000 ALTER TABLE `chzb_loginrec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chzb_proxy`
--

DROP TABLE IF EXISTS `chzb_proxy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chzb_proxy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` varchar(500) NOT NULL,
  `proxy` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chzb_proxy`
--

LOCK TABLES `chzb_proxy` WRITE;
/*!40000 ALTER TABLE `chzb_proxy` DISABLE KEYS */;
INSERT INTO `chzb_proxy` VALUES (125,'eJzLKCkpsNLXNzS00DO0NNAzNDDVMzQ30TcyMLQ0NDQ00gcAhPoHOA==','eJwrzi+w0tcHAAfeAes=');
/*!40000 ALTER TABLE `chzb_proxy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chzb_serialnum`
--

DROP TABLE IF EXISTS `chzb_serialnum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `vip` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=580 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chzb_serialnum`
--

LOCK TABLES `chzb_serialnum` WRITE;
/*!40000 ALTER TABLE `chzb_serialnum` DISABLE KEYS */;
INSERT INTO `chzb_serialnum` VALUES (570,77124471,0,0,365,'admin',1573361979,0,'',1),(571,35646412,0,0,365,'admin',1573361979,0,'',1),(572,77792756,0,0,365,'admin',1573361979,0,'',1),(575,28061819,0,0,11,'admin',1573361995,0,'',0),(576,62279196,0,0,11,'admin',1573361995,0,'',0),(577,68388313,479775,1573470207,11,'admin',1573361995,1,'',0);
/*!40000 ALTER TABLE `chzb_serialnum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chzb_users`
--

DROP TABLE IF EXISTS `chzb_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `vip` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7751 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chzb_users`
--

LOCK TABLES `chzb_users` WRITE;
/*!40000 ALTER TABLE `chzb_users` DISABLE KEYS */;
INSERT INTO `chzb_users` VALUES (7528,53055,'9c:a6:9d:11:92:30','1f9f30e9a69ad9df','WTV43K1','113.102.34.215','广东肇庆电信 ',1603036800,151,'admin',1571575533,1,1571905160,'已授权',1),(7556,123,'60:ab:67:f9:e4:0a','e4c9cc17dff2ba16','MI 9 SE','113.102.34.28','广东肇庆电信 ',1603296000,151,'admin',1571798055,1,1573084676,'',0),(7727,85583274,'08:00:27:f5:be:d4','da43048a00a96fed','MuMu','123.161.231.155','河南信阳电信',1604851200,0,'admin',1573392058,1,1573559304,'',1),(7734,68388313,'08:00:27:4e:c1:4e','bf215aae25f75e53','MuMu','113.102.34.191','广东肇庆电信',1574352000,0,'admin',1573470207,1,1573472326,'',0),(7735,498037,'','da18a1c362868d34','','114.87.2.47','上海上海电信',1573660800,0,'',0,-1,1573529099,'试用',0),(7736,357933,'','6e2c95d8bcc7cb87','','60.18.72.226','辽宁抚顺联通',1573660800,0,'',0,-1,1573471959,'试用',0),(7737,958801,'','d5d7919c6aac3eff','','14.108.178.203','重庆重庆电信',1573660800,0,'',0,-1,1573471986,'试用',0),(7738,981251,'','6023046156297873','','182.131.85.164','四川广安电信',1573660800,0,'',0,-1,1573483088,'试用',0),(7739,496915,'','e87130d4797db0d9','','180.142.28.90','广西柳州电信',1573660800,0,'',0,-1,1573487708,'试用',0),(7740,441781,'','c9914d06e1516380','','14.221.36.69','广东东莞电信',1573660800,0,'',0,-1,1573487887,'试用',0),(7741,80934,'','f8cba61131a7daa0','','120.239.7.36','广东梅州移动',1573747200,0,'',0,-1,1573511891,'试用',0),(7742,741749,'','83f8665ab8d477fc','','122.136.231.173','吉林延边联通',1573747200,0,'',0,-1,1573517411,'试用',0),(7743,839654,'','4132b7fdf75bdabc','','182.131.85.164','四川广安电信',1573747200,0,'',0,-1,1573523904,'试用',0),(7744,664844,'','de3541fbc8c42b01','','110.82.55.17','福建漳州电信',1573747200,0,'',0,-1,1573558516,'试用',0),(7745,890167,'','d669111f237b95f3','','117.143.170.149','上海上海移动',1573747200,0,'',0,-1,1573561137,'试用',0),(7746,879999,'','90504be4485ab562','','58.219.179.27','江苏盐城电信',1573747200,0,'',0,-1,1573547387,'试用',0),(7747,762108,'','ca4da96040e78ca','','115.209.32.243','浙江舟山电信',1573747200,0,'',0,-1,1573554326,'试用',0),(7748,674948,'','5f9478d7ae555930','','125.118.66.24','浙江杭州电信',1573747200,0,'',0,-1,1573556505,'试用',0),(7749,51452672,'08:00:27:4b:f5:e1','871544fa3caeb847','vivo X9','58.60.9.119','广东深圳电信',0,0,'',0,-1,1573557012,'',0),(7750,944309,'','8ae625723f614cbd','','118.76.84.162','山西晋城联通',1573747200,0,'',0,-1,1573558507,'试用',0);
/*!40000 ALTER TABLE `chzb_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-12 20:26:28
