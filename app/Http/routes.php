<?php

Route::get('/', ['as' => 'home', 'uses' => 'CubeController@index']);
Route::post('/config/save', ['as' => 'config_save', 'uses' => 'CubeController@postConfig']);
Route::post('/command', ['as' => 'command', 'uses' => 'CubeController@postCommand']);
