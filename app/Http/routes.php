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

Route::get('auth/signin', [
    'as' => 'auth.signin',
    'uses' => 'Auth\AuthController@signin'
]);

Route::get('auth/github', [
    'as' => 'auth.github.oauth',
    'uses' => 'Auth\AuthController@githubRedirect'
]);
Route::get('auth/github/callback', [
    'as' => 'auth.github.callback',
    'uses' => 'Auth\AuthController@githubCallback'
]);

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@home'
]);

Route::get('/{view}', [
    'as' => 'view',
    'uses' => 'HomeController@playView'
])->where('view', '.+');
