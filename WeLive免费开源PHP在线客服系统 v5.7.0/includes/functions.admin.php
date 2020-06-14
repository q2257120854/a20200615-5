<?php if(!defined('ROOT')) die('Access denied.');

//处理后台URL: 参数c控制器; 参数a动作;
function BURL($q = ''){
	if(!$q) return './';
	$q = explode('?', $q, 2);
	$ca = explode('/', $q[0], 2);

	$ca[0] && $url = "?c=$ca[0]";
	if(isset($ca[1])) $url = Iif($url, "$url&a=$ca[1]", "?a=$ca[1]");
	if(isset($q[1])) $url = Iif($url, "$url&$q[1]", "?$q[1]");

	return "index.php$url";
}

//返回用户头像URL
function GetAvatar($userid, $n = 0) {
	$filename = Iif(file_exists(ROOT . "avatar/$userid.jpg"), "$userid.jpg", "0.jpg");
	if($n) return $filename; //仅返回头像文件名
	return SYSDIR . "avatar/$filename";
}

//立即跳转函数 redirect
function Redirect($url = ''){
	echo '<script type="text/javascript">document.location="' . BURL($url) . '";</script>';
	exit();
}

//转换表情符号
function getSmile($str = ''){
	return preg_replace("/\[:(\d+):\]/i", '<img src="' . SYSDIR . 'public/smilies/${1}.png">', $str);
}

//  BR #
function BR($n=1) {for($i = 0; $i < $n; $i++) echo '<BR>';}

//  PRINT HEADER #
function SubMenu($title, $menus = array()) {
	if(empty($menus)) {
		$s = '<div class="itemtitle"><h3>'.$title.'</h3></div>';
	} else {
		$s = '<div class="itemtitle"><h3>'.$title.'</h3><ul>';
		foreach($menus as $k => $menu) {
			$s .= '<a class="link-btn' . Iif($menu[2], ' link-live') . '" href="' . Iif($menu[1], BURL($menu[1]), "javascript:;") . '">' . $menu[0] . '</a>';
		}
		$s .= '</ul></div>';
	}
	echo $s;
}

//  ShowTips #
function ShowTips($tips, $tiptitle = '技巧提示') {
	TableHeader($tiptitle);
	TableRow('<div class=tips>' . $tips . '</div>');
	TableFooter();
}

//  Table #
function TableHeader($title = '') {
	echo '<table class="tb">';
	if($title) {
		echo '<tr><td colspan="38" class="tbheader">'.$title.'</td></tr>';
	}
}

function TableRow($tdtext = '', $trstyle = '') {
	$cells = '<tr' . Iif($trstyle, ' class='.$trstyle) . '>';
	if(is_array($tdtext)) {
		$last = count($tdtext) - 1;
		foreach($tdtext as $key => $v) {
				$cells .= '<td class="td' . Iif($last == $key, ' last') . '">' . $v . '</td>';
		}
	} else {
		$cells .= '<td colspan="38" valign="middle" class="td">'.$tdtext.'</td>';
	}
	$cells .= '</tr>';
	echo $cells;
}

function TableFooter() {
	echo '</table>';
}

//  PRINT SUBMIT #
function PrintSubmit($submit, $cancel = '', $confirm = 0, $confirminfo ='') {
	echo '<div class="submit"><input class="save" type="submit" name="save" value="' . $submit . '"' . Iif($confirm, ' onclick="var _me=$(this);showDialog(\'' . Iif($confirminfo, $confirminfo, '确定保存更新吗?') . '\', \'确认操作\', function(){_me.closest(\'form\').submit();});return false;"') . '>' . Iif($cancel, '<input class="cancel" type="submit" name="cancel" value="' . $cancel . '" onclick="history.back();return false;">') . '</div></form>';
}

// 输出 错误信息对话框  参数$errors:字符串或数据;  $time: 自动关闭的时间(秒)
function Error($errors, $title = '', $time = 0) {
	if(empty($errors)) return; //无信息时仅返回;
	if(is_array($errors)){
		for($i = 0; $i < count($errors); $i++)
			$str .= "<font color=#AEABAA>" . ($i + 1) . "). </font>$errors[$i]<br>";
	}else {
		$str =  $errors;
	}

	die("<script>\$(function(){showInfo('$str', '$title', function(){history.back();}, $time);});</script>");
}


