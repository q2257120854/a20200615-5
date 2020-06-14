<?php defined('PT_ROOT') || exit('Permission denied');?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php if ($_parsetplfile=parseTpl($tkd['title'])){include $_parsetplfile;}?></title>
    <meta name="keywords" content="<?php if ($_parsetplfile=parseTpl($tkd['keywords'])){include $_parsetplfile;}?>" />
    <meta name="description" content="<?php if ($_parsetplfile=parseTpl($tkd['description'])){include $_parsetplfile;}?>" />
    <meta name="applicable-device" content="pc">
    <meta name="renderer" content="webkit">
   <meta name="viewport" content="width=device-width" />
   <meta http-equiv="Cache-Control" content="no-siteapp" />
   <meta http-equiv="Cache-Control" content="no-transform " />
    <meta http-equiv="mobile-agent" content="format=html5; url=<?php echo $this->pt->config->get("wapurl");?><?php echo __SELF__;?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->pt->config->get("resurl");?><?php echo __TMPL__;?>/v<?php echo $this->pt->config->get("tplconfig.demo");?>/css/common.css">
    <script type="text/javascript" src="<?php echo $this->pt->config->get("resurl");?><?php echo __TMPL__;?>/js/common.js"></script>
</head>
<body>
<div class="header">
	<div class="layui-main">
		<a class="logo" href="<?php echo $this->pt->config->get("siteurl");?>"><i class="iconfont icon-logo"></i><?php echo $this->pt->config->get("sitename");?></a>
		<a class="history" href="<?php echo U("user.history.index",array());?>"><i class="layui-icon i_history"></i>阅读历史</a>
		<ul class="nav">
			<li ><a href="<?php echo $this->pt->config->get("siteurl");?>">首页</a></li>
			<li class="on"><a href="<?php echo U("novelsearch.list.category",array('key'=>0,'chapternum'=>0,'isover'=>0,'order'=>'lastupdate','page'=>1));?>">书库大全</a></li>
			<li ><a href="<?php echo U("novelsearch.index.category",array());?>">小说分类</a></li>
			<li ><a href="<?php echo U("novelsearch.index.top",array());?>">排行榜</a></li>
			<li ><a href="<?php echo U("novelsearch.list.over",array());?>">完本</a></li>
		</ul>
		<form action="<?php echo U("novelsearch.search.result",array());?>" class="search">
			<input type="text" name="searchkey" placeholder="请输入搜索内容！" autocomplete="off">
			<button type="submit" class="layui-icon i_search"></button>
		</form>
	</div>
