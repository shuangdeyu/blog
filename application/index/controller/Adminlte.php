<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/22 0022
 * Time: 16:15
 */

namespace app\index\controller;


use think\Controller;
use think\Db;
use think\Request;
use think\Session;

/**
 * 本来是基于Adminlte框架的后台，先改成基于Gentelella
 * @package app\index\controller
 */

class Adminlte extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    /*---------------------------------------------------------------*
     *--------------------------登录相关-----------------------------*
     *---------------------------------------------------------------*/
    /**
     * 登录首页
     */
    public function index()
    {
        $user_id = Session::get('userId');
        if ($user_id != "") {
            $this->redirect('main');
        }
        return $this->fetch();
    }

    /**
     * 主页
     */
    public function main()
    {
        /*$user_name = Session::get('user');
        $this->assign('user',$user_name);*/
        // 获取微博数量
        $w_num = Db::name('weibo')->count("*");
        // 获取文章数量
        $a_num = Db::name('movie')->count("*");
        // 获取相册数量
        $i_num = Db::name('images')->count("*");

        $this->assign('w_num', $w_num);
        $this->assign('a_num', $a_num);
        $this->assign('i_num', $i_num);
        return $this->fetch();
    }

    /**
     * 登录验证
     */
    public function login()
    {
        $user = $_POST['user'];
        $password = md5($_POST['password']);

        $Admin = Db::name('admin');
        $where = array();
        $where['user'] = $user;
        $where['password'] = $password;
        $con = $Admin->where($where)->find();

        if ($con) {
            Session::set('user', $user);
            Session::set('userId', $con['id']);
            $this->success('登陆成功', url('index/adminlte/main'));
        } else {
            echo "<script>alert('用户名或密码错误');history.go(-1);</script>";
        }
    }

    /**
     * 退出登录
     */
    public function loginout()
    {
        Session::clear();
        $this->redirect(url('index/adminlte/index'));
    }

    /*---------------------------------------------------------------*
     *--------------------------微博相关-----------------------------*
     *---------------------------------------------------------------*/
    /**
     * 显示微博
     */
    public function weibo_show()
    {
        $weibo = Db::name('weibo')->order('id desc')->paginate(15);

        $this->assign('weibo', $weibo);
        return $this->fetch();
    }

    /**
     * 删除微博
     */
    public function weibo_del(){
        $wid = input('post.wid');
        Db::name('weibo')->where('id',$wid)->delete();
        return true;
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
        $url = url('index/adminlte/weibo_show');
        echo "<script>window.location.href='$url';</script>";
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
        echo '<script>history.go(-2);</script>';
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

        //返回到父页面
        $url = url('index/adminlte/movie_show');
        echo "<script>window.location.href='$url';</script>";
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
        if(isset($_FILES['Photo']) && $_FILES['Photo']['name'] != ''){
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
}