<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"D:\wamp\www\jyj/application/index\view\testfile\index.html";i:1499312334;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Demo</title>
    <style>
        body, input, select, button, h1 {
            font-size: 28px;
            line-height:1.7;
        }
    </style>
</head>

<body>

<h1></h1>
    <form method="post" action="<?php echo url('index/testfile/upload_more'); ?>" enctype="multipart/form-data">
        <label>测试表单：</label>
        <input type="file" name="photo[]" multiple>

        <!--<button id="save">保存</button>-->
        <input type="submit" value="提交" >
    </form>
</body>
</html>
