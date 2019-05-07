<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class hasjoin extends Controller
{
    //
    public function index(){
        if(functions::ifmobile())
            return view('gobrowser');
        return view('hasjoin');
    }
}
