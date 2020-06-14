<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:62:"/www/wwwroot/tiaoshi.com/application/admin/view/role/info.html";i:1552720680;s:64:"/www/wwwroot/tiaoshi.com/application/admin/view/public/head.html";i:1552720680;s:66:"/www/wwwroot/tiaoshi.com/application/admin/view/public/editor.html";i:1552720680;s:64:"/www/wwwroot/tiaoshi.com/application/admin/view/public/foot.html";i:1552720680;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $title; ?> - 苹果CMS</title>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/css/admin_style.css">
    <script type="text/javascript" src="/static/js/jquery.js"></script>
    <script type="text/javascript" src="/static/layui/layui.js"></script>
    <script>
        var ROOT_PATH="",ADMIN_PATH="<?php echo $_SERVER['SCRIPT_NAME']; ?>", MAC_VERSION='v10';
    </script>
</head>
<body>
<script type="text/javascript" src="/static/js/jquery.jscolor.js"></script>
<?php 
$editor=$GLOBALS['config']['app']['editor'];
$ue_old= ROOT_PATH . 'static/ueditor/' ;
$ue_new= ROOT_PATH . 'static/editor/'. $editor ;
if( (!file_exists($ue_new) && file_exists($ue_old)) || $editor=='' ){
    $editor = 'ueditor';
}
 if($editor == 'ueditor'): ?>
<script type="text/javascript" src="/static/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/static/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript">
    window.UEDITOR_CONFIG.serverUrl = "<?php echo url('upload/upload'); ?>?from=ueditor&flag=role_editor&input=upfile";
    var EDITOR = UE;
</script>
<?php elseif($editor == 'umeditor'): ?>
<link rel="stylesheet" href="/static/editor/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/static/editor/umeditor/umeditor.config.js"></script>
<script type="text/javascript" src="/static/editor/umeditor/umeditor.min.js"></script>
<script type="text/javascript">
    window.UMEDITOR_CONFIG.imageUrl = "<?php echo url('upload/upload'); ?>?from=umeditor&flag=role_editor&input=upfile";
    var EDITOR = UM;
</script>
<?php elseif($editor == 'kindeditor'): ?>
<script type="text/javascript" src="/static/editor/kindeditor/kindeditor-all-min.js"></script>
<script type="text/javascript">
    var EDITOR = KindEditor;
</script>
<?php elseif($editor == 'ckeditor'): ?>
<script type="text/javascript" src="/static/editor/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    var EDITOR = CKEDITOR;
</script>
<?php endif; ?>
<script>
    var editor = "<?php echo $editor; ?>";
    function editor_getEditor(obj)
    {
        var res;
        switch(editor){
            case "kindeditor":
                res = KindEditor.create('#'+obj, { uploadJson:"<?php echo url('upload/upload'); ?>?from=kindeditor&flag=role_editor&input=imgFile" , allowFileManager : false });
                break;
            case "ckeditor":
                res = CKEDITOR.replace(obj,{filebrowserImageUploadUrl:"<?php echo url('upload/upload'); ?>?from=ckeditor&flag=role_editor&input=upload"});
                break;
            default:
                res = EDITOR.getEditor(obj);
                break;
        }
        return res;
    }
    function editor_setContent(obj,html) {
        var res;
        switch(editor){
            case "kindeditor":
                res = obj.html(html);
                break;
            case "ckeditor":
                res = obj.setData(html);
                break;
            default:
                res = obj.setContent(html);
                break;
        }
        return res;
    }
    function editor_getContent(obj) {
        var res;
        switch(editor){
            case "kindeditor":
                res = obj.html();
                break;
            case "ckeditor":
                res = obj.getData();
                break;
            default:
                res = obj.getContent();
                break;
        }
        return res;
    }
