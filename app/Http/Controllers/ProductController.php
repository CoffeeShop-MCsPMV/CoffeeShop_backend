<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:40',
            'type' => 'sometimes|string|size:1',
            'category' => 'sometimes|string|size:3',
            'is_available' => 'sometimes|boolean',
            'current_price' => 'sometimes|numeric|min:0',
            'unit_ml' => 'sometimes|integer|min:0',
        ]);

        $record = new Product();
        $record->fill($validatedData);
        $record->save();
    }

    public function show($id)
    {
        return Product::find($id);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:40',
            'type' => 'sometimes|string|size:1',
            'category' => 'sometimes|string|size:3',
            'is_available' => 'sometimes|boolean',
            'current_price' => 'sometimes|numeric|min:0',
            'unit_ml' => 'sometimes|integer|min:0',
        ]);

        $product->fill($validatedData);
        $product->save();
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }

    // public function getProductsByType($type)
    // {
    //     if (!in_array($type, ['I', 'F'])) {
    //         return response()->json(['error' => 'Type is not find'], 400);
    //     }

    //     $products = Product::where('type', $type)
    //         ->orderBy('product_name')
    //         ->get(['product_name', 'current_price', 'chategory', 'is_available']);
    //     return response()->json($products, 200);
    // }

    public function getProductsByType($type)
{
    if (!in_array($type, ['I', 'F'])) {
        return response()->json(['error' => 'Type is not find'], 400);
    }

    $sql = "
        SELECT 
            product_name, 
            current_price, 
            chategory, 
            is_available
        FROM 
            products
        WHERE 
            type = :type
        ORDER BY 
            product_name ASC
    ";

    $products = DB::select($sql, ['type' => $type]);

    return response()->json($products, 200);
}
}
