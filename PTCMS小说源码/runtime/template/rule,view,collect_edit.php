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
    <div class="pt-set-wrap" ng-app="ptcms">
    <form action="<?php echo __SELF__;?>" method="post" enctype="multipart/form-data" class="vform" ng-controller="rule" onsubmit="return false;">
        <h4 class="pt-msg-title"><b class="f-fl">规则信息</b></h4>
        <div class="pt-set-box">
            <div class="pt-set-content">
                <div class="pt-set-info">
                    <div class="line">
                        <b>规则名称：</b>
                        <label><input ng-model="rule.name" type="text" value="" class="input-text w640" datatype="*" /></label>
                    </div>
                </div>
                <div class="pt-set-info">
                    <div class="line">
                        <b>所属站点：</b>
                        <label>
                            <select class="input-box w640" ng-model="rule.siteid">
                                <option value="">请选择站点</option>
                                <?php if(is_array($sitelist)): foreach($sitelist as $key =>$loop):?>
                                <option value="<?php echo $loop['id'];?>"><?php echo $loop['name'];?></option>
                                <?php endforeach; endif;?>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="pt-set-info">
                    <div class="line">
                        <b>跳过始章：</b>
                        <label><input ng-model="rule.discardstartnum" type="text" value="" class="input-text w150" datatype="*" /></label>
                        <span class="Validform_checktip">在目录页跳过最初的几个章节</span>
                    </div>
                </div>
                <div class="pt-set-info">
                    <div class="line">
                        <b>跳过尾章：</b>
                        <label><input ng-model="rule.discardendnum" type="text" value="" class="input-text w150" datatype="*" /></label>
                        <span class="Validform_checktip">在目录页跳过末尾的几个章节</span>
                    </div>
                </div>
                <div class="pt-set-info">
                    <div class="line">
                        <b>选项设置：</b>
                        <div class="pt-set-area">
                            <label><input type="checkbox" ng-model="rule.addnew" ng-true-value="'1'" ng-false-value="'0'" />添加新书</label>
                            <label><input type="checkbox" ng-model="rule.newreplace" ng-true-value="'1'" ng-false-value="'0'" />更新其他站点采集到的小说信息</label>
                            <label><input type="checkbox" ng-model="rule.collectallchapter" ng-true-value="'1'" ng-false-value="'0'" />老章节入库(不选之入库最新章节)</label>
                            <label><input type="checkbox" ng-model="rule.dirsort" ng-true-value="'1'" ng-false-value="'0'" />章节目录乱序处理</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h4 class="pt-msg-title"><b class="f-fl">采集地址</b></h4>
        <div class="pt-set-box">
            <div class="pt-set-content">
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleurl",'rulename'=>"列表页地址",'rulekey'=>"url_list",'ruletype'=>0));?>
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleurl",'rulename'=>"信息页地址",'rulekey'=>"url_info",'ruletype'=>0));?>
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleurl",'rulename'=>"目录页地址",'rulekey'=>"url_dir",'ruletype'=>0));?>
            </div>
        </div>
        <h4 class="pt-msg-title"><b class="f-fl">更新列表规则</b></h4>
        <div class="pt-set-box">
            <div class="pt-set-content">
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleitem",'rulename'=>"小说名称",'rulekey'=>"list_novelname"));?>
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleitem",'rulename'=>"小说书号",'rulekey'=>"list_novelid"));?>
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleitem",'rulename'=>"更新标识",'rulekey'=>"list_lastid"));?>
            </div>
        </div>
        <h4 class="pt-msg-title"><b class="f-fl">信息页规则</b></h4>
        <div class="pt-set-box">
            <div class="pt-set-content">
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleitem",'rulename'=>"小说名称",'rulekey'=>"info_novelname"));?>
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleitem",'rulename'=>"小说作者",'rulekey'=>"info_author"));?>
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleitem",'rulename'=>"小说简介",'rulekey'=>"info_intro"));?>
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleitem",'rulename'=>"小说封面",'rulekey'=>"info_cover"));?>
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleitem",'rulename'=>"小说分类",'rulekey'=>"info_category"));?>
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleitem",'rulename'=>"小说进度",'rulekey'=>"info_isover"));?>
            </div>
        </div>
        <h4 class="pt-msg-title"><b class="f-fl">目录页规则</b></h4>
        <div class="pt-set-box">
            <div class="pt-set-content">
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleitem",'rulename'=>"章节ID",'rulekey'=>"dir_chapterid"));?>
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleitem",'rulename'=>"章节名称",'rulekey'=>"dir_chaptername"));?>
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleurl",'rulename'=>"章节地址",'rulekey'=>"dir_chapterurl",'ruletype'=>1));?>
            </div>
        </div>
        <h4 class="pt-msg-title"><b class="f-fl">章节页规则</b></h4>
        <div class="pt-set-box">
            <div class="pt-set-content">
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleurl",'rulename'=>"接口URL",'rulekey'=>"chapter_api",'ruletype'=>0,'ruledesc'=>"当使用外接接口时填写,[url]表示当前章节地址"));?>
                <?php echo $this->pt->block->getdata('',array('template'=>"block_ruleitem",'rulename'=>"内容规则",'rulekey'=>"chapter_content"));?>
            </div>
        </div>
        <div class="pt-tab-button">
            <div class="pt-set-info">
                <div class="line">
                    <b></b>
                    <input class="btn btn-success" type="button" value=" 修改规则 " ng-click="submitform()" />&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
        <div class="pt-pop f-dn errorbox">
            <div class="pt-set-content">
                <div class="pt-set-info">
                    <label>
                        <label><textarea class="input-box w450" ng-model="errorsign"></textarea></label>
                    </label>
                </div>
                <div class="pt-set-info f-tac">
                    <span class="btn btn-primary" ng-click="doerror()">确定</span>
                    <span class="btn btn-default" onclick="layer.closeAll()">取消</span>
                </div>
            </div>
        </div>
        <div class="pt-pop f-dn replacebox">
            <div class="pt-set-content">
                <div class="pt-set-info">
                    <b>要替换的内容：</b>
                    <label>
                        <label><textarea class="input-box w450" ng-model="replaceinfo.search"></textarea></label>
                    </label>
                </div>
                <div class="pt-set-info">
                    <b>替换后：</b>
                    <label>
                        <label><textarea class="input-box w450" ng-model="replaceinfo.replace"></textarea></label>
                    </label>
                </div>
                <div class="pt-set-info">
                    <b>替换参数：</b>
                    <label>
                        <label><input type="checkbox" ng-model="replaceinfo.type" ng-true-value="'1'" />正则模式</label>
                        <label><input type="checkbox" ng-model="replaceinfo.ignorecase" ng-true-value="'1'" />不区分大小写</label>
                        <label><input type="checkbox" ng-model="replaceinfo.singleline" ng-true-value="'1'" />单行模式</label>
                    </label>
                </div>
                <div class="pt-set-info f-tac">
                    <span class="btn btn-primary" ng-click="doreplace(replaceinfo)">确定</span>
                    <span class="btn btn-default" onclick="layer.closeAll()">取消</span>
                </div>
            </div>
        </div>
    </form>
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

