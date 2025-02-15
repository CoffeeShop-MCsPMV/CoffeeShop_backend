<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        $user = [
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post('/register', $user);

        // Ha az API JSON választ ad vissza, akkor inkább assertCreated()
        $response->assertRedirect('/home'); // Ha a regisztráció után átirányít
        // vagy
        // $response->assertStatus(201); // Ha API válaszként JSON-t küld vissza

        $this->assertAuthenticated();

        // A jelszó nem egyezik az adatbázisban a hashelés miatt, ezért így ellenőrizzük:
        $this->assertDatabaseHas('users', [
            'name' => 'User',
            'email' => 'user@example.com',
        ]);
    }
}