// 输出 成功信息对话框  参数$url: 为空显示信息不跳转; $info:字符串;  $time自动关闭的时间(秒)
function Success($url = '', $time = 1, $info = '', $title = '') {
	if(!$info) $info = '<font color=#AEABAA>操作成功, 页面跳转中 ...</font>';
	if($url){
		$callback = "function(){document.location='". BURL($url) ."';}"; //关闭后跳转, $url如果为空则不跳转
	}else{
		$callback = 0;
	}
	echo "<script>\$(function(){showInfo('$info', '$title', $callback, $time, 1);});</script>";

	if($url) die();
}

// ADMIN PAGELIST #
function GetPageList($FileName, $PageCount, $CurrentPage = 1, $PagesToDisplay = 10, $PN01 = '', $PNV01 = '', $PN02 = '', $PNV02 = '', $PN03 = '', $PNV03 = '', $PN04 = '', $PNV04 = '', $PN05 = '', $PNV05 = '') {

	if($PageCount < 2) return '';
	$PreviousText =  '上一页';
	$NextText = '下一页';

	$Params = '';
	$Params .= Iif($PN01 AND $PNV01, '&'.$PN01.'='.$PNV01);
	$Params .= Iif($PN02 AND $PNV02, '&'.$PN02.'='.$PNV02);
	$Params .= Iif($PN03 AND $PNV03, '&'.$PN03.'='.$PNV03);
	$Params .= Iif($PN04 AND $PNV04, '&'.$PN04.'='.$PNV04);
	$Params .= Iif($PN05 AND $PNV05, '&'.$PN05.'='.$PNV05);

	$iPagesToDisplay = $PagesToDisplay - 2;      
	if ($iPagesToDisplay <= 8) $iPagesToDisplay = 8;

	$MidPoint = ($iPagesToDisplay / 2);

	$FirstPage = $CurrentPage - $MidPoint;
	if ($FirstPage < 1) $FirstPage = 1;

	$LastPage = $FirstPage + ($iPagesToDisplay - 1);

	if ($LastPage > $PageCount) {
		$LastPage = $PageCount;
		$FirstPage = $PageCount - $iPagesToDisplay;
		if ($FirstPage < 1) $FirstPage = 1;
	}

	$Loop = 0;
	$iTmpPage = 0;
	$sReturn = '<div id="pagelist"><div class="PageListDiv"><ol class="PageList">';

	if ($CurrentPage > 1) {
		$iTmpPage = $CurrentPage - 1;
		$sReturn .= '<li><a href="' . $FileName . '&p=' . $iTmpPage . $Params . '" class="PagePrev"  onfocus="this.blur()">'.$PreviousText.'</a></li>';
	} else {
		$sReturn .= '<li><span class="NoPagePrev">'.$PreviousText.'</span></li>';
	}

	if ($FirstPage > 2) {
		$sReturn .= '<li><a href="' . $FileName . '&p=1' . $Params . '" onfocus="this.blur()">1</a></li><li>...</li>';
	} elseif ($FirstPage == 2) {
		$sReturn .= '<li><a href="' . $FileName . '&p=1' . $Params . '" onfocus="this.blur()">1</a></li>';
	}

	$Loop = 0;

	for ($Loop = 1; $Loop <= $PageCount; $Loop++) {
		if (($Loop >= $FirstPage) && ($Loop <= $LastPage)) {
			if ($Loop == $CurrentPage) {
				$sReturn .= '<li><span class="CurrentPage">'.$Loop.'</span></li>';
			} else {
				$sReturn .= '<li><a href="' .  $FileName . '&p=' . $Loop . $Params . '" onfocus="this.blur()">'.$Loop.'</a></li>';
			}
		}
	}

	if ($CurrentPage < ($PageCount - $MidPoint) && $PageCount > $PagesToDisplay - 1) {
		$sReturn .= '<li>...</li><li><a href="' . $FileName . '&p=' . $PageCount . $Params . '" onfocus="this.blur()">'.$PageCount.'</a></li>';
	} else if ($CurrentPage == ($PageCount - $MidPoint) && ($PageCount > $PagesToDisplay)) {
		$sReturn .= '<li><a href="' . $FileName . '&p=' . $PageCount . $Params . '" onfocus="this.blur()">'.$PageCount.'</a></li>';
	}

	if ($CurrentPage != $PageCount) {
		$iTmpPage = $CurrentPage + 1;
		$sReturn .= '<li><a href="' . $FileName . '&p=' . $iTmpPage . $Params . '" class="PageNext" onfocus="this.blur()">'.$NextText.'</a></li>';
	} else {
		$sReturn .= '<li><span class="NoPageNext">'.$NextText.'</span></li>';
	}

	$sReturn .= '</ol></div></div>';
	return $sReturn;
}


