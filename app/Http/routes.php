<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('auth/signin', function (\Illuminate\Contracts\Auth\Guard $auth) {
    if (env('APP_ENV') == 'dev') {
        $auth->loginById('00000000-0000-0000-0000-000000000000');
        return redirect('/');
    } else {
        return redirect('auth/github');
    }
});

Route::get('auth/github', 'Auth\AuthController@githubRedirect');
Route::get('auth/github/callback', 'Auth\AuthController@githubCallback');

Route::get('/', function () {
    return view('welcome', ['title' => 'Dashboard', 'nodes' => []]);
});
