<?php
//创建一个memcache对象
$memcache = new Memcache; 
//连接Memcached服务器
$memcache->connect('localhost', 11211) or die ("Could not connect");
//设置一个变量到内存中，名称是key 值是test
$memcache->set('key', 'test');
//从内存中取出key的值
$get_value = $memcache->get('key'); 
var_dump($get_value);
?>