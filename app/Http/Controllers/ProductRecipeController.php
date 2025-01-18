<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRecipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductRecipeController extends Controller
{
    public function index()
    {
        return ProductRecipe::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product' => 'required|exists:products,product_id',
            'ingredient' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $record = new ProductRecipe();
        $record->fill($validatedData);
        $record->save();
    }

    public function show($product, $ingredient)
    {
        $productRecipe = ProductRecipe::where('product', $product)
            ->where('ingredient', $ingredient)
            ->firstOrFail();

        return $productRecipe;
    }

    public function update(Request $request, $productId, $ingredientId)
    {
        // Validálás
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Megkeressük az adott rekordot a `product_recipes` táblában
        $productRecipe = DB::table('product_recipes')
            ->where('product', $productId)
            ->where('ingredient', $ingredientId)
            ->first();
    
        // Ellenőrzés, hogy létezik-e a rekord
        if (!$productRecipe) {
            return response()->json(['message' => 'Record not found'], 404);
        }
    
        // Frissítés
        DB::table('product_recipes')
            ->where('product', $productId)
            ->where('ingredient', $ingredientId)
            ->update([
                'quantity' => $request->input('quantity'),
                'updated_at' => now(),
            ]);
    
        return response()->json(['message' => 'Record updated successfully']);
    }
    


    public function destroy($product, $ingredient)
    {
        $this->show($product, $ingredient)->delete();
    }

    public function ingredientsOfProduct($productId)
{
    $ingredients = DB::table('product_recipes')
        ->join('products as p', 'product_recipes.ingredient', '=', 'p.product_id')  // Összekapcsolás a termékek összetevőivel
        ->where('product_recipes.product', '=', $productId)  // A keresett termék ID-ja
        ->select('p.name as ingredient_name', 'product_recipes.quantity')  // Az összetevő neve és mennyisége
        ->get();

    if ($ingredients->isEmpty()) {
        return response()->json(['message' => 'No ingredients found for this product'], 404);
    }

    return response()->json($ingredients);
}

}
