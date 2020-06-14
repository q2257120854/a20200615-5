<script>
  var leftbgColor='#112233';
  
  var showindex=-1;
  var maxindex=0;
</script>
<?php

include_once "nav.php";

mysql_query("alter table chzb_appdata add column autoupdate int DEFAULT 1;");
mysql_query("alter table chzb_appdata add column updateinterval int DEFAULT 15;");
mysql_query("alter table chzb_category add column psw varchar(16) DEFAULT '';");
mysql_query("alter table chzb_category_cc add column psw varchar(16) DEFAULT '';");
mysql_query("alter table chzb_category_dx add column psw varchar(16) DEFAULT '';");
mysql_query("alter table chzb_category_lt add column psw varchar(16) DEFAULT '';");
mysql_query("alter table chzb_category_qw add column psw varchar(16) DEFAULT '';");
mysql_query("alter table chzb_category_sl add column psw varchar(16) DEFAULT '';");
mysql_query("alter table chzb_category_yd add column psw varchar(16) DEFAULT '';");


if($_SESSION['channeladmin']==0){
	exit();
}

function echoJSON($category){
	$sql = "SELECT name,url FROM chzb_channels where category='$category' order by id";
	$result = mysql_query($sql);

	while($row = mysql_fetch_array($result)) {
		if(!in_array($row['name'],$nameArray)){
			$nameArray[]=$row['name'];
		}		
		$sourceArray[$row['name']][]=$row['url'];
	}
	mysql_free_result($result);
	$objCategory=(Object)null;
	$objChannel=(Object)null;

	for($i=0;$i<count($nameArray);$i++) {
		$objChannel=(Object)null;
		$objChannel->name=$nameArray[$i];
		$objChannel->source=$sourceArray[$nameArray[$i]];
		$channelArray[]=$objChannel;
	}
	$objCategory->$category=$channelArray;
	return $objCategory;
}

?>

<html>
<head>
<meta charset="UTF-8"> <!-- for HTML5 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
  (function($){$.session={_id:null,_cookieCache:undefined,_init:function()
  {if(!window.name){window.name=Math.random();}
  this._id=window.name;this._initCache();var matches=(new RegExp(this._generatePrefix()+"=([^;]+);")).exec(document.cookie);if(matches&&document.location.protocol!==matches[1]){this._clearSession();for(var key in this._cookieCache){try{window.sessionStorage.setItem(key,this._cookieCache[key]);}catch(e){};}}
  document.cookie=this._generatePrefix()+"="+ document.location.protocol+';path=/;expires='+(new Date((new Date).getTime()+ 120000)).toUTCString();},_generatePrefix:function()
  {return'__session:'+ this._id+':';},_initCache:function()
  {var cookies=document.cookie.split(';');this._cookieCache={};for(var i in cookies){var kv=cookies[i].split('=');if((new RegExp(this._generatePrefix()+'.+')).test(kv[0])&&kv[1]){this._cookieCache[kv[0].split(':',3)[2]]=kv[1];}}},_setFallback:function(key,value,onceOnly)
  {var cookie=this._generatePrefix()+ key+"="+ value+"; path=/";if(onceOnly){cookie+="; expires="+(new Date(Date.now()+ 120000)).toUTCString();}
  document.cookie=cookie;this._cookieCache[key]=value;return this;},_getFallback:function(key)
  {if(!this._cookieCache){this._initCache();}
  return this._cookieCache[key];},_clearFallback:function()
  {for(var i in this._cookieCache){document.cookie=this._generatePrefix()+ i+'=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';}
  this._cookieCache={};},_deleteFallback:function(key)
  {document.cookie=this._generatePrefix()+ key+'=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';delete this._cookieCache[key];},get:function(key)
  {return window.sessionStorage.getItem(key)||this._getFallback(key);},set:function(key,value,onceOnly)
  {try{window.sessionStorage.setItem(key,value);}catch(e){}
  this._setFallback(key,value,onceOnly||false);return this;},'delete':function(key){return this.remove(key);},remove:function(key)
  {try{window.sessionStorage.removeItem(key);}catch(e){};this._deleteFallback(key);return this;},_clearSession:function()
  {try{window.sessionStorage.clear();}catch(e){for(var i in window.sessionStorage){window.sessionStorage.removeItem(i);}}},clear:function()
  {this._clearSession();this._clearFallback();return this;}};$.session._init();})(jQuery);

</script>

