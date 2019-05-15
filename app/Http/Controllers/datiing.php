<?php

namespace App\Http\Controllers;

use App\Http\Controllers\functions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Self_;
use Psr\Log\NullLogger;

class datiing extends Controller
{

    /*答题闯关之第一关*/
    public function lev1()
    {
        if (functions::ifmobile())
            return view('gobrowser');
        if (session('yb_userid') == null)
            return view('jump');
        $lev1_single = env("LEV1_SINGLE");
        $lev1_multi = env("LEV1_MULTI");
        $lev1_blank = env("LEV1_BLANK");

        /*选择题*/

        $sub = DB::table('question')
            ->inRandomOrder()
            ->where('flag', '=', '2')
            ->limit($lev1_single);
        $questions_select = DB::table('question')
            ->inRandomOrder()
            ->where('flag', '=', '1')
            ->limit($lev1_multi)
            ->union($sub)
            ->inRandomOrder()
            ->get();
        $questions_select = functions::object2array($questions_select);
        //dump($sub);
        foreach ($questions_select as $key => $value)
            $answer_select[$value->id] = $value->answer;
        /*存储答案*/
        session(['answer_select' => $answer_select]);

        /*end*/

        /*填空题*/
        $que_blank = DB::table("question2")
            ->inRandomOrder()
            ->limit($lev1_blank)
            ->get();

        foreach ($que_blank as $que) {
            $questions[$que->id]['id'] = $que->id;
            $questions[$que->id]['question'] = $que->question;
            $questions[$que->id]['ans1'] = $que->ans1;
            $questions[$que->id]['ans2'] = $que->ans2;
            $questions[$que->id]['ans3'] = $que->ans3;
            $questions[$que->id]['ans4'] = $que->ans4;
            $questions[$que->id]['ans5'] = $que->ans5;
        }
        $temp = 0;
        foreach ($que_blank as $que) {
            if ($que->ans1 != null)
                $answer_blank[$temp++] = $que->ans1;
            if ($que->ans2 != null)
                $answer_blank[$temp++] = $que->ans2;
            if ($que->ans3 != null)
                $answer_blank[$temp++] = $que->ans3;
            if ($que->ans4 != null)
                $answer_blank[$temp++] = $que->ans4;
            if ($que->ans5 != null)
                $answer_blank[$temp++] = $que->ans5;
        }
        if (isset($answer_blank))
            session(["answer_blank" => $answer_blank]);
        /*end*/
        //dump($questions_select);
        if (isset($questions))
            return view('datiing_lev1', ['sub' => $questions_select, 'questions' => $questions, 'sum' => 1, 'num' => 1]);
        return view('datiing_lev1', ['sub' => $questions_select, 'sum' => 1, 'num' => 1]);
    }

    /*答题闯关之第二关*/
    public function lev2()
    {
        if (functions::ifmobile())
            return view('gobrowser');
        if (session('yb_userid') == null)
            return view('jump');
        $lev2_single = env("LEV2_SINGLE");
        $lev2_multi = env("LEV2_MULTI");
        $lev2_blank = env("LEV2_BLANK");

        /*选择题*/

        $sub = DB::table('question')
            ->inRandomOrder()
            ->where('flag', '=', '2')
            ->limit($lev2_single);
        $questions_select = DB::table('question')
            ->inRandomOrder()
            ->where('flag', '=', '1')
            ->limit($lev2_multi)
            ->union($sub)
            ->inRandomOrder()
            ->get();
        $questions_select = functions::object2array($questions_select);
        //dump($sub);
        foreach ($questions_select as $key => $value)
            $answer_select[$value->id] = $value->answer;
        /*存储答案*/
        session(['answer_select' => $answer_select]);

        /*end*/

        /*填空题*/
        $que_blank = DB::table("question2")
            ->inRandomOrder()
            ->limit($lev2_blank)
            ->get();

        foreach ($que_blank as $que) {
            $questions[$que->id]['id'] = $que->id;
            $questions[$que->id]['question'] = $que->question;
            $questions[$que->id]['ans1'] = $que->ans1;
            $questions[$que->id]['ans2'] = $que->ans2;
            $questions[$que->id]['ans3'] = $que->ans3;
            $questions[$que->id]['ans4'] = $que->ans4;
            $questions[$que->id]['ans5'] = $que->ans5;
        }
        $temp = 0;
        foreach ($que_blank as $que) {
            if ($que->ans1 != null)
                $answer_blank[$temp++] = $que->ans1;
            if ($que->ans2 != null)
                $answer_blank[$temp++] = $que->ans2;
            if ($que->ans3 != null)
                $answer_blank[$temp++] = $que->ans3;
            if ($que->ans4 != null)
                $answer_blank[$temp++] = $que->ans4;
            if ($que->ans5 != null)
                $answer_blank[$temp++] = $que->ans5;
        }
        if (isset($answer_blank))
            session(["answer_blank" => $answer_blank]);
        /*end*/
        //dump($questions_select);
        if (isset($questions))
            return view('datiing_lev2', ['sub' => $questions_select, 'questions' => $questions, 'sum' => 1, 'num' => 1]);
        return view('datiing_lev2', ['sub' => $questions_select, 'sum' => 1, 'num' => 1]);
    }

