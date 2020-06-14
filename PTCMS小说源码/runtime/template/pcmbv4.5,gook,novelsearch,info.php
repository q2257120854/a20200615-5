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
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta property="og:type" content="novel"/>
    <meta property="og:title" content="<?php echo $novel['name'];?>"/>
    <meta property="og:description" content="<?php echo nl2br($novel['intro']);?>"/>
    <meta property="og:image" content="<?php if(strpos($novel['cover'],'http://')===0):?><?php echo $this->pt->config->get("tplconfig.imgurl");?><?php echo mb_substr($novel['cover'],13,300,'utf-8');?><?php else:?><?php echo $this->pt->config->get("tplconfig.imgurl");?><?php echo mb_substr($novel['cover'],13,300,'utf-8');?><?php endif;?>"/>
    <meta property="og:novel:category" content="<?php echo $category['name'];?>"/>
    <meta property="og:novel:author" content="<?php echo $author['name'];?>"/>
    <meta property="og:novel:book_name" content="<?php echo $novel['name'];?>"/>
    <meta property="og:novel:read_url" content="<?php echo $this->pt->config->get("siteurl");?><?php echo $url['info'];?>"/>
    <meta property="og:url" content="<?php echo $this->pt->config->get("siteurl");?><?php echo $url['first'];?>"/>
    <meta property="og:novel:status" content="<?php echo defaultvar($novel['isover'],"连载中","已完结");?>"/>
    <meta property="og:novel:update_time" content="<?php echo datevar($last['time'],'Y-m-d H:i:s');?>"/>
    <meta property="og:novel:latest_chapter_name" content="<?php echo $last['name'];?>"/>
    <meta property="og:novel:latest_chapter_url" content="<?php echo $this->pt->config->get("siteurl");?><?php echo $last['url'];?>"/>
    <meta property="og:novel:author_link" content="<?php echo $author['url'];?>"/>
    <meta property="og:novel:click_cnt" content="<?php echo $data['allvisit'];?>"/>
