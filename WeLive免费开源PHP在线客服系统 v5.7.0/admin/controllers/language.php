<?php if(!defined('ROOT')) die('Access denied.');

class c_language extends Admin{

	public function __construct($path){
		parent::__construct($path);

		$this->lang_path = ROOT . 'language/';

		$this->CheckAction();
	}

	//ajax动作集合, 通过action判断具体任务
    public function ajax(){
		//ajax权限验证
		if(!$this->CheckAccess()){
			$this->ajax['s'] = 0; //ajax操作失败
			$this->ajax['i'] = '您没有权限设置或管理网站语言!';
			die($this->json->encode($this->ajax));
		}
		
		$action = ForceStringFrom('action');
		if($action == 'setlang'){
			$this->select();
		}elseif($action == 'delete'){
			$file = ForceStringFrom('file');
			$file = basename($file); //去掉可能用户手动添加的相对路径, 限制在当前目录

			//不允许删除系统默认的语言文件
			if($file == 'English.php' OR $file == 'Chinese.php'){
				$this->ajax['s'] = 0; //ajax操作失败
				$this->ajax['i'] = '系统默认的语言文件无法删除!';
			}else{
				if(@unlink($this->lang_path.$file))	{
					//无动作
				}else{
					$this->ajax['s'] = 0; //ajax操作失败
					$this->ajax['i'] = '无法删除语言文件! 文件夹不可写或文件不存在.';
				}
			}
		}elseif($action == 'savelang'){
			$result = $this->save(); //保存当前语言文件
			if($result !== true){
				$this->ajax['s'] = 0; //ajax操作失败
				$this->ajax['i'] = $result;
			}
		}

		die($this->json->encode($this->ajax));
	}

	//选择并设置语言
    private function select(){
		$Lang    = ForceStringFrom('Lang');

		if(APP::$_CFG['Lang'] != $Lang){

			//解决PHP7 Opcache开启时无法实时更新设置的问题
			if(function_exists('opcache_reset')) {
				@opcache_reset();
			}

			$filename = ROOT . "config/settings.php";
			$welive_js = ROOT . "welive.js";

			//修改./config/settings.php文件
			$fp = @fopen($filename, 'rb');
			$contents = @fread($fp, @filesize($filename));
			@fclose($fp);
			$contents =  trim($contents);

			$contents = preg_replace("/[$]_CFG\['Lang'\]\s*\=\s*[\"'].*?[\"'];/is", "\$_CFG['Lang'] = \"$Lang\";", $contents);

			$fp = @fopen($filename, 'w');
			@fwrite($fp, $contents);
			@fclose($fp);

			//修改./welive.js文件
			$fp = @fopen($welive_js, 'rb');
			$welive_js_contents = @fread($fp, filesize($welive_js));
			@fclose($fp);
			$welive_js_contents = trim($welive_js_contents);

			$welive_js_contents = preg_replace("/var\s*welive_lang\s*\=\s*[\"'].*?[\"'];/is", "var welive_lang = \"$Lang\";", $welive_js_contents);

			$fp = @fopen($welive_js, 'w');
			@fwrite($fp, $welive_js_contents);
			@fclose($fp);
		}
	}

	//保存语言文件
    public function save(){
		$filename = ForceStringFrom('filename');
		$filename = basename($filename); //去掉可能用户手动添加的相对路径, 限制在当前目录

		$file = $this->lang_path . $filename;

		if (is_writable($file)) {

			//解决PHP7 Opcache开启时无法实时更新设置的问题
			if(function_exists('opcache_reset')) {
				@opcache_reset();
			}

			$filecontent = trim($_POST['filecontent']);
			if (get_magic_quotes_gpc()) {
				$filecontent = stripslashes($filecontent);
			}

			$fd = fopen($file, 'wb');
			fputs($fd,$filecontent);

			return true;
		}else{
			return "语言文件($filename)不可写! 请将其属性设置为: 777";
		}
	}

