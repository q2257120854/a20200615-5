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
    <div class = "pt-set-wrap">
    <h4 class = "pt-msg-title"><b class = "f-fl">广告预览</b></h4>
    <div style="border:1px dashed #ccc;height:auto;;margin:20px 0;padding:20px;">
        <script type="text/javascript" src="<?php echo PT_DIR;?>/public/<?php echo $this->pt->config->get("addir");?>/<?php echo $info['key'];?>.js"></script>
    </div>
    <h4 class = "pt-msg-title"><b class = "f-fl">广告信息</b></h4>
    <div class = "pt-set-box">
        <div class = "pt-set-content">
            <div class = "pt-set-info">
                <div class = "auth">
                    <b>广告名称：</b>
                    <?php echo $info['name'];?>
                </div>
            </div>
            <div class = "pt-set-info">
                <div class = "auth">
                    <b>广告描述：</b>
                    <?php echo $info['intro'];?>
                </div>
            </div>
            <div class = "pt-set-info">
                <div class = "auth">
                    <b>广告尺寸：</b>
                    <?php echo $info['width'];?>*<?php echo $info['height'];?>
                </div>
            </div>
            <div class = "pt-set-info">
                <div class = "auth"><b>模版语法：</b>
                    <input name = "tplcode" type = "text" value = "{$pt.getad.<?php echo $info['key'];?>}" class = "input-text" style = "width:500px" />
                </div>
            </div>
            <div class = "pt-set-info">
                <div class = "auth"><b>Js直接调用：</b>
                    <input name = "jscode" type = "text" value = '<script type="text/javascript" src="<?php echo PT_DIR;?>/public/<?php echo $this->pt->config->get("addir");?>/<?php echo $info['key'];?>.js"></script>' class = "input-text" style = "width:500px" />
                </div>
            </div>
            <div class = "pt-set-info">
                <div class = "auth">
                    <b></b>
                    <span class = "btn btn-primary copybtn tplcode">复制模版标签</span>
                    <span class = "btn btn-primary copybtn jscode">复制JS语句</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script type = "text/javascript" src = "<?php echo PT_DIR;?>/public/plugin/zclip/zclip.min.js"></script>
<script type = "text/javascript">
    $('.copybtn').zclip({
        'path': '<?php echo PT_DIR;?>/public/plugin/zclip/zclip.swf',
        'afterCopy': function () {
            alert('复制成功');
        },
        'copy': function () {
            console.log($(this).is('.tplcode'));
            if ($(this).is('.tplcode')) {
                return $('input[name=tplcode]').val();
            } else {
                return $('input[name=jscode]').val();
            }
        }
    });
</script>
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
