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
    ];


    public function customBucket()
    {
        return $this->belongsTo(CustomBucket::class);
    }
}
