<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventListenerUser;
use App\Http\Requests\EventListenerRequest;
use App\Events\LoggedIn;
use App\Events\LoggedOut;

class EventListenerController extends Controller
{
    /**
     * Get users page.
     * 
     * Collect users from DB.
     */
    public function index(){
        $users = EventListenerUser::all();
        return view('event_listener.index',compact('users'));
    } 

    /**
     * Store users.
     * 
     * Request validation EventListenerRequest
     * 
     * @param $request
     */
    public function store(EventListenerRequest $request){
        $users = EventListenerUser::create($request->all());
        $user = EventListenerUser::findorfail($users->id);
        // $user = EventListenerUser::orderBy('created_at','asc')->limit(1)->first();
        event(new LoggedIn($user));
        return \Redirect::back();
    }

    /**
     * User delete 
     * 
     * Call event Loggedout
     * 
     * @param $id
     */
    public function delete($id){
        $users = EventListenerUser::findorfail($id);
        event(new LoggedOut($users));
        return \Redirect::back();
    }
}
