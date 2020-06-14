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
    <div class = "pt-table-wrap" ng-app = "ptcms">
    <h4 class = "pt-msg-title"><b class = "f-fl"><?php echo $menuinfo['menu']['name'];?></b></h4>
    <div class = "pt-list" ng-controller = "showlist">
        <form method = "post" action = "<?php echo __SELF__;?>" id="showtable">
            <table class = "pt-list-table" style="width:600px">
                <thead>
                <tr>
                    <th style = "width:50px">站点ID</th>
                    <th style = "width:150px">站点名称</th>
                    <th class = "w-word4">入库书数量</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list)): foreach($list as $key =>$loop):?>
                <tr>
                    <td><?php echo $loop['siteid'];?></td>
                    <td><?php echo $loop['sitename'];?></td>
                    <td><?php echo $loop['num'];?></td>
                </tr>
                <?php endforeach; endif;?>
                </tbody>
            </table>
            <div class = "pt-list-footer">
                <div class = "pt-list-operate f-fl"></div>
                <div class = "f-clear"></div>
            </div>
        </form>
    </div>
</div>
<script type = "text/javascript" src = "<?php echo PT_DIR;?>/public/plugin/datepicker/WdatePicker.js"></script>
<script type="text/javascript">
    $(function(){
        $('input.date').on('click', function () {
            WdatePicker({skin: 'ext', dateFmt: 'yyyyMMdd', el: this})
        });
    })
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
