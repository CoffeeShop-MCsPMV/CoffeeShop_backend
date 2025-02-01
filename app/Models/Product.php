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
        'category',
        'is_available',
        'current_price',
        'unit',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

}
