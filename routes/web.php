<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('posts', 'PostsController@List');
$router->get('posts/{postId}', 'PostsController@Detail');

$router->group(['middleware' => 'auth'], function () use ($router) {

    //posts routes
    $router->post("/posts", 'PostsController@Create');
    $router->put("/posts/{postId}", 'PostsController@Update');
    $router->delete("/posts/{postId}", 'PostsController@Delete');

    //comments routes
    $router->post("/posts/{postId}/comments",'CommentsController@Create');

});
