<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:54:"D:\wamp\www\jyj/application/index\view\photo\view.html";i:1500101561;s:55:"D:\wamp\www\jyj/application/index\view\public\base.html";i:1500100076;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="蒋小凡" />
    <meta name="Copyright" content="蒋小凡" />
    <meta name="description" content="蒋小凡的主页" />
    <meta name="keywords" content="个人主页 蒋小凡" />
    <title>Jiang XiaoFan</title>

    <link rel="Bookmark" href="__IMG__/favicon.ico" >
    <link rel="Shortcut Icon" href="__IMG__/favicon.ico" />

    

    <link rel="stylesheet" type="text/css" href="__CSS__/style.css" />
    <!--<link rel="stylesheet" type="text/css" href="__CSS__/bootstrap.min.css" />-->
    <link rel="stylesheet" type="text/css" href="__CSS__/newstyle.css" />

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
                    <ul class="zuopin-type" style="display:block">
                        <li><a href="<?php echo url('photo/shan'); ?>">摄影</a></li>
                        <li><a href="<?php echo url('photo/net'); ?>">网站</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo url('index/weibo'); ?>">微博</a></li>
                <li><a href="<?php echo url('movie/index'); ?>">文章</a></li>
                <li><a href="<?php echo url('index/card'); ?>">关于我</a></li>
            </ul>
        </div>
    </div>


    <!-- 内容 -->
    
    <div class="con-right">
        <div class="con-nav">
            <a href="<?php echo url('photo/shan'); ?>"><span>山</span></a>
            <a href="<?php echo url('photo/ren'); ?>"><span>人</span></a>
            <a href="<?php echo url('photo/xian'); ?>"><span>仙</span></a>
            <a href="<?php echo url('photo/view'); ?>"><span class="active">赏</span></a>
        </div>

        <?php if(is_array($img) || $img instanceof \think\Collection || $img instanceof \think\Paginator): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="small_pic">
                <a href="#<?php echo $vo['id']; ?>">
                    <img class="lazy" data-original="<?php echo $vo['pic_url']; ?>" />
                </a>
            </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>

    </div>

    <!-- 要放大显示的div -->
    <?php if(is_array($img) || $img instanceof \think\Collection || $img instanceof \think\Paginator): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <div id="<?php echo $vo['id']; ?>" style="display:none;"><img src="<?php echo $vo['pic_url']; ?>" /></div>
    <?php endforeach; endif; else: echo "" ;endif; ?>



    
</div>

<script type="text/javascript" src="__JS__/jquery-2.0.0.min.js"></script>

    <script type="text/javascript" src="__JS__/content_zoom.js"></script><!-- 点击显示大图 -->
    <script type="text/javascript" src="__JS__/lazy-load.js"></script><!-- 懒加载 -->
    <script>
        $(document).ready(function(){
            $("span a").click(function(){
                $(this).parent().next().slideToggle();
                $(this).parent().prevAll("ul").slideUp("slow");
                $(this).parent().next().nextAll("ul").slideUp("slow");
                return false;
            });
        });

        $(document).ready(function() {
            $('div.small_pic a').fancyZoom({scaleImg: true, closeOnClick: true});
        });

        $(function() {
            $("img.lazy").lazyload({
                effect : "fadeIn"
            });
        });
    </script>

</body>

</html>
