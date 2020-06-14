<?php if(!defined('ROOT')) die('Access denied.');

class c_robot extends Admin{

	public function __construct($path){
		parent::__construct($path);

		$this->CheckAction();
	}


	public function index(){

		echo '<div style="font-size:13px;width:460px; border:1px solid #acacac;background:#ddd;margin:160px auto;padding:8px;border-radius: 6px;line-height:24px;text-shadow:1px 1px 0 #efefef;">
		<ul>
		<li>1)&nbsp; 感谢您选择并使用WeLive5企业级在线客服系统!</li>
		<li>2)&nbsp; WeLive5免费版主要是针对个人用户使用, 功能受限, 如需要请选择商业版.</li>
		<li>3)&nbsp; WeLive5商业授权版较免费版增加三大功能: <font color="#ff6600"><BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A. H5客服移动端, 即客服人员可以使用移动设备;<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B. 上传图片或文件, 以及客服授权访客上传功能;<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C. 无人值守、智能机器人自动回复功能.</font></li>
		<li>4)&nbsp; WeLive5商业授权版统一售价 <span class=blueb>1680</span> 元, 一次性付费, 永久使用.</li>
		<li>5)&nbsp; 购买商业授权版: QQ <span class=note>20577229</span> (加入时请注明: <span class=note>WeLive5商业版</span>) <BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;或致电: <a href="http://www.weensoft.cn/" target="_blank">为因软件</a> <BR><BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;感谢您的支持!</li>
		</ul></div>';
		
	}


} 

?>