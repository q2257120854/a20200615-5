<?php
define('ROOT', dirname(dirname(__FILE__)).'/');

error_reporting(E_ALL & ~E_NOTICE);

include(ROOT. 'includes/version.php');
include(ROOT. 'includes/class.DBMysql.php');
include(ROOT. 'includes/class.DBMysqli.php');


$DB = 0; //数据库连接

// ############################## FUNCTIONS ##############################

function IsName($name){
	$entities_match = array(',',';','$','!','@','#','%','^','&','*','(',')','{','}','|',':','"','<','>','?','[',']','\\',"'",'/','*','+','~','`','=');
	for ($i = 0; $i<count($entities_match); $i++) {
	     if(strpos($name, $entities_match[$i])){
               return false;
		 }
	}
   return true;
}

function PassGen($length = 8){
	$str = 'abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	for ($i = 0, $passwd = ''; $i < $length; $i++)
		$passwd .= substr($str, mt_rand(0, strlen($str) - 1), 1);
	return $passwd;
}


//判断是否为https
function is_https()
{
	if ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off')
	{
		return TRUE;
	}
	elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https')
	{
		return TRUE;
	}
	elseif ( ! empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off')
	{
		return TRUE;
	}

	return FALSE;
}

// ############################## HEADER AND FOOTER ############################

echo '<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>WeLive在线客服系统 - 安装向导</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div id="logo">
	<img src="img/logo.png" alt="WeLive">
</div>
<div id="main">';

$footer = '</div>
<div id="copyright">
	'.date("Y").' &copy; WeLive '. $WeLiveVersion .' <a href="http://www.yunziyuan.com.cn" target="_blank">云资源</a>
</div>
</body>
</html>';

// ################# CHECK IF ALREADY INSTALLED ##################

@include(ROOT . 'config/config.php');

if(defined('SYSDIR')){
	echo '<font class=red><b>WeLive在线客服系统已经安装!</b></font><BR><BR>
	如果您希望重新安装，请先删除config/目录下的config.php文件。<BR><BR>';

	echo $footer;
	exit();
}elseif(!extension_loaded('sockets')){
	echo '<font class=red><b>服务器Socket扩展未加载, 无法安装WeLive!</b></font><BR><BR>
	关于PHP如何加载Socket扩展，百度一下即可。<BR><BR>';

	echo $footer;
	exit();
}

// ############################### GET POST VARS ###############################

$servername      = isset($_POST['install']) ? trim($_POST['servername'])      : 'localhost';
$dbname          = isset($_POST['install']) ? trim($_POST['dbname'])          : '';
$dbusername      = isset($_POST['install']) ? trim($_POST['dbusername'])      : '';
$dbpassword      = isset($_POST['install']) ? trim($_POST['dbpassword'])      : '';
$tableprefix     = isset($_POST['install']) ? trim($_POST['tableprefix'])     : 'welive_';
$confirmprefix     = isset($_POST['install']) ? trim($_POST['confirmprefix'])     : '';

$username        = isset($_POST['install']) ? trim($_POST['username'])        : '';
$password        = isset($_POST['install']) ? trim($_POST['password'])        : '';
$confirmpassword = isset($_POST['install'])? trim($_POST['confirmpassword']) : '';
$email           = isset($_POST['install']) ? trim($_POST['email']) : '';

$tableprefix_err = 0;

// ############################ INSTALL #############################

if(isset($_POST['install'])){
	// check for errors
	@chmod(ROOT . 'welive.js', 0777);
	@chmod(ROOT . 'avatar/', 0777);
	@chmod(ROOT . 'config/', 0777);
	@chmod(ROOT . 'config/settings.php', 0777);
	@chmod(ROOT . 'config/1f5fb85bd9c392d03f659a9c15756777.txt', 0777);
	@chmod(ROOT . 'upload/upload/img/', 0777);

	if (!is_writable(ROOT . 'welive.js'))
		$installerrors[] = '请将根目录下的welive.js文件的属性设置为: 777';

	if (!is_writable(ROOT . 'avatar/'))
		$installerrors[] = '请将avatar文件夹的属性设置为: 777';

	if (!is_writable(ROOT . 'config/'))
		$installerrors[] = '请将config文件夹的属性设置为: 777';

	if(!is_writeable(ROOT . 'config/settings.php')) {
		$installerrors[] = '请将系统配置文件config/settings.php设置为可写, 即属性设置为: 777';
	}

	if(!is_writeable(ROOT . 'config/1f5fb85bd9c392d03f659a9c15756777.txt')) {
		$installerrors[] = '请将config/1f5fb85bd9c392d03f659a9c15756777.txt文件设置为可写, 即属性设置为: 777';
	}

	if (!is_writable(ROOT . 'upload/img/'))
		$installerrors[] = '请将upload/img/文件夹的属性设置为: 777';


	if(strlen($username) == 0){
		$installerrors[] = '请输入系统管理员用户名.';
	}else if(!IsName($username)){
		$installerrors[] = '用户名中含有非法字符.';
	}

	if(strlen($password) == 0){
		$installerrors[] = '请输入系统管理员密码.';
	}

	if(is_numeric($dbname)){
		$installerrors[] = '数据库名必须包含字母.';
	}

	if($password != $confirmpassword) $installerrors[] = '管理员密码与确认密码不相同.';
	if(strlen($email) == 0) $installerrors[] = '请输入管理员电子信箱.';

	if(strlen($tableprefix) == 0){
		$installerrors[] = '请输入数据库表前缀.';
	}else if(!preg_match('/^[A-Za-z0-9]+_$/', $tableprefix)){
		$installerrors[] = '数据库表前缀只能是英文字母或数字, 而且必需以 _ 结尾.';
	}

	if(!isset($installerrors)){
		// Determine if MySql is installed
		if(function_exists('mysql_connect') OR function_exists('mysqli_connect')){

			if(function_exists('mysqli_connect')){
				$DB = new DBMysqli($dbusername, $dbpassword, $dbname,  $servername); //MSQLI
				$sqlversion = @mysqli_get_server_info();
				$dbmysql  = 'mysqli';
			}else{
				$DB = new DBMysql($dbusername, $dbpassword, $dbname,  $servername);
				$sqlversion = @mysql_get_server_info();
				$dbmysql  = 'mysql';
			}

			// attempt to connect to the database
			if($DB->conn){

				if(empty($sqlversion)) $sqlversion='5.0';

				$DB->query("set names 'utf8'");
				$DB->query("SET COLLATION_CONNECTION='utf8_general_ci'");
				$DB->query("ALTER DATABASE `$dbname` DEFAULT CHARACTER SET utf8 COLLATE 'utf8_general_ci'");

				if($sqlversion >= '5.0') $DB->query("SET sql_mode=''");

			}else{
				// could not connect
				$installerrors[] = '无法连接MySql数据库服务器.';
			}
		}else{
			// mysql extensions not installed
			$installerrors[] = '网站服务器环境不支持MySql数据库.';
		}
	}

	if(!isset($installerrors)){
		$SqlLines = @file('welive.sql');
		if (!$SqlLines) {
			$installerrors[] = '无法加载数据文件: install/welive.sql';
		} else {
			if(!$confirmprefix) {
				if($query = $DB->query("SHOW TABLES FROM $dbname")) {
					while($row = $DB->fetch($query)) {
						if(preg_match("/^$tableprefix/", $row["Tables_in_{$dbname}"])) {
							$tableprefix_err = 1;
							break;
						}
					}
				}
			}

			if(!$tableprefix_err){

				//解决PHP7 Opcache开启时无法实时更新设置的问题
				if(function_exists('opcache_reset')) {
					@opcache_reset();
				}

				$sql = implode('', $SqlLines);

				/* 删除SQL行注释，行注释不匹配换行符 */
				$sql = preg_replace('/^\s*(?:--|#).*/m', '', $sql);

				/* 删除SQL块注释，匹配换行符，且为非贪婪匹配 */
				$sql = preg_replace('/^\s*\/\*.*?\*\//ms', '', $sql);

				/* 删除SQL串首尾的空白符 */
				$sql = trim($sql);

				/* 替换表前缀 */
				$sql = preg_replace('/((TABLE|INTO|IF EXISTS)\s+`)welive_/', '${1}' . $tableprefix, $sql);

				/* 解析查询项 */
				$sql = str_replace("\r", '', $sql);
				$query_items = explode(";\n", $sql);

				foreach ($query_items AS $query_item){
					/* 如果查询项为空，则跳过 */
					if (!$query_item){
						continue;
					}else{
						$DB->query($query_item);
					}
				}

				$DB->query("INSERT INTO " . $tableprefix . "admin (aid, type, activated, username, password, email, first, fullname, fullname_en, post, post_en)  VALUES (1, 1, 1, '$username', '".md5($password)."', '$email', '".time()."', '管理员', 'Admin', '系统管理员', 'Administrator')");

				$thisfiledirname = substr(str_replace(dirname(dirname(dirname(__FILE__))), '', dirname(dirname(__FILE__))), 1);
				$script_name = $_SERVER['SCRIPT_NAME'];

				if (strstr($script_name, $thisfiledirname.'/')){
					$thiswebsitedir = str_replace(strstr($script_name, $thisfiledirname.'/'), '', $script_name);
					$SYSDIR = $thiswebsitedir . $thisfiledirname . '/';
				}else{
					$SYSDIR = '/';
				}

				$http_type = is_https()? "https://" : "http://";

				$BaseURL = $http_type . $_SERVER['HTTP_HOST'] . $SYSDIR;

				$filename = ROOT . "config/settings.php";
				$fp = @fopen($filename, 'rb');
				$contents = @fread($fp, filesize($filename));
				@fclose($fp);
				$contents =  trim($contents);
				$contents = preg_replace("/[$]_CFG\['BaseUrl'\]\s*\=\s*[\"'].*?[\"'];/is", "\$_CFG['BaseUrl'] = \"$BaseURL\";", $contents);

				$fp = @fopen($filename, 'w');
				@fwrite($fp, $contents);
				@fclose($fp);

				// write config file last off in case installation fails
				$configfile="<?php if(!defined('ROOT')) die('Access denied.');

\$servername  = '$servername';
\$dbname      = '$dbname';
\$dbusername  = '$dbusername';
\$dbpassword  = '$dbpassword';
\$dbmysql  = '$dbmysql';

define('TABLE_PREFIX', '$tableprefix');
define('COOKIE_KEY', '".PassGen(12)."');
define('WEBSITE_KEY', '".PassGen(12)."');
define('SYSDIR', '$SYSDIR');

?>";

				// write the config file
				$filenum = fopen (ROOT . "config/config.php","w");
				ftruncate($filenum, 0);
				fwrite($filenum, $configfile);
				fclose($filenum);

				echo '<font class=red>恭喜: 您的WeLive在线客服系统 安装成功!</font><br /><br />请在删除WeLive安装目录(./install/)后继续!
					<br /><br />
					1).&nbsp;<a href="../" target="_blank"><b>浏览加载WeLive访客对话窗口页面!</b></a>
					<br /><br />
					2).&nbsp;<a href="../admin/" target="_blank"><b>点击这里进入后台管理及客服窗口!</b></a><br /><br />';
			}
		}
	}
}


