<?php

namespace Tests\Feature;

use App\Models\Content;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ContentTest extends TestCase
{
    // use RefreshDatabase;

    // #[Test]
    // public function it_can_store_content()
    // {
    //     $user = User::find(2);
    //     $order = Order::create([
    //         'user' => $user->id,
    //         'date' => '2025-02-15',
    //     ]);
    //     $orderItem = OrderItem::create([
    //         'order_id' => $order->id,
    //     ]);

    //     $cup = $orderItem->cup_id;

    //     $data = [
    //         'product_id' => 20015,
    //         'cup_id' => $cup,
    //         'product_type' => 'F',
    //     ];

    //     $response = $this->post('/contents', $data);
        
    //     $this->assertDatabaseHas('contents', [
    //         'product_id' => 20015,
    //         'cup_id' => $cup,
    //     ]);

    //     $this->assertEquals(2.50, OrderItem::where('cup_id', $cup)->value('item_price'));
    //     $this->assertEquals(2.50, Order::where('id', $order->id)->value('total_cost'));
    // }

    // // #[Test]
    // // public function it_can_show_content_for_a_specific_cup_and_product()
    // // {
    // //     $user = User::find(2);
    // //     $order = Order::create([
    // //         'user_id' => $user->id,
    // //         'date' => '2025-02-15',
    // //     ]);
    // //     $orderItem = OrderItem::create([
    // //         'order_id' => $order->id,
    // //     ]);
        
    // //     $cup = $orderItem->cup_id;

    // //     $response = $this->getJson("/contents/$cup/20016");

    // //     $response->assertJson([
    // //         'product_id' => 20016,
    // //         'cup_id' => $cup,
    // //     ]);
    // // }

    // // #[Test]
    // // public function it_can_return_all_contents_of_a_cup()
    // // {
    // //     $user = User::find(2);
    // //     $order = Order::create([
    // //         'user_id' => $user->id,
    // //         'date' => '2025-02-15',
    // //     ]);
    // //     $orderItem = OrderItem::create([
    // //         'order_id' => $order->id,
    // //     ]);
        
    // //     $cup = $orderItem->cup_id;

    // //     Content::factory()->create(['product_id' => 20000, 'cup_id' => $cup]);
    // //     Content::factory()->create(['product_id' => 20001, 'cup_id' => $cup]);

    // //     $response = $this->get("/contents-of-cup/$cup");

    // //     $response->assertStatus(200);
    // //     $response->assertJsonFragment(['product_id' => 20000]);
    // //     $response->assertJsonFragment(['product_id' => 20001]);
    // // }

    // // #[Test]
    // // public function it_can_return_top_products()
    // // {
    // //     Content::factory()->create(['product_id' => 20015]);
    // //     Content::factory()->create(['product_id' => 20015]);
    // //     Content::factory()->create(['product_id' => 20016]);

    // //     $response = $this->getJson('/contents/top-products');

    // //     $response->assertStatus(200);
    // //     $response->assertJsonFragment(['product_id' => 20015]);
    // //     $response->assertJsonFragment(['product_id' => 20016]);
    // // }
}