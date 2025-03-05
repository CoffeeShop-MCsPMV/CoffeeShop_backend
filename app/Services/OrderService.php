<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Content;
use App\Models\Product;

class OrderService
{
    public function createOrderWithItems(int $userId, array $products)
    {
        DB::beginTransaction();

        try {
            // Új rendelés létrehozása
            $order = Order::create(['user' => $userId]);

            $contents = [];

            foreach ($products as $productId) {
                // Termék típusának és árának lekérése
                $product = Product::where('product_id', $productId)->first();
                if (!$product) {
                    throw new \Exception("Product not found: $productId");
                }

                // OrderItem létrehozása
                $orderItem = OrderItem::create([
                    'order_id' => $order->order_id,
                    'item_price' => $product->current_price,
                ]);

                // Content rekord előkészítése
                $contents[] = [
                    'cup_id' => $orderItem->cup_id,
                    'product_id' => $productId,
                    'product_type' => $product->type
                ];

                // Rendelés teljes költségének frissítése
                $order->total_cost += $product->current_price;
            }

            // Content rekordok beszúrása
            Content::insert($contents);

            // Rendelés mentése frissített árral
            $order->save();

            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
