<?php
header("Content-type: text/html; charset=utf-8");
$data=file_get_contents('https://live.wasu.cn/show/id/');
preg_match_all("/live\.wasu\.cn\/show\/id\/[0-9]{1,}.*?                                                                                <\/a>/", $data, $matches);
$arr=$matches[0];

for ($i=0; $i <count($arr) ; $i++) { 
	preg_match("/>.*?/",$arr[$i],$m);
	$name=$m[0];
	preg_match("/[0-9]+/", $arr[$i],$n);
	$id=$n[0];
	echo $arr[$i];
	//echo $name .',https://live.wasu.cn/show/id/'.$id ."\r\n";
}

?>