<?php

use App\Core\Route;
use App\Core\Request;

/**
 * Register the auto loader
 * 
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * direct the routes
 * 
 */
Route::direct(
	// request uri
	Request::uri(),

	// the method use of the uri
	Request::method()
);
