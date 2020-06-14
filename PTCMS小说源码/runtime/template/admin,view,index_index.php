<?php defined('PT_ROOT') || exit('Permission denied');?><!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8" />
    <title>管理中心 - <?php echo PRONAME;?></title>
    <link rel = "stylesheet" href = "<?php echo PT_DIR;?>/application/admin/view/css/admin.css" />
    <meta name = "viewport" content = "width=device-width" />
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
</head>
<body style = "overflow: scroll; overflow-y: hidden; overflow-x: hidden">
<div id = "pt-wrapper">
    <div id = "pt-header">
        <div class = "logo"></div>
        <div class = "menu">
            <?php if(is_array($menu) && (array()!=$menu)): $i=array(); $i['loop']=array_slice($menu,0,null,true); $i['total']=count($menu); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
            <a href = "#" class = "link"><?php echo $loop['name'];?></a>
            <?php endforeach; endif;?>
        </div>
        <div class = "login-info">
            <span>欢迎回来：<font color = "red"><?php echo $username;?></font></span>
            <a class = "box" title = "刷新主页面" href = "javascript:mainframe.location.reload();">刷新页面</a>
            <a class = "box" title = "查看站点页面" href = "<?php echo $this->pt->config->get("siteurl");?>" target = "_blank">查看站点</a>
            <a class = "box" title = "退出<?php echo PRONAME;?>" href = "<?php echo U("admin.public.logout",array());?>">退出登陆</a>
        </div>
    </div>
    <div id = "container">
        <div class = "pt-sidebar">
            <?php if(is_array($menu) && (array()!=$menu)): $i=array(); $i['loop']=array_slice($menu,0,null,true); $i['total']=count($menu); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $loop=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
            <ul class = 'pt-sidebar-menu'>
                <?php if(is_array($loop['sons']) && (array()!=$loop['sons'])): $i=array(); $i['loop']=array_slice($loop['sons'],0,null,true); $i['total']=count($loop['sons']); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $submenu=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
                <li>
                    <h3><i></i><?php echo $submenu['name'];?></h3>
                    <div class = "pt-sidebar-menu-info">
                        <?php if(is_array($submenu['sons']) && (array()!=$submenu['sons'])): $i=array(); $i['loop']=array_slice($submenu['sons'],0,null,true); $i['total']=count($submenu['sons']); $i['count']=count($i['loop']); $i['cols']=1; $i['add']=$i['count']%1?1-$i['count']%1:0; $i['order']=0; $i['row']=1;$i['col']=0;foreach(array_pad($i['loop'],$i['add'],array()) as $i['index']=>$i['list']): $submenulist=$i['list']; $i['order']++; $i['col']++; if($i['col']==1): $i['col']=0; $i['row']++; endif; $i['first']=$i['order']==1; $i['last']=$i['order']==$i['count']; $i['extra']=$i['order']>$i['count'];?>
                        <a href = "<?php echo $submenulist['url'];?>" target = "mainframe"><?php echo $submenulist['name'];?></a>
                        <?php endforeach; endif;?>
                    </div>
                </li>
                <?php endforeach; endif;?>
            </ul>
            <?php endforeach; endif;?>
        </div>
        <div class = "pt-main">
            <iframe id = "pt-mainframe" width = "100%" name = "mainframe" frameborder = "0" src = "" scrolling = "yes"></iframe>
        </div>
    </div>
</div>
<script type = "text/javascript" src = "<?php echo PT_DIR;?>/public/script/jquery.min.js"></script>
<script type = "text/javascript" src = "<?php echo PT_DIR;?>/application/admin/view/script/admin.js"></script>
<script type = "text/javascript">
    $(function () {
        $.admin.init();
    });
</script>
<div style = "display: none">
    <script language = "javascript" type = "text/javascript" src = "<?php echo PT_DIR;?>/application/admin/view/script/tongji.js"></script>
</div>
</body>
</html>