<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"/www/wwwroot/tiaoshi.com/application/admin/view/extend/pay/whereali.html";i:1577381801;}*/ ?>
<div class="layui-tab-item">

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>where支付宝</legend>
    </fieldset>
	
	<div class="layui-form-item">
        <label class="layui-form-label">where支付开关：</label>
        <div class="layui-input-inline w400">
            <input type="radio" name="pay[whereali][kaiguan]"  value="1" title="开" <?php if($config['pay']['whereali']['kaiguan'] == 1): ?>checked<?php endif; ?>>
			<input type="radio" name="pay[whereali][kaiguan]"  value="0" title="关" <?php if($config['pay']['whereali']['kaiguan'] == 0): ?>checked<?php endif; ?>>
        </div>
    </div>
	
    <div class="layui-form-item">
        <label class="layui-form-label">支付商家编号：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[whereali][appid]" placeholder="" value="<?php echo $config['pay']['whereali']['appid']; ?>" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">支付商家密钥：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[whereali][appkey]" placeholder="" value="<?php echo $config['pay']['whereali']['appkey']; ?>" class="layui-input">
        </div>
    </div>
    
    <div class="layui-form-item">
        <label class="layui-form-label">网关提交地址：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[whereali][act]" placeholder="" value="<?php echo $config['pay']['whereali']['act']; ?>" class="layui-input">
        </div>
       
    </div>
</div>