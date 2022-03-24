<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PusherUser;
use App\Models\Message;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function __construct(PusherUser $pusherUser,Message $message){
        $this->pusherUser = $pusherUser;
        $this->message = $message;
    }

    public function index(){
        return view('chat');
    }

    public function fetchMessages(){
        return $this->message->with('pusherUser')->get();
    }

    public function sendMessage(Request $request){
        $userId = Session::get('user');
        $this->message->create([
            'pusher_user_id' => $userId->id,
            'message' => $request->message
        ]);

        broadcast(new MessageSent($user, $message))->toOthers();

        return ['status' => 'Message sent!'];
    }

    public function i(){
        return view('chat');
    }
    
}
