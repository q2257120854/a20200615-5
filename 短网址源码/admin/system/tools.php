<?php if(!defined("APP")) die(); // Protect this page ?>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        删除不活跃的网址
      </div>
      <div class="panel-body">
        <p>
          此工具会删除过去30天内未收到任何点击的网址。
        </p>
        <a href="<?php echo Main::ahref("urls/inactive").Main::nonce("inactive_urls") ?>" class="btn btn-danger delete">删除不活跃的网址</a>
      </div>
    </div>    
  </div>    
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        删除匿名用户网址
      </div>
      <div class="panel-body">
        <p>
          此工具删除匿名未注册用户缩短的所有URL（及其关联的统计信息，如果您的网站响应速度很慢，建议您这样做。.
        </p>
        <a href="<?php echo Main::ahref("urls/flush").Main::nonce("flush") ?>" class="btn btn-danger delete">删除匿名用户网址</a>
      </div>
    </div>    
  </div>  
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        导出网址
      </div>
      <div class="panel-body">
        <p>
          此工具允许您生成CSV格式的URL列表，此类点击的一些基本数据也将包含在内。
        </p>
        <a href="<?php echo Main::ahref("urls/export") ?>" class="btn btn-primary">导出网址</a>
      </div>
    </div>    
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        删除非活跃用户
      </div>
      <div class="panel-body">
        <p>
          此工具会删除已注册但未激活其帐户的用户。这可能是试图使用虚假电子邮件甚至垃圾邮件发送者的用户.
        </p>
        <a href="<?php echo Main::ahref("users/inactive").Main::nonce("inactive_users") ?>" class="btn btn-danger delete">删除非活跃用户</a> 
      </div>
    </div>    
  </div>    
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        导出用户
      </div>
      <div class="panel-body">
        <p>
          此工具允许您生成CSV格式的用户列表。然后，您可以在电子邮件营销工具中导入它.
        </p>
        <a href="<?php echo Main::ahref("users/export") ?>" class="btn btn-primary">导出用户</a> 
      </div>
    </div>    
  </div>  
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        优化数据库
      </div>
      <div class="panel-body">
        <p>
          此工具可优化数据库，使其更好地运行。.
        </p>
        <a href="<?php echo Main::ahref("tools/optimize") ?>" class="btn btn-primary">优化数据库</a>
      </div>
    </div>    
  </div>
</div>  