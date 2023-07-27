<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin_panel');
    $router->resource('users', 'UserController');
    $router->resource('forums', 'ForumController');

    $router->resource('topics', 'TopicController');
    $router->resource('comments', 'CommentController');

    $router->get('/api/forum',[\App\Admin\Api\ForumApi::class,'index']);

});
