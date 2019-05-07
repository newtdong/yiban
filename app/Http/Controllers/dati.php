<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dati extends Controller
{
    public function index()
    {
        if (functions::ifmobile())
            return view('gobrowser');
        else
            return view('dati');
    }
}
