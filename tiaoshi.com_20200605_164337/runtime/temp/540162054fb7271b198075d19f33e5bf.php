<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:62:"/www/wwwroot/tiaoshi.com/application/dai/view/agent/index.html";i:1588716426;s:62:"/www/wwwroot/tiaoshi.com/application/dai/view/layout/base.html";i:1589221096;}*/ ?>

<!DOCTYPE html>
<html lang="zh_ch">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">
    
    <title>后台管理系统</title>
    
    <link href="/static/dai/css/style.css" rel="stylesheet">
    <!--<link href="/static/dai/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="/static/dai/css/style-responsive.css" rel="stylesheet">
    
    <script src="/static/dai/js/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/static/dai/js/html5shiv.js"></script>
    <script src="/static/dai/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo start-->
        <div class="logo">
            <a href="<?php echo url('index/home'); ?>"><img src="/static/dai/images/logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="<?php echo url('index/home'); ?>"><img src="/static/dai/images/logo_icon.png" alt=""></a>
        </div>
        <!--logo  end-->


        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="/static/dai/images/photos/user-avatar.png" class="media-object">
                    <div class="media-body">
                        <h4><a><?php echo $user['user_name']; ?></a></h4>
                    </div>
                </div>
                <ul class="nav nav-pills nav-stacked custom-nav">
                    <li><a  data-toggle="modal" href="#myModal"><i class="fa fa-cog"></i> <span>修改密码</span></a></li>
                    <li><a href="<?php echo url('index/out'); ?>"><i class="fa fa-sign-out"></i> <span>退出</span></a></li>
                </ul>
            </div>

            <!--左侧菜单 start-->
<ul class="nav nav-pills nav-stacked custom-nav">
    <li class="menu-list}" data-url="index">
        <a href="<?php echo url('index/home'); ?>"><i class="fa fa-home"></i><span>主页</span></a>
    </li>
    <li class="menu-list" data-url="agent"><a href="#"><i class="fa fa-edit"></i><span>团队管理</span></a>
        <ul class="sub-menu-list">
            <li data-url="agent-user"><a href="<?php echo url('agent/user'); ?>">直属用户</a></li>
            <li data-url="agent-index"><a href="<?php echo url('agent/index'); ?>">代理列表</a></li>
            <li data-url="agent-agent_add"><a href="<?php echo url('agent/agent_add'); ?>">代理添加</a></li>
            <!--<li data-url="agent-agent_add"><a href="<?php echo url('agent/user_info'); ?>">用户信息</a></li>-->
        </ul>
    </li>
    <li class="menu-list" data-url="statistic"><a href="#"><i class="fa fa-edit"></i><span>数据统计</span></a>
        <ul class="sub-menu-list">
            <li data-url="statistic-index"><a href="<?php echo url('statistic/index'); ?>">收益统计</a></li>
            <li data-url="statistic-register"><a href="<?php echo url('statistic/register'); ?>">注册统计</a></li>
            <li data-url="statistic-recharge"><a href="<?php echo url('statistic/recharge'); ?>">充值统计</a></li>
            <li data-url="statistic-zhi_rate"><a href="<?php echo url('statistic/zhi_rate'); ?>">直属用户转化</a></li>
            <li data-url="statistic-daili_rate"><a href="<?php echo url('statistic/daili_rate'); ?>">代理发展转化</a></li>
            <li data-url="statistic-agent"><a href="<?php echo url('statistic/agent'); ?>">代理统计</a></li>
        </ul>
    </li>
    <li class="menu-list" data-url="finance"><a href="#"><i class="fa fa-edit"></i><span>财务管理</span></a>
        <ul class="sub-menu-list">
            <li data-url="finance-index"><a href="<?php echo url('finance/index'); ?>">个人财务</a></li>
          	<li data-url="finance-record"><a href="<?php echo url('finance/yjlog'); ?>">佣金记录</a></li>
            <li data-url="finance-record"><a href="<?php echo url('finance/record'); ?>">提现记录</a></li>
        </ul>
    </li>
    <li class="menu-list}">
        <a href="<?php echo url('index/promote'); ?>"><i class="fa fa-link"></i><span>推广链接</span></a>
    </li>
</ul>
<input type="hidden" name="controller_now" value="<?php echo $controller; ?>">
<input type="hidden" name="action_now" value="<?php echo $action; ?>">
<!--左侧菜单 end-->
<script>
    var controller_now = $("[name=controller_now]").val();
    var action_now = $("[name=action_now]").val();

    $(".menu-list").each(function () {
        if($(this).data('url') == controller_now){
            $(this).addClass('nav-active');
        }
    })
    $(".sub-menu-list li").each(function () {
        if($(this).data('url') == (controller_now+'-'+action_now)){
            $(this).addClass('active');
        }
    })
