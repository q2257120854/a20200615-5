<?php defined('PT_ROOT') || exit('Permission denied');?><html>
<head>
    <title><?php echo $msgname;?> 友情提示信息</title>
    <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8" />
    <base target = "_self" />
    <style>
        html, body, h2, div, p { margin: 0; padding: 0; list-style: none; border: none; font-size: 12px; }
        body { text-align: center; font-family: "Microsoft Yahei", Tahoma, Geeva, sans-serif; background: #E6E8F0; padding-bottom: 25px; font-size: 12px; outline: none; }
        a:link, a:visited, a:active { text-decoration: none; font-family: Tahoma, Geneva, sans-serif; }
        a:hover { text-decoration: underline; }
        .ts_div { width: 500px; overflow: hidden; position: absolute; top: 50%; left: 50%; margin-left: -250px; margin-top: -150px }
        .ts_borderline { border: 1px solid #E9E9E9; border-radius: 3px; }
        .ts_border { border: 7px solid #efefef; }
        .ts_b2 { background: #fff; border: 1px solid #E9E9E9; padding: 10px 20px 10px 20px; }
        .ts_div h2 { text-align: left; color: #666; border-bottom: 1px dotted #ccc; padding-bottom: 10px; font-size: 16px; }
        .ts_div p { line-height: 2; margin: 10px auto; font-size: 14px; text-align: left; padding: 10px 0 10px 45px; }
        .ts_div .success { background: url(<?php echo PT_DIR;?>/public/image/success.gif) no-repeat 0 center; }
        .ts_div .error { background: url(<?php echo PT_DIR;?>/public/image/error.gif) no-repeat 0 center; }
        .ts_tz { position: relative; top: 50%; left: 50%; margin-left: -250px; margin-top: 10px; text-align: right; width: 500px; color: #666; }
        .ts_tz a { color: #f30; }
        .ts_tz span { color: #ff0000; font-weight: bold; padding: 0 5px; }
    </style>
</head>
<body style = "background:#f7f7f7;">
<div class = "ts_div">
    <div class = "ts_borderline">
        <div class = "ts_border">
            <div class = "ts_b2">
                <h2><?php echo $msgname;?><?php echo $msgtitle;?>提示</h2>
                <p class = "<?php echo $msgtype;?>"><?php echo $message;?></p>
            </div>
        </div>
    </div>
    <?php if($waitsecond):?>
    <div class = "ts_tz"><span id = "second"><?php echo $waitsecond;?></span>秒后自动跳转，如果浏览器没有自动跳转，请 <a href = "javascript:redirect()" id = "jumourl">点击这里</a></div>
    <script type = "text/javascript">
        var time = parseInt("<?php echo $waitsecond;?>");
        function redirect() {
            var url = "<?php echo $jumpurl;?>";
            if (url == '#back#') {
                history.back(-1);
            } else if (url == '#close#') {
                window.close();
            } else {
                location.href = url;
            }
        }
        function change() {
            document.getElementById('second').innerHTML = --time;
            if (time == 0) {
                clearInterval(t);
                redirect();
            }
        }
        t = setInterval('change()', 1000);
    </script>
    <?php endif;?>
</div>
</body>
</html>