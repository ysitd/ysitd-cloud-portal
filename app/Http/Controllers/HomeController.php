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

    public function hit()
    {
        $miss = apcu_fetch('portal_class_load_miss');
        $total = apcu_fetch('portal_class_load_total');
        $hit = $total - $miss;
        return $hit / $total * 100;
    }

    public function reset()
    {
        apcu_store(['portal_class_load_miss' => 0, 'portal_class_load_total' => 0]);
    }
}