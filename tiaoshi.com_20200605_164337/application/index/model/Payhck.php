<?php
namespace app\index\model;
use think\Db;

class Payhck extends Base {

    var $_config;
    public function submit($user,$order,$param)
    {
        echo '接口暂时关闭';
        die;
        $pay_type = 1;
        if(!empty($param['paytype'])){
            $pay_type = intval($param['paytype']);
        }

        //组装参数
        $data = array(
            "pid" => trim( $GLOBALS['config']['pay']['hck']['appid'] ),//你的APPID
            "type" => $pay_type,//alipay:支付宝,tenpay:财付通,qqpay:QQ钱包,wxpay:微信支付
            "money" => $order['order_price'],//金额100元
            "out_trade_no" => $order['order_code'], //唯一标识 可以是用户ID,用户名,session_id(),订单ID,ip 付款后返回
            "notify_url" => $this->_http_type . $_SERVER['SERVER_NAME'] . '/index.php/payment/notify/pay_type/hck',//通知地址
            "return_url" => $this->_http_type . $_SERVER['SERVER_NAME'] . '/index.php/payment/notify/pay_type/hck',//跳转地址
            "sitename"=> $GLOBALS['config']['site']['site_name'],
            "name" => '会员充值',
        );

        $para = $this->buildRequestPara($data);
        $sHtml = "<form id='hcksubmit' name='hcksubmit' action='https://cms.hckpay.cn/submit.php' method='POST'>";
        while (list ($key, $val) = each ($para)) {
            $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
        }
        //submit按钮控件请不要含有name属性
        $sHtml = $sHtml."<input type='submit' value='正在提交'></form>";
        $sHtml = $sHtml."<script>document.forms['hcksubmit'].submit();</script>";
        echo $sHtml;
        die;
    }

    public function notify()
    {
        echo '接口暂时关闭';
        die;
        $param = input();
        $GLOBALS['config']['pay'] = config('maccms.pay');
        unset($param['/payment/notify/pay_type/hck']);
        unset($param['pay_type']);

        $isSign = $this->getSignVeryfy($param, $param["sign"]);
        //验证成功
        if($isSign) {
            if ($param['trade_status'] == 'TRADE_SUCCESS') {
                $res = model('Order')->notify($param['out_trade_no'],'hck');
                if($res['code']>1){
                    echo "fail";
                }
                else{
                    echo "success";
                }
            }
            else {
                echo "success";
            }
        }else{
            echo "fail";
        }
    }



    public function buildRequestPara($para_temp) {
        //除去待签名参数数组中的空值和签名参数
        $para_filter = $this->paraFilter($para_temp);

        //对待签名参数数组排序
        $para_sort = $this->argSort($para_filter);

        //生成签名结果
        $mysign = $this->buildRequestMysign($para_sort);

        //签名结果与签名方式加入请求提交参数组中
        $para_sort['sign'] = $mysign;
        $para_sort['sign_type'] = 'MD5';

        return $para_sort;
    }

    public function paraFilter($para) {
        $para_filter = array();
        while (list ($key, $val) = each ($para)) {
            if($key == "sign" || $key == "sign_type" || $val == "")continue;
            else	$para_filter[$key] = $para[$key];
        }
        return $para_filter;
    }

    public function argSort($para) {
        ksort($para);
        reset($para);
        return $para;
    }

    public function buildRequestMysign($para_sort) {
        //把数组所有元素，按照"参数=参数值"的模式用"&"字符拼接成字符串
        $prestr = $this->createLinkstring($para_sort);

        $mysign = $this->md5Sign($prestr, $GLOBALS['config']['pay']['hck']['appkey']);

        return $mysign;
    }

    public function createLinkstring($para) {
        $arg  = "";
        while (list ($key, $val) = each ($para)) {
            $arg.=$key."=".$val."&";
        }
        //去掉最后一个&字符
        $arg = substr($arg,0,count($arg)-2);

        //如果存在转义字符，那么去掉转义
        if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

        return $arg;
    }

    public function md5Sign($prestr, $key) {
        $prestr = $prestr . $key;
        return md5($prestr);
    }

    public function getSignVeryfy($para_temp, $sign) {
        //除去待签名参数数组中的空值和签名参数
        $para_filter = $this->paraFilter($para_temp);

        //对待签名参数数组排序
        $para_sort = $this->argSort($para_filter);

        //把数组所有元素，按照"参数=参数值"的模式用"&"字符拼接成字符串
        $prestr = $this->createLinkstring($para_sort);

        $isSgin = false;
        $isSgin = $this->md5Verify($prestr, $sign, $GLOBALS['config']['pay']['hck']['appkey']);

        return $isSgin;
    }

    public function md5Verify($prestr, $sign, $key) {
        $prestr = $prestr . $key;
        $mysgin = md5($prestr);
        if($mysgin == $sign) {
            return true;
        }
        else {
            return false;
        }
    }
}
