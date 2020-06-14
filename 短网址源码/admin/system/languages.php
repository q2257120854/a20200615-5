<?php if(!defined("APP")) die()?>
<div class="panel panel-default">
  <div class="panel-heading">
    网站多语言
    <a href="<?php echo Main::ahref("languages/add") ?>" class="pull-right btn btn-primary btn-xs">添加语言</a>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>语言名称</th>
              <th>代码</th>
              <th>作者</th>
              <th>日期</th>
              <th>%翻译进度</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>          
            <?php foreach ($languages as $language): ?>
              <tr>
                <td><?php echo $language["name"] ?></td>
                <td><?php echo $language["code"] ?></td>
                <td><?php echo $language["author"] ?></td>
                <td><?php echo $language["date"] ?></td>
                <td><span class="label label-success"><?php echo $language["percent"] ?>%</span></td>
                <td>
                  <a href="<?php echo Main::ahref("languages/edit/{$language["code"]}") ?>" class="btn btn-primary btn-xs">编辑</a>
                  <a href="<?php echo Main::ahref("languages/delete/{$language["code"]}").Main::nonce("delete_language-{$language["code"]}") ?>" class="btn btn-danger btn-xs delete" title="Delete Language">删除</a>                  
                </td>
              </tr>      
            <?php endforeach ?>
          </tbody>
        </table> 
    </div>
  </div>
</div>