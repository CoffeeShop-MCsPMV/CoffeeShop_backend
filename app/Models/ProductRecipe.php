<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRecipe extends Model
{
    use HasFactory;
    
    public $incrementing = false;

    protected $fillable = [
        'product',
        'ingredient',
        'quantity',
    ];

    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('product', '=', $this->getAttribute('product'))
            ->where('ingredient', '=', $this->getAttribute('ingredient'));

        return $query;
    }

    public $timestamps = true;

    
    public function product()
    {
        return $this->hasMany(Product::class, 'product');
    }

    public function ingredient()
    {
        return $this->hasMany(Product::class, 'ingredient');
    }

    public function ingredients()
    {
        return $this->hasMany(Product::class, 'ingredient', 'product_id') 
            ->where('type', 'I'); 
    }

    public function finishedProduct()
    {
        return $this->hasMany(Product::class, 'product', 'product_id') 
            ->where('type', 'F'); 
    }
}
