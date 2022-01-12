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

Route::get('/', function () {
    return view('welcome');
});




Route::name('observer.')->group(function(){
    Route::get('/index',[App\Http\Controllers\ObserverUserController::class,'index'])->name('index');
    Route::post('/store',[App\Http\Controllers\ObserverUserController::class,'create'])->name('store');
    Route::post('/update/{id}',[App\Http\Controllers\ObserverUserController::class,'update'])->name('update');
});