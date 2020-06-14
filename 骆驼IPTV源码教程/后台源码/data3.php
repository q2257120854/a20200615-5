<?php
include_once"aes.php";
include_once "conn.php";
mysql_query("set names utf8");
$channelNumber=1;

function echoJSON($category,$netType,$alisname,$psw){
	global $channelNumber;

	$sql = "SELECT name,url FROM chzb_channels where category='$category' and (nettype='$netType' or nettype='通用') order by id";
	$result = mysql_query($sql);
	$nameArray = array();
	while($row = mysql_fetch_array($result)) {
		if(!in_array($row['name'],$nameArray)){
			$nameArray[]=$row['name'];
		}		
		$sourceArray[$row['name']][]=$row['url'];
	}
	mysql_free_result($result);
	$objCategory=(Object)null;
	$objChannel=(Object)null;

    $channelArray=array();
	for($i=0;$i<count($nameArray);$i++) {
		$objChannel=(Object)null;
		$objChannel->num=$channelNumber;
		$objChannel->name=$nameArray[$i];
		$objChannel->source=$sourceArray[$nameArray[$i]];
		$channelArray[]=$objChannel;
		$channelNumber++;
	}
    $objCategory->name=$alisname;
     $objCategory->psw=$psw;
	$objCategory->data=$channelArray;

	return $objCategory;
}


if(isset($_POST['data'])){
	 $obj=json_decode($_POST['data']);
	 $region=$obj->region;
	 $mac=$obj->mac;
	 $androidid=$obj->androidid;
	 $model=$obj->model;
	 $nettype=$obj->nettype;
	 $appname=$obj->appname;
	 $randkey=$obj->rand;
  
	 $ip=$_SERVER['REMOTE_ADDR'];


	if(strpos($nettype,'电信')!==false){
		$categoryname="chzb_category_dx";
	}elseif(strpos($nettype,'联通')!==false){
		$categoryname="chzb_category_lt";
	}else{
		$categoryname="chzb_category_yd";
	}

	
	$result=mysql_query("SELECT vip from chzb_users where deviceid='$androidid'");
	if($row=mysql_fetch_array($result)){
		$isvip=$row['vip'];
	}else{
		$isvip=0;
	}


	$contents[]= echoJSON($pdname,'通用',"我的收藏",''); 
  
	//添加全网频道数据
    $sql = "SELECT name,id,psw FROM chzb_category_qw where enable=1 order by id";
    $result = mysql_query($sql);
    while($row = mysql_fetch_array($result)) {
        $pdname=$row['name'];
        $psw=$row['psw'];
        $contents[]= echoJSON($pdname,'全网',$pdname,$psw);        
    }



    	//添加运营商频道数据
		$arrPD = array();
	    $sql = "SELECT name,id,psw FROM $categoryname where enable=1 order by id";
	    $result = mysql_query($sql);
	    while($row = mysql_fetch_array($result)) {
	        $pdname=$row['name'];
	        $arrPD[]=$pdname; 
	         $psw=$row['psw'];
	        $contents[]= echoJSON($pdname,$nettype,$pdname,$psw); 
	        
	    }
	

    //添加通用频道数据   
    $sql = "SELECT name,id ,psw FROM chzb_category where enable=1 order by id";
    $result = mysql_query($sql);
    while($row = mysql_fetch_array($result)) {
        $pdname=$row['name'];
         $psw=$row['psw'];
        if(!in_array($pdname, $arrPD)){
        	$contents[]= echoJSON($pdname,'通用',$pdname,$psw); 
        }             
    }
   
   //添加隐藏频道数据
   if($isvip==1){
   	    $sql = "SELECT name,id ,psw FROM chzb_category_jw where enable=1 order by id";
	    $result = mysql_query($sql);
	    while($row = mysql_fetch_array($result)) {
	        $pdname=$row['name'];
	         $psw=$row['psw'];
	        if(!in_array($pdname, $arrPD)){
	        	$contents[]= echoJSON($pdname,'隐藏',$pdname,$psw); 
	        }             
	    }
   }


    if(isset($region)&&$region!=''){
    	//添加省内频道数据

	    $sql = "SELECT name,psw FROM chzb_category_sl where enable=1 and name like '$region%' order by id";
	    $result = mysql_query($sql);
	    while($row = mysql_fetch_array($result)) {
	        $pdname=$row['name'];
	         $psw=$row['psw'];
	        $contents[]= echoJSON($pdname,'省内',$pdname,$psw);
	       
	       
	    }
    }
    


    $str=json_encode($contents,JSON_UNESCAPED_UNICODE);
    $str=stripslashes($str);
 $str=base64_encode(gzcompress($str));
  
    $result=mysql_query("select dataver from chzb_appdata");
     $ver=3;
      if($row=mysql_fetch_array($result)){
        $ver=$row[0];
      }
      $key=md5($key.$randkey);
      $key=substr($key,7,16);
      
      $aes = new Aes($key);
      $encrypted =$aes->encrypt($str);

      $encrypted=str_replace("f", "&", $encrypted);
      $encrypted=str_replace("b", "f", $encrypted);
      $encrypted=str_replace("&", "b", $encrypted);

      $encrypted=str_replace("t", "#", $encrypted);
      $encrypted=str_replace("y", "t", $encrypted);
      $encrypted=str_replace("#", "y", $encrypted);
     
  	  $coded=substr($encrypted,44,128);
 	  $coded=strrev($coded);
  
	  $str=$coded.$encrypted;
     
	  echo $str;
    mysql_close($con);
}else{
	 mysql_close($con);
	exit();
}


?>