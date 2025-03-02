<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    public function addType($product){
        $type=Product::where('product_id',$product)->value('type');
        return $type;

    }

    public function costCounter($product, $cup,){
        $price=Product::where('product_id',$product)->value('current_price');
        $orderItem=OrderItem::where('cup_id',$cup);
        $orderItem->item_price += $price;
        $orderItem->save(); 

        $order=Order::where('order_id',($orderItem->value('order_id')));
        $order->total_cost += $price;
        $order->save();
    }
    
    public function show($cup_id, $product_id)
    {
        $cup_content = Content::where('cup_id', $cup_id)
            ->where('product_id', $product_id)
            ->get();
        return $cup_content[0];
    }

    public function store(Request $request)
    {
        $product = $request->input('product_id');
        $cup = $request->input('cup_id');
        $this->costCounter($product, $cup);
        $record = new Content();
        $record->fill($request->all());
        $record->product_type = $this->addType($product);
        $record->save();
    }

    // public function update(Request $request, $cup_id, $product_id)
    // {
    //     $record = $this->show($cup_id, $product_id);
    //     $record->fill($request->all());
    //     $record->save();
    // }

    // public function destroy($cup_id, $product_id)
    // {
    //     $this->show($cup_id, $product_id)->delete();
    // }

    public function contentsOfCup()
    {
        $content = DB::select(
            "
           SELECT 
                    contents.*,
                    products.name AS product_name,
                    products.type AS product_type,
                    products.current_price AS product_price,
                    product_recipes.ingredient,
                    product_recipes.quantity
                FROM 
                    contents
                LEFT JOIN 
                    products ON contents.product_id = products.product_id
                LEFT JOIN 
                    product_recipes ON contents.product_id = product_recipes.product
                ORDER BY 
                    contents.cup_id;"
        );

        return response()->json($content);
    }

    public function topProducts()
    {
        $topItems = DB::select("
            SELECT 
                contents.product_id, 
                COUNT(*) AS total_count
            FROM 
                contents
            JOIN 
                products ON contents.product_id = products.product_id
            WHERE 
                products.type = 'T'
            GROUP BY 
                contents.product_id
            ORDER BY 
                total_count DESC
            LIMIT 3
        ");
        return response()->json($topItems);
    }
}
