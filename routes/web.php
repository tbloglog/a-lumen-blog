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

    $router->group(['prefix' => 'posts'], function () use ($router) {
        
        //posts routes
        $router->post('', 'PostsController@Create');
        $router->put('{postId}', 'PostsController@Update');
        $router->delete('{postId}', 'PostsController@Delete');

        $router->group(['prefix' => '{postId}/comments'], function () use ($router) {
            //comments routes
            $router->post('','CommentsController@Create');
            $router->put('{commentId}','CommentsController@Update');
            $router->delete('{commentId}','CommentsController@Delete');
        });
        
    });

});

$router->post('/auth','AuthController@Login');