</script>

        </div>
    </div>
    <!-- left side end-->

    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->

            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu pull-right">

                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo $user['user_portrait']; ?>" alt="" />
                            <?php echo $user['user_name']; ?>                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a  data-toggle="modal" href="#myModal"><i class="fa fa-cog"></i> <span>修改密码</span></a></li>
                            <li><a href="<?php echo url('index/out'); ?>"><i class="fa fa-sign-out"></i>退出</a></li>
                        </ul>
                    </li>

                </ul>


                <!-- <ul class="nav navbar-top-links navbar-right pull-right" style="margin-top:5px">
                    <li class="dropdown" style="margin-right: 0px;">
                        <a type="hidden" class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell fa-fw"></i><span id="msg_total" style="background-color: red" class="badge badge-important">0</span>
                        </a>
                        <ul class="dropdown-menu dropdown-user ">
                            <li><a href="/index/money/recharge.html"><i class="fa fa-user-plus fa-fw"></i>  待充值信息       <span id="recharging" style="float: center;background-color: red"class="badge badge-important">0</span></a>
                            </li>
                            <li><a href="/index/money/cash.html"><i class="fa fa-shopping-bag fa-fw"></i>  待提现信息       <span id="cashing" style="float: center;background-color: red"class="badge badge-important">0</span></a>
                                <audio src="__AUDIO__/recharge.mp3" id="audio_recharge">
                                </audio>
                                <audio src="__AUDIO__/withdraw.mp3" id="audio_withdraw">
                                </audio>
                            </li>
                        </ul>
                    
                    </li>
           
                </ul> -->
            </div>
            <!--notification menu end -->

        </div>
        <!-- header section end-->
        <!--提示信息-->
        <div id="top-alert" class="fixed alert alert-error">
            <button class="close fixed">&times;</button>
            <div class="alert-content">提示信息</div>
        </div>
        <!--提示信息end-->
        


<link rel="stylesheet" href="/static/layui/css/layui.css" media="all">
<!--body wrapper start-->
<style>
    .amount-box {
        background: #fff;
        border-radius: 4px;
        padding: 15px 5px 0px;
    }

    .amount-box li {
        display: inline-block;
        width: 15%;
        min-width: 70px;
        text-align: center;
        margin-right: 15px;
        margin-bottom: 15px;
        border: 1px solid #ebeef5;
    }

    .amount-box li span {
        display: block;
        padding: 0 15px;
        line-height: 42px;
    }

    .amount-box li .amount-title {
        border-bottom: 1px solid #ebeef5;
    }
</style>

<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb panel">
                <li><a href="<?php echo url("","",true,false);?>">代理管理</a></li>
                <li class="active">代理列表</li>
                <li class="active">代理列表</li>
            </ul>
            <p style="padding: 10px 0;font-size: 20px;background: #fff;padding-left: 5px;text-align: center"><b
                    style="color: #00b7ee"><?php echo $user['user_name']; ?></b> 的直推数据</p>
            <!--breadcrumbs end -->
            <ul class="amount-box">
                <li>
                    <span class="amount-title">今日注册量</span>
                    <span class="amount-count"><?php echo $data['jrzcl']; ?></span>
                </li>
                <li>
                    <span class="amount-title">总注册量</span>
                    <span class="amount-count"><?php echo $data['zzcl']; ?></span>
                </li>
                <li>
                    <span class="amount-title">今日充值订单数</span>
                    <span class="amount-count"><?php echo $data['jrczdds']; ?></span>
                </li>
                <li>
                    <span class="amount-title">总充值订单数</span>
                    <span class="amount-count"><?php echo $data['zczdds']; ?></span>
                </li>
                <li>
                    <span class="amount-title">今日充值额</span>
                    <span class="amount-count"><?php echo $data['jrcze']; ?></span>
                </li>
                <li>
                    <span class="amount-title">总充值额</span>
                    <span class="amount-count"><?php echo $data['zcze']; ?></span>
                </li>
                <!-- <li>
                    <span class="amount-title">今日安卓注册数</span>
                    <span class="amount-count">0</span>
                </li>
                <li>
                    <span class="amount-title">今日IOS注册数</span>
                    <span class="amount-count">0</span>
                </li> -->
            </ul>
        </div>
    </div>
    <header class="panel-heading col-xs-12">
        <form class="form-inline" action="">
            <div class="form-group">
                <input type="text" name="account" class="form-control" value="" placeholder="账号">
                <input type="text" name="phone" class="form-control" value="" placeholder="手机号">
                <input type="text" name="start" id="start" autocomplete="off" class="form-control" value=""
                    placeholder="开始时间">
                <input type="text" name="end" id="end" autocomplete="off" class="form-control" value=""
                    placeholder="结束时间">
                <select name="order" class="form-control">
                    <option value="0">时间倒序</option>
                    <option value="1">时间正序</option>
                </select>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </header>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="home">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <tr>
                    <th>编号</th>
                    <th>代理账号</th>
                    <th>手机号</th>
                    <th>直属代理量</th>
                    <th>直属用户量</th>
                    <th>提成比例</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                <?php foreach($list as $key => $vo): ?>
                    <tr>
                        <td ><?php echo $vo['user_id']; ?></td>
                        <td ><?php echo $vo['user_name']; ?></td>
                        <td ><?php echo $vo['user_phone']; ?></td>
                        <td ><?php echo $vo['dll']; ?></td>
                        <td ><?php echo $vo['yhl']; ?></td>
                        <td ><?php echo $vo['user_tc']; ?></td>
                        <td ><?php echo date('Y-m-d H:i:s', $vo['user_reg_time']); ?></td>
                        <td ></td>
                    </tr>
                    <?php endforeach; ?>
            </table>
            <div class="page">
            </div>
        </div>

    </div>
