<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRecipe;
use Illuminate\Http\Request;

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

    public function update(Request $request, $product, $ingredient)
    {
        $record = $this->show($product, $ingredient);

        // $validatedData = $request->validate([
        //     'quantity' => 'sometimes|integer|min:1',
        // ]);

        $record->fill($request->all());
        $record->save();
    }

    public function destroy($product, $ingredient)
    {
        $this->show($product, $ingredient)->delete();
    }

    public function ingredientsOfProduct()
    {
        $recipe = ProductRecipe::with(['ingredients', 'finishedProduct'])->get();
        return response()->json($recipe);
    }
}
