<?php

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

Route::get('/', [\App\Http\Controllers\HelloWorldController::class], 'index');
Route::resource('/user', \App\Http\Controllers\UserController::class);

Route::prefix('admin')->namespace('Admin')->group(function(){
    Route::resource('posts', 'PostController');
});