</div>

<!--body wrapper end-->


<!--body wrapper end-->
<script src="/static/dai/js/laydate/laydate.js"></script>
<script src="/static/layui/layui.all.js"></script>
<script type="text/javascript">
    laydate.render({
        elem: '#start'
        , type: 'datetime'
    });
    laydate.render({
        elem: '#end'
        , type: 'datetime'
    });

    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要执行该操作吗？',function(){
            //发异步删除数据
            $.post("url(agent/agent_del)",{id:id},function (data) {
                if (data.code == 200) {
                    layer.msg(data.msg,{icon:6,time:1000},function () {
                        window.location.reload();
                    });
                }else{
                    layer.msg(data.msg,{icon:5,time:1500});
                }
            })
        });
    }
</script>

        <!--footer section start-->
        <footer class="sticky-footer">
        </footer>
        <!--footer section end-->

    </div>
    <!-- main content end-->
</section>

<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <h4 class="modal-title">修改密码</h4>
            </div>
            <form class="form-horizontal form-post change_pass_form" action="/index/agent/change_pass.html" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label  class="col-lg-2 col-sm-2 control-label">原密码</label>
                    <div class="col-lg-10">
                        <input type="password" name="pass_old" class="form-control"  placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-lg-2 col-sm-2 control-label">新密码</label>
                    <div class="col-lg-10">
                        <input type="password" name="pass_new" class="form-control"  placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-lg-2 col-sm-2 control-label">确认密码</label>
                    <div class="col-lg-10">
                        <input type="password" name="pass_sure" class="form-control"  placeholder="">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
                <button class="btn btn-primary change_pass" type="button">提交</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- modal -->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="/static/dai/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/static/dai/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/static/dai/js/bootstrap.min.js"></script>
<script src="/static/dai/js/modernizr.min.js"></script>
<script src="/static/dai/js/jquery.nicescroll.js"></script>



<!--common scripts for all pages-->
<script src="/static/dai/js/scripts.js"></script>
<script src="/static/dai/js/common.js"></script>

<script>
    $(".change_pass").click(function () {
        var pass_old = $("[name=pass_old]").val();
        var pass_new = $("[name=pass_new]").val();
        var pass_sure = $("[name=pass_sure]").val();
        if(pass_old == "" || pass_new ==""){
            layer.msg('密码不能为空!');
            return false;
        }

        if(pass_new != pass_sure){
            layer.msg('两次密码不一致!');
            return false;
        }
        $.post("<?php echo url('agent/change_pass'); ?>",{pass_old:pass_old,pass_new:pass_new,pass_sure:pass_sure},function (res) {
            if(res.code == 200){
                layer.msg(res.msg,{icon:6,time:1500},function () {
                    window.location.reload();
                })
            }else{
                layer.msg(res.msg);
                return false;
            }
        })
    });

function get_msg(){
    var total = $("#msg_total").text();
    var recharge = $("#recharging").text();
    var cash = $("#cashing").text();

    // $.ajax({
    //     url: "/index/index/get_msg.html",
    //     // data: ,
    //     type:'POST',
    //     dataType: "json",
    //     success:function(data){
    //         var new_total = data.recharge+data.withdrawals
    //         $("#msg_total").text(new_total);
    //         $("#recharging").text(data.recharge);
    //         $("#cashing").text(data.withdrawals);
            
    //     }
    // })

    setTimeout(function(){get_msg()}, 30000);
}
</script>

</body>
</html>