    /*答题闯关之第三关*/
    public function lev3()
    {
        if (functions::ifmobile())
            return view('gobrowser');
        if (session('yb_userid') == null)
            return view('jump');
        $lev3_single = env("LEV3_SINGLE");
        $lev3_multi = env("LEV3_MULTI");
        $lev3_blank_1 = env("LEV3_BLANK_1");
        $lev3_blank_2 = env("LEV3_BLANK_2");
        $lev3_blank_3 = env("LEV3_BLANK_3");
        $lev3_blank_4 = env("LEV3_BLANK_4");
        $lev3_blank_5 = env("LEV3_BLANK_5");

        /*选择题*/

        $sub = DB::table('question')
            ->inRandomOrder()
            ->where('flag', '=', '2')
            ->limit($lev3_single);
        $questions_select = DB::table('question')
            ->inRandomOrder()
            ->where('flag', '=', '1')
            ->limit($lev3_multi)
            ->union($sub)
            ->inRandomOrder()
            ->get();
        $questions_select = functions::object2array($questions_select);
        //dump($sub);
        foreach ($questions_select as $key => $value)
            $answer_select[$value->id] = $value->answer;
        /*存储答案*/
        session(['answer_select' => $answer_select]);

        /*end*/

        /*填空题*/
        $que_blank1 = DB::table("question2")
            ->inRandomOrder()
            ->where('ans_num', '=', 1)
            ->limit($lev3_blank_1);
        $que_blank2 = DB::table("question2")
            ->inRandomOrder()
            ->where('ans_num', '=', 2)
            ->limit($lev3_blank_2);
        $que_blank3 = DB::table("question2")
            ->inRandomOrder()
            ->where('ans_num', '=', 3)
            ->limit($lev3_blank_3);
        $que_blank4 = DB::table("question2")
            ->inRandomOrder()
            ->where('ans_num', '=', 4)
            ->limit($lev3_blank_4);
        $que_blank = DB::table("question2")
            ->inRandomOrder()
            ->where('ans_num', '=', 5)
            ->limit($lev3_blank_5)
            ->union($que_blank1)
            ->union($que_blank2)
            ->union($que_blank3)
            ->union($que_blank4)
            ->inRandomOrder()
            ->get();

        foreach ($que_blank as $que) {
            $questions[$que->id]['id'] = $que->id;
            $questions[$que->id]['question'] = $que->question;
            $questions[$que->id]['ans1'] = $que->ans1;
            $questions[$que->id]['ans2'] = $que->ans2;
            $questions[$que->id]['ans3'] = $que->ans3;
            $questions[$que->id]['ans4'] = $que->ans4;
            $questions[$que->id]['ans5'] = $que->ans5;
        }
        $temp = 0;
        foreach ($que_blank as $que) {
            if ($que->ans1 != null)
                $answer_blank[$temp++] = $que->ans1;
            if ($que->ans2 != null)
                $answer_blank[$temp++] = $que->ans2;
            if ($que->ans3 != null)
                $answer_blank[$temp++] = $que->ans3;
            if ($que->ans4 != null)
                $answer_blank[$temp++] = $que->ans4;
            if ($que->ans5 != null)
                $answer_blank[$temp++] = $que->ans5;
        }
        if (isset($answer_blank))
            session(["answer_blank" => $answer_blank]);
        /*end*/
        //dump($questions_select);
        if (isset($questions))
            return view('datiing_lev3', ['sub' => $questions_select, 'questions' => $questions, 'sum' => 1, 'num' => 1]);
        return view('datiing_lev3', ['sub' => $questions_select, 'sum' => 1, 'num' => 1]);
    }

}
