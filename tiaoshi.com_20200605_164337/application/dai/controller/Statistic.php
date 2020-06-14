<?php
namespace app\dai\controller;

use think\Controller;
use think\Db;
class Statistic extends Base
{
    public function __construct()
    {
        parent::__construct();
      	$a = mktime(0, 0, 0, date('m'), date('d') , date('Y'));
      	if (!empty($GLOBALS['dai']['user_id'])) {
           $id = $GLOBALS['dai']['user_id'];
      	$data = ['time' => $a,
                    'user_id' => $id];
      	$time=Db::name('statistic')->where($data)->find();
        if (!$time) {
          	
			Db::name('statistic')->insert($data);
        }
        };
      	
    }
  	
  public function up()
    {
  		$all = input('isall', 0);
    if($all==0){
      $this->ups(true);
    }else{
      	$data = ['time' => $a,
                    'user_id' => $id];
         
        $time=Db::name('statistic')->where($param)->find();	
      
      	$param = input();
        
        if(empty($param['k'])){
            $param['k']=0;
        }
      	$a = mktime(0, 0, 0, date('m'), date('d') , date('Y'));
        if (!empty(input('time'))) {
                $a = strtotime(input('time'));
          		
            
          };
      	
      	$data = ['time' => $a-86400*$param['k']
                ];
         
        $time=Db::name('statistic')->where($data)->find();
        if(!$time){
          echo '更新完毕';
          return;
        }
      
      	$this->ups(true);
        $param['k']++;
      	$param['time']=date("Y/m/d",$a-86400*$param['k']);
      	
        $url = url('Statistic/up') . '?' . http_build_query($param);
      	mac_jump($url, 3);
      
    }
    
  }
  
  public function ups($up=false)
    {
  		
    	$users = model('user')
         
          
           ->where('user_tc',  '<>',0)
          ->field('user_id')->select();
       
      if ($users) {
            $users = collection($users)->toArray();
        };
    	foreach ($users as $key => $value) {
          	
          		$a = mktime(0, 0, 0, date('m'), date('d') , date('Y'));
          		if (!empty(input('time'))) {
                $a = strtotime(input('time'));
          		
            
          };
      			$id = $value['user_id'];
          		$data = ['time' => $a,
                    'user_id' => $id];
         
                $time=Db::name('statistic')->where($data)->find();
        if (!$time) {
          	if($up){
              Db::name('statistic')->insert($data);
               
            }else{
              continue;
            }
			
          
        }
                  
                $this->agent($value['user_id'],false);
          		$this->daili_rate($value['user_id'],false);
          		$this->recharge($value['user_id'],false);
          $this->index($value['user_id'],false);
          $this->register($value['user_id'],false);
          
          $this->zhi_rate($value['user_id'],false);
          
          		echo("用户id".$value['user_id']."的".date("Y/m/d",$a)."统计数据已更新"."<br>");

            };
  }

