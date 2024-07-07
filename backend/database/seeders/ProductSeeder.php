<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            Product::create([
                'category_id' => $category->id,
                'title' => 'Sample Product ' . $category->id,
                'price' => 100.00,
                'description' => 'This is a sample product description.',
                'metadata' => json_encode(['key' => 'value']),
            ]);
        }
    }
}
