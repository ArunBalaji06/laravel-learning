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
        $users = $this->user->get();
        // dd($users);
        return view('index',compact('users'));
    }

    /**
     * Create a record.
     * Call observer.
     */
    public function create(Request $request){
        $create = $this->user->create($request->all());
        return \Redirect::back();
    }

    public function update($id, Request $request){
        // $count = $this->user->where('id',$id)->pluck('deleted_at')->first();
        // dd($count);
        // $count = (int)$count;
        // $update = ObserverUser::find($id);
        // $update->deleted_at = $count + 1;
        // $update->save();
        $users = $this->user->where('id',$id)->first()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return \Redirect::back();

    }
}
