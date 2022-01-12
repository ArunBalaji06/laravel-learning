<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObserverUser extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'slug',
        'updated_count',
        'status',
        'deleted_at'
    ];
}
