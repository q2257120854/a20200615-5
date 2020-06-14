<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"/www/wwwroot/tiaoshi.com/application/admin/view/extend/pay/yiqianpay.html";i:1566534838;}*/ ?>
<div class="layui-tab-item">

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>易千支付设置</legend>
    </fieldset>
	
	<div class="layui-form-item">
        <label class="layui-form-label">易千支付开关：</label>
        <div class="layui-input-inline w400">
            <input type="radio" name="pay[yiqianpay][kaiguan]"  value="1" title="开" <?php if($config['pay']['yiqianpay']['kaiguan'] == 1): ?>checked<?php endif; ?>>
			<input type="radio" name="pay[yiqianpay][kaiguan]"  value="0" title="关" <?php if($config['pay']['yiqianpay']['kaiguan'] == 0): ?>checked<?php endif; ?>>
        </div>
    </div>
	
    <div class="layui-form-item">
        <label class="layui-form-label">支付商家编号：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[yiqianpay][appid]" placeholder="" value="<?php echo $config['pay']['yiqianpay']['appid']; ?>" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">支付商家密钥：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[yiqianpay][appkey]" placeholder="" value="<?php echo $config['pay']['yiqianpay']['appkey']; ?>" class="layui-input">
        </div>
    </div>
    
    <div class="layui-form-item">
        <label class="layui-form-label">网关提交地址：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[yiqianpay][act]" placeholder="" value="<?php echo $config['pay']['yiqianpay']['act']; ?>" class="layui-input">
        </div>
       
    </div>
</div>