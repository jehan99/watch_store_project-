<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    
    protected $fillable = [
        'user_id',
        'name',
        'number',
        'email',
        'address',
        'province'
    ];

    
    use HasFactory;
}
