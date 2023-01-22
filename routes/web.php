<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

route::group(['middleware' => 'auth:web'], function () {

    // Route::resource('posts' , PostController::class);
    Route::post('posts/store' , [PostController::class , 'store'])->name('posts.store');
    Route::post('posts/update/{post}' , [PostController::class , 'update'])->name('posts.update');
    Route::get('posts/destroy/{post}' , [PostController::class , 'destroy'])->name('posts.destroy');


    Route::post('comments/store' , [CommentController::class , 'store'])->name('comments.store');
    Route::get('comments/destroy/{comment}' , [CommentController::class , 'destroy'])->name('comments.destroy');
});


Route::any('{url}', function(){
    return view('404');
})->where('url', '.*');
