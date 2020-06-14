<?php  
/**
 * ====================================================================================
 *                           某某短域名系统
 * ----------------------------------------------------------------------------------
 * @copyright This software is exclusively sold at CodeCanyon.net. If you have downloaded this
 *  from another site or received it from someone else than me, then you are engaged
 *  in an illegal activity. You must delete this software immediately or buy a proper
 *  license from www.yunziyuan.com.cn
 *
 *  Thank you for your cooperation and don't hesitate to contact me if anything :)
 * ====================================================================================
 *
 * @author 某某 (http://www.yunziyuan.com.cn)
 * @link http://www.yunziyuan.com.cn
 * @package 某某短域名系统
 * @subpackage Application updater
 */	
	$step = 1;
	if(isset($_GET["run"]) && $_GET["run"] == "true"){
		$step = 2;
	}	
	$message="";
	if(isset($_GET["step"]) && is_numeric($_GET["step"]) && $_GET["step"]<3){
		$step=$_GET["step"];
	}
	if($step==2){		
		include("includes/config.php");
    $db = new PDO("mysql:host=".$dbinfo["host"].";dbname=".$dbinfo["db"]."", $dbinfo["user"], $dbinfo["password"]);
    $query=get_query($dbinfo);

		foreach ($query as $q) {
		 	$db->query($q);
		} 	
		header("Location: index.php"); 
		$_SESSION["msg"]="success::Database was successfully updated. Enjoy the new features!";
			if(file_exists("main.zip")){
				unlink('main.zip');
			}
			if(file_exists("install.php")){
				unlink('install.php');
			}
		unlink(__FILE__);
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>某某短域名系统 Installation</title>
	<style type="text/css">
		body{background:#f9f9f9;font-family:Helvetica, Arial;width:860px;line-height:25px;font-size:13px;margin:0 auto;}a{color:#009ee4;font-weight:700;text-decoration:none;}a:hover{color:#000;text-decoration:none;}.container{background:#fff;border:1px solid #eee;box-shadow:0 0 0 3px #f7f7f7;border-radius:3px;display:block;overflow:hidden;margin:50px 0;}.container h1{font-size:22px;display:block;border-bottom:1px solid #eee;margin:0!important;padding:10px;}.container h2{color:#999;font-size:18px;margin:10px;}.container h3{background:#f8f8f8;border-bottom:1px solid #eee;border-radius:3px 0 0 0;text-align:center;margin:0;padding:10px 0;}.left{float:left;width:258px;}.right{float:left;width:599px;border-left:1px solid #eee;}.form{width:90%;display:block;padding:10px;}.form label{font-size:15px;font-weight:700;margin:5px 0;}.form label a{float:right;color:#009ee4;font:bold 12px Helvetica, Arial; padding-top: 5px;}.form .input{display:block;width:98%;height:15px;border:1px #ccc solid;font:bold 15px Helvetica, Arial;color:#aaa;border-radius:2px;box-shadow:inset 1px 1px 3px #ccc,0 0 0 3px #f8f8f8;margin:10px 0;padding:10px;}.form .input:focus{border:1px #73B9D9 solid;outline:none;color:#222;box-shadow:inset 1px 1px 3px #ccc,0 0 0 3px #DEF1FA;}.form .button{height:35px;}.button{background:#0080FF;height:20px;width:90%;display:block;text-decoration:none;text-align:center;border-radius: 2px;color:#fff;font:15px Helvetica, Arial bold;cursor:pointer;border-radius:3px;margin:30px auto;padding:5px 0;border:0;width: 98%;}.button:active,.button:hover{background:#0069D2;color:#fff;}.content{color:#999;display:block;border-top:1px solid #eee;margin:10px 0;padding:10px;}li{color:#999;}li.current{color:#000;font-weight:700;}li span{float:right;margin-right:10px;font-size:11px;font-weight:700;color:#00B300;}.left > p{border-top:1px solid #eee;color:#999;font-size:12px;margin:0;padding:10px;}.left > p >a{color:#777;}.content > p{color:#222;font-weight:700;}span.ok{float:right;border-radius:3px;background:#00B300;color:#fff;padding:2px 10px;}span.fail{float:right;border-radius:3px;background:#B30000;color:#fff;padding:2px 10px;}span.warning{float:right;border-radius:3px;background:#D27900;color:#fff;padding:2px 10px;}.message{background:#1F800D;color:#fff;font:bold 15px Helvetica, Arial;border:1px solid #000;padding:10px;}.error{background:#980E0E;color:#fff;font:bold 15px Helvetica, Arial;border-bottom:1px solid #740C0C;border-top:1px solid #740C0C;margin:0;padding:10px;}.inner,.right > p{margin:10px;}	
	</style>
  </head>
  <body>
  	<div class="container">
  		<div class="left">
			<h3>Updating to 5.4</h3>
			<ol>
				<li<?php echo ($step=="1")?" class='current'":""?>>Update Information <?php echo ($step>"1")?"<span>Complete</span>":"" ?></li>				
				<li<?php echo ($step=="2")?" class='current'":""?>>Update Complete</li>
			</ol>
			<p>
				<a href="http://www.yunziyuan.com.cn/" target="_blank">Home</a> | 
				<a href="http://support.gempixel.com/" target="_blank">Support</a> | 
				<a href="http://www.yunziyuan.com.cn/profile" target="_blank">Profile</a> <br />
				2012-<?php echo date("Y") ?> &copy; <a href="http://www.yunziyuan.com.cn" target="_blank">某某</a> - All Rights Reserved
			</p>
  		</div>
  		<div class="right">
				<h1>Upgrading 某某短域名系统 to 5.4</h1> 
				<p>
					You are about to upgrade this software to version <strong>5.4</strong>. Please note that this will only update your database and NOT your files. It is strongly recommended that you first backup your database then your existing files in case something unexpected occurs. 
				</p>
				<p>
					Version 5.4 adds many new functionality including improvements in performance, features and security. For this reason, <strong>a lot of files</strong> were updated. <strong>Please read</strong> the update manual carefully in order to make sure the update is done as smoothly as possible. 
				</p>			
				<p>					
					If you have made a lot of changes to the script and wish to keep those changes, <strong>DO NOT UPDATE</strong> as this will completely overwrite the affected files. Also if you are happy with the current version, <strong>don't update</strong>. Otherwise, click the button below to proceed. <strong>Please make sure that this file is deleted at the end.</strong>
				</p>

				<a href="updater.php?step=2" class="button">I am ready, please update my database</a>		
  		</div>  		
  	</div>
  </body>
</html>
<?php 
function get_query($dbinfo){

		  $query[]="ALTER TABLE `{$dbinfo["prefix"]}url` ADD `uniqueclick` bigint(20) DEFAULT '0'";

			$query[] ="INSERT INTO `{$dbinfo["prefix"]}settings` (`config`, `var`) VALUES
								('schemes', 'https,ftp,http'),
								('email.activated', '<p><b>Hello</b></p><p>Your account has been successfully activated at {site.title}.</p>'),
								('email.activation', '<p><b>Hello!</b></p><p>You have been successfully registered at {site.title}. To login you will have to activate your account by clicking the URL below.</p><p><a href=\"http://{user.activation}\" target=\"_blank\">{user.activation}</a></p>'),
								('email.registration', '<p><b>Hello!</b></p><p>You have been successfully registered at {site.title}. You can now login to our site at <a href=\"http://{site.link}\" target=\"_blank\">{site.link}</a>.</p>'),
								('email.reset', '<p><b>A request to reset your password was made.</b> If you <b>didn\'t</b> make this request, please ignore and delete this email otherwise click the link below to reset your password.</p>\r\n		      <b><div style=\"text-align: center;\"><b><a href=\"http://{user.activation}\" class=\"link\">Click here to reset your password.</a></b></div></b></p><p>\r\n		      <p>If you cannot click on the link above, simply copy &amp; paste the following link into your browser.</p>\r\n		      <p><a href=\"http://{user.activation}\" target=\"_blank\">{user.activation}</a></p>\r\n		      <p><b>Note: This link is only valid for one day. If it expires, you can request another one.</b></p>');";

			$query[]="INSERT INTO `{$dbinfo["prefix"]}settings` (`config` ,`var`) VALUES ('purchasecode', '');";
			$query[]="INSERT INTO `{$dbinfo["prefix"]}settings` (`config` ,`var`) VALUES ('alias_length', '5');";
			$query[]="INSERT INTO `{$dbinfo["prefix"]}settings` (`config` ,`var`) VALUES ('theme_config', '');";

			$query[]="ALTER TABLE `{$dbinfo["prefix"]}user` ADD  `planid` int(9) DEFAULT NULL";

			$query[] = "CREATE TABLE IF NOT EXISTS `{$dbinfo["prefix"]}plans` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `name` varchar(255) DEFAULT NULL,
			  `slug` varchar(255) DEFAULT NULL,
			  `description` text,
			  `icon` varchar(255) DEFAULT NULL,
			  `price_monthly` float NOT NULL DEFAULT '0',
			  `price_yearly` float NOT NULL DEFAULT '0',
			  `free` int(1) NOT NULL DEFAULT '0',
			  `numurls` int(9) DEFAULT NULL,
			  `permission` text,
			  `status` int(1) NOT NULL DEFAULT '0',
			  `stripeid` varchar(255) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";

			$query[] = "CREATE TABLE IF NOT EXISTS `{$dbinfo["prefix"]}overlay` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `userid` int(9) DEFAULT NULL,
			  `name` varchar(255) DEFAULT NULL,
			  `data` text,
			  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`),
			  KEY `userid` (`userid`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";			
			
			$query[] = "CREATE TABLE IF NOT EXISTS `{$dbinfo["prefix"]}domains` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `userid` int(11) DEFAULT NULL,
		  `domain` varchar(255) DEFAULT NULL,
		  `status` int(1) NOT NULL DEFAULT '1',
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";

		$query[] = "CREATE TABLE IF NOT EXISTS `{$dbinfo["prefix"]}ads` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` varchar(255) DEFAULT NULL,
		  `type` enum('728','468','300','resp','splash','frame') DEFAULT NULL,
		  `code` text,
		  `impression` int(12) DEFAULT '0',
		  `enabled` enum('0','1') DEFAULT '1',
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

		$query[]="INSERT INTO `{$dbinfo["prefix"]}settings` (`config` ,`var`) VALUES
		('advanced', '0');";

		$query[]="INSERT INTO `{$dbinfo["prefix"]}settings` (`config` ,`var`) VALUES
		('allowdelete', '1'),
		('favicon', ''),
		('serverip', '');";

		$query[]="ALTER TABLE `{$dbinfo["prefix"]}subscription` ADD `planid` int(9) DEFAULT NULL";

		$query[]="ALTER TABLE `{$dbinfo["prefix"]}user` ADD `twitterpixel` text NULL";
		$query[]="ALTER TABLE `{$dbinfo["prefix"]}user` ADD `adrollpixel` text NULL";

		$query[]="ALTER TABLE `{$dbinfo["prefix"]}user` CHANGE `fbpixel` `fbpixel` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `adwordspixel` `adwordspixel` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `linkedinpixel` `linkedinpixel` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL";

		$query[]="UPDATE `{$dbinfo["prefix"]}user` SET  `fbpixel` =  '';";		
		$query[]="UPDATE `{$dbinfo["prefix"]}user` SET  `linkedinpixel` =  '';";		
		$query[]="UPDATE `{$dbinfo["prefix"]}user` SET  `adwordspixel` =  '';";		

		$query[]="INSERT INTO `{$dbinfo["prefix"]}settings` (`config` ,`var`) VALUES
		('homepage_stats', '1'),
		('home_redir', ''),
		('detectadblock', '0'),
		('timezone', ''),
		('freeurls', '10')";

	$query[]="ALTER TABLE `{$dbinfo["prefix"]}url` ADD `pixels` varchar(255) NULL";
	$query[]="ALTER TABLE `{$dbinfo["prefix"]}url` ADD `expiry` date NULL";
	$query[]="ALTER TABLE `{$dbinfo["prefix"]}user` ADD `address` text NULL";
	$query[]="ALTER TABLE `{$dbinfo["prefix"]}user` ADD `name` varchar(255) NULL";
	$query[]="ALTER TABLE `{$dbinfo["prefix"]}user` ADD `fbpixel` text(255) NULL";
	$query[]="ALTER TABLE `{$dbinfo["prefix"]}user` ADD `linkedinpixel` text(255) NULL";
	$query[]="ALTER TABLE `{$dbinfo["prefix"]}user` ADD `adwordspixel` text(255) NULL";
	$query[]="ALTER TABLE `{$dbinfo["prefix"]}user` ADD `defaulttype` varchar(255) NULL";

	// Add new Tables
	$query[]="UPDATE `{$dbinfo["prefix"]}settings` SET  `var` =  'cleanex' WHERE `config` =  'theme';";	
	$query[]="ALTER TABLE `{$dbinfo["prefix"]}url` ADD `domain` text NULL";
	$query[]="ALTER TABLE `{$dbinfo["prefix"]}stats` ADD `browser` text NULL";
	$query[]="ALTER TABLE `{$dbinfo["prefix"]}stats` ADD `os` text NULL";
	$query[]="ALTER TABLE `{$dbinfo["prefix"]}url` ADD `devices` text NULL";
	$query[]="ALTER TABLE `{$dbinfo["prefix"]}user` ADD `overlay` text NULL";

	$query[]="INSERT INTO `{$dbinfo["prefix"]}settings` (`config` ,`var`) VALUES ('devicetarget', '1');";

	$query[]="CREATE TABLE IF NOT EXISTS `{$dbinfo["prefix"]}payment` (
					  `id` int(11) AUTO_INCREMENT,
					  `tid` varchar(255) NULL,
					  `userid` bigint(20) NULL,
					  `status` varchar(255) NULL,
					  `amount` decimal(10,2) NULL,
					  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
					  `expiry` datetime NULL,
					  `data` text NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

	$query[]="CREATE TABLE IF NOT EXISTS `{$dbinfo["prefix"]}splash` (
					  `id` int(11) AUTO_INCREMENT,
					  `userid` bigint(12) NULL,
					  `name` varchar(255) NULL,
					  `data` text NULL,
					  `date` datetime NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";


	$query[]="UPDATE `{$dbinfo["prefix"]}settings` SET  `config` =  'pro_yearly' WHERE `config` = 'custom_splash_amount';";
	$query[]="UPDATE `{$dbinfo["prefix"]}settings` SET  `config` =  'pro_monthly' WHERE `config` =  'removal_amount';";

	$query[]="INSERT INTO `{$dbinfo["prefix"]}settings` (`config` ,`var`) VALUES
		('smtp', ''),
		('style', ''),
		('font', ''),
		('currency', 'USD'),
		('news', ''),
		('gl_connect', '0'),
		('require_registration', '0'),
		('phish_api', ''),
		('aliases', '');";

	$query[]="INSERT INTO `{$dbinfo["prefix"]}settings` (`config` ,`var`) VALUES
		('pro', '1'),
		('google_cid', ''),
		('google_cs', ''),
		('public_dir', '0');";
		
	//Update stats Table
	$query[]="ALTER TABLE `{$dbinfo["prefix"]}stats` ADD `urlid` bigint(20) NULL";
	$query[]="ALTER TABLE `{$dbinfo["prefix"]}stats` ADD `urluserid` bigint(20) NULL DEFAULT '0'";
	$query[]="ALTER TABLE `{$dbinfo["prefix"]}stats` ADD `domain` varchar(50) NULL";
 	// Update URL Table
 	$query[]="ALTER TABLE `{$dbinfo["prefix"]}url` ADD `type` varchar(50) NULL DEFAULT ''";
 	// Update User Table
 	$query[]="ALTER TABLE `{$dbinfo["prefix"]}user` ADD `auth_key` varchar(100) NULL";
 	$query[]="ALTER TABLE `{$dbinfo["prefix"]}user` ADD `last_payment` datetime NULL";
 	$query[]="ALTER TABLE `{$dbinfo["prefix"]}user` ADD `expiration` datetime NULL";
 	$query[]="ALTER TABLE `{$dbinfo["prefix"]}user` ADD `pro` int(1) NULL DEFAULT '0'";

	return $query;
}

?>