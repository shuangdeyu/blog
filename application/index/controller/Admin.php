<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/7
 * Time: 10:50
 */

namespace app\index\controller;

use think\Controller;
use think\config;
use think\Validate;
use think\Request;
use think\Db;
use think\Session;

class Admin extends Controller
{
    /*---------------------------------------------------------------*
     *--------------------------登录相关-----------------------------*
     *---------------------------------------------------------------*/
    /**
     * 登录首页
     */
    public function index(){
        return $this->fetch();
    }

    /**
     * 主页
     */
    public function main(){
        /*$user_name = Session::get('user');
        $this->assign('user',$user_name);*/
        return $this->fetch();
    }

    /**
     * 登录验证
     */
    public function login(){
        $user = $_POST['user'];
        $password = md5($_POST['password']);

        $Admin = Db::name('admin');
        $where = array();
        $where['user'] = $user;
        $where['password'] = $password;
        $con = $Admin->where($where)->find();

        if($con){
            Session::set('user',$user);
            Session::set('userId',$con['id']);
            $this->success('登陆成功',url('index/admin/main'));
        }else{
            echo "<script>alert('用户名或密码错误');history.go(-1);</script>";
        }
    }

    /**
     * 退出登录
     */
    public function loginout(){
        Session::clear();
        $this->redirect(url('index/admin/index'));
    }

    /*---------------------------------------------------------------*
     *--------------------------微博相关-----------------------------*
     *---------------------------------------------------------------*/
    /**
     * 显示微博
     */
    public function show_weibo(){
        $weibo = Db::name('weibo')->order('id desc')->paginate(15);

        $this->assign('weibo',$weibo);
        return $this->fetch();
    }

    /**
     * 微博编辑界面
     */
    public function weibo_info(){
        $id = input('get.id');

        $weibo = Db::name('weibo')->where('id',$id)->find();

        $this->assign('weibo',$weibo);
        return $this->fetch();
    }

    /**
     * 编辑微博
     */
    public function weibo_edit(){
        $id = input('post.id');
        $name = input('post.name');
        $link = input('post.link');
        $content = input('post.content');

        $data['name'] = $name;
        $data['link'] = $link;
        $data['content'] = $content;
        Db::name('weibo')->where('id',$id)->update($data);

        //返回到父页面
        echo '<script>parent.window.location.reload();</script>';
    }

    /**
     * 添加微博界面
     */
    public function weibo_add(){
        return $this->fetch();
    }

    /**
     * 保存添加
     */
    public function weibo_save(){
        $name = input('post.name');
        $link = input('post.link');
        $content = input('post.content');

        $data['name'] = $name;
        $data['link'] = $link;
        $data['content'] = $content;
        Db::name('weibo')->insert($data);

        //返回到父页面
        echo '<script>parent.window.location.reload();</script>';
    }

    /**
     * 删除
     */
    public function weibo_del(){
        $wid = input('post.wid');

        Db::name('weibo')->where('id',$wid)->delete();

        return true;
    }

    /*---------------------------------------------------------------*
     *--------------------------文章相关-----------------------------*
     *---------------------------------------------------------------*/
    const moviePhotoAddr1 = './public/static/images/movie/'; //文件夹的地址形式
    const moviePhotoAddr2 = '__IMG__/movie/'; //写入数据库的地址形式
    /**
     * 显示影评列表
     */
    public function movie_show(){
        $movie = Db::name('movie')->order('id desc')->paginate(15);

        $this->assign('movie',$movie);
        return $this->fetch();
    }

    /**
     * 影评详细信息
     */
    public function movie_info(){
        $id = input('get.id');
        $movie = Db::name('movie')->where('id',$id)->find();

        $this->assign('movie',$movie);
        return $this->fetch();
    }

    /**
     * 添加影评界面
     */
    public function movie_add(){
        $m = input('get.m');

        $this->assign('is_m',$m);
        return $this->fetch();
    }

