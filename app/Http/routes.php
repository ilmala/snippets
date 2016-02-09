<?php

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['web']], function () {
  Route::get('login', 'AuthController@login');
  Route::get('logout', 'AuthController@logout');
  Route::get('auth/github', 'AuthController@redirectToProvider');
  Route::get('auth/github/callback', 'AuthController@handleProviderCallback');

  Route::get('gists', ['as'=>'gists_path', 'uses'=>'GistsController@index']);
  Route::get('gists/{gist}', ['as'=>'gist_path', 'uses'=>'GistsController@show']);
});
