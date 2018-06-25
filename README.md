# 简洁的轻博客型个人网站 

### 示例地址
http://xf.shuangdeyu.com/

网站采用thinkphp5开发，前端使用框架H-ui，适合初学者学习thinkphp5使用
项目中有前台展示和后台管理，使用的时候将文件夹中的spl文件导入mysql

后台登录 admin 123456

在application/index加入配置文件 **config.php**
```
// URL访问根地址
$root = \think\Request::instance()->root();
$root = str_replace('/index.php', '', $root);
define("__ROOT__", $root);

return [
    'view_replace_str' => [
        '__PUBLIC__'   => __ROOT__ . '/public',
        '__STATIC__'   => __ROOT__ . '/public/static',
        '__CSS__'      => __ROOT__ . '/public/static/css',
        '__JS__'       => __ROOT__ . '/public/static/js',`
        '__IMG__'      => __ROOT__ . '/public/static/images',
        '__HUI__'      => __ROOT__ . '/public/static/hui',
        '__KED__'      => __ROOT__ . '/public/static/kindeditor',
    ],
    'AccessKey' => '', //七牛ak
    'SecretKey' => '', //七牛sk
    'Bucket'    => '', //七牛空间名
    'QiniuUrl'  => '', //七牛默认外链
];
```

**database.php** 文件请自行添加，详细忽略的文件见.gitignore

2017-07-06：接入七牛云，图片存储在七牛云，大大提高了加载速度

2017-07-16：界面优化，加入分页功能，图片懒加载，文章加入友言评论插件
