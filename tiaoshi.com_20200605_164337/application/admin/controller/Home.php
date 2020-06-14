<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
class Home  extends Controller
{
    

    

    public function index()
    {
        $zhys = model('user')->count();
      	$zdds = model('order')->count();
      	$zzfdds = model('order')->count();
      	$zzfcgs = model('order')->where('order_status', 1)->count();
      	$zczs = model('order')->where('order_status', 1)->sum('order_price');
      
      	$beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        if (!empty(input('time'))) {
            $beginToday = strtotime(input('time'));
        };
      
      	$jrzc = model('user')->where('user_reg_time', 'BETWEEN', [$beginToday, $beginToday + 86399])->count();
      	$jrdl = model('user')->where('user_login_time', 'BETWEEN', [$beginToday, $beginToday + 86399])->count();
      	$jrddzs = model('order')->where('order_pay_time', 'BETWEEN', [$beginToday, $beginToday + 86399])->count();
      	$jrcgdd = model('order')->where('order_pay_time', 'BETWEEN', [$beginToday, $beginToday + 86399])->where('order_status', 1)->count();
      	$ddcjl = round($jrddzs/$jrcgdd*100,2);
         
      	$this->assign('data', [
            "zhys" => $zhys,
            "zdds" => $zdds,
            "zzfdds" => $zzfdds,
            "zzfcgs" => $zzfcgs,
            "zczs" => $zczs,

            "jrzc" => $jrzc,
            "jrdl" => $jrdl,
            "jrddzs" => $jrddzs,
            "jrcgdd" => $jrcgdd,
          "ddcjl" => $ddcjl,
        ]);
      	
      	$type=[];
      	$td=config('maccms.pay');
      
    
          foreach ($td as $key => $value) {
           
            $a = model('order')->where('order_pay_type', $key)->count();
            if($a!==0){
              	$type2['name']=$key;
              $type2['tjdd']=model('order')->where('order_pay_type', $key)->where('order_pay_time', 'BETWEEN', [$beginToday, $beginToday + 86399])->count();
                $type2['zfdd']=model('order')->where('order_status', 1)->where('order_pay_type', $key)->where('order_pay_time', 'BETWEEN', [$beginToday, $beginToday + 86399])->count();
                 $type2['cjl']=round($type2['zfdd']/$type2['tjdd']*100,2);
                
              array_push($type,$type2);
            }
            
          
        };
      	$this->assign('type', $type);
     	
      $where=[];
      $a = mktime(0, 0, 0, date('m'), date('d') , date('Y'));
      $where['a.time']=['=',$a];
      if (!empty(input('start'))) {
           $a = strtotime(input('start'));
          $where['a.time']=['=',$a];
            
          };
       if (!empty(input('group_id'))) {
           $a = strtotime(input('time'));
         	$group_id = input('group_id');
          $where['b.group_id']=['=',$group_id];
            
          };
      
      
      
      $list=Db::name('user')
        ->alias('b')->join('__STATISTIC__ a ','b.user_id= a.user_id')
        ->order('a.zyj desc')
        //->where('b.group_id', $group_id)
        ->where($where)
        ->paginate(10);
      $this->assign('list', $list);
      $group_list = model('Group')->getCache('group_list');
       $this->assign('group_list', $group_list);
      
      //print_r($list);
      
      $group_lists = model('Group')->select();
       $this->assign('group_lists', $group_lists);
      
        return $this->fetch('admin@home/index');
    }
  
  
    
}
