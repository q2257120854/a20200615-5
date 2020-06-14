<?php
header("Content-type: text/html; charset=utf-8");
$con = mysql_connect("localhost","syzb","ckBf3S8TXpLPPMbi");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("syzb", $con);
mysql_query("set names utf8");
?>