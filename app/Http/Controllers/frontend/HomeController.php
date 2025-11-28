<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // simple view return
        return view('frontend.index');
    }
}
