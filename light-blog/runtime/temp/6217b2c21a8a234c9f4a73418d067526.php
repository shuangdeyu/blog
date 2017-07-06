<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"D:\wamp\www\jyj/application/index\view\admin\photo_info.html";i:1497605795;s:56:"D:\wamp\www\jyj/application/index\view\public\admin.html";i:1499046364;}*/ ?>
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
    

    <title>xiaofan-admin</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
</head>
<body>








<div class="pd-20">
    <?php if(is_array($img) || $img instanceof \think\Collection || $img instanceof \think\Paginator): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <div style="font-size:15px;padding:0px 0 10px 0;color:#636363">
        <img src="<?php echo $vo['pic_url']; ?>" width="100%" />
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <div style="padding-bottom:25px;border-bottom:1px solid #ededed">
        <?php echo $photo['content']; ?>
    </div>
</div>


<script type="text/javascript" src="__HUI__/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__HUI__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__HUI__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__HUI__/h-ui.admin/js/H-ui.admin.page.js"></script>


<script type="text/javascript">

</script>


</body>
</html>