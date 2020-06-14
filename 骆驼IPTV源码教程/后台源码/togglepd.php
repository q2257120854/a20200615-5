<?php
include_once "conn.php";
session_start();
if(isset($_SESSION['user']))$user=$_SESSION['user'];
 $result=mysql_query("select * from chzb_admin where name='$user'");
    if($row=mysql_fetch_array($result)){
    	$psw=$row['psw'];
    }else{
    	$psw='';
    }
if(!isset($_SESSION['psw'])||$_SESSION['psw']!=md5($psw)){
    exit;
}
?>
<?php

if(isset($_GET['pdname']) && isset($_GET['cat'])){
	$pdname=$_GET['pdname'];
	$categoryname=$_GET['cat'];
	$result=mysql_query("select enable from $categoryname where name='$pdname'");
	if($row=mysql_fetch_array($result)){
		if($row['enable']==1){
			mysql_query("UPDATE $categoryname set enable=0 where name='$pdname'");
			echo "$pdname 已禁用";
		}else{
			mysql_query("UPDATE $categoryname set enable=1 where name='$pdname'");
			echo "$pdname 已启用";
		}

	}else{
		echo "$pdname 操作失败！";
	}
	
}else{
	echo "参数错误";
}

?>