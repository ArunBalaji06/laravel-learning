<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashierController;
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
})->name('home');


Route::get('/customer-create-view',[CashierController::class,'createCustomer']);
Route::post('/customer-create',[CashierController::class,'createCustomer']);
Route::get('/customer-update/{name}/{email}/{password}/{id}',[CashierController::class,'updateCustomer']);
Route::get('/customer-get/{id}',[CashierController::class,'findCustomer']);
Route::get('/customer-get-balance/{id}',[CashierController::class,'checkBalance']);
Route::get('/customer-credit-balance/{id}/{amount}/{description}',[CashierController::class,'customerCreditBalance']);
Route::get('/customer-debit-balance/{id}/{amount}/{description}',[CashierController::class,'customerDebitBalance']);
Route::get('/customer-balance-transaction/{id}',[CashierController::class,'customerBalanceTransaction']);

Route::get('/customer-payment-form/{id}',[CashierController::class,'paymentForm']);

Route::post('/make-payment',[CashierController::class,'makePayment']);
Route::get('/make-payment-checkout/{id}/{amount}/{description}',[CashierController::class,'makeCheckout'])->name('checkout');

Route::get('/add-payment-method/{id}',[CashierController::class,'addPaymentMethod']);
Route::post('/post-payment-method',[CashierController::class,'postPaymentMethod']);


Route::get('/get-payment-method/{id}',[CashierController::class,'getPaymentMethod']);

Route::get('/create-subscription/{id}',[CashierController::class,'createSubscription']);
Route::get('/check-subscription/{id}',[CashierController::class,'checkSubscription']);
Route::get('/change-subscription/{id}/{productId}',[CashierController::class,'changeSubscription']);
Route::get('/product-checkout/{id}/{productId}',[CashierController::class,'productCheckout']);

Route::get('/metered-subscription/{id}/{productId}',[CashierController::class,'meteredSubscription']);
Route::get('/usage-records/{id}',[CashierController::class,'usageRecord']);

Route::get('/webhook-charge-success',[CashierController::class,'webhookChargeSuccess']);















