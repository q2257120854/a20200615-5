<?php if(!defined('ROOT')) die('Access denied.');

error_reporting(E_ALL & ~E_NOTICE);

$mtime = explode(' ', microtime());
$sys_starttime = $mtime[1] + $mtime[0];

//自动加载函数(魔术函数)
function my_autoload($class){
	require_once(ROOT. "includes/class.$class.php");
}

spl_autoload_register('my_autoload');


@include(ROOT . 'config/config.php');
require(ROOT . 'config/settings.php');
include(ROOT . 'includes/functions.admin.php');
require(ROOT . 'includes/version.php');
require(ROOT . 'includes/APP.php');

define('APP_VERSION', $WeLiveVersion);
define('APP_NAME', base64_decode("V2VMaXZl"));
define('APP_URL', base64_decode("aHR0cDovL3d3dy53ZWVuc29mdC5jbi8="));

define('BASEURL', $_CFG['BaseUrl']);
define('COOKIE_ADMIN', COOKIE_KEY.'admin');  //后台用户的COOKIE名称

define('WS_HEAD', Iif(is_https(), 'wss://', 'ws://')); //定义websocket类型: ws | wss
define('WS_HOST', gethostbyname($_SERVER['HTTP_HOST'])); //socket服务器IP地址
define('WS_PORT', $_CFG['SocketPort']); // socket服务器端口号

//获取或生成安全cookie名称, 随PHP进程消失. 这个cookie名称为后面的程序设置cookie使用
if(isset($_COOKIE[COOKIE_KEY . 'safe'])){
	define('COOKIE_SAFE', $_COOKIE[COOKIE_KEY . 'safe']);
}else{
	$value = md5(COOKIE_KEY . time());
	setcookie(COOKIE_KEY . 'safe', $value, 0, '/');
	define('COOKIE_SAFE', $value);
}

APP::$_CFG = &$_CFG; //设置APP静态成员$_CFG引用全局的系统配置数组$_CFG

if($dbmysql == "mysqli"){
	APP::$DB = new DBMysqli($dbusername, $dbpassword, $dbname,  $servername); //MSQLI
}else{
	APP::$DB = new DBMysql($dbusername, $dbpassword, $dbname,  $servername);
}

$dbpassword = '';

?>