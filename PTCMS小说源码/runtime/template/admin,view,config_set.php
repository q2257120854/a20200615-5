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
    <h4 class = "pt-msg-title"><b class = "f-fl"><?php echo $menuinfo['menu']['name'];?></b></h4>
    <div class = "pt-set-box">
        <form action = "<?php echo __SELF__;?>" method = "post" enctype = "multipart/form-data" class = "vform">
            <div class = "pt-tab">
                <div class = "pt-tab-nav">
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
                    <a href = "javascript:;" <?php if($i['first']):?>class = "current"<?php endif;?>><span><?php echo $loop['name'];?></span></a>
                    <?php endforeach; endif;?>
                </div>
                <div class = "pt-tab-content">
                    <?php if(is_array($list) && (array()!=$list)): $i=array(); $i['loop']=array_slice($list,0,null,true); $i['total']=count($list); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $l=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
                    <div class = "pt-tab-item">
                        <div class = "pt-set-content">
                            <?php if(is_array($l['list'])): foreach($l['list'] as $key =>$loop):?>
                            <div class = "pt-set-info">
                                <div class = "line">
                                    <b><?php echo $loop['title'];?>：</b>
                                    <?php if($loop['type']=='num' || $loop['type']=='text'):?>
                                    <label><input name = "<?php echo $loop['key'];?>" type = "text" value = "<?php echo $loop['value'];?>" class = "input-text w450"/></label>
                                    <?php elseif($loop['type']=='textarea'):?>
                                    <label><textarea name = "<?php echo $loop['key'];?>" class="input-box w450"><?php echo $loop['value'];?></textarea></label>
                                    <?php elseif($loop['type']=='radio' || $loop['type']=='checkbox'):?>
                                    <?php if(is_array($loop['list']) && (array()!=$loop['list'])): $i=array(); $i['loop']=array_slice($loop['list'],0,null,true); $i['total']=count($loop['list']); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $ll=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
                                    <label>
                                        <input name = "<?php echo $loop['key'];?>" type = "<?php echo $loop['type'];?>" value = "<?php echo $ll['value'];?>" <?php echo $ll['status'];?> /><?php echo $ll['title'];?>
                                    </label>
                                    <?php endforeach; endif;?>
                                    <?php elseif($loop['type']=='select'):?>
                                    <label>
                                        <select name = "<?php echo $loop['key'];?>" class="input-box w450">
                                            <?php if(is_array($loop['list']) && (array()!=$loop['list'])): $i=array(); $i['loop']=array_slice($loop['list'],0,null,true); $i['total']=count($loop['list']); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $ll=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
                                            <option value = "<?php echo $ll['value'];?>" <?php echo $ll['status'];?>><?php echo $ll['title'];?></option>
                                            <?php endforeach; endif;?>
                                        </select>
                                    </label>

                                    <?php else:?>
                                    该项为数组参数，无法直接设置
                                    <?php endif;?>
                                    <span class="Validform_checktip"><?php echo $loop['intro'];?></span>
                                </div>
                            </div>
                            <?php endforeach; endif;?>
                        </div>
                    </div>
                    <?php endforeach; endif;?>
                    <div class = "pt-tab-button">
                        <div class = "pt-set-info">
                            <div class = "line">
                                <b></b>
                                <input class = "btn btn-success" type = "submit" value = " 确定提交 " />&nbsp;&nbsp;&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
