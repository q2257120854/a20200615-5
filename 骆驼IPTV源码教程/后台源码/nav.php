<meta charset="UTF-8"> <!-- for HTML5 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>IPTV管理平台</title>
<?php
include_once "conn.php";
include_once "val.php";

?>
<style type="text/css">

a:link, a:visited { text-decoration: none; color: #000 }
#topnav { width: 100%; background: #33a996; height: 50px; line-height: 50px; }
#topnav ul { width: 100%; margin: auto }
#topnav a { display: inline-block; font-size: 18px; font-family: "Microsoft Yahei", Arial, Helvetica, sans-serif; padding: 0 20px; }
#topnav a:hover { background: #345; color: #fff; border-top: 0px solid #f77825; }
#topnav a { color: #FFF }
#topnav_current { background: #345; border-top: 0px solid #f77825; color: #fff }/* 高亮选中颜色 */
a#topnav_current { color: #fff }
</style>
<center>

  <nav id="topnav">
<ul>
<a href="sysadmin.php">系统</a>
<a href="useradmin0.php">授权</a>
<a href="useradmin1.php">账号</a>
<a href="useradmin2.php">用户</a>
<a href="ipcheck.php">异常</a>
<a href="channeladmin.php?nettype=全网">全网</a>
<a href="channeladmin.php?nettype=通用">通用</a>
<a href="channeladmin.php?nettype=省内">省内</a>
<a href="channeladmin.php?nettype=电信">电信</a>
<a href="channeladmin.php?nettype=移动">移动</a>
<a href="channeladmin.php?nettype=联通">联通</a>
<a href="channeladmin.php?nettype=隐藏">隐藏</a>

</ul>
    <script language="javascript">
		var obj=null;
		var As=document.getElementById('topnav').getElementsByTagName('a');
		obj = As[0];
		for(i=1;i<As.length;i++){
      var navhref=As[i].href;
      var href='';
      if(navhref.indexOf('&')>=0){
        href=navhref.substring(0,navhref.indexOf('&'));
      }else{
        href=navhref;
      }
      if(window.location.href.indexOf(href)>=0)
		  obj=As[i];
    }
		obj.id='topnav_current';
    </script> 
 </nav>
 </center>
 <div style="float: left;width:100%;background: #fff;margin:auto;">
  
 <?php
  date_default_timezone_set('Etc/GMT-8');

  echo "<p style='padding-left:20px;color:#000'>  <a style='padding-right:30px;' href=\"madmin.php\"> <font color=blue>手机版</font></a>管理员：【".$user . "】".date("Y-m-d H:i",time());
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="logout.php"><font color=red>注销登陆</font></a>
</div>
<br><br>
<?php
//创建境外表
mysql_query("CREATE TABLE IF NOT EXISTS `chzb_category_jw` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `isprov` tinyint(4) NOT NULL DEFAULT '0',
  `canseek` tinyint(4) NOT NULL DEFAULT '0',
  `enable` tinyint(4) NOT NULL DEFAULT '1',
  `updateurl` varchar(500) DEFAULT '',
  `psw` varchar(16) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
?>
