<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public function __construct(User $user){
        $this->user = $user;
    }

    public function usersList(){
        $users = $this->user->get();
        $userSet = Redis::set('user_set',$users);
    }

    public function getUsers(){
        $userGet = Redis::get('user_set');
        return response()->json([
            'body' => $userGet,
        ]);
    }

    public function getUsersWithoutRedis(){
        $userGet = $this->user->get();
        return response()->json([
            'body' => $userGet,
        ]);
    }
}
