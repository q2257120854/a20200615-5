<?php if(!defined('ROOT')) die('Access denied.');

class c_settings extends Admin{

	public function __construct($path){
		parent::__construct($path);

		SubMenu('系统设置', array(
			array('基本设置', 'settings', Iif($path[1] == 'index',1,0)),
			array('邮件设置', 'settings/mail', Iif($path[1] == 'mail',1,0))
		));

		$this->CheckAction();
	}

    public function save(){
		$action = ForceStringFrom('action');
		$filename = ROOT . "config/settings.php";
		$welive_js = ROOT . "welive.js";

		if(!is_writeable($filename)) $errors[] = '请将系统配置文件config/settings.php设置为可写, 即属性设置为: 777';
		if(!is_writeable($welive_js)) $errors[] = '请将根目录下的welive.js文件设置为可写, 即属性设置为: 777';

		if(isset($errors)) Error($errors, '系统设置错误');

		//解决PHP7 Opcache开启时无法实时更新设置的问题
		if(function_exists('opcache_reset')) {
			@opcache_reset();
		}

		$settings    = $_POST['settings'];

		$fp = @fopen($filename, 'rb');
		$contents = @fread($fp, filesize($filename));
		@fclose($fp);
		$contents = $oldcontents = trim($contents);

		$fp = @fopen($welive_js, 'rb');
		$welive_js_contents = @fread($fp, filesize($welive_js));
		@fclose($fp);
		$welive_js_contents = $welive_js_contents_old = trim($welive_js_contents);


		foreach($settings as $key => $value){
			$value = $this->Clear_string_for_js($value); //去掉换行符, 兼容JS变量调用
			$value = str_replace('"', "'", $value); //将引双引号替换成单引号

			if(APP::$_CFG[$key] != $value){
				//$value = ForceString($value);

				//对有关设置项的值进行限制处理等
				switch($key){
					case 'BaseUrl':

						if(substr($value, -1) != '/') $value .= '/';

						$value = strtolower($value);

						if(!preg_match('/^http(s)?:\\/\\/.+/i', $value)){
							$value = Iif(is_https(), "https://", "http://") .  $value;
						}

						break;

					case 'KillRobotCode':

						if(trim($value) == "") $value =  APP::$_CFG[$key];

						break;

					case 'Update':
						$value = ForceInt($value);
						if($value < 1) $value = 1;
						if($value > 20) $value = 20;
						break;

					case 'UploadLimit':
						$value = ForceInt($value);
						if($value < 2) $value = 2;
						if($value > 20) $value = 20;
						break;

					case 'AutoOffline':
						$value = ForceInt($value);
						if($value < 4) $value = 4;
						if($value > 30) $value = 30;
						break;
					case 'SocketPort':
						$value = ForceInt($value);
						if($value < 100) $value = 100;
						if($value > 65535) $value = 65535;
						break;

					case 'Lang': //设置语言

						$welive_js_contents = preg_replace("/var\s*welive_lang\s*\=\s*[\"'].*?[\"'];/is", "var welive_lang = \"$value\";", $welive_js_contents);

						break;

					case 'Actived': //是否对外服务

						$welive_js_contents = preg_replace("/var\s*welive_actived\s*\=\s*.*?;/is", "var welive_actived = {$value};", $welive_js_contents);

						break;

					case 'ColorStyle': //访客对话窗口颜色风格, 修改welive.js文件

						$welive_js_contents = preg_replace("/var\s*welive_color_style\s*\=\s*.*?;/is", "var welive_color_style = {$value};", $welive_js_contents);

						break;

					case 'AutoOpen': //访客对话窗口自动展开时间  秒

						$value = ForceInt($value);
						if($value < 1) $value = 0;
						if($value > 1200) $value = 1200; //最大20分钟展开

						$welive_js_contents = preg_replace("/var\s*welive_auto\s*\=\s*.*?;/is", "var welive_auto = {$value};", $welive_js_contents);

						break;

				}

				$code = ForceString($key);
				$contents = preg_replace("/[$]_CFG\['$code'\]\s*\=\s*[\"'].*?[\"'];/is", "\$_CFG['$code'] = \"$value\";", $contents);
			}
		}

		if($contents != $oldcontents){
			$fp = @fopen($filename, 'w');
			@fwrite($fp, $contents);
			@fclose($fp);
		}

		if($welive_js_contents != $welive_js_contents_old){
			$fp = @fopen($welive_js, 'w');
			@fwrite($fp, $welive_js_contents);
			@fclose($fp);
		}

		Success('settings'. Iif($action, '/'.$action));
	}