    public function agent($id='',$true=true)
    {
      if(empty($id)){
        $id = $GLOBALS['dai']['user_id'];
      }  
      
      
      

        $where = [];
        if (!empty(input('account'))) {
            $where['user_name'] = input('account');
        };
        $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        if (!empty(input('time'))) {
            $beginToday = strtotime(input('time'));
        };

        $order = input('order', 0);
        if ($order == 0) {
            $o = 'user_reg_time';
        } else {
            $o = 'user_reg_time desc';
        }
        $users = model('user')->where($where)->where('user_tc',  '<>',0)->where('user_pid|user_pid_2|user_pid_3', $id)->order($o)->select();
        
        foreach ($users as $key => $value) {
            
            $users[$key]['jrzcrs'] = model('user')->where('user_pid', $value['user_id'])->where('user_reg_time', 'BETWEEN', [$beginToday, $beginToday + 86399])->count();
            $users[$key]['zzcrs'] = model('user')->where('user_pid', $value['user_id'])->count();
            $users[$key]['jrczdds'] = model('order')
                ->alias('o')

                ->join('__USER__ u', 'o.user_id = u.user_id', 'left')

                ->where('u.user_pid', $value['user_id'])
				
                
                ->where('o.order_pay_time', 'BETWEEN', [$beginToday, $beginToday + 86399])->count();
            $users[$key]['zczdds'] = model('order')
                ->alias('o')

                ->join('__USER__ u', 'o.user_id = u.user_id', 'left')

                ->where('u.user_pid', $value['user_id'])
				 ->where('o.order_pay_time', '<',  $beginToday+ 86399 )
                ->where('o.order_status',1)
                ->count();
            $users[$key]['jrcze'] = model('order')
                ->alias('o')

                ->join('__USER__ u', 'o.user_id = u.user_id', 'left')

                ->where('u.user_pid', $value['user_id'])
				
               
                ->where('o.order_pay_time', 'BETWEEN', [$beginToday, $beginToday + 86399])->sum('order_price');
            $users[$key]['zcze'] = model('order')
                ->alias('o')

                ->join('__USER__ u', 'o.user_id = u.user_id', 'left')

                ->where('u.user_pid', $value['user_id'])
              	->where('o.order_status',1)
				 ->where('o.order_pay_time', '<',  $beginToday+ 86399 )
                
                ->sum('order_price');
        }
		if($true){
          $this->assign('list', $users);
        return $this->fetch('dai@statistic/agent');
        };
        
    }
    public function daili_rate($id='',$true=true)
    {
      if(empty($id)){
        $id = $GLOBALS['dai']['user_id'];
      }  
        $page = input('page', 1);
       
        
      	$users = model('user')->where('user_tc',  '<>',0)->where('user_pid', $id)->field('user_id')->select();
      	$users2 = model('user')->where('user_pid_2|user_pid_3', $id)->field('user_id')->select();
        if ($users) {
          	$users = collection($users)->toArray();
          	$users2 = collection($users2)->toArray();
          	
          		$users =array_merge($users,$users2);
            
        }
        $list = [];
        $a = mktime(0, 0, 0, date('m'), date('d') , date('Y'));
      	$where=[];
      	$where['time']=['>=',$GLOBALS['dai']['user_reg_time']];
      	if (!empty(input('time'))) {
                $a = strtotime(input('time'));
          $where['time']=['=',$a];
            
          };
		$dl = 0;	
      foreach ($users as $key => $value) {
            $aa = model('order')->where('user_id', $value['user_id'])->where('order_pay_time', 'BETWEEN', [$a, $a + 86399])->count();
            
        
        	if($aa>0)
            {
              
            $dl++;
            }
        
        };
            

            

            $zs = model('user')
              
              ->where('user_pid_2|user_pid_3', $id)
              ->where('user_reg_time', '<',  $a + 86399)
              ->count();
      		$zs += model('user')
              ->where('user_tc', '<>', 0)
              
              ->where('user_pid', $id)
              ->where('user_reg_time', '<', $a + 86399)
              ->count();

            $list['dlczz'] = $dl;

            $list['dlyhz'] = $zs;
            $zong = $dl / $zs * 100;
            if (is_nan($zong)) {
                $zong = 0;
            }
      		 if ($zong == 1) {
                $zong = 100;
            }

            $list['dlzhl'] = $zong;
       $c=Db::name('statistic')->where('user_id',$id)->where('time',$a)->update($list);
        
		$list = Db::name('statistic')->where('user_id',$id)->order('time desc')->where($where)->paginate(10);
		if($true){
        $this->assign('list', $list);
        return $this->fetch('dai@statistic/daili_rate'); };
    }
    public function index($id='',$true=true)
    {
      if(empty($id)){
        $id = $GLOBALS['dai']['user_id'];
      }  
        // 褰撳墠鍒嗕剑姣斾緥
        $dqfybl = $GLOBALS['dai']['user_tc'];
        
        $page = input('page', 1);

        $users = model('user')
         
          
          ->where('user_pid_2|user_pid_3', $id)
         
          ->field('user_id')->select();
        $users2 = model('user')
         
          
          ->where('user_pid', $id)
          ->where('user_tc', 0)
          ->field('user_id')->select();
      	$users3 = model('user')
         
          
          ->where('user_pid', $id)
           ->where('user_tc',  '<>',0)
          ->field('user_id')->select();
      	if ($users) {
            $users = collection($users)->toArray();
          	$users3 = collection($users3)->toArray();
          	array_merge($users,$users3);
        }
      if ($users2) {
            $users2 = collection($users2)->toArray();
        }
      	
      
        $list = [];
        $a = mktime(0, 0, 0, date('m'), date('d') , date('Y'));
      	$where=[];
      	$where['time']=['>=',$GLOBALS['dai']['user_reg_time']];
      	if (!empty(input('time'))) {
                $a = strtotime(input('time'));
          $where['time']=$a;
          };

            $dl = 0;
            foreach ($users as $key => $value) {
                $adl = model('yj')->where('user_id_1', $value['user_id'])
                 ->where('user_id', $id)
                  ->where('plog_time', 'BETWEEN', [$a, $a + 86399])
                  ->sum('plog_points');
                 

                $dl += $adl;

            };

            $zs = 0;
            foreach ($users2 as $key => $value) {
                $azs = model('yj')->where('user_id_1', $value['user_id'])
                  ->where('plog_time', 'BETWEEN', [$a, $a + 86399])
                  ->where('user_id', $id)
                  ->sum('plog_points');
                  
                $zs += $azs;

            };
            $list['dlyj'] = number_format($dl , 2);
            $list['zsyj'] = number_format($zs , 2);
            $list['zyj'] = number_format($dl + $zs , 2);
        Db::name('statistic')->where('user_id',$id)->where('time',$a)->update($list);
        if($true){
		$list = Db::name('statistic')->where('user_id',$id)->order('time desc')->where($where)->paginate(10);
        $this->assign('list', $list);
        return $this->fetch('dai@statistic/index'); };
    }

