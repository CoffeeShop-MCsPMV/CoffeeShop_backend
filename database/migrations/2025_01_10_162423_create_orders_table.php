<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');  // order_id lesz az elsődleges kulcs
            $table->unsignedBigInteger('user');  // Külső kulcs
            $table->datetime('date');
            $table->decimal('total_cost', 10, 2)->default(0);
            $table->char('order_status', 3);
            $table->timestamps();
        
            // Külső kulcs beállítása a 'user' oszlopra (users táblához)
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
        });
        
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
