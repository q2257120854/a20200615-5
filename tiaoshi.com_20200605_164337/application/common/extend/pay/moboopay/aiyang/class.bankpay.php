<?php
/*
===============================================================================
类：bankpay 优卡网银支付接口调用
属性：
	$parter
		商户id，由优卡联盟分配
	$type
		准备使用网银支付的银行，约定如下		
			962	中信银行|银行卡支付（全国范围）
			963	中国银行|银行卡支付（全国范围）
			964	中国农业银行|网上银行签约客户（全国范围）
			965	中国建设银行|网上银行签约客户（全国范围）
			966	中国工商银行|工行手机支付（仅限工行手机签约客户）
			967	中国工商银行|网上签约注册用户（全国范围）
			968	浙商银行|银行卡支付（全国范围）
			969	浙江稠州商业银行|浙江稠州商业银行（全国范围）
			970	招商银行|银行卡支付（全国范围）
			971	邮政储蓄|银联网上支付签约客户（全国范围）
			972	兴业银行|在线兴业（全国范围）
			973	顺德农村信用合作社|顺德信用合作社借记卡（顺德地区）
			974	深圳发展银行|发展卡支付（全国范围）
			975	上海银行|银行卡支付（全国范围）
			976	上海农村商业银行|如意借记卡（上海地区）
			977	浦东发展银行|东方卡（全国范围）
			978	平安银行|平安借记卡（全国范围）
			979	南京银行|银行卡支付（全国范围）
			980	民生银行|民生卡（全国范围）
			981	交通银行|太平洋卡（全国范围）
			982	华夏银行|华夏借记卡（全国范围）
			983	杭州银行|银行卡支付（全国范围）
			984	广州市农村信用社|麒麟借记卡（广州地区）,广州市商业银行|羊城万事顺卡借记卡（广州地区）
			985	广东发展银行|银行卡支付（全国范围）
			986	光大银行|银行卡支付（全国范围）
			987	东亚银行|银行卡支付（全国范围）
			988	渤海银行|银行卡支付（全国范围）
			989	北京银行|北京银行(全国范围)
			990	北京农村商业银行|银行卡支付（全国范围）
			992  支付宝
			993  财付通		
	$value
		支付金额，单位元（人民币），保留2位小数。最小金额为0.02。
	$orderid
		请求发起方自己的订单号，该订单号将作为优卡的返回数据
	$callbackurl
		在下行过程中返回结果的地址，需要以http://开头
	$hrefbackurl
		支付完成之后优卡会自动跳转回到的页面
	$key
		商户密钥
		
函数:
	send()
		发送到优卡网银消费接口
	
===============================================================================
*/
require_once("init.php");
class bankpay{
	/*
	* 优卡网银支付接口URL
	*/
	const aiyang_bank_url	= 'http://pay.scdijie.net:1212/pay.aspx';
	
	/*
	* 商户id，由优卡联盟分配
	*/
	var $parter;
	
	/*
	* 准备使用网银支付的银行
	*/
	var $type;
	
	/*
	* 支付金额
	*/
	var $value;
	
	/*
	* 请求发起方自己的订单号，该订单号将作为优卡的返回数据
	*/
	var $orderid;
	
	/*
	* 在下行过程中返回结果的地址，需要以http://开头。
	*/
	var $callbackurl;
	
	/*
	* 支付完成之后优卡会自动跳转回到的页面
	*/
	var $hrefbackurl;
	
	/*
	* 商户密钥
	*/
	var $key;
	
	
	/*
	*构造函数
	*/
	public function bankpay(){
		
	}
	
	/*
	///发送到优卡网银消费接口
	*/
	public function send(){
		//检查是否正确
		$error 	= 0;
		$msg		= '您调用优卡网银支付接口的参数有误，错误信息如下：';
		if(empty($this->parter)){
			$error 	= 1;
			$msg 	.= '<li>parter不能为空: 商户id，由优卡联盟分配</li>';
		}
		if(empty($this->type)){
			$error 	= 1;
			$msg 	.= '<li>type不能为空: 网银种类</li>';
		}
		if(empty($this->value)){
			$error 	= 1;
			$msg 	.= '<li>value提交有误: 支付金额</li>';
		}
		if(empty($this->callbackurl)){
			$error 	= 1;
			$msg 	.= '<li>callbackurl不能为空：下行过程中返回结果的地址</li>';
		}
		if(empty($this->orderid)){
			$error 	= 1;
			$msg 	.= '<li>orderid不能为空：订单号</li>';
		}
		if(empty($this->key)){
			$error 	= 1;
			$msg 	.= '<li>key不能为空：商户密钥</li>';
		}
		//若提交参数有误，则提示错误信息
		if($error){
			die($msg);
		}
	
		//
		$url = "parter=". $this->parter ."&type=". $this->type ."&value=". $this->value. "&orderid=". $this->orderid ."&callbackurl=". $this->callbackurl;
		//签名
		$sign	= md5($url. $this->key);
		
		//最终url
		$url	= bankpay::aiyang_bank_url . "?" . $url . "&sign=" .$sign. "&hrefbackurl=". $this->hrefbackurl;				
		
		//页面跳转
		header("location:" .$url);
	}
	
	
	/*
	///接收优卡消息，这会判断签名是否正确
	*/
	public function recive(){
		header('Content-Type:text/html;charset=GB2312');
		$orderid        = trim($_GET['orderid']);
		$opstate        = trim($_GET['opstate']);
		$ovalue         = trim($_GET['ovalue']);
		$sign           = trim($_GET['sign']);
		
		//订单号为必须接收的参数，若没有该参数，则返回错误
		if(empty($orderid)){
			die("opstate=-1");		//签名不正确，则按照协议返回数据
		}
		
		$sign_text	= "orderid=$orderid&opstate=$opstate&ovalue=$ovalue".$this->key;
		$sign_md5 = md5($sign_text);
		if($sign_md5 != $sign){
			die("opstate=-2");		//签名不正确，则按照协议返回数据
		}	
	}
	
}
?>