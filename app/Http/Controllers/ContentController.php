<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    public function show($cup_id, $product_id)
    {
        $cup_content = Content::where('cup_id', $cup_id)
            ->where('product_id', $product_id)
            ->get();
        return $cup_content[0];
    }

    public function store(Request $request)
    {
        $record = new Content();
        $record->fill($request->all());
        $record->save();
    }

    public function update(Request $request, $cup_id, $product_id)
    {
        $record = $this->show($cup_id, $product_id);
        $record->fill($request->all());
        $record->save();
    }

    public function destroy($cup_id, $product_id)
    {
        $this->show($cup_id, $product_id)->delete();
    }

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
}
