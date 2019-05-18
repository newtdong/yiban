<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class functions extends Controller
{
    //web参数，由易班网给定
    static $appid = "";
    static $appsecret = "";
    static $callback = "";



    /*
     * code检测：检测是否授权  */
    public static function ifcode($code)
    {
        $redirct_url = "location:https://openapi.yiban.cn/oauth/authorize?client_id=" . self::$appid . "&redirect_uri=" . self::$callback;
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
        if (session("access_token") != null)
            return session("access_token");
        $uri = 'https://openapi.yiban.cn/oauth/access_token';
        $post_data = array(
            'code' => $token,
            'client_id' => self::$appid,
            'client_secret' => self::$appsecret,
            'redirect_uri' => self::$callback
        );

        $response = self::posturl($uri, $post_data);
        //$response = json_decode($response, true);
        //dump($token);
        //dump($response);
        if (isset($response['access_token'])) {
            session(['access_token' => $response['access_token']]);
            return $response['access_token'];
        } else {
            header("location:https://openapi.yiban.cn/oauth/authorize?client_id=" . self::$appid . "&redirect_uri=" . self::$callback);

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

    public static function posturl($url, $data)
    {
        //$data = json_encode($data);
        $headerArray = array("Content-type:multipart/form-data;charset='utf-8'", "Accept:application/json");
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headerArray);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return json_decode($output, true);
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

        $uri = 'https://openapi.yiban.cn/user/verify_me?access_token=' . $accesstoken;
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
    public static function record()
    {
        $old_record = DB::table('user')->where('userid', session('yb_userid'))->value('score');
        $old_record = self::object2array($old_record);
        $score1 = $old_record[0]['score1'] > session("score1") ? $old_record[0]['score1'] : session("score1");
        $score2 = $old_record[0]['score2'] > session("score2") ? $old_record[0]['score2'] : session("score2");
        $score3 = $old_record[0]['score3'] > session("score3") ? $old_record[0]['score3'] : session("score3");
        $score = $score1 + $score2 + $score3;
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
            "score_1" => $score1,
            "score_2" => $score2,
            "score_3" => $score3,
            "score" => $score,
            "subtime" => time(),
            "real_name" => session('yb_realname'),
            "student_id" => session('yb_studentid'),
            "college_name" => session('yb_collegename'),
        );
        if (DB::table('user')->where('userid', session('yb_userid'))->exists()) {
//            return view('hasjoin');
            $old_score = DB::table('user')->where('userid', session('yb_userid'))->value('score');
            DB::table('user')->where('userid', session('yb_userid'))->update(['score' => $score, 'score_1' => $score1, 'score_2' => $score2, 'score_3' => $score3]);
        } else
            DB::table('user')->insert($data);
        self::rank(session('yb_schoolid'), $score, session('yb_schoolname'));
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

    public static function rank($schoolid, $score, $schoolname)
    {
        if (DB::table('school')->where('id', $schoolid)->exists()) {
            $num = DB::table('school')->where('id', $schoolid)->value('num');
            $sum = DB::table('school')->where('id', $schoolid)->value('sum');
            $max = DB::table('school')->where('id', $schoolid)->value('max');
            $num++;
            $sum = $sum + $score;
            $avage = $sum / $num;
            if ($score > $max)
                $max = $score;
            DB::table('school')->where('id', $schoolid)->update(['num' => $num, 'sum' => $sum, 'max' => $max, 'avage' => $avage]);
        } else {
            DB::table('school')->insert(
                ['id' => $schoolid,
                    'name' => $schoolname,
                    'num' => 1,
                    'sum' => $score,
                    'max' => $score,
                    'avage' => $score
                ]);
        }

    }

    public static function ifsessonname()
    {
        //dump(session('yb_userid'));
        if (session('yb_userid') != null)
            return 0;
        else {
            //echo "wewewe";
            return 1;
        }
    }

    public static function ifmobile()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false || preg_match('/QQBrowser/i', $_SERVER['HTTP_USER_AGENT'])) {
            return true;
        } else {
            return false;
        }
    }
}
