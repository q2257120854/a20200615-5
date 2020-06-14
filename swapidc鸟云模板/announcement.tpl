<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
        <title>公告信息 - {$c['网站名称']}</title>
<link href="{$templatedir}/style1/css/all.min.css" rel="stylesheet">
<link href="{$templatedir}/style1/css/custom.css" rel="stylesheet">
<link rel="icon"href="{$templatedir}/favicon.ico">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="{$templatedir}/style/js/html5shiv.js"></script>
  <script src="{$templatedir}/style/js/respond.min.js"></script>
<![endif]-->

<!---版权信息，作者QQ 1282127298--->

<script src="{$templatedir}/style1/js/scripts.min.js"></script>


<link rel="stylesheet" href="{$templatedir}/style1/css/bootstrap.min.css">
<link rel="stylesheet" id="css-main" href="{$templatedir}/style/css/oneui.css">
<link rel="stylesheet" href="{$templatedir}/style1/css/magnific-popup.min.css">
<link rel="stylesheet" href="{$templatedir}/style1/css/slick.min.css">
<link rel="stylesheet" href="{$templatedir}/style1/css/slick-theme.min.css">
<link rel="stylesheet" href="{$templatedir}/style1/css/font.css">

    


<!-- Dynamic Template Compatibility -->
<!-- Please update your theme to include or have a comment on the following to negate dynamic inclusion -->
<link rel="stylesheet" type="text/css" href="{$templatedir}/style1/css/fontawesome-all.min.css" />

</head>
<body data-phone-cc-input="1">
 <body>{include file="alert.tpl"}




<link rel="stylesheet" href="{$templatedir}/style1/css/bootstrap.min.css">
<link rel="stylesheet" id="css-main" href="{$templatedir}/style1/css/oneui.css">
<link rel="stylesheet" href="{$templatedir}/style1/css/magnific-popup.min.css">
<link rel="stylesheet" href="{$templatedir}/style1/css/slick.min.css">
<link rel="stylesheet" href="{$templatedir}/style1/css/slick-theme.min.css">
<link rel="stylesheet" href="{$templatedir}/style1/css/font.css">




<link rel="stylesheet" href="{$templatedir}/style1/css/main.css">
        <link href="{$templatedir}/style/css/all.min-40cb1e.css" rel="stylesheet">
        <link href="{$templatedir}/style/css/custom.css" rel="stylesheet">
        <!--[if lt IE 9]>
            <script src="style/js/html5shiv.js"></script>
            <script src="style/js/respond.min.js"></script>
        <![endif]-->
        <script src="{$templatedir}/style/js/scripts.min-40cb1e.js"></script>
        <link rel="stylesheet" href="{$templatedir}/style/css/bootstrap.min.css">
        <link rel="stylesheet" id="css-main" href="{$templatedir}/style/css/oneui.css">
        <link rel="stylesheet" href="{$templatedir}/style/css/magnific-popup.min.css">
        <link rel="stylesheet" href="{$templatedir}/style/css/slick.min.css">
        <link rel="stylesheet" href="{$templatedir}/style/css/slick-theme.min.css">
        <link rel="stylesheet" href="{$templatedir}/style/css/font.css">
        <link rel="stylesheet" type="text/css" href="{$templatedir}/style/css/fontawesome-all.min.css">
    </head>
    
    <body data-phone-cc-input="">
        <link rel="stylesheet" href="{$templatedir}/style/css/bootstrap.min.css">
        <link rel="stylesheet" id="css-main" href="{$templatedir}/style/css/oneui.css">
        <link rel="stylesheet" href="{$templatedir}/style/css/magnific-popup.min.css">
        <link rel="stylesheet" href="{$templatedir}/style/css/slick.min.css">
        <link rel="stylesheet" href="{$templatedir}/style/css/slick-theme.min.css">
        <link rel="stylesheet" href="{$templatedir}/style/css/font.css">
        <div id="page-container" class="side-scroll header-navbar-fixed header-navbar-transparent">
            {include file="public/index_header.tpl"}
            <main id="main-container2">
                <section id="main-body">
                    <div class="bg-white" style="height: 65px;box-shadow: 1px 1px 19px rgba(28, 61, 94, 0.17);line-height: 65px;">
                        <section class="content-full content-boxed container">	<i class="fa fa-bullhorn" style="margin-right: 10px;font-size: 20px;color: #00C0FA;"></i><span style="color: #00c0fa;font-weight: 600;font-size: 18px;">公告信息</span>

                        </section>
                    </div>
                    <section id="main-body">
                        <div class="main-content">
                            <section class="content-full content-boxed container">
                                <div class="bg-white push-50-t" style="border-radius: 5px;padding: 20px 25px 50px 25px;box-shadow: 1px 1px 22px rgba(157, 184, 209, 0.19);margin-bottom: 150px;">
                                    <div class="alert alert-info text-center">【{$e['公告标题']}】-{$lang['时间']}: {$e['公告时间']} {$lang['作者']}: {$e['公告作者']}</div>
                                    <p>{$e['公告内容']}</p>
                                </div>
                            </section>
                        </div>
                    </section>
                    <div class="bg-gray-lighter" style="background: #0af url(/templates/KiKiCloud/style/images/img/footer_bg.jpg) no-repeat center;">
                        <section class="content content-full content-boxed">
    {if $s['是否已经登陆']=='否'}
                        <div class="push-15-t push-10 text-center">
                            <h3 class="h4 text-white">立即加入我们，开启云计算之旅~</h3>
                            <a class="push-15-t btn " href="/index.php/index/register/" style="    display: inline-block;
    margin-top: 24px;
    width: 220px;
    height: 44px;
    line-height: 30px;
    border: 1px solid #fff;
    color: #fff;">免费注册账户</a>
                        </div>
 {/if}
   {if $s['是否已经登陆']=='是'}
                        <div class="push-15-t push-10 text-center">
                            <h3 class="h4 text-white">进入会员中心管理您宝贵的产品</h3>
                            <a class="push-15-t btn " href="/index.php/user/" style="    display: inline-block;
    margin-top: 24px;
    width: 220px;
    height: 44px;
    line-height: 30px;
    border: 1px solid #fff;
    color: #fff;">进入会员中心</a>
                        </div>
  {/if}
                        </section>
                    </div>
                </section>
            </main>
            {include file="footer.tpl"}
        </div>
        <script src="{$templatedir}/style/js/jquery.slimscroll.min.js"></script>
        <script src="{$templatedir}/style/js/jquery.scrollLock.min.js"></script>
        <script src="{$templatedir}/style/js/jquery.appear.min.js"></script>
        <script src="{$templatedir}/style/js/jquery.countTo.min.js"></script>
        <script src="{$templatedir}/style/js/jquery.placeholder.min.js"></script>
        <script src="{$templatedir}/style/js/js.cookie.min.js"></script>
        <script src="{$templatedir}/style/js/slick.min.js"></script>
        <script src="{$templatedir}/style/js/Chart.min.js"></script>
        <script>
        jQuery(function () {
            // Init page helpers (Slick Slider plugin)
            App.initHelpers('slick');
        });
        </script>
        <script src="{$templatedir}/style/js/magnific-popup.min.js"></script>
        <script>
        jQuery(function () {
            // Init page helpers (Magnific Popup plugin)
            App.initHelpers('magnific-popup');
        });
        </script>
    </body>

</html>