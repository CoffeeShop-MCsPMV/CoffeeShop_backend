<?php

use App\Models\ProductRecipe;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_recipes', function (Blueprint $table) {
            $table->primary(['product', 'ingredient']);
            $table->unsignedBigInteger('product');
            $table->unsignedBigInteger('ingredient');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('product')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('ingredient')->references('product_id')->on('products')->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_recipes');
    }
};
