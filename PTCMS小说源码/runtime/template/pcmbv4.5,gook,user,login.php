<?php defined('PT_ROOT') || exit('Permission denied');?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>登录_<?php echo $this->pt->config->get("sitename");?></title>
<meta name="keywords" content="<?php echo $this->pt->config->get("sitename");?>">
<meta name="description" content="<?php echo $this->pt->config->get("sitename");?>">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0">
<meta name="format-detection" content="telephone=no,email=no,address=no">
<meta name="applicable-device" content="mobile">
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-transform">
<meta http-equiv="Cache-Control" content="no-siteapp">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="stylesheet" type="text/css" href="<?php echo $this->pt->config->get("resurl");?><?php echo __TMPL__;?>/v<?php echo $this->pt->config->get("tplconfig.demo");?>/css/user.css">
<script type="text/javascript" src="<?php echo $this->pt->config->get("resurl");?><?php echo __TMPL__;?>/js/layui.js"></script>
</head>
<body>
<div class="account layui-anim layui-anim-scaleSpring">
	<div class="layui-tab layui-tab-brief">
		<ul class="layui-tab-title">
			<li class="layui-this">登录</li>
			<li><a href="<?php echo U("user.public.register",array());?>">注册</a></li>
			<li><a href="/">首页</a></li>
		</ul>
	</div>
	<form method="post" class="layui-form">
		<input type="text" name="username" lay-verify="required" placeholder="请输入帐号" autocomplete="off">
		<input type="password" name="password" lay-verify="required" placeholder="请输入密码">
		<button type="submit" lay-filter="login" lay-submit>登 录</button>
	</form>
</div>
<script>
layui.use(['form'], function(){
	var form = layui.form;
});
</script>
</body>
</html>