<style type="text/css">
a{
text-decoration: none;
font-size:16px;
color:#0000ff;
}
#pdlist{padding-left: 0px;padding-top: 5px;}
ul li{list-style: none}
textarea{
	font-size:16px;
	font-family:Fixedsys;
	line-height: 1.5;
	width:100%;
	height: 76%;
	white-space:nowrap; 
	overflow:scroll;

}
input{
	margin:5px;
}
img{
	vertical-align: middle;
	padding-left: 5px;
}
pre{
white-space:pre-wrap;
white-space:-moz-pre-wrap;
white-space:-pre-wrap;
white-space:-o-pre-wrap;
word-wrap:break-word;
}

</style>

</head>
<body>
<?php
ini_set('display_errors',1);            
ini_set('display_startup_errors',1);   
error_reporting(E_ERROR);

if(isset($_GET['nettype'])){
	$nettype=$_GET['nettype'];
}else{
	$nettype='通用';
}

switch ($nettype) {
	case '全网':
		$categoryname="chzb_category_qw";
		$numCount=1;
		break;	
	case '电信':
		$categoryname="chzb_category_dx";
		$numCount=51;
		break;
	case '联通':
		$categoryname="chzb_category_lt";
		$numCount=51;
		break;
	case '移动':
		$categoryname="chzb_category_yd";
		$numCount=51;
		break;
	case '通用':
		$categoryname="chzb_category";
		$numCount=101;
		break;
	case '省内':
		$categoryname="chzb_category_sl";
		$numCount=151;
		break;
	case '隐藏':
		$categoryname="chzb_category_jw";
		$numCount=51;
		break;
	default:
		$categoryname="chzb_category_yd";
		$numCount=51;
		break;
}
//对分类进行重新排序　
$result=mysql_query("SELECT * from $categoryname order by id");
while ($row=mysql_fetch_array($result)) {
	$name=$row['name'];
	mysql_query("UPDATE $categoryname set id=$numCount where name='$name'");
	$numCount++;
}
//排序结束


