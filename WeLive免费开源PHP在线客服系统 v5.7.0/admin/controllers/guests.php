<?php if(!defined('ROOT')) die('Access denied.');

class c_guests extends Admin{

	public function __construct($path){
		parent::__construct($path);

		$this->CheckAction();
	}


	//按客人ID删除客人及其对话记录
	private function DeleteGuest($gid){
		if(!$gid) return;
		APP::$DB->exe("DELETE FROM " . TABLE_PREFIX . "guest WHERE gid = '$gid'");

		//删除客人的对话记录
		APP::$DB->exe("DELETE FROM " . TABLE_PREFIX . "msg WHERE (fromid = '$gid' AND type = 0) OR (toid = '$gid' AND type = 1)");
	}

	//保存
	public function save(){
		$gid          = ForceIntFrom('gid');

		$email           = ForceStringFrom('email');
		$fullname        = ForceStringFrom('fullname');
		$phone        = ForceStringFrom('phone');
		$address        = ForceStringFrom('address');
		$remark        = ForceStringFrom('remark');

		if($email AND !IsEmail($email)) Error('Email地址不规范', '编辑客人错误');

		APP::$DB->exe("UPDATE " . TABLE_PREFIX . "guest SET fullname    = '$fullname',
		address       = '$address',
		phone       = '$phone',
		email       = '$email',
		remark       = '$remark'
		WHERE gid      = '$gid'");

		Success('guests');
	}

	//快速删除客人
	public function fastdelete(){
		$days = ForceIntFrom('days');

		if(!$days) Error('请选择删除期限!');

		$time = time() - $days * 24 * 3600;

		$gets = APP::$DB->query("SELECT gid FROM " . TABLE_PREFIX . "guest WHERE last < $time");
		while($g = APP::$DB->fetch($gets)){
			APP::$DB->exe("DELETE FROM " . TABLE_PREFIX . "msg WHERE (fromid = '$g[gid]' AND type = 0) OR (toid = '$g[gid]' AND type = 1)");
		}

		APP::$DB->exe("DELETE FROM " . TABLE_PREFIX . "guest WHERE last < $time");

		Success('guests');
	}

	//批量更新客人
	public function updateguests(){
		$page = ForceIntFrom('p', 1);   //页码

		$deletegids = $_POST['deletegids'];

		for($i = 0; $i < count($deletegids); $i++){
			$gid = ForceInt($deletegids[$i]);
			$this->DeleteGuest($gid); //批量删除客人及对话记录
		}

		Success('guests?p=' . $page);
	}

	//编辑调用add
	public function edit(){
		$gid = ForceIntFrom('gid');

		SubMenu('编辑客人', array(array('客人列表', 'guests'), array('编辑客人', 'guests/edit?gid='.$gid, 1)));
		
		$user = APP::$DB->getOne("SELECT * FROM " . TABLE_PREFIX . "guest WHERE gid = '$gid'");
		if(!$user) Error('您正在尝试编辑的客人不存在!', '编辑客人错误');

		echo '<form method="post" action="'.BURL('guests/save').'">
		<input type="hidden" name="gid" value="' . $gid . '">';

		TableHeader('编辑客人信息: <span class=note>' . Iif($user['fullname'], $user['fullname'], Iif($user['lang'], "无名 (ID: $gid)", "None (ID: $gid)")) . '</span>');

		TableRow(array('<b>姓名:</b>', '<input type="text" name="fullname" value="'.$user['fullname'].'" size="20"><font style="margin-left:40px;" class=light>意向分: '. $user['grade'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登录: $user[logins]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;踢出: $user[banned]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;上传授权: " . Iif($user['upload'], '有', '-') . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;语言: " . Iif($user['lang'], '中文', 'English') . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;来自: $user[ipzone]($user[lastip])</font>"));
		TableRow(array('<b>来自页面</b>', "<a href=\"$user[fromurl]\" target=\"_blank\">$user[fromurl]</a>&nbsp;&nbsp;浏览器: $user[browser]" . Iif($user['mobile'], ' <img src="' . SYSDIR . 'public/img/mobile.png" style="height:20px;">')));
		TableRow(array('<b>Email:</b>', '<input type="text" name="email" value="'.$user['email'].'" size="40">'));
		TableRow(array('<b>电话:</b>', '<input type="text" name="phone" value="'.$user['phone'].'" size="40">'));
		TableRow(array('<b>地址:</b>', '<input type="text" name="address" value="'.$user['address'].'" size="40">'));
		TableRow(array('<b>备注:</b>', '<textarea name="remark" style="height:80px;width:400px;">' . $user['remark'] . '</textarea>'));

		TableFooter();

		PrintSubmit('保存更新');
	}

	public function index(){
		$NumPerPage = 20;
		$page = ForceIntFrom('p', 1);
		$letter = ForceStringFrom('key');
		$search = ForceStringFrom('s');
		$groupid = ForceStringFrom('g');

		if(IsGet('s')){
			$search = urldecode($search);
		}

		$start = $NumPerPage * ($page-1);

		$admins = array();
		$getadmins = APP::$DB->query("SELECT aid, fullname FROM " . TABLE_PREFIX . "admin");
		while($a = APP::$DB->fetch($getadmins)){
			$admins[$a['aid']] = $a['fullname'];
		}

		SubMenu('客人列表', array(array('客人列表', 'guests', 1)));

		TableHeader('快速查找客人');
		for($alphabet = 'a'; $alphabet != 'aa'; $alphabet++){
			$alphabetlinks .= '<a href="'.BURL('guests?key=' . $alphabet) . '" title="' . strtoupper($alphabet) . '开头的客人" class="link_alphabet">' . strtoupper($alphabet) . '</a> &nbsp;';
		}

		TableRow('<center><b><a href="'.BURL('guests').'" class="link_alphabet">全部客人</a>&nbsp;&nbsp;&nbsp;<a href="'.BURL('guests?key=Other').'"  class="link_alphabet">中文名</a>&nbsp;&nbsp;&nbsp;' . $alphabetlinks . '</b></center>');
		TableFooter();


		TableHeader('搜索及快速删除');
		TableRow('<center><form method="post" action="'.BURL('guests').'" name="searchguests" style="display:inline-block;*display:inline;"><label>关键字:</label>&nbsp;<input type="text" name="s" size="18">&nbsp;&nbsp;&nbsp;<label>来源或意向:</label>&nbsp;<select name="g"><option value="0">全部</option><option value="cn" ' . Iif($groupid == 'cn', 'SELECTED') . ' class=blue>中文 (语言)</option><option value="en" ' . Iif($groupid == 'en', 'SELECTED') . ' class=red>EN (语言)</option><option value="5" ' . Iif($groupid == '5', 'SELECTED') . '>5分 (意向)</option><option value="4" ' . Iif($groupid == '4', 'SELECTED') . '>4分 (意向)</option><option value="3" ' . Iif($groupid == '3', 'SELECTED') . '>3分 (意向)</option><option value="2" ' . Iif($groupid == '2', 'SELECTED') . '>2分 (意向)</option><option value="1" ' . Iif($groupid == '1', 'SELECTED') . '>1分 (意向)</option><option value="web" ' . Iif($groupid == 'web', 'SELECTED') . ' class=blue>Web端</option><option value="mobile" ' . Iif($groupid == 'mobile', 'SELECTED') . ' class=red>移动端</option></select>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="搜索客人" class="cancel"></form>

		<form method="post" action="'.BURL('guests/fastdelete').'" name="fastdelete" style="display:inline-block;margin-left:80px;*display:inline;"><label>快速删除客人:</label>&nbsp;<select name="days"><option value="0">请选择 ...</option><option value="360">12个月前登录的客人</option><option value="180">&nbsp;6 个月前登录的客人</option><option value="90">&nbsp;3 个月前登录的客人</option><option value="30">&nbsp;1 个月前登录的客人</option></select>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="快速删除" class="save" onclick="var _me=$(this);showDialog(\'确定删除所选客人吗?<br>注: 客人的对话记录将同时被删除.\', \'确认操作\', function(){_me.closest(\'form\').submit();});return false;"></form></center>');

		
		TableFooter();


		if($letter){
			if($letter == 'Other'){
				$searchsql = " WHERE fullname <> '' AND fullname NOT REGEXP(\"^[a-zA-Z]\") ";
				$title = '<span class=note>中文姓名</span> 的客人列表';
			}else{
				$searchsql = " WHERE fullname LIKE '$letter%' ";
				$title = '<span class=note>'.strtoupper($letter) . '</span> 字母开头的客人列表';
			}
		}else if($search){
			if(preg_match("/^[1-9][0-9]*$/", $search)){
				$s = ForceInt($search);
				$searchsql = " WHERE (gid = '$s' OR aid = '$s' OR phone LIKE '$s') "; //按ID搜索
				$title = "搜索数字为: <span class=note>$s</span> 的客人";
			}else{
				$searchsql = " WHERE (fullname LIKE '%$search%' OR address LIKE '%$search%' OR browser LIKE '%$search%' OR email LIKE '%$search%' OR ipzone LIKE '%$search%' OR remark LIKE '%$search%') ";
				$title = "搜索: <span class=note>$search</span> 的客人列表";
			}

			if($groupid) {
				if($groupid == 'cn' OR $groupid == 'en'){
					$searchsql .= " AND lang = " . Iif($groupid == 'cn', 1, 0)." ";
					$title = "在 <span class=note>" .Iif($groupid == 'cn', '中文客人', '英文客人'). "</span> 中, " . $title;
				}elseif($groupid == 'mobile' OR $groupid == 'web'){
					$searchsql .= " AND mobile = " . Iif($groupid == 'mobile', 1, 0)." ";
					$title = "在 <span class=note>" .Iif($groupid == 'mobile', '来自移动端的客人', '来自Web端的客人'). "</span> 中, " . $title;
				}else{
					$searchsql .= " AND grade = '$groupid' ";
					$title = "在 <span class=note>意向为: ".$groupid."分</span> 中, " . $title;
				}
			}
		}else if($groupid){
			if($groupid == 'cn' OR $groupid == 'en'){
				$searchsql .= " WHERE lang = " . Iif($groupid == 'cn', 1, 0)." ";
				$title = "全部 <span class=note>" .Iif($groupid == 'cn', '中文客人', '英文客人'). "</span> 列表";
			}elseif($groupid == 'mobile' OR $groupid == 'web'){
				$searchsql .= " WHERE mobile = " . Iif($groupid == 'mobile', 1, 0)." ";
				$title = "全部 <span class=note>" .Iif($groupid == 'mobile', '来自移动端的客人', '来自Web端的客人'). "</span> 列表";
			}else{
				$searchsql .= " WHERE grade = '$groupid' ";
				$title = "<span class=note>意向为: ".$groupid." 分</span> 的客人列表";
			}
		}else{
			$searchsql = '';
			$title = '全部客人列表';
		}

		$getguests = APP::$DB->query("SELECT * FROM " . TABLE_PREFIX . "guest ".$searchsql." ORDER BY last DESC LIMIT $start,$NumPerPage");

		$maxrows = APP::$DB->getOne("SELECT COUNT(gid) AS value FROM " . TABLE_PREFIX . "guest ".$searchsql);

		echo '<form method="post" action="'.BURL('guests/updateguests').'" name="guestsform">
		<input type="hidden" name="p" value="'.$page.'">';

		TableHeader($title.'('.$maxrows['value'].'个)');
		TableRow(array('ID', '姓名', '意向分', '语言', '登录', '踢出 (次)', '最后服务', '上传授权', '浏览器', '来自页面', 'Email', '电话', '地址', '备注', '归属地 (IP)', '最后登陆', '<input type="checkbox" id="checkAll" for="deletegids[]"> <label for="checkAll">删除</label>'), 'tr0');

		if($maxrows['value'] < 1){
			TableRow('<center><BR><font class=redb>未搜索到任何客人!</font><BR><BR></center>');
		}else{
			while($user = APP::$DB->fetch($getguests)){
				TableRow(array($user['gid'],
				'<a title="编辑" href="'.BURL('guests/edit?gid='.$user['gid']).'">' . Iif($user['fullname'], $user['fullname'], '<font class=grey>' . Iif($user['lang'], '无名', 'None') . '</font>') . '</a>',
				$user['grade'],
				Iif($user['lang'], '中文', 'EN'),
				$user['logins'],
				$user['banned'],
				Iif(isset($admins[$user['aid']]), $admins[$user['aid']], '<font class=grey>机器人</font>'),
				Iif($user['upload'], '<font class=blue>有</font>'),
				$user['browser'] . Iif($user['mobile'], ' <img src="' . SYSDIR . 'public/img/mobile.png" style="height:20px;">'),
				"<a href=\"$user[fromurl]\" target=\"_blank\">" . ShortTitle($user['fromurl'], 36) . "</a>",
				Iif($user['email'], '<a href="mailto:' . $user['email'] . '">' . $user['email'] . '</a>'),
				$user['phone'],
				$user['address'],
				ShortTitle($user['remark'], 48),
				$user['ipzone'] . " (<a href=\"https://www.baidu.com/s?wd=$user[lastip]\" target=\"_blank\">$user[lastip]</a>)",
				DisplayDate($user['last'], '', 1),
				'<input type="checkbox" name="deletegids[]" value="' . $user['gid'] . '">'));
			}

			$totalpages = ceil($maxrows['value'] / $NumPerPage);

			if($totalpages > 1){
				TableRow(GetPageList(BURL('guests'), $totalpages, $page, 10, 'key', $letter, 's', urlencode($search), 'g', $groupid));
			}

		}

		TableFooter();

		PrintSubmit('删除客人', '', 1, '确定删除所选客人吗?<br>注: 客人的对话记录将同时被删除.');
	}

} 

?>