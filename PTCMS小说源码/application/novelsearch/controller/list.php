<?php
class listController extends CommonController
{
    public function topAction()
    {
	
        $order = I('get.type', 'en', 'weekvisit');
        //$zym_6 = $this->model('top')->getlist();
        $siteid = I('get.page', 'int', '0');
		 $zym_6 = (new NovelSearch_SiteModel())->field(['id','name', 'url', 'key'])->where(['id' => $siteid])->find();
		 if($zym_6){
			 $this->view->totalnum = M('novelsearch_info')->getcount(array('siteid'=>$siteid)); 
              $this->view->toplist = M('novelsearch_info')->getpagelist(array('siteid'=>$siteid), $order, 0, 30);
		 }else{
			  $this->view->totalnum = M('novelsearch_info')->getcount(array()); 
              $this->view->toplist = M('novelsearch_info')->getpagelist(array(), $order, 0, 30);
			  $zym_6 = Array ( 'id' => 1,'name' =>C('sitename'));
		 }
        $this->view->order =$order;
		$this->view->topinfo =$zym_6;
        //$this->view->pageurl = U('novelsearch.list.top', array('type' => $order, 'si' => '__PAGE__'));
        //$this->view->top = array('key' => $zym_8, 'name' => $zym_6[$zym_8]['name'], 'url' => $zym_6[$zym_8]['url']);
        $this->display('top');
    }
    public function categoryAction()
    {
        $zym_8 = I('get.key', 'en', 'all');
		$isover = I('get.isover', 'int', '0');
		$chapternum = I('get.chapternum', 'int', '0');
		$order = I('get.order', 'en', 'lastupdate');
        $zym_9 = M('category')->getinfobykey($zym_8);
        $zym_7 = array();
        if ($zym_8 != 'all' && $zym_8 != 'man' && $zym_8 != 'nv') {
            $zym_7['categoryid'] =  $zym_9['id'];
        }else{
		    $zym_9['group'] =1;
		}
		if($zym_8 == 'man' ){
		   $zym_7['group'] = array('IN','1,2,3,4,5,6,7,8,9,10');
		   $zym_9['group'] =1;
		}else if($zym_8 == 'nv' ){
		   $zym_7['categoryid'] = array('IN','11,12,13,14,15,16,17');
		   $zym_9['group'] =2;
		}
		if($isover ==1){
		   $zym_7['isover'] = 0;
		}else if($isover ==2){
		   $zym_7['isover'] = 1;
		}
		if($chapternum ==1){
		   $zym_7['chaptersign'] = array ('<',500);
		}else if($chapternum ==2){
		   $zym_7['chaptersign'] = array ('BETWEEN','500,1000');
		}else if($chapternum ==3){
		   $zym_7['chaptersign'] = array ('>',1000);
		}
        $this->view->category = $this->view->info = $zym_9;
        $this->view->page = I('get.page', 'int', 1);
        $this->view->pagesize = C('pagesize_categorylist');
        $this->view->totalnum = M('novelsearch_info')->getcount($zym_7);
        $this->view->categorylist = $this->view->list = M('novelsearch_info')->getpagelist($zym_7, $order , $this->view->page, $this->view->pagesize);
		//echo M('novelsearch_info')->getlastsql();
		$this->view->set($_GET);
        $this->view->pageurl = U('novelsearch.list.category', array('key' => $zym_8,'chapternum' => $_GET['chapternum'],'isover' => $_GET['isover'],'order' => $_GET['order'], 'page' => '__PAGE__'));
        $this->display('category');
    }
    public function overAction()
    {
        $zym_5 = new NovelSearch_infoModel();
        $this->view->page = I('get.page', 'int', 1);
        $this->view->pagesize = C('pagesize_toplist');
        $this->view->totalnum = $zym_5->getcount(['isover' => 1]);
        $this->view->overlist = $zym_5->getpagelist(['isover' => 1], 'lastupdate', $this->view->page, $this->view->pagesize);
        $this->view->pageurl = U('novelsearch.list.over', array('page' => '__PAGE__'));
        $this->display('over');
    }
    public function searchAction()
    {
        $zym_5 = new NovelSearch_infoModel();
        $this->view->page = I('get.page', 'int', 1);
        $this->view->pagesize = C('pagesize_toplist');
        $this->view->totalnum = $zym_5->getcount(['isover' => 1]);
        $this->view->overlist = $zym_5->getpagelist(['isover' => 1], 'lastupdate', $this->view->page, $this->view->pagesize);
        $this->view->pageurl = U('novelsearch.list.over', array('page' => '__PAGE__'));
        $this->display('search');
    }
}