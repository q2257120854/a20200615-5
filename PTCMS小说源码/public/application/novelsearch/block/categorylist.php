<?php
class categorylistBlock extends Block
{
    public function run($zym_8)
    {
        $zym_6 = I('pid', 'int', 0, $zym_8);
		//$ids = $zym_8['ids'];
		$where['status'] = 1;
        $where['pid'] =$zym_6;
		if($ids){
		   $where['id'] = array('IN',$ids);
		}
        $zym_9 = M('category')->field('id,name,key')->where($where)->order('id asc')->select();
       if (!isset($zym_8['all']) || $zym_8['all']) {
           array_unshift($zym_9, array('id' => 0, 'key' => 'all', 'name' => C('caption_allcateogry')));
        }
        $zym_5 = new NovelSearch_infoModel();
        foreach ($zym_9 as &$zym_7) {
            $zym_7['url'] = U('novelsearch.list.category', array('key' => $zym_7['id'],'chapternum' => 0,'isover' => 0,'order' => 'lastupdate','page' => 1));
            if ($zym_7['id'] == 0) {
                $zym_7['num'] = $zym_5->getcount([]);
            } else {
                $zym_7['num'] = $zym_5->getcount(['categoryid' => $zym_7['id']]);
            }
        }
        return $zym_9;
    }
}