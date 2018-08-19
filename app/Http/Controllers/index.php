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
        //dump($code);

        /*获取学生信息并存入session*/
        $info=functions::getinfo($accesstoken);
/*
 * 展示首页
 * */

        return view('index');
    }



}