if(isset($_GET['pd'])){
	$pd=$_GET['pd'];
}else{
	$result=mysql_query("SELECT name from $categoryname order by id");
	if($row=mysql_fetch_array($result)){
		$pd=$row['name'];
	}else{
		$pd='';
	}
}

	mysql_query("set names utf8");

	if(isset($_POST['submit'])&&isset($_POST['pd'])&&isset($_POST['srclist'])){
		$pd=$_POST['pd'];
		$srclist=$_POST['srclist'];
		$showindex=$_POST['showindex'];
		if($nettype=='省内'){
			$i=50000;
		}else if($nettype=='通用'){
			$i=40000;
		}else if($nettype=='全网'){
			$i=0;
		}else {
			$i=20000;
		}
		
		mysql_query("delete from chzb_channels where category='$pd' and nettype='$nettype'");
		$rows=explode("\r\n",$srclist);
		foreach($rows as $row){	
			if (strpos($row, ',') !== false){
				$ipos=strpos($row, ',');			
				//$arr_row=explode(",",$row);
				$channelname=substr($row,0,$ipos);
				$source=substr($row,$ipos+1);
				if(strpos($source,'#')!==false){
					$sources=explode("#",$source);
					foreach ($sources as $src) {
						$i++;
						$src2=str_replace("\"", "", $src);
						$src2=str_replace("\'", "", $src2);
						//$src2=str_replace(",", "", $src2);
						$src2=str_replace("}", "", $src2);
						$src2=str_replace("{", "", $src2);
						if($channelname!=''&&$src2!=''){
							mysql_query("INSERT INTO chzb_channels VALUES ($i,'$channelname','$src2','$pd','$nettype')");
						
						}
						
					}					
				}else{
					$i++;
					$src2=str_replace("\"", "", $source);
					$src2=str_replace("\'", "", $src2);
					//$src2=str_replace(",", "", $src2);
					$src2=str_replace("}", "", $src2);
					$src2=str_replace("{", "", $src2);
					if($channelname!=''&&$src2!=''){
						mysql_query("INSERT INTO chzb_channels VALUES ($i,'$channelname','$src2','$pd','$nettype')");
					}
				}
				
			}
		}
		echo"<script>showindex=$showindex;</script>保存成功。";
		
	}
	if(isset($_POST['submit'])&&isset($_POST['category'])){
		$category=$_POST['category'];
		$isprov=$_POST['isprov'];
		$canseek=$_POST['canseek'];
		$cpass=$_POST['cpass'];
        $maxindex=$_POST['maxindex'];
		if($category==""){
			echo "类别名称不能为空！";
			exit();
		}
		if($isprov=="true"){
			$isprovValue=1;
		}else{
			$isprovValue=0;
		}
		if($canseek=="true"){
			$canseekValue=1;
		}else{
			$canseekValue=0;
		}

		
		$result=mysql_query("SELECT max(id) from $categoryname");
		if($row=mysql_fetch_array($result)){			
			if($row[0]>0){
				$numCount=$row[0]+1;
			}
		}
		

		$sql = "SELECT name FROM $categoryname where name='$category'";
		$result = mysql_query($sql);
		if(mysql_fetch_array($result)){
			echo "<script>showindex=$showindex;</script>该栏目已经存在！";
		}else{
			mysql_query("INSERT INTO $categoryname (id,name,isprov,canseek,psw) VALUES ($numCount,'$category',$isprovValue,$canseekValue,'$cpass')");
			$result=mysql_query("SELECT * from $categoryname");
			$showindex=mysql_num_rows($result)-1;
			echo "<script>showindex=$showindex;</script><font color=red>增加类别$category 成功！</font>";
			$pd=$category;
			//header("location:?nettype=$nettype&pd=$pd");
		}
        
		
	}
	if(isset($_POST['submit_deltype'])&&isset($_POST['category'])){
		$category=$_POST['category'];
	    $showindex=$_POST['showindex'];
		$result=mysql_query("SELECT id from $categoryname where name='$category'");
		if($row=mysql_fetch_array($result)){
			$categoryid=$row[0];
			mysql_query("UPDATE $categoryname set id=id-1 where id>$categoryid");
		}

		$sql = "delete from $categoryname where name='$category'";
		mysql_query($sql);	
		mysql_query("delete from chzb_channels where category='$category' and nettype='$nettype'");
		echo "<script>showindex=$showindex-1;</script>$category 删除成功！";
	}

	if(isset($_POST['submit_modifytype'])&&isset($_POST['category'])){
		$category=$_POST['category'];	
		$isprov=$_POST['isprov'];
		$canseek=$_POST['canseek'];
		$cpass=$_POST['cpass'];
        $showindex=$_POST['showindex'];
        $category0=$_POST['typename0'];
		if($category==""){
			echo "类别名称不能为空！";
			exit();
		}
		if($isprov=="true"){
			$isprovValue=1;
		}else{
			$isprovValue=0;
		}
		if($canseek=="true"){
			$canseekValue=1;
		}else{
			$canseekValue=0;
		}		
		mysql_query("update $categoryname set name='$category',psw='$cpass',canseek=$canseekValue,isprov=$isprovValue where name='$category0'");
		mysql_query("UPDATE chzb_channels set category='$category' where category='$category0'");
		echo "$category 修改成功！<script>showindex=$showindex;</script>";
		$pd=$category;
	}

	if(isset($_POST['submit_moveup'])&&isset($_POST['category'])){
		$category=$_POST['category'];
       $showindex=$_POST['showindex'];
		$result=mysql_query("SELECT id from $categoryname where name='$category'");
		if($row=mysql_fetch_array($result)){
			$id=$row['id'];
			if(!($id==101||$id==51||$id==1)){
				$preid=$id-1;
				mysql_query("update $categoryname set id=id+1  where id=$preid");	
				mysql_query("update $categoryname set id=id-1  where name='$category'");
               echo "<script>showindex=$showindex-1;</script>";
			}
		}
	}
	if(isset($_POST['submit_movedown'])&&isset($_POST['category'])){
		$category=$_POST['category'];
       $showindex=$_POST['showindex'];
		$result=mysql_query("SELECT id from $categoryname where name='$category'");
		if($row=mysql_fetch_array($result)){
			$id=$row['id'];	
			$nextid=$id+1;
			if(mysql_fetch_array(mysql_query("SELECT id from $categoryname where id=$nextid"))){
				mysql_query("update $categoryname set id=id-1  where id=$nextid");	
				mysql_query("update $categoryname set id=id+1  where name='$category'");
            	echo "<script>showindex=$showindex+1;</script>";
			}else{
            	echo "<script>showindex=$showindex;</script>";
            }
			
			
		}
	}
	if(isset($_POST['submit_movetop'])&&isset($_POST['category'])){
		$category=$_POST['category'];
		$result=mysql_query("SELECT Min(id) from $categoryname");
		if($row=mysql_fetch_array($result)){
			$id=$row[0]-1;				
			mysql_query("update $categoryname set id=$id  where name='$category'");
			mysql_query("update $categoryname set id=id+1");
			echo "<script>showindex=0;</script>";
		}
	}

	if(isset($_POST['submit'])&&isset($_POST['ver'])){
		$updateinterval=$_POST['updateinterval'];

		if(isset($_POST['autoupdate'])){			
			mysql_query("update chzb_appdata set autoupdate=1,updateinterval=$updateinterval");
			
		}else{
			$ver=$_POST['ver'];
			$sql = "update chzb_appdata set dataver=$ver,autoupdate=0";
			mysql_query($sql);	
			
		}
		echo "<font color=red>保存成功。</font>";
		
	}

	if(isset($_POST['checkpdname'])){ 
		mysql_query("UPDATE $categoryname set enable=0");
			foreach ($_POST['enable'] as $pdenable) {				
				mysql_query("UPDATE $categoryname set enable=1 where name='$pdenable'");		 	 
			 }

	}

	$result=mysql_query("select psw,canseek,isprov from $categoryname where name='$pd'");
	if($row=mysql_fetch_array($result)){
		$canseek=$row['canseek'];
		$isprov=$row['isprov'];
		$cpass=$row['psw'];
		if($canseek==1){
			$canseekchecked=" checked='true' ";
		}else{
			$canseekchecked="";
		}
		if($isprov==1){
			$isprovchecked=" checked='true' ";
		}else{
			$isprovchecked="";
		}
	}else{
		$canseekchecked="";
		$isprovchecked="";
	}


	
	$sql = "SELECT dataver,appver,autoupdate,updateinterval FROM chzb_appdata";
	$result = mysql_query($sql);
	if($row = mysql_fetch_array($result)) {
		$ver=$row['dataver'];
		$versionname=$row['appver'];
		$autoupdate=$row['autoupdate'];
		$updateinterval=$row['updateinterval'];
	}else{
		$ver="0";
		$autoupdate=0;
		$updateinterval=0;
	}
	if($autoupdate==1){
		$checktext="checked='true'";
	}else{
		$checktext='';
	}
