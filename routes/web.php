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

// Event and Listener
Route::name('el.')->group(function () {
    Route::get('/el-index',[App\Http\Controllers\EventListenerController::class,'index'])->name('index');
    Route::post('/el-store',[App\Http\Controllers\EventListenerController::class,'store'])->name('store');
    Route::get('/el-delete/{id}',[App\Http\Controllers\EventListenerController::class,'delete'])->name('delete');

});
