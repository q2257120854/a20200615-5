<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"/www/wwwroot/tiaoshi.com/application/admin/view/extend/pay/moboopay.html";i:1566532014;}*/ ?>
<div class="layui-tab-item">

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
        <legend>乐支付设置</legend>
    </fieldset>
	
	<div class="layui-form-item">
        <label class="layui-form-label">乐支付开关：</label>
        <div class="layui-input-inline w400">
            <input type="radio" name="pay[moboopay][kaiguan]"  value="1" title="开" <?php if($config['pay']['moboopay']['kaiguan'] == 1): ?>checked<?php endif; ?>>
			<input type="radio" name="pay[moboopay][kaiguan]"  value="0" title="关" <?php if($config['pay']['moboopay']['kaiguan'] == 0): ?>checked<?php endif; ?>>
        </div>
    </div>
	
    <div class="layui-form-item">
        <label class="layui-form-label">支付商家编号：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[moboopay][appid]" placeholder="" value="<?php echo $config['pay']['moboopay']['appid']; ?>" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">支付商家密钥：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[moboopay][appkey]" placeholder="" value="<?php echo $config['pay']['moboopay']['appkey']; ?>" class="layui-input">
        </div>
    </div>
    
    <div class="layui-form-item">
        <label class="layui-form-label">网关提交地址：</label>
        <div class="layui-input-inline w400">
            <input type="text" name="pay[moboopay][act]" placeholder="" value="<?php echo $config['pay']['moboopay']['act']; ?>" class="layui-input">
        </div>
       
    </div>
</div>