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
            $table->integer('unit_ml');
            $table->timestamps();

            $table->foreign('category')->references('code')->on('dictionaries')->onDelete('cascade'); });

            DB::table('products')->insert([
                // Összetevők
                ['name' => 'Ground Coffee', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit_ml' => 10],
                ['name' => 'Water', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit_ml' => 30],
                ['name' => 'Milk', 'type' => 'I', 'category' => 'MIL', 'current_price' => 0, 'unit_ml' => 100],
                ['name' => 'Whipped Cream', 'type' => 'I', 'category' => 'TOP', 'current_price' => 0, 'unit_ml' => 30],
                // ['name' => 'Ice', 'type' => 'I', 'category' => '', 'current_price' => 0, 'unit_ml' => 200],
                ['name' => 'Chocolate Syrup', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit_ml' => 20],
                ['name' => 'Matcha Powder', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit_ml' => 2],
                ['name' => 'Honey', 'type' => 'I', 'category' => 'SWE', 'current_price' => 0, 'unit_ml' => 10],
                ['name' => 'Cinnamon Syrup', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit_ml' => 10],
                ['name' => 'Vanilla Syrup', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit_ml' => 20],
                ['name' => 'Coconut Syrup', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit_ml' => 20],
                ['name' => 'Lavender Syrup', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit_ml' => 10],
                ['name' => 'Chai Tea Concentrate', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit_ml' => 20],
                ['name' => 'Peach Tea Bag', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit_ml' => 1],
                ['name' => 'Black Tea Bag', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit_ml' => 1],
            
                // Késztermékek
                ['name' => 'Espresso', 'type' => 'F', 'category' => 'COF', 'current_price' => 1.50, 'unit_ml' => 30],
                ['name' => 'Cappuccino', 'type' => 'F', 'category' => 'COF', 'current_price' => 2.50, 'unit_ml' => 150],
                ['name' => 'Latte', 'type' => 'F', 'category' => 'COF', 'current_price' => 2.80, 'unit_ml' => 250],
                ['name' => 'Frappuccino (Iced)', 'type' => 'F', 'category' => 'ICF', 'current_price' => 4.00, 'unit_ml' => 300],
                ['name' => 'Matcha Latte', 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.50, 'unit_ml' => 250],
                ['name' => 'Flat White', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.20, 'unit_ml' => 200],
                ['name' => 'Melange', 'type' => 'F', 'category' => 'COF', 'current_price' => 2.70, 'unit_ml' => 200],
                ['name' => 'Hot Chocolate', 'type' => 'F', 'category' => 'HOD', 'current_price' => 1.80, 'unit_ml' => 250],
                ['name' => 'Green Tea', 'type' => 'F', 'category' => 'TEA', 'current_price' => 1.50, 'unit_ml' => 200],
                ['name' => 'Iced Coffee', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.00, 'unit_ml' => 300],
                ['name' => 'Winter Coffee (Iced)', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.50, 'unit_ml' => 350],
                ['name' => 'Tea Latte', 'type' => 'F', 'category' => 'HOD', 'current_price' => 2.80, 'unit_ml' => 250],
                ['name' => 'Iced Latte', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.00, 'unit_ml' => 250],
                ['name' => 'Iced Mocha', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.50, 'unit_ml' => 300],
                ['name' => 'Macchiato', 'type' => 'F', 'category' => 'COF', 'current_price' => 2.00, 'unit_ml' => 90],
                ['name' => 'Caramel Latte', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.50, 'unit_ml' => 250],
                ['name' => 'Affogato', 'type' => 'F', 'category' => 'COF', 'current_price' => 4.00, 'unit_ml' => 150],
                ['name' => 'Vanilla Latte', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.50, 'unit_ml' => 250],
                ['name' => 'Iced Matcha Latte', 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.80, 'unit_ml' => 250],
                ['name' => 'Cinnamon Latte', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.30, 'unit_ml' => 250],
                ['name' => 'Chai Latte', 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.20, 'unit_ml' => 250],
                ['name' => 'Ristretto', 'type' => 'F', 'category' => 'COF', 'current_price' => 1.50, 'unit_ml' => 20],
                ['name' => 'Turmeric Latte', 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.50, 'unit_ml' => 250],
                ['name' => 'Honey Lavender Latte', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.80, 'unit_ml' => 250],
                ['name' => 'Iced Americano', 'type' => 'F', 'category' => 'ICF', 'current_price' => 2.50, 'unit_ml' => 300],
                ['name' => 'Caramel Macchiato', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.50, 'unit_ml' => 250],
                ['name' => 'Iced Flat White', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.50, 'unit_ml' => 250],
                ['name' => 'Affogato with Chocolate Syrup', 'type' => 'F', 'category' => 'COF', 'current_price' => 4.20, 'unit_ml' => 150],
                ['name' => 'Coconut Latte', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.50, 'unit_ml' => 250],
                ['name' => 'Iced Caramel Latte', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.80, 'unit_ml' => 300],
                ['name' => 'Peach Iced Tea', 'type' => 'F', 'category' => 'ICT', 'current_price' => 2.50, 'unit_ml' => 300],
                ['name' => 'Iced Chai Latte', 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.50, 'unit_ml' => 300],
                ]);
                
        
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
