<script type="text/javascript">
function copyText(t){
    var oInput = document.createElement('textarea');
    oInput.value = t;
    document.body.appendChild(oInput);
    oInput.select(); // 选择对象
    document.execCommand("Copy"); // 执行浏览器复制命令
    oInput.className = 'oInput';
    document.body.removeChild(oInput);
}
</script>
<?php

include_once "conn.php";
include_once "val.php";


if(isset($_POST['submitunbind'])){
	$userid=$_POST['snNumber'];
	$result=mysql_query("select * from chzb_users where name=$userid");
	if(mysql_fetch_array($result)){
		mysql_query("update chzb_users set mac='',deviceid='',model='' where name=$userid");
		echo "账号$userid 解绑成功！";
	}else{
		echo "账号$userid 不存在！";
	}	
}

if(isset($_POST['submitaddsn'])){
	$sn=$_POST['snNumber'];
	$exp=$_POST['exp'];
	$marks=$_POST['marks'];
	$snall='';
	$nowtime=time();
	$result = mysql_query("SELECT * from chzb_users where name=$sn");
	if($row=mysql_fetch_array($result)){
		echo "<font color=red>账号$sn 已存在！</font>";
	}else{
		$result = mysql_query("SELECT * from chzb_serialnum where sn=$sn");
		if($row=mysql_fetch_array($result)){
			echo "<font color=red>账号$sn 已经存在！</font>";
		}else{
			$sql="INSERT into chzb_serialnum (sn,exp,author,createtime,marks) values($sn,$exp,'$user',$nowtime,'$marks')";
			mysql_query($sql);
			$infotext="账号$sn 已成功生成，授权天数$exp 天，用此账号激活后自动绑定该设备。";
			echo "<script>copyText(\"$infotext\");</script><font color=red>账号$sn 已生成！</font>";
		}
		
		
	}
}

if(isset($_POST['submitdelsn'])){
	$sn=$_POST['snNumber'];
	mysql_query("delete from chzb_serialnum where sn=$sn");		
	mysql_query("delete from chzb_users where name=$sn");		
	
	echo "账号$sn 已删除！";
}
if(isset($_POST['submitmodifysn'])){
	$expimportmac=$_POST['exp'];
	$marks=$_POST['marks'];
	$exp=strtotime(date("Y-m-d"),time())+86400*$_POST['exp'];
	$sn=$_POST['snNumber'];
	mysql_query("update chzb_users set exp=$exp,marks='$marks' where name=$sn and status=1");
	mysql_query("update chzb_users set exp=$expimportmac,marks='$marks'  where name=$sn and status=2");		
	mysql_query("update chzb_serialnum set exp=$expimportmac,marks='$marks' where sn=$sn");
	echo "用户$sn 授权天数已修改！";	
}

if(isset($_POST['tryuse'])){
	$userid=$_POST['sn'];
	$exp=strtotime(date("Y-m-d"),time())+86400*2;
	mysql_query("update chzb_users set status=1,exp=$exp,marks='试用2天' where name=$userid");
  	echo "用户$userid 已授权试用2天！";	
}
?>
<html>
<head>
<style type="text/css">
body{
	font-size:18px; 
	line-height:24px;
}
  a:link, a:visited { text-decoration: none; color: #000 }
input{
  width:50%;
  height:24px;
  margin:10px;
  border:1px solid #6699ee;
  font-size:16px;
  }
  .button{
	  width:20%;
	  height:24px;
	  margin:5px;
	  font-size:12px;
  }
    .tryuse{
	  width:90%;
	  height:24px;
	  margin:0px;
	  font-size:12px;
  }
  ul{list-style:none;}
 div{
   padding:0px;
  }
  table{
  	border:1px solid #a0c6e5;
  	border-collapse:collapse;
  	width: 100%;
  	font-size: 12px;
  }
  td{padding:7px;
	text-align: center;
	border:2px solid #a0c6e5;
  }
.titlediv{
  width:100%;
  height:34px;
  color:#fff;
  background:#112233;
}
.title{  
  line-height:34px;
  padding-left:20px;
  }
 .content{
   width:100%;
   margin:0px;
   background:#ddeeff;
  }
</style>
<title>IPTV账号管理</title>
</head>
<body>
  <div><a href="useradmin0.php"><font color=blue>电脑版</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="madmin.php">刷新</a></div>

<div class="titlediv"><p class="title">账号管理</div>
<center>
<div class="content">
<form method="post">
	输入账号:<input type="text" name="snNumber" value="" size="20" /><br>
	授权天数:<input type="text" name="exp" value="365" size="20" /><br>
    备注内容:<input type="text" name="marks" value="" size="20" /><br>
	<button class="button" type="submit" name="submitunbind">解绑账号</button>
	<button class="button" type="submit" name="submitaddsn">生成账号</button>
	<button class="button" type="submit" name="submitdelsn" onclick="return confirm('该账号将从账号列表和用户列表中同时删除，是否删除？')">删除账号</button>
	<button class="button" type="submit" name="submitmodifysn" onclick="return confirm('确定修改账号列表和用户列表信息？')">修改账号</button>
	<br>
</form>

</div>
</center>


<div class="titlediv"><p class="title">账号列表</div>
<center>
<table>
<tr><td>账号</td><td>激活时间</td><td>授权天数</td><td>备注</td></tr>
<?php 
$result=mysql_query("select sn,regtime,exp,marks from chzb_serialnum order by createtime desc limit 10");

while ($row=mysql_fetch_array($result)){
	$sn=$row['sn'];
	$regtime=$row['regtime']==0?'':date("Y-m-d H:i:s",$row['regtime']);
	$exp=$row['exp'];
	$marks=$row['marks'];
	echo "<tr>
	<td>$sn</td>
	<td>$regtime</td>
	<td>$exp</td>
	<td>$marks</td>
	</tr>";
}
 ?>
</table>
</center>


<div class="titlediv"><p class="title">用户列表</div>
<center>
<table>
<tr><td>账号</td><td>MAC</td><td>天数</td><td>备注</td></tr>
<?php 
$result=mysql_query("select name,mac,exp,marks from chzb_users where status>=0 order by lasttime desc limit 10");

while ($row=mysql_fetch_array($result)){
	$name=$row['name'];
	$mac=$row['mac'];
	$exp=ceil(($row['exp']-time())/86400);
	$marks=$row['marks'];
	echo "<tr>
	<td>$name</td>
	<td>$mac</td>
	<td>$exp</td>
	<td>$marks</td>
	</tr>";
}
 ?>
</table>
</center>

<div class="titlediv"><p class="title">待授权列表</div>
<center>
<table>
<tr><td>账号</td><td>MAC</td><td>model</td><td>&nbsp;操&nbsp;&nbsp;&nbsp;&nbsp;作&nbsp;</td></tr>
<?php 
$result=mysql_query("select name,mac,model from chzb_users where status=-1 order by lasttime desc limit 10");

while ($row=mysql_fetch_array($result)){
	$name=$row['name'];
	$mac=$row['mac'];
	$model=$row['model'];
	echo "<tr>
	<td>$name</td>
	<td>$mac</td>
	<td>$model</td>
	<td><form method='post'><input type='hidden' name='sn' value='$name'><button class='tryuse' type='submit' name='tryuse' onclick=\"return confirm('账号$name 试用2天')\">试用</button></form></td>
	</tr>";
}
 ?>
</table>
</center>

</body>
</html>