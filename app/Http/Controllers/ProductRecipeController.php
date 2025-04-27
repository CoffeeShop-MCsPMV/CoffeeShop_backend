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

    public function ifProductType($searchTerm)
    {
        $type = Product::where('product_id', $searchTerm)->value('type');
        return $type;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product' => 'required|exists:products,product_id',
            'ingredient' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
        ]);

        
        $productType = $this->ifProductType($validatedData['product']);
        $ingredientType = $this->ifProductType($validatedData['ingredient']);

       
        if ($productType !== 'F' || $ingredientType !== 'I') {
            return response()->json(['error' => 'Invalid product or ingredient type'], 400);
        }

      
        $record = new ProductRecipe();
        $record->product = $validatedData['product'];
        $record->ingredient = $validatedData['ingredient'];
        $record->quantity = $validatedData['quantity'];
        $record->save();

        return response()->json(['message' => 'Product recipe saved successfully'], 201);
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

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);


        $productRecipe = DB::table('product_recipes')
            ->where('product', $productId)
            ->where('ingredient', $ingredientId)
            ->first();


        if (!$productRecipe) {
            return response()->json(['message' => 'Record not found'], 404);
        }


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
            ->join('products as p', 'product_recipes.ingredient', '=', 'p.product_id')
            ->where('product_recipes.product', '=', $productId)
            ->select('p.name as ingredient_name', 'product_recipes.quantity')
            ->get();

        if ($ingredients->isEmpty()) {
            return response()->json(['message' => 'No ingredients found for this product'], 404);
        }

        return response()->json($ingredients);
    }
}
