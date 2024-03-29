<?php
class categoryController extends adminController
{
    public function init()
    {
        $this->tableName = 'category';
        parent::init();
    }
    public function indexAction()
    {
        $zym_8 = new Tree($this->model);
        $zym_10 = $zym_8->getIconList($zym_8->getList(0, 'id,name,ordernum,group,status,key'), 2);
        foreach ($zym_10 as &$zym_9) {
            $zym_9['url_edit'] = U('admin.category.edit', array('id' => $zym_9['id']));
            $zym_9['url_son'] = U('admin.category.add', array('pid' => $zym_9['id']));
        }
        $this->list = $zym_10;
        $this->assign('totalnum', count($this->list));
        $this->display();
    }
    public function addAction()
    {
        if (IS_POST) {
            $zym_7['name'] = I('name', 'str', '');
            $zym_7['key'] = I('key', 'en', '');
            $zym_7['pid'] = I('pid', 'int', 0);
            $zym_7['status'] = I('status', 'int', 1);
			 $zym_7['group'] = I('group', 'int', 1);
            $zym_7['ordernum'] = I('ordernum', 'int', 1);
            $zym_7['create_user_id'] = $_SESSION['admin']['userid'];
            $zym_7['create_time'] = NOW_TIME;
            if ($this->model->add($zym_7)) {
                $this->success('添加成功');
            } else {
                $this->error('添加失败');
            }
        }
        $zym_8 = new Tree($this->model);
        $this->parentlist = $zym_8->getIconList($zym_8->getList(0, 'id,name'));
        $this->display();
    }
    public function editAction()
    {
        $zym_5 = I('request.id', 'int', 0);
        $zym_6 = $this->model->where(array('id' => $zym_5))->find();
        if (IS_POST) {
            if ($zym_6['id'] == $_POST['pid']) {
                $this->error('不能设置自己为上级分类');
            }
            $zym_7['name'] = I('name', 'str', '');
            $zym_7['key'] = I('key', 'en', '');
            $zym_7['pid'] = I('pid', 'int', 0);
            $zym_7['status'] = I('status', 'int', 1);
			$zym_7['group'] = I('group', 'int', 1);
            $zym_7['ordernum'] = I('ordernum', 'int', 1);
            $zym_7['update_user_id'] = $_SESSION['admin']['userid'];
            $zym_7['update_time'] = NOW_TIME;
            $zym_7['id'] = $zym_5;
            if ($this->model->edit($zym_7)) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
            }
        }
        $zym_8 = new Tree($this->model);
        $this->parentlist = $zym_8->getIconList($zym_8->getList(0, 'id,name'));
        $this->info = $zym_6;
        $this->display();
    }
}