</script>
<div class="page-container p10">
    <div class="showpic" style="display:none;"><img class="showpic_img" width="120" height="160"></div>
    
    <form class="layui-form layui-form-pane" method="post" action="">
        <input type="hidden" name="role_id" value="<?php echo $info['role_id']; ?>">

        <div class="layui-tab">
            <ul class="layui-tab-title ">
                <li class="layui-this">基本信息</a></li>
                <li>其他信息</li>
            </ul>
            <div class="layui-tab-content">

                <div class="layui-tab-item layui-show">
                    
                <div class="layui-form-item">
                    <label class="layui-form-label">参数：</label>
                    <div class="layui-input-inline w150">
                            <select name="role_level">
                                <option value="0">请选择推荐</option>
                                <option value="9" <?php if($info['role_level'] == 9): ?>selected<?php endif; ?>>推荐9-幻灯</option>
                                <option value="1" <?php if($info['role_level'] == 1): ?>selected<?php endif; ?>>推荐1</option>
                                <option value="2" <?php if($info['role_level'] == 2): ?>selected<?php endif; ?>>推荐2</option>
                                <option value="3" <?php if($info['role_level'] == 3): ?>selected<?php endif; ?>>推荐3</option>
                                <option value="4" <?php if($info['role_level'] == 4): ?>selected<?php endif; ?>>推荐4</option>
                                <option value="5" <?php if($info['role_level'] == 5): ?>selected<?php endif; ?>>推荐5</option>
                                <option value="6" <?php if($info['role_level'] == 6): ?>selected<?php endif; ?>>推荐6</option>
                                <option value="7" <?php if($info['role_level'] == 7): ?>selected<?php endif; ?>>推荐7</option>
                                <option value="8" <?php if($info['role_level'] == 8): ?>selected<?php endif; ?>>推荐8</option>

                            </select>
                    </div>
                    <div class="layui-input-inline w150">
                            <select name="role_status">
                                <option value="1">已审核</option>
                                <option value="0" <?php if($info['role_status'] == '0'): ?>selected<?php endif; ?>>未审核</option>
                            </select>
                    </div>
                    <div class="layui-input-inline w150">
                        <select name="role_lock">
                            <option value="0">未锁</option>
                            <option value="1" <?php if($info['role_lock'] == 1): ?>selected<?php endif; ?>>锁定</option>
                        </select>
                    </div>

                    <div class="layui-input-inline">
                        <input type="checkbox" name="uptime" title="更新时间" value="1" checked class="layui-checkbox checkbox-ids" lay-skin="primary">
                    </div>
                </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">视频名称：</label>
                        <div class="layui-input-inline w400">
                            <input type="text" class="layui-input" value="<?php echo $data['vod_name']; ?>" readonly="readonly" placeholder="" name="">
                        </div>
                        <label class="layui-form-label">视频ID：</label>
                        <div class="layui-input-inline w70">
                            <input type="text" class="layui-input" value="<?php echo $info['role_rid']; ?>" readonly="readonly" placeholder="" name="role_rid">
                        </div>
                        <label class="layui-form-label">视频分类：</label>
                        <div class="layui-input-inline w70">
                            <input type="text" class="layui-input" value="<?php echo $data['type']['type_name']; ?>" readonly="readonly" placeholder="" name="">
                        </div>
                    </div>


                <div class="layui-form-item">
                    <label class="layui-form-label">角色名：</label>
                    <div class="layui-input-inline w200">
                        <input type="text" class="layui-input" value="<?php echo $info['role_name']; ?>" placeholder="请输入" name="role_name">
                    </div>
                    <label class="layui-form-label">演员名：</label>
                    <div class="layui-input-inline w200">
                        <input type="text" class="layui-input" value="<?php echo $info['role_actor']; ?>" placeholder="请输入" name="role_actor">
                    </div>
                    <label class="layui-form-label">排序：</label>
                    <div class="layui-input-inline w200">
                        <input type="text" class="layui-input" value="<?php echo $info['role_sort']; ?>" placeholder="请输入" name="role_sort">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">拼音：</label>
                    <div class="layui-input-inline w200">
                        <input type="text" class="layui-input" value="<?php echo $info['role_en']; ?>" placeholder="" name="role_en">
                    </div>
                    <label class="layui-form-label">首字母：</label>
                    <div class="layui-input-inline w200">
                        <input type="text" class="layui-input" value="<?php echo $info['role_letter']; ?>" placeholder="" name="role_letter">
                    </div>
                    <label class="layui-form-label">高亮：</label>
                    <div class="layui-input-inline w200">
                        <input type="text" class="layui-input color" value="<?php echo $info['role_color']; ?>" placeholder="" name="role_color">
                    </div>
                </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">备注：</label>
                        <div class="layui-input-inline w400">
                            <input type="text" class="layui-input" value="<?php echo $info['role_remarks']; ?>" placeholder="" name="role_remarks">
                        </div>
                    </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">图片：</label>
                    <div class="layui-input-inline w400 upload">
                        <input type="text" class="layui-input upload-input" style="max-width:100%;" value="<?php echo $info['role_pic']; ?>" placeholder="" id="role_pic" name="role_pic">
                    </div>
                    <div class="layui-input-inline ">
                        <button type="button" class="layui-btn layui-upload" lay-data="" id="upload1">上传图片</button>
                    </div>
                </div>


                    <div class="layui-form-item">
                        <label class="layui-form-label">介绍：</label>
                        <div class="layui-input-block">
                            <textarea id="role_content" name="role_content" type="text/plain" style="width:99%;height:300px"><?php echo mac_url_content_img($info['role_content']); ?></textarea>
                        </div>
                    </div>
                    
        </div>


                    <div class="layui-tab-item">
                        <div class="layui-form-item">
                            <label class="layui-form-label">顶数量：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['role_up']; ?>" placeholder="" id="role_up" name="role_up">
                            </div>
                            <label class="layui-form-label">踩数量：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['role_down']; ?>" placeholder="" id="role_down" name="role_down">
                            </div>
                            <button class="layui-btn" type="button" id="btn_rnd">随机生成</button>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">总人气：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['role_hits']; ?>" placeholder="" id="role_hits" name="role_hits">
                            </div>
                            <label class="layui-form-label">月人气：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['role_hits_month']; ?>" placeholder="" id="role_hits_month" name="role_hits_month" >
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">周人气：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['role_hits_week']; ?>" placeholder="" id="role_hits_week" name="role_hits_week">
                            </div>
                            <label class="layui-form-label">日人气：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input " value="<?php echo $info['role_hits_day']; ?>" placeholder="" id="role_hits_day" name="role_hits_day">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">平均分：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['role_score']; ?>" placeholder="" id="role_score" name="role_score">
                            </div>
                            <label class="layui-form-label">总评分：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['role_score_all']; ?>" placeholder="" id="role_score_all" name="role_score_all">
                            </div>
                            <label class="layui-form-label">总评次：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['role_score_num']; ?>" placeholder="" id="role_score_num" name="role_score_num">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">独立模板：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['role_tpl']; ?>" placeholder="" name="role_tpl">
                            </div>
                            <label class="layui-form-label">跳转URL：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['role_jumpurl']; ?>" placeholder="" name="role_jumpurl">
                            </div>
                        </div>
                    </div>
            </div>
        </div>

                <div class="layui-form-item center">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formSubmit" data-child="">保 存</button>
                        <button class="layui-btn layui-btn-warm" type="reset">还 原</button>
                    </div>
                </div>
    </form>

