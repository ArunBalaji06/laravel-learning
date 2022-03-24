<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;

class PusherUser extends Model
{
    use HasFactory;

    protected $table = 'pusher_users';

    protected $fillable = [
        'name','email','password'
    ];

    public function message(){
        return $this->hasMany(Message::class,'pusher_user_id');
    }
}
