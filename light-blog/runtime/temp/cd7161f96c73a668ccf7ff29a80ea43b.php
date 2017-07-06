<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/data/wwwroot/www.shuangdeyu.com/jyj/application/index/view/admin/images_show.html";i:1499046714;s:77:"/data/wwwroot/www.shuangdeyu.com/jyj/application/index/view/public/admin.html";i:1499046364;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="__HUI__/lib/lightbox2/2.8.1/css/lightbox.css" />


    <title>xiaofan-admin</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
</head>
<body>


<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="#">后台管理</a>
            <span class="logo navbar-slogan f-l mr-10 hidden-xs"></span>
            <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <li>管理员</li>
                    <li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A"><?php echo \think\Session::get('user'); ?> <i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <!--<li><a href="javascript:;" onClick="myselfinfo()">个人信息</a></li>
                            <li><a href="#">切换账户</a></li>-->
                            <li><a href="<?php echo url('/admin/loginout'); ?>">退出</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>



<aside class="Hui-aside">

    <div class="menu_dropdown bk_2">
        <dl id="menu-weibo">
            <dt><i class="Hui-iconfont">&#xe616;</i> 微博<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd >
                <ul>
                    <li ><a href="<?php echo url('index/admin/show_weibo'); ?>" title="微博">微博</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-mivie">
            <dt><i class="Hui-iconfont">&#xe613;</i> 文章<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd >
                <ul>
                    <li class="current"><a href="<?php echo url('index/admin/movie_show'); ?>" title="影评">文章</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-photo">
            <dt><i class="Hui-iconfont">&#xe620;</i> 摄影<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd style="display: block">
                <ul>
                    <li ><a href="<?php echo url('index/admin/photo_show'); ?>" title="图文">图文</a></li>
                    <li class="current"><a href="<?php echo url('index/admin/images_show'); ?>" title="相册">相册</a></li>
                </ul>
            </dd>
        </dl>
    </div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>



<section class="Hui-article-box">
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
        <span class="c-gray en">&gt;</span>
        相册管理
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
    </nav>
    <div class="pd-20">
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
                <a href="javascript:;" onclick="images_add('添加图片','images_add.html','10001')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 新增</a>
            </span>
            <span class="r">共有数据：<strong></strong> 条</span>
        </div>
        <div class="portfolio-content">
            <form id="delForm" method="post" action="<?php echo url('index/admin/images_del'); ?>">
                <ul class="cl portfolio-area">
                    <?php if(is_array($img) || $img instanceof \think\Collection || $img instanceof \think\Paginator): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li class="item">
                            <div class="portfoliobox">
                                <input class="checkbox" name="delImg[]" type="checkbox" value="<?php echo $vo['id']; ?>">
                                <div class="picbox">
                                    <a href="<?php echo $vo['pic_url']; ?>" data-lightbox="gallery" ><img src="<?php echo $vo['pic_url']; ?>"></a>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </form>
        </div>
    </div>
</section>


<script type="text/javascript" src="__HUI__/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__HUI__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__HUI__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__HUI__/h-ui.admin/js/H-ui.admin.page.js"></script>


<script type="text/javascript" src="__HUI__/lib/lightbox2/2.8.1/js/lightbox.min.js"></script>
<script type="text/javascript">
    $(function(){
        $.Huihover(".portfolio-area li");
    });

    /*添加*/
    function images_add(title,url,id,w,h){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*删除*/
    function datadel(){
        $("#delForm").submit();
    }
</script>


</body>
</html>