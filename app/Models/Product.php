<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'availability',
        'specifications',

    ];

    protected $casts = [
        'specifications' => 'array',
    ];

    public function getAvailabilityTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->availability));
    }
    

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function mainImage()
    {
        return $this->hasOne(ProductImage::class, 'product_id')
                    ->where('is_main', true);
    }

    public function galleryImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id')
                    ->where('is_main', false);
    }

    


}