    public function index(){

		echo '<form method="post" action="'.BURL('settings/save').'">';

		TableHeader('基本设置');

		TableRow(array('<B>客服系统URL</B><BR><font class=grey>WeLive在线客服系统安装后的完整URL, 用于找回密码、邮件发送等. 请以 <span class=note>/</span> 结束.', '<input type="text" style="width:292px;" name="settings[BaseUrl]" value="' . BASEURL . '">'));

		$Radio = new Radio;
		$Radio->Name = 'settings[Actived]';
		$Radio->SelectedID = APP::$_CFG['Actived'];
		$Radio->AddOption(1, '开启', '<i class="w20"></i>');
		$Radio->AddOption(0, '关闭', '&nbsp;&nbsp;');
		TableRow(array('<B>系统工作状态</B><BR><font class=grey>WeLive在线客服系统工作状态, 设置为 <span class=note>关闭</span> 时, 将不对外提供任何服务, 包括留言.</font>', $Radio->Get()));

		$Radio ->Clear();
		$Radio->Name = 'settings[ColorStyle]';
		$Radio->SelectedID = APP::$_CFG['ColorStyle'];
		$Radio->AddOption(1, '<a class="welive_style welive_style1">1</a>', '<i class="w20"></i>');
		$Radio->AddOption(2, '<a class="welive_style welive_style2">2</a>', '<i class="w20"></i>');
		$Radio->AddOption(3, '<a class="welive_style welive_style3">3</a>', '<i class="w20"></i>');
		$Radio->AddOption(4, '<a class="welive_style welive_style4">4</a>', '<i class="w20"></i>');
		$Radio->AddOption(5, '<a class="welive_style welive_style5">5</a>', '<i class="w20"></i>');
		TableRow(array('<B>访客窗口颜色风格</B><BR><font class=grey>WeLive在线客服系统前台访客对话窗口的颜色风格, 此项设置仅对在当前页面打开的客服窗口有效.</font>', $Radio->Get()));

		$Radio ->Clear();
		$Radio->Name = 'settings[Record]';
		$Radio->SelectedID = APP::$_CFG['Record'];
		$Radio->AddOption(10, '10条', '<i class="w20"></i>');
		$Radio->AddOption(20, '20条', '<i class="w20"></i>');
		$Radio->AddOption(30, '30条', '<i class="w20"></i>');
		$Radio->AddOption(40, '40条', '<i class="w20"></i>');
		$Radio->AddOption(60, '60条', '<i class="w20"></i>');
		TableRow(array('<B>显示对话记录数</B><BR><font class=grey>访客再次进入客服后, 系统自动显示多少条对话历史记录. 此项设置依赖上一项设置.', $Radio->Get()));

		$Langs = GetLangs();
		$Radio ->Clear();
		$Radio->Name = 'settings[Lang]';
		$Radio->SelectedID = APP::$_CFG['Lang'];
		$Radio->AddOption('Auto', '自动', '<i class="w20"></i>');
		foreach($Langs as $lang){
			$lang_name = Iif($lang == 'Chinese', '中文', $lang);
			$Radio->AddOption($lang, $lang_name, '<i class="w20"></i>');
		}
		TableRow(array('<B>访客窗口默认语言</B><BR><font class=grey>当选择 <span class=note>自动</span> 时, 访客对话窗口将根据其浏览器语言自动选择语言, 非中文浏览器将显示英文信息提示.</font>', $Radio->Get()));

		$Radio ->Clear();
		$Radio->Name = 'settings[AuthUpload]';
		$Radio->SelectedID = APP::$_CFG['AuthUpload'];
		$Radio->AddOption(1, '需要授权', '<i class="w20"></i>');
		$Radio->AddOption(0, '不需要', '&nbsp;&nbsp;');
		TableRow(array('<B>访客上传授权</B><BR><font class=grey>访客进入WeLive客服系统后, 是否需要经过客服人员授权后才能上传图片文件等. <br><span class=note>如果设置为“不需要”, 即访客可自由上传, 将可能导致大量垃圾文件上传到服务器</span>.</font>', $Radio->Get()));

		TableRow(array('<B>允许上传的文件大小(M)</B><BR><font class=grey>允许上传的文件大小(限20M), 此项设置仅对上传普通文件有效(图片限4M).</font>', '<input type="text" style="width:80px;" name="settings[UploadLimit]" value="' . APP::$_CFG['UploadLimit'] . '"> (M)'));

		TableRow(array('<B>Socket服务端口号</B><BR><font class=grey>WeLive将建立Socket服务进行通讯, 此服务占用服务器的哪个端口号, <span class=note>此项设置仅在Socket服务重启后生效</span>.<BR>Web服务器开放的端口号一般为: 1 ~ 65535, 其中1000以下为众所周知的端口号, 建议设置成1000以上.<BR>如果您对此项设置不太了解, 建议咨询您的服务器提供商.</font>', '<input type="text" style="width:80px;" name="settings[SocketPort]" value="' . APP::$_CFG['SocketPort'] . '">'));

		TableRow(array('<B>访客窗口自动展开时间(秒)</B><BR><font class=grey>当用户在浏览器中打开调用WeLive在线客服的网页后, 访客对话窗口自动展开的时间. <span class=note>设置为0表示不自动展开</span>.</font>', '<input type="text" style="width:80px;" name="settings[AutoOpen]" value="' . APP::$_CFG['AutoOpen'] . '"> (秒)'));

		$Select = new Select;
		$Select->Name = 'settings[Update]';
		$Select->SelectedValue = APP::$_CFG['Update'];
		for($i = 1; $i <= 20; $i++){
			$Select->AddOption($i, "$i 秒");
		}
		TableRow(array('<B>输入状态更新时间</B><BR><font class=grey>'.APP_NAME.'对话时客服可以看到访客的输入状态, 更新这个状态信息的时间.<BR>注意: 设置的时间越短，服务器承载的压力越大. 如果您的服务器较慢, 建议设置为较大值.</font>', $Select->Get()));

		$Select->Clear();
		$Select->Name = 'settings[AutoOffline]';
		$Select->SelectedValue = APP::$_CFG['AutoOffline'];
		for($i = 4; $i <= 30; $i += 2){
			$Select->AddOption($i, "$i 分钟");
		}
		TableRow(array('<B>自动离线时间</B><BR><font class=grey>访客保持沉默的状态(不发言)多少分钟后, 系统会自动将其设置成离线, 并断开其与服务器的Socket连接.<BR>此项设置有利于减少服务器资源的浪费, 保持其承载能力.</font>', $Select->Get()));

		TableRow(array('<B>防机器人代码</B><BR><font class=grey>此码用于防止搜索机器人等进入客服、破解后台管理密码等. 可更换, 但不能设置为空.</font>', '<input type="text" style="width:150px;" name="settings[KillRobotCode]" value="' . APP::$_CFG['KillRobotCode'] . '">'));

		$Select->Clear();
		$Select->Name = 'settings[Timezone]';
		$Select->SelectedValue = APP::$_CFG['Timezone'];
		$Select->AddOption('-12', '(GMT -12) Eniwetok,Kwajalein');
		$Select->AddOption('-11', '(GMT -11) Midway Island,Samoa');
		$Select->AddOption('-10', '(GMT -10) Hawaii');
		$Select->AddOption('-9', '(GMT -9) Alaska');
		$Select->AddOption('-8', '(GMT -8) Pacific Time(US & Canada)');
		$Select->AddOption('-7', '(GMT -7) Mountain Time(US & Canada)');
		$Select->AddOption('-6', '(GMT -6) Mexico City');
		$Select->AddOption('-5', '(GMT -5) Bogota,Lima');
		$Select->AddOption('-4', '(GMT -4) Caracas,La Paz');
		$Select->AddOption('-3', '(GMT -3) Brazil,Buenos Aires,Georgetown');
		$Select->AddOption('-2', '(GMT -2) Mid-Atlantic');
		$Select->AddOption('-1', '(GMT -1) Azores,CapeVerde Islands');
		$Select->AddOption('', '(GMT) London,Lisbon,Casablanca');
		$Select->AddOption('+1', '(GMT +1) Paris,Brussels,Copenhagen');
		$Select->AddOption('+2', '(GMT +2) Kaliningrad,South Africa');
		$Select->AddOption('+3', '(GMT +3) Moscow,Baghdad,Petersburg');
		$Select->AddOption('+4', '(GMT +4) Abu Dhabi,Muscat,Baku,Tbilisi');
		$Select->AddOption('+5', '(GMT +5) Karachi,Islamabad,Tashkent');
		$Select->AddOption('+6', '(GMT +6) Almaty,Dhaka,Colombo');
		$Select->AddOption('+7', '(GMT +7) Bangkok,Hanoi,Jakarta');
		$Select->AddOption('+8', '(GMT +8) 北京, 香港, 新加坡');
		$Select->AddOption('+9', '(GMT +9) Tokyo,Osaka,Yakutsk');
		$Select->AddOption('+10', '(GMT +10) Australia,Guam,Vladivostok');
		$Select->AddOption('+11', '(GMT +11) Magadan,Solomon Islands');
		$Select->AddOption('+12', '(GMT +12) Auckland,Wellington,Fiji');
		TableRow(array('<B>系统默认时区</B><BR><font class=grey>'.APP_NAME.'在线客服系统将此项设置的时区显示日期和时间.</font>', $Select->Get()));

		$Select->Clear();
		$Select->Name = 'settings[DateFormat]';
		$Select->SelectedValue = APP::$_CFG['DateFormat'];
		$Select->AddOption('Y-m-d', "2010-08-12");
		$Select->AddOption('Y-n-j', "2010-8-12");
		$Select->AddOption('Y/m/d', "2010/08/12");
		$Select->AddOption('Y/n/j', "2010/8/12");
		$Select->AddOption('Y年n月j日', "2010年8月12日");
		$Select->AddOption('m-d-Y', "08-12-2010");
		$Select->AddOption('m/d/Y', "08/12/2010");
		$Select->AddOption('M j, Y', "Aug 12, 2010");
		TableRow(array('<B>日期格式</B><BR><font class=grey>系统显示日期的格式.</font>', $Select->Get()));

		TableRow(array('<B>系统页面标题</B><BR><font class=grey>'.APP_NAME.'在线客服系统后台管理或客服操作页面显示的标题.</font>', '<input type="text" style="width:292px;" name="settings[Title]" value="' . APP::$_CFG['Title'] . '">'));

		TableRow(array('<B>欢迎信息(<span class=blue>中文</span>)</B><BR><font class=grey>访客(中文浏览器)进入客服后，首次显示的问候语.</font>', '<textarea style="width:500px;height:80px;border-color:blue;" name="settings[Welcome]">' . APP::$_CFG['Welcome'] . '</textarea>'));

		TableRow(array('<B>欢迎信息(<span class=red>English</span>)</B><BR><font class=grey>访客(非中文浏览器)进入客服后，首次显示的问候语.</font>', '<textarea style="width:500px;height:80px;" name="settings[Welcome_en]">' . APP::$_CFG['Welcome_en'] . '</textarea>'));


		TableRow(array('<B>留言提示信息(<span class=blue>中文</span>)</B><BR><font class=grey>客服离线时, 显示在留言板上的提示信息.</font>', '<textarea style="width:500px;height:80px;border-color:blue;" name="settings[Comment_note]">' . APP::$_CFG['Comment_note'] . '</textarea>'));

		TableRow(array('<B>留言提示信息(<span class=red>English</span>)</B><BR><font class=grey>客服离线时, 显示在留言板上的英文提示信息.</font>', '<textarea style="width:500px;height:80px;" name="settings[Comment_note_en]">' . APP::$_CFG['Comment_note_en'] . '</textarea>'));
		
		
		TableFooter();

		//访客面板风格选中样式
		echo '<script type="text/javascript">
			$(function(){
				var style_num = $("input[name=\'settings[ColorStyle]\'][checked]").val() - 1;
				$("label[for=\'Radio_settings[ColorStyle]"+ style_num + "\']").children("a").addClass("welive_style_checked");
			});
		</script>';


		PrintSubmit('保存设置', '取消');
	} 

