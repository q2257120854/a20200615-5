<?php if(!defined("APP")) die()?>
<div class="panel panel-default">
  <div class="panel-heading">
    页面管理 (<?php echo $count ?>)
    <a href="<?php echo Main::ahref("pages/add") ?>" class="pull-right btn btn-primary btn-xs">新建页面</a>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>名称</th>
              <th>短网址</th>
              <th>介绍</th>
              <th>显示</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>          
            <?php foreach ($pages as $page): ?>
              <tr data-id="<?php echo $page->id ?>">
                <td><?php echo Main::truncate($page->name,20) ?></td>
                <td><a href="<?php echo Main::href("page/{$page->seo}") ?>" class='btn btn-success btn-xs' target='_blank'><?php echo $page->seo ?></a></td>
                <td><?php echo Main::truncate(strip_tags($page->content),100) ?></td>
                <td><?php echo $page->menu ? "Yes" : "No" ?></td>         
                <td>
                  <a href="<?php echo Main::ahref("pages/edit/{$page->id}") ?>" class="btn btn-primary btn-xs">编辑</a>
                  <a href="<?php echo Main::ahref("pages/delete/{$page->id}").Main::nonce("delete_page-{$page->id}") ?>" class="btn btn-danger btn-xs delete">删除</a>
                </td>
              </tr>      
            <?php endforeach ?>
          </tbody>
        </table> 
    </div>
  </div>
</div>