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
<body id="chapter" article-id="<?php echo $novel['id'];?>" info-id="<?php echo $url['info'];?>" zz-id="<?php echo $author['url'];?>" xs-id="<?php echo __SELF__;?>" chapter-id="<?php echo $chapter['id'];?>" data-id="<?php echo $novel['cover'];?>" ondragstart="return false;" oncopy="return false;" oncut="return false;" oncontextmenu="return false;">
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
			<div class="path"><a href="<?php echo $this->pt->config->get("siteurl");?>" class="layui-icon i_home"></a><i>&gt;</i><a href="<?php echo mb_substr($category['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $category['name'];?></a><i>&gt;</i><a href="<?php echo $url['info'];?>"><?php echo $novel['name'];?></a><i>&gt;</i><a href="<?php echo $url['dir'];?>">最新章节列表</a></div>
		</div>
		<div class="area">
		    <div class="nr_title" id="nr_title">
	            <span class="xialas">换源:
		            <select onchange="window.location=this.value;">
			          <?php if(is_array($chapter['samelist'])): foreach($chapter['samelist'] as $key =>$loop):?>
		               <option value="<?php echo $loop['url'];?>" title="<?php echo $novel['name'];?> <?php echo $loop['name'];?> <?php echo $chapter['name'];?>"><?php echo $loop['name'];?></option>
			           <?php endforeach; endif;?>
			        </select>
		        </span>
	        </div>
			<h1><?php echo $chapter['name'];?></h1>
			<div class="light">作品：<a id="bookname" href="<?php echo $url['info'];?>"><?php echo $novel['name'];?></a><i>|</i>作者：<a id="author" href="<?php echo $author['url'];?>"><?php echo $author['name'];?></a><i>|</i>分类：<a href="<?php echo mb_substr($category['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $category['name'];?></a><i>|</i>更新：<?php echo datevar($chapter['time'],"Y-m-d H:i:s");?><i>|</i>下载：<a href="<?php echo $url['down'];?>" title="{<?php echo $novel['name'];?> TXT下载"><?php echo $novel['name'];?>TXT下载</a></div>
			<div id="content"><?php echo $chapter['content'];?></div>
			<div class="page"><a href="<?php echo $chapter['preinfo']['url'];?>">上一章【快捷键：←】</a> <a href="<?php echo $url['dir'];?>">目 录【快捷键：Enter】</a> <a id="page2" href="<?php echo $chapter['nextinfo']['url'];?>">下一章【快捷键：→】</a></div>
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
<ul id="setting" class="hide" style="display: none;"><li class="theme"><p>主题模式：</p><a class="day on"></a><a class="night"></a><a class="pink"></a><a class="yellow"></a><a class="blue"></a><a class="green"></a><a class="gray"></a></li><li class="style"><p>字体样式：</p><a class="yahei on">雅黑</a><a class="songti">宋体</a><a class="kaishu">楷书</a></li><li class="size"><p>字体大小：</p><a class="iconfont icon-dec"></a><a class="num">18</a><a class="iconfont icon-inc"></a></li><li class="default"><p></p><a>恢复默认</a></li></ul>
<ul class="bar left_bar">
    <li><a class="iconfont icon-read" href="<?php echo $url['dir'];?>">目录</a></li>
	<li><a class="iconfont icon-setting" href="javascript:void(0)">设置</a></li>
	<li><a class="iconfont icon-info" href="<?php echo $url['info'];?>">详情</a></li>
    <li><a class="iconfont icon-tingshu" href="javascript:void(0)">朗读</a></li>
</ul>
<ul class="bar right_bar">
	<li><a class="layui-icon i_phone" href="javascript:void(0)" onclick="phone()">手机</a></li>
	<li><a class="layui-icon i_mark" href="javascript:void(0)" onclick="mark(<?php echo $novel['id'];?>)">收藏</a></li>
	<li><a class="layui-icon i_prev" href="<?php echo $chapter['preinfo']['url'];?>"></a></li>
	<li><a class="layui-icon i_next" href="<?php echo $chapter['nextinfo']['url'];?>"></a></li>
    <li><a class="iconfont icon-top" href="#"></a></li>
</ul>
</body>
</html>