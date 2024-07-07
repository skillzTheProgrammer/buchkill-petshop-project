<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            'Nike',
            'Adidas',
            'Sony',
            'Samsung',
            'Apple'
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'uuid' => Str::uuid(),
                'title' => $brand,
                'slug' => Str::slug($brand)
            ]);
        }
    }
}
