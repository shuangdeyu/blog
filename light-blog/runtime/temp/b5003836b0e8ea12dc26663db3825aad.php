<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:74:"/data/wwwroot/www.shuangdeyu.com/jyj/application/index/view/photo/net.html";i:1499046379;s:76:"/data/wwwroot/www.shuangdeyu.com/jyj/application/index/view/public/base.html";i:1499046331;}*/ ?>
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
        <div class="net" id="net1">
            <a href="http://shuangdeyu.oschina.io/" target="_blank">
                <img src="__IMG__/net/blog.png">
                <div class="abs" id="blog">
                    <h2>个人博客</h2>
                    <p>装逼又好用的hexo静态博客</p>
                </div>
            </a>
        </div>
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

        $("#net1").mouseenter(function(){
            //$("#yu").css("display","block");
            $("#blog").fadeIn(300);
        });
        $("#net1").mouseleave(function(){
            //$("#yu").css("display","none");
            $("#blog").fadeOut(300);
        });
    </script>

</body>

</html>
