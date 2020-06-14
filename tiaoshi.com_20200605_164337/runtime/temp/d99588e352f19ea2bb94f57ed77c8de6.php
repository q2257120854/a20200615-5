<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:35:"template/RX03/new1685/user/buy.html";i:1590855006;s:64:"/www/wwwroot/tiaoshi.com/template/RX03/new1685/user/include.html";i:1576939983;s:61:"/www/wwwroot/tiaoshi.com/template/RX03/new1685/user/head.html";i:1576939971;s:62:"/www/wwwroot/tiaoshi.com/template/RX03/new1685/user/zhifu.html";i:1590855015;s:63:"/www/wwwroot/tiaoshi.com/template/RX03/new1685/public/foot.html";i:1577472563;}*/ ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="Cache-Control" content="max-age=60" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<meta http-equiv="Cache-Control" content="no-transform" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="renderer" content="webkit" />
	<meta name="viewport" content="initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<meta name="apple-mobile-web-app-title" content="<?php echo $maccms['site_name']; ?>" />
	<title>充值中心 - 个人中心 - <?php echo $maccms['site_name']; ?></title>
	<meta name="keywords" content="个人中心,<?php echo $maccms['site_keywords']; ?>" />
	<meta name="description" content="<?php echo $maccms['site_description']; ?>" />
	<!-- Favicon Icon -->
	<link rel="icon" type="image/png" href="<?php echo $maccms['path_tpl']; ?>html/style/images/favicon.png" />
	<!-- Bootstrap core CSS-->
	<link href="<?php echo $maccms['path_tpl']; ?>html/style/css/bootstrap.min.css" rel="stylesheet" />
	<!-- Custom fonts for this template-->
	<link href="<?php echo $maccms['path_tpl']; ?>html/style/css/all.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $maccms['path_tpl']; ?>css/home.css" rel="stylesheet" type="text/css" />
	<!-- Custom styles for this template-->
	<link href="<?php echo $maccms['path_tpl']; ?>html/style/css/osahan.css" rel="stylesheet" />
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="<?php echo $maccms['path_tpl']; ?>html/style/css/owl.carousel.css" />
	<link rel="stylesheet" href="<?php echo $maccms['path_tpl']; ?>html/style/css/owl.theme.css" />
	<link href="<?php echo $maccms['path_tpl']; ?>html/style/css/sweetalert.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo $maccms['path_tpl']; ?>html/style/js/sweetalert.min.js" type="text/javascript"></script>
	<script src="<?php echo $maccms['path_tpl']; ?>html/style/js/jquery.min.js"></script>
	<script src="<?php echo $maccms['path_tpl']; ?>html/style/js/jquery.lazyload.min.js"></script>
	<script src="<?php echo $maccms['path']; ?>static/js/jquery.autocomplete.js"></script>
