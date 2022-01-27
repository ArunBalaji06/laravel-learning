<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ComponentController extends Controller
{
    public function index(){
        $users = User::get();
        // dd($users);
        return view('index',compact('users'));
    }

    public function store(Request $request){
        $create = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        return \Redirect::back();
    }
}
