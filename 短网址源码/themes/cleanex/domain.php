<?php defined("APP") or die() // Settings Page ?>
<div class="row">	
  <div id="user-content" class="col-md-8">  	
  	<?php echo $this->ads(728) ?>
		<?php echo Main::message() ?>  			
		<div class="main-content panel panel-default panel-body">
			<h3><?php echo e("Add a custom domain") ?></h3>
			<form action='<?php echo Main::href("user/domain") ?>' method='post' class='form-horizontal' role='form'>
	      <div class='form-group'>
	        <label for='domain' class='col-sm-3 control-label'><?php echo e("Custom domain name") ?></label>
	        <div class='col-sm-9'>
	          <input type='domain' class='form-control' name='domain' id='domain' value='' placeholder='e.g. http://on.domain.com'>
	        </div>
	      </div>
	      <?php echo Main::csrf_token(TRUE) ?>
	      <input type='submit' value='<?php echo e("Add Domain") ?>' class='btn btn-primary' />
      </form>
			<hr>
			<h3><?php echo e("Domain Names") ?></h3>
	    <div class="table-responsive">
	        <table class="table table-striped">
	          <thead>
	            <tr>
	              <th><?php echo e("Domain Name") ?></th>
	              <th><?php echo e("Status") ?></th>
	              <th><?php echo e("Options") ?></th>
	            </tr>
	          </thead>
	          <tbody>          
	            <?php foreach ($domains as $domain): ?>
	              <tr data-id="<?php echo $domain->id ?>">
	                <td><?php echo $domain->domain ?></td>	               
	                <td><?php echo $domain->status ? "<span class='label label-success'>".e("Active")."</span>" : "<span class='label label-danger'>".e("Inactive")."</span>" ?></td>         
	                <td>
	                  <a href="<?php echo Main::href("user/domain/{$domain->id}").Main::nonce("delete_domain-{$domain->id}") ?>" class="btn btn-danger btn-xs delete"><?php echo e("Delete") ?></a>
	                </td>
	              </tr>      
	            <?php endforeach ?>
	          </tbody>
	        </table> 
	    </div>     
		</div>	
  </div><!--/#user-content-->
  <div id="widgets" class="col-md-4">
  	<?php echo $this->sidebar() ?>
		<?php echo $widgets ?>				
  </div><!--/#widgets-->
</div><!--/.row-->