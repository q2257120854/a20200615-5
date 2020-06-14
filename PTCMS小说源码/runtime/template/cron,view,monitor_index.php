<?php defined('PT_ROOT') || exit('Permission denied');?><!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8" />
    <title>管理中心 - <?php echo PRONAME;?></title>
    <link rel = "stylesheet" href = "<?php echo PT_DIR;?>/application/admin/view/css/admin.css" />
    <meta name = "keywords" content = "" />
    <meta name = "description" content = "" />
    <meta name = "viewport" content = "width=device-width" />
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <script type = "text/javascript" src = "<?php echo PT_DIR;?>/public/script/jquery.min.js"></script>
    <script type = "text/javascript" src = "<?php echo PT_DIR;?>/application/admin/view/script/admin.js"></script>
    <script type = "text/javascript" src = "<?php echo PT_DIR;?>/public/plugin/layer/layer.js"></script>
    <script type = "text/javascript" src = "<?php echo PT_DIR;?>/public/script/jquery.validform.js"></script>
    <script type = "text/javascript">
        var URL = '<?php echo  __URL__;?>', APP = '<?php echo __APP__;?>', MODULE = '<?php echo __MODULE__;?>', SELF = '<?php echo __SELF__;?>', MODULE_NAME = '<?php echo MODULE_NAME;?>', CONTROLLER_NAME = '<?php echo CONTROLLER_NAME;?>', ACTION_NAME = '<?php echo ACTION_NAME;?>';
    </script>
</head>
<body>
<div class = "pt-main-wrap">
    <div class = "pt-path">
        <span class = "pt-path-icon icon-home"></span>当前位置：
        <a href="http://www.360xiankan.com" target="_blank"><?php echo PRONAME;?></a>
        <span> &gt; </span><a href="<?php echo $menuinfo['menu']['url'];?>"><?php echo $menuinfo['menu']['name'];?></a>
        <?php if(isset($menuinfo['submenu']['name'])):?>
        <span> &gt; </span><?php echo $menuinfo['submenu']['name'];?>
        <?php endif;?>
    </div>
    <div class="pt-table-wrap" ng-app="ptcms">
    <h4 class="pt-msg-title"><b class="f-fl"><?php echo $menuinfo['menu']['name'];?></b></h4>
    <div class="pt-list" ng-controller="showlist">
        <form method="post" action="<?php echo U("cron.manage.power",array());?>" id="showtable">
            <input type="hidden" name="method" />
            <div class="pt-list-header">
                <div class="pt-list-operate f-fl">
                    <?php if($this->pt->config->get("cron_power")):?>
                    <button type="submit" class="btn btn-danger btn-sm btn-checkbox" name="stop"><span class="icon icon-stop"></span> 停止总进程</button>
                    <?php else:?>
                    <button type="submit" class="btn btn-success btn-sm btn-checkbox" name="start"><span class="icon icon-play"></span> 启动总进程</button>
                    <?php endif;?>
                </div>
                <div class="f-fr">主任务运行时间：{{ now }}</div>
                <div class="f-clear"></div>
            </div>
            <table class="pt-list-table">
                <thead>
                <tr>
                    <th class="w-checkbox"><input type="checkbox" class="checkall" data="id[]"></th>
                    <th style="width:200px;">任务名</th>
                    <th>运行状态</th>
                    <th class="w-fulltime">运行时间</th>
                    <th class="w-fulltime">启动时间</th>
                    <th class="w-fulltime">检查时间</th>
                    <th class="w-word4">状态</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="loop in lists">
                    <td><input type="checkbox" name="id[]" value="{{loop.id}}"></td>
                    <td class="f-tal">{{loop.name}}</td>
                    <td class="f-tal">{{loop.info}}</td>
                    <td>{{loop.last}}秒</td>
                    <td>{{loop.starttime}}</td>
                    <td>{{loop.lastruntime}}</td>
                    <td>
                        <span class="label label-warning" ng-if="loop.status==0" ng-click="changestatus($index,1)">已经停止</span>
                        <span class="label label-success" ng-if="loop.status==1" ng-click="changestatus($index,0)">正常运行</span>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="pt-list-footer">
                <div class="pt-list-operate f-fl">
                </div>
                <div class="f-clear"></div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="<?php echo PT_DIR;?>/public/script/angular.min.js"></script>
<script type="text/javascript" src="<?php echo PT_DIR;?>/public/script/angular.init.js"></script>
<script type="text/javascript">
    ptng.controller('showlist', function ($scope, $http) {
        $scope.lists = {};
        $scope.now = '';
        $scope.changestatus = function (id, value) {
            var param = {
                'changestatus': '修改状态',
                'id[]': $scope.lists[id].id,
                'value[]': value
            };
            $http.post('<?php echo  __URL__;?>/multi', param).success(function (res) {
                if (res.status == 1) {
                    $scope.lists[id].status = value;
                } else {
                    alert(res.info);
                }
            });
        };
        $scope.getlist = function () {
            $http.post('<?php echo  __URL__;?>/index').success(function (res) {
                $scope.lists = res.data;
                $scope.now = res.now;
                setTimeout($scope.getlist, 1000);
            });
        };
        $scope.getlist();
    });
</script>

    <div class = "f-clear"></div>
</div>
<div class="footinfo"><?php echo $this->pt->response->runinfo();?></div>
<div style = "display: none">
    <script language = "javascript" type = "text/javascript" src = "<?php echo PT_DIR;?>/application/admin/view/script/tongji.js"></script>
</div>
<script type = "text/javascript">
    $(function(){
        //设置高度
        var h1=$(document).height(),h2=$('.pt-main-wrap').height();
        if (h2+60<h1){
            $('.pt-main-wrap').height(h1-60)
        }
    })
</script>
</body>
</html>
