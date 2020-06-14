<?php
namespace app\dai\controller;

use think\Controller;

class Agent extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function agent_add()
    {
        if (Request()->isPost()) {
            $data = input('post.');
			
          	if (!preg_match("/^[a-zA-Z\d]*$/i", $data['account'])) {
            return ['code' => 1006, 'msg' => '用户名只能包含字母和数字，请更换'];
        }	
          if (!preg_match("/^1[34578]{1}\d{9}$/", $data['mobile'])) {
            return ['code' => 1006, 'msg' => '请输入正确手机号'];
        }
           if ($data['rate']>$GLOBALS['dai']['user_tc']) {
            return ['code' => 1006, 'msg' => '提成比例不能大于上级'];
        }
         
          
            $uid = $GLOBALS['dai']['user_id'];

            $ip = sprintf('%u', ip2long(request()->ip()));
            if ($ip > 2147483647) {
                $ip = 0;
            }
			
            $fields = [];
            $fields['user_tc'] = $data['rate'];
            $fields['user_name'] = $data['account'];
            $fields['user_pwd'] = md5($data['password']);
            $fields['group_id'] = 5;
            $fields['user_points'] = intval($config['user']['reg_points']);
            $fields['user_status'] = 1;
            $fields['user_reg_time'] = time();
            $fields['user_reg_ip'] = $ip;

            $invite = $GLOBALS['dai'];
            $fields['user_pid'] = $invite['user_id'];
            $fields['user_pid_2'] = $invite['user_pid'];
            $fields['user_pid_3'] = $invite['user_pid_2'];

            $where2 = [];
            $where2['user_name'] = $data['account'];

            $row = model('user')->where($where2)->find();
            if (!empty($row)) {
                return ['code' => 1011, 'msg' => '代理账号已被使用，请更换'];
            }

            $where2 = [];
            $where2['user_phone'] = $data['mobile'];

            $row = model('user')->where($where2)->find();
            if (!empty($row)) {
                return ['code' => 1011, 'msg' => '手机号已被使用，请更换'];
            }
            $fields['user_phone'] = $data['mobile'];

            $res = model('user')->insert($fields);
            if ($res === false) {
                return ['code' => 1010, 'msg' => '注册失败'];
            }

            $nid = model('user')->getLastInsID();
            $uid = intval($uid);
            if ($uid > 0) {
                $where2 = [];
                $where2['user_id'] = $uid;
                $invite = model('user')->where($where2)->find();
                if ($invite) {
                    $where = [];
                    $where['user_id'] = $nid;
                    $update = [];
                    $update['user_pid'] = $invite['user_id'];
                    $update['user_pid_2'] = $invite['user_pid'];
                    $update['user_pid_3'] = $invite['user_pid_2'];
                    $r1 = model('user')->where($where)->update($update);
                    $r2 = false;
                    $config['user']['invite_reg_num'] = intval($config['user']['invite_reg_num']);

                    if ($config['user']['invite_reg_points'] > 0) {
                        $r2 = model('user')->where($where2)->setInc('user_points', $config['user']['invite_reg_points']);
                    }

                    if ($r2 !== false) {
                        //积分日志
                        $data = [];
                        $data['user_id'] = $uid;
                        $data['plog_type'] = 2;
                        $data['plog_points'] = $config['user']['invite_reg_points'];
                        model('Plog')->saveData($data);
                    }
                }
            }
            return ['code' => 200, 'msg' => '添加代理成功'];
        }
        return $this->fetch('dai@agent/agent_add');
    }

    public function index()
    {
        $dqfybl = $GLOBALS['dai']['user_tc'];
        $where = [];
        if (!empty(input('account'))) {
            $where['user_name'] = input('account');
        };
        if (!empty(input('phone'))) {
            $where['user_phone'] = input('phone');
        };
        $uid = $GLOBALS['dai']['user_id'];
        $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
        if (!empty(input('start'))) {
            $beginToday = strtotime(input('start'));
        };
        if (!empty(input('end'))) {
            $endToday = strtotime(input('end'));
        };

        $order = input('order', 0);
        if ($order == 0) {
            $o = 'user_reg_time';
        } else {
            $o = 'user_reg_time desc';
        }

        $users = model('user')->where($where)->where('user_tc',  '<>',0)->where('user_pid', $uid)->order($o)->select();
      	$users2 = model('user')->where($where)->where('user_pid_2|user_pid_3', $uid)->order($o)->select();
        if ($users) {
          	$users = collection($users)->toArray();
          	$users2 = collection($users2)->toArray();
          	
          		$users =array_merge($users,$users2);
            
        }
      
      	$jrzcl = model('user')->where('user_tc',  '<>',0)->where('user_pid', $uid)->where('user_reg_time', 'BETWEEN', [$beginToday, $endToday])->count();
      	$jrzcl += model('user')->where('user_pid_2|user_pid_3', $uid)->where('user_reg_time', 'BETWEEN', [$beginToday, $endToday])->count();
        $jrczdds = 0;
        $jrcze = 0;
        foreach ($users as $key => $value) {
            $a = model('order')->where('order_status', 1)->where('user_id', $value['user_id'])->where('order_pay_time', 'BETWEEN', [$beginToday, $endToday])->count();
            $b = model('order')->where('order_status', 1)->where('user_id', $value['user_id'])->where('order_pay_time', 'BETWEEN', [$beginToday, $endToday])->sum('order_price');
            $jrczdds += $a;
            $jrcze += $b;
          
        };
      	
      	$zzcl = model('user')->where('user_tc',  '<>',0)->where('user_pid', $uid)->count();
      	$zzcl += model('user')->where('user_pid_2|user_pid_3', $uid)->count();
        $zczdds = 0;
        $zcze = 0;
        foreach ($users as $key => $value) {
            $a = model('order')->where('order_status', 1)->where('user_id', $value['user_id'])->count();
            $b = model('order')->where('order_status', 1)->where('user_id', $value['user_id'])->sum('order_price');
            $zczdds += $a;
            $zcze += $b;
          
        };
      	

        $this->assign('data', [
            "dqfybl" => $dqfybl,
            "jrzcl" => $jrzcl,
            "jrczdds" => $jrczdds,
            "jrcze" => $jrcze,
            "jrtc" => $jrtc,

            "zzcl" => $zzcl,
            "zczdds" => $zczdds,
            "zcze" => $zcze,
            "ztc" => $ztc,
        ]);
		$users = model('user')->where($where)->where('user_tc',  '<>',0)->where('user_pid|user_pid_2|user_pid_3', $uid)->order($o)->select();
      	if ($users) {
          	$users = collection($users)->toArray();
          	
            
        }
      	foreach ($users as $key => $value) {
          	$a = model('user')->where('user_tc',  0)->where('user_pid', $value['user_id'])->count();
            $b = model('user')->where('user_tc','<>', 0)->where('user_pid', $value['user_id'])->count();
          	
            $users[$key]['dll'] = $b;
            $users[$key]['yhl'] = $a;
          	$zzcl+=$a+$b;
          
          	
          
          	
          
            
        };
      
        $this->assign('list', $users);
        return $this->fetch('dai@agent/index');
    }

    public function user()
    {
        $where = [];
        if (!empty(input('id'))) {
            $where['user_id'] = input('id');
        };
        $uid = $GLOBALS['dai']['user_id'];
        $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
        if (!empty(input('start'))) {
            $beginToday = strtotime(input('start'));
        };
        if (!empty(input('end'))) {
            $endToday = strtotime(input('end'));
        };

        $order = input('order', 0);
        if ($order == 0) {
            $o = 'user_reg_time';
        } else {
            $o = 'user_reg_time desc';
        }

        $users = model('user')->where($where)->where('user_tc',0)->where('user_pid', $uid)->order($o)->select();
        if ($users) {
            $users = collection($users)->toArray();
        }
        $group_list = model('Group')->getCache('group_list');
		$list = model('user')->where($where)->where('user_tc',0)->where('user_pid', $uid)->order($o)->paginate(10);
        foreach ($list as $key => $value) {
            $a = model('order')->where('order_status', 1)->where('user_id', $value['user_id'])->where('order_pay_time', 'BETWEEN', [$beginToday, $endToday])->sum('order_price');
            $b = model('order')->where('order_status', 1)->where('user_id', $value['user_id'])->sum('order_price');
            $list[$key]['jrcz'] = number_format($a, 2);
            $list[$key]['ljcz'] = number_format($b, 2);

            $list[$key]['group_name'] = $group_list[$value['group_id']]['group_name'];

        };
		
     
        $this->assign('list', $list);
        return $this->fetch('dai@agent/user');
    }

    public function change_pass()
    {
        $uid = $GLOBALS['dai']['user_id'];
        $param = input('post.');
        $param['user_pwd'] = htmlspecialchars(urldecode(trim($param['pass_old'])));
        $param['user_pwd2'] = htmlspecialchars(urldecode(trim($param['pass_new'])));
        $param['user_pwd22'] = htmlspecialchars(urldecode(trim($param['pass_sure'])));

        if (strlen($param['user_pwd']) < 6) {
            return ['code' => 2002, 'msg' => '密码最少6个字符' . $param['user_pwd']];
        }
        if ($param['user_pwd22'] != $param['user_pwd2']) {
            return ['code' => 2003, 'msg' => '密码与确认密码不一致'];
        }

        $where = [];
        $where['user_id'] = $uid;
        $where['user_pwd'] = md5($param['user_pwd']);

        $user = model('user')->where($where)->find();

        if (!$user) {
            return ['code' => 2006, 'msg' => '原密码错误'];
        }

        $update = [];
        $update['user_id'] = $GLOBALS['user']['user_id'];
        $update['user_pwd'] = md5($param['user_pwd22']);

        $res = model('user')->where($where)->update($update);
        if ($res === false) {
            return ['code' => 2009, 'msg' => '修改失败，请重试'];
        }
        return ['code' => 200, 'msg' => '修改密码成功'];
    }

    
}
