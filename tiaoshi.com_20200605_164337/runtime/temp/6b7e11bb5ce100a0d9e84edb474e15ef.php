<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:39:"template/RX03/new1685/actor/detail.html";i:1576939426;s:66:"/www/wwwroot/tiaoshi.com/template/RX03/new1685/public/include.html";i:1576939674;s:63:"/www/wwwroot/tiaoshi.com/template/RX03/new1685/public/head.html";i:1577290900;s:63:"/www/wwwroot/tiaoshi.com/template/RX03/new1685/public/foot.html";i:1577472563;}*/ ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $obj['actor_name']; ?>个人资料_<?php echo $obj['actor_name']; ?>演过的电视剧_<?php echo $obj['actor_name']; ?>电影全集-<?php echo $maccms['site_name']; ?></title>
<meta name="keywords" content="<?php echo $obj['actor_name']; ?>个人资料,<?php echo $obj['actor_name']; ?>演过的电视剧,<?php echo $obj['actor_name']; ?>电影全集,<?php echo $obj['actor_name']; ?>最新电影,<?php echo $obj['actor_name']; ?>最新电视剧">
<meta name="description" content="<?php echo $maccms['site_name']; ?>演示站为你收集了<?php echo $obj['actor_name']; ?>个人资料包括了<?php echo $obj['actor_name']; ?>最新演过的电视剧,<?php echo $obj['actor_name']; ?>电影全集,以及<?php echo $obj['actor_name']; ?>图片剧照最近动态等信息希望你能喜欢。">
<script src="<?php echo $maccms['path']; ?>static/js/jquery.autocomplete.js"></script>
<script src="<?php echo $maccms['site_wapurl']; ?>js/jquery.superslide.js"></script>
<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
<script src="<?php echo $maccms['site_wapurl']; ?>js/jquery.base.js"></script>
<script>var maccms={"path":"","mid":"<?php echo $maccms['mid']; ?>","aid":"<?php echo $maccms['aid']; ?>","url":"<?php echo $maccms['site_url']; ?>","wapurl":"<?php echo $maccms['site_wapurl']; ?>","mob_status":"<?php echo $maccms['mob_status']; ?>"};</script>
<script src="<?php echo $maccms['path']; ?>static/js/home.js"></script>
<style>.table.table-sm .div-pc {display: table-row-group;vertical-align: middle;border-color: inherit;}.table.table-sm ul {padding-left: 0;display: table-row;vertical-align: inherit;border-color: inherit;}.ui-slide-block li {float: left;border-bottom: 1px solid #dee2e6;list-style-type: none;width: 25%;padding: .3rem;overflow: hidden; text-overflow: ellipsis; white-space: nowrap;}.ui-slide-block-pc li,.ui-slide-block-pc-down li,.ui-slide-block-pc-down2 li{width: 120px;font-size: 14px;line-height: 25px !important;padding: .3rem;vertical-align: top;float: left;border-bottom: 1px solid #dee2e6;list-style-type: none;overflow: hidden; text-overflow: ellipsis; white-space: nowrap;}@media (max-width: 768px){body.sidebar-toggled #block-slide{display: block !important}.navbar-brand{width:8rem;margin-right: 0rem!important;}.table.table-sm ul{display:block;overflow:hidden;}}</style>

<!--明星库主样式-->
<link href="<?php echo $maccms['site_wapurl']; ?>css/actor.css" rel="stylesheet" type="text/css" />
</head><body>
<nav class="navbar navbar-expand navbar-light bg-white static-top osahan-nav sticky-top">
  <button type="button" class="d-block d-sm-none btn btn-primary border-none btn-sm order-1 order-sm-0" id="sidebarToggle"><i
		 class="fa fa-bars"></i>导航</button>
  <button class="d-none d-sm-block btn btn-link btn-sm text-secondary order-1 order-sm-0" id="sidebarToggle"> <i class="fa fa-bars"></i> </button>
  <a class="navbar-brand" href="/" style="margin-right: 1.3rem;"><img class="img-fluid" style="max-width: 90%;" alt="<?php echo $maccms['site_name']; ?>"  src="/<?php echo $maccms['site_logo']; ?>" /></a>
  <button type="button" class="d-none d-sm-block btn btn-primary border-none btn-sm order-1 order-sm-0" id="sidebarTogglePc"><i
		 class="fa fa-video-camera"></i> 在线视频分类</button>
  <!--<button type="button" style="margin-left: 20px" class="d-none d-sm-block btn btn-primary border-none btn-sm order-1 order-sm-0"
	 id="sidebarTogglePcDown"><i class="fa fa-image"></i> 套图专区分类</button>-->
  <button type="button" style="margin-left: 20px" class="d-none d-sm-block btn btn-primary border-none btn-sm order-1 order-sm-0"
	 id="sidebarTogglePcDown2"><i class="fa fa-book"></i> 小说专区分类</button>
  <!-- Navbar Search -->
  <form id="search" action="<?php echo mac_url('vod/search'); ?>" method="get" onSubmit="return qrsearch();" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-5 my-2 my-md-0 osahan-navbar-search">
    <div class="input-group">
      <input type="text" id="wd" name="wd" class="form-control" placeholder="输入关键字进行搜索…" />
      <div class="input-group-append">
        <button class="btn btn-light" type="submit"> <i class="fa fa-search"></i> </button>
      </div>
    </div>
  </form>
  <!-- Navbar -->
     <?php if($GLOBALS['user']['user_id']): ?>
   <ul class="navbar-nav ml-auto ml-md-0 osahan-right-navbar"> 
    <li class="nav-item dropdown no-arrow osahan-right-navbar-user"> <a class="nav-link dropdown-toggle user-dropdown-link" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img alt="Avatar" src="<?php echo mac_get_user_portrait($user['user_id']); ?>" /><span>个人中心</span></a> 
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown"> 
     <a class="dropdown-item" href="#"><i class="fas fa-fw fa-user"></i>   <?php echo $user['user_name']; ?></a> 
     <div class="dropdown-divider"></div> 
     <a class="dropdown-item" href="<?php echo mac_url('user/index'); ?>"><i class="fas fa-fw fa-user-circle"></i>   进入会员中心</a> 
     <a class="dropdown-item" href="<?php echo mac_url('user/buy'); ?>"><i class="fas fa-fw fa-money-bill"></i>   升级VIP</a> 
     <div class="dropdown-divider"></div> 
     <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-fw fa-sign-out-alt"></i>   退出</a> 
    </div> </li> 
   </ul>
   <?php else: ?>
   <ul class="navbar-nav ml-auto ml-md-0 osahan-right-navbar"> 
    <li class="nav-item dropdown no-arrow osahan-right-navbar-user"> <a class="nav-link" href="<?php echo mac_url('user/login'); ?>" style="font-size: 14px"> <i class="fas fa-user-circle fa-fw"></i> 登录 </a> </li> 
    <li class="nav-item dropdown no-arrow osahan-right-navbar-user"> <a class="nav-link" href="<?php echo mac_url('user/reg'); ?>" style="font-size: 14px"> <i class="fas fa-registered fa-fw"></i> 注册 </a> </li> 
   </ul>
   <?php endif; ?> </nav>
<div class="ui-slide-block" style="font-size: 12px;display: none;" id="block-slide">
  <div class="container">
    <div class="table table-sm" style="margin-bottom: 0rem;">
      <div>
        <div style="line-height:20px;padding: .3rem;">
          <form id="search" method="get" action="<?php echo mac_url('vod/search'); ?>" onSubmit="return qrsearch();" class="form-inline ml-auto mr-0 mr-md-5 my-2 my-md-0 ">
            <div class="input-group">
              <input class="form-control border-form-control search-input" style="background-color: white;border: none" id="wd"
							 name="wd" placeholder="输入关键字进行搜索" type="text" />
              <button type="submit" class="btn btn-danger border-none"> 搜索 </button>
            </div>
          </form>
        </div>
        <span style="color: #ffade8;font-size: 16px" target="_blank"><i class="fa fa-fw fa-video"></i>视频区</span>
        <ul>
          <li style="line-height:20px"><a style="color: white;" href="/" target="_blank"><b>首页</b></a></li>
          <li style="line-height:20px"><a style="color: #f5ff06;" href="<?php echo mac_url('user/upgrade'); ?>" target="_blank"><b>升级VIP</b></a></li>
          <li style="line-height:20px"><a style="color: #f5ff06;" href="/index.php/vod/type/id/20.html" target="_blank"><b>试看</b></a></li>
          <li style="line-height:20px"><a style="color: #f5ff06;" href="/index.php/vod/search/by/time_add.html" target="_blank"><b>最近更新</b></a></li>
          <li style="line-height:20px"><a style="color: #f5ff06;" href="/index.php/vod/search/by/hits.html" target="_blank"><b>最多观看</b></a></li>
          <?php $__TAG__ = '{"ids":"parent","order":"asc","by":"sort","flag":"vod","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
          <li style="line-height:20px"><a style="color: white;" href="<?php echo mac_url_type($vo); ?>" target="_blank"><?php echo $vo['type_name']; ?></a></li>
          <?php endforeach; endif; else: echo "" ;endif; $__TAG__ = '{"ids":"child","order":"asc","by":"sort","flag":"vod","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
          <li style="line-height:20px"><a style="color: white;" href="<?php echo mac_url_type($vo); ?>" target="_blank"><?php echo $vo['type_name']; ?></a></li>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!--<span style="color: #ffccfa;font-size: 16px;" target="_blank"><i class="fa fa-image"></i>套图区</span>
        <ul>
          <li style="line-height:20px"><a style="color: white;" href="/index.php/art/search/by/time_add.html" target="_blank">最新套图</a></li>
          <li style="line-height:20px"><a style="color: white;" href="/index.php/art/search/by/hits.html" target="_blank">热门套图</a></li>
          <?php $__TAG__ = '{"ids":"parent","order":"asc","by":"sort","flag":"art","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
          <li style="line-height:20px"><a style="color: white;" href="<?php echo mac_url_type($vo); ?>" target="_blank"><?php echo $vo['type_name']; ?></a></li>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>-->
        <span style="color: #ffccfa;font-size: 16px;" target="_blank"><i class="fa fa-fw fa-book"></i>小说区</span>
        <ul>
          <?php $__TAG__ = '{"ids":"parent","order":"asc","by":"sort","flag":"art","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
          <li style="line-height:20px"><a style="color: white;" href="<?php echo mac_url_type($vo); ?>" target="_blank"><?php echo $vo['type_name']; ?></a></li>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="ui-slide-block-pc" id="block-slide-pc">
  <div class="container">
    <div class="table table-sm" style="width: 480px;margin-bottom: -0.1rem;">
      <div class="div-pc">
        <ul>
          <li style="line-height:20px"><a style="color: white;" href="/" target="_blank"><b>首页</b></a></li>
          <li style="line-height:20px"><a style="color: #f5ff06;" href="/index.php/user/upgrade.html" target="_blank"><b>升级VIP</b></a></li>
          <li style="line-height:20px"><a style="color: #f5ff06;" href="/index.php/vod/type/id/20.html" target="_blank"><b>试看</b></a></li>
          <li style="line-height:20px"><a style="color: #f5ff06;" href="/index.php/vod/search/by/time_add.html" target="_blank"><b>最近更新</b></a></li>
          <li style="line-height:20px"><a style="color: #f5ff06;" href="/index.php/vod/search/by/hits.html" target="_blank"><b>最多观看</b></a></li>
          <?php $__TAG__ = '{"ids":"parent","order":"asc","by":"sort","flag":"vod","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
          <li style="line-height:20px"><a style="color: white;" href="<?php echo mac_url_type($vo); ?>" target="_blank"><?php echo $vo['type_name']; ?></a></li>
          <?php endforeach; endif; else: echo "" ;endif; $__TAG__ = '{"ids":"child","order":"asc","by":"sort","flag":"vod","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
          <li style="line-height:20px"><a style="color: white;" href="<?php echo mac_url_type($vo); ?>" target="_blank"><?php echo $vo['type_name']; ?></a></li>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="ui-slide-block-pc-down" id="block-slide-pc-down">
  <div class="container">
    <div class="table table-sm" style="width: 480px;margin-bottom: -0.1rem;">
      <div class="div-pc">
        <ul>
          <li style="line-height:20px"><a style="color: white;" href="/" target="_blank"><b>首页</b></a></li>
          <li style="line-height:20px"><a style="color: #f5ff06;" href="<?php echo mac_url('user/upgrade'); ?>" target="_blank"><b>升级VIP</b></a></li>
          <li style="line-height:20px"><a style="color: #f5ff06;" href="/index.php/art/search/by/time_add.html" target="_blank"><b>最新套图</b></a></li>
          <li style="line-height:20px"><a style="color: #f5ff06;" href="/index.php/art/search/by/hits.html" target="_blank"><b>热门套图</b></a></li>
          <?php $__TAG__ = '{"ids":"parent","order":"asc","by":"sort","flag":"art","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
          <li style="line-height:20px"><a style="color: white;" href="<?php echo mac_url_type($vo); ?>" target="_blank"><?php echo $vo['type_name']; ?></a></li>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="ui-slide-block-pc-down2" id="block-slide-pc-down2">
  <div class="container">
    <div class="table table-sm" style="width: 480px;margin-bottom: -0.1rem;">
      <div class="div-pc">
        <ul>
          <li style="line-height:20px"><a style="color: white;" href="/" target="_blank"><b>首页</b></a></li>
          <li style="line-height:20px"><a style="color: #f5ff06;" href="<?php echo mac_url('user/upgrade'); ?>" target="_blank"><b>升级VIP</b></a></li>
          <?php $__TAG__ = '{"ids":"parent","order":"asc","by":"sort","flag":"art","id":"vo","key":"key"}';$__LIST__ = model("Type")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
          <li style="line-height:20px"><a style="color: white;" href="<?php echo mac_url_type($vo); ?>" target="_blank"><?php echo $vo['type_name']; ?></a></li>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<!--当前位置-->
<div class="bread-crumb-nav fn-clear">
  <ul class="bread-crumbs">
    <li class="home"><a href="<?php echo $maccms['path']; ?>">首页</a></li>
    <li><a href="<?php echo mac_url('actor/index'); ?>" target="_blank">明星</a></li>
    <li><a href=""><?php echo $obj['actor_area']; ?>明星</a></li>
    <li><?php echo $obj['actor_name']; ?></li>
    <li class="back"><a href="javascript:MAC.GoBack()">返回上一页</a></li>
  </ul>
</div>
<!--明星详细介绍-->
<div class="ui-box" id="detail-box">
  <div class="detail-cols fn-clear">
    <div class="detail-pic fn-left"><img src="<?php echo mac_url_img($obj['actor_pic']); ?>" alt="<?php echo $obj['actor_name']; ?>" /></div>
    <div class="detail-info fn-left">
      <div class="detail-title fn-clear">
        <h1><?php echo $obj['actor_name']; ?></h1>
      </div>
      <div class="info fn-clear">
        <dl class="nyzhuy">
          <dt>星座：</dt>
          <dd><?php echo $obj['actor_starsign']; ?></dd>
        </dl>
        <dl class="fn-left">
          <dt>血型：</dt>
          <dd><span class="color"><?php echo $obj['actor_blood']; ?>型</span></dd>
        </dl>
        <dl class="fn-right">
          <dt>职业：</dt>
          <dd>演员</dd>
        </dl>
        <dl class="fn-left">
          <dt>身高：</dt>
          <dd><span><?php echo $obj['actor_height']; ?></span></dd>
        </dl>
        <dl class="fn-right">
          <dt>地区：</dt>
          <dd><span><?php echo $obj['actor_area']; ?></span></dd>
        </dl>
        <dl class="fn-left">
          <dt>生日：</dt>
          <dd><span id="addtime"><?php echo $obj['actor_birthday']; ?></span></dd>
        </dl>
        <dl class="fn-right">
          <dt>人气：</dt>
          <dd><span>58866</span></dd>
        </dl>
        <dl class="jianjie">
          <dt>简介：</dt>
          <dd><?php echo $obj['actor_blurb']; ?>... <a class="link detail-desc" href="#jianjie">详细>></a></dd>
        </dl>
        <dl class="fenx">
          <dt>分享：</dt>
          <dd>
            <div class="bdsharebuttonbox"><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣网"></a><a href="#" class="bds_tieba" data-cmd="tieba" title="分享到百度贴吧"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_kaixin001" data-cmd="kaixin001" title="分享到开心网"></a><a href="#" class="bds_mogujie" data-cmd="mogujie" title="分享到蘑菇街"></a><a href="#" class="bds_huaban" data-cmd="huaban" title="分享到花瓣"></a><a href="#" class="bds_tqf" data-cmd="tqf" title="分享到腾讯朋友"></a><a href="#" class="bds_more" data-cmd="more"></a></div>
            <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
          </dd>
        </dl>
      </div>
    </div>
  </div>
</div>
<!--详细资料-->
<div class="layui-tab layui-tab-brief main dattop" id="detail-box" lay-filter="docDemoTabBrief">
  <ul class="tab-nav layui-tab-title clearfix">
    <li id="tab1" class="layui-this" onMouseMove="setTab('tab','stab',1,3)"><a   target="_self" href="javascript:;">参演</a></li>
    <li id="tab2" onMouseMove="setTab('tab','stab',2,3)"><a  target="_self" href="javascript:;">个人资料</a></li>
    <li id="tab3" onMouseMove="setTab('tab','stab',3,3)"><a  target="_self" href="javascript:;">星闻资讯</a></li>
  </ul>
  <!-- tab内容-->
  <div class="layui-tab-content">
    <div id="stab1" class="layui-tab-item layui-show">
      <div class="panel mt20">
        <div class="panel-hd">
          <h2 class="title">电影作品</h2>
          <span class="extend"> </span> </div>
        <div class="panel-bd">
          <ul class="v_picTxt pic180_240 clearfix">
            <?php $__TAG__ = '{"num":"5","type":"1","actor":"'.$obj['actor_name'].'","order":"desc","by":"time","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
            <li class=" ">
              <div class="pic"> <img src="<?php echo mac_url_img($vo['vod_pic']); ?>" alt="" title="<?php echo $vo['vod_name']; ?>">
                <p class="pRightBottom"> <em><?php echo $vo['vod_score']; ?>分</em> </p>
                <a data-ajax83="ys_mx_detail_pic_tj_dy_1" class="aPlayBtn" href="<?php echo mac_url_vod_detail($vo); ?>" title="<?php echo $vo['vod_name']; ?>" target="_blank"><i></i></a> </div>
              <div class="txtPadding"> <span class="sTit"> <em class="emTit"><a data-ajax83="ys_mx_detail_title_tj_dy_1" target="_blank" href="<?php echo mac_url_vod_detail($vo); ?>" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a></em> </span> </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div>
      </div>
      <div class="rowIvy  mt20 clearfix"> </div>
      <div class="panel mt20">
        <div class="panel-hd">
          <h2 class="title">电视剧作品</h2>
          <span class="extend"> </span> </div>
        <div class="panel-bd">
          <ul class="v_picTxt pic180_240 clearfix">
            <?php $__TAG__ = '{"num":"5","type":"2","actor":"'.$obj['actor_name'].'","order":"desc","by":"time","id":"vo","key":"key"}';$__LIST__ = model("Vod")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
            <li class=" ">
              <div class="pic"> <img src="<?php echo mac_url_img($vo['vod_pic']); ?>" alt="" title="<?php echo $vo['vod_name']; ?>">
                <p class="pRightBottom"> <em><?php echo $vo['vod_score']; ?>分</em> </p>
                <a data-ajax83="ys_mx_detail_pic_tj_dy_1" class="aPlayBtn" href="<?php echo mac_url_vod_detail($vo); ?>" title="<?php echo $vo['vod_name']; ?>" target="_blank"><i></i></a> </div>
              <div class="txtPadding"> <span class="sTit"> <em class="emTit"><a data-ajax83="ys_mx_detail_title_tj_dy_1" target="_blank" href="<?php echo mac_url_vod_detail($vo); ?>" title="<?php echo $vo['vod_name']; ?>"><?php echo $vo['vod_name']; ?></a></em> </span> </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div>
      </div>
      <div class="rowIvy  mt20 clearfix"> </div>
    </div>
    <!--介绍-->
    <div id="stab2" class="layui-tab-item" style="display:none">
      <div class="conList" id="conList">
        <ul class="ulDetailIntro clearfix">
          <li> <span class="sTit">中文名</span> <?php echo $obj['actor_name']; ?></li>
          <li><span class="sTit">身高</span><?php echo $obj['actor_height']; ?></li>
          <li><span class="sTit">体重</span><?php echo $obj['actor_weight']; ?></li>
          <li> <span class="sTit">国籍</span> 中国</li>
          <li> <span class="sTit">民族</span> 汉族</li>
          <li> <span class="sTit">星座</span> <?php echo $obj['actor_starsign']; ?></li>
          <li> <span class="sTit">血型</span> <?php echo $obj['actor_blood']; ?>型</li>
          <li> <span class="sTit">出生日期</span> <?php echo $obj['actor_birthday']; ?></li>
          <li> <span class="sTit">出生地</span> <?php echo $obj['actor_birtharea']; ?></li>
          <li> <span class="sTit">职业</span> <em>演员</em><em>音乐人</em><em>唱作歌手</em><em>企业家</em></li>
          <li> <span class="sTit">毕业院校</span> <?php echo $obj['actor_school']; ?></li>
          <li> <span class="sTit">经纪公司</span> EEG</li>
          <li class="all"> <span class="sTit">代表作品</span> <?php echo $obj['actor_works']; ?></li>
        </ul>
        <dl class="dlTxtList">
          <!--详细内容-->
          <dt> <span class="sMark"><i class="iIcon"></i>主要成就</span> <i class="iLine"></i> </dt>
          <dd>
            <div class="txtList"><?php echo $obj['actor_content']; ?> </div>
          </dd>
        </dl>
        <!-- 个人资料 end -->
      </div>
    </div>
    <!--资讯-->
    <div id="stab3" class="layui-tab-item" style="display:none">
      <!--这里是文章-->
      <div class="vodlist_l">
        <ul class="pianyi">
          <?php $__TAG__ = '{"num":"30","paging":"no","tag":"'.$obj['actor_name'].'","order":"desc","by":"time","id":"vo","key":"key"}';$__LIST__ = model("Art")->listCacheData($__TAG__); if(is_array($__LIST__['list']) || $__LIST__['list'] instanceof \think\Collection || $__LIST__['list'] instanceof \think\Paginator): $key = 0; $__LIST__ = $__LIST__['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
          <li><span><?php echo date('Y-m-d',$vo['art_time']); ?></span><a href="<?php echo mac_url_art_detail($vo); ?>"><?php echo $vo['art_name']; ?></a></li>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
    </div>
  </div>
  <!--分类标签-->
</div>
<script>
  function setTab(name,name2,cursel,n){
    for(i=1;i<=n;i++){
      var menu=document.getElementById(name+i);
      var con=document.getElementById(name2+i);
      menu.className=i==cursel?"current":"";
      con.style.display=i==cursel?"block":"none";
    }
  }
</script>
<footer class="sticky-footer" style="margin-left: initial; margin-top: 30px;">
  <div class="container">
    <div class="row no-gutters">
      <div class="col-lg-6 col-sm-6">
        <p class="mt-1 mb-0">© Copyright 2019 <strong class="text-dark"><?php echo $maccms['site_name']; ?></strong>. All Rights Reserved<br />
          <small class="mt-0 mb-0"><?php echo $maccms['site_tj']; ?></small> </p>
      </div>
      <div class="col-lg-6 col-sm-6 text-right">
        <div class="app"> <a  target="_self" href="/index.php/art/detail/id/5295.html"><img alt="" src="<?php echo $maccms['site_wapurl']; ?>html/style/images/google.png" /></a> <a  target="_self" href="/index.php/art/detail/id/5295.html"><img alt="" src="<?php echo $maccms['site_wapurl']; ?>html/style/images/apple.png" /></a> </div>
      </div>
    </div>
  </div>
</footer>
<div class="m-footer" style="display:none;"> <a class="navFooter" target="_self" href="/"><i class="fa fa-home"></i>首页</a>
  <button type="button" class="navFooter" id="sidebarToggle"><i class="fa fa-list"></i>分类</button>
  <a class="navFooter" target="_self" href="/index.php/vod/type/id/20.html"><i class="fas fa-layer-group"></i>试看</a> <a class="navFooter" target="_self" href="<?php echo mac_url('user/buy'); ?>"><i class="fa fa-diamond"></i>充值VIP</a> <a class="navFooter" target="_self" href="<?php echo mac_url('user/login'); ?>"><i class="fa fa-user"></i>我的</a> </div>
</body>
</html>
