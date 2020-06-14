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
		<a class="logo" href="<?php echo $this->pt->config->get("siteurl");?>" title="<?php echo $this->pt->config->get("sitename");?>_免费在线读书网_TXT免费下载"><i class="iconfont icon-logo"></i><?php echo $this->pt->config->get("sitename");?></a>
		<a class="history" href="<?php echo U("user.history.index",array());?>"><i class="layui-icon i_history"></i>阅读历史</a>
		<ul class="nav">
			<li class="on"><a href="<?php echo $this->pt->config->get("siteurl");?>" title="<?php echo $this->pt->config->get("sitename");?>_免费在线读书网_TXT免费下载">首页</a></li>
			<li ><a href="<?php echo U("novelsearch.list.category",array('key'=>0,'chapternum'=>0,'isover'=>0,'order'=>'lastupdate','page'=>1));?>" title="<?php echo $this->pt->config->get("siteurl");?>_书库大全">书库大全</a></li>
			<li ><a href="<?php echo U("novelsearch.index.category",array());?>" title="<?php echo $this->pt->config->get("siteurl");?>_小说分类">小说分类</a></li>
			<li ><a href="<?php echo U("novelsearch.index.top",array());?>" title="<?php echo $this->pt->config->get("siteurl");?>_排行榜">排行榜</a></li>
			<li ><a href="<?php echo U("novelsearch.list.over",array());?>" title="<?php echo $this->pt->config->get("siteurl");?>_完本小说在线阅读_完本TXT免费下载">完本</a></li>
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
			<div class="layui-carousel" id="carousel">
				<ul class="recommend" height="380" carousel-item>
					<?php $list=$this->pt->block->getdata('novellist',array('novelid'=>$this->pt->config->get("tplconfig.pictj")));?>
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><img src="<?php echo $this->pt->config->get("tplconfig.pictj1");?>" alt="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"></a></li>
					<?php endforeach; endif;?>
					<?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,1,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><img src="<?php echo $this->pt->config->get("tplconfig.pictj2");?>" alt="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"></a></li>
					<?php endforeach; endif;?>
					<?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,2,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><img src="<?php echo $this->pt->config->get("tplconfig.pictj3");?>" alt="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"></a></li>
					<?php endforeach; endif;?>
					<?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,3,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><img src="<?php echo $this->pt->config->get("tplconfig.pictj4");?>" alt="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"></a></li>
					<?php endforeach; endif;?>
					<?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,4,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li><a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><img src="<?php echo $this->pt->config->get("tplconfig.pictj5");?>" alt="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"></a></li>
					<?php endforeach; endif;?>
				</ul>
			</div>
		</div>
		<div class="clear"></div>
		<div class="box left w_840">
			<div class="title caption">
				<p>精品推荐</p>
			</div>
			<div class="cover">
				<ul class="detail">
				    <?php $list=$this->pt->block->getdata('novellist',array('novelid'=>$this->pt->config->get("tplconfig.zztj")));?>
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li class="layui-anim layui-anim-fadein on">
						<a class="<?php echo defaultvar($loop['novel']['isover'],"bookimg","bookimg finish");?>"  style="width: 180px;height: 240px;" href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
						<a class="bookname" href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><?php echo $loop['novel']['name'];?></a>
						<p class="intro"><?php echo $loop['novel']['intro'];?></p>
						<p><a class="read" href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载">立即阅读 &gt;</a>作者：<a href="<?php echo $loop['author']['url'];?>" title="<?php echo $loop['author']['name'];?> 作品全集"><?php echo $loop['author']['name'];?></a>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html" title="更多<?php echo $loop['category']['name'];?>小说"><?php echo $loop['category']['name'];?></a>热度：<a><span class="layui-badge-rim layui-icon i_visit"> <?php echo $loop['data']['allvisit'];?></span></a>更新：<a><span class="layui-badge-rim layui-icon i_history"> <?php echo cntime($loop['last']['time']);?></span></a></p>
					</li>
					<?php endforeach; endif;?>
					<?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,1,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
				     <li class="layui-anim layui-anim-fadein">
						<a class="<?php echo defaultvar($loop['novel']['isover'],"bookimg","bookimg finish");?>"  style="width: 180px;height: 240px;" href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
						<a class="bookname" href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><?php echo $loop['novel']['name'];?></a>
						<p class="intro"><?php echo $loop['novel']['intro'];?></p>
						<p><a class="read" href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载">立即阅读 &gt;</a>作者：<a href="<?php echo $loop['author']['url'];?>" title="<?php echo $loop['author']['name'];?> 作品全集"><?php echo $loop['author']['name'];?></a>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html" title="更多<?php echo $loop['category']['name'];?>小说"><?php echo $loop['category']['name'];?></a>热度：<a><span class="layui-badge-rim layui-icon i_visit"> <?php echo $loop['data']['allvisit'];?></span></a>更新：<a><span class="layui-badge-rim layui-icon i_history"> <?php echo cntime($loop['last']['time']);?></span></a></p>
					</li>
					 <?php endforeach; endif;?>
				</ul>
				<ul class="tab">
				     <?php $list=$this->pt->block->getdata('novellist',array('novelid'=>$this->pt->config->get("tplconfig.zztj")));?>
				    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li class="on"><a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a></li>
					<?php endforeach; endif;?>
					<?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,1,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
				     <li ><a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a></li>
					 <?php endforeach; endif;?>
				</ul>
			</div>
			<ul class="block">
			    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"dayvisit",'num'=>16));?>
                <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
				<li><span class="light">[<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html" title="更多<?php echo $loop['category']['name'];?>小说"><?php echo $loop['category']['name'];?></a>]</span><a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><?php echo $loop['novel']['name'];?></a></li>
				<?php endforeach; endif;?>
			</ul>
		</div>
		<div class="box right w_260">
			<div class="title caption">
				<p>本周强推</p>
			</div>
			<ul class="list xs rank tab">
			    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"dayvisit",'num'=>8));?>
                <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
				<li class="on">
					<a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
					<i class="layui-bg-red">1</i>
					<p class="bookname"><a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><?php echo $loop['novel']['name'];?></a></p>
					<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					<p class="author">作者：<a href="<?php echo $loop['author']['url'];?>" title="<?php echo $loop['author']['name'];?> 作品全集"><?php echo $loop['author']['name'];?></a></p>
					<p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html" title="更多<?php echo $loop['category']['name'];?>小说"><?php echo $loop['category']['name'];?></a></p>
				</li>
				<?php endforeach; endif;?>
				<?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,1,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
				<li >
					<a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
					<i class="layui-bg-orange">2</i>
					<p class="bookname"><a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><?php echo $loop['novel']['name'];?></a></p>
					<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					<p class="author">作者：<a href="<?php echo $loop['author']['url'];?>" title="<?php echo $loop['author']['name'];?> 作品全集"><?php echo $loop['author']['name'];?></a></p>
					<p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html" title="更多<?php echo $loop['category']['name'];?>小说"><?php echo $loop['category']['name'];?></a></p>
				</li>
				<?php endforeach; endif;?>
				<?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,2,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
				<li >
					<a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
					<i class="layui-bg-blue">3</i>
					<p class="bookname"><a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><?php echo $loop['novel']['name'];?></a></p>
					<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					<p class="author">作者：<a href="<?php echo $loop['author']['url'];?>" title="<?php echo $loop['author']['name'];?> 作品全集"><?php echo $loop['author']['name'];?></a></p>
					<p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html" title="更多<?php echo $loop['category']['name'];?>小说"><?php echo $loop['category']['name'];?></a></p>
				</li>
				<?php endforeach; endif;?>
				<?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,3,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
				<li >
					<a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
					<i class="layui-bg-cyan"><?php echo $i['order']+3;;?></i>
					<p class="bookname"><a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><?php echo $loop['novel']['name'];?></a></p>
					<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					<p class="author">作者：<a href="<?php echo $loop['author']['url'];?>" title="<?php echo $loop['author']['name'];?> 作品全集"><?php echo $loop['author']['name'];?></a></p>
					<p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html" title="更多<?php echo $loop['category']['name'];?>小说"><?php echo $loop['category']['name'];?></a></p>
				</li>
                <?php endforeach; endif;?>
			</ul>
		</div>
		<div class="clear"></div>
		<div class="box">
			<div class="title caption">
				<p>热门推荐</p>
			</div>
			<ul class="hot">
			    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"votenum",'num'=>8,'cachetime'=>3600));?>
                <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
				<li>
					<a class="bookimg" href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
					<a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><?php echo $loop['novel']['name'];?></a>
					<a class="light" href="<?php echo $loop['author']['url'];?>" title="<?php echo $loop['author']['name'];?> 作品全集"><?php echo $loop['author']['name'];?></a>
				</li>
				<?php endforeach; endif;?>
			</ul>
		</div>
		<div class="box left w_740">
			<div class="title lite">
				<p>最近更新</p>
				<a href="<?php echo U("novelsearch.list.top",array('type'=>'lastupdate'));?>" class="more" title="更多最近更新的小说">更多 &gt;</a>
			</div>
			<div class="table">
				<table class="layui-table" lay-even lay-skin="nob">
					<thead>
						<tr>
							<th width="60">分类</th>
							<th width="140">书名</th>
							<th>最新章节</th>
							<th width="85">作者</th>
							<th width="60">更新时间</th>
							<th width="40">状况</th>
						</tr>
					</thead>
					<tbody>
					    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"lastupdate",'num'=>16,'cachetime'=>120));?>
                        <?php if(is_array($list)): foreach($list as $key =>$loop):?>
						<tr>
							<td><a class="light" href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html" title="更多<?php echo $loop['category']['name'];?>小说"><?php echo $loop['category']['name'];?></a></td>
							<td><a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><?php echo $loop['novel']['name'];?></a></td>
							<td><a href="<?php echo $loop['last']['url'];?>" title="<?php echo $loop['novel']['name'];?>最新章节_<?php echo $loop['last']['name'];?>_<?php echo cntime($loop['last']['time']);?>"><?php echo $loop['last']['name'];?></a></td>
							<td><a href="<?php echo $loop['author']['url'];?>" title="<?php echo $loop['author']['name'];?> 作品全集"><?php echo $loop['author']['name'];?></a></td>
							<td><?php echo cntime($loop['last']['time']);?></td>
							<th><?php echo defaultvar($loop['novel']['isover'],"连载","完结");?></th>
						</tr>
						<?php endforeach; endif;?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="box right w_360">
			<div class="title lite">
				<p>最新入站</p>
				<a href="<?php echo U("novelsearch.list.top",array('type'=>'postdate'));?>" class="more" title="更多最新入库的小说">更多 &gt;</a>
			</div>
			<ul class="list bg">
			    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"postdate",'num'=>16));?>
                <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
				<li><span class="light">[<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html" title="更多<?php echo $loop['category']['name'];?>小说"><?php echo $loop['category']['name'];?></a>]</span><a href="<?php echo $loop['url']['info'];?>" title="<?php echo $loop['novel']['name'];?>在线阅读_<?php echo $loop['novel']['name'];?>TXT免费下载"><?php echo $loop['novel']['name'];?></a></li>
				<?php endforeach; endif;?>
			</ul>
		</div>
		<div class="clear"></div>
		<div class="notice">
			<span class="layui-btn layui-btn-xs layui-btn-danger">友情链接</span>
			<?php $list=$this->pt->block->getdata('friendlink',array('num'=>30,'cachetime'=>600));?>
            <?php if(is_array($list)): foreach($list as $key =>$loop):?>
			<a href ="<?php echo $loop['url'];?>" title ="<?php echo $loop['description'];?>" target ="_blank"><?php echo $loop['showname'];?></a>
			<?php endforeach; endif;?>
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