<?php
use ArunBalaji\Calculator\App\Http\Controllers\CalculatorController;

Route::get('/calculator', function(){
    
    echo 'Hello from the calculator package!';

});

Route::get('add/{a}/{b}',[ArunBalaji\Calculator\App\Http\Controllers\CalculatorController::class,'add']);
Route::get('sub/{a}/{b}',[CalculatorController::class,'subtract']);
