<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomBucketItem extends Model
{
    protected $fillable = [
        'custom_bucket_id',
        'bouquet_id',
        'quantity'
    ];

    // Relationship with custom bucket
    public function customBucket()
    {
        return $this->belongsTo(CustomBucket::class);
    }

    // Relationship with bouquet
    public function bouquet()
    {
        return $this->belongsTo(Bouquet::class);
    }
}
