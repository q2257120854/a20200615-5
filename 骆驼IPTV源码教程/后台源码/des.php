<?php
header('Content-Type: text/json;charset=UTF-8');

$id=isset($_GET['id'])?$_GET['id']:0;

$json=file_get_contents('http://livemm.ottcom.cn/index/channel?isp=%E7%94%B5%E4%BF%A1');

$obj=json_decode($json);
$data=$obj->data;

$list=decrypt($data,'galaxy88','galaxy88');

$objlist=json_decode($list);
$result='';
foreach ($objlist as $objCategory) {
	if($id==0){
		$objChannels=$objCategory->list;
		$result=$result.$objCategory->name.",#genre#\r\n";
		foreach ($objChannels as $objChannel) {
			$name=$objChannel->name;
			$streams=$objChannel->streams;
			foreach ($streams as $stream) {
				$result=$result.$name.','.$stream->url."\r\n";
			}
		}
	}else{
		if($id==$objCategory->id){
			$result=$result.$objCategory->name.",#genre#\r\n";
			$objChannels=$objCategory->list;
			foreach ($objChannels as $objChannel) {
				$name=$objChannel->name;
				$streams=$objChannel->streams;
				foreach ($streams as $stream) {
					$result=$result.$name.','.$stream->url."\r\n";
				}
			}
		}
	}
}

echo $result;

/*
 * 在采用DES加密算法,cbc模式,pkcs5Padding字符填充方式下,对明文进行加密函数
 */
 
function encrypt($input, $ky, $iv) {
    $key = $ky;
    $iv = $iv;  //$iv为加解密向量
    $size = 8; //填充块的大小,单位为bite    初始向量iv的位数要和进行pading的分组块大小相等!!!
    $input = pkcs5_pad($input, $size);  //对明文进行字符填充
    $td = mcrypt_module_open(MCRYPT_DES, '', 'cbc', '');    //MCRYPT_DES代表用DES算法加解密;'cbc'代表使用cbc模式进行加解密.
    mcrypt_generic_init($td, $key, $iv);
    $data = mcrypt_generic($td, $input);    //对$input进行加密
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);
    $data = base64_encode($data);   //对加密后的密文进行base64编码
    return $data;
}

 
/*
 * 在采用DES加密算法,cbc模式,pkcs5Padding字符填充方式,对密文进行解密函数
 */
 
function decrypt($crypt, $ky, $iv) {
    $crypt = base64_decode($crypt);   //对加密后的密文进行解base64编码
    $key = $ky;
    $iv = $iv;  //$iv为加解密向量
    $td = mcrypt_module_open(MCRYPT_DES, '', 'cbc', '');    //MCRYPT_DES代表用DES算法加解密;'cbc'代表使用cbc模式进行加解密.
    mcrypt_generic_init($td, $key, $iv);
    $decrypted_data = mdecrypt_generic($td, $crypt);    //对$input进行解密
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);
    $decrypted_data = pkcs5_unpad($decrypted_data); //对解密后的明文进行去掉字符填充
    $decrypted_data = rtrim($decrypted_data);   //去空格
    return $decrypted_data;
}
 
/*
 * 对明文进行给定块大小的字符填充
 */
 
function pkcs5_pad($text, $blocksize) {
    $pad = $blocksize - (strlen($text) % $blocksize);
    return $text . str_repeat(chr($pad), $pad);
}
 
/*
 * 对解密后的已字符填充的明文进行去掉填充字符
 */
 
function pkcs5_unpad($text) {
    $pad = ord($text{strlen($text) - 1});
    if ($pad > strlen($text))
        return false;
    return substr($text, 0, -1 * $pad);
}



?>