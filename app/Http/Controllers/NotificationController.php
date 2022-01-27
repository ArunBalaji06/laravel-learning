<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\DemoNotification;
use DB;

class NotificationController extends Controller
{
    /**
     * Collect user
     */
    public function sendNotification(Request $request){
        $users = User::get();
        foreach($users as $user){
            $data = [
                'name' => $user->name,
                'body' => $request->details,
                'thanks' => 'Thank you',
                'text' => 'click here!',
                'url' => url('/notification-index'),
                'id' => rand(10000,99999)
            ];

            Notification::send($user, new DemoNotification($data));
        }
        return \Redirect::back();
    }

    /**
     * collect user
     * @param $request
     */
    public function create(Request $request){
        // $user = User::get();
        // dd($request->all()); 
        $user = User::create($request->all());
        return \Redirect::back()->with('success','Notification sent!');
    }

    /**
     * Index page
     */
    public function index(){
        $notifiers = DB::table('notifications')
                    ->join('users','users.id','=','notifications.notifiable_id')
                    ->select('users.name as name','notifications.data as data')->get();
        return view('notification.index',compact('notifiers'));
    }
}
