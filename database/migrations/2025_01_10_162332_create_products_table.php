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

            $table->foreign('category')->references('code')->on('dictionaries')->onDelete('cascade');
        });

        DB::table('products')->insert([
            // Összetevők
            ['name' => 'Ground Coffee', 'src' => null, 'type' => 'I', 'category' => 'COR', 'current_price' => 0, 'unit' => 2],
            ['name' => 'Water', 'src' => 'images/water.png', 'type' => 'I', 'category' => 'COR', 'current_price' => 0, 'unit' => 10],
            ['name' => 'Milk', 'src' => 'images/milk.png', 'type' => 'I', 'category' => 'MIL', 'current_price' => 0, 'unit' => 100],
            ['name' => 'Whipped Cream', 'src' =>'images/whipped.png', 'type' => 'I', 'category' => 'TOP', 'current_price' => 0, 'unit' => 30],
            // ['name' => 'Ice', 'type' => 'I', 'category' => '', 'current_price' => 0, 'unit' => 200],
            ['name' => 'Chocolate Syrup', 'src' => 'images/ChocholateSyr.png', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 20],
            ['name' => 'Matcha Powder', 'src' => 'images/matcha.png', 'type' => 'I', 'category' => 'BAS', 'current_price' => 2.5, 'unit' => 2],
            ['name' => 'Honey', 'src' => null, 'type' => 'I', 'category' => 'SWE', 'current_price' => 0, 'unit' => 10],
            ['name' => 'Cinnamon Syrup', 'src' => 'images/cinamonSyr.png', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 10],
            ['name' => 'Vanilla Syrup', 'src' => 'images/VanilliaSyr.png', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 20],
            ['name' => 'Coconut Syrup', 'src' => 'images/coconutSyr.png', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 20],
            ['name' => 'Lavender Syrup', 'src' => 'images/levanderSyr.png', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0.8, 'unit' => 10],
            ['name' => 'Chai Tea', 'src' => 'images/chaiTea.png', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 20],
            ['name' => 'Peach Tea Bag', 'src' => 'images/peachTea.png', 'type' => 'I', 'category' => 'COR', 'current_price' => 0, 'unit' => 1],
            ['name' => 'Black Tea Bag', 'src' => 'images/blackTea.png', 'type' => 'I', 'category' => 'COR', 'current_price' => 1.2, 'unit' => 1],

            // Késztermékek
            
                ['name' => 'Espresso', 'src' => 'images/espresso.png', 'type' => 'F', 'category' => 'COF', 'current_price' => 1.50, 'unit' => 30],
                ['name' => 'Cappuccino', 'src' => 'images/cappuccino.png', 'type' => 'F', 'category' => 'COF', 'current_price' => 2.50, 'unit' => 150],
                ['name' => 'Latte', 'src' => 'images/latte.png', 'type' => 'F', 'category' => 'COF', 'current_price' => 2.80, 'unit' => 250],
                ['name' => 'Frappuccino', 'src' => 'images/frappuccino.png', 'type' => 'F', 'category' => 'ICF', 'current_price' => 4.00, 'unit' => 300],
                ['name' => 'Matcha Latte', 'src' => 'images/matcha_latte.png', 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Flat White', 'src' => 'images/flat_white.png', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.20, 'unit' => 200],
                ['name' => 'Melange', 'src' => 'images/melange.png', 'type' => 'F', 'category' => 'COF', 'current_price' => 2.70, 'unit' => 200],
                ['name' => 'Hot Chocolate', 'src' => 'images/hot_chocolate.png', 'type' => 'F', 'category' => 'HOD', 'current_price' => 1.80, 'unit' => 250],
                ['name' => 'Green Tea', 'src' => 'images/green_tea.png', 'type' => 'F', 'category' => 'TEA', 'current_price' => 1.50, 'unit' => 200],
                ['name' => 'Iced Coffee', 'src' => 'images/iced_coffee.png', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.00, 'unit' => 300],
                ['name' => 'Snow Coffee', 'src' => 'images/winter_coffee.png', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.50, 'unit' => 350],
                ['name' => 'Tea Latte', 'src' => 'images/tea_latte.png', 'type' => 'F', 'category' => 'HOD', 'current_price' => 2.80, 'unit' => 250],
                ['name' => 'Iced Latte', 'src' => 'images/iced_latte.png', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.00, 'unit' => 250],
                ['name' => 'Iced Mocha', 'src' => 'images/iced_mocha.png', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.50, 'unit' => 300],
                ['name' => 'Macchiato', 'src' => 'images/macchiato.png', 'type' => 'F', 'category' => 'COF', 'current_price' => 2.00, 'unit' => 90],
                ['name' => 'Caramel Latte', 'src' => 'images/caramel_latte.png', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Affogato', 'src' => 'images/affogato.png', 'type' => 'F', 'category' => 'COF', 'current_price' => 4.00, 'unit' => 150],
                ['name' => 'Vanilla Latte', 'src' => 'images/vanilla_latte.png', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Iced Matcha Latte', 'src' => 'images/iced_matcha_latte.png', 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.80, 'unit' => 250],
                ['name' => 'Cinnamon Latte', 'src' => 'images/cinnamon_latte.png', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.30, 'unit' => 250],
                ['name' => 'Chai Latte', 'src' => 'images/chai_latte.png', 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.20, 'unit' => 250],
                ['name' => 'Ristretto', 'src' => 'images/ristretto.png', 'type' => 'F', 'category' => 'COF', 'current_price' => 1.50, 'unit' => 20],
                ['name' => 'Turmeric Latte', 'src' => 'images/turmeric_latte.png', 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Honey Lavender Latte', 'src' => 'images/honey_lavender_latte.png', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.80, 'unit' => 250],
                ['name' => 'Iced Americano', 'src' => 'images/iced_americano.png', 'type' => 'F', 'category' => 'ICF', 'current_price' => 2.50, 'unit' => 300],
                ['name' => 'Caramel Macchiato', 'src' => 'images/caramel_macchiato.png', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Iced Flat White', 'src' => 'images/iced_flat_white.png', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Chocolate Affogato', 'src' => 'images/affogato_chocolate.png', 'type' => 'F', 'category' => 'COF', 'current_price' => 4.20, 'unit' => 150],
                ['name' => 'Coconut Latte', 'src' => 'images/coconut_latte.png', 'type' => 'F', 'category' => 'COF', 'current_price' => 3.50, 'unit' => 250],
                ['name' => 'Iced Caramel Latte', 'src' => 'images/iced_caramel_latte.png', 'type' => 'F', 'category' => 'ICF', 'current_price' => 3.80, 'unit' => 300],
                ['name' => 'Peach Iced Tea', 'src' => 'images/iced_peach_tea.png', 'type' => 'F', 'category' => 'ICT', 'current_price' => 2.50, 'unit' => 300],
                ['name' => 'Iced Chai Latte', 'src' => 'images/iced_chai_latte.png', 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.50, 'unit' => 300],
            
            
            
            
            
            
        ]);

        DB::table('products')->insert([
            ['name' => 'Classic Lemonade', 'src' => 'images/classic_lemonade.png', 'type' => 'F', 'category' => 'IDR', 'current_price' => 2.50, 'unit' => 300],
            ['name' => 'Strawberry Lemonade', 'src' => 'images/strawberry_lemonade.png', 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.00, 'unit' => 300],
            ['name' => 'Blueberry Lemonade', 'src' => 'images/blueberry_lemonade.png', 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.20, 'unit' => 300],
            ['name' => 'Lavender Lemonade', 'src' => 'images/lavender_lemonade.png', 'type' => 'F', 'category' => 'IDR', 'current_price' => 3.50, 'unit' => 300],
            ['name' => 'Berry Punch', 'src' => 'images/berry_punch2.png', 'type' => 'F', 'category' => 'HOD', 'current_price' => 4.00, 'unit' => 350],
            ['name' => 'Citrus Punch', 'src' => 'images/citrus_punch.png', 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.50, 'unit' => 300],
            ['name' => 'Peach Punch', 'src' => 'images/peach_punch.png', 'type' => 'F', 'category' => 'HOD', 'current_price' => 3.70, 'unit' => 300],
        ]);

        // kimaradt összetevők:

        DB::table('products')->insert([
            ['name' => 'Espresso Coffee', 'src' =>'images/espressoIngredient.png', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 30],
            ['name' => 'Ice', 'src' => null, 'type' => 'I', 'category' => 'ICE', 'current_price' => 0, 'unit' => 200],
            ['name' => 'Caramel Syrup', 'src' => 'images/caramellSyr.png', 'type' => 'I', 'category' => 'SYR', 'current_price' => 0, 'unit' => 20],
            ['name' => 'Vanilla Ice Cream', 'src' => 'images/vanillia.png', 'type' => 'I', 'category' => 'TOP', 'current_price' => 0, 'unit' => 100],
            ['name' => 'Turmeric Powder', 'src' => 'images/turmericPow.png', 'type' => 'I', 'category' => 'BAS', 'current_price' => 0, 'unit' => 2],
            ['name' => 'Raspberry Puree', 'src' => null, 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 20],
            ['name' => 'Blueberry Puree', 'src' => null, 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 30],
            ['name' => 'Cranberry Juice', 'src' => null, 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 50],
            ['name' => 'Lime Juice', 'src' => null, 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 20],
            ['name' => 'Peach Puree', 'src' => null, 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 40],
            ['name' => 'Strawberry Puree', 'src' => null, 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 30],
            ['name' => 'Lemon Juice', 'src' => null, 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 10],
            ['name' => 'Orange Juice', 'src' => null, 'type' => 'I', 'category' => 'FRU', 'current_price' => 0, 'unit' => 50],
            ['name' => 'Sugar Syrup', 'src' => null, 'type' => 'I', 'category' => 'SWE', 'current_price' => 0, 'unit' => 10],
            ['name' => 'Green Tea Bag', 'src' =>'images/greenTea.png', 'type' => 'I', 'category' => 'COR', 'current_price' => 0, 'unit' => 1],
            ['name' => 'Almond Milk', 'src' => 'images/almondMilk.png', 'type' => 'I', 'category' => 'MIL', 'current_price' => 0, 'unit' => 100],
            ['name' => 'Oat Milk', 'src' => 'images/OatMilk.png', 'type' => 'I', 'category' => 'MIL', 'current_price' => 0, 'unit' => 100],

        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
