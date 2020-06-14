<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"/www/wwwroot/tiaoshi.com/application/admin/view/extend/pay/zhapay.html";i:1552720680;s:70:"/www/wwwroot/tiaoshi.com/application/admin/view/extend/pay/weipay.html";i:1590799321;}*/ ?>
<div class="layui-tab-item">

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>weipay支付设置</legend>
    </fieldset>

    <div class="layui-form-item">
        <label class="layui-form-label">weipay支付开关：</label>
        <div class="layui-input-inline w400">
            <input type="radio" name="pay[weipay][kaiguan]" value="1" title="开" <?php if($config['pay']['weipay']['kaiguan'] == 1): ?>checked<?php endif; ?>>
            <input type="radio" name="pay[weipay][kaiguan]" value="0" title="关" <?php if($config['pay']['weipay']['kaiguan'] == 0): ?>checked<?php endif; ?>>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">支付商家编号：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[weipay][appid]" placeholder="" value="<?php echo $config['pay']['weipay']['appid']; ?>"
                class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">支付商家密钥：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[weipay][appkey]" placeholder="" value="<?php echo $config['pay']['weipay']['appkey']; ?>"
                class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">网关提交地址：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[weipay][url]" placeholder="" value="<?php echo $config['pay']['weipay']['url']; ?>"
                class="layui-input">
        </div>

    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">支付编号：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[weipay][tongdao]" placeholder="" value="<?php echo $config['pay']['weipay']['tongdao']; ?>"
                class="layui-input">
        </div>

    </div>
</div>