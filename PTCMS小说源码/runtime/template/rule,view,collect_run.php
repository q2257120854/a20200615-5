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
    <h4 class="pt-msg-title"><b class="f-fl">单页采集</b></h4>
    <div class="pt-set-box">
        <form action="<?php echo __SELF__;?>" method="post" enctype="multipart/form-data" class="vform">
            <div class="pt-set-content">
                <div class="pt-set-info">
                    <div class="line">
                        <b>选用规则：</b>
                        <label>
                            <select class="input-box w450" name="id">
                                <option value="">请选择规则</option>
                                <?php if(is_array($list)): foreach($list as $key =>$loop):?>
                                <option value="<?php echo $loop['id'];?>" <?php if($id==$loop['id']):?>selected<?php endif;?>><?php echo $loop['name'];?></option>
                                <?php endforeach; endif;?>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="pt-set-info">
                    <div class="line">
                        <b>采集间隔时间：</b>
                        <label><input name="interval" type="text" value="30" class="input-text w450" datatype="*" /></label>
                        <span class="Validform_checktip">单位秒，0只运行一次，大于0为循环运行</span>
                    </div>
                </div>
                <div class="pt-set-info">
                    <div class="line"><b>采集形式：</b>
                        <label>
                            <input name="status" type="radio" value='0' checked/>直接采集(需保持浏览器打开状态)
                        </label>
                        <label>
                            <input name="status" type="radio" value="1" />加入后台计划任务（后台运行）
                        </label>
                    </div>
                </div>
            </div>
            <div class="pt-tab-button">
                <div class="pt-set-info">
                    <div class="line">
                        <b></b>
                        <input class="btn btn-success" type="submit" value=" 添加采集 " />&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="<?php echo PT_DIR;?>/public/plugin/datepicker/WdatePicker.js"></script>
<script type="text/javascript">
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
