<?php if(!defined("APP")) die(); // Protect this page ?>
<?php if(!$this->config["ads"]): ?>
  <div class="panel panel-red panel-body">
    请注意，广告模块已禁用。您可以通过设置>应用程序设置来启用它。
  </div>
<?php endif ?>
<div class="panel panel-default">
  <div class="panel-heading">
    广告列表 (<?php echo $count ?>)
    <a href="<?php echo Main::ahref("ads/add") ?>" class="pull-right btn btn-primary btn-xs">添加广告</a>
  </div>  
  <div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>名称</th>
              <th><a href="<?php echo Main::ahref("ads?filter=type") ?>">类型</a></th>
              <th><a href="<?php echo Main::ahref("ads?filter=impression") ?>">浏览量</a></th>              
              <th><a href="<?php echo Main::ahref("ads?filter=enabled") ?>">启用</a></th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>          
            <?php foreach ($ads as $ad): ?>
              <tr data-id="<?php echo $ad->id ?>">
                <td><?php echo $ad->name ?></td>
                <td><?php echo ad_type($ad->type) ?></td>
                <td><?php echo $ad->impression ?></td>
                <td><?php echo $ad->enabled ? "Yes" : "No" ?></td>                 
                <td>
                  <a href="<?php echo Main::ahref("ads/edit/{$ad->id}") ?>" class="btn btn-primary btn-xs">编辑</a>
                  <a href="<?php echo Main::ahref("ads/delete/{$ad->id}").Main::nonce("delete_ad-{$ad->id}") ?>" class="btn btn-danger btn-xs delete">删除</a>
                </td>
              </tr>      
            <?php endforeach ?>
          </tbody>
        </table> 
    </div>
  </div>
</div>