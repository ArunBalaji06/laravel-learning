<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventListenerUser extends Model
{
    use HasFactory;

    /**
     *The attributes that are mass assignable.
     * 
     * $table = event_listener_users
     */
    protected $table = 'event_listener_users';

    protected $fillable = [
        'name','email','password','logged_in','logged_out'
    ];
}
