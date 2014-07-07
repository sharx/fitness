<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('users',function()
{  
    $users=DB::select('select * from users');
    $env=App::environment();
    $value=Request::server('PATH_INFO');
    //return $env;
    return View::make('users')->with('users',$users);
});
