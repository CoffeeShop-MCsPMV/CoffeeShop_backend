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
            'src' => 'sometimes|nullable|string|max:255', // Az src mező opcionális és szöveg
            'type' => 'sometimes|string|size:1', // Pontosan 1 karakter
            'category' => 'sometimes|string|size:3', // Pontosan 3 karakter
            'is_available' => 'sometimes|boolean', // true/false érték
            'current_price' => 'sometimes|numeric|min:0', // Szám, nem negatív
            'unit_ml' => 'sometimes|integer|min:0', // Egész szám, nem negatív
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

  public function getProductsByType(Request $request)
{
    // Paraméter kinyerése az API kérésből
    $type = $request->input('type');

    // Ellenőrzés, hogy a type paraméter érvényes-e
    if (!in_array($type, ['I', 'F'])) {
        return response()->json(['error' => 'Type is not find'], 400);
    }

    // Query Builder lekérdezés
    $products = DB::table('products')
        ->select('name', 'current_price', 'category', 'is_available')
        ->where('type', '=', $type)
        ->orderBy('name', 'asc')
        ->get();

    return response()->json($products, 200);
}
}
