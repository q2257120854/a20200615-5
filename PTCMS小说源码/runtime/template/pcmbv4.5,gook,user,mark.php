<?php defined('PT_ROOT') || exit('Permission denied');?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>我的书架_<?php echo $this->pt->config->get("sitename");?></title>
    <meta name="keywords" content="<?php echo $this->pt->config->get("sitename");?>" />
    <meta name="description" content="<?php echo $this->pt->config->get("sitename");?>" />
    <meta name="applicable-device" content="pc">
    <meta name="renderer" content="webkit">
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
			<div class="title part">
				<h2>用户中心</h2>
			</div>
			<ul class="top">
				<li><a href="<?php echo U("user.history.index",array());?>">阅读记录</a></li>
				<li class="on"><a href="<?php echo U("user.mark.index",array());?>">用户书架</a></li>
				<li><a href="<?php echo U("user.public.logout",array());?>">退出登录</a></li>
			</ul>
		</div>
		<div class="box right w_840">
			<div class="title lite">
				<h1>书架共有 <span id="mark_num"><?php echo count($marklist);?></span> 本收藏</h1>
			</div>
			<ul id="mark_list" class="list zoom">
			    <?php if(is_array($marklist)): foreach($marklist as $key =>$loop):?>
				<li class="on" article-id="<?php echo $loop['novel']['id'];?>">
					<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
					<a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a>
					<span class="layui-badge layui-bg-blue"><?php echo defaultvar($loop['novel']['isover'],"连载中","已完结");?></span>
					<p class="action"><a href="<?php echo $loop['nexturl'];?>">继续阅读</a><a class="mark_del" href="<?php echo U("user.mark.del",array('novelid'=>$loop['novel']['id']));?>">移除书架</a></p>
					<p>作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a><em>|</em>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a><em>|</em>热度：<?php echo $loop['data']['allvisit'];?></p>
					<p class="intro" style="height:40px"><?php echo mb_substr($loop['novel']['intro'],0,140,'utf-8');?>...</p>
					<p class="chapter">最新：<a href="<?php echo $loop['last']['url'];?>"><?php echo $loop['last']['name'];?></a><em>|</em><?php echo datevar($loop['last']['time'],"Y-m-d H:i:s");?></p>
					<p id="last">进度：<?php if($loop['hasnew']):?>已读到第 <?php echo $loop['hnew'];?> 章<?php else:?>全部读完<?php endif;?></p>
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