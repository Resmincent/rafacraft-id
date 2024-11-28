<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bouquet extends Model
{
    /** @use HasFactory<\Database\Factories\BouquetFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
    ];


    public function customBucketItems()
    {
        return $this->hasMany(CustomBucketItem::class);
    }
}
