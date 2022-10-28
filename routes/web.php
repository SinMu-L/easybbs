<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
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

Route::get('/', [TopicController::class,'index']);



Auth::routes();

Route::get('/home', [TopicController::class,'index'])->name('home');

Route::resource('topic',TopicController::class);

Route::resource('user',UserController::class);
// Route::resource('comment',CommentController::class);

Route::post('/topic/{topic_id}/comment/{comment_id?}',[CommentController::class,'store'])->name('add_comment');
Route::get('/topic/{topic_id}/comment/{comment_id?}',[CommentController::class,'show'])->name('show_comment');
