<?php
namespace app\index\controller;

use think\Controller;
use think\config;
use think\Validate;
use think\Request;
use think\Db;
use think\Session;

class Index extends Controller
{
    //
    /*public function _base(){
        return $this->fetch();
    }*/

    //首页
    public function index(){
        return $this->fetch();
    }

    //个人介绍
    public function card(){
        return $this->fetch();
    }

    //微博页
    public function weibo(){
        $data = Db::name('weibo')->order('id desc')->paginate(15);

        $this->assign('list', $data);
        return $this->fetch();
    }
}
