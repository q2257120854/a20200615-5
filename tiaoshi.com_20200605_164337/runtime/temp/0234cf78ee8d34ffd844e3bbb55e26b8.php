<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:63:"/www/wwwroot/tiaoshi.com/application/admin/view/actor/info.html";i:1552720680;s:64:"/www/wwwroot/tiaoshi.com/application/admin/view/public/head.html";i:1552720680;s:66:"/www/wwwroot/tiaoshi.com/application/admin/view/public/editor.html";i:1552720680;s:64:"/www/wwwroot/tiaoshi.com/application/admin/view/public/foot.html";i:1552720680;}*/ ?>
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
    window.UEDITOR_CONFIG.serverUrl = "<?php echo url('upload/upload'); ?>?from=ueditor&flag=actor_editor&input=upfile";
    var EDITOR = UE;
</script>
<?php elseif($editor == 'umeditor'): ?>
<link rel="stylesheet" href="/static/editor/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/static/editor/umeditor/umeditor.config.js"></script>
<script type="text/javascript" src="/static/editor/umeditor/umeditor.min.js"></script>
<script type="text/javascript">
    window.UMEDITOR_CONFIG.imageUrl = "<?php echo url('upload/upload'); ?>?from=umeditor&flag=actor_editor&input=upfile";
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
                res = KindEditor.create('#'+obj, { uploadJson:"<?php echo url('upload/upload'); ?>?from=kindeditor&flag=actor_editor&input=imgFile" , allowFileManager : false });
                break;
            case "ckeditor":
                res = CKEDITOR.replace(obj,{filebrowserImageUploadUrl:"<?php echo url('upload/upload'); ?>?from=ckeditor&flag=actor_editor&input=upload"});
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
        <input type="hidden" name="actor_id" value="<?php echo $info['actor_id']; ?>">

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
                            <select name="actor_level">
                                <option value="0">请选择推荐</option>
                                <option value="9" <?php if($info['actor_level'] == 9): ?>selected<?php endif; ?>>推荐9-幻灯</option>
                                <option value="1" <?php if($info['actor_level'] == 1): ?>selected<?php endif; ?>>推荐1</option>
                                <option value="2" <?php if($info['actor_level'] == 2): ?>selected<?php endif; ?>>推荐2</option>
                                <option value="3" <?php if($info['actor_level'] == 3): ?>selected<?php endif; ?>>推荐3</option>
                                <option value="4" <?php if($info['actor_level'] == 4): ?>selected<?php endif; ?>>推荐4</option>
                                <option value="5" <?php if($info['actor_level'] == 5): ?>selected<?php endif; ?>>推荐5</option>
                                <option value="6" <?php if($info['actor_level'] == 6): ?>selected<?php endif; ?>>推荐6</option>
                                <option value="7" <?php if($info['actor_level'] == 7): ?>selected<?php endif; ?>>推荐7</option>
                                <option value="8" <?php if($info['actor_level'] == 8): ?>selected<?php endif; ?>>推荐8</option>
                            </select>
                    </div>
                    <div class="layui-input-inline w150">
                            <select name="actor_status">
                                <option value="1">已审核</option>
                                <option value="0" <?php if($info['actor_status'] == '0'): ?>selected<?php endif; ?>>未审核</option>
                            </select>
                    </div>
                    <div class="layui-input-inline w150">
                        <select name="actor_sex">
                            <option value="男">男</option>
                            <option value="女" <?php if($info['actor_sex'] == '女'): ?>selected<?php endif; ?>>女</option>
                        </select>
                    </div>
                    <div class="layui-input-inline w150">
                        <select name="actor_lock">
                            <option value="0">未锁</option>
                            <option value="1" <?php if($info['actor_lock'] == 1): ?>selected<?php endif; ?>>锁定</option>
                        </select>
                    </div>

                    <div class="layui-input-inline">
                        <input type="checkbox" name="uptime" title="更新时间" value="1" checked class="layui-checkbox checkbox-ids" lay-skin="primary">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">演员名：</label>
                    <div class="layui-input-inline w200">
                        <input type="text" class="layui-input" value="<?php echo $info['actor_name']; ?>" placeholder="请输入" name="actor_name">
                    </div>
                    <label class="layui-form-label">别名：</label>
                    <div class="layui-input-inline w200">
                        <input type="text" class="layui-input" value="<?php echo $info['actor_alias']; ?>" placeholder="请输入" name="actor_alias">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">拼音：</label>
                    <div class="layui-input-inline w200">
                        <input type="text" class="layui-input" value="<?php echo $info['actor_en']; ?>" placeholder="" name="actor_en">
                    </div>
                    <label class="layui-form-label">首字母：</label>
                    <div class="layui-input-inline w200">
                        <input type="text" class="layui-input" value="<?php echo $info['actor_letter']; ?>" placeholder="" name="actor_letter">
                    </div>
                    <label class="layui-form-label">高亮：</label>
                    <div class="layui-input-inline w200">
                        <input type="text" class="layui-input color" value="<?php echo $info['actor_color']; ?>" placeholder="" name="actor_color">
                    </div>
                </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">血型：</label>
                        <div class="layui-input-inline w200">
                            <input type="text" class="layui-input" value="<?php echo $info['actor_blood']; ?>" placeholder="A,B,AB,O" name="actor_blood">
                        </div>
                        <label class="layui-form-label">地区：</label>
                        <div class="layui-input-inline w200">
                            <input type="text" class="layui-input" value="<?php echo $info['actor_area']; ?>" placeholder="" name="actor_area">
                        </div>
                        <label class="layui-form-label">出生地：</label>
                        <div class="layui-input-inline w200">
                            <input type="text" class="layui-input" value="<?php echo $info['actor_birtharea']; ?>" placeholder="" name="actor_birtharea">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">身高：</label>
                        <div class="layui-input-inline w200">
                            <input type="text" class="layui-input" value="<?php echo $info['actor_height']; ?>" placeholder="单位cm" name="actor_height">
                        </div>
                        <label class="layui-form-label">体重：</label>
                        <div class="layui-input-inline w200">
                            <input type="text" class="layui-input" value="<?php echo $info['actor_weight']; ?>" placeholder="单位kg" name="actor_weight">
                        </div>
                        <label class="layui-form-label">生日：</label>
                        <div class="layui-input-inline w200">
                            <input type="text" class="layui-input" value="<?php echo $info['actor_birthday']; ?>" placeholder="例如：2000-01-01" name="actor_birthday">
                        </div>
                    </div>

                    <div class="layui-form-item">

                        <label class="layui-form-label">星座：</label>
                        <div class="layui-input-inline w200">
                            <input type="text" class="layui-input" value="<?php echo $info['actor_starsign']; ?>" placeholder="" name="actor_starsign">
                        </div>
                        <label class="layui-form-label">毕业学校：</label>
                        <div class="layui-input-inline w200">
                            <input type="text" class="layui-input" value="<?php echo $info['actor_school']; ?>" placeholder="" name="actor_school">
                        </div>
                        <label class="layui-form-label">备注：</label>
                        <div class="layui-input-inline w200">
                            <input type="text" class="layui-input" value="<?php echo $info['actor_remarks']; ?>" placeholder="" name="actor_remarks" id="actor_remarks">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">代表作：</label>
                        <div class="layui-input-inline w800">
                            <input type="text" class="layui-input" value="<?php echo $info['actor_works']; ?>" placeholder="多个用,号连接" name="actor_works">
                        </div>
                    </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">图片：</label>
                    <div class="layui-input-inline w400 upload">
                        <input type="text" class="layui-input upload-input" style="max-width:100%;" value="<?php echo $info['actor_pic']; ?>" placeholder="" id="actor_pic" name="actor_pic">
                    </div>
                    <div class="layui-input-inline ">
                        <button type="button" class="layui-btn layui-upload" lay-data="" id="upload1">上传图片</button>
                    </div>
                </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">简介：</label>
                        <div class="layui-input-block">
                            <textarea name="actor_blurb" cols="" rows="3" class="layui-textarea"  placeholder="不填写将自动从第一页详情里获取前100个字" style="height:40px;"><?php echo $info['actor_blurb']; ?></textarea>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">介绍：</label>
                        <div class="layui-input-block">
                            <textarea id="actor_content" name="actor_content" type="text/plain" style="width:99%;height:300px"><?php echo mac_url_content_img($info['actor_content']); ?></textarea>
                        </div>
                    </div>
                    
        </div>


                    <div class="layui-tab-item">
                        <div class="layui-form-item">
                            <label class="layui-form-label">顶数量：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['actor_up']; ?>" placeholder="" id="actor_up" name="actor_up">
                            </div>
                            <label class="layui-form-label">踩数量：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['actor_down']; ?>" placeholder="" id="actor_down" name="actor_down">
                            </div>
                            <button class="layui-btn" type="button" id="btn_rnd">随机生成</button>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">总人气：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['actor_hits']; ?>" placeholder="" id="actor_hits" name="actor_hits">
                            </div>
                            <label class="layui-form-label">月人气：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['actor_hits_month']; ?>" placeholder="" id="actor_hits_month" name="actor_hits_month" >
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">周人气：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['actor_hits_week']; ?>" placeholder="" id="actor_hits_week" name="actor_hits_week">
                            </div>
                            <label class="layui-form-label">日人气：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input " value="<?php echo $info['actor_hits_day']; ?>" placeholder="" id="actor_hits_day" name="actor_hits_day">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">平均分：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['actor_score']; ?>" placeholder="" id="actor_score" name="actor_score">
                            </div>
                            <label class="layui-form-label">总评分：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['actor_score_all']; ?>" placeholder="" id="actor_score_all" name="actor_score_all">
                            </div>
                            <label class="layui-form-label">总评次：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['actor_score_num']; ?>" placeholder="" id="actor_score_num" name="actor_score_num">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">独立模板：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['actor_tpl']; ?>" placeholder="" name="actor_tpl">
                            </div>
                            <label class="layui-form-label">跳转URL：</label>
                            <div class="layui-input-inline ">
                                <input type="text" class="layui-input" value="<?php echo $info['actor_jumpurl']; ?>" placeholder="" name="actor_jumpurl">
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
            actor_name: function (value) {
                if (value == "") {
                    return "请输入名称";
                }
            }
        });

        upload.render({
            elem: '.layui-upload'
            ,url: "<?php echo url('upload/upload'); ?>?flag=actor"
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
            $("#actor_hits").val( rndNum(5000,9999) );
            $("#actor_hits_month").val( rndNum(1000,4999) );
            $("#actor_hits_week").val( rndNum(300,999) );
            $("#actor_hits_day").val( rndNum(1,299) );
            $("#actor_up").val( rndNum(1,999) );
            $("#actor_down").val( rndNum(1,999) );
            $("#actor_score").val( rndNum(10) );
            $("#actor_score_all").val( rndNum(1000) );
            $("#actor_score_num").val( rndNum(100) );
        });

        var ue = editor_getEditor('actor_content');
    });
    
</script>

</body>
</html>