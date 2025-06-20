<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NepaliController extends Controller
{
    public function np_index()
    {
        return view('nepali.index');
    }
}
