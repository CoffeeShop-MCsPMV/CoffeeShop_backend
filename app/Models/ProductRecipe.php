<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRecipe extends Model
{
    /** @use HasFactory<\Database\Factories\ProductRecipeFactory> */
    use HasFactory;
    
    protected $primaryKey = ['product', 'ingredient'];
    public $incrementing = false;

    protected $fillable = [
        'product',
        'ingredient',
        'quantity',
    ];

    public $timestamps = true;

    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product');
    }

    public function ingredient()
    {
        return $this->belongsTo(Product::class, 'ingredient');
    }

    public function ingredients()
    {
        return $this->belongsTo(Product::class, 'ingredient', 'product_id') 
            ->where('type', 'I'); 
    }

    public function finishedProduct()
    {
        return $this->belongsTo(Product::class, 'product', 'product_id') 
            ->where('type', 'F'); 
    }
}
