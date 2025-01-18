<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id')->startingValue(20000);;
            $table->string('name', 40);
            $table->char('type', 1);
            $table->char('category', 3);
            $table->boolean('is_available')->default(true);
            $table->decimal('current_price');
            $table->integer('unit_ml');
            $table->timestamps();

            $table->foreign('category')->references('id')->on('dictionaries')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
