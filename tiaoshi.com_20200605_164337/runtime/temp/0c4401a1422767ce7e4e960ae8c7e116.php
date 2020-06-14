<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:66:"/www/wwwroot/tiaoshi.com/application/admin/view/comment/index.html";i:1552720680;s:64:"/www/wwwroot/tiaoshi.com/application/admin/view/public/head.html";i:1552720680;s:64:"/www/wwwroot/tiaoshi.com/application/admin/view/public/foot.html";i:1552720680;}*/ ?>
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
                <div class="layui-input-inline w100">
                    <select name="status">
                        <option value="">选择状态</option>
                        <option value="0" <?php if($param['status'] == '0'): ?>selected <?php endif; ?>>未审核</option>
                        <option value="1" <?php if($param['status'] == '1'): ?>selected <?php endif; ?>>已审核</option>
                    </select>
                </div>
                <div class="layui-input-inline w100">
                    <select name="mid">
                        <option value="">选择模块</option>
                        <option value="1" <?php if($param['mid'] == '1'): ?>selected <?php endif; ?>>视频</option>
                        <option value="2" <?php if($param['mid'] == '2'): ?>selected <?php endif; ?>>文章</option>
                        <option value="3" <?php if($param['mid'] == '3'): ?>selected <?php endif; ?>>专题</option>
                    </select>
                </div>
                <div class="layui-input-inline w100">
                    <select name="report">
                        <option value="">选择举报</option>
                        <option value="1" <?php if($param['report'] == '1'): ?>selected <?php endif; ?>>未举报</option>
                        <option value="2" <?php if($param['report'] == '2'): ?>selected <?php endif; ?>>有举报</option>
                    </select>
                </div>

                <div class="layui-input-inline">
                    <input type="text" autocomplete="off" placeholder="请输入搜索条件" class="layui-input" name="wd" value="<?php echo $param['wd']; ?>">
                </div>
                <button class="layui-btn mgl-20 j-search" >查询</button>
            </form>
        </div>

        <div class="layui-btn-group">
            <a data-href="<?php echo url('del'); ?>" class="layui-btn layui-btn-primary j-page-btns confirm"><i class="layui-icon">&#xe640;</i>删除</a>
            <a data-href="<?php echo url('index/select'); ?>?tab=comment&col=comment_status&tpl=select_status&url=comment/field" data-width="470" data-height="100" data-checkbox="1" class="layui-btn layui-btn-primary j-select"><i class="layui-icon">&#xe620;</i>状态</a>
            <a data-href="<?php echo url('del'); ?>?all=1" class="layui-btn layui-btn-primary j-ajax" confirm="确认清空数据吗？操作不可恢复"><i class="layui-icon">&#xe640;</i>清空</a>
        </div>
    </div>

    <form class="layui-form" method="post" id="pageListForm" >
        <table class="layui-table" lay-size="sm">
            <thead>
            <tr>
                <th width="25"><input type="checkbox" lay-skin="primary" lay-filter="allChoose"></th>
                <th width="60">编号</th>
                <th width="60">模块</th>
                <th width="60">状态</th>
                <th >评论内容</th>
                <th width="100">操作</th>
            </tr>
            </thead>

            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td><input type="checkbox" name="ids[]" value="<?php echo $vo['comment_id']; ?>" class="layui-checkbox checkbox-ids" lay-skin="primary"></td>
                <td><?php echo $vo['comment_id']; ?></td>
                <td><?php echo mac_get_mid_text($vo['comment_mid']); ?></td>
                <td><?php if($vo['comment_status'] == 0): ?><span class="layui-badge">未审核</span><?php else: ?><span class="layui-badge layui-bg-green">已审核</span><?php endif; ?></td>
                <td>
                    <div class="c-999 f-12">
                        <u style="cursor:pointer" class="text-primary"><?php echo $vo['comment_name']; ?>：</u>
                        <time>【<?php echo mac_day($vo['comment_time'],color); ?>】</time>
                        <span class="ml-20">ip：【<?php echo long2ip($vo['comment_ip']); ?>】</span>
                        <span class="ml-20">顶：【<?php echo $vo['comment_up']; ?>】</span>
                        <span class="ml-20">踩：【<?php echo $vo['comment_down']; ?>】</span>
                        <span class="ml-20">举报：【<?php echo $vo['comment_report']; ?>】</span>
                        <span class="ml-20">链接：
                            <?php if(!is_array($vo['data'])): ?>
                            【数据已删除】
                            <?php elseif($vo['comment_mid'] == 1): ?>
                            【<a target="_blank" href="<?php echo mac_url_vod_detail($vo['data']); ?>"><?php echo $vo['data']['vod_name']; ?></a>】</span>
                            <?php elseif($vo['comment_mid'] == 2): ?>
                            【<a target="_blank" href="<?php echo mac_url_art_detail($vo['data']); ?>"><?php echo $vo['data']['art_name']; ?></a>】</span>
                            <?php elseif($vo['comment_mid'] == 3): ?>
                            【<a target="_blank" href="<?php echo mac_url_topic_detail($vo['data']); ?>"><?php echo $vo['data']['topic_name']; ?></a>】</span>
                            <?php elseif($vo['comment_mid'] == 8): ?>
                            【<a target="_blank" href="<?php echo mac_url_actor_detail($vo['data']); ?>"><?php echo $vo['data']['actor_name']; ?></a>】</span>
                            <?php elseif($vo['comment_mid'] == 9): ?>
                            【<a target="_blank" href="<?php echo mac_url_role_detail($vo['data']); ?>"><?php echo $vo['data']['role_name']; ?></a>】</span>
                            <?php endif; ?>
                    </div>
                    <div class="f-12 c-999">
                        评论：<?php echo $vo['comment_content']; ?>
                    </div>
                </td>
                <td>
                    <a class="layui-badge-rim j-iframe" data-href="<?php echo url('info?id='.$vo['comment_id']); ?>" href="javascript:;" title="编辑">编辑</a>
                    <a class="layui-badge-rim j-tr-del" data-href="<?php echo url('del?ids='.$vo['comment_id']); ?>" href="javascript:;" title="删除">删除</a>
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
    var curUrl="<?php echo url('comment/data',$param); ?>";
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