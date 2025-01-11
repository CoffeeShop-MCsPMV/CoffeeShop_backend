<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dictionaries', function (Blueprint $table) {
            $table->char('id', 3)->primary();
            $table->string('description', 40);
            $table->char('reference', 1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dictionaries');
    }
};
