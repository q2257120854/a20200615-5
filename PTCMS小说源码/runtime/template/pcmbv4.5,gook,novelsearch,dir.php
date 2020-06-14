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
<body article-id="<?php echo $novel['id'];?>">
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
		<div class="box">
			<div class="path"><a href="<?php echo $this->pt->config->get("siteurl");?>" class="layui-icon i_home"></a><i>&gt;</i><a href="<?php echo mb_substr($category['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $category['name'];?></a><i>&gt;</i><a href="<?php echo $url['info'];?>"><?php echo $novel['name'];?></a><i>&gt;</i><b>最新章节列表</b></div>
		</div>
		<div class="box">
			<div class="headline">
				<h1><?php echo $novel['name'];?></h1>
				<h2>文 / <a href="<?php echo $author['url'];?>"><?php echo $author['name'];?></a></h2>
				<p>分类：<a href="<?php echo mb_substr($category['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $category['name'];?></a></p>
				<p>章节：<span class="layui-badge-rim layui-icon i_"> <?php echo $last['id'];?></span></p>
				<p>点击：<span class="layui-badge-rim layui-icon i_visit"> <?php echo $data['allvisit'];?></span></p>
				<p>下载：<span class="layui-badge-rim layui-icon i_vote"> <?php echo $data['downnum'];?></span></p>
				<p>更新：<span class="layui-badge-rim layui-icon i_history"> <?php echo cntime($last['time']);?></span></p>
			</div>
			<div class="read">
				<dl>
					<dt><b><?php echo $novel['name'];?>最新章节</b></dt>
					<?php $list=$this->pt->block->getdata('chapterlist',array('novelid'=>$novel['id'],'sort'=>'desc','num'=>12));?>
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<dd chapter-id="<?php echo $novel['id'];?>"<?php if($loop['marked']):?> class="last"<?php endif;?> style="width: 340px;"><a href="<?php echo $loop['url_read'];?>"><?php echo $loop['name'];?><span class="time">更新：<?php echo datevar($loop['time'],'Y-m-d H:i:s');?></span></a></dd>
					<?php endforeach; endif;?>
				</dl>
				<dl>
					<dt><b><?php echo $novel['name'];?>全部章节</b></dt>
					<?php $list=$this->pt->block->getdata('chapterlist',array('novelid'=>$novel['id']));?>
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<dd chapter-id="<?php echo $novel['id'];?>"<?php if($loop['marked']):?> class="last"<?php endif;?> style="width: 340px;"><a href="<?php echo $loop['url_read'];?>"><?php echo $loop['name'];?><span class="time">更新：<?php echo datevar($loop['time'],'Y-m-d H:i:s');?></span></a></dd>
					<?php endforeach; endif;?>
				</dl>
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