<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:65:"/www/wwwroot/tiaoshi.com/application/admin/view/version/info.html";i:1591345661;s:64:"/www/wwwroot/tiaoshi.com/application/admin/view/public/head.html";i:1552720680;s:66:"/www/wwwroot/tiaoshi.com/application/admin/view/public/editor.html";i:1552720680;s:64:"/www/wwwroot/tiaoshi.com/application/admin/view/public/foot.html";i:1552720680;}*/ ?>
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
    window.UEDITOR_CONFIG.serverUrl = "<?php echo url('upload/upload'); ?>?from=ueditor&flag=topic_editor&input=upfile";
    var EDITOR = UE;
</script>
<?php elseif($editor == 'umeditor'): ?>
<link rel="stylesheet" href="/static/editor/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/static/editor/umeditor/umeditor.config.js"></script>
<script type="text/javascript" src="/static/editor/umeditor/umeditor.min.js"></script>
<script type="text/javascript">
    window.UMEDITOR_CONFIG.imageUrl = "<?php echo url('upload/upload'); ?>?from=umeditor&flag=topic_editor&input=upfile";
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
                res = KindEditor.create('#'+obj, { uploadJson:"<?php echo url('upload/upload'); ?>?from=kindeditor&flag=topic_editor&input=imgFile" , allowFileManager : false });
                break;
            case "ckeditor":
                res = CKEDITOR.replace(obj,{filebrowserImageUploadUrl:"<?php echo url('upload/upload'); ?>?from=ckeditor&flag=topic_editor&input=upload"});
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
    <form class="layui-form layui-form-pane" method="post" action="">
        <input id="link_id" name="link_id" type="hidden" value="<?php echo $info['link_id']; ?>">
        <div class="layui-form-item">
            <label class="layui-form-label">旧版本：</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="<?php echo $info['oldversion']; ?>" placeholder="请输入旧版本" lay-verify="oldversion"  id="oldversion" name="oldversion">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">新版本：</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="<?php echo $info['newversion']; ?>" placeholder="请输入新版本" lay-verify="newversion"  id="newversion" name="newversion">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">更新内容：</label>
            <div class="layui-input-block">
               <textarea id="content" name="content" type="text/plain" style="width:99%;height:300px"><?php echo mac_url_content_img($info['content']); ?></textarea>
               
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">下载地址：</label>
            <div class="layui-input-block ">
                <input type="text" class="layui-input" value="<?php echo $info['downloadurl']; ?>" placeholder="请输入下载地址" placeholder="请输入链接地址http://开头" id="downloadurl" name="downloadurl">
            </div>
        </div>
      <div class="layui-form-item">
            <label class="layui-form-label">排序：</label>
            <div class="layui-input-inline w100">
                <input type="text" class="layui-input" value="<?php echo $info['weigh']; ?>" placeholder="请输入顺序号"  id="weigh" name="weigh">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">类型：</label>
            <div class="layui-input-inline">
                <select class="w100" name="type">
                    <option value="0" <?php if($vo['type'] == 0): ?>selected <?php endif; ?>>安卓</option>
                    <option value="1" <?php if($vo['type'] == 1): ?>selected <?php endif; ?>>苹果</option>
                </select>
            </div>
        </div>
      <div class="layui-form-item">
            <label class="layui-form-label">强制更新：</label>
            <div class="layui-input-inline">
                <select class="w100" name="enforce">
                    <option value="0" <?php if($vo['enforce'] == 0): ?>selected <?php endif; ?>>不强制</option>
                    <option value="1" <?php if($vo['enforce'] == 1): ?>selected <?php endif; ?>>强制</option>
                </select>
            </div>
        </div>
      <div class="layui-form-item">
            <label class="layui-form-label">状态：</label>
            <div class="layui-input-inline">
                <select class="w100" name="status">
                    <option value="0" <?php if($vo['status'] == 0): ?>selected <?php endif; ?>>开启</option>
                    <option value="1" <?php if($vo['status'] == 1): ?>selected <?php endif; ?>>关闭</option>
                </select>
            </div>
        </div>

        <div class="layui-form-item center">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="formSubmit" data-child="true">保 存</button>
                <button class="layui-btn layui-btn-warm" type="reset">还 原</button>
            </div>
        </div>
    </form>

</div>

<script type="text/javascript" src="/static/js/admin_common.js"></script>

<script type="text/javascript">
  var ue = editor_getEditor('content');
    layui.use(['form', 'layer'], function () {
        // 操作对象
        var form = layui.form
                , layer = layui.layer
                , $ = layui.jquery;

        // 验证
        form.verify({
            link_name: function (value) {
                if (value == "") {
                    return "请输入链接名称";
                }
            },
            link_url: function (value) {
                if (value == "") {
                    return "请输入链接地址";
                }
            }
        });


    });
</script>

</body>
</html>