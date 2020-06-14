<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"/www/wwwroot/tiaoshi.com/application/admin/view/extend/pay/wherewx.html";i:1577382040;}*/ ?>
<div class="layui-tab-item">
  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
  <legend>where微信支付设置</legend>
  </fieldset>
  <div class="layui-form-item">
    <label class="layui-form-label">Where微信支付开关：</label>
    <div class="layui-input-inline w400">
      <input type="radio" name="pay[wherewx][kaiguan]"  value="1" title="开" <?php if($config['pay']['wherewx']['kaiguan'] == 1): ?>checked<?php endif; ?>>
      <input type="radio" name="pay[wherewx][kaiguan]"  value="0" title="关" <?php if($config['pay']['wherewx']['kaiguan'] == 0): ?>checked<?php endif; ?>>
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">支付商家编号：</label>
    <div class="layui-input-inline w400">
      <input type="text" name="pay[wherewx][appid]" placeholder="" value="<?php echo $config['pay']['wherewx']['appid']; ?>" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">支付商家密钥：</label>
    <div class="layui-input-inline w400">
      <input type="text" name="pay[wherewx][appkey]" placeholder="" value="<?php echo $config['pay']['wherewx']['appkey']; ?>" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">网关提交地址：</label>
    <div class="layui-input-inline w400">
      <input type="text" name="pay[wherewx][act]" placeholder="" value="<?php echo $config['pay']['wherewx']['act']; ?>" class="layui-input">
    </div>
  </div>
</div>
