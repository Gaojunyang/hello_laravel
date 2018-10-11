<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function home()
    {
        return view('static_pages/home');
    }

    public function help(Request $request)
    {
        echo $request->path().PHP_EOL;
        echo $request->fullUrl().PHP_EOL;
        echo $request->method().PHP_EOL;
        return view('static_pages/help');
    }

    public function about()
    {
        return view('static_pages/about');
    }
}
