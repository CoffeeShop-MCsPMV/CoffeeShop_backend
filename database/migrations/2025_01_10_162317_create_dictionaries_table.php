<?php

use App\Models\Dictionary;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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

        Dictionary::create([
            'code'=>'ABC',
            'description'=>'teszt_adat1',
            'reference'=>'A',]
        );

        Dictionary::create([
            'code'=>'BCD',
            'description'=>'teszt_adat2',
            'reference'=>'A',]
        );

        Dictionary::create([
            'code'=>'CDE',
            'description'=>'teszt_adat3',
            'reference'=>'B',]
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('dictionaries');
    }
};
