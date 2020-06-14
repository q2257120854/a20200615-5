<?php
namespace app\index\controller;
use think\Controller;
use \think\Request;

class Payment extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function notify()
    {
        if (1||Request()->isPost()) {
            $param = input();
            $pay_type = $param['pay_type'];

            if ($GLOBALS['config']['pay'][$pay_type]['appid'] == '') {
                echo '该支付选项未开启';
                exit;
            }

            $cp = 'app\\common\\extend\\pay\\' . ucfirst($pay_type);
            if (class_exists($cp)) {
                $c = new $cp;

                $c->notify();
            }
            else{
                echo '未找到支付选项';
                exit;
            }
        }
        else{
            return $this->success('支付完成', url('user/index') );
        }
    }
	
	public function href()
    {
        if (1||Request()->isPost()) {
            $param = input();
            $pay_type = $param['pay_type'];

            if ($GLOBALS['config']['pay'][$pay_type]['appid'] == '') {
                echo '该支付选项未开启';
                exit;
            }

            $cp = 'app\\common\\extend\\pay\\' . ucfirst($pay_type);
            if (class_exists($cp)) {
                $c = new $cp;

                $c->href();
            }
            else{
                echo '未找到支付选项';
                exit;
            }
        }
        else{
            return $this->success('支付完成', url('user/index') );
        }
    }
}