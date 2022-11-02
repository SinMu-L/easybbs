<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Models\Forum;
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
Route::post('/register',[RegisterController::class,'store'])->name('register.store');
Route::get('/register',[RegisterController::class,'create'])->name('register');

// 登录
Route::get('/login',[LoginController::class,'create'])->name('login.create');
Route::post('/login',[LoginController::class,'login'])->name('login.store');
Route::get('/logout',[LoginController::class,'destroy'])->name('logout');



Route::get('/', [ForumController::class,'index'])->name('/');





Route::get('/home', [ForumController::class,'index'])->name('home');



Route::resource('topic',TopicController::class)->except(['create']);

Route::resource('user',UserController::class);


Route::post('/topic/{topic_id}/comment/{comment_id?}',[CommentController::class,'store'])->name('add_comment');
Route::get('/topic/{topic_id}/comment/{comment_id?}',[CommentController::class,'show'])->name('show_comment');

Route::resource('forum',ForumController::class);

Route::get('forum/{forum_id}/topic',[TopicController::class,'create'])->name('topic.create');
