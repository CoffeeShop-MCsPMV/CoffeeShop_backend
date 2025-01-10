<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

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
        $content = Content::with('product', 'productRecipe') // Betöltjük a terméket és a receptet
            ->orderBy('cup_id')
            ->get();
    }
}
