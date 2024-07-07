<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\PasswordReset;
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
            'phone_number' => '123-456-7890',
            'address' => '456 Main St, Anytown, CA',
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

    /**
     * Test user logout.
     *
     * @return void
     */
    public function testUserLogout()
    {
        // Create a user
        $user = User::create([
            'uuid' => Str::uuid(),
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane.doe@example.com',
            'password' => Hash::make('password'),
            'phone_number' => '123-456-7890',
            'address' => '456 Main St, Anytown, CA',
            'is_marketing' => false,
        ]);

        // Log the user in to get a token
        $loginResponse = $this->postJson('/api/v1/user/login', [
            'email' => 'jane.doe@example.com',
            'password' => 'password'
        ]);

        $loginResponse->assertStatus(200);

        $token = $loginResponse->json('data.token');

        // Logout the user
        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->postJson('/api/v1/user/logout');

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Logged out successfully',
                     'data' => null
                 ]);
    }

    /**
     * Test forgot password.
     *
     * @return void
     */
    public function testForgotPassword()
    {
        // Create a user
        $user = User::create([
            'uuid' => Str::uuid(),
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane.doe@example.com',
            'password' => Hash::make('password'),
            'phone_number' => '123-456-7890',
            'address' => '456 Main St, Anytown, NG',
            'is_marketing' => false,
        ]);

        $response = $this->postJson('/api/v1/user/forgot-password', [
            'email' => 'jane.doe@example.com',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         'token'
                     ]
                 ]);

        $this->assertDatabaseHas('password_resets', [
            'email' => 'jane.doe@example.com'
        ]);
    }

    /**
     * Test reset password.
     *
     * @return void
     */
    public function testResetPassword()
    {
        // Create a user
        $user = User::create([
            'uuid' => Str::uuid(),
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane.doe@example.com',
            'password' => Hash::make('password'),
            'phone_number' => '123-456-7890',
            'address' => '456 Main St, Anytown, CA',
            'is_marketing' => false,
        ]);

        // Create a password reset token
        $token = Str::random(60);
        PasswordReset::create([
            'email' => 'jane.doe@example.com',
            'token' => $token,
            'created_at' => now(),
        ]);

        $response = $this->postJson('/api/v1/user/reset-password-token', [
            'token' => $token,
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Password reset successfully',
                     'data' => null
                 ]);

        $this->assertDatabaseMissing('password_resets', [
            'email' => 'jane.doe@example.com',
            'token' => $token
        ]);

        $this->assertTrue(Hash::check('newpassword', $user->fresh()->password));
    }
}
