<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Get User all
     */ 
    public function index(){
        $users = User::all()->tobase();
        return view('index',compact('users'));
    }
}
