<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');  
            $table->unsignedBigInteger('user');  
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('total_cost', 10, 2)->default(0);
            $table->string('order_status')->default('REC');
            $table->timestamps();
                   
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_status')->references('code')->on('dictionaries')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
