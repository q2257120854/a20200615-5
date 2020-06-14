<?php
namespace app\common\extend\pay;

class Weipay
{

    public $name = 'weipay支付';
    public $ver = '1.0';

    public function submit($user, $order, $param)
    {
        if (!empty($param['paytype'])) {
            $pay_type = $GLOBALS['config']['pay']['weipay']['tongdao'];
        }
        if ($param['paytype'] == 1) {
            $pay_type = $GLOBALS['config']['pay']['weipay']['tongdao'];
        }
        //组装参数

        $data = array(

            "version" => '1.0',

            "customerid" => $GLOBALS['config']['pay']['weipay']['appid'],

            "total_fee" => $order['order_price'],

            "sdorderno" => $order['order_code'],

            "notifyurl" => $GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . '/index.php/payment/notify/pay_type/weipay', //通知地址

            "returnurl" => $GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . '/index.php/payment/notify/pay_type/weipay', //跳转地址

            "paytype" => $pay_type,
            //"bankcode" => '',

        );
        $native = $data;
        unset($native["paytype"]);
        //unset($native["bankcode"]);
        ksort($native);
        $md5str = "";
        foreach ($native as $key => $val) {
            $md5str = $md5str . $key . "=" . $val . "&";
        }
        //echo($md5str . "key=" . $Md5key);
        $Md5key = $GLOBALS['config']['pay']['weipay']['appkey'];
        $tjurl = $GLOBALS['config']['pay']['weipay']['url'];
        $sign = strtoupper(md5($md5str . $Md5key));
        $data["sign"] = $sign = md5("version=" . $data['version'] . "&customerid=" . $data['customerid'] . "&total_fee=" . $data['total_fee'] . "&sdorderno=" . $data['sdorderno'] . "&notifyurl=" . $data['notifyurl'] . "&returnurl=" . $data['returnurl'] . "&" . $Md5key);
        //$sign;
        //print_r($data);

        $sHtml = "<form id='youbaopaysubmit' name='youbaopaysubmit' action='" . $tjurl . "' method='POST' >";
        foreach ($data as $key => $val) {
            $sHtml .= "<input type='hidden' name='" . $key . "' value='" . $val . "'/>";
        }
        $sHtml .= "</form>";
        $sHtml .= "<script>document.forms['youbaopaysubmit'].submit();</script>";
        echo $sHtml;

    }

    public function notify()
    {
        $param = input();
        $Md5key = $GLOBALS['config']['pay']['weipay']['appkey'];
        $sign = md5("customerid=" . $param['customerid'] . "&status=" . $param['status'] . "&sdpayno=" . $param['sdpayno'] . "&sdorderno=" . $param['sdorderno'] . "&total_fee=" . $param['total_fee'] . "&paytype=" . $param['paytype'] . "&" . $Md5key);
        // Log::error($param['sign']);
        // Log::error($sign);
        if ($param['sign'] == $sign) {
            $res = model('Order')->notify($param['sdorderno'], 'weipay');
            if ($res['code'] > 1) {
                echo $param['sdorderno'];
                //'fail1';
            } else {
                exit("success");
                //echo 'success';
            }
        } else {
            exit("fail");
        }

    }

    public function apiReturn($status, $msg, $data = null)
    {
        $a = array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
        );
        header('Content-type: application/json');
        echo json_encode($a);
        die;
    }

    public function httpPost($url, $param)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== false) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
        }
        if (is_string($param)) {
            $strPOST = $param;
        } else {
            $aPOST = array();
            foreach ($param as $key => $val) {
                $aPOST[] = $key . "=" . urlencode($val);
            }
            $strPOST = join("&", $aPOST);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
        curl_setopt($oCurl, CURLOPT_TIMEOUT, 5);
        $sContent = curl_exec($oCurl);

        $aStatus = curl_getinfo($oCurl);

        return $sContent;
        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }

    /**
     * 用户端生成签名的方法
     * @param array $a
     * @param string $key
     */
    public function getpaysign($a = [], $key = '')
    {
        ksort($a, SORT_STRING);
        $signText = '';
        foreach ($a as $k => $v) {
            if ($k == 'sign' || strlen($v) <= 0) {
                continue;
            }

            $signText .= $k . '=' . $v . '&';
        }
        $signText = rtrim($signText, "&");
        $signText = strtoupper(md5($signText . $key));
        return $signText;
    }

}
