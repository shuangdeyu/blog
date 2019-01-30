<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/6
 * Time: 15:21
 */

namespace app\index\controller;

use think\Controller;
use think\config;
use think\Validate;
use think\Request;
use think\Db;
use think\Session;

class Movie extends Controller
{
    public function index(){
        $search = trim(input('get.search', ''));
        $data = Db::name('movie')
            ->where('title', 'like', '%' . $search . '%')
            ->order('id desc')
            ->paginate(10, false, [
                'query' => ['search'=>$search],
            ]);

        $this->assign('list', $data);
        $this->assign('search_str', $search);
        return $this->fetch();
    }

    public function content(){
        $movieId = input('get.mid');

        $data = Db::name('movie')->where('id',$movieId)->find();

        $this->assign('con', $data);
        return $this->fetch();
    }
}