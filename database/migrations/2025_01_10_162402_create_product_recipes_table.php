<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_recipes', function (Blueprint $table) {
            $table->unsignedBigInteger('product');
            $table->unsignedBigInteger('ingredient');
            $table->integer('quantity');
            $table->timestamps();

            $table->primary(['product', 'ingredient']);

            $table->foreign('product')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('ingredient')->references('product_id')->on('products')->onDelete('cascade');

            DB::table('product_recipes')->insert([
                //espresso
                ['product' => 20014, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20014, 'ingredient' => 20001, 'quantity' => 3],
                //cappucino
                ['product' => 20015, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20015, 'ingredient' => 20002, 'quantity' => 1.2],
                ['product' => 20015, 'ingredient' => 20003, 'quantity' => 1],
                ['product' => 20015, 'ingredient' => 20001, 'quantity' => 3],
                //latte
                ['product' => 20016, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20016, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20016, 'ingredient' => 20002, 'quantity' => 2.2],
                //frappucino
                ['product' => 20017, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20017, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20017, 'ingredient' => 20054, 'quantity' => 1],
                ['product' => 20017, 'ingredient' => 20002, 'quantity' => 0.7],
                ['product' => 20017, 'ingredient' => 20004, 'quantity' => 1],
                //matcha latte
                ['product' => 20018, 'ingredient' => 20005, 'quantity' => 1],
                ['product' => 20018, 'ingredient' => 20002, 'quantity' => 2.4],
                ['product' => 20018, 'ingredient' => 20006, 'quantity' => 1],
                //flat white
                ['product' => 20019, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20019, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20019, 'ingredient' => 20002, 'quantity' => 1.7],
                //melange
                ['product' => 20020, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20020, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20020, 'ingredient' => 20002, 'quantity' => 1.5],
                ['product' => 20020, 'ingredient' => 20003, 'quantity' => 1],
                //hot chocolate
                ['product' => 20021, 'ingredient' => 20002, 'quantity' => 2.2],
                ['product' => 20021, 'ingredient' => 20004, 'quantity' => 1.5],
                ['product' => 20021, 'ingredient' => 20003, 'quantity' => 1],
                //green tea
                ['product' => 20022, 'ingredient' => 20067, 'quantity' => 1],
                ['product' => 20022, 'ingredient' => 20001, 'quantity' => 20],
                //iced coffee
                ['product' => 20023, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20023, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20023, 'ingredient' => 20054, 'quantity' => 1],
                ['product' => 20023, 'ingredient' => 20002, 'quantity' => 1],
                ['product' => 20023, 'ingredient' => 20008, 'quantity' => 1],
                //winter coffee
                ['product' => 20024, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20024, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20024, 'ingredient' => 20054, 'quantity' => 1.25],
                ['product' => 20024, 'ingredient' => 20007, 'quantity' => 1],
                ['product' => 20024, 'ingredient' => 20002, 'quantity' => 0.7],
                //tea latte
                ['product' => 20025, 'ingredient' => 20013, 'quantity' => 1],
                ['product' => 20025, 'ingredient' => 20001, 'quantity' => 15],
                ['product' => 20025, 'ingredient' => 20002, 'quantity' => 1],
                //iced latte
                ['product' => 20026, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20026, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20026, 'ingredient' => 20054, 'quantity' => 1],
                ['product' => 20026, 'ingredient' => 20002, 'quantity' => 0.7],
                //iced mocha
                ['product' => 20027, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20027, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20027, 'ingredient' => 20054, 'quantity' => 1],
                ['product' => 20027, 'ingredient' => 20002, 'quantity' => 1],
                ['product' => 20027, 'ingredient' => 20004, 'quantity' => 1.5],
                //macchiato
                ['product' => 20028, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20028, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20028, 'ingredient' => 20002, 'quantity' => 0.6],
                //caramel latte
                ['product' => 20029, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20029, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20029, 'ingredient' => 20002, 'quantity' => 2.2],
                ['product' => 20029, 'ingredient' => 20055, 'quantity' => 1],
                //affogate
                ['product' => 20030, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20030, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20030, 'ingredient' => 20056, 'quantity' => 1],
                ['product' => 20030, 'ingredient' => 20003, 'quantity' => 1],
                //vanilla latte
                ['product' => 20031, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20031, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20031, 'ingredient' => 20002, 'quantity' => 2.2],
                ['product' => 20031, 'ingredient' => 20008, 'quantity' => 1],
                //iced matcha latte
                ['product' => 20032, 'ingredient' => 20005, 'quantity' => 1],
                ['product' => 20032, 'ingredient' => 20054, 'quantity' => 1],
                ['product' => 20032, 'ingredient' => 20002, 'quantity' => 0.7],
                ['product' => 20032, 'ingredient' => 20006, 'quantity' => 1],
                //cinnamon latte
                ['product' => 20033, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20033, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20033, 'ingredient' => 20002, 'quantity' => 2.2],
                ['product' => 20033, 'ingredient' => 20007, 'quantity' => 1],
                //chai latte
                ['product' => 20034, 'ingredient' => 20011, 'quantity' => 1],
                ['product' => 20034, 'ingredient' => 20002, 'quantity' => 2.3],
                ['product' => 20034, 'ingredient' => 20006, 'quantity' => 1],
                //ristretto
                ['product' => 20035, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20035, 'ingredient' => 20001, 'quantity' => 2],
                //turmeric latte
                ['product' => 20036, 'ingredient' => 20057, 'quantity' => 1],
                ['product' => 20036, 'ingredient' => 20002, 'quantity' => 2.4],
                ['product' => 20036, 'ingredient' => 20006, 'quantity' => 1],
                //honey lavender latte
                ['product' => 20037, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20037, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20037, 'ingredient' => 20002, 'quantity' => 2.2],
                ['product' => 20037, 'ingredient' => 20010, 'quantity' => 1],
                ['product' => 20037, 'ingredient' => 20006, 'quantity' => 1],
                //iced americano
                ['product' => 20038, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20038, 'ingredient' => 20054, 'quantity' => 1.25],
                ['product' => 20038, 'ingredient' => 20001, 'quantity' => 13],
                //caramel macchiato
                ['product' => 20039, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20039, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20039, 'ingredient' => 20002, 'quantity' => 2.2],
                ['product' => 20039, 'ingredient' => 20055, 'quantity' => 1],
                //iced flat white
                ['product' => 20040, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20040, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20040, 'ingredient' => 20054, 'quantity' => 1],
                ['product' => 20040, 'ingredient' => 20002, 'quantity' => 0.7],
                //affogato chocolate
                ['product' => 20041, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20041, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20041, 'ingredient' => 20056, 'quantity' => 1],
                ['product' => 20041, 'ingredient' => 20004, 'quantity' => 1],
                //coconut latte
                ['product' => 20042, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20042, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20042, 'ingredient' => 20002, 'quantity' => 2.2],
                ['product' => 20042, 'ingredient' => 20009, 'quantity' => 1],
                //iced caramel latte
                ['product' => 20043, 'ingredient' => 20000, 'quantity' => 3],
                ['product' => 20043, 'ingredient' => 20001, 'quantity' => 3],
                ['product' => 20043, 'ingredient' => 20054, 'quantity' => 1],
                ['product' => 20043, 'ingredient' => 20002, 'quantity' => 0.7],
                ['product' => 20043, 'ingredient' => 20055, 'quantity' => 1],
                //peach tea
                ['product' => 20044, 'ingredient' => 20012, 'quantity' => 1],
                ['product' => 20044, 'ingredient' => 20054, 'quantity' => 1.25],
                ['product' => 20044, 'ingredient' => 20001, 'quantity' => 10],
                //iced chai latte
                ['product' => 20045, 'ingredient' => 20011, 'quantity' => 1],
                ['product' => 20045, 'ingredient' => 20054, 'quantity' => 1.25],
                ['product' => 20045, 'ingredient' => 20002, 'quantity' => 1],
                ['product' => 20045, 'ingredient' => 20006, 'quantity' => 1],
                //classic lemonade
                ['product' => 20046, 'ingredient' => 20064, 'quantity' => 3],
                ['product' => 20046, 'ingredient' => 20066, 'quantity' => 2],
                ['product' => 20046, 'ingredient' => 20001, 'quantity' => 25],
                ['product' => 20046, 'ingredient' => 20054, 'quantity' => 0.5],
                //berry lemonade
                ['product' => 20047, 'ingredient' => 20064, 'quantity' => 2],
                ['product' => 20047, 'ingredient' => 20063, 'quantity' => 1],
                ['product' => 20047, 'ingredient' => 20066, 'quantity' => 1],
                ['product' => 20047, 'ingredient' => 20001, 'quantity' => 24],
                ['product' => 20047, 'ingredient' => 20054, 'quantity' => 0.5],
                //blueberry lemonade
                ['product' => 20048, 'ingredient' => 20064, 'quantity' => 2],
                ['product' => 20048, 'ingredient' => 20059, 'quantity' => 1],
                ['product' => 20048, 'ingredient' => 20066, 'quantity' => 1],
                ['product' => 20048, 'ingredient' => 20001, 'quantity' => 24],
                ['product' => 20048, 'ingredient' => 20054, 'quantity' => 0.5],
                //lavender lemonade
                ['product' => 20049, 'ingredient' => 20064, 'quantity' => 2],
                ['product' => 20049, 'ingredient' => 20010, 'quantity' => 1],
                ['product' => 20049, 'ingredient' => 20066, 'quantity' => 1],
                ['product' => 20049, 'ingredient' => 20001, 'quantity' => 24],
                ['product' => 20049, 'ingredient' => 20054, 'quantity' => 0.5],
                //berry punch
                ['product' => 20050, 'ingredient' => 20058, 'quantity' => 1],
                ['product' => 20050, 'ingredient' => 20059, 'quantity' => 1],
                ['product' => 20050, 'ingredient' => 20060, 'quantity' => 1],
                ['product' => 20050, 'ingredient' => 20064, 'quantity' => 2],
                ['product' => 20050, 'ingredient' => 20001, 'quantity' => 24],
                //citrus punch
                ['product' => 20051, 'ingredient' => 20065, 'quantity' => 1],
                ['product' => 20051, 'ingredient' => 20064, 'quantity' => 2],
                ['product' => 20051, 'ingredient' => 20061, 'quantity' => 1],
                ['product' => 20051, 'ingredient' => 20066, 'quantity' => 2],
                ['product' => 20051, 'ingredient' => 20001, 'quantity' => 19],
                //peach punch
                ['product' => 20052, 'ingredient' => 20062, 'quantity' => 1],
                ['product' => 20052, 'ingredient' => 20064, 'quantity' => 2],
                ['product' => 20052, 'ingredient' => 20066, 'quantity' => 1],
                ['product' => 20052, 'ingredient' => 20001, 'quantity' => 23],
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_recipes');
    }
};
