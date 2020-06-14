<?php 
/**
 * ====================================================================================
 *                           5G云短网址系统
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
 * @package 5G云短网址系统
 * @subpackage Application installer
 */
	if(!isset($_SESSION)) session_start();
	$error="";
	$message=(isset($_SESSION["msg"])?$_SESSION["msg"]:"");
	if(!isset($_GET["step"]) || $_GET["step"]=="1" || $_GET["step"] < "1"){
		$step = "1";
	}elseif($_GET["step"] > "1" && $_GET["step"]<="5"){
		$step = $_GET["step"];
	}else{
		die("哎呀！看起来你没有按照说明做！请按照说明操作，否则您将无法安装此脚本。");
	}
	switch ($step) {
		case '2':
			if(file_exists("includes/config.php")) $error='配置文件已存在。请删除或重命名“config.php”重新上传“config_sample.php”。';  

			if(isset($_POST["step2"])){
			if (empty($_POST["host"]))  $error.="<p>- 数据库主机必须填写.</p>"; 
            if (empty($_POST["name"])) $error.="<p>- 数据库名必须填写.</p>"; 
            if (empty($_POST["user"])) $error.="<p>- 数据库账户必须填写.</p>"; 
	            if(empty($error)){
					 try{
					    $db = new PDO("mysql:host=".$_POST["host"].";dbname=".$_POST["name"]."", $_POST["user"], $_POST["pass"]);
						generate_config($_POST);
		                $query=get_query();
						foreach ($query as $q) {
						  $db->query($q);
						} 
						$_SESSION["msg"]="数据库连接成功";
						header("Location: install.php?step=3");
					  }catch (PDOException $e){
					    $error = $e->getMessage();
					  }
          }							
			}
		break;
		case '3':
			if(!file_exists("includes/config.php")) die("<div class='error'>找不到includes/config.php文件。如果文件includes/config_sample.php存在，请将其重命名为includes/config.php并刷新此页。</div>");			
					@include("includes/config.php");
					

					$_SESSION["msg"]="";

					if($db->get("user",["admin"=>"1"], ["limit" => "1"])){
						$error.="<div class='error'>您已经创建了一个管理员帐户！您不能再使用此表单。</div>"; 
					}

			    if(isset($_POST["step3"])){
			            if (empty($_POST["email"]))  $error.="<div class='error'>邮箱未设置.</div>"; 
			            if (empty($_POST["pass"])) $error.="<div class='error'>密码未设置.</div>"; 
			            if (empty($_POST["url"])) $error.="<div class='error'>网址未设置.</div>"; 
			    	if(!$error){

			    	$data=array(
				    	":admin"=>"1",
				    	":email"=>$_POST["email"],
				    	":username"=>$_POST["username"],
				    	":password"=>Main::encode($_POST["pass"]),
				    	":date"=>"NOW()",
				    	":pro"=>"1",
				    	":auth_key"=>Main::encode(Main::strrand()),
				    	":last_payment" => date("Y-m-d H:i:s",time()),
				    	":expiration" => date("Y-m-d H:i:s",time()+315360000),
				    	":api" => Main::strrand(12)
			    	);

					  $db->insert("user",$data);					  
					  $db->update("settings",array("var"=>"?"),array("config"=>"?"),array($_POST["url"],"url"));
					  $db->update("settings",array("var"=>"?"),array("config"=>"?"),array($_POST["email"],"email"));
					  $_SESSION["msg"]="您的管理帐户已成功创建.";
					  $_SESSION["site"]=$_POST["url"];
					  $_SESSION["username"]=$_POST["username"];
					  $_SESSION["email"]=$_POST["email"];
					  $_SESSION["password"]=$_POST["pass"];
					  header("Location: install.php?step=4"); 
			        }   
			    }		
		break;
		case '4':
			$_SESSION["msg"]="";
			@include("includes/config.php");
					if(!file_exists(ROOT."/.htaccess")){
					  	$content = "### Generated on ".date("d-m-Y H:i:s", strtotime("now"))."\nRewriteEngine On\n#Rewritebase /\n## Admin \nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteRule ^admin/(.*)?$ admin/index.php?a=$1 [QSA,NC,L]\nRewriteRule ^sitemap.xml$ sitemap.php\n## App \nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteRule ^(.*)?$ index.php?a=$1	[QSA,NC,L]\nErrorDocument 404 /index.php?a=404";
					  	$file = fopen(ROOT."/.htaccess", "w");
					  	fwrite($file, $content);
					  	fclose($file);						
					}
		break;
		case '5':
			header("Location: index.php"); 
			unset($_SESSION);
			unlink(__FILE__);
			
			if(file_exists("main.zip")){
				unlink('main.zip');
			}
			if(file_exists("updater.php")){
				unlink('updater.php');
			}
		break;
	}
 ?>