    /**
     * 添加新影评
     */
    public function movie_save(){
        //接收表单
        $title = input('post.title');
        $content = input('post.content');
        $is_markdown = input('post.is_markdown');

        //当前时间，年月日
        $time = date('Y-m-d');

        /*上传到本地*/
        /*//图片名称
        $filename = uniqid();
        //获取图片扩展名
        $exname = strrchr($_FILES['Photo']['name'], '.');

        $dir1 = '';$dir2 = '';
        if($exname) {
            //检查图片文件夹是否存在
            if (!is_dir(self::moviePhotoAddr1)) {
                mkdir(self::moviePhotoAddr1, 0777);
            }

            //图片总路径-上传文件
            $dir1 = self::moviePhotoAddr1 . $filename . $exname;
            //图片总路径-写入数据库
            $dir2 = self::moviePhotoAddr2 . $filename . $exname;
        }*/

        /*上传到七牛*/
        $Upload = new Upload();
        $pic_url = $Upload->one(request()->file('Photo'));

        if($pic_url) {
            //先添加进数据库
            $Movie = Db::name('movie');
            $data  = array();
            $data['title']   = $title;
            $data['content'] = $content;
            $data['time']    = $time;
            $data['cover']   = $pic_url;
            $data['is_markdown'] = $is_markdown;
            $add = $Movie->insert($data);
        }

        //判断是否添加成功，再将图片传入文件夹
        /*if(is_numeric($add) && $exname){
            //将缓存中的图片移到正确位置
            $up = move_uploaded_file($_FILES['Photo']['tmp_name'], $dir1);
        }*/

        echo "<script>parent.window.location.reload();</script>";
    }

    /**
     * 删除影评
     */
    public function movie_del(){
        $movieId = input('post.mid');

        $where['id'] = $movieId;

        //先获取图片路径，删除图片
        $data = Db::name('movie')->where($where)->field('cover')->find();

        if($data['cover']) {
            /*删除本地图片*/
            /*$dir = substr(strrchr($data['cover'], '/'), 1);
            $dir = self::moviePhotoAddr1 . $dir;
			if(is_file($dir)){
				unlink($dir);
			}*/

            /*删除七牛图片*/
            $Upload = new Upload();
            $delete = $Upload->delete($data['cover']);
        }

        $del = Db::name('movie')->where($where)->delete();

        return true;
    }

    /**
     * 编辑影评显示
     */
    public function movie_edit(){
        $id = input('get.id');
        $is_markdown = input('get.is_m');
        $movie = Db::name('movie')->where('id',$id)->find();

        $this->assign('movie',$movie);
        $this->assign('is_m',$is_markdown);
        return $this->fetch();
    }

    /**
     * 编辑影评操作
     */
    public function movie_update(){
        $movie_id = input('post.mid');
        $title = input('post.title');
        $cover = input('post.cover');
        $content = input('post.content');

        //当前时间，年月日
        $time = date('Y-m-d');

        //判断是否有更新封面图片
        if(isset($_FILES['Photo'])){
            //先删除原来的图片
            /*$deldir = substr(strrchr($cover, '/'), 1);
            $deldir = self::moviePhotoAddr1.$deldir;
			if(is_file($deldir)){
				unlink($deldir);
			}*/
            $Upload = new Upload();
            $delete = $Upload->delete($cover);

            //图片名称
            /*$filename = uniqid();
            //获取图片扩展名
            $exname = strrchr($_FILES['Photo']['name'], '.');

            //检查图片文件夹是否存在
            if(!is_dir(self::moviePhotoAddr1)){
                mkdir(self::moviePhotoAddr1, 0777);
            }

            //图片总路径-上传文件
            $dir1 = self::moviePhotoAddr1.$filename.$exname;
            //图片总路径-写入数据库
            $dir2 = self::moviePhotoAddr2.$filename.$exname;*/

            /*上传到七牛*/
            $Upload = new Upload();
            $pic_url = $Upload->one(request()->file('Photo'));

            if($pic_url) {
                //先更新数据库
                $Movie = Db::name('movie');
                $data = array();
                $data['title']   = $title;
                $data['content'] = $content;
                $data['time']    = $time;
                $data['cover']   = $pic_url;
                $up = $Movie->where('id=' . $movie_id)->update($data);
            }

            //判断是否更新成功，再将图片传入文件夹
            /*if(is_numeric($up)){
                //将缓存中的图片移到正确位置
                move_uploaded_file($_FILES['Photo']['tmp_name'], $dir1);
            }*/
        }else{
            //没有更新封面图片
            $Movie = Db::name('movie');

            $data = array();
            $data['title'] = $title;
            $data['content'] = $content;
            $data['time'] = $time;

            $up = $Movie->where('id='.$movie_id)->update($data);
        }

        //返回父页面
        echo "<script>parent.window.location.reload();</script>";
    }

