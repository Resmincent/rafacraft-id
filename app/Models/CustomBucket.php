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
        'image',
        'size'
    ];


    public function bouquets()
    {
        return $this->hasMany(Bouquet::class);
    }
}
