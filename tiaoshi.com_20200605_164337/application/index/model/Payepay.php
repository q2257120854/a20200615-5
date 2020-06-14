<?php

/**
 * @Author: 琳飞
 * @Date:   2019-07-12 12:11:46
 * @Last Modified by:   琳飞
 * @Last Modified time: 2019-07-12 13:26:53
 * @E-mail: admin@eyabc.cn
 */
namespace app\index\model;

class Payepay extends Base
{
    public function submit($user, $order, $param)
    {
        // 支付方式
        $type = empty($param['paytype']) ? 1 : $param['paytype'];
        switch ((string) $type) {
            case '1':
                $type = 'alipay';
                break;
            case '2':
                $type = 'qqpay';
                break;
            case '3':
                $type = 'wxpay';
                break;
            default:
                $type = 'alipay';
                break;
        }
        // 异步回调地址
        $notify_url = $this->_http_type . $_SERVER['SERVER_NAME'] . '/index.php/payment/notify/pay_type/epay';
        // 同步回调地址
        $return_url = $this->_http_type . $_SERVER['SERVER_NAME'] . '/index.php/payment/notify/pay_type/epay';
        // 商户订单号
        $out_trade_no = $order['order_code'];
        // 订单名称
        $name = '积分充值（UID：' . $order['user_id'] . '）';
        // 支付金额
        $money = sprintf("%.2f", $order['order_price']);
        // 站点名称
        $sitename = '在线充值';
        //构造要请求的参数数组
        $parameter = array(
            "pid"          => trim($this->getConfig('appid')),
            "type"         => $type,
            "notify_url"   => $notify_url,
            "return_url"   => $return_url,
            "out_trade_no" => $out_trade_no,
            "name"         => $name,
            "money"        => $money,
            "sitename"     => $sitename,
        );

        //待请求参数数组
        $para  = $this->buildRequestPara($parameter);
        $sHtml = "<form id='epaysubmit' name='epaysubmit' action='http://api.danbaiyun.cn/submit.php?_input_charset=utf-8' method='POST'>";
        while (list($key, $val) = each($para)) {
            $sHtml .= "<input type='hidden' name='" . $key . "' value='" . $val . "'/>";
        }
        //submit按钮控件请不要含有name属性
        $sHtml = $sHtml . "<input type='submit' value='正在提交'></form>";
        $sHtml = $sHtml . "<script>document.forms['epaysubmit'].submit();</script>";
        echo $sHtml;
        die();
    }

    public function notify()
    {
        $param                    = input();
        $GLOBALS['config']['pay'] = config('maccms.pay');
        unset($param['/payment/notify/pay_type/epay']);
        unset($param['pay_type']);

        $isSign = $this->getSignVeryfy($param, $param["sign"]);
        //验证成功
        if ($isSign) {
            if ($param['trade_status'] == 'TRADE_SUCCESS') {
                $res = model('Order')->notify($param['out_trade_no'], 'epay');
                if ($res['code'] > 1) {
                    echo "fail2";
                } else {
                    echo "success2";
                }
            } else {
                echo "success";
            }
        } else {
            echo "fail";
        }
    }

    /**
     * 获取支付配置
     * @access private
     * @return array
     */
    private function getConfig($val = null)
    {
        if (!is_null($val) && isset($GLOBALS['config']['pay']['epay'][$val])) {
            return $GLOBALS['config']['pay']['epay'][$val];
        }
    }

    private function buildRequestPara($para_temp)
    {
        //除去待签名参数数组中的空值和签名参数
        $para_filter = $this->paraFilter($para_temp);

        //对待签名参数数组排序
        $para_sort = $this->argSort($para_filter);

        //生成签名结果
        $mysign = $this->buildRequestMysign($para_sort);

        //签名结果与签名方式加入请求提交参数组中
        $para_sort['sign']      = $mysign;
        $para_sort['sign_type'] = 'MD5';

        return $para_sort;
    }

    private function paraFilter($para)
    {
        $para_filter = array();
        while (list($key, $val) = each($para)) {
            if ($key == "sign" || $key == "sign_type" || $val == "") {
                continue;
            } else {
                $para_filter[$key] = $para[$key];
            }

        }
        return $para_filter;
    }

    private function argSort($para)
    {
        ksort($para);
        reset($para);
        return $para;
    }

    private function buildRequestMysign($para_sort)
    {
        //把数组所有元素，按照"参数=参数值"的模式用"&"字符拼接成字符串
        $prestr = $this->createLinkstring($para_sort);

        $mysign = $this->md5Sign($prestr, $this->getConfig('key'));

        return $mysign;
    }

    private function createLinkstring($para)
    {
        $arg = "";
        while (list($key, $val) = each($para)) {
            $arg .= $key . "=" . $val . "&";
        }
        //去掉最后一个&字符
        $arg = substr($arg, 0, count($arg) - 2);

        //如果存在转义字符，那么去掉转义
        if (get_magic_quotes_gpc()) {$arg = stripslashes($arg);}

        return $arg;
    }

    private function md5Sign($prestr, $key)
    {
        $prestr = $prestr . $key;
        return md5($prestr);
    }

    private function getSignVeryfy($para_temp, $sign)
    {
        //除去待签名参数数组中的空值和签名参数
        $para_filter = $this->paraFilter($para_temp);

        //对待签名参数数组排序
        $para_sort = $this->argSort($para_filter);

        //把数组所有元素，按照"参数=参数值"的模式用"&"字符拼接成字符串
        $prestr = $this->createLinkstring($para_sort);

        $isSgin = false;
        $isSgin = $this->md5Verify($prestr, $sign, $this->getConfig('key'));

        return $isSgin;
    }

    private function md5Verify($prestr, $sign, $key)
    {
        $prestr = $prestr . $key;
        $mysgin = md5($prestr);
        if ($mysgin == $sign) {
            return true;
        } else {
            return false;
        }
    }
}
