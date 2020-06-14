<?php
include_once "conn.php";
$id=$_GET['id'];
mysql_query("UPDATE chzb_users set vpn=vpn+1 where name=$id");
mysql_close($con);
?>