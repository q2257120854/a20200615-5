<?php if(!defined('ROOT')) die('Access denied.');

class Admin extends Auth{
	protected $ajax = array(); //用于ajax数据收集与输出
	public $json; //ajax时的JSON对象

	public function __construct($path = ''){
		parent::__construct($path);

		if($path[1] == 'ajax') { //任意控制器的动作为ajax时, 执行ajax动作, 禁止输出页头, 页尾及数据库访问错误
			APP::$DB->printerror = false; //ajax数据库访问不打印错误信息
			$this->ajax['s'] = 1; //初始化ajax返回数据, s表示状态
			$this->ajax['i'] = ''; //i指ajax提示信息
			$this->ajax['d'] = ''; //d指ajax返回的数据
			$this->json = new JSON;

			if(!$this->admin){//管理员验证不成功, 直接输出ajax信息, 并终止ajax其它程序程序运行
				$this->ajax['s'] = 0;
				$this->ajax['i'] = "管理员授权错误! 请确认已成功登录后台.";
				die($this->json->encode($this->ajax));
			}
		}else{
			if($path[1] == 'logout') $this->logout(); //无论哪个控制器, 只要是logout动作, admin用户退出

			if($path[0] == 'online'){
				$this->s_page_header($path); //授权成功, 客服输出页头
			}else{
				$this->page_header($path); //授权成功, 管理员输出页头
			}
		}
	}


	/**
	 * gest_menu 顶部菜单
	 */
	protected function get_menu($isAdmin = 0,  $blank = 0) {

		if($blank) {
			$blank = ' target="_blank"';
		}else{
			$blank = '';
		}

		$admin_menu = '<dl class="first"></dl>
			<dl class="home">
				<dt><a href="./"' . $blank . '>首页</a></dt>
				<dd>
					<div>
						<li class="first"><a href="./"' . $blank . '>首页</a></li>
						<li class="last"></li>
					</div>
				</dd>
			</dl>
			<dl>
				<dt><a href="' . BURL('guests') . '"' . $blank . '>用户</a></dt>
				<dd>
					<div>
						<li class="first"><a href="' . BURL('guests') . '"' . $blank . '>客人管理</a></li>
						<li><a href="' . BURL('users/add') . '"' . $blank . '>添加客服</a></li>
						<li><a href="' . BURL('users') . '"' . $blank . '>客服管理</a></li>
						<li class="last"><a href="' . BURL('avatar') . '"' . $blank . '>上传我的头像</a></li>
					</div>
				</dd>
			</dl>
			<dl>
				<dt><a href="' . BURL('comments') . '"' . $blank . '>留言</a></dt>
				<dd>
					<div>
						<li class="first"><a href="' . BURL('comments') . '"' . $blank . '>留言管理</a></li>
						<li class="last"></li>
					</div>
				</dd>
			</dl>
			<dl>
				<dt><a href="' . BURL('messages') . '"' . $blank . '>记录</a></dt>
				<dd>
					<div>
						<li class="first"><a href="' . BURL('messages') . '"' . $blank . '>对话记录管理</a></li>
						<li><a href="' . BURL('rating') . '"' . $blank . '>访客评价管理</a></li>
						<li><a href="' . BURL('upload_img') . '"' . $blank . '>上传图片清理</a></li>
						<li class="last"><a href="' . BURL('upload_file') . '"' . $blank . '>上传文件清理</a></li>
					</div>
				</dd>
			</dl>
			<dl>
				<dt><a href="' . BURL('robot') . '"' . $blank . '>智能</a></dt>
				<dd>
					<div>
						<li class="first"><a href="' . BURL('robot') . '"' . $blank . '>机器人客服管理</a></li>
						<li><a href="' . BURL('phrases/add') . '"' . $blank . '>添加常用短语</a></li>
						<li class="last"><a href="' . BURL('phrases') . '"' . $blank . '>常用短语管理</a></li>
					</div>
				</dd>
			</dl>
			<dl>
				<dt><a href="' . BURL('settings') . '"' . $blank . '>系统</a></dt>
				<dd>
					<div>
						<li class="first"><a href="' . BURL('settings') . '"' . $blank . '>系统设置</a></li>
						<li><a href="' . BURL('language') . '"' . $blank . '>语言管理</a></li>
						<li><a href="' . BURL('database') . '"' . $blank . '>数据维护</a></li>
						<li><a href="' . BURL('phpinfo') . '"' . $blank . '>环境信息</a></li>
						<li class="last"><a href="' . BURL('upgrade') . '"' . $blank . '>系统升级</a></li>
					</div>
				</dd>
			</dl>
			<dl class="last"></dl>';

		$support_menu = '<dl class="first"></dl>
			<dl>
				<dt><a href="' . BURL('mymessages') . '"' . $blank . '>记录</a></dt>
				<dd>
					<div>
						<li class="first last"><a href="' . BURL('mymessages') . '"' . $blank . '>对话记录管理</a></li>
					</div>
				</dd>
			</dl>
			<dl>
				<dt><a href="' . BURL('myphrases') . '"' . $blank . '>短语</a></dt>
				<dd>
					<div>
						<li class="first"><a href="' . BURL('myphrases/add') . '"' . $blank . '>添加常用短语</a></li>
						<li class="last"><a href="' . BURL('myphrases') . '"' . $blank . '>常用短语管理</a></li>
					</div>
				</dd>
			</dl>
			<dl>
				<dt><a href="' . BURL('myprofile') . '"' . $blank . '>我的</a></dt>
				<dd>
					<div>
						<li class="first"><a href="' . BURL('myprofile') . '"' . $blank . '>编辑我的资料</a></li>
						<li class="last"><a href="' . BURL('avatar') . '"' . $blank . '>上传头像</a></li>
					</div>
				</dd>
			</dl>
			<dl class="last"></dl>';

		if($isAdmin){
			return $admin_menu;
		}else{
			return $support_menu;
		}
	}


