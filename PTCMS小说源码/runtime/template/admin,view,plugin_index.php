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
    <div class = "pt-table-wrap" ng-app = "ptcms">
    <h4 class = "pt-msg-title"><b class = "f-fl"><?php echo $menuinfo['menu']['name'];?></b></h4>
    <div class = "pt-list" ng-controller = "showlist">
        <form method = "post" action = "<?php echo  __URL__;?>/multi" id = "showtable">
            <input type = "hidden" name = "method" />
            <div class = "pt-list-header">
                <div class = "pt-list-operate f-fl">
                </div>
                <div class = "f-fr">
                    <input ng-model = 'keyword' class = "input-text w160" type = "text" onkeypress = "if(event.keyCode==13) {return false;}" />
                    <input type = "button" class = "btn btn-default btn-sm" value = "搜索" />
                </div>
                <div class = "f-clear"></div>
            </div>
            <table class = "pt-list-table">
                <thead>
                <tr>
                    <th class = "f-tal" style = "width:150px">模块名称</th>
                    <th class = "f-tal">模块信息</th>
                    <th class = "w-word5">模块作者</th>
                    <th class = "w-word5">模块版本</th>
                    <th class = "w-word3">状态</th>
                    <th class = "operate w-operate2">操作</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat = "loop in lists | filter:keyword">
                    <td class = "f-tal">{{loop.name}}</td>
                    <td class = "f-tal">{{loop.desc}}</td>
                    <td>{{loop.author}}</td>
                    <td>{{loop.version}}</td>
                    <td>
                        <span class = "label label-warning" ng-if = "loop.setup==0">未安装</span>
                        <span class = "label label-success" ng-if = "loop.setup==1">已安装</span>
                    </td>
                    <td class = "operate">
                        <a ng-if = "loop.setup==0" ng-href = "{{loop.url_install}}"><i class = "icon icon-save"></i>安装</a>
                        <a ng-if = "loop.setup==1" onclick = "uninstall(this)" data-url = "{{loop.url_uninstall}}"><i class = "icon icon-open"></i>卸载</a>
                        <a ng-href = "{{loop.url_config}}"><i class = "icon icon-edit"></i>设置</a>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class = "pt-list-footer">
                <div class = "pt-list-operate f-fl"></div>
                <div class = "f-clear"></div>
            </div>
        </form>
    </div>
</div>
<script type = "text/javascript" src = "<?php echo PT_DIR;?>/public/script/angular.min.js"></script>
<script type = "text/javascript" src = "<?php echo PT_DIR;?>/public/script/angular.init.js"></script>
<script type = "text/javascript">
    ptng.controller('showlist',function($scope, $http) {
        try{
            $scope.lists = JSON.parse('<?php echo json_encode($list,JSON_UNESCAPED_UNICODE);?>');
        }catch(e){
            try{
                $scope.lists = eval('<?php echo json_encode($list,JSON_UNESCAPED_UNICODE);?>');
            }catch(ee){
                $scope.lists = {};
            }
        }
        $scope.keywords='';
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
        $scope.del = function (id,key) {
            if (confirm('确认删除么？')) {
                var param={'id':id};
                $http.post('<?php echo  __URL__;?>/del', param).success(function (res) {
                    if (res.status == 1) {
                        $scope.lists.splice(key, 1);
                    } else {
                        alert(res.info);
                    }
                });
            }
        };
        $scope.getlist=function(){
            var param = {
                'searchtype': $('.searchtype option:selected').val(),
                'searchkey': $('.searchkey').val(),
                'page': $scope.page
            };
            $http.post('<?php echo  __URL__;?>/index', param).success(function (res) {
                $scope.lists=res.data;
                $scope.totalnum=res.totalnum;
                $scope.pagenum=res.pagenum;
            });
        };
        <?php if(!empty($page)):?>
            $scope.page='<?php echo $page;?>';
            $scope.totalnum='<?php echo $totalnum;?>';
            $scope.pagenum='<?php echo $pagenum;?>';
            $scope.gopage=function(n){
                if (n=='+1'){
                    if ($scope.page<$scope.pagenum) $scope.page++;
                }else if (n=='-1'){
                    if ($scope.page>1) $scope.page--;
                }else if (n=='input'){
                    n=parseInt($('.pageinput').val());
                    if (n>$scope.pagenum){
                        $scope.page=$scope.pagenum;
                    }else if (n<1){
                        $scope.page=1;
                    }else if (n>0){
                        $scope.page=n;
                    }else{
                        $scope.page=1;
                    }
                }else{
                    $scope.page=n;
                }
            }
            $scope.$watch('page',$scope.getlist);
        <?php endif;?>
    });
    $(function(){
        $('.pt-list-footer .pt-list-operate').html($('.pt-list-header .pt-list-operate').html());
        $('.btn-checkbox').on('click',function(e){
            e.preventDefault();
            $('input[name=method]').val($(this).attr('name'));
            checkselt('id[]','#showtable');
        })
        $('.btn-all').on('click',function(e){
            e.preventDefault();
            $('input[name=method]').val($(this).attr('name'));
            $('#showtable').submit();
        })
    })
</script>

<script type = "text/javascript">
    function uninstall(o) {
        var url = $(o).data('url');
        if (confirm('您是否要卸载该插件')) {
            window.location.href = url ;
        }
    }
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
