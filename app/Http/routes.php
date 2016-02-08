<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
  Route::get('auth/github', 'AuthController@redirectToProvider');
  Route::get('auth/github/callback', 'AuthController@handleProviderCallback');

  Route::get('gists', ['as'=>'gists_path', 'uses'=>'GistsController@index']);
  Route::get('gists/{gist}', ['as'=>'gist_path', 'uses'=>'GistsController@show']);
});