<!DOCTYPE html>
<html lang="zh">
  <head>
    <meta charset="utf-8">
    <title>5G云短网址系统安装</title>
	<style type="text/css">
		body{background:#fbfbfb;font-family:Helvetica, Arial;width:860px;line-height:25px;font-size:13px;margin:0 auto;}a{color:#009ee4;font-weight:700;text-decoration:none;}a:hover{color:#000;text-decoration:none;}.container{background:#fff;border:1px solid #eee;box-shadow:0 10px 30px rgba(0,0,0,0.15);border-radius:3px;display:block;overflow:hidden;margin:50px 0;}.container h1{font-size:22px;display:block;border-bottom:1px solid #eee;margin:0!important;padding:10px;}.container h2{color:#999;font-size:18px;margin:10px;}.container h3{background:#f8f8f8;border-bottom:1px solid #eee;border-radius:3px 0 0 0;text-align:center;margin:0;padding:10px 0;}.left{float:left;width:258px;}.right{float:left;width:599px;border-left:1px solid #eee;}.form{width:90%;display:block;    padding: 10px 20px;}.form label{font-size:15px;font-weight:700;margin:20px 0px 5px;display: block;}.form label a{float:right;color:#009ee4;font:bold 12px Helvetica, Arial; padding-top: 5px;}.form .input{display:block;width:95%;height:15px;border:1px #ccc solid;font:bold 15px Helvetica, Arial;color:#aaa;border-radius:25px;box-shadow: 0 5px 10px rgba(0,0,0,0.1);margin:10px 0;padding:10px 25px;}.form .input:focus{border:1px #73B9D9 solid;outline:none;color:#222;box-shadow:inset 1px 1px 3px #ccc,0 0 0 3px #DEF1FA;}.form .button{height:35px;}.button{background-color: #4f37ac;font-weight: 700;background-image: -moz-linear-gradient(0deg, #0854a9 0%, #4f37ac 100%);background-image: -webkit-linear-gradient(0deg, #0854a9 0%, #4f37ac 100%);width:90%;display:block;text-decoration:none;text-align:center;border-radius: 2px;color:#fff;font:15px Helvetica, Arial bold;cursor:pointer;border-radius:25px;margin:30px auto; padding:10px 0;border:0;}.button:active,.button:hover{opacity: 0.9; color: #fff;}.content{color:#999;display:block;border-top:1px solid #eee;margin:10px 0;padding:10px;}li{color:#999;}li.current{color:#000;font-weight:700;}li span{float:right;margin-right:10px;font-size:11px;font-weight:700;color:#00B300;}.left > p{border-top:1px solid #eee;color:#999;font-size:12px;margin:0;padding:10px;}.left > p >a{color:#777;}.content > p{color:#222;font-weight:700;}span.ok{float:right;border-radius:3px;background-color: #59d8c5;font-weight: 700;background-image: -moz-linear-gradient(0deg, #59d8c5 0%, #68b835 100%);background-image: -webkit-linear-gradient(0deg, #59d8c5 0%, #68b835 100%);background-image: -ms-linear-gradient(0deg, #59d8c5 0%, #68b835 100%);color:#fff;padding:2px 10px;}span.fail{float:right;border-radius:3px;background-color: #FF3146;font-weight: 700;background-image: -moz-linear-gradient(0deg, #f04c74 0%, #FF3146 100%);background-image: -webkit-linear-gradient(0deg, #f04c74 0%, #FF3146 100%);background-image: -ms-linear-gradient(0deg, #f04c74 0%, #FF3146 100%);color:#fff;padding:2px 10px;}span.warning{float:right;border-radius:3px;background:#D27900;color:#fff;padding:2px 10px;}.message{background:#1F800D;color:#fff;font:bold 15px Helvetica, Arial;border:1px solid #000;padding:10px;}.error{    background-color: #FF3146;background-image: -moz-linear-gradient(0deg, #f04c74 0%, #FF3146 100%);background-image: -webkit-linear-gradient(0deg, #f04c74 0%, #FF3146 100%);background-image: -ms-linear-gradient(0deg, #f04c74 0%, #FF3146 100%);color:#fff;font:bold 15px Helvetica, Arial;margin:0;padding:10px;}.inner,.right > p{margin:10px;}
	</style>
  </head>
  <body>
  	<div class="container">
  		<div class="left">
			<h3>安装过程</h3>
			<ol>
				<li<?php echo ($step=="1")?" class='current'":""?>>服务器环境测试 <?php echo ($step>"1")?"<span>ok</span>":"" ?></li>
				<li<?php echo ($step=="2")?" class='current'":""?>>数据库配置信息<?php echo ($step>"2")?"<span>ok</span>":"" ?></li>
				<li<?php echo ($step=="3")?" class='current'":""?>>网站基本设置<?php echo ($step>"3")?"<span>ok</span>":"" ?></li>
				<li<?php echo ($step=="4")?" class='current'":""?>>安装完成</li>
			</ol>
			<p>
				<a href="http://www.yunziyuan.com.cn/" target="_blank">主页</a> | 
				<a href="http://www.yunziyuan.com.cn/" target="_blank">帮助</a> | 
				<a href="http://www.yunziyuan.com.cn/" target="_blank">更新</a> <br />
				2012-<?php echo date("Y") ?> &copy; <a href="http://www.yunziyuan.com.cn" target="_blank">某某</a> - All Rights Reserved
			</p>
  		</div>
  		<div class="right">
					<h1>5G云短网址系统安装</h1> 
					<?php if(!empty($message)) echo "<div class='message'>$message</div>"; ?>
					<?php if(!empty($error)) echo "<div class='error'>$error</div>"; ?>
					<?php if($step=="1"): ?>		
						<h2>1.0 服务器环境测试</h2>
						<p>
							5G云短网址系统是一个专业的网址缩略的脚本代码，其主要功能有：完整的后台管理、功能齐全的用户面板、用户系统、社交分享、短网址统计、短网址自定义、多国语言支持、社交分享以及API系统等。
						</p>
						<div class="content">
							<p>
							PHP 版本 (最低需要php 5.5)
							<?php echo check('version')?>
							</p>
							使用该系统必须PHP 5.5版以上，强烈建议您使用7.0或更高版本以获得更好的性能。
						</div>
						<div class="content">
							<p>PDO 必须开启 
								<?php echo check('pdo')?>
							</p>
							PDO驱动程序非常重要，因此必须启用它。如果没有这个，系统将无法连接到数据库，因此它根本不起作用。如果此检查失败，您将需要联系您的Web主机商并要求他们启用它或正确配置它。
						</div>					
						<div class="content">
							<p><i>config_sample.php</i> 可写. 
								<?php echo check('config')?>
							</p>
							安装系统必须保证 <b>includes</b> 文件夹的config_sample.php文件可写.
						</div>		
						<div class="content">
							<p><i>content/</i> 可写. 
								<?php echo check('content')?>
							</p>
							保证content/文件夹可写.
						</div>												
						<div class="content">
							<p><i>allow_url_fopen</i> 状态
								<?php echo check('file')?>
							</p>
							 <strong>file_get_contents</strong> 函数用于与外部服务器或API交互。.
						</div>
						<div class="content">
							<p>cURL 状态 <?php echo check('curl')?></p>
							cURL用于与外部服务器或API交互.
						</div>				
					<?php if(!$error) echo '<a href="?step=2" class="button">下一步</a>'?>
					<?php elseif($step=="2"): ?>	
					<h2>2.0 数据库配置信息</h2>
					<p>
						设置Mysql数据库信息.
					</p>
					<form method="post" action="?step=2" class="form">
					    <label>数据库地址 <a>一般为 localhost 或 127.0.0.1</a></label>
					    <input type="text" name="host" class="input" required />
					    
					    <label>数据库名</label>
					    <input type="text" name="name" class="input" required />
					    
					    <label>数据库账号 </label>
					    <input type="text" name="user" class="input" required />    
					    
					    <label>数据库密码</label>
					    <input type="password" name="pass" class="input" />   

					    <label>数据库表前缀 <a>推荐使用&nbsp;short_</a></label>
					    <input type="text" name="prefix" class="input" value="" />       

					    <label>安全密钥（保密） <a>禁止修改!</a></label>
					    <input type="text" name="key" class="input" value="<?php echo md5(rand(0,100000)) ?>" />   

					    <button type="submit" name="step2" class='button'>下一步</button>    
					</form>
					<?php elseif($step=="3"): ?>
					<p>网站基本设置
					</p>
					  <form method="post" action="?step=3" class="form">
					        <label>管理员邮箱</label>
					        <input type="text" name="email" class="input" required />

					        <label>管理员账号</label>
					        <input type="text" name="username" class="input" required />	

					        <label>管理员密码</label>
					        <input type="password" name="pass" class="input" required />   

					        <label>网址地址 <a>不需要/结尾</a></label>
					        <input type="text" name="url" class="input" value="<?php echo get_domain() ?>" placeholder="http://" required />  

					        <input type="submit" name="step3" value="完成安装" class='button' />     
					  </form>		
					<?php elseif($step=="4"): ?>
				       <p>
			 				5G云短网址系统安装完成. 
				       </p>
				       <p>
				       	  马上登陆后台瞧一瞧呗！
				       </p>
				       <p>
				       <strong>登录地址: <a href="<?php get('site') ?>/user/login" target="_blank"><?php get('site') ?>/user/login</a></strong> <br />
				       <strong>邮箱: <?php get('email') ?></strong> <br />
				       <strong>用户名: <?php get('username') ?></strong> <br />
				       <strong>密码: <?php get('password') ?></strong>
				       </p>	       
				       <a href="?step=5" class="button">删除 install.php文件</a>	       
					<?php endif; ?>					
  		</div>  		
  	</div>
  </body>
</html>
<?php 
function get_domain(){
	$http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
	$url = "{$http}://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$url = str_replace("/install.php?step=3", "", $url);
	return $url;
}
function get($what){
	if(isset($_SESSION[strip_tags(trim($what))])){
		echo $_SESSION[strip_tags(trim($what))];
	}
}
function check($what){
	switch ($what) {
		case 'version':
			if(PHP_VERSION >= "5.5"){
				return "<span class='ok'>".PHP_VERSION."</span>";
			}else{
				global $error;
				$error.=1;
				return "<span class='fail'>".PHP_VERSION."</span>";
			}
			break;
		case 'config':
			if(@file_get_contents('includes/config_sample.php') && is_writable('includes/config_sample.php')){
				return "<span class='ok'>可写</span>";
			}else{
				global $error;
				$error.=1;
				return "<span class='fail'>不可写</span>";
			}
			break;
		case 'content':
			if(is_writable('content')){
				return "<span class='ok'>可写</span>";
			}else{
				global $error;
				$error.=1;
				return "<span class='fail'>不可写</span>";
			}
			break;			
		case 'pdo':
			if(defined('PDO::ATTR_DRIVER_NAME') && class_exists("PDO")){
				return "<span class='ok'>启用</span>";
			}else{
				global $error;
				$error.=1;
				return "<span class='fail'>未启用</span>";
			}
			break;
		case 'file':
			if(ini_get('allow_url_fopen')){
				return "<span class='ok'>启用</span>";
			}else{
				return "<span class='warning'>未启用</span>";
			}
			break;	
		case 'curl':
			if(in_array('curl', get_loaded_extensions())){
				return "<span class='ok'>启用</span>";
			}else{
				return "<span class='warning'>未启用</span>";
			}
			break;						
	}
}
function get_query(){

$query[] = "CREATE TABLE IF NOT EXISTS `".trim($_POST["prefix"])."ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` enum('728','468','300','resp','splash','frame') DEFAULT NULL,
  `code` text,
  `impression` int(12) DEFAULT '0',
  `enabled` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$query[] = "CREATE TABLE IF NOT EXISTS `".trim($_POST["prefix"])."bundle` (
  `id` int(11) AUTO_INCREMENT,
  `name` varchar(255) NULL,
  `userid` mediumint(9) NULL,
  `date` datetime NULL,
  `access` varchar(10) NOT NULL DEFAULT 'private',
  `view` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

$query[] = "CREATE TABLE IF NOT EXISTS `".trim($_POST["prefix"])."domains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";

$query[] = "CREATE TABLE IF NOT EXISTS `".trim($_POST["prefix"])."overlay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(9) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `data` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";

$query[] = "CREATE TABLE IF NOT EXISTS `".trim($_POST["prefix"])."page` (
  `id` int(11) AUTO_INCREMENT,
  `name` varchar(255) NULL,
  `seo` varchar(255) NULL,
  `content` text NULL,
  `menu` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;";

$query[] = "CREATE TABLE IF NOT EXISTS `".trim($_POST["prefix"])."payment` (
  `id` int(11) AUTO_INCREMENT,
  `tid` varchar(255) NULL,
  `userid` bigint(20) NULL,
  `status` varchar(255) NULL,
  `amount` decimal(10,2) NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiry` datetime NULL,
  `data` text NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$query[] = "CREATE TABLE IF NOT EXISTS `".trim($_POST["prefix"])."plans` (
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

$query[] = "CREATE TABLE IF NOT EXISTS `".trim($_POST["prefix"])."settings` (
  `config` varchar(255),
  `var` text NULL,
  PRIMARY KEY (`config`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";


$query[] = "INSERT INTO `".trim($_POST["prefix"])."settings` (`config`, `var`) VALUES
('url', ''),
('title', ''),
('description', ''),
('api', '1'),
('user', '1'),
('sharing', '1'),
('geotarget', '1'),
('adult', '1'),
('maintenance', '0'),
('keywords', ''),
('theme', 'cleanex'),
('apikey', ''),
('ads', '1'),
('captcha', '0'),
('ad728', ''),
('ad468', ''),
('ad300', ''),
('frame', '0'),
('facebook', ''),
('twitter', ''),
('email', ''),
('fb_connect', '0'),
('analytic', ''),
('private', '0'),
('facebook_app_id', ''),
('facebook_secret', ''),
('twitter_key', ''),
('twitter_secret', ''),
('safe_browsing', ''),
('captcha_public', ''),
('captcha_private', ''),
('tw_connect', '0'),
('multiple_domains', '0'),
('domain_names', ''),
('tracking', '1'),
('update_notification', '0'),
('default_lang', 'ch'),
('user_activate', '0'),
('domain_blacklist', ''),
('keyword_blacklist', ''),
('user_history', '0'),
('pro_yearly', ''),
('show_media', '0'),
('pro_monthly', ''),
('paypal_email', ''),
('logo', ''),
('timer', ''),
('smtp', ''),
('style', ''),
('font', ''),
('currency', 'RMB'),
('news', '<strong>安装完成</strong> 请转到“管理面板”设置!'),
('gl_connect', '0'),
('require_registration', '0'),
('phish_api', ''),
('aliases', ''),
('pro', '1'),
('google_cid', ''),
('google_cs', ''),
('public_dir', '0'),
('devicetarget', '1'),
('homepage_stats', '1'),
('home_redir', ''),
('detectadblock', '0'),
('timezone', ''),
('freeurls', '10'),
('allowdelete', '1'),
('serverip', ''),
('favicon', ''),
('advanced', '0'),
('purchasecode', ''),
('alias_length', '5'),
('theme_config', ''),
('schemes', 'https,ftp,http'),
('email.activated', '<p><b>Hello</b></p><p>您的帐户已在 {site.title} 成功激活.</p>'),
('email.activation', '<p><b>Hello!</b></p><p>您已在{site.title}成功注册。要登录，您必须通过单击下面的URL激活您的帐户。.</p><p><a href=\"http://{user.activation}\" target=\"_blank\">{user.activation}</a></p>'),
('email.registration', '<p><b>Hello!</b></p><p>您已在{site.title}成功注册。您现在可以登录我们的网站 <a href=\"http://{site.link}\" target=\"_blank\">{site.link}</a>.</p>'),
('email.reset', '<p><b>请求修改密码.</b> 如果您 <b>没有</b> 发出此请求，请忽略并删除此电子邮件，否则单击下面的链接重置密码。</p>\r\n		      <b><div style=\"text-align: center;\"><b><a href=\"http://{user.activation}\" class=\"link\">点击这里修改密码.</a></b></div></b></p><p>\r\n		      <p>如果您无法单击上面的链接，只需将以下链接复制并粘贴到浏览器中即可。</p>\r\n		      <p><a href=\"http://{user.activation}\" target=\"_blank\">{user.activation}</a></p>\r\n		      <p><b>注意：此链接仅在一天内有效。如果过期，请重新申请。</b></p>');";


$query[] = "CREATE TABLE IF NOT EXISTS `".trim($_POST["prefix"])."splash` (
  `id` int(11) AUTO_INCREMENT,
  `userid` bigint(12) NULL,
  `name` varchar(255) NULL,
  `data` text NULL,
  `date` datetime NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";


$query[] = "CREATE TABLE IF NOT EXISTS `".trim($_POST["prefix"])."stats` (
  `id` int(11) AUTO_INCREMENT,
  `short` varchar(255) NULL,
  `urlid` bigint(20) NULL,
  `urluserid` bigint(20) NOT NULL DEFAULT '0',
  `date` datetime NULL,
  `ip` varchar(255) NULL,
  `country` varchar(255) NULL,
  `domain` varchar(50) NULL,
  `referer` text NULL,
  `browser` text NULL,
  `os` text NULL,    
  PRIMARY KEY (`id`),
  KEY `short` (`short`),
  KEY `ip` (`ip`),
  KEY `urlid` (`urlid`)  
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$query[] = "CREATE TABLE IF NOT EXISTS `".trim($_POST["prefix"])."url` (
  `id` int(20) AUTO_INCREMENT,
  `userid` int(16) NOT NULL DEFAULT '0',
  `alias` varchar(10) NULL,
  `custom` varchar(160) NULL,
  `url` text NULL,
  `location` text NULL,
  `devices` text NULL,
  `domain` text NULL,
  `description` text NULL,
  `date` datetime NULL,
  `pass` varchar(255) NULL,
  `click` bigint(20) NOT NULL DEFAULT '0',
  `uniqueclick` bigint(20) NOT NULL DEFAULT '0',
  `meta_title` varchar(255) NULL,
  `meta_description` varchar(255) NULL,
  `ads` int(1) NOT NULL DEFAULT '1',
  `bundle` mediumint(9) NULL,
  `public` int(1) NOT NULL DEFAULT '0',
  `archived` int(1) NOT NULL DEFAULT '0',
  `type` varchar(64) NULL,
  `pixels` varchar(255) NULL,
  `expiry` date NULL,
  PRIMARY KEY (`id`),
  KEY `alias` (`alias`),
  KEY `custom` (`custom`),
  KEY `pixels` (`pixels`)  
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";


$query[] = "CREATE TABLE IF NOT EXISTS `".trim($_POST["prefix"])."user` (
  `id` int(11) AUTO_INCREMENT,
  `auth` text NULL,
  `auth_id` varchar(255) NULL,
  `admin` int(1) NOT NULL DEFAULT '0',
  `email` varchar(255) NULL,
  `name` varchar(255) NULL,
  `username` varchar(255) NULL,
  `password` varchar(255) NULL,
  `address` text NULL,
  `date` datetime NULL,
  `api` varchar(255) NULL,
  `ads` int(1) NOT NULL DEFAULT '1',
  `active` int(1) NOT NULL DEFAULT '1',
  `banned` int(1) NOT NULL DEFAULT '0',
  `public` int(1) NOT NULL DEFAULT '0',
  `domain` varchar(255) NULL,
  `media` int(1) NOT NULL DEFAULT '0',
  `splash_opt` int(1) NOT NULL DEFAULT '0',
  `splash` text NULL,
  `auth_key` varchar(255) NULL,
  `last_payment` datetime NULL,
  `expiration` datetime NULL,
  `pro` int(1) NOT NULL DEFAULT '0',
  `planid` int(9) DEFAULT NULL,
  `overlay` text NULL,
  `fbpixel` text NULL,
  `linkedinpixel` text NULL,
  `adwordspixel` text NULL,
  `twitterpixel` text NULL,
  `adrollpixel` text NULL,
  `defaulttype` varchar(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `api` (`api`),
  KEY `username` (`username`),
  KEY `email` (`email`)  
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

$query[]=<<<QUERY
INSERT INTO `{$_POST["prefix"]}page` (`id`, `name`, `seo`, `content`, `menu`) VALUES
(1, 'Terms and Conditions', 'terms', 'Please edit me when you can. I am very important.', 1);
QUERY;
return $query;
}
function generate_config($array){
	if(!empty($array)){
	    $file=file_get_contents('includes/config_sample.php');
	    $file=str_replace("RHOST",trim($array["host"]),$file);
	    $file=str_replace("RDB",trim($array["name"]),$file);
	    $file=str_replace("RUSER",trim($array["user"]),$file);
	    $file=str_replace("RPASS",trim($array["pass"]),$file);                
	    $file=str_replace("RPRE",trim($array["prefix"]),$file);  
	    $file=str_replace("RPUB",trim(md5(api())),$file);
	    $file=str_replace("RKEY",trim($array["key"]),$file);
	    $fh = fopen('includes/config_sample.php', 'w') or die("Can't open config_sample.php. Make sure it is writable.");
	    fwrite($fh, $file);
	    fclose($fh); 
	    rename("includes/config_sample.php", "includes/config.php");
	}
}
function api(){
          $l='12';
          $api="";
          $r= "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
            srand((double)microtime()*1000000); 
            for($i=0; $i<$l; $i++) { 
              $api.= $r[rand()%strlen($r)]; 
            } 
          return $api;    
      }
?>
