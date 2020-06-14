<?php if(!defined('ROOT')) die('Access denied.');

class c_messages extends Admin{

	public function __construct($path){
		parent::__construct($path);

		$this->CheckAction();
	}


	//快速删除记录
	public function fastdelete(){
		$days = ForceIntFrom('days');

		if(!$days) Error('请选择删除期限!');

		$time = time() - $days * 24 * 3600;

		APP::$DB->exe("DELETE FROM " . TABLE_PREFIX . "msg WHERE time < $time");

		Success('messages');
	}

	//批量更新记录
	public function updatemessages(){
		$page = ForceIntFrom('p', 1);   //页码

		$deletemids = $_POST['deletemids'];

		for($i = 0; $i < count($deletemids); $i++){
			$mid = ForceInt($deletemids[$i]);
			APP::$DB->exe("DELETE FROM " . TABLE_PREFIX . "msg WHERE mid = '$mid'");
		}

		Success('messages?p=' . $page);
	}


	public function index(){
		$NumPerPage = 20;
		$page = ForceIntFrom('p', 1);
		$search = ForceStringFrom('s');
		$groupid = ForceStringFrom('g');

		if(IsGet('s')) $search = urldecode($search);

		$start = $NumPerPage * ($page-1);

		SubMenu('记录列表', array(array('记录列表', 'messages', 1)));

		TableHeader('搜索及快速删除');

		TableRow('<center><form method="post" action="'.BURL('messages').'" name="searchmessages" style="display:inline-block;*display:inline;"><label>关键字:</label>&nbsp;<input type="text" name="s" size="18">&nbsp;&nbsp;&nbsp;<label>分类:</label>&nbsp;<select name="g"><option value="0">全部</option><option value="1" ' . Iif($groupid == '1', 'SELECTED') . ' class=red>客人的发言</option><option value="2" ' . Iif($groupid == '2', 'SELECTED') . '>客服的发言</option></select>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="搜索记录" class="cancel"></form>

		<form method="post" action="'.BURL('messages/fastdelete').'" name="fastdelete" style="display:inline-block;margin-left:80px;*display:inline;"><label>快速删除记录:</label>&nbsp;<select name="days"><option value="0">请选择 ...</option><option value="360">12个月前的对话记录</option><option value="180">&nbsp;6 个月前的对话记录</option><option value="90">&nbsp;3 个月前的对话记录</option><option value="30">&nbsp;1 个月前的对话记录</option></select>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="快速删除" class="save" onclick="var _me=$(this);showDialog(\'确定删除所选记录吗?\', \'确认操作\', function(){_me.closest(\'form\').submit();});return false;"></form></center>');
		
		TableFooter();

		if($search){
			if(preg_match("/^[1-9][0-9]*$/", $search)){
				$s = ForceInt($search);
				$searchsql = " WHERE (mid = '$s' OR fromid = '$s' OR toid = '$s') "; //按ID搜索
				$title = "搜索ID号为: <span class=note>$s</span> 的记录";
			}else{
				$searchsql = " WHERE (fromname LIKE '%$search%' OR toname LIKE '%$search%' OR msg LIKE '%$search%') ";
				$title = "搜索: <span class=note>$search</span> 的记录列表";
			}

			if($groupid) {
				if($groupid == 1 OR $groupid == 2){
					$searchsql .= " AND type = " . Iif($groupid == 1, 0, 1)." ";
					$title = "在 <span class=note>" .Iif($groupid == 1, '客人的发言', '客服的发言'). "</span> 中, " . $title;
				}
			}
		}else if($groupid){
			if($groupid == 1 OR $groupid == 2){
				$searchsql .= " WHERE type = " . Iif($groupid == 1, 0, 1)." ";
				$title = "全部 <span class=note>" .Iif($groupid == 1, '客人的发言', '客服的发言'). "</span> 列表";
			}
		}else{
			$searchsql = '';
			$title = '全部记录列表';
		}

		$getmessages = APP::$DB->query("SELECT * FROM " . TABLE_PREFIX . "msg ".$searchsql." ORDER BY mid DESC LIMIT $start,$NumPerPage");

		$maxrows = APP::$DB->getOne("SELECT COUNT(mid) AS value FROM " . TABLE_PREFIX . "msg ".$searchsql);

		echo '<form method="post" action="'.BURL('messages/updatemessages').'" name="messagesform">
		<input type="hidden" name="p" value="'.$page.'">';

		TableHeader($title.'('.$maxrows['value'].'个)');

		//TableRow(array('ID', '发送人', '接收人', '对话内容', '记录时间', '<input type="checkbox" id="checkAll" for="deletemids[]"> <label for="checkAll">删除</label>'), 'tr0');
		echo '<tr class="tr0"><td class=td>ID</td><td class=td>发送人</td><td class=td>接收人</td><td class="td" width="50%">对话内容</td><td class=td>记录时间</td><td class="td last"><input type="checkbox" id="checkAll" for="deletemids[]"> <label for="checkAll">删除</label></td></tr>';

		if($maxrows['value'] < 1){
			TableRow('<center><BR><font class=redb>未搜索到任何记录!</font><BR><BR></center>');
		}else{
			while($msg = APP::$DB->fetch($getmessages)){
				TableRow(array($msg['mid'],

				"<a title=\"编辑\" href=\"" . Iif($msg['type'], BURL('users/edit?aid='.$msg['fromid']), BURL('guests/edit?gid='.$msg['fromid'])) . "\">$msg[fromname]</a>",

				"<a title=\"编辑\" href=\"" . Iif($msg['type'], BURL('guests/edit?gid='.$msg['toid']), BURL('users/edit?aid='.$msg['toid'])) . "\">$msg[toname]</a>",

				Iif($msg['filetype'] == '1', $this->getImage($msg['msg']), getSmile($msg['msg'])),

				DisplayDate($msg['time'], '', 1),

				'<input type="checkbox" name="deletemids[]" value="' . $msg['mid'] . '">'));
			}

			$totalpages = ceil($maxrows['value'] / $NumPerPage);

			if($totalpages > 1){
				TableRow(GetPageList(BURL('messages'), $totalpages, $page, 10, 's', urlencode($search), 'g', $groupid));
			}

		}

		TableFooter();

		PrintSubmit('删除记录', '', 1, '确定删除所选记录吗?');
	}


	//解析图片
	private function getImage($msg){
		if(!$msg) return '';

		$img = explode('|', $msg);

		$img_src = $img[0];
		$img_w = $img[1];
		$img_h = $img[2];

		return '<img src="' . SYSDIR . 'upload/img/' . $img_src . '" class="img_upload" onclick="show_big_img(this, ' . $img_w . ', ' . $img_h . ');return false;">';
	}

} 

?>