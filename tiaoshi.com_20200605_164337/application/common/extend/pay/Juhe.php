<?php
namespace app\common\extend\pay;

use Pay\Aes;

class Juhe
{

    public $name = '聚合支付';
    public $ver = '1.0';

    public function submit($user, $order, $param)
    {
		if(!empty($param['paytype'])){
            $pay_type = $GLOBALS['config']['pay']['juhe']['tongdao'];
        }
      if($param['paytype']==1){
            $pay_type = $GLOBALS['config']['pay']['juhe']['tongdao'];
        }
        $key = trim($GLOBALS['config']['pay']['juhe']['appkey']); //商户apikey 在api信息里查看
        $Aes = new Aes($key);
        $demo['order_price'] = $order['order_price'];
        $demo['order_id'] = $order['order_code'];
        $demo['type'] =// $GLOBALS['config']['pay']['juhe']['tongdao'];
        $param['paytype'];
        $demo['notify_url'] = $GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . '/index.php/payment/notify/pay_type/juhe'; //通知地址
        $demo['return_url'] = $GLOBALS['http_type'] . $_SERVER['HTTP_HOST'] . '/index.php/payment/notify/pay_type/juhe'; //服务端返回地址

        $demo['sign'] = $this->getpaysign($demo, $key);

        $datas['account'] = trim($GLOBALS['config']['pay']['juhe']['appid']); //商户的api_id,在api信息里查看
        $datas['content'] = base64_encode($Aes->encrypt(json_encode($demo)));
        $d['content'] = base64_encode(json_encode($datas));

        $r = $this->httpPost($GLOBALS['config']['pay']['juhe']['url'], $d);
        if ($r !== false) {
            $json = json_decode($r,true);
            
            //获取到的json数组的data
            $data = $json['data'];
          	//解密
$data = base64_decode($data);
$data = $Aes->decrypt($data);
$data = json_decode($data,true);
            if ($data == '') {
                print_r($r);
            } else {
              
                mac_redirect($data['url']);
            }

        }

    }

    public function notify()
    {
        $param = input();
      	$content = $param['content'];
          
          //解密
          $apikey = trim($GLOBALS['config']['pay']['juhe']['appkey']);//TODO 这个是测试apikey,这边需要换成你自己的apikey
          $content = base64_decode($content);
          $aes= new Aes($apikey);
          $r = json_decode($aes->decrypt($content),true);

        $res = model('Order')->notify($r['order_id'], 'juhe');
        if ($res['code'] > 1) {
            echo $r['order_id'];
              //'fail1';
        } else {
            echo 'success';
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
