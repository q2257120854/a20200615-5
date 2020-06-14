<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"/www/wwwroot/tiaoshi.com/application/admin/view/topic/index.html";i:1552720680;s:64:"/www/wwwroot/tiaoshi.com/application/admin/view/public/head.html";i:1552720680;s:64:"/www/wwwroot/tiaoshi.com/application/admin/view/public/foot.html";i:1552720680;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $title; ?> - 苹果CMS</title>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/css/admin_style.css">
    <script type="text/javascript" src="/static/js/jquery.js"></script>
    <script type="text/javascript" src="/static/layui/layui.js"></script>
    <script>
        var ROOT_PATH="",ADMIN_PATH="<?php echo $_SERVER['SCRIPT_NAME']; ?>", MAC_VERSION='v10';
    </script>
</head>
<body>
<div class="page-container p10">

    <div class="my-toolbar-box" >

        <div class="center mb10">
            <form class="layui-form " method="post">
                <div class="layui-input-inline w150">
                    <select name="status">
                        <option value="">选择状态</option>
                        <option value="0" <?php if($param['status'] == '0'): ?>selected <?php endif; ?>>未审核</option>
                        <option value="1" <?php if($param['status'] == '1'): ?>selected <?php endif; ?>>已审核</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <input type="text" autocomplete="off" placeholder="请输入搜索条件" class="layui-input" name="wd" value="<?php echo $param['wd']; ?>">
                </div>
                <button class="layui-btn mgl-20 j-search" >查询</button>
            </form>
        </div>
        <div class="layui-btn-group">
            <a data-full="1" data-href="<?php echo url('info'); ?>" class="layui-btn layui-btn-primary j-iframe"><i class="layui-icon">&#xe654;</i>添加</a>
            <a data-href="<?php echo url('del'); ?>" class="layui-btn layui-btn-primary j-page-btns confirm"><i class="layui-icon">&#xe640;</i>删除</a>
            <a data-href="<?php echo url('index/select'); ?>?tab=topic&col=topic_level&tpl=select_level&url=topic/field" data-width="270" data-height="100" data-checkbox="1" class="layui-btn layui-btn-primary j-select"><i class="layui-icon">&#xe620;</i>推荐</a>
            <a data-href="<?php echo url('index/select'); ?>?tab=topic&col=topic_status&tpl=select_status&url=topic/field" data-width="470" data-height="100" data-checkbox="1" class="layui-btn layui-btn-primary j-select"><i class="layui-icon">&#xe620;</i>状态</a>
            <a class="layui-btn layui-btn-primary j-iframe" data-href="<?php echo url('images/opt?tab=topic'); ?>" href="javascript:;" title="同步远程图片"><i class="layui-icon">&#xe620;</i>同步图片</a>
        </div>
    </div>

    <form class="layui-form" method="post" id="pageListForm" >
        <table class="layui-table" lay-size="sm">
            <thead>
            <tr>
                <th width="25"><input type="checkbox" lay-skin="primary" lay-filter="allChoose"></th>
                <th width="100">编号</th>
                <th >名称</th>
                <th width="30">人气</th>
                <th width="30">评分</th>
                <th width="30">推荐</th>
                <th width="30">浏览</th>
                <th width="150">更新时间</th>
                <th width="100">操作</th>
            </tr>
            </thead>

            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td><input type="checkbox" name="ids[]" value="<?php echo $vo['topic_id']; ?>" class="layui-checkbox checkbox-ids" lay-skin="primary"></td>
                <td><?php echo $vo['topic_id']; ?></td>
                <td><a target="_blank" class="layui-badge-rim " href="<?php echo mac_url_topic_detail($vo); ?>"><?php echo $vo['topic_name']; ?></a> <?php if($vo['topic_status'] == 0): ?> <span class="layui-badge">未审</span><?php endif; ?> </td>
                <td><?php echo $vo['topic_hits']; ?></td>
                <td><?php echo $vo['topic_score']; ?></td>
                <td><a data-href="<?php echo url('index/select'); ?>?tab=topic&col=topic_level&tpl=select_level&url=topic/field&ids=<?php echo $vo['topic_id']; ?>" data-width="270" data-height="100" class=" j-select"><span class="layui-badge layui-bg-orange"><?php echo $vo['topic_level']; ?></span></a></td>
                <td><?php if($vo['ismake'] == 1): ?><a target="_blank" class="layui-badge layui-bg-green " href="<?php echo mac_url_topic_detail($vo); ?>">Y</a><?php else: ?><a class="layui-badge" href="<?php echo url('make/make?ac=topic_info'); ?>?topic=<?php echo $vo['topic_id']; ?>&ref=1">N</a><?php endif; ?></td>
                <td><?php echo mac_day($vo['topic_time'],color); ?></td>
                <td>
                    <a class="layui-badge-rim j-iframe" data-full="1" data-href="<?php echo url('info?id='.$vo['topic_id']); ?>" href="javascript:;" title="编辑">编辑</a>
                    <a class="layui-badge-rim j-tr-del" data-href="<?php echo url('del?ids='.$vo['topic_id']); ?>" href="javascript:;" title="删除">删除</a>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div id="pages" class="center"></div>
    </form>
</div>

<script type="text/javascript" src="/static/js/admin_common.js"></script>

<script type="text/javascript">
    var curUrl="<?php echo url('topic/data',$param); ?>";
    layui.use(['laypage', 'layer','form'], function() {
        var laypage = layui.laypage
                , layer = layui.layer,
                form = layui.form;

        laypage.render({
            elem: 'pages'
            ,count: <?php echo $total; ?>
            ,limit: <?php echo $limit; ?>
            ,curr: <?php echo $page; ?>
            ,layout: ['count', 'prev', 'page', 'next', 'limit', 'skip']
            ,jump: function(obj,first){
                if(!first){
                    location.href = curUrl.replace('%7Bpage%7D',obj.curr).replace('%7Blimit%7D',obj.limit);
                }
            }
        });


    });
</script>
</body>
</html>