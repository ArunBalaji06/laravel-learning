<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PusherUserController;

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

/** Auth routes */
Route::get('/Register',[PusherUserController::class,'index']);
Route::post('/post-register',[PusherUserController::class,'register']);

Route::get('/', [ChatController::class,'index']);
Route::get('messages', [ChatController::class,'fetchMessages']);
Route::post('messages', [ChatController::class,'sendMessage']);

Route::get('/i', [ChatController::class,'i']);