<script src="<?php echo $maccms['site_wapurl']; ?>js/jquery.superslide.js"></script>
<script>var maccms={"path":"","mid":"<?php echo $maccms['mid']; ?>","url":"<?php echo $maccms['site_url']; ?>","wapurl":"<?php echo $maccms['site_wapurl']; ?>","mob_status":"<?php echo $maccms['mob_status']; ?>"};</script>
<script src="<?php echo $maccms['path']; ?>static/js/home.js"></script>
<script src="<?php echo $maccms['site_wapurl']; ?>js/formValidator-4.0.1.js" type="text/javascript"></script>
<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
<script src="<?php echo $maccms['path']; ?>static/js/jquery.imageupload.js"></script>
<link href="<?php echo $maccms['site_wapurl']; ?>html/style/css/orang.css" rel="stylesheet" type="text/css" /> 
<style>.table.table-sm .div-pc {display: table-row-group;vertical-align: middle;border-color: inherit;}.table.table-sm ul {padding-left: 0;display: table-row;vertical-align: inherit;border-color: inherit;}.ui-slide-block li {float: left;border-bottom: 1px solid #dee2e6;list-style-type: none;width: 25%;padding: .3rem;overflow: hidden; text-overflow: ellipsis; white-space: nowrap;}.ui-slide-block-pc li,.ui-slide-block-pc-down li,.ui-slide-block-pc-down2 li{width: 120px;font-size: 14px;line-height: 25px !important;padding: .3rem;vertical-align: top;float: left;border-bottom: 1px solid #dee2e6;list-style-type: none;overflow: hidden; text-overflow: ellipsis; white-space: nowrap;}@media (max-width: 768px){body.sidebar-toggled #block-slide{display: block !important}.navbar-brand{width:8rem;margin-right: 0rem!important;}.table.table-sm ul{display:block;overflow:hidden;}}</style>  
	<style>
		.sidebar .nav-item .dropdown-menu {
			top: -100% !important;
		}

		.shadow_border {
			border: 1px solid #000;
			padding: 60px;
			width: 100px;
			-webkit-border-radius: 8px;
			-moz-border-radius: 8px;
			border-radius: 8px;
			-webkit-box-shadow: #666 0 0 10px;
			-moz-box-shadow: #666 0 0 10px;
			box-shadow: #666 0 0 10px;
		}


		.shadow_font {
			text-shadow: #f00 3px 3px 3px;
		}

		.nav_new {
			position: fixed;

			z-index: 99;
			width: 100%;
		}

		.ui-fix-top {
			position: fixed;
			left: 0;
			right: 0;
			top: 0
		}

		.ui-wrapper {
			margin-top: 58px;
		}

		.ui-slide-block-pc,
		.ui-slide-block-pc-down2 {
			background: linear-gradient(123deg, #ff516b 0%, #8876ea 100%);
			display: none;
			/*position: sticky;*/
			position: fixed;
			z-index: 100;
			margin-left: 14.1rem;
			border-bottom: 5px solid #ffbfef;
			border-right: 5px solid #ffbfef;
			/*border-left:5px solid #ffbfef;*/
		}


		.ui-slide-block-pc td,
		.ui-slide-block-pc-down2 td {
			width: 120px;
			font-size: 14px;
			line-height: 25px !important;
		}

		.ui-slide-block-pc-down {
			background: linear-gradient(123deg, #69dccc 0%, #5b4baf 100%);
			display: none;
			/*position: sticky;*/
			position: fixed;
			z-index: 100;
			margin-left: 14.1rem;
			border-bottom: 5px solid #a8f7ee;
			border-right: 5px solid #a8f7ee;
			/*border-left:5px solid #ffbfef;*/
		}

		.ui-slide-block-pc-down td {
			width: 120px;
			font-size: 14px;
			line-height: 25px !important;
		}

		.ui-slide-block {
			background: linear-gradient(123deg, #ff516b 0%, #8876ea 100%);
			display: none;
			position: sticky;
			position: fixed;
			z-index: 100;
		}

		.no-border {
			border-top: 0 solid #dee2e6 !important;
		}
	</style>
</head>

<body id="page-top" class="fed-min-width">
	<nav class="navbar navbar-expand navbar-light bg-white static-top osahan-nav sticky-top">
  <button type="button" class="d-block d-sm-none btn btn-primary border-none btn-sm order-1 order-sm-0" id="sidebarToggle"><i
		 class="fa fa-bars"></i>导航</button>
  <button class="d-none d-sm-block btn btn-link btn-sm text-secondary order-1 order-sm-0" id="sidebarToggle"> <i class="fa fa-bars"></i> </button>
  <a class="navbar-brand" href="/" style="margin-right: 1.3rem;"><img class="img-fluid" style="max-width: 90%;" alt="<?php echo $maccms['site_name']; ?>"
		 src="/<?php echo $maccms['site_logo']; ?>" /></a>
  <button type="button" class="d-none d-sm-block btn btn-primary border-none btn-sm order-1 order-sm-0" id="sidebarTogglePc"><i
		 class="fa fa-bars"></i> 在线视频分类</button>
<!--  <button type="button" style="margin-left: 20px" class="d-none d-sm-block btn btn-primary border-none btn-sm order-1 order-sm-0"
	 id="sidebarTogglePcDown"><i class="fa fa-bars"></i> 套图专区分类</button>-->
  <button type="button" style="margin-left: 20px" class="d-none d-sm-block btn btn-primary border-none btn-sm order-1 order-sm-0"
	 id="sidebarTogglePcDown2"><i class="fa fa-bars"></i> 小说专区分类</button>
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
    <li class="nav-item dropdown no-arrow osahan-right-navbar-user"> <a class="nav-link dropdown-toggle user-dropdown-link"
			 id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img
				 alt="Avatar" src="<?php echo mac_get_user_portrait($user['user_id']); ?>" /> 个人中心 </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown"> <a class="dropdown-item" href="#"><i class="fa fa-fw fa-user"></i> <?php echo $user['user_name']; ?></a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo mac_url('user/index'); ?>"><i class="fa fa-fw fa-user-circle"></i> 进入会员中心</a> <a class="dropdown-item" href="<?php echo mac_url('user/upgrade'); ?>"><i class="fa fa-fw fa-money-bill"></i> 升级VIP</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo url('user/logout'); ?>" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-out"></i> 退出</a> </div>
    </li>
  </ul>
  <?php else: ?>
  <ul class="navbar-nav ml-auto ml-md-0 osahan-right-navbar">
    <li class="nav-item dropdown no-arrow osahan-right-navbar-user"> <a class="nav-link" href="<?php echo mac_url('user/login'); ?>"
			 style="font-size: 14px"> <i class="fa fa-user-circle fa-fw"></i> 登录 </a> </li>
    <li class="nav-item dropdown no-arrow osahan-right-navbar-user"> <a class="nav-link" href="<?php echo mac_url('user/reg'); ?>"
			 style="font-size: 14px"> <i class="fa fa-registered fa-fw"></i> 注册 </a> </li>
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

  
	<div class="fed-main-info fed-min-width">
		<div class="fed-part-case">
			<div class="fed-user-head fed-margin-top fed-back-whits">
				<div class="fed-list-pics fed-lazy fed-part-5by2 fed-part-rows"
					style="background:url(<?php echo $maccms['path_tpl']; ?>html/style/images/user.jpg);">
					<div class="fed-part-core fed-text-center">
						<div class="fed-user-image" data-role="<?php echo mac_url('user/portrait'); ?>">
							<img class="face fed-user-avat fed-part-roun"
								src="<?php echo mac_url_img(mac_default($obj['user_portrait'],'static/images/touxiang.png')); ?>?v=<?php echo time(); ?>" />
						</div>
						<span class="fed-visible fed-text-white fed-padding"><?php echo $obj['user_name']; ?></span>
					</div>
				</div>
				<div class="fed-padding fed-part-rows fed-back-whits fed-hide-md">
					<ul class="fed-user-brief fed-part-rows fed-back-whits">
						<li class="fed-padding-x fed-text-center fed-col-xs4">
							<span class="fed-visible fed-text-gules"><?php echo $obj['user_points']; ?></span>
							<span class="fed-visible">我的积分</span>
						</li>
						<li class="fed-padding-x fed-text-center fed-line-left fed-col-xs4">
							<span class="fed-visible fed-text-gules"><?php echo $obj['group']['group_name']; ?></span>
							<span class="fed-visible">我的等级</span>
						</li>
						<li class="fed-padding-x fed-text-center fed-line-left fed-col-xs4">
							<span class="fed-visible fed-text-gules"><?php echo $obj['user_extend']; ?></span>
							<span class="fed-visible">推广次数</span>
						</li>
					</ul>
				</div>
			</div>
			<div class="fed-part-rows">
				<div class="fed-main-right fed-col-xs12 fed-col-md8 fed-col-lg9">
					<div class="fed-part-layout fed-back-whits">
						<style>
							.donation_thumbnail .thumbRow.left .nakedGirl {
								background-image: url('/template/RX03/img/thumb1_left.gif');
							}

							.donation_thumbnail .thumbRow.middle .nakedGirl {
								background-image: url('/template/RX03/img/thumb1_middle.gif');
							}

							.donation_thumbnail .thumbRow.right .nakedGirl {
								background-image: url('/template/RX03/img/thumb1_right.gif');
							}

							.fed-col-lg9 {
								width: 100%;
							}
						</style>
						<div class="donation_intro">
							<p class="titleBig">全亚洲唯一『国产+主播+极品』全场看到爽</p>
							<p class="titleMid">最佳选择，已有
								<span id="currentMembership">1,086,795</span>
								会员安心认证</p>
							<div class="featureContent">
								<div class="featureList cameraLi">
									<span class="itemIcon"></span>
									<span class="itemDescrip">线上看、G点看随你选</span>
								</div>
								<div class="featureList fileLi">
									<span class="itemIcon"></span>
									<span class="itemDescrip">每日不停更</span>
								</div>
								<div class="featureList femaleLi">
									<span class="itemIcon"></span>
									<span class="itemDescrip">极品资源+稀缺资源</span>
								</div>
								<div class="featureList videoLi">
									<span class="itemIcon"></span>
									<span class="itemDescrip">十万+部影片</span>
								</div>
							</div>
						</div>
						<div id="goodsList" class="donation-wrapper">
							<div class="donation-box">
								<div class="pepay_login li-donation-in svipBox">
									<div class="icon-donate-svalue cn"></div>
									<div class="icon-donate-30 cn"></div>
									<div class="redtag-greatvalue cn"></div>
									<div class="donation-time">Vip体验/天</div>
									<div class="donation-cost">
										<span class="ntSymbol">￥</span>1<span class="priceSlash">/</span>
										<span class="GBuyText">1天</span>
									</div>
									<p>24小时试用体验价</p>
									<p>一包香烟的价格即可建立信任！</p>
									<div onclick="ShowPayType(this)" class="btn-donation upgrade">
										<span>升级</span>
									</div>
								</div>
								<div class="con-donation-list" style="display: none;">
									<ul class="donation-list-lev1 client-pc">
										<?php if($config['juhe']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(1,'juhe','icbc')">微信wap【PC】</span>
										</li>
										<?php endif; if($config['weipay']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(20,'weipay','zweixin')">weipay【PC】</span>
										</li>
										<?php endif; ?>
										<li>
											<span onclick="CratePayGoods(1,'whereali')">支付宝【推荐】</span>
										</li>
										<!---->
										<li>
											<span onclick="CratePayGoods(1,'wherewx')">微信【推荐】</span>
										</li>

										<!---->
										<!---->
									</ul>
									<ul class="donation-list-lev1 client-mobile" style="display: none;">
										<?php if($config['juhe']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(1,'juhe','wxwap')">微信wap【wap】</span>
										</li>
										<?php endif; if($config['weipay']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(20,'weipay','zweixin')">weipay【wap】</span>
										</li>
										<?php endif; ?>
										<li>
											<span onclick="CratePayGoods(1,'whereali')">支付宝【推荐】</span>
										</li>
										<!---->
										<li>
											<span onclick="CratePayGoods(1,'wherewx')">微信【推荐】</span>
										</li>
										<!---->
									</ul>
									<div class="text-ssl">
										<p>如果有任何疑问，点击<a href="javascript:GoToChat();"
												style="cursor: pointer; color: rgb(0, 255, 255);">[在线咨询]</a>，联系在线客服</p>
									</div>
								</div>
							</div>
							<div class="donation-box">
								<div class="pepay_login li-donation-in svipBox">
									<div class="icon-donate-svalue cn"></div>
									<div class="icon-donate-30 cn"></div>
									<div class="redtag-greatvalue cn"></div>
									<div class="donation-time">Vip会员/月</div>
									<div class="donation-cost">
										<span class="ntSymbol">￥</span>1.2<span class="priceSlash">/</span>
										<span class="GBuyText">1个月</span>
									</div>
									<p>1个月无限观看弹性方案</p>
									<p>想要拥有极速不是梦想</p>
									<div onclick="ShowPayType(this)" class="btn-donation upgrade">
										<span>升级</span>
									</div>
								</div>
								<div class="con-donation-list" style="display: none;">
									<ul class="donation-list-lev1 client-pc">
										<?php if($config['juhe']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(1.2,'juhe')">微信wap【推荐】</span>
										</li>
										<?php endif; if($config['weipay']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(1.2,'weipay','zweixin')">weipay【推荐】</span>
										</li>
										<?php endif; ?>
										<li>
											<span onclick="CratePayGoods(1.2,'whereali')">支付宝【推荐】</span>
										</li>
										<!---->
										<li>
											<span onclick="CratePayGoods(1.2,'wherewx')">微信【推荐】</span>
										</li>
										<!---->
										<!---->
									</ul>
									<ul class="donation-list-lev1 client-mobile" style="display: none;">
										<?php if($config['juhe']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(1.2,'juhe')">微信wap【推荐1.2】</span>
										</li>
										<?php endif; if($config['weipay']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(1.2,'weipay','zweixin')">weipay【推荐】</span>
										</li>
										<?php endif; ?>
										<li>
											<span onclick="CratePayGoods(1.2,'whereali')">支付宝【推荐】</span>
										</li>
										<!---->
										<li>
											<span onclick="CratePayGoods(1.2,'wherewx')">微信【推荐】</span>
										</li>
										<!---->
									</ul>
									<div class="text-ssl">
										<p>如果有任何疑问，点击<a href="javascript:GoToChat();"
												style="cursor: pointer; color: rgb(0, 255, 255);">[在线咨询]</a>，联系在线客服</p>
									</div>
								</div>
							</div>
							<div class="donation-box">
								<div class="pepay_login li-donation-in svipBox">
									<div class="icon-donate-svalue cn"></div>
									<div class="icon-donate-30 cn"></div>
									<div class="redtag-greatvalue cn"></div>
									<div class="donation-time">Vip会员/季</div>
									<div class="donation-cost">
										<span class="ntSymbol">￥</span>1.3<span class="priceSlash">/</span>
										<span class="GBuyText">3个月</span>
									</div>
									<p>3个月无限观看季度速成</p>
									<p>让你修炼成手枪达人</p>
									<div onclick="ShowPayType(this)" class="btn-donation upgrade">
										<span>升级</span>
									</div>
								</div>
								<div class="con-donation-list" style="display: none;">
									<ul class="donation-list-lev1 client-pc">
										<?php if($config['juhe']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(1.3,'juhe')">微信wap【推荐】</span>
										</li>
										<?php endif; if($config['weipay']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(1.3,'weipay','zweixin')">weipay【推荐】</span>
										</li>
										<?php endif; ?>
										<li>
											<span onclick="CratePayGoods(1.3,'whereali')">支付宝【推荐】</span>
										</li>
										<!---->
										<li>
											<span onclick="CratePayGoods(1.3,'wherewx')">微信【推荐】</span>
										</li>
										<!---->
										<!---->
									</ul>
									<ul class="donation-list-lev1 client-mobile" style="display: none;">
										<?php if($config['juhe']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(1.3,'juhe')">微信wap【推荐1.3】</span>
										</li>
										<?php endif; if($config['weipay']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(1.3,'weipay','zweixin')">weipay【推荐】</span>
										</li>
										<?php endif; ?>
										<li>
											<span onclick="CratePayGoods(1.3,'whereali')">支付宝【推荐】</span>
										</li>
										<!---->
										<li>
											<span onclick="CratePayGoods(1.3,'wherewx')">微信【推荐】</span>
										</li>
										<!---->
									</ul>
									<div class="text-ssl">
										<p>如果有任何疑问，点击<a href="javascript:GoToChat();"
												style="cursor: pointer; color: rgb(0, 255, 255);">[在线咨询]</a>，联系在线客服</p>
									</div>
								</div>
							</div>
							<div class="donation-box">
								<div class="pepay_login li-donation-in svipBox">
									<div class="icon-donate-svalue cn"></div>
									<div class="icon-donate-30 cn"></div>
									<div class="redtag-greatvalue cn"></div>
									<div class="donation-time">Vip会员/年</div>
									<div class="donation-cost">
										<span class="ntSymbol">￥</span>1.5<span class="priceSlash">/</span>
										<span class="GBuyText">12个月</span>
									</div>
									<p>12个月无限观看适合持久不断的你</p>
									<p>一号在手天下我有</p>
									<div onclick="ShowPayType(this)" class="btn-donation upgrade">
										<span>升级</span>
									</div>
								</div>
								<div class="con-donation-list" style="display: none;">
									<ul class="donation-list-lev1 client-pc">
										<?php if($config['juhe']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(1.5,'juhe')">微信wap【推荐】</span>
										</li>
										<?php endif; if($config['weipay']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(1.5,'weipay','zweixin')">weipay【推荐】</span>
										</li>
										<?php endif; ?>
										<li>
											<span onclick="CratePayGoods(1.5,'whereali')">支付宝【推荐】</span>
										</li>
										<!---->
										<li>
											<span onclick="CratePayGoods(1.5,'wherewx')">微信【推荐】</span>
										</li>
										<!---->
										<!---->
									</ul>
									<ul class="donation-list-lev1 client-mobile" style="display: none;">
										<?php if($config['juhe']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(1.5,'juhe')">微信wap【推荐1.5】</span>
										</li>
										<?php endif; if($config['weipay']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(1.5,'weipay','zweixin')">weipay【推荐】</span>
										</li>
										<?php endif; ?>
										<li>
											<span onclick="CratePayGoods(1.5,'whereali')">支付宝【推荐】</span>
										</li>
										<!---->
										<li>
											<span onclick="CratePayGoods(1.5,'wherewx')">微信【推荐】</span>
										</li>
										<!---->
									</ul>
									<div class="text-ssl">
										<p>如果有任何疑问，点击<a href="javascript:GoToChat();"
												style="cursor: pointer; color: rgb(0, 255, 255);">[在线咨询]</a>，联系在线客服</p>
									</div>
								</div>
							</div>
							<div class="donation-box">
								<div class="pepay_login li-donation-in svipBox">
									<div class="icon-donate-svalue cn"></div>
									<div class="icon-donate-30 cn"></div>
									<div class="redtag-greatvalue cn"></div>
									<div class="donation-time">Vip会员/终生</div>
									<div class="donation-cost">
										<span class="ntSymbol">￥</span>518<span class="priceSlash">/</span>
										<span class="GBuyText">终生</span>
									</div>
									<p>终身会员！无限观看！</p>
									<p>一号在手天下我有</p>
									<div onclick="ShowPayType(this)" class="btn-donation upgrade">
										<span>升级</span>
									</div>
								</div>
								<div class="con-donation-list" style="display: none;">
									<ul class="donation-list-lev1 client-pc">
										<?php if($config['juhe']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(518,'juhe','wxwap')">微信wap【推荐】</span>
										</li>
										<?php endif; if($config['weipay']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(518,'weipay','zweixin')">weipay【推荐】</span>
										</li>
										<?php endif; ?>
										<li>
											<span onclick="CratePayGoods(518,'whereali')">支付宝【推荐】</span>
										</li>
										<!---->
										<li>
											<span onclick="CratePayGoods(518,'wherewx')">微信【推荐】</span>
										</li>
										<!---->
										<!---->
									</ul>
									<ul class="donation-list-lev1 client-mobile" style="display: none;">
										<?php if($config['juhe']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(518,'juhe')">微信wap【推荐518】</span>
										</li>
										<?php endif; if($config['weipay']['appid']!=''): ?>
										<li>
											<span onclick="CratePayGoods(518,'weipay','zweixin')">weipay【推荐】</span>
										</li>
										<?php endif; ?>
										<li>
											<span onclick="CratePayGoods(518,'whereali')">支付宝【推荐】</span>
										</li>
										<!---->
										<li>
											<span onclick="CratePayGoods(5181,'wherewx')">微信【推荐】</span>
										</li>
										<!---->
									</ul>
									<div class="text-ssl">
										<p>如果有任何疑问，点击<a href="javascript:GoToChat();"
												style="cursor: pointer; color: rgb(0, 255, 255);">[在线咨询]</a>，联系在线客服</p>
									</div>
								</div>
							</div>
						</div>
						<div class="donation_thumbnail">
							<p class="secTitle">升级VIP 好片天天看到爽</p>
							<div class="thumbRow left">
								<div class="nakedGirl"></div>
								<p>天天更新，大大满足</p>
							</div>
							<div class="thumbRow middle">
								<div class="nakedGirl"></div>
								<p>主播直送，当日同步！</p>
							</div>
							<div class="thumbRow right">
								<div class="nakedGirl"></div>
								<p>全亚独家，爽度爆表！</p>
							</div>
						</div>
						<div class="donation_descrip">
							<div class="secTitle">
								<p>贴心说明</p>
							</div>
							<div class="leftBox">
								<p class="boxTitle">一分钟快速升级</p>
								<div class="payment_step">
									<span class="stepNum">1</span>
									<span class="paymentInfo">选择优惠方案</span>
									<span class="paymentArrow">&gt;</span>
									<span class="stepNum">2</span>
									<span class="paymentInfo">选择付费方式</span>
									<span class="paymentArrow">&gt;</span>
									<span class="stepNum">3</span>
									<span class="paymentInfo">完成付款</span>
								</div>
								<p>本站提供－ 支付宝/微信支付等方式来升级VIP或购买Ｇ点，帐单不会有任何情色/成人相关字样，请安心购买。</p>
								<p>安全加密－ 含羞草对于会员交易信息，采用最高级别加密技术，请放心消费，安全无虞。</p>
							</div>
							<div class="rightBox">
								<p class="boxTitle">附加说明</p>
								<p>* 升级VIP由系统自动完成，升级后立享福利，无需人工验证。</p>
								<p>*「VIP」虽拥有多种福利，但与一般会员一样必须遵守我站规定。</p>
								<p>*「VIP」到期后会自动转回为体验会员。</p>
								<p>*「VIP」付款周期有天、月、季、半年、年5种。</p>
								<p>* 有关本网站相关问题请来信至 hanxiucao6@gmail.com。</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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
	<script>
		var client = {};
		// 是否为移动端
		client.isMobile = /(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i.test(navigator.userAgent);
		// 移动端类型
		client.isiPad = /iPad/i.test(navigator.userAgent); // ipad
		client.isiPhone = /iPhone|iPod/i.test(navigator.userAgent); // iphone
		client.isAndroid = /Android/i.test(navigator.userAgent); // android
		client.isIOS = /\(i[^;]+;( U;)? CPU.+Mac OS X/i.test(navigator.userAgent) // IOS
		client.isWechat = /MicroMessenger/i.test(navigator.userAgent); // wechat
		client.isQQ = /QQ/i.test(navigator.userAgent); // QQ
		client.isWeibo = /Weibo/i.test(navigator.userAgent);
		// weibo
		// 浏览器类型
		client.isQQBro = /MQQBrowser/i.test(navigator.userAgent) // QQ浏览器
		client.isUCBro = /UCBrowser/i.test(navigator.userAgent) // UC浏览器
		client.isChrome = /Chrome\/([\d\.]+)/i.test(navigator.userAgent) // Chrome
		client.isFireFox = /Firefox\/([\d\.]+)/i.test(navigator.userAgent) // FireFox
		client.isIE = navigator.userAgent.indexOf("compatible") > -1 && navigator.userAgent.indexOf("MSIE") > -1 && !isOpera // IE
		client.isSafari = /Safari/i.test(navigator.userAgent) // Safari
		client.isOpera = /Opera/i.test(navigator.userAgent) // Opera
		client.isMaxthon = navigator.userAgent.indexOf("Maxthon") > -1 // 遨游broswer

		if (!client.isWechat && !client.isQQ && !client.isWeibo) {
			var domain = document.location.origin + document.location.pathname;
			if (window.parent.length > 0)
				top.location.href = domain + (UserInfo.AgentID > 0 ? "?AgentID=" + UserInfo.AgentID : "");

		}

		if (client.isIOS || client.isAndroid) {
			$(".client-pc").hide();
			$(".client-mobile").show();
		}
		function ShowPayType(obj) {
			var panel = $(obj).parent().next();
			if (panel.css("display") == "none")
				panel.css("display", "block");
			else
				panel.css("display", "none");

		}
		function Post(url, params) {
			var form = $("<form method='post'></form>");
			form.attr({ "action": url });
			for (pa in params) {
				var input = $("<input type='hidden'>");
				input.attr({ "name": pa });
				input.val(params[pa]);
				form.append(input);
			}
			$("html").append(form);
			form.submit();
		}

		function CratePayGoods(price, payment, type = 1) {

			Post("<?php echo url('user/gopay2'); ?>", {
				price: price,
				payment: payment,
				paytype: type
			});

		}
	</script>
	<script>
		$('#btn_submit_card').click(function () {
			var that = $(this);
			var no = $('input[name="card_no"]').val();
			if (no == '') {
				alert('请输入充值卡');
				return;
			}
			if (confirm('确定要使用充值卡充值吗')) {
				$.ajax({
					url: "<?php echo mac_url('user/buy'); ?>",
					type: "post",
					dataType: "json",
					data: {
						card_no: no,
						flag: 'card'
					},
					beforeSend: function () {
						$("#btn_submit_card").val("loading...");
					},
					success: function (r) {
						alert(r.msg);
						if (r.code == 1) {
							location.href = "<?php echo mac_url('user/index'); ?>";
						}

					},
					complete: function () {
						$("#btn_submit_card").val("提交");
					}
				});
			}
		});

		$(".face").imageUpload({
			formAction: "<?php echo url('user/portrait'); ?>",
			inputFileName: 'file',
			browseButtonValue: '',
			browseButtonClass: 'btn btn-default btn-xs fed-user-alter fed-part-roun fed-icon-font fed-icon-xiugai',
			automaticUpload: true,
			hideDeleteButton: true,
			hover: true
		})
		$(".jQuery-image-upload-controls").mouseenter(function () {
			$(".jQuery-image-upload-controls").css("display", "block");
		});
		$(".jQuery-image-upload-controls").mouseleave(function () {
			$(".jQuery-image-upload-controls").css("display", "none");
		});
		$(".face").on("imageUpload.uploadFailed", function (ev, err) {
			alert(err);
		});
	</script>
	<script src="<?php echo $maccms['path_tpl']; ?>html/style/js/bootstrap.bundle.min.js"></script>
	<!-- Core plugin JavaScript-->
	<script src="<?php echo $maccms['path_tpl']; ?>html/style/js/jquery.easing.min.js"></script>
	<!-- Owl Carousel -->
	<script src="<?php echo $maccms['path_tpl']; ?>html/style/js/owl.carousel.js"></script>
	<!-- Custom scripts for all pages-->
	<script src="<?php echo $maccms['path_tpl']; ?>html/style/js/custom.js"></script>
	<script>
		$(document).on('click', '#sidebarTogglePc', function (e) {
			e.preventDefault();
			$("#block-slide-pc").slideToggle("fast")
			if ($("#block-slide-pc-down").is(":visible")) {
				$("#block-slide-pc-down").slideToggle("fast")
			}


			// $("#block-slide-pc-down").slideToggle("fast")
		});
		$(document).on('click', '#sidebarTogglePcDown', function (e) {
			e.preventDefault();
			$("#block-slide-pc-down").slideToggle("fast")
			if ($("#block-slide-pc").is(":visible")) {
				$("#block-slide-pc").slideToggle("fast")
			}


			// $("#block-slide-pc").slideToggle("fast")
		});
		$(document).on('click', '#sidebarTogglePcLeft', function (e) {
			e.preventDefault();
			$("#block-slide-pc").slideToggle("fast")
			if ($("#block-slide-pc-down").is(":visible")) {
				$("#block-slide-pc-down").slideToggle("fast")
			}

		});
		$(document).on('click', '#sidebarTogglePcLeftDown', function (e) {
			e.preventDefault();
			$("#block-slide-pc-down").slideToggle("fast")
			if ($("#block-slide-pc").is(":visible")) {
				$("#block-slide-pc").slideToggle("fast")
			}

		});


		$(document).ready(function () {
			$("img.lazy").lazyload({ effect: "fadeIn", threshold: 500 });
			$("img.lazy1").lazyload({ effect: "fadeIn", threshold: 500 });

		});
	</script>
	<script>
		function open_new_window(full_link) {
			window.open('javascript:window.name;', '<script>location.replace("' + full_link + '")<\/script>');
		}
		if (client.isIOS || client.isAndroid) {
			$(".client-pc").hide();
			$(".client-mobile").show();
		}
	</script>
</body>

</html>