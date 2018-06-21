<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/6
 * Time: 11:56
 */

namespace app\index\controller;

use think\Controller;

use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

class Upload extends Controller
{
    /**
     * 上传单张
     */
    public function one($file){
        //图片文件处理
        $filePath = $file->getRealPath(); //要上传的本地路径
        $ext = pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);  //后缀
        $key = 'blog'.substr(md5($file->getRealPath()),0,5).date('YmdHis').rand(0, 9999).'.'.$ext; //保存的文件名

        // 用于签名的公钥和私钥
        $accessKey = config('AccessKey');
        $secretKey = config('SecretKey');
        // 初始化签权对象
        $auth = new Auth($accessKey, $secretKey);

        // 空间名
        $bucket = config('Bucket');
        // 生成上传Token
        $token = $auth->uploadToken($bucket);

        // 构建 UploadManager 对象
        $uploadMgr = new UploadManager();

        // 调用 UploadManager 的 putFile 方法进行文件的上传
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err !== null) {
            //var_dump($err);
            return false;
        } else {
            //var_dump($ret);
            return config('QiniuUrl').$ret['key'];
        }
    }

    /**
     * 上传多张
     */
    public function more(){
        ;
    }

    /**
     * 删除图片
     */
    public function delete($url){
        $accessKey = config('AccessKey');
        $secretKey = config('SecretKey');
        //初始化Auth状态
        $auth = new Auth($accessKey, $secretKey);

        //初始化BucketManager
        $bucketMgr = new BucketManager($auth);

        //你要测试的空间， 并且这个key在你空间中存在
        $bucket = config('Bucket');
        $key = substr($url,33);

        //删除$bucket 中的文件 $key
        $err = $bucketMgr->delete($bucket, $key);

        return true;
    }
}