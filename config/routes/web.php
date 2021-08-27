<?php

use App\Core\App;
use App\Core\Auth;
use App\Core\Routing\Route;

// your routes goes here
Route::get('/', ['WelcomeController@home', 'auth']);
Route::get('/home', ['WelcomeController@home', 'auth']);

// file upload
Route::group(['prefix' => 'file/upload', 'middleware' => ['auth']], function () {
    Route::post('/', ['FileUploadController@store']);
    Route::delete('/', ['FileUploadController@delete']);
});

Route::group(['prefix' => 'project', 'middleware' => ['auth']], function () {
    Route::get('/', ['ProjectController@index']);
    Route::get('/{id}/edit', ['ProjectController@edit']);
    Route::post('/{project_id}', ['ProjectController@update']);
    Route::get('/create', ['ProjectController@create']);
    Route::post('/', ['ProjectController@store']);
    Route::post('/{id}/delete', ['ProjectController@destroy']);
    Route::get('/{id}', ['ProjectController@show']);
});
