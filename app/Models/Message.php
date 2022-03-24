<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PusherUser;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'pusher_user_id','message'
    ];

    public function pusherUser(){
        return $this->belongsTo(PusherUser::class,'pusher_user_id');
    }
}
