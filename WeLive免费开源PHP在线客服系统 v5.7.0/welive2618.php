<?php  

define('ROOT', dirname(__FILE__).'/');  //系统程序根路径, 必须定义, 用于防翻墙
require(ROOT . 'includes/core.guest.php');  //加载核心文件

if(!$_CFG['Actived']) shut_down($langs['shutdown']);

//正式开始
$a = intval($_GET['a']);
if($a !== 621256861) die('Access denied.'); //简单地防止直接访问当前文件(并不重要)


$gid = intval($_GET['gid']); //访客ID, 解决跨域问题
$fn = str_replace(array('"', "'"), "", trim($_GET['fn'])); //去掉引号, 避免JS运行出错

$fromurl = base64_decode(trim($_GET['url']));
$json = new JSON; //将语言转换成js对象

$smilies = ''; //表情图标
for($i = 0; $i < 24; $i++){
	$smilies .= '<img src="' . SYSDIR . 'public/smilies/' . $i . '.png" onclick="insertSmilie(' . $i . ');">';
}

$agent = encodeChar(get_userAgent($_SERVER['HTTP_USER_AGENT']));

$key = PassGen(8);
$code = authcode(md5(WEBSITE_KEY . $_CFG['KillRobotCode']), 'ENCODE', $key, 3600*8); //8小时过期(8小时后断线重连将失败)
$code = encodeChar($code); //先将&转换成特殊字符串||4||

header_nocache(); //不缓存
header('P3P: CP=CAO PSA OUR'); //解决IE下iframe cookie问题

//界面配色方案
$color_style = intval($_CFG['ColorStyle']);
$color_style = Iif($color_style, $color_style, 1);

//不活动自动离线时间
$auto_offline  = intval($_CFG['AutoOffline']); //自动离线时间(分)
$auto_offline  = Iif($auto_offline, $auto_offline, 8) * 60000; //自动离线时间(毫秒)

//输入状态更新时间
$update_time  = intval($_CFG['Update']); //状态更新时间(秒)
$update_time  = Iif($update_time, $update_time, 2) * 1017; //状态更新时间(毫秒), 设置一个怪异的数字避免与自动离线的时间间隔重合, 避免在同一时间点上send数据上可能产生 -----幽灵bug


echo '<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="public/guest.css?v=' . APP_VERSION . '">
<script type="text/javascript" src="public/jquery126.js"></script>
<script type="text/javascript" src="public/jquery.scrollbar.js" ></script>
<script type="text/javascript">
SYSDIR = "' . SYSDIR . '",
COLOR_STYLE = "' . $color_style . '",
COOKIE_USER = "' . COOKIE_USER . '",
SYSKEY = "' . $key . '",
SYSCODE = "' . $code . '",
WS_HEAD = "' . WS_HEAD . '",
WS_HOST = "' . WS_HOST . '",
WS_PORT = "' . WS_PORT . '",
welive_domain = "' . trim($_GET['d']) . '",
update_time = ' . $update_time . ',
offline_time = ' . $auto_offline . ',
auth_upload = ' . $_CFG['AuthUpload'] . ',
guest = {gid: ' . $gid . ', fn: "' . $fn . '", aid: 0, au: 0, an: "", sess: "", lang: ' . IS_CHINESE . ', agent: "' . $agent . '", ip: "' . GetIP() . '", fromurl: "' . $fromurl . '"},
welcome = "' . encodeChar(Iif(IS_CHINESE, $_CFG['Welcome'], $_CFG['Welcome_en'])) . '",
comment_note = "' . encodeChar(Iif(IS_CHINESE, $_CFG['Comment_note'], $_CFG['Comment_note_en'])) . '",
langs = ' . $json->encode($langs) . ';
</script>
</head>
<body>
<div id="welive_operator">
	<img src="' . SYSDIR . 'public/img/welive.png" id="welive_avatar" style="padding:2px;">
	<div id="welive_name">' . $langs['welive'] . '</div>
	<div id="welive_duty" class="welive_color2_' . $color_style . '">Connecting ...</div>
	<div id="welive_copyright" class=""><a href="http://www.yunziyuan.com.cn" target="_blank">&copy; WeLive</a></div>
</div>
<div class="history">
	<div class="scb_scrollbar scb_radius"><div class="scb_tracker"><div class="scb_mover scb_radius"></div></div></div>
	<div class="viewport loading3">
		<div class="overview">
			<div class="msg s">
				<div class="b">
					<div class="i">' . $langs['connecting'] . '</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="enter">
	<div class="tool_bar">
		<div id="toolbar_emotion" title="' . $langs['emotions'] . '" class="tool_bar_i"></div>
		<div id="toolbar_photo" title="' . $langs['sendphoto'] . '" class="tool_bar_i"></div>
		<div id="toolbar_file" title="' . $langs['sendfile'] . '" class="tool_bar_i"></div>
		<div id="toolbar_sound" title="' . $langs['sound'] . '" class="tool_bar_i"></div>
		<div id="toolbar_evaluate" title="' . $langs['evaluate'] . '" class="tool_bar_i"></div>
		<div class="tool_bar_call">
			<input type="text" id="phone_num" maxlength="26" placeholder="' . $langs['type_phone'] . '" class="welive_border_' . $color_style . '">
			<div id="phone_call_back" class="tool_bar_phone welive_color_' . $color_style . '" title="' . $langs['require_callback'] . '"><s class="tool_bar_i"></s></div>
		</div>
	</div>
	<div id="alert_info"></div>
	<textarea name="msger" placeholder="' . $langs['type_question'] . '" class="msger"></textarea>
	<input type="file" name="file" id="upload_img" accept="image/jpg,image/jpeg,image/gif,image/png" style="width:1px;height:1px;display:none;overflow:hidden;">
	<a id="sender_msg" class="sender welive_color_' . $color_style . '">' . $langs['send'] . '</a>
</div>
<div id="wl_sounder" style="width:1px;height:1px;visibility:hidden;overflow:hidden;"></div>
<div class="smilies_div" style="display:none"><div class="smilies_wrap">' . $smilies . '</div></div>
<div id="starRating" style="display:none">
	<p class="title">' . $langs['rating_title'] . '</p>
    <p class="star">
        <span star_val="1"><i class="high"></i><i class="nohigh"></i></span>
        <span star_val="2"><i class="high"></i><i class="nohigh"></i></span>
        <span star_val="3"><i class="high"></i><i class="nohigh"></i></span>
        <span star_val="4"><i class="high"></i><i class="nohigh"></i></span>
        <span star_val="5" class="last"><i class="high"></i><i class="nohigh"></i></span>
    </p>
    <p class="starInfo">' . $langs['select_star'] . '</p>
	<p><textarea placeholder="' . $langs['rating_advise'] . '" id="rating_advise"></textarea></p>
	<p><a id="sender_eval" class="sender welive_color_' . $color_style . '" onclick="send_evaluate();return false;">' . $langs['submit'] . '</a></p>
</div>
<script type="text/javascript" src="public/guest_free.js?v=' . APP_VERSION . '"></script>
</body>
</html>';


function shut_down($info){
	echo '<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="background:#fff url(public/img/w_ibg.png);margin:0;padding:0;">
	<div style="font-size:14px;color:red;text-align:center;border:1px solid #b7b7b7;margin:0;padding:0;height:400px;padding-top:100px;">
	' . $info . '
	</div>
</body>
</html>';

	die();
}


?>