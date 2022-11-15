<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubImgController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/',[GuestController::class,'index'])->name('guest.index');

Auth::routes();

Route::middleware("auth")->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/category',CategoryController::class);
    Route::resource('/post',PostController::class);
    Route::resource('/user',UserController::class);
    Route::resource('/subImgs',SubImgController::class);
    Route::get('/allpost',[UserController::class,'showAllPost'])->name('user.allpost');
});