<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"/www/wwwroot/tiaoshi.com/application/admin/view/system/configpay.html";i:1563297075;s:64:"/www/wwwroot/tiaoshi.com/application/admin/view/public/head.html";i:1552720680;s:64:"/www/wwwroot/tiaoshi.com/application/admin/view/public/foot.html";i:1552720680;}*/ ?>
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

<div class="page-container">
    <form class="layui-form layui-form-pane" action="">
        <div class="layui-tab">
            <ul class="layui-tab-title">
                <li class="layui-this">在线支付设置</li>
                <li class="">卡密</li>
                <?php if(is_array($ext_list) || $ext_list instanceof \think\Collection || $ext_list instanceof \think\Paginator): $i = 0; $__LIST__ = $ext_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li class="" data-key="<?php echo $key; ?>"><?php echo $vo; ?></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                
            </ul>
            <div class="layui-tab-content">

                <div class="layui-tab-item layui-show">

                    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                        <legend>支付设置</legend>
                    </fieldset>

                    <div class="layui-form-item">
                        <label class="layui-form-label">回调通知地址：</label>
                        <div class="layui-input-inline w400">
                            <input type="text" readonly="readonly" value="<?php echo $http_type; ?><?php echo $config['site']['site_url']; ?>/index.php/payment/notify.html" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">支付接口通知回调地址</div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">最小充值金额：</label>
                        <div class="layui-input-inline w400">
                            <input type="text" name="pay[min]" placeholder="单位RMB元，最低1元" value="<?php echo $config['pay']['min']; ?>" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">最小充值金额</div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">兑换比例：</label>
                        <div class="layui-input-inline w400">
                            <input type="text" name="pay[scale]" placeholder="1元RMB兑换多少个积分" value="<?php echo $config['pay']['scale']; ?>" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">1元人民币等于多少积分</div>
                    </div>
                </div>

                <div class="layui-tab-item ">

                    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                        <legend>卡密设置</legend>
                    </fieldset>

                    <div class="layui-form-item">
                        <label class="layui-form-label">销售网址：</label>
                        <div class="layui-input-inline w400">
                            <input type="text" name="pay[card][url]" placeholder="" value="<?php echo $config['pay']['card']['url']; ?>" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">第三方卡密平台</div>
                    </div>
                </div>

                <?php echo $ext_html; ?>

            </div>
        </div>
        <div class="layui-form-item center">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="formSubmit">保 存</button>
                <button class="layui-btn layui-btn-warm" type="reset">还 原</button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript" src="/static/js/admin_common.js"></script>
<script type="text/javascript">
    $(function(){

    });
</script>

</body>
</html>