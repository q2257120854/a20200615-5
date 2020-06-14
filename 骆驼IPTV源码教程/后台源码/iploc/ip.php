<?php
header("Content-type: text/json; charset=utf-8");
$ip=$_GET['ip'];
$ipjson=file_get_contents("http://ip.taobao.com//service/getIpInfo.php?ip=$ip");
$tbObj=json_decode($ipjson);

$nettype=$tbObj->data->isp;
$loc=$tbObj->data->region;
$region=$loc . $tbObj->data->city . $nettype;

$obj=(Object)null;
$obj->region=$region;
$obj->nettype=$nettype;
$obj->loc=$loc;
echo json_encode($obj);

 ?>