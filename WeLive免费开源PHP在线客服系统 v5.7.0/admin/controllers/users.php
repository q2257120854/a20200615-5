<?php if(!defined('ROOT')) die('Access denied.');

class c_users extends Admin{

	public function __construct($path){
		parent::__construct($path);

		$this->CheckAction(); //权限验证
	}

	//按用户ID删除用户
	private function DeleteUser($aid){
		if(!$aid) return;

		//初始管理员及在席客服无法删除
		$re = APP::$DB->exe("DELETE FROM " . TABLE_PREFIX . "admin WHERE aid = '$aid' AND aid != 1 And online != 1");

		//删除常用短语
		if($re) APP::$DB->exe("DELETE FROM " . TABLE_PREFIX . "phrase WHERE aid = '$aid'");

		//删除头像
		@unlink(ROOT . "avatar/$aid.jpg");
	}


	//保存
	public function save(){
		$aid          = ForceIntFrom('aid');

		$type     = ForceIntFrom('type');
		$activated       = ForceIntFrom('activated');
		$username        = ForceStringFrom('username');
		$password        = ForceStringFrom('password');
		$passwordconfirm = ForceStringFrom('passwordconfirm');

		$email           = ForceStringFrom('email');
		$fullname        = ForceStringFrom('fullname');
		$fullname_en        = ForceStringFrom('fullname_en');
		$post        = ForceStringFrom('post');
		$post_en        = ForceStringFrom('post_en');

		$deleteuser       = ForceIntFrom('deleteuser');

		if($deleteuser AND $aid != $this->admin['aid']){
			$this->DeleteUser($aid);
			Success('users'); //如果删除客服, 直接跳转
		}

		if(!$username){
			$errors[] = '请输入用户名!';
		}elseif(!IsName($username)){
			$errors[] = '用户名存在非法字符!';
		}elseif(APP::$DB->getOne("SELECT aid FROM " . TABLE_PREFIX . "admin WHERE username = '$username' AND aid != '$aid'")){
			$errors[] = '用户名已存在!';
		}

		if($aid){
			if(strlen($password) OR strlen($passwordconfirm)){
				if(strcmp($password, $passwordconfirm)){
					$errors[] = '两次输入的密码不相同!';
				}
			}
		}else{
			if(!$password){
				$errors[] = '请输入密码!';
			}elseif($password != $passwordconfirm){
				$errors[] = '两次输入的密码不相同!';
			}
		}

		if(!$email){
			$errors[] = '请输入Email地址!';
		}elseif(!IsEmail($email)){
			$errors[] = 'Email地址不规范!';
		}elseif(APP::$DB->getOne("SELECT aid FROM " . TABLE_PREFIX . "admin WHERE email = '$email' AND aid != '$aid'")){
			$errors[] = 'Email地址已占用!';
		}

		if(!$fullname) $errors[] = '请输入中文昵称!';
		if(!$fullname_en) $errors[] = '请输入英文昵称!';
		if(!$post) $errors[] = '请输入中文职位!';
		if(!$post_en) $errors[] = '请输入英文职位!';

		if(isset($errors)){
			Error($errors, Iif($aid, '编辑客服错误', '添加客服错误'));
		}else{
			if($aid){
				APP::$DB->exe("UPDATE " . TABLE_PREFIX . "admin SET username    = '$username',
				".Iif($aid != $this->admin['aid'], "type = '$type', activated = '$activated',")."
				".Iif($password, "password = '" . md5($password) . "',")."
				email       = '$email',
				fullname       = '$fullname',
				fullname_en       = '$fullname_en',
				post       = '$post',
				post_en       = '$post_en'										 
				WHERE aid      = '$aid'");

			}else{
				APP::$DB->exe("INSERT INTO " . TABLE_PREFIX . "admin (type, activated, username, password, email, first, fullname, fullname_en, post, post_en) VALUES ('$type', 1, '$username', '".md5($password)."', '$email', '".time()."', '$fullname', '$fullname_en', '$post', '$post_en')");
			}

			Success('users');
		}
	}

	//批量更新客服
	public function updateusers(){
		$page = ForceIntFrom('p', 1);   //页码

		$deleteaids = $_POST['deleteaids'];

		for($i = 0; $i < count($deleteaids); $i++){
			$aid = ForceInt($deleteaids[$i]);
			if($aid != $this->admin['aid']){
				$this->DeleteUser($aid);
			}
		}

		Success('users?p=' . $page);
	}

	//编辑调用add
	public function edit(){
		$this->add();
	}

	//添加页面
	public function add(){
		$aid = ForceIntFrom('aid');

		if($aid){
			SubMenu('编辑客服', array(array('客服列表', 'users'), array('添加客服', 'users/add'), array('编辑客服', 'users/edit?aid='.$aid, 1)));
			
			$user = APP::$DB->getOne("SELECT * FROM " . TABLE_PREFIX . "admin WHERE aid = '$aid'");

			if(!$user) Error('您正在尝试编辑的客服不存在!', '编辑客服错误');
		}else{
			SubMenu('添加客服', array(array('客服列表', 'users'), array('添加客服', 'users/add', 1)));

			$user = array('aid' => 0, 'type' => 0, 'activated' => 1);
		}

		$need_info = '&nbsp;&nbsp;<font class=red>*</font>';
		$pass_info = Iif($aid, '&nbsp;&nbsp;<font class=grey>不修改请留空</font>', $need_info);

		echo '<form method="post" action="'.BURL('users/save').'">
		<input type="hidden" name="aid" value="' . $user['aid'] . '">';

		if($aid){
			TableHeader('编辑客服信息: <span class=note>' . $user['username'] . '</span>');
		}else{
			TableHeader('填写客服信息');
		}

		TableRow(array('<b>用户名:</b>', '<input type="text" name="username" value="'.$user['username'].'" size="20">' .$need_info . Iif($aid, "<font class=light><img src='" . GetAvatar($user['aid']) . "' class='avatar wh30' style='margin-left:60px'>")));

		$Radio = new Radio;
		$Radio->Name = 'type';
		$Radio->SelectedID = $user['type'];
		$Radio->AddOption(1, '<font class=redb>管理员</font>', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
		$Radio->AddOption(0, '<b>客服</b>', '&nbsp;&nbsp;');

		if($aid != $this->admin['aid']){

			TableRow(array('<b>类型:</b>', $Radio->Get()));

			if($aid){
				$Radio ->Clear();
				$Radio->Name = 'activated';
				$Radio->SelectedID = $user['activated'];
				$Radio->AddOption(1, '正常', '&nbsp;&nbsp;&nbsp;&nbsp;');
				$Radio->AddOption(0, '禁止', '&nbsp;&nbsp;&nbsp;&nbsp;');

				TableRow(array('<b>账号:</b>', $Radio->Get()));

				if($user['aid'] != $this->admin['aid'] && $user['aid'] != 1 && $user['online'] != 1){
					TableRow(array('<b>删除此客服?</b>', '<input type="checkbox" name="deleteuser" value="1">&nbsp;<font class=redb>慎选!</font>'));
				}

			}
		}else{
			$Radio->Attributes = 'disabled';
			TableRow(array('<b>类型:</b>', $Radio->Get()));
		}

		TableRow(array('<b>密码:</b>', '<input type="text" name="password" size="20">'.$pass_info));
		TableRow(array('<b>确认密码:</b>', '<input type="text" name="passwordconfirm" size="20">'.$pass_info));
		TableRow(array('<b>Email地址:</b>', '<input type="text" name="email" value="'.$user['email'].'" size="20">'.$need_info));

		TableRow(array('<b>昵称 (<font class=blue>中文</font>):</b>', '<input type="text" name="fullname" value="'.$user['fullname'].'" size="20">'.$need_info));
		TableRow(array('<b>昵称 (<font class=red>英文</font>):</b>', '<input type="text" name="fullname_en" value="'.$user['fullname_en'].'" size="20">'.$need_info));
		TableRow(array('<b>职位 (<font class=blue>中文</font>):</b>', '<input type="text" name="post" value="'.$user['post'].'" size="20">'.$need_info));
		TableRow(array('<b>职位 (<font class=red>英文</font>):</b>', '<input type="text" name="post_en" value="'.$user['post_en'].'" size="20">'.$need_info));

		TableFooter();

		PrintSubmit(Iif($aid, '保存更新', '添加客服'));
	}

	public function index(){

		$NumPerPage = 10;
		$page = ForceIntFrom('p', 1);

		$start = $NumPerPage * ($page-1);

		SubMenu('客服列表', array(array('客服列表', 'users', 1), array('添加客服', 'users/add')));

		$getusers = APP::$DB->query("SELECT a.*, ROUND(AVG(r.score), 2) AS avg_score, COUNT(r.rid) AS scores, 
													(select COUNT(gid)  FROM " . TABLE_PREFIX . "guest WHERE aid = a.aid) AS guests 		
													FROM " . TABLE_PREFIX . "admin a 
													LEFT JOIN " . TABLE_PREFIX . "rating r ON r.aid = a.aid
													GROUP BY a.aid ORDER BY activated ASC, aid DESC LIMIT $start, $NumPerPage");


		$maxrows = APP::$DB->getOne("SELECT COUNT(aid) AS value FROM " . TABLE_PREFIX . "admin");

		echo '<form method="post" action="'.BURL('users/updateusers').'" name="usersform">
		<input type="hidden" name="p" value="'.$page.'">';

		TableHeader('共有 '.$maxrows['value'].' 位客服人员');
		TableRow(array('ID', '用户名', '服务状态', '访客人数', '平均投票得分<br>(评价次数)', '类型', '账号', 'Email', '登录', '昵称 (中)', '职位 (中)', '昵称 (EN)', '职位 (EN)', '注册日期', '最后登陆 (IP)', '<input type="checkbox" id="checkAll" for="deleteaids[]"> <label for="checkAll">删除</label>'), 'tr0');

		while($user = APP::$DB->fetch($getusers)){

			TableRow(array($user['aid'],

			'<a title="编辑" href="'.BURL('users/edit?aid='.$user['aid']).'"><img src="' . GetAvatar($user['aid']) . '" class="avatar wh30">' . Iif($user['activated'] == 1, $user['username'], "<font class=red><s>$user[username]</s></font>") . '</a>',

			Iif($user['online'], '<font class=blue>服务中...</font>', '<font class=grey>离席</font>'),

			$user['guests'],

			Iif($user['avg_score'], $user['avg_score'] . " (" .  $user['scores'] .  ")", "-"),

			Iif($user['type'], '<font class=red>管理员</font>', '客服人员'),

			Iif($user['activated'], '正常', '<font class=red>已禁止</font>'),

			Iif($user['aid'] == $this->admin['aid'], $user['email'], '<a href="mailto:' . $user['email'] . '">' . $user['email'] . '</a>'),

			$user['logins'],
			$user['fullname'],
			$user['post'],
			$user['fullname_en'],
			$user['post_en'],
			DisplayDate($user['first']),

			Iif($user['last'] == 0, '<span class="red">从未登陆</span>', DisplayDate($user['last'], '', 1)  . " ($user[lastip])"),

			Iif($user['aid'] != $this->admin['aid'] && $user['aid'] != 1 && $user['online'] != 1, '<input type="checkbox" name="deleteaids[]" value="' . $user['aid'] . '">')));
		}

		$totalpages = ceil($maxrows['value'] / $NumPerPage);

		if($totalpages > 1){
			TableRow(GetPageList(BURL('users'), $totalpages, $page));
		}

		TableFooter();

		PrintSubmit('删除客服', '', 1, '确定删除所选客服吗?');
	}
} 

?>