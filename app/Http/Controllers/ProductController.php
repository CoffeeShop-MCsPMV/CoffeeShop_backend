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
            'src' => 'sometimes|nullable|string|max:255', 
            'type' => 'sometimes|string|size:1', 
            'category' => 'sometimes|string|size:3', 
            'is_available' => 'sometimes|boolean',
            'current_price' => 'sometimes|numeric|min:0', 
            'unit' => 'sometimes|integer|min:0',
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

  public function getAvailableProductsByType(Request $request)
{
    $type = $request->input('type');

    if (!in_array($type, ['I', 'F'])) {
        return response()->json(['error' => 'Type is not find'], 400);
    }

    $products = DB::table('products')
        ->select('product_id','name','src', 'current_price', 'category', 'is_available')
        ->where('type', '=', $type)
        ->where('is_available', 1)
        ->orderBy('name', 'asc')
        ->get();

    return response()->json($products, 200);
}

public function getAvailableProductsByCategory(Request $request)
{
    
    $category = $request->input('category');

    if (!in_array($category, ['COF', 'TEA', 'ICF', 'ICT', 'HOD', 'IDR', 'BAS', 'MIL', 'SYR', 'SWE', 'FRU', 'TOP', 'ICE'])) {
        return response()->json(['error' => 'Category is not find'], 400);
    }
    
    $products = DB::table('products')
        ->select('product_id','name','src', 'current_price', 'type', 'is_available')
        ->where('category', '=', $category)
        ->where('is_available', 1)
        ->orderBy('name', 'asc')
        ->get();

    return response()->json($products, 200);
}
}
