<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', ['as' => 'home', 'uses' => 'CubeController@index']);
Route::post('/config/save', ['as' => 'config_save', 'uses' => 'CubeController@postConfig']);
