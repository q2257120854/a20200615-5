<?php  

define('ROOT', dirname(__FILE__).'/');  //系统程序根路径, 必须定义, 用于防翻墙

require(ROOT . 'includes/core.guest.php');  //加载核心文件
require(ROOT . 'includes/functions.ajax.php');  //加载需要的函数

if(!$_CFG['Actived']) die("Access denied");

//ajax操作
$ajax =  intval($_GET['ajax']);

if(!$ajax) die("Access denied");


if($dbmysql == "mysqli"){
	$DB = new DBMysqli($dbusername, $dbpassword, $dbname,  $servername, false, false); //MSQLI, 不显示mysql查询错误
}else{
	$DB = new DBMysql($dbusername, $dbpassword, $dbname,  $servername, false, false);
}

$dbpassword = '';


$json = new JSON;
$ajax = array('s' => 0, 'i' => '');

$act = ForceStringFrom('act');

//访客留言
if($act == "comment"){
	$key = ForceStringFrom('key');
	$code = ForceStringFrom('code');
	$decode = authcode($code, 'DECODE', $key);
	if($decode != md5(WEBSITE_KEY . $_CFG['KillRobotCode'])){
		die($json->encode($ajax)); //验证码过期
	}

	$fullname = ForceStringFrom('fullname');
	$email = ForceStringFrom('email');
	$phone = ForceStringFrom('phone');
	$content = ForceStringFrom('content');
	$vid = ForceIntFrom('vid');
	$vvc = ForceIntFrom('vvc');

	if(!$fullname OR strlen($fullname) > 90){
		$ajax['s'] = 2;
		die($json->encode($ajax));
	}elseif(!$content OR strlen($content) > 1800){
		$ajax['s'] = 4;
		die($json->encode($ajax));
	}elseif(!checkVVC($vid, $vvc)){
		$ajax['s'] = 5;
		die($json->encode($ajax));
	}

	$gid = ForceIntFrom('gid');
	$ip = GetIP();

	$DB->exe("INSERT INTO " . TABLE_PREFIX . "comment (gid, fullname, ip, phone, email, content, time) VALUES ('$gid', '$fullname', '$ip', '$phone', '$email', '$content', '".time()."')");
	$ajax['s'] =1;
	die($json->encode($ajax));
}

//生成验证码, 返回vvc id
if($act == 'vvc'){

	$key = ForceStringFrom('key');
	$code = ForceStringFrom('code');
	$decode = authcode($code, 'DECODE', $key);

	if($decode != md5(WEBSITE_KEY . $_CFG['KillRobotCode'])){
		$ajax['s'] = 0;
		die($json->encode($ajax)); //验证码过期
	}

	$ajax['s'] = createVVC();
	die($json->encode($ajax));
}

//获取验证码图片
if($act == 'get'){
	getVVC();
	die();
}

?>