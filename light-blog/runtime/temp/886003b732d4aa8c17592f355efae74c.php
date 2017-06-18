<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:62:"D:\wamp\www\light-blog/application/index\view\index\weibo.html";i:1494055177;s:62:"D:\wamp\www\light-blog/application/index\view\public\base.html";i:1495723985;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="蒋小凡" />
    <meta name="Copyright" content="蒋小凡" />
    <meta name="description" content="蒋小凡的主页" />
    <meta name="keywords" content="个人主页 蒋小凡" />
    <title>Jiang XiaoFan</title>

    

    

    <link rel="stylesheet" type="text/css" href="__CSS__/style.css" />

    <script type="text/javascript">
        //判断客户端是PC还是移动端
        if ((navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i))) {
            //window.location.href="style2.html";
        } else {
            //
        }
    </script>

</head>

<body>
<div class="con-main">
    <!-- 导航 -->
    
    <div class="con-left">
        <div class="head">
            <a href="<?php echo url('index/index'); ?>"><img src="__IMG__/head.jpg" title="蒋小凡"></a>
        </div>
        <div class="name"><a href="<?php echo url('index/card'); ?>"><strong>JIANG XIAOFAN</strong></a></div>
        <div class="about">
            <ul>
                <li>
                    <span><a href="javascript:" >作品集</a></span>
                    <ul class="zuopin-type">
                        <li><a href="<?php echo url('photo/shan'); ?>">摄影</a></li>
                        <li><a href="<?php echo url('photo/net'); ?>">网站</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo url('index/weibo'); ?>">微博</a></li>
                <li><a href="<?php echo url('movie/index'); ?>">电影</a></li>
                <li><a href="<?php echo url('index/card'); ?>">关于我</a></li>
            </ul>
        </div>
    </div>
    

    <!-- 内容 -->
    
    <div class="con-right con-article-img">
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div style="font-size:15px;padding:35px 0 10px 0;color:#636363">
                <?php if($vo['link'] != ''): ?>
                    <p><a href="<?php echo $vo['link']; ?>" target="_blank">
                        <strong><?php echo $vo['name']; ?></strong></a></p>
                    <?php else: ?> <p><strong><?php echo $vo['name']; ?></strong></p>
                <?php endif; ?>
            </div>
            <div style="padding-bottom:25px;border-bottom:1px solid #ededed">
                <?php echo $vo['content']; ?>
            </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>


    
</div>

<script type="text/javascript" src="__JS__/jquery-2.0.0.min.js"></script>

<script>
    $(document).ready(function(){
        $("span a").click(function(){
            $(this).parent().next().slideToggle();
            $(this).parent().prevAll("ul").slideUp("slow");
            $(this).parent().next().nextAll("ul").slideUp("slow");
            return false;
        });
    });
</script>

</body>

</html>
