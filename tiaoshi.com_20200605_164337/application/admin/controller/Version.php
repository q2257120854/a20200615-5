<?php
namespace app\admin\controller;
use app\common\controller\All;
class Version extends All
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
            $where['newversion'] = ['like','%'.$param['wd'].'%'];
        }

        $order='id desc';
        $res = model('Version')->listData($where,$order,$param['page'],$param['limit']);

        $this->assign('list',$res['list']);
        $this->assign('total',$res['total']);
        $this->assign('page',$res['page']);
        $this->assign('limit',$res['limit']);

        $param['page'] = '{page}';
        $param['limit'] = '{limit}';
        $this->assign('param',$param);
        $this->assign('title','版本管理');
        return $this->fetch('admin@version/index');
    }

    public function info()
    {
        if (Request()->isPost()) {
            $param = input();
            $res = model('Version')->saveData($param);
            if($res['code']>1){
                return $this->error($res['msg']);
            }
            return $this->success($res['msg']);
        }

        $id = input('id');
        $where=[];
        $where['id'] = ['eq',$id];
        $res = model('Version')->infoData($where);


        $this->assign('info',$res['info']);
        $this->assign('title','版本管理信息');
        return $this->fetch('admin@version/info');
    }

    public function del()
    {
        $param = input();
        $ids = $param['ids'];

        if(!empty($ids)){
            $where=[];
            $where['id'] = ['in',$ids];
            $res = model('Version')->delData($where);
            if($res['code']>1){
                return $this->error($res['msg']);
            }
            return $this->success($res['msg']);
        }
        return $this->error('参数错误');
    }

    public function batch()
    {
        $param = input();
        $ids = $param['ids'];
        foreach ($ids as $k=>$id) {
            $data = [];
            $data['id'] = intval($id);
            $data['oldversion'] = $param['oldversion'][$k];
            $data['newversion'] = $param['newversion'][$k];
            $data['downloadurl'] = $param['downloadurl'][$k];
            $data['status'] = intval($param['status'][$k]);
          	$data['enforce'] = intval($param['enforce'][$k]);
            $data['iosdownloadurl'] = $param['iosdownloadurl'][$k];

            if (empty($data['newversion'])) {
                $data['newversion'] = '未知';
            }
            $res = model('Version')->saveData($data);
            if($res['code']>1){
                return $this->error($res['msg']);
            }
        }
        $this->success($res['msg']);
    }

}
