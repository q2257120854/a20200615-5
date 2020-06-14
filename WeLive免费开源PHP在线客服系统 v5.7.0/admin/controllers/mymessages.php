<?php if(!defined('ROOT')) die('Access denied.');

class c_mymessages extends Admin{

	public function __construct($path){
		parent::__construct($path);

	}

	public function index(){
		$myid = $this->admin['aid'];

		$NumPerPage = 20;
		$page = ForceIntFrom('p', 1);
		$search = ForceStringFrom('s');
		$groupid = ForceStringFrom('g');

		if(IsGet('s')) $search = urldecode($search);

		$start = $NumPerPage * ($page-1);

		SubMenu('我的对话记录', array(array('记录列表', 'mymessages', 1)));

		TableHeader('搜索对话记录');

		TableRow('<center><form method="post" action="'.BURL('mymessages').'" name="search" style="display:inline-block;"><label>关键字:</label>&nbsp;<input type="text" name="s" size="18">&nbsp;&nbsp;&nbsp;<label>分类:</label>&nbsp;<select name="g"><option value="0">全部</option><option value="1" ' . Iif($groupid == '1', 'SELECTED') . ' class=red>客人的发言</option><option value="2" ' . Iif($groupid == '2', 'SELECTED') . '>我的发言</option></select>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="搜索记录" class="cancel"></form></center>');
		
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
					$searchsql .= " AND (" . Iif($groupid == 1, "type = 0 AND toid = '$myid'", "type = 1 AND fromid = '$myid'") . ") ";
					$title = "在 <span class=note>" .Iif($groupid == 1, '客人的发言', '我的发言'). "</span> 中, " . $title;
				}
			}else{
					$searchsql .= " AND ((type = 1 AND fromid = '$myid') OR (type = 0 AND toid = '$myid')) ";
			}
		}else if($groupid){
			if($groupid == 1 OR $groupid == 2){
				$searchsql .= " WHERE " . Iif($groupid == 1, "type = 0 AND toid = '$myid' ", "type = 1 AND fromid = '$myid' ");
				$title = "全部 <span class=note>" .Iif($groupid == 1, '客人的发言', '我的发言'). "</span> 列表";
			}
		}else{
			$searchsql = " WHERE (type = 1 AND fromid = '$myid') OR (type = 0 AND toid = '$myid') ";
			$title = '全部记录列表';
		}

		$getmy = APP::$DB->query("SELECT * FROM " . TABLE_PREFIX . "msg " . $searchsql . " ORDER BY mid DESC LIMIT $start,$NumPerPage");

		$maxrows = APP::$DB->getOne("SELECT COUNT(mid) AS value FROM " . TABLE_PREFIX . "msg " . $searchsql);

		TableHeader($title . '(' . $maxrows['value'] . '个)');

		//TableRow(array('ID', '发送人', '接收人', '对话内容', '记录时间'), 'tr0');
		echo '<tr class="tr0"><td class=td>ID</td><td class=td>发送人</td><td class=td>接收人</td><td class="td" width="50%">对话内容</td><td class="td last">记录时间</td></tr>';

		if($maxrows['value'] < 1){
			TableRow('<center><BR><font class=redb>未搜索到任何记录!</font><BR><BR></center>');
		}else{
			while($msg = APP::$DB->fetch($getmy)){
				TableRow(array($msg['mid'],
				$msg['fromname'],

				$msg['toname'],

				Iif($msg['filetype'] == '1', $this->getImage($msg['msg']), getSmile($msg['msg'])),

				DisplayDate($msg['time'], '', 1)));
			}

			$totalpages = ceil($maxrows['value'] / $NumPerPage);

			if($totalpages > 1){
				TableRow(GetPageList(BURL('mymessages'), $totalpages, $page, 10, 's', urlencode($search), 'g', $groupid));
			}

		}

		TableFooter();

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