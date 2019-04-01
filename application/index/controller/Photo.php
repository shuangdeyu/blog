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
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->labelColor = array('#5fc0a7', '#a7c299', '#9597ca', '#c7a7d2', '#b8a1a9', '#fcae62', '#098ec4', '#b2103e',
            '#ef342a', '#076750', '#8fd1cd', '#b4d6f2', '#ffd00d', '#be3223', '#f79d8b', '#6dade2', '#b5a87f');
    }

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

    // 豆瓣电实验验站点
    public function douban_film() {
        $tag = trim(input('get.tag', ''));
        $order = trim(input('get.order', 'release')); // rank 评分，recommend 评价数(热度), release 上映时间

        $conf = Config::get('database')['db_config2'];
        // 获取tags列表
        $tags = Db::connect($conf)->table('q_tag')->field('id, name, color')->order('`order` asc')->select();
//        $new_tags = array();
//        $len_color = count($this->labelColor) - 1;
//        foreach ($tags as $k=>$v) {
//            $l = rand(0, $len_color);
//            $new_tags[$k] = array(
//                "id" => $v['id'],
//                "name" => $v['name'],
//                "color" => $this->labelColor[$l],
//            );
//        }
        // 获取电影列表
        $tag == '全部' ? $tag = '' : $tag;
        if ($order != 'rank' && $order != 'recommend' && $order != 'release') {
            $order = 'release';
        }
        switch ($order) {
            case 'rank':        $w_order = "rating_num desc"; break;
            case 'recommend':   $w_order = "rating_people desc"; break;
            case 'release':     $w_order = "release_date desc"; break;
            default:            $w_order = "release_date desc"; break;
        }
        $list = Db::connect($conf)->table('q_movie')
            ->where('tags', 'like', '%' . $tag . '%')
            ->order($w_order)
            ->paginate(20, false, [
                'query' => ['tag' => $tag, 'order' => $order],
            ]);



        $url = 'https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2541901817.jpg';
        $img = "http://qiniucdn.shuangdeyu.com/blog9f6ac201903181512463831.jpg";
        $path = ROOT_PATH ."public".DS."static".DS."images".DS."testsst".DS;
//        echo $path;
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        if(empty($img)){
            return false;
        }
        //获取图片信息大小
        $imgSize = getImageSize($img);
        if(!in_array($imgSize['mime'],array('image/jpg', 'image/gif', 'image/png', 'image/jpeg'),true)){
            return false;
        }
        //获取后缀名
        $_mime = explode('/', $imgSize['mime']);
        $_ext = '.'.end($_mime);
        if(empty($fileName)){  //生成唯一的文件名
            $fileName = uniqid(time(),true).$_ext;
        }
        //开始攫取
        ob_start();
        readfile($img);
        $imgInfo = ob_get_contents();
        ob_end_clean();

        $fp = fopen($path.$fileName, 'a');
        $imgLen = strlen($imgInfo);    //计算图片源码大小
        $_inx = 1024;   //每次写入1k
        $_time = ceil($imgLen/$_inx);
        for($i=0; $i<$_time; $i++){
            fwrite($fp,substr($imgInfo, $i*$_inx, $_inx));
        }
        fclose($fp);
        echo $path.$fileName;

        

        $tag == '' ? $tag = '全部' : $tag;
        $this->assign('tags', $tags);
//        $this->assign('tags', $new_tags);
        $this->assign('list', $list);
        $this->assign('tag', $tag);
        $this->assign('order', $order);
//        return $this->fetch();
    }
}