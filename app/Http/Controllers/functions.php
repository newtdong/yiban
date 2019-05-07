<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class functions extends Controller
{
    //web参数，由易班网给定
    static $appid = "be70db817cd306a9";
    static $appsecret = "33b7ab89941f22a18263fdd1c88b0c3b";
    static $callback = "http://yiban2.dlink.com";
    /*题目数量*/
    static $sum=25;

    /*
     * code检测：检测是否授权  */
    public static function ifcode($code)
    {
        $redirct_url="location:https://oauth.yiban.cn/code/html?client_id=".self::$appid."&redirect_uri=".self::$callback;
        if ($code)
            return $code;
        else
            header($redirct_url);
    }

    /*
     * 获取access_token
     * */
    public static function getaccesstoken($token)
    {
        $uri = 'https://oauth.yiban.cn/token/info?code=' . $token . '&client_id=' . self::$appid . '&client_secret=' . self::$appsecret . '&redirect_uri='.self::$callback;
        $response = self::requir($uri);
        $response = json_decode($response, true);
        //dump($token);
        //var_dump($response);
        if (isset($response['access_token'])) {
            session(['access_token' => $response['access_token']]);
            return $response['access_token'];
        } else {
            header("location:https://oauth.yiban.cn/code/html?client_id=".self::$appid."&redirect_uri=".self::$callback);

        }

    }

    /*
     * 请求API
     * return:请求结果
     * */
    public static function requir($uri)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Yi OAuth2 v0.1');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $response = curl_exec($ch);
        //dump($response);
        return $response;
    }

    /*
     * 获取用户信息
     * */
    public static function getinfo($accesstoken)
    {
        $uri = 'https://openapi.yiban.cn/user/me?access_token=' . $accesstoken;
        $info = self::requir($uri);
        $info = json_decode($info, true);
        //dump($info);
        session($info['info']);
        return $info;

    }

    /*
     * 是否参加过此活动*/
    public static function ifjoin()
    {
        if (DB::table('user')->where('userid', session('yb_userid'))->exists()) {
            //echo "wrong";
            return false;
        } else {
            return true;
        }
    }

    /*
     * 记录参加记录
     * */
    public static function record($score, $time)
    {
        $data = array(
            "userid" => session('yb_userid'),
            "username" => session('yb_username'),
            "usernick" => session('yb_usernick'),
            "sex" => session('yb_sex'),
            "money" => session('yb_money'),
            "userhead" => session('yb_userhead'),
            "schoolid" => session('yb_schoolid'),
            "schoolname" => session('yb_schoolname'),
            "regtime" => session('yb_regtime'),
            "score" => $score,
            "subtime" => time(),
            "time" => $time,
        );
        if (DB::table('user')->where('userid', session('yb_userid'))->exists()) {
//            return view('hasjoin');
            DB::table('user')->where('userid', session('yb_userid'))->update(['score'=>$score]);
        } else
            DB::table('user')->insert($data);
            self::rank(session('yb_schoolid'),$score,session('yb_schoolname'));
    }

    /*object转array*/
    public static function object2array($object)
    {
        if (is_object($object)) {
            foreach ($object as $key => $value) {
                $array[$key] = $value;
            }
        } else {
            $array = $object;
        }
        return $array;
    }
    public static function rank($schoolid,$score,$schoolname){
        if (DB::table('school')->where('id',$schoolid)->exists()) {
            $num=DB::table('school')->where('id',$schoolid)->value('num');
            $sum=DB::table('school')->where('id',$schoolid)->value('sum');
            $max=DB::table('school')->where('id',$schoolid)->value('max');
            $num++;
            $sum=$sum+$score;
            $avage=$sum/$num;
            if($score>$max)
                $max=$score;
         DB::table('school')->where('id',$schoolid)->update(['num'=>$num,'sum'=>$sum,'max'=>$max,'avage'=>$avage]);
        }
        else
        {
            DB::table('school')->insert(
                ['id'=>$schoolid,
                'name'=>$schoolname,
                'num'=>1,
                'sum'=>$score,
                'max'=>$score,
                'avage'=>$score
                ]);
        }

    }
    public static function ifsessonname(){
        //dump(session('yb_userid'));
        if(session('yb_userid')!=null)
            return 0;
        else
        {
            //echo "wewewe";
           return 1;
        }
    }
    public static function ifmobile() {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false||preg_match('/QQBrowser/i',$_SERVER['HTTP_USER_AGENT' ])) {
            return true;
        } else {
            return false;
        }
}
}
