<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmartImageController extends Controller
{
    public function index(){
        return view('smart_image');
    }
}
