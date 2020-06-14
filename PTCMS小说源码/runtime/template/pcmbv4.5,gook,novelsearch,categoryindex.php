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
			<li ><a href="<?php echo U("novelsearch.list.category",array('key'=>0,'chapternum'=>0,'isover'=>0,'order'=>'lastupdate','page'=>1));?>">书库大全</a></li>
			<li class="on"><a href="<?php echo U("novelsearch.index.category",array());?>">小说分类</a></li>
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
		<div class="box">
			<div class="path">
				<ul class="nav">
				    <?php $list=$this->pt->block->getdata('categorylist',array('pid'=>0,'cachetime'=>120));?>
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><a href="<?php echo mb_substr($loop['url'],0,6,'utf-8');?><?php echo $loop['key'];?>_0_0_lastupdate_1.html"><?php echo $loop['name'];?></a><span class="layui-badge-rim"><?php echo $loop['num'];?></span></li>
					<?php endforeach; endif;?>
				</ul>
			</div>
		</div>
		<?php $list=$this->pt->block->getdata('categorylist',array('pid'=>0,'num'=>14));?>
        <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,2,8,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
		<div class="box left w_265">
			<div class="title lite">
				<h2><?php echo $loop['name'];?></h2>
				<a href="<?php echo mb_substr($loop['url'],0,6,'utf-8');?><?php echo $loop['key'];?>_0_0_lastupdate_1.html" class="more">更多 &gt;</a>
			</div>
			<div class="list bg">
				<ul class="mini">
				    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"weekvisit",'category'=>$loop['id'],'num'=>10));?>
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li class="on">
						<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
						<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></p>
						<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,33,'utf-8');?></p>
						<p class="author">作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
					</li>
					<?php endforeach; endif;?>
					<?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,1,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li>
						<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></p>
						<p class="author"><a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
					</li>
					<?php endforeach; endif;?>
				</ul>
			</div>
		</div>
		<?php endforeach; endif;?>
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