    /*---------------------------------------------------------------*
     *--------------------------图文相关-----------------------------*
     *---------------------------------------------------------------*/
    const syPhotoAddr1 = './public/static/images/zuopin/'; //文件夹的地址形式
    const syPhotoAddr2 = '__IMG__/zuopin/'; //写入数据库的地址形式
    /**
     * 显示图文列表
     */
    public function photo_show(){
        $type = input('get.type');
        if($type == '') $type = 0;

        $photo = Db::name('photo')->where('type',$type)->select();

        $this->assign('photo',$photo);
        $this->assign('type',$type);
        return $this->fetch();
    }

    /**
     * 详细信息
     */
    public function photo_info(){
        $id = input('get.id');

        $photo = Db::name('photo')->where('id',$id)->find();

        $images = Db::name('images')->where('target_id',$id)->where('target',0)->select();

        $this->assign('photo',$photo);
        $this->assign('img',$images);
        return $this->fetch();
    }

    /**
     * 添加图文
     */
    public function photo_add(){
        $type = input('get.type');
        if($type == '') $type = 0;

        $this->assign('type',$type);
        return $this->fetch();
    }

    /**
     * 添加图文操作
     */
    public function photo_save(){
        $type = input('post.type'); //类型，0单图，1、2多图
        $content = input('post.content');

        //dump($_FILES['Photo']);
        if($type == 0){
            /*$file = request()->file('Photo');
            $info = $file->rule('uniqid')->move(self::syPhotoAddr1);
            if ($info) {
                // 获取图片名称
                $addr = self::syPhotoAddr2 . $info->getFilename();
            } else {
                // 上传失败获取错误信息
                echo $file->getError();
                return;
            }*/
            /*上传到七牛*/
            $Upload = new Upload();
            $addr = $Upload->one(request()->file('Photo'));

            if($addr) {
                $data_photo['content'] = $content;
                $data_photo['type'] = $type;
                $photo_id = Db::name('photo')->insertGetId($data_photo);

                $data_img['pic_url'] = $addr;
                $data_img['target_id'] = $photo_id;
                $data_img['target'] = 0;
                Db::name('images')->insertGetId($data_img);
            }
        }else{
            $data_photo['content'] = $content;
            $data_photo['type'] = $type;
            $photo_id = Db::name('photo')->insertGetId($data_photo);

            $files = request()->file('Photo');
            foreach($files as $file){
                /*$info = $file->rule('uniqid')->move(self::syPhotoAddr1);
                if($info){
                    // 获取图片名称
                    $addr = self::syPhotoAddr2 . $info->getFilename();
                }else{
                    echo $file->getError();
                    return;
                }*/
                /*上传到七牛*/
                $Upload = new Upload();
                $addr = $Upload->one($file);

                if($addr) {
                    $data_img['pic_url']   = $addr;
                    $data_img['target_id'] = $photo_id;
                    $data_img['target']    = 0;
                    Db::name('images')->insertGetId($data_img);
                }
            }
        }
        echo "<script>parent.window.location.reload();</script>";
    }

    /**
     * 删除图文
     */
    public function photo_del(){
        $pid = input('post.pid');

        Db::name('photo')->where('id',$pid)->delete();

        $img = Db::name('images')->where('target_id',$pid)->where('target',0)->select();
        foreach($img as $value){
            /*$deldir = substr(strrchr($value['pic_url'], '/'), 1);
            $deldir = self::syPhotoAddr1.$deldir;
            unlink($deldir);*/
            $Upload = new Upload();
            $Upload->delete($value['pic_url']);
        }
        Db::name('images')->where('target_id',$pid)->where('target',0)->delete();

        return true;
    }

    /**
     * 编辑图文显示
     */
    public function photo_edit(){
        $id = input('get.id');
        $type = input('get.type');

        $photo = Db::name('photo')->where('id',$id)->find();

        $images = Db::name('images')->where('target_id',$id)->where('target',0)->select();

        $this->assign('photo',$photo);
        $this->assign('img',$images);
        $this->assign('type',$type);
        return $this->fetch();
    }

