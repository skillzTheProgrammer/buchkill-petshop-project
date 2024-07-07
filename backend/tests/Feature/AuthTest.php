<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user registration.
     *
     * @return void
     */
    public function testUserRegistration()
    {
        $response = $this->postJson('/api/v1/user/create', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'avatar' => null,
            'address' => 'somewhere in the world',
            'phone_number' => '123-456-7890',
            'is_marketing' => false,
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         'user' => [
                             'id',
                             'uuid',
                             'first_name',
                             'last_name',
                             'email',
                             'address',
                             'phone_number',
                             'created_at',
                             'updated_at',
                         ],
                         'token'
                     ]
                 ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com'
        ]);
    }

    /**
     * Test user login.
     *
     * @return void
     */
    public function testUserLogin()
    {
        // Create a user
        $user = User::create([
            'uuid' => Str::uuid(),
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane.doe@example.com',
            'password' => Hash::make('password'),
            'avatar' => null,
            'address' => json_encode(['street' => '456 Main St', 'city' => 'Anytown', 'state' => 'CA']),
            'phone_number' => '123-456-7890',
            'is_marketing' => false,
        ]);

        $response = $this->postJson('/api/v1/user/login', [
            'email' => 'jane.doe@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         'token'
                     ]
                 ]);
    }

    /**
     * Test invalid user login.
     *
     * @return void
     */
    public function testInvalidUserLogin()
    {
        $response = $this->postJson('/api/v1/user/login', [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword'
        ]);

        $response->assertStatus(401)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Invalid credentials',
                     'errors' => []
                 ]);
    }
}
