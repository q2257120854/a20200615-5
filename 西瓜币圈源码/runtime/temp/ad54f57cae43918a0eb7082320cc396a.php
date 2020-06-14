<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:60:"/web/bt/public/../application/admin/view/usercount/edit.html";i:1558774086;s:50:"/web/bt/application/admin/view/layout/default.html";i:1558774088;s:47:"/web/bt/application/admin/view/common/meta.html";i:1558774089;s:49:"/web/bt/application/admin/view/common/script.html";i:1558774089;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !$config['fastadmin']['multiplenav']): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Uid'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-uid" data-rule="required" class="form-control form-control" name="row[uid]" type="number" value="<?php echo $row['uid']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Wup'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-wup" data-rule="required" class="form-control form-control" name="row[wup]" type="number" value="<?php echo $row['wup']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Wdown'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-wdown" data-rule="required" class="form-control form-control" name="row[wdown]" type="number" value="<?php echo $row['wdown']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Allin'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-allin" data-rule="required" class="form-control form-control" name="row[allin]" type="number" value="<?php echo $row['allin']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Xallin'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-xallin" data-rule="required" class="form-control form-control" name="row[xallin]" type="number" value="<?php echo $row['xallin']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Allout'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-allout" data-rule="required" class="form-control form-control" name="row[allout]" type="number" value="<?php echo $row['allout']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Srpay'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-srpay" data-rule="required" class="form-control form-control" step="0.01" name="row[srpay]" type="number" value="<?php echo $row['srpay']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Kfdown'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-kfdown" data-rule="required" class="form-control form-control" step="0.01" name="row[kfdown]" type="number" value="<?php echo $row['kfdown']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Kfup'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-kfup" data-rule="required" class="form-control form-control" name="row[kfup]" type="number" value="<?php echo $row['kfup']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Result'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-result" data-rule="required" class="form-control form-control" name="row[result]" type="number" value="<?php echo $row['result']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Paytime'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-paytime" data-rule="required" class="form-control datetimepicker form-control" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[paytime]" type="text" value="<?php echo datetime($row['paytime']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Peitime'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-peitime" data-rule="required" class="form-control datetimepicker form-control" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[peitime]" type="text" value="<?php echo datetime($row['peitime']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Onlinetixiantime'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-onlinetixiantime" data-rule="required" class="form-control datetimepicker form-control" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[onlinetixiantime]" type="text" value="<?php echo datetime($row['onlinetixiantime']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Award'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-award" data-rule="required" class="form-control form-control" name="row[award]" type="number" value="<?php echo $row['award']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Awardok'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-awardok" data-rule="required" class="form-control form-control" name="row[awardok]" type="number" value="<?php echo $row['awardok']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Acount'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-acount" data-rule="required" class="form-control form-control" name="row[acount]" type="number" value="<?php echo $row['acount']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Xcount'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-xcount" data-rule="required" class="form-control form-control" name="row[xcount]" type="number" value="<?php echo $row['xcount']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Xxcount'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-xxcount" data-rule="required" class="form-control form-control" name="row[xxcount]" type="number" value="<?php echo $row['xxcount']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Xxxcount'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-xxxcount" data-rule="required" class="form-control form-control" name="row[xxxcount]" type="number" value="<?php echo $row['xxxcount']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Xxxxcount'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-xxxxcount" data-rule="required" class="form-control form-control" name="row[xxxxcount]" type="number" value="<?php echo $row['xxxxcount']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Awardtime'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-awardtime" data-rule="required" class="form-control datetimepicker form-control" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[awardtime]" type="text" value="<?php echo datetime($row['awardtime']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-status" data-rule="required" class="form-control form-control" name="row[status]" type="number" value="<?php echo $row['status']; ?>">
        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>