</div>
<script type="text/javascript" src="/static/js/admin_common.js"></script>

<script type="text/javascript">

    layui.use(['form','upload', 'layer'], function () {
        // 操作对象
        var form = layui.form
                , layer = layui.layer
                , $ = layui.jquery
                , upload = layui.upload;;

        // 验证
        form.verify({
            role_name: function (value) {
                if (value == "") {
                    return "请输入名称";
                }
            }
        });

        upload.render({
            elem: '.layui-upload'
            ,url: "<?php echo url('upload/upload'); ?>?flag=role"
            ,method: 'post'
            ,before: function(input) {
                layer.msg('文件上传中...', {time:3000000});
            },done: function(res, index, upload) {
                var obj = this.item;
                if (res.code == 0) {
                    layer.msg(res.msg);
                    return false;
                }
                layer.closeAll();
                var input = $(obj).parent().parent().find('.upload-input');
                if ($(obj).attr('lay-type') == 'image') {
                    input.siblings('img').attr('src', res.data.file).show();
                }
                input.val(res.data.file);

                if(res.data.thumb_class !=''){
                    $('.'+ res.data.thumb_class).val(res.data.thumb[0].file);
                }
            }
        });

        $('.upload-input').hover(function (e){
            var e = window.event || e;
            var imgsrc = $(this).val();
            if(imgsrc.trim()==""){ return; }
            var left = e.clientX+document.body.scrollLeft+20;
            var top = e.clientY+document.body.scrollTop+20;
            $(".showpic").css({left:left,top:top,display:""});
            if(imgsrc.indexOf('://')<0){ imgsrc = ROOT_PATH + '/' + imgsrc;	} else{ imgsrc = imgsrc.replace('mac:','http:'); }
            $(".showpic_img").attr("src", imgsrc);
        },function (e){
            $(".showpic").css("display","none");
        });

        $("#btn_rnd").click(function(){
            $("#role_hits").val( rndNum(5000,9999) );
            $("#role_hits_month").val( rndNum(1000,4999) );
            $("#role_hits_week").val( rndNum(300,999) );
            $("#role_hits_day").val( rndNum(1,299) );
            $("#role_up").val( rndNum(1,999) );
            $("#role_down").val( rndNum(1,999) );
            $("#role_score").val( rndNum(10) );
            $("#role_score_all").val( rndNum(1000) );
            $("#role_score_num").val( rndNum(100) );
        });

        var ue = editor_getEditor('role_content');
    });
    
</script>

</body>
</html>