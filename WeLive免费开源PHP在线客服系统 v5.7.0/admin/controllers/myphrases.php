<?php if(!defined('ROOT')) die('Access denied.');

class c_myphrases extends Admin{

	public function __construct($path){
		parent::__construct($path);

	}

	//添加
	public function save(){

		$msg = ForceStringFrom('msg');
		$msg_en = ForceStringFrom('msg_en');

		if(!$msg) $errors[] = '请填写常用短语中文内容!';
		if(!$msg_en) $errors[] = '请填写常用短语英文内容!';

		if(isset($errors)) Error($errors, '添加常用短语');

		$myid = $this->admin['aid'];
		APP::$DB->exe("INSERT INTO " . TABLE_PREFIX . "phrase (aid, activated, msg, msg_en) VALUES ('$myid', 1, '$msg', '$msg_en')");

		$lastid = APP::$DB->insert_id;
		APP::$DB->exe("UPDATE " . TABLE_PREFIX . "phrase SET sort = '$lastid' WHERE pid = '$lastid'");

		Success('myphrases');
	}

	//添加
	public function add(){

		SubMenu('添加常用短语', array(array('常用短语列表', 'myphrases'), array('添加常用短语', 'myphrases/add', 1)));

		$need_info = '&nbsp;&nbsp;<font class=red>* 必填项</font>';

		echo '<form method="post" action="'.BURL('myphrases/save').'">';

		TableHeader('常用短语信息:');

		TableRow(array('<b>短语内容 (<font class=blue>中文</font>):</b>', '<input type="text" name="msg" value="" size="80">' . $need_info));
		TableRow(array('<b>短语内容 (<font class=red>英文</font>):</b>', '<input type="text" name="msg_en" value="" size="80">' . $need_info));

		TableFooter();

		PrintSubmit('添加常用短语');
	}


