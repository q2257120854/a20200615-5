<?php
$down_url = base64_decode($_GET['url']);
$sitename = $_GET['name'];
?>
<!doctype html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<title>页面跳转...爱友小说网</title>
<script>
function gotopage(){
		location.href = "<?php echo $down_url;?>";
}
window.setTimeout("gotopage()",3000); 
</script>
<meta name="viewport"content="width=device-width, initial-scale=1"/>
<link rel="stylesheet" href="/down/pcdown.css" media="screen and (min-width:501px)" />
<link rel="stylesheet" href="/down/wapdown.css" media="screen and (max-width:500px)" />
</head>
<body>
<div class="wrapper">
    <div class="content mt20">
            <div class="okremind mb10">
                <h3><b>提醒：</b></h3>
                <b>爱友小说网</b>不存储任何小说内容，正跳转至<b><?php echo $sitename;?></b>下载本书<br/>书籍正在打包中......请稍后。<br/>
                <p>页面将在<em class="red">5s</em>后自动跳转；</p>
                <p>若没有自动跳转，<a href="<?php echo $down_url;?>">点击立即跳转...</a></p>
            </div>
    </div>
    <div style="display:none;"></div>
</div>
</body>
</html>