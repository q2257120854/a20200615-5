<?php defined('PT_ROOT') || exit('Permission denied');?>﻿<!DOCTYPE html>
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
			<li ><a href="<?php echo U("novelsearch.index.top",array());?>">排行榜</a></li>
			<li class="on"><a href="<?php echo U("novelsearch.list.over",array());?>">完本</a></li>
		</ul>
		<form action="<?php echo U("novelsearch.search.result",array());?>" class="search">
			<input type="text" name="searchkey" placeholder="请输入搜索内容！" autocomplete="off">
			<button type="submit" class="layui-icon i_search"></button>
		</form>
	</div>
</div>
<div class="main">
	<div class="layui-main">
		<div class="box left w_740">
			<div class="title caption">
				<h1>完本小说</h1>
			</div>
			<div class="table">
				<table class="layui-table" lay-even lay-skin="nob">
				  	<thead>
						<tr>
							<th width="65">分类</th>
							<th width="125">书名</th>
							<th>最新章节</th>
							<th width="90">作者</th>
							<th width="100">更新</th>
					    </tr>
					</thead>
					<tbody>
					    <?php if(is_array($overlist)): foreach($overlist as $key =>$loop):?>
						<tr>
							<td><a class="light" href="<?php echo mb_substr($loop['category']['url'],0,10,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a></td>
							<td><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></td>
							<td><a href="<?php echo $loop['last']['url'];?>"><?php echo $loop['last']['name'];?></a></td>
							<td><a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></td>
							<td><?php echo mb_substr(datevar($loop['last']['time'],"Y-m-d H:i"),2,33,'utf-8');?></td>
						</tr>
						<?php endforeach; endif;?>
					</tbody>
				</table>
			</div>
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
		<div class="box right w_360">
			<div class="title tab">
				<ul class="nav">
					<li class="on"><a id="votenum" href="javascript:void(0)">推荐榜</a></li>
				</ul>
				<h2>热门全本</h2>
			</div>
			<div class="list tab">
				<ul class="rank">
					<?php $list=$this->pt->block->getdata('novellist',array('sort'=>"votenum",'num'=>10));?>
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,1,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li class="on">
						<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
						<i class="layui-bg-<?php if($i['order']==1):?>red<?php elseif($i['order']==2):?>orange<?php elseif($i['order']==3):?>blue<?php else:?>cyan<?php endif;?>"><?php echo $i['order'];?></i>
						<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></p>
						<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,36,'utf-8');?></p>
						<p class="author">作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
						<p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,11,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a></p>
					</li>
					<?php endforeach; endif;?>
					<?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,1,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
					<li>
						<a href="<?php echo $loop['url']['info'];?>"><img src="<?php echo $loop['novel']['cover'];?>" alt="<?php echo $loop['novel']['name'];?>"></a>
						<i class="layui-bg-<?php if($i['order']==1):?>red<?php elseif($i['order']==2):?>orange<?php elseif($i['order']==3):?>blue<?php else:?>cyan<?php endif;?>"><?php echo $i['order'];?></i>
						<p class="bookname"><a href="<?php echo $loop['url']['info'];?>"><?php echo $loop['novel']['name'];?></a></p>
						<p class="intro"><?php echo mb_substr($loop['novel']['intro'],0,36,'utf-8');?></p>
						<p class="author">作者：<a href="<?php echo $loop['author']['url'];?>"><?php echo $loop['author']['name'];?></a></p>
						<p>分类：<a href="<?php echo mb_substr($loop['category']['url'],0,11,'utf-8');?>_0_0_lastupdate_1.html"><?php echo $loop['category']['name'];?></a></p>
					</li>
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