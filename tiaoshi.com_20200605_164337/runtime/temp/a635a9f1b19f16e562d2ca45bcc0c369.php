<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:35:"template/RX03/new1685/user/reg.html";i:1577446254;s:61:"/www/wwwroot/tiaoshi.com/template/RX03/new1685/user/foot.html";i:1577472541;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,minimum-scale=1,user-scalable=no">
<meta name="description" content="<?php echo $maccms['site_description']; ?>">
<meta name="author" content="<?php echo $maccms['site_name']; ?>">
<title>用户注册 - <?php echo $maccms['site_name']; ?></title>
<!-- Favicon Icon -->
<link rel="icon" type="image/png" href="<?php echo $maccms['site_wapurl']; ?>html/style/images/favicon.png">
<!-- Bootstrap core CSS-->
<link href="<?php echo $maccms['site_wapurl']; ?>html/style/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom fonts for this template-->
<link href="<?php echo $maccms['site_wapurl']; ?>html/style/css/all.min.css" rel="stylesheet" type="text/css">
<!-- Custom styles for this template-->
<link href="<?php echo $maccms['site_wapurl']; ?>html/style/css/osahan.css" rel="stylesheet">
<!-- Owl Carousel -->
<link rel="stylesheet" href="<?php echo $maccms['site_wapurl']; ?>html/style/css/owl.carousel.css">
<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $maccms['site_wapurl']; ?>html/style/css/owl.theme.css">
<script src="<?php echo $maccms['path']; ?>static/js/jquery.js"></script>
<script>var maccms={"path":"","mid":"<?php echo $maccms['mid']; ?>","url":"<?php echo $maccms['site_url']; ?>","wapurl":"<?php echo $maccms['site_wapurl']; ?>","mob_status":"<?php echo $maccms['mob_status']; ?>"};</script>
<script src="<?php echo $maccms['path']; ?>static/js/home.js"></script>
<style>
.fr{float:right}@media (max-width: 768px){.login-main-wrapper{background: #fff;}.col-md-7.slide2{display: none!important;}.full-height{height: calc(100%);}} a.gohome{position:absolute;z-index:1;color:#fff;padding:7px 10px;border-radius:5px;margin:10px;border-color:transparent!important;background:#ff516b;background:-moz-linear-gradient(-45deg,#ff516b 0,#826cfd 100%);background:-webkit-linear-gradient(-45deg,#ff516b 0,#826cfd 100%);background:linear-gradient(135deg,#ff516b 0,#826cfd 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff516b',endColorstr='#826cfd',GradientType=1)}
</style>
</head>
<body class="login-main-body">
<section class="login-main-wrapper">
  <div class="container-fluid pl-0 pr-0">
    <div class="row no-gutters"> <a class="gohome" href="http://<?php echo $maccms['site_url']; ?>">首页</a>
      <div class="col-md-5 p-5 bg-white full-height">
        <div class="login-main-left">
          <div class="text-center mb-5 login-main-left-header pt-4"> <img src="<?php echo $maccms['site_wapurl']; ?>html/style/images/favicon.png" class="img-fluid" alt="LOGO">
            <h5 class="mt-3 mb-3">欢迎注册</h5>
            <p>海量番号精品视频精彩无限在线观看</p>
          </div>
          <form method="post" id="fm" action="">
            <div class="form-group">
              <label>账号设定</label>
              <input type="text" id="user_name" name="user_name" class="form-control" placeholder="建议您使用QQ号或手机号作为登录账号" required autofocus>
            </div>
            <div class="form-group">
              <label>密码设定</label>
              <input type="password" id="user_pwd" name="user_pwd" class="form-control" placeholder="请输入您的登录密码" required>
            </div>
            <div class="form-group">
              <label>确认密码</label>
              <input type="password" id="user_pwd2" name="user_pwd2" class="form-control" placeholder="请输入您的确认密码" required>
            </div>
            <?php if($user_config['reg_phone_sms'] != 0): ?>
            <input type="hidden" name="ac" value="phone">
            <div class="form-group">
              <label>手机号码</label>
              <input type="text" class="form-control" id="to" name="to" placeholder="请输入手机号">
              <input type="button" class="fr" style="margin-top: -31px;margin-right: 5px;" id="btn_send_sms" value="获取验证码"/>
            </div>
            <div class="form-group">
              <label>手机验证码</label>
              <input type="text" class="form-control" id="code" name="code" placeholder="请输入手机验证码">
            </div>
            <?php elseif($user_config['reg_email_sms'] != 0): ?>
            <input type="hidden" name="ac" value="email">
            <div class="form-group">
              <label>邮箱地址</label>
              <input type="text" class="form-control" id="to" name="to" placeholder="请输入邮箱">
              <input type="button" class="fr" style="margin-top: -31px;margin-right: 5px;" id="btn_send_sms" value="获取验证码"/>
            </div>
            <div class="form-group">
              <label>邮箱验证码</label>
              <input type="text" class="form-control" id="code" name="code" placeholder="请输入手机验证码">
            </div>
            <?php endif; if($user_config['reg_verify'] != 0): ?>
            <div class="form-group">
              <label>验证码</label>
              <input type="text" class="form-control" id="verify" name="verify" placeholder="请输入验证码">
              <img class="fr" style="margin-top: -39px;" id="verify_img" src="<?php echo url('verify/index'); ?>" onClick="this.src=this.src+'?'"  alt="单击刷新" /> </div>
            <?php endif; ?>
            <div class="mt-4">
              <input type="button" id="btn_submit" class="btn btn-outline-primary btn-block btn-lg" value="立即注册">
            </div>
          </form>
          <div class="text-center mt-5">
            <p class="light-gray">已经有账户? <a href="<?php echo url('user/login'); ?>">登录</a></p>
          </div>
        </div>
      </div>
      <div class="col-md-7 slide2">
        <div class="login-main-right bg-white p-5 mt-5 mb-5">
          <div class="owl-carousel owl-carousel-login">
            <div class="item">
              <div class="carousel-login-card text-center"> <img src="<?php echo $maccms['site_wapurl']; ?>html/style/images/recharge_loading_bg.png" width="75%" class="img-fluid" alt="LOGO">
                <h5 class="mt-5 mb-3">​海量番号精品视频精彩无限在线观看</h5>
                <p class="mb-4">蜜色拥有超过20000部激情视频 <br>
                  高速在线播放看个过瘾</p>
              </div>
            </div>
            <div class="item">
              <div class="carousel-login-card text-center"> <img src="<?php echo $maccms['site_wapurl']; ?>html/style/images/loading_empty.png" width="75%" class="img-fluid" alt="LOGO">
                <h5 class="mt-5 mb-3">VIP专区视频更精彩</h5>
                <p class="mb-4">VIP会员专区拥有更加优质精彩的内容,无需下载，超多美女激情视频一触即发 <br>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="m-footer" style="display:none;">
    <a class="navFooter" target="_self" href="/"><i class="fa fa-home"></i>首页</a>
    <button type="button" class="navFooter" id="sidebarToggle"><i class="fa fa-list"></i>分类</button>
    <a class="navFooter" target="_self" href="/index.php/vod/type/id/20.html"><i class="fas fa-layer-group"></i>试看</a>
    <a class="navFooter" target="_self" href="<?php echo mac_url('user/buy'); ?>"><i class="fa fa-diamond"></i>充值VIP</a>
    <a class="navFooter" target="_self" href="<?php echo mac_url('user/login'); ?>"><i class="fa fa-user"></i>我的</a>
</div>
  <a class="scroll-to-top rounded" href="#page-top"> <i class="fa fa-angle-up"></i> </a> 
  <!-- Logout Modal--> 
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
   <div class="modal-dialog modal-sm modal-dialog-centered" role="document"> 
    <div class="modal-content"> 
     <div class="modal-header"> 
      <h5 class="modal-title" id="exampleModalLabel">确定要退出?</h5> 
      <button class="close" type="button" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> 
     </div> 
     <div class="modal-body">
      真的要退出登录吗
     </div> 
     <div class="modal-footer"> 
      <button class="btn btn-secondary" type="button" data-dismiss="modal">取消</button> 
      <a class="btn btn-primary" href="<?php echo url('user/logout'); ?>" > 退出 </a> 
     </div> 
    </div> 
   </div> 
  </div> </div>
  </div>
</section>
<script type="text/javascript">

    var countdown=60;
    function settime(val) {
        if (countdown == 0) {
            val.removeAttribute("disabled");
            val.value="获取验证码";
            countdown = 60;
            return true;
        } else {
            val.setAttribute("disabled", true);
            val.value="重新发送(" + countdown + ")";
            countdown--;
        }
        setTimeout(function() {settime(val) },1000)
    }


		$("body").bind('keyup',function(event) {
			if(event.keyCode==13){ $('#btnLogin').click(); }
		});

        $('#btn_send_sms').click(function(){
            var ac = $('input[name="ac"]').val();
            var to = $('input[name="to"]').val();
            if(ac=='email') {
                var pattern = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
                var ex = pattern.test(to);
                if (!ex) {
                    alert('邮箱格式不正确');
                    return;
                }
            }
            else if(ac=='phone') {
                var pattern=/^[1][0-9]{10}$/;
                var ex = pattern.test(to);
                if (!ex) {
                    alert('手机号格式不正确');
                    return;
                }
            }
            else{
                alert('参数错误');
                return;
            }


            settime(this);
            var data = $("#fm").serialize();

            $.ajax({
                url: "<?php echo url('user/reg_msg'); ?>",
                type: "post",
                dataType: "json",
                data: data,
                beforeSend: function () {
                    //开启loading
                },
                success: function (r) {
                    alert(r.msg);
                },
                complete: function () {
                    //结束loading
                }
            });
        });

		$('#btn_submit').click(function() {
			if ($('#user_name').val()  == '') { alert('请输入用户！'); $("#user_name").focus(); return false; }
			if ($('#user_pwd').val()  == '') { alert('请输入密码！'); $("#user_pwd").focus(); return false; }
			if ($('#verify').val()  == '') { alert('请输入验证码！'); $("#verify").focus(); return false; }

			$.ajax({
				url: "<?php echo url('user/reg'); ?>",
				type: "post",
				dataType: "json",
				data: $('#fm').serialize(),
				beforeSend: function () {
					$("#btn_submit").val("loading...");
				},
				success: function (r) {
					alert(r.msg);
					if(r.code==1){
						location.href="<?php echo url('user/login'); ?>";
					}
					else{
						$('#verify_img').click();
					}
				},
				complete: function () {
					$("#btn_submit").val("立即注册");
				}
			});

		});


</script>
<!-- Bootstrap core JavaScript-->
<script src="<?php echo $maccms['site_wapurl']; ?>html/style/js/jquery.min.js"></script>
<script src="<?php echo $maccms['site_wapurl']; ?>html/style/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="<?php echo $maccms['site_wapurl']; ?>html/style/js/jquery.easing.min.js"></script>
<!-- Owl Carousel -->
<script src="<?php echo $maccms['site_wapurl']; ?>html/style/js/owl.carousel.js"></script>
<!-- Custom scripts for all pages-->
<script src="<?php echo $maccms['site_wapurl']; ?>html/style/js/custom.js"></script>
</body>
</html>
