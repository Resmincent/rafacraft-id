<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    /** @use HasFactory<\Database\Factories\CartItemFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'full_name',
        'phone_number',
        'address',
        'city',
        'pickup',
        'custom_bucket_id',
        'item_type',
        'cart_id',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customBucket()
    {
        return $this->belongsTo(CustomBucket::class);
    }

    public function getPrice()
    {
        return $this->item_type === 'product'
            ? $this->product->price
            : $this->customBucket->price;
    }
}
