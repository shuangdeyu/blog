<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"D:\wamp\www\jyj/application/index\view\admin\photo_edit.html";i:1497681735;s:56:"D:\wamp\www\jyj/application/index\view\public\admin.html";i:1499046364;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="favicon.ico" >
    <link rel="Shortcut Icon" href="favicon.ico" />

    
<link rel="stylesheet" type="text/css" href="__HUI__/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="__HUI__/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="__HUI__/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="__HUI__/h-ui.admin/skin/default/skin.css" />
<link rel="stylesheet" type="text/css" href="__HUI__/h-ui.admin/css/style.css" />
<link rel="stylesheet" type="text/css" href="__CSS__/admin.css" />
<link rel="stylesheet" type="text/css" href="__HUI__/fileinput/fileinput.css" />


    <title>xiaofan-admin</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
</head>
<body>








<article class="page-container">
    <form class="form form-horizontal" id="form-article-add" action="<?php echo url('index/admin/photo_update'); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="type" value="<?php echo $photo['type']; ?>" />
        <input type="hidden" name="id" value="<?php echo $photo['id']; ?>" />
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">内容：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea id="photoContent" name="content" ><?php echo $photo['content']; ?></textarea>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">图片：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <?php if(is_array($img) || $img instanceof \think\Collection || $img instanceof \think\Paginator): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <img src="<?php echo $vo['pic_url']; ?>" width="100%" />
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">更换图片：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <?php if($type == 0): ?> <input name="Photo" id="file-1" type="file" data-show-cancel="false" />
                <?php else: ?> <input name="Photo[]" id="file-1" type="file" data-show-cancel="false" multiple />
                <?php endif; ?>
            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <div class="row cl">
                    <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                        <button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
                        <button class="btn btn-default radius" type="reset">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</article>


<script type="text/javascript" src="__HUI__/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__HUI__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__HUI__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__HUI__/h-ui.admin/js/H-ui.admin.page.js"></script>


<script type="text/javascript" src="__HUI__/fileinput/fileinput.js"></script>
<script type="text/javascript" src="__KED__/kindeditor.js"></script>
<script type="text/javascript" src="__KED__/lang/zh_CN.js"></script>
<script>
    KindEditor.ready(function(K) {
        window.editor = K.create('#photoContent');
    });

    $("#file-1").fileinput({
        showUpload: false,
        showCaption: false,
        browseClass: "btn btn-primary btn-default",
        fileType: "any",
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
    });
</script>


</body>
</html>