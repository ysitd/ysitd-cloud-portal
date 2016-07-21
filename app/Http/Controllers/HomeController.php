<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function home()
    {
        return view('welcome', ['title' => 'Dashboard']);
    }

    public function playView($view)
    {
        $title = $view;
        $title = str_replace('/', ' ', $title);
        $title = trim($title);
        $title = Str::title($title);
        return view($view)->with('title', $title);
    }
}