<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomBucket extends Model
{
    /** @use HasFactory<\Database\Factories\CustomBucketFactory> */
    use HasFactory;

    protected $fillable = [
        'tema',
        'color',
        'price',
        'bouquet_id',
        'size_id',
        'image'
    ];


    public function customBucketItems()
    {
        return $this->hasMany(CustomBucketItem::class);
    }

    public function bouquets()
    {
        return $this->hasManyThrough(Bouquet::class, CustomBucketItem::class, 'custom_bucket_id', 'id', 'id', 'bouquet_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
