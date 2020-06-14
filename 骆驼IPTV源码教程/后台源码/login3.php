<?php
ini_set('display_errors',1);            
ini_set('display_startup_errors',1);   
error_reporting(E_ERROR);

include_once"aes.php";
include_once "conn.php";

if(isset($_POST['login'])){ 
	$json=$_POST['login'];

	 $obj=json_decode($json);
	 $region=$obj->region;
	 $androidid=$obj->androidid;
	 $mac=$obj->mac;
     $model=$obj->model;
	 $nettype=$obj->nettype;
	 $appname=$obj->appname;
     $ip=$_SERVER['REMOTE_ADDR'];

	 $myurl='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
     $json=file_get_contents(dirname($myurl)."/iploc/iploc.php?ip=$ip");
     $obj=json_decode($json);
     $region=$obj->region;
     $nettype=$obj->nettype;
    
	

function genName(){
	$name=rand(1000,999999);
	$result = mysql_query("SELECT * from chzb_users where name=$name");
	if($row=mysql_fetch_array($result)){
		genName();
	}else{
		$result = mysql_query("SELECT * from chzb_serialnum where sn=$name");
		if($row=mysql_fetch_array($result)){
			genName();
		}else{
			return $name;
		}
		
	}
}
//status=1,正常用户；
//status=0,停用用户;
//status=-1,未授权用户
//status=999为永不到期
$days=0;

$nowtime=time();


//androidID是否匹配
$sql = "SELECT name,status,exp,deviceid,model FROM chzb_users where deviceid='$androidid'";
$result = mysql_query($sql);
if($row = mysql_fetch_array($result)) { //匹配成功
	$days=ceil(($row['exp']-time())/86400);
	$status=intval($row['status']);
	$name=$row['name'];
	if($days>0&&$status==-1){
		$status=1;
	}
	//更新位置，登陆时间
	mysql_query("UPDATE chzb_users set region='$region',ip='$ip',lasttime=$nowtime where  deviceid='$androidid'");

	//生成用户访问记录
	$result=mysql_query("SELECT logintime from chzb_loginrec where deviceid='$androidid' and ip='$ip'");
	if($row=mysql_fetch_array($result)){//数据库中找到该用户该IP的登陆记录
		mysql_query("UPDATE chzb_loginrec set logintime=$nowtime where deviceid='$androidid' and ip='$ip'");
	}else{
		mysql_query("INSERT into chzb_loginrec values($name,'$androidid','$mac','$model','$ip','$region','$nowtime')");
	}	
}else{//用户验证失败，识别用户信息存入后台
	
	$name=genName();
	
	$sql = "SELECT trialdays FROM chzb_appdata";
	$result = mysql_query($sql);
	if($row = mysql_fetch_array($result)) {
		$days=$row['trialdays'];				
	}else{
		$days=0;
	}
	if($days>0){
		$status=-1;
		$marks='试用';
	}else{
		$status=-1;
		$marks='未授权';
	}

	$exp=strtotime(date("Y-m-d"),time())+86400*$days;
	mysql_query("INSERT into chzb_users (name,mac,deviceid,model,exp,ip,status,region,lasttime,marks) values($name,'$mac','$androidid','$model',$exp,'$ip',$status,'$region',$nowtime,'$marks')");
	if($days>0&&$status==-1)$status=1;				
}



$sql = "SELECT dataver,appver,setver,adtext,showtime,showinterval,dataurl,appurl,decoder,buffTimeOut,tiploading,tipusernoreg,tipuserexpired,tipuserforbidden,tipmatcherror,needauthor,qqinfo,autoupdate,randkey,updateinterval FROM chzb_appdata";
$result = mysql_query($sql);
if($row = mysql_fetch_array($result)) {
	$dataver=$row['dataver'];
	$appver=$row['appver'];	
	$setver=$row['setver'];
	$adtext=$row['adtext'];
	$showtime=$row['showtime'];
	$showinterval=$row['showinterval'];
	$decoder=$row['decoder'];
	$buffTimeOut=$row['buffTimeOut'];
	$tiploading=$row['tiploading'];
	$tipusernoreg=$row['tipusernoreg'];
	$tipuserexpired='当前账号'.$name.'，'.$row['tipuserexpired'];
	$tipuserforbidden='当前账号'.$name.'，'.$row['tipuserforbidden'];
	$tipmatcherror='当前账号'.$name.'，'.$row['tipmatcherror'];
	$needauthor=$row['needauthor'];
	$qqinfo=$row['qqinfo'];
  	$autoupdate=$row['autoupdate'];
  	$randkey=$row['randkey'];
	$updateinterval=$row['updateinterval'];
	
	if($matcherror)$tipusernoreg=$tipmatcherror;

	$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; 
	$dataurl=dirname($url)."/data3.php";
	$appUrl=$row['appurl'];

}

if($needauthor==0){
	$status=999;
}


if($status<1){
	$dataurl='';
	$appUrl='';
}

$result=mysql_query("select * from chzb_category_sl where enable=1 order by id");
while($row=mysql_fetch_array($result)){
  $arrprov[]=$row['name'];
}

$arrcanseek[]='';

$j=0;
$result=mysql_query("SELECT src,proxy from chzb_proxy");
while($row=mysql_fetch_array($result)){
	$src[$j]=gzuncompress(base64_decode($row['src']));
	$proxy[$j]=gzuncompress(base64_decode($row['proxy']));
	$j++;
}

$objres= array('status' => $status, 'dataurl'=>$dataurl,'appurl'=>$appUrl,'dataver' =>$dataver,'appver'=>$appver,'setver'=>$setver,'adtext'=>$adtext,'showinterval'=>$showinterval,'categoryCount'=>0,'exp' => $days,'ip'=>$ip,'showtime'=>$showtime ,'provlist'=>$arrprov,'canseeklist'=>$arrcanseek,'id'=>$name,'decoder'=>$decoder,'buffTimeOut'=>$buffTimeOut,'tipusernoreg'=>$tipusernoreg,'tiploading'=>$tiploading,'tipuserforbidden'=>$tipuserforbidden,'tipuserexpired'=>$tipuserexpired,'qqinfo'=>$qqinfo,'arrsrc'=>$src,'arrproxy'=>$proxy,'location'=>$region,'nettype'=>$nettype,'autoupdate'=>$autoupdate,'updateinterval'=>$updateinterval,'randkey'=>$randkey);

$objres=str_replace("\\/", "/",  json_encode($objres,JSON_UNESCAPED_UNICODE));
 
 $key=substr($key,5,16);

 $aes2 = new Aes($key);
 $encrypted =$aes2->encrypt($objres);


 echo $encrypted;

mysql_close($con);
}else{
	mysql_close($con);
	exit();
}
 

?>