<?php  


echo '<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>WeLive - 管理登录</title>
<link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="public/login.css">
</head>
<body>
<div id="logo">
	<img src="public/img/login_logo.png"> 
</div>
<div id="login">
	<form id="loginform" action="" method="post">
		<p id="info">请输入用户名和密码</p>
		<p id="info_alert" style="color:#ff3300;display:none;"></p>
		<div class="control-group">
			<span class="icon-user"></span><input name="username" placeholder="Username" type="text" autocomplete="off">
		</div>

		<div class="control-group">
			<span class="icon-lock"></span><input name="password" placeholder="Password" type="password">
		</div>

		<div class="remember-me">
				<input name="remember" value="1" type="checkbox" id="rm"><label for="rm"> 记住我</label>
		</div>

		<div class="login-btn">
			<input id="login-btn" value="登 录" type="submit" name="submit" onclick="setSafeCookie();return false;">
		</div>
	</form>

</div>

<div id="login-copyright">
	'.date("Y").' &copy; WeLive <a href="http://www.yunziyuan.com.cn" target="_blank">云资源</a>
</div>

<script src="public/jquery-3.3.1.min.js" type="text/javascript"></script>

<script>
	function setSafeCookie() {
		$("#info_alert").html("免费版未开放客服移动端！").show();
		$("#info").hide();

		setTimeout(function(){
			$("#info_alert").fadeOut("slow", function(){				
				$("#info").show();				
			});
		}, 5000);
		
	}

	function reset_window(){
		var margin_top = ($(window).height() - $("#logo").height() - $("#login").height() - $("#login-copyright").height() - 58)/2;

		if(margin_top < 58) margin_top = 8;
		$("#logo").css("margin-top", margin_top+"px");
	}

	$(function(){
		reset_window();

		$(window).on("orientationchange", function(){	reset_window();});
	});

</script>
</body>
</html>';



?> 