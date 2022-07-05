<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','payment_type','amount','currency',
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