    public function mail(){

		echo '<form method="post" action="'.BURL('settings/save').'">
		<input type="hidden" name="action" value="mail">';

		TableHeader('邮件设置');

		TableRow(array('<B>系统Email地址</B><BR><font class=grey>发送邮件时显示在邮件的回复地址中.<BR>如果没有此项设置, 某些接受邮件的服务器可能会把系统发送的邮件当成垃圾邮件.</font>', '<input type="text" style="width:292px;" name="settings[Email]" value="' . APP::$_CFG['Email'] . '">'));

		TableRow(array('<B>邮件发送方式</B><BR><font class=grey>如果WeLive所在服务器是Windows系统, 则必须选择SMTP方式才能发送邮件(<span class=note>要求服务器php环境支持Sockets</span>).<BR>UNIX或linux服务器则推荐使用PHP Mail函数发送邮件.</font>', '<input type="radio" id="m1" name="settings[UseSmtp]" value="0" '.Iif(!APP::$_CFG['UseSmtp'], ' checked="checked"').'><label for="m1">PHP Mail</label><i class="w20"></i><input type="radio" id="m2" name="settings[UseSmtp]" value="1" '.Iif(APP::$_CFG['UseSmtp'], ' checked="checked"').'><label for="m2">SMTP</label>'));

		TableRow(array('<B>-- SMTP服务器地址</B><BR><font class=grey>如: mailer.weensoft.cn 或SMTP邮件服务器IP地址.</font>', '<input type="text" style="width:292px;" name="settings[SmtpHost]" value="' . APP::$_CFG['SmtpHost'] . '">'));
		TableRow(array('<B>-- SMTP服务器端口</B><BR><font class=grey>SMTP邮件服务器的端口号, 一般为25.</font>', '<input type="text" style="width:292px;" name="settings[SmtpPort]" value="' . APP::$_CFG['SmtpPort'] . '">'));
		TableRow(array('<B>-- SMTP服务器邮箱</B><BR><font class=grey>使用当前SMTP邮件服务器时您的Email地址, 此Email地址仅用于发送邮件, 不用于接收Email.</font>', '<input type="text" style="width:292px;" name="settings[SmtpEmail]" value="' . APP::$_CFG['SmtpEmail'] . '">'));
		TableRow(array('<B>-- SMTP服务器邮箱用户名</B><BR><font class=grey>登录SMTP服务器邮箱的用户名. 注: 有的SMTP服务器需求填写为用户名对应的邮箱地址.</font>', '<input type="text" style="width:292px;" name="settings[SmtpUser]" value="' . APP::$_CFG['SmtpUser'] . '">'));
		TableRow(array('<B>-- SMTP服务器用户密码</B><BR><font class=grey>登录SMTP服务器邮箱的用户密码.</font>', '<input type="password" style="width:292px;" name="settings[SmtpPassword]" value="' . APP::$_CFG['SmtpPassword'] . '">'));

		TableFooter();

		PrintSubmit('保存设置');
	} 


	//去掉空白及换行函数
	private function Clear_string_for_js($str) 
	{ 
		$str = str_replace(PHP_EOL, '', $str); //去掉换行符, 兼容JS变量调用
		$str = preg_replace("/\t/", '', $str); //使用正则表达式替换内容，如：换行
		$str = preg_replace("/\r\n/", '', $str); 
		$str = preg_replace("/\r/", '', $str); 
		$str = preg_replace("/\n/", '', $str); 
		return trim($str); //返回字符串
	}

} 

?>