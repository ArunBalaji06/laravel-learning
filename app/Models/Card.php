<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','card_brand','exp_month','exp_year','last4','is_default','payment_method_id',
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
