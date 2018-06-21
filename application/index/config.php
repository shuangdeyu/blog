<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/6
 * Time: 11:24
 */
 //URL访问根地址
$root = \think\Request::instance()->root();
$root = str_replace('/index.php', '', $root);
define("__ROOT__", $root);

return [
    'view_replace_str'       => [
        '__PUBLIC__'    => __ROOT__ . '/public',
        '__STATIC__'    => __ROOT__ . '/public/static',
        '__CSS__'    => __ROOT__ . '/public/static/css',
        '__JS__'     => __ROOT__ . '/public/static/js',
        '__IMG__'    => __ROOT__ . '/public/static/images',
        '__HUI__'    => __ROOT__ . '/public/static/hui',
        '__KED__'    => __ROOT__ . '/public/static/kindeditor',
    ],
    'AccessKey' => '2q2xXaJvjo6gP-k9pzUEBoidq5LZvcq21LMeD-39', //七牛ak
    'SecretKey' => 'pq7sAcSfqNdGYzjtRLTYiuViebRL3K6LVPivS2Xr', //七牛sk
    'Bucket' => 'images', //七牛空间名
    'QiniuUrl' => 'http://on7plg7jx.bkt.clouddn.com/', //七牛默认外链
];