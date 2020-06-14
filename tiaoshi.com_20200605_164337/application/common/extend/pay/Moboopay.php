<?php
namespace app\common\extend\pay;

class moboopay {

    public $name = 'MO支付宝';
    public $ver = '1.0';

    public function submit($user,$order,$param)
    {	
		//乐支付商户ID
		$aiyang_merchant_id		= $GLOBALS['config']['pay']['moboopay']['appid'];
		//乐支付通信密钥
		$aiyang_merchant_key		= $GLOBALS['config']['pay']['moboopay']['appkey'];
		
		//======================网银支付配置=================================
		//接收乐支付网银支付接口的地址
		$aiyang_bank_callback_url	= $GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . '/index.php/payment/notify/pay_type/moboopay'; 
		
		//网银支付跳转回的页面地址
		$aiyang_bank_hrefbackurl	= $GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . '/index.php/payment/href/pay_type/moboopay';
		
		$order_id = $order['order_code']; //您的订单Id号，你必须自己保证订单号的唯一性，乐支付不会限制该值的唯一性
		$payType = 'bank';  //充值方式：bank为网银，card为卡类支付
		$account = $_POST['account'];  //充值的账号
		$amount = $order['order_price'];//充值的金额
		
		//网银支付
		if ('bank' == $payType) {
			//$bankType = $_POST['paytype'];   //银行类型
         	 $bankType = "992";   //银行类型
			
			//@include_once(ROOT_PATH ."/application/common/extend/pay/moboopay/config/pay_config.php");
			@include_once(ROOT_PATH ."/application/common/extend/pay/moboopay/aiyang/class.bankpay.php");
			$bankpay = new \bankpay();
			$bankpay->parter = $aiyang_merchant_id;  //商家Id
			$bankpay->key = $aiyang_merchant_key; //商家密钥
			$bankpay->type = $bankType;   //商家密钥
			$bankpay->value = $amount;    //提交金额
			$bankpay->orderid = $order_id;   //订单Id号
			$bankpay->callbackurl = $aiyang_bank_callback_url; //下行url地址
			$bankpay->hrefbackurl = $aiyang_bank_hrefbackurl; //下行url地址
			//发送
			$bankpay->send();
		}

		
    }

	public function notify()
    {
		
		//乐支付商户ID
		$aiyang_merchant_id		= $GLOBALS['config']['pay']['moboopay']['appid'];
		//乐支付通信密钥
		$aiyang_merchant_key		= $GLOBALS['config']['pay']['moboopay']['appkey'];
		
		//======================网银支付配置=================================
		//接收乐支付网银支付接口的地址
		$aiyang_bank_callback_url	= $GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . '/index.php/payment/notify/pay_type/moboopay'; 
		
		//网银支付跳转回的页面地址
		$aiyang_bank_hrefbackurl	= $GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . '/index.php/payment/href/pay_type/moboopay';
		@require_once(ROOT_PATH ."/application/common/extend/pay/moboopay/aiyang/class.bankpay.php");

		//获取返回的下行数据
		$orderid        = trim($_GET['orderid']);
		$opstate        = trim($_GET['opstate']);
		$ovalue         = trim($_GET['ovalue']);
		$sysorderid		= trim($_GET['sysorderid']);
		$completiontime		= trim($_GET['systime']);

		//进行优卡签名认证
		$bankpay		= new \bankpay();
		$bankpay->key	= $aiyang_merchant_key;
		$bankpay->recive();

		//////////////////////////////////////////////////////////////////////////
		// 进入到这一步，说明签名已经验证成功，
		// 你可以在这里加入自己的代码, 例如：可以将处理结果存入数据库


		$res = model('Order')->notify($orderid,'moboopay');



		//////////////////////////////////////////////////////////////////////////
		//完成之后返回成功
		/*
			协议:
			0 成功
			-1 请求参数无效
			-2 签名错误
		*/
		die("opstate=0");
	}
	public function href()
    {
		
		//乐支付商户ID
		$aiyang_merchant_id		= $GLOBALS['config']['pay']['moboopay']['appid'];
		//乐支付通信密钥
		$aiyang_merchant_key		= $GLOBALS['config']['pay']['moboopay']['appkey'];
		
		//======================网银支付配置=================================
		//接收乐支付网银支付接口的地址
		$aiyang_bank_callback_url	= $GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . '/index.php/payment/notify/pay_type/moboopay'; 
		
		//网银支付跳转回的页面地址
		$aiyang_bank_hrefbackurl	= $GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . '/index.php/payment/href/pay_type/moboopay';
		@require_once(ROOT_PATH ."/application/common/extend/pay/moboopay/aiyang/class.bankpay.php");

		//获取返回的下行数据
		$orderid        = trim($_GET['orderid']);
		$opstate        = trim($_GET['opstate']);
		$ovalue         = trim($_GET['ovalue']);
		$sysorderid		= trim($_GET['sysorderid']);
		$completiontime		= trim($_GET['systime']);

		//进行优卡签名认证
		$bankpay		= new \bankpay();
		$bankpay->key	= $aiyang_merchant_key;
		$bankpay->recive();

		//////////////////////////////////////////////////////////////////////////
		// 进入到这一步，说明签名已经验证成功，
		// 你可以在这里加入自己的代码, 例如：可以将处理结果存入数据库

		header("Location: ".$GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . "/index.php/user/upgrade.html"); 



		//////////////////////////////////////////////////////////////////////////
		//完成之后返回成功
		/*
			协议:
			0 成功
			-1 请求参数无效
			-2 签名错误
		*/
		die("opstate=0");
	}
    
}
