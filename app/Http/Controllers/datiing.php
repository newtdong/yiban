<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psr\Log\NullLogger;
use App\Http\Controllers\functions;
class datiing extends Controller
{
    //


    public function index(Request $request)
    {
       $flag=functions::ifsessonname();
        if($flag==1)
            return view('jump');

        /*检测是否已经参与过此活动*/

        if(!functions::ifjoin()){
            return view('hasjoin');
        }
        /*获取题目数据*/
        $sub = DB::table('question')->inRandomOrder()->limit(functions::$sum)->get();
        $sub = functions::object2array($sub);
        //dump($sub);
        foreach ($sub as $key=>$value)
            $answer[$value->id]=$value->answer;
        /*存储答案*/
            session(['answer'=>$answer]);
            /*存储本次请求的时间戳*/
        session(['starttime'=>$_SERVER['REQUEST_TIME']]);
        return view('datiing',['sub'=>$sub,'sum'=>1]);
    }

}
