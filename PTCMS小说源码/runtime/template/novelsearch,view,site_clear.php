<?php defined('PT_ROOT') || exit('Permission denied');?><!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8" />
    <title>管理中心 - <?php echo PRONAME;?></title>
    <link rel = "stylesheet" href = "<?php echo PT_DIR;?>/application/admin/view/css/admin.css" />
    <meta name = "keywords" content = "" />
    <meta name = "description" content = "" />
    <meta name = "viewport" content = "width=device-width" />
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <script type = "text/javascript" src = "<?php echo PT_DIR;?>/public/script/jquery.min.js"></script>
    <script type = "text/javascript" src = "<?php echo PT_DIR;?>/application/admin/view/script/admin.js"></script>
    <script type = "text/javascript" src = "<?php echo PT_DIR;?>/public/plugin/layer/layer.js"></script>
    <script type = "text/javascript" src = "<?php echo PT_DIR;?>/public/script/jquery.validform.js"></script>
    <script type = "text/javascript">
        var URL = '<?php echo  __URL__;?>', APP = '<?php echo __APP__;?>', MODULE = '<?php echo __MODULE__;?>', SELF = '<?php echo __SELF__;?>', MODULE_NAME = '<?php echo MODULE_NAME;?>', CONTROLLER_NAME = '<?php echo CONTROLLER_NAME;?>', ACTION_NAME = '<?php echo ACTION_NAME;?>';
    </script>
</head>
<body>
<div class = "pt-main-wrap">
    <div class = "pt-path">
        <span class = "pt-path-icon icon-home"></span>当前位置：
        <a href="http://www.360xiankan.com" target="_blank"><?php echo PRONAME;?></a>
        <span> &gt; </span><a href="<?php echo $menuinfo['menu']['url'];?>"><?php echo $menuinfo['menu']['name'];?></a>
        <?php if(isset($menuinfo['submenu']['name'])):?>
        <span> &gt; </span><?php echo $menuinfo['submenu']['name'];?>
        <?php endif;?>
    </div>
    <div class="pt-set-wrap">
    <h4 class="pt-msg-title"><b class="f-fl">清空站点</b></h4>
    <div class="pt-set-box">
        <form action="<?php echo __SELF__;?>" method="post" enctype="multipart/form-data" class="vform">
            <div class="pt-set-content">
                <div class="pt-set-info rule">
                    <div class="line">
                        <b>站点选择：</b>
                        <label>
                            <select class="input-box w450" name="siteid">
                                <?php if(is_array($sitelist)): foreach($sitelist as $key =>$loop):?>
                                <option value="<?php echo $loop['id'];?>"><?php echo $loop['name'];?></option>
                                <?php endforeach; endif;?>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="pt-set-info rule rule1">
                    <div class="line"><b>规则配置：</b>
                        <div class="pt-set-area">
                            <label><input type="checkbox" name="log"  value="1"/>清空采集日志(已采章节不会再次入库)</label>
                            <label><input type="checkbox" name="all"  value="1"/>清空所有章节</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-tab-button">
                <div class="pt-set-info">
                    <div class="line">
                        <b></b>
                        <input class="btn btn-success" type="submit" value=" 开始处理 " />&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<link media="all" rel="stylesheet" type="text/css" href="/public/plugin/simditor/styles/font-awesome.css" />
<link media="all" rel="stylesheet" type="text/css" href="/public/plugin/simditor/styles/simditor.css" />
<link media="all" rel="stylesheet" type="text/css" href="/public/plugin/simditor/styles/simditor-emoji.css" />
<script type="text/javascript" src="/public/plugin/simditor/scripts/module.min.js"></script>
<script type="text/javascript" src="/public/plugin/simditor/scripts/simditor.min.js"></script>
<script type="text/javascript" src="/public/plugin/simditor/scripts/uploader.min.js"></script>
<script type="text/javascript" src="/public/plugin/simditor/scripts/simditor-emoji.js"></script>
<script type="text/javascript" src="/public/plugin/simditor/scripts/simditor-markdown.js"></script>
<script type="text/javascript">
    var editor;
    $(function () {
        if($('.simditoreditor').length>0){
            editor = new Simditor({
                textarea: $('.simditoreditor'),
                toolbar: ['emoji', 'title', 'bold', 'italic', 'underline', 'strikethrough', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image'],
                pasteImage: true,
                defaultImage: '/public/image/144.png',
                emoji: {imagePath: '/public/image/emoji/'},
                markdown: true,
                upload: {
                    url: '<?php echo  __URL__;?>/uploadone'
                }
            });
        }
        $('button.uploadfile').on('click',function(){
            $(this).siblings('input[type=file]').val('').trigger('click');
        });
        $('input[type=file].uploadfile').on('change', function(e) {
            var t=$(this).siblings('input[type=text]');
            var uploader = simple.uploader({
                url: '<?php echo  __URL__;?>/uploadone'
            });
            uploader.upload($(this));
            uploader.on('uploadsuccess', function(e, file, res) {
                if (res.success==true){
                    $(t).val(res.file_path);
                }else{
                    alert(res.msg);
                }
                uploader.destroy()
            });
        });
    });
</script>
<style rel="stylesheet" type="text/css">
    .simditor .simditor-body b { width: auto !important; }
    .simditor .simditor-body{padding:10px 10px 40px !important;}
</style>


    <div class = "f-clear"></div>
</div>
<div class="footinfo"><?php echo $this->pt->response->runinfo();?></div>
<div style = "display: none">
    <script language = "javascript" type = "text/javascript" src = "<?php echo PT_DIR;?>/application/admin/view/script/tongji.js"></script>
</div>
<script type = "text/javascript">
    $(function(){
        //设置高度
        var h1=$(document).height(),h2=$('.pt-main-wrap').height();
        if (h2+60<h1){
            $('.pt-main-wrap').height(h1-60)
        }
    })
</script>
</body>
</html>
