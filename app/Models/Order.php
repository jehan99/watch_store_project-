<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order_info';

    protected $fillable = [
        'user_id',
        'product_id',
        'item_name',
        'item_image',
        'price',
        'quantity',
        'total',
        'name',
        'email',
        'phone',
        'address',
        'province',
        'status', 
    ];

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);

    }




}