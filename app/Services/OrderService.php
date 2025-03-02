<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Content;

class OrderService
{
    public function createOrderWithItems(int $userId, array $products)
    {
        DB::beginTransaction(); 

        try {
            // Új rendelés létrehozása
            $order = Order::create(['user' => $userId]);

            // OrderItem rekordok előkészítése
            $orderItems = [];
            foreach ($products as $productId) {
                // Az order_id-t és a megfelelő product_id-t hozzárendeljük
                $orderItems[] = [
                    'order_id' => $order->order_id,  // Az order_id a rendelés ID-ja
                ];
            }

            // OrderItem rekordok beszúrása
            OrderItem::insert($orderItems); 

            // Az OrderItem-ok lekérése, hogy a cup_id-t is hozzáadhassuk a Content táblához
            $orderItemsFromDb = OrderItem::where('order_id', $order->order_id)->get();

            // Content rekordok előkészítése
            $contents = [];
            foreach ($orderItemsFromDb as $index => $orderItem) {
                // A cup_id és product_id összekapcsolása a Content táblában
                $contents[] = [
                    'cup_id' => $orderItem->cup_id,  
                    'product_id' => $products[$index],  // A termék ID-ját az eredeti listából
                ];
            }

            // Content rekordok beszúrása
            Content::insert($contents); 

            DB::commit();  // Ha minden rendben ment, elkötelezzük az adatokat
            return $order;
        } catch (\Exception $e) {
            DB::rollBack();  // Ha bármi hiba történik, visszavonjuk az összes műveletet
            throw $e;  // Kivétel dobása
        }
    }
}
