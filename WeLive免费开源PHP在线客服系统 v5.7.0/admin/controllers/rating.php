<?php if(!defined('ROOT')) die('Access denied.');

class c_rating extends Admin{

	public function __construct($path){
		parent::__construct($path);

		$this->CheckAction();
	}


	//快速删除评价
	public function fastdelete(){
		$days = ForceIntFrom('days');

		if(!$days) Error('请选择删除期限!');

		$time = time() - $days * 24 * 3600;

		APP::$DB->exe("DELETE FROM " . TABLE_PREFIX . "rating WHERE time < $time");

		Success('rating');
	}

	//批量更新评价
	public function updaterating(){
		$page = ForceIntFrom('p', 1);   //页码

		$deleterids = $_POST['deleterids'];

		for($i = 0; $i < count($deleterids); $i++){
			$rid = ForceInt($deleterids[$i]);
			APP::$DB->exe("DELETE FROM " . TABLE_PREFIX . "rating WHERE rid = '$rid'");
		}

		Success('rating?p=' . $page);
	}


	public function index(){
		$NumPerPage = 20;
		$page = ForceIntFrom('p', 1);
		$search = ForceIntFrom('s');
		$groupid = ForceIntFrom('g');

		if(IsGet('s')) $search = urldecode($search);

		$start = $NumPerPage * ($page-1);

		//获取所有客服
		$admins = array();
		$getadmins = APP::$DB->query("SELECT aid, fullname FROM " . TABLE_PREFIX . "admin");
		while($a = APP::$DB->fetch($getadmins)){
			$admins[$a['aid']] = $a['fullname'];
		}

		SubMenu('评价列表', array(array('评价列表', 'rating', 1)));

		TableHeader('搜索及快速删除');

		TableRow('<center><form method="post" action="'.BURL('rating').'" name="searchrating" style="display:inline-block;*display:inline;"><label>ID:</label>&nbsp;<input type="text" name="s" size="18">&nbsp;&nbsp;&nbsp;<label>分类:</label>&nbsp;<select name="g"><option value="0">全部</option><option value="1" ' . Iif($groupid == '1', 'SELECTED') . ' class=red>按客人ID搜索</option><option value="2" ' . Iif($groupid == '2', 'SELECTED') . '>按客服ID搜索</option></select>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="搜索评价" class="cancel"></form>

		<form method="post" action="'.BURL('rating/fastdelete').'" name="fastdelete" style="display:inline-block;margin-left:80px;*display:inline;"><label>快速删除评价:</label>&nbsp;<select name="days"><option value="0">请选择 ...</option><option value="360">12个月前的对话评价</option><option value="180">&nbsp;6 个月前的对话评价</option><option value="90">&nbsp;3 个月前的对话评价</option><option value="30">&nbsp;1 个月前的对话评价</option></select>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="快速删除" class="save" onclick="var _me=$(this);showDialog(\'确定删除所选评价吗?\', \'确认操作\', function(){_me.closest(\'form\').submit();});return false;"></form></center>');
		
		TableFooter();

		if($search){
			if($groupid == 2){
				$searchsql = " WHERE aid = '$search' ";
				$title = "搜索客服ID号为: <span class=note>$search</span> 的评价";
			}elseif($groupid == 1){
				$searchsql = " WHERE gid = '$search' ";
				$title = "搜索客人ID号为: <span class=note>$search</span> 的评价";
			}else{
				$searchsql = " WHERE (gid = '$search' OR aid = '$search') ";
				$title = "搜索ID号为: <span class=note>$search</span> 的评价";
			}
		}else{
			$searchsql = '';
			$title = '全部评价列表';
		}

		$getrating = APP::$DB->query("SELECT * FROM " . TABLE_PREFIX . "rating ".$searchsql." ORDER BY rid DESC LIMIT $start,$NumPerPage");

		$maxrows = APP::$DB->getOne("SELECT COUNT(rid) AS value FROM " . TABLE_PREFIX . "rating ".$searchsql);

		echo '<form method="post" action="'.BURL('rating/updaterating').'" name="ratingform">
		<input type="hidden" name="p" value="'.$page.'">';

		TableHeader($title.'('.$maxrows['value'].'个)');
		TableRow(array('ID', '客人ID', '被评价客服(ID)', '星星数', '意见建议', '评价时间', '<input type="checkbox" id="checkAll" for="deleterids[]"> <label for="checkAll">删除</label>'), 'tr0');

		if($maxrows['value'] < 1){
			TableRow('<center><BR><font class=redb>未搜索到任何评价!</font><BR><BR></center>');
		}else{
			while($msg = APP::$DB->fetch($getrating)){
				TableRow(array($msg['rid'],

				$msg['gid'],

				Iif(isset($admins[$msg['aid']]), "<a title=\"编辑客服\" href=\"" . BURL('users/edit?aid='.$msg['aid']) . "\">" . $admins[$msg['aid']] . "($msg[aid])</a>", "机器人($msg[aid])"),

				$msg['score'],

				$msg['msg'],

				DisplayDate($msg['time'], '', 1),

				'<input type="checkbox" name="deleterids[]" value="' . $msg['rid'] . '">'));
			}

			$totalpages = ceil($maxrows['value'] / $NumPerPage);

			if($totalpages > 1){
				TableRow(GetPageList(BURL('rating'), $totalpages, $page, 10, 's', urlencode($search), 'g', $groupid));
			}

		}

		TableFooter();

		PrintSubmit('删除评价', '', 1, '确定删除所选评价吗?');
	}

} 

?>