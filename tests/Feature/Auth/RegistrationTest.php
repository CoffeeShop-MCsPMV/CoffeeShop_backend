<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'testing@example.com',
            'password' => 'password1',
            'password_confirmation' => 'password1',
            // 'is_suscribed'=>0,
            // 'profile_type'=>'U'
        ]);

        // $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['name' => 'Test User']);
    }
}
