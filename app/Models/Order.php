<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Profiler\Profile;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user',
        'date',
        'total_cost',
        'order_status'
    ];

    public function userRelation()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    public function statusRelation()
    {
        return $this->belongsTo(Dictionary::class, 'order_status', 'id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    public function ordersToUser()
    {
        return $this->belongsTo(User::class);
    }
}
