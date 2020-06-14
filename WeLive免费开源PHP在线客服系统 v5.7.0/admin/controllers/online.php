<?php if(!defined('ROOT')) die('Access denied.');

class c_online extends Admin{

	public function __construct($path){
		parent::__construct($path);

	}


	public function index(){
		$smilies = ''; //表情图标
		for($i = 0; $i < 24; $i++){
			$smilies .= '<img src="' . SYSDIR . 'public/smilies/' . $i . '.png" onclick="insertSmilie(' . $i . ', towhere);">';
		}

		$myid = $this->admin['aid'];
		$phrases = ''; //中文常用短语
		$phrases_en = ''; //英文常用短语
		$getphrases = APP::$DB->getAll("SELECT msg, msg_en FROM " . TABLE_PREFIX . "phrase WHERE aid = '$myid' AND activated =1 ORDER BY sort DESC");

		$getphrases = array_reverse($getphrases, true); //数组反转一下
		foreach($getphrases AS $k => $phrase){
			$phrases .= '<li onclick="insertPhrase(this, towhere);"><i>●</i><b>' . $phrase['msg'] . '</b></li>';
			$phrases_en .= '<li onclick="insertPhrase(this, towhere);"><i>●</i><b>' . $phrase['msg_en'] . '</b></li>';
		}

		if(!$phrases) {
			$phrases = '<li>暂未添加常用短语!</li>';
			$phrases_en = '<li>暂未添加常用短语!</li>';
		}

		echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="100%"><div class="guest_div"><div class="g_title">访客<div><b class="online_guests">0</b>/<b class="total_guests">0</b></div></div><div id="g"></div></div></td>
<td>
<div id="s_chat_num" style="display:none;" title="点击展开">客服: <b>0</b></div>
<div id="s_chat">
	<div class="s_title" title="点击收拢"><div class="l">客服交流</div><div class="s_toggle"></div><div class="r"><b class="s_admins">0</b> 位在线</div></div>
	<div class="s_mid">
		<div id="s_hwrap" class="loading3">
			<div class="scb_scrollbar scb_radius"><div class="scb_tracker"><div class="scb_mover scb_radius"></div></div></div>
			<div class="viewport">
				<div class="overview">
					<div class="i"><b></b>服务器连接中 ...</div>
				</div>
			</div>
		</div>
		<div id="s_owrap">
			<div class="scb_scrollbar scb_radius"><div class="scb_tracker"><div class="scb_mover scb_radius"></div></div></div>
			<div class="viewport">
				<div class="overview"></div>
			</div>
		</div>
	</div>
	<div class="s_bott">
		<div class="s_face"></div>
		<input name="s_msg" placeholder="Enter to send" type="text" class="s_msg">
		<a class="s_send" title="发送"></a>
		<a id="wl_ring" class="s_ring" title="声音"></a>
	</div>
</div>
</td>
</tr>
</table>
<input type="file" name="file" id="upload_img" accept="image/jpg,image/jpeg,image/gif,image/png" style="width:1px;height:1px;display:none;overflow:hidden;">
<div id="wl_sounder" style="width:1px;height:1px;visibility:hidden;overflow:hidden;"></div>
<div class="smilies_div" style="display:none"><div class="smilies_wrap">' . $smilies . '</div></div>
<div class="phrases_div" style="display:none"><div class="phrases_wrap">' . $phrases . '</div></div>
<div class="phrasesen_div" style="display:none"><div class="phrases_wrap">' . $phrases_en . '</div></div>';
	}

} 

?>