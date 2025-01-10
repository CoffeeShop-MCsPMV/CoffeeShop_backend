<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('cup_id');  // Automatikusan növekvő elsődleges kulcs
            $table->unsignedBigInteger('order_id');  // Külső kulcs a 'orders' táblához
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->decimal('item_price', 10, 2)->default(0.00);
            $table->timestamps();
        });
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
