<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /** @use HasFactory<\Database\Factories\SaleFactory> */
    use HasFactory;


    protected $fillable = [
        'product_id',
        'sale_price',
        'sale_date',
        'buyer_name',
    ];

    /**
     * Get the vehicle associated with the sale.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