<script type="text/javascript">
    function getrule() {
        var rule = [];
        $.ajax({
            url: '<?php echo  __URL__;?>/ajax/id/<?php echo $id;?>',
            type: 'POST',
            dataType: 'json',
            async: false,
            success: function (res) {
                rule = res;
            }
        });
        return rule;
    }
</script>
<script type="text/javascript">
    ptng.controller('rule', function ($scope, $http,$window) {
        $scope.replaceinfo = {};
        $scope.replace = [];
        $scope.rule = getrule();
        var p='';
        //显示错误修改框
        $scope.showerror = function (k) {
            p=k;
            $scope.errorsign = $scope.rule[p].error;
            $.admin.tool.tipbox('.errorbox', '页面错误标识');
        };
        // 提交错误修改
        $scope.doerror = function () {
            $scope.rule[p].error=$scope.errorsign;
            layer.closeAll();
        };
        $scope.showreplace = function (k) {
            p=k;
            $scope.replace[k]=1;
        };
        $scope.hidereplace = function (k) {
            p=k;
            $scope.replace[k]=0
        };
        $scope.editreplace=function(t,k){
            p=t;
            $scope.replaceinfo=[];
            $scope.replaceinfo=angular.copy($scope.rule[p].replace[k]);
            $scope.replaceid=k;
            $.admin.tool.tipbox('.replacebox', '修改替换规则');
        };
        //添加内容
        $scope.addreplace=function(k){
            p=k;
            $scope.replaceinfo={};
            $scope.replaceid='';
            $.admin.tool.tipbox('.replacebox', '添加替换规则');
        };
        $scope.doreplace=function(replaceinfo){
            //替换前的必填
            if (!replaceinfo.search){
                alert('请输入要替换的内容');
                return false;
            }
            if ($scope.replaceid===''){
                $scope.rule[p].replace.push(replaceinfo);
            }else{
                $scope.rule[p].replace[$scope.replaceid]=replaceinfo;
            }
            layer.closeAll();
        };
        $scope.delreplace=function(t,k){
            $scope.rule[t].replace.splice(k, 1);
        };
        //提交表单
        $scope.submitform = function () {
            if (!$scope.rule.name){
                alert('请输入规则名称');
                return false;
            }
            if (!$scope.rule.siteid){
                alert('请选择站点');
                return false;
            }
            if (!$scope.rule.url_list.rule){
                alert('请输入列表页url');
                return false;
            }
            if (!$scope.rule.url_info.rule){
                alert('请输入信息页url');
                return false;
            }
            if (!$scope.rule.url_dir.rule){
                alert('请输入目录页url');
                return false;
            }
            if (!$scope.rule.list_novelid.rule){
                alert('请输入列表页小说书号规则');
                return false;
            }
            if (!$scope.rule.list_novelname.rule){
                alert('请输入列表页小说书名规则');
                return false;
            }
            if (!$scope.rule.list_lastid.rule){
                alert('请输入列表页更新标识规则');
                return false;
            }
            if (!$scope.rule.info_novelname.rule){
                alert('请输入信息页书名规则');
                return false;
            }
            if (!$scope.rule.info_author.rule){
                alert('请输入信息页作者规则');
                return false;
            }
            if (!$scope.rule.info_cover.rule){
                alert('请输入信息页封面规则');
                return false;
            }
            if (!$scope.rule.info_intro.rule){
                alert('请输入信息页简介规则');
                return false;
            }
            if (!$scope.rule.info_category.rule){
                alert('请输入信息页分类规则');
                return false;
            }

            if (!$scope.rule.dir_chaptername.rule){
                alert('请输入章节名称规则');
                return false;
            }
            if (!$scope.rule.dir_chapterurl.rule){
                alert('请输入章节地址规则');
                return false;
            }
            if (!$scope.rule.dir_chapterid.rule){
                alert('请输入章节ID规则');
                return false;
            }
            if (!$scope.rule.chapter_content.rule){
                alert('请输入章节内容规则');
                return false;
            }
            //console.log($scope.rule);return false;
            $http.post($('form').attr('action'),$scope.rule).success(function(res){
                if (res.status){
                    alert(res.info);
                    window.location.href=res.url;
                }else{
                    alert(res.info);
                }
            });
        };
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