	/**
	 * 输出页头 page_header
	 */
	protected function page_header($path = '') {

		$isAdmin = $this->CheckAccess();

		if($path[0] == 'index' AND !$isAdmin) Redirect('online'); //客服人员进入首页时跳转到客服操作页面

		echo '<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>'.APP::$_CFG['Title'].' - 后台管理</title>
<link rel="shortcut icon" href="' . SYSDIR . 'public/img/favicon.ico" type="image/x-icon"> 
<link rel="stylesheet" type="text/css" href="'. SYSDIR .'public/admin.css">
<link rel="stylesheet" type="text/css" href="'. SYSDIR .'public/easyDialog/easyDialog.css">
<link rel="stylesheet" type="text/css" href="'. SYSDIR .'public/jquery.tipTip.css">
<script src="'. SYSDIR .'public/jquery191.js" type="text/javascript"></script>
<script src="'. SYSDIR .'public/jquery.tipTip.js" type="text/javascript"></script>
<script src="'. SYSDIR .'public/admin.js" type="text/javascript"></script>
<script type="text/javascript">
var this_uri = "' . strstr($_SERVER['REQUEST_URI'], 'index.php') . '";
var baseurl = "' . BASEURL . '";
</script>
</head>
<body>
<script src="'. SYSDIR .'public/easyDialog/easyDialog.js" type="text/javascript"></script>
' . Iif($isAdmin, $this->header_menu($path), $this->s_header_menu($path)) . '
<div class="maindiv">
	<div id="main">';
	}

	/**
	 * 输出客服操作页面页头 s_page_header
	 */
	protected function s_page_header($path = '') {
		header_nocache(); //不缓存

		echo '<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>客服在线 - ' . APP::$_CFG['Title'] . '</title>
<link rel="shortcut icon" href="' . SYSDIR . 'public/img/favicon.ico" type="image/x-icon"> 
<link rel="stylesheet" type="text/css" href="'. SYSDIR .'public/admin.css?v=' . APP_VERSION . '">
<link rel="stylesheet" type="text/css" href="'. SYSDIR .'public/easyDialog/easyDialog.css">
<link rel="stylesheet" type="text/css" href="'. SYSDIR .'public/jquery.tipTip.css">
<script src="'. SYSDIR .'public/jquery191.js" type="text/javascript"></script>
<script src="'. SYSDIR .'public/jquery.tipTip.js" type="text/javascript"></script>
<script src="'. SYSDIR .'public/jquery.scrollbar.js" type="text/javascript"></script>
<script type="text/javascript">
var BASEURL = "' . BASEURL . '",
SYSDIR = "' . SYSDIR . '",
WS_HEAD = "' . WS_HEAD . '",
WS_HOST = "' . WS_HOST . '",
WS_PORT = "' . WS_PORT . '",
auth_upload = ' .  ForceInt(APP::$_CFG['AuthUpload']) . ',
admin ={id: ' . $this->admin['aid'] . ', type: ' . $this->admin['type'] . ', sid: "' . $this->admin['sid'] . '", fullname: "' . $this->admin['fullname'] . '", post: "' . $this->admin['post'] . '", agent: "' . $this->admin['agent'] . '"};
</script>
<script src="'. SYSDIR .'public/support_free.js?v=' . APP_VERSION . '" type="text/javascript"></script>
</head>
<body class="online">
<script src="'. SYSDIR .'public/easyDialog/easyDialog.js" type="text/javascript"></script>
' . $this->s_header_menu($path, 1) . '
<div class="maindiv">
<div id="main">';
	}


