<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Address;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function address(){
        return $this->hasOne(Address::class);
    }


    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }


    public function setNameAttribute($value)
    {
        return $this->attributes['first_name'] = $this->name.' '.$value.' '.$this->email;
    }

    public function scopeFirstuser($value){
        return $value->where('id',1);
    }
    
}
