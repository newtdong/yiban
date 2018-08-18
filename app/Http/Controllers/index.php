<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\functions;
class index extends Controller
{

    public function index(Request $request){
        $code=functions::ifcode($request['code']);
        $accesstoken=functions::getaccesstoken($code);
        //dump($request);
        /*
         * 检测是否已经参与过活动
         * */
        if(!functions::ifjoin()){
            return view('hasjoin');
        }
        //dump(session('yb_userid'));
        echo session('yb_username');

/*
 * 展示首页
 * */
$info=functions::getinfo($accesstoken);
functions::record(12,12);
dump($info);
        return view('index');
    }
    public function submit(){

    }


}