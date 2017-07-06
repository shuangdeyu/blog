<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"/data/wwwroot/www.shuangdeyu.com/jyj/application/index/view/index/card.html";i:1499046462;s:76:"/data/wwwroot/www.shuangdeyu.com/jyj/application/index/view/public/base.html";i:1499046331;}*/ ?>
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
                <li><a href="<?php echo url('movie/index'); ?>">文章</a></li>
                <li><a href="<?php echo url('index/card'); ?>">关于我</a></li>
            </ul>
        </div>
    </div>
    

    <!-- 内容 -->
    
    <div class="con-right" >
        <div style="font-size:15px;padding:35px 0;color:#636363">
            <p>來自pisces的Jiang Xiaofan</p>
        </div>
        <div>
            <p>毕业于浙江理工大学科技与艺术学院，电子信息工程专业，人送外号“痴焊”</p>
            <p>拿过最牛逼的奖是电子设计大赛省二等奖，熟悉单片机</p>
            <p><br></p>
            <p>兴趣广泛，有ps、摄影、看书、爬山、徒步、电影、动漫、数码、做自己的网站等等</p>
            <p>自学web、php编程，喜欢简单舒服的网站，喜欢捣鼓新奇的玩意</p>
            <p><br></p>
            <!--<p>客观评价，慢热型男生，比较文静，有自己的想法，喜欢安静的环境，好相处</p>
            <p>其实内心喜欢坐过山车(向往刺激新鲜的事物)</p>-->
        </div>
        <div style="font-size:15px;padding:55px 0 15px 0;color:#636363" >
            <p>聯繫方式：</p>
        </div>
        <div class="lianxi">
            <ul>
                <li>QQ：749212498</li>
                <li>weixin：749212498</li>
                <li>email：<a href="mailto:tianxianyuyu@sina.cn" target="_blank">tianxianyuyu@sina.cn</a></li>
                <li>個人博客：<a href="http://shuangdeyu.oschina.io/" target="_blank">XiaoFan's Blog</a></li>
				<li>GitHub：<a href="https://github.com/shuangdeyu" target="_blank">shuangdeyu</a></li>
            </ul>
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
</script>

</body>

</html>
