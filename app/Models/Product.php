<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $primaryKey = 'product_id';
    

    protected $fillable = [
        'product_name',
        'type',
        'chategory',
        'is_available',
        'current_price',
        'unit_ml',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

}
