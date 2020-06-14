<?php
namespace app\dai\controller;

use think\Controller;

class Index extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        // 当前分佣比例
        $dqfybl = $GLOBALS['dai']['user_tc'];
        $uid = $GLOBALS['dai']['user_id'];

        $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
        $beginThismonth = mktime(0, 0, 0, date('m'), 1, date('Y'));
        $endThismonth = mktime(23, 59, 59, date('m'), date('t'), date('Y'));

        $users = model('user')->where('user_pid|user_pid_2|user_pid_3', $uid)->field('user_id')->select();
        // 今日注册量
        // 今日充值订单数
        // 今日充值额
        // 今日提成
        $jrzcl = model('user')->where('user_pid|user_pid_2|user_pid_3', $uid)->where('user_reg_time', 'BETWEEN', [$beginToday, $endToday])->count();
        $jrczdds = 0;
        $jrcze = 0;
       
        
      	// 当月注册量
        // 当月充值订单数
        // 当月充值额
        // 当月提成
        $dyzcl = model('user')->where('user_pid|user_pid_2|user_pid_3', $uid)->where('user_reg_time', 'BETWEEN', [$beginThismonth, $endThismonth])->count();
        $dyczdds = 0;
        $dycze = 0;
      
      	// 总注册量
        // 总充值订单数
        // 总充值额
        // 总提成
        $zzcl = model('user')->where('user_pid|user_pid_2|user_pid_3', $uid)->count();
        $zczdds = 0;
        $zcze = 0;
        foreach ($users as $key => $value) {
          	
          	$a = model('order')->where('order_status', 1)->where('user_id', $value['user_id'])->where('order_pay_time', 'BETWEEN', [$beginToday, $endToday])->count();
            $b = model('order')->where('order_status', 1)->where('user_id', $value['user_id'])->where('order_pay_time', 'BETWEEN', [$beginToday, $endToday])->sum('order_price');
            $jrczdds += $a;
            $jrcze += $b;
          	$c = model('yj')->where('user_id', $uid)->where('user_id_1', $value['user_id'])->where('plog_time', 'BETWEEN', [$beginToday, $endToday])->sum('plog_points');
          	$jrtc += $c;
          	
            $a = model('order')->where('order_status', 1)->where('user_id', $value['user_id'])->where('order_pay_time', 'BETWEEN', [$beginThismonth, $endThismonth])->count();
            $b = model('order')->where('order_status', 1)->where('user_id', $value['user_id'])->where('order_pay_time', 'BETWEEN', [$beginThismonth, $endThismonth])->sum('order_price');
            $dyczdds += $a;
            $dycze += $b;
          	$c = model('yj')->where('user_id', $uid)->where('user_id_1', $value['user_id'])->where('plog_time', 'BETWEEN', [$beginThismonth, $endThismonth])->sum('plog_points');
          	$dytc += $c;
          
          	$a = model('order')->where('order_status', 1)->where('user_id', $value['user_id'])->count();
            $b = model('order')->where('order_status', 1)->where('user_id', $value['user_id'])->sum('order_price');
          	$c = model('yj')->where('user_id', $uid)->where('user_id_1', $value['user_id'])->sum('plog_points');
          	$ztc += $c;
            $zczdds += $a;
            $zcze += $b;
        };
      
      	 $jrcze = number_format($jrcze, 2);
      
        $dycze = number_format($dycze, 2);
      
      	$zcze = number_format($zcze, 2);
        
        
     
        
        

        $this->assign('data', [
            "dqfybl" => $dqfybl,
            "jrzcl" => $jrzcl,
            "jrczdds" => $jrczdds,
            "jrcze" => $jrcze,
            "jrtc" => $jrtc,
            "dyzcl" => $dyzcl,
            "dyczdds" => $dyczdds,
            "dycze" => $dycze,
            "dytc" => $dytc,
            "zzcl" => $zzcl,
            "zczdds" => $zczdds,
            "zcze" => $zcze,
            "ztc" => $ztc,
        ]);
        return $this->fetch('dai@index/home');
    }

    public function out()
    {
        
      	cookie('dai_id', null);
        cookie('dai_name', null);
        cookie('dai_group_id', null);
        cookie('dai_group_name', null);
        cookie('dai_check', null);
        cookie('dai_portrait', null);
        
        return $this->error('退出成功', url('index/login'));

    }
    public function login()
    {
        if (Request()->isPost()) {
            $data = input('post.');

            if (empty($data['username']) || empty($data['password'])) {
                return ['code' => 1001, 'msg' => '请填写必填项'];
            }

            if ($GLOBALS['config']['user']['login_verify'] == 1 && !captcha_check($data['code'])) {
                return ['code' => 1002, 'msg' => '验证码错误'];
            }

            $pwd = md5($data['password']);
            $where = [];

            $pattern = '/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/';
            if (!preg_match($pattern, $data['username'])) {
                $where['user_name'] = ['eq', $data['username']];
            } else {
                $where['user_email'] = ['eq', $data['username']];
            }

            $where['user_pwd'] = ['eq', $pwd];
            $where['user_status'] = ['eq', 1];
            $where['user_tc'] = ['<>', 0]; 
          	
            $row = model('user')->where($where)->find();

            if (empty($row)) {
                return ['code' => 1003, 'msg' => '查找用户信息失败'];
            }

            

            $random = md5(rand(10000000, 99999999));
            $ip = sprintf('%u', ip2long(request()->ip()));
            if ($ip > 2147483647) {
                $ip = 0;
            }
            $update['user_random'] = $random;
            $update['user_login_ip'] = $ip;
            $update['user_login_time'] = time();
            $update['user_login_num'] = $row['user_login_num'] + 1;
            $update['user_last_login_time'] = $row['user_login_time'];
            $update['user_last_login_ip'] = $row['user_login_ip'];

            $res = model('user')->where($where)->update($update);
            if ($res === false) {
                return ['code' => 1004, 'msg' => '更新登录信息失败'];
            }

            //用户组
            $group_list = model('Group')->getCache('group_list');
            $group = $group_list[$row['group_id']];

            cookie('dai_id', $row['user_id'], ['expire' => 2592000]);
            cookie('dai_name', $row['user_name'], ['expire' => 2592000]);
            cookie('dai_group_id', $group['group_id'], ['expire' => 2592000]);
            cookie('dai_group_name', $group['group_name'], ['expire' => 2592000]);
            cookie('dai_check', md5($random . '-' . $row['user_id']), ['expire' => 2592000]);
            cookie('dai_portrait', mac_get_user_portrait($row['user_id']), ['expire' => 2592000]);

            return ['code' => 200, 'msg' => '登录成功', 'url' => url('dai/index/home')];

        }
        return $this->fetch('dai@index/login');
    }
  
  public function promote()
    {
		$this->assign('maccms',[
          "http_type" => $GLOBALS['http_type'],
          "site_url" => $GLOBALS['config']['site']['site_url'],
            ]);
        return $this->fetch('dai@index/promote');
    }
  
  	public function test()
    {	
      model('order')->reward(100);

    }

}
