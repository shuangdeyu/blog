<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"D:\wamp\www\jyj/application/index\view\movie\content.html";i:1500111728;s:55:"D:\wamp\www\jyj/application/index\view\public\base.html";i:1500100076;}*/ ?>
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

    
    <style type="text/css">
        #back-to-top {
            position: fixed;
            bottom: 50px;
            right: 0px;
        }
        #back-to-top a span {
            background: #9c9c9c;
            border-radius: 6px;
            display: block;
            height: 30px;
            width: 30px;
            background: #9c9c9c url(__IMG__/arrow-up.png) no-repeat center center;
            background-size: 14px;
            margin-bottom: 5px;
            -moz-transition: background 0.3s;
            -webkit-transition: background 0.3s;
            -o-transition: background 0.3s;
            transition: background 0.3s;
        }
    </style>


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
                    <ul class="zuopin-type">
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
    
    <div class="con-right con-article-img">
        <div style="font-size:25px;padding:35px 0 10px 0;color:#636363">
            <?php echo $con['title']; ?>
        </div>
        <div style="font-size:15px;padding:05px 0 10px 0;color:#636363">
            <?php echo $con['time']; ?>
        </div>
        <div style="padding-bottom:15px;">
            <?php echo $con['content']; ?>
        </div>

        <!-- 返回顶部 -->
        <p id="back-to-top"><a href="#top"><span></span></a></p>

        <!-- JiaThis Button BEGIN -->
        <div class="jiathis_style">
            <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt" target="_blank"><img src="http://v3.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border="0" /></a>
            <a class="jiathis_counter_style_margin:3px 0 0 2px"></a>
        </div>
        <script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
        <!-- JiaThis Button END -->

        <div style="padding-bottom:55px;border-bottom:1px solid #ededed">

        </div>

        <!-- UY BEGIN -->
        <div id="uyan_frame"></div>
        <script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=2126657"></script>
        <!-- UY END -->

    </div>


    
</div>

<script type="text/javascript" src="__JS__/jquery-2.0.0.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("span a").click(function(){
                $(this).parent().next().slideToggle();
                $(this).parent().prevAll("ul").slideUp("slow");
                $(this).parent().next().nextAll("ul").slideUp("slow");
                return false;
            });
        });

        $(document).ready(function() {
            //首先将#back-to-top隐藏
            $("#back-to-top").hide();
            //当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
            $(function() {
                $(window).scroll(function() {
                    if ($(window).scrollTop() > 100) {
                        $("#back-to-top").fadeIn(1500);
                    } else {
                        $("#back-to-top").fadeOut(1500);
                    }
                });
                //当点击跳转链接后，回到页面顶部位置
                $("#back-to-top").click(function() {
                    $('body,html').animate({
                            scrollTop: 0
                        },
                        1000);
                    return false;
                });
            });
        });
    </script>

</body>

</html>
