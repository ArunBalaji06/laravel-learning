<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function __construct(User $user){
        $this->user = $user;
    }

    public function signUp(){

        return view('auth.sign_up');
    }

    public function store(RegisterRequest $request){
        $currenctUser = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        Session::put('user',$currenctUser);

        return redirect('/users');
    }

    public function signIn(){
        return view('auth.sign_in');
    }

    public function login(RegisterRequest $request){
        $currenctUser = $this->user->where('email',$request->email)->where('password',$request->password)->first();
        if(isset($currenctUser)){
            Session::put('user',$currenctUser);
            return redirect('/users');
        }else{
            return back()->with('error','User not found');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/sign-in');
    }
}
