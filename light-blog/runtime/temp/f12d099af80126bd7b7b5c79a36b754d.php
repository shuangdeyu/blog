<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"/data/wwwroot/www.shuangdeyu.com/jyj/application/index/view/admin/show_weibo.html";i:1499046798;s:77:"/data/wwwroot/www.shuangdeyu.com/jyj/application/index/view/public/admin.html";i:1499046364;}*/ ?>
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
            <dd style="display: block">
                <ul>
                    <li class="current"><a href="<?php echo url('index/admin/show_weibo'); ?>" title="微博">微博</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-mivie">
            <dt><i class="Hui-iconfont">&#xe613;</i> 文章<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="<?php echo url('index/admin/movie_show'); ?>" title="影评">文章</a></li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-photo">
            <dt><i class="Hui-iconfont">&#xe620;</i> 摄影<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="<?php echo url('index/admin/photo_show'); ?>" title="图文">图文</a></li>
                    <li><a href="<?php echo url('index/admin/images_show'); ?>" title="相册">相册</a></li>
                </ul>
            </dd>
        </dl>
    </div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>



<section class="Hui-article-box">
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
        <span class="c-gray en">&gt;</span>
        微博管理
        <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
    </nav>
    <div class="Hui-article">
        <article class="cl pd-20">
            <div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
				<a class="btn btn-primary radius" data-title="添加微博" onclick="weibo_add('添加微博','weibo_add.html','10001')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加微博</a>
				</span>
                <span class="r">共有数据：<strong></strong> 条</span>
            </div>
            <div class="mt-20">
                <table class="table table-border table-bordered table-bg table-hover table-sort">
                    <thead>
                    <tr class="text-c">
                        <th width="25"><input type="checkbox" name="" value=""></th>
                        <th width="80">id</th>
                        <th width="150">标题</th>
                        <th >内容</th>
                        <th width="180">链接</th>
                        <th width="120">操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php if(is_array($weibo) || $weibo instanceof \think\Collection || $weibo instanceof \think\Paginator): $i = 0; $__LIST__ = $weibo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr class="text-c">
                            <td><input type="checkbox" value="" name=""></td>
                            <td><?php echo $vo['id']; ?></td>
                            <td><?php echo $vo['name']; ?></td>
                            <td><?php echo $vo['content']; ?></td>
                            <td><?php echo $vo['link']; ?></td>
                            <td class="f-14 td-manage">
                                <a style="text-decoration:none" class="ml-5" onClick="weibo_edit('编辑微博','weibo_info.html?id=<?php echo $vo['id']; ?>','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
                                <a style="text-decoration:none" class="ml-5" onClick="weibo_del(this,'10001','/jyj/admin/weibo_del','<?php echo $vo['id']; ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
                            </td>
                        </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                    </tbody>
                </table>
                <?php echo $weibo->render(); ?>
            </div>
        </article>
    </div>
</section>


<script type="text/javascript" src="__HUI__/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__HUI__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__HUI__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__HUI__/h-ui.admin/js/H-ui.admin.page.js"></script>


<script type="text/javascript">
    /*微博-添加*/
    function weibo_add(title,url,id,w,h){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*微博-编辑*/
    function weibo_edit(title,url,id,w,h){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    /*微博-删除*/
    function weibo_del(obj,id,url,wid){
        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'json',
                data: {wid:wid},
                success: function(data){
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });
        });
    }
</script>


</body>
</html>