// ############################### INSTALL FORM ################################

if(!isset($_POST['install']) OR isset($installerrors) OR $tableprefix_err){
	if(isset($installerrors)){
		echo '<div style="padding:8px;border: 1px solid #FF0000; font-size: 12px;background:#FFE1E1;margin-bottom:12px;">
		<b>安装过程中发现以下错误:</b><br /><br />';

		for($i = 0; $i < count($installerrors); $i++){
			echo '' . ($i + 1) . ') ' . $installerrors[$i] . '<br />';
		}
		echo '</div>';
	}

	echo '<form method="post" action="index.php" id="installform">
		<div class="maindiv">
		<b>1) 安装WeLive的数据库连接信息:</b>
		<table width="92%" border="0" cellpadding="0" cellspacing="0" align="center" class="maintable">
		<tr>
		<td>数据库服务器地址:</td>
		<td align="right"><input type="text" name="servername" value="' . $servername . '" /></td>
		</tr>
		<tr>
		<td>数据库名:</td>
		<td align="right"><input type="text" name="dbname" value="' . $dbname . '" /></td>
		</tr>
		<tr>
		<td>数据库用户名:</td>
		<td align="right"><input type="text" name="dbusername" value="' . $dbusername . '" /></td>
		</tr>
		<tr>
		<td>数据库密码:</td>
		<td align="right"><input type="text" name="dbpassword" value="' . $dbpassword . '" /></td>
		</tr>
		<tr>
		<td>数据库表前缀:</td>
		<td align="right"><input type="text" name="tableprefix" value="' . $tableprefix . '" /></td>
		</tr>';

	if($tableprefix_err OR $confirmprefix){
		echo '<tr>
		<td><font class=red><B>强制安装:</B><BR>当前数据库当中存在相同表前缀的数据库表, 您可以重填"表前缀"来避免删除旧的数据, 或者选择强制安装。强制安装将删除原有相同表前缀的数据库表, 且无法恢复!</font></td>
		<td align="right"><input type="checkbox" class="check" name="confirmprefix" value="1"' . ($confirmprefix ? ' checked="checked"' : ''). '> 删除数据, 强制安装 !!!</td>
		</tr>';
	}

	echo '</table>
		<br />
		<b>2) 创建WeLive系统管理员帐号:</b>
		<table width="92%" border="0" cellpadding="0" cellspacing="0" align="center" class="maintable">
		<tr>
		<td>用户名:</td>
		<td align="right"><input type="text" name="username" value="' . $username . '" /></td>
		</tr>
		<tr>
		<td>密码:</td>
		<td align="right"><input type="text" name="password" value="' . $password . '" /></td>
		</tr>
		<tr>
		<td>确认密码:</td>
		<td align="right"><input type="text" name="confirmpassword" value="' . $confirmpassword . '" /></td>
		</tr>
		<tr>
		<td>Email地址:</td>
		<td align="right"><input type="text" name="email" value="' . $email . '" /></td>
		</tr>
		<tr>
		</table>
		</div>
		<div class="install-btn">
			<input value="安装 WeLive" type="submit" name="install">
		</div>
		</form>';
}

// ############################### PRINT FOOTER ################################

echo $footer;

?>