<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\User;

class EloquentController extends Controller
{
    public function __construct(User $user){
        $this->user = $user;
    }

    public function users(){
        $userName = User::first();
        $userName->name = '-';
        $firstUser = User::firstuser()->first();
        $relation = User::with('address:id,user_id,address')->first();
        return view('index',compact('userName','relation','firstUser'));
    }
}
