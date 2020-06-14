<?php defined("APP") or die() ?>
<div id="user-content">
	<?php echo Main::message() ?>  	
	<div class="row">
		<div class="main-content col-md-5">
			<div class="panel panel-default panel-body">
				<h3><?php echo e("Manage your bundles") ?> <a href="" class="btn btn-xs btn-primary ajax_call pull-right" data-action="bundle_create" data-title="<?php echo e("Create Bundle") ?>"><?php echo e("Create Bundle") ?></a>	</h3>
				<ul class="list-group bundles">
				<?php foreach ($bundles as $bundle): ?>
					<li class="list-group-item">
						<a href="#" class="ajax_call" data-class="return-ajax" data-id="<?php echo $bundle->id ?>" data-active="active" data-action="bundle_urls"><h4 class="list-group-item-heading"><?php echo $bundle->name ?></h4></a>
						<p><?php echo $this->config["url"]."/profile/{$this->user->username}/".Main::slug($bundle->name)."-{$bundle->id}"; ?> <a href="#" class="copy inline-copy" data-clipboard-text="<?php echo $this->config["url"]."/profile/{$this->user->username}/".Main::slug($bundle->name)."-{$bundle->id}"; ?>"><?php echo e("Copy") ?></a></p>
				    <p class="list-group-item-text">
							<a href='#edit' class='ajax_call' data-title="<?php echo e("Edit Bundle")?>" data-action='bundle_edit' data-id='<?php echo $bundle->id ?>'><?php echo e("Edit")?></a>
							&nbsp;&nbsp;&bullet;&nbsp;&nbsp; 
							<a href="<?php echo Main::href("user/delete/{$bundle->id}").Main::nonce("delete_bundle-{$bundle->id}") ?>" class="delete"><?php echo e("Delete")?></a>			    	
							&nbsp;&nbsp;&bullet;&nbsp;&nbsp; 
				    	<?php echo $bundle->view ?> <?php echo e("Views") ?> &nbsp;&nbsp;&bullet;&nbsp;&nbsp; 
				    	<?php echo $this->count("user_bundle_urls",$bundle->id) ?> <?php echo e("URLs") ?> &nbsp;&nbsp;&bullet;&nbsp;&nbsp;
				    	<?php echo e(ucfirst($bundle->access)) ?>				
				    	&nbsp;&nbsp;&bullet;&nbsp;&nbsp;	
							<?php echo Main::timeago($bundle->date) ?>
				    </p>					
					</li>					
				<?php endforeach ?>
				</ul>
				<?php echo $pagination ?>				
			</div>
		</div>
		<div class="main-content col-md-7">
			<div class="panel panel-default panel-body">
				<div id="data-container">
					<div class="btn-group btn-group-sm">
						<a href="#" class="btn btn-primary" id="selectall"><?php echo e("Select All")?></a>
						<a href="#" class="btn btn-danger" id="deleteall"><?php echo e("Delete All")?></a>
					</div>
					<form action="<?php echo Main::href("user/delete") ?>" method="post" id="delete-all-urls">				
						<div class="url-container">
							<div class="return-ajax">
								<p class="center"><?php echo e("Please select a bundle from the left.") ?></p>
							</div><!-- /.return-ajax -->							
						</div>
						<?php echo Main::csrf_token(TRUE) ?>
					</form>
				</div><!-- /#data-container -->	  					
			</div>		
		</div>
	</div>
</div>