// 获得语言名称或文件名
function GetLangs($filename = 0) {
	$Languages = array();
	$LangPath = ROOT . 'language/';

	if(!is_dir($LangPath)) return $Languages;

	$FolderHandle = @opendir($LangPath);
	while (false !== ($Item = readdir($FolderHandle))) {
		if (filesize($LangPath.$Item) && $Item != '.' 	&& $Item != '..' && substr($Item, -4) == '.php') {
			if (substr($Item, 0, 1) != ".") {
				$Languages[] = Iif($filename, $Item, substr($Item, 0, -4));
			}
		}
	}
	@closedir($LangPath);
	return $Languages;
}

// ##
function ShortTitle($string, $length=81){
	if(strlen($string) == 0) 	return '';
	if(strlen($string) <= $length) return $string;

	$string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array('&', '"', '<', '>'), $string);
	$strcut = '';

	$n = $tn = $noc = 0;
	while($n < strlen($string)) {
		$t = ord($string[$n]);
		if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
			$tn = 1; $n++; $noc++;
		} elseif(194 <= $t && $t <= 223) {
			$tn = 2; $n += 2; $noc += 2;
		} elseif(224 <= $t && $t < 239) {
			$tn = 3; $n += 3; $noc += 2;
		} elseif(240 <= $t && $t <= 247) {
			$tn = 4; $n += 4; $noc += 2;
		} elseif(248 <= $t && $t <= 251) {
			$tn = 5; $n += 5; $noc += 2;
		} elseif($t == 252 || $t == 253) {
			$tn = 6; $n += 6; $noc += 2;
		} else {
			$n++;
		}

		if($noc >= $length) break;
	}

	if($noc > $length) $n -= $tn;

	$strcut = substr($string, 0, $n);
	$strcut = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $strcut);

	return $strcut.'...';
}

// ###
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 600) {
	$ckey_length = 4;
	$key = md5($key ? $key : 'default_key');
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}
}

/**
 * 邮件发送函数SendMail
 *
 * @param string $email 接受邮件的email地址
 * @param string $subject 邮件主题(标题)
 * @param string $content 邮件内容(正文)
 * @param boolean $html 邮件内容是否以html格式发送, 默认为true. fasle时以文本格式发送
 * @param boolean $lang 邮件内容中文或英文, 默认为1: 中文; 0: 英文
 * @return boolean OR string 发送成功返回true, 失败返回错误信息
 */
function SendMail($email, $subject, $content, $lang = 1, $html = true) {
	if(!$email OR !$subject OR !$content) return false;

	$mail = new PHPMailer();
	$mail->IsHTML($html); //邮件内容格式

	if(APP::$_CFG['UseSmtp']){ //以SMTP方式发送邮件
		$mail->IsSMTP();
		$mail->Host = APP::$_CFG['SmtpHost'];
		$mail->Port = APP::$_CFG['SmtpPort'];

		$mail->SMTPAuth = true;
		$mail->Username = APP::$_CFG['SmtpUser'];
		$mail->Password = APP::$_CFG['SmtpPassword'];
		$mail->Sender = APP::$_CFG['SmtpEmail'];

	}else{ //使用php mail()函数发送邮件
		$mail->IsMail();
		$mail->Sender = APP::$_CFG['Email'];
	}

	$sitename = APP::$_CFG['Title']; //中英文名称
	$mail->From = APP::$_CFG['Email'];
	$mail->FromName = $sitename;
	$mail->AddReplyTo(APP::$_CFG['Email'], $sitename); //回复地址及姓名

	$mail->AddAddress($email);
	$mail->Subject  = $subject;

	//在邮件内容最后加上网站版权名称及链接
	$mail->Body = $content . '<br><a href="' . BASEURL . ADMINDIR . '/" target="_blank">' . $sitename . '</a><br>' . DisplayDate() . '<br><br>';

	if($mail->Send()){
		return true;
	}else{
		return $mail->ErrorInfo; //发送失败时返回错误信息
	}
}

//创建文件夹
function MakeDir($path) {
	if (!file_exists($path)) {
		mkdir($path, 0777);
		@chmod($path, 0777);
	}
}

//检测是否为合法的上传文件
function IsUploadedFile($file) {
	return function_exists('is_uploaded_file') && (is_uploaded_file($file) || is_uploaded_file(str_replace('\\\\', '\\', $file)));
}

// 获得文件后缀函数  *参数$filename: 文件名或路径
function getFileExt($filename) {
	$temp_arr = explode(".", $filename);
	$file_ext = strtolower(trim(array_pop($temp_arr)));

	if($filename == $file_ext) return ''; //没有后缀返回空字符串

	return $file_ext;
}

