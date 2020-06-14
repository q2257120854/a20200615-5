<?php defined('PT_ROOT') || exit('Permission denied');?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $msgtitle;?>提示</title>
<meta name="keywords" content="<?php echo $msgtitle;?>提示" />
<meta name="description" content="<?php echo $msgtitle;?>提示" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0">
<meta name="format-detection" content="telephone=no,email=no,address=no">
<meta name="applicable-device" content="pc,mobile">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="stylesheet" type="text/css" href="<?php echo $this->pt->config->get("resurl");?><?php echo __TMPL__;?>/v<?php echo $this->pt->config->get("tplconfig.demo");?>/css/message.css">
<script type="text/javascript" src="<?php echo $this->pt->config->get("resurl");?><?php echo __TMPL__;?>/js/layui.js"></script>
</head>
<body>
<div class="shadow"></div>
<div class="layout <?php if($msgtitle == 成功):?>success<?php else:?>error<?php endif;?> layui-anim layui-anim-scaleSpring">
	<ul><li></li><li></li></ul>
	<p><?php echo $message;?></p>
	<?php if($waitsecond):?>
	<a id="jump" href="javascript:redirect()">点击跳转</a>
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
<script>
layui.use(['jquery'], function(){
	var $ = layui.jquery;
	var url = $('#jump').attr('href');
	var time = 3;
	$('#jump').html('跳转 (<b>'+time+'</b>)');
	if (url === '') $('#jump').attr('href', '/');
	var t = setInterval(function(){
		$('#jump').html('跳转 (<b>'+(--time)+'</b>)');
		if(time < 0){
			clearInterval(t);
			$('#jump').html('点击跳转');
			if (url === '') {
				$('#jump').attr('href', '/');
				window.history.back();
			} else {
				$(location).attr('href', url);
			}
		}
	}, 1000);
});
</script>
</body>
</html>