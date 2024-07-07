<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Database\Seeders\OrderStatusSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test show user details.
     *
     * @return void
     */
    public function testShowUserDetails()
    {
        // Create a user
        $user = User::create([
            'uuid' => Str::uuid(),
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password'),
            'phone_number' => '123-456-7890',
            'address' => '456 Main St, Anytown, CA',
            'is_marketing' => false,
        ]);

        // Log the user in to get a token
        $loginResponse = $this->postJson('/api/v1/user/login', [
            'email' => 'john.doe@example.com',
            'password' => 'password'
        ]);

        $loginResponse->assertStatus(200);

        $token = $loginResponse->json('data.token');

        // Show user details
        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->getJson('/api/v1/user');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         'id',
                         'uuid',
                         'first_name',
                         'last_name',
                         'email',
                         'address',
                         'phone_number',
                         'created_at',
                         'updated_at',
                     ]
                 ]);
    }

    /**
     * Test update user details.
     *
     * @return void
     */
    public function testUpdateUserDetails()
    {
        // Create a user
        $user = User::create([
            'uuid' => Str::uuid(),
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password'),
            'phone_number' => '123-456-7890',
            'address' => '456 Main St, Anytown, CA',
            'is_marketing' => false,
        ]);

        // Log the user in to get a token
        $loginResponse = $this->postJson('/api/v1/user/login', [
            'email' => 'john.doe@example.com',
            'password' => 'password'
        ]);

        $loginResponse->assertStatus(200);

        $token = $loginResponse->json('data.token');

        // Update user details
        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->putJson('/api/v1/user/edit', [
                             'first_name' => 'Jane',
                             'last_name' => 'Smith',
                             'phone_number' => '987-654-3210',
                             'address' => '123 New St, New City, CA',
                         ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         'id',
                         'uuid',
                         'first_name',
                         'last_name',
                         'email',
                         'address',
                         'phone_number',
                         'created_at',
                         'updated_at',
                     ]
                 ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'phone_number' => '987-654-3210',
            'address' => '123 New St, New City, CA',
        ]);
    }

    /**
     * Test delete user account.
     *
     * @return void
     */
    public function testDeleteUserAccount()
    {
        // Create a user
        $user = User::create([
            'uuid' => Str::uuid(),
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password'),
            'phone_number' => '123-456-7890',
            'address' => '456 Main St, Anytown, CA',
            'is_marketing' => false,
        ]);

        // Log the user in to get a token
        $loginResponse = $this->postJson('/api/v1/user/login', [
            'email' => 'john.doe@example.com',
            'password' => 'password'
        ]);

        $loginResponse->assertStatus(200);

        $token = $loginResponse->json('data.token');

        // Delete user account
        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->deleteJson('/api/v1/user');

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'User account deleted successfully',
                     'data' => null
                 ]);

        $this->assertDatabaseMissing('users', [
            'email' => 'john.doe@example.com'
        ]);
    }

    /**
     * Test retrieve user orders.
     *
     * @return void
     */
    public function testRetrieveUserOrders()
    {
        // Create a user
        $user = User::create([
            'uuid' => Str::uuid(),
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password'),
            'phone_number' => '123-456-7890',
            'address' => '456 Main St, Anytown, CA',
            'is_marketing' => false,
        ]);
   // Seed the order statuses
        $this->seed(OrderStatusSeeder::class);

        // Log the user in to get a token
        $loginResponse = $this->postJson('/api/v1/user/login', [
            'email' => 'john.doe@example.com',
            'password' => 'password'
        ]);

        $loginResponse->assertStatus(200);

        $token = $loginResponse->json('data.token');

        // Retrieve user orders
        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->getJson('/api/v1/user/orders');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         '*' => [
                             'id',
                             'user_id',
                             'order_status_id',
                             'uuid',
                             'products',
                             'address',
                             'delivery_fee',
                             'amount',
                             'shipped_at',
                             'created_at',
                             'updated_at',
                         ]
                     ]
                 ]);
    }
}
