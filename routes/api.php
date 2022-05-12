<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


    /**     Admin routes     */
Route::post('/register-admin',[UserController::class,'registerAdmin']);


    /**     User routes      */
Route::post('/register-user',[UserController::class,'registerUser']);


    /**     Either ability   */
Route::get('/view-user',[UserController::class,'viewUsers'])->middleware(['auth:sanctum','ability:user,admin']);


    /**     Both admin and user routes   */
Route::post('/register-super-admin',[UserController::class,'registerSuperAdmin']);
Route::get('delete',[UserController::class,'delete'])->middleware('auth:sanctum','abilities:admin,user');

Route::get('/logout',[UserController::class,'logout'])->middleware('auth:sanctum');


