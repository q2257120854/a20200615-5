<?php
namespace app\api\controller;

use think\Controller;

class Index extends Base
{
    public function __construct()
    {
        parent::__construct();
    }
    public function play()
    {
        $param = mac_param_url();
        //$this->assign('param',$param);

        //if(empty($info)) {
        $res = mac_label_vod_detail($param);
        $info = $this->label_vod_play('play');

        return json($res);
    }
    public function vodtype()
    {
        // $param = input();
        // $name = input('name','vod');
        $info = Model('type')->select();
        $param['num'] = 6;

        $param['order'] = "desc";
        $param['by'] = "time";
        foreach ($info as $k => $v) {
            $param['type'] = $v['type_id'];
            $d = Model('vod')->listCacheData($param);
            $data[$v['type_id']] = $d['list'];
        }
        return json($data);

    }

    public function plays()
    {
        $param = input();
        $param['page'] = intval($param['page']) < 1 ? 1 : intval($param['page']);
        $param['limit'] = intval($param['limit']) < 20 ? 20 : intval($param['limit']);

        $where = [];
        $where['user_id'] = $GLOBALS['user']['user_id'];
        $where['ulog_mid'] = 1;
        $where['ulog_type'] = 4;
        $order = 'ulog_id desc';
        $res = model('Ulog')->listData($where, $order, $param['page'], $param['limit']);

        return json($res);
    }

    public function downs()
    {
        $param = input();
        $param['page'] = intval($param['page']) < 1 ? 1 : intval($param['page']);
        $param['limit'] = intval($param['limit']) < 20 ? 20 : intval($param['limit']);

        $where = [];
        $where['user_id'] = $GLOBALS['user']['user_id'];
        $where['ulog_mid'] = 1;
        $where['ulog_type'] = 5;
        $order = 'ulog_id desc';
        $res = model('Ulog')->listData($where, $order, $param['page'], $param['limit']);

        return json($res);
    }

    public function favs()
    {
        $param = input();
        $param['page'] = intval($param['page']) < 1 ? 1 : intval($param['page']);
        $param['limit'] = intval($param['limit']) < 20 ? 20 : intval($param['limit']);

        $where = [];
        $where['user_id'] = $GLOBALS['user']['user_id'];
        $where['ulog_type'] = 2;
        $order = 'ulog_id desc';
        $res = model('Ulog')->listData($where, $order, $param['page'], $param['limit']);
        return json($res);
    }

    public function ulog_del()
    {
        $param = input();
        $ids = $param['ids'];
        $type = $param['type'];
        $all = $param['all'];

        if (!in_array($type, array('1', '2', '3', '4', '5'))) {
            return json(['code' => 1001, 'msg' => '参数错误']);
        }

        if (empty($ids) && empty($all)) {
            return json(['code' => 1001, 'msg' => '参数错误']);
        }

        $arr = [];
        $ids = explode(',', $ids);
        foreach ($ids as $k => $v) {
            $v = intval(abs($v));
            $arr[$v] = $v;
        }

        $where = [];
        $where['user_id'] = $GLOBALS['user']['user_id'];
        $where['ulog_type'] = $type;
        if ($all != '1') {
            $where['ulog_id'] = array('in', implode(',', $arr));
        }
        $return = model('Ulog')->delData($where);
        return json($return);
    }
    public function actor()
    {
        $param = mac_param_url();

        $res = mac_label_actor_detail($param);
        return json($res);
    }
    public function vod()
    {
        $param = mac_param_url();

        $res = mac_label_vod_detail($param);

        return json($res);
    }
    public function topic()
    {
        $param = mac_param_url();

        $res = mac_label_topic_detail($param);

        return json($res);
    }
    public function tree()
    {
        $order = 'type_sort asc';
        $where = [];
        $res = model('Type')->listData($where, $order, 'tree');
        return json($res);
    }

    public function index()
    {
        $param = input();
        $name = input('maccms', 'vod');
        $info = Model($name)->listCacheData($param);
        return json($info);

    }
    public function config()
    {
        $maccms = $GLOBALS['config']['site'];
        $maccms['path'] = MAC_PATH;
        $maccms['path_tpl'] = MAC_PATH_TEMPLATE;
        $maccms['path_ads'] = MAC_PATH_ADS;
        $maccms['user_status'] = $GLOBALS['config']['user']['status'];
        $maccms['date'] = date('Y-m-d');

        $maccms['search_hot'] = $GLOBALS['config']['app']['search_hot'];
        $maccms['art_extend_class'] = $GLOBALS['config']['app']['art_extend_class'];
        $maccms['vod_extend_class'] = $GLOBALS['config']['app']['vod_extend_class'];
        $maccms['vod_extend_state'] = $GLOBALS['config']['app']['vod_extend_state'];
        $maccms['vod_extend_version'] = $GLOBALS['config']['app']['vod_extend_version'];
        $maccms['vod_extend_area'] = $GLOBALS['config']['app']['vod_extend_area'];
        $maccms['vod_extend_lang'] = $GLOBALS['config']['app']['vod_extend_lang'];
        $maccms['vod_extend_year'] = $GLOBALS['config']['app']['vod_extend_year'];
        $maccms['vod_extend_weekday'] = $GLOBALS['config']['app']['vod_extend_weekday'];
        $maccms['actor_extend_area'] = $GLOBALS['config']['app']['actor_extend_area'];

        $maccms['http_type'] = $GLOBALS['http_type'];

        if (!empty($GLOBALS['mid'])) {
            $maccms['mid'] = $GLOBALS['mid'];
        } else {
            $maccms['mid'] = mac_get_mid($this->_cl);
        }
        if (!empty($GLOBALS['aid'])) {
            $maccms['aid'] = $GLOBALS['aid'];
        } else {
            $maccms['aid'] = mac_get_aid($this->_cl, $this->_ac);
        }

        $info = ['code' => 1, 'msg' => '数据列表', 'list' => $maccms];

        return json($info);

    }
}
