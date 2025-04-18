<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    public function index()
    {
        return OrderItem::all();
    }

    public function show($cup_id, $order_id)
    {
        return OrderItem::where('cup_id', $cup_id)
            ->where('order_id', $order_id)
            ->first();
    }

    public function store(Request $request)
    {
        $record = new OrderItem();
        $record->order_id = $request->order_id;
        $record->save();
    }

    public function update(Request $request, $cup_id, $order_id)
    {
        $record = OrderItem::where('cup_id', $cup_id)
            ->where('order_id', $order_id)
            ->first();

        if ($record) {
            $record->item_price = $request->item_price;
            $record->save();
        }
    }

    public function destroy($cup_id, $order_id)
    {
        OrderItem::where('cup_id', $cup_id)
            ->where('order_id', $order_id)
            ->delete();
    }


    public function getLastCup($orderId)
    {

        $lastCupId = OrderItem::where('order_id', $orderId)
            ->latest('created_at')
            ->value('cup_id');

        return $lastCupId;
    }
}
