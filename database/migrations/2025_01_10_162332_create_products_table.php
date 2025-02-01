<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id')->startingValue(20000);
            $table->string('name', 40);
            $table->string('src')->nullable();
            $table->char('type', 1);
            $table->char('category', 3);
            $table->boolean('is_available')->default(true);
            $table->decimal('current_price');
            $table->integer('unit');
            $table->timestamps();

            $table->foreign('category')->references('code')->on('dictionaries')->onDelete('cascade'); });

            DB::table('products')->insert([
                // Összetevők
                ['name' => 'Ground Coffee', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 10],
                ['name' => 'Water', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 30],
                ['name' => 'Milk', 'type' => 'I', 'category' => 'MIL', 'current_price' => 0, 'unit' => 100],
                ['name' => 'Whipped Cream', 'type' => 'I', 'category' => 'TOP', 'current_price' => 0, 'unit' => 30],
                // ['name' => 'Ice', 'type' => 'I', 'category' => '', 'current_price' => 0, 'unit' => 200],
                ['name' => 'Chocolate Syrup', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 20],
                ['name' => 'Matcha Powder', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 2],
                ['name' => 'Honey', 'type' => 'I', 'category' => 'SWE', 'current_price' => 0, 'unit' => 10],
                ['name' => 'Cinnamon Syrup', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 10],
                ['name' => 'Vanilla Syrup', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 20],
                ['name' => 'Coconut Syrup', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 20],
                ['name' => 'Lavender Syrup', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 10],
                ['name' => 'Chai Tea Concentrate', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 20],
                ['name' => 'Peach Tea Bag', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 1],
                ['name' => 'Black Tea Bag', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 1],
            
                // Késztermékek
                ['name' => 'Espresso', 'type' => 'F', 'category' => 'COF', 'current_price' => 1.50, 'unit' => 30],
                ['name' => 'Cappuccino', 'type' => 'F', 'category' => 'COF', 'current_price' => 2.50, 'unit' => 150],
                ['name' => 'Latte', 'type' => 'F', 'category' => 'COF', 'current_price' => 2.80, 'unit' => 250],
                ['name' => 'Frappuccino (Iced)', 'type' => 'F', 'category' => 'ICF', 'current_price' => 4.00, 'unit' => 300],
                ['name' => 'Matcha Latte', 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Flat White', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.20, 'unit' => 200],
                ['name' => 'Melange', 'type' => 'F', 'category' => 'COF', 'current_price' => 2.70, 'unit' => 200],
                ['name' => 'Hot Chocolate', 'type' => 'F', 'category' => 'HOD', 'current_price' => 1.80, 'unit' => 250],
                ['name' => 'Green Tea', 'type' => 'F', 'category' => 'TEA', 'current_price' => 1.50, 'unit' => 200],
                ['name' => 'Iced Coffee', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.00, 'unit' => 300],
                ['name' => 'Winter Coffee (Iced)', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.50, 'unit' => 350],
                ['name' => 'Tea Latte', 'type' => 'F', 'category' => 'HOD', 'current_price' => 2.80, 'unit' => 250],
                ['name' => 'Iced Latte', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.00, 'unit' => 250],
                ['name' => 'Iced Mocha', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.50, 'unit' => 300],
                ['name' => 'Macchiato', 'type' => 'F', 'category' => 'COF', 'current_price' => 2.00, 'unit' => 90],
                ['name' => 'Caramel Latte', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Affogato', 'type' => 'F', 'category' => 'COF', 'current_price' => 4.00, 'unit' => 150],
                ['name' => 'Vanilla Latte', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Iced Matcha Latte', 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.80, 'unit' => 250],
                ['name' => 'Cinnamon Latte', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.30, 'unit' => 250],
                ['name' => 'Chai Latte', 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.20, 'unit' => 250],
                ['name' => 'Ristretto', 'type' => 'F', 'category' => 'COF', 'current_price' => 1.50, 'unit' => 20],
                ['name' => 'Turmeric Latte', 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Honey Lavender Latte', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.80, 'unit' => 250],
                ['name' => 'Iced Americano', 'type' => 'F', 'category' => 'ICF', 'current_price' => 2.50, 'unit' => 300],
                ['name' => 'Caramel Macchiato', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Iced Flat White', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Affogato with Chocolate Syrup', 'type' => 'F', 'category' => 'COF', 'current_price' => 4.20, 'unit' => 150],
                ['name' => 'Coconut Latte', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Iced Caramel Latte', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.80, 'unit' => 300],
                ['name' => 'Peach Iced Tea', 'type' => 'F', 'category' => 'ICT', 'current_price' => 2.50, 'unit' => 300],
                ['name' => 'Iced Chai Latte', 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.50, 'unit' => 300],
                ]);

                DB::table('products')->insert([
                    ['name' => 'Classic Lemonade', 'type' => 'F', 'category' => 'IDR', 'current_price' => 2.50, 'unit' => 300],
                    ['name' => 'Strawberry Lemonade', 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.00, 'unit' => 300],
                    ['name' => 'Blueberry Lemonade', 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.20, 'unit' => 300],
                    ['name' => 'Lavender Lemonade', 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.50, 'unit' => 300],
                    ['name' => 'Berry Punch', 'type' => 'F', 'category' => 'HOD', 'current_price' => 4.00, 'unit' => 350],
                    ['name' => 'Citrus Punch', 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.50, 'unit' => 300],
                    ['name' => 'Peach Punch', 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.70, 'unit' => 300],
                ]);

                // kimaradt összetevők:

                DB::table('products')->insert([
                    ['name' => 'Espresso Coffee', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 30],
                    ['name' => 'Ice', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 200],
                    ['name' => 'Caramel Syrup', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 20],
                    ['name' => 'Vanilla Ice Cream', 'type' => 'I', 'category' => 'TOP', 'current_price' => 0, 'unit' => 100],
                    ['name' => 'Turmeric Powder', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 2],
                    ['name' => 'Raspberry Puree', 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 20],
                    ['name' => 'Blueberry Puree', 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 30],
                    ['name' => 'Cranberry Juice', 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 50],
                    ['name' => 'Lime Juice', 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 20],
                    ['name' => 'Peach Puree', 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 40],
                    ['name' => 'Strawberry Puree', 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 30],
                    ['name' => 'Fresh Lemon Juice', 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 30],
                    ['name' => 'Orange Juice', 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 50],
                ]);
                
                
                
        
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
