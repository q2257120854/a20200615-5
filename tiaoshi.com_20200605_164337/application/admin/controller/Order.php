<?php
namespace app\admin\controller;
use think\Db;

class Order extends Base
{
    public function __construct()
    {
        parent::__construct();
    }
	public function export_csv($data)
	{
		$string="";
		foreach ($data as $key => $value) 
		{
			foreach ($value as $k => $val)
			{
				$value[$k]=iconv('utf-8','gb2312',$value[$k]);
			}

			$string .= implode(",",$value)."\n"; //用英文逗号分开 
		}
		
		$filename = 'order_' . date('Y-m-d'). '.csv';
		header("Content-type:text/csv");
		header("Accept-Ranges:bytes");
		header("Content-Disposition:attachment;filename=".$filename."");
		header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
		header('Expires:0');
		header('Pragma:public');
		echo $string; 
	}
    public function index()
    {
        $param = input();
        $param['page'] = intval($param['page']) <1 ? 1 : $param['page'];
        $param['limit'] = intval($param['limit']) <1 ? $this->_pagesize : $param['limit'];
        $where=[];
        if($param['status']!=''){
            $where['order_status'] = ['eq',$param['status']];
        }
        if(!empty($param['uid'])){
            $where['o.user_id'] = ['eq',$param['uid'] ];
        }
        if(!empty($param['wd'])){
            $where['order_code'] = ['like','%'.$param['wd'].'%'];
        }

        if($param['export'] =='1'){
            $param['page'] = 1;
            $param['limit'] = 9999;
        }
        $order='order_id desc';
        $res = model('Order')->listData($where,$order,$param['page'],$param['limit']);

		if($param['export'] =='1'){
			$arr = [];
			$arr[] = [
				'id',
				'单号',
				'订单金额',
				'订单状态',
				'下单时间',
				'支付类型',
				'支付时间',
				'用户id',
				'用户名',
				'代理id',
				'代理用户名',	
			];
			foreach($res['list'] as  $k=>$v){
				$rs = [];
				$rs[] = $v['order_id'];
				$rs[] = $v['order_code'];
				$rs[] = $v['order_price'];
				$rs[] = mac_get_order_status_text($v['order_status']);
				$rs[] = mac_day($v['order_pay_time']);
				$rs[] = $v['order_pay_type'];
				$rs[] = mac_day($v['mac_day']);
				$rs[] = $v['user_id'];
				$rs[] = $v['user_name'];
				$rs[] = $v['fid'];
				$rs[] = $v['fuser'];

				$arr[] = $rs;
			}
			$this->export_csv($arr);

            exit;
        }
        $this->assign('list',$res['list']);
        $this->assign('total',$res['total']);
        $this->assign('page',$res['page']);
        $this->assign('limit',$res['limit']);

        $param['page'] = '{page}';
        $param['limit'] = '{limit}';
        $this->assign('param',$param);


        $this->assign('title','订单管理');
        return $this->fetch('admin@order/index');
    }


    public function del()
    {
        $param = input();
        $ids = $param['ids'];
        $all = $param['all'];

        if(!empty($ids)){
            $where=[];
            $where['order_id'] = ['in',$ids];
            if($all==1){
                $where['order_id'] = ['gt',0];
            }
            $res = model('Order')->delData($where);
            if($res['code']>1){
                return $this->error($res['msg']);
            }
            return $this->success($res['msg']);
        }
        return $this->error('参数错误');
    }



}