<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\functions;

class index extends Controller
{

    public function index(Request $request)
    {

        //dump($request);
        $code = functions::ifcode($request['code']);
        $accesstoken = functions::getaccesstoken($code);
        $info = functions::getinfo($accesstoken);
        $flag = functions::ifsessonname();
        if ($flag == 1)
            return view('jump');
        //dump($accesstoken);
        //dump($info);
        //dump($request);
        //dump($code);
        if (functions::ifmobile()) {
            return view('gobrowser');
        } else
            return view('index');


        /*获取学生信息并存入session*/

        /*
         * 展示首页
         * */
//dump($code);


    }


}
