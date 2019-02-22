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
            $this->success('登陆成功',url('index/adminlte/main'));
        }else{
            echo "<script>alert('用户名或密码错误');history.go(-1);</script>";
        }
    }
}