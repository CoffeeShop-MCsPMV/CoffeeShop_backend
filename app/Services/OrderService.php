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
                // Kevert termékek kezelése
                if (is_array($productId)) {
                    $mixedProductId = $productId;
                    $mixedPrice = 0.0;

                    // Kevert termékek ciklusa
                    $orderItem = OrderItem::create([
                        'order_id' => $order->order_id,
                        'item_price' => 0.0, // Kezdeti ár
                    ]);

                    foreach ($mixedProductId as $ingredient) {
                        $ingredientOfCup = Product::where('product_id', $ingredient)->first();
                        if ($ingredientOfCup) {
                            $contents[] = [
                                'cup_id' => $orderItem->cup_id,
                                'product_id' => $ingredientOfCup->product_id,
                                'product_type' => $ingredientOfCup->type
                            ];
                            $mixedPrice += $ingredientOfCup->current_price;
                        }
                    }

                    // Frissítés kevert termék ára
                    $orderItem->item_price = $mixedPrice;
                    $order->total_cost += $mixedPrice;

                } else {
                    // Normál termékek kezelése
                    $product = Product::where('product_id', $productId)->first();
                    if (!$product) {
                        throw new \Exception("Product not found: $productId");
                    }

                    $orderItem = OrderItem::create([
                        'order_id' => $order->order_id,
                        'item_price' => $product->current_price,
                    ]);

                    // Content rekord előkészítése
                    $contents[] = [
                        'cup_id' => $orderItem->cup_id,
                        'product_id' => $product->product_id,
                        'product_type' => $product->type
                    ];

                    $order->total_cost += $product->current_price;
                }
            }

            // Content rekordok egyszerre történő beszúrása
            Content::insert($contents);

            // Rendelés mentése
            $order->save();

            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
