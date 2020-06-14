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
			<li ><a href="<?php echo U("novelsearch.index.category",array());?>">小说分类</a></li>
			<li class="on"><a href="<?php echo U("novelsearch.index.top",array());?>">排行榜</a></li>
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
			<div class="title part">
				<h2>排行榜</h2>
			</div>
			<ul class="top">
				<li><a href="/top/allvisit.html">总点击小说榜</a></li>
				<li><a href="/top/monthvisit.html">月点击小说榜</a></li>
				<li><a href="/top/weekvisit.html">周点击小说榜</a></li>
				<li><a href="/top/dayvisit.html">日点击小说榜</a></li>
				<li><a href="/top/votenum.html">总推荐小说榜</a></li>
				<li><a href="/top/marknum.html">总收藏小说榜</a></li>
				<li><a href="/top/downnum.html">总下载小说榜</a></li>
				<li><a href="/top/lastupdate.html">最近更新榜</a></li>
				<li><a href="/top/postdate.html">入库新书榜</a></li>
			</ul>
		</div>
		<div class="right w_860">
			<div class="box left w_265">
				<div class="title lite">
					<p>总点击榜</p>
					<a href="<?php echo U("novelsearch.list.top",array('type'=>'allvisit'));?>" class="more">更多 &gt;</a>
				</div>
				<ul class="list bg rank">
				    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"allvisit",'num'=>10));?>
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li class="on">
						<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
						<i class="layui-bg-red">1</i>
						<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></a></p>
						<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					    <p>作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
					    <p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a></p>
					</li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,1,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-orange">2</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,2,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-blue">3</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,3,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-cyan"><?php echo $i['order']+3;;?></i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				</ul>
			</div>
			<div class="box left w_265">
				<div class="title lite">
					<p>推荐排行</p>
					<a href="<?php echo U("novelsearch.list.top",array('type'=>'votenum'));?>" class="more">更多 &gt;</a>
				</div>
				<ul class="list bg rank">
				    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"votenum",'num'=>10));?>
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li class="on">
						<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
						<i class="layui-bg-red">1</i>
						<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></a></p>
						<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					    <p>作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
					    <p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a></p>
					</li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,1,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-orange">2</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,2,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-blue">3</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,3,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-cyan"><?php echo $i['order']+3;;?></i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				</ul>
			</div>
			<div class="box left w_265">
				<div class="title lite">
					<p>收藏排行</p>
					<a href="<?php echo U("novelsearch.list.top",array('type'=>'marknum'));?>" class="more">更多 &gt;</a>
				</div>
				<ul class="list bg rank">
				    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"marknum",'num'=>10));?>
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li class="on">
						<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
						<i class="layui-bg-red">1</i>
						<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></a></p>
						<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					    <p>作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
					    <p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a></p>
					</li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,1,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-orange">2</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,2,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-blue">3</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,3,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-cyan"><?php echo $i['order']+3;;?></i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				</ul>
			</div>
			<div class="box left w_265">
				<div class="title lite">
					<p>月点击榜</p>
					<a href="<?php echo U("novelsearch.list.top",array('type'=>'monthvisit'));?>" class="more">更多 &gt;</a>
				</div>
				<ul class="list bg rank">
				    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"monthvisit",'num'=>10));?>
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li class="on">
						<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
						<i class="layui-bg-red">1</i>
						<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></a></p>
						<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					    <p>作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
					    <p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a></p>
					</li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,1,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-orange">2</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,2,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-blue">3</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				   <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,3,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-cyan"><?php echo $i['order']+3;;?></i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				</ul>
			</div>
			<div class="box left w_265">
				<div class="title lite">
					<p>周点击榜</p>
					<a href="<?php echo U("novelsearch.list.top",array('type'=>'weekvisit'));?>" class="more">更多 &gt;</a>
				</div>
				<ul class="list bg rank">
				    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"weekvisit",'num'=>10));?>
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li class="on">
						<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
						<i class="layui-bg-red">1</i>
						<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></a></p>
						<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					    <p>作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
					    <p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a></p>
					</li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,1,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-orange">2</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,2,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-blue">3</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,3,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-cyan"><?php echo $i['order']+3;;?></i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				</ul>
			</div>
			<div class="box left w_265">
				<div class="title lite">
					<p>日点击榜</p>
					<a href="<?php echo U("novelsearch.list.top",array('type'=>'dayvisit'));?>" class="more">更多 &gt;</a>
				</div>
				<ul class="list bg rank">
				    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"dayvisit",'num'=>10));?>
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li class="on">
						<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
						<i class="layui-bg-red">1</i>
						<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></a></p>
						<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					    <p>作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
					    <p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a></p>
					</li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,1,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-orange">2</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,2,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-blue">3</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,3,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-cyan"><?php echo $i['order']+3;;?></i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				</ul>
			</div>
			<div class="box left w_265">
				<div class="title lite">
					<p>下载排行</p>
					<a href="<?php echo U("novelsearch.list.top",array('type'=>'downnum'));?>" class="more">更多 &gt;</a>
				</div>
				<ul class="list bg rank">
				    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"downnum",'num'=>10));?>
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li class="on">
						<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
						<i class="layui-bg-red">1</i>
						<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></a></p>
						<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					    <p>作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
					    <p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a></p>
					</li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,1,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-orange">2</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,2,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-blue">3</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,3,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-cyan"><?php echo $i['order']+3;;?></i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				</ul>
			</div>
			<div class="box left w_265">
				<div class="title lite">
					<p>最近更新</p>
					<a href="<?php echo U("novelsearch.list.top",array('type'=>'lastupdate'));?>" class="more">更多 &gt;</a>
				</div>
				<ul class="list bg rank">
				    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"lastupdate",'num'=>10));?>
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li class="on">
						<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
						<i class="layui-bg-red">1</i>
						<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></a></p>
						<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					    <p>作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
					    <p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a></p>
					</li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,1,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-orange">2</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,2,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-blue">3</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,3,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-cyan"><?php echo $i['order']+3;;?></i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				</ul>
			</div>
			<div class="box left w_265">
				<div class="title lite">
					<p>最新入库</p>
					<a href="<?php echo U("novelsearch.list.top",array('type'=>'postdate'));?>" class="more">更多 &gt;</a>
				</div>
				<ul class="list bg rank">
				    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"postdate",'num'=>10));?>
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li class="on">
						<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
						<i class="layui-bg-red">1</i>
						<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></a></p>
						<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					    <p>作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
					    <p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a></p>
					</li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,1,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-orange">2</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,2,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-blue">3</i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
					<?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,3,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><i class="layui-bg-cyan"><?php echo $i['order']+3;;?></i><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></li>
					<?php endforeach; endif;?>
				</ul>
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