<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Dictionary;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductRecipe;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
  

        Dictionary::factory(20)->create();
        User::factory(10)->create();
        Product::factory(30)->create();
        Order::factory(40)->create();
        OrderItem::factory(60)->create();
        Content::factory(90)->create();
        

        User::create([
            'name' => 'Test Admin',  
            'email' => 'testadmin@example.com',  
            'password' => Hash::make('admin123'), 
            'is_subscribed' => true,  
            'profile_type' => 'A',  
        ]);

        User::create([
            'name' => 'Test User',  
            'email' => 'testuser@example.com',  
            'password' => Hash::make('user123'), 
            'is_subscribed' => true,  
            'profile_type' => 'U',  
        ]);
    }
}
