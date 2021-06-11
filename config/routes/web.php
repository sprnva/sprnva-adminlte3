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
    $router->get('/detail/{id}', ['ProjectController@detail']);
    $router->post('/detail/{id}', ['ProjectController@updateDetail']);
    $router->get('/add', ['ProjectController@add']);
    $router->post('/add', ['ProjectController@store']);
    $router->post('/delete/{id}', ['ProjectController@delete']);
    $router->get('/view/{id}', ['ProjectController@view']);
});
