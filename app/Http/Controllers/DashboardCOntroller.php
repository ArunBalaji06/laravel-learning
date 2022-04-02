<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class DashboardCOntroller extends Controller
{
    public function index(){
        $users = User::get();
        $posts = Post::with('user')->get();
        return view('dashboard',compact('users','posts'));
    }

    public function createPost(Request $request){
        $user = User::where('id',Auth::user()->id)->first();

        $post = Post::create([
            'user_id' => $user->id,
            'post' => $request->post,
        ]);

        return back()->with('success','Post created successfully');
    }

    public function updatePost(Request $request){
        $user = User::where('id',Auth::user()->id)->first();
        $post = Post::where('id',$request->post_id)->first();

        if ($user->can('update', $post)){
            $post->update([
                'user_id' => $request->user_id,
                'post' => $request->post,
            ]);

            return back()->with('success','Post updated successfully');
        }else{
            return back()->with('error','you are not author for this post.');
        }
    }
}







