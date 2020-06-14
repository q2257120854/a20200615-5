<?php
class CollectController extends AdminController 
{
	public function init() 
	{
		parent::init();
		$this->list = array();
		$this->model = new ruleModel();
	}
	public function indexAction() 
	{
		$this->list = $this->model->field('id,name,siteid,create_user_id,create_time,update_user_id,update_time')->order('id asc')->getlist();
		$this->display();
	}
	public function addAction() 
	{
		if (IS_POST) 
		{
			if ($var_1727 = $this->model->add($_POST)) 
			{
				$this->success('添加成功', U('test', array('id' => $var_1727)));
			}
			else 
			{
				$this->error('添加失败');
			}
		}
		$this->sitelist = M('novelsearch_site')->where(array('status' => 1))->order('id asc')->getfield('id,name', true);
		$this->display();
	}
	public function editAction() 
	{
		$this->id = I('request.id', 'int', 0);
		if (IS_POST) 
		{
			if ($this->model->edit($_POST, ['id' => $this->id])) 
			{
				$this->success('修改成功', U('test', array('id' => $_POST['id'])));
			}
			else 
			{
				$this->error('修改失败', $this->model->geterror());
			}
		}
		$this->sitelist = M('novelsearch_site')->where(array('status' => 1))->order('id asc')->getfield('id,name', true);
		$this->display();
	}
	public function ajaxAction() 
	{
		$var_53 = I('request.id', 'int', 0);
		$var_1465 = $this->model->geteditinfo($var_53);
		$this->ajax($var_1465);
	}
	public function testAction() 
	{
		ob_start();
		$var_1730 = I('request.id', 'int', 0);
		if ($var_1730) 
		{
			$var_1731 = new collectModel($var_1730);
			$var_1731->test();
		}
		else 
		{
			$this->error('找不到指定的规则');
		}
	}
	public function runAction() 
	{
		$this->id = I('request.id', 'int', 0);
		if (IS_POST) 
		{
			if (!$this->id) 
			{
				$this->error('请选择规则');
			}
			$var_1733 = I('interval', 'int', '30');
			if (empty($_POST['status'])) 
			{
				$this->redirect($this->config->get('cronurl', $this->config->get('siteurl')) . U('rule.collect.go', array('id' => $this->id, 'interval' => $var_1733)));
			}
			$var_1734 = M('cron')->where(array('action' => 'cron.task.collect', 'param' => $this->id))->find();
			if ($var_1734) 
			{
				$this->error('规则已经在计划任务中了');
			}
			else 
			{
				$var_1735 = $this->model->field('name')->find($this->id);
				if ($var_1733 == 0) $var_1733 = 1;
				$var_1736 = array( 'name' => $var_1735['name'], 'action' => 'cron.task.collect', 'param' => $this->id, 'interval' => $var_1733, );
				if (M('cron')->add($var_1736)) 
				{
					$this->success('处理成功', U('cron.manage.index'));
				}
				else 
				{
					$this->error('处理失败');
				}
			}
		}
		$this->list = $this->model->field('id,name')->order('id asc')->select();
		$this->display();
	}
	public function goAction() 
	{
		ob_start();
		$var_1738 = I('request.interval', 'int', 0);
		$var_1739 = $this->input->request('id');
		$var_451 = new CollectModel($var_1739);
		$var_451->collectlist();
		if ($var_1738 > 0) 
		{
			$var_1738 *= 1000;
			$this->show('<script type="text/javascript">setTimeout(function(){window.location.href="' . __SELF__ . '";},' . $var_1738 . ')</script>');
		}
	}
	public function listAction() 
	{
		$this->ruleid = $var_1753 = $this->input->request('id');
		if (isset($_GET['startid'])) 
		{
			$var_1742 = [ 'id' => $var_1753, 'startid' => $this->input->request('startid', 'int', 1), 'endid' => $this->input->request('endid', 'int', 0), 'interval' => $this->input->request('interval', 'int', 10), 'url' => $this->input->request('url', 'str', ''), 'runid' => $this->input->request('runid', 'int', 1), ];
			if (!$var_1742['endid']) $var_1742['endid'] = $var_1742['startid'];
			if ($var_1742['runid'] < $var_1742['startid']) $var_1742['runid'] = $var_1742['startid'];
			if ($var_1742['runid'] > $var_1742['endid']) 
			{
				$this->success('采集完成', '', 0);
			}
			if (!$var_1753) 
			{
				$this->error('请选择规则');
			}
			$var_1743 = new CollectModel($var_1753);
			$var_1743->collectlist($var_1742['url'], $var_1742['runid']);
			$var_1742['runid']++;
			$this->show('<script type="text/javascript">setTimeout(function(){window.location.href="' . U('rule.collect.list', $var_1742) . '";},' . $var_1742['interval'] * 1000 . ')</script>');
		}
		else 
		{
			$this->list = $this->model->field('id,name')->order('id asc')->select();
			$this->display();
		}
	}
	public function idAction() 
	{
		$this->ruleid = $var_1745 = $this->input->request('id');
		if (isset($_GET['startid'])) 
		{
			$var_1746 = $this->input->request('startid', 'str', 1);
			$var_182 = $this->input->request('endid', 'int', 0);
			if (!$var_1745) 
			{
				$this->error('请选择规则');
			}
			if (!$var_1746) 
			{
				$this->error('请输入起始书号');
			}
			$var_1124 = new CollectModel($var_1745);
			if (!$var_182) 
			{
				$var_1124->collectidone($var_1746);
			}
			else 
			{
				$var_1747 = $this->input->request('runid', 'int', $var_1746);
				if ($var_1747 < $var_1746) 
				{
					$var_1747 = $var_1746;
				}
				$var_19 = $this->input->request('limit', 'int', 100);
				$var_1748 = $this->input->request('interval', 'int', 10);
				if ($var_1747 > $var_182) 
				{
					$this->success('采集完成', '', 0);
				}
				$var_1749 = $var_1747 + $var_19;
				if ($var_1749 > $var_182) 
				{
					$var_1749 = $var_182 + 1;
				}
				$var_1124->collectid($var_1747, $var_1749);
				$var_1747 = $var_1749;
				$this->show('<script type="text/javascript">setTimeout(function(){window.location.href="' . U('rule.collect.id', ['id' => $var_1745, 'startid' => $var_1746, 'endid' => $var_182, 'limit' => $var_19, 'interval' => $var_1748, 'runid' => $var_1747]) . '";},' . $var_1748 * 1000 . ')</script>');
			}
		}
		else 
		{
			$this->list = $this->model->field('id,name')->order('id asc')->select();
			$this->display();
		}
	}
	public function updateinfoAction() 
	{
		if ($this->request->isPost()) 
		{
			$var_1766 = $this->getnovelids();
			$var_1752=[];
			$var_1752['id']=['in',$var_1766];
			if(isset($_POST['emptycover']))
			{
				$var_1752['cover']='';
			}
			if(isset($_POST['emptyintro']))
			{
				$var_1752['intro']='';
			}
			$var_1753 = $this->input->post('ruleid');
			$var_1766=(new NovelSearch_infoModel())->where($var_1752)->getField('id',true);
			$var_374 = new Collect_OpModel();
			foreach($var_1766 as $var_297)
			{
				$var_374->updateinfo($var_297, $var_1753);
			}
		}
		else 
		{
			$this->rulelist = $this->model('rule')->field('id,name')->order('id asc')->select();
			$this->display();
		}
	}
	public function reAction() 
	{
		if ($this->request->isPost()) 
		{
			$var_1757 = $this->getnovelids();
			$var_1758 = $this->input->post('ruleid');
			$var_1759 = $this->input->post('chapter');
			if ($var_1759) 
			{
				$var_1759 = [$this->input->get('chapterstarttime', 'time', 0), $this->input->get('chapterendtime', 'time', 0)];
			}
			$var_1242 = new Collect_OpModel();
			foreach ($var_1757 as $var_1760) 
			{
				if ($var_1760) 
				{
					$var_1242->recollect($var_1760, $var_1758, $var_1759);
				}
			}
		}
		else 
		{
			$this->rulelist = $this->model('rule')->field('id,name')->order('id asc')->select();
			$this->display();
		}
	}
	public function reorderAction() 
	{
		if ($this->request->isPost()) 
		{
			$var_1762 = $this->getnovelids();
			$var_1763 = [$this->input->post('ruleid1'), $this->input->post('ruleid2'), $this->input->post('ruleid3')];
			$var_1763 = array_unique(array_filter($var_1763, function ($v_1) 
			{
				return $v_1 > 0;
			}
			));
			$var_374 = new Collect_OpModel();
			foreach ($var_1762 as $var_297) 
			{
				if ($var_297) 
				{
					$var_374->reorder($var_297, $var_1763);
				}
			}
		}
		else 
		{
			$this->rulelist = $this->model('rule')->field('id,name')->order('id asc')->select();
			$this->display();
		}
	}
	protected function getnovelids() 
	{
		switch ($this->input->post('type')) 
		{
			case 0: $var_1765 = $this->input->post('novelid');
			if (!$var_1765) 
			{
				$this->error('未获取到书号');
			}
			return [$var_1765];
			case 1: $var_1766 = explode('|', $this->input->post('novelids', 'str', ''));
			if (!$var_1766) 
			{
				$this->error('未获取到书号');
			}
			return $var_1766;
			case 2: $var_1767 = $this->input->post('startid', 'int', 0);
			$var_1768 = $this->input->post('endid', 'int', 0);
			if ($var_1767 == 0 || $var_1767 > $var_1768) 
			{
				$this->error('书号范围有误');
			}
			$var_1766 = [];
			for ($var_28 = $var_1767; $var_28 <= $var_1768; $var_28++) 
			{
				$var_1766[] = $var_28;
			}
			return $var_1766;
			case 3: $var_1769 = strtotime($this->input->post('startupdatetime', 'str'));
			$var_1770 = strtotime($this->input->post('endupdatetime', 'str'));
			if ($var_1769 == 0 || $var_1769 > $var_1770) 
			{
				$this->error('书号范围有误');
			}
			$var_1766 = (new NovelSearch_infoModel())->where(['lastupdate' => ['bwtween', [$var_1769, $var_1770]]])->getField('novelid', true);
			if (!$var_1766) 
			{
				$this->error('未获取到书号');
			}
			return $var_1766;
			case 4: $var_1769 = strtotime($this->input->post('startupdatetime', 'str'));
			$var_1770 = strtotime($this->input->post('endupdatetime', 'str'));
			if ($var_1769 == 0 || $var_1769 > $var_1770) 
			{
				$this->error('书号范围有误');
			}
			$var_1766 = (new NovelSearch_infoModel())->where(['lastupdate' => ['bwtween', [$var_1769, $var_1770]]])->getField('novelid', true);
			if (!$var_1766) 
			{
				$this->error('未获取到书号');
			}
			return $var_1766;
		}
	}
} ?>