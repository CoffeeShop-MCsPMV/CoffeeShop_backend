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
        DB::table('orders')->insert([
            ['user' => 2, 'order_status' => 'COM'],
            ['user' => 1, 'order_status' => 'COM'],
            ['user' => 2, 'order_status' => 'COM'],
            ['user' => 1, 'order_status' => 'COM'],
            ['user' => 1, 'order_status' => 'COM'],
            ['user' => 2, 'order_status' => 'COM'],
            ['user' => 2, 'order_status' => 'COM'],
            ['user' => 1, 'order_status' => 'COM'],
            ['user' => 2, 'order_status' => 'COM'],
        ]);

        DB::table('order_items')->insert([
            ['order_id' => 1],
            ['order_id' => 2],
            ['order_id' => 3],
            ['order_id' => 4],
            ['order_id' => 5],
            ['order_id' => 6],
            ['order_id' => 7],
            ['order_id' => 8],
            ['order_id' => 9]
        ]);

        DB::table('contents')->insert([
            ['cup_id' => 1, 'product_id' => 20014],
            ['cup_id' => 2, 'product_id' => 20015],
            ['cup_id' => 3, 'product_id' => 20014],
            ['cup_id' => 4, 'product_id' => 20015],
            ['cup_id' => 5, 'product_id' => 20016],
            ['cup_id' => 6, 'product_id' => 20016],
            ['cup_id' => 7, 'product_id' => 20017],
            ['cup_id' => 8, 'product_id' => 20017],
            ['cup_id' => 9, 'product_id' => 20018],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
