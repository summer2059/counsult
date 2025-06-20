<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JapanController extends Controller
{
    public function jp_index(){
        return view('japan.index');
    }
}
