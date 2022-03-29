<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AuthController;

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

/**     Auth routes      */
Route::get('/sign-up',[AuthController::class,'signUp']);
Route::post('/register',[AuthController::class,'store']);
Route::get('/sign-in',[AuthController::class,'signIn']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/logout',[AuthController::class,'logout']);


/**     Chat routes      */
Route::get('/users',[ChatController::class,'users'])->middleware('logout');
Route::get('/chat/{id}',[ChatController::class,'index'])->middleware('logout');
Route::post('/send',[ChatController::class,'chat'])->middleware('cors');
