<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/6
 * Time: 16:14
 */

namespace app\index\controller;

use think\Controller;
use think\config;
use think\Validate;
use think\Request;
use think\Db;
use think\Session;

class Photo extends Controller
{
    public function shan(){
        $data = Db::table('tp_photo p')
            ->join('tp_images i','p.id = i.target_id and i.target = 0')
            ->field('p.id,p.content,i.pic_url')
            ->where('p.type',0)
            ->select();

        $this->assign('data',$data);
        return $this->fetch();
    }

    public function ren(){
        $con = Db::name('photo')->where('type',1)->find();
        $img = Db::name('images')->where('target_id',$con['id'])->where('target',0)->select();

        $this->assign('con',$con);
        $this->assign('img',$img);
        return $this->fetch();
    }

    public function xian(){
        $con = Db::name('photo')->where('type',2)->find();
        $img = Db::name('images')->where('target_id',$con['id'])->where('target',0)->select();

        $this->assign('con',$con);
        $this->assign('img',$img);
        return $this->fetch();
    }

    public function view(){
        $img = Db::name('images')->where('target',1)->select();

        $this->assign('img',$img);
        return $this->fetch();
    }

    public function net(){
        return $this->fetch();
    }
}