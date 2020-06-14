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
        <form method = "post" action = "<?php echo  __URL__;?>/multi" id="showtable">
            <input type = "hidden" name = "method" />
            <div class = "pt-list-header">
                <div class = "pt-list-operate f-fl">
                    <a class = "btn btn-success btn-sm" href = '<?php echo  __URL__;?>/add'>添加</a>
                    <input type = "submit" class = "btn btn-primary btn-sm btn-checkbox" value = "禁用" name = "forbidden">
                    <input type = "submit" class = "btn btn-primary btn-sm btn-checkbox" value = "恢复" name = "recover">
                    <input type = "submit" class = "btn btn-danger btn-sm btn-checkbox" value = "删除" name = "mdel">
                </div>
                <div class = "f-fr">
                    <input ng-model = 'keyword' class = "input-text w160" type = "text" onkeypress="if(event.keyCode==13) {return false;}"/>
                    <input type = "button" class = "btn btn-default btn-sm" value = "搜索" />
                </div>
                <div class = "f-clear"></div>
            </div>
            <table class = "pt-list-table">
                <thead>
                <tr>
                    <th class = "w-checkbox"><input type = "checkbox" class = "checkall" data = "id[]" ></th>
                    <th class = "f-tal" style = "width:20px">ID</th>
                    <th class = "f-tal" style = "width:150px">站点名称</th>
                    <th class = "f-tal">站点地址</th>
                    <th style="width:120px">站点key</th>
                    <th class = "w-word3">权重</th>
                    <th class = "w-word4">IP控制</th>
                    <th class = "w-word5">站点类型</th>
                    <th class = "w-word5">状态</th>
                    <th class = "operate w-operate2">操作</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat = "loop in lists | filter:keyword">
                    <td><input type = "checkbox" name = "id[]" value = "{{loop.id}}"></td>
                    <td class = "f-tal">{{loop.id}}</td>
                    <td class = "f-tal">{{loop.name}}</td>
                    <td class = "f-tal">{{loop.url}}</td>
                    <td>{{loop.key}}</td>
                    <td>{{loop.weight}}</td>
                    <td>{{loop.ip}}</td>
                    <td>
                        <span class = "c-orange" ng-if = "loop.isoriginal==0">转载</span>
                        <span class = "c-green" ng-if = "loop.isoriginal==1">原创</span>
                    </td>
                    <td>
                        <span class = "label label-warning" ng-if = "loop.status==0" ng-click = "changestatus($index,1)">禁用</span>
                        <span class = "label label-success" ng-if = "loop.status==1" ng-click = "changestatus($index,0)">正常</span>
                    </td>
                    <td class = "operate">
                        <a ng-href = "{{loop.url_edit}}"><i class = "icon icon-edit"></i>编辑</a>
                        <a href = "javascript:;" ng-click = "del(loop.id,$index)"><i class = "icon icon-trash"></i>删除</a>
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
