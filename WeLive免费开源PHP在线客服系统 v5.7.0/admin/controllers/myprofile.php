<?php if(!defined('ROOT')) die('Access denied.');

class c_myprofile extends Admin{

	public function __construct($path){
		parent::__construct($path);

	}

	//保存
	public function save(){
		$aid          = $this->admin['aid'];

		$password        = ForceStringFrom('password');
		$passwordconfirm = ForceStringFrom('passwordconfirm');

		$email           = ForceStringFrom('email');
		$fullname        = ForceStringFrom('fullname');
		$fullname_en        = ForceStringFrom('fullname_en');

		if(strlen($password) OR strlen($passwordconfirm)){
			if(strcmp($password, $passwordconfirm)){
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

		if(isset($errors)){
			Error($errors, '编辑我的信息错误');
		}else{
			APP::$DB->exe("UPDATE " . TABLE_PREFIX . "admin SET 
			".Iif($password, "password = '" . md5($password) . "',")."
			email       = '$email',
			fullname       = '$fullname',
			fullname_en       = '$fullname_en'
			WHERE aid      = '$aid'");

			Success('myprofile');
		}
	}


	//添加页面
	public function index(){

		SubMenu('我的信息', array(array('编辑我的信息', 'myprofile', 1)));
		
		$need_info = '&nbsp;&nbsp;<font class=red>* 必填项</font>';
		$pass_info = '&nbsp;&nbsp;<font class=grey>不修改请留空</font>';

		echo '<form method="post" action="'.BURL('myprofile/save').'">
		<input type="hidden" name="aid" value="' . $this->admin['aid'] . '">';

		TableHeader('编辑我的信息: <span class=note>' . $this->admin['fullname'] . '</span>');

		TableRow(array('<b>登录名:</b>',  $this->admin['username']));

		TableRow(array('<b>密码:</b>', '<input type="text" name="password" size="20">'.$pass_info));
		TableRow(array('<b>确认密码:</b>', '<input type="text" name="passwordconfirm" size="20">'.$pass_info));
		TableRow(array('<b>Email地址:</b>', '<input type="text" name="email" value="'.$this->admin['email'].'" size="20">'.$need_info));

		TableRow(array('<b>昵称 (<font class=blue>中文</font>):</b>', '<input type="text" name="fullname" value="'.$this->admin['fullname'].'" size="20">'.$need_info));
		TableRow(array('<b>昵称 (<font class=red>英文</font>):</b>', '<input type="text" name="fullname_en" value="'.$this->admin['fullname_en'].'" size="20">'.$need_info));

		TableFooter();

		PrintSubmit('保存更新');
	}

} 

?>