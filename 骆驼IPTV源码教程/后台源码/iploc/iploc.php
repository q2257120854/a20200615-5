<?php

$qqip=1;
//qqip=1使用付费IP数据库，qqip=0使用纯真IP数据库

header("Content-type: text/json; charset=utf-8");
$ip=isset($_GET['ip'])?$_GET['ip']:real_ip();
$myurl=dirname('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
if($qqip==1){
	echo file_get_contents("$myurl/qqip.php?ip=$ip");
}else{
	echo file_get_contents("$myurl/qqwry.php?ip=$ip");
}

function real_ip(){
$ip = $_SERVER['REMOTE_ADDR'];
if (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
	$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
	foreach ($matches[0] AS $xip) {
		if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
			$ip = $xip;
			break;
		}
	}
}
return $ip;
}
?>