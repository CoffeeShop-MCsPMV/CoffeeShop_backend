<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testAPostResponse():void{
        $response = $this->withoutMiddleware()->post('/api/users', ['name' => 'Amy', 'email' => 'amy@example.com', 'password' => '123', 'is_subscribed' => 0, 'profile_type' => 'U']);
        $response->assertStatus(200);
    }

    public function testUserId():void{
        $user = User::factory()->make();
        $this->withoutMiddleware()->get('/api/users/' . $user->id)->assertStatus(200);
    }

    public function testUserIdAuth():void{
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/api/users/' . $user->id);
        $response->assertStatus(200);

    }

    public function test_users_auth() : void {
        //$this->withoutExceptionHandling();
        // create rögzíti az adatbázisban a felh-t
        $admin = User::factory()->create([
            'profile_type' => "A",
        ]);
        $response = $this->actingAs($admin)->get('/api/users/'.$admin->id);
        $response->assertStatus(200);
    }

}
