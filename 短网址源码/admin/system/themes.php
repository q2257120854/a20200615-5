<?php if(!defined("APP")) die()?>
<p class="alert alert-info">
 所有主题都位于“themes”文件夹中。您所要做的就是将您的主题上传到该文件夹​​，然后来这里激活它。确保命名主样式表style.css，否则主题不会显示！
</p>      
<div class="row themes">
  <?php echo $theme_list ?> 
</div>