<?php
class SiteController extends AdminController {
    public function init() {
        $this->tableName = 'novelsearch_site';
        parent::init();
    }
    public function indexAction() {
        $this->list = $this->model->order('id asc')->getlist();
        $this->display();
    }
    public function addAction() {
        if (IS_POST) {
            $zym_12['name'] = I('name', 'str');
            $zym_12['url'] = I('url', 'str', '');
            $zym_12['key'] = I('key', 'en', '');
            $zym_12['style'] = I('style', 'str', '');
            $zym_12['desc'] = I('desc', 'str', '');
            $zym_12['isoriginal'] = I('isoriginal', 'int', 1);
            $zym_12['status'] = I('status', 'int', 0);
            $zym_12['weight'] = I('weight', 'int', 0);
            $zym_12['ip'] = I('ip', 'int', 1);
            if ($this->model->add($zym_12)) {
                $this->success('添加站点成功', U('index'));
            } else {
                $this->error('添加站点失败');
            }
        }
        $this->display();
    }
    public function editAction() {
        $zym_14 = I('request.id', 'int', 0);
        if (IS_POST) {
            $zym_12['name'] = I('name', 'str');
            $zym_12['url'] = I('url', 'str', '');
            $zym_12['key'] = I('key', 'en', '');
            $zym_12['style'] = I('style', 'str', '');
            $zym_12['desc'] = I('desc', 'str', '');
            $zym_12['isoriginal'] = I('isoriginal', 'int', 1);
            $zym_12['status'] = I('status', 'int', 1);
            $zym_12['weight'] = I('weight', 'int', 0);
            $zym_12['ip'] = I('ip', 'int', 0);
            $zym_12['id'] = $zym_14;
            if ($this->model->edit($zym_12) !== false) {
                $this->success('修改站点成功', U('index'));
            } else {
                $this->error('修改站点失败');
            }
        } elseif ($zym_14 && $zym_11 = $this->model->where(array(
            'id' => $zym_14
        ))->find()) {
            $this->info = $zym_11;
            $this->display();
        } else {
            $this->error('参数不正确');
        }
    }
    public function statAction() {
        $zym_15 = (new NovelSearch_LogModel())->field('count(*) as num,siteid')->group('siteid')->order('num desc')->select();
        $zym_13 = [];
        foreach ($zym_15 as $zym_9) {
            $zym_6 = $this->model->get('novelsearch_site', $zym_9['siteid']);
            if ($zym_6['status']) {
                $zym_9['sitename'] = $zym_6['name'];
            }
            $zym_13[] = $zym_9;
        }
        $this->view->list = $zym_13;
        $this->display();
    }
    public function daystatAction() {
        $zym_5 = $this->input->request('siteid', 'int', 0);
        $zym_8 = $this->input->request('date', 'int', date('Ymd'));
        $zym_10 = ['date' => $zym_8];
        if ($zym_5) {
            $zym_10['siteid'] = $zym_5;
        }
        $zym_13 = (array)M('novelsearch_ipcount')->where($zym_10)->order('ip desc')->select();
        foreach ($zym_13 as & $zym_9) {
            $zym_6 = $this->model()->get('novelsearch_site', $zym_9['siteid']);
            $zym_9['sitename'] = $zym_6['name'];
            $zym_9['siteurl'] = $zym_6['url'];
        }
        $this->view->set('list', $zym_13);
        $this->view->set('siteid', $zym_5);
        $this->view->set('date', $zym_8);
        $this->view->set('sitelist', M('novelsearch_site')->where(['status' => 1])->field('id,name')->select());
        $this->display();
    }
    public function monthstatAction() {
        $zym_5 = $this->input->request('siteid', 'int', 0);
        $zym_8 = substr($this->input->request('date', 'int', date('Ymd')) , 0, 6);
        $zym_10 = ['date' => ['between', [$zym_8 . '01', $zym_8 . '31']]];
        if ($zym_5) {
            $zym_10['siteid'] = $zym_5;
            $zym_13 = (array)M('novelsearch_ipcount')->where($zym_10)->order('ip desc')->select();
        } else {
            $zym_15 = (array)M('novelsearch_ipcount')->where($zym_10)->order('ip desc')->select();
            $zym_13 = [];
            foreach ($zym_15 as $zym_9) {
                if (isset($zym_13[$zym_9['siteid']])) {
                    $zym_13[$zym_9['siteid']]['ip']+= $zym_9['ip'];
                    $zym_13[$zym_9['siteid']]['pv']+= $zym_9['pv'];
                } else {
                    $zym_13[$zym_9['siteid']]['date'] = $zym_8;
                    $zym_13[$zym_9['siteid']]['siteid'] = $zym_9['siteid'];
                    $zym_13[$zym_9['siteid']]['ip'] = $zym_9['ip'];
                    $zym_13[$zym_9['siteid']]['pv'] = $zym_9['pv'];
                }
            }
        }
        foreach ($zym_13 as & $zym_9) {
            $zym_6 = $this->model()->get('novelsearch_site', $zym_9['siteid']);
            $zym_9['sitename'] = $zym_6['name'];
            $zym_9['siteurl'] = $zym_6['url'];
        }
        $this->view->set('list', $zym_13);
        $this->view->set('siteid', $zym_5);
        $this->view->set('date', $zym_8 . '01');
        $this->display();
    }
    public function clearAction() {
        if ($this->request->ispost()) {
            $zym_5 = $this->input->request('siteid');
            if ($zym_5) {
                $zym_7 = new novelsearch_siteModel();
                if (isset($_POST['all'])) {
                    $zym_7->clearlog($zym_5);
                    $zym_7->clearchapter($zym_5);
                } elseif (isset($_POST['log'])) {
                    $zym_7->clearlog($zym_5);
                } else {
                    $this->error('请选择清理操作');
                }
                $this->success('清理完成');
            } else {
                $this->error('请选择站点');
            }
        } else {
            $this->sitelist = $this->model('novelsearch_site')->field('id,name')->order('id asc')->select();
            $this->display();
        }
    }
}
?>
