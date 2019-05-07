<?php

namespace App\Http\Controllers;

use App\Http\Controllers\functions;
use Illuminate\Http\Request;

class input extends Controller
{

    public function index(Request $request)
    {
        return view('input');
    }


}
