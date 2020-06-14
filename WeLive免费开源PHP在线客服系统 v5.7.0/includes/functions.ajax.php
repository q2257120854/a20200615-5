<?php if(!defined('ROOT')) die('Access denied.');

//留言时需要使用的函数
function IsEmail($email){
	return preg_match("/^[a-z0-9]+[.a-z0-9_-]*@[a-z0-9]+[.a-z0-9_-]*\.[a-z0-9]+$/i", $email);
}


// ##
function ForceInt($InValue, $DefaultValue = 0) {
	$iReturn = intval($InValue);
	return ($iReturn == 0) ? $DefaultValue : $iReturn;
}

// ##
function ForceString($InValue, $DefaultValue = '') {
	if (is_string($InValue)) {
		$sReturn = EscapeSql(trim($InValue));
		if (empty($sReturn) && strlen($sReturn) == 0) $sReturn = $DefaultValue;
	} else {
		$sReturn = EscapeSql($DefaultValue);
	}
	return $sReturn;
}

// ##
function ForceStringFrom($VariableName, $DefaultValue = '') {
	if (isset($_GET[$VariableName])) {
		return ForceString($_GET[$VariableName], $DefaultValue);
	} elseif (isset($_POST[$VariableName])) {
		return ForceString($_POST[$VariableName], $DefaultValue);
	} else {
		return $DefaultValue;
	}
}

// ##
function ForceIntFrom($VariableName, $DefaultValue = 0) {
	if (isset($_GET[$VariableName])) {
		return ForceInt($_GET[$VariableName], $DefaultValue);
	} elseif (isset($_POST[$VariableName])) {
		return ForceInt($_POST[$VariableName], $DefaultValue);
	} else {
		return $DefaultValue;
	}
}

// ##
function ForceCookieFrom($VariableName, $DefaultValue = '') {
	if (isset($_COOKIE[$VariableName])) {
		return ForceString($_COOKIE[$VariableName], $DefaultValue);
	} else {
		return $DefaultValue;
	}
}

// ##
function EscapeSql($query_string) {
	global $DB;

	if(get_magic_quotes_gpc()) $query_string = stripslashes($query_string);

	$query_string = htmlspecialchars(str_replace (array('\0', '　'), '', $query_string), ENT_QUOTES);

	if($DB->type == "mysqli"){
		if(function_exists('mysqli_real_escape_string')) {
			$query_string = mysqli_real_escape_string($DB->conn, $query_string);
		}else{
			$query_string = addslashes($query_string);
		}
	}else{
		if(function_exists('mysql_real_escape_string')) {
			$query_string = mysql_real_escape_string($query_string);
		}else if(function_exists('mysql_escape_string')){
			$query_string = mysql_escape_string($query_string);
		}else{
			$query_string = addslashes($query_string);
		}
	}

	return $query_string;
}

//创建验证码, 返回id
function createVVC() {
	global $DB;
	
	$DB->exe("INSERT INTO " . TABLE_PREFIX . "vvc (time) VALUES ('".time()."')");
	return $DB->insert_id;
}

//验证码校验  参数delete:  ajax验证时, 如果表单还要提交, 不能删除
function checkVVC($vid, $code, $delete = 1) {
	global $DB;

	if(!$vid OR !$code) return false;

	$vvc = $DB->getOne("SELECT code FROM " . TABLE_PREFIX . "vvc WHERE vid = '$vid'");
	if($vvc AND $vvc['code'] == $code){
		if($delete) $DB->exe("DELETE FROM " . TABLE_PREFIX . "vvc WHERE vid = '$vid'");
		return true;
	}

	return false;
}


//验证码
function getVVC($w = 70, $h = 24) {
	global $DB;

	$im = imagecreate($w, $h);
	$red = imagecolorallocate($im, 14, 114, 180);

	$num1 = rand(1, 20);
	$num2 = rand(1, 20);

	$vid = ForceIntFrom('vid');
	if($vid) $DB->exe("UPDATE ".TABLE_PREFIX."vvc SET code = '" . ($num1 + $num2). "' WHERE vid = '$vid'");

	$gray = imagecolorallocate($im, 188, 188, 188);
	$black = imagecolorallocate($im, 255, 255, 255);

	//画背景
	imagefilledrectangle($im, 0, 0, 100, 24, $black);
	//在画布上随机生成大量点，起干扰作用;
	for ($i = 0; $i < 80; $i++) {
		imagesetpixel($im, rand(0, $w), rand(0, $h), $gray);
	}

	imagestring($im, 5, 5, 4, $num1, $red);
	imagestring($im, 5, 30, 3, "+", $red);
	imagestring($im, 5, 45, 4, $num2, $red);

	header("Content-type: image/png");
	imagepng($im);
	imagedestroy($im);
}

?>