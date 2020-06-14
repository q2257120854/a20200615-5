<?php
namespace app\common\model;
use think\Db;

class Order extends Base {
    // 设置数据表（不含前缀）
    protected $name = 'order';

    // 定义时间戳字段名
    protected $createTime = '';
    protected $updateTime = '';

    // 自动完成
    protected $auto       = [];
    protected $insert     = [];
    protected $update     = [];


    public function listData($where,$order,$page=1,$limit=20,$start=0)
    {
        if(!is_array($where)){
            $where = json_decode($where,true);
        }
        $limit_str = ($limit * ($page-1) + $start) .",".$limit;
        $total = $this->alias('o')->where($where)->count();
        $list = Db::name('Order')->alias('o')
            ->field('o.*,u.user_name')
            ->join('__USER__ u','o.user_id = u.user_id','left')
            ->where($where)
            ->order($order)
            ->limit($limit_str)
            ->select();


        return ['code'=>1,'msg'=>'数据列表','page'=>$page,'pagecount'=>ceil($total/$limit),'limit'=>$limit,'total'=>$total,'list'=>$list];
    }

    public function infoData($where,$field='*')
    {
        if(empty($where) || !is_array($where)){
            return ['code'=>1001,'msg'=>'参数错误'];
        }
        $info = $this->field($field)->where($where)->find();

        if(empty($info)){
            return ['code'=>1002,'msg'=>'获取数据失败'];
        }
        $info = $info->toArray();

        return ['code'=>1,'msg'=>'获取成功','info'=>$info];
    }

    public function saveData($data)
    {
        $validate = \think\Loader::validate('Order');
        if(!$validate->check($data)){
            return ['code'=>1001,'msg'=>'参数错误：'.$validate->getError() ];
        }

        $data['order_time'] = time();
        if(!empty($data['order_id'])){
            $where=[];
            $where['order_id'] = ['eq',$data['order_id']];
            $res = $this->allowField(true)->where($where)->update($data);
        }
        else{
            $res = $this->allowField(true)->insert($data);
        }
        if(false === $res){
            return ['code'=>1002,'msg'=>'保存失败：'.$this->getError() ];
        }
        return ['code'=>1,'msg'=>'保存成功'];
    }

    public function delData($where)
    {
        $res = $this->where($where)->delete();
        if($res===false){
            return ['code'=>1001,'msg'=>'删除失败：'.$this->getError() ];
        }
        return ['code'=>1,'msg'=>'删除成功'];
    }

    public function fieldData($where,$col,$val)
    {
        if(!isset($col) || !isset($val)){
            return ['code'=>1001,'msg'=>'参数错误'];
        }

        $data = [];
        $data[$col] = $val;
        $res = $this->allowField(true)->where($where)->update($data);
        if($res===false){
            return ['code'=>1001,'msg'=>'设置失败：'.$this->getError() ];
        }
        return ['code'=>1,'msg'=>'设置成功'];
    }

    /*
     * 充值回调函数接口
     * 任何充值接口，回调接口里直接调用该接口更新订单状态、用户积分
     * pay_type预留值alipay,weixin,bank，可以继续自定义最长10个字符
     */
    public function notify($order_code,$pay_type)
    {
     

        if(empty($order_code) || empty($pay_type)){
            return ['code'=>1001,'msg'=>'参数错误'];
        }


        $where = [];
        $where['order_code'] = $order_code;
        $order = model('Order')->infoData($where);
     
        if($order['code']>1){
            //return $order;
        }

        if($order['info']['order_status'] == 1){
            return ['code'=>1,'msg'=>'订单已支付完毕'];
            exit;
        }
		
        $where2=[];
        $where2['user_id'] = $order['info']['user_id'];
        $user = model('User')->infoData($where2);
		
        $update = [];
		if($user['info']['user_pid']){
			$ww=[];
			$ww['user_id'] = $user['info']['user_pid'];
			$uu = model('User')->infoData($ww);
			$update['fid'] = $uu['info']['user_id'];
			$update['fuser'] = $uu['info']['user_name'];
		}
        if($user['code']>1){
            return $user;
        }

        $update['order_status'] = 1;
        $update['order_pay_time'] = time();
        $update['order_pay_type'] = $pay_type;
        $res = $this->where($where)->update($update);
        if($res===false){
            return ['code'=>2002,'msg'=>'更新订单状态失败'];
        }

       //20191221更新充值类型为用户组
        /*
		$where2 = [];
        $where2['user_id'] = $user['info']['user_id'];
        $res = model('User')->where($where2)->setInc('user_points',$order['info']['order_points']);
        if($res===false){
            return ['code'=>2003,'msg'=>'更新会员积分失败'];
        }
		 //积分日志
        $data = [];
        $data['user_id'] = $user['info']['user_id'];
        $data['plog_type'] = 1;
        $data['plog_points'] = $order['info']['order_points'];
        model('Plog')->saveData($data);

		*/
		
		$where2 = [];
        $where2['user_id'] = $user['info']['user_id'];//用户id
		$userendtime = $user['info']['user_end_time'];//有效期
		if($userendtime >time()){
			$userendtime = $user['info']['user_end_time'];
		}else{
			$userendtime = time();
		}
		$usertpye = floatval($order['info']['order_price']);//充值价格
		if($usertpye =='1'){
			$userendtime = $userendtime + 1*24*60*60;//一天
		}else if($usertpye =='1.2'){
			$userendtime = $userendtime+ 30*24*60*60;//一个月
		}else if($usertpye =='1.3'){
			$userendtime = $userendtime + 90*24*60*60;//一个季度
		}else if($usertpye =='1.4'){
			$userendtime = $userendtime + 183*24*60*60;//半年
		}else if($usertpye =='10'){
			$userendtime = $userendtime + 365*24*60*60;//一年
		}else if($usertpye =='20'){
			$userendtime = $userendtime + 365*24*60*60;//一年
		}
		
        $update3['group_id'] = 3;//vip用户组
        $update3['user_end_time'] = $userendtime;
      
      	$uservip = model('User');
        $res = $uservip->where($where2)->update($update3);
      	
    	$this->reward($usertpye,$user['info']);
      	
        if($res===false){
            return ['code'=>2019,'msg'=>'更新会员用户组失败'];
        }
		
        return ['code'=>1,'msg'=>'充值完毕,回调函数执行成功'];

    }
  
