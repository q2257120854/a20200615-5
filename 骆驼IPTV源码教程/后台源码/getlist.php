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

header("Content-type:text/json;charset=utf-8");
function echoSource($category,$netType){
	mysql_query("set names utf8");
		$sql = "SELECT distinct name,url FROM chzb_channels where category='$category' and nettype='$netType' order by id";
		$result = mysql_query($sql);
			while($row = mysql_fetch_array($result)) {
				echo $row['name'] .",". $row['url'] . "\n";
			}
}
if(isset($_GET['nettype']) && isset($_GET['pd'])){
	$nettype=$_GET['nettype'];
	$pd=$_GET['pd'];
}else{
	$pd='未知';
	$nettype='未知';
}
echoSource($pd,$nettype);
?>