<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewMessage;
use App\Models\User;
use App\Models\Message;
use Session;

class ChatController extends Controller
{

    public function __construct(User $user,Message $messages){
        $this->user = $user;
        $this->message = $messages;
    }

    public function users(){
        $userId = Session::get('user')->id;
        $users = $this->user->where('id','!=',$userId)->tobase()->get();
        return view('/users',compact('users'));
    }

    public function index($id){
        $receiver = $this->user->where('id',$id)->tobase()->first();
        
        return view('chat',compact('receiver','id'));
    }

    public function chat(Request $request){
        $userId = Session::get('user')->id;
        $message = $request->data;
        $this->message->create([
            'sender_id' => $userId,
            'receiver_id' => $request->receiver_id,
            'message' => $message
        ]);
        event(new NewMessage($message));
        return back();
    }
}
