<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function home()
    {
        return view('welcome', ['title' => 'Dashboard']);
    }

    public function playView($view, Filesystem $file)
    {
        $path = base_path("resources/views/{$view}.blade.php");
        if (!$file->exists($path)) {
            abort(404);
        }
        $title = $view;
        $title = str_replace('/', ' ', $title);
        $title = trim($title);
        $title = Str::title($title);
        return view($view)->with('title', $title);
    }
}