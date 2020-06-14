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
    <div class="alert alert-warning alert-dismissable" style="margin-bottom:20px;">
        <p>
            暂时未对批量操作做优化,如果选择小说太多会造成程序崩溃,谨慎使用!
        </p>
    </div>
    <form action="<?php echo __SELF__;?>" method="post" enctype="multipart/form-data" class="vform">
        <h4 class="pt-msg-title"><b class="f-fl">信息更新</b></h4>
        <div class="pt-set-box">
            <div class="pt-set-content">
                <div class="pt-set-info">
                    <div class="line"><b>选择小说：</b>
                        <label>
                            <input name="type" type="radio" value="0" checked />单本书
                        </label>
                        <label>
                            <input name="type" type="radio" value="1"  />自由书号
                        </label>
                        <label>
                            <input name="type" type="radio" value="2"  />连续书号
                        </label>
                        <label>
                            <input name="type" type="radio" value='3' />更新时间
                        </label>
                        <label>
                            <input name="type" type="radio" value='4' />入库时间
                        </label>
                    </div>
                </div>
                <div class="pt-set-info type type0">
                    <div class="line">
                        <b>指定书号：</b>
                        <label><input name="novelid" type="text" value="" class="input-text w450" placeholder="请输入起始书号，不填写为不限制" /></label>
                    </div>
                </div>
                <div class="pt-set-info type type1">
                    <div class="line">
                        <b>书号列表：</b>
                        <label>
                            <textarea name="novelids" class="input-box w450"></textarea>
                        </label>
                        <span class="Validform_checktip">"|"分隔</span>
                    </div>
                </div>
                <div class="pt-set-info type type2">
                    <div class="line">
                        <b>起始书号：</b>
                        <label><input name="startid" type="text" value="" class="input-text w450" placeholder="请输入起始书号，不填写为不限制" /></label>
                    </div>
                </div>
                <div class="pt-set-info type type2">
                    <div class="line">
                        <b>截止书号：</b>
                        <label><input name="endid" type="text" value="" class="input-text w450" placeholder="请输入截止书号，不填写为不限制" /></label>
                    </div>
                </div>
                <div class="pt-set-info type type3">
                    <div class="line">
                        <b>更新起始时间：</b>
                        <label><input name="startupdatetime" type="text" value="" class="input-text w450 datetime" placeholder="不选为不限制，建议选择" /></label>
                    </div>
                </div>
                <div class="pt-set-info type type3">
                    <div class="line">
                        <b>更新截止时间：</b>
                        <label><input name="endupdatetime" type="text" value="" class="input-text w450 datetime" placeholder="不选为不限制，建议选择" /></label>
                    </div>
                </div>
                <div class="pt-set-info type type4">
                    <div class="line">
                        <b>入库起始时间：</b>
                        <label><input name="startposttime" type="text" value="" class="input-text w450 datetime" placeholder="不选为不限制，建议选择" /></label>
                    </div>
                </div>
                <div class="pt-set-info type type4">
                    <div class="line">
                        <b>入库截止时间：</b>
                        <label><input name="endposttime" type="text" value="" class="input-text w450 datetime" placeholder="不选为不限制，建议选择" /></label>
                    </div>
                </div>
                <div class="pt-set-info">
                    <div class="line">
                        <b>限制条件：</b>
                        <div class="pt-set-area">
                            <label><input type="checkbox" name="emptyintro" />简介为空</label>
                            <label><input type="checkbox" name="emptycover" />封面为空</label>
                        </div>
                    </div>
                </div>
                <div class="pt-set-info">
                    <div class="line">
                        <b>使用规则：</b>
                        <label>
                            <select class="input-box w450" name="ruleid">
                                <?php if(is_array($rulelist)): foreach($rulelist as $key =>$loop):?>
                                <option value="<?php echo $loop['id'];?>"><?php echo $loop['name'];?></option>
                                <?php endforeach; endif;?>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="pt-set-info">
                    <div class="line"><b>更新内容：</b>
                        <div class="pt-set-area">
                            <label><input type="checkbox" name="updateintro" />简介</label>
                            <label><input type="checkbox" name="updatecover" />封面</label>
                            <label><input type="checkbox" name="updatecategory" />分类</label>
                            <label><input type="checkbox" name="updateisover" />进度</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-tab-button">
                <div class="pt-set-info">
                    <div class="line">
                        <b></b>
                        <input class="btn btn-success" type="submit" value=" 立即执行 " />&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?php echo PT_DIR;?>/public/plugin/datepicker/WdatePicker.js"></script>
<script type="text/javascript">
    $(function () {
        $('.type').hide();
        $('.type0').show();
        $('input[type=radio]').change(function () {
            $('.type').hide();
            $('.type' + $(this).val()).show()
        })
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
