
//获取cookie
function welive_online_getCookie(n){
	var a = document.cookie.match(new RegExp("(^| )" + n + "=([^;]*)(;|$)"));
	if (a != null) return a[2];
	return "";
}

//防机器人编码
var welive_online_code = 621276866;

//访客id
var welive_online_gid = welive_online_getCookie("welive_user");

//访客用户名
var welive_online_fn = welive_online_getCookie("welive_fn");

//welive所在URL
var welive_online_url = document.getElementsByTagName("script");
welive_online_url = welive_online_url[welive_online_url.length-1].src;
welive_online_url = welive_online_url.substring(0, welive_online_url.indexOf("welive_ol.js"));

//判断是否为移动设备
var welive_online_mobile = navigator.userAgent.match(/(iPhone|Android|iPod|ios|iPad|Windows ce|Windows mobile|Micromessenger|webOS|Ucweb|UCBrowser|BlackBerry|midp|rv:1.2.3.4)/i);

var welive_online_link = "";

//监听加载样式
window.addEventListener("load", function(){

	//当前页面URL
	var url = window.btoa(window.location.href);

	//根据设备跳转的链接不同
	if(welive_online_mobile){ //mobile
		welive_online_link = "mobile/online.php";
	}else{ //web
		welive_online_link = "online.php";
	}

	welive_online_link = welive_online_url + welive_online_link + "?a=" + welive_online_code + "&gid=" + welive_online_gid + "&fn=" + welive_online_fn + "&r=" + Math.random() + "&url=" + url;

	var welive_targets = document.getElementsByClassName("welive_online");

	for(var i = 0; i < welive_targets.length; i++) {

		welive_targets[i].onclick = function(e){
			e.preventDefault();
			window.open(welive_online_link);
			return false;
		}
	}
});