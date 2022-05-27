<?php

namespace ArunBalaji\calculator\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CalculatorController extends Controller
{
    public function add($a, $b){
        $result = $a + $b;
        return view('calci::show',compact('result'));
    }
        
    public function subtract($a, $b){
        $result = $a - $b;
        return view('show',compact('result'));
    }
}
