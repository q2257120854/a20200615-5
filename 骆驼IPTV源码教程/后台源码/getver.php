<?php
include_once "conn.php";
$appver='V1.0';
$appUrl='';
$sql = "SELECT appver,appurl FROM chzb_appdata";
$result = mysql_query($sql);
if($row = mysql_fetch_array($result)) {
	$appver=$row['appver'];	
	$appUrl=$row['appurl'];
}
$obj=(Object)null;
$obj->appver=$appver;
$obj->appurl=$appUrl;

echo json_encode($obj);
mysql_close($con);
?>