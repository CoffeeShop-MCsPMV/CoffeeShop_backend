<?php

use App\Models\Dictionary;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dictionaries', function (Blueprint $table) {
            $table->char('code', 3)->primary();
            $table->string('description', 40);
            $table->char('reference', 1);
            $table->timestamps();
        });

        DB::table('dictionaries')->insert([
            ['code' => 'REC', 'description' => 'Received', 'reference' => 'S'],
            ['code' => 'ACC', 'description' => 'Accepted', 'reference' => 'S'],
            ['code' => 'PRO', 'description' => 'In Progress', 'reference' => 'S'],
            ['code' => 'COM', 'description' => 'Completed', 'reference' => 'S'],
            ['code' => 'PUP', 'description' => 'Picked Up', 'reference' => 'S'],
            ['code' => 'CAN', 'description' => 'Canceled', 'reference' => 'S'],
        ]);

        DB::table('dictionaries')->insert([
            ['code' => 'COF', 'description' => 'Coffee', 'reference' => 'F'],
            ['code' => 'TEA', 'description' => 'Tea', 'reference' => 'F'],
            ['code' => 'ICF', 'description' => 'Iced Coffee', 'reference' => 'F'],
            ['code' => 'ICT', 'description' => 'Iced Tea', 'reference' => 'F'],
            ['code' => 'HOD', 'description' => 'Hot drinks', 'reference' => 'F'],
            ['code' => 'IDR', 'description' => 'Iced drinks', 'reference' => 'F'],
        ]);
        
        DB::table('dictionaries')->insert([
            ['code' => 'COR', 'description' => 'Core', 'reference' => 'I'],
            ['code' => 'BAS', 'description' => 'Base Ingredients', 'reference' => 'I'],
            ['code' => 'ICE', 'description' => 'Ice', 'reference' => 'I'],
            ['code' => 'MIL', 'description' => 'Milks', 'reference' => 'I'],
            ['code' => 'SWE', 'description' => 'Sweeteners', 'reference' => 'I'],
            ['code' => 'SYR', 'description' => 'Flavored Syrups', 'reference' => 'I'],
            ['code' => 'TOP', 'description' => 'Toppings', 'reference' => 'I'],
            ['code' => 'FRU', 'description' => 'Fruit purees / juices', 'reference' => 'I'],

        ]);
        
        
    }

    public function down(): void
    {
        Schema::dropIfExists('dictionaries');
    }
};