	//批量更新常用短语
	public function updatemyphrases(){
		$myid = $this->admin['aid'];

		$page = ForceIntFrom('p', 1);   //页码

		if(IsPost('updatemyphrases')){
			$pids = $_POST['pids'];
			$sorts   = $_POST['sorts'];
			$activateds   = $_POST['activateds'];
			$msgs   = $_POST['msgs'];
			$msg_ens   = $_POST['msg_ens'];

			for($i = 0; $i < count($pids); $i++){
				$pid = ForceInt($pids[$i]);
				APP::$DB->exe("UPDATE " . TABLE_PREFIX . "phrase SET sort = '" . ForceInt($sorts[$i]) . "',
					activated = '" . ForceInt($activateds[$i]) . "',
					msg = '" . ForceString($msgs[$i]) . "',
					msg_en = '" . ForceString($msg_ens[$i]) . "'					
					WHERE pid = '$pid' AND aid='$myid'");
			}
		}else{
			$deletepids = $_POST['deletepids'];

			for($i = 0; $i < count($deletepids); $i++){
				$pid = ForceInt($deletepids[$i]);
				APP::$DB->exe("DELETE FROM " . TABLE_PREFIX . "phrase WHERE pid = '$pid' AND aid='$myid'");
			}
		}

		Success('myphrases?p=' . $page);
	}


	public function index(){
		$myid = $this->admin['aid'];

		$NumPerPage = 10;
		$page = ForceIntFrom('p', 1);
		$search = ForceStringFrom('s');
		$groupid = ForceStringFrom('g');

		if(IsGet('s')) $search = urldecode($search);

		$start = $NumPerPage * ($page-1);

		SubMenu('我的常用短语', array(array('常用短语列表', 'myphrases', 1), array('添加常用短语', 'myphrases/add')));

		TableHeader('搜索常用短语');

		TableRow('<center><form method="post" action="'.BURL('myphrases').'" name="searchmyphrases" style="display:inline-block;"><label>关键字:</label>&nbsp;<input type="text" name="s" size="18">&nbsp;&nbsp;&nbsp;<label>状态:</label>&nbsp;<select name="g"><option value="0">全部</option><option value="1" ' . Iif($groupid == '1', 'SELECTED') . '>可用</option><option value="2" ' . Iif($groupid == '2', 'SELECTED') . ' class=red>已禁用</option></select>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="搜索常用短语" class="cancel"></form></center>');
		
		TableFooter();

		if($search){
			$searchsql = " WHERE (msg LIKE '%$search%' OR msg_en LIKE '%$search%') AND aid = '$myid' ";
			$title = "搜索: <span class=note>$search</span> 的常用短语列表";

			if($groupid) {
				if($groupid == 1 OR $groupid == 2){
					$searchsql .= " AND activated = " . Iif($groupid == 1, 1, 0)." ";
					$title = "在 <span class=note>" .Iif($groupid == 1, '可用的常用短语', '已禁用的常用短语'). "</span> 中, " . $title;
				}
			}
		}else if($groupid){
			if($groupid == 1 OR $groupid == 2){
				$searchsql .= " WHERE aid = '$myid' AND activated = " . Iif($groupid == 1, 1, 0)." ";
				$title = "全部 <span class=note>" .Iif($groupid == 1, '可用的常用短语', '已禁用的常用短语'). "</span> 列表";
			}
		}else{
			$searchsql = " WHERE aid = '$myid' ";
			$title = '全部常用短语列表';
		}

		$getmyphrases = APP::$DB->query("SELECT * FROM " . TABLE_PREFIX . "phrase ".$searchsql." ORDER BY aid DESC, sort DESC LIMIT $start,$NumPerPage");

		$maxrows = APP::$DB->getOne("SELECT COUNT(pid) AS value FROM " . TABLE_PREFIX . "phrase ".$searchsql);

		echo '<form method="post" action="'.BURL('myphrases/updatemyphrases').'" name="myphrasesform">
		<input type="hidden" name="p" value="'.$page.'">';

		TableHeader($title.'('.$maxrows['value'].'个)');
		TableRow(array('所属客服', '排序', '状态', '短语 (中)', '短语 (英)', '<input type="checkbox" id="checkAll" for="deletepids[]"> <label for="checkAll">删除</label>'), 'tr0');

		if($maxrows['value'] < 1){
			TableRow('<center><BR><font class=redb>未搜索到任何常用短语!</font><BR><BR></center>');
		}else{
			while($phrase = APP::$DB->fetch($getmyphrases)){
				TableRow(array('<input type="hidden" name="pids[]" value="'.$phrase['pid'].'">' . $this->admin['fullname'] . " (ID: $myid)",

				'<input type="text" name="sorts[]" value="' . $phrase['sort'] . '" size="4">',

				'<select name="activateds[]"' . Iif(!$phrase['activated'], ' class=red'). '><option value="1">可用</option><option class="red" value="0" ' . Iif(!$phrase['activated'], 'SELECTED') . '>禁用</option></select>',

				'<input type="text" name="msgs[]" value="' . $phrase['msg'] . '" size="60">',

				'<input type="text" name="msg_ens[]" value="' . $phrase['msg_en'] . '" size="60">',

				'<input type="checkbox" name="deletepids[]" value="' . $phrase['pid'] . '">'));
			}

			$totalpages = ceil($maxrows['value'] / $NumPerPage);

			if($totalpages > 1){
				TableRow(GetPageList(BURL('myphrases'), $totalpages, $page, 10, 's', urlencode($search), 'g', $groupid));
			}

		}

		TableFooter();

		echo '<div class="submit"><input type="submit" name="updatemyphrases" value="保存更新" class="cancel" style="margin-right:28px"><input type="submit" name="deletemyphrases" value="删除常用短语" class="save" onclick="var _me=$(this);showDialog(\'确定删除所选常用短语吗?\', \'确认操作\', function(){_me.closest(\'form\').submit();});return false;"></div></form>';
	}

} 

?>