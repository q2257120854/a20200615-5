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
    <h4 class = "pt-msg-title"><b class = "f-fl">模版列表</b></h4>
    <div class = "pt-set-box">
        <div class = "pt-list">
            <div class = "pt-list-title">
                <p class = "f-fl tips">
                    当前共有<b class = "c-red"> <?php echo count($list);?> </b>个模版
                </p>
            </div>
            <div class = "f-clear"></div>
            <table class = "pt-list-table">
                <thead>
                <tr>
                    <th style = "width:160px">模版预览</th>
                    <th class = "f-tal">模版信息</th>
                    <th class = "w-word3">版本</th>
                    <th class = "w-word4">类型</th>
                    <th class = "w-word4">PC风格</th>
                    <th class = "w-word4">手机风格</th>
                    <th class = "w-word4">mip风格</th>
                    <th class = "operate w-operate3">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list)): foreach($list as $key =>$loop):?>
                <tr>
                    <td><img src = "<?php echo $loop['demo'];?>" width = "160" height = "120"></td>
                    <td class = "f-tal" style = "vertical-align: top">
                        <b><?php echo $loop['name'];?></b><br />
                        作者：<?php echo $loop['author'];?><br />
                        邮箱：<?php echo $loop['email'];?><br />
                        网址：<?php echo $loop['url'];?><br />
                        简介：<?php echo $loop['description'];?><br />
                    </td>
                    <td><?php echo $loop['version'];?></td>
                    <td><?php echo $loop['typename'];?></td>
                    <td><?php if($config['tpl_theme']==$key):?><span class = "label label-success"><i class = "icon icon-ok-circle"></i> 默认</span><?php endif;?></td>
                    <td><?php if($config['wap_theme']==$key):?><span class = "label label-success"><i class = "icon icon-ok-circle"></i> 默认</span><?php endif;?></td>
                    <td><?php if($config['mip_theme']==$key):?><span class = "label label-success"><i class = "icon icon-ok-circle"></i> 默认</span><?php endif;?></td>
                    <td class = "operate">
                        <a href = "<?php echo U($urlkey,array( 't'=>$key, '_force'=>1));?>" target = "_blank"><i class = "icon icon-search"></i>预览</a>
                        <a href = "<?php echo U("admin.theme.set",array('tpl'=>$key));?>"><i class = "icon icon-floppy-saved"></i>使用</a>
                        <a href = "<?php echo U("admin.theme.config",array('tpl'=>$key));?>"><i class = "icon icon-edit"></i>参数</a>
                    </td>
                </tr>
                <?php endforeach; endif;?>
                </tbody>
            </table>
            <div class = "clear"></div>
        </div>
    </div>
</div>
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
