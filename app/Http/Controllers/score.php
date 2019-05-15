<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\functions;
use App\Http\Controllers\datiing;

class score extends Controller
{
    //
    public function index1(Request $request)
    {
        $user_answer = functions::object2array($request->request);

        /*选择题处理*/
        $true_ans_single = 0;
        $true_ans_multi = 0;
        $ans_select = session("answer_select");
        $user_ans_select = json_decode($user_answer["ans_select"]);
        $user_ans_select = functions::object2array($user_ans_select);
        $true_ans_select = array_intersect_assoc($user_ans_select, $ans_select);
        foreach ($true_ans_select as $item) {
            if (strlen($item) == 1)
                $true_ans_single++;
            else
                $true_ans_multi++;

        }

        $score_select = $true_ans_single * env("LEV1_SINGLE_SCORE")+$true_ans_multi*env("LEV1_MULTI_SCORE");;

        /*填空题处理*/
        $score_blank = 0;
        if (env("LEV1_BLANK")!=0) {
            $ans_blank = session("answer_blank");
            $user_ans_blank = json_decode($user_answer["ans_blank"]);
            $user_ans_blank = functions::object2array($user_ans_blank);
            $true_ans_blank = array_intersect_assoc($user_ans_blank, $ans_blank);
            $true_ans_blank = count($true_ans_blank);
            //dump($true_ans_blank);
            $score_blank = $true_ans_blank * env("LEV1_BLANK_SCORE");
        }


        $score = $score_select + $score_blank;
        session(["score1"=>$score]);
        if($score<env("LINE_LEV1"))
        {
            echo "<script>alert('亲，分数不够呢，请重新答题！');parent.location.href='/datiing1';</script>";
        }
        if (functions::ifmobile())
            return view('gobrowser');
        else
            return view('lev_jump', ['score' => $score, 'lev' => "一", "lev_n" => "二","next"=>"datiing2"]);
    }

    public function index2(Request $request)
    {
        $user_answer = functions::object2array($request->request);

        /*选择题处理*/
        $true_ans_single = 0;
        $true_ans_multi = 0;
        $ans_select = session("answer_select");
        $user_ans_select = json_decode($user_answer["ans_select"]);
        $user_ans_select = functions::object2array($user_ans_select);
        $true_ans_select = array_intersect_assoc($user_ans_select, $ans_select);
        foreach ($true_ans_select as $item) {
            if (strlen($item) == 1)
                $true_ans_single++;
            else
                $true_ans_multi++;

        }

        $score_select = $true_ans_single * env("LEV2_SINGLE_SCORE")+$true_ans_multi*env("LEV2_MULTI_SCORE");;

        /*填空题处理*/
        $score_blank = 0;
        if (env("LEV1_BLANK")!=0) {
            $ans_blank = session("answer_blank");
            $user_ans_blank = json_decode($user_answer["ans_blank"]);
            $user_ans_blank = functions::object2array($user_ans_blank);
            $true_ans_blank = array_intersect_assoc($user_ans_blank, $ans_blank);
            $true_ans_blank = count($true_ans_blank);
            //dump($true_ans_blank);
            $score_blank = $true_ans_blank * env("LEV2_BLANK_SCORE");
        }


        $score = $score_select + $score_blank;
        session(["score2"=>$score]);
        if($score<env("LINE_LEV1"))
        {
            echo "<script>alert('亲，分数不够呢，请重新答题！');parent.location.href='/datiing2';</script>";
        }

        if (functions::ifmobile())
            return view('gobrowser');
        else
            return view('lev_jump', ['score' => $score, 'lev' => "二", "lev_n" => "三","next"=>"datiing3"]);
    }

    public function index3(Request $request)
    {
        $user_answer = functions::object2array($request->request);

        /*选择题处理*/
        $true_ans_single = 0;
        $true_ans_multi = 0;
        $ans_select = session("answer_select");
        $user_ans_select = json_decode($user_answer["ans_select"]);
        $user_ans_select = functions::object2array($user_ans_select);
        $true_ans_select = array_intersect_assoc($user_ans_select, $ans_select);
        foreach ($true_ans_select as $item) {
            if (strlen($item) == 1)
                $true_ans_single++;
            else
                $true_ans_multi++;

        }

        $score_select = $true_ans_single * env("LEV3_SINGLE_SCORE")+$true_ans_multi*env("LEV3_MULTI_SCORE");;

        /*填空题处理*/
        $score_blank = 0;
        if (env("LEV1_BLANK")!=0) {
            $ans_blank = session("answer_blank");
            $user_ans_blank = json_decode($user_answer["ans_blank"]);
            $user_ans_blank = functions::object2array($user_ans_blank);
            $true_ans_blank = array_intersect_assoc($user_ans_blank, $ans_blank);
            $true_ans_blank = count($true_ans_blank);
            //dump($true_ans_blank);
            $score_blank = $true_ans_blank * env("LEV3_BLANK_SCORE");
        }


        $score = $score_select + $score_blank;
        session(["score3"=>$score]);
        if($score<env("LINE_LEV1"))
    {
        echo "<script>alert('亲，分数不够呢，请重新答题！');parent.location.href='/datiing3';</script>";
    }
        functions::record();
        if (functions::ifmobile())
            return view('gobrowser');
        else
            return view('score', ['score' => $score, 'lev' => "二", "lev_n" => "三","next"=>"datiing2"]);

    }
}
