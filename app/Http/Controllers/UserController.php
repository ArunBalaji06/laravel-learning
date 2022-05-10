<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\SendResponse;

class UserController extends SendResponse
{
    public function __construct(User $user){
        $this->user = $user;
    }

    public function register(Request $request){
        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        // Create oauth token
        $token['token'] =  $user->createToken('LearningToken')->accessToken;
        $token['name'] =  $user->name;
        $user->token = $token['token'];

        return $this->sendResponses('User Created', $user, true);
    }

    public function update(Request $request){

        // Update can be done, only auth bearer token present in headers
        $user = $this->user->where('email',$request->email)->first();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return SendResponse::sendResponses('User Updated', $user, true);
    }

    public function logout(Request $request){
        //logout from passport oauth
        if (Auth::check()) {
            $user = Auth::user()->delete();
            $token = Auth::user()->tokens->find(Auth::user()->token());
            $token->delete();
        }
        // That oauth token is invalid from now

        return SendResponse::sendResponses('User Loggedout', $user, true);
    }
}