</div>
<div class="main">
	<div class="layui-main">
		<div class="box left w_260">
			<ul class="filter">
				<li>
					<dl>
						<dt>分类：</dt>
						<?php $list=$this->pt->block->getdata('categorylist',array('pid'=>0));?>
                        <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
						<dd <?php if($category['key'] == $loop['key']):?>class="on"<?php endif;?>><a href="<?php echo U("novelsearch.list.category",array('key'=>$loop['key'],'chapternum'=>$chapternum,'isover'=>$isover,'order'=>$order,'page'=>$page));?>"><?php echo $loop['name'];?></a></dd>
						<?php endforeach; endif;?>
					</dl>
				</li>
				<li>
					<dl>
						<dt>状态：</dt>
						<dd <?php if($isover == 0):?>class="on"<?php endif;?>><a href="<?php echo U("novelsearch.list.category",array('key'=>$category['key'],'chapternum'=>$chapternum,'isover'=>0,'order'=>$order,'page'=>$page));?>">全部</a></dd>
						<dd <?php if($isover == 1):?>class="on"<?php endif;?>><a href="<?php echo U("novelsearch.list.category",array('key'=>$category['key'],'chapternum'=>$chapternum,'isover'=>1,'order'=>$order,'page'=>$page));?>">连载中</a></dd>
						<dd <?php if($isover == 2):?>class="on"<?php endif;?>><a href="<?php echo U("novelsearch.list.category",array('key'=>$category['key'],'chapternum'=>$chapternum,'isover'=>2,'order'=>$order,'page'=>$page));?>">已完本</a></dd>
					</dl>
				</li>
				<li>
					<dl>
						<dt>章节：</dt>
						<ds <?php if($chapternum == 0):?>class="on"<?php endif;?>><a href="<?php echo U("novelsearch.list.category",array('key'=>$category['key'],'chapternum'=>'0','isover'=>$isover,'order'=>$order,'page'=>$page));?>">全部</a></ds>
						<ds <?php if($chapternum == 1):?>class="on"<?php endif;?>><a href="<?php echo U("novelsearch.list.category",array('key'=>$category['key'],'chapternum'=>'1','isover'=>$isover,'order'=>$order,'page'=>$page));?>">500章以下</a></ds>
						<ds <?php if($chapternum == 2):?>class="on"<?php endif;?>><a href="<?php echo U("novelsearch.list.category",array('key'=>$category['key'],'chapternum'=>'2','isover'=>$isover,'order'=>$order,'page'=>$page));?>">500章-1000章</a></ds>
						<ds <?php if($chapternum == 3):?>class="on"<?php endif;?>><a href="<?php echo U("novelsearch.list.category",array('key'=>$category['key'],'chapternum'=>'3','isover'=>$isover,'order'=>$order,'page'=>$page));?>">1000章以上</a></ds>
					</dl>
				</li>
			</ul>
		</div>
		<div class="box right w_840">
			<ul class="order">
				<li>排序</li>
				<li <?php if($order == allvisit):?>class="on"<?php endif;?><?php if($order == monthvisit):?>class="on"<?php endif;?><?php if($order == weekvisit):?>class="on"<?php endif;?><?php if($order == dayvisit):?>class="on"<?php endif;?>>
					<dl>
						<dt><?php if($order == votenum):?>点击<?php endif;?><?php if($order == marknum):?>点击<?php endif;?><?php if($order == lastupdate):?>点击<?php endif;?><?php if($order == postdate):?>点击<?php endif;?><?php if($order == allvisit):?>总点击<?php endif;?><?php if($order == monthvisit):?>月点击<?php endif;?><?php if($order == weekvisit):?>周点击<?php endif;?><?php if($order == dayvisit):?>日点击<?php endif;?><i class="layui-icon"></i></dt>
						<dd><a href="<?php echo U("novelsearch.list.category",array('key'=>$category['key'],'chapternum'=>$chapternum,'isover'=>$isover,'order'=>'allvisit','page'=>$page));?>">总点击</a></dd>
						<dd><a href="<?php echo U("novelsearch.list.category",array('key'=>$category['key'],'chapternum'=>$chapternum,'isover'=>$isover,'order'=>'monthvisit','page'=>$page));?>">月点击</a></dd>
						<dd><a href="<?php echo U("novelsearch.list.category",array('key'=>$category['key'],'chapternum'=>$chapternum,'isover'=>$isover,'order'=>'weekvisit','page'=>$page));?>">周点击</a></dd>
						<dd><a href="<?php echo U("novelsearch.list.category",array('key'=>$category['key'],'chapternum'=>$chapternum,'isover'=>$isover,'order'=>'dayvisit','page'=>$page));?>">日点击</a></dd>
					</dl>
				</li>
				<li <?php if($order == votenum):?>class="on"<?php endif;?>><a href="<?php echo U("novelsearch.list.category",array('key'=>$category['key'],'chapternum'=>$chapternum,'isover'=>$isover,'order'=>'votenum','page'=>$page));?>">推荐</a></li>
				<li <?php if($order == marknum):?>class="on"<?php endif;?>><a href="<?php echo U("novelsearch.list.category",array('key'=>$category['key'],'chapternum'=>$chapternum,'isover'=>$isover,'order'=>'marknum','page'=>$page));?>">收藏</a></li>
				<li <?php if($order == lastupdate):?>class="on"<?php endif;?>><a href="<?php echo U("novelsearch.list.category",array('key'=>$category['key'],'chapternum'=>$chapternum,'isover'=>$isover,'order'=>'lastupdate','page'=>$page));?>">最新</a></li>
				<li <?php if($order == postdate):?>class="on"<?php endif;?>><a href="<?php echo U("novelsearch.list.category",array('key'=>$category['key'],'chapternum'=>$chapternum,'isover'=>$isover,'order'=>'postdate','page'=>$page));?>">入库</a></li>
				<li class="right"><a href="<?php echo U("novelsearch.list.category",array('key'=>0,'chapternum'=>0,'isover'=>0,'order'=>'lastupdate','page'=>1));?>"><i class="layui-icon i_refresh"></i> 重置</a></li>
			</ul>
			<ul class="library">
			    <?php if(is_array($categorylist)): foreach($categorylist as $key =>$loop):?>
				<li>
					<a class="bookimg" href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
					<a class="bookname" href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a>
					<span class="layui-badge layui-bg-blue"><?php echo defaultvar($loop['novel']['isover'],"连载中","已完结");?></span>
					<p>作者：<a class="author" href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a><i>|</i><a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a><i>|</i><?php echo cntime($loop['last']['time']);?></p>
					<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,60,'utf-8');?></p>
					<a class="chapter" href="<?php echo $loop['last']['url'];?>"><?php echo $loop['last']['name'];?></a>
				</li>
				<?php endforeach; endif;?>
			</ul>
			<div class="clear"></div>
			<div class="page">
			    <?php $pagelist=$this->pt->block->getdata('page',array('totalnum'=>$totalnum,'page'=>$page,'pagesize'=>$pagesize,'maxpage'=>0,'section'=>3));?>
				<?php if($pagelist['page'] == 1):?>
				<em class="layui-disabled">首页</em>
				<em class="layui-disabled">上一页</em>
				<?php else:?>
				<a href="<?php echo str_replace('__PAGE__',$pagelist['first']['num'],$pageurl);?>">首页</a>
                <a href="<?php echo str_replace('__PAGE__',$pagelist['first']['num'],$pageurl);?>">上一页</a>
                <?php endif;?>
                <?php if(is_array($pagelist['num'])): foreach($pagelist['num'] as $key =>$loop):?>
                <?php if($loop['status']):?>				
				<em class="on"><?php echo $loop['num'];?></em>
                <?php else:?>				
				<a href="<?php echo str_replace('__PAGE__',$loop['num'],$pageurl);?>"><?php echo $loop['num'];?></a>
                <?php endif;?>
                <?php endforeach; endif;?>		
				<a href="<?php echo str_replace('__PAGE__',$pagelist['next']['num'],$pageurl);?>">下一页</a>	
				<a href="<?php echo str_replace('__PAGE__',$pagelist['last']['num'],$pageurl);?>">尾页</a>		
			</div>
		</div>
	</div>
</div>
<div class="footer">
	<p>Copyright &copy; 2018 <a href="<?php echo $this->pt->config->get("siteurl");?>"><?php echo $this->pt->config->get("sitename");?> (<?php echo mb_substr($this->pt->config->get("siteurl"),8,50,'utf-8');?>)</a> All Rights Reserved</p>
</div>
<!-- cnzz stats -->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?65a0ed88070a14ee714298c4909d68e8";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</body>
</html>