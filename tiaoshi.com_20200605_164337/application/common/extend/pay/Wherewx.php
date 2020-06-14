<?php
namespace app\common\extend\pay;

class Wherewx {

    public $name = 'Wherewx';
    public $ver = '1.0';

    public function submit($user,$order,$param)
    {
        $pay_type = 1;
        if(!empty($param['paytype'])){
            $pay_type = intval($param['paytype']);
        }

		$data = array(
			'type' => $param['cz_type'],
			'money' => $order['order_price'],
			'name' => '投诉售后QQ:2378693164-影视收款',
			'order' =>  $order['order_code'],
            'type' => 'alipay',
          
           // 'notify_url' => $GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . '/index.php/payment/notify/pay_type/Wherewx',//通知地址
           //'return_url' => $GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . '/index.php/payment/notify/pay_type/Wherewx',//跳转地址
		);
        ksort($data); //重新排序$data数组
        reset($data); //内部指针指向数组中的第一个元素

        $sign = ''; //初始化需要签名的字符为空
        $urls = array(); //初始化URL参数为空

        foreach ($data as $key => $val) { //遍历需要传递的参数
         
            $urls[] .= "$key=" . urlencode($val); //拼接为url参数形式并URL编码参数值
        }
		$query = implode('&',$urls);
        $url = "/demo/Wwx/epayapi.php?{$query}"; //支付页面

        mac_redirect($url);
    }

    public function notify()
    {
        $param = $_GET;
		if(0){
			$rs['get'] = $_GET;
			$rs['post'] = $_POST;
			file_put_contents('./1.txt',json_encode($rs));
			echo 'success';
			die();
			/*
			
			"get": {
				"money": "10.00",
				"name": "\u5f71\u89c6\u6536\u6b3e",
				"out_trade_no": "PAY20190716152951246848",
				"pid": "19681",
				"trade_no": "2019071616260180139",
				"trade_status": "TRADE_SUCCESS",
				"type": "alipay",
				"sign": "150eafca08fc44b1f4a5912fb601ff50",
				"sign_type": "MD5"
			},
			*/
		}
        // $post['pay_id'] 这是付款人的唯一身份标识或订单ID
        // $post['pay_no'] 这是流水号 没有则表示没有付款成功 流水号不同则为不同订单
        // $post['money'] 这是付款金额
        // $post['param'] 这是自定义的参数


        $sign = '';
  
		$res = model('Order')->notify($param['out_trade_no'],'Wherewx');
		if($res['code'] >1){
			echo 'fail2';
		}
		else {
			echo 'success';
		}
    }
}