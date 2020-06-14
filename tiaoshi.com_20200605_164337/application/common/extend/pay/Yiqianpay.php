<?php
namespace app\common\extend\pay;

class yiqianpay {

    public $name = '易千支付';
    public $ver = '1.0';

    public function submit($user,$order,$param)
    {	
		
		$pay_memberid = $GLOBALS['config']['pay']['yiqianpay']['appid'];   //商户后台API管理获取
		$pay_orderid = $order['order_code'];    //订单号
		$pay_amount = $order['order_price'];    //交易金额
		$pay_applydate = date("Y-m-d H:i:s");  //订单时间
		$pay_notifyurl = $GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . '/index.php/payment/notify/pay_type/yiqianpay';;   //服务端返回地址
		$pay_callbackurl = $GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . '/index.php/payment/href/pay_type/yiqianpay';;  //页面跳转返回地址
		$Md5key = $GLOBALS['config']['pay']['yiqianpay']['appkey'];   //商户后台API管理获取
		$tjurl = $GLOBALS['config']['pay']['yiqianpay']['act'];   //提交地址
		$pay_bankcode = $_POST['paytype']; //支付宝扫码  //商户后台通道费率页 获取银行编码
		$native = array(
			"pay_memberid" => $pay_memberid,
			"pay_orderid" => $pay_orderid,
			"pay_amount" => $pay_amount,
			"pay_applydate" => $pay_applydate,
			"pay_bankcode" => $pay_bankcode,
			"pay_notifyurl" => $pay_notifyurl,
			"pay_callbackurl" => $pay_callbackurl,
		);
		ksort($native);
		$md5str = "";
		foreach ($native as $key => $val) {
			$md5str = $md5str . $key . "=" . $val . "&";
		}
		//echo($md5str . "key=" . $Md5key);
		$sign = strtoupper(md5($md5str . "key=" . $Md5key));
		$native["pay_md5sign"] = $sign;
		$native['pay_attach'] = "";
		$native['pay_productname'] ='在线充值';
		$sHtml = "<form id='youbaopaysubmit' name='youbaopaysubmit' action='".$tjurl."' method='POST' >";
		foreach ($native as $key => $val) {
			$sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
		}
		$sHtml.= "</form>";
		$sHtml.= "<script>document.forms['youbaopaysubmit'].submit();</script>";
		echo $sHtml;
    }

	public function notify()
    {
		
		$returnArray = array( // 返回字段
            "memberid" => $_REQUEST["memberid"], // 商户ID
            "orderid" =>  $_REQUEST["orderid"], // 订单号
            "amount" =>  $_REQUEST["amount"], // 交易金额
            "datetime" =>  $_REQUEST["datetime"], // 交易时间
            "transaction_id" =>  $_REQUEST["transaction_id"], // 支付流水号
            "returncode" => $_REQUEST["returncode"],
        );
        $md5key = $GLOBALS['config']['pay']['yiqianpay']['appkey'];
        ksort($returnArray);
        reset($returnArray);
        $md5str = "";
        foreach ($returnArray as $key => $val) {
            $md5str = $md5str . $key . "=" . $val . "&";
        }
        $sign = strtoupper(md5($md5str . "key=" . $md5key));
        if ($sign == $_REQUEST["sign"]) {
            if ($_REQUEST["returncode"] == "00") {
                   $str = "交易成功！订单号：".$_REQUEST["orderid"];
              	   $orderid = trim($_REQUEST['orderid']);
                   file_put_contents("success.txt",$str."\n", FILE_APPEND);
				   $res = model('Order')->notify($orderid,'yiqianpay');
                   exit("OK");
            }
        }else{
			exit("fail");
		}
	}
	
	public function href()
    {
		
		$returnArray = array( // 返回字段
            "memberid" => $_REQUEST["memberid"], // 商户ID
            "orderid" =>  $_REQUEST["orderid"], // 订单号
            "amount" =>  $_REQUEST["amount"], // 交易金额
            "datetime" =>  $_REQUEST["datetime"], // 交易时间
            "transaction_id" =>  $_REQUEST["transaction_id"], // 支付流水号
            "returncode" => $_REQUEST["returncode"],
        );
        $md5key = $GLOBALS['config']['pay']['yiqianpay']['appkey'];
        ksort($returnArray);
        reset($returnArray);
        $md5str = "";
        foreach ($returnArray as $key => $val) {
            $md5str = $md5str . $key . "=" . $val . "&";
        }
        $sign = strtoupper(md5($md5str . "key=" . $md5key));
        if ($sign == $_REQUEST["sign"]) {
            if ($_REQUEST["returncode"] == "00") {
                   $str = "交易成功！订单号：".$_REQUEST["orderid"];
                  header("Location: ".$GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . "/index.php/user/upgrade.html"); 
            }
        }else{
			exit("fail");
		}
	}
    
}
