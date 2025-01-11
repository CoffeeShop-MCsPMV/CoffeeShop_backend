<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'cup_id';

    protected $fillable = [
        'order_id',
        'item_price',
    ];

    protected $attributes = [
        'item_price' => 0.00,
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function content()
    {
        return $this->hasMany(Content::class, 'cup_id', 'cup_id');
    }
}
