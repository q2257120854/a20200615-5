<?php if(!defined('ROOT')) die('Access denied.');

class c_index extends Admin{

    function index($path){
		
		//获取统计数据
		$basedata = APP::$DB->getOne("SELECT (select COUNT(cid)  FROM " . TABLE_PREFIX . "comment WHERE readed = 0) AS new_comments, 
		(select COUNT(cid) FROM " . TABLE_PREFIX . "comment) AS comments,
		(select COUNT(gid) FROM " . TABLE_PREFIX . "guest) AS guests, 
		(select COUNT(mid) FROM " . TABLE_PREFIX . "msg) AS msgs, 
		(select COUNT(rid)  FROM " . TABLE_PREFIX . "rating) AS ratings");

		$dir_size_img = $this->dirsize(ROOT . 'upload/img/'); //上传图片文件夹的大小
		$dir_size_img = number_format($dir_size_img / 1024000, 2);

		$dir_size_file = $this->dirsize(ROOT . 'upload/file/'); //上传普通文件的文件夹大小
		$dir_size_file = number_format($dir_size_file / 1024000, 2);

		SubMenu('欢迎进入 '.APP_NAME.' 管理中心', array(
			array('查看留言', 'comments'),
			array('管理客人', 'guests'),
			array('管理记录', 'messages'),
			array('管理评价', 'rating'),
			array('清理图片', 'upload_img'),
			array('清理文件', 'upload_file'),
			array('智能客服管理', 'robot')
		));

		$welcome = '<ul><li>欢迎 <font class=orange>'.$this->admin['fullname'].'</font> 进入后台管理面板! 为了确保系统安全, 请在关闭前点击 <a href="#" class="logout">退出</a> 安全离开!</li>
		<li>隐私保护: <span class="note2">'.APP_NAME.'客服系统[免费版'.APP_VERSION.'] 郑重承诺, 您在使用本系统时, WeLive开发商不会收集您的任何信息</span>.</li>
		<li>您在使用 '.APP_NAME.'客服系统[免费版'.APP_VERSION.'] 时有任何问题, 请访问: <a href="http://www.weensoft.cn/bbs/" target="_blank">云资源</a></li></ul>';

		ShowTips($welcome, '系统信息');

		BR(1);

		TableHeader('运行数据统计');

		TableRow(array('A)', '访客总人数：&nbsp;&nbsp;&nbsp;'. Iif($basedata['guests'] > 10000, '<font class=redb>'.$basedata['guests'].'</font><a class="alert-btn" href="' . BURL('guests') . '">前往清理</a>', '<font class=greyb>'.$basedata['guests'].'</font>'), '', '留言总条数：&nbsp;&nbsp;&nbsp;'. Iif($basedata['comments'] > 10000, '<font class=redb>'.$basedata['comments'].'</font><a class="alert-btn" href="' . BURL('comments') . '">前往清理</a>', '<font class=greyb>'.$basedata['comments'].'</font>'), ''));
		TableRow(array('B)', '对话记录数：&nbsp;&nbsp;&nbsp;'. Iif($basedata['msgs'] > 10000, '<font class=redb>'.$basedata['msgs'].'</font><a class="alert-btn" href="' . BURL('messages') . '">前往清理</a>', '<font class=greyb>'.$basedata['msgs'].'</font>'), '', '访客评价数：&nbsp;&nbsp;&nbsp;'. Iif($basedata['ratings'] > 10000, '<font class=redb>'.$basedata['ratings'].'</font><a class="alert-btn" href="' . BURL('rating') . '">前往清理</a>', '<font class=greyb>'.$basedata['ratings'].'</font>'), ''));
		TableRow(array('C)', '上传图片大小：&nbsp;&nbsp;&nbsp;'. Iif($dir_size_img > 1000, '<font class=redb>'.$dir_size_img.' M</font><a class="alert-btn" href="' . BURL('upload_img') . '">前往清理</a>', '<font class=greyb>'.$dir_size_img.' M</font>'), '上传文件大小：&nbsp;&nbsp;&nbsp;'. Iif($dir_size_file > 1000, '<font class=redb>'.$dir_size_file.' M</font><a class="alert-btn" href="' . BURL('upload_file') . '">前往清理</a>', '<font class=greyb>'.$dir_size_file.' M</font>'), ''));

		TableFooter();


		BR(1);

		TableHeader('客服操作技巧说明');

		TableRow('<font class=grey>1)</font>&nbsp;&nbsp;将代码 <span class=note>&lt;script type="text/javascript" charset="UTF-8" src="' . BASEURL . 'welive.js"&gt;&lt;/script&gt;</span> 插入需要调用WeLive客服小面板的网页&lt;html&gt;内.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp此方式将在当前页面打开对话窗口, 支持web和移动端页面. ');

		TableRow('<font class=grey>2)</font>&nbsp;&nbsp;将代码 <span class=note>&lt;script type="text/javascript" charset="UTF-8" src="' . BASEURL . 'welive_ol.js"&gt;&lt;/script&gt;</span> 插入需要在新窗口打开WeLive客服对话窗口的网页&lt;html&gt;内.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp编辑此页面中的元素，为其添加样式：class="welive_online"，那么点击此元素将在新窗口中打开WeLive对话窗口，如：<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&lt;a href="" class="welive_online"&gt;点击在新窗口打开WeLive&lt;/a&gt;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp此方式支持web和移动端页面. ');

		TableRow('<font class=grey>3)</font>&nbsp;&nbsp;链接URL直接进入对话窗口(二维码): <span class=note>' . BASEURL . 'kefu.php?a=621276866</span> 此方式支持web和移动端. 参阅：<a href="../" target="_blank">前台客服加载演示</a>');
		TableRow('<font class=grey>4)</font>&nbsp;&nbsp;客服窗口中, 按 Ctrl + Alt, 在客服交流区与当前客人小窗口间切换.');
		TableRow('<font class=grey>5)</font>&nbsp;&nbsp;客服窗口中, 按 Ctrl + 下箭头 或 Esc键, 关闭当前客人小窗口. 如果小窗口都关闭了, 自动切换到客服交流区.');
		TableRow('<font class=grey>6)</font>&nbsp;&nbsp;客服窗口中, 按 Ctrl + 上箭头, 展开关闭的客人小窗口.');
		TableRow('<font class=grey>7)</font>&nbsp;&nbsp;客服窗口中, 按 Ctrl + 左或右箭头, 在已展开的客人小窗口间切换.');
		TableRow('<font class=grey>8)</font>&nbsp;&nbsp;与原网站用户接口：在引入WeLive客服系统JS文件的页面，将原网站的用户名(昵称)保存名称为:“welive_fn”的<span class=note>Cookie</span>.');
		TableRow('<font class=grey>9)</font>&nbsp;&nbsp;WeLive默认安装后, 前台客服小面板不会自动展开, 即不会进入客服. 如何希望自动展开, 可在系统设置中设置. <span class=note>自动展开会消耗服务器资源</span>');
		TableRow('<font class=grey>10)</font>&nbsp;&nbsp;移动端客服登录地址: <span class=note>' . BASEURL . 'app/</span>, 后台管理及客服登录目录admin或app均可任修改.');
		TableRow('<font class=grey>11)</font>&nbsp;&nbsp;在客服窗口中的客服交流区, 管理员可发送特殊指令: system die --- Socket服务将中断并重启(<span class=note>慎用</span>);&nbsp;&nbsp;all --- 显示所有连接数;&nbsp;&nbsp;admin --- 显示所有客服及其客人数;&nbsp;&nbsp;guest --- 显示客人数;&nbsp;&nbsp;robot --- 显示机器人服务数据');

		TableFooter();

		//更新顶部提示信息
		echo '<script type="text/javascript">
			$(function(){
				var info_total = ' . $basedata['new_comments'] . ';

				if(info_total > 0){
					$("#topuser dl#info_all").removeClass("none");
					$("#topuser #info_total").html(info_total);
					$("#topuser #info_comms").html(info_total).attr("class", "orangeb");

				}

				//将统计数据保存为cookie. 注: header已发送, 此页面不能使用php保存cookie
				setCookie("' . COOKIE_KEY . 'backinfos", info_total, 365);
			});
		</script>';
    }

	/**
	 * 文件夹大小
	 * @param $path
	 * @return int
	 */
	private function dirsize($path)
	{
		$size = 0;
		if(!is_dir($path)) return $size;

		$handle = opendir($path);
		while (($item = readdir($handle)) !== false) {
			if ($item == '.' || $item == '..') continue;
			$_path = $path . '/' . $item;
			if (is_file($_path)) $size += filesize($_path);
			if (is_dir($_path)) $size += $this->dirsize($_path);
		}
		closedir($handle);
		return $size;
	}


}

?>