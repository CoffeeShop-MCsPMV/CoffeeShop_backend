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
                ['name' => 'Ground Coffee', 'src' => null, 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 2],
                ['name' => 'Water', 'src' => null, 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 10],
                ['name' => 'Milk', 'src' => null, 'type' => 'I', 'category' => 'MIL', 'current_price' => 0, 'unit' => 100],
                ['name' => 'Whipped Cream', 'src' => null, 'type' => 'I', 'category' => 'TOP', 'current_price' => 0, 'unit' => 30],
                // ['name' => 'Ice', 'type' => 'I', 'category' => '', 'current_price' => 0, 'unit' => 200],
                ['name' => 'Chocolate Syrup', 'src' => null, 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 20],
                ['name' => 'Matcha Powder', 'src' => null, 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 2],
                ['name' => 'Honey', 'src' => null, 'type' => 'I', 'category' => 'SWE', 'current_price' => 0, 'unit' => 10],
                ['name' => 'Cinnamon Syrup', 'src' => null, 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 10],
                ['name' => 'Vanilla Syrup', 'src' => null, 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 20],
                ['name' => 'Coconut Syrup', 'src' => null, 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 20],
                ['name' => 'Lavender Syrup', 'src' => null, 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 10],
                ['name' => 'Chai Tea Concentrate', 'src' => null, 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 20],
                ['name' => 'Peach Tea Bag', 'src' => null, 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 1],
                ['name' => 'Black Tea Bag', 'src' => null, 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 1],
            
                // Késztermékek
                ['name' => 'Espresso', 'src' => asset('images/espresso.png'), 'type' => 'F', 'category' => 'COF', 'current_price' => 1.50, 'unit' => 30],
                ['name' => 'Cappuccino', 'src' => asset('images/cappucino.png'), 'type' => 'F', 'category' => 'COF', 'current_price' => 2.50, 'unit' => 150],
                ['name' => 'Latte', 'src' => asset('images/latte.png'), 'type' => 'F', 'category' => 'COF', 'current_price' => 2.80, 'unit' => 250],
                ['name' => 'Frappuccino (Iced)', 'src' => asset('images/frappucino.png'), 'type' => 'F', 'category' => 'ICF', 'current_price' => 4.00, 'unit' => 300],
                ['name' => 'Matcha Latte', 'src' => asset('images/matcha latte.png'), 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Flat White', 'src' => asset('images/flat white.png'), 'type' => 'F', 'category' => 'COF', 'current_price' => 3.20, 'unit' => 200],
                ['name' => 'Melange', 'src' => asset('images/melange.png'), 'type' => 'F', 'category' => 'COF', 'current_price' => 2.70, 'unit' => 200],
                ['name' => 'Hot Chocolate', 'src' => asset('images/hot chocolate.png'), 'type' => 'F', 'category' => 'HOD', 'current_price' => 1.80, 'unit' => 250],
                ['name' => 'Green Tea', 'src' => asset('images/green tea.png'), 'type' => 'F', 'category' => 'TEA', 'current_price' => 1.50, 'unit' => 200],
                ['name' => 'Iced Coffee', 'src' => asset('images/iced coffee.png'), 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.00, 'unit' => 300],
                ['name' => 'Winter Coffee (Iced)', 'src' => asset('images/winter coffee.png'), 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.50, 'unit' => 350],
                ['name' => 'Tea Latte', 'src' => asset('images/tea latte.png'), 'type' => 'F', 'category' => 'HOD', 'current_price' => 2.80, 'unit' => 250],
                ['name' => 'Iced Latte', 'src' => asset('images/iced latte.png'), 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.00, 'unit' => 250],
                ['name' => 'Iced Mocha', 'src' => asset('images/iced mocha.png'), 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.50, 'unit' => 300],
                ['name' => 'Macchiato', 'src' => asset('images/macchiato.png'), 'type' => 'F', 'category' => 'COF', 'current_price' => 2.00, 'unit' => 90],
                ['name' => 'Caramel Latte', 'src' => asset('images/caramel latte.png'), 'type' => 'F', 'category' => 'COF', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Affogato', 'src' => asset('images/affogato.png'), 'type' => 'F', 'category' => 'COF', 'current_price' => 4.00, 'unit' => 150],
                ['name' => 'Vanilla Latte', 'src' => asset('images/vanilia latte.png'), 'type' => 'F', 'category' => 'COF', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Iced Matcha Latte', 'src' => asset('images/iced matcha latte.png'), 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.80, 'unit' => 250],
                ['name' => 'Cinnamon Latte', 'src' => asset('images/cinamon latte.png'), 'type' => 'F', 'category' => 'COF', 'current_price' => 3.30, 'unit' => 250],
                ['name' => 'Chai Latte', 'src' => asset('images/chai latte.png'), 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.20, 'unit' => 250],
                ['name' => 'Ristretto', 'src' => asset('images/ristretto.png'), 'type' => 'F', 'category' => 'COF', 'current_price' => 1.50, 'unit' => 20],
                ['name' => 'Turmeric Latte', 'src' => asset('images/turmeric latte.png'), 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Honey Lavender Latte', 'src' => asset('images/honey lavender latte.png'), 'type' => 'F', 'category' => 'COF', 'current_price' => 3.80, 'unit' => 250],
                ['name' => 'Iced Americano', 'src' => asset('images/iced americano.png'), 'type' => 'F', 'category' => 'ICF', 'current_price' => 2.50, 'unit' => 300],
                ['name' => 'Caramel Macchiato', 'src' => asset('images/caramel machiato.png'), 'type' => 'F', 'category' => 'COF', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Iced Flat White', 'src' => asset('images/iced flat white.png'), 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Affogato with Chocolate Syrup', 'src' => asset('images/affogato chocolate.png'), 'type' => 'F', 'category' => 'COF', 'current_price' => 4.20, 'unit' => 150],
                ['name' => 'Coconut Latte', 'src' => asset('images/coconut latte.png'), 'type' => 'F', 'category' => 'COF', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Iced Caramel Latte', 'src' => asset('images/iced caramel latte.png'), 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.80, 'unit' => 300],
                ['name' => 'Peach Iced Tea', 'src' => asset('images/iced peach tea.png'), 'type' => 'F', 'category' => 'ICT', 'current_price' => 2.50, 'unit' => 300],
                ['name' => 'Iced Chai Latte', 'src' => asset('images/iced chai latte.png'), 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.50, 'unit' => 300],
                ]);

                DB::table('products')->insert([
                    ['name' => 'Classic Lemonade', 'src' => asset('images/classic lemonade.png'), 'type' => 'F', 'category' => 'IDR', 'current_price' => 2.50, 'unit' => 300],
                    ['name' => 'Strawberry Lemonade', 'src' => asset('images/strawberry lemonade.png'), 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.00, 'unit' => 300],
                    ['name' => 'Blueberry Lemonade', 'src' => asset('images/blueberry lemonade.png'), 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.20, 'unit' => 300],
                    ['name' => 'Lavender Lemonade', 'src' => asset('images/lavender lemonade.png'), 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.50, 'unit' => 300],
                    ['name' => 'Berry Punch', 'src' => asset('images/berry punch.png'), 'type' => 'F', 'category' => 'HOD', 'current_price' => 4.00, 'unit' => 350],
                    ['name' => 'Citrus Punch', 'src' => asset('images/citrus punch.png'), 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.50, 'unit' => 300],
                    ['name' => 'Peach Punch', 'src' => asset('images/peach punch.png'), 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.70, 'unit' => 300],
                ]);

                // kimaradt összetevők:

                DB::table('products')->insert([
                    ['name' => 'Espresso Coffee', 'src' => null, 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 30],
                    ['name' => 'Ice', 'src' => null, 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 200],
                    ['name' => 'Caramel Syrup', 'src' => null, 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 20],
                    ['name' => 'Vanilla Ice Cream', 'src' => null, 'type' => 'I', 'category' => 'TOP', 'current_price' => 0, 'unit' => 100],
                    ['name' => 'Turmeric Powder', 'src' => null, 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 2],
                    ['name' => 'Raspberry Puree', 'src' => null, 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 20],
                    ['name' => 'Blueberry Puree', 'src' => null, 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 30],
                    ['name' => 'Cranberry Juice', 'src' => null, 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 50],
                    ['name' => 'Lime Juice', 'src' => null, 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 20],
                    ['name' => 'Peach Puree', 'src' => null, 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 40],
                    ['name' => 'Strawberry Puree', 'src' => null, 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 30],
                    ['name' => 'Fresh Lemon Juice', 'src' => null, 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 10],
                    ['name' => 'Orange Juice', 'src' => null, 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 50],
                    ['name' => 'Sugar Syrup', 'src' => null, 'type' => 'I', 'category' => 'SWE', 'current_price' => 0, 'unit' => 10],
                    ['name' => 'Green Tea Bag', 'src' => null, 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 1],

                ]);
                
                
                
        
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
