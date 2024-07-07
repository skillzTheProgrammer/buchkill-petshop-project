<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Electronics',
            'Clothing',
            'Books',
            'Home & Kitchen',
            'Toys & Games'
        ];

        foreach ($categories as $category) {
            Category::create([
                'uuid' => Str::uuid(),
                'title' => $category,
                'slug' => Str::slug($category)
            ]);
        }
    }
}
