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

    /**
     * 获取最新评论
     */
    public function getCommentList()
    {
        $headers = array(
            'X-LC-Id:' . config('LeancloudAppId'),
            'X-LC-Key:' . config('LeancloudMasterKey') . ',master',
        );
        $url = urlencode(config('LeancloudGetClassUrl') . 'Comment?where={"is_read":0}&limit=100&&order=-updatedAt');
        $data = curlGet($url, $headers);
        $data = '{
    "results":[
        {
            "nick":"Anonymous",
            "updatedAt":"2019-03-13T15:55:19.807Z",
            "objectId":"5c8927e7fe88c20065efb729",
            "mail":"",
            "ua":"Mozilla\/5.0(WindowsNT10.0;Win64;x64)AppleWebKit\/537.36(KHTML,
            likeGecko)Chrome\/70.0.3534.4Safari\/537.36",
            "insertedAt":{
                "__type":"Date",
                "iso":"2019-03-13T15:55:17.282Z"
            },
            "createdAt":"2019-03-13T15:55:19.807Z",
            "link":"",
            "is_read":0,
            "comment":"学习了，很好的教程",
            "url":"http:\/\/xf.shuangdeyu.com\/movie\/content.html?mid=29"
        },
        {
            "nick":"Anonymous",
            "updatedAt":"2019-03-13T16:26:12.521Z",
            "objectId":"5c892f24fe88c20065f02ca9",
            "mail":"",
            "ua":"Mozilla\/5.0(WindowsNT10.0;Win64;x64)AppleWebKit\/537.36(KHTML,
            likeGecko)Chrome\/70.0.3534.4Safari\/537.36",
            "insertedAt":{
                "__type":"Date",
                "iso":"2019-03-13T16:26:09.905Z"
            },
            "createdAt":"2019-03-13T16:26:12.521Z",
            "link":"",
            "is_read":0,
            "comment":"\u270a<\/p>\n很棒，膜拜大佬dasfdsgfdsgdgdfgdfgdfgdfgdfgdrfgrgr",
            "url":"http:\/\/xf.shuangdeyu.com\/movie\/content.html?mid=29"
        }
    ],
    "cursor":null
}1';
        $data = substr($data, 0, -1);
        $data = trim($data); //清除字符串两边的空格
        $data = preg_replace("/\t/", "", $data); // 使用正则表达式替换内容，如：空格，换行，并将替换为空。
        $data = preg_replace("/\r\n/", "", $data);
        $data = preg_replace("/\r/", "", $data);
        $data = preg_replace("/\n/", "", $data);
        $data = preg_replace("/ /", "", $data);
        $data = preg_replace("/  /", "", $data);  // 匹配html中的空格
        $arr = json_decode(utf8_encode($data), true); // 带有Unicode，注意编码成utf8
        $comment = array();
        if (isset($arr['results']) && count($arr['results']) > 0) {
            foreach ($arr['results'] as $k => $v) {
                $comment[$k] = array(
                    'id' => $v['objectId'],
                    'nick' => $v['nick'],
                    'link' => $v['link'],
                    'createdAt' => date("Y-m-d H:i:s", strtotime($v['createdAt'])),
                    'url' => $v['url'],
                    'comment' => $v['comment'],
                );
            }
        }
        return showRes(0, 'success', 'json', $comment);
    }

    /**
     * 评论页
     */
    public function comment() {
        return $this->fetch();
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
    public function weibo_del()
    {
        $wid = input('post.wid');
        Db::name('weibo')->where('id', $wid)->delete();
        return true;
    }

    /**
     * 添加微博界面
     */
    public function weibo_add()
    {
        return $this->fetch();
    }

    /**
     * 保存添加
     */
    public function weibo_save()
    {
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
    public function weibo_info()
    {
        $id = input('get.id');

        $weibo = Db::name('weibo')->where('id', $id)->find();

        $this->assign('weibo', $weibo);
        return $this->fetch();
    }

    /**
     * 编辑微博
     */
    public function weibo_edit()
    {
        $id = input('post.id');
        $name = input('post.name');
        $link = input('post.link');
        $content = input('post.content');

        $data['name'] = $name;
        $data['link'] = $link;
        $data['content'] = $content;
        Db::name('weibo')->where('id', $id)->update($data);

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
    public function movie_show()
    {
        $movie = Db::name('movie')->order('id desc')->paginate(15);

        $this->assign('movie', $movie);
        return $this->fetch();
    }

    /**
     * 影评详细信息
     */
    public function movie_info()
    {
        $id = input('get.id');
        $movie = Db::name('movie')->where('id', $id)->find();

        $this->assign('movie', $movie);
        return $this->fetch();
    }

    /**
     * 添加影评界面
     */
    public function movie_add()
    {
        $m = input('get.m');

        $this->assign('is_m', $m);
        return $this->fetch();
    }

    /**
     * 添加新影评
     */
    public function movie_save()
    {
        //接收表单
        $title = input('post.title');
        $content = input('post.content');
        $is_markdown = input('post.is_markdown');

        //当前时间，年月日
        $time = date('Y-m-d');

        /*上传到七牛*/
        $Upload = new Upload();
        $pic_url = $Upload->one(request()->file('Photo'));

        if ($pic_url) {
            //先添加进数据库
            $Movie = Db::name('movie');
            $data = array();
            $data['title'] = $title;
            $data['content'] = $content;
            $data['time'] = $time;
            $data['cover'] = $pic_url;
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
    public function movie_del()
    {
        $movieId = input('post.mid');

        $where['id'] = $movieId;

        //先获取图片路径，删除图片
        $data = Db::name('movie')->where($where)->field('cover')->find();

        if ($data['cover']) {
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
    public function movie_edit()
    {
        $id = input('get.id');
        $is_markdown = input('get.is_m');
        $movie = Db::name('movie')->where('id', $id)->find();

        $this->assign('movie', $movie);
        $this->assign('is_m', $is_markdown);
        return $this->fetch();
    }

    /**
     * 编辑影评操作
     */
    public function movie_update()
    {
        $movie_id = input('post.mid');
        $title = input('post.title');
        $cover = input('post.cover');
        $content = input('post.content');

        //当前时间，年月日
        $time = date('Y-m-d');

        //判断是否有更新封面图片
        if (isset($_FILES['Photo']) && $_FILES['Photo']['name'] != '') {
            $Upload = new Upload();
            $delete = $Upload->delete($cover);

            /*上传到七牛*/
            $Upload = new Upload();
            $pic_url = $Upload->one(request()->file('Photo'));

            if ($pic_url) {
                //先更新数据库
                $Movie = Db::name('movie');
                $data = array();
                $data['title'] = $title;
                $data['content'] = $content;
                $data['time'] = $time;
                $data['cover'] = $pic_url;
                $up = $Movie->where('id=' . $movie_id)->update($data);
            }
        } else {
            //没有更新封面图片
            $Movie = Db::name('movie');

            $data = array();
            $data['title'] = $title;
            $data['content'] = $content;
            $data['time'] = $time;

            $up = $Movie->where('id=' . $movie_id)->update($data);
        }

        //返回父页面
        echo "<script>history.go(-2);</script>";
    }

    /*---------------------------------------------------------------*
     *--------------------------图文相关-----------------------------*
     *---------------------------------------------------------------*/
    const syPhotoAddr1 = './public/static/images/zuopin/'; //文件夹的地址形式
    const syPhotoAddr2 = '__IMG__/zuopin/'; //写入数据库的地址形式

    /**
     * 显示图文列表
     */
    public function photo_show()
    {
        $type = input('get.type');
        if ($type == '') $type = 0;

        $photo = Db::name('photo')->where('type', $type)->select();

        $this->assign('photo', $photo);
        $this->assign('type', $type);
        return $this->fetch();
    }

    /**
     * 添加图文
     */
    public function photo_add()
    {
        $type = input('get.type');
        if ($type == '') $type = 0;

        $this->assign('type', $type);
        return $this->fetch();
    }

    /**
     * 添加图文操作
     */
    public function photo_save()
    {
        $type = input('post.type'); //类型，0单图，1、2多图
        $content = input('post.content');

        if (!request()->file('Photo')) {
            $this->error("图片未选择", null, "", 1);
        }

        if ($type == 0) {
            /*上传到七牛*/
            $Upload = new Upload();
            $addr = $Upload->one(request()->file('Photo'));

            if ($addr) {
                $data_photo['content'] = $content;
                $data_photo['type'] = $type;
                $photo_id = Db::name('photo')->insertGetId($data_photo);

                $data_img['pic_url'] = $addr;
                $data_img['target_id'] = $photo_id;
                $data_img['target'] = 0;
                Db::name('images')->insertGetId($data_img);
            }
        } else {
            $data_photo['content'] = $content;
            $data_photo['type'] = $type;
            $photo_id = Db::name('photo')->insertGetId($data_photo);

            $files = request()->file('Photo');
            foreach ($files as $file) {
                /*上传到七牛*/
                $Upload = new Upload();
                $addr = $Upload->one($file);

                if ($addr) {
                    $data_img['pic_url'] = $addr;
                    $data_img['target_id'] = $photo_id;
                    $data_img['target'] = 0;
                    Db::name('images')->insertGetId($data_img);
                }
            }
        }
        $url = url('index/adminlte/photo_show');
        echo "<script>window.location.href='$url';</script>";
    }

    /**
     * 删除图文
     */
    public function photo_del()
    {
        $pid = input('post.pid');

        Db::name('photo')->where('id', $pid)->delete();

        $img = Db::name('images')->where('target_id', $pid)->where('target', 0)->select();
        foreach ($img as $value) {
            $Upload = new Upload();
            $Upload->delete($value['pic_url']);
        }
        Db::name('images')->where('target_id', $pid)->where('target', 0)->delete();

        return true;
    }

    /**
     * 编辑图文显示
     */
    public function photo_edit()
    {
        $id = input('get.id');
        $type = input('get.type');

        $photo = Db::name('photo')->where('id', $id)->find();
        $images = Db::name('images')->where('target_id', $id)->where('target', 0)->select();

        $this->assign('photo', $photo);
        $this->assign('img', $images);
        $this->assign('type', $type);
        return $this->fetch();
    }

    /**
     * 编辑图文操作
     */
    public function photo_update()
    {
        $type = input('post.type');
        $id = input('post.id');
        $content = input('post.content');

        //修改photo表数据
        $data['content'] = $content;
        Db::name('photo')->where('id', $id)->update($data);

        $is_up = 0;
        if ($type == 0) {
            if ($_FILES['Photo']['error'] == 0) $is_up = 1; //有更新图片
        } else {
            if ($_FILES['Photo']['error'][0] == 0) $is_up = 1; //没更新图片
        }
        if ($is_up) {
            //先删除原来的图片
            $img = Db::name('images')->where('target_id', $id)->where('target', 0)->select();
            foreach ($img as $value) {
                $Upload = new Upload();
                $Upload->delete($value['pic_url']);
            }
            Db::name('images')->where('target_id', $id)->where('target', 0)->delete();

            //添加更新图片
            if ($type == 0) {
                $file = request()->file('Photo');
                $Upload = new Upload();
                $addr = $Upload->one($file);

                if ($addr) {
                    $data_img['pic_url'] = $addr;
                    $data_img['target_id'] = $id;
                    $data_img['target'] = 0;
                    Db::name('images')->insertGetId($data_img);
                }
            } else {
                $files = request()->file('Photo');
                foreach ($files as $file) {
                    $Upload = new Upload();
                    $addr = $Upload->one($file);

                    if ($addr) {
                        $data_img['pic_url'] = $addr;
                        $data_img['target_id'] = $id;
                        $data_img['target'] = 0;
                        Db::name('images')->insertGetId($data_img);
                    }
                }
            }
        }
        echo "<script>history.go(-2)</script>";
    }

    /*---------------------------------------------------------------*
     *--------------------------相册相关-----------------------------*
     *---------------------------------------------------------------*/
    const xcPhotoAddr1 = './public/static/images/photo/'; //文件夹的地址形式
    const xcPhotoAddr2 = '__IMG__/photo/'; //写入数据库的地址形式

    /**
     * 显示图片列表
     */
    public function images_show()
    {
        $img = Db::name('images')->where('target', 1)->select();

        $this->assign('img', $img);
        return $this->fetch();
    }

    /**
     * 添加图片显示
     */
    public function images_add()
    {
        return $this->fetch();
    }

    /**
     * 添加图片操作
     */
    public function images_save()
    {
        $files = request()->file('Photo');
        foreach ($files as $file) {
            $Upload = new Upload();
            $addr = $Upload->one($file);

            if ($addr) {
                $data_img['pic_url'] = $addr;
                $data_img['target_id'] = 0;
                $data_img['target'] = 1;
                Db::name('images')->insertGetId($data_img);
            }
        }
        $url = url('index/adminlte/images_show');
        echo "<script>window.location.href='$url';</script>";
    }

    /**
     * 删除图片
     */
    public function images_del()
    {
        $imgId = input('post.delImg/a');
        foreach ($imgId as $value) {
            $img = Db::name('images')->where('id', $value)->find();

            $Upload = new Upload();
            $Upload->delete($img['pic_url']);

            Db::name('images')->where('id', $value)->delete();
        }
        echo "<script>self.location=document.referrer;</script>";
    }
}