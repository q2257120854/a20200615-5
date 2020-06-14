<?php  

define('ROOT', dirname(dirname(__FILE__)).'/');  //系统程序根路径, 必须定义, 用于防翻墙、文件调用等

define('ADMINDIR', substr(str_replace(dirname(dirname(__FILE__)), '', dirname(__FILE__)), 1)); //自动定义后台管理的目录名称

require(ROOT . 'includes/core.admin.php');  //加载核心文件

APP::run();

?> 