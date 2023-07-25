<?php

use App\Http\Controllers\Admin\ForumsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomLoginController;
use App\Models\Forum;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 注册
Route::post('/register',[RegisterController::class,'store'])
    ->middleware('guest')
    ->name('register.store');
Route::get('/register',[RegisterController::class,'create'])
    ->middleware('guest')
    ->name('register');

// 登录
Route::get('/login',[LoginController::class,'create'])
    ->middleware('guest')
    ->name('login.create');
Route::post('/login',[LoginController::class,'login'])
    ->middleware('guest')
    ->name('login.store');
Route::get('/logout',[LoginController::class,'destroy'])
    ->middleware('auth')
    ->name('logout');
Route::get('/auth/github',[CustomLoginController::class,'index'])
    ->name('login.github');

// 首页
Route::get('/', [ForumController::class,'index'])
    ->name('/');

// 话题
Route::resource('topic',TopicController::class)->except(['create']);
Route::get('forum/{forum_id}/topic',[TopicController::class,'create'])
    ->middleware('auth')
    ->name('topic.create');
Route::post('/topic/{topic_id}/comment/{comment_id?}',[CommentController::class,'store'])
    ->middleware('auth')
    ->name('add_comment');
Route::get('/topic/{topic_id}/comment/{comment_id?}',[CommentController::class,'show'])
    ->middleware('auth')
    ->name('show_comment');

// 用户
Route::resource('user',UserController::class);

// 论坛版块
Route::resource('forum',ForumController::class);



Route::get('help',function(){
    return view('help');
})->name('help');


// 管理版块
Route::namespace('Admin')
    ->prefix('admin')
    ->name('admin.')
    ->middleware('founder')
    ->group(function(){
        Route::get('/panel',[ForumsController::class,'index'])->name('panel');
        Route::post('execsql',[ForumsController::class,'execSQL'])->name('execsql');
});

Route::get('/test',function (){
   return 134;
});




