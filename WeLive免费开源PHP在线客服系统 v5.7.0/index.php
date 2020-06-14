<?php
define('ROOT', dirname(__FILE__).'/');  //系统程序根路径, 必须定义, 用于防翻墙
require(ROOT . 'includes/core.guest.php');  //加载核心文件

if(!defined('SYSDIR')) header('Location: ./install/');


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo $_CFG['Title'] ?></title>
<link rel="shortcut icon" href="public/img/favicon.ico" type="image/x-icon"> 
<script type="text/javascript" src="public/jquery126.js"></script>


</head>

<body style="background:#fff;font:16px Microsoft YaHei, \5b8b\4f53, Verdana, Arial;word-break:break-all;">

<br>

<a href="../" style="margin-left: 30px;display: inline-block;color: #a4a4a4;font: bold 16px 'Open Sans Condensed', sans-serif; border: 2px solid #c7c7c7;padding: 5px 20px 7px;text-decoration: none;">返回首页</a>

<br><br>

<font color="red"><b>WeLive5</b></font> 在线客服系统加载演示，共有三种加载模式：

<br><br>
<font color="#03a3a7"><b>一、伴随网站页面加载，此方式在页面右下角显示“在线客服”标志，支持web和移动端：</b></font>
<br><br>
WeLive可跨站调用，你的网站，甚至localhost本地页面也可以加载WeLive客服，只要在页面的html内插入：
<br>
&lt;script type="text/javascript" charset="UTF-8" src="<?php echo BASEURL; ?>welive.js"&gt;&lt;/script&gt;

<br><br>

<font color="#03a3a7"><b>二、打开独立页面进入对话窗口，支持web和移动端：</b></font>
<br><br>
在你的网站页面html内插入：
<br>
&lt;script type="text/javascript" charset="UTF-8" src="<?php echo BASEURL; ?>welive_ol.js"&gt;&lt;/script&gt;
<br><br>
编辑此页面中的元素，为其添加样式：class="welive_online"，那么点击此元素将在新窗口中打开WeLive对话窗口，如：

<br><br>
<a href="" class="welive_online" style="padding: 4px 8px; border: 1px solid #21a39f;background-color: #29C7C2;text-decoration:none;border-radius:4px;color:#fff;margin-left:60px;">点击在新窗口打开WeLive</a>

<br><br><br>

<font color="#03a3a7"><b>三、链接或直接发送链接URL进入对话窗口，支持web和移动端，如：</b></font>
<br><br>
链接URL(<font color="red">可制作成二维码</font>)：<?php echo $_CFG['BaseUrl'] ?>kefu.php?a=621276866


<br><br><br>
<font color="red">手机、Pad等移动设备也可以适配哟，请在移动端进入此页面测试。</font>
<br>

<br><br>
<br><br>
<br><br>

<script type="text/javascript" charset="UTF-8" src="welive.js"></script>
<script type="text/javascript" charset="UTF-8" src="welive_ol.js"></script>

</body>
</html>