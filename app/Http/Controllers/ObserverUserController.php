<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObserverUser;

class ObserverUserController extends Controller
{
    public function __construct(ObserverUser $user){
        $this->user = $user;
    }
    /**
     * Get index page
     */
    public function index(){
        $users = $this->user->where('status',0)->get();
        $deletedUsers = $this->user->where('status',1)->get();
        return view('index',compact('users','deletedUsers'));
    }

    /**
     * Create a record.
     * Call observer.
     */
    public function create(Request $request){
        $create = $this->user->create($request->all());
        return \Redirect::back();
    }

    /**
     * Update user.
     * call observer updating.
     * @param $id, $request.
     */
    public function update($id, Request $request){
        $users = $this->user->where('id',$id)->first()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return \Redirect::back();

    }

    /**
     * Delete User
     * Call observer Deleteing
     */
    public function delete($id){
        $user = $this->user->where('id',$id)->first()->delete();
        return \Redirect::back();
    }
}
