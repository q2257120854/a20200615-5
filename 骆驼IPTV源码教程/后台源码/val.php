<?php
session_start();
if(isset($_SESSION['user'])){
	$user=$_SESSION['user'];
}else{
	 header("location:userlogin.php");
}
 $result=mysql_query("select * from chzb_admin where name='$user'");
    if($row=mysql_fetch_array($result)){
    	$psw=$row['psw'];
    }else{
    	$psw='';
    }
if(!isset($_SESSION['psw'])||$_SESSION['psw']!=md5($psw)){
    header("location:userlogin.php");
}
?>