    public function recharge($id='',$true=true)
    {
      if(empty($id)){
        $id = $GLOBALS['dai']['user_id'];
      }  
        
        $users = model('user')
          
          ->where('user_pid_2|user_pid_3', $id)->field('user_id')->select();
        $users2 = model('user')
         
          ->where('user_tc', 0)
          ->where('user_pid', $id)->field('user_id')->select();
      $users3 = model('user')
         
          
          ->where('user_pid', $id)
           ->where('user_tc',  '<>',0)
          ->field('user_id')->select();
      	if ($users) {
            $users = collection($users)->toArray();
          	$users3 = collection($users3)->toArray();
          	array_merge($users,$users3);
        }
      if ($users2) {
            $users2 = collection($users2)->toArray();
        }
        $list = [];
        $a = mktime(0, 0, 0, date('m'), date('d') , date('Y'));
      	
      	$where=[];
      	$where['time']=['>=',$GLOBALS['dai']['user_reg_time']];
      	if (!empty(input('time'))) {
                $a = strtotime(input('time'));
          $where['time']=$a;
          };

            $dl = 0;
            foreach ($users as $key => $value) {
                $adl = model('order')->where('user_id', $value['user_id'])->where('order_pay_time', 'BETWEEN', [$a, $a + 86399])->sum('order_price');

                $dl += $adl;

            };

            $zs = 0;
            foreach ($users2 as $key => $value) {
                $azs = model('order')->where('user_id', $value['user_id'])->where('order_pay_time', 'BETWEEN', [$a, $a + 86399])->sum('order_price');

                $zs += $azs;

            };
      		
            $list['dlcz'] = $dl;//number_format($dl, 2);
            $list['zscz'] = $zs;
            $list['zcz'] = $dl + $zs;//number_format($dl + $zs, 2);
        $b=Db::name('statistic')->where('user_id',$id)->where('time',$a)->update($list);
        if($true){	
		$list = Db::name('statistic')->where('user_id',$id)->order('time desc')->where($where)->paginate(10);
        $this->assign('list', $list);
        return $this->fetch('dai@statistic/recharge'); };
    }
    public function register($id='',$true=true)
    {
      if(empty($id)){
        $id = $GLOBALS['dai']['user_id'];
      }  
        $list = [];
        $a = mktime(0, 0, 0, date('m'), date('d') , date('Y'));
      	$where=[];
      	$where['time']=['>=',$GLOBALS['dai']['user_reg_time']];
      	if (!empty(input('time'))) {
                $a = strtotime(input('time'));
          $where['time']=$a;
          };
    
      	
       
     		$a1 = model('user')->where('user_pid_2|user_pid_3', $id)->where('user_reg_time','BETWEEN', [$a, $a + 86399])->count();
      		$a2 = model('user')->where('user_tc','<>', 0)->where('user_pid', $id)->where('user_reg_time', 'BETWEEN', [$a, $a + 86399])->count();
            $list['dlzc'] = $a1+$a2;
             
            $list['zszc'] = 
              model('user')->where('user_tc', 0)->where('user_pid', $id)->where('user_reg_time', 'BETWEEN', [$a, $a + 86399])->count();
             
            $list['zzc'] = $list['dlzc']+$list['zszc'];

          	Db::name('statistic')->where('time',$a)->update($list);
      
        if($true){
		$list = Db::name('statistic')->where('user_id',$id)->where('user_id',$id)->order('time desc')->where($where)->paginate(10);
        $this->assign('list', $list);

        return $this->fetch('dai@statistic/register'); };
    }
    public function zhi_rate($id='',$true=true)
    {
      if(empty($id)){
        $id = $GLOBALS['dai']['user_id'];
      }  
        $users = model('user')->where('user_tc', 0)->where('user_pid', $id)
      	->select();
      	if ($users) {
            $users = collection($users)->toArray();
          	
        }
        $list = [];
        $a = mktime(0, 0, 0, date('m'), date('d') , date('Y'));
      	$where=[];
      	$where['time']=['>=',$GLOBALS['dai']['user_reg_time']];
      	if (!empty(input('time'))) {
                $a = strtotime(input('time'));
          $where['time']=$a;
          };

            $dl = 0;	
      foreach ($users as $key => $value) {
            $aa = model('order')->where('user_id', $value['user_id'])->where('order_pay_time', 'BETWEEN', [$a, $a + 86399])->count();
            
        
        	if($aa>0)
            {
              
            $dl++;
            }
        
        };

            
			
      	$zs=  model('user')->where('user_tc',  0)->where('user_pid', $id)->where('user_reg_time', '<', $a + 86399)->count();	
      
            $list['zsczz'] = $dl;

            $list['zsyhz'] = $zs;
            $zong = $dl / $zs;
            if (is_nan($zong)) {
                $zong = 0;
            }
			 if ($zong == 1) {
                $zong = 100;
            }
            $list['zszhl'] = $zong;
        Db::name('statistic')->where('user_id',$id)->where('time',$a)->update($list);
        if($true){
		$list = Db::name('statistic')->where('user_id',$id)->order('time desc')->where($where)->paginate(10);

        $this->assign('list', $list);
        return $this->fetch('dai@statistic/zhi_rate');
        };
    }
  
  	
    
}
