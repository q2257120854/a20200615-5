<?php defined("APP") or die() ?>
<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
  <head>       
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0" />  
    <meta name="description" content="<?php echo Main::description() ?>" />
    <!-- Open Graph Tags -->
    <?php echo Main::ogp(); ?> 

    <title><?php echo Main::title() ?></title> 
        
    <!-- Bootstrap core CSS -->
    <link href="<?php echo $this->config["url"] ?>/static/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config["url"] ?>/themes/<?php echo $this->config["theme"] ?>/style.css">    
    <!-- Required Javascript Files -->
    <script type="text/javascript" src="<?php echo $this->config["url"] ?>/static/js/jquery.min.js?v=1.11.0"></script>
    <script type="text/javascript" src="<?php echo $this->config["url"] ?>/static/application.fn.js?v=1.0"></script>
    <script type="text/javascript" src="<?php echo $this->config["url"] ?>/static/application.js?v=1.0"></script>      
    <script type="text/javascript">
      var appurl="<?php echo $this->config["url"] ?>";
      var token="<?php echo $this->config["public_token"] ?>";
    </script>
    <?php Main::enqueue() // Add scripts when needed ?>    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body<?php echo Main::body_class() ?> id="main-overlay" style="overflow:hidden">
    <section>
        <div class='custom-message <?php echo $position ?>' style='background-color: <?php echo $bg; ?> !important'>
            <?php if (!empty($label)): ?>
              <div class='custom-label' style='background-color: <?php echo $labelbg; ?>;color: <?php echo $labelcolor; ?>'><?php echo $label; ?></div>
            <?php endif ?>
            <p style='color: <?php echo $color; ?>'><?php echo $message; ?></p>
            <a href='<?php echo $link; ?>' class='btn btn-xs' style='background-color: <?php echo $btnbg; ?>;color: <?php echo $btncolor; ?>'><?php echo $text; ?></a>
            <a href="<?php echo $url->url ?>" class="remove"><i class="glyphicon glyphicon-remove-sign"></i></a>
        </div><!-- /.custom-message --> 
      <iframe id="site" src="<?php echo $url->url;?>" frameborder="0" style="border: 0; width: 100%; height: 100%" scrolling="yes"></iframe>
    </section>
    <script type="text/javascript">
       $("iframe#site,section").height($(document).height());
    </script>
    <?php Main::enqueue('footer') ?>  
  </body>
</html>  