<?php
/**
 * ====================================================================================
 *                           某某短域名系统
 * ----------------------------------------------------------------------------------
 *  @copyright - This software is exclusively sold at CodeCanyon.net. If you have downloaded this
 *  from another site or received it from someone else than me, then you are engaged
 *  in illegal activity. You must delete this software immediately or buy a proper
 *  license from www.yunziyuan.com.cn
 *
 *	@license http://www.yunziyuan.com.cn/license
 *
 *  Thank you for your cooperation and don't hesitate to contact me if anything :)
 * ====================================================================================
 *
 * @author 某某 (http://www.yunziyuan.com.cn)
 * @link http://www.yunziyuan.com.cn
 * @package 某某短域名系统
 * @subpackage Dispatch Admin
 */
	
	require_once(dirname(dirname(__FILE__))."/includes/config.php");	

	// Set up some admin variables
	include (ROOT."/includes/Admin.class.php");	
	$admin = new Admin($config,$db);
	$admin->run();	
	
?>