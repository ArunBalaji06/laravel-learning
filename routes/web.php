<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedisController;
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
Route::get('/users',[RedisController::class,'usersList']);
Route::get('/users-get',[RedisController::class,'getUsers']);
Route::get('/users-get-no-redis',[RedisController::class,'getUsersWithoutRedis']);

