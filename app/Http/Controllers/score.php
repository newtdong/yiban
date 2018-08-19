<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\functions;
use App\Http\Controllers\datiing;
class score extends Controller
{
    //
    public function index(Request $request){
$answer=session('answer');
$repo=functions::object2array($request->request);
$trueans=array_intersect_assoc($repo,$answer);
$score=count($trueans);
//dump(session('starttime'));
$time=time()-session('starttime');
//dump($time);
        $score=$score*(100/functions::$sum);
functions::record($score,$time);
return view('score',['score'=>$score]);
    }
}