	//编辑语言文件
    public function edit(){
		SubMenu('语言管理', array(array('语言列表及操作', 'language')));

		$filename = ForceStringFrom('filename');
		$filename = basename($filename); //去掉可能用户手动添加的相对路径, 限制在当前目录

		$filepath = $this->lang_path . $filename;

		if(!is_file($filepath)) Error('正在打开的文件不存在!', '打开文件错误');

		$filecontent = htmlspecialchars(implode("",file($filepath)));

		echo '<form method="post" name="editform" onsubmit="return false;">
		<input type="hidden" name="filename" value="' . $filename . '">
		<input type="hidden" name="action" value="savelang">';

		TableHeader('编辑语言文件: &nbsp;' . BASEURL . "language/$filename");

		TableRow('<b>注意:</b> <span class=note>语言文件为PHP程序文件, 请使用正确的标点符号, 不正确的编辑将会导致访客对话窗口运行崩溃!<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;如需要在内容中添加单引号, 则需要在其前面加\, 如：\'welive\' => \'在线\\\'OK\\\'客服\', 且每一行需要以英文逗号分隔.</span><BR><textarea rows="26" style="width:90%;margin-top:8px" name="filecontent" >' . $filecontent . '</textarea>');

		TableFooter();

		echo '<div class="submit"><input type="submit" id="updatelang" value="保存更新" class="save"><input class="cancel" type="submit" name="cancel" value="返回" onclick="history.back();return false;"></div></form>
		<script type="text/javascript">
			$(function(){
				$("#updatelang").click(function(e){
					var form = $(this).closest("form");

					showDialog("确定保存更新语言文件: ' . $filename . ' 吗?", "确认操作", function(){
						ajax("' . BURL('language/ajax') . '", form.serialize(), function(data){
							showInfo("当前语言文件已更新!", "Ajax操作", "", 4, 1);
						});
					});
					e.preventDefault();
				});
			});
		</script>';
	}

    public function index(){
		SubMenu('语言管理', array(array('语言列表及操作', 'language', 1)));

		$Langs = GetLangs();
		array_unshift($Langs,"Auto");

		foreach($Langs as $k => $val){
			$laname = Iif($val == 'Auto', '自动', Iif($val == 'Chinese', '中文', $val));
			$langstr .= '<input type="radio" name="Lang" id="Lang_' . $k . '" value="' . $val . '"' . Iif(APP::$_CFG['Lang'] == $val, ' checked') . '><label for="Lang_' . $k . '">' . $laname . '</label><i class="w20"></i>';
		}

		TableHeader('访客默认语言');
		TableRow('<form>
			<b>设置访客窗口默认语言:</b><i class="w20"></i>' . $langstr . '&nbsp;&nbsp;
			<input type="submit" value="保存设置" class="cancel" id="setlang"><BR>
			<font class=grey>注: 当选择 <span class=note>自动</span> 时, 访客对话窗口将根据其浏览器语言自动选择语言, 非中文浏览器将显示英文信息提示.</font>
			</form>');

		TableFooter();

		BR(2);

		TableHeader('语言文件列表');

		$files   = GetLangs(1);
		$columncount = 0;

		echo '<td class="td last"><table width="100%" border="0" cellpadding="5" cellspacing="0">';

		for($i = 0; $i < count($files); $i++) {
			$columncount++;

			if($columncount == 1)	{
				echo '<tr>';
			}

			echo '<td width="33%">';
			$this->DisplayFileDetails($files[$i]);
			echo '</td>';

			if($columncount == 3)	{
				echo '</tr>';
				$columncount = 0;
			}
		}
		@closedir($handle);

		if($columncount != 0 && $columncount != 3){
			while($columncount < 3){
				$columncount++;
				echo '<td>&nbsp;</td>';
			}
			echo '</tr>';
		}

		echo '</table></td>';

		TableFooter();

		echo '<script type="text/javascript">
				$(function(){
					$("#setlang").click(function(e){
						var data = $(this).parent().serialize();
						ajax("' . BURL('language/ajax?action=setlang') . '", data, function(data){
							showInfo("访客窗口默认语言设置成功.", "Ajax操作", "", 4, 1);
						});

						e.preventDefault();
					});

					$("#main a.ajax").click(function(e){
						var _me=$(this);
						showDialog("确定删除语言文件: " + _me.attr("file") + " 吗?", "确认操作", function(){
							ajax("' . BURL('language/ajax?action=delete') . '", {file: _me.attr("file")}, function(data){
								_me.parent().parent().hide();
							});
						});

						e.preventDefault();
					});
				});

				</script>';

	} 

	private function DisplayFileDetails($file){
		echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td width="10" valign="top" style="padding-right: 15px;">
		<a href="'.BURL('language/edit?filename=' . $file).'"><img style="border:1px solid #e8e8e8; padding:3px;" src="'.SYSDIR .'public/img/editablefile.gif" /></a>
		</td>
		<td valign="top">
		<b>' . $file . '</b> (' .DisplayFilesize(@filesize($this->lang_path . $file)). ')<br /><br />
		<a href="'.BURL('language/edit?filename=' . $file).'" class="link-btn">编辑文件</a>
		<a file="' . $file . '" class="link-btn ajax">删除文件</a>
		</td>
		</tr>
		</table>';
	}
} 

?>