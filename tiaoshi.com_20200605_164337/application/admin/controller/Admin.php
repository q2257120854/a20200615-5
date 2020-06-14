<?php
namespace app\admin\controller;
use think\Db;

class Admin extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $param = input();
        $param['page'] = intval($param['page']) <1 ? 1 : $param['page'];
        $param['limit'] = intval($param['limit']) <1 ? $this->_pagesize : $param['limit'];
        $where=[];
        if(!empty($param['wd'])){
            $where['admin_name'] = ['like','%'.$param['wd'].'%'];
        }

        $order='admin_id desc';
        $res = model('Admin')->listData($where,$order,$param['page'],$param['limit']);

        $this->assign('list',$res['list']);
        $this->assign('total',$res['total']);
        $this->assign('page',$res['page']);
        $this->assign('limit',$res['limit']);

        $param['page'] = '{page}';
        $param['limit'] = '{limit}';
        $this->assign('param',$param);
        $this->assign('title','管理员管理');
        return $this->fetch('admin@admin/index');
    }

    public function info()
    {
        if (Request()->isPost()) {
            $param = input('post.');
            if(!in_array('index/welcome',$param['admin_auth'])){
                $param['admin_auth'][] = 'index/welcome';
            }
            $res = model('Admin')->saveData($param);
            if($res['code']>1){
                return $this->error($res['msg']);
            }
            return $this->success($res['msg']);
        }

        $id = input('id');

        $where=[];
        $where['admin_id'] = ['eq',$id];

        $res = model('Admin')->infoData($where);
        $this->assign('info',$res['info']);

        //权限列表
        $menus = @include MAC_ADMIN_COMM . 'auth.php';

        foreach($menus as $k1=>$v1){
            $all = [];
            $cs = [];
            $menus[$k1]['ck'] = '';
            foreach($v1['sub'] as $k2=>$v2){
                $one = $v2['controller'] . '/' . $v2['action'];
                $menus[$k1]['sub'][$k2]['url'] = url($one);
                $menus[$k1]['sub'][$k2]['ck']= '';
                $all[] = $one;

                if(strpos(','.$res['info']['admin_auth'],$one)>0){
                    $cs[] = $one;
                    $menus[$k1]['sub'][$k2]['ck'] = 'checked';
                }
                if($k2==11){
                    $menus[$k1]['sub'][$k2]['ck'] = ' checked  readonly="readonly" ';
                }
            }
            if($all == $cs){
                $menus[$k1]['ck'] = 'checked';
            }
        }
        $this->assign('menus',$menus);


        $this->assign('title','管理员信息');
        return $this->fetch('admin@admin/info');
    }

    public function del()
    {
        $param = input();
        $ids = $param['ids'];

        if(!empty($ids)){
            $where=[];
            $where['admin_id'] = ['in',$ids];
            $res = model('Admin')->delData($where);
            if($res['code']>1){
                return $this->error($res['msg']);
            }
            return $this->success($res['msg']);
        }
        return $this->error('参数错误');
    }

    public function field()
    {
        $param = input();
        $ids = $param['ids'];
        $col = $param['col'];
        $val = $param['val'];

        if(!empty($ids) && in_array($col,['admin_status']) && in_array($val,['0','1'])){
            $where=[];
            $where['admin_id'] = ['in',$ids];

            $res = model('Admin')->fieldData($where,$col,$val);
            if($res['code']>1){
                return $this->error($res['msg']);
            }
            return $this->success($res['msg']);
        }
        return $this->error('参数错误');
    }
  
  	public function home()
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
      
        return $this->fetch('admin@admin/home');
    }

}
