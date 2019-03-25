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
        $tag_id = trim(input('get.tag_id', ''));
        $data = Db::name('movie')
            ->where('title', 'like', '%' . $search . '%')
            ->order('id desc')
            ->paginate(10, false, [
                'query' => ['search'=>$search],
            ]);

        // 获取tag列表
        $tags = Db::name('tag')->select();

        $this->assign('list', $data);
        $this->assign('tags', $tags);
        $this->assign('search_str', $search);
        return $this->fetch();
    }

    public function content(){
        $movieId = input('get.mid');

        $data = Db::name('movie')->where('id',$movieId)->find();

        $this->assign('con', $data);
        return $this->fetch();
    }

    /**
     * 获取tags名称
     */
    public function tags_name($tags) {
        $list = explode($tags, ',');
        if (is_array($list) && count($list) > 0) {
            $tmp = '';
            foreach ($list as $v) {
                if ($v != '') {
                    $tag = Db::name('tag')->where('id', $v)->find();
                    $tmp .= '<span class="label ' . $tag['css'] . '">' . $tag['name'] . '</span>';
                }
            }
            return $tmp;
        }
        return '';
    }
}