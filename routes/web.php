<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;



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

Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::post('/user_create',[DashboardController::class,'create'])->name('user.create');
Route::post('/user_update',[DashboardController::class,'update'])->name('user.update');
Route::get('/user_view',[DashboardController::class,'view'])->name('user.view');
Route::get('/user_delete/{id}',[DashboardController::class,'delete'])->name('user.delete');

