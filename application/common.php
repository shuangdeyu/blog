<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 设置ajax跨域头文件，允许跨域
 */
function setAjaxHead()
{
    header("Access-Control-Allow-Origin:*"); //*号表示所有域名都可以访问
    header("Access-Control-Allow-Method:POST,GET");
}

/**
 * 按综合方式输出通信数据
 * @param integer $code 状态码
 * @param string $message 提示信息
 * @param string $type 数据类型
 * return string
 */
function showRes($code, $message = '', $type = 'default', $data = [])
{
    $type = strtolower($type);

    switch ($type) {
        case 'default':
            echo $message;
            break;
        case 'json':
            showJson($code, $message, $data);
            break;
    }
}

/**
 * 按json方式输出通信数据
 * @param integer $code 状态码
 * @param string $message 提示信息
 * return string
 */
function showJson($code, $message = '', $data = array())
{
    $result = array(
        'code' => $code,
        'msg' => $message,
        'data' => $data
    );
    echo json_encode($result);
}

/**
 * Unicode转utf8
 * @param $str
 * @return null|string|string[]
 */
function decodeUnicode($str)
{
    return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
        create_function(
            '$matches',
            'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
        ),
        $str);
}

/**
 * 发送get请求
 * @param $url
 * @param array $headers
 * @return mixed
 */
function curlGet($url, $headers = array())
{
    //初始化
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $url);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 0);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //执行命令
    $data = curl_exec($curl);
    //关闭URL请求
    curl_close($curl);
    return $data;
}

/**
 * 发送put请求
 * @param $url
 * @param $data
 * @return mixed
 */
function putUrl($url, $data)
{
    $data = json_encode($data);
    $ch = curl_init(); //初始化CURL句柄
    curl_setopt($ch, CURLOPT_URL, $url); //设置请求的URL
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); //设置请求方式
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//设置提交的字符串
    $output = curl_exec($ch);
    curl_close($ch);
    return json_decode($output, true);
}