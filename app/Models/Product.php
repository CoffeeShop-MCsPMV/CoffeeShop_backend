<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';
    
    protected $fillable = [
        'name',
        'src',
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
