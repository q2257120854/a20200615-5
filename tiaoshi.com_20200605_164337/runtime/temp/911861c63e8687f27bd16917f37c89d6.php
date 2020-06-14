<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"/www/wwwroot/tiaoshi.com/application/admin/view/extend/pay/dby.html";i:1563295921;}*/ ?>
<div class="layui-tab-item">

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>蛋白云支付设置</legend>
    </fieldset>

    <div class="layui-form-item">
        <label class="layui-form-label">支付商家编号：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[dby][appid]" placeholder="" value="<?php echo $config['pay']['dby']['appid']; ?>" class="layui-input">
        </div>
    </div>
</div>