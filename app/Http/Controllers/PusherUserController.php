<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PusherUser;
use App\Models\Message;
use Session;

class PusherUserController extends Controller
{
    public function __construct(PusherUser $pusherUser,Message $message){
        $this->pusherUser = $pusherUser;
        $this->message = $message;
    }

    public function index(){
        return view('Auth.register');
    }

    public function register(Request $request){
       $user = $this->pusherUser->create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => $request->password
       ]);
       Session::put('user',$user);
       return view('chat');
    }

    public function login(Request $request){
        $user = $this->pusherUser->where('email',$request->email)->where('password',$request->password)->first();
        if(!isset($user)){
            return back();
        }else{
            Session::put('user',$user);
            return view('chat');
        }
    }
}
