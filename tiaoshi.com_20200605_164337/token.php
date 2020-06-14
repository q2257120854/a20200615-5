<?php 
/*
设置cookie并且跳转指定页面完成登录需要注意的是cookie有效时间 cookie作用域
*/
$token=urldecode($_GET['token']);
$user_id=cut($token,"user_id=",";",0);
$user_name=cut($token,"user_name=",";",0);
$group_id=cut($token,"group_id=",";",0);
$group_name=cut($token,"group_name=",";",0);
$user_check=cut($token,"user_check=",";",0);
$user_portrait=cut($token,"user_portrait=",";",0);
setcookie("user_id",$user_id );
setcookie("user_name",$user_name);
setcookie("user_check",$user_check);
setcookie("user_portrait",$user_portrait );
setcookie("group_id", $group_id);
setcookie("group_name", $group_name);
header("Location: http://163.44.167.135:7788/index.php/user/buy.html");
/*
* php截取两个字符串之间的字符 by 若忧愁 QQ2557594045
* @param string $str 需要截取的字符串
* @param string ,$begin 开始字符
* @param string ,$end 结束字符
* @param int $number 如果等于0则以开始字符为唯一标识符截取，不等于0则以结束字符为唯一标识符截取
* @return string 返回截取的内容
*/


function cut($str,$begin,$end,$number){
  
  if($number==0){
return cut_str(cut_str($str,$begin,-1),$end,0);
  }else{
  return cut_str(cut_str($str,$end,0),$begin,-1);
  }
}

/**
* 按符号截取字符串的指定部分
* @param string $str 需要截取的字符串
* @param string $sign 需要截取的符号
* @param int $number 如是正数以0为起点从左向右截 负数则从右向左截
* @return string 返回截取的内容
*/
function cut_str($str,$sign,$number){
    $array=explode($sign, $str);
    $length=count($array);
    if($number<0){
        $new_array=array_reverse($array);
        $abs_number=abs($number);
        if($abs_number>$length){
            return 'error';
        }else{
            return $new_array[$abs_number-1];
        }
    }else{
        if($number>=$length){
            return 'error';
        }else{
            return $array[$number];
        }
    }
}



?>