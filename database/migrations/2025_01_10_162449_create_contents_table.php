<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->unsignedBigInteger('cup_id');  
            $table->unsignedBigInteger('product_id'); 
            $table->primary(['cup_id', 'product_id']);  
            $table->char('product_type', 1)->default(null);  
            $table->timestamps();
            
            $table->foreign('cup_id')->references('cup_id')->on('order_items')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
