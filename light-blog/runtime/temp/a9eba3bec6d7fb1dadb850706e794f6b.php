<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:55:"D:\wamp\www\jyj/application/index\view\admin\login.html";i:1496807822;s:56:"D:\wamp\www\jyj/application/index\view\public\admin.html";i:1496887726;}*/ ?>
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
                    <li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A"><?php echo $user; ?> <i class="Hui-iconfont">&#xe6d5;</i></a>
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
            <dd>
                <ul>
                    <li><a href="#" title="微博">微博</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-mivie">
            <dt><i class="Hui-iconfont">&#xe613;</i> 影评<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="#" title="影评">影评</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-photo">
            <dt><i class="Hui-iconfont">&#xe620;</i> 摄影<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="#" title="品牌管理">品牌管理</a></li>
                    <li><a href="#" title="分类管理">分类管理</a></li>
                    <li><a href="#" title="产品管理">产品管理</a></li>
                </ul>
            </dd>
        </dl>
    </div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>



<section class="Hui-article-box">
    <nav class="breadcrumb"><i class="Hui-iconfont"></i> <a href="/" class="maincolor">首页</a>
        <span class="c-999 en">&gt;</span>
        <span class="c-666">我的桌面</span>
        <!--<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>-->
    </nav>
    <div style="display: flex;flex-direction: column;align-items: center;">
        <h3>后台管理</h3>
    </div>
</section>


<script type="text/javascript" src="__HUI__/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__HUI__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__HUI__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__HUI__/h-ui.admin/js/H-ui.admin.page.js"></script>


<script type="text/javascript">

</script>


</body>
</html>