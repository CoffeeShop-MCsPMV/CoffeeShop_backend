<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("CREATE TRIGGER recipe_product_types
ON product_recipes
INSTEAD OF INSERT
AS
BEGIN
    IF EXISTS (
        SELECT * FROM inserted i
        LEFT JOIN products p1 ON i.product = p1.product_id
        LEFT JOIN products p2 ON i.ingredient = p2.product_id
        WHERE p1.type IS NULL OR p2.type IS NULL OR p1.type <> 'F' OR p2.type <> 'I'    )
    BEGIN
        RAISERROR (\"The product must be of type 'F' (finished product) and the ingredient must be of type 'I' (ingredient)\", 16, 1);
        ROLLBACK TRANSACTION;
        RETURN;
    END

    INSERT INTO product_recipes (product, ingredient, quantity)
    SELECT product, ingredient, quantity
    FROM inserted;
END;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         DB::unprepared('DROP TRIGGER IF EXISTS recipe_product_types');
    }
};
