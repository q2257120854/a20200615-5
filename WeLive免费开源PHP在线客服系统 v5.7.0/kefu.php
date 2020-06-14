<?php

//WeLive5在线客服系统
//独立窗口进入客服, web和移动端统一链接文件

//正式开始
$a = 0;
if(isset($_GET['a'])) $a = intval($_GET['a']);

if($a !== 621276866) die('Access denied.'); //简单地防止直接访问当前文件

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script type="text/javascript">
//获取cookie
function welive_kefu_getCookie(n){
	var a = document.cookie.match(new RegExp("(^| )" + n + "=([^;]*)(;|$)"));
	if (a != null) return a[2];
	return "";
}

//welive安装后所在URL, 相对地址或绝对地址, 以 / 结尾
var welive_kefu_url = "./";

//原网站用户名或昵称fullname ---用户接口
var welive_kefu_fn = welive_kefu_getCookie("welive_fn");

//防机器人编码
var welive_kefu_code = 621276866;

//WeLive访客id
var welive_kefu_gid = welive_kefu_getCookie("welive_user");

//判断是否为移动设备
var welive_kefu_mobile = navigator.userAgent.match(/(iPhone|Android|iPod|ios|iPad|Windows ce|Windows mobile|Micromessenger|webOS|Ucweb|UCBrowser|BlackBerry|midp|rv:1.2.3.4)/i);

var welive_kefu_link = "";

window.onload=function(){
	//来自页面的URL
	var url = '';

	if(typeof(document.referrer) != 'undefined' && document.referrer.length > 0) {
		url = document.referrer;
	}else{
		try {
			if (typeof(opener.location.href) != 'undefined' && opener.location.href.length > 0) {
				url = opener.location.href;
			}
		}catch(e){}
	}

	url = url ?  window.btoa(url) : window.btoa(window.location.href);

	//根据设备跳转的链接不同
	if(welive_kefu_mobile){ //mobile
		welive_kefu_link = "mobile/online.php";
	}else{ //web
		welive_kefu_link = "online.php";
	}

	window.location.href = welive_kefu_url + welive_kefu_link + "?a=" + welive_kefu_code + "&gid=" + welive_kefu_gid + "&fn=" + welive_kefu_fn + "&r=" + Math.random() + "&url=" + url;
}
</script>
</head>
<body>
</body>
</html>