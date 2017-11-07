<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// --------------------- Snaps routes

$router->options('posts', ['uses' => 'SnapController@cors']); // This is needed by the following route for the CORS pre-flight response
$router->options('posts/{id}', ['uses' => 'SnapController@cors']); // This is needed by the following route for the CORS pre-flight response
$router->options('posts/{id}/views', ['uses' => 'SnapController@cors']); // This is needed by the following route for the CORS pre-flight response

$router->get('posts', ['uses' => 'SnapController@index']);
$router->patch('posts/{id}/views', ['uses' => 'SnapController@incrementViews']);

// $router->group(['middleware' => 'auth'], function () use ($router) { //TODO Use the auth middleware for the following routes?
$router->post('posts', ['uses' => 'SnapController@create']);
$router->put('posts', ['uses' => 'SnapController@update']);
$router->get('posts/{id}', ['uses' => 'SnapController@show']);
$router->delete('posts/{id}', ['uses' => 'SnapController@destroy']);



// --------------------- Auth routes


$router->options('register', ['uses' => 'SnapController@cors']); // This is needed by the following route for the CORS pre-flight response
$router->post('register', ['uses' => 'Auth\\AuthController@register']);

$router->options('login', ['uses' => 'SnapController@cors']); // This is needed by the following route for the CORS pre-flight response
$router->post('login', ['uses' => 'Auth\\AuthController@login']);

$router->options('logout', ['uses' => 'SnapController@cors']); // This is needed by the following route for the CORS pre-flight response
$router->post('logout', ['uses' => 'Auth\\AuthController@logout']);

$router->options('verifyToken', ['uses' => 'SnapController@cors']); // This is needed by the following route for the CORS pre-flight response
$router->post('verifyToken', ['uses' => 'Auth\\AuthController@checkAPIToken']);

/*
$router->group(['middleware' => 'auth:api'], function() use ($router) { //FIXME Delete this -->
    $router->get('testAuth', ['uses' => 'SnapController@index']);
});
*/


// --------------------- Debug routes

/*
$router->get('lumenVersion', function() use ($router) {
    return $router->app->version();
});
*/
