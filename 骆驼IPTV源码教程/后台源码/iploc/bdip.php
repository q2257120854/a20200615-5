<?php

header("Content-type:text/html;charset=utf-8");

$ip=isset($_GET['ip'])?$_GET['ip']:$_SERVER['REMOTE_ADDR'];
$json= curl("http://api.anquan.baidu.com/ipgeo/info?ip=$ip");
$obj=json_decode($json);
$loc=$obj->result->baseinfo->colombo->province;
echo $json;


function curl($url,$post=null,$header=null){
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if(isset($header)){
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
		}else{
			$add_header = array("User-Agent: Youku HD;3.9.4;iPhone OS;7.1.2;iPad4,1",
				"apikey: APIKEY_b81194ba0ad9b695ed23445ac60362cf");
            curl_setopt($ch, CURLOPT_ENCODING, "gzip, deflate");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $add_header);
		}
        if(isset($post)) {
			curl_setopt($ch, CURLOPT_POST,1 );
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");      
            curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
		}
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        $response = curl_exec($ch);
	    curl_close ($ch);
	    return $response;
}


?>