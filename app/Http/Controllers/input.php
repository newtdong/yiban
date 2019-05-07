<?php

namespace App\Http\Controllers;

use App\Http\Controllers\functions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
class input extends Controller
{

    public function index()
    {
        return view('input');
    }

    public function save(Request $request)
    {
        if(DB::table("question2")->insert([
            'question' => $request['que'],
            'ans1' => $request['ans1'],
            'ans2' => $request['ans2'],
            'ans3' => $request['ans3'],
            'ans4' => $request['ans4'],
            'ans5' => $request['ans5']]))
            $status="success";
        else
            $status="fail";
        return view('input',['status'=>$status]);

    }

}
