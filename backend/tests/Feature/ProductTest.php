<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed necessary data
        $this->seed(CategorySeeder::class);
        $this->seed(ProductSeeder::class);
    }

    /**
     * Test retrieving all products.
     *
     * @return void
     */
    public function testGetAllProducts()
    {
        // Log the user in to get a token
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

        $loginResponse = $this->postJson('/api/v1/user/login', [
            'email' => 'john.doe@example.com',
            'password' => 'password'
        ]);

        $loginResponse->assertStatus(200);

        $token = $loginResponse->json('data.token');

        // Get all products
        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->getJson('/api/v1/products');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         '*' => [
                             'id',
                             'category_id',
                             'uuid',
                             'title',
                             'price',
                             'description',
                             'metadata',
                             'created_at',
                             'updated_at',
                         ]
                     ]
                 ]);
    }

    /**
     * Test creating a product.
     *
     * @return void
     */
    public function testCreateProduct()
    {
        // Log the user in to get a token
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

        $loginResponse = $this->postJson('/api/v1/user/login', [
            'email' => 'john.doe@example.com',
            'password' => 'password'
        ]);

        $loginResponse->assertStatus(200);

        $token = $loginResponse->json('data.token');

        $category = Category::first();

        // Create a product
        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->postJson('/api/v1/product/create', [
                             'category_id' => $category->id,
                             'title' => 'New Product',
                             'price' => 99.99,
                             'description' => 'Product description',
                         ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         'id',
                         'category_id',
                         'uuid',
                         'title',
                         'price',
                         'description',
                         'created_at',
                         'updated_at',
                     ]
                 ]);

        $this->assertDatabaseHas('products', [
            'title' => 'New Product',
            'description' => 'Product description',
            'price' => 99.99
        ]);
    }

    /**
     * Test retrieving a single product.
     *
     * @return void
     */
    public function testGetSingleProduct()
    {
        // Create a product
        $product = Product::first();

        // Log the user in to get a token
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

        $loginResponse = $this->postJson('/api/v1/user/login', [
            'email' => 'john.doe@example.com',
            'password' => 'password'
        ]);

        $loginResponse->assertStatus(200);

        $token = $loginResponse->json('data.token');

        // Get single product
        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->getJson("/api/v1/product/{$product->uuid}");

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         'id',
                         'category_id',
                         'uuid',
                         'title',
                         'price',
                         'description',
                         'metadata',
                         'created_at',
                         'updated_at',
                     ]
                 ]);
    }

    /**
     * Test updating a product.
     *
     * @return void
     */
    public function testUpdateProduct()
    {
        // Create a product
        $product = Product::first();

        // Log the user in to get a token
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

        $loginResponse = $this->postJson('/api/v1/user/login', [
            'email' => 'john.doe@example.com',
            'password' => 'password'
        ]);

        $loginResponse->assertStatus(200);

        $token = $loginResponse->json('data.token');

        // Update product
        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->putJson("/api/v1/product/{$product->uuid}", [
                             'category_id' => $product->category_id,
                             'title' => 'Updated Product',
                             'price' => 199.99,
                             'description' => 'Updated description',
                         ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         'id',
                         'category_id',
                         'uuid',
                         'title',
                         'price',
                         'description',
                         'created_at',
                         'updated_at',
                     ]
                 ]);

        $this->assertDatabaseHas('products', [
            'uuid' => $product->uuid,
            'title' => 'Updated Product',
            'description' => 'Updated description',
            'price' => 199.99
        ]);
    }

    /**
     * Test deleting a product.
     *
     * @return void
     */
    public function testDeleteProduct()
    {
        // Create a product
        $product = Product::first();

        // Log the user in to get a token
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

        $loginResponse = $this->postJson('/api/v1/user/login', [
            'email' => 'john.doe@example.com',
            'password' => 'password'
        ]);

        $loginResponse->assertStatus(200);

        $token = $loginResponse->json('data.token');

        // Delete product
        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->deleteJson("/api/v1/product/{$product->uuid}");

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Product deleted successfully',
                     'data' => null
                 ]);

        $this->assertSoftDeleted('products', [
            'uuid' => $product->uuid
        ]);
    }
}
