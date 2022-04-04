<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('permission:user.update', ['only' => ['update']]);
        $this->middleware('permission:user.create', ['only' => ['create','delete']]);
    }

    public function index(){
        $users = User::get();
        return view('dashboard',compact('users'));
    }

    public function create(Request $request){
        $post = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ])->assignRole('user')->givePermissionTo('user.update');
        return back()->with("success",'User created');
    }

    public function update(Request $request){
        $user = User::where('id',$request->user_id)->first();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return back()->with("success",'User updated');
    }

    public function view(){
        $users = User::where('id','!=',1)->get();
        return view('view',compact('users'));
    }

    public function delete($id){
        User::where('id',$id)->delete();
        return back();
    }
}
