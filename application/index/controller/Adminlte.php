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
}