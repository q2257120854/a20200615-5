<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"/www/wwwroot/tiaoshi.com/application/admin/view/order/index.html";i:1566582597;s:64:"/www/wwwroot/tiaoshi.com/application/admin/view/public/head.html";i:1552720680;s:64:"/www/wwwroot/tiaoshi.com/application/admin/view/public/foot.html";i:1552720680;}*/ ?>
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
            <form class="layui-form " method="post" id="searchForm">
                <div class="layui-input-inline w150">
                    <select name="status">
                        <option value="">选择订单状态</option>
                        <option value="0" <?php if($param['status'] == '0'): ?>selected <?php endif; ?>>未支付</option>
                        <option value="1" <?php if($param['status'] == '1'): ?>selected <?php endif; ?>>已支付</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <input type="text" autocomplete="off" placeholder="请输入搜索条件" class="layui-input" name="wd" value="<?php echo $param['wd']; ?>">
                </div>
                <button class="layui-btn mgl-20 j-search" >查询</button>
                <button class="layui-btn mgl-20" type="button" id="btnExport">导出</button>
            </form>
        </div>

        <div class="layui-btn-group">
            <a data-href="<?php echo url('del'); ?>" class="layui-btn layui-btn-primary j-page-btns confirm"><i class="layui-icon">&#xe640;</i>删除</a>
            <a data-href="<?php echo url('del'); ?>?ids=1&all=1" class="layui-btn layui-btn-primary j-ajax" confirm="确认清空数据吗？操作不可恢复"><i class="layui-icon">&#xe640;</i>清空</a>
        </div>

    </div>

     <form class="layui-form " method="post" id="pageListForm">
         <table class="layui-table" lay-size="sm">
            <thead>
            <tr>
                <th width="25"><input type="checkbox" lay-skin="primary" lay-filter="allChoose"></th>
                <th width="50">编号</th>
                <th width="100">单号</th>
                <th width="80">订单金额</th>
                <th width="80">订单状态</th>
                <th width="130">下单时间</th>
                <th width="100">支付类型</th>
                <th width="130">支付时间</th>
                <th>用户id</th>
                <th>用户名</th>
                <th>代理id</th>
                <th>代理用户名</th>
                <th width="50">操作</th>
            </tr>
            </thead>

            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td><input type="checkbox" name="ids[]" value="<?php echo $vo['order_id']; ?>" class="layui-checkbox checkbox-ids" lay-skin="primary"></td>
                <td><?php echo $vo['order_id']; ?></td>
                <td><?php echo $vo['order_code']; ?></td>
                <td><?php echo $vo['order_price']; ?></td>
                <td><?php echo mac_get_order_status_text($vo['order_status']); ?></td>
                <td><?php echo mac_day($vo['order_time'],color); ?></td>
                <td><?php echo $vo['order_pay_type']; ?></td>
                <td><?php echo mac_day($vo['order_pay_time'],color); ?></td>
                <td><?php echo $vo['user_id']; ?></td>
                <td><?php echo $vo['user_name']; ?></td>
                <td><?php echo $vo['fid']; ?></td>
                <td><?php echo $vo['fuser']; ?></td>
                <td>
                    <a class="layui-badge-rim j-tr-del" data-href="<?php echo url('del?ids='.$vo['order_id']); ?>" href="javascript:;" title="删除">删除</a>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>

        <div id="pages" class="center"></div>

    </form>
    <iframe id="if" width="0" height="0"></iframe>

</div>

<script type="text/javascript" src="/static/js/admin_common.js"></script>


<script type="text/javascript">
    var curUrl="<?php echo url('order/index',$param); ?>";
    layui.use(['laypage', 'layer'], function() {
        var laypage = layui.laypage
                , layer = layui.layer;

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
        $('#btnExport').click(function(){
            var par = $('#searchForm').serialize() + '&export=1';

            $('#if').attr('src',"<?php echo url('order/index'); ?>?" + par);
        });
    });
</script>
</body>
</html>