  	public function reward($fee_points=0,$user=null)
    {
        //三级分销
        if($fee_points>0){
          	
          	$where2=[];
        	$where2['user_id'] = $user['user_pid'];
        	$pid = model('User')->infoData($where2);
          	$pid =$pid['info'];
			$tc['user_pid'] = $pid['user_tc'];
          	$tc['user_pid_2'] = model('user')->where('user_id', $user['user_pid_2'])->value('user_tc');
          	$tc['user_pid_3'] = model('user')->where('user_id', $user['user_pid_3'])->value('user_tc');
          	
            if(!empty($user['user_pid'])){
              	
                
              	$points = $fee_points /100 * $tc['user_pid'];
              	
                if($points>0){
                  	
                    $where=[];
                    $where['user_id'] = $user['user_pid'];
                  
                  	
                  	$row = Db::name('dai')->where($where)->find();

            		if (empty($row)) {
                		Db::name('dai')->insert($where);
            		}
                  	
                    $r = Db::name('dai')->where($where)->setInc('dai_yj',$points);
                    if($r){
                        $data = [];
                        $data['user_id'] = $user['user_pid'];
                      	$data['user_id_1'] = $user['user_id'];
                        $data['plog_type'] = 1;
                        $data['plog_points'] = $points;
                        $data['plog_remarks'] = '代理【'.$pid['user_id'].'、'.$pid['user_name'].'】的下级用户【'.$user['user_id'].'、'.$user['user_name'].'】充值'.$fee_points.'元，获得奖励'.$points.'元';
                        model('Yj')->saveData($data);
                    }
                  	
                }
            }
            if( !empty($user['user_pid_2'])){
              	
                $points = $fee_points / 100 * ($tc['user_pid_2']-$tc['user_pid']) ;
              	$points =abs($points);
               
              
                if($points>0){
                    $where=[];
                    $where['user_id'] = $user['user_pid_2'];
                  	$row = Db::name('dai')->where($where)->find();

            		if (empty($row)) {
                		Db::name('dai')->insert($where);
            		}
                    $r = Db::name('dai')->where($where)->setInc('dai_yj',$points);
                    if($r){
                        $data = [];
                        $data['user_id'] = $user['user_pid_2'];
                      	$data['user_id_1'] = $user['user_id'];
                        $data['plog_type'] = 2;
                        $data['plog_points'] = $points;
                        $data['plog_remarks'] ='代理【'.$pid['user_id'].'、'.$pid['user_name'].'】的下级用户【'.$user['user_id'].'、'.$user['user_name'].'】充值'.$fee_points.'元，获得奖励'.$points.'元';
                        model('Yj')->saveData($data);
                    }
                }
            }
            if( !empty($user['user_pid_3'])){
                
                 $points = $fee_points / 100 * ($tc['user_pid_3']-$tc['user_pid_2']) ;
              	$points =abs($points);
              	
                if($points>0){
                    $where=[];
                    $where['user_id'] = $user['user_pid_3'];
                  	$data['user_id_1'] = $user['user_id'];
                  	$row = Db::name('dai')->where($where)->find();

            		if (empty($row)) {
                		Db::name('dai')->insert($where);
            		}
                    $r = Db::name('dai')->where($where)->setInc('dai_yj',$points);
                    if($r){
                        $data = [];
                        $data['user_id'] = $user['user_pid_3'];
                      	$data['user_id_1'] = $user['user_id'];
                        $data['plog_type'] = 3;
                        $data['plog_points'] = $points;
                        $data['plog_remarks'] = '代理【'.$pid['user_id'].'、'.$pid['user_name'].'】的下级用户【'.$user['user_id'].'、'.$user['user_name'].'】充值'.$fee_points.'元，获得奖励'.$points.'元';
                        model('Yj')->saveData($data);
                    }
                }
            }
        }
		
        //return ['code'=>1,'msg'=>'分销提成成功'];
    }

}