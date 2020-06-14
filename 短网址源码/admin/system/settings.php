<?php if(!defined("APP")) die()?>
<?php echo $this->update_notification() ?>
<div class="panel panel-default">
  <div class="panel-heading">
    网站设置
  </div>      
  <div class="panel-body settings">
  	<div class="row">
  		<div class="col-md-3 sub-sidebar">
        <ul class="nav tabs">
          <li class="active"><a href="#general">基本设置</a></li>
					<li><a href="#app">应用设置</a></li>
          <li><a href="#adv">高级设置</a></li>					
          <li><a href="#themes">主题设置</a></li>					
					<li><a href="#security">安全设置</a></li>
          <li><a href="#payment">支付设置</a></li>
          <li><a href="#user">会员设置</a></li>
          <li><a href="#ads">广告设置</a></li>
          <li><a href="#tools">邮件设置</a></li>
        </ul>
  		</div>
  		<div class="col-md-9">
				<form class="form-horizontal" role="form" id="setting-form" action="<?php echo Main::ahref("settings") ?>" method="post" enctype="multipart/form-data">
					<div id="general" class="tabbed">
						<div class="form-group">
					    <label for="url" class="col-sm-3 control-label">网址域名</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="url" id="url" value="<?php echo $this->config['url'] ?>">
					      <p class="help-block">（请确保包含http：//或https：//）并删除最后一个斜杠</p>
					    </div>
					  </div>				
						<div class="form-group">
					    <label for="title" class="col-sm-3 control-label">网站名称</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="title" id="title" value="<?php echo $this->config['title'] ?>">
					      <p class="help-block">短网址网址名称.</p>
					    </div>
					  </div>
                        <div class="form-group">
					    <label for="title" class="col-sm-3 control-label">SEO标题</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="seotitle" id="title" value="<?php echo $this->config['seotitle'] ?>">
					      <p class="help-block">网站SEO标题.</p>
					    </div>
					  </div>					  
						<div class="form-group">
					    <label for="description" class="col-sm-3 control-label">网站介绍</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="description" id="description" value="<?php echo $this->config['description'] ?>">
					      <p class="help-block">网站介绍.</p>
					    </div>
					  </div>
						<div class="form-group">
					    <label for="keywords" class="col-sm-3 control-label">网站关键词</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="keywords" id="keywords" value="<?php echo $this->config['keywords'] ?>">
					      <p class="help-block">网站关键词.</p>
					    </div>
					  </div>					  
						<div class="form-group">
					    <label for="logo" class="col-sm-3 control-label">Logo
					    	<?php if(!empty($this->config["logo"])):  ?>
					    	<span class="help-block"><a href="#" id="remove_logo" class="btn btn-info btn-xs">删除 Logo</a></span>
					    	<?php endif ?>
					    </label>
					    <div class="col-sm-9">
								<?php if(!empty($this->config["logo"])):  ?>
									<img src="<?php echo $this->config["url"] ?>/content/<?php echo $this->config["logo"] ?>" height="80" alt=""> <br />
								<?php endif ?>					    	
					      <input type="file" name="logo_path" id="logo">
					      <p class="help-block">请确保LOGO的大小和格式</p>
					    </div>
					  </div>		
						<div class="form-group">
					    <label for="favicon" class="col-sm-3 control-label">Favicon
					    	<?php if(!empty($this->config["favicon"])):  ?>
					    	<span class="help-block"><a href="#" id="remove_favicon" class="btn btn-info btn-xs">删除 Favicon</a></span>
					    	<?php endif ?>
					    </label>
					    <div class="col-sm-9">
								<?php if(!empty($this->config["favicon"])):  ?>
									<img src="<?php echo $this->config["url"] ?>/content/<?php echo $this->config["favicon"] ?>" height="32" alt=""> <br />
								<?php endif ?>					    	
					      <input type="file" name="favicon_path" id="favicon">
					      <p class="help-block">请确保favicon的尺寸和格式（32x32 png或ico）</p>
					    </div>
					  </div>					  
						<div class="form-group">
					    <label for="default_lang" class="col-sm-3 control-label">默认语言</label>
					    <div class="col-sm-9">
					      <select name="default_lang" id="default_lang" class="selectized">
					      	<?php echo $lang ?>
					      </select>
					      <p class="help-block">要添加新语言，可以使用includes / languages /中的示例文件“sample_lang.php”，然后重命名为双字母代码。.</p>
					    </div>
					  </div>
						<div class="form-group">
					    <label for="timezone" class="col-sm-3 control-label">时区</label>
					    <div class="col-sm-9">
					      <select name="timezone" id="timezone" class="selectized">
									<?php
										$timezone_identifiers = DateTimeZone::listIdentifiers();
										foreach($timezone_identifiers as $tz){
										    echo "<option value='$tz' ".($this->config["timezone"] == $tz ? "selected":"").">$tz</option>";
										}
									?>
									<option <?php echo ($this->config["timezone"] == "Etc/GMT+12" ? "selected":"") ?> value="Etc/GMT+12">GMT+12</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT+11" ? "selected":"") ?> value="Etc/GMT+11">GMT+11</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT+10" ? "selected":"") ?> value="Etc/GMT+10">GMT+10</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT+9" ? "selected":"") ?> value="Etc/GMT+9">GMT+9</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT+8" ? "selected":"") ?> value="Etc/GMT+8">GMT+8</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT+7" ? "selected":"") ?> value="Etc/GMT+7">GMT+7</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT+6" ? "selected":"") ?> value="Etc/GMT+6">GMT+6</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT+5" ? "selected":"") ?> value="Etc/GMT+5">GMT+5</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT+4" ? "selected":"") ?> value="Etc/GMT+4">GMT+4</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT+3" ? "selected":"") ?> value="Etc/GMT+3">GMT+3</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT+2" ? "selected":"") ?> value="Etc/GMT+2">GMT+2</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT+1" ? "selected":"") ?> value="Etc/GMT+1">GMT+1</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT+0" ? "selected":"") ?> value="Etc/GMT+0">GMT</option>
									<option <?php echo ($this->config["timezone"] == "Etc/GMT-12" ? "selected":"") ?> value="Etc/GMT-12">GMT-12</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT-11" ? "selected":"") ?> value="Etc/GMT-11">GMT-11</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT-10" ? "selected":"") ?> value="Etc/GMT-10">GMT-10</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT-9" ? "selected":"") ?> value="Etc/GMT-9">GMT-9</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT-8" ? "selected":"") ?> value="Etc/GMT-8">GMT-8</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT-7" ? "selected":"") ?> value="Etc/GMT-7">GMT-7</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT-6" ? "selected":"") ?> value="Etc/GMT-6">GMT-6</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT-5" ? "selected":"") ?> value="Etc/GMT-5">GMT-5</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT-4" ? "selected":"") ?> value="Etc/GMT-4">GMT-4</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT-3" ? "selected":"") ?> value="Etc/GMT-3">GMT-3</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT-2" ? "selected":"") ?> value="Etc/GMT-2">GMT-2</option>		    
									<option <?php echo ($this->config["timezone"] == "Etc/GMT-1" ? "selected":"") ?> value="Etc/GMT-1">GMT-1</option>											    
								</select> 
					    </div>
					  </div>
						<div class="form-group">
					    <label for="font" class="col-sm-3 control-label">Google字体</label>
					    <div class="col-sm-9">
					      <input class="form-control" name="font" id="font" value="<?php echo $this->config['font'] ?>">
					      <p class="help-block">请添加Google字体的名称： <a href="https://www.google.com/fonts" target="_blank">Google Font</a>: 例如<strong>Open Sans</strong>.</p>
					    </div>
					  </div>
						<div class="form-group">
					    <label for="news" class="col-sm-3 control-label">公告</label>
					    <div class="col-sm-9">
					      <textarea class="form-control" name="news" id="news"><?php echo $this->config['news'] ?></textarea>
					      <p class="help-block">这将显示在用户仪表板中，你可以使用HTML.</p>
					    </div>
					  </div>					  			  
						<div class="form-group">
					    <label for="email" class="col-sm-3 control-label">电子邮件</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="email" id="email" value="<?php echo $this->config['email'] ?>">
					      <p class="help-block">此电子邮件将用于发送电子邮件和接收电子邮件.</p>
					    </div>
					  </div>
					  <hr>
						<div class="form-group">
					    <label for="facebook" class="col-sm-3 control-label">微博地址</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="facebook" id="facebook" value="<?php echo $this->config['facebook'] ?>">
					      <p class="help-block">微博地址</p>
					    </div>
					  </div>	
						<div class="form-group">
					    <label for="twitter" class="col-sm-3 control-label">QQ空间</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="twitter" id="twitter" value="<?php echo $this->config['twitter'] ?>">
					      <p class="help-block">QQ空间</p>
					    </div>
					  </div>						  					  			  		  												
					</div><!-- /#main.tabbed -->
					<script src="/static/js/cache.js"></script>
					<div id="app" class="tabbed">
						<ul class="form_opt" data-id="maintenance">
							<li class="text-label">网站维护 <small>开启只能管理员登录查看.</small></li>
							<li><a href="" class="last<?php echo (($this->config["maintenance"])?' current':'')?>" data-value="1">维护</a></li>
							<li><a href="" class="first<?php echo ((!$this->config["maintenance"])?' current':'')?>" data-value="0">上线</a></li>
						</ul>
						<input type="hidden" name="maintenance" id="maintenance" value="<?php echo $this->config["maintenance"]?>">	

						<ul class="form_opt" data-id="private">
							<li class="text-label">私人服务 <small>开启只能管理员添加用户.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["private"])?' current':'')?>" data-value="0">禁用</a></li>
							<li><a href="" class="first<?php echo (($this->config["private"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="private" id="private" value="<?php echo $this->config["private"]?>">	

						<div class="form-group">
					    <label for="home_redir" class="col-sm-3 control-label">首页跳转</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="home_redir" id="home_redir" value="<?php echo $this->config['home_redir'] ?>">
					      <p class="help-block">开启私人模式可以设置首页跳转，记得加上http://.</p>
					    </div>
					  </div>	

						<ul class="form_opt" data-id="frame">
							<li class="text-label">网站重定向模式<small>选择短网址跳转模式，只对免费用户和匿名用户有效</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["frame"])?' current':'')?>" data-value="0">直接</a></li>
							<li><a href="" class="<?php echo (($this->config["frame"]==1)?' current':'')?>" data-value="1">框架</a></li>
							<li><a href="" class="<?php echo (($this->config["frame"]==2)?' current':'')?>" data-value="2">点击</a></li>
							<li><a href="" class="first<?php echo (($this->config["frame"]==3)?' current':'')?>" data-value="3">自动</a></li>
						</ul>
						<input type="hidden" name="frame" id="frame" value="<?php echo $this->config["frame"]?>">		
						<div class="form-group">
							<div class="col-md-10">
								<label for="timer" class="control-label">跳转计时</label>								
								<p class="help-block">设置用户访问短网址需要几秒钟后点击.</p>
							</div>					    
					    <div class="col-md-2">
					      <input type="text" class="form-control" name="timer" id="timer" value="<?php echo $this->config['timer'] ?>">
					    </div>
					  </div>	

						<ul class="form_opt" data-id="advanced">
							<li class="text-label">短网址高级功能 <small>匿名用户开启高级功能.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["advanced"])?' current':'')?>" data-value="0">禁用</a></li>
							<li><a href="" class="first<?php echo (($this->config["advanced"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="advanced" id="advanced" value="<?php echo $this->config["advanced"]?>">	

						<ul class="form_opt" data-id="show_media">
							<li class="text-label">媒体网关 <small>启用此功能将自动为Youtube，Vine，Dailymotion等URL创建媒体页面。.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["show_media"])?' current':'')?>" data-value="0">禁用</a></li>
							<li><a href="" class="first<?php echo (($this->config["show_media"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="show_media" id="show_media" value="<?php echo $this->config["show_media"]?>">				

						<ul class="form_opt" data-id="geotarget">
							<li class="text-label">地理定位<small>根据用户所在的国家（如果由用户设置）重定向。</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["geotarget"])?' current':'')?>" data-value="0">禁用</a></li>
							<li><a href="" class="first<?php echo (($this->config["geotarget"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="geotarget" id="geotarget" value="<?php echo $this->config["geotarget"]?>">	

						<ul class="form_opt" data-id="devicetarget">
							<li class="text-label">访问设备<small>根据用户的设备重定向（如果由用户设置）.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["devicetarget"])?' current':'')?>" data-value="0">禁用</a></li>
							<li><a href="" class="first<?php echo (($this->config["devicetarget"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="devicetarget" id="devicetarget" value="<?php echo $this->config["devicetarget"]?>">	

						<ul class="form_opt" data-id="api">
							<li class="text-label">开发API <small>允许注册用户使用API缩短其网站的URL.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["api"])?' current':'')?>" data-value="0">禁用</a></li>
							<li><a href="" class="first<?php echo (($this->config["api"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="api" id="api" value="<?php echo $this->config["api"]?>">							

						<ul class="form_opt" data-id="sharing">
							<li class="text-label">网址分享 <small>允许用户分享其缩短的URL.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["sharing"])?' current':'')?>" data-value="0">禁用</a></li>
							<li><a href="" class="first<?php echo (($this->config["sharing"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="sharing" id="sharing" value="<?php echo $this->config["sharing"]?>">					

													
					</div><!-- /#app.tabbed -->

					<div id="adv" class="tabbed">
						<div class="form-group">
					    <label for="alias_length" class="col-sm-3 control-label">短网址长度</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="alias_length" id="alias_length" value="<?php echo $this->config['alias_length'] ?>">
					      <p class="help-block">此字段用于生成短网址长度的随机别名。最小值3.</p>
					    </div>
					  </div>	
						<div class="form-group">
					    <label for="schemes" class="col-sm-3 control-label">缩短方案</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="schemes" id="schemes" value="<?php echo $this->config['schemes'] ?>">
					      <p class="help-block">添加或删除允许的URL方案。</p>
					    </div>
					  </div>	

						<ul class="form_opt" data-id="tracking">
							<li class="text-label">高级跟踪系统 <small> “系统”将使用内置跟踪系统，“禁用”将禁用高级跟踪，但仍将计算点击次数.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["tracking"])?' current':'')?>" data-value="0">禁用</a></li>
							<li><a href="" class="<?php echo (($this->config["tracking"]==='1')?' current':'')?>" data-value="1">系统</a></li>
						</ul>
						<input type="hidden" name="tracking" id="tracking" value="<?php echo $this->config["tracking"]?>">
						<div class="form-group">
					    <label for="analytic" class="col-sm-3 control-label">谷歌统计 ID</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="analytic" id="analytic" value="<?php echo $this->config['analytic'] ?>">
					      <p class="help-block">谷歌统计 ID 例如. UA-12345678-1.</p>
					    </div>
					  </div>	
					  <hr>
						<ul class="form_opt" data-id="multiple_domains">
							<li class="text-label">多域名 <small>如果启用，用户可以从下面的列表中选择他们的首选域名,确保域名指向本站。</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["multiple_domains"])?' current':'')?>" data-value="0">禁用</a></li>
							<li><a href="" class="first<?php echo (($this->config["multiple_domains"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="multiple_domains" id="multiple_domains" value="<?php echo $this->config["multiple_domains"]?>">
						<div class="form-group">
					    <label for="domain_names" class="col-sm-3 control-label">域名</label>
					    <div class="col-sm-9">
					      <textarea name="domain_names" id="domain_names" rows="5" class="form-control"><?php echo $this->config["domain_names"]?></textarea>	
					      <p class="help-block">每行一个域，包括http://，不包括主域名.</p>
					    </div>
					  </div>			
					  <hr>
						<div class="form-group">
					    <label for="serverip" class="col-sm-3 control-label">网站IP地址</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="serverip" id="serverip" value="<?php echo $this->config['serverip'] ?>">
					      <p class="help-block">在此处添加服务器IP以启用A记录，否则，您的客户只能使用CNAME。</p>
					    </div>
					  </div>					  									  
					</div><!-- /#adv.tabbed -->
					<div id="themes" class="tabbed">
						<ul class="form_opt" data-id="user_history">
							<li class="text-label">匿名用户记录 <small>如果启用，匿名用户可以在主页上查看其URL的个人历史记录.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["user_history"])?' current':'')?>" data-value="0">禁用</a></li>
							 <li><a href="" class="first<?php echo (($this->config["user_history"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="user_history" id="user_history" value="<?php echo $this->config["user_history"]?>">				
						<ul class="form_opt" data-id="public_dir">
							<li class="text-label">公开网址列表 <small>启用此选项将在主页上显示新的公共URL列表，只有最新25个URL会显示在那里.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["public_dir"])?' current':'')?>" data-value="0">禁用</a></li>
							<li><a href="" class="first<?php echo (($this->config["public_dir"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="public_dir" id="public_dir" value="<?php echo $this->config["public_dir"]?>">	
						
						<ul class="form_opt" data-id="homepage_stats">
							<li class="text-label">网址统计显示 <small>开启后将在主页显示统计量.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["homepage_stats"])?' current':'')?>" data-value="0">禁用</a></li>
							<li><a href="" class="first<?php echo (($this->config["homepage_stats"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="homepage_stats" id="homepage_stats" value="<?php echo $this->config["homepage_stats"]?>">									
					</div>
					<div id="security" class="tabbed">

						<ul class="form_opt" data-id="adult">
							<li class="text-label">黑名单网址 <small>启用后，将不允许包含以下关键字的任何URL，还将阻止缩短到可执行文件的链接.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["adult"])?' current':'')?>" data-value="0">禁用</a></li>	
							<li><a href="" class="first<?php echo (($this->config["adult"])?' current':'')?>" data-value="1">启用</a></li>			
						</ul>
						<input type="hidden" name="adult" id="adult" value="<?php echo $this->config["adult"]?>">			
						<div class="form-group">												
					    <label for="keyword_blacklist" class="col-sm-3 control-label">黑名单关键字</label>
					    <div class="col-sm-9">
					      <textarea name="keyword_blacklist" id="keyword_blacklist"class="form-control" rows="5"><?php echo $this->config["keyword_blacklist"] ?></textarea>
					      <p class="help-block">用逗号分隔每个关键字,例如关键字1,关键字2,关键字3</p>
					    </div>
					  </div>
						<div class="form-group">
					    <label for="domain_blacklist" class="col-sm-3 control-label">黑名单域名</label>
					    <div class="col-sm-9">
					      <textarea name="domain_blacklist" id="domain_blacklist" class="form-control" rows="5"><?php echo $this->config["domain_blacklist"] ?></textarea>
					      <p class="help-block">添加域名（用逗号分隔）：domain.com，domain2.com，domain3.com</p>
					    </div>
					  </div>				  
						<hr>
						<div class="form-group">
					    <label for="safe_browsing" class="col-sm-3 control-label">Google安全浏览</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="safe_browsing" id="safe_browsing" value="<?php echo $this->config['safe_browsing'] ?>">
					      <p class="help-block">查看及申请API请移到 <a href="https://developers.google.com/safe-browsing" target="_blank">Google</a></p>
					    </div>
					  </div>
						<div class="form-group">
					    <label for="phish_api" class="col-sm-3 control-label">Phishtank API</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="phish_api" id="phish_api" value="<?php echo $this->config['phish_api'] ?>">
					      <p class="help-block">请注意，不需要API密钥，但是请求的数量将受到限制。您可以从 <a href="https://www.phishtank.com/developer_info.php" target="_blank">这里</a>免费获得API密钥</p>
					    </div>
					  </div>						  	
						<hr>	
						<ul class="form_opt" data-id="captcha" data-callback="solvemedia">
							<li class="text-label">验证码<small>Users will be prompted to answer a captcha before processing their request. If you enable any of the captcha make sure to add your keys as well.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["captcha"])?' current':'')?>" data-value="0">禁用</a></li>
							<li><a href="" class="<?php echo (($this->config["captcha"]=="1")?' current':'')?>" data-value="1">谷歌验证码</a></li>
							<li><a href=""class="first<?php echo (($this->config["captcha"]=="2")?' current':'')?>" data-value="2">Solvemedia</a></li>
						</ul>
						<input type="hidden" name="captcha" id="captcha" value="<?php echo $this->config["captcha"]?>">					  
						<p class="solvemedia alert alert-info" style="display: none;">
							要设置solvemedia captcha，必须打开includes/library/solvemedia.php文件，并在其中填写说明solvemedia API密钥的密钥。请注意，如果启用此功能并且不添加密钥，脚本将不起作用！
						</p>
						<div class="form-group">
					    <label for="captcha_public" class="col-sm-3 control-label">谷歌验证码 Public Key</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="captcha_public" id="captcha_public" value="<?php echo $this->config['captcha_public'] ?>">
					      <p class="help-block">申请及查看 <a href="https://www.google.com/recaptcha" target="_blank">Google</a></p>
					    </div>
					  </div>				
						<div class="form-group">
					    <label for="captcha_private" class="col-sm-3 control-label">谷歌验证码 Private Key</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="captcha_private" id="captcha_private" value="<?php echo $this->config['captcha_private'] ?>">
					      <p class="help-block">申请及查看 <a href="https://www.google.com/recaptcha" target="_blank">Google</a></p>
					    </div>
					  </div>										
					</div><!-- /#security.tabbed -->
					<div id="payment" class="tabbed">
						<ul class="form_opt" data-id="pro">
							<li class="text-label">高级模块 <small>启用此模块将允许您向用户收取高级功能的费用。如果要免费提供这些功能，请禁用此功能.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["pro"])?' current':'')?>" data-value="0">禁用</a></li>	
							<li><a href="" class="first<?php echo (($this->config["pro"])?' current':'')?>" data-value="1">启用</a></li>			
						</ul>
						<input type="hidden" name="pro" id="pro" value="<?php echo $this->config["pro"]?>">		
						<?php if ($this->isExtended()): ?>
							<ul class="form_opt" data-id="pt">
								<li class="text-label">支付网关 <small>选择支付宝或Paypal.</small></li>
								<li><a href="" class="last<?php echo (($this->config["pt"] == "stripe")?' current':'')?>" data-value="stripe">支付宝</a></li>	
								<li><a href="" class="first<?php echo (($this->config["pt"] == "paypal")?' current':'')?>" data-value="paypal">Paypal</a></li>			
							</ul>
							<input type="hidden" name="pt" id="pt" value="<?php echo $this->config["pt"]?>">															
						<?php endif ?>														
						<hr>						
						<div class="form-group">
					    <label for="paypal_email" class="col-sm-3 control-label">PayPal Email</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="paypal_email" placeholder="myemail@host.com"  id="paypal_email" value="<?php echo $this->config['paypal_email'] ?>">
					      <p class="help-block">支付成功返回地址 <strong><?php echo $this->config["url"] ?>/ipn</strong>  <a href="https://developer.paypal.com/webapps/developer/docs/classic/products/instant-payment-notification/" target="_blank">申请PayPal</a></p>
					    </div>
					  </div>	
					  <hr>
					  <?php if ($this->isExtended()): ?>
							<div class="form-group">
						    <label for="stpk" class="col-sm-3 control-label">Stripe Publishable Key</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control" name="stpk" id="stpk" value="<?php echo $this->config['stpk'] ?>">
						      <p class="help-block">Get your stripe keys from here once logged in <a href="https://dashboard.stripe.com/account/apikeys" target="_blank">click here</a></p>
						    </div>
						  </div>	
							<div class="form-group">
						    <label for="stsk" class="col-sm-3 control-label">Stripe Secret Key</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control" name="stsk"  id="stsk" value="<?php echo $this->config['stsk'] ?>">
						      <p class="help-block">Get your stripe keys from here once logged in <a href="https://dashboard.stripe.com/account/apikeys" target="_blank">click here</a></p>
						    </div>
						  </div>			
							<div class="form-group">
						    <label for="stripesig" class="col-sm-3 control-label">Webhook Signature Key</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control" name="stripesig" placeholder="whsec_..."  id="stripesig" value="<?php echo $this->config['stripesig'] ?>">
						      <p class="help-block">Webhook signature is a security measure to verify the authenticity of the data incoming from Stripe. It is highly recommended that you add this for safety measure. You can find your key after adding a webhook. <a href="https://dashboard.stripe.com/account/webhooks" target="_blank">Click here to find your signature key.</a></p>
						    </div>
						  </div>							  	
						  <hr>				
					  <?php endif; ?>	  	 					  
						<div class="form-group">
					    <label for="currency" class="col-sm-3 control-label">货币单位</label>
					    <div class="col-sm-9">
					      <?php $currencies = Main::currency() ?>
					     <select name="currency" id="currency">
					      <?php foreach ($currencies as $code => $info): ?>
					      	<option value="<?php echo $code ?>" <?php if($this->config["currency"]==$code) echo "selected" ?>><?php echo $info["label"] ?></option>
					      <?php endforeach ?>
					      </select>
					  		<p class="help-block"><strong>注意</strong> 如果您已经有了会员，强烈建议您不要更改货币或会员费！</p>	 					      
					    </div>
					  </div>			  
						<div class="form-group">
					    <label for="aliases" class="col-sm-3 control-label">高级短网址</label>
					    <div class="col-sm-9">
					      <textarea name="aliases" class="form-control" rows="5"><?php echo $this->config["aliases"] ?></textarea>
					      <p class="help-block">仅为Pro成员保留别名，请将其添加到上面的列表中（用逗号分隔，每个别名之间没有空格）：Google、Apple、Microsoft等。只有管理员和Pro用户可以选择这些别名.</p>
					    </div>
					  </div>						  		  		  					
					</div><!-- /#payment.tabbed -->	
					<div id="user" class="tabbed">
						<ul class="form_opt" data-id="user_r">
							<li class="text-label">用户注册 <small>允许用户注册并为其URL加书签。如果禁用注册，链接将隐藏.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["user"])?' current':'')?>" data-value="0">禁用</a></li>
							 <li><a href="" class="first<?php echo (($this->config["user"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="user" id="user_r" value="<?php echo $this->config["user"]?>">	

						<ul class="form_opt" data-id="user_activate">
							<li class="text-label">用户激活 <small>如果启用，将向用户发送包含激活链接的电子邮件.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["user_activate"])?' current':'')?>" data-value="0">禁用</a></li>
							 <li><a href="" class="first<?php echo (($this->config["user_activate"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="user_activate" id="user_activate" value="<?php echo $this->config["user_activate"]?>">	

						<ul class="form_opt" data-id="require_registration">
							<li class="text-label">需要注册 <small>如果启用，用户缩短域名必须注册.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["require_registration"])?' current':'')?>" data-value="0">禁用</a></li>
							 <li><a href="" class="first<?php echo (($this->config["require_registration"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="require_registration" id="require_registration" value="<?php echo $this->config["require_registration"]?>">	

						<ul class="form_opt" data-id="allowdelete">
							<li class="text-label">允许注销帐户 <small>如果启用，用户将能够完全删除其帐户和所有相关数据.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["allowdelete"])?' current':'')?>" data-value="0">禁用</a></li>
							 <li><a href="" class="first<?php echo (($this->config["allowdelete"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="allowdelete" id="allowdelete" value="<?php echo $this->config["allowdelete"]?>">	

						<hr>
						<ul class="form_opt" data-id="fb_connect">
							<li class="text-label">启用 Facebook Connect <small>用户可以使用他们的Facebook帐户登录和注册.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["fb_connect"])?' current':'')?>" data-value="0">禁用</a></li>
							<li><a href="" class="first<?php echo (($this->config["fb_connect"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="fb_connect" id="fb_connect" value="<?php echo $this->config["fb_connect"]?>">
						<div class="form-group">
					    <label for="facebook_app_id" class="col-sm-3 control-label">Facebook App ID</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="facebook_app_id" id="facebook_app_id" value="<?php echo $this->config['facebook_app_id'] ?>">
					    </div>
					  </div>
						<div class="form-group">
					    <label for="facebook_secret" class="col-sm-3 control-label">Facebook Secret</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="facebook_secret" id="facebook_secret" value="<?php echo $this->config['facebook_secret'] ?>">
					    </div>
					  </div>					  
						<hr>
						<ul class="form_opt" data-id="tw_connect">
							<li class="text-label">启用 Twitter Connect <small>用户可以使用他们的Twitter帐户登录和注册.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["tw_connect"])?' current':'')?>" data-value="0">禁用</a></li>
							<li><a href="" class="first<?php echo (($this->config["tw_connect"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="tw_connect" id="tw_connect" value="<?php echo $this->config["tw_connect"]?>">											
						<div class="form-group">
					    <label for="twitter_key" class="col-sm-3 control-label">Twitter Public Key</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="twitter_key" id="twitter_key" value="<?php echo $this->config['twitter_key'] ?>">
					    </div>
					  </div>
						<div class="form-group">
					    <label for="twitter_secret" class="col-sm-3 control-label">Twitter Secret Key</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="twitter_secret" id="twitter_secret" value="<?php echo $this->config['twitter_secret'] ?>">
					    </div>
					  </div>
					  <hr>
						<ul class="form_opt" data-id="gl_connect">
							<li class="text-label">启用 Google Authentication <small>用户可以使用他们的Google帐户登录和注册.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["gl_connect"])?' current':'')?>" data-value="0">禁用</a></li>
							<li><a href="" class="first<?php echo (($this->config["gl_connect"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="gl_connect" id="gl_connect" value="<?php echo $this->config["gl_connect"]?>">

						<div class="form-group">
					    <label for="google_cid" class="col-sm-3 control-label">Google Client ID</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="google_cid" id="google_cid" value="<?php echo $this->config['google_cid'] ?>">
					    </div>
					  </div>
						<div class="form-group">
					    <label for="google_cs" class="col-sm-3 control-label">Google Client Secret</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="google_cs" id="google_cs" value="<?php echo $this->config['google_cs'] ?>">
					    </div>
					  </div>											  					
					</div><!-- /#user.tabbed -->
					<div id="ads" class="tabbed">
						<ul class="form_opt" data-id="ads">
							<li class="text-label">广告模块 <small>启用或禁用整个网站的广告.</small></li>
							<li><a href="" class="last<?php echo ((!$this->config["ads"])?' current':'')?>" data-value="0">禁用</a></li>
							<li><a href="" class="first<?php echo (($this->config["ads"])?' current':'')?>" data-value="1">启用</a></li>
						</ul>
						<input type="hidden" name="ads" id="ads" value="<?php echo $this->config["ads"]?>">				

									
					</div><!-- /#ads.tabbed -->			
					<div id="tools" class="tabbed">
					  <div class="alert alert-info"><strong>发信设置:</strong> 建议使用SMTP，因为它比系统邮件模块更可靠.</div>
						<div class="form-group">
					    <label for="smtp" class="col-sm-3 control-label">SMTP Host</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="smtp[host]" value="<?php echo $this->config['smtp']['host'] ?>">
					    </div>
					  </div>				
						<div class="form-group">
					    <label for="smtp" class="col-sm-3 control-label">SMTP Port</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="smtp[port]" value="<?php echo $this->config['smtp']['port'] ?>">
					    </div>
					  </div>		
						<div class="form-group">
					    <label for="smtp" class="col-sm-3 control-label">SMTP User</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" name="smtp[user]" value="<?php echo $this->config['smtp']['user'] ?>">
					    </div>
					  </div>		
						<div class="form-group">
					    <label for="smtp" class="col-sm-3 control-label">SMTP Pass</label>
					    <div class="col-sm-9">
					      <input type="password" class="form-control" name="smtp[pass]" value="<?php echo $this->config['smtp']['pass'] ?>">
					    </div>
					  </div>										 
					</div><!-- /#tools.tabbed -->

				  <div class="form-group">
				    <div class="col-sm-12">
				    	<?php echo Main::csrf_token(TRUE) ?>
				    	<br>
				      <button type="submit" class="btn btn-primary">保存设置</button>
				    </div>
				  </div>
				</form>  			
  		</div>
  	</div>
  </div>
</div>