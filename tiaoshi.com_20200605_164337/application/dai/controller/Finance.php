<?php
namespace app\dai\controller;

use think\Controller;
use think\Db;

class Finance extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $uid = $GLOBALS['dai']['user_id'];
        
        $dai = Db::name('dai')->where('user_id', $uid)->find();
        $this->assign('dai', $dai);
        return $this->fetch('dai@finance/index');
    }
    public function record()
    {
      $uid = $GLOBALS['dai']['user_id'];  
      $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y') - 200);
        $endToday = mktime(0, 0, 0, date('m'), date('d'), date('Y') + 200);
        if (!empty(input('start'))) {
            $beginToday = strtotime(input('start'));
        };
        if (!empty(input('end'))) {
            $endToday = strtotime(input('end'));
        };
        $log = Db::name('cash')->where('user_id', $uid)->where('cash_time', 'BETWEEN', [$beginToday, $endToday])->paginate(10);

        $this->assign('log', $log);
        return $this->fetch('dai@finance/record');
    }
  	public function yjlog()
    {
      $uid = $GLOBALS['dai']['user_id'];  
      $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y') - 200);
        $endToday = mktime(0, 0, 0, date('m'), date('d'), date('Y') + 200);
        if (!empty(input('start'))) {
            $beginToday = strtotime(input('start'));
        };
        if (!empty(input('end'))) {
            $endToday = strtotime(input('end'));
        };
      	$order = input('order', 0);
        if ($order == 0) {
            $o = 'plog_time';
        } else {
            $o = 'plog_time desc';
        }
        $log = model('yj')->where('user_id', $uid)->order('plog_time desc')->where('plog_time', 'BETWEEN', [$beginToday, $endToday])->paginate(10);
		
        $this->assign('log', $log);
        return $this->fetch('dai@finance/yjlog');
    }

    public function change_pass()
    {
        if (Request()->isPost()) {
            $uid = $GLOBALS['dai']['user_id'];
            $param = input('post.');
            $param['user_pwd'] = htmlspecialchars(urldecode(trim($param['old_pass'])));
            $param['user_pwd2'] = htmlspecialchars(urldecode(trim($param['new_pass'])));
            $param['user_pwd22'] = htmlspecialchars(urldecode(trim($param['re_pass'])));

            if (strlen($param['user_pwd']) < 6) {
              	return $this->error('密码最少6个字符');
                
            }
            if ($param['user_pwd22'] != $param['user_pwd2']) {
              return $this->error('密码与确认密码不一致');
                
            }

            $where = [];
            $where['user_id'] = $uid;
            $where['dai_mm'] = md5($param['user_pwd']);

            $user = Db::name('dai')->where($where)->find();

            if (!$user) {
              return $this->error('原密码错误');
                
            }

            $update = [];
            $update['user_id'] = $uid;
            $update['dai_mm'] = md5($param['user_pwd22']);

            $res = Db::name('dai')->where($where)->update($update);
            if ($res === false) {
              return $this->error('修改失败，请重试');
                
            }
            
          return $this->error('修改提现密码成功', url('finance/index'));
        }
        return $this->fetch('dai@finance/change_pass');
    }

    public function withdrawal()
    {
        if (Request()->isPost()) {
            $uid = $GLOBALS['dai']['user_id'];
            $param = input('post.');
            $param['user_pwd'] = htmlspecialchars(urldecode(trim($param['tx_mm'])));

            if (strlen($param['user_pwd']) < 6) {
                return $this->error('密码最少6个字符');

            }
          	if ($param['cash_money'] < 100) {
                return $this->error('最低100起提');

            }
          	

            $where = [];
            $where['user_id'] = $uid;
            $where['dai_mm'] = md5($param['user_pwd']);

            $user = Db::name('dai')->where($where)->find();

            if (!$user) {
                return $this->error('提现密码错误');

            }

            $param['user_id'] = $uid;
          	$param['cash_time'] = time();
            $res = Db::name('cash')->insert($param);
			if ($param['cash_money'] > $user['dai_yj']) {
                return $this->error('余额不足');

            }
            if ($res < 1) {
                return $this->error('提现申请失败');
            }
          	
          	Db::name('dai')->where('user_id', $uid)->update([
          	'dai_txz' =>  $user['dai_txz']+$param['cash_money'] ,
          	
              'dai_yj' =>  $user['dai_yj']-$param['cash_money'] 
        	]);
            return $this->error('提现申请成功', url('finance/index'));
        }
        return $this->fetch('dai@finance/withdrawal');
    }

}
