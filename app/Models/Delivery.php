<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'delivery_info';
    
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
