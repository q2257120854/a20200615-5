<?php if(!defined("APP")) die()?>
<div class="panel panel-default">
  <div class="panel-heading">
    会员计划 (<?php echo $count ?>)
    <a href="<?php echo Main::ahref("plans/add") ?>" class="pull-right btn btn-primary btn-xs">添加计划</a>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>名称</th>
              <th>月付价格</th>
              <th>年付价格</th>
              <th>功能</th>
              <th>状态</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>          
            <?php foreach ($plans as $plan): ?>
              <tr data-id="<?php echo $plan->id ?>">
                <td><?php echo Main::truncate($plan->name,20) ?></td>
                <?php if ($plan->free): ?>
                  <td>Free</td>
                  <td>Free</td>
                <?php else: ?>
                  <td><?php echo Main::currency($this->config["currency"]) ?> <?php echo $plan->price_monthly ?></td>
                  <td><?php echo Main::currency($this->config["currency"]) ?> <?php echo $plan->price_yearly ?></td>
                <?php endif ?>
                <td>
                  <span class="label label-info"><?php echo $plan->numurls == "0" ? "Unlimited" : $plan->numurls ?> 网址</span>                  
                  <?php foreach (json_decode($plan->permission) as $type => $p): ?>
                    <?php if (isset($p->enabled) && $p->enabled): ?>
                      <?php $count = NULL;
                        if (isset($p->count)): ?>
                        <?php $count = $p->count == "0" ? "无限" : $p->count ?>
                      <?php endif ?>
                      <span class="label label-info"><?php echo $count ?> <?php echo $type == "api" ? "API支持" : ucfirst($type) ?></span>
                    <?php endif ?>
                  <?php endforeach ?>
                </td>
                <td><?php echo $plan->status ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>" ?></td>         
                <td>
                  <a href="<?php echo Main::ahref("plans/edit/{$plan->id}") ?>" class="btn btn-primary btn-xs">编辑</a>
                  <a href="<?php echo Main::ahref("plans/delete/{$plan->id}").Main::nonce("delete_plan-{$plan->id}") ?>" class="btn btn-danger btn-xs delete" data-content="如果删除此计划不会影响现有用户！为了防止用户继续按此收费，您需要先取消他们的会员资格。只有在没有其他选项的情况下才删除计划！">删除</a>
                </td>
              </tr>      
            <?php endforeach ?>
          </tbody>
        </table> 
    </div>
  </div>
</div>