?>
  <div id="tip"></div>
<div  style="float:left;width:99%;text-align: right;
border-top:1px solid #a0c6e5;
border-left:1px solid #a0c6e5;
border-right:1px solid #a0c6e5;
border-bottom: :0px solid #a0c6e5;">
<table>
	<tr>
		<td width="400px">
		<form method="post" id='autoupdate_form'>	
		
		<input type="hidden" name="ver" value="<?php echo ($ver+1); ?>">
		间隔时间<input type="text" name='updateinterval' value="<?php echo $updateinterval ?>" size="5">分
		<?php echo"<input type=\"checkbox\" name=\"autoupdate\" value=\"$autoupdate\" $checktext>自动更新"?>
		<input type="submit" name="submit" value="&nbsp;&nbsp;保存设定&nbsp;&nbsp;"/>
		</form>
		</td>
		<td>

		<form method="post">
        <input type="hidden" id="showindextype" name="showindex" value=""/>
        <input type="hidden" id="typename0" name="typename0" value=""/>
		分类名称<input id="typename" type="text" size="10" name="category" value="<?PHP echo $pd?>" />
		分类密码<input id="typepass" type="text" size="10" name="cpass" value="<?PHP echo $cpass?>" />
		
		
		<input type="submit" name="submit" value="增加分类">
		<input type="submit" name="submit_deltype" value="删除分类">
		<input type="submit" name="submit_modifytype" value="修改分类">
		<input type="submit" name="submit_moveup" value="上移分类">
		<input type="submit" name="submit_movedown" value="下移分类">
		<input type="submit" name="submit_movetop" value="移至最上">
		</form>
		</td></tr>
</table>
</div>

<div style="float:left; width:19%;height:80%;border-left:1px solid #a0c6e5;border-bottom:1px solid #a0c6e5;" >
<div style="height: 35px;"></div>
<div id="cate" style="border-top:1px solid #a0c6e5;padding:5px;overflow:scroll;height: 94%">
<script type="text/javascript">
var nettype="<?php echo $nettype ?>";
var pdname=[];
var psw=[];
</script>
<center>

<ul id="pdlist">
	<?php
			$sql = "SELECT name,psw,isprov,canseek,enable FROM $categoryname order by isprov,id";
			
			$result = mysql_query($sql);
			$index=0;
				while($row = mysql_fetch_array($result)) {
					$pdname=$row['name'];
					$isprov=$row['isprov'];
					$enable=$row['enable'];
					$canseek=$row['canseek'];
					$cpass=$row['psw'];
					if($enable==1){
						$check='checked=checked';
					}else{
						$check='';
					}

				   if($cpass==''){
                   	$lockimg='';
                   }else{
                   	$lockimg='*';
                   }
					
                   echo "<script>pdname[$index]='$pdname';psw[$index]='$cpass';</script>";
					echo "<li>
					<a href='#' onclick=\"showlist($index)\">
					<div class='pdlist' style='text-align:left;padding-left:25px;padding-top:5px;padding-bottom:5px;'>
					<input width='20px' type='checkbox' $check onclick='togglepdcheck(\"$pdname\",\"$categoryname\")'/>					
					$pdname $lockimg 
					
					</div>
					
					</a>
					</li>";
					$index++;
				}
	mysql_close($con);
	?>
