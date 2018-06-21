<?php
namespace app\admin\controller;

use think\Controller;
use think\config;
use think\Validate;
use think\Request;
use think\Db;
use think\Session;

class Index extends Controller
{
    //
    public function index(){
        return $this->fetch();
    }
}
