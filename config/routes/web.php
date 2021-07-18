<?php

use App\Core\App;
use App\Core\Auth;

// your routes goes here
$router->get('/', ['WelcomeController@home', 'auth']);
$router->get('/home', ['WelcomeController@home', 'auth']);

// file upload
$router->group(['prefix' => 'file/upload', 'middleware' => ['auth']], function ($router) {
    $router->post('/', ['FileUploadController@store']);
    $router->delete('/', ['FileUploadController@delete']);
});

$router->group(['prefix' => 'project', 'middleware' => ['auth']], function ($router) {
    $router->get('/', ['ProjectController@index']);
    $router->get('/{id}/edit', ['ProjectController@edit']);
    $router->post('/{project_id}', ['ProjectController@update']);
    $router->get('/create', ['ProjectController@create']);
    $router->post('/', ['ProjectController@store']);
    $router->post('/{id}/delete', ['ProjectController@destroy']);
    $router->get('/{id}', ['ProjectController@show']);
});