</ul></center>
</div>
</div>
<script>
  	function togglepdcheck(pdname,catname){
		$.get("togglepd.php?pdname="+pdname+"&cat="+catname,function(data){$("#tip").html(data)});
	}
	function showlist(index){
      	$("#pdlist li div").css("fontSize","22px");
        
        $("#cate").css("background","#3c444d");
		$("#pdlist li").css("background","none");		
		$(".pdlist").css("color","#d6d7d9");
      	$("#pdlist li").css("border-left","3px solid #3c444d");
        $($("#pdlist li")[index]).css("background","#2c3138");
        $($("#pdlist li")[index]).css("border-left","3px solid #55ff77");
		$($(".pdlist")[index]).css("color","white");
              
	    $("#srclist").val("正在加载中...");
   		$("#srclist").load("getlist.php?nettype="+nettype+"&pd="+pdname[index],function(data){
          $("#srclist").val(data);
        });
		$("#typename").val(pdname[index]);
     	 $("#typename0").val(pdname[index]);
        $("#typepass").val(psw[index]);
		$("#pd").val(pdname[index]);
		$("#showindex").val(index);
     	 $("#showindextype").val(index);
		showindex=index;
        $.session.set("<?php echo $nettype.'showindex';?>",showindex);
	}
    if(showindex==-1)  showindex=$.session.get("<?php echo $nettype.'showindex';?>");

    $("#cate")[0].scrollTop=$.session.get("<?php echo $nettype.'scrollTop';?>");
    $("#cate").scroll(function(){
          $.session.set("<?php echo $nettype.'scrollTop';?>", $(this)[0].scrollTop);
    });
</script>

<div  style="float:left;width:80%;text-align: center;">
<form method="post">
<div style="text-align: left;height: 20px; padding: 10px;border-right: 1px solid #a0c6e5;">
<font color=red size="3"><B>注意：维护节目源后需点击左上角推送节目，下次启动就是最新的节目数据。</B></font>
<div style="float: right;margin:0px;padding-right:30px;" >
<?php
	switch ($pd) {
		case '央视栏目':
			echo "<a target='_blank' href='./cntv.php'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '星秀':
			echo "<a target='_blank' href='./huya.php?type=1663'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '户外':
			echo "<a target='_blank' href='./huya.php?type=2165'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '二次元':
			echo "<a target='_blank' href='./huya.php?type=2633'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '一起看':
			echo "<a target='_blank' href='./huya.php?type=2135&count=100'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '美食':
			echo "<a target='_blank' href='./huya.php?type=2752'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '颜值':
			echo "<a target='_blank' href='./huya.php?type=2168'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '交友':
			echo "<a target='_blank' href='./huya.php?type=4079'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '吃喝玩乐':
			echo "<a target='_blank' href='./huya.php?type=100044'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '娱乐天地':
			echo "<a target='_blank' href='./huya.php?type=100022'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '陪玩':
			echo "<a target='_blank' href='./huya.php?type=5367'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '音乐':
			echo "<a target='_blank' href='./huya.php?type=3793'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '体育':
			echo "<a target='_blank' href='./huya.php?type=tiyu'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '湖南':
			echo "<a target='_blank' href='./huya.php?type=5123'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '虎牙文化':
			echo "<a target='_blank' href='./huya.php?type=wenhua'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '动漫':
			echo "<a target='_blank' href='./huya.php?type=dm'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '技术宅':
			echo "<a target='_blank' href='./huya.php?type=jsz'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		case '英雄联盟':
			echo "<a target='_blank' href='./huya.php?type=lol'>立即更新</a>&nbsp;&nbsp;&nbsp;";
			break;
		default:
			# code...
			break;
	}


?>
<input style="margin:0px;padding:3px;" type="submit" name="submit" value="&nbsp;&nbsp;保&nbsp;&nbsp;&nbsp;&nbsp;存&nbsp;&nbsp;"></div>
</div>
<input type="hidden" id="pd" name="pd" value=""/>
<input type="hidden" id="showindex" name="showindex" value=""/>

<textarea id="srclist" name="srclist">

</textarea>

</form>
</div>
<script type="text/javascript">
showlist(showindex);
</script>

</body>
</html>

