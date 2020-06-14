<?php if(!defined("APP")) die(); // Protect this page ?>
<div class="row">
	<div class="col-md-9">
		<div class="row">
			<div class="col-md-6">
				<div class="panel">
					<div class="panel-heading"><label for="email.registration">用户注册邮件通知</label></div>
					<div class="panel-body">
						<form action="<?php echo Main::ahref("emails") ?>" method="post">
							<div class="form-group">
								<textarea name="email.registration" id="email.registration" cols="30" rows="10" class="form-control editor"><?php echo $this->config["email.registration"] ?></textarea>
							</div>
							<?php echo Main::csrf_token(TRUE) ?>
							<button type="submit" class="btn btn-primary">保存</button>
						</form>				
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel">
					<div class="panel-heading"><label for="email.activation">用户激活邮件通知</label></div>
					<div class="panel-body">
						<form action="<?php echo Main::ahref("emails") ?>" method="post">
							<div class="form-group">
								<textarea name="email.activation" id="email.activation" cols="30" rows="10" class="form-control editor"><?php echo $this->config["email.activation"] ?></textarea>
							</div>
							<?php echo Main::csrf_token(TRUE) ?>
							<button type="submit" class="btn btn-primary">保存</button>
						</form>				
					</div>
				</div>
			</div>			
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="panel">
					<div class="panel-heading"><label for="email.activated">用户激活成功邮件通知</label></div>
					<div class="panel-body">
						<form action="<?php echo Main::ahref("emails") ?>" method="post">
							<div class="form-group">
								<textarea name="email.activated" id="email.activated" cols="30" rows="10" class="form-control editor"><?php echo $this->config["email.activated"] ?></textarea>
							</div>
							<?php echo Main::csrf_token(TRUE) ?>
							<button type="submit" class="btn btn-primary">保存</button>
						</form>				
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel">
					<div class="panel-heading"><label for="email.reset">修改密码邮件通知</label></div>
					<div class="panel-body">
						<form action="<?php echo Main::ahref("emails") ?>" method="post">
							<div class="form-group">
								<textarea name="email.reset" id="email.reset" cols="30" rows="10" class="form-control editor"><?php echo $this->config["email.reset"] ?></textarea>
							</div>
							<?php echo Main::csrf_token(TRUE) ?>
							<button type="submit" class="btn btn-primary">保存</button>
						</form>				
					</div>
				</div>
			</div>			
		</div>					
	</div>
	<div class="col-md-3">
		<div class="panel">
			<div class="panel-heading">相关字段</div>
			<div class="panel-body">
        <ul>
          <li>用户名: <strong>{user.username}</strong></li>
          <li>邮箱: <strong>{user.email}</strong></li>
          <li>注册时间: <strong>{user.date}</strong></li>
          <li>激活链接或密码重置: <strong>{user.activation}</strong></li>
          <li>网站名称: <strong>{site.title}</strong></li>
          <li>网站域名: <strong>{site.link}</strong></li>
        </ul>				
			</div>
		</div>
	</div>
</div>