<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
		<title>用户登录 - {$c['网站名称']}</title>

		<link href="{$templatedir}/style/css/all.min-40cb1e.css" rel="stylesheet">
		<link href="{$templatedir}/style/css/custom.css" rel="stylesheet">
		<link rel="icon"href="{$templatedir}/favicon.ico">
		<!--[if lt IE 9]>
  <script src="{$templatedir}/style/js/html5shiv.js"></script>
  <script src="{$templatedir}/style/js/respond.min.js"></script>
<![endif]-->

		<script src="{$templatedir}/style/js/scripts.min-40cb1e.js"></script>
		<link rel="stylesheet" href="{$templatedir}/style/css/bootstrap.min.css">
		<link rel="stylesheet" id="css-main" href="{$templatedir}/style/css/oneui.css">


		<link rel="stylesheet" type="text/css" href="{$templatedir}/style/css/fontawesome-all.min.css">
	</head>
	<body data-phone-cc-input="1" style="background-color: #F5F5F5;">
		<link rel="stylesheet" href="{$templatedir}/style/css/bootstrap.min.css">
		<link rel="stylesheet" id="css-main" href="{$templatedir}/style/css/oneui.css">
	    	{include file="alert.tpl"}
		<div class="bg-white pulldown">
			<div class="content content-boxed overflow-hidden">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
						<div class="push-30-t push-50 animated fadeIn">
							<div class="text-center">
						         <img src="{$templatedir}/logo2.png" widht="122" height="44" /> 
							</div>

		<br/>					<section id="main-body">
								<div class="main-content">
									<p class="text-center text-muted">
										用户登录
									</p>
<h1 class="h3 text-center" style="color: #656565;">Login</h1>


									<form class="js-validation-login form-horizontal push-30-t login-form" action=""
									 method="post" role="form" style="margin-bottom: 30px;">
									    
										<div class="form-group">
											<div class="col-xs-12">
												<div class="form-material form-material-primary floating">
													
													<input type="text" name="swapname"  id="inputEmail" size="50"  class="form-control"/>
													
													<label for="inputEmail" style="color: #767676;">用户名/邮件地址</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-12">
												<div class="form-material form-material-primary floating">
													
													<input type="password" name="swappass" size="20" class="form-control" id="inputPassword" autocomplete="off" />
													
													<label for="login-password" style="color: #767676;">密码</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-6">
												<label class="css-input switch switch-sm switch-primary">
													<input type="checkbox" id="rememberme" name="rememberme"><span></span> 自动登录
												</label>
											</div>
											<div class="col-xs-6">
												<div class="font-s13 text-right push-5-t">
													<!--<a href="忘记密码" style="color: #00AAFF;">忘记密码？</a>-->
													{$plug['登入页底部']}
												</div>
											</div>
										</div>
										<div class="form-group push-30-t">
											<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
												<button id="login" class="btn btn-sm btn-block btn-primary" type="submit">登录</button>
											</div>
										</div>
									</form>

	还没有账户？立即 <a href="{$ROOT}/index/register" style="color: #00aaff;">免费注册</a>
                 &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/" style="color: #00aaff;">返回首页</a>
									<!--<p style="text-align:center;">您也可以选择 <a href="javascript:window.open('https://www.whmcs.com/');" target="_blank">QQ登录</a></p>-->
								</div>
							</section>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="pulldown push-30-t text-center animated fadeInUp">
			<small class="text-muted"><span class="js-year-copy"></span> &copy; Copyright 2020 {$c['网站名称']} , All Rights Reserved</small>
		</div>
<br/><br/>
		<script src="{$templatedir}/style/js/jquery.slimscroll.min.js"></script>
		<script src="{$templatedir}/style/js/jquery.scrollLock.min.js"></script>
		<script src="{$templatedir}/style/js/jquery.appear.min.js"></script>
		<script src="{$templatedir}/style/js/jquery.countTo.min.js"></script>
		<script src="{$templatedir}/style/js/jquery.placeholder.min.js"></script>
		<script src="{$templatedir}/style/js/js.cookie.min.js"></script>
		<script src="{$templatedir}/style/js/app.js"></script>
		<script src="{$templatedir}/style/js/base_pages_login.js"></script>
		<script src="{$templatedir}/style/js/jquery.validate.min.js"></script>
		<div class="modal system-modal fade" id="modalAjax" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content panel panel-primary">
					<div class="modal-header panel-heading">
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only">Close</span>
						</button>
						<h4 class="modal-title">Title</h4>
					</div>
					<div class="modal-body panel-body">
						Loading...
					</div>
					<div class="modal-footer panel-footer">
						<div class="pull-left loader">
							<i class="fa fa-circle-o-notch fa-spin"></i> Loading...
						</div>
						<button type="button" class="btn btn-default" data-dismiss="modal">
							Close
						</button>
						<button type="button" class="btn btn-primary modal-submit">
							Submit
						</button>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
