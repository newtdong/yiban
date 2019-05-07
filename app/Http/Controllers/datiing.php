<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psr\Log\NullLogger;
use App\Http\Controllers\functions;

class datiing extends Controller
{

    /*答题闯关之第一关*/
    public function index(Request $request)
    {
        $flag = functions::ifsessonname();
        if ($flag == 1)
            return view('jump');

        /*检测是否已经参与过此活动*/

//        if (!functions::ifjoin()) {
//            if (functions::ifmobile())
//                return view('gobrowser');
//            else
//                return view('hasjoin');
//        }
        /*获取题目数据*/
        $sub = DB::table('question')->inRandomOrder()->limit(functions::$sum)->get();
        $sub = functions::object2array($sub);
        //dump($sub);
        foreach ($sub as $key => $value)
            $answer[$value->id] = $value->answer;
        /*存储答案*/
        session(['answer' => $answer]);
        /*存储本次请求的时间戳*/
        session(['starttime' => $_SERVER['REQUEST_TIME']]);
        if (functions::ifmobile())
            return view('gobrowser', ['sub' => $sub, 'sum' => 1]);
        else
            return view('datiing', ['sub' => $sub, 'sum' => 1]);
    }

    /*答题闯关之第二关*/
    public function lev2()
    {
        $lev2_ = env("LEV2_SINGLE");
    }

    /*答题闯关之第三关*/
    public function lev3()
    {
        $lev3_blank = env("LEV3_BLANK");
        $que_blank=DB::table("question2")->inRandomOrder()->limit($lev3_blank)->get();
        dump($que_blank);
    }

}
