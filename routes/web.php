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

Route::get('/notification-index', [App\Http\Controllers\NotificationController::class,'index'])->name('notification.index');
Route::post('/notification-notification', [App\Http\Controllers\NotificationController::class,'sendNotification'])->name('notification.send');
Route::post('/notification-create', [App\Http\Controllers\NotificationController::class,'create'])->name('notification.create');
