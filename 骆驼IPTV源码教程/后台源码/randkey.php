<?php
include_once "conn.php";
mysql_query("alter table chzb_appdata add column randkey varchar(100) DEFAULT '827ccb0eea8a706c4c34a16891f84e7b'");
$r=rand(1,9999999);
$k=md5($r);
mysql_query("UPDATE chzb_appdata set randkey='$k'");

echo '更新成功！';
?>