</head>
<body article-id="<?php echo $novel['id'];?>">
<div class="header">
	<div class="layui-main">
		<a class="logo" href="<?php echo $this->pt->config->get("siteurl");?>"><i class="iconfont icon-logo"></i><?php echo $this->pt->config->get("sitename");?></a>
		<a class="history" href="<?php echo U("user.history.index",array());?>"><i class="layui-icon i_history"></i>阅读历史</a>
		<ul class="nav">
			<li ><a href="<?php echo $this->pt->config->get("siteurl");?>">首页</a></li>
			<li ><a href="<?php echo U("novelsearch.list.category",array('key'=>0,'chapternum'=>0,'isover'=>0,'order'=>'lastupdate','page'=>1));?>">书库大全</a></li>
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
		<div class="box">
			<div class="path"><a href="<?php echo $this->pt->config->get("siteurl");?>" class="layui-icon i_home"></a><i>&gt;</i><a href="<?php echo mb_substr($category['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $category['name'];?></a><i>&gt;</i><b><?php echo $novel['name'];?></b></div>
		</div>
		<div class="left w_860">
			<div class="box">
				<div class="detail">
					<a class="<?php echo defaultvar($novel['isover'],"bookimg","bookimg finish");?>" href="<?php echo $url['info'];?>"><img src="<?php echo $novel['cover'];?>" alt="<?php echo $novel['name'];?>"></a>
					<h1><?php echo $novel['name'];?></h1>
					<p>作者：<a href="<?php echo $author['url'];?>"><?php echo $author['name'];?></a>分类：<a href="<?php echo mb_substr($category['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $category['name'];?></a>点击：<span class="layui-badge-rim layui-icon i_visit"> <?php echo $data['allvisit'];?></span>　　下载：<span class="layui-badge-rim layui-icon i_vote"> <?php echo $data['downnum'];?></span>　　更新：<span class="layui-badge-rim layui-icon i_history"> <?php echo cntime($last['time']);?></span></p>
					<div class="mod">
						<p class="intro"><?php echo showintro($novel['intro']);?></p>
						<p id="expand">[+展开]</p>
						<p class="action"><?php if($marked):?><a href="<?php echo $lasturl;?>">继续阅读</a><?php else:?><a href="<?php echo $url['first'];?>">开始阅读</a><?php endif;?><a href="<?php echo $url['down'];?>">下载本书</a><?php if($marked):?><a href="<?php echo U("user.mark.del",array('novelid'=>$novel['id']));?>">移除书架</a><?php else:?><a href="<?php echo $url['addmark'];?>">加入书架</a><?php endif;?><a href="<?php echo $url['dir'];?>">查看目录</a></p>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="box">
				<div class="title lite">
					<p>免责声明</p>
					<div class="more"><span class="layui-badge-rim layui-icon i_history"><font color="red"><?php echo $last['name'];?></font></span></div>
				</div>
				<div class="content">
					<p style="font-size: 14px;">① 《<strong><a href="<?php echo $url['info'];?>"><?php echo $novel['name'];?></a></strong>》为作者<strong><a href="<?php echo $author['url'];?>"><?php echo $author['name'];?></a></strong>原创作品，<strong><a href="<?php echo $this->pt->config->get("siteurl");?>"><?php echo $this->pt->config->get("sitename");?></a></strong>为大家提供最新最快最舒适的阅读体验，请大家支持正版。</p>
					<p style="font-size: 14px;">② 《<strong><a href="<?php echo $url['info'];?>"><?php echo $novel['name'];?></a></strong>》为作者<strong><a href="<?php echo $author['url'];?>"><?php echo $author['name'];?></a></strong>所著虚构作品，如有雷同，纯属巧合。</p>
					<p style="font-size: 14px;">③  <strong><a href="<?php echo $this->pt->config->get("siteurl");?>"><?php echo $this->pt->config->get("sitename");?></a></strong>提供一键登录，登录后可永久收藏《<strong><a href="<?php echo $url['info'];?>"><?php echo $novel['name'];?></a></strong>》，方便即时阅读《<strong><a href="<?php echo $url['info'];?>"><?php echo $novel['name'];?></a></strong>》最新章节，这是对作者<strong><a href="<?php echo $author['url'];?>"><?php echo $author['name'];?></a></strong> 的强力支持，相信<strong><a href="<?php echo $author['url'];?>"><?php echo $author['name'];?></a></strong>会给我们提供更多更好的作品。</p>
				</div>
			</div>
			<div class="box">
				<div class="title lite">
					<p><?php echo $novel['name'];?>最新章节</p>
					<span class="more"><a href="<?php echo $url['dir'];?>"><p>共有约<?php echo $last['id'];?>章  </a></span>
				</div>
				<div class="read new">
					<dl class="list">
					    <?php $list=$this->pt->block->getdata('chapterlist',array('novelid'=>$novel['id'],'sort'=>'desc','num'=>12));?>
                        <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
						<dd><a href="<?php echo $loop['url_read'];?>" title="<?php echo $novel['name'];?> <?php echo $loop['name'];?> <?php echo datevar($loop['time'],'Y-m-d H:i:s');?>"><?php echo $loop['name'];?><span class="time">更新：<?php echo datevar($loop['time'],'Y-m-d H:i:s');?></span></a></dd>
						<?php endforeach; endif;?>
				    </dl>
				</div>
			</div>
		</div>
		<div class="right w_280">
			<div class="box">
				<div class="title lite">
					<p>作者作品</p>
					<a class="more" href="<?php echo $author['url'];?>">更多</a>
				</div>
				<div class="layui-carousel" id="carousel">
					<ul class="rest" height="250" carousel-item>
					    <?php $list=$this->pt->block->getdata('authorlist',array('author'=>$author['name']));?>
                        <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
						<li><a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"><?php echo $loop['novel']['name'];?></a></li>
						<?php endforeach; endif;?>
					</ul>
				</div>
			</div>
			<div class="box right w_260">
			<div class="title caption">
				<p>分类推荐</p>
			</div>
			<ul class="list xs rank tab">
			    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"allvisit",'category'=>$category['id'],'num'=>10));?>
                <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
				<li class="on">
					<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
					<i class="layui-bg-red">1</i>
					<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></p>
					<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					<p class="author">作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
					<p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a></p>
				</li>
				<?php endforeach; endif;?>
				<?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,1,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
				<li >
					<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
					<i class="layui-bg-orange">2</i>
					<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></p>
					<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					<p class="author">作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
					<p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a></p>
				</li>
				<?php endforeach; endif;?>
				<?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,2,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
				<li >
					<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
					<i class="layui-bg-blue">3</i>
					<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></p>
					<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					<p class="author">作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
					<p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a></p>
				</li>
				<?php endforeach; endif;?>
				<?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,3,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
				<li >
					<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
					<i class="layui-bg-cyan"><?php echo $i['order']+3;;?></i>
					<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></p>
					<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,24,'utf-8');?></p>
					<p class="author">作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
					<p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a></p>
				</li>
                <?php endforeach; endif;?>
			</ul>
		</div>
		</div>
		<div class="clear"></div>
		<div class="box">
			<div class="title lite">
				<p>其他人正在看</p>
			</div>
			<ul class="vote">
			    <?php $list=$this->pt->block->getdata('novellist',array('sort'=>"marknum",'category'=>$category['id'],'num'=>8));?>
                <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
				<li>
					<a class="bookimg" href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
					<a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a>
					<a class="light" href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a>
				</li>
				<?php endforeach; endif;?>
			</ul>
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