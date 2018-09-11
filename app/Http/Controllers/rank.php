<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\functions;
class rank extends Controller
{
    //
    public function index(){
    	$rank=DB::table('school')->orderBy('avage','desc')->limit(20)->get();
    	//dump($rank);
    	$rank=functions::object2array($rank);
    	//dump($rank);
        return view('rank',['rank'=>$rank]);
    }
}