    /**
     * 编辑图文操作
     */
    public function photo_update(){
        $type = input('post.type');
        $id = input('post.id');
        $content = input('post.content');

        //修改photo表数据
        $data['content'] = $content;
        Db::name('photo')->where('id',$id)->update($data);

        $is_up = 0;
        if($type == 0){
            if($_FILES['Photo']['error'] == 0) $is_up = 1; //有更新图片
        }else{
            if($_FILES['Photo']['error'][0] == 0) $is_up = 1; //没更新图片
        }
        if($is_up){
            //先删除原来的图片
            $img = Db::name('images')->where('target_id',$id)->where('target',0)->select();
            foreach($img as $value){
                /*$deldir = substr(strrchr($value['pic_url'], '/'), 1);
                $deldir = self::syPhotoAddr1.$deldir;
                unlink($deldir);*/
                $Upload = new Upload();
                $Upload->delete($value['pic_url']);
            }
            Db::name('images')->where('target_id',$id)->where('target',0)->delete();

            //添加更新图片
            if($type == 0){
                $file = request()->file('Photo');
                /*$info = $file->rule('uniqid')->move(self::syPhotoAddr1);
                if ($info) {
                    // 获取图片名称
                    $addr = self::syPhotoAddr2 . $info->getFilename();
                } else {
                    // 上传失败获取错误信息
                    echo $file->getError();
                    return;
                }*/
                $Upload = new Upload();
                $addr = $Upload->one($file);

                if($addr) {
                    $data_img['pic_url']   = $addr;
                    $data_img['target_id'] = $id;
                    $data_img['target']    = 0;
                    Db::name('images')->insertGetId($data_img);
                }
            }else{
                $files = request()->file('Photo');
                foreach($files as $file){
                    /*$info = $file->rule('uniqid')->move(self::syPhotoAddr1);
                    if($info){
                        // 获取图片名称
                        $addr = self::syPhotoAddr2 . $info->getFilename();
                    }else{
                        echo $file->getError();
                        return;
                    }*/
                    $Upload = new Upload();
                    $addr = $Upload->one($file);

                    if($addr) {
                        $data_img['pic_url']   = $addr;
                        $data_img['target_id'] = $id;
                        $data_img['target']    = 0;
                        Db::name('images')->insertGetId($data_img);
                    }
                }
            }
        }
        echo "<script>parent.window.location.reload();</script>";
    }

    /*---------------------------------------------------------------*
     *--------------------------相册相关-----------------------------*
     *---------------------------------------------------------------*/
    const xcPhotoAddr1 = './public/static/images/photo/'; //文件夹的地址形式
    const xcPhotoAddr2 = '__IMG__/photo/'; //写入数据库的地址形式

    /**
     * 显示图片列表
     */
    public function images_show(){
        $img = Db::name('images')->where('target',1)->select();

        $this->assign('img',$img);
        return $this->fetch();
    }

    /**
     * 添加图片显示
     */
    public function images_add(){
        return $this->fetch();
    }

    /**
     * 添加图片操作
     */
    public function images_save(){
        $files = request()->file('Photo');
        foreach($files as $file){
            /*$info = $file->rule('uniqid')->move(self::xcPhotoAddr1);
            if($info){
                // 获取图片名称
                $addr = self::xcPhotoAddr2 . $info->getFilename();
            }else{
                echo $file->getError();
                return;
            }*/
            $Upload = new Upload();
            $addr = $Upload->one($file);

            if($addr) {
                $data_img['pic_url']   = $addr;
                $data_img['target_id'] = 0;
                $data_img['target']    = 1;
                Db::name('images')->insertGetId($data_img);
            }
        }
        echo "<script>parent.window.location.reload();</script>";
    }

    /**
     * 删除图片
     */
    public function images_del(){
        $imgId = input('post.delImg/a');
        dump($imgId);
        foreach($imgId as $value){
            $img = Db::name('images')->where('id',$value)->find();

            /*$deldir = substr(strrchr($img['pic_url'], '/'), 1);
            $deldir = self::xcPhotoAddr1.$deldir;
            unlink($deldir);*/
            $Upload = new Upload();
            $Upload->delete($img['pic_url']);

            Db::name('images')->where('id',$value)->delete();
        }
        echo "<script>self.location=document.referrer;</script>";
    }
}