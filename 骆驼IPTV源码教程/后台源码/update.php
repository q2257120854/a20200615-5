<?php
include "conn.php";
mysql_query("alter table chzb_channels modify column url varchar(600)");
mysql_query("alter table chzb_appdata add column trialdays int(11)");
mysql_query("update chzb_appdata set trialdays=0");
mysql_query("ALTER TABLE chzb_users DROP index mac");
mysql_query("ALTER TABLE chzb_users ADD UNIQUE(mac,deviceid,model)");
mysql_query("RENAME TABLE chzb_category_gd TO chzb_category_qw");
mysql_query("UPDATE chzb_category set id=id+50 where id>50 and id<100");
mysql_query("UPDATE chzb_category_cc set id=id+50 where id>0 and id<50");
mysql_query("UPDATE chzb_category_dx set id=id+50 where id>0 and id<50");
mysql_query("UPDATE chzb_category_yd set id=id+50 where id>0 and id<50");
mysql_query("UPDATE chzb_category_lt set id=id+50 where id>0 and id<50");
mysql_query("UPDATE chzb_category_sl set id=id+50 where id>100 and id<150");
mysql_close($con);
echo "数据库已升级，最长URL支持600字符。<br>";
echo "已增加试用天数设置字段。<br>";
echo "已修复识别授权出现重复记录问题！<br>";
echo "已将原广电数据表重命名为全网<br>";
?>