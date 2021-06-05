<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PostController;

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

//Route::get('/', function () {
//    return view('posts.create');
//});

Route::get('/home',[PostController::class,'index'])->name('userManagement.index');
Route::get('/create',[PostController::class,'create'])->name('userManagement.create');
Route::post('/store',[PostController::class,'store'])->name('userManagement.store');
Route::get('/delete/{id}',[PostController::class,'destroy'])->name('userManagement.destroy');