// ##
function DisplayDate($timestamp = 0, $dateformat = '', $time = 0){
	if(!$dateformat) $dateformat = APP::$_CFG['DateFormat'] . Iif($time, ' H:i:s');
	return @gmdate($dateformat, Iif($timestamp, $timestamp, time()) + (3600 * ForceInt(APP::$_CFG['Timezone'])));
}

// ##
function Iif($expression, $x, $y = ''){
	return $expression ? $x : $y;
}

// ##
function SafeSql($source){
	$entities_match = array(',',';','$','!','@','#','%','^','&','*','_','(',')','{','}','|',':','"','<','>','?','[',']','\\',"'",'.','/','*','+','~','`','=');
	return str_replace($entities_match, '', trim($source));
}

// ##
function SafeSearchSql($source){
	$entities_match = array('$','!','@','#','%','^','&','*','_','(',')','{','}','|',':','"','<','>','?','[',']','\\',"'",'.','/','*','~','`','=');
	return str_replace($entities_match, '', trim($source));
}

// ##
function IsEmail($email){
	return preg_match("/^[a-z0-9]+[.a-z0-9_-]*@[a-z0-9]+[.a-z0-9_-]*\.[a-z0-9]+$/i", $email);
}

// ##
function IsName($name){
	$entities_match = array(',',';','$','!','@','#','%','^','&','*','(',')','{','}','|',':','"','<','>','?','[',']','\\',"'",'/','*','+','~','`','=');
	for ($i = 0; $i<count($entities_match); $i++) {
	     if(strpos($name, $entities_match[$i])){
               return false;
		 }
	}
   return true;
}

// ##
function IsAlnum($str){
   return preg_match("/^[[:alnum:]]+$/i", $str);
}

// ##
function PassGen($length = 8){
	$str = 'abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	for ($i = 0, $passwd = ''; $i < $length; $i++)
		$passwd .= substr($str, mt_rand(0, strlen($str) - 1), 1);
	return $passwd;
}

// ##
function IsGet($VariableName) {
	return Iif(isset($_GET[$VariableName]), true, false);
}

// ##
function IsPost($VariableName) {
	return Iif(isset($_POST[$VariableName]), true, false);
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
	if(get_magic_quotes_gpc()) $query_string = stripslashes($query_string);

	$query_string = htmlspecialchars(str_replace (array('\0', '　'), '', $query_string), ENT_QUOTES);

	if(APP::$DB->type == "mysqli"){
		if(function_exists('mysqli_real_escape_string')) {
			$query_string = mysqli_real_escape_string(APP::$DB->conn, $query_string);
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

// ##
function html($String) {
	 return str_replace(array('&amp;','&#039;','&quot;','&lt;','&gt;'), array('&','\'','"','<','>'), $String);
}

// ##
function GetIP() {
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'LAN')) {
		$thisip = getenv('HTTP_CLIENT_IP');
	} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'LAN')) {
		$thisip = getenv('HTTP_X_FORWARDED_FOR');
	} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'LAN')) {
		$thisip = getenv('REMOTE_ADDR');
	} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'LAN')) {
		$thisip = $_SERVER['REMOTE_ADDR'];
	}

	preg_match("/[\d\.]{7,15}/", $thisip, $thisips);
	$thisip = $thisips[0] ? $thisips[0] : 'LAN';
	return $thisip;
}

// ##
function header_nocache() {
	header("Expires: Mon, 18 Jul 1988 01:08:08 GMT"); // Date in the past
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // HTTP/1.1
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache"); // HTTP/1.0
}

// ##
function DisplayFilesize($filesize){
	$kb = 1024;         // Kilobyte
	$mb = 1048576;      // Megabyte
	if($filesize < $kb){
		$size = $filesize . ' B';
	}else if($filesize < $mb){
		$size = round($filesize/$kb,2) . ' K';
	}else{
		$size = round($filesize/$mb,2) . ' M';
	}

	return (isset($size) AND $size != '0 B' AND  $size != ' B') ? $size : 0;
}

// ##
function encodeChar($str = ''){
	return str_replace('&', '||4||', $str); //将&转换成特殊字符串||4||
}


//判断是否为https
function is_https()
{
	if ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off')
	{
		return TRUE;
	}
	elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https')
	{
		return TRUE;
	}
	elseif ( ! empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off')
	{
		return TRUE;
	}

	return FALSE;
}

?>