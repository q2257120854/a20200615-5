<?php if(!defined('ROOT')) die('Access denied.');

class c_upgrade extends Admin{

	public function __construct($path){
		parent::__construct($path);

		$this->CheckAction(); //权限验证
		$this->update_path = ROOT . 'upgrade/';
	}

	public function ajax(){
		//ajax权限验证
		if(!$this->CheckAccess()){
			$this->ajax['s'] = 0; //ajax操作失败
			$this->ajax['i'] = '您没有权限进行系统升级操作!';
			die($this->json->encode($this->ajax));
		}

		include($this->update_path . 'upgrade.php');

		$updateinfo = UpgradeSystem();

		if($updateinfo !== true){
			$this->ajax['s'] = 0; //ajax操作失败
			$this->ajax['i'] = '升级未完成! ' . $updateinfo;
		}

		die($this->json->encode($this->ajax));
	}

	public function index(){
		SubMenu('系统升级');

		$available = 0;

		if(file_exists($this->update_path . 'upgrade.php') and file_exists($this->update_path . 'version.php')){
			$available = 1;
		}

		ShowTips('<ul><li>请严格按升级说明进行系统升级, 升级说明一般随附在升级包中.</li>
		<li>升级过程一般是先将升级包解压后, 设置FTP工具以 <span class=note>二进制方式</span>, 先将upgrade目录上传到WeLive根目录, 然后在后台运行升级程序更新数据库. 然后再将升级包中的其它文件上传替换原文件.</li>
		<li>安全建议: <span class=note>升级完成后删除upgrade目录下的所有文件</span>.</li>
		</ul>', '升级提示');

		BR(2);

		TableHeader('升级操作');

		if($available){
			include($this->update_path . 'version.php');
			
			$new = str_replace ('.', '', $NewVersion);
			$old = str_replace ('.', '', APP_VERSION);

			If(intval ($new) <= intval ($old)){
				$output = '<font class=red>您现在正在使用的版本高于或等于升级程序中的版本, 无需升级!</font><BR>';
			}else{
				$output = '<form><input type="submit" value="运行升级程序" class="save" id="doupgrade"></form>';
			}

			TableRow(array('当前使用中的版本是: <span id="version">' . APP_VERSION . '</span>', '正要升级到的版本是: <font class=red>' . $NewVersion . '</font>'));
			 
			TableRow("<center><br>$output<br></center>");

		}else{
			TableRow('<center><br><br><b><span class=note>暂无可用的升级程序!</span></b><br><br><br></center>');
		}

		TableFooter();

		echo '<script type="text/javascript">
			$(function(){
				$("#doupgrade").click(function(e){
					var _me=$(this);

					showDialog("确定运行升级程序吗?<BR>建议在升级前备份网站数据.", "确认操作", function(){
						ajax("' . BURL('upgrade/ajax') . '", {}, function(data){
							$("#version").html("' . $NewVersion . '");
							_me.parent().parent().html("<br><font class=blueb>升级已完成!</font><br><br>");
						});
					});

					e.preventDefault();
				});
			});
		</script>';
	}
} 

?>