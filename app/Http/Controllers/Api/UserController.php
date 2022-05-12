<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(User $user){
        $this->user = $user;
    }

    /**
     * Register user with sanctum token
     * Create with admin ability
     */
    public function registerAdmin(Request $request){
        $users = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $token = $users->createToken('admin-token',['admin']);
        $users->token = $token;
        $users->plainToken = $token->plainTextToken;

        return response()->json(['body' => $users, 'message' => 'Admin Created Successfully', 'status' => true]);
    }

    /**
     * Register user with sanctum token
     * Create with user ability
     */
    public function registerUser(Request $request){
        $users = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $token = $users->createToken('user-token',['user']);
        $users->token = $token;
        $users->plainToken = $token->plainTextToken;

        return response()->json(['body' => $users, 'message' => 'User Created Successfully', 'status' => true]);
    }

    /**
     * Register user with sanctum token
     * Create with both admin and user ability
     */
    public function registerSuperAdmin(Request $request){
        $users = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $token = $users->createToken('super-token',['user','admin']);
        $users->token = $token;
        $users->plainToken = $token->plainTextToken;

        return response()->json(['body' => $users, 'message' => 'Super Admin Created Successfully', 'status' => true]);
    }

    /**
     * View Users api
     * 
     * Can only viewed by admin token
     */
    public function viewUsers(){
        $users = $this->user->get();
        return response()->json(['body' => $users, 'message' => 'User Created Successfully', 'status' => true]);
    }

    /**
     * Delete the token for currently logged in user
     */
    public function logout(){
        $token = Auth::user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Users and Token Deleted Successfully', 'status' => true]);
    }

    /**
     * This route can be accessed only by ablity who have both admin and user
     */
    public function delete(){
        $currentAdmin = Auth::user()->id;
        $deleteUsers = $this->user->where('id','!=',$currentAdmin)->delete();
        return response()->json(['body' => Auth::user(), 'message' => 'Users Deleted Successfully', 'status' => true]);
    }
    
}
