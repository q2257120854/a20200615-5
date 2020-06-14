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
    <h4 class = "pt-msg-title"><b class = "f-fl">友情链接管理</b></h4>
    <div class = "pt-list" ng-controller = "showlist">
        <form method = "post" action = "<?php echo  __URL__;?>/multi" id="showtable">
            <input type = "hidden" name = "method" />
            <div class = "pt-list-header">
                <div class = "pt-list-operate f-fl">
                    <a class = "btn btn-success btn-sm" href = '<?php echo  __URL__;?>/add'>添加</a>
                    <input type = "submit" class = "btn btn-primary btn-sm btn-checkbox" value = "排序" name = "reorder">
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
                    <th style="width:150px">链接名称</th>
                    <th>链接地址</th>
                    <th class = "w-word3">排序</th>
                    <th class = "w-word5">创建人</th>
                    <th class = "w-time">创建时间</th>
                    <th class = "w-word5">修改人</th>
                    <th class = "w-time">修改时间</th>
                    <th class = "w-word3">状态</th>
                    <th class = "operate w-operate2">操作</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat = "loop in lists | filter:keyword">
                    <td><input type = "checkbox" name = "id[]" value = "{{loop.id}}"></td>
                    <td class = "f-tal"><a ng-href="{{loop.url}}" title="{{loop.description}}" ng-bind-html="loop.showname | to_trusted"></a></td>
                    <td class = "f-tal f-cut">{{loop.url}}</td>
                    <td>
                        <input type = "text" name = "ordernum[{{loop.id}}]" value = " {{loop.ordernum}}" class = "input-text f-tac" style = "width:40px;"  onkeypress="if(event.keyCode==13) {return false;}"/>
                    </td>
                    <td>{{loop.create_username}}</td>
                    <td>{{loop.create_time}}</td>
                    <td>{{loop.update_username}}</td>
                    <td>{{loop.update_time}}</td>
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