	//管理员顶部导航菜单内容
	protected function header_menu($path = '') {

		$info_total = 0;

		//如果不是后台首页, 获取cookie统计数据
		if($path[0] != 'index') $info_total = ForceInt(ForceCookieFrom(COOKIE_KEY . 'backinfos'));
 
		return '<div id="header">
	<div class="logo"><a href="./"><img src="'. SYSDIR .'public/img/logo.gif" title="后台首页"></a></div>
	<div id="ajax-loader"></div>
	<div id="topbar">
		<div id="topmenu">' . $this->get_menu(1) . '</div>

		<div id="topuser">
			' . Iif($this->admin['online'] != 1, '<div class="open"><a href="' . BURL('online') . '" target="_blank" class="link-btn2">进入客服</a></div>') . '
			<dl class="first"></dl>
			<dl class="' . Iif($info_total, 'info', 'info none') . '" id="info_all"><!-- 如果没有信息 class=info none -->
				<dt><a href="' . BURL() . '" title="点击更新提示信息"><i></i><span id="info_total">' . $info_total .  '</span></a></dt>
				<dd>
					<div>
						<li class="first"><a href="' . BURL('comments') . '"><font id="info_comms" class="' . Iif($info_total, 'orangeb', 'light') . '">' . $info_total . '</font> 条未读留言</a></li>
						<li class="last"></li>
					</div>
				</dd>
			</dl>
			<dl class="admin">
				<dt><a href="#" class="logout"><i></i></a></dt>
				<dd>
					<div>
						<li class="first"><a href="' . BURL('index/logout') . '"><img src="' . GetAvatar($this->admin['aid']) . '" class="avatar" style="margin-bottom:6px;"><BR><font class=orange>'.$this->admin['fullname'].'</font> 退出?</a></li>
						<li><a href="' . BURL('users/edit?aid=' . $this->admin['aid']) . '">修改我的资料</a></li>
						<li><a href="' . BURL('avatar') . '">上传我的头像</a></li>
						<li class="last"><a href="../" target="_blank">客服加载演示</a></li>
					</div>
				</dd>
			</dl>
			<dl class="last"></dl>
		</div>
		<div></div>
	</div>
</div>';
	}


	//客服顶部导航菜单内容
	protected function s_header_menu($path = '', $blank = 0) {
		if($blank) {
			$blank = ' target="_blank"';
		}else{
			$blank = '';
		}

		$isAdmin = $this->CheckAccess();

		return '<div id="header">
	<div class="logo" ><img src="'. SYSDIR .'public/img/logo.gif"></div>
	<div id="ajax-loader"></div>
	<div id="topbar">
		<div id="topmenu">' . $this->get_menu($isAdmin, $blank) . '</div>
		<div id="topuser">
			' . Iif($isAdmin, '<div class="open"><a class="link-btn2 set_robot_on">无人值守</a><a class="link-btn3 set_robot_off" title="关闭无人值守后, 新进入的访客将由客服提供服务, 但此前在线的访客仍会由机器人自动回复.">关闭无人值守</a></div>') . '
			' . Iif($blank, '<div class="open"><a class="link-btn2 set_busy">挂起</a><a class="link-btn3 set_serving" title="解除挂起进入服务状态, 接受新客人加入.">解除挂起</a></div>') . '
			' . Iif($isAdmin, '<div class="open"><a class="link-btn2 reset_socket" title="重启Socket通讯服务, 所有在线客人将丢失. <br>无特殊原因, 请勿重启Socket通讯服务!">重启服务</a></div>') . '
			' . Iif($blank, '<div class="open"><a class="link-btn2 logout">安全退出</a></div>') . '
			<dl class="first"></dl>
			<dl class="supporter"><div>' . $this->admin['fullname'] . ' <label class="grey">[' . $this->admin['post'] . ']</label>&nbsp;&nbsp;<img src="' . GetAvatar($this->admin['aid']) . '" class="avatar w20"></div></dl>
			<dl class="last"></dl>
		</div>
		<div></div>
	</div>
</div>';
	}

	/**
	 * 输出页脚 page_footer
	 */
    protected function page_footer($sysinfo = ''){
		global $sys_starttime;

		$mtime = explode(' ', microtime());
		$sys_runtime = number_format(($mtime[1] + $mtime[0] - $sys_starttime), 3);
		echo '</div>
</div>
<div class="sysinfo">'.date("Y").' &copy; '.APP_NAME.' '.APP_VERSION.' <a href="'.APP_URL.'" target="_blank">云资源</a> Done in '.$sys_runtime.' second(s), '.APP::$DB->query_nums.' queries, GMT' .APP::$_CFG['Timezone'].' ' .DisplayDate('', '', 1).'</div>	
</body>
</html>';
	}

	/**
	 * 析构函数 输出页脚
	 */
	public function __destruct(){
		//登录成功才允许在析构函数中输出面页底部. 未登录时, 有登录页面, 互不冲突
		if($this->admin AND !$this->ajax) $this->page